<?php
/**
 * "Agents that plug into your stack": an AI agent hub with business tools
 * orbiting around it (CSS animation), plus supporting copy.
 */
$ace_inner = array( 'CRM', 'Email', 'Slack', 'Database' );
$ace_outer = array( 'ERP', 'WhatsApp', 'APIs', 'Docs', 'Calendar', 'Cloud' );
$ace_agents_page = get_page_by_path( 'ai-services/ai-agent-development' );
?>
<section class="tdb-orbit-section" aria-labelledby="tdb-orbit-title">
	<div class="container tdb-orbit-section__inner">
		<div class="tdb-orbit-section__copy">
			<p class="tdb-chip"><span></span><?php esc_html_e( 'Integrations', 'ace' ); ?></p>
			<h2 id="tdb-orbit-title"><?php esc_html_e( 'AI agents that plug into the tools you already use', 'ace' ); ?></h2>
			<p><?php esc_html_e( 'Our agents connect securely to your CRM, ERP, email, chat, documents and databases, so they work inside your existing processes instead of adding another tool.', 'ace' ); ?></p>
			<ul class="tdb-orbit-section__list">
				<li><?php esc_html_e( 'Secure API and database connections', 'ace' ); ?></li>
				<li><?php esc_html_e( 'Role-based access and full audit logs', 'ace' ); ?></li>
				<li><?php esc_html_e( 'Human approval for sensitive actions', 'ace' ); ?></li>
			</ul>
			<?php if ( $ace_agents_page && 'publish' === $ace_agents_page->post_status ) : ?>
				<a class="tdb-btn tdb-btn--primary" href="<?php echo esc_url( get_permalink( $ace_agents_page ) ); ?>"><?php esc_html_e( 'Explore AI Agents', 'ace' ); ?></a>
			<?php endif; ?>
		</div>
		<div class="tdb-orbit" aria-hidden="true">
			<div class="tdb-orbit__ring tdb-orbit__ring--outer" style="--n: <?php echo count( $ace_outer ); ?>">
				<?php foreach ( $ace_outer as $i => $label ) : ?>
					<span class="tdb-orbit__item" style="--i: <?php echo (int) $i; ?>"><b><?php echo esc_html( $label ); ?></b></span>
				<?php endforeach; ?>
			</div>
			<div class="tdb-orbit__ring tdb-orbit__ring--inner" style="--n: <?php echo count( $ace_inner ); ?>">
				<?php foreach ( $ace_inner as $i => $label ) : ?>
					<span class="tdb-orbit__item" style="--i: <?php echo (int) $i; ?>"><b><?php echo esc_html( $label ); ?></b></span>
				<?php endforeach; ?>
			</div>
			<div class="tdb-orbit__core">
				<svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a3 3 0 0 1 3 3v1h2a3 3 0 0 1 3 3v7a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4V9a3 3 0 0 1 3-3h2V5a3 3 0 0 1 3-3Z"/><circle cx="9" cy="13" r="1.3"/><circle cx="15" cy="13" r="1.3"/><path d="M9.5 17h5"/></svg>
				<span>AI Agent</span>
			</div>
		</div>
	</div>
</section>
