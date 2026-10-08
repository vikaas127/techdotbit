<?php
/**
 * Homepage: industry expertise (technology we build for each industry).
 */
require_once __DIR__ . '/helpers.php';
$ace_inds = array(
	array( 'Manufacturing', 'Production tracking, quality systems, shop-floor apps and AI for planning.', '<path d="M3 21V9l6 4V9l6 4V5h6v16H3Z"/>' ),
	array( 'Healthcare', 'Patient apps, clinic workflows and secure AI for documents and triage.', '<path d="M12 21s-7-4.4-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 11c0 5.6-7 10-7 10Z"/><path d="M12 9v5M9.5 11.5h5"/>' ),
	array( 'Retail & e-commerce', 'Storefronts, order and inventory systems, recommendations and support bots.', '<path d="M4 7h16l-1.5 9h-13L4 7Z"/><circle cx="9" cy="20" r="1"/><circle cx="16" cy="20" r="1"/><path d="M8 7V5a4 4 0 0 1 8 0v2"/>' ),
	array( 'FMCG & distribution', 'Sales-force apps, distributor portals, demand forecasting and route planning.', '<rect x="3" y="8" width="13" height="10" rx="1"/><path d="M16 11h3l2 3v4h-5M7 21a2 2 0 1 0 0-4 2 2 0 0 0 0 4ZM18 21a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>' ),
	array( 'Fintech', 'Secure platforms, onboarding and KYC flows, fraud signals and reporting.', '<rect x="3" y="6" width="18" height="13" rx="2"/><path d="M3 10h18M7 15h4"/>' ),
	array( 'Logistics', 'Fleet tracking, dispatch tools, proof of delivery and ETA prediction.', '<path d="M12 21s-6-5.4-6-11a6 6 0 0 1 12 0c0 5.6-6 11-6 11Z"/><circle cx="12" cy="10" r="2.2"/>' ),
	array( 'Education', 'Learning platforms, admin systems and AI tutors that support teachers.', '<path d="m2 9 10-5 10 5-10 5L2 9Z"/><path d="M6 11v5c3 2 9 2 12 0v-5"/>' ),
	array( 'Professional services', 'Project, time and billing systems plus AI for proposals and reports.', '<rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>' ),
);
?>
<section class="tdb-h tdb-inds" aria-labelledby="tdb-inds-title" data-tdb-inview>
	<div class="container">
		<div class="tdb-inds__top">
			<div class="tdb-h__head tdb-h__head--left">
				<p class="tdb-h__chip"><span></span><?php esc_html_e( 'Industries', 'ace' ); ?></p>
				<h2 id="tdb-inds-title"><?php esc_html_e( 'Technology for real-world industries', 'ace' ); ?></h2>
			</div>
			<p class="tdb-inds__intro"><?php esc_html_e( 'Good software starts with understanding the business. We bring industry context to every AI and software project, so solutions fit how work is really done.', 'ace' ); ?></p>
		</div>
		<div class="tdb-inds__grid">
			<?php foreach ( $ace_inds as $ace_i => $ace_ind ) : ?>
				<div class="tdb-inds__item" style="--i: <?php echo (int) $ace_i; ?>">
					<span class="tdb-inds__icon" aria-hidden="true"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><?php echo $ace_ind[2]; // phpcs:ignore -- static ?></svg></span>
					<h3><?php echo esc_html( $ace_ind[0] ); ?></h3>
					<p><?php echo esc_html( $ace_ind[1] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="tdb-h__actions">
			<a class="tdb-h__link" href="<?php echo esc_url( ace_page_url( 'industries' ) ); ?>"><?php esc_html_e( 'See all industries', 'ace' ); ?> <span aria-hidden="true">&rarr;</span></a>
		</div>
	</div>
</section>
