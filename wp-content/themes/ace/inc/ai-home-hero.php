<?php
/**
 * Homepage AI hero: headline + CTAs on the left, animated 3D visual with
 * floating "proof" cards on the right. Editable via "Homepage: AI hero".
 */
$hf = function ( $name, $default = '' ) {
	$v = function_exists( 'get_field' ) ? get_field( $name ) : '';
	return ( '' === $v || null === $v || false === $v || array() === $v ) ? $default : $v;
};
$hub     = get_page_by_path( 'ai-services' );
$hub_url = $hub && 'publish' === $hub->post_status ? get_permalink( $hub ) : home_url( '/contact-us/' );
$audit   = get_page_by_path( 'ai-services/ai-readiness-assessment' );

$eyebrow = $hf( 'home_eyebrow', __( 'AI-first software engineering', 'ace' ) );
$title   = $hf( 'home_title', __( 'AI agents and AI-driven software that move your business forward', 'ace' ) );
$hl      = $hf( 'home_highlight', __( 'AI-driven software', 'ace' ) );
$intro   = $hf( 'home_intro', __( 'TechDotBit designs, builds and runs AI agents, AI-led software and intelligent automation, from the first idea to secure, monitored production systems.', 'ace' ) );
$cta1    = $hf( 'home_cta1_label', __( 'Get a free AI assessment', 'ace' ) );
$cta1url = $hf( 'home_cta1_url', $audit && 'publish' === $audit->post_status ? get_permalink( $audit ) : home_url( '/contact-us/' ) );
$cta2    = $hf( 'home_cta2_label', __( 'Explore AI services', 'ace' ) );
$cta2url = $hf( 'home_cta2_url', $hub_url );
$proof   = $hf( 'home_proof', array(
	array( 'value' => __( 'Up to 40%', 'ace' ), 'label' => __( 'faster feature delivery', 'ace' ) ),
	array( 'value' => '99.9%', 'label' => __( 'uptime with self-healing AIOps', 'ace' ) ),
	array( 'value' => __( 'Near-zero', 'ace' ), 'label' => __( 'defect releases with agentic QA', 'ace' ) ),
) );

$h1 = esc_html( $title );
if ( $hl && false !== strpos( $title, $hl ) ) {
	$h1 = str_replace( esc_html( $hl ), '<span class="tdb-hl tdb-hl--dark">' . esc_html( $hl ) . '</span>', $h1 );
}
?>
<section class="tdb-hero tdb-hero--home" aria-labelledby="tdb-hero-title">
	<div class="tdb-hero__visual" aria-hidden="true"><canvas class="tdb-orb"></canvas></div>
	<div class="container tdb-hero__inner">
		<div class="tdb-hero__copy">
			<?php if ( $eyebrow ) : ?><p class="tdb-chip"><span></span><?php echo esc_html( $eyebrow ); ?></p><?php endif; ?>
			<h1 id="tdb-hero-title" class="tdb-hero__title"><?php echo $h1; // phpcs:ignore -- escaped above ?></h1>
			<?php if ( $intro ) : ?><p class="tdb-hero__intro"><?php echo esc_html( $intro ); ?></p><?php endif; ?>
			<div class="tdb-hero__actions">
				<a class="tdb-btn tdb-btn--primary" href="<?php echo esc_url( $cta1url ); ?>"><?php echo esc_html( $cta1 ); ?></a>
				<?php if ( $cta2 ) : ?><a class="tdb-btn tdb-btn--glass" href="<?php echo esc_url( $cta2url ); ?>"><?php echo esc_html( $cta2 ); ?> <span aria-hidden="true">&rarr;</span></a><?php endif; ?>
			</div>
		</div>
		<?php if ( $proof ) : ?>
		<ul class="tdb-proof" aria-label="<?php esc_attr_e( 'Results', 'ace' ); ?>">
			<?php foreach ( $proof as $i => $card ) : ?>
				<li class="tdb-proof__card" style="--i: <?php echo (int) $i; ?>">
					<strong><?php echo esc_html( $card['value'] ); ?></strong>
					<span><?php echo esc_html( $card['label'] ); ?></span>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php endif; ?>
	</div>
</section>
