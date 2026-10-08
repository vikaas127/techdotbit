<?php
/**
 * Creates / updates the AI section of the site as DRAFT pages using the
 * "AI Landing Page" template. All pages live under /ai-services/.
 *
 * Run from the WordPress root:
 *   wp eval-file wp-content/themes/ace/tools/create-ai-pages.php
 *
 * Re-running RESETS the text of existing AI pages to the copy in this file
 * (useful after editing this file; it overwrites edits made in WP Admin).
 * Pages are never duplicated and their publish status is kept. New pages are
 * drafts. To only add new pages, use tools/ai-pages-go-live.php instead.
 * Copy uses only the figures supplied by TechDotBit (40% faster delivery,
 * 99.9% uptime); no client names or results are invented.
 */

if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
	exit; // CLI only.
}

const ACE_QUOTE_FORM = '[contact-form-7 id="0f5d249" title="Quote Form"]';
const ACE_AUDIT_FORM = '[contact-form-7 id="af5387b" title="Free Audit Form"]';

/**
 * Find a page by slug anywhere (so pages created by older scripts at the
 * site root are moved under the hub instead of duplicated).
 */
function ace_find_page( $slug ) {
	global $wpdb;
	$id = $wpdb->get_var( $wpdb->prepare(
		"SELECT ID FROM {$wpdb->posts} WHERE post_type = 'page' AND post_name = %s AND post_status NOT IN ('trash','auto-draft') ORDER BY ID ASC LIMIT 1",
		$slug
	) );
	return $id ? get_post( (int) $id ) : null;
}

function ace_save_page( $p, $parent_id = 0, $order = 0 ) {
	$page = ace_find_page( $p['slug'] );
	// When called from ai-pages-go-live.php, only create pages that are missing
	// and never overwrite content that may have been edited in WP Admin.
	if ( $page && ! empty( $GLOBALS['ace_only_missing'] ) ) {
		return $page->ID;
	}
	$args = array(
		'post_type'    => 'page',
		'post_title'   => $p['title'],
		'post_name'    => $p['slug'],
		'post_parent'  => $parent_id,
		'menu_order'   => $order,
		'post_status'  => $page ? $page->post_status : 'draft',
		'post_content' => $p['content'],
		'post_excerpt' => $p['excerpt'],
	);
	if ( $page ) {
		$args['ID'] = $page->ID;
	}
	$id = wp_insert_post( $args, true );
	if ( is_wp_error( $id ) ) {
		WP_CLI::error( $p['slug'] . ': ' . $id->get_error_message() );
	}
	update_post_meta( $id, '_wp_page_template', 'landing-template.php' );
	foreach ( $p['fields'] as $name => $value ) {
		update_field( $name, $value, $id );
	}
	WP_CLI::log( sprintf( '  %-48s ID %-5d %s', $p['title'], $id, get_post_status( $id ) ) );
	return $id;
}

/** Small helpers to keep the page definitions readable. */
function ace_cards( $rows ) {
	return array_map( function ( $r ) {
		return array( 'title' => $r[0], 'text' => $r[1], 'link' => isset( $r[2] ) ? $r[2] : '' );
	}, $rows );
}
function ace_steps( $rows ) {
	return array_map( function ( $r ) { return array( 'title' => $r[0], 'text' => $r[1] ); }, $rows );
}
function ace_faq( $rows ) {
	return array_map( function ( $r ) { return array( 'question' => $r[0], 'answer' => $r[1] ); }, $rows );
}
function ace_points( $rows ) {
	return array_map( function ( $t ) { return array( 'text' => $t ); }, $rows );
}
function ace_url( $slug ) {
	return home_url( '/ai-services/' . $slug . '/' );
}

$default_steps = ace_steps( array(
	array( 'Assess', 'We review your systems, data and goals to find where AI will have the biggest, measurable impact.' ),
	array( 'Architect', 'We design the solution, tooling and guardrails around your security and compliance requirements.' ),
	array( 'Build & integrate', 'Our engineers deliver in short iterations and connect everything to the tools you already use.' ),
	array( 'Operate & improve', 'We monitor quality, cost and performance in production and keep improving the results.' ),
) );

/* -------------------------------------------------------------------------
 * Hub page
 * ---------------------------------------------------------------------- */
$hub = array(
	'slug'    => 'ai-services',
	'title'   => 'AI Services',
	'excerpt' => 'AI development services from TechDotBit: AI-led software development, agentic QA, AIOps, legacy modernization, AI agents and responsible AI governance.',
	'content' => '<h2>One partner for AI across the software lifecycle</h2><p>TechDotBit brings AI into the way software is designed, built, tested and run. Whether you want to accelerate an engineering team, automate a business workflow with AI agents or modernize a legacy platform, we combine experienced engineers with agentic tooling and clear governance, so AI delivers results you can measure and trust.</p>',
	'fields'  => array(
		'lp_hero_style'    => 'streaks',
		'lp_show_stack'    => 1,
		'lp_eyebrow'       => 'AI Services',
		'lp_title'         => 'AI Services That Turn Ideas Into Production Results',
		'lp_intro'         => 'From AI-led development and autonomous testing to AI agents and legacy modernization, we help companies adopt AI safely and see real impact on delivery speed, quality and cost.',
		'lp_cta_label'     => 'Talk to an AI expert',
		'lp_hero_features' => array(
			array( 'title' => 'Build faster', 'text' => 'AI-augmented engineering that accelerates feature delivery by up to 40%.', 'link' => ace_url( 'ai-led-software-development' ) ),
			array( 'title' => 'Run reliably', 'text' => 'AIOps and self-healing infrastructure for 99.9% uptime.', 'link' => ace_url( 'aiops-observability' ) ),
			array( 'title' => 'Automate work', 'text' => 'Custom AI agents that handle repetitive business processes.', 'link' => ace_url( 'ai-agent-development' ) ),
		),
		'lp_form_heading'  => 'Not sure where to start with AI?',
		'lp_form_text'     => 'Tell us about your product or process. We will suggest the AI opportunities with the fastest return.',
		'lp_cards_eyebrow' => 'Our AI services',
		'lp_cards_heading' => 'Everything you need to build with AI',
		'lp_cards'         => ace_cards( array(
			array( 'AI-Led Software Development', 'Agentic tools remove boilerplate so engineers focus on architecture and logic, accelerating delivery by up to 40%.', ace_url( 'ai-led-software-development' ) ),
			array( 'Agentic QA & Testing', 'Autonomous agents predict failure points and generate complex test scenarios for near-zero defect releases.', ace_url( 'agentic-qa-testing' ) ),
			array( 'AIOps & Observability', 'Predictive analytics, anomaly detection and self-healing scripts keep systems at 99.9% uptime.', ace_url( 'aiops-observability' ) ),
			array( 'AI-Powered Legacy Modernization', 'Automated refactoring turns legacy monoliths into scalable, AI-native microservices.', ace_url( 'ai-legacy-modernization' ) ),
			array( 'Responsible AI & Security', 'Guardrails, compliance, bias detection and hallucination controls for enterprise AI.', ace_url( 'responsible-ai-security' ) ),
			array( 'LLM Development', 'RAG assistants, fine-tuning and private LLMs built on GPT, Claude, Gemini, Llama and more.', ace_url( 'llm-development' ) ),
			array( 'AI Agent Development', 'Custom AI agents connected to your tools and data, with human approval where it matters.', ace_url( 'ai-agent-development' ) ),
			array( 'AI Workflow Automation', 'Teams of specialist agents that run sales, support and operations work on autopilot.', ace_url( 'ai-workflow-automation' ) ),
			array( 'AI-Driven Software Development', 'An end-to-end AI-augmented delivery model, from code to production operations.', ace_url( 'ai-driven-software-development' ) ),
			array( 'Free AI Readiness Assessment', 'A practical review of where AI can help your business, with a prioritised roadmap.', ace_url( 'ai-readiness-assessment' ) ),
		) ),
		'lp_steps_heading' => 'How we deliver AI projects',
		'lp_steps'         => $default_steps,
		'lp_faq'           => ace_faq( array(
			array( 'What AI services does TechDotBit offer?', 'We offer AI-led software development, agentic QA and testing, AIOps and observability, AI-powered legacy modernization, AI agent development, AI workflow automation and responsible AI and security governance.' ),
			array( 'Do you work with startups or enterprises?', 'Both. We work with startups that want to build AI into a new product and with established companies that want to bring AI into existing systems and teams.' ),
			array( 'How do we get started?', 'Most clients start with a short conversation or our free AI readiness assessment. We then agree a focused first project with clear success metrics.' ),
		) ),
	),
);

