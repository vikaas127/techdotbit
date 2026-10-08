<?php
/**
 * "What can an AI agent actually do?" Prompt -> agent workflow chains that
 * reveal step by step when scrolled into view.
 */
$ace_cases = array(
	array( 'Monitor my inventory.', 'Inventory Agent', array( 'Analyse inventory', 'Identify low stock', 'Check open purchase orders', 'Analyse sales demand', 'Recommend purchase', 'Request approval' ) ),
	array( 'Test the latest application release.', 'QA Agent', array( 'Read requirements', 'Create test cases', 'Execute tests', 'Identify defects', 'Re-test fixes', 'Generate QA report' ) ),
	array( "Prepare this month's business report.", 'Reporting Agent', array( 'Collect data', 'Analyse', 'Compare with last month', 'Identify anomalies', 'Generate report', 'Send to management' ) ),
	array( 'Plan production for this week’s orders.', 'Manufacturing Agent', array( 'Read confirmed sales orders', 'Check raw material stock', 'Raise purchase for shortages', 'Schedule machines and shifts', 'Track work in progress', 'Plan dispatch' ) ),
);
?>
<section class="tdb-cases" aria-labelledby="tdb-cases-title">
	<div class="container">
		<div class="tdb-lp-head">
			<h6 class="ld-fh-element">Use cases</h6>
			<h2 id="tdb-cases-title">What can an AI agent actually do?</h2>
			<p>You give the instruction in plain language. The agent does the work across your systems and reports back.</p>
		</div>
		<div class="tdb-cases__grid">
			<?php foreach ( $ace_cases as $case ) : ?>
				<article class="tdb-case" data-tdb-reveal-chain>
					<p class="tdb-case__prompt"><span>You</span>&ldquo;<?php echo esc_html( $case[0] ); ?>&rdquo;</p>
					<p class="tdb-case__agent"><span aria-hidden="true">&#9679;</span> <?php echo esc_html( $case[1] ); ?></p>
					<ol class="tdb-case__chain">
						<?php foreach ( $case[2] as $i => $step ) : ?>
							<li style="--i: <?php echo (int) $i; ?>"><?php echo esc_html( $step ); ?></li>
						<?php endforeach; ?>
					</ol>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
