<?php
/**
 * Plugin Name: TechDotBit Link & Social Tag Hygiene
 * Description: Fixes site-audit issues from menu items and post content stored in the database: internal links to their final HTTPS URL, mailto: for bare email hrefs, dead and spam outbound links, http:// own-domain assets, one H1 per page, /blogs and /jobs/ redirects, a footer link to the HTML sitemap, fallback meta descriptions and Open Graph tags, shorter titles, and the off-topic category out of the index.
 * Version:     1.1.0
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
    if ( ! is_string( $html ) || '' === $html ) {
        return $html;
    }

    if ( false !== stripos( $html, '<a' ) ) {
        // Spam and dead external links: drop spam entirely, unwrap dead links (keep the text).
        $html = preg_replace_callback(
            '/<a\b[^>]*?\shref\s*=\s*(["\'])(.*?)\1[^>]*>(.*?)<\/a>/is',
            function ( $m ) {
                $url = html_entity_decode( trim( $m[2] ), ENT_QUOTES );
                foreach ( techdotbit_spam_link_patterns() as $pattern ) {
                    if ( preg_match( $pattern, $url ) ) {
                        return '';
                    }
                }
                foreach ( techdotbit_dead_link_patterns() as $pattern ) {
                    if ( preg_match( $pattern, $url ) ) {
                        return $m[3];
                    }
                }
                return $m[0];
            },
            $html
        );

        // Internal links to their final URL; known moved external links.
        $html = preg_replace_callback(
            '/(<a\b[^>]*?\shref\s*=\s*)(["\'])(.*?)\2/is',
            function ( $m ) {
                $fixed = techdotbit_normalize_internal_url( techdotbit_replace_external_url( $m[3] ) );
                if ( $fixed === $m[3] ) {
                    return $m[0];
                }
                return $m[1] . $m[2] . esc_attr( $fixed ) . $m[2];
            },
            $html
        );
    }

    // Own-domain images, scripts and styles over http:// are mixed content.
    $html = preg_replace( '#(?<=["\'(\s,=])http://(?:www\.)?techdotbit\.com(?=[/"\'\s)?\#]|$)#i', 'https://techdotbit.com', $html );
    $html = preg_replace( '#http:\\\\/\\\\/(?:www\.)?techdotbit\.com(?=\\\\/|")#i', 'https:\/\/techdotbit.com', $html );

    return $html;
}

/**
 * Outbound links to sites that are gone (404 or no longer resolving). The
 * link is removed and its text kept.
 */
function techdotbit_dead_link_patterns() {
    return apply_filters( 'techdotbit_dead_link_patterns', array(
        '#^https?://apps\.apple\.com/us/app/(crackle-movies-tv|hbo-now-stream-tv-movies|getease|klasterme)/#i',
        '#^https?://play\.google\.com/store/apps/details\?id=(com\.gotv\.crackle\.handset|com\.hbo\.hbonow|com\.yeagger\.ease)\b#i',
        '#^https?://(www\.)?crackle\.com(/|$)#i',
        '#^https?://avinetworks\.com/glossary/kubernetes-container/?#i',
        '#^https?://www\.jpmorgan\.com/technology/technology-blog/synthetic-data-for-real-insights#i',
        '#^https?://www\.fbi\.gov/stats-services/publications/insurance-fraud#i',
    ) );
}

/**
 * Injected spam links (removed together with their anchor text).
 */
function techdotbit_spam_link_patterns() {
    return apply_filters( 'techdotbit_spam_link_patterns', array(
        '#^https?://([a-z0-9-]+\.)*goldenbet-casino\.co\.uk#i',
    ) );
}

/**
 * External URLs that moved or were mistyped, mapped to a working address.
 */
function techdotbit_replace_external_url( $url ) {
    $raw = html_entity_decode( trim( $url ), ENT_QUOTES );
    // http:////ec.europa.eu/... (extra slashes).
    if ( preg_match( '#^https?:/{3,}(.+)$#i', $raw, $m ) ) {
        return 'https://' . $m[1];
    }
    // DotOne's old domains no longer resolve.
    if ( preg_match( '#^https?://(www\.)?dotoneforbusiness\.(com|in)(/.*)?$#i', $raw ) ) {
        return function_exists( 'ace_dotone_url' ) ? ace_dotone_url() : 'https://dotone.in/';
    }
    return $url;
}

/**
 * The theme prints the post/page title as the H1, so H1s inside the content
 * become H2s (one H1 per page).
 */
function techdotbit_demote_content_h1( $content ) {
    if ( ! is_string( $content ) || false === stripos( $content, '<h1' ) ) {
        return $content;
    }
    $content = preg_replace( '/<h1(\s[^>]*)?>/i', '<h2$1>', $content );
    return preg_replace( '/<\/h1\s*>/i', '</h2>', $content );
}

add_filter( 'the_content', function ( $content ) {
    return is_singular() && in_the_loop() ? techdotbit_demote_content_h1( $content ) : $content;
}, 20 );

add_action( 'template_redirect', function () {
    if ( is_admin() || is_feed() || wp_doing_ajax() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
        return;
    }
    ob_start( 'techdotbit_fix_links_in_html' );
}, 0 );

/**
 * /jobs/ (the job board archive) duplicates the /career/ page, has no H1 and
 * nothing links to it. Send it to the careers page and keep it out of the
 * sitemap. Single job pages are unchanged.
 */
