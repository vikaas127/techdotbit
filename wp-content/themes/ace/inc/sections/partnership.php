<?php
/**
 * Homepage "How we partner": three principles with matching animated line
 * icons, a connector that draws itself, and proof points for each card.
 */
$ace_partner = array(
	array(
		'title' => 'One team with yours',
		'tag'   => 'Teamwork',
		'text'  => 'Our engineers work in your tools, sprints and channels.',
		'proof' => array( 'Dedicated engineers and a named lead', 'Your tools: Jira, GitHub, Slack, Teams', 'Time-zone overlap for daily syncs' ),
		'icon'  => '<circle cx="9" cy="8" r="3.2"/><circle cx="17" cy="9.5" r="2.6"/><path d="M3.5 19.5a5.5 5.5 0 0 1 11 0"/><path d="M14.5 15.2a4.6 4.6 0 0 1 6.5 4.3"/>',
	),
	array(
		'title' => 'Full visibility, every sprint',
		'tag'   => 'Transparency',
		'text'  => 'Working software to review every two weeks.',
		'proof' => array( 'Sprint demos and written updates', 'Shared backlog, budget and risks', 'Code, docs and AI prompts in your repo' ),
		'icon'  => '<path d="M2.5 12s3.5-6.5 9.5-6.5S21.5 12 21.5 12 18 18.5 12 18.5 2.5 12 2.5 12Z"/><circle cx="12" cy="12" r="3"/>',
	),
	array(
		'title' => 'Accountable for outcomes',
		'tag'   => 'Commitment',
		'text'  => 'Measurable goals agreed up front, and met.',
		'proof' => array( 'Clear goals and acceptance criteria', 'Quality gates before every release', 'Support and improvement after launch' ),
		'icon'  => '<path d="M12 3 4.5 6v5.5c0 4.4 3.1 8.3 7.5 9.5 4.4-1.2 7.5-5.1 7.5-9.5V6L12 3Z"/><path d="m8.5 12 2.5 2.5 4.5-5"/>',
	),
);
?>
<section class="tdb-partner" aria-labelledby="tdb-partner-title" data-tdb-inview>
	<div class="container">
		<div class="tdb-partner__head">
			<p class="tdb-partner__chip"><span></span><?php esc_html_e( 'How we partner', 'ace' ); ?></p>
			<h2 id="tdb-partner-title"><?php esc_html_e( 'A partnership model built on trust', 'ace' ); ?></h2>
		</div>
		<div class="tdb-partner__grid">
			<span class="tdb-partner__line" aria-hidden="true"><i></i></span>
			<?php foreach ( $ace_partner as $ace_i => $ace_p ) : ?>
				<article class="tdb-partner__card" style="--i: <?php echo (int) $ace_i; ?>">
					<span class="tdb-partner__num" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $ace_i + 1 ) ); ?></span>
					<span class="tdb-partner__icon" aria-hidden="true">
						<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $ace_p['icon']; // phpcs:ignore -- static ?></svg>
					</span>
					<p class="tdb-partner__tag"><?php echo esc_html( $ace_p['tag'] ); ?></p>
					<h3><?php echo esc_html( $ace_p['title'] ); ?></h3>
					<p class="tdb-partner__text"><?php echo esc_html( $ace_p['text'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<script>
(function () {
	var s = document.currentScript && document.currentScript.previousElementSibling;
	if (!s) return;
	if (!('IntersectionObserver' in window)) { s.classList.add('is-in'); return; }
	var io = new IntersectionObserver(function (e) {
		if (e[0].isIntersecting) { s.classList.add('is-in'); io.disconnect(); }
	}, { threshold: 0.25 });
	io.observe(s);
})();
</script>
