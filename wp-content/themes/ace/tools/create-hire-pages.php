<?php
/**
 * "Hire" pages for AI-era roles (AI engineers, Gen AI engineers, LLM, agent,
 * ML, MLOps, data, Python, AI QA and ERP developers) on the AI Landing Page
 * template, plus a new set of options under the main menu's "Hire" item.
 *
 * Run from the WordPress root:
 *   wp eval-file wp-content/themes/ace/tools/create-hire-pages.php           # add missing pages, publish, update menu
 *   wp eval-file wp-content/themes/ace/tools/create-hire-pages.php refresh   # also re-write pages created by this script
 *   wp eval-file wp-content/themes/ace/tools/create-hire-pages.php nomenu    # skip the menu step
 *
 * Pages live at the site root (like the existing /hire-full-stack-developers/).
 * Existing pages not created by this script are never changed. The menu step
 * replaces the links under "Hire" (the old pages themselves are kept).
 */

if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
	exit; // CLI only.
}

$ace_args    = isset( $args ) ? (array) $args : array();
$ace_refresh = in_array( 'refresh', $ace_args, true );
$ace_menu    = ! in_array( 'nomenu', $ace_args, true );

/* -------------------------------------------------------------------------
 * Roles
 * ---------------------------------------------------------------------- */
