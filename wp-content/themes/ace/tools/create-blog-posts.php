<?php
/**
 * Blog posts from tools/blog-content/*.php (one file per post). Each post gets
 * its category, excerpt, and SEO title, meta description and keyphrases in
 * All in One SEO. Files starting with "_" (templates) are skipped.
 *
 * Run from the WordPress root:
 *   wp eval-file wp-content/themes/ace/tools/create-blog-posts.php            # add missing posts
 *   wp eval-file wp-content/themes/ace/tools/create-blog-posts.php draft      # add missing posts as drafts
 *   wp eval-file wp-content/themes/ace/tools/create-blog-posts.php only=slug  # re-write just this post
 *
 * Existing posts are never changed unless named with only=. A post file can
 * set 'status' => 'draft' to always be created as a draft for review.
 */

if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
	exit; // CLI only.
}

$ace_args  = isset( $args ) ? (array) $args : array();
$ace_draft = in_array( 'draft', $ace_args, true );
$ace_only  = array();
foreach ( $ace_args as $ace_arg ) {
	if ( 0 === strpos( $ace_arg, 'only=' ) ) {
		$ace_only = array_filter( explode( ',', substr( $ace_arg, 5 ) ) );
	}
}

/** Sections -> HTML: h2, p[], list[], h3[[title, text]], p2[]; text may contain trusted inline HTML links. */
function ace_blog_html( $p ) {
	$out = '';
	foreach ( isset( $p['lead'] ) ? (array) $p['lead'] : array() as $para ) {
		$out .= '<p>' . $para . "</p>\n";
	}
	foreach ( $p['body'] as $sec ) {
		$out .= '<h2>' . esc_html( $sec['h2'] ) . "</h2>\n";
		foreach ( isset( $sec['p'] ) ? $sec['p'] : array() as $para ) {
			$out .= '<p>' . $para . "</p>\n";
		}
		if ( ! empty( $sec['list'] ) ) {
			$out .= "<ul>\n";
			foreach ( $sec['list'] as $li ) {
				// "Label: text" -> bold label.
				if ( preg_match( '/^([^:<]{2,60}):\s+(.+)$/s', $li, $m ) ) {
					$out .= '<li><strong>' . esc_html( $m[1] ) . ':</strong> ' . $m[2] . "</li>\n";
				} else {
					$out .= '<li>' . $li . "</li>\n";
				}
			}
			$out .= "</ul>\n";
		}
		foreach ( isset( $sec['h3'] ) ? $sec['h3'] : array() as $h ) {
			$out .= '<h3>' . esc_html( $h[0] ) . "</h3>\n<p>" . $h[1] . "</p>\n";
		}
		foreach ( isset( $sec['p2'] ) ? $sec['p2'] : array() as $para ) {
			$out .= '<p>' . $para . "</p>\n";
		}
	}
	if ( ! empty( $p['faq'] ) ) {
		$out .= "<h2>Frequently asked questions</h2>\n";
		foreach ( $p['faq'] as $f ) {
			$out .= '<h3>' . esc_html( $f[0] ) . "</h3>\n<p>" . $f[1] . "</p>\n";
		}
	}
	return wp_kses_post( $out );
}

/** Title, description and keyphrases in All in One SEO (plus the theme fallback). */
function ace_blog_seo( $id, $p ) {
	update_post_meta( $id, '_ace_seo_title', $p['seo_title'] );
	update_post_meta( $id, '_ace_seo_desc', $p['meta'] );
	if ( ! class_exists( '\AIOSEO\Plugin\Common\Models\Post' ) || ! function_exists( 'aioseo' ) ) {
		return;
	}
	$extra = array();
	foreach ( array_slice( array_values( array_diff( $p['keywords'], array( $p['focus'] ) ) ), 0, 4 ) as $k ) {
		$extra[] = array( 'keyphrase' => $k, 'score' => 0, 'analysis' => array() );
	}
	try {
		\AIOSEO\Plugin\Common\Models\Post::savePost( $id, array(
			'title'       => $p['seo_title'],
			'description' => $p['meta'],
			'keyphrases'  => array(
				'focus'      => array( 'keyphrase' => $p['focus'], 'score' => 0, 'analysis' => array() ),
				'additional' => $extra,
			),
		) );
	} catch ( \Throwable $e ) {
		WP_CLI::warning( 'AIOSEO meta not saved for ' . $p['slug'] . ': ' . $e->getMessage() );
	}
}

$ace_files = glob( __DIR__ . '/blog-content/*.php' );
sort( $ace_files );
WP_CLI::log( 'Blog posts:' );
foreach ( $ace_files as $ace_file ) {
	if ( '_' === basename( $ace_file )[0] ) {
		continue;
	}
	$ace_p    = require $ace_file;
	$ace_post = get_page_by_path( $ace_p['slug'], OBJECT, 'post' );
	if ( $ace_post && ! in_array( $ace_p['slug'], $ace_only, true ) ) {
		WP_CLI::log( sprintf( '  kept     %-60s ID %d', $ace_p['title'], $ace_post->ID ) );
		continue;
	}
	if ( $ace_only && ! in_array( $ace_p['slug'], $ace_only, true ) ) {
		continue;
	}
	$ace_cats = array();
	foreach ( (array) $ace_p['categories'] as $ace_cat ) {
		$ace_term = get_category_by_slug( $ace_cat );
		if ( $ace_term ) {
			$ace_cats[] = (int) $ace_term->term_id;
		} else {
			WP_CLI::warning( 'Category not found: ' . $ace_cat );
		}
	}
	$ace_status = ( $ace_draft || ( isset( $ace_p['status'] ) && 'draft' === $ace_p['status'] ) ) ? 'draft' : 'publish';
	$ace_data   = array(
		'post_type'     => 'post',
		'post_title'    => $ace_p['title'],
		'post_name'     => $ace_p['slug'],
		'post_status'   => $ace_post ? $ace_post->post_status : $ace_status,
		'post_content'  => ace_blog_html( $ace_p ),
		'post_excerpt'  => $ace_p['excerpt'],
		'post_category' => $ace_cats,
	);
	if ( $ace_post ) {
		$ace_data['ID'] = $ace_post->ID;
	}
	$ace_id = wp_insert_post( wp_slash( $ace_data ), true );
	if ( is_wp_error( $ace_id ) ) {
		WP_CLI::error( $ace_p['slug'] . ': ' . $ace_id->get_error_message() );
	}
	update_post_meta( $ace_id, '_ace_blog_post', 1 );
	ace_blog_seo( $ace_id, $ace_p );
	WP_CLI::log( sprintf( '  %-8s %-60s ID %d (%s)', $ace_post ? 'updated' : 'created', $ace_p['title'], $ace_id, get_post_status( $ace_id ) ) );
}
WP_CLI::success( 'Blog posts ready. Then run: wp litespeed-purge all' );
