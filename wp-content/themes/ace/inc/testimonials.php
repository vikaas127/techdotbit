<?php
/**
 * Client testimonials: review cards in a swipeable carousel (3 visible on
 * desktop), with stars, quote, photo, name and role. Data: Theme Options >
 * Testimonials (heading, sub_heading, list: image, name, designation, feedback).
 */
if ( ! have_rows( 'testimonials', 'option' ) ) {
	return;
}
$ace_tst_heading = '';
$ace_tst_sub     = '';
$ace_tst_items   = array();
while ( have_rows( 'testimonials', 'option' ) ) {
	the_row();
	$ace_tst_heading = wp_strip_all_tags( (string) get_sub_field( 'heading' ) );
	$ace_tst_sub     = wp_strip_all_tags( (string) get_sub_field( 'sub_heading' ) );
	if ( have_rows( 'list', 'option' ) ) {
		while ( have_rows( 'list', 'option' ) ) {
			the_row();
			$ace_tst_items[] = array(
				'image' => get_sub_field( 'image' ),
				'name'  => wp_strip_all_tags( (string) get_sub_field( 'name' ) ),
				'role'  => wp_strip_all_tags( (string) get_sub_field( 'designation' ) ),
				'text'  => trim( wp_strip_all_tags( (string) get_sub_field( 'feedback' ) ), " \t\n\r\"“”" ),
			);
		}
	}
}
if ( ! $ace_tst_items ) {
	return;
}
if ( ! $ace_tst_heading || preg_match( '/^what our client says\.?$/i', $ace_tst_heading ) ) {
	$ace_tst_heading = __( 'What our clients say', 'ace' );
}
ace_inline_css( 'testimonials.css' );
?>
<section class="tdb-tst" aria-labelledby="tdb-tst-title" data-tdb-tst>
	<div class="container">
		<div class="tdb-tst__head">
			<div>
				<p class="tdb-tst__chip"><span></span><?php echo esc_html( $ace_tst_sub ? $ace_tst_sub : __( 'Reviews', 'ace' ) ); ?></p>
				<h2 id="tdb-tst-title"><?php echo esc_html( $ace_tst_heading ); ?></h2>
			</div>
			<div class="tdb-tst__nav">
				<button type="button" class="tdb-tst__arrow" data-dir="-1" aria-label="<?php esc_attr_e( 'Previous review', 'ace' ); ?>"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 6l-6 6 6 6"/></svg></button>
				<button type="button" class="tdb-tst__arrow" data-dir="1" aria-label="<?php esc_attr_e( 'Next review', 'ace' ); ?>"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 6l6 6-6 6"/></svg></button>
			</div>
		</div>
		<div class="tdb-tst__track" tabindex="0" aria-label="<?php esc_attr_e( 'Client reviews', 'ace' ); ?>">
			<?php foreach ( $ace_tst_items as $ace_t ) : ?>
				<figure class="tdb-tst__card">
					<div class="tdb-tst__top">
						<span class="tdb-tst__stars" aria-label="<?php esc_attr_e( '5 out of 5 stars', 'ace' ); ?>">★★★★★</span>
						<svg class="tdb-tst__q" width="34" height="34" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M9.5 6C6.5 7 4 9.7 4 13.6V18h6v-6H7.2c.2-2 1.4-3.4 3.3-4.1L9.5 6Zm10 0c-3 1-5.5 3.7-5.5 7.6V18h6v-6h-2.8c.2-2 1.4-3.4 3.3-4.1L19.5 6Z"/></svg>
					</div>
					<blockquote><p><?php echo esc_html( $ace_t['text'] ); ?></p></blockquote>
					<figcaption>
						<?php if ( $ace_t['image'] ) : ?>
							<img loading="lazy" decoding="async" width="52" height="52" src="<?php echo esc_url( is_array( $ace_t['image'] ) ? $ace_t['image']['url'] : $ace_t['image'] ); ?>" alt="<?php echo esc_attr( $ace_t['name'] ); ?>">
						<?php else : ?>
							<span class="tdb-tst__initial" aria-hidden="true"><?php echo esc_html( mb_substr( $ace_t['name'], 0, 1 ) ); ?></span>
						<?php endif; ?>
						<span><b><?php echo esc_html( $ace_t['name'] ); ?></b><small><?php echo esc_html( $ace_t['role'] ); ?></small></span>
					</figcaption>
				</figure>
			<?php endforeach; ?>
		</div>
		<div class="tdb-tst__dots" aria-hidden="true"><?php foreach ( $ace_tst_items as $i => $ace_t ) : ?><i class="<?php echo 0 === $i ? 'is-active' : ''; ?>"></i><?php endforeach; ?></div>
	</div>
</section>
<script>
(function () {
	var root = document.querySelector('[data-tdb-tst]');
	if (!root) return;
	var track = root.querySelector('.tdb-tst__track'), cards = track.children, dots = root.querySelectorAll('.tdb-tst__dots i'), timer;
	function step() { return cards.length > 1 ? cards[1].offsetLeft - cards[0].offsetLeft : track.clientWidth; }
	function go(dir) {
		var max = track.scrollWidth - track.clientWidth - 4;
		if (dir > 0 && track.scrollLeft >= max) { track.scrollTo({ left: 0, behavior: 'smooth' }); return; }
		track.scrollBy({ left: dir * step(), behavior: 'smooth' });
	}
	root.querySelectorAll('.tdb-tst__arrow').forEach(function (b) { b.addEventListener('click', function () { go(+b.getAttribute('data-dir')); restart(); }); });
	track.addEventListener('scroll', function () {
		var i = Math.round(track.scrollLeft / step());
		dots.forEach(function (d, k) { d.classList.toggle('is-active', k === Math.min(i, dots.length - 1)); });
	}, { passive: true });
	function restart() {
		clearInterval(timer);
		if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
		timer = setInterval(function () { go(1); }, 6000);
	}
	root.addEventListener('mouseenter', function () { clearInterval(timer); });
	root.addEventListener('mouseleave', restart);
	restart();
})();
</script>
