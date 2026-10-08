<?php
/**
 * Category archive.
 */
get_header();
$ace_blog = array(
	'eyebrow' => __( 'Category', 'ace' ),
	'title'   => single_cat_title( '', false ),
	'intro'   => wp_strip_all_tags( category_description() ),
);
include locate_template( 'inc/blog/listing.php' );
include locate_template( 'inc/bottom-cta.php' );
get_footer();
