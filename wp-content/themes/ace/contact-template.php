<?php
/* Template Name: Contact Template */

get_header();

$ace_title = __( 'Let\'s build something intelligent together', 'ace' );
if ( have_rows( 'banner' ) ) {
	while ( have_rows( 'banner' ) ) {
		the_row();
		if ( get_sub_field( 'title' ) && 'contact us' !== strtolower( trim( wp_strip_all_tags( get_sub_field( 'title' ) ) ) ) ) {
			$ace_title = wp_strip_all_tags( get_sub_field( 'title' ) );
		}
	}
}
$ace_phone    = get_field( 'phone' );
$ace_email    = get_field( 'email' );
$ace_address  = get_field( 'address' );
$ace_career   = get_page_by_path( 'career' );
$ace_icon     = function ( $path ) {
	return '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $path . '</svg>';
};
?>

<section class="tdb-contact-hero">
	<div class="container">
		<p class="tdb-contact__chip"><span></span><?php esc_html_e( 'Contact us', 'ace' ); ?></p>
		<h1><?php echo esc_html( $ace_title ); ?></h1>
		<p class="tdb-contact-hero__intro"><?php esc_html_e( 'Tell us what you want to build or improve, whether it is an AI agent, a custom application or an automation. We will reply with ideas and next steps.', 'ace' ); ?></p>
	</div>
</section>

<section class="tdb-contact">
	<div class="container">
		<div class="tdb-contact__grid">
			<aside class="tdb-contact__info">
				<div class="tdb-contact__card">
					<h2><?php esc_html_e( 'What happens next', 'ace' ); ?></h2>
					<ol class="tdb-contact__steps">
						<li><b><?php esc_html_e( 'We review your message', 'ace' ); ?></b><span><?php esc_html_e( 'An engineer, not a bot, reads what you need.', 'ace' ); ?></span></li>
						<li><b><?php esc_html_e( 'A short discovery call', 'ace' ); ?></b><span><?php esc_html_e( 'We ask the right questions and suggest an approach.', 'ace' ); ?></span></li>
						<li><b><?php esc_html_e( 'A clear proposal', 'ace' ); ?></b><span><?php esc_html_e( 'Scope, timeline and team, with no obligation.', 'ace' ); ?></span></li>
					</ol>
				</div>

				<div class="tdb-contact__methods">
					<?php if ( $ace_email ) : ?>
						<a class="tdb-contact__method" href="mailto:<?php echo esc_attr( $ace_email ); ?>">
							<span class="tdb-contact__icon"><?php echo $ace_icon( '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>' ); // phpcs:ignore ?></span>
							<span><small><?php esc_html_e( 'Email', 'ace' ); ?></small><b><?php echo esc_html( $ace_email ); ?></b></span>
						</a>
					<?php endif; ?>
					<?php if ( $ace_phone ) : ?>
						<a class="tdb-contact__method" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $ace_phone ) ); ?>">
							<span class="tdb-contact__icon"><?php echo $ace_icon( '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2Z"/>' ); // phpcs:ignore ?></span>
							<span><small><?php esc_html_e( 'Phone', 'ace' ); ?></small><b><?php echo esc_html( $ace_phone ); ?></b></span>
						</a>
					<?php endif; ?>
					<?php if ( $ace_address ) : ?>
						<div class="tdb-contact__method">
							<span class="tdb-contact__icon"><?php echo $ace_icon( '<path d="M12 21s-6-5.4-6-11a6 6 0 0 1 12 0c0 5.6-6 11-6 11Z"/><circle cx="12" cy="10" r="2.2"/>' ); // phpcs:ignore ?></span>
							<span><small><?php esc_html_e( 'Head office', 'ace' ); ?></small><b class="tdb-contact__address"><?php echo wp_kses_post( $ace_address ); ?></b></span>
						</div>
					<?php endif; ?>
				</div>

				<?php if ( have_rows( 'more_locations' ) ) : ?>
					<div class="tdb-contact__offices">
						<h3><?php esc_html_e( 'Other offices', 'ace' ); ?></h3>
						<?php while ( have_rows( 'more_locations' ) ) : the_row(); ?>
							<div class="tdb-contact__office">
								<b><?php echo esc_html( wp_strip_all_tags( get_sub_field( 'location' ) ) ); ?></b>
								<div><?php echo wp_kses_post( get_sub_field( 'address' ) ); ?></div>
								<?php if ( get_sub_field( 'phone' ) ) : ?><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', get_sub_field( 'phone' ) ) ); ?>"><?php echo esc_html( get_sub_field( 'phone' ) ); ?></a><?php endif; ?>
								<?php if ( get_sub_field( 'email' ) ) : ?><a href="mailto:<?php echo esc_attr( get_sub_field( 'email' ) ); ?>"><?php echo esc_html( get_sub_field( 'email' ) ); ?></a><?php endif; ?>
							</div>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>

				<?php if ( $ace_career ) : ?>
					<a class="tdb-contact__career" href="<?php echo esc_url( get_permalink( $ace_career ) ); ?>">
						<span><b><?php esc_html_e( 'Looking for a job?', 'ace' ); ?></b><small><?php esc_html_e( 'See open roles at TechDotBit', 'ace' ); ?></small></span>
						<span aria-hidden="true">&rarr;</span>
					</a>
				<?php endif; ?>
			</aside>

			<div class="tdb-contact__form">
				<h2><?php esc_html_e( 'Tell us about your project', 'ace' ); ?></h2>
				<p><?php esc_html_e( 'A few details help us prepare. Fields marked * are required.', 'ace' ); ?></p>
				<?php echo do_shortcode( '[contact-form-7 id="b3de3ca" title="Contact Us Form"]' ); ?>
				<p class="tdb-contact__secure"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2 4 5v6c0 5 3.4 9.4 8 11 4.6-1.6 8-6 8-11V5l-8-3Zm-1 14-4-4 1.4-1.4L11 13.2l4.6-4.6L17 10l-6 6Z"/></svg><?php esc_html_e( 'Your details are confidential. We can sign an NDA before you share specifics.', 'ace' ); ?></p>
			</div>
		</div>
	</div>
</section>

<?php include_once( 'inc/brands.php' ); ?>
<?php get_footer(); ?>
