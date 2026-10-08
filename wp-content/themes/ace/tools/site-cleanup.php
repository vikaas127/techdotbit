<?php
/**
 * Site clean-up for techdotbit.com. Does NOT delete any post or page.
 *
 * Preview (changes nothing):
 *   wp eval-file wp-content/themes/ace/tools/site-cleanup.php
 * Apply:
 *   wp eval-file wp-content/themes/ace/tools/site-cleanup.php apply
 *
 * What it does:
 *  1. Gives pages that still use their URL slug as the title a proper title.
 *  2. Removes plugins that are unused or risky (File Manager Advanced,
 *     Skyboot icons for Elementor - Elementor is not installed) and
 *     deactivates one-off tools (WordPress Importer, All-in-One WP Migration).
 *  3. Deletes phpinfo.php from the site root (exposes server configuration).
 *  4. Reports (only) things that need a human decision: duplicate analytics,
 *     theme demo images still referenced in content, city landing pages,
 *     duplicate service pages and year-stamped post titles.
 */

if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
	exit; // CLI only.
}

$apply = isset( $args ) && in_array( 'apply', (array) $args, true );
WP_CLI::log( $apply ? '== APPLYING CHANGES ==' : '== PREVIEW (nothing is changed; add "apply" to run) ==' );

require_once ABSPATH . 'wp-admin/includes/plugin.php';
require_once ABSPATH . 'wp-admin/includes/file.php';

/* 1. Page titles ------------------------------------------------------- */
WP_CLI::log( "\n1) Page titles that are still the URL slug" );
$titles = array(
	'dedicated-software-development-team'      => 'Dedicated Software Development Team',
	'ux-ui-design'                             => 'UI/UX Design Services',
	'nodejs-development'                       => 'Node.js Development Services',
	'partners'                                 => 'Partners',
	'top-10-mobile-app-development-companies'  => 'Top 10 Mobile App Development Companies',
	'blockchain-development-companies-in-usa'  => 'Blockchain Development Companies in USA',
	'top-website-development-company-delhi'    => 'Top Website Development Company in Delhi',
	'it-consulting-services'                   => 'IT Consulting Services',
	'hire-developers'                          => 'Hire Developers',
	'devops-services'                          => 'DevOps Services',
	'media-entertainment-app-development'      => 'Media & Entertainment App Development',
	'real-estate-app-development'              => 'Real Estate App Development',
	'elearning-assessment-app-development'     => 'eLearning & Assessment App Development',
	'travel-hospitality-app-development'       => 'Travel & Hospitality App Development',
	'cloud-migration-services'                 => 'Cloud Migration Services',
	'mobile-game-development-services'         => 'Mobile Game Development Services',
	'logistics-transportation-app-development' => 'Logistics & Transportation App Development',
	'blockchain-development-services'          => 'Blockchain Development Services',
	'ai-ml-development-services'               => 'AI & ML Development Services',
	'technologies'                             => 'Technologies',
);
foreach ( $titles as $slug => $title ) {
	$pages = get_posts( array( 'post_type' => 'page', 'name' => $slug, 'post_status' => 'any', 'posts_per_page' => 1 ) );
	if ( ! $pages ) {
		continue;
	}
	$p = $pages[0];
	// Only touch titles that are clearly unset (equal to the slug).
	if ( strtolower( trim( $p->post_title ) ) !== $slug ) {
		continue;
	}
	WP_CLI::log( sprintf( '   %-45s -> %s', $p->post_title, $title ) );
	if ( $apply ) {
		wp_update_post( array( 'ID' => $p->ID, 'post_title' => $title ) );
	}
}