/* -------------------------------------------------------------------------
 * Child pages
 * ---------------------------------------------------------------------- */
$pages = array();

$pages[] = array(
	'slug'    => 'ai-led-software-development',
	'title'   => 'AI-Led Software Development',
	'excerpt' => 'AI-led software development with agentic tools that remove boilerplate and accelerate feature delivery by up to 40%.',
	'content' => '<h2>What is AI-led software development?</h2><p>AI-led development uses agentic coding tools to handle repetitive engineering work such as scaffolding, boilerplate, refactoring, documentation and first-draft tests. Experienced engineers stay in charge of architecture, business logic and code review, so you get speed without losing quality or ownership of your codebase.</p><h2>How it changes your delivery</h2><p>We introduce AI-augmented workflows into your existing repositories and CI/CD pipelines, set clear review rules and measure the impact on cycle time and defects. Teams spend less time on routine code and more on the features that differentiate your product.</p>',
	'fields'  => array(
		'lp_hero_style'    => 'knot',
		'lp_show_stack'    => 1,
		'lp_eyebrow'       => 'AI-Led Software Development',
		'lp_title'         => 'AI-Led Software Development',
		'lp_intro'         => 'Transition to AI-augmented workflows using agentic tools to eliminate manual boilerplate. Focus on high-level architecture and logic to accelerate feature delivery by up to 40%.',
		'lp_points'        => ace_points( array( 'Up to 40% faster feature delivery', 'Engineers focus on architecture and business logic', 'Works with your existing codebase and pipelines' ) ),
		'lp_cards_eyebrow' => 'What you get',
		'lp_cards_heading' => 'An engineering team amplified by AI',
		'lp_cards'         => ace_cards( array(
			array( 'Agentic coding workflows', 'AI agents generate scaffolding, boilerplate and repetitive code from clear specifications, reviewed by senior engineers.' ),
			array( 'AI-assisted code review', 'Automated reviews catch bugs, security issues and style problems before human review.' ),
			array( 'Automated refactoring', 'Keep the codebase clean with AI-driven refactoring and documentation as features evolve.' ),
			array( 'Spec-to-feature delivery', 'Turn product requirements into working, tested features in shorter cycles.' ),
			array( 'Secure by default', 'Private models or approved providers, no training on your code, and clear data handling rules.' ),
			array( 'Measured impact', 'We track cycle time, throughput and defect rates so you can see the gains.' ),
		) ),
		'lp_steps'         => $default_steps,
		'lp_faq'           => ace_faq( array(
			array( 'Will AI-written code be maintainable?', 'Yes. Every change is reviewed by experienced engineers and follows your coding standards, tests and architecture. AI speeds up the routine work; people stay responsible for quality.' ),
			array( 'Is our source code safe?', 'We use approved AI providers or private deployments configured so your code is not used for model training, and we follow your security and access policies.' ),
			array( 'Can you work inside our existing team?', 'Yes. We can embed engineers in your team, introduce AI-augmented workflows to your developers, or deliver features end to end.' ),
		) ),
	),
);

$pages[] = array(
	'slug'    => 'agentic-qa-testing',
	'title'   => 'Agentic QA & Testing',
	'excerpt' => 'Agentic quality assurance: autonomous AI agents that predict failure points and generate complex test scenarios for near-zero defect releases.',
	'content' => '<h2>Testing that keeps up with your code</h2><p>Traditional test suites fall behind as products grow. Agentic QA uses AI agents that read your code changes and requirements, predict where failures are most likely and generate new test scenarios automatically, including edge cases manual testers often miss.</p><h2>From flaky suites to confident releases</h2><p>We combine AI-generated tests with stable automation frameworks, self-healing selectors and clear reporting, so your team gets fast, trustworthy feedback on every pull request and release.</p>',
	'fields'  => array(
		'lp_hero_style'    => 'agents',
		'lp_eyebrow'       => 'Agentic QA & Testing',
		'lp_title'         => 'Agentic QA that delivers near-zero defect releases',
		'lp_title_highlight' => 'near-zero defect releases',
		'lp_intro'         => 'Deploy autonomous AI agents that predict failure points and self-generate complex test scenarios. Ensure near-zero defect releases with QA frameworks that evolve as fast as your code.',
		'lp_cta_label'     => 'Book a QA consultation',
		'lp_cta2_label'    => 'See capabilities',
		'lp_cta2_link'     => '#use-cases',
		'lp_prompt'        => 'Generate regression tests for the new checkout flow',
		'lp_agents'        => array( array( 'name' => 'Risk Analyzer' ), array( 'name' => 'Test Generator' ), array( 'name' => 'Regression Runner' ) ),
		'lp_form_heading'  => 'Let us review your QA process',
		'lp_form_text'     => 'Tell us about your product and current testing. We will show where agentic QA can reduce defects and release time.',
		'lp_cards_eyebrow' => 'Capabilities',
		'lp_cards_heading' => 'Autonomous testing across your stack',
		'lp_cards'         => ace_cards( array(
			array( 'Failure prediction', 'AI analyses code changes and history to focus testing where defects are most likely.' ),
			array( 'Self-generated test scenarios', 'Agents create unit, API and end-to-end tests, including complex edge cases.' ),
			array( 'Self-healing automation', 'UI tests adapt to interface changes instead of breaking on every release.' ),
			array( 'CI/CD integration', 'Fast, reliable feedback on every pull request in the pipeline you already use.' ),
			array( 'Performance & security checks', 'Automated load, regression and security testing built into the release process.' ),
			array( 'Clear quality reporting', 'Dashboards that show coverage, risk and release readiness at a glance.' ),
		) ),
		'lp_steps'         => $default_steps,
		'lp_faq'           => ace_faq( array(
			array( 'What is agentic QA?', 'Agentic QA uses AI agents that understand your code and requirements, decide what to test, generate the tests and run them automatically, alongside your QA engineers.' ),
			array( 'Does it replace our QA team?', 'No. It removes repetitive test writing and maintenance so your QA engineers can focus on test strategy, exploratory testing and product quality.' ),
			array( 'Can it work with our existing test framework?', 'Yes. We generate tests for common frameworks and plug into your current CI/CD pipeline rather than replacing it.' ),
		) ),
	),
);

