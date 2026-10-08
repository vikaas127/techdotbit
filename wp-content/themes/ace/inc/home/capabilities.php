<?php
/**
 * Homepage: what TechDotBit does. A capability explorer: pick a capability
 * on the left, see what we deliver on the right (auto-advances; stacked on mobile).
 */
require_once __DIR__ . '/helpers.php';
$ace_caps = array(
	array(
		'name'  => 'AI solutions',
		'line'  => 'Copilots, smart search and prediction built into your products.',
		'text'  => 'We find where AI pays off in your business, then build it properly: grounded in your data, evaluated before launch and monitored after it.',
		'items' => array( 'LLM apps and copilots', 'RAG search over your documents', 'Forecasting and scoring models', 'Document and image understanding' ),
		'url'   => ace_page_url( 'ai-services' ),
		'icon'  => '<path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M5.6 18.4l2.1-2.1M16.3 7.7l2.1-2.1"/><circle cx="12" cy="12" r="3.5"/>',
	),
	array(
		'name'  => 'Custom software',
		'line'  => 'Web, mobile and business applications shaped around your process.',
		'text'  => 'Portals, internal tools, mobile apps and platforms engineered for your workflows, with clean architecture your team can own.',
		'items' => array( 'Web and mobile applications', 'Business and workflow systems', 'APIs and integrations', 'Modernisation of legacy software' ),
		'url'   => ace_page_url( 'ai-services/ai-led-software-development' ),
		'icon'  => '<rect x="3" y="4" width="18" height="14" rx="2"/><path d="m9 9-2.5 2.5L9 14M15 9l2.5 2.5L15 14M8 21h8"/>',
	),
	array(
		'name'  => 'Automation',
		'line'  => 'Connect your systems and remove repetitive work.',
		'text'  => 'We map the manual steps between your tools, then automate them with integrations, workflows and AI agents that hand exceptions to people.',
		'items' => array( 'Workflow and approval automation', 'System-to-system integrations', 'Document and data entry automation', 'AI agents for back-office tasks' ),
		'url'   => ace_page_url( 'ai-services/ai-workflow-automation' ),
		'icon'  => '<path d="M4 7h10M4 7l3-3M4 7l3 3M20 17H10M20 17l-3-3M20 17l-3 3"/>',
	),
	array(
		'name'  => 'Product engineering',
		'line'  => 'From first prototype to a product that scales.',
		'text'  => 'Discovery, UX, engineering, QA and cloud operations in one team, so ideas become reliable products and keep improving after launch.',
		'items' => array( 'Discovery, UX and prototypes', 'Full-stack product development', 'Agentic QA and test automation', 'Cloud, DevOps and AIOps' ),
		'url'   => ace_page_url( 'ai-services/ai-engineering', ace_page_url( 'ai-services' ) ),
		'icon'  => '<path d="M5 19c4-1 6-3 7-6l3-3a3 3 0 0 0-4-4l-3 3c-3 1-5 3-6 7l3 3Z"/><circle cx="15.5" cy="8.5" r="1.2"/><path d="M8 16l-2 2"/>',
	),
);
?>
<section class="tdb-h tdb-caps" aria-labelledby="tdb-caps-title" data-tdb-inview>
	<div class="container">
		<div class="tdb-h__head">
			<p class="tdb-h__chip"><span></span><?php esc_html_e( 'What we do', 'ace' ); ?></p>
			<h2 id="tdb-caps-title"><?php esc_html_e( 'From idea to intelligent software', 'ace' ); ?></h2>
			<p><?php esc_html_e( 'One engineering team for the AI, the software around it and the automation that ties it into your business.', 'ace' ); ?></p>
		</div>
		<div class="tdb-caps__wrap" data-tdb-caps>
			<div class="tdb-caps__list" role="tablist" aria-label="<?php esc_attr_e( 'Capabilities', 'ace' ); ?>">
				<?php foreach ( $ace_caps as $ace_i => $ace_c ) : ?>
					<button type="button" class="tdb-caps__tab" role="tab" id="tdb-cap-tab-<?php echo (int) $ace_i; ?>" aria-controls="tdb-cap-<?php echo (int) $ace_i; ?>" aria-selected="<?php echo 0 === $ace_i ? 'true' : 'false'; ?>">
						<span class="tdb-caps__icon" aria-hidden="true"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><?php echo $ace_c['icon']; // phpcs:ignore -- static ?></svg></span>
						<span><b><?php echo esc_html( $ace_c['name'] ); ?></b><small><?php echo esc_html( $ace_c['line'] ); ?></small></span>
						<i class="tdb-caps__bar" aria-hidden="true"></i>
					</button>
				<?php endforeach; ?>
			</div>
			<div class="tdb-caps__panels">
				<?php foreach ( $ace_caps as $ace_i => $ace_c ) : ?>
					<div class="tdb-caps__panel<?php echo 0 === $ace_i ? ' is-active' : ''; ?>" role="tabpanel" id="tdb-cap-<?php echo (int) $ace_i; ?>" aria-labelledby="tdb-cap-tab-<?php echo (int) $ace_i; ?>">
						<span class="tdb-caps__big-icon" aria-hidden="true"><svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><?php echo $ace_c['icon']; // phpcs:ignore -- static ?></svg></span>
						<h3><?php echo esc_html( $ace_c['name'] ); ?></h3>
						<p><?php echo esc_html( $ace_c['text'] ); ?></p>
						<ul>
							<?php foreach ( $ace_c['items'] as $ace_k => $ace_item ) : ?>
								<li style="--k: <?php echo (int) $ace_k; ?>"><?php echo esc_html( $ace_item ); ?></li>
							<?php endforeach; ?>
						</ul>
						<a class="tdb-h__link" href="<?php echo esc_url( $ace_c['url'] ); ?>"><?php echo esc_html( sprintf( __( 'Explore %s', 'ace' ), strtolower( $ace_c['name'] ) ) ); ?> <span aria-hidden="true">&rarr;</span></a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
