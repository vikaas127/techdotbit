<?php
/**
 * Homepage: why TechDotBit. Three overlapping circles (business understanding,
 * software engineering, applied AI) that slide together on scroll.
 */
$ace_why = array(
	array( 'Business understanding', 'Your process first.' ),
	array( 'Software engineering', 'Built to last.' ),
	array( 'Applied AI', 'Measured, under control.' ),
);
?>
<section class="tdb-h tdb-why" aria-labelledby="tdb-why-title" data-tdb-inview>
	<div class="container">
		<div class="tdb-why__grid">
			<div class="tdb-why__venn" aria-hidden="true">
				<span class="tdb-why__c tdb-why__c--1"><b><?php esc_html_e( 'Business', 'ace' ); ?></b></span>
				<span class="tdb-why__c tdb-why__c--2"><b><?php esc_html_e( 'Engineering', 'ace' ); ?></b></span>
				<span class="tdb-why__c tdb-why__c--3"><b><?php esc_html_e( 'AI', 'ace' ); ?></b></span>
				<span class="tdb-why__center">TechDotBit</span>
			</div>
			<div class="tdb-why__copy">
				<p class="tdb-h__chip"><span></span><?php esc_html_e( 'Why TechDotBit', 'ace' ); ?></p>
				<h2 id="tdb-why-title"><?php esc_html_e( 'Where business sense, engineering and AI meet', 'ace' ); ?></h2>
				<p class="tdb-why__lead"><?php esc_html_e( 'AI is easy to demo and hard to run well. We bring all three.', 'ace' ); ?></p>
				<ol class="tdb-why__list">
					<?php foreach ( $ace_why as $ace_i => $ace_w ) : ?>
						<li style="--i: <?php echo (int) $ace_i; ?>"><b><?php echo esc_html( $ace_w[0] ); ?></b><span><?php echo esc_html( $ace_w[1] ); ?></span></li>
					<?php endforeach; ?>
				</ol>
			</div>
		</div>
	</div>
</section>