$pages[] = array(
	'slug'    => 'aiops-observability',
	'title'   => 'Intelligent AIOps & Observability',
	'excerpt' => 'AIOps and observability services: predictive analytics, AI anomaly detection and self-healing scripts for 99.9% uptime.',
	'content' => '<h2>Fix problems before users notice</h2><p>Modern systems produce more logs, metrics and alerts than any team can review. AIOps applies machine learning to that telemetry to spot unusual behaviour early, correlate related alerts and point engineers straight to the likely root cause.</p><h2>Self-healing operations</h2><p>For known issues we automate the fix: scaling resources, restarting unhealthy services or rolling back a bad deployment, with full audit logs and human approval for sensitive actions.</p>',
	'fields'  => array(
		'lp_hero_style'    => 'streaks',
		'lp_eyebrow'       => 'AIOps & Observability',
		'lp_title'         => 'Intelligent AIOps for 99.9% Uptime',
		'lp_intro'         => 'Bridge the dev-ops gap with predictive analytics to resolve infrastructure bottlenecks before they impact users. Maintain 99.9% uptime through self-healing scripts and AI-driven anomaly detection that prevents system downtime.',
		'lp_cta_label'     => 'Talk to an AIOps engineer',
		'lp_hero_features' => array(
			array( 'title' => 'Predict', 'text' => 'Forecast capacity issues and bottlenecks before they cause incidents.' ),
			array( 'title' => 'Detect', 'text' => 'AI anomaly detection that cuts alert noise and finds real problems.' ),
			array( 'title' => 'Self-heal', 'text' => 'Automated remediation for known issues, with audit trails.' ),
		),
		'lp_form_heading'  => 'Improve uptime and reduce alert fatigue',
		'lp_form_text'     => 'Share your current monitoring setup and biggest incidents. We will suggest where AIOps can help first.',
		'lp_cards_eyebrow' => 'Capabilities',
		'lp_cards_heading' => 'Operations that learn and improve',
		'lp_cards'         => ace_cards( array(
			array( 'Unified observability', 'Logs, metrics and traces brought together so teams see the full picture.' ),
			array( 'AI anomaly detection', 'Baselines learned from your systems flag unusual behaviour early.' ),
			array( 'Alert correlation', 'Related alerts grouped into one incident with the probable root cause.' ),
			array( 'Predictive scaling', 'Capacity planned ahead of demand to avoid slowdowns and over-spend.' ),
			array( 'Self-healing runbooks', 'Automated fixes for common failures, with approvals for risky actions.' ),
			array( 'Cloud cost insight', 'Spot waste and optimise infrastructure spend alongside reliability.' ),
		) ),
		'lp_steps'         => $default_steps,
		'lp_faq'           => ace_faq( array(
			array( 'What is AIOps?', 'AIOps (AI for IT operations) uses machine learning on logs, metrics and events to detect problems early, find root causes faster and automate responses.' ),
			array( 'Which cloud platforms do you support?', 'We work with major cloud providers and on-premise environments, and integrate with common monitoring and incident tools.' ),
			array( 'Are automated fixes safe?', 'Automated remediation is limited to well-understood issues, fully logged, and can require human approval for any sensitive action.' ),
		) ),
	),
);

$pages[] = array(
	'slug'    => 'ai-legacy-modernization',
	'title'   => 'AI-Powered Legacy Modernization',
	'excerpt' => 'AI-powered legacy modernization: automated refactoring of legacy monoliths into scalable, AI-native microservices.',
	'content' => '<h2>Modernize without a risky big-bang rewrite</h2><p>Legacy systems hold critical business logic but slow every new initiative. We use AI to analyse old code, map dependencies, document behaviour and generate refactored services, then migrate step by step so the business keeps running throughout.</p><h2>A core that is ready for AI</h2><p>The result is a modular, cloud-ready architecture with clean APIs and data access, so adding AI features, analytics and integrations becomes straightforward instead of a major project.</p>',
	'fields'  => array(
		'lp_hero_style'    => 'knot',
		'lp_eyebrow'       => 'Legacy Modernization',
		'lp_title'         => 'AI-Powered Legacy Modernization',
		'lp_intro'         => 'Rapidly transform legacy monoliths into scalable, AI-native microservices using automated refactoring. Eliminate technical debt and build a future-proof core ready for seamless next-gen AI integrations.',
		'lp_points'        => ace_points( array( 'Automated code analysis and refactoring', 'Step-by-step migration with no big-bang rewrite', 'A cloud-ready core prepared for AI features' ) ),
		'lp_cards_eyebrow' => 'How we modernize',
		'lp_cards_heading' => 'From monolith to modern, AI-ready platform',
		'lp_cards'         => ace_cards( array(
			array( 'AI code discovery', 'Automatically map modules, dependencies and business rules in large legacy codebases.' ),
			array( 'Automated documentation', 'Generate up-to-date documentation for code nobody fully understands any more.' ),
			array( 'Automated refactoring', 'AI-assisted conversion to modern languages, frameworks and service boundaries.' ),
			array( 'Incremental migration', 'Strangler-pattern rollout so old and new systems run side by side safely.' ),
			array( 'Cloud & data readiness', 'Containerised services, clean APIs and accessible data for analytics and AI.' ),
			array( 'Regression safety net', 'Automated tests confirm the new system behaves like the old one.' ),
		) ),
		'lp_steps'         => $default_steps,
		'lp_faq'           => ace_faq( array(
			array( 'Which legacy technologies can you modernize?', 'We work with a wide range of older stacks and monolithic applications. The first step is an assessment of your codebase to plan the safest migration path.' ),
			array( 'Will our business be disrupted during migration?', 'No big-bang switch-over. We migrate in stages, run old and new components side by side and verify behaviour with automated tests before each cut-over.' ),
			array( 'How does AI speed up modernization?', 'AI analyses and documents legacy code, proposes refactorings and generates tests, which removes much of the slow manual work in a modernization project.' ),
		) ),
	),
);

