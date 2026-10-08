<?php
/**
 * Creates three example landing pages (as DRAFTS) using the AI Landing Page
 * template, one per hero style:
 *   - AI-Driven Software Development  (3D shape + form)
 *   - AI Agent Development            (minimal light streaks)
 *   - AI Workflow Automation          (light + AI agents panel)
 *
 * Run from the WordPress root:
 *   wp eval-file wp-content/themes/ace/tools/create-ai-landing.php
 * Re-running updates the same page instead of creating a duplicate.
 */

if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
	exit; // CLI only.
}


function ace_save_landing( $slug, $title, $content, $excerpt, $fields ) {
	$page = get_page_by_path( $slug );
	$args = array(
		'post_type'    => 'page',
		'post_title'   => $title,
		'post_name'    => $slug,
		'post_status'  => $page ? $page->post_status : 'draft',
		'post_content' => $content,
		'post_excerpt' => $excerpt,
	);
	if ( $page ) {
		$args['ID'] = $page->ID;
	}
	$id = wp_insert_post( $args, true );
	if ( is_wp_error( $id ) ) {
		WP_CLI::error( $id->get_error_message() );
	}
	update_post_meta( $id, '_wp_page_template', 'landing-template.php' );
	foreach ( $fields as $name => $value ) {
		update_field( $name, $value, $id );
	}
	WP_CLI::success( sprintf( '%s saved (ID %d, %s): %s', $title, $id, get_post_status( $id ), get_preview_post_link( $id ) ) );
}

$content1 = <<<HTML
<h2>AI across your entire software lifecycle</h2>
<p>TechDotBit helps product teams adopt AI where it makes the biggest difference: writing and reviewing code, testing, running infrastructure, modernizing legacy systems and governing how models are used. Instead of bolting a chatbot onto an old process, we redesign the delivery workflow around agentic tools, so your engineers spend their time on architecture and business logic rather than boilerplate.</p>
<h2>Built for production, not demos</h2>
<p>Every engagement starts with your existing codebase, data and compliance requirements. We introduce AI step by step, measure the impact on delivery speed and quality, and keep humans in control of every release. Security guardrails, data protection and responsible-AI checks are part of the architecture from day one.</p>
HTML;

$fields1 = array(
	'lp_hero_style'     => 'knot',
	'lp_eyebrow'        => 'AI Engineering Services',
	'lp_title'          => 'AI-Driven Software Development',
	'lp_intro'          => 'Leverage agentic AI across development, testing, operations and modernization to ship features faster, release with confidence and turn legacy systems into an AI-ready core.',
	'lp_points'         => array(
		array( 'text' => 'Accelerate feature delivery by up to 40%' ),
		array( 'text' => 'Near-zero defect releases with autonomous QA' ),
		array( 'text' => '99.9% uptime with self-healing AIOps' ),
	),
	'lp_form_title'     => "Let's talk",
	'lp_form_note'      => 'Your data is secure with us.',
	'lp_cards_eyebrow'  => 'What we do',
	'lp_cards_heading'  => 'AI services that cover the full delivery lifecycle',
	'lp_cards_intro'    => 'From the first line of code to production operations and governance.',
	'lp_cards'          => array(
		array(
			'title' => 'AI-Led Software Development',
			'text'  => 'Transition to AI-augmented workflows using agentic tools to eliminate manual boilerplate. Focus on high-level architecture and logic to accelerate feature delivery by up to 40%.',
		),
		array(
			'title' => 'Agentic Quality Assurance & Testing',
			'text'  => 'Deploy autonomous AI agents that predict failure points and self-generate complex test scenarios. Ensure near-zero defect releases with QA frameworks that evolve as fast as your code.',
		),
		array(
			'title' => 'Intelligent AIOps & Observability',
			'text'  => 'Bridge the dev-ops gap with predictive analytics to resolve infrastructure bottlenecks before they impact users. Maintain 99.9% uptime through self-healing scripts and AI-driven anomaly detection that prevents system downtime.',
		),
		array(
			'title' => 'AI-Powered Legacy Modernization',
			'text'  => 'Rapidly transform legacy monoliths into scalable, AI-native microservices using automated refactoring. Eliminate technical debt and build a future-proof core ready for seamless next-gen AI integrations.',
		),
		array(
			'title' => 'Responsible AI & Security Governance',
			'text'  => 'Embed security guardrails and compliance into every model to protect your proprietary data and IP. Foster trust with built-in bias detection, hallucination controls, and ethically governed frameworks for enterprise-grade applications.',
		),
	),
	'lp_steps_heading'  => 'How we work',
	'lp_steps'          => array(
		array( 'title' => 'Assess', 'text' => 'We review your codebase, delivery pipeline and data to find where AI will have the biggest impact.' ),
		array( 'title' => 'Architect', 'text' => 'We design the target workflow, tooling and guardrails, aligned with your security and compliance needs.' ),
		array( 'title' => 'Build & automate', 'text' => 'Our engineers deliver features with agentic tools, autonomous testing and automated refactoring.' ),
		array( 'title' => 'Operate & improve', 'text' => 'AIOps monitoring, anomaly detection and continuous measurement keep quality and uptime high.' ),
	),
	'lp_faq'            => array(
		array(
			'question' => 'What is AI-driven software development?',
			'answer'   => 'It is a way of building software where AI agents handle repetitive engineering work such as boilerplate code, test generation, refactoring and monitoring, while experienced engineers focus on architecture, business logic and review.',
		),
		array(
			'question' => 'Can you work with our existing codebase?',
			'answer'   => 'Yes. Most engagements start with an existing product. We introduce AI tooling step by step and can modernize legacy systems into scalable services without a risky big-bang rewrite.',
		),
		array(
			'question' => 'How do you keep our code and data secure?',
			'answer'   => 'Security and compliance are designed in from the start: access controls, data protection, guardrails around model use, and human review of every release. Your proprietary code and IP stay protected.',
		),
		array(
			'question' => 'How quickly can we see results?',
			'answer'   => 'Teams typically see faster delivery and fewer defects within the first few sprints, as AI-assisted development and automated testing are put in place.',
		),
	),
);


