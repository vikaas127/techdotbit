<?php
/**
 * Full Agent Library: every category and agent with what it does.
 */
require_once __DIR__ . '/ai-agents-data.php';
$ace_cats = ace_ai_agents();
?>
<section class="tdb-library" aria-labelledby="tdb-library-title">
	<div class="container">
		<div class="tdb-lp-head">
			<h6 class="ld-fh-element"><?php esc_html_e( 'Agent library', 'ace' ); ?></h6>
			<h2 id="tdb-library-title"><?php esc_html_e( 'Meet the agents', 'ace' ); ?></h2>
			<p><?php esc_html_e( 'Each agent is configured for your business: its role, knowledge, tools, permissions and approval rules.', 'ace' ); ?></p>
		</div>
		<nav class="tdb-library__nav" aria-label="<?php esc_attr_e( 'Agent categories', 'ace' ); ?>">
			<?php foreach ( $ace_cats as $key => $cat ) : ?>
				<a href="#<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $cat['title'] ); ?> <span><?php echo count( $cat['agents'] ); ?></span></a>
			<?php endforeach; ?>
		</nav>

		<?php foreach ( $ace_cats as $key => $cat ) : ?>
			<div class="tdb-library__cat" id="<?php echo esc_attr( $key ); ?>">
				<div class="tdb-library__cat-head">
					<span class="tdb-build__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?php echo $cat['icon']; // phpcs:ignore -- static ?></svg></span>
					<div>
						<h3><?php echo esc_html( $cat['title'] ); ?></h3>
						<p><?php echo esc_html( $cat['intro'] ); ?></p>
					</div>
				</div>
				<?php if ( ! empty( $cat['flow'] ) ) : ?>
					<div class="tdb-library__industry">
						<p class="tdb-flow" aria-label="<?php esc_attr_e( 'Manufacturing flow', 'ace' ); ?>">
							<?php foreach ( $cat['flow'] as $fi => $f ) : ?><span style="--i: <?php echo (int) $fi; ?>"><?php echo esc_html( $f ); ?></span><?php endforeach; ?>
						</p>
						<p class="tdb-library__industries"><b><?php esc_html_e( 'Built for:', 'ace' ); ?></b> <?php echo esc_html( implode( ' · ', $cat['industries'] ) ); ?></p>
					</div>
				<?php endif; ?>
				<div class="tdb-library__grid">
					<?php foreach ( $cat['agents'] as $agent ) : ?>
						<article class="tdb-agent-card">
							<header>
								<span class="tdb-agent-card__avatar" aria-hidden="true"><?php echo esc_html( mb_substr( $agent[0], 0, 1 ) ); ?></span>
								<div>
									<h4><?php echo esc_html( $agent[0] ); ?></h4>
									<p><?php echo esc_html( $agent[1] ); ?></p>
								</div>
							</header>
							<ul>
								<?php foreach ( $agent[2] as $duty ) : ?>
									<li><?php echo esc_html( $duty ); ?></li>
								<?php endforeach; ?>
							</ul>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