$pages[] = array(
	'slug'    => 'responsible-ai-security',
	'title'   => 'Responsible AI & Security Governance',
	'excerpt' => 'Responsible AI and security governance: guardrails, compliance, bias detection and hallucination controls for enterprise AI.',
	'content' => '<h2>Trustworthy AI from day one</h2><p>AI creates new risks: data leakage, prompt injection, biased or invented answers and unclear accountability. We design governance and security into every AI system we build, so your teams can innovate while your data, customers and reputation stay protected.</p><h2>Practical, auditable controls</h2><p>Our approach covers data protection, access control, model evaluation, monitoring and clear human oversight, documented in a way that supports your internal policies and external compliance requirements.</p>',
	'fields'  => array(
		'lp_hero_style'    => 'agents',
		'lp_eyebrow'       => 'Responsible AI',
		'lp_title'         => 'Responsible AI with enterprise-grade security built in',
		'lp_title_highlight' => 'enterprise-grade security',
		'lp_intro'         => 'Embed security guardrails and compliance into every model to protect your proprietary data and IP. Foster trust with built-in bias detection, hallucination controls, and ethically governed frameworks for enterprise-grade applications.',
		'lp_cta_label'     => 'Discuss AI governance',
		'lp_cta2_label'    => 'View controls',
		'lp_cta2_link'     => '#use-cases',
		'lp_prompt'        => 'Check this assistant for data leaks and bias',
		'lp_agents'        => array( array( 'name' => 'Guardrails' ), array( 'name' => 'Bias Monitor' ), array( 'name' => 'Audit Trail' ) ),
		'lp_form_heading'  => 'Make your AI safe to scale',
		'lp_form_text'     => 'Tell us about the AI systems you run or plan. We will suggest the guardrails and governance you need.',
		'lp_cards_eyebrow' => 'Controls',
		'lp_cards_heading' => 'Governance and security for every model',
		'lp_cards'         => ace_cards( array(
			array( 'Data & IP protection', 'Private deployments, data masking and strict access control so proprietary data stays yours.' ),
			array( 'Security guardrails', 'Defences against prompt injection, data exfiltration and misuse of AI features.' ),
			array( 'Hallucination controls', 'Grounding in your trusted sources, citations and confidence checks before answers reach users.' ),
			array( 'Bias detection', 'Testing and monitoring for unfair or harmful outputs across user groups.' ),
			array( 'Human oversight', 'Approval workflows and escalation for high-impact decisions and actions.' ),
			array( 'Audit & compliance', 'Logging, evaluation reports and documentation that support your compliance needs.' ),
		) ),
		'lp_steps'         => $default_steps,
		'lp_faq'           => ace_faq( array(
			array( 'What is responsible AI?', 'Responsible AI means designing AI systems that are secure, fair, transparent and accountable, with controls that protect users, data and the business.' ),
			array( 'How do you reduce AI hallucinations?', 'We ground answers in your approved data, add retrieval and citation, evaluate responses automatically and route low-confidence answers to people.' ),
			array( 'Can you review AI systems built by another team?', 'Yes. We can assess existing AI applications for security, data protection and quality risks and recommend practical fixes.' ),
		) ),
	),
);

$pages[] = array(
	'slug'    => 'llm-development',
	'title'   => 'LLM Development Services',
	'excerpt' => 'LLM development services: model selection, RAG, fine-tuning, LLM agents, evaluation, guardrails and secure deployment of GPT, Claude, Gemini, Llama and open-source models.',
	'content' => '<h2>What is a large language model (LLM)?</h2><p>A large language model is an AI model trained on vast amounts of text that can understand and generate language, write and review code, summarise documents, extract data and reason through multi-step tasks. Well-known families include OpenAI GPT, Anthropic Claude, Google Gemini, and open-source models such as Meta Llama, Mistral, DeepSeek and Qwen.</p>'
		. '<h2>RAG, fine-tuning or prompting?</h2><p>Most business use cases do not need a custom-trained model. <strong>Prompt engineering</strong> gets surprisingly far with a strong general model. <strong>Retrieval-augmented generation (RAG)</strong> connects the model to your own documents and data, so answers are current, grounded and cite their sources. <strong>Fine-tuning</strong> adapts a model to a specific style, format or narrow task, and can make a smaller, cheaper model perform like a larger one. We help you choose the simplest approach that meets your quality, cost and privacy goals.</p>'
		. '<h2>Hosted API or open-source model?</h2><p>Hosted models from providers such as OpenAI, Anthropic and Google offer top quality with no infrastructure to manage. Open-source models like Llama, Mistral or Qwen can run in your own cloud or data centre for full data control and predictable cost at scale. Many production systems combine both, routing each request to the most suitable model.</p>'
		. '<h2>From prototype to production</h2><p>A demo is easy; a reliable LLM product is not. We add evaluation datasets, guardrails against prompt injection and data leakage, monitoring of quality, latency and cost, and human review for sensitive actions, so your LLM features keep working as models and data change.</p>',
	'fields'  => array(
		'lp_hero_style'    => 'streaks',
		'lp_eyebrow'       => 'LLM Development',
		'lp_title'         => 'LLM Development Services for Real Business Use',
		'lp_intro'         => 'We build secure, production-ready applications on large language models: from RAG assistants and AI agents to fine-tuned and self-hosted open-source models, with evaluation and guardrails built in.',
		'lp_cta_label'     => 'Discuss your LLM project',
		'lp_hero_features' => array(
			array( 'title' => 'RAG assistants', 'text' => 'Answers grounded in your documents and data, with sources.' ),
			array( 'title' => 'Fine-tuning', 'text' => 'Adapt open-source or hosted models to your domain and format.' ),
			array( 'title' => 'Private LLMs', 'text' => 'Self-hosted models in your cloud for full data control.' ),
		),
		'lp_form_heading'  => 'Tell us about your LLM idea',
		'lp_form_text'     => 'Share your use case and data. We will recommend the right model, architecture and next steps.',
		'lp_cards_eyebrow' => 'LLM services',
		'lp_cards_heading' => 'Everything you need to build with LLMs',
		'lp_cards'         => ace_cards( array(
			array( 'LLM strategy & model selection', 'Compare GPT, Claude, Gemini, Llama, Mistral and others on your own tasks for quality, speed, cost and privacy.' ),
			array( 'RAG & knowledge assistants', 'Chat and search over your documents, wikis, tickets and databases, with citations and access control.' ),
			array( 'LLM agents & tool use', 'Agents that call your APIs, query data and complete multi-step workflows safely.', ace_url( 'ai-agent-development' ) ),
			array( 'Fine-tuning & distillation', 'LoRA / PEFT fine-tuning and distillation to make smaller models faster and cheaper.' ),
			array( 'Private & on-premise LLMs', 'Deploy open-source models with vLLM, Ollama or cloud GPUs inside your own environment.' ),
			array( 'Prompt engineering & structured output', 'Reliable prompts, JSON / schema outputs and function calling for production systems.' ),
			array( 'Evaluation & monitoring', 'Test datasets, automated scoring and tracing of quality, latency and cost in production.' ),
			array( 'Guardrails & security', 'Protection against prompt injection, data leakage, hallucinations and harmful output.', ace_url( 'responsible-ai-security' ) ),
			array( 'LLM integration', 'Add LLM features to your web, mobile and enterprise apps through clean, secure APIs.' ),
		) ),
		'lp_show_stack'    => 1,
		'lp_steps_heading' => 'How we deliver LLM projects',
		'lp_steps'         => ace_steps( array(
			array( 'Use case & data', 'Define the task, success metrics and the data the model needs.' ),
			array( 'Model bake-off', 'Test candidate models and approaches (prompting, RAG, fine-tuning) on real examples.' ),
			array( 'Build & integrate', 'Production pipeline, APIs, guardrails and integration with your systems.' ),
			array( 'Evaluate & operate', 'Continuous evaluation, monitoring and cost optimisation after launch.' ),
		) ),
		'lp_faq'           => ace_faq( array(
			array( 'Which LLM is best for my business?', 'It depends on the task, data sensitivity, latency and budget. We test several models on your real examples and recommend the best fit; often a mix of a large model for hard tasks and a smaller, cheaper one for routine work.' ),
			array( 'Should we use RAG or fine-tuning?', 'Use RAG when answers must reflect your own, changing documents and data. Use fine-tuning to teach a consistent style, format or narrow skill. Many solutions combine both.' ),
			array( 'Can we run an LLM privately?', 'Yes. Open-source models such as Llama, Mistral or Qwen can be deployed in your own cloud account or data centre so your data never leaves your environment.' ),
			array( 'How do you reduce hallucinations?', 'We ground answers in trusted sources with RAG, require citations, evaluate responses automatically, and route low-confidence answers to a person.' ),
			array( 'How much does an LLM application cost to run?', 'Costs depend on model choice, request volume and response length. We design for cost from the start with model routing, caching and smaller models where quality allows, and we monitor spend in production.' ),
		) ),
	),
);

