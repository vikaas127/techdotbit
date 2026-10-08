<?php
/** AI solution demonstrations: problem -> AI solution -> agent workflow -> outcome (no invented clients). */
$ace_demos = array(
	array( 'Automating software quality testing', 'Regression testing before every release takes days of manual effort and still misses defects.', 'A QA Agent that reads requirements, generates and runs regression tests, and reports defects automatically.', array( 'Read requirements', 'Generate tests', 'Run regression', 'Log defects', 'Re-test', 'QA report' ), 'Faster, more consistent releases with a test report for every build.' ),
	array( 'Purchase planning in manufacturing', 'Purchase teams check stock, orders and demand in spreadsheets, so shortages are found too late.', 'An Inventory + Purchase Agent connected to the ERP that recommends orders before stock runs out.', array( 'Monitor stock', 'Forecast demand', 'Check open POs', 'Recommend order', 'Manager approval', 'Raise PO' ), 'Fewer stock-outs and less excess inventory, with every decision approved by a person.' ),
	array( 'Monthly management reporting', 'Finance spends days every month collecting data and building the same reports.', 'A Reporting Agent that collects ERP and CRM data, analyses variances and writes the report.', array( 'Collect data', 'Reconcile', 'Compare periods', 'Flag anomalies', 'Write report', 'Send to management' ), 'Reports ready on day one, with anomalies highlighted for review.' ),
);
?>
<section class="tdb-demos" aria-labelledby="tdb-demos-title">
	<div class="container">
		<div class="tdb-lp-head">
			<h6 class="ld-fh-element">AI solution demonstrations</h6>
			<h2 id="tdb-demos-title">Problem → AI solution → agent workflow → result</h2>
			<p>Representative solutions we design and build. Ask us for a live walkthrough.</p>
		</div>
		<div class="tdb-demos__list">
			<?php foreach ( $ace_demos as $d ) : ?>
				<article class="tdb-demo" data-tdb-reveal-chain>
					<h3><?php echo esc_html( $d[0] ); ?></h3>
					<div class="tdb-demo__cols">
						<div><span class="tdb-demo__label">Problem</span><p><?php echo esc_html( $d[1] ); ?></p></div>
						<div><span class="tdb-demo__label">AI solution</span><p><?php echo esc_html( $d[2] ); ?></p></div>
						<div class="tdb-demo__flow"><span class="tdb-demo__label">Agent workflow</span>
							<ol class="tdb-case__chain"><?php foreach ( $d[3] as $i => $s ) : ?><li style="--i: <?php echo (int) $i; ?>"><?php echo esc_html( $s ); ?></li><?php endforeach; ?></ol>
						</div>
						<div><span class="tdb-demo__label">Result</span><p><?php echo esc_html( $d[4] ); ?></p></div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
