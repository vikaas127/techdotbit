<?php
/**
 * TechDotBit AI agent library: categories -> agents -> what each agent does.
 * Used by the homepage "What we build" section and the Agent Library page.
 * Change via the 'ace_ai_agents' filter.
 */
if ( ! function_exists( 'ace_ai_agents' ) ) {
	function ace_ai_agents() {
		return apply_filters( 'ace_ai_agents', array(
			'management' => array(
				'title' => 'Management Agents',
				'intro' => 'Agents that plan, coordinate and report, so managers spend time on decisions instead of follow-ups.',
				'icon'  => '<path d="M12 2a4 4 0 0 1 4 4v1a4 4 0 0 1-8 0V6a4 4 0 0 1 4-4Z"/><path d="M4 21v-1a6 6 0 0 1 6-6h4a6 6 0 0 1 6 6v1"/>',
				'agents' => array(
					array( 'Project Manager Agent', 'Keeps every project on plan.', array( 'Creates project plans and timelines', 'Tracks tasks and progress across teams', 'Identifies delays before they happen', 'Assigns and rebalances work', 'Generates weekly status reports', 'Escalates risks to the right person' ) ),
					array( 'Product Manager Agent', 'Turns ideas into clear, buildable requirements.', array( 'Analyses requirements and feedback', 'Writes product specifications', 'Generates user stories', 'Defines acceptance criteria', 'Maintains the product roadmap' ) ),
					array( 'Reporting & Analytics Agent', 'Your business numbers, explained automatically.', array( 'Collects data from ERP, CRM and spreadsheets', 'Compares results with targets and last period', 'Flags anomalies and trends', 'Writes management reports in plain language', 'Sends reports on schedule' ) ),
					array( 'Documentation Agent', 'Documentation that is always up to date.', array( 'Writes SOPs, manuals and release notes', 'Keeps technical docs in sync with code', 'Answers questions from your documents', 'Translates and formats content' ) ),
					array( 'Research Agent', 'Hours of research done in minutes.', array( 'Researches markets, competitors and companies', 'Summarises reports and long documents', 'Collects sources and cites them', 'Prepares briefing notes for meetings' ) ),
				),
			),
			'engineering' => array(
				'title' => 'Quality & Engineering Agents',
				'intro' => 'Your autonomous software engineering and testing team, working alongside your developers.',
				'icon'  => '<path d="m8 9-4 3 4 3M16 9l4 3-4 3M13.5 5l-3 14"/>',
				'agents' => array(
					array( 'QA / Testing Agent', 'Your autonomous software testing team.', array( 'Reads requirements and creates test cases', 'Executes functional and regression tests', 'Identifies and documents defects', 'Re-tests fixes automatically', 'Generates QA reports for every release' ) ),
					array( 'Code Review Agent', 'A senior reviewer on every pull request.', array( 'Reviews code for bugs and bad patterns', 'Checks standards and best practices', 'Suggests clear, specific fixes', 'Explains changes to reviewers' ) ),
					array( 'Bug Analysis Agent', 'From bug report to root cause, faster.', array( 'Reproduces reported issues', 'Analyses logs and stack traces', 'Finds the likely root cause', 'Proposes a fix and test' ) ),
					array( 'Security Testing Agent', 'Finds vulnerabilities before attackers do.', array( 'Scans code and dependencies', 'Tests for common web vulnerabilities', 'Checks access control and secrets', 'Prioritises fixes by risk' ) ),
					array( 'Release Agent', 'Calm, predictable releases.', array( 'Prepares release checklists', 'Verifies builds and test results', 'Writes release notes', 'Monitors after deployment and alerts on issues' ) ),
				),
			),
			'business' => array(
				'title' => 'Business Agents',
				'intro' => 'Agents that run day-to-day work in sales, service, finance, purchase, inventory and HR.',
				'icon'  => '<rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M3 13h18"/>',
				'agents' => array(
					array( 'Sales Agent', 'More qualified pipeline with less admin.', array( 'Researches and qualifies leads', 'Drafts personalised follow-ups', 'Prepares quotations', 'Tracks deals and reminds the team' ) ),
					array( 'CRM Agent', 'A CRM that updates itself.', array( 'Logs calls, emails and meetings', 'Enriches and de-duplicates records', 'Keeps deal stages accurate', 'Highlights accounts that need attention' ) ),
					array( 'Customer Support Agent', 'Fast, accurate answers, day and night.', array( 'Answers common questions from your knowledge base', 'Looks up orders and account details', 'Creates and routes tickets', 'Escalates complex cases with full context' ) ),
					array( 'Finance Agent', 'Cleaner books with less manual work.', array( 'Processes invoices and bills', 'Reconciles payments and ledgers', 'Tracks receivables and sends reminders', 'Prepares cash-flow summaries' ) ),
					array( 'Purchase Agent', 'The right material at the right price.', array( 'Analyses demand and stock levels', 'Recommends purchase quantities', 'Compares vendor quotes', 'Drafts purchase orders for approval' ) ),
					array( 'Inventory Agent', 'No more stock-outs or dead stock.', array( 'Monitors stock in real time', 'Identifies low and slow-moving items', 'Checks open purchase orders', 'Recommends reorders and transfers' ) ),
					array( 'HR Agent', 'Smoother hiring and people operations.', array( 'Screens CVs against job requirements', 'Schedules interviews', 'Answers employee policy questions', 'Prepares onboarding checklists' ) ),
				),
			),
			'industry' => array(
				'title' => 'Industry Agents',
				'intro' => 'Agents built around how your industry actually works, from the order to the dispatch.',
				'icon'  => '<path d="M3 21V9l6 4V9l6 4V5h6v16H3Z"/><path d="M7 17h2M11 17h2M15 17h2"/>',
				'flow'  => array( 'Sales', 'Production', 'Purchase', 'Inventory', 'Quality', 'Dispatch' ),
				'industries' => array( 'Plywood', 'Tape', 'Footwear', 'Lamination', 'ACP', 'Metallic', 'FMCG', 'Service businesses' ),
				'agents' => array(
					array( 'Manufacturing Agent', 'Understands your whole order-to-dispatch cycle.', array( 'Turns sales orders into production plans', 'Checks raw material and triggers purchase', 'Tracks work in progress and machine load', 'Monitors quality and rejection rates', 'Plans dispatch and updates customers' ) ),
					array( 'Production Planning Agent', 'Smarter schedules for your shop floor.', array( 'Plans batches by priority and due date', 'Balances machine and labour capacity', 'Re-plans when orders or materials change', 'Alerts supervisors to bottlenecks' ) ),
					array( 'Quality Agent', 'Consistent quality, fewer rejections.', array( 'Records inspections and test results', 'Spots patterns in defects', 'Links issues to batches, machines and suppliers', 'Recommends corrective actions' ) ),
					array( 'Distribution & Dispatch Agent', 'On-time delivery, every time.', array( 'Plans dispatch by route and priority', 'Prepares delivery documents', 'Tracks shipments and proof of delivery', 'Keeps customers and sales teams informed' ) ),
				),
			),
		) );
	}
}
