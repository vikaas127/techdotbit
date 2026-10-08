<?php
/**
 * Blog home and fallback listing.
 */
get_header();
$ace_blog = array(
	'eyebrow' => __( 'TechDotBit blog', 'ace' ),
	'title'   => get_option( 'page_for_posts' ) ? get_the_title( get_option( 'page_for_posts' ) ) : __( 'Blog', 'ace' ),
	'intro'   => __( 'Practical insights on AI agents, ERP, automation and software engineering from the TechDotBit team.', 'ace' ),
);
include locate_template( 'inc/blog/listing.php' );
include locate_template( 'inc/bottom-cta.php' );
get_footer();
