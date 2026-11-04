<?php
/**
 * Permanently fixes the internal links Ahrefs Site Audit flags, in the
 * database itself (the techdotbit-link-hygiene mu-plugin only rewrites them
 * as pages are served).
 *
 * Preview (changes nothing):
 *   wp eval-file wp-content/themes/ace/tools/fix-audit-links.php
 * Apply:
 *   wp eval-file wp-content/themes/ace/tools/fix-audit-links.php apply
 *
 * What it changes:
 *  - Menu item URLs (e.g. INDUSTRIES -> http://techdotbit.com/industries).
 *  - <a href> links in post, page and other post-type content.
 *  - Plain-text post meta (ACF fields) holding a techdotbit.com URL or <a> links.
 *  - Removes injected spam links (casino) and unlinks dead external links,
 *    keeping their text; fixes moved external URLs (dotoneforbusiness -> dotone.in).
 *  - Turns <h1> headings inside post content into <h2> (the theme already
 *    prints the title as the page's H1).
 *  - Lists (only) other links that look like injected spam, for review.
 *
 * Each link becomes its final address: https, no www, trailing slash, and
 * moved pages mapped (/blogs -> /blog/, /contact -> /contact-us/, ...).
 * Bare email hrefs (href="privacy@techdotbit.in") become mailto: links.
 * External links, files and serialized meta are not touched. Post modified
 * dates are kept.
 */

if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
	exit; // CLI only.
}

if ( ! function_exists( 'techdotbit_normalize_internal_url' ) ) {
	WP_CLI::error( 'The techdotbit-link-hygiene mu-plugin is not loaded; deploy wp-content/mu-plugins/techdotbit-link-hygiene.php first.' );
}

global $wpdb;

$apply = isset( $args ) && in_array( 'apply', (array) $args, true );
WP_CLI::log( $apply ? '== APPLYING CHANGES ==' : '== PREVIEW (nothing is changed; add "apply" to run) ==' );

$total = 0;

/** Log each changed link in $before -> $after (both HTML). */
$ace_log_diff = function ( $label, $before, $after ) {
	$re = '/<a\b[^>]*?\shref\s*=\s*(["\'])(.*?)\1/is';
	preg_match_all( $re, $before, $a );
	preg_match_all( $re, $after, $b );
	$old = array_map( 'html_entity_decode', $a[2] );
	$new = array_map( 'html_entity_decode', $b[2] );
	WP_CLI::log( '  ' . $label );
	foreach ( array_unique( array_diff( $old, $new ) ) as $x ) {
		WP_CLI::log( '      - ' . $x );
	}
	foreach ( array_unique( array_diff( $new, $old ) ) as $x ) {
		WP_CLI::log( '      + ' . $x );
	}
	$h1 = preg_match_all( '/<h1[\s>]/i', $before ) - preg_match_all( '/<h1[\s>]/i', $after );
	if ( $h1 > 0 ) {
		WP_CLI::log( "      $h1 <h1> -> <h2>" );
	}
};

/* 1. Menu items ---------------------------------------------------------- */
WP_CLI::log( "\n1) Menu item URLs" );
$rows = $wpdb->get_results( "SELECT post_id, meta_value FROM {$wpdb->postmeta} WHERE meta_key = '_menu_item_url' AND meta_value <> ''" );
foreach ( $rows as $row ) {
	$new = techdotbit_normalize_internal_url( $row->meta_value );
	if ( $new === $row->meta_value ) {
		continue;
	}
	$total++;
	WP_CLI::log( sprintf( '  #%d "%s": %s  ->  %s', $row->post_id, get_the_title( $row->post_id ), $row->meta_value, $new ) );
	if ( $apply ) {
		update_post_meta( $row->post_id, '_menu_item_url', esc_url_raw( $new ) );
	}
}

