<?php
/**
 * Homepage: about TechDotBit, with an animated "idea to production" build
 * pipeline instead of stock illustrations.
 */
require_once __DIR__ . '/helpers.php';
$ace_flow = array(
	array( 'Understand', 'Your process, users and goals' ),
	array( 'Design', 'Architecture, UX and AI approach' ),
	array( 'Build', 'Software, integrations and agents' ),
	array( 'Verify', 'Testing, evaluation and security' ),
	array( 'Run & improve', 'Monitoring, support and iteration' ),
);
?>
<section class="tdb-h tdb-about" aria-labelledby="tdb-about-title" data-tdb-inview>
	<div class="container">
		<div class="tdb-about__grid">
			<div class="tdb-about__copy">
				<p class="tdb-h__chip"><span></span><?php esc_html_e( 'About TechDotBit', 'ace' ); ?></p>
				<h2 id="tdb-about-title"><?php esc_html_e( 'An engineering company that builds intelligent software', 'ace' ); ?></h2>
				<p><?php esc_html_e( 'TechDotBit Private Limited is a software engineering company headquartered in Noida, India, with sales offices in Australia and Sweden. We help businesses use AI and modern software to work faster, make better decisions and serve customers better.', 'ace' ); ?></p>
				<p><?php esc_html_e( 'Our teams combine product thinking, engineering discipline and applied AI. We also build our own products, so we know what it takes to run software in production, not just ship it.', 'ace' ); ?></p>
				<ul class="tdb-about__facts">
					<li><b><?php esc_html_e( 'Noida, India', 'ace' ); ?></b><span><?php esc_html_e( 'Headquarters and engineering', 'ace' ); ?></span></li>
					<li><b><?php esc_html_e( 'Australia · Sweden', 'ace' ); ?></b><span><?php esc_html_e( 'Sales offices', 'ace' ); ?></span></li>
					<li><b><?php esc_html_e( 'AI + software', 'ace' ); ?></b><span><?php esc_html_e( 'Services and our own products', 'ace' ); ?></span></li>
				</ul>
				<a class="tdb-h__link" href="<?php echo esc_url( ace_page_url( 'about-us', ace_page_url( 'about' ) ) ); ?>"><?php esc_html_e( 'More about us', 'ace' ); ?> <span aria-hidden="true">&rarr;</span></a>
			</div>
			<div class="tdb-about__visual" aria-hidden="true">
				<div class="tdb-about__board">
					<p class="tdb-about__board-title"><span></span><?php esc_html_e( 'How we deliver', 'ace' ); ?></p>
					<ol class="tdb-about__flow">
						<?php foreach ( $ace_flow as $ace_i => $ace_f ) : ?>
							<li style="--i: <?php echo (int) $ace_i; ?>">
								<span class="tdb-about__dot"><?php echo esc_html( $ace_i + 1 ); ?></span>
								<span><b><?php echo esc_html( $ace_f[0] ); ?></b><small><?php echo esc_html( $ace_f[1] ); ?></small></span>
							</li>
						<?php endforeach; ?>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>
