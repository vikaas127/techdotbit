<?php
/**
 * AI + ERP: from AI agents to an AI-powered business operating system (DotOne).
 * Animation: a pulse travels along the ERP module track; agents attach below.
 */
$ace_modules = array( 'CRM', 'Sales', 'Purchase', 'Inventory', 'Manufacturing', 'Finance', 'HR', 'Analytics' );
$ace_erp_agents = array( 'Sales Agent', 'Inventory Agent', 'Purchase Agent', 'Production Agent', 'Finance Agent', 'CRM Agent', 'Reporting Agent' );
?>
<section class="tdb-erp" id="ai-erp" aria-labelledby="tdb-erp-title">
	<div class="container">
		<div class="tdb-erp__top">
			<div>
				<p class="tdb-chip"><span></span>AI + ERP</p>
				<h2 id="tdb-erp-title">From AI agents to an AI-powered business operating system</h2>
			</div>
			<div class="tdb-erp__compare">
				<p><span class="tdb-erp__tag tdb-erp__tag--old">Traditional ERP</span> records what happened.</p>
				<p><span class="tdb-erp__tag">AI-powered ERP</span> helps decide what should happen next, and does the routine work.</p>
			</div>
		</div>

		<div class="tdb-erp__board">
			<div class="tdb-erp__brand">
				<strong>DotOne</strong>
				<span>The AI-powered ERP platform for modern businesses, built by TechDotBit.</span>
			</div>
			<ol class="tdb-erp__track" aria-label="DotOne ERP modules">
				<?php foreach ( $ace_modules as $i => $m ) : ?>
					<li style="--i: <?php echo (int) $i; ?>"><?php echo esc_html( $m ); ?></li>
				<?php endforeach; ?>
			</ol>
			<div class="tdb-erp__plus" aria-hidden="true"><span>+ AI Agents</span></div>
			<ul class="tdb-erp__agents">
				<?php foreach ( $ace_erp_agents as $i => $a ) : ?>
					<li style="--i: <?php echo (int) $i; ?>"><?php echo esc_html( $a ); ?></li>
				<?php endforeach; ?>
			</ul>
			<div class="tdb-erp__cta">
				<p>Already have an ERP, CRM or internal application? We can add AI agents to it, or move you to DotOne.</p>
				<a class="tdb-btn tdb-btn--primary" href="https://dotone.biz/" target="_blank" rel="noopener">Explore DotOne ERP</a>
				<a class="tdb-btn tdb-btn--glass" href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>">Add AI to my ERP <span aria-hidden="true">&rarr;</span></a>
			</div>
		</div>
	</div>
</section>