function techdotbit_careers_url() {
    $page = get_page_by_path( 'career' );
    return $page && 'publish' === $page->post_status ? get_permalink( $page ) : '';
}

add_action( 'template_redirect', function () {
    if ( is_post_type_archive( 'jobpost' ) && ( $url = techdotbit_careers_url() ) ) {
        wp_safe_redirect( $url, 301 );
        exit;
    }
}, 1 );

add_filter( 'aioseo_sitemap_post_archives', function ( $entries ) {
    $jobs = home_url( '/jobs/' );
    return array_values( array_filter( (array) $entries, function ( $entry ) use ( $jobs ) {
        return empty( $entry['loc'] ) || trailingslashit( $entry['loc'] ) !== $jobs;
    } ) );
} );

add_filter( 'aioseo_sitemap_posts', function ( $entries ) {
    $jobs = home_url( '/jobs/' );
    return array_values( array_filter( (array) $entries, function ( $entry ) use ( $jobs ) {
        return empty( $entry['loc'] ) || trailingslashit( $entry['loc'] ) !== $jobs;
    } ) );
} );

/**
 * Off-topic categories (their posts are already hidden): noindex, follow and
 * out of the sitemap.
 */
function techdotbit_offtopic_category_slugs() {
    return apply_filters( 'techdotbit_offtopic_category_slugs', array( '1v1-lol-unblocked' ) );
}

add_filter( 'aioseo_robots_meta', function ( $attributes ) {
    if ( is_category( techdotbit_offtopic_category_slugs() ) ) {
        $attributes['noindex'] = 'noindex';
        unset( $attributes['nofollow'] );
    }
    return $attributes;
} );

add_filter( 'aioseo_sitemap_term', function ( $entry, $term_id, $taxonomy ) {
    $term = get_term( $term_id, $taxonomy );
    if ( 'category' === $taxonomy && $term && ! is_wp_error( $term ) && in_array( $term->slug, techdotbit_offtopic_category_slugs(), true ) ) {
        $entry['techdotbit_drop'] = true;
    }
    return $entry;
}, 10, 3 );

add_filter( 'aioseo_sitemap_terms', function ( $entries ) {
    return array_values( array_filter( (array) $entries, function ( $entry ) {
        return empty( $entry['techdotbit_drop'] );
    } ) );
}, 20 );

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
    if ( is_category() || is_tag() || is_tax() ) {
        $term = get_queried_object();
        if ( ! $term instanceof WP_Term ) {
            return '';
        }
        $text = trim( wp_strip_all_tags( term_description( $term ) ) );
        if ( '' === $text ) {
            $text = sprintf(
                /* translators: %s: category name */
                __( 'Articles and guides on %s from TechDotBit: practical insights on software development, ERP and AI for growing businesses.', 'ace' ),
                $term->name
            );
        }
        return techdotbit_trim_text( $text, 155 );
    }
    if ( ! is_singular() ) {
        return '';
    }
    $post = get_queried_object();
    if ( ! $post instanceof WP_Post ) {
        return '';
    }
    $text = has_excerpt( $post ) ? $post->post_excerpt : strip_shortcodes( $post->post_content );
    $text = trim( preg_replace( '/\s+/u', ' ', wp_strip_all_tags( $text ) ) );
    if ( mb_strlen( $text ) < 70 ) {
        // Template-built pages (hire, industry, service) keep their copy in ACF fields.
        $text = sprintf(
            /* translators: %s: page title */
            __( '%s by TechDotBit: custom software, mobile app, ERP and AI development for businesses in India and worldwide. Talk to our team today.', 'ace' ),
            wp_strip_all_tags( get_the_title( $post ) )
        );
    }
    return techdotbit_trim_text( $text, 155 );
}

/**
 * Pages without a meta description (AIOSEO prints none when it is empty) get
 * one from the excerpt, opening text or a short summary.
 */
add_action( 'wp_head', function () {
    if ( ! function_exists( 'aioseo' ) || is_404() || is_search() ) {
        return;
    }
    $current = aioseo()->meta->description->getDescription();
    if ( '' !== trim( (string) $current ) ) {
        return;
    }
    $description = techdotbit_fallback_description();
    if ( $description ) {
        printf( "<meta name=\"description\" content=\"%s\" />\n", esc_attr( $description ) );
    }
}, 2 );

/**
 * Titles: drop the " - TechDotBit" suffix when the title is already longer
 * than 60 characters, and give category archives a fuller, unique title
 * (e.g. "Dedicated Development Team" category vs. the service page).
 */
add_filter( 'aioseo_title', function ( $title ) {
    $plain  = html_entity_decode( wp_strip_all_tags( (string) $title ), ENT_QUOTES | ENT_HTML5, 'UTF-8' );
    $suffix = '#\s+(?:-|–|—|\||&\#8211;|&\#8212;|&ndash;|&mdash;)\s+TechDotBit\s*$#u';
    if ( is_category() && ! is_paged() ) {
        $term = get_queried_object();
        $name = html_entity_decode( $term instanceof WP_Term ? $term->name : '', ENT_QUOTES );
        if ( '' !== $name && preg_match( '#^' . preg_quote( $name, '#' ) . substr( $suffix, 1 ), $plain ) ) {
            return sprintf( __( '%s Articles & Guides - TechDotBit', 'ace' ), $term->name );
        }
    }
    if ( mb_strlen( $plain ) > 60 && preg_match( $suffix, $plain ) ) {
        return preg_replace( $suffix, '', $plain );
    }
    return $title;
} );

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
