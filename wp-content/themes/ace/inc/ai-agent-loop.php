<?php
/**
 * Animated "how an AI agent works" workflow:
 * AI Agent -> Understand -> Decide -> Execute -> Verify -> Learn (-> loop).
 * Pure HTML/CSS (+ a tiny step highlighter in landing-orb.js). Text is real
 * HTML so it is readable by search engines and screen readers.
 */
$ace_loop = array(
	array( 'AI Agent', 'Receives a goal or event: a ticket, an email, a request.', '<path d="M12 2a3 3 0 0 1 3 3v1h2a3 3 0 0 1 3 3v7a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4V9a3 3 0 0 1 3-3h2V5a3 3 0 0 1 3-3Z"/><circle cx="9" cy="13" r="1.3"/><circle cx="15" cy="13" r="1.3"/><path d="M9.5 17h5"/>' ),
	array( 'Understand', 'Reads the context and pulls facts from your data and tools.', '<circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/>' ),
	array( 'Decide', 'Plans the next steps and checks them against your rules.', '<path d="M6 3v6a3 3 0 0 0 3 3h6a3 3 0 0 1 3 3v6"/><path d="m15 18 3 3 3-3"/><circle cx="6" cy="3" r="1"/>' ),
	array( 'Execute', 'Takes action in your systems through secure APIs.', '<path d="M13 2 4 14h7l-1 8 9-12h-7l1-8Z"/>' ),
	array( 'Verify', 'Checks the result, and asks a person when unsure.', '<path d="M12 3 4 6v6c0 4.5 3.4 8.3 8 9 4.6-.7 8-4.5 8-9V6l-8-3Z"/><path d="m9 12 2 2 4-4"/>' ),
	array( 'Learn', 'Feedback and outcomes improve the next run.', '<path d="M21 12a9 9 0 1 1-3-6.7"/><path d="M21 4v5h-5"/>' ),
);
?>
<section class="tdb-loop" aria-labelledby="tdb-loop-title">
	<div class="container">
		<div class="tdb-lp-head">
			<h6 class="ld-fh-element"><?php esc_html_e( 'How our AI agents work', 'ace' ); ?></h6>
			<h2 id="tdb-loop-title"><?php esc_html_e( 'From goal to verified result, on autopilot', 'ace' ); ?></h2>
			<p><?php esc_html_e( 'Every agent we build follows a clear, auditable loop, with guardrails and human review where it matters.', 'ace' ); ?></p>
		</div>

		<ol class="tdb-loop__flow" data-tdb-loop>
			<?php foreach ( $ace_loop as $i => $step ) : ?>
				<li class="tdb-loop__step<?php echo 0 === $i ? ' is-agent' : ''; ?>" style="--i: <?php echo (int) $i; ?>">
					<span class="tdb-loop__node">
						<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?php echo $step[2]; // phpcs:ignore -- static markup ?></svg>
					</span>
					<span class="tdb-loop__name"><?php echo esc_html( $step[0] ); ?></span>
					<span class="tdb-loop__text"><?php echo esc_html( $step[1] ); ?></span>
					<?php if ( $i < count( $ace_loop ) - 1 ) : ?><span class="tdb-loop__link" aria-hidden="true"><i></i></span><?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ol>
		<div class="tdb-loop__return" aria-hidden="true"><span><?php esc_html_e( 'Continuous improvement loop', 'ace' ); ?></span></div>
	</div>
</section>
