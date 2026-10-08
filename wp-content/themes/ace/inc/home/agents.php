<?php
/**
 * Homepage: AI agents gallery. Each tile shows an agent and a live-looking
 * task log that ticks through what it does (illustrative, not real data).
 */
require_once __DIR__ . '/helpers.php';
$ace_agents = array(
	array( 'Sales Agent', 'Qualifies leads and keeps the CRM current.', array( 'Reading 12 new enquiries', 'Scoring against your ideal customer', 'Drafting follow-ups for review' ) ),
	array( 'Support Agent', 'Answers customers from your knowledge base.', array( 'Classifying incoming tickets', 'Finding the answer in your docs', 'Escalating 1 case with context' ) ),
	array( 'Operations Agent', 'Watches orders, stock and schedules.', array( 'Checking today\'s open orders', 'Flagging items running low', 'Preparing a reorder for approval' ) ),
	array( 'Document Agent', 'Reads invoices, contracts and forms.', array( 'Extracting invoice fields', 'Matching against purchase orders', 'Sending 2 mismatches to review' ) ),
	array( 'Testing Agent', 'Writes and runs tests on every release.', array( 'Reading the new user stories', 'Generating regression tests', 'Re-testing fixed defects' ) ),
	array( 'Reporting Agent', 'Turns raw data into clear reports.', array( 'Collecting numbers from 4 systems', 'Comparing with last month', 'Writing the management summary' ) ),
);
?>
<section class="tdb-h tdb-hagents" aria-labelledby="tdb-hagents-title" data-tdb-inview>
	<div class="container">
		<div class="tdb-h__head">
			<p class="tdb-h__chip"><span></span><?php esc_html_e( 'AI agents', 'ace' ); ?></p>
			<h2 id="tdb-hagents-title"><?php esc_html_e( 'AI that doesn\'t stop at answers. It gets work done.', 'ace' ); ?></h2>
		</div>
		<div class="tdb-hagents__grid">
			<?php foreach ( $ace_agents as $ace_i => $ace_a ) : ?>
				<article class="tdb-hagents__card" style="--i: <?php echo (int) $ace_i; ?>" data-tdb-ticker>
					<header>
						<span class="tdb-hagents__avatar" aria-hidden="true"><?php echo esc_html( substr( $ace_a[0], 0, 1 ) ); ?></span>
						<h3><?php echo esc_html( $ace_a[0] ); ?></h3>
						<span class="tdb-hagents__live" aria-hidden="true"><?php esc_html_e( 'Live', 'ace' ); ?></span>
					</header>
					<ol class="tdb-hagents__log" aria-label="<?php echo esc_attr( sprintf( __( 'Example tasks for the %s', 'ace' ), $ace_a[0] ) ); ?>">
						<?php foreach ( $ace_a[2] as $ace_step ) : ?>
							<li><?php echo esc_html( $ace_step ); ?></li>
						<?php endforeach; ?>
					</ol>
				</article>
			<?php endforeach; ?>
		</div>
		<div class="tdb-h__actions">
			<a class="tdb-h__btn" href="<?php echo esc_url( ace_page_url( 'ai-services/ai-agent-development' ) ); ?>"><?php esc_html_e( 'Build your AI agent', 'ace' ); ?> <span aria-hidden="true">&rarr;</span></a>
			<a class="tdb-h__link" href="<?php echo esc_url( ace_page_url( 'ai-services/how-ai-agents-work', ace_page_url( 'ai-services' ) ) ); ?>"><?php esc_html_e( 'How our agents work', 'ace' ); ?> <span aria-hidden="true">&rarr;</span></a>
		</div>
	</div>
</section>
