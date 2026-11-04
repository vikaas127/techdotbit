<?php
/**
 * Plugin Name: TechDotBit Link & Social Tag Hygiene
 * Description: Fixes site-audit issues that come from menu items and post content stored in the database: rewrites internal links to their final HTTPS URL (no http://, no www, trailing slash, known moved URLs), turns bare email hrefs into mailto: links, 301s the old /blogs URL, adds a site-wide link to the HTML sitemap, fills in missing Open Graph / Twitter image and description, and trims over-long meta descriptions.
 * Version:     1.0.0
 * Author:      TechDotBit
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Old or mistyped internal paths that currently 301 or 404, mapped to the
 * page they should point at. Keys and values are paths with a trailing slash.
 */
function techdotbit_link_path_map() {
    return array(
        '/blogs/'                                   => '/blog/',
        '/contact/'                                 => '/contact-us/',
        '/services/software-development-service/'   => '/services/software-development-services/',
    );
}

/**
 * Return the final URL for an internal link, or the input unchanged when it
 * is external or not a page link.
 */
function techdotbit_normalize_internal_url( $url ) {
    $raw = trim( html_entity_decode( $url, ENT_QUOTES ) );

    // href="someone@techdotbit.in" resolves as a relative page URL and 404s.
    if ( preg_match( '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/', $raw ) ) {
        return 'mailto:' . $raw;
    }

    if ( ! preg_match( '#^(?:https?:)?//(?:www\.)?techdotbit\.com(?=[/?\#]|$)(.*)$#i', $raw, $m ) ) {
        return $url;
    }

    $rest     = $m[1];
    $fragment = '';
    $query    = '';
    if ( false !== ( $pos = strpos( $rest, '#' ) ) ) {
        $fragment = substr( $rest, $pos );
        $rest     = substr( $rest, 0, $pos );
    }
    if ( false !== ( $pos = strpos( $rest, '?' ) ) ) {
        $query = substr( $rest, $pos );
        $rest  = substr( $rest, 0, $pos );
    }

    $path = '' === $rest ? '/' : $rest;

    // Leave files (uploads, feeds, sitemaps, wp-admin, etc.) alone apart from the scheme.
    $is_page = ! preg_match( '#\.[a-z0-9]{2,5}$#i', $path ) && 0 !== strpos( $path, '/wp-' );
    if ( $is_page ) {
        if ( '/' !== substr( $path, -1 ) ) {
            $path .= '/';
        }
        $map = techdotbit_link_path_map();
        if ( isset( $map[ strtolower( $path ) ] ) ) {
            $path = $map[ strtolower( $path ) ];
        }
    }

    return 'https://techdotbit.com' . $path . $query . $fragment;
}

/**
 * Rewrite every <a href> in front-end HTML. Doing it on the final output
 * covers menus, Elementor/ACF fields and post content in one place, without
 * editing the database.
 */
function techdotbit_fix_links_in_html( $html ) {
    if ( ! is_string( $html ) || false === stripos( $html, '<a' ) ) {
        return $html;
    }

    return preg_replace_callback(
        '/(<a\b[^>]*?\shref\s*=\s*)(["\'])(.*?)\2/is',
        function ( $m ) {
            $fixed = techdotbit_normalize_internal_url( $m[3] );
            if ( $fixed === $m[3] ) {
                return $m[0];
            }
            return $m[1] . $m[2] . esc_attr( $fixed ) . $m[2];
        },
        $html
    );
}

add_action( 'template_redirect', function () {
    if ( is_admin() || is_feed() || wp_doing_ajax() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
        return;
    }
    ob_start( 'techdotbit_fix_links_in_html' );
}, 0 );

/**
 * /blogs (linked from older posts and possibly elsewhere) 404s; send it to
 * the blog. Runs before WordPress decides on the 404.
 */