$ace_roles = array(
	array(
		'slug'  => 'hire-ai-engineers',
		'nav'   => 'AI Engineers',
		'title' => 'Hire AI Engineers',
		'seo'   => 'Hire AI Engineers in India | Dedicated AI Developers',
		'meta'  => 'Hire AI engineers who design, build and ship production AI: LLM apps, AI agents, ML models and integrations. Dedicated or project-based teams from India.',
		'focus' => 'hire ai engineers',
		'intro' => 'Dedicated AI engineers who turn ideas into production AI features, from LLM apps and AI agents to ML models wired into your products and workflows.',
		'points'=> array( 'Production-focused AI engineers, not just prototypes', 'Full-time, part-time or project-based', 'Start with a short paid pilot' ),
		'about' => array(
			'An AI engineer sits between data science and software engineering. They pick the right model for a problem, connect it to your data and systems, and make it reliable, secure and affordable to run. Most of the work is engineering: APIs, data pipelines, evaluation, monitoring and the user experience around the model.',
			'Our AI engineers work with large language models, retrieval (RAG), AI agents, computer vision and classical machine learning. They write tested, documented code that your own team can maintain, and they measure quality with evaluations instead of demos.',
		),
		'builds'=> array( 'AI copilots and assistants inside your web and mobile apps', 'Retrieval-augmented search over documents, policies and product data', 'AI agents that update CRM, ERP and ticketing systems', 'Document and invoice extraction pipelines', 'Forecasting, scoring and recommendation models', 'Evaluation, monitoring and cost dashboards for AI features' ),
		'cards' => array( array( 'LLM applications', 'Chat, search and copilots built on OpenAI, Anthropic, Gemini or open-source models.' ), array( 'AI agents', 'Agents that plan, call tools and complete multi-step work with human approval.' ), array( 'RAG and knowledge', 'Vector search, chunking and citations so answers come from your own data.' ), array( 'ML models', 'Classification, forecasting and anomaly detection with scikit-learn and PyTorch.' ), array( 'Integrations', 'APIs and connectors into your CRM, ERP, databases and internal tools.' ), array( 'Evaluation & safety', 'Test sets, guardrails, monitoring and cost control for production AI.' ) ),
		'faq'   => array( array( 'What does an AI engineer do?', 'An AI engineer builds software features powered by AI models. That includes choosing models, preparing data, building retrieval and agent logic, integrating with your systems, and setting up evaluation and monitoring so the feature stays accurate and affordable in production.' ), array( 'AI engineer or data scientist: which do I need?', 'If you need to ship an AI feature in a product or workflow, start with an AI engineer. If you mainly need research, statistical analysis or new model development on your own data, a data scientist or ML engineer is a better fit. Many projects use both.' ) ),
	),
	array(
		'slug'  => 'hire-generative-ai-engineers',
		'nav'   => 'Gen AI Engineers',
		'title' => 'Hire Generative AI Engineers',
		'seo'   => 'Hire Generative AI Engineers | Gen AI Developers India',
		'meta'  => 'Hire generative AI engineers to build chatbots, copilots, RAG search, content and document automation with GPT, Claude, Gemini and open-source LLMs.',
		'focus' => 'hire generative ai engineers',
		'intro' => 'Gen AI engineers who build chatbots, copilots, RAG search and document automation that work on your data, with the guardrails your business needs.',
		'points'=> array( 'GPT, Claude, Gemini, Llama and Mistral', 'RAG, fine-tuning and prompt engineering', 'Secure, monitored deployments' ),
		'about' => array(
			'Generative AI engineers specialise in applications built on large language and image models. They know when a prompt is enough, when retrieval is needed and when fine-tuning pays off, and they design the user experience so people can trust the output.',
			'We help companies move from a promising demo to a dependable product: grounded answers with citations, structured outputs, guardrails against unsafe content, and cost and latency budgets that hold up at scale.',
		),
		'builds'=> array( 'Customer support and sales assistants grounded in your knowledge base', 'Internal knowledge search across documents, SOPs and tickets', 'Proposal, report and content generation with your templates and tone', 'Document understanding: contracts, invoices, forms and emails', 'Multimodal features using images, audio and text', 'Fine-tuned or distilled models for lower cost and latency' ),
		'cards' => array( array( 'Chatbots & copilots', 'Conversational assistants for customers and teams, with handoff to people.' ), array( 'RAG pipelines', 'Ingestion, embeddings, vector databases and citation-backed answers.' ), array( 'Prompt engineering', 'Structured prompts, tool calling and JSON outputs that are tested, not guessed.' ), array( 'Fine-tuning', 'LoRA and instruction tuning when prompts and retrieval are not enough.' ), array( 'Guardrails', 'Content filters, PII redaction, grounding checks and approval steps.' ), array( 'LLMOps', 'Tracing, evaluations, model routing and cost monitoring in production.' ) ),
		'faq'   => array( array( 'Which LLM will you use?', 'We pick the model per use case after testing on your data: hosted models such as GPT, Claude or Gemini for quality, or open-source models such as Llama or Mistral when data must stay in your environment or cost matters most. Many solutions route between models.' ), array( 'Is our data safe with generative AI?', 'We use enterprise APIs that do not train on your data, or self-hosted models, and add access control, redaction of sensitive fields and audit logs. Security and data-residency requirements are agreed before any build starts.' ) ),
	),
	array(
		'slug'  => 'hire-llm-engineers',
		'nav'   => 'LLM Engineers',
		'title' => 'Hire LLM Engineers',
		'seo'   => 'Hire LLM Engineers | RAG, Fine-Tuning & LLMOps Experts',
		'meta'  => 'Hire LLM engineers for RAG systems, fine-tuning, evaluation and LLMOps. Build accurate, fast and cost-efficient large language model applications.',
		'focus' => 'hire llm engineers',
		'intro' => 'LLM engineers who make large language model features accurate, fast and cost-efficient, with retrieval, evaluation and the right model for each task.',
		'points'=> array( 'RAG, fine-tuning and model routing', 'Evaluation suites and tracing', 'Hosted or self-hosted models' ),
		'about' => array(
			'LLM engineering is the discipline of making language models behave predictably. It covers retrieval design, prompt and tool schemas, evaluation datasets, model selection, caching, batching and deployment of open-source models on your own infrastructure.',
			'Our LLM engineers are useful when a first version exists but quality, latency or cost is not good enough, or when you need a model that runs privately inside your own cloud.',
		),
		'builds'=> array( 'Hybrid search (keyword + vector) with re-ranking', 'Evaluation datasets and automated regression tests for prompts', 'Self-hosted models with vLLM, Ollama or managed endpoints', 'Model routing between large and small models to control cost', 'Fine-tuned models for classification, extraction and tone', 'Tracing and analytics with LangSmith, Langfuse or OpenTelemetry' ),
		'cards' => array( array( 'Retrieval design', 'Chunking, embeddings, metadata filters and re-rankers tuned on your data.' ), array( 'Fine-tuning', 'Supervised and parameter-efficient tuning with clear before/after evaluations.' ), array( 'Self-hosting', 'Open-source models served on GPUs in your cloud for privacy and cost.' ), array( 'Evaluation', 'Golden datasets, LLM-as-judge and human review to track quality.' ), array( 'Performance', 'Caching, streaming, batching and smaller models to cut latency.' ), array( 'Frameworks', 'LangChain, LlamaIndex, LangGraph, DSPy and plain Python where simpler.' ) ),
		'faq'   => array( array( 'Can you improve an LLM app we already built?', 'Yes. We usually start with an evaluation of the current system on real questions, then improve retrieval, prompts or model choice step by step, measuring each change so you can see quality, latency and cost move.' ), array( 'Do we need fine-tuning?', 'Often not. Better retrieval and structured prompts solve most quality problems. Fine-tuning helps when you need a consistent format or tone, a narrow classification task, or a smaller, cheaper model that matches a larger one.' ) ),
	),
	array(
		'slug'  => 'hire-ai-agent-developers',
		'nav'   => 'AI Agent Developers',
		'title' => 'Hire AI Agent Developers',
		'seo'   => 'Hire AI Agent Developers | Agentic AI Engineers India',
		'meta'  => 'Hire AI agent developers to build agents that plan, use tools and complete business tasks in your CRM, ERP, email and apps, with approvals and audit logs.',
		'focus' => 'hire ai agent developers',
		'intro' => 'Agent developers who build AI agents that plan, use your tools and finish real business tasks, with human approval wherever it matters.',
		'points'=> array( 'Single and multi-agent systems', 'Tool calling into CRM, ERP and apps', 'Approvals, audit logs and monitoring' ),
		'about' => array(
			'AI agents go beyond chat: they understand a goal, plan steps, call tools and APIs, check results and hand exceptions to a person. Building them well is mostly about clear tools, permissions, state and testing.',
			'Our agent developers design agents around a real process (lead qualification, purchase planning, ticket triage, report preparation) and connect them to the systems where the work happens. See our [[ai-agent-library|agent library]] for examples.',
		),
		'builds'=> array( 'Sales, support and purchase agents connected to your systems', 'Multi-agent workflows with planner, worker and reviewer roles', 'Agents inside ERP and CRM that prepare records for approval', 'Browser and email agents for repetitive back-office tasks', 'Agent dashboards with task history, cost and quality', 'Human-in-the-loop approval steps and escalation rules' ),
		'cards' => array( array( 'Agent design', 'Goals, tools, permissions and stop conditions defined around your process.' ), array( 'Tool calling', 'Secure connectors into APIs, databases, ERP, CRM, email and documents.' ), array( 'Multi-agent', 'LangGraph, CrewAI, AutoGen or custom orchestration where it adds value.' ), array( 'Memory & state', 'Short- and long-term memory so agents keep context across runs.' ), array( 'Guardrails', 'Approvals, spending limits, sandboxing and full audit trails.' ), array( 'Monitoring', 'Traces, success rates and cost per task for every agent.' ) ),
		'faq'   => array( array( 'What can an AI agent do in our business?', 'Agents work best on repeatable, rule-guided tasks: qualifying leads and updating the CRM, preparing purchase orders from stock levels, triaging tickets, reconciling documents or compiling reports. A person approves anything important before it is final.' ), array( 'Which agent frameworks do you use?', 'We use LangGraph, CrewAI, the OpenAI Agents SDK, the Claude Agent SDK and plain code with function calling, choosing the simplest option that meets the need. The agent logic stays in your repository and is fully documented.' ) ),
	),
	array(
		'slug'  => 'hire-machine-learning-engineers',
		'nav'   => 'ML Engineers',
		'title' => 'Hire Machine Learning Engineers',
		'seo'   => 'Hire Machine Learning Engineers | ML Developers India',
		'meta'  => 'Hire machine learning engineers for forecasting, classification, recommendation, computer vision and anomaly detection, deployed and monitored in production.',
		'focus' => 'hire machine learning engineers',
		'intro' => 'ML engineers who build and deploy models for forecasting, scoring, recommendation, computer vision and anomaly detection on your own data.',
		'points'=> array( 'From data exploration to deployment', 'Python, scikit-learn, PyTorch, XGBoost', 'Models monitored for drift' ),
		'about' => array(
			'Machine learning engineers turn historical data into models that predict, classify or detect. Unlike one-off analysis, their models run every day inside your products and processes, so they care about data pipelines, retraining and monitoring as much as accuracy.',
			'Typical projects include demand forecasting for inventory, credit or lead scoring, quality inspection with computer vision, predictive maintenance and personalised recommendations.',
		),
		'builds'=> array( 'Demand and sales forecasting for planning and inventory', 'Lead, churn and risk scoring models', 'Computer vision for inspection, counting and safety', 'Predictive maintenance from machine and sensor data', 'Recommendation and ranking systems', 'Anomaly and fraud detection on transactions' ),
		'cards' => array( array( 'Forecasting', 'Time-series models for demand, sales, cash flow and capacity.' ), array( 'Classification', 'Scoring and categorisation models with explainable outputs.' ), array( 'Computer vision', 'Detection, segmentation and OCR with OpenCV and deep learning.' ), array( 'Recommendations', 'Personalised products, content and next-best actions.' ), array( 'Feature pipelines', 'Clean, versioned features built from your operational data.' ), array( 'Deployment', 'APIs, batch jobs and edge devices, with monitoring for drift.' ) ),
		'faq'   => array( array( 'How much data do we need for machine learning?', 'It depends on the problem. Forecasting usually needs one to two years of history; classification needs enough labelled examples of each outcome. We assess your data first and tell you honestly whether ML, simple rules or an LLM is the better choice.' ), array( 'Who maintains the model after launch?', 'We set up monitoring for accuracy and data drift plus a retraining pipeline. Your team can run it, or we can support it on a monthly plan.' ) ),
	),
	array(
		'slug'  => 'hire-mlops-engineers',
		'nav'   => 'MLOps Engineers',
		'title' => 'Hire MLOps Engineers',
		'seo'   => 'Hire MLOps Engineers | ML & LLM Deployment Experts',
		'meta'  => 'Hire MLOps engineers to deploy, monitor and scale ML and LLM models: CI/CD for models, GPU infrastructure, model registries, drift and cost monitoring.',
		'focus' => 'hire mlops engineers',
		'intro' => 'MLOps engineers who take models from notebooks to reliable production, with CI/CD, GPU infrastructure, monitoring and cost control.',
		'points'=> array( 'AWS, Azure and Google Cloud', 'Docker, Kubernetes and model serving', 'Monitoring for drift, latency and cost' ),
		'about' => array(
			'Most AI projects stall between a working notebook and a production service. MLOps engineers close that gap with reproducible training, model registries, automated deployment, scaling and observability.',
			'They also own the cost side of AI: right-sizing GPUs, batching and caching requests, and routing traffic between models so your AI features stay affordable as usage grows.',
		),
		'builds'=> array( 'CI/CD pipelines for training, testing and deploying models', 'Model registries and experiment tracking with MLflow or Weights & Biases', 'Scalable model serving on Kubernetes, SageMaker or Vertex AI', 'GPU clusters and autoscaling for LLM inference', 'Monitoring for latency, errors, drift and spend', 'Data and model versioning for audits and rollbacks' ),
		'cards' => array( array( 'Model CI/CD', 'Automated tests and deployments for every model change.' ), array( 'Serving', 'Low-latency APIs with autoscaling on CPU and GPU.' ), array( 'Experiment tracking', 'MLflow or W&B so every result is reproducible.' ), array( 'Observability', 'Dashboards and alerts for quality, latency, errors and cost.' ), array( 'Cloud infrastructure', 'Terraform-managed environments on AWS, Azure or GCP.' ), array( 'Governance', 'Versioning, approvals and audit trails for regulated teams.' ) ),
		'faq'   => array( array( 'Do we need MLOps for a single model?', 'Even one model in production benefits from automated deployment, monitoring and a rollback plan. We scale the setup to your needs, from a lightweight pipeline to a full platform for many models.' ), array( 'Can you reduce our AI cloud bill?', 'Usually, yes. Common savings come from right-sizing instances, autoscaling to zero, batching, caching, quantised models and routing simple requests to smaller models.' ) ),
	),
	array(
		'slug'  => 'hire-data-engineers',
		'nav'   => 'Data Engineers',
		'title' => 'Hire Data Engineers',
		'seo'   => 'Hire Data Engineers | ETL, Data Pipelines & Warehouses',
		'meta'  => 'Hire data engineers to build pipelines, warehouses and lakehouses that make your data AI-ready: ETL/ELT, dbt, Spark, Airflow, Snowflake, BigQuery and more.',
		'focus' => 'hire data engineers',
		'intro' => 'Data engineers who build the pipelines and warehouses that make your data clean, connected and ready for reporting and AI.',
		'points'=> array( 'ETL/ELT pipelines and data warehouses', 'dbt, Airflow, Spark and Kafka', 'AI-ready data foundations' ),
		'about' => array(
			'AI and analytics are only as good as the data behind them. Data engineers bring data from ERP, CRM, apps, files and devices into one reliable place, model it, test it and keep it fresh.',
			'For AI projects they also prepare document stores, embeddings pipelines and feature tables, so models and agents always work with current, trustworthy information.',
		),
		'builds'=> array( 'Data warehouses and lakehouses on Snowflake, BigQuery, Redshift or Databricks', 'ELT pipelines with dbt and orchestration with Airflow or Dagster', 'Real-time streams with Kafka for events and IoT', 'Connectors from ERP, CRM, Tally, spreadsheets and APIs', 'Data quality tests and lineage', 'Embedding and document pipelines for RAG and AI agents' ),
		'cards' => array( array( 'Pipelines', 'Batch and streaming pipelines that are tested and monitored.' ), array( 'Warehousing', 'Clean, modelled data in Snowflake, BigQuery, Redshift or Postgres.' ), array( 'Integration', 'Connectors for ERP, CRM, accounting, apps and files.' ), array( 'Data quality', 'Tests, alerts and lineage so reports can be trusted.' ), array( 'BI enablement', 'Data ready for Power BI, Looker, Metabase and dashboards.' ), array( 'AI-ready data', 'Feature tables, vector stores and document pipelines for AI.' ) ),
		'faq'   => array( array( 'Do we need a data warehouse before using AI?', 'Not always, but most AI projects need at least clean, connected data for the use case. We often start small: one pipeline and one data model for the first AI feature, then grow the platform as more use cases arrive.' ), array( 'Can you connect Tally or our ERP to a dashboard?', 'Yes. We build connectors or use existing APIs and exports to bring accounting, sales, stock and production data into a warehouse, then into dashboards your management can use.' ) ),
	),
	array(
		'slug'  => 'hire-python-developers',
		'nav'   => 'Python Developers',
		'title' => 'Hire Python Developers',
		'seo'   => 'Hire Python Developers | Django, FastAPI & AI Python',
		'meta'  => 'Hire Python developers for AI, automation, APIs and web apps with FastAPI, Django and Flask. Dedicated Python engineers who write tested, maintainable code.',
		'focus' => 'hire python developers',
		'intro' => 'Python developers for AI back-ends, APIs, automation and data work, using FastAPI, Django and the modern Python AI stack.',
		'points'=> array( 'FastAPI, Django and Flask', 'AI, data and automation libraries', 'Tested, typed, maintainable code' ),
		'about' => array(
			'Python is the language of AI and data, and also a strong choice for APIs and internal tools. Our Python developers build the services that sit behind AI features: APIs, workers, schedulers and integrations.',
			'They write typed, tested code with clear structure, and use the AI ecosystem (LangChain, LlamaIndex, Pandas, NumPy, PyTorch) when the project needs it.',
		),
		'builds'=> array( 'REST and GraphQL APIs with FastAPI or Django', 'Back-ends for AI products, agents and copilots', 'Automation scripts and scheduled jobs for operations', 'Data processing with Pandas, Polars and NumPy', 'Integrations with ERP, CRM, payment and messaging systems', 'Admin panels and internal tools' ),
		'cards' => array( array( 'APIs', 'Fast, documented APIs with FastAPI, Django REST Framework or Flask.' ), array( 'AI back-ends', 'LLM, RAG and agent services with LangChain, LlamaIndex or plain SDKs.' ), array( 'Automation', 'Scripts, workers and schedulers that remove manual work.' ), array( 'Data processing', 'ETL, reports and analysis with Pandas, Polars and SQL.' ), array( 'Web apps', 'Django applications with admin, auth and role-based access.' ), array( 'Quality', 'Type hints, pytest, CI pipelines and code review.' ) ),
		'faq'   => array( array( 'Django or FastAPI?', 'Django suits full applications with an admin panel, users and many models. FastAPI suits lightweight, high-performance APIs and AI services. We often use both: Django for the core app and FastAPI for AI endpoints.' ), array( 'Can your Python developers join our existing team?', 'Yes. They follow your repository, coding standards, sprint process and tools, and work in your time zone overlap for stand-ups and reviews.' ) ),
	),
	array(
		'slug'  => 'hire-ai-qa-engineers',
		'nav'   => 'AI QA Engineers',
		'title' => 'Hire AI QA & Test Automation Engineers',
		'seo'   => 'Hire AI QA Engineers | Test Automation & Agentic QA',
		'meta'  => 'Hire AI QA engineers for test automation and agentic QA: AI-generated test cases, Playwright and Selenium suites, API tests and LLM evaluation for AI features.',
		'focus' => 'hire ai qa engineers',
		'intro' => 'QA engineers who combine test automation with AI: generated test cases, self-healing suites and evaluation of AI features before every release.',
		'points'=> array( 'Playwright, Selenium, Cypress and API tests', 'AI-generated and self-healing tests', 'LLM and agent evaluation' ),
		'about' => array(
			'Modern QA engineers use AI to write and maintain tests faster, and test AI features that traditional QA cannot cover. They build automation suites that run on every pull request and evaluation sets that catch regressions in LLM answers.',
			'This is the same approach behind our [[agentic-qa-testing|agentic QA service]]: fewer escaped defects, faster releases and clear quality reports for every build.',
		),
		'builds'=> array( 'End-to-end UI suites with Playwright or Cypress', 'API and contract tests in CI/CD', 'AI-generated test cases from requirements and user stories', 'Evaluation suites for chatbots, RAG and agents', 'Performance and load tests', 'Release quality reports and dashboards' ),
		'cards' => array( array( 'Test automation', 'UI, API and mobile tests that run on every commit.' ), array( 'AI test generation', 'Test cases drafted by AI from requirements, reviewed by engineers.' ), array( 'Self-healing tests', 'Resilient selectors and AI repair to cut flaky failures.' ), array( 'LLM evaluation', 'Accuracy, grounding, safety and regression tests for AI features.' ), array( 'Performance', 'Load and stress testing before peak traffic.' ), array( 'Reporting', 'Clear defect reports and release readiness for every build.' ) ),
		'faq'   => array( array( 'How do you test an AI chatbot or agent?', 'We build an evaluation set of real questions and tasks with expected outcomes, then score accuracy, grounding, tone and safety automatically, plus human review on samples. The suite runs whenever prompts, models or data change.' ), array( 'Can you automate our existing manual test cases?', 'Yes. We prioritise the most valuable and repetitive cases, automate them in your CI pipeline and expand coverage sprint by sprint.' ) ),
	),
	array(
		'slug'  => 'hire-erp-developers',
		'nav'   => 'ERP Developers',
		'title' => 'Hire ERP Developers',
		'seo'   => 'Hire ERP Developers | Custom ERP & AI-Powered ERP',
		'meta'  => 'Hire ERP developers to customise, integrate and extend your ERP, migrate from Tally or Excel, and add AI agents for purchase, inventory, sales and reports.',
		'focus' => 'hire erp developers',
		'intro' => 'ERP developers who customise, integrate and extend ERP systems, and add AI agents that automate purchase, inventory, sales and reporting work.',
		'points'=> array( 'Custom modules and workflows', 'Integrations and Tally/Excel migration', 'AI agents inside your ERP' ),
		'about' => array(
			'ERP developers understand both code and business processes: orders, stock, production, accounting and GST. They build the custom modules, reports and integrations that make an ERP fit how your company actually works.',
			'Our team builds and implements [[erp-software|DotOne ERP]] and also works on existing ERPs, connecting them to e-commerce, logistics, banking and AI services.',
		),
		'builds'=> array( 'Custom ERP modules for production, quality and dispatch', 'Integrations with e-commerce, logistics, banking and payment systems', 'Migration from Tally, Excel or legacy software', 'MIS reports and management dashboards', 'Mobile apps for sales teams, shop floor and attendance', 'AI agents for purchase planning, stock alerts and collections' ),
		'cards' => array( array( 'Customisation', 'Workflows, fields, approvals and print formats that match your process.' ), array( 'Integrations', 'APIs and connectors to the rest of your business systems.' ), array( 'Migration', 'Masters, open orders and balances moved safely from old systems.' ), array( 'Reports', 'MIS, costing and stock reports management actually uses.' ), array( 'Mobile ERP', 'Apps for field sales, approvals, attendance and stock checks.' ), array( 'AI in ERP', 'Agents that prepare purchase orders, flag shortages and chase payments.' ) ),
		'faq'   => array( array( 'Can you work on our existing ERP?', 'Yes. We extend and integrate existing ERP systems through their APIs, database layers or extension frameworks, and can add AI agents on top without replacing what already works.' ), array( 'Do you build industry-specific ERP?', 'Yes. DotOne ERP is built for Indian manufacturers and distributors, and we configure it for industries such as plywood, adhesive tape, footwear, laminates, ACP, steel, FMCG and services.' ) ),
	),
);

