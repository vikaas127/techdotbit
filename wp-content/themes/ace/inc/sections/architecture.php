<?php
/** Layered AI agent architecture with data packets flowing through the layers. */
$ace_layers = array(
	array( 'User / Business', 'Requests, events and schedules from your teams and systems.', array() ),
	array( 'AI Orchestration Layer', 'Routes each task, manages context, memory and model selection.', array() ),
	array( 'Agent Layer', 'Specialist agents that collaborate on the task.', array( 'Planning Agent', 'Reasoning Agent', 'Execution Agent', 'Verification Agent' ) ),
	array( 'Tools & Integrations', 'Secure connectors to the systems where work happens.', array( 'ERP', 'CRM', 'APIs', 'Database', 'Email', 'Documents', 'Web', 'Internal systems' ) ),
	array( 'Knowledge Layer', 'What the agents know about your business.', array( 'Company knowledge', 'SOPs', 'Documents', 'Policies', 'Historical data' ) ),
	array( 'Security & Governance', 'Controls that wrap every layer.', array( 'Authentication', 'Permissions', 'Audit logs', 'Human approval', 'Data security' ) ),
);
?>
<section class="tdb-arch" aria-labelledby="tdb-arch-title">
	<div class="container tdb-arch__inner">
		<div class="tdb-arch__copy">
			<p class="tdb-chip"><span></span>Architecture</p>
			<h2 id="tdb-arch-title">Our AI agent architecture</h2>
			<p>For enterprise teams who want to know exactly how it works: every agent runs inside a layered architecture with orchestration, specialist agents, secure integrations, your company knowledge and governance around everything.</p>
			<ul class="tdb-arch__points">
				<li>Model-agnostic: GPT, Claude, Gemini, Llama and private models</li>
				<li>Deploy in our cloud, your cloud or on-premise</li>
				<li>Every action logged and traceable</li>
			</ul>
		</div>
		<ol class="tdb-arch__stack" aria-label="Architecture layers">
			<?php foreach ( $ace_layers as $i => $layer ) : ?>
				<li class="tdb-arch__layer tdb-arch__layer--<?php echo (int) $i; ?>" style="--i: <?php echo (int) $i; ?>">
					<div class="tdb-arch__head"><b><?php echo esc_html( $layer[0] ); ?></b><span><?php echo esc_html( $layer[1] ); ?></span></div>
					<?php if ( $layer[2] ) : ?>
						<p class="tdb-arch__chips"><?php foreach ( $layer[2] as $c ) : ?><span><?php echo esc_html( $c ); ?></span><?php endforeach; ?></p>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
			<li class="tdb-arch__packets" aria-hidden="true"><i></i><i></i><i></i></li>
		</ol>
	</div>
</section>
