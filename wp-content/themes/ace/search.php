<?php
/**
 * Search results.
 */
get_header();
$ace_blog = array(
	'eyebrow' => __( 'Search', 'ace' ),
	/* translators: %s: search terms */
	'title'   => sprintf( __( 'Results for "%s"', 'ace' ), get_search_query() ),
	'intro'   => sprintf( _n( '%d article found.', '%d articles found.', (int) $GLOBALS['wp_query']->found_posts, 'ace' ), (int) $GLOBALS['wp_query']->found_posts ),
);
include locate_template( 'inc/blog/listing.php' );
include locate_template( 'inc/bottom-cta.php' );
get_footer();
