<?php
/**
 * Homepage "AI services" grid, built automatically from the published pages
 * under /ai-services/ (each card links to its page).
 */
$ace_hub = get_page_by_path( 'ai-services' );
if ( ! $ace_hub || 'publish' !== $ace_hub->post_status ) {
	return;
}
$ace_ai_pages = get_pages( array( 'parent' => $ace_hub->ID, 'sort_column' => 'menu_order', 'post_status' => 'publish', 'number' => 9 ) );
if ( ! $ace_ai_pages ) {
	return;
}
$ace_icons = array(
	'<path d="m8 9-4 3 4 3M16 9l4 3-4 3M13.5 5l-3 14"/>',
	'<path d="M9 3h6M10 3v6L5 18a2 2 0 0 0 1.8 3h10.4A2 2 0 0 0 19 18l-5-9V3"/><path d="m9 15 2 2 4-4"/>',
	'<path d="M3 12h4l3-8 4 16 3-8h4"/>',
	'<path d="m12 3 9 5-9 5-9-5 9-5Z"/><path d="m3 13 9 5 9-5"/>',
	'<path d="M12 3 4 6v6c0 4.5 3.4 8.3 8 9 4.6-.7 8-4.5 8-9V6l-8-3Z"/><path d="m9 12 2 2 4-4"/>',
	'<path d="M12 3v4M12 17v4M3 12h4M17 12h4M6 6l2.5 2.5M15.5 15.5 18 18M6 18l2.5-2.5M15.5 8.5 18 6"/>',
);
$ace_heading = function_exists( 'get_field' ) && get_field( 'home_ai_grid_heading' ) ? get_field( 'home_ai_grid_heading' ) : __( 'AI services built for real business results', 'ace' );
?>
<section class="lqd-section services inner-services tdb-lp-cards tdb-home-ai" id="ai-services">
	<div class="container">
		<div class="tdb-lp-head">
			<h6 class="ld-fh-element"><?php esc_html_e( 'What we build with AI', 'ace' ); ?></h6>
			<h2><?php echo esc_html( $ace_heading ); ?></h2>
			<p><?php esc_html_e( 'From AI agents and automation to AI-led engineering, testing and operations.', 'ace' ); ?></p>
		</div>
		<div class="row">
			<?php foreach ( $ace_ai_pages as $i => $p ) : ?>
				<div class="col col-12 col-md-6 col-lg-4 mb-30">
					<div class="iconbox">
						<div class="iconbox-icon-wrap mb-1em"><span class="iconbox-icon-container"><svg class="tdb-line-icon" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?php echo $ace_icons[ $i % count( $ace_icons ) ]; // phpcs:ignore -- static ?></svg></span></div>
						<div class="contents">
							<h3><a href="<?php echo esc_url( get_permalink( $p ) ); ?>"><?php echo esc_html( get_the_title( $p ) ); ?></a></h3>
							<?php if ( has_excerpt( $p ) ) : ?><p><?php echo esc_html( get_the_excerpt( $p ) ); ?></p><?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<p class="tdb-home-ai__more"><a class="tdb-btn tdb-btn--glass" href="<?php echo esc_url( get_permalink( $ace_hub ) ); ?>"><?php esc_html_e( 'View all AI services', 'ace' ); ?> <span aria-hidden="true">&rarr;</span></a></p>
	</div>
</section>
