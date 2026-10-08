<?php
/**
 * ERP SEO section: /erp-software/ hub + industry, module and guide pages
 * (content in tools/erp-content/*.php). Each page targets one keyword cluster
 * and gets its SEO title, meta description and focus keyphrases in
 * All in One SEO, FAQ + Service + Breadcrumb schema (landing template) and
 * internal links to related ERP pages.
 *
 * Run from the WordPress root:
 *   wp eval-file wp-content/themes/ace/tools/create-erp-pages.php            # add missing pages, publish, add menu
 *   wp eval-file wp-content/themes/ace/tools/create-erp-pages.php refresh    # also re-write pages created by this script
 *   wp eval-file wp-content/themes/ace/tools/create-erp-pages.php draft      # create new pages as drafts
 *   wp eval-file wp-content/themes/ace/tools/create-erp-pages.php nomenu     # skip the menu step
 *
 * Pages that already exist and were NOT created by this script are never
 * changed. "refresh" overwrites WP Admin edits on generated pages.
 */

if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
	exit; // CLI only.
}

$ace_args    = isset( $args ) ? (array) $args : array();
$ace_refresh = in_array( 'refresh', $ace_args, true );
$ace_draft   = in_array( 'draft', $ace_args, true );
$ace_menu    = ! in_array( 'nomenu', $ace_args, true );

/* -------------------------------------------------------------------------
 * Content
 * ---------------------------------------------------------------------- */
$ace_groups = array(
	'industries' => array( 'label' => 'ERP by industry', 'heading' => 'ERP software for your industry', 'anchor' => 'industries' ),
	'modules'    => array( 'label' => 'ERP modules', 'heading' => 'ERP modules that run every department', 'anchor' => 'modules' ),
	'solutions'  => array( 'label' => 'ERP services & guides', 'heading' => 'ERP services, guides and buying help', 'anchor' => 'guides' ),
);
$ace_pages = array();
foreach ( $ace_groups as $ace_g => $ace_meta ) {
	$ace_file = __DIR__ . '/erp-content/' . $ace_g . '.php';
	if ( ! file_exists( $ace_file ) ) {
		WP_CLI::warning( 'Missing ' . $ace_file );
		continue;
	}
	foreach ( (array) require $ace_file as $ace_p ) {
		$ace_p['group']                 = $ace_g;
		$ace_pages[ $ace_p['slug'] ]    = $ace_p;
	}
}
$ace_hub_slug = 'erp-software';

/**
 * Turn [[slug|anchor]] tokens into links: ERP pages, then any existing post
 * or page with that slug; unknown slugs become plain text.
 */
function ace_erp_links( $text, $pages, $hub ) {
	return preg_replace_callback( '/\[\[([a-z0-9-]+)\|([^\]]+)\]\]/', function ( $m ) use ( $pages, $hub ) {
		$url = '';
		if ( isset( $pages[ $m[1] ] ) ) {
			$url = home_url( '/' . $hub . '/' . $m[1] . '/' );
		} elseif ( 'ai-powered-erp' === $m[1] || 'ai-agent-library' === $m[1] ) {
			$url = home_url( '/ai-services/' . $m[1] . '/' );
		} else {
			global $wpdb;
			$id = $wpdb->get_var( $wpdb->prepare(
				"SELECT ID FROM {$wpdb->posts} WHERE post_name = %s AND post_type IN ('post','page') AND post_status = 'publish' LIMIT 1",
				$m[1]
			) );
			$url = $id ? get_permalink( (int) $id ) : '';
		}
		return $url ? '<a href="' . esc_url( $url ) . '">' . esc_html( $m[2] ) . '</a>' : esc_html( $m[2] );
	}, $text );
}

