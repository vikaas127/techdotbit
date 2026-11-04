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

    $html = techdotbit_fix_images_in_html( $html );

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
        '#^https?://promotions\.bankofamerica\.com/digitalbanking/mobilebanking/erica#i',
        '#^https?://drive\.google\.com/drive/folders/#i',
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
    $map = techdotbit_external_redirect_map();
    if ( isset( $map[ $raw ] ) ) {
        return $map[ $raw ];
    }
    // DotOne's old domains no longer resolve.
    if ( preg_match( '#^https?://(www\.)?dotoneforbusiness\.(com|in)(/.*)?$#i', $raw ) ) {
        return function_exists( 'ace_dotone_url' ) ? ace_dotone_url() : 'https://dotone.in/';
    }
    return $url;
}

/**
 * Outbound links that permanently redirect (checked November 2026), mapped
 * to where they end up so visitors and crawlers skip the redirect.
 */
function techdotbit_external_redirect_map() {
    return apply_filters( 'techdotbit_external_redirect_map', array(
        'http://www.talend.com/' => 'https://www.qlik.com/us/qlik-talend',
        'https://ai.google.dev/available_regions#available_regions' => 'https://aistudio.google.com/docs/available-regions',
        'https://ai.google.dev/docs' => 'https://aistudio.google.com/docs',
        'https://ai.google.dev/tutorials/dart_quickstart' => 'https://aistudio.google.com/docs/get-started?codelanguage=dart',
        'https://aistudio.google.com/?utm_source=flutter&utm_medium=referral&utm_campaign=blog_gaidartsdk_announcment&utm_content=' => 'https://aistudio.google.com/welcome?utm_source=flutter&utm_medium=referral&utm_campaign=blog_gaidartsdk_announcment&utm_content',
        'https://apps.apple.com/cn/app/%E9%97%B2%E9%B1%BC-%E9%97%B2%E4%B8%8D%E4%BD%8F-%E4%B8%8A%E9%97%B2%E9%B1%BC/id510909506' => 'https://apps.apple.com/cn/app/%E9%97%B2%E9%B1%BC-%E4%B8%8A%E9%97%B2%E9%B1%BC-%E8%B5%9A%E4%B8%80%E7%AC%94/id510909506',
        'https://apps.apple.com/us/app/acorn-tv/id896014310' => 'https://apps.apple.com/us/app/acorn-tv-brilliant-mysteries/id896014310',
        'https://apps.apple.com/us/app/hallmark-movies-now/id472567577' => 'https://apps.apple.com/us/app/hallmark/id472567577',
        'https://apps.apple.com/us/app/realtor-com-real-estate/id336698281' => 'https://apps.apple.com/us/app/realtor-com-real-estate-rent/id336698281',
        'https://apps.apple.com/us/app/story-collage-editor-postmuse/id1373022941?ls=1' => 'https://apps.apple.com/us/app/reels-story-templates-postmuse/id1373022941?ls=1',
        'https://apps.apple.com/us/app/youtube-watch-listen-stream/id544007664' => 'https://apps.apple.com/us/app/youtube/id544007664',
        'https://aws.amazon.com/cloudformation' => 'https://aws.amazon.com/cloudformation/',
        'https://aws.amazon.com/what-is-aws' => 'https://aws.amazon.com/what-is-aws/',
        'https://cloud.google.com/dataflow' => 'https://cloud.google.com/products/dataflow',
        'https://cloud.google.com/use-cases/generative-ai' => 'https://cloud.google.com/ai/generative-ai',
        'https://docs.mongodb.com/' => 'https://www.mongodb.com/docs/',
        'https://insights.stackoverflow.com/survey/2021#most-loved-dreaded-and-wanted-language-want' => 'https://survey.stackoverflow.co/2021',
        'https://nodejs.org/' => 'https://nodejs.org/en',
        'https://scrapy.org/' => 'https://www.scrapy.org/',
        'https://spot.io/resources/cloud-cost/cloud-cost-optimization-15-ways-to-optimize-your-cloud/' => 'https://www.flexera.com/blog/finops/cloud-cost-optimization-15-ways-to-optimize-your-cloud/',
        'https://www.android.com/everyone/' => 'https://www.android.com/why-android/',
        'https://www.azzure-it.com/' => 'https://advania.co.uk',
        'https://www.bmc.com/blogs/csp-cloud-service-providers/' => 'https://www.bmc.com/resources/topics/csp-cloud-service-providers.html',
        'https://www.capitalone.com/digital/eno/' => 'https://www.capitalone.com/digital/tools/eno/',
        'https://www.facebook.com/profile.php?id=100091553312657' => 'https://www.facebook.com/people/Techdotbit/100091553312657/',
        'https://www.gnani.ai/resources/blogs/ai-speech-recognition-what-is-it-and-how-it-works/' => 'https://www.gnani.ai/resources/blogs/ai-speech-recognition-what-is-it-and-how-it-works',
        'https://www.hmnow.com/' => 'https://www.hallmarkplus.com/',
        'https://www.hulu.com/' => 'https://www.hulu.com/welcome',
        'https://www.ibm.com/cloud/learn/cloud-computing' => 'https://www.ibm.com/topics',
        'https://www.ibm.com/topics/encryption#:~:text=Data%20encryption%20is%20a%20way,data%20encryption%3A%20asymmetric%20vs%20symmetric' => 'https://www.ibm.com/think/topics/encryption',
        'https://www.ibm.com/topics/natural-language-processing#:~:text=Natural%20language%20processing%20(NLP)%20refers,same%20way%20human%20beings%20can.' => 'https://www.ibm.com/think/topics/natural-language-processing',
        'https://www.ibm.com/topics/serverless#:~:text=Serverless%20computing%20is%20an%20application,managing%20servers%20or%20backend%20infrastructure.' => 'https://www.ibm.com/think/topics/serverless',
        'https://www.ibm.com/watson/advantage-reports/market-report.html' => 'https://www.ibm.com/products/watsonx',
        'https://www.knowledgehut.com/blog/blockchain/smart-contract' => 'https://www.upgrad.com/blog/how-to-write-first-smart-contract/',
        'https://www.microsoft.com/en-us/power-platform/products/power-bi/' => 'https://www.microsoft.com/en-us/microsoft-fabric/features/power-bi',
        'https://www.mongodb.com/transactions' => 'https://www.mongodb.com/products/capabilities/transactions',
        'https://www.techtarget.com/searchcio/definition/compliance-audit' => 'https://www.techtarget.com/it-strategy/definition/compliance-audit',
        'https://www2.deloitte.com/' => 'https://www.deloitte.com/us/en.html',
        'https://www2.deloitte.com/content/dam/insights/us/articles/4958_Digital-banking-charticle/4958_Online-banking_Charticle.pdf' => 'https://www.deloitte.com/content/dam/insights/articles/2024/4958_digital-banking-charticle/4958-online-banking-charticle.pdf',
    ) );
}