$ace_steps = array(
	array( 'title' => 'Share your needs', 'text' => 'Tell us the role, skills, project and how long you need the engineer.' ),
	array( 'title' => 'Meet matched engineers', 'text' => 'We shortlist engineers who fit your stack and domain; you interview them.' ),
	array( 'title' => 'Start with a pilot', 'text' => 'Begin with a short paid pilot so you can judge quality before committing.' ),
	array( 'title' => 'Scale the team', 'text' => 'Add or change engineers as your roadmap grows, with no long lock-in.' ),
);
$ace_shared_faq = array(
	array( 'question' => 'What engagement models do you offer?', 'answer' => 'You can hire a dedicated full-time engineer, a part-time engineer, or a managed team that delivers a defined project. Engineers work in your tools and process, and you can scale up or down as needs change.' ),
	array( 'question' => 'How quickly can an engineer start?', 'answer' => 'After we understand your requirements we share matching profiles for interview. Start dates depend on the role and availability; we confirm them before you commit.' ),
	array( 'question' => 'Who owns the code and IP?', 'answer' => 'You do. All code, models, prompts and documentation created for you are your intellectual property, and we sign an NDA before any details are shared.' ),
);

/** [[slug|anchor]] tokens -> links to existing published pages. */
function ace_hire_links( $text ) {
	return preg_replace_callback( '/\[\[([a-z0-9-]+)\|([^\]]+)\]\]/', function ( $m ) {
		global $wpdb;
		$id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE post_name = %s AND post_type = 'page' AND post_status = 'publish' LIMIT 1", $m[1] ) );
		return $id ? '<a href="' . esc_url( get_permalink( (int) $id ) ) . '">' . esc_html( $m[2] ) . '</a>' : esc_html( $m[2] );
	}, esc_html( $text ) );
}

