<?php
/**
 * Plugin Name: TechDotBit Off-topic Post Noindex
 * Description: Keeps off-topic posts (gaming, crypto investing, third-party products) and utility pages on the site but out of Google: noindex, follow, excluded from the AIOSEO sitemap, and off-topic posts hidden from blog listings and search. Content is not changed or deleted.
 * Version:     1.1.0
 * Author:      TechDotBit
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Post slugs to keep out of search and blog listings. Add more via the
 * 'techdotbit_offtopic_post_slugs' filter; remove a slug to bring it back.
 */
function techdotbit_offtopic_post_slugs() {
    return apply_filters( 'techdotbit_offtopic_post_slugs', array(
        // Consumer / gaming traffic bait.
        'what-is-1v1-lol-unblocked',
        'how-youtube-is-influencing-youth-a-concise-overview',
        // Third-party finance sites and crypto products (sponsored).
        'what-is-fintechzoom',
        'what-is-fintechzoom-com',
        'what-is-alaya-ai',
        'crypto-legacy-app-software',
        'crypto-legacy-apps-safeguarding-digital-wealth-for-future-generation',
        'crypto-legacy-app-the-game-changer-for-modern-cryptocurrency-traders',
        // Crypto investing and company profiles.
        'the-best-ai-powered-cryptocurrencies-transforming-the-future-of-tech-and-finance',
        'riot-blockchain-stocks-a-closer-look-at-investing-in-crypto-mining',
        'coinbase-your-comprehensive-guide-to-the-cryptocurrency-exchange-giant',
        'exploring-bigg-digital-assets-a-deep-dive-into-security-and-innovation-in-crypto',
        'bitfury-pioneering-the-blockchain-revolution-one-innovation-at-a-time',
        'axelar-network-bridging-blockchains-for-a-more-connected-future',
        'exploring-the-xdc-network-a-new-frontier-in-blockchain-technology',
        'how-fedex-is-exploring-crypto-and-blockchain-the-future-of-shipping',
    ) );
}

/**
 * Utility pages with no search value (forms, thank-you, past events).
 */
function techdotbit_noindex_page_slugs() {
    return apply_filters( 'techdotbit_noindex_page_slugs', array(
        'thank-you',
        'candidate-registration-form',
        'newsletter',
        'events-webinar-event78',
    ) );
}

function techdotbit_offtopic_post_ids() {
    static $ids = null;
    if ( null === $ids ) {
        $ids = techdotbit_ids_for_slugs( techdotbit_offtopic_post_slugs(), 'post' );
    }
    return $ids;
}

function techdotbit_noindex_page_ids() {
    static $ids = null;
    if ( null === $ids ) {
        $ids = techdotbit_ids_for_slugs( techdotbit_noindex_page_slugs(), 'page' );
    }
    return $ids;
}

function techdotbit_ids_for_slugs( $slugs, $post_type ) {
    global $wpdb;
    if ( ! $slugs ) {
        return array();
    }
    $in = implode( ', ', array_fill( 0, count( $slugs ), '%s' ) );
    return array_map( 'intval', $wpdb->get_col( $wpdb->prepare(
        "SELECT ID FROM {$wpdb->posts} WHERE post_type = %s AND post_name IN ($in)",
        array_merge( array( $post_type ), $slugs )
    ) ) );
}

/**
 * noindex, follow: Google drops the page but still follows its links.
 */
add_filter( 'aioseo_robots_meta', function ( $attributes ) {
    $id = get_queried_object_id();
    $hit = ( is_singular( 'post' ) && in_array( $id, techdotbit_offtopic_post_ids(), true ) )
        || ( is_page() && in_array( $id, techdotbit_noindex_page_ids(), true ) );
    if ( ! $hit ) {
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
    return array_values( array_unique( array_merge( (array) $ids, techdotbit_offtopic_post_ids(), techdotbit_noindex_page_ids() ) ) );
}, 10, 2 );

/**
 * Hide off-topic posts from the blog, category and tag lists, site search and
 * feeds, so visitors and crawlers are not sent to them. The URLs still work.
 */
add_action( 'pre_get_posts', function ( $query ) {
    if ( is_admin() || ! $query->is_main_query() || $query->is_singular() ) {
        return;
    }
    if ( $query->is_home() || $query->is_archive() || $query->is_search() || $query->is_feed() ) {
        $query->set( 'post__not_in', array_merge( (array) $query->get( 'post__not_in' ), techdotbit_offtopic_post_ids() ) );
    }
} );
