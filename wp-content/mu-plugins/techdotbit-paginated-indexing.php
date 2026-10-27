<?php
/**
 * Plugin Name: TechDotBit Paginated Archive Indexing
 * Description: Keeps page 2+ of the blog and category archives indexable with a self-referencing canonical, overriding AIOSEO's paginated noindex/nofollow and its "no pagination for canonical" setting.
 * Version:     1.0.0
 * Author:      TechDotBit
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Only the blog posts index (/blog/page/N/) and category archives
 * (/category/x/page/N/). Tag, author, date and search archives keep their
 * existing noindex.
 */
function techdotbit_is_indexable_paginated_archive() {
    return is_paged() && ( is_home() || is_category() ) && ! is_search();
}

/**
 * Remove the noindex/nofollow AIOSEO adds to paginated pages.
 */
add_filter( 'aioseo_robots_meta', function ( $attributes ) {
    if ( ! techdotbit_is_indexable_paginated_archive() || ! get_option( 'blog_public' ) ) {
        return $attributes;
    }

    unset( $attributes['noindex'], $attributes['nofollow'] );

    return $attributes;
} );

/**
 * Point the canonical at the paginated URL itself instead of page 1, so
 * Google does not treat /blog/page/N/ as a duplicate of /blog/.
 */
add_filter( 'aioseo_canonical_url', function ( $url ) {
    if ( ! techdotbit_is_indexable_paginated_archive() ) {
        return $url;
    }

    return get_pagenum_link( max( 1, (int) get_query_var( 'paged' ) ), false );
} );