/* Existing landing pages from create-ai-landing.php are kept and moved under the hub. */
$pages[] = array(
	'slug'    => 'ai-agent-development',
	'title'   => 'AI Agent Development',
	'excerpt' => 'Custom AI agent development: consulting, integration and operations for safe, reliable AI agents.',
	'content' => '<h2>What is an AI agent?</h2><p>An AI agent is software that can understand a goal, plan the steps, use your tools and data, and complete the work with little human input. Unlike a simple chatbot, an agent can look up records, update systems, draft responses and hand off to a person when it is unsure.</p><h2>Agents built for your business</h2><p>We design, build and run custom AI agents that connect to the systems you already use, such as your CRM, helpdesk, databases and internal APIs. Every agent ships with guardrails, logging and human review so you stay in control of quality, cost and security.</p>',
	'fields'  => array(
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
		'lp_cards'         => ace_cards( array(
			array( 'Customer support agents', 'Answer common questions, look up orders and accounts, and escalate complex cases to your team with full context.' ),
			array( 'Sales and lead qualification', 'Research inbound leads, enrich CRM records and route qualified opportunities to the right person.' ),
			array( 'Back-office automation', 'Process documents, reconcile data and keep systems in sync without copy-and-paste work.' ),
			array( 'Engineering copilots', 'Agents that review code, generate tests and triage incidents alongside your developers.' ),
			array( 'Knowledge assistants', 'Secure assistants that answer questions from your internal documents and policies.' ),
			array( 'Responsible AI by design', 'Guardrails, audit logs, data protection and human-in-the-loop approvals built into every agent.', ace_url( 'responsible-ai-security' ) ),
		) ),
		'lp_steps_heading' => 'From idea to agent in production',
		'lp_steps'         => ace_steps( array(
			array( 'Discover', 'Map the workflow, data sources and success metrics.' ),
			array( 'Prototype', 'A working agent on real examples, reviewed with your team.' ),
			array( 'Integrate', 'Connect to your systems with security and approval rules.' ),
			array( 'Launch & improve', 'Go live with monitoring, evaluation and ongoing tuning.' ),
		) ),
		'lp_faq'           => ace_faq( array(
			array( 'What is the difference between a chatbot and an AI agent?', 'A chatbot mainly answers questions. An AI agent can also take actions: look up data, update records, call APIs and complete multi-step tasks, with guardrails and human approval where needed.' ),
			array( 'Can AI agents work with our existing tools?', 'Yes. We connect agents to the systems you already use through their APIs or secure integrations, such as CRMs, helpdesks, databases and internal services.' ),
			array( 'How do you keep AI agents safe and accurate?', 'Every agent includes guardrails, logging, evaluation tests and escalation to a person when confidence is low. Sensitive actions can require human approval.' ),
		) ),
	),
);