function ace_hire_find( $slug ) {
	global $wpdb;
	$id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'page' AND post_name = %s AND post_status NOT IN ('trash','auto-draft') ORDER BY ID ASC LIMIT 1", $slug ) );
	return $id ? get_post( (int) $id ) : null;
}

/* -------------------------------------------------------------------------
 * Pages
 * ---------------------------------------------------------------------- */
WP_CLI::log( 'Hire pages:' );
$ace_bgs = array( 'network', 'grid', 'aurora', 'streaks', 'knot' );
$ace_ids = array();
foreach ( $ace_roles as $i => $r ) {
	$page = ace_hire_find( $r['slug'] );
	if ( $page && ( ! $ace_refresh || ! get_post_meta( $page->ID, '_ace_hire_page', true ) ) ) {
		WP_CLI::log( sprintf( '  kept     %-40s ID %d', $r['title'], $page->ID ) );
		$ace_ids[ $r['slug'] ] = $page->ID;
		continue;
	}
	$role    = strtolower( $r['nav'] );
	$content = '<h2>' . esc_html( sprintf( 'What our %s do', $role ) ) . "</h2>\n";
	foreach ( $r['about'] as $p ) {
		$content .= '<p>' . ace_hire_links( $p ) . "</p>\n";
	}
	$content .= '<h2>' . esc_html( sprintf( 'What you can build with our %s', $role ) ) . "</h2>\n<ul>\n";
	foreach ( $r['builds'] as $b ) {
		$content .= '<li>' . esc_html( $b ) . "</li>\n";
	}
	$content .= "</ul>\n<h2>Flexible ways to hire</h2>\n<ul>\n";
	$content .= '<li><strong>Dedicated engineer:</strong> ' . esc_html( sprintf( 'a full-time %s working only on your product, in your tools and sprints.', rtrim( $role, 's' ) ) ) . "</li>\n";
	$content .= "<li><strong>Part-time or on demand:</strong> expert hours for reviews, architecture or a specific feature.</li>\n";
	$content .= "<li><strong>Managed team:</strong> a small cross-functional team that delivers a defined project end to end.</li>\n</ul>\n";

	$data = array(
		'post_type'    => 'page',
		'post_title'   => $r['title'],
		'post_name'    => $r['slug'],
		'post_status'  => $page ? $page->post_status : 'publish',
		'post_content' => $content,
		'post_excerpt' => $r['intro'],
	);
	if ( $page ) {
		$data['ID'] = $page->ID;
	}
	$id = wp_insert_post( wp_slash( $data ), true );
	if ( is_wp_error( $id ) ) {
		WP_CLI::error( $r['slug'] . ': ' . $id->get_error_message() );
	}
	update_post_meta( $id, '_wp_page_template', 'landing-template.php' );
	update_post_meta( $id, '_ace_hire_page', 1 );
	update_post_meta( $id, '_ace_seo_title', $r['seo'] );
	update_post_meta( $id, '_ace_seo_desc', $r['meta'] );
	$fields = array(
		'lp_hero_style'      => 'knot',
		'lp_bg_visual'       => $ace_bgs[ $i % count( $ace_bgs ) ],
		'lp_eyebrow'         => 'Hire ' . $r['nav'],
		'lp_title'           => $r['title'],
		'lp_title_highlight' => $r['nav'],
		'lp_intro'           => $r['intro'],
		'lp_points'          => array_map( function ( $t ) { return array( 'text' => $t ); }, $r['points'] ),
		'lp_cta_label'       => 'Hire ' . $r['nav'],
		'lp_cta2_label'      => 'See skills',
		'lp_cta2_link'       => '#use-cases',
		'lp_form_heading'    => 'Tell us who you need',
		'lp_form_text'       => 'Share the role, skills and timeline. We will come back with matching engineers.',
		'lp_cards_eyebrow'   => 'Skills',
		'lp_cards_heading'   => 'What our ' . $role . ' bring',
		'lp_cards'           => array_map( function ( $c ) { return array( 'title' => $c[0], 'text' => $c[1], 'link' => '' ); }, $r['cards'] ),
		'lp_steps_heading'   => 'How hiring works',
		'lp_steps'           => $ace_steps,
		'lp_faq'             => array_merge( array_map( function ( $f ) { return array( 'question' => $f[0], 'answer' => $f[1] ); }, $r['faq'] ), $ace_shared_faq ),
		'lp_sections'        => array( 'engineering' ),
		'lp_show_stack'      => 1,
	);
	foreach ( $fields as $name => $value ) {
		update_field( $name, $value, $id );
	}
	if ( class_exists( '\AIOSEO\Plugin\Common\Models\Post' ) && function_exists( 'aioseo' ) ) {
		try {
			\AIOSEO\Plugin\Common\Models\Post::savePost( $id, array(
				'title'       => $r['seo'],
				'description' => $r['meta'],
				'keyphrases'  => array( 'focus' => array( 'keyphrase' => $r['focus'], 'score' => 0, 'analysis' => array() ), 'additional' => array() ),
			) );
		} catch ( \Throwable $e ) {
			WP_CLI::warning( 'AIOSEO meta not saved for ' . $r['slug'] . ': ' . $e->getMessage() );
		}
	}
	$ace_ids[ $r['slug'] ] = $id;
	WP_CLI::log( sprintf( '  %-8s %-40s ID %d', $page ? 'updated' : 'created', $r['title'], $id ) );
}