$content2 = <<<HTML
<h2>What is an AI agent?</h2>
<p>An AI agent is software that can understand a goal, plan the steps, use your tools and data, and complete the work with little human input. Unlike a simple chatbot, an agent can look up records, update systems, draft responses and hand off to a person when it is unsure.</p>
<h2>Agents built for your business</h2>
<p>We design, build and run custom AI agents that connect to the systems you already use, such as your CRM, helpdesk, databases and internal APIs. Every agent ships with guardrails, logging and human review so you stay in control of quality, cost and security.</p>
HTML;

$fields2 = array(
	'lp_hero_style'    => 'streaks',
	'lp_eyebrow'       => 'AI Agent Development',
	'lp_title'         => 'Custom AI Agents That Work Around the Clock',
	'lp_intro'         => 'We help startups and enterprises design, build and operate safe, reliable AI agents that cut manual work, speed up response times and scale with your business.',
	'lp_cta_label'     => 'Book a free consultation',
	'lp_hero_features' => array(
		array( 'title' => 'Agent Consulting', 'text' => 'Find the workflows where AI agents deliver the fastest, measurable return.' ),
		array( 'title' => 'Agent Development', 'text' => 'Custom agents connected to your tools, data and approval rules.' ),
		array( 'title' => 'Agent Operations', 'text' => 'Monitoring, evaluation and continuous improvement once agents are live.' ),
	),
	'lp_form_heading'  => 'Tell us what you want to automate',
	'lp_form_text'     => 'Share a few details about your workflow and an engineer will get back to you with next steps.',
	'lp_cards_eyebrow' => 'Use cases',
	'lp_cards_heading' => 'Where AI agents make an impact',
	'lp_cards'         => array(
		array( 'title' => 'Customer support agents', 'text' => 'Answer common questions, look up orders and accounts, and escalate complex cases to your team with full context.' ),
		array( 'title' => 'Sales and lead qualification', 'text' => 'Research inbound leads, enrich CRM records and route qualified opportunities to the right person.' ),
		array( 'title' => 'Back-office automation', 'text' => 'Process documents, reconcile data and keep systems in sync without copy-and-paste work.' ),
		array( 'title' => 'Engineering copilots', 'text' => 'Agents that review code, generate tests and triage incidents alongside your developers.' ),
		array( 'title' => 'Knowledge assistants', 'text' => 'Secure assistants that answer questions from your internal documents and policies.' ),
		array( 'title' => 'Responsible AI by design', 'text' => 'Guardrails, audit logs, data protection and human-in-the-loop approvals built into every agent.' ),
	),
	'lp_steps_heading' => 'From idea to agent in production',
	'lp_steps'         => array(
		array( 'title' => 'Discover', 'text' => 'Map the workflow, data sources and success metrics.' ),
		array( 'title' => 'Prototype', 'text' => 'A working agent on real examples, reviewed with your team.' ),
		array( 'title' => 'Integrate', 'text' => 'Connect to your systems with security and approval rules.' ),
		array( 'title' => 'Launch & improve', 'text' => 'Go live with monitoring, evaluation and ongoing tuning.' ),
	),
	'lp_faq'           => array(
		array( 'question' => 'What is the difference between a chatbot and an AI agent?', 'answer' => 'A chatbot mainly answers questions. An AI agent can also take actions: look up data, update records, call APIs and complete multi-step tasks, with guardrails and human approval where needed.' ),
		array( 'question' => 'Can AI agents work with our existing tools?', 'answer' => 'Yes. We connect agents to the systems you already use through their APIs or secure integrations, such as CRMs, helpdesks, databases and internal services.' ),
		array( 'question' => 'How do you keep AI agents safe and accurate?', 'answer' => 'Every agent includes guardrails, logging, evaluation tests and escalation to a person when confidence is low. Sensitive actions can require human approval.' ),
	),
);

