<?php
/** Before / after: a business without and with AI agents. */
$ace_before = array( 'Manual work', 'Employees search for data', 'Manual reports', 'Manual testing', 'Manual follow-ups', 'Delayed decisions' );
$ace_after  = array( 'AI agent receives the goal', 'Understands your data', 'Analyses', 'Makes recommendations', 'Executes actions', 'Verifies results', 'Reports automatically' );
?>
<section class="tdb-trans" aria-labelledby="tdb-trans-title">
	<div class="container">
		<div class="tdb-lp-head">
			<h6 class="ld-fh-element">AI transformation</h6>
			<h2 id="tdb-trans-title">Turn your existing business into an AI-powered business</h2>
			<p>Same people, same systems, a very different way of working.</p>
		</div>
		<div class="tdb-trans__grid">
			<div class="tdb-trans__col tdb-trans__col--before">
				<h3>Before</h3>
				<ol><?php foreach ( $ace_before as $i => $x ) : ?><li style="--i: <?php echo (int) $i; ?>"><?php echo esc_html( $x ); ?></li><?php endforeach; ?></ol>
			</div>
			<div class="tdb-trans__arrow" aria-hidden="true"><span>AI agents</span></div>
			<div class="tdb-trans__col tdb-trans__col--after">
				<h3>After</h3>
				<ol><?php foreach ( $ace_after as $i => $x ) : ?><li style="--i: <?php echo (int) $i; ?>"><?php echo esc_html( $x ); ?></li><?php endforeach; ?></ol>
			</div>
		</div>
	</div>
</section>
