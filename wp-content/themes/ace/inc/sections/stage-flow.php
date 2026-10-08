<?php
/**
 * Stage flow: the process stages named in the page text (its H3 headings),
 * shown as an animated stepper that lights up stage by stage.
 */
$ace_stages = array();
if ( preg_match_all( '#<h3[^>]*>(.*?)</h3>#is', (string) get_post_field( 'post_content', get_the_ID() ), $ace_m ) ) {
	foreach ( $ace_m[1] as $ace_s ) {
		$ace_s = trim( wp_strip_all_tags( $ace_s ) );
		if ( $ace_s && strlen( $ace_s ) <= 60 ) {
			$ace_stages[] = $ace_s;
		}
	}
}
$ace_stages = array_slice( array_values( array_unique( $ace_stages ) ), 0, 6 );
if ( count( $ace_stages ) < 3 ) {
	return;
}
?>
<section class="tdb-flowx" aria-labelledby="tdb-flowx-title" data-tdb-flowx>
	<div class="container">
		<div class="tdb-lp-head">
			<h6 class="ld-fh-element"><?php esc_html_e( 'How work flows', 'ace' ); ?></h6>
			<h2 id="tdb-flowx-title"><?php esc_html_e( 'Every stage, connected in one system', 'ace' ); ?></h2>
		</div>
		<ol class="tdb-flowx__track" style="--n: <?php echo count( $ace_stages ); ?>">
			<span class="tdb-flowx__rail" aria-hidden="true"><i></i></span>
			<?php foreach ( $ace_stages as $i => $ace_s ) : ?>
				<li class="tdb-flowx__step" style="--i: <?php echo (int) $i; ?>">
					<span class="tdb-flowx__dot"><?php echo (int) $i + 1; ?></span>
					<span class="tdb-flowx__name"><?php echo esc_html( $ace_s ); ?></span>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
<script>
(function () {
	var root = document.querySelector('[data-tdb-flowx]');
	if (!root) return;
	if (!('IntersectionObserver' in window)) { root.classList.add('is-in'); return; }
	new IntersectionObserver(function (e, o) { if (e[0].isIntersecting) { root.classList.add('is-in'); o.disconnect(); } }, { threshold: .3 }).observe(root);
})();
</script>