/** Body sections -> HTML for the page content. */
function ace_erp_html( $p, $pages, $hub ) {
	$t   = function ( $s ) use ( $pages, $hub ) {
		$s = esc_html( $s );
		$s = str_replace( array( '&#039;', '&quot;' ), array( "'", '"' ), $s );
		return ace_erp_links( $s, $pages, $hub );
	};
	$out = '';
	foreach ( $p['body'] as $sec ) {
		$out .= '<h2>' . esc_html( $sec['h2'] ) . "</h2>\n";
		foreach ( isset( $sec['p'] ) ? $sec['p'] : array() as $para ) {
			$out .= '<p>' . $t( $para ) . "</p>\n";
		}
		if ( ! empty( $sec['list'] ) ) {
			$out .= "<ul>\n";
			foreach ( $sec['list'] as $li ) {
				// "Label: text" -> bold label.
				if ( preg_match( '/^([^:]{2,60}):\s+(.+)$/s', $li, $m ) ) {
					$out .= '<li><strong>' . esc_html( $m[1] ) . ':</strong> ' . $t( $m[2] ) . "</li>\n";
				} else {
					$out .= '<li>' . $t( $li ) . "</li>\n";
				}
			}
			$out .= "</ul>\n";
		}
		foreach ( isset( $sec['h3'] ) ? $sec['h3'] : array() as $h ) {
			$out .= '<h3>' . esc_html( $h[0] ) . "</h3>\n<p>" . $t( $h[1] ) . "</p>\n";
		}
		foreach ( isset( $sec['p2'] ) ? $sec['p2'] : array() as $para ) {
			$out .= '<p>' . $t( $para ) . "</p>\n";
		}
	}
	return $out;
}

/** Hub page body: overview + every ERP page grouped, with descriptions. */
function ace_erp_hub_html( $pages, $groups, $hub ) {
	$out  = '<h2>What is ERP software?</h2>' . "\n";
	$out .= '<p>ERP (enterprise resource planning) software brings sales, purchase, inventory, production, quality, dispatch, accounts and HR into one system with one set of data. Instead of re-typing the same order into a register, a spreadsheet and Tally, each department works on the same live record, so stock, costs and delivery dates are always current. Read our ' . ace_erp_links( '[[what-is-erp|complete guide to ERP]]', $pages, $hub ) . ' for the basics.</p>' . "\n";
	$out .= '<p>TechDotBit builds and implements <strong>DotOne ERP</strong>, an AI-powered, industry-specific ERP for Indian manufacturers, distributors and service companies. It is configured around how your industry actually works: the units you buy and sell in, your production stages, your quality checks and your dispatch process, with GST-ready accounting and a mobile app for teams on the shop floor and in the field.</p>' . "\n";
	$out .= '<h2>Why businesses move to an industry-specific ERP</h2>' . "\n<ul>\n";
	foreach ( array(
		'One source of truth: orders, stock, production and accounts update together, so reports no longer depend on who updated which sheet.',
		'Less manual work: quotations, purchase orders, job cards, invoices and e-way bills are generated from data already in the system.',
		'Real-time stock and costing: know what you have, what is reserved, what is in production and what each order really costs.',
		'Control without micromanagement: approvals, user rights and audit trails make processes consistent across plants, branches and warehouses.',
		'AI that does routine work: AI agents flag shortages, suggest purchase quantities, chase payments and prepare MIS reports for review.',
	) as $li ) {
		$out .= '<li>' . esc_html( $li ) . "</li>\n";
	}
	$out .= "</ul>\n";
	foreach ( $groups as $g => $meta ) {
		$out .= '<h2 id="' . esc_attr( $meta['anchor'] ) . '">' . esc_html( $meta['heading'] ) . "</h2>\n<ul class=\"tdb-erp-index\">\n";
		foreach ( $pages as $p ) {
			if ( $p['group'] !== $g ) {
				continue;
			}
			$out .= '<li><a href="' . esc_url( home_url( '/' . $hub . '/' . $p['slug'] . '/' ) ) . '">' . esc_html( $p['title'] ) . '</a> ' . esc_html( $p['excerpt'] ) . "</li>\n";
		}
		$out .= "</ul>\n";
	}
	$out .= '<h2>How we implement ERP</h2>' . "\n";
	$out .= '<p>Every implementation starts with a study of your current process, documents and reports. We then configure DotOne ERP (or build custom modules where your process is unique), migrate masters and opening balances from Tally or spreadsheets, train each department and stay with you through the first closing cycles. If you already use an ERP, we can ' . ace_erp_links( '[[erp-integration-services|integrate it]]', $pages, $hub ) . ' with your other systems or add ' . ace_erp_links( '[[ai-powered-erp|AI agents to your existing ERP]]', $pages, $hub ) . '.</p>' . "\n";
	return $out;
}

