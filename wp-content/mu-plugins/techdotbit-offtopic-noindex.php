<?php
/**
 * Plugin Name: TechDotBit Off-topic Post Noindex
 * Description: Keeps off-topic posts (gaming, third-party finance sites) on the site but out of Google: noindex, follow and excluded from the AIOSEO sitemap. Content is not changed.
 * Version:     1.0.0
 * Author:      TechDotBit
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Post slugs to keep out of search. Add more via the
 * 'techdotbit_offtopic_post_slugs' filter; remove a slug to re-index it.
 */
function techdotbit_offtopic_post_slugs() {
    return apply_filters( 'techdotbit_offtopic_post_slugs', array(
        'what-is-1v1-lol-unblocked',
        'what-is-fintechzoom',
        'what-is-fintechzoom-com',
    ) );
}

function techdotbit_offtopic_post_ids() {
    $ids = array();
    foreach ( techdotbit_offtopic_post_slugs() as $slug ) {
        $post = get_page_by_path( $slug, OBJECT, 'post' );
        if ( $post ) {
            $ids[] = (int) $post->ID;
        }
    }
    return $ids;
}

/**
 * noindex, follow: Google drops the page but still follows its links.
 */
add_filter( 'aioseo_robots_meta', function ( $attributes ) {
    if ( ! is_singular( 'post' ) || ! in_array( get_queried_object_id(), techdotbit_offtopic_post_ids(), true ) ) {
        return $attributes;
    }

    $attributes['noindex'] = 'noindex';
    unset( $attributes['nofollow'] );

    return $attributes;
} );

/**
 * A noindexed URL must not be listed in the sitemap.
 */
add_filter( 'aioseo_sitemap_exclude_posts', function ( $ids, $type ) {
    return array_values( array_unique( array_merge( (array) $ids, techdotbit_offtopic_post_ids() ) ) );
}, 10, 2 );
