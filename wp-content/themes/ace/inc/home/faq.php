<?php
/**
 * Homepage FAQ for an AI and software engineering company (with FAQPage schema).
 */
require_once __DIR__ . '/helpers.php';
$ace_faq = array(
	array( 'What does TechDotBit do?', 'TechDotBit is an AI and software engineering company. We design and build AI solutions, AI agents, automation and custom software (web, mobile and business applications), and we support them in production. We also build our own product, DotOne.' ),
	array( 'How do I know if AI is right for my business?', 'Start with the problem, not the technology. In a short discovery session we look at your processes and data, identify where AI can save time or improve decisions, and estimate the effort and value. Sometimes the right answer is simple automation or better software rather than AI.' ),
	array( 'What is an AI agent and how is it different from a chatbot?', 'A chatbot answers questions. An AI agent works towards a goal: it understands the request, plans steps, uses your systems (CRM, ERP, email, databases) and completes the task, with people approving important actions. Agents are useful for repetitive, rule-guided work such as lead qualification, reporting or document processing.' ),
	array( 'Can you add AI to our existing software?', 'Yes. Most of our AI work extends systems clients already use. We connect AI features and agents to your applications, CRM, ERP and databases through APIs, so you get the benefits without replacing what works.' ),
	array( 'Is our data safe when you build AI solutions?', 'We use enterprise AI services that do not train on your data, or self-hosted models when data must stay in your environment. Access control, encryption, audit logs and human approval steps are part of every design, and we are happy to sign an NDA before you share details.' ),
	array( 'How long does a project take and how do you work?', 'A focused first version usually takes a few weeks to a few months, depending on scope and integrations. We work in short sprints with a demo every two weeks, so you see progress early and can change priorities as you learn.' ),
	array( 'Do you work with startups as well as established companies?', 'Yes. We help startups build and launch products, and help established businesses modernise systems, automate operations and adopt AI. Engagements range from a small pilot to a dedicated long-term team.' ),
	array( 'What happens after launch?', 'We monitor quality, performance and cost, fix issues, and keep improving the software and AI models. You can choose ongoing support and development, or a handover to your own team with documentation.' ),
);
?>
<section class="tdb-h tdb-hfaq" aria-labelledby="tdb-hfaq-title">
	<div class="container">
		<div class="tdb-hfaq__grid">
			<div class="tdb-hfaq__side">
				<p class="tdb-h__chip"><span></span><?php esc_html_e( 'FAQ', 'ace' ); ?></p>
				<h2 id="tdb-hfaq-title"><?php esc_html_e( 'Questions we hear often', 'ace' ); ?></h2>
				<a class="tdb-h__btn" href="<?php echo esc_url( ace_page_url( 'contact-us' ) ); ?>"><?php esc_html_e( 'Ask a question', 'ace' ); ?> <span aria-hidden="true">&rarr;</span></a>
			</div>
			<div class="tdb-hfaq__list">
				<?php foreach ( $ace_faq as $ace_i => $ace_q ) : ?>
					<details class="tdb-hfaq__item"<?php echo 0 === $ace_i ? ' open' : ''; ?>>
						<summary><?php echo esc_html( $ace_q[0] ); ?><i aria-hidden="true"></i></summary>
						<div class="tdb-hfaq__answer"><p><?php echo esc_html( $ace_q[1] ); ?></p></div>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<script type="application/ld+json"><?php
		echo wp_json_encode( array(
			'@context'   => 'https://schema.org',
			'@type'      => 'FAQPage',
			'mainEntity' => array_map( function ( $q ) {
				return array( '@type' => 'Question', 'name' => $q[0], 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $q[1] ) );
			}, $ace_faq ),
		), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
	?></script>
</section>
