<?php
/**
 * Homepage "What we build": the four agent categories with their agents and
 * a link to the full Agent Library.
 */
require_once __DIR__ . '/ai-agents-data.php';
$ace_cats    = ace_ai_agents();
$ace_library = get_page_by_path( 'ai-services/ai-agent-library' );
$ace_lib_url = $ace_library && 'publish' === $ace_library->post_status ? get_permalink( $ace_library ) : '';
?>
<section class="tdb-build" aria-labelledby="tdb-build-title">
	<div class="container">
		<div class="tdb-lp-head">
			<h6 class="ld-fh-element"><?php esc_html_e( 'What we build', 'ace' ); ?></h6>
			<h2 id="tdb-build-title"><?php esc_html_e( 'AI agents for every part of your business', 'ace' ); ?></h2>
			<p><?php esc_html_e( 'Specialist agents that plan, test, sell, support, purchase, produce and report, each one connected to your systems and working under your rules.', 'ace' ); ?></p>
		</div>
		<div class="tdb-build__grid">
			<?php foreach ( $ace_cats as $key => $cat ) : ?>
				<article class="tdb-build__card">
					<span class="tdb-build__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?php echo $cat['icon']; // phpcs:ignore -- static ?></svg></span>
					<h3><?php echo esc_html( $cat['title'] ); ?></h3>
					<p><?php echo esc_html( $cat['intro'] ); ?></p>
					<ul class="tdb-build__agents">
						<?php foreach ( $cat['agents'] as $agent ) : ?>
							<li><b><?php echo esc_html( $agent[0] ); ?></b><span><?php echo esc_html( $agent[1] ); ?></span></li>
						<?php endforeach; ?>
					</ul>
					<?php if ( ! empty( $cat['flow'] ) ) : ?>
						<p class="tdb-flow" aria-label="<?php esc_attr_e( 'Manufacturing flow', 'ace' ); ?>">
							<?php foreach ( $cat['flow'] as $ace_fi => $ace_flow ) : ?><span style="--i: <?php echo (int) $ace_fi; ?>"><?php echo esc_html( $ace_flow ); ?></span><?php endforeach; ?>
						</p>
					<?php endif; ?>
					<?php if ( $ace_lib_url ) : ?>
						<a class="tdb-build__more" href="<?php echo esc_url( $ace_lib_url . '#' . $key ); ?>"><?php esc_html_e( 'See what these agents do', 'ace' ); ?> <span aria-hidden="true">&rarr;</span></a>
					<?php endif; ?>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
