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

$eyebrow = $hf( 'home_eyebrow', __( 'AI & software engineering company', 'ace' ) );
$title   = $hf( 'home_title', __( 'AI-driven software that moves your business forward', 'ace' ) );
// Drop the old "AI agents and" opening if it is still saved in the field.
if ( 0 === stripos( $title, 'AI agents and ' ) ) {
	$title = preg_replace( '/\bmove your\b/', 'moves your', substr( $title, strlen( 'AI agents and ' ) ) );
}
$hl      = $hf( 'home_highlight', __( 'AI-driven software', 'ace' ) );
$intro   = $hf( 'home_intro', __( 'We design and build AI solutions, intelligent agents, automation and custom software around the way your business works, and keep them running reliably in production.', 'ace' ) );
$agents  = get_page_by_path( 'ai-services/ai-agent-development' );
$contact = get_page_by_path( 'contact-us' );
$cta1    = $hf( 'home_cta1_label', __( 'Start a project', 'ace' ) );
$cta1url = $hf( 'home_cta1_url', $contact ? get_permalink( $contact ) : home_url( '/contact-us/' ) );
$cta2    = $hf( 'home_cta2_label', __( 'See our work', 'ace' ) );
$cta2url = $hf( 'home_cta2_url', '#work' );
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
		<div class="tdb-console" aria-hidden="true" data-tdb-console>
			<div class="tdb-console__bar">
				<span class="tdb-console__dots"><i></i><i></i><i></i></span>
				<span class="tdb-console__title">TechDotBit Agent</span>
				<span class="tdb-console__live"><i></i>Live</span>
			</div>
			<div class="tdb-console__body">
				<div class="tdb-console__msg"><span class="tdb-console__you">You</span><span class="tdb-console__typed" data-text="Qualify today's inbound leads and update the CRM"></span></div>
				<ol class="tdb-console__steps">
					<li data-tool="crm"><span class="tdb-console__state"></span>Reading new inbound leads</li>
					<li data-tool="web"><span class="tdb-console__state"></span>Enriching with company data</li>
					<li data-tool="db"><span class="tdb-console__state"></span>Scoring against your ideal customer profile</li>
					<li data-tool="crm"><span class="tdb-console__state"></span>Updating CRM records</li>
					<li data-tool="mail"><span class="tdb-console__state"></span>Drafting follow-ups for hot leads</li>
				</ol>
				<div class="tdb-console__tools">
					<span data-tool="crm">CRM</span><span data-tool="web">Web search</span><span data-tool="db">Database</span><span data-tool="mail">Email</span>
				</div>
				<div class="tdb-console__done"><b>&#10003; Completed</b> &middot; 2 leads flagged for human review</div>
			</div>
		</div>
	</div>
	<?php if ( $proof ) : ?>
	<div class="container">
		<ul class="tdb-proof-row" aria-label="<?php esc_attr_e( 'Results', 'ace' ); ?>">
			<?php foreach ( $proof as $card ) : ?>
				<li><strong><?php echo esc_html( $card['value'] ); ?></strong><span><?php echo esc_html( $card['label'] ); ?></span></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php endif; ?>
</section>
