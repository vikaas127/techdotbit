<?php
/**
 * Homepage: industry expertise (technology we build for each industry).
 */
require_once __DIR__ . '/helpers.php';
$ace_inds = array(
	array( 'Healthcare', 'Patient apps, clinic and hospital systems, and secure AI for documents and triage.', '<path d="M12 21s-7-4.4-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 11c0 5.6-7 10-7 10Z"/><path d="M12 9v5M9.5 11.5h5"/>', 'healthcare-software-development' ),
	array( 'FinTech', 'Payments, lending and wealth platforms with KYC, fraud signals and reporting.', '<rect x="3" y="6" width="18" height="13" rx="2"/><path d="M3 10h18M7 15h4"/>', 'fintech-software-development' ),
	array( 'Logistics & Supply Chain', 'Fleet tracking, transport and warehouse systems, driver apps and ETA prediction.', '<rect x="3" y="8" width="13" height="10" rx="1"/><path d="M16 11h3l2 3v4h-5M7 21a2 2 0 1 0 0-4 2 2 0 0 0 0 4ZM18 21a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>', 'logistics-software-development' ),
	array( 'Manufacturing', 'Production tracking, quality systems, shop-floor apps and AI for planning.', '<path d="M3 21V9l6 4V9l6 4V5h6v16H3Z"/>', 'manufacturing-software-development' ),
	array( 'Automotive', 'Dealer, service and parts systems, telematics and connected-vehicle apps.', '<path d="M5 16h14M6 16l1.5-5h9L18 16"/><circle cx="8" cy="17.5" r="1.5"/><circle cx="16" cy="17.5" r="1.5"/>', 'automotive-software-development' ),
	array( 'Retail & eCommerce', 'Online stores, marketplaces, omnichannel inventory and AI shopping assistants.', '<path d="M4 7h16l-1.5 9h-13L4 7Z"/><circle cx="9" cy="20" r="1"/><circle cx="16" cy="20" r="1"/><path d="M8 7V5a4 4 0 0 1 8 0v2"/>', 'ecommerce-software-development' ),
	array( 'Real Estate', 'Property portals, sales CRM, bookings and property management.', '<path d="M3 11 12 4l9 7"/><path d="M5 10v10h14V10M10 20v-5h4v5"/>', 'real-estate-software-development' ),
	array( 'EdTech', 'Learning platforms, virtual classrooms, institution systems and AI tutors.', '<path d="m2 9 10-5 10 5-10 5L2 9Z"/><path d="M6 11v5c3 2 9 2 12 0v-5"/>', 'edtech-software-development' ),
	array( 'Travel & Hospitality', 'Booking engines, hotel and villa systems, tour platforms and guest apps.', '<path d="M2 16l20-6-3-3-6 2-5-5-2 1 3 6-4 1-2-2-1 1 2 4Z"/>', 'travel-software-development' ),
);
?>
<section class="tdb-h tdb-inds" aria-labelledby="tdb-inds-title" data-tdb-inview>
	<div class="container">
		<div class="tdb-inds__top">
			<div class="tdb-h__head tdb-h__head--left">
				<p class="tdb-h__chip"><span></span><?php esc_html_e( 'Industries', 'ace' ); ?></p>
				<h2 id="tdb-inds-title"><?php esc_html_e( 'Technology for real-world industries', 'ace' ); ?></h2>
			</div>
		</div>
		<div class="tdb-inds__grid">
			<?php foreach ( $ace_inds as $ace_i => $ace_ind ) : ?>
				<?php $ace_ind_url = ace_page_url( $ace_ind[3], '' ); $ace_has = false === strpos( $ace_ind_url, '/contact-us/' ); ?>
				<<?php echo $ace_has ? 'a href="' . esc_url( $ace_ind_url ) . '"' : 'div'; ?> class="tdb-inds__item" style="--i: <?php echo (int) $ace_i; ?>">
					<span class="tdb-inds__icon" aria-hidden="true"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><?php echo $ace_ind[2]; // phpcs:ignore -- static ?></svg></span>
					<h3><?php echo esc_html( $ace_ind[0] ); ?></h3>
					<p class="tdb-inds__hint"><?php echo esc_html( $ace_ind[1] ); ?></p>
				</<?php echo $ace_has ? 'a' : 'div'; ?>>
			<?php endforeach; ?>
		</div>
		<div class="tdb-h__actions">
			<a class="tdb-h__link" href="<?php echo esc_url( ace_page_url( 'industries' ) ); ?>"><?php esc_html_e( 'See all industries', 'ace' ); ?> <span aria-hidden="true">&rarr;</span></a>
		</div>
	</div>
</section>
