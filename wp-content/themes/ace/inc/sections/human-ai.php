<?php
/** AI agents + human intelligence: who does what. */
$ace_ai = array( 'Repetitive work', 'Analysis', 'Monitoring', 'Testing', 'Documentation', 'Data processing', 'Recommendations', 'Workflow execution' );
$ace_hu = array( 'Strategic decisions', 'Approvals', 'Exceptions', 'Creativity', 'Accountability', 'Customer relationships' );
?>
<section class="tdb-human" aria-labelledby="tdb-human-title">
	<div class="container">
		<div class="tdb-lp-head">
			<h6 class="ld-fh-element">Human + AI</h6>
			<h2 id="tdb-human-title">AI agents + human intelligence</h2>
			<p>Our agents are built to take work off your team, not to replace it. People stay in control of what matters.</p>
		</div>
		<div class="tdb-human__split">
			<div class="tdb-human__col tdb-human__col--ai">
				<h3>AI handles</h3>
				<ul><?php foreach ( $ace_ai as $i => $x ) : ?><li style="--i: <?php echo (int) $i; ?>"><?php echo esc_html( $x ); ?></li><?php endforeach; ?></ul>
			</div>
			<div class="tdb-human__core" aria-hidden="true"><span>Together</span></div>
			<div class="tdb-human__col tdb-human__col--hu">
				<h3>Humans handle</h3>
				<ul><?php foreach ( $ace_hu as $i => $x ) : ?><li style="--i: <?php echo (int) $i; ?>"><?php echo esc_html( $x ); ?></li><?php endforeach; ?></ul>
			</div>
		</div>
	</div>
</section>