/**
 * Images: content copied from the old staging site, hotlinked images that
 * moved, and hotlinked images that no longer exist (removed).
 */
function techdotbit_dead_image_patterns() {
    return apply_filters( 'techdotbit_dead_image_patterns', array(
        '#^https?://solveit\.dev/_next/image#i',
        '#^https?://media\.umbraco\.io/goodhabitz/#i',
        '#^https?://www\.apptunix\.com/blog/wp-content/uploads/sites/3/2019/11/KlasterMe#i',
        '#^https?://www\.philips-hue\.com/.*signifyimg#i',
        '#^https?://i\.morioh\.com/2023/11/17/c1b87fb6\.webp#i',
        '#^https?://letstranzact\.com/_nuxt/img/#i',
    ) );
}

function techdotbit_fix_images_in_html( $html ) {
    if ( ! is_string( $html ) || false === stripos( $html, '<img' ) ) {
        return $html;
    }
    $html = str_ireplace( 'techdotbit.com/staging/wp-content/', 'techdotbit.com/wp-content/', $html );
    $html = str_replace(
        array( 'https://reflectly.app/assets/', 'https://cdn-images-1.medium.com/max/1600/' ),
        array( 'https://reflectlyapp.com/assets/', 'https://cdn-images-1.medium.com/v2/resize:fit:1600/' ),
        $html
    );
    $html = preg_replace_callback(
        '/<img\b[^>]*>/i',
        function ( $m ) {
            if ( ! preg_match( '/\s(?:data-)?src\s*=\s*(["\'])(.*?)\1/i', $m[0], $src ) ) {
                return $m[0];
            }
            $url = html_entity_decode( $src[2], ENT_QUOTES );
            foreach ( techdotbit_dead_image_patterns() as $pattern ) {
                if ( preg_match( $pattern, $url ) ) {
                    return '';
                }
            }
            return $m[0];
        },
        $html
    );
    // Wrappers left empty by a removed image.
    return preg_replace( '#<figure\b[^>]*>\s*</figure>#i', '', $html );
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
