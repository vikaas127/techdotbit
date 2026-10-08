<?php
/**
 * Homepage: selected work. Uses the projects chosen in Theme Options >
 * Case study (if set), otherwise the latest projects.
 */
require_once get_stylesheet_directory() . '/inc/project-cover.php';
$ace_work = array();
if ( function_exists( 'get_field' ) ) {
	$ace_cs = get_field( 'case_study', 'option' );
	$ace_cs = is_array( $ace_cs ) && isset( $ace_cs[0] ) ? $ace_cs[0] : $ace_cs;
	if ( ! empty( $ace_cs['list'] ) && is_array( $ace_cs['list'] ) ) {
		$ace_work = $ace_cs['list'];
	}
}
if ( ! $ace_work && post_type_exists( 'project' ) ) {
	$ace_work = get_posts( array( 'post_type' => 'project', 'numberposts' => 6 ) );
}
$ace_work = array_slice( array_filter( array_map( 'get_post', (array) $ace_work ) ), 0, 3 ); // three case studies, one opens at a time
if ( ! $ace_work ) {
	return;
}
?>
<?php ace_inline_css( 'work.css' ); ?>
<section class="tdb-h tdb-cases3" id="work" aria-labelledby="tdb-work-title" data-tdb-cases3 style="--count: <?php echo count( $ace_work ); ?>">
	<div class="tdb-cases3__sticky">
		<div class="container">
			<div class="tdb-inds__top">
				<div class="tdb-h__head tdb-h__head--left">
					<p class="tdb-h__chip"><span></span><?php esc_html_e( 'Our work', 'ace' ); ?></p>
					<h2 id="tdb-work-title"><?php esc_html_e( 'Software we have built', 'ace' ); ?></h2>
				</div>
				<a class="tdb-h__link" href="<?php echo esc_url( function_exists( 'ace_portfolio_url' ) ? ace_portfolio_url() : home_url( '/' ) ); ?>"><?php esc_html_e( 'See all work', 'ace' ); ?> <span aria-hidden="true">&rarr;</span></a>
			</div>
			<div class="tdb-cases3__row">
				<?php foreach ( $ace_work as $ace_i => $ace_w ) :
					$ace_terms = get_the_terms( $ace_w->ID, 'tagportfolio' );
					$ace_tag   = $ace_terms && ! is_wp_error( $ace_terms ) ? $ace_terms[0]->name : '';
					$ace_sum   = has_excerpt( $ace_w ) ? get_the_excerpt( $ace_w ) : wp_trim_words( wp_strip_all_tags( strip_shortcodes( $ace_w->post_content ) ), 24, '…' );
					?>
					<article class="tdb-cases3__card<?php echo 0 === $ace_i ? ' is-open' : ''; ?>" data-case="<?php echo (int) $ace_i; ?>">
						<button type="button" class="tdb-cases3__tab" aria-expanded="<?php echo 0 === $ace_i ? 'true' : 'false'; ?>">
							<span class="tdb-cases3__num"><?php echo esc_html( sprintf( '%02d', $ace_i + 1 ) ); ?></span>
							<span class="tdb-cases3__vtitle"><?php echo esc_html( get_the_title( $ace_w ) ); ?></span>
						</button>
						<div class="tdb-cases3__body">
							<span class="tdb-cases3__media"><?php echo ace_project_cover( $ace_w->ID ); // phpcs:ignore -- escaped inside ?></span>
							<div class="tdb-cases3__info">
								<?php if ( $ace_tag ) : ?><span class="tdb-work__tag"><?php echo esc_html( $ace_tag ); ?></span><?php endif; ?>
								<h3><?php echo esc_html( get_the_title( $ace_w ) ); ?></h3>
								<?php if ( $ace_sum ) : ?><p><?php echo esc_html( wp_trim_words( wp_strip_all_tags( $ace_sum ), 24, '…' ) ); ?></p><?php endif; ?>
								<a class="tdb-h__btn" href="<?php echo esc_url( get_permalink( $ace_w ) ); ?>"><?php esc_html_e( 'View case study', 'ace' ); ?> <span aria-hidden="true">&rarr;</span></a>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
			<div class="tdb-cases3__progress" aria-hidden="true"><?php foreach ( $ace_work as $ace_i => $ace_w ) : ?><i class="<?php echo 0 === $ace_i ? 'is-active' : ''; ?>"></i><?php endforeach; ?></div>
		</div>
	</div>
</section>
<script>
(function () {
	var root = document.querySelector('[data-tdb-cases3]');
	if (!root) return;
	var cards = root.querySelectorAll('.tdb-cases3__card'), dots = root.querySelectorAll('.tdb-cases3__progress i');
	var n = cards.length, cur = 0, manual = false;
	function open(i) {
		if (i === cur) return;
		cur = i;
		cards.forEach(function (c, k) { c.classList.toggle('is-open', k === i); c.querySelector('.tdb-cases3__tab').setAttribute('aria-expanded', k === i ? 'true' : 'false'); });
		dots.forEach(function (d, k) { d.classList.toggle('is-active', k === i); });
	}
	cards.forEach(function (c, k) { c.querySelector('.tdb-cases3__tab').addEventListener('click', function () { manual = true; open(k); }); });
	// Scroll-driven: while the section is pinned, each third of the scroll opens the next card.
	function onScroll() {
		if (manual || window.innerWidth < 992) return;
		var r = root.getBoundingClientRect(), total = root.offsetHeight - window.innerHeight;
		if (total <= 0) return;
		var p = Math.min(1, Math.max(0, -r.top / total));
		open(Math.min(n - 1, Math.floor(p * n * 0.999)));
	}
	window.addEventListener('scroll', function () { window.requestAnimationFrame(onScroll); }, { passive: true });
	root.addEventListener('mouseleave', function () { manual = false; });
	onScroll();
})();
</script>