/* -------------------------------------------------------------------------
 * Save helpers
 * ---------------------------------------------------------------------- */
function ace_erp_find( $slug, $parent = null ) {
	global $wpdb;
	$sql = "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'page' AND post_name = %s AND post_status NOT IN ('trash','auto-draft')";
	$sql = null === $parent ? $wpdb->prepare( $sql . ' ORDER BY ID ASC LIMIT 1', $slug ) : $wpdb->prepare( $sql . ' AND post_parent = %d ORDER BY ID ASC LIMIT 1', $slug, $parent );
	$id  = $wpdb->get_var( $sql );
	return $id ? get_post( (int) $id ) : null;
}

/** Title, description and keyphrases in All in One SEO (plus a theme fallback). */
function ace_erp_seo( $id, $p ) {
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

/**
 * Create or update one page. Returns the ID. Existing pages that this script
 * did not create are left alone.
 */
function ace_erp_save( $p, $parent_id, $order, $fields, $refresh, $draft ) {
	$page = ace_erp_find( $p['slug'], $parent_id ? $parent_id : null );
	if ( $page && ( ! $refresh || ! get_post_meta( $page->ID, '_ace_erp_page', true ) ) ) {
		WP_CLI::log( sprintf( '  kept     %-46s ID %d', $p['title'], $page->ID ) );
		return $page->ID;
	}
	$data = array(
		'post_type'    => 'page',
		'post_title'   => $p['title'],
		'post_name'    => $p['slug'],
		'post_parent'  => $parent_id,
		'menu_order'   => $order,
		'post_status'  => $page ? $page->post_status : ( $draft ? 'draft' : 'publish' ),
		'post_content' => $p['content'],
		'post_excerpt' => $p['excerpt'],
	);
	if ( $page ) {
		$data['ID'] = $page->ID;
	}
	$id = wp_insert_post( wp_slash( $data ), true );
	if ( is_wp_error( $id ) ) {
		WP_CLI::error( $p['slug'] . ': ' . $id->get_error_message() );
	}
	update_post_meta( $id, '_wp_page_template', 'landing-template.php' );
	update_post_meta( $id, '_ace_erp_page', 1 );
	update_post_meta( $id, '_ace_related', isset( $p['related'] ) ? array_values( $p['related'] ) : array() );
	foreach ( $fields as $name => $value ) {
		update_field( $name, $value, $id );
	}
	ace_erp_seo( $id, $p );
	WP_CLI::log( sprintf( '  %-8s %-46s ID %d', $page ? 'updated' : 'created', $p['title'], $id ) );
	return $id;
}

/** ACF fields for an ERP page. */
function ace_erp_fields( $p, $i ) {
	$bgs    = array( 'network', 'grid', 'aurora', 'streaks', 'knot' );
	$style  = 'modules' === $p['group'] ? 'streaks' : 'knot';
	$bg     = $bgs[ $i % count( $bgs ) ];
	if ( 'streaks' === $style && 'knot' === $bg ) {
		$bg = 'network';
	}
	$label  = isset( $p['nav'] ) ? $p['nav'] : $p['eyebrow'];
	return array(
		'lp_hero_style'      => $style,
		'lp_bg_visual'       => $bg,
		'lp_eyebrow'         => $p['eyebrow'],
		'lp_title'           => $p['title'],
		'lp_title_highlight' => $p['highlight'],
		'lp_intro'           => $p['intro'],
		'lp_points'          => array_map( function ( $t ) { return array( 'text' => $t ); }, $p['points'] ),
		'lp_hero_features'   => array_map( function ( $t ) { return array( 'text' => $t ); }, $p['points'] ),
		'lp_cta_label'       => 'Book a free ERP demo',
		'lp_cta2_label'      => 'See features',
		'lp_cta2_link'       => '#use-cases',
		'lp_form_heading'    => 'Get a free ' . $label . ' demo',
		'lp_form_text'       => 'Tell us about your business and current process. We will show how DotOne ERP fits, module by module.',
		'lp_cards_eyebrow'   => 'Key features',
		'lp_cards_heading'   => 'What ' . $label . ' covers',
		'lp_cards'           => array_map( function ( $r ) { return array( 'title' => $r[0], 'text' => $r[1], 'link' => '' ); }, $p['cards'] ),
		'lp_steps_heading'   => 'How it works',
		'lp_steps'           => array_map( function ( $r ) { return array( 'title' => $r[0], 'text' => $r[1] ); }, $p['steps'] ),
		'lp_faq'             => array_map( function ( $r ) { return array( 'question' => $r[0], 'answer' => $r[1] ); }, $p['faq'] ),
		'lp_sections'        => 'solutions' === $p['group'] ? array() : array( 'erp' ),
		'lp_show_stack'      => 0,
	);
}

/* -------------------------------------------------------------------------
 * Hub
 * ---------------------------------------------------------------------- */
$ace_hub = array(
	'slug'      => $ace_hub_slug,
	'title'     => 'ERP Software for Manufacturers & Growing Businesses',
	'seo_title' => 'ERP Software India | AI-Powered DotOne ERP | TechDotBit',
	'meta'      => 'AI-powered ERP software for Indian manufacturers, distributors and MSMEs. Industry-specific DotOne ERP for inventory, production, GST accounting and more.',
	'focus'     => 'erp software',
	'keywords'  => array( 'erp software', 'erp software india', 'erp system', 'ai erp software', 'industry specific erp' ),
	'excerpt'   => 'AI-powered, industry-specific ERP for manufacturers, distributors and MSMEs.',
	'related'   => array(),
);
$ace_hub['content'] = ace_erp_hub_html( $ace_pages, $ace_groups, $ace_hub_slug );
$ace_hub_fields = array(
	'lp_hero_style'      => 'knot',
	'lp_bg_visual'       => 'network',
	'lp_eyebrow'         => 'DotOne ERP by TechDotBit',
	'lp_title'           => 'AI-powered ERP software built for your industry',
	'lp_title_highlight' => 'built for your industry',
	'lp_intro'           => 'Run sales, purchase, inventory, production, quality, dispatch, GST accounting and HR in one system, with AI agents that handle the routine work.',
	'lp_points'          => array( array( 'text' => 'Industry-specific for manufacturing, trading and services' ), array( 'text' => 'GST-ready accounting and mobile app' ), array( 'text' => 'AI agents for stock, purchase, sales and reports' ) ),
	'lp_cta_label'       => 'Book a free ERP demo',
	'lp_form_heading'    => 'Get a free ERP demo',
	'lp_form_text'       => 'Share your industry and current process. We will show you DotOne ERP configured for it.',
	'lp_cards_eyebrow'   => 'ERP by industry',
	'lp_cards_heading'   => 'ERP built around how your industry works',
	'lp_cards'           => array(),
	'lp_steps_heading'   => 'From first call to go-live',
	'lp_steps'           => array(
		array( 'title' => 'Process study', 'text' => 'We map your orders, production, stock, accounts and reports, and agree what the ERP must do.' ),
		array( 'title' => 'Configure & build', 'text' => 'DotOne ERP is configured for your industry; anything unique is built as a custom module.' ),
		array( 'title' => 'Migrate & train', 'text' => 'Masters and opening balances move from Tally or spreadsheets, and every department is trained.' ),
		array( 'title' => 'Go live & improve', 'text' => 'We support the first closing cycles, then add AI agents and reports as you grow.' ),
	),
	'lp_faq'             => array(
		array( 'question' => 'What is ERP software?', 'answer' => 'ERP (enterprise resource planning) software connects sales, purchase, inventory, production, accounts and HR in one system with one database, so every department works on the same, up-to-date information.' ),
		array( 'question' => 'What is DotOne ERP?', 'answer' => 'DotOne is the AI-powered, industry-specific ERP built by TechDotBit for Indian businesses. It covers CRM, sales, purchase, inventory, manufacturing, finance, HR and analytics, with AI agents and a mobile app.' ),
		array( 'question' => 'Which industries do you build ERP for?', 'answer' => 'Manufacturing (including plywood, adhesive tape, footwear, laminates, ACP, steel and metal, packaging, plastics, chemicals, furniture and auto components), FMCG, distribution and trading, textiles and service businesses.' ),
		array( 'question' => 'Can you move us from Tally or Excel?', 'answer' => 'Yes. We migrate item, customer and supplier masters, open orders and opening balances, and can keep Tally running for accounts during the transition if you prefer.' ),
		array( 'question' => 'Is DotOne ERP cloud-based?', 'answer' => 'DotOne runs in the cloud, so teams can use it from the office, the factory or on the move, with role-based access and regular backups.' ),
	),
	'lp_sections'        => array( 'erp', 'how' ),
	'lp_show_stack'      => 0,
);
// Hub cards: one per industry page (internal links with descriptive anchors).
foreach ( $ace_pages as $ace_p ) {
	if ( 'industries' === $ace_p['group'] && count( $ace_hub_fields['lp_cards'] ) < 9 ) {
		$ace_hub_fields['lp_cards'][] = array( 'title' => $ace_p['title'], 'text' => $ace_p['excerpt'], 'link' => home_url( '/' . $ace_hub_slug . '/' . $ace_p['slug'] . '/' ) );
	}
}

WP_CLI::log( sprintf( 'ERP pages (%d)%s:', count( $ace_pages ) + 1, $ace_refresh ? ' - refresh' : '' ) );
$ace_hub_id = ace_erp_save( $ace_hub, 0, 0, $ace_hub_fields, $ace_refresh, $ace_draft );

$ace_ids = array();
$ace_i   = 0;
foreach ( $ace_pages as $ace_slug => $ace_p ) {
	$ace_p['content']   = ace_erp_html( $ace_p, $ace_pages, $ace_hub_slug );
	$ace_ids[ $ace_slug ] = ace_erp_save( $ace_p, $ace_hub_id, $ace_i + 1, ace_erp_fields( $ace_p, $ace_i ), $ace_refresh, $ace_draft );
	$ace_i++;
}

/* -------------------------------------------------------------------------
 * Menu: "ERP" mega menu with three columns + overview
 * ---------------------------------------------------------------------- */
if ( $ace_menu ) {
	$ace_locations = get_nav_menu_locations();
	$ace_menu_id   = isset( $ace_locations['primary-menu'] ) ? (int) $ace_locations['primary-menu'] : 0;
	if ( ! $ace_menu_id ) {
		WP_CLI::warning( 'No menu in the "Primary Menu" location; skipping the menu step.' );
	} else {
		$ace_items = wp_get_nav_menu_items( $ace_menu_id, array( 'post_status' => 'any' ) );
		$ace_top   = null;
		foreach ( $ace_items as $ace_it ) {
			if ( 'post_type' === $ace_it->type && (int) $ace_it->object_id === (int) $ace_hub_id && 0 === (int) $ace_it->menu_item_parent ) {
				$ace_top = $ace_it;
			}
		}
		// Prefer the existing "DotOne" / "ERP" top-level item, so the header does not get another item.
		$ace_host = null;
		foreach ( $ace_items as $ace_it ) {
			if ( 0 === (int) $ace_it->menu_item_parent && preg_match( '/dot\s*one|\berp\b/i', $ace_it->title ) ) {
				$ace_host = $ace_it;
				break;
			}
		}
		$ace_has_cols = false;
		if ( $ace_host ) {
			foreach ( $ace_items as $ace_it ) {
				if ( (int) $ace_it->menu_item_parent === (int) $ace_host->ID && $ace_it->title === $ace_groups['industries']['label'] ) {
					$ace_has_cols = true;
				}
			}
		}
		if ( $ace_top || $ace_has_cols ) {
			WP_CLI::log( '  menu     ERP menu already in the main menu (not changed)' );
		} else {
			$ace_add = function ( $args ) use ( $ace_menu_id ) {
				return wp_update_nav_menu_item( $ace_menu_id, 0, array_merge( array( 'menu-item-status' => 'publish' ), $args ) );
			};
			if ( $ace_host ) {
				$ace_parent = $ace_host->ID;
				$ace_classes = trim( implode( ' ', (array) $ace_host->classes ) . ' full-menu erp-menu' );
				update_post_meta( $ace_host->ID, '_menu_item_classes', array_unique( array_filter( explode( ' ', $ace_classes ) ) ) );
				WP_CLI::log( '  menu     adding ERP pages under "' . $ace_host->title . '"' );
			} else {
			$ace_tops = array_values( array_filter( $ace_items, function ( $it ) { return 0 === (int) $it->menu_item_parent; } ) );
			usort( $ace_tops, function ( $a, $b ) { return $a->menu_order - $b->menu_order; } );
			$ace_pos = $ace_tops ? $ace_tops[ count( $ace_tops ) - 1 ]->menu_order : 1;
			foreach ( $ace_items as $ace_it ) {
				if ( $ace_it->menu_order >= $ace_pos ) {
					wp_update_post( array( 'ID' => $ace_it->ID, 'menu_order' => $ace_it->menu_order + 1 ) );
				}
			}
			$ace_parent = $ace_add( array(
				'menu-item-title'     => 'ERP',
				'menu-item-object'    => 'page',
				'menu-item-object-id' => $ace_hub_id,
				'menu-item-type'      => 'post_type',
				'menu-item-position'  => $ace_pos,
				'menu-item-classes'   => 'full-menu erp-menu',
			) );
			}
			$ace_col_pos = 100;
			foreach ( $ace_groups as $ace_g => $ace_meta ) {
				$ace_col = $ace_add( array(
					'menu-item-title'     => $ace_meta['label'],
					'menu-item-url'       => home_url( '/' . $ace_hub_slug . '/#' . $ace_meta['anchor'] ),
					'menu-item-type'      => 'custom',
					'menu-item-parent-id' => $ace_parent,
					'menu-item-position'  => $ace_col_pos++,
				) );
				$ace_n = 0;
				foreach ( $ace_pages as $ace_slug => $ace_p ) {
					if ( $ace_p['group'] !== $ace_g || $ace_n >= 8 ) {
						continue;
					}
					$ace_add( array(
						'menu-item-title'     => isset( $ace_p['nav'] ) ? $ace_p['nav'] : $ace_p['title'],
						'menu-item-object'    => 'page',
						'menu-item-object-id' => $ace_ids[ $ace_slug ],
						'menu-item-type'      => 'post_type',
						'menu-item-parent-id' => $ace_col,
						'menu-item-position'  => ++$ace_n,
					) );
				}
				$ace_add( array(
					'menu-item-title'     => 'View all &rarr;',
					'menu-item-url'       => home_url( '/' . $ace_hub_slug . '/#' . $ace_meta['anchor'] ),
					'menu-item-type'      => 'custom',
					'menu-item-parent-id' => $ace_col,
					'menu-item-position'  => ++$ace_n,
				) );
			}
			$ace_col = $ace_add( array(
				'menu-item-title'     => 'DotOne ERP',
				'menu-item-url'       => 'https://dotone.biz/',
				'menu-item-type'      => 'custom',
				'menu-item-parent-id' => $ace_parent,
				'menu-item-position'  => $ace_col_pos,
			) );
			$ace_add( array(
				'menu-item-title'     => 'ERP overview',
				'menu-item-object'    => 'page',
				'menu-item-object-id' => $ace_hub_id,
				'menu-item-type'      => 'post_type',
				'menu-item-parent-id' => $ace_col,
				'menu-item-position'  => 1,
			) );
			$ace_ai_erp = ace_erp_find( 'ai-powered-erp' );
			if ( $ace_ai_erp ) {
				$ace_add( array(
					'menu-item-title'     => 'AI-powered ERP',
					'menu-item-object'    => 'page',
					'menu-item-object-id' => $ace_ai_erp->ID,
					'menu-item-type'      => 'post_type',
					'menu-item-parent-id' => $ace_col,
					'menu-item-position'  => 2,
				) );
			}
			WP_CLI::log( '  menu     ERP mega menu added' );
		}
	}
}

WP_CLI::success( 'ERP section ready: ' . get_permalink( $ace_hub_id ) . '  (then run: wp litespeed-purge all)' );
