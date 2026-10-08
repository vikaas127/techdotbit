<?php
/**
 * Puts the AI section live in one step:
 *  1. creates the AI pages if they do not exist yet (tools/create-ai-pages.php),
 *  2. publishes the hub and every page under /ai-services/,
 *  3. adds an "AI Services" dropdown to the main menu (before the last,
 *     button-styled item) listing all AI pages.
 *
 * Run from the WordPress root:
 *   wp eval-file wp-content/themes/ace/tools/ai-pages-go-live.php
 *
 * Safe to re-run: pages are not duplicated, menu items already present are
 * kept. To undo the menu change, delete "AI Services" in Appearance > Menus.
 */

if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
	exit; // CLI only.
}

/* 1. Make sure the pages exist ------------------------------------------ */
global $wpdb;
$find_hub = function () use ( $wpdb ) {
	$id = $wpdb->get_var( "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'page' AND post_name = 'ai-services' AND post_status NOT IN ('trash','auto-draft') ORDER BY ID ASC LIMIT 1" );
	return $id ? get_post( (int) $id ) : null;
};
$hub = $find_hub();
if ( ! $hub ) {
	WP_CLI::log( 'AI pages not found: creating them first...' );
	require __DIR__ . '/create-ai-pages.php';
	$hub = $find_hub();
}
if ( ! $hub ) {
	WP_CLI::error( 'Could not find or create the AI Services hub page.' );
}

/* 2. Publish ------------------------------------------------------------ */
$children = array_map( 'get_post', $wpdb->get_col( $wpdb->prepare(
	"SELECT ID FROM {$wpdb->posts} WHERE post_type = 'page' AND post_parent = %d AND post_status IN ('draft','pending','publish','private') ORDER BY menu_order ASC, ID ASC",
	$hub->ID
) ) );
foreach ( array_merge( array( $hub ), $children ) as $p ) {
	if ( 'publish' !== $p->post_status ) {
		wp_update_post( array( 'ID' => $p->ID, 'post_status' => 'publish' ) );
		WP_CLI::log( '  published  ' . $p->post_title );
	}
}

/* 3. Main menu ---------------------------------------------------------- */
$locations = get_nav_menu_locations();
$menu_id   = isset( $locations['primary-menu'] ) ? (int) $locations['primary-menu'] : 0;
if ( ! $menu_id ) {
	WP_CLI::warning( 'No menu is assigned to the "Primary Menu" location; skipping the menu step.' );
} else {
	$items  = wp_get_nav_menu_items( $menu_id, array( 'post_status' => 'any' ) );
	$parent = null;
	foreach ( $items as $it ) {
		if ( 'post_type' === $it->type && (int) $it->object_id === $hub->ID && 0 === (int) $it->menu_item_parent ) {
			$parent = $it;
		}
	}

	if ( ! $parent ) {
		// Insert as the second-to-last top-level item (the last one is styled as the CTA button).
		$top = array_values( array_filter( $items, function ( $it ) { return 0 === (int) $it->menu_item_parent; } ) );
		usort( $top, function ( $a, $b ) { return $a->menu_order - $b->menu_order; } );
		$insert_at = max( 1, count( $top ) ); // before the last top-level item
		$position  = $top ? $top[ $insert_at - 1 ]->menu_order : 1;

		// Make room: shift every item at or after the insert position.
		foreach ( $items as $it ) {
			if ( $it->menu_order >= $position ) {
				wp_update_post( array( 'ID' => $it->ID, 'menu_order' => $it->menu_order + 1 ) );
			}
		}
		$parent_id = wp_update_nav_menu_item( $menu_id, 0, array(
			'menu-item-title'     => 'AI Services',
			'menu-item-object'    => 'page',
			'menu-item-object-id' => $hub->ID,
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
			'menu-item-position'  => $position,
			'menu-item-classes'   => 'full-menu ai-menu',
		) );
		WP_CLI::log( '  menu       added "AI Services" to the main menu' );
	} else {
		$parent_id = $parent->ID;
		WP_CLI::log( '  menu       "AI Services" already in the main menu' );
	}

	// Children: one entry per AI page, in page order.
	$existing = array();
	foreach ( wp_get_nav_menu_items( $menu_id, array( 'post_status' => 'any' ) ) as $it ) {
		if ( (int) $it->menu_item_parent === (int) $parent_id ) {
			$existing[ (int) $it->object_id ] = true;
		}
	}
	$pos = 1;
	foreach ( $children as $c ) {
		if ( isset( $existing[ $c->ID ] ) ) {
			continue;
		}
		wp_update_nav_menu_item( $menu_id, 0, array(
			'menu-item-title'     => $c->post_title,
			'menu-item-object'    => 'page',
			'menu-item-object-id' => $c->ID,
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
			'menu-item-parent-id' => $parent_id,
			'menu-item-position'  => $pos++,
		) );
	}
	WP_CLI::log( sprintf( '  menu       %d AI pages listed under "AI Services"', count( $children ) ) );
}

WP_CLI::success( 'AI section is live: ' . get_permalink( $hub ) . '  (now run: wp litespeed-purge all)' );
