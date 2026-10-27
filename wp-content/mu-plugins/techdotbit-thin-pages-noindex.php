<?php
/**
 * Plugin Name: TechDotBit Thin Pages Noindex
 * Description: Keeps low-value archives (post tags, job taxonomies, portfolio tags) and the near-duplicate city service pages on the site but out of Google: noindex, follow and removed from the AIOSEO sitemap, so crawling goes to the ERP, service and blog pages. Nothing is deleted.
 * Version:     1.0.0
 * Author:      TechDotBit
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Taxonomies whose archive pages are noindexed and left out of the sitemap.
 */
function techdotbit_thin_taxonomies() {
    return apply_filters( 'techdotbit_thin_taxonomies', array(
        'post_tag',
        'tagportfolio',
        'jobpost_category',
        'jobpost_job_type',
        'jobpost_location',
        'jobpost_tag',
    ) );
}

/**
 * Page slug prefixes of the city landing pages under /services/
 * (e.g. mobile-app-development-company-in-toronto).
 */
function techdotbit_city_page_prefixes() {
    return apply_filters( 'techdotbit_city_page_prefixes', array(
        'mobile-app-development-company-in-',
        'web-development-company-in-',
    ) );
}

function techdotbit_city_page_ids() {
    static $ids = null;
    if ( null !== $ids ) {
        return $ids;
    }
    global $wpdb;
    $ids = array();
    foreach ( techdotbit_city_page_prefixes() as $prefix ) {
        $ids = array_merge( $ids, array_map( 'intval', $wpdb->get_col( $wpdb->prepare(
            "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'page' AND post_name LIKE %s",
            $wpdb->esc_like( $prefix ) . '%'
        ) ) ) );
    }
    return $ids;
}

/**
 * noindex, follow: Google drops the page but still follows its links.
 */
add_filter( 'aioseo_robots_meta', function ( $attributes ) {
    $thin = is_tag() || is_tax( techdotbit_thin_taxonomies() )
        || ( is_page() && in_array( get_queried_object_id(), techdotbit_city_page_ids(), true ) );
    if ( ! $thin ) {
        return $attributes;
    }

    $attributes['noindex'] = 'noindex';
    unset( $attributes['nofollow'] );

    return $attributes;
} );

/**
 * Sitemap: drop the taxonomy sitemaps from the index, empty them if requested
 * directly, and leave out the city pages.
 */
add_filter( 'aioseo_sitemap_indexes', function ( $indexes ) {
    $pattern = '#/(' . implode( '|', array_map( 'preg_quote', techdotbit_thin_taxonomies() ) ) . ')-[a-z0-9_-]*?\d*\.xml$#';
    return array_values( array_filter( $indexes, function ( $index ) use ( $pattern ) {
        return empty( $index['loc'] ) || ! preg_match( $pattern, $index['loc'] );
    } ) );
} );

add_filter( 'aioseo_sitemap_term', function ( $entry, $term_id, $taxonomy ) {
    if ( in_array( $taxonomy, techdotbit_thin_taxonomies(), true ) ) {
        $entry['techdotbit_drop'] = true;
    }
    return $entry;
}, 10, 3 );

add_filter( 'aioseo_sitemap_terms', function ( $entries ) {
    return array_values( array_filter( (array) $entries, function ( $entry ) {
        return empty( $entry['techdotbit_drop'] );
    } ) );
} );

add_filter( 'aioseo_sitemap_exclude_posts', function ( $ids, $type ) {
    return array_values( array_unique( array_merge( (array) $ids, techdotbit_city_page_ids() ) ) );
}, 10, 2 );
