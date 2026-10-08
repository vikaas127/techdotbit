<?php
/** Enterprise-ready AI: the trust questions answered up front. */
$ace_trust = array(
	array( 'Data privacy', 'Your data is never used to train public models.' ),
	array( 'Role-based access', 'Agents only see what each role is allowed to see.' ),
	array( 'Authentication', 'SSO and secure, scoped credentials for every connector.' ),
	array( 'Agent permissions', 'Each agent has an explicit list of allowed actions.' ),
	array( 'Human approval', 'Sensitive actions wait for a person to approve.' ),
	array( 'Audit trails', 'Every read, decision and action is logged.' ),
	array( 'Data isolation', 'Separate environments and data per customer.' ),
	array( 'Monitoring', 'Quality, cost and behaviour tracked in real time.' ),
	array( 'Secure integrations', 'Encrypted connections and least-privilege access.' ),
	array( 'Deployment options', 'Our cloud, your cloud or fully on-premise.' ),
);
?>
<section class="tdb-trust" aria-labelledby="tdb-trust-title">
	<div class="container tdb-trust__inner">
		<div class="tdb-trust__visual" aria-hidden="true">
			<div class="tdb-trust__radar"><i></i></div>
			<svg class="tdb-trust__shield" width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3 4 6v6c0 4.5 3.4 8.3 8 9 4.6-.7 8-4.5 8-9V6l-8-3Z"/><path d="m9 12 2 2 4-4"/></svg>
		</div>
		<div>
			<p class="tdb-chip"><span></span>Enterprise-ready AI</p>
			<h2 id="tdb-trust-title">Can the AI do something dangerous? Not on our watch.</h2>
			<p class="tdb-trust__lead">When AI agents can take actions, control matters as much as capability. Every TechDotBit agent runs with clear permissions, approvals and full visibility.</p>
			<ul class="tdb-trust__grid">
				<?php foreach ( $ace_trust as $t ) : ?>
					<li><b><?php echo esc_html( $t[0] ); ?></b><span><?php echo esc_html( $t[1] ); ?></span></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>
