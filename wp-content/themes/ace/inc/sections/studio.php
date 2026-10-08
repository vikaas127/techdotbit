<?php
/** TechDotBit AI Agent Studio: lifecycle + an animated agent configuration panel. */
$ace_life = array( 'Build', 'Configure', 'Connect', 'Test', 'Deploy', 'Monitor' );
$ace_conf = array(
	array( 'Role', 'Inventory Agent' ),
	array( 'Objective', 'Prevent stock-outs and excess stock' ),
	array( 'Knowledge', 'SOPs, item master, vendor lead times' ),
	array( 'Tools', 'ERP, Email, Purchase module' ),
	array( 'Permissions', 'Read stock · Draft purchase orders' ),
	array( 'Memory', 'Past orders and seasonality' ),
	array( 'Rules', 'Reorder level · Budget limits' ),
	array( 'Workflow', 'Daily at 9:00 and on low-stock events' ),
	array( 'Approval', 'Purchase manager approves POs' ),
	array( 'Monitoring', 'Accuracy, savings and exceptions' ),
);
?>
<section class="tdb-studio" aria-labelledby="tdb-studio-title">
	<div class="container tdb-studio__inner">
		<div>
			<p class="tdb-chip"><span></span>TechDotBit AI Agent Studio</p>
			<h2 id="tdb-studio-title">Build, configure and run agents like real team members</h2>
			<p>Our internal platform for creating dependable agents: every agent has a defined role, knowledge, tools, permissions and approval rules, and is tested and monitored like production software.</p>
			<ol class="tdb-studio__life">
				<?php foreach ( $ace_life as $i => $l ) : ?><li style="--i: <?php echo (int) $i; ?>"><span><?php echo (int) $i + 1; ?></span><?php echo esc_html( $l ); ?></li><?php endforeach; ?>
			</ol>
		</div>
		<div class="tdb-studio__panel" aria-hidden="true">
			<div class="tdb-studio__bar"><span class="tdb-console__dots"><i></i><i></i><i></i></span><b>agent.config</b><em>Deployed</em></div>
			<dl>
				<?php foreach ( $ace_conf as $i => $c ) : ?>
					<div style="--i: <?php echo (int) $i; ?>"><dt><?php echo esc_html( $c[0] ); ?></dt><dd><?php echo esc_html( $c[1] ); ?></dd></div>
				<?php endforeach; ?>
			</dl>
		</div>
	</div>
</section>