$pages[] = array(
	'slug'    => 'ai-workflow-automation',
	'title'   => 'AI Workflow Automation',
	'excerpt' => 'AI workflow automation with teams of specialist AI agents for sales, support and operations.',
	'content' => '<h2>Automation that understands your work</h2><p>Traditional automation breaks when inputs change. AI-powered workflows read emails, documents and tickets the way a person would, decide what needs to happen next and coordinate a team of specialised agents to get it done, all inside the tools your team already uses.</p><h2>Designed with your team</h2><p>Your team describes the process in plain language; we turn it into reliable, monitored automations with clear owners, approval steps and reporting, so you can see exactly what each agent did and why.</p>',
	'fields'  => array(
		'lp_hero_style'      => 'agents',
		'lp_eyebrow'         => 'AI Workflow Automation',
		'lp_title'           => 'AI agents that drive business impact, built around your team',
		'lp_title_highlight' => 'business impact',
		'lp_intro'           => 'We build teams of specialist AI agents that run repetitive work on autopilot, from lead research to ticket triage, so your people can focus on decisions that matter.',
		'lp_cta_label'       => 'Book a demo',
		'lp_cta2_label'      => 'See use cases',
		'lp_cta2_link'       => '#use-cases',
		'lp_prompt'          => 'Build a team to work my inbound pipeline',
		'lp_agents'          => array( array( 'name' => 'Lead Researcher' ), array( 'name' => 'Inbound Qualifier' ), array( 'name' => 'Outreach Assistant' ) ),
		'lp_form_heading'    => 'Let us map your first automation',
		'lp_form_text'       => 'Tell us which process takes the most time today. We will suggest where agents can help and what results to expect.',
		'lp_cards_eyebrow'   => 'Use cases',
		'lp_cards_heading'   => 'Automate the work that slows your team down',
		'lp_cards'           => ace_cards( array(
			array( 'Sales pipeline', 'Research prospects, qualify inbound leads and prepare personalised outreach for your reps.' ),
			array( 'Support operations', 'Classify, prioritise and route tickets, and draft accurate replies from your knowledge base.' ),
			array( 'Finance & operations', 'Extract data from invoices and documents, reconcile records and flag exceptions for review.' ),
		) ),
		'lp_steps'           => ace_steps( array(
			array( 'Map', 'Pick one high-volume process and define what good looks like.' ),
			array( 'Build', 'Design the agent team, tools and approval steps.' ),
			array( 'Prove', 'Run it on real work and measure time saved and quality.' ),
			array( 'Scale', 'Roll out to more processes with monitoring in place.' ),
		) ),
		'lp_faq'             => ace_faq( array(
			array( 'Do we need technical staff to use these automations?', 'No. Your team describes the process and reviews results; we handle the engineering, integrations and monitoring.' ),
			array( 'Which processes are best to automate first?', 'High-volume, rules-heavy work that still needs judgement, such as lead qualification, ticket triage and document processing, usually gives the fastest return.' ),
		) ),
	),
);

$pages[] = array(
	'slug'    => 'ai-driven-software-development',
	'title'   => 'AI-Driven Software Development',
	'excerpt' => 'AI-driven software development services: agentic coding, autonomous QA, AIOps, legacy modernization and responsible AI governance.',
	'content' => '<h2>AI across your entire software lifecycle</h2><p>TechDotBit helps product teams adopt AI where it makes the biggest difference: writing and reviewing code, testing, running infrastructure, modernizing legacy systems and governing how models are used. Instead of bolting a chatbot onto an old process, we redesign the delivery workflow around agentic tools, so your engineers spend their time on architecture and business logic rather than boilerplate.</p><h2>Built for production, not demos</h2><p>Every engagement starts with your existing codebase, data and compliance requirements. We introduce AI step by step, measure the impact on delivery speed and quality, and keep humans in control of every release. Security guardrails, data protection and responsible-AI checks are part of the architecture from day one.</p>',
	'fields'  => array(
		'lp_hero_style'    => 'knot',
		'lp_eyebrow'       => 'AI Engineering Services',
		'lp_title'         => 'AI-Driven Software Development',
		'lp_intro'         => 'Leverage agentic AI across development, testing, operations and modernization to ship features faster, release with confidence and turn legacy systems into an AI-ready core.',
		'lp_points'        => ace_points( array( 'Accelerate feature delivery by up to 40%', 'Near-zero defect releases with autonomous QA', '99.9% uptime with self-healing AIOps' ) ),
		'lp_cards_eyebrow' => 'What we do',
		'lp_cards_heading' => 'AI services that cover the full delivery lifecycle',
		'lp_cards_intro'   => 'From the first line of code to production operations and governance.',
		'lp_cards'         => ace_cards( array(
			array( 'AI-Led Software Development', 'Transition to AI-augmented workflows using agentic tools to eliminate manual boilerplate. Focus on high-level architecture and logic to accelerate feature delivery by up to 40%.', ace_url( 'ai-led-software-development' ) ),
			array( 'Agentic Quality Assurance & Testing', 'Deploy autonomous AI agents that predict failure points and self-generate complex test scenarios. Ensure near-zero defect releases with QA frameworks that evolve as fast as your code.', ace_url( 'agentic-qa-testing' ) ),
			array( 'Intelligent AIOps & Observability', 'Bridge the dev-ops gap with predictive analytics to resolve infrastructure bottlenecks before they impact users. Maintain 99.9% uptime through self-healing scripts and AI-driven anomaly detection that prevents system downtime.', ace_url( 'aiops-observability' ) ),
			array( 'AI-Powered Legacy Modernization', 'Rapidly transform legacy monoliths into scalable, AI-native microservices using automated refactoring. Eliminate technical debt and build a future-proof core ready for seamless next-gen AI integrations.', ace_url( 'ai-legacy-modernization' ) ),
			array( 'Responsible AI & Security Governance', 'Embed security guardrails and compliance into every model to protect your proprietary data and IP. Foster trust with built-in bias detection, hallucination controls, and ethically governed frameworks for enterprise-grade applications.', ace_url( 'responsible-ai-security' ) ),
		) ),
		'lp_steps_heading' => 'How we work',
		'lp_steps'         => $default_steps,
		'lp_faq'           => ace_faq( array(
			array( 'What is AI-driven software development?', 'It is a way of building software where AI agents handle repetitive engineering work such as boilerplate code, test generation, refactoring and monitoring, while experienced engineers focus on architecture, business logic and review.' ),
			array( 'Can you work with our existing codebase?', 'Yes. Most engagements start with an existing product. We introduce AI tooling step by step and can modernize legacy systems into scalable services without a risky big-bang rewrite.' ),
			array( 'How do you keep our code and data secure?', 'Security and compliance are designed in from the start: access controls, data protection, guardrails around model use, and human review of every release. Your proprietary code and IP stay protected.' ),
			array( 'How quickly can we see results?', 'Teams typically see faster delivery and fewer defects within the first few sprints, as AI-assisted development and automated testing are put in place.' ),
		) ),
	),
);