add_action( 'template_redirect', function () {
    $path = strtolower( trim( (string) wp_parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' ) );
    if ( 'blogs' === $path ) {
        wp_safe_redirect( home_url( '/blog/' ), 301 );
        exit;
    }
}, -1 );

/**
 * The /sitemap/ HTML sitemap lists every page, but nothing linked to it, so
 * pages with no other inbound link were orphaned. Link it from the footer.
 */
add_action( 'wp_footer', function () {
    if ( is_admin() ) {
        return;
    }
    $page = get_page_by_path( 'sitemap' );
    if ( ! $page || 'publish' !== $page->post_status ) {
        return;
    }
    printf(
        '<nav class="tdb-sitemap-link" aria-label="%1$s" style="text-align:center;padding:0 0 18px;font-size:13px;"><a href="%2$s" style="color:inherit;opacity:.75;">%3$s</a></nav>',
        esc_attr__( 'Sitemap', 'ace' ),
        esc_url( get_permalink( $page ) ),
        esc_html__( 'Sitemap', 'ace' )
    );
}, 5 );

/**
 * Trim text to at most $max characters on a word boundary.
 */
function techdotbit_trim_text( $text, $max ) {
    $text = html_entity_decode( wp_strip_all_tags( (string) $text ), ENT_QUOTES | ENT_HTML5, 'UTF-8' );
    $text = trim( preg_replace( '/\s+/u', ' ', $text ) );
    if ( mb_strlen( $text ) <= $max ) {
        return $text;
    }
    $cut  = mb_substr( $text, 0, $max - 1 );
    $last = mb_strrpos( $cut, ' ' );
    if ( false !== $last && $last > $max * 0.6 ) {
        $cut = mb_substr( $cut, 0, $last );
    }
    return rtrim( $cut, " ,;:-–—" ) . '…';
}

/**
 * Description to use when a page has none: its excerpt or opening text.
 */
function techdotbit_fallback_description() {
    if ( ! is_singular() ) {
        return '';
    }
    $post = get_queried_object();
    if ( ! $post instanceof WP_Post ) {
        return '';
    }
    $text = has_excerpt( $post ) ? $post->post_excerpt : strip_shortcodes( $post->post_content );
    $text = trim( preg_replace( '/\s+/u', ' ', wp_strip_all_tags( $text ) ) );
    return '' === $text ? '' : techdotbit_trim_text( $text, 155 );
}

/**
 * Image to use for social cards: the featured image, else the site icon.
 */
function techdotbit_social_image() {
    if ( is_singular() && has_post_thumbnail( get_queried_object_id() ) ) {
        $src = wp_get_attachment_image_src( get_post_thumbnail_id( get_queried_object_id() ), 'large' );
        if ( $src ) {
            return array( 'url' => $src[0], 'width' => $src[1], 'height' => $src[2] );
        }
    }
    $icon = get_site_icon_url( 512 );
    return $icon ? array( 'url' => $icon, 'width' => 512, 'height' => 512 ) : null;
}

// Meta descriptions over 160 characters get cut off in search results.
add_filter( 'aioseo_description', function ( $description ) {
    return mb_strlen( html_entity_decode( (string) $description, ENT_QUOTES | ENT_HTML5, 'UTF-8' ) ) > 160 ? techdotbit_trim_text( $description, 158 ) : $description;
} );

add_filter( 'aioseo_facebook_tags', function ( $meta ) {
    if ( empty( $meta['og:description'] ) ) {
        $meta['og:description'] = techdotbit_fallback_description();
    } elseif ( mb_strlen( html_entity_decode( $meta['og:description'], ENT_QUOTES | ENT_HTML5, 'UTF-8' ) ) > 200 ) {
        $meta['og:description'] = techdotbit_trim_text( $meta['og:description'], 200 );
    }
    if ( empty( $meta['og:image'] ) && ( $image = techdotbit_social_image() ) ) {
        $meta['og:image']            = $image['url'];
        $meta['og:image:secure_url'] = $image['url'];
        $meta['og:image:width']      = $image['width'];
        $meta['og:image:height']     = $image['height'];
    }
    return $meta;
} );

add_filter( 'aioseo_twitter_tags', function ( $meta ) {
    if ( empty( $meta['twitter:description'] ) ) {
        $meta['twitter:description'] = techdotbit_fallback_description();
    }
    if ( empty( $meta['twitter:image'] ) && ( $image = techdotbit_social_image() ) ) {
        $meta['twitter:image'] = $image['url'];
    }
    return $meta;
} );
