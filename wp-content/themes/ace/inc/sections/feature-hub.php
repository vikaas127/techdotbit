<?php
/**
 * Feature hub: the page's key features around a central hub, with animated
 * connections; pick a feature (or let it auto-advance) to read its detail.
 * Expects $cards (title/text) and $f (field helper) from landing-template.php.
 */
$ace_hub_label = $f( 'lp_eyebrow', get_the_title() );
$ace_hub_items = array_slice( $cards, 0, 6 );
$ace_hub_icons = array(
	'<path d="m12 3 9 5-9 5-9-5 9-5Z"/><path d="m3 13 9 5 9-5"/>',
	'<path d="M3 12h4l3-8 4 16 3-8h4"/>',
	'<path d="M12 3 4 6v6c0 4.5 3.4 8.3 8 9 4.6-.7 8-4.5 8-9V6l-8-3Z"/><path d="m9 12 2 2 4-4"/>',
	'<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 10h18M9 20V10"/>',
	'<path d="M4 19V5M4 19h16M8 15l3-4 3 2 5-6"/>',
	'<path d="M5 12h14M13 6l6 6-6 6"/>',
);
// Node positions (percent) around the hub.
// [x, y, side]: side anchors the node box so it never overflows the diagram.
$ace_hub_pos = array( array( 50, 7, 'c' ), array( 100, 30, 'r' ), array( 100, 72, 'r' ), array( 50, 93, 'c' ), array( 0, 72, 'l' ), array( 0, 30, 'l' ) );
?>
<section class="tdb-hub" id="use-cases" aria-labelledby="tdb-hub-title" data-tdb-hub>
	<div class="container">
		<div class="tdb-lp-head">
			<?php if ( $f( 'lp_cards_eyebrow' ) ) : ?><h6 class="ld-fh-element"><?php echo esc_html( $f( 'lp_cards_eyebrow' ) ); ?></h6><?php endif; ?>
			<h2 id="tdb-hub-title"><?php echo esc_html( $f( 'lp_cards_heading', __( 'Key features', 'ace' ) ) ); ?></h2>
		</div>
		<div class="tdb-hub__wrap">
			<div class="tdb-hub__map">
				<svg class="tdb-hub__lines" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
					<?php foreach ( $ace_hub_items as $i => $item ) : $p = $ace_hub_pos[ $i ]; ?>
						<line class="tdb-hub__line" style="--i: <?php echo (int) $i; ?>" x1="50" y1="50" x2="<?php echo (int) ( "l" === $p[2] ? 18 : ( "r" === $p[2] ? 82 : $p[0] ) ); ?>" y2="<?php echo (int) $p[1]; ?>"/>
					<?php endforeach; ?>
				</svg>
				<?php foreach ( $ace_hub_items as $i => $item ) : $p = $ace_hub_pos[ $i ]; ?>
					<span class="tdb-hub__pulse" style="--i: <?php echo (int) $i; ?>; --x: <?php echo (int) ( 'l' === $p[2] ? 18 : ( 'r' === $p[2] ? 82 : $p[0] ) ); ?>%; --y: <?php echo (int) $p[1]; ?>%;" aria-hidden="true"></span>
				<?php endforeach; ?>
				<div class="tdb-hub__core" aria-hidden="true">
					<span class="tdb-hub__ring"></span><span class="tdb-hub__ring tdb-hub__ring--2"></span>
					<b><?php echo esc_html( $ace_hub_label ); ?></b>
				</div>
				<?php foreach ( $ace_hub_items as $i => $item ) : $p = $ace_hub_pos[ $i ]; ?>
					<button type="button" class="tdb-hub__node tdb-hub__node--<?php echo esc_attr( $p[2] ); ?><?php echo 0 === $i ? ' is-active' : ''; ?>" style="--x: <?php echo (int) $p[0]; ?>%; --y: <?php echo (int) $p[1]; ?>%; --i: <?php echo (int) $i; ?>" data-hub="<?php echo (int) $i; ?>" aria-controls="tdb-hub-detail" aria-pressed="<?php echo 0 === $i ? 'true' : 'false'; ?>">
						<span class="tdb-hub__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?php echo $ace_hub_icons[ $i % 6 ]; // phpcs:ignore -- static ?></svg></span>
						<span class="tdb-hub__name"><?php echo esc_html( $item['title'] ); ?></span>
					</button>
				<?php endforeach; ?>
			</div>
			<div class="tdb-hub__detail" id="tdb-hub-detail" aria-live="polite">
				<?php foreach ( $ace_hub_items as $i => $item ) : ?>
					<div class="tdb-hub__panel<?php echo 0 === $i ? ' is-active' : ''; ?>" data-panel="<?php echo (int) $i; ?>">
						<span class="tdb-hub__num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?> / <?php echo esc_html( sprintf( '%02d', count( $ace_hub_items ) ) ); ?></span>
						<span class="tdb-hub__big-icon" aria-hidden="true"><svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $ace_hub_icons[ $i % 6 ]; // phpcs:ignore -- static ?></svg></span>
						<h3><?php echo esc_html( $item['title'] ); ?></h3>
						<p><?php echo esc_html( $item['text'] ); ?></p>
					</div>
				<?php endforeach; ?>
				<div class="tdb-hub__dots" aria-hidden="true">
					<?php foreach ( $ace_hub_items as $i => $item ) : ?><i class="<?php echo 0 === $i ? 'is-active' : ''; ?>"></i><?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
(function () {
	var root = document.querySelector('[data-tdb-hub]');
	if (!root) return;
	var nodes = root.querySelectorAll('.tdb-hub__node'), panels = root.querySelectorAll('.tdb-hub__panel'), dots = root.querySelectorAll('.tdb-hub__dots i');
	var cur = 0, timer, reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	function show(i) {
		cur = (i + nodes.length) % nodes.length;
		nodes.forEach(function (n, k) { n.classList.toggle('is-active', k === cur); n.setAttribute('aria-pressed', k === cur ? 'true' : 'false'); });
		panels.forEach(function (p, k) { p.classList.toggle('is-active', k === cur); });
		dots.forEach(function (d, k) { d.classList.toggle('is-active', k === cur); });
		root.style.setProperty('--active', cur);
	}
	function play() { if (reduce) return; clearInterval(timer); timer = setInterval(function () { show(cur + 1); }, 4500); }
	nodes.forEach(function (n, k) {
		n.addEventListener('click', function () { show(k); play(); });
		n.addEventListener('mouseenter', function () { show(k); clearInterval(timer); });
		n.addEventListener('mouseleave', play);
	});
	if ('IntersectionObserver' in window) {
		new IntersectionObserver(function (e, o) { if (e[0].isIntersecting) { root.classList.add('is-in'); play(); o.disconnect(); } }, { threshold: .2 }).observe(root);
	} else { root.classList.add('is-in'); play(); }
})();
</script>