/* -------------------------------------------------------------------------
 * Menu: replace the links under "Hire" with the new roles
 * ---------------------------------------------------------------------- */
if ( $ace_menu ) {
	$locations = get_nav_menu_locations();
	$menu_id   = isset( $locations['primary-menu'] ) ? (int) $locations['primary-menu'] : 0;
	$items     = $menu_id ? wp_get_nav_menu_items( $menu_id, array( 'post_status' => 'any' ) ) : array();
	$hire      = null;
	foreach ( (array) $items as $it ) {
		if ( 0 === (int) $it->menu_item_parent && preg_match( '/^\s*hire\b/i', $it->title ) ) {
			$hire = $it;
			break;
		}
	}
	if ( ! $hire ) {
		WP_CLI::warning( 'No top-level "Hire" item in the Primary Menu; add the pages to the menu manually.' );
	} else {
		// Remove the old links below "Hire" (menu entries only, pages are kept).
		$children = array();
		foreach ( $items as $it ) {
			$children[ (int) $it->menu_item_parent ][] = $it;
		}
		$remove = function ( $parent_id ) use ( &$remove, $children ) {
			foreach ( isset( $children[ $parent_id ] ) ? $children[ $parent_id ] : array() as $c ) {
				$remove( (int) $c->ID );
				wp_delete_post( $c->ID, true );
			}
		};
		$remove( (int) $hire->ID );
		$pos = 1;
		foreach ( $ace_roles as $r ) {
			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title'     => $r['nav'],
				'menu-item-object'    => 'page',
				'menu-item-object-id' => $ace_ids[ $r['slug'] ],
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
				'menu-item-parent-id' => $hire->ID,
				'menu-item-position'  => $pos++,
			) );
		}
		// Keep the most useful existing hire pages too.
		foreach ( array( 'hire-full-stack-developers' => 'Full Stack Developers', 'hire-mobile-app-developers' => 'Mobile App Developers' ) as $slug => $label ) {
			$p = ace_hire_find( $slug );
			if ( $p && 'publish' === $p->post_status ) {
				wp_update_nav_menu_item( $menu_id, 0, array(
					'menu-item-title'     => $label,
					'menu-item-object'    => 'page',
					'menu-item-object-id' => $p->ID,
					'menu-item-type'      => 'post_type',
					'menu-item-status'    => 'publish',
					'menu-item-parent-id' => $hire->ID,
					'menu-item-position'  => $pos++,
				) );
			}
		}
		WP_CLI::log( sprintf( '  menu     "%s" now lists %d roles', $hire->title, $pos - 1 ) );
	}
}

WP_CLI::success( 'Hire pages ready. Then run: wp litespeed-purge all' );