$pages[] = array(
	'slug'    => 'ai-readiness-assessment',
	'title'   => 'Free AI Readiness Assessment',
	'excerpt' => 'Free AI readiness assessment: find the AI opportunities with the fastest return and get a practical, prioritised roadmap.',
	'content' => '<h2>What the assessment covers</h2><p>In a short, structured review we look at your goals, current systems, data and team skills. We identify the processes and product features where AI can deliver measurable value soonest, highlight risks around data, security and compliance, and estimate the effort involved.</p><h2>What you receive</h2><p>A clear, prioritised roadmap with recommended first projects, expected benefits and the steps needed to get started, whether you work with us or not.</p>',
	'fields'  => array(
		'lp_hero_style'     => 'knot',
		'lp_eyebrow'        => 'Free assessment',
		'lp_title'          => 'Free AI Readiness Assessment',
		'lp_intro'          => 'Find out where AI can make the biggest difference in your business. Get a practical, prioritised roadmap from engineers who build AI systems every day.',
		'lp_points'         => ace_points( array( 'Highest-value AI opportunities identified', 'Data, security and compliance risks reviewed', 'A prioritised roadmap you can act on' ) ),
		'lp_form_title'     => 'Request your free assessment',
		'lp_form_shortcode' => ACE_AUDIT_FORM,
		'lp_cards_eyebrow'  => 'What we review',
		'lp_cards_heading'  => 'A practical view of your AI potential',
		'lp_cards'          => ace_cards( array(
			array( 'Business processes', 'Where repetitive work, delays or errors could be reduced with AI agents and automation.' ),
			array( 'Products & customer experience', 'AI features that would make your product more useful, personal or efficient.' ),
			array( 'Engineering workflow', 'How AI-led development, testing and operations could speed up delivery.' ),
			array( 'Data readiness', 'Whether your data is accessible, reliable and governed well enough for AI.' ),
			array( 'Security & compliance', 'Risks to address before AI touches sensitive data or decisions.' ),
			array( 'Roadmap & quick wins', 'Recommended first projects with expected benefits and effort.' ),
		) ),
		'lp_steps_heading'  => 'How it works',
		'lp_steps'          => ace_steps( array(
			array( 'Share your goals', 'Fill in the short form and tell us what you want to improve.' ),
			array( 'Discovery call', 'A focused conversation with an AI engineer about your systems and data.' ),
			array( 'Analysis', 'We assess opportunities, risks and effort.' ),
			array( 'Your roadmap', 'You receive a prioritised plan with recommended next steps.' ),
		) ),
		'lp_faq'            => ace_faq( array(
			array( 'Is the AI readiness assessment really free?', 'Yes. There is no cost and no obligation. It helps you understand your options and helps us see if we are the right partner.' ),
			array( 'Who should take part?', 'Ideally a business or product owner and someone who knows your systems and data. We keep the time commitment short.' ),
			array( 'Do we need to share sensitive data?', 'No. The assessment is based on conversations and high-level information. We can sign an NDA if you prefer.' ),
		) ),
	),
);

/* Industry pages */
$industries = array(
	array(
		'slug' => 'ai-for-fintech', 'title' => 'AI for Fintech', 'style' => 'streaks',
		'excerpt' => 'AI solutions for fintech: fraud detection, intelligent onboarding, AI customer support and compliance automation.',
		'h1' => 'AI Solutions for Fintech',
		'intro' => 'Build faster, safer financial products with AI that detects fraud, speeds up onboarding, supports customers and automates compliance work, all with the security and auditability finance requires.',
		'features' => array( array( 'Fraud & risk', 'Detect suspicious activity earlier with machine learning.' ), array( 'Onboarding & KYC', 'Automate document checks and verification steps.' ), array( 'Compliance', 'Monitor, summarise and report with full audit trails.' ) ),
		'cards' => array(
			array( 'Fraud detection', 'Models that learn normal behaviour and flag unusual transactions in real time.' ),
			array( 'Intelligent KYC & onboarding', 'AI document extraction and verification that shortens onboarding.' ),
			array( 'AI customer support', 'Secure assistants that answer account questions and escalate when needed.' ),
			array( 'Credit & risk insights', 'Better risk signals from transaction and behavioural data.' ),
			array( 'Compliance automation', 'Summarise regulations, monitor communications and prepare reports.' ),
			array( 'Secure, auditable AI', 'Data protection, explainability and logs that support regulatory review.', ace_url( 'responsible-ai-security' ) ),
		),
		'faq' => array(
			array( 'Is AI safe to use with financial data?', 'Yes, with the right controls: private deployments, encryption, strict access rules, explainable decisions and audit logs. We design these in from the start.' ),
			array( 'Can AI help with regulatory compliance?', 'AI can monitor transactions and communications, summarise regulatory changes and prepare reports, while compliance teams keep final responsibility.' ),
		),
	),
	array(
		'slug' => 'ai-for-healthcare', 'title' => 'AI for Healthcare', 'style' => 'agents',
		'excerpt' => 'AI solutions for healthcare: clinical documentation, patient engagement, medical document processing and operations automation.',
		'h1' => 'AI solutions that give healthcare teams more time for patients',
		'hl' => 'more time for patients',
		'intro' => 'We help healthcare providers and health-tech companies reduce administrative work, improve patient engagement and make better use of their data, with privacy and safety built in.',
		'prompt' => 'Summarise this patient referral and book a follow-up',
		'agents' => array( 'Document Reader', 'Care Coordinator', 'Scheduling Assistant' ),
		'cards' => array(
			array( 'Clinical documentation', 'AI that drafts notes and summaries for clinicians to review and approve.' ),
			array( 'Patient engagement', 'Assistants that answer common questions, send reminders and support scheduling.' ),
			array( 'Medical document processing', 'Extract and organise information from referrals, forms and reports.' ),
			array( 'Operations automation', 'Streamline billing, claims and administrative workflows.' ),
			array( 'Health data insights', 'Analytics that help teams spot trends and improve outcomes.' ),
			array( 'Privacy & safety first', 'Data protection, access control and human oversight for every AI decision.', ace_url( 'responsible-ai-security' ) ),
		),
		'faq' => array(
			array( 'How do you protect patient data?', 'We follow strict data protection practices: minimal data access, encryption, private deployments where needed and full audit logs, aligned with the regulations that apply to you.' ),
			array( 'Does AI make clinical decisions?', 'No. Our healthcare solutions support clinicians and staff; people remain responsible for clinical decisions.' ),
		),
	),
	array(
		'slug' => 'ai-for-ecommerce', 'title' => 'AI for E-commerce', 'style' => 'knot',
		'excerpt' => 'AI solutions for e-commerce: personalised recommendations, AI shopping assistants, demand forecasting and catalogue automation.',
		'h1' => 'AI Solutions for E-commerce',
		'intro' => 'Grow conversion and average order value with AI that personalises the shopping experience, answers customers instantly, forecasts demand and keeps your catalogue up to date.',
		'points' => array( 'Personalised product recommendations', 'AI shopping and support assistants', 'Smarter inventory and demand forecasting' ),
		'cards' => array(
			array( 'Personalised recommendations', 'Suggest the right products based on browsing, purchases and context.' ),
			array( 'AI shopping assistant', 'Help customers find products, compare options and complete purchases.' ),
			array( 'Customer support automation', 'Resolve order, delivery and return questions instantly, around the clock.' ),
			array( 'Demand forecasting', 'Plan stock and promotions with better predictions.' ),
			array( 'Catalogue automation', 'Generate and improve product descriptions, attributes and tags at scale.' ),
			array( 'Search that understands intent', 'Semantic search that finds what shoppers mean, not just what they type.' ),
		),
		'faq' => array(
			array( 'Can AI integrate with our e-commerce platform?', 'Yes. We integrate AI features with popular e-commerce platforms and custom stores through their APIs.' ),
			array( 'Where does AI usually deliver the fastest return in e-commerce?', 'Personalised recommendations, smarter search and automated customer support are often the quickest wins.' ),
		),
	),
);

