<?php
/**
 * Homepage: a small "Our product" band for DotOne (the product has its own
 * website), plus a link to TechDotBit's ERP guides when they are published.
 */
require_once __DIR__ . '/helpers.php';
$ace_erp_hub = get_page_by_path( 'erp-software' );
?>
<section class="tdb-h tdb-prod" id="products" aria-labelledby="tdb-prod-title" data-tdb-inview>
	<div class="container">
		<div class="tdb-prod__card">
			<div class="tdb-prod__copy">
				<p class="tdb-prod__eyebrow"><?php esc_html_e( 'Our product · Built by TechDotBit', 'ace' ); ?></p>
				<h2 id="tdb-prod-title">DotOne</h2>
				<p><?php esc_html_e( 'Your business operations in one intelligent platform.', 'ace' ); ?></p>
				<div class="tdb-prod__actions">
					<a class="tdb-h__btn" href="https://dotone.biz/" target="_blank" rel="noopener"><?php esc_html_e( 'Visit DotOne', 'ace' ); ?> <span aria-hidden="true">&nearr;</span></a>
					<?php if ( $ace_erp_hub && 'publish' === $ace_erp_hub->post_status ) : ?>
						<a class="tdb-prod__link" href="<?php echo esc_url( get_permalink( $ace_erp_hub ) ); ?>"><?php esc_html_e( 'ERP software by industry', 'ace' ); ?> <span aria-hidden="true">&rarr;</span></a>
					<?php endif; ?>
				</div>
			</div>
			<div class="tdb-prod__visual" aria-hidden="true">
				<span class="tdb-prod__core">DotOne</span>
				<span class="tdb-prod__orbit"><i></i><i></i><i></i><i></i><i></i><i></i></span>
			</div>
		</div>
	</div>
</section>
