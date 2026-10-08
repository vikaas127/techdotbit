<?php
/*
 * Template Name: AI Landing Page
 *
 * Dark hero with headline + glass enquiry form and a live 3D visual,
 * followed by optional highlight cards, page content, process steps,
 * FAQ (with FAQPage schema) and the site-wide bottom CTA.
 * Fields are registered in inc/landing-fields.php.
 */

get_header();

while ( have_posts() ) :
	the_post();

	$f = function ( $name, $default = '' ) {
		$v = function_exists( 'get_field' ) ? get_field( $name ) : '';
		return ( '' === $v || null === $v || false === $v ) ? $default : $v;
	};

	$eyebrow    = $f( 'lp_eyebrow' );
	$title      = $f( 'lp_title', get_the_title() );
	$intro      = $f( 'lp_intro', has_excerpt() ? get_the_excerpt() : '' );
	$form_title = $f( 'lp_form_title', __( "Let's talk", 'ace' ) );
	$form_code  = $f( 'lp_form_shortcode', '[contact-form-7 id="0f5d249" title="Quote Form"]' );
	$form_note  = $f( 'lp_form_note', __( 'Your data is secure with us.', 'ace' ) );
	$visual     = $f( 'lp_visual' );
	$points     = $f( 'lp_points', array() );
	$style      = $f( 'lp_hero_style', 'knot' );
	$features   = $f( 'lp_hero_features', array() );
	$cta_label  = $f( 'lp_cta_label', __( 'Book a free consultation', 'ace' ) );

	// The glass enquiry card: inside the hero (knot style) or its own section (streaks style).
	ob_start();
	?>
	<div class="tdb-glass">
		<h2 class="tdb-glass__title"><?php echo esc_html( $form_title ); ?></h2>
		<div class="tdb-glass__form">
			<?php echo do_shortcode( wp_kses_post( $form_code ) ); ?>
		</div>
		<?php if ( $form_note ) : ?>
			<p class="tdb-glass__note">
				<svg width="14" height="14" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M12 1 3 5v6c0 5.6 3.8 10.7 9 12 5.2-1.3 9-6.4 9-12V5l-9-4Zm-1.4 15.4L6.2 12l1.4-1.4 3 3 6.8-6.8 1.4 1.4-8.2 8.2Z"/></svg>
				<?php echo esc_html( $form_note ); ?>
			</p>
		<?php endif; ?>
	</div>
	<?php
	$glass = ob_get_clean();
	?>

	<?php if ( 'agents' === $style ) :
		$hl      = $f( 'lp_title_highlight' );
		$h1_html = esc_html( $title );
		if ( $hl && false !== strpos( $title, $hl ) ) {
			$h1_html = str_replace( esc_html( $hl ), '<span class="tdb-hl">' . esc_html( $hl ) . '</span>', $h1_html );
		}
		$agents = $f( 'lp_agents', array() );
		if ( ! $agents ) {
			$agents = array( array( 'name' => 'Research Agent' ), array( 'name' => 'Triage Agent' ), array( 'name' => 'Resolution Agent' ) );
		}
		$agent_icons = array(
			'<path d="M11 4a7 7 0 1 0 4.2 12.6L20 21.4 21.4 20l-4.8-4.8A7 7 0 0 0 11 4Zm0 2a5 5 0 1 1 0 10 5 5 0 0 1 0-10Z"/>',
			'<path d="M4 5h16v2l-6 6v6l-4 2v-8L4 7V5Z"/>',
			'<path d="M9.5 16.2 5.3 12l-1.4 1.4 5.6 5.6L20.1 8.4 18.7 7z"/>',
			'<path d="M12 2 3 7v10l9 5 9-5V7l-9-5Zm0 2.3L18.7 8 12 11.7 5.3 8 12 4.3Z"/>',
		);
		?>

	<section class="tdb-hero tdb-hero--agents" aria-labelledby="tdb-hero-title">
		<div class="container">
			<div class="tdb-agents-top">
				<div>
					<?php if ( $eyebrow ) : ?>
						<p class="tdb-chip"><span></span><?php echo esc_html( $eyebrow ); ?></p>
					<?php endif; ?>
					<h1 id="tdb-hero-title" class="tdb-hero__title"><?php echo $h1_html; // phpcs:ignore -- escaped above ?></h1>
				</div>
				<div class="tdb-agents-side">
					<?php if ( $intro ) : ?>
						<p class="tdb-hero__intro"><?php echo esc_html( $intro ); ?></p>
					<?php endif; ?>
					<div class="tdb-hero__actions">
						<a class="tdb-btn tdb-btn--primary" href="#lets-talk"><?php echo esc_html( $cta_label ); ?></a>
						<?php if ( $f( 'lp_cta2_label' ) ) : ?>
							<a class="tdb-btn tdb-btn--ghost" href="<?php echo esc_url( $f( 'lp_cta2_link', '#lets-talk' ) ); ?>"><?php echo esc_html( $f( 'lp_cta2_label' ) ); ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<div class="tdb-agents-panel" aria-hidden="true">
				<div class="tdb-prompt">
					<span class="tdb-prompt__text" data-text="<?php echo esc_attr( $f( 'lp_prompt', 'Build an agent team to handle our support tickets' ) ); ?>"><?php echo esc_html( $f( 'lp_prompt', 'Build an agent team to handle our support tickets' ) ); ?></span><span class="tdb-prompt__caret"></span>
					<span class="tdb-prompt__send"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M12 4 5 11l1.4 1.4L11 7.8V20h2V7.8l4.6 4.6L19 11z"/></svg></span>
				</div>
				<svg class="tdb-agents-lines" viewBox="0 0 900 120" preserveAspectRatio="none">
					<?php
					$n = count( $agents );
					for ( $i = 0; $i < $n; $i++ ) {
						$x = ( $i + 0.5 ) * 900 / $n;
						printf( '<path d="M450 0 C 450 60, %1$s 40, %1$s 120" />', esc_attr( round( $x ) ) );
					}
					?>
				</svg>
				<ul class="tdb-agents" style="--n: <?php echo (int) count( $agents ); ?>">
					<?php foreach ( $agents as $ai => $agent ) : ?>
						<li class="tdb-agent" style="--i: <?php echo (int) $ai; ?>">
							<span class="tdb-agent__avatar"><svg width="22" height="22" viewBox="0 0 24 24"><g fill="currentColor"><?php echo $agent_icons[ $ai % count( $agent_icons ) ]; // phpcs:ignore -- static ?></g></svg><i></i></span>
							<span class="tdb-agent__name"><?php echo esc_html( $agent['name'] ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</section>

	<?php elseif ( 'streaks' === $style ) : ?>

	<section class="tdb-hero tdb-hero--streaks" aria-labelledby="tdb-hero-title">
		<div class="tdb-hero__visual" aria-hidden="true"><canvas class="tdb-streaks"></canvas></div>
		<div class="container">
			<div class="tdb-hero__copy">
				<?php if ( $eyebrow ) : ?>
					<p class="tdb-chip"><span></span><?php echo esc_html( $eyebrow ); ?></p>
				<?php endif; ?>
				<h1 id="tdb-hero-title" class="tdb-hero__title"><?php echo esc_html( $title ); ?><span class="tdb-caret" aria-hidden="true"></span></h1>
				<?php if ( $intro ) : ?>
					<p class="tdb-hero__intro"><?php echo esc_html( $intro ); ?></p>
				<?php endif; ?>
				<div class="tdb-hero__actions">
					<a class="btn btn-solid bg-primary text-white" href="#lets-talk"><span class="inline-flex py-1/15em px-2/1em items-center"><span class="btn-txt"><?php echo esc_html( $cta_label ); ?></span></span></a>
				</div>
			</div>
			<?php if ( $features ) : ?>
				<ul class="tdb-hero__features">
					<?php foreach ( $features as $feat ) : ?>
						<li>
							<h2 class="tdb-hero__feature-title">
								<?php if ( ! empty( $feat['link'] ) ) : ?><a href="<?php echo esc_url( $feat['link'] ); ?>"><?php endif; ?>
								<?php echo esc_html( $feat['title'] ); ?>
								<?php if ( ! empty( $feat['link'] ) ) : ?></a><?php endif; ?>
							</h2>
							<p><?php echo esc_html( $feat['text'] ); ?></p>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	</section>

	<?php else : ?>

	<section class="tdb-hero" aria-labelledby="tdb-hero-title">
		<div class="tdb-hero__visual" aria-hidden="true">
			<?php if ( is_array( $visual ) && ! empty( $visual['url'] ) ) : ?>
				<img src="<?php echo esc_url( $visual['url'] ); ?>" alt="" width="<?php echo (int) $visual['width']; ?>" height="<?php echo (int) $visual['height']; ?>" fetchpriority="high">
			<?php else : ?>
				<canvas class="tdb-orb"></canvas>
			<?php endif; ?>
		</div>

		<div class="container tdb-hero__inner">
			<div class="tdb-hero__copy">
				<?php if ( $eyebrow ) : ?>
					<p class="tdb-chip"><span></span><?php echo esc_html( $eyebrow ); ?></p>
				<?php endif; ?>
				<h1 id="tdb-hero-title" class="tdb-hero__title"><?php echo esc_html( $title ); ?></h1>
				<?php if ( $intro ) : ?>
					<p class="tdb-hero__intro"><?php echo esc_html( $intro ); ?></p>
				<?php endif; ?>
				<?php if ( $points ) : ?>
					<ul class="tdb-hero__points">
						<?php foreach ( $points as $row ) : ?>
							<?php if ( ! empty( $row['text'] ) ) : ?>
								<li><?php echo esc_html( $row['text'] ); ?></li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>

			<div class="tdb-hero__form" id="lets-talk">
				<?php echo $glass; // phpcs:ignore -- built above from escaped parts ?>
			</div>
		</div>
	</section>

	<?php endif; ?>

	<?php $cards = $f( 'lp_cards', array() ); ?>
	<?php if ( $cards ) : ?>
	<section class="lqd-section services inner-services tdb-lp-cards" id="use-cases">
		<div class="container">
			<?php if ( $f( 'lp_cards_heading' ) ) : ?>
				<div class="tdb-lp-head">
					<?php if ( $f( 'lp_cards_eyebrow' ) ) : ?><h6 class="ld-fh-element"><?php echo esc_html( $f( 'lp_cards_eyebrow' ) ); ?></h6><?php endif; ?>
					<h2><?php echo esc_html( $f( 'lp_cards_heading' ) ); ?></h2>
					<?php if ( $f( 'lp_cards_intro' ) ) : ?><p><?php echo esc_html( $f( 'lp_cards_intro' ) ); ?></p><?php endif; ?>
				</div>
			<?php endif; ?>
			<div class="row">
				<?php
				// Fallback line icons (code, test, pulse, layers, shield, spark) when a card has no icon image.
				$ace_icons = array(
					'<path d="m8 9-4 3 4 3M16 9l4 3-4 3M13.5 5l-3 14"/>',
					'<path d="M9 3h6M10 3v6L5 18a2 2 0 0 0 1.8 3h10.4A2 2 0 0 0 19 18l-5-9V3"/><path d="m9 15 2 2 4-4"/>',
					'<path d="M3 12h4l3-8 4 16 3-8h4"/>',
					'<path d="m12 3 9 5-9 5-9-5 9-5Z"/><path d="m3 13 9 5 9-5"/>',
					'<path d="M12 3 4 6v6c0 4.5 3.4 8.3 8 9 4.6-.7 8-4.5 8-9V6l-8-3Z"/><path d="m9 12 2 2 4-4"/>',
					'<path d="M12 3v4M12 17v4M3 12h4M17 12h4M6 6l2.5 2.5M15.5 15.5 18 18M6 18l2.5-2.5M15.5 8.5 18 6"/>',
				);
				?>
				<?php foreach ( $cards as $ci => $card ) : ?>
					<div class="col col-12 col-md-6 col-lg-4 mb-30">
						<div class="iconbox">
							<div class="iconbox-icon-wrap mb-1em"><span class="iconbox-icon-container">
								<?php if ( ! empty( $card['icon']['url'] ) ) : ?>
									<img src="<?php echo esc_url( $card['icon']['url'] ); ?>" alt="" width="32" height="32" loading="lazy">
								<?php else : ?>
									<svg class="tdb-line-icon" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?php echo $ace_icons[ $ci % count( $ace_icons ) ]; // phpcs:ignore -- static markup ?></svg>
								<?php endif; ?>
							</span></div>
							<div class="contents">
								<h3><?php if ( ! empty( $card['link'] ) ) : ?><a href="<?php echo esc_url( $card['link'] ); ?>"><?php echo esc_html( $card['title'] ); ?></a><?php else : ?><?php echo esc_html( $card['title'] ); ?><?php endif; ?></h3>
								<p><?php echo esc_html( $card['text'] ); ?></p>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( trim( get_the_content() ) ) : ?>
	<section class="lqd-section tdb-lp-content py-75">
		<div class="container">
			<div class="entry-content tdb-prose">
				<?php the_content(); ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( 'knot' !== $style ) : ?>
	<section class="tdb-form-band" id="lets-talk">
		<div class="container tdb-form-band__inner">
			<div class="tdb-form-band__copy">
				<h2><?php echo esc_html( $f( 'lp_form_heading', __( 'Tell us what you want to automate', 'ace' ) ) ); ?></h2>
				<p><?php echo esc_html( $f( 'lp_form_text', __( 'Share a few details and an engineer will get back to you within one business day with next steps.', 'ace' ) ) ); ?></p>
			</div>
			<div class="tdb-form-band__form"><?php echo $glass; // phpcs:ignore ?></div>
		</div>
	</section>
	<?php endif; ?>

	<?php $dash_tabs = $f( 'lp_dash_tabs', array() ); ?>
	<?php if ( $dash_tabs ) : ?>
	<section class="lqd-section tdb-dash-section py-75">
		<div class="container">
			<?php if ( $f( 'lp_dash_heading' ) ) : ?>
				<div class="tdb-lp-head">
					<h2><?php echo esc_html( $f( 'lp_dash_heading' ) ); ?></h2>
					<?php if ( $f( 'lp_dash_text' ) ) : ?><p><?php echo esc_html( $f( 'lp_dash_text' ) ); ?></p><?php endif; ?>
				</div>
			<?php endif; ?>

			<div class="tdb-dash" data-tdb-tabs>
				<div class="tdb-dash__tabs" role="tablist">
					<?php foreach ( $dash_tabs as $ti => $tab ) : ?>
						<button type="button" role="tab" id="tdb-dash-tab-<?php echo (int) $ti; ?>" aria-controls="tdb-dash-panel-<?php echo (int) $ti; ?>" aria-selected="<?php echo 0 === $ti ? 'true' : 'false'; ?>"<?php echo 0 === $ti ? '' : ' tabindex="-1"'; ?>><?php echo esc_html( $tab['label'] ); ?></button>
					<?php endforeach; ?>
				</div>

				<?php foreach ( $dash_tabs as $ti => $tab ) : ?>
				<div class="tdb-dash__panel" role="tabpanel" id="tdb-dash-panel-<?php echo (int) $ti; ?>" aria-labelledby="tdb-dash-tab-<?php echo (int) $ti; ?>"<?php echo 0 === $ti ? '' : ' hidden'; ?>>
					<?php if ( ! empty( $tab['kpis'] ) ) : ?>
					<div class="tdb-kpis">
						<?php foreach ( $tab['kpis'] as $ki => $kpi ) :
							$up = ( 'down' !== $kpi['trend'] );
							// Deterministic little trend line for the sparkline.
							$pts = array();
							for ( $p = 0; $p <= 8; $p++ ) {
								$base  = $up ? 52 - $p * 5.2 : 10 + $p * 5.2;
								$wiggle = sin( ( $p + $ki * 2 ) * 1.7 ) * 3;
								$pts[] = round( $p * 25, 1 ) . ',' . round( $base + $wiggle, 1 );
							}
							$line = 'M' . implode( ' L', $pts );
							$last = explode( ',', end( $pts ) );
							?>
							<div class="tdb-kpi tdb-kpi--<?php echo $up ? 'up' : 'down'; ?>">
								<p class="tdb-kpi__label"><?php echo esc_html( $kpi['label'] ); ?></p>
								<p class="tdb-kpi__value"><?php echo esc_html( $kpi['value'] ); ?></p>
								<?php if ( $kpi['note'] ) : ?><p class="tdb-kpi__note"><?php echo $up ? '&uarr;' : '&darr;'; ?> <?php echo esc_html( $kpi['note'] ); ?></p><?php endif; ?>
								<svg class="tdb-kpi__spark" viewBox="0 0 200 64" preserveAspectRatio="none" aria-hidden="true">
									<path class="tdb-kpi__area" d="<?php echo esc_attr( $line . ' L200,64 L0,64 Z' ); ?>"/>
									<path class="tdb-kpi__line" d="<?php echo esc_attr( $line ); ?>"/>
									<circle cx="<?php echo esc_attr( $last[0] ); ?>" cy="<?php echo esc_attr( $last[1] ); ?>" r="3.5"/>
								</svg>
							</div>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>

					<?php if ( ! empty( $tab['rows'] ) ) : ?>
					<div class="tdb-dash__table-wrap">
						<table class="tdb-dash__table">
							<thead><tr><th scope="col">Task</th><th scope="col">Run by</th><th scope="col">Model</th><th scope="col">Eval</th><th scope="col">Cost</th></tr></thead>
							<tbody>
								<?php foreach ( $tab['rows'] as $row ) :
									$running = ( false !== stripos( (string) $row['status'], 'running' ) );
									?>
									<tr<?php echo $running ? ' class="is-running"' : ''; ?>>
										<td><?php echo esc_html( $row['task'] ); ?></td>
										<td><span class="tdb-dash__agent"><span class="tdb-dash__avatar" aria-hidden="true"><?php echo esc_html( mb_substr( $row['agent'], 0, 1 ) ); ?></span><?php echo esc_html( $row['agent'] ); ?></span></td>
										<td class="tdb-dash__muted"><?php echo esc_html( $row['model'] ); ?></td>
										<td><span class="tdb-dash__status<?php echo $running ? ' is-running' : ''; ?>"><?php echo esc_html( $row['status'] ); ?></span></td>
										<td><?php echo esc_html( $row['cost'] ); ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<?php endif; ?>
				</div>
				<?php endforeach; ?>
				<?php if ( $f( 'lp_dash_note' ) ) : ?><p class="tdb-dash__note"><?php echo esc_html( $f( 'lp_dash_note' ) ); ?></p><?php endif; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php $steps = $f( 'lp_steps', array() ); ?>
	<?php if ( $steps ) : ?>
	<section class="lqd-section tdb-lp-steps py-75">
		<div class="container">
			<div class="tdb-lp-head">
				<h2><?php echo esc_html( $f( 'lp_steps_heading', __( 'How we work', 'ace' ) ) ); ?></h2>
			</div>
			<ol class="tdb-steps">
				<?php foreach ( $steps as $i => $step ) : ?>
					<li class="tdb-step">
						<span class="tdb-step__num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
						<h3><?php echo esc_html( $step['title'] ); ?></h3>
						<p><?php echo esc_html( $step['text'] ); ?></p>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>
	<?php endif; ?>

	<?php include locate_template( 'inc/stats.php' ); ?>

	<?php $faqs = $f( 'lp_faq', array() ); ?>
	<?php if ( $faqs ) : ?>
	<section class="lqd-section py-75 faq tdb-lp-faq">
		<div class="container">
			<div class="tdb-lp-head">
				<h2><?php esc_html_e( 'Frequently asked questions', 'ace' ); ?></h2>
			</div>
			<ul class="faq-list list-unstyled">
				<?php foreach ( $faqs as $faq ) : ?>
					<li>
						<div class="question"><?php echo esc_html( $faq['question'] ); ?></div>
						<div class="answer"><?php echo wp_kses_post( wpautop( $faq['answer'] ) ); ?></div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<script type="application/ld+json"><?php
		echo wp_json_encode( array(
			'@context'   => 'https://schema.org',
			'@type'      => 'FAQPage',
			'mainEntity' => array_map( function ( $faq ) {
				return array(
					'@type'          => 'Question',
					'name'           => wp_strip_all_tags( $faq['question'] ),
					'acceptedAnswer' => array( '@type' => 'Answer', 'text' => wp_strip_all_tags( $faq['answer'] ) ),
				);
			}, $faqs ),
		) );
	?></script>
	<?php endif; ?>

	<?php
	// Related AI pages (other published pages on this template) for internal linking.
	$related = get_posts( array(
		'post_type'      => 'page',
		'post_status'    => 'publish',
		'posts_per_page' => 6,
		'post__not_in'   => array( get_the_ID() ),
		'meta_key'       => '_wp_page_template',
		'meta_value'     => 'landing-template.php',
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
	) );
	?>
	<?php if ( $related ) : ?>
	<section class="lqd-section tdb-related py-75">
		<div class="container">
			<div class="tdb-lp-head"><h2><?php esc_html_e( 'Explore more AI services', 'ace' ); ?></h2></div>
			<ul class="tdb-related__list">
				<?php foreach ( $related as $rel ) : ?>
					<li>
						<a href="<?php echo esc_url( get_permalink( $rel ) ); ?>">
							<span class="tdb-related__title"><?php echo esc_html( get_the_title( $rel ) ); ?></span>
							<?php if ( has_excerpt( $rel ) ) : ?><span class="tdb-related__text"><?php echo esc_html( get_the_excerpt( $rel ) ); ?></span><?php endif; ?>
							<span class="tdb-related__arrow" aria-hidden="true">&rarr;</span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php endif; ?>

	<script type="application/ld+json"><?php
		// Describe this page as a Service offered by the company (helps rich results).
		echo wp_json_encode( array(
			'@context'    => 'https://schema.org',
			'@type'       => 'Service',
			'name'        => wp_strip_all_tags( $title ),
			'description' => wp_strip_all_tags( $intro ? $intro : get_the_excerpt() ),
			'url'         => get_permalink(),
			'serviceType' => wp_strip_all_tags( $eyebrow ? $eyebrow : $title ),
			'provider'    => array( '@type' => 'Organization', 'name' => get_bloginfo( 'name' ), 'url' => home_url( '/' ) ),
		), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
	?></script>

	<?php include locate_template( 'inc/testimonials.php' ); ?>
	<?php include locate_template( 'inc/bottom-cta.php' ); ?>

<?php endwhile; ?>

<?php get_footer(); ?>