foreach ( $industries as $ind ) {
	$fields = array(
		'lp_hero_style'    => $ind['style'],
		'lp_eyebrow'       => $ind['title'],
		'lp_title'         => $ind['h1'],
		'lp_intro'         => $ind['intro'],
		'lp_cta_label'     => 'Talk to an AI expert',
		'lp_form_heading'  => 'Explore AI for your business',
		'lp_form_text'     => 'Tell us about your product and goals. We will suggest the AI use cases with the fastest return.',
		'lp_cards_eyebrow' => 'Use cases',
		'lp_cards_heading' => 'Where AI makes a difference in ' . str_replace( 'AI for ', '', $ind['title'] ),
		'lp_cards'         => ace_cards( $ind['cards'] ),
		'lp_steps'         => $default_steps,
		'lp_faq'           => ace_faq( $ind['faq'] ),
	);
	if ( ! empty( $ind['features'] ) ) {
		$fields['lp_hero_features'] = array_map( function ( $f ) { return array( 'title' => $f[0], 'text' => $f[1] ); }, $ind['features'] );
	}
	if ( ! empty( $ind['points'] ) ) {
		$fields['lp_points'] = ace_points( $ind['points'] );
	}
	if ( ! empty( $ind['hl'] ) ) {
		$fields['lp_title_highlight'] = $ind['hl'];
		$fields['lp_prompt']          = $ind['prompt'];
		$fields['lp_agents']          = array_map( function ( $a ) { return array( 'name' => $a ); }, $ind['agents'] );
		$fields['lp_cta2_label']      = 'See use cases';
		$fields['lp_cta2_link']       = '#use-cases';
	}
	$pages[] = array(
		'slug'    => $ind['slug'],
		'title'   => $ind['title'],
		'excerpt' => $ind['excerpt'],
		'content' => '<h2>' . esc_html( $ind['title'] ) . ' with TechDotBit</h2><p>We combine AI engineering with an understanding of how your industry works: its data, its customers and its rules. Every solution is designed to integrate with your existing systems, protect sensitive information and deliver results you can measure, starting with a focused first project and scaling from there.</p>',
		'fields'  => $fields,
	);
}

/* -------------------------------------------------------------------------
 * Dashboard showcase (illustrative example data, labelled as such on the page)
 * ---------------------------------------------------------------------- */
function ace_dash_tab( $label, $kpis, $rows ) {
	return array(
		'label' => $label,
		'kpis'  => array_map( function ( $k ) { return array( 'label' => $k[0], 'value' => $k[1], 'note' => $k[2], 'trend' => $k[3] ); }, $kpis ),
		'rows'  => array_map( function ( $r ) { return array( 'task' => $r[0], 'agent' => $r[1], 'model' => $r[2], 'status' => $r[3], 'cost' => $r[4] ); }, $rows ),
	);
}
$dash = array(
	'lp_dash_heading' => 'See your AI agents at work',
	'lp_dash_text'    => 'Every agent we deliver comes with monitoring for volume, cost and quality, so you always know what it is doing and what it is worth.',
	'lp_dash_note'    => 'Illustrative example. Figures vary by project.',
	'lp_dash_tabs'    => array(
		ace_dash_tab( 'Sales', array(
			array( 'Tasks run / mo', '42,800', '3.1x this year', 'up' ),
			array( 'Hours saved / mo', '1,250', 'up from 380', 'up' ),
			array( 'Avg cost / task', '$0.04', 'down from $0.11', 'down' ),
			array( 'Eval pass rate', '95.8%', 'bar held at 90%', 'up' ),
		), array(
			array( 'Enrich account in CRM', 'Research Agent', 'GPT-4o mini', 'Running', '$0.02' ),
			array( 'Qualify inbound lead', 'Qualifier Agent', 'Claude Haiku', '97%', '$0.03' ),
			array( 'Draft follow-up email', 'Outreach Agent', 'Gemini Flash', '94%', '$0.01' ),
		) ),
		ace_dash_tab( 'Support', array(
			array( 'Tickets handled / mo', '18,400', '2.4x this year', 'up' ),
			array( 'First response time', '45 sec', 'down from 6 hrs', 'down' ),
			array( 'Avg cost / ticket', '$0.06', 'down from $0.15', 'down' ),
			array( 'Resolution accuracy', '96.2%', 'bar held at 92%', 'up' ),
		), array(
			array( 'Classify & route ticket', 'Triage Agent', 'Claude Haiku', 'Running', '$0.01' ),
			array( 'Draft reply from knowledge base', 'Resolution Agent', 'GPT-4o', '96%', '$0.04' ),
			array( 'Summarise escalation', 'Handoff Agent', 'Gemini Flash', '98%', '$0.01' ),
		) ),
		ace_dash_tab( 'Operations', array(
			array( 'Documents processed / mo', '9,600', '4.2x this year', 'up' ),
			array( 'Manual hours / mo', '140', 'down from 610', 'down' ),
			array( 'Avg cost / document', '$0.08', 'down from $0.19', 'down' ),
			array( 'Extraction accuracy', '98.1%', 'bar held at 95%', 'up' ),
		), array(
			array( 'Extract invoice data', 'Document Agent', 'GPT-4o', 'Running', '$0.05' ),
			array( 'Reconcile with ledger', 'Finance Agent', 'Claude Sonnet', '97%', '$0.06' ),
			array( 'Flag exceptions for review', 'Review Agent', 'Gemini Flash', '99%', '$0.01' ),
		) ),
	),
);
foreach ( $pages as &$pg ) {
	if ( in_array( $pg['slug'], array( 'ai-agent-development', 'ai-workflow-automation' ), true ) ) {
		$pg['fields'] = array_merge( $pg['fields'], $dash );
	}
}
unset( $pg );

/* -------------------------------------------------------------------------
 * Save everything
 * ---------------------------------------------------------------------- */
WP_CLI::log( 'Saving AI pages:' );
$hub_id = ace_save_page( $hub, 0, 0 );
foreach ( $pages as $i => $p ) {
	ace_save_page( $p, $hub_id, $i + 1 );
}
WP_CLI::success( 'Done. Review the drafts under Pages, then publish. Hub: ' . get_preview_post_link( $hub_id ) );