/* 2. Plugins ----------------------------------------------------------- */
WP_CLI::log( "\n2) Plugins" );
$remove = array(
	'file-manager-advanced/file_manager_advanced.php' => 'security risk: browser file manager',
	'skyboot-custom-icons-for-elementor/skyboot-custom-icons-for-elementor.php' => 'needs Elementor, which is not installed',
);
$all = get_plugins();
foreach ( $remove as $file => $why ) {
	// Match by folder in case the main file name differs.
	$folder = dirname( $file );
	$found  = null;
	foreach ( $all as $f => $data ) {
		if ( 0 === strpos( $f, $folder . '/' ) ) {
			$found = $f;
			break;
		}
	}
	if ( ! $found ) {
		continue;
	}
	WP_CLI::log( "   remove     $folder ($why)" );
	if ( $apply ) {
		deactivate_plugins( $found, true );
		$r = delete_plugins( array( $found ) );
		if ( is_wp_error( $r ) ) {
			WP_CLI::warning( $r->get_error_message() );
		}
	}
}
foreach ( array( 'wordpress-importer', 'all-in-one-wp-migration' ) as $folder ) {
	foreach ( $all as $f => $data ) {
		if ( 0 === strpos( $f, $folder . '/' ) && is_plugin_active( $f ) ) {
			WP_CLI::log( "   deactivate $folder (one-off tool; reactivate when needed)" );
			if ( $apply ) {
				deactivate_plugins( $f );
			}
		}
	}
}

/* 3. Risky files ------------------------------------------------------- */
WP_CLI::log( "\n3) Files" );
foreach ( array( 'phpinfo.php' ) as $file ) {
	$path = ABSPATH . $file;
	if ( file_exists( $path ) ) {
		WP_CLI::log( "   delete     $file (shows server configuration to anyone)" );
		if ( $apply ) {
			unlink( $path );
		}
	}
}

/* 4. Report only ------------------------------------------------------- */
WP_CLI::log( "\n4) For your decision (nothing changed)" );
global $wpdb;

if ( is_plugin_active( 'google-analytics-for-wordpress/googleanalytics.php' ) ) {
	WP_CLI::log( '   - MonsterInsights is active AND the theme loads Google Tag Manager (GTM-54W7LPM5).' );
	WP_CLI::log( '     If GA4 is also set up inside GTM, visits are counted twice: keep only one.' );
}

$demo_refs = (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->postmeta} WHERE meta_value LIKE '%assets/images/demo/%'" )
	+ (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->options} WHERE option_value LIKE '%assets/images/demo/%'" )
	+ (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_content LIKE '%assets/images/demo/%' AND post_status = 'publish'" );
WP_CLI::log( "   - Theme demo images referenced in content/settings: $demo_refs" );
WP_CLI::log( $demo_refs ? '     Some content still uses the theme demo images (incl. Amazon/Spotify/Cisco logos). Check before removing them.' : '     None are used: the demo image folder can be removed safely (tell Claude to do it in the repo).' );

$city = $wpdb->get_col( "SELECT post_name FROM {$wpdb->posts} WHERE post_type = 'page' AND post_status = 'publish' AND post_name LIKE 'mobile-app-development-company-in-%'" );
WP_CLI::log( sprintf( '   - City landing pages ("mobile-app-development-company-in-..."): %d published.', count( $city ) ) );
WP_CLI::log( '     Kept as requested. Make sure each has unique, useful content; near-identical copies can be treated as doorway pages by Google.' );

$dups = array( array( 'dedicated-software-development-team', 'dedicated-development-team' ), array( 'ai-ml-development-services', 'ai-services' ) );
foreach ( $dups as $pair ) {
	$a = get_posts( array( 'post_type' => 'page', 'name' => $pair[0], 'posts_per_page' => 1 ) );
	$b = get_posts( array( 'post_type' => 'page', 'name' => $pair[1], 'posts_per_page' => 1 ) );
	if ( $a && $b ) {
		WP_CLI::log( sprintf( '   - Overlapping pages: %s  <->  %s (consider a 301 redirect from one to the other)', get_permalink( $a[0] ), get_permalink( $b[0] ) ) );
	}
}

$dated = $wpdb->get_results( "SELECT ID, post_title FROM {$wpdb->posts} WHERE post_type = 'post' AND post_status = 'publish' AND post_title REGEXP '20(1[0-9]|2[0-4])'" );
if ( $dated ) {
	WP_CLI::log( sprintf( '   - %d posts have an old year in the title (refresh the content and year when you can):', count( $dated ) ) );
	foreach ( $dated as $d ) {
		WP_CLI::log( '       ' . $d->post_title );
	}
}

WP_CLI::success( $apply ? 'Clean-up applied. Purge the cache: wp litespeed-purge all' : 'Preview finished. Run again with "apply" to make the changes in sections 1-3.' );