/* 2. Post content -------------------------------------------------------- */
WP_CLI::log( "\n2) Links in post content" );
$ids = $wpdb->get_col(
	"SELECT ID FROM {$wpdb->posts}
	 WHERE post_type NOT IN ('revision','nav_menu_item','attachment')
	   AND post_status IN ('publish','draft','pending','private','future')
	   AND post_content LIKE '%<a%'"
);
foreach ( $ids as $id ) {
	$before = $wpdb->get_var( $wpdb->prepare( "SELECT post_content FROM {$wpdb->posts} WHERE ID = %d", $id ) );
	$after  = techdotbit_demote_content_h1( techdotbit_fix_links_in_html( $before ) );
	if ( $after === $before ) {
		continue;
	}
	$total++;
	$ace_log_diff( sprintf( '#%d %s', $id, get_permalink( $id ) ), $before, $after );
	if ( $apply ) {
		$wpdb->update( $wpdb->posts, array( 'post_content' => $after ), array( 'ID' => $id ) );
		clean_post_cache( $id );
	}
}

/* 3. Plain-text post meta (ACF fields) ----------------------------------- */
WP_CLI::log( "\n3) Links in post meta" );
$rows = $wpdb->get_results(
	"SELECT meta_id, post_id, meta_key, meta_value FROM {$wpdb->postmeta}
	 WHERE meta_key NOT LIKE '\\_%'
	   AND ( meta_value LIKE '%techdotbit.com%' OR meta_value LIKE '%<a%' )"
);
foreach ( $rows as $row ) {
	$value = $row->meta_value;
	if ( is_serialized( $value ) ) {
		continue;
	}
	if ( false !== stripos( $value, '<a' ) ) {
		$new = techdotbit_fix_links_in_html( $value );
	} elseif ( preg_match( '#^\s*\S+\s*$#', $value ) ) {
		$new = techdotbit_normalize_internal_url( $value );
	} else {
		continue;
	}
	if ( $new === $value ) {
		continue;
	}
	$total++;
	WP_CLI::log( sprintf( '  #%d %s [%s]', $row->post_id, get_permalink( $row->post_id ), $row->meta_key ) );
	if ( $apply ) {
		$wpdb->update( $wpdb->postmeta, array( 'meta_value' => $new ), array( 'meta_id' => $row->meta_id ) );
		wp_cache_delete( $row->post_id, 'post_meta' );
	}
}

/* 4. Possible spam links (report only) ---------------------------------- */
WP_CLI::log( "\n4) Links that look like injected spam (review and remove by hand)" );
$spam_words = '(casino|betting|\\bbet[0-9a-z-]*\\.|poker|slots?\\b|gambl|viagra|cialis|payday|loan|escort|porn|xxx|replica|essay)';
$rows       = $wpdb->get_results(
	"SELECT ID, post_content FROM {$wpdb->posts}
	 WHERE post_type NOT IN ('revision','nav_menu_item') AND post_status <> 'trash' AND post_content LIKE '%<a%'"
);
$found = 0;
foreach ( $rows as $row ) {
	if ( preg_match_all( '/<a\\b[^>]*href=["\']([^"\']+)["\'][^>]*>(.*?)<\\/a>/is', $row->post_content, $m, PREG_SET_ORDER ) ) {
		foreach ( $m as $link ) {
			$host = (string) wp_parse_url( $link[1], PHP_URL_HOST );
			if ( $host && preg_match( '#' . $spam_words . '#i', $host . ' ' . wp_strip_all_tags( $link[2] ) ) && ! preg_match( '#techdotbit\\.com$#', $host ) ) {
				$found++;
				WP_CLI::log( sprintf( '  #%d %s: %s ("%s")', $row->ID, get_permalink( $row->ID ), $link[1], wp_strip_all_tags( $link[2] ) ) );
			}
		}
	}
}
if ( ! $found ) {
	WP_CLI::log( '  none found' );
}

WP_CLI::log( '' );
if ( ! $total ) {
	WP_CLI::success( 'No links needed fixing.' );
} elseif ( $apply ) {
	if ( function_exists( 'do_action' ) ) {
		do_action( 'litespeed_purge_all' );
	}
	WP_CLI::success( "$total items updated. LiteSpeed cache purged; re-run the Ahrefs crawl." );
} else {
	WP_CLI::success( "$total items would change. Run again with \"apply\" to save." );
}
