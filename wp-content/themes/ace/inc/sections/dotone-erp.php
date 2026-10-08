<?php
/**
 * AI + ERP: from AI agents to an AI-powered business operating system (DotOne).
 * Animation: a pulse travels along the ERP module track; agents attach below.
 */
$ace_modules = array( 'CRM', 'Sales', 'Purchase', 'Inventory', 'Manufacturing', 'Finance', 'HR', 'Analytics' );
$ace_erp_agents = array( 'Sales Agent', 'Inventory Agent', 'Purchase Agent', 'Production Agent', 'Finance Agent', 'CRM Agent', 'Reporting Agent' );
// Industry ERP pages (tools/create-erp-pages.php), linked when published.
$ace_erp_hub   = get_page_by_path( 'erp-software' );
$ace_erp_links = array();
if ( $ace_erp_hub && 'publish' === $ace_erp_hub->post_status ) {
	foreach ( array(
		'manufacturing-erp-software' => 'Manufacturing',
		'plywood-erp-software'       => 'Plywood',
		'adhesive-tape-erp-software' => 'Adhesive tape',
		'footwear-erp-software'      => 'Footwear',
		'laminate-erp-software'      => 'Laminates',
		'acp-erp-software'           => 'ACP',
		'steel-metal-erp-software'   => 'Steel & metal',
		'fmcg-erp-software'          => 'FMCG',
		'distribution-erp-software'  => 'Distribution',
		'service-business-erp-software' => 'Services',
	) as $ace_slug => $ace_label ) {
		$ace_pg = get_page_by_path( 'erp-software/' . $ace_slug );
		if ( $ace_pg && 'publish' === $ace_pg->post_status ) {
			$ace_erp_links[ $ace_label ] = get_permalink( $ace_pg );
		}
	}
}
?>
<?php ace_inline_css( 'erp-os.css' ); ?>
<section class="tdb-eos" id="ai-erp" aria-labelledby="tdb-eos-title">
	<span class="tdb-eos__grid" aria-hidden="true"></span>
	<div class="container">
		<div class="tdb-eos__wrap">
			<div class="tdb-eos__copy">
				<p class="tdb-eos__chip"><span></span>AI + ERP</p>
				<h2 id="tdb-eos-title">An ERP that doesn't just record. <em>It acts.</em></h2>
				<div class="tdb-eos__compare">
					<div class="tdb-eos__row tdb-eos__row--old"><b>Traditional ERP</b><span>Records what happened</span></div>
					<div class="tdb-eos__row tdb-eos__row--new"><b>AI-powered ERP</b><span>Decides what's next and does the routine work</span></div>
				</div>
				<div class="tdb-eos__actions">
					<a class="tdb-eos__btn" href="https://dotone.biz/" target="_blank" rel="noopener">Explore DotOne <span aria-hidden="true">&nearr;</span></a>
					<a class="tdb-eos__btn tdb-eos__btn--ghost" href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>">Add AI to my ERP <span aria-hidden="true">&rarr;</span></a>
				</div>
				<?php if ( $ace_erp_links ) : ?>
					<nav class="tdb-eos__inds" aria-label="ERP software by industry">
						<span>ERP for</span>
						<?php foreach ( array_slice( $ace_erp_links, 0, 6, true ) as $ace_label => $ace_url ) : ?>
							<a href="<?php echo esc_url( $ace_url ); ?>"><?php echo esc_html( $ace_label ); ?></a>
						<?php endforeach; ?>
						<a class="tdb-eos__all" href="<?php echo esc_url( get_permalink( $ace_erp_hub ) ); ?>">All <span aria-hidden="true">&rarr;</span></a>
					</nav>
				<?php endif; ?>
			</div>

			<div class="tdb-eos__visual" aria-hidden="true">
				<span class="tdb-eos__orbit tdb-eos__orbit--outer"></span>
				<span class="tdb-eos__orbit tdb-eos__orbit--inner"></span>
				<?php foreach ( $ace_modules as $i => $m ) :
					$ang = deg2rad( -90 + $i * ( 360 / count( $ace_modules ) ) );
					$x   = 50 + 40 * cos( $ang );
					$y   = 50 + 40 * sin( $ang );
					?>
					<span class="tdb-eos__spoke" style="--a: <?php echo esc_attr( round( -90 + $i * ( 360 / count( $ace_modules ) ), 2 ) ); ?>deg; --i: <?php echo (int) $i; ?>"><i></i></span>
					<span class="tdb-eos__mod" style="left: <?php echo esc_attr( round( $x, 2 ) ); ?>%; top: <?php echo esc_attr( round( $y, 2 ) ); ?>%; --i: <?php echo (int) $i; ?>"><?php echo esc_html( $m ); ?></span>
				<?php endforeach; ?>
				<span class="tdb-eos__core">
					<span class="tdb-eos__pulse"></span><span class="tdb-eos__pulse tdb-eos__pulse--2"></span>
					<b>DotOne</b>
					<small>+ AI agents</small>
				</span>
				<div class="tdb-eos__agents">
					<?php foreach ( array_slice( $ace_erp_agents, 0, 4 ) as $i => $ag ) : ?>
						<span class="tdb-eos__agent" style="--i: <?php echo (int) $i; ?>"><i></i><?php echo esc_html( $ag ); ?></span>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>
