<?php
/**
 * Tag archive.
 */
get_header();
$ace_blog = array(
	'eyebrow' => __( 'Topic', 'ace' ),
	'title'   => single_tag_title( '', false ),
	'intro'   => wp_strip_all_tags( tag_description() ),
);
include locate_template( 'inc/blog/listing.php' );
include locate_template( 'inc/bottom-cta.php' );
get_footer();
