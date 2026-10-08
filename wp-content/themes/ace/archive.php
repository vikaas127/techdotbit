<?php
/**
 * Date, author and other archives.
 */
get_header();
$ace_blog = array(
	'eyebrow' => __( 'Archive', 'ace' ),
	'title'   => wp_strip_all_tags( get_the_archive_title() ),
	'intro'   => wp_strip_all_tags( get_the_archive_description() ),
);
include locate_template( 'inc/blog/listing.php' );
include locate_template( 'inc/bottom-cta.php' );
get_footer();