$content3 = <<<HTML
<h2>Automation that understands your work</h2>
<p>Traditional automation breaks when inputs change. AI-powered workflows read emails, documents and tickets the way a person would, decide what needs to happen next and coordinate a team of specialised agents to get it done, all inside the tools your team already uses.</p>
<h2>Designed with your team</h2>
<p>Your team describes the process in plain language; we turn it into reliable, monitored automations with clear owners, approval steps and reporting, so you can see exactly what each agent did and why.</p>
HTML;

$fields3 = array(
	'lp_hero_style'      => 'agents',
	'lp_eyebrow'         => 'AI Workflow Automation',
	'lp_title'           => 'AI agents that drive business impact, built around your team',
	'lp_title_highlight' => 'business impact',
	'lp_intro'           => 'We build teams of specialist AI agents that run repetitive work on autopilot, from lead research to ticket triage, so your people can focus on decisions that matter.',
	'lp_cta_label'       => 'Book a demo',
	'lp_cta2_label'      => 'See use cases',
	'lp_cta2_link'       => '#use-cases',
	'lp_prompt'          => 'Build a team to work my inbound pipeline',
	'lp_agents'          => array(
		array( 'name' => 'Lead Researcher' ),
		array( 'name' => 'Inbound Qualifier' ),
		array( 'name' => 'Outreach Assistant' ),
	),
	'lp_form_heading'    => 'Let us map your first automation',
	'lp_form_text'       => 'Tell us which process takes the most time today. We will suggest where agents can help and what results to expect.',
	'lp_cards_eyebrow'   => 'Use cases',
	'lp_cards_heading'   => 'Automate the work that slows your team down',
	'lp_cards'           => array(
		array( 'title' => 'Sales pipeline', 'text' => 'Research prospects, qualify inbound leads and prepare personalised outreach for your reps.' ),
		array( 'title' => 'Support operations', 'text' => 'Classify, prioritise and route tickets, and draft accurate replies from your knowledge base.' ),
		array( 'title' => 'Finance & operations', 'text' => 'Extract data from invoices and documents, reconcile records and flag exceptions for review.' ),
	),
	'lp_steps_heading'   => 'How we work',
	'lp_steps'           => array(
		array( 'title' => 'Map', 'text' => 'Pick one high-volume process and define what good looks like.' ),
		array( 'title' => 'Build', 'text' => 'Design the agent team, tools and approval steps.' ),
		array( 'title' => 'Prove', 'text' => 'Run it on real work and measure time saved and quality.' ),
		array( 'title' => 'Scale', 'text' => 'Roll out to more processes with monitoring in place.' ),
	),
	'lp_faq'             => array(
		array( 'question' => 'Do we need technical staff to use these automations?', 'answer' => 'No. Your team describes the process and reviews results; we handle the engineering, integrations and monitoring.' ),
		array( 'question' => 'Which processes are best to automate first?', 'answer' => 'High-volume, rules-heavy work that still needs judgement, such as lead qualification, ticket triage and document processing, usually gives the fastest return.' ),
	),
);

ace_save_landing( 'ai-driven-software-development', 'AI-Driven Software Development', $content1, 'AI-driven software development services: agentic coding, autonomous QA, AIOps, legacy modernization and responsible AI governance.', $fields1 );
ace_save_landing( 'ai-agent-development', 'AI Agent Development', $content2, 'Custom AI agent development: consulting, integration and operations for safe, reliable AI agents.', $fields2 );
ace_save_landing( 'ai-workflow-automation', 'AI Workflow Automation', $content3, 'AI workflow automation with teams of specialist AI agents for sales, support and operations.', $fields3 );
