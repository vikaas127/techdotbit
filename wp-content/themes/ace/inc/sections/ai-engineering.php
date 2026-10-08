<?php
/** AI Engineering: custom development with AI at the centre. */
$ace_eng = array( 'AI application development', 'Generative AI', 'AI agents', 'Agentic workflows', 'LLM integration', 'RAG systems', 'AI automation', 'Machine learning', 'Computer vision', 'Natural language processing', 'AI-powered analytics', 'AI integration with existing software', 'Enterprise AI systems', 'AI infrastructure', 'Web & mobile apps', 'ERP & CRM development' );
?>
<section class="tdb-eng" aria-labelledby="tdb-eng-title">
	<div class="container">
		<div class="tdb-lp-head">
			<h6 class="ld-fh-element">AI Engineering</h6>
			<h2 id="tdb-eng-title">AI + software + ERP + business process knowledge</h2>
			<p>We still build great software. The difference is that AI sits at the centre of everything we design.</p>
		</div>
		<ul class="tdb-eng__grid">
			<?php foreach ( $ace_eng as $i => $e ) : ?><li style="--i: <?php echo (int) $i; ?>"><?php echo esc_html( $e ); ?></li><?php endforeach; ?>
		</ul>
		<div class="tdb-eng__callout">
			<p><b>Have an existing ERP, CRM, website or internal application?</b> We can add intelligence to it, without rebuilding what already works.</p>
			<a class="tdb-btn tdb-btn--primary" href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>">Talk to an engineer</a>
		</div>
	</div>
</section>
