<?php
/**
 * "How AI agents work": inputs -> Understand / Reason / Plan / Execute /
 * Verify / Learn -> systems. Real HTML (good for SEO and screen readers);
 * the animation only highlights steps (landing-orb.js).
 */
$ace_inputs  = array( 'User request', 'Business rules', 'Documents', 'Database records', 'APIs', 'Application data' );
$ace_systems = array( 'ERP', 'CRM', 'APIs', 'Databases', 'Email', 'Documents', 'Web applications', 'Internal tools' );
$ace_steps   = array(
	array( 'Understand', 'Reads the request together with your business rules, documents, database records and application data.', '<circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/>' ),
	array( 'Reason', 'Analyses the information and works out what actually needs to happen, and what must not.', '<path d="M9 18h6M10 22h4M12 2a7 7 0 0 0-4 12.7V17h8v-2.3A7 7 0 0 0 12 2Z"/>' ),
	array( 'Plan', 'Breaks the goal into a clear sequence of actions, with approval points where required.', '<path d="M9 6h11M9 12h11M9 18h11"/><path d="m3 6 1 1 2-2M3 12l1 1 2-2M3 18l1 1 2-2"/>' ),
	array( 'Execute', 'Carries out each action in your ERP, CRM, databases, email, documents and internal tools.', '<path d="M13 2 4 14h7l-1 8 9-12h-7l1-8Z"/>' ),
	array( 'Verify', 'Checks that every action completed correctly, and hands exceptions to a person.', '<path d="M12 3 4 6v6c0 4.5 3.4 8.3 8 9 4.6-.7 8-4.5 8-9V6l-8-3Z"/><path d="m9 12 2 2 4-4"/>' ),
	array( 'Learn & improve', 'Results and feedback are used to improve the next run.', '<path d="M21 12a9 9 0 1 1-3-6.7"/><path d="M21 4v5h-5"/>' ),
);
?>
<section class="tdb-how" aria-labelledby="tdb-how-title">
	<div class="container">
		<div class="tdb-lp-head">
			<h6 class="ld-fh-element"><?php esc_html_e( 'How AI agents work', 'ace' ); ?></h6>
			<h2 id="tdb-how-title"><?php esc_html_e( 'AI that executes business work, not just answers questions', 'ace' ); ?></h2>
			<p><?php esc_html_e( 'Every TechDotBit agent follows the same transparent loop: it understands your context, reasons, plans, acts in your systems, verifies the result and improves over time.', 'ace' ); ?></p>
		</div>

		<div class="tdb-how__grid" data-tdb-how>
			<div class="tdb-how__side tdb-how__side--in">
				<h3 class="tdb-how__side-title"><?php esc_html_e( 'The agent receives', 'ace' ); ?></h3>
				<ul>
					<?php foreach ( $ace_inputs as $i => $label ) : ?>
						<li style="--i: <?php echo (int) $i; ?>"><span><?php echo esc_html( $label ); ?></span><i aria-hidden="true"></i></li>
					<?php endforeach; ?>
				</ul>
			</div>

			<ol class="tdb-how__steps">
				<?php foreach ( $ace_steps as $i => $step ) : ?>
					<li class="tdb-how__step" data-step="<?php echo (int) $i; ?>">
						<span class="tdb-how__icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?php echo $step[2]; // phpcs:ignore -- static ?></svg></span>
						<span class="tdb-how__num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
						<h3 class="tdb-how__name"><?php echo esc_html( $step[0] ); ?></h3>
						<p class="tdb-how__text"><?php echo esc_html( $step[1] ); ?></p>
					</li>
				<?php endforeach; ?>
				<li class="tdb-how__loop" aria-hidden="true"><span><?php esc_html_e( 'Continuous improvement loop', 'ace' ); ?></span></li>
			</ol>

			<div class="tdb-how__side tdb-how__side--out">
				<h3 class="tdb-how__side-title"><?php esc_html_e( 'and works inside', 'ace' ); ?></h3>
				<ul>
					<?php foreach ( $ace_systems as $i => $label ) : ?>
						<li style="--i: <?php echo (int) $i; ?>"><i aria-hidden="true"></i><span><?php echo esc_html( $label ); ?></span></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</section>
