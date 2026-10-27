<?php
/**
 * TEMPLATE (skipped by create-blog-posts.php because the name starts with "_").
 *
 * Weekly "AI & ERP news for Indian manufacturers" roundup. Each week:
 *  1. Copy this file to blog-content/weekly-news-YYYY-MM-DD.php (Monday's date).
 *  2. Replace every [[...]] placeholder; add 4-6 news items, each with a link
 *     to the original source (government site, company announcement, major
 *     publication). Only real, checked news - never guesses.
 *  3. Run: wp eval-file wp-content/themes/ace/tools/create-blog-posts.php
 *     It is created as a draft; review it in WP Admin, then publish.
 *
 * Good topics: GST, e-invoicing and e-way bill changes; MSME and PLI scheme
 * updates; export and China+1 news; new AI tools businesses can use (ChatGPT,
 * Claude, Gemini, Copilot, DeepSeek); manufacturing technology. Always add
 * "What it means for you" so the post is useful, not just copied headlines.
 */

return array(
	'status'     => 'draft',
	'slug'       => 'ai-erp-news-india-[[yyyy-mm-dd]]',
	'title'      => 'AI & ERP News for Indian Manufacturers: Week of [[DD Month YYYY]]',
	'seo_title'  => 'AI & ERP News India: Week of [[DD Mon YYYY]] | TechDotBit',
	'meta'       => 'This week for Indian manufacturers: [[topic 1]], [[topic 2]] and [[topic 3]], with what each change means for your business.',
	'focus'      => '[[main topic of the week, e.g. gst e-invoicing update]]',
	'keywords'   => array(
		'[[main topic of the week]]',
		'ai news india',
		'erp news india',
		'manufacturing news india',
		'gst update for manufacturers',
	),
	'categories' => array( 'news' ),
	'excerpt'    => 'The week\'s AI, ERP, GST and manufacturing news for Indian businesses, with what each change means for you.',
	'lead'       => array(
		'Every week we pick the news that matters for Indian manufacturers, distributors and growing businesses, and explain what it means in practice. This week: [[one-sentence summary]].',
	),
	'body'       => array(
		array(
			'h2' => '[[News item 1 headline]]',
			'p'  => array(
				'[[What happened, in 2-3 sentences.]] Source: <a href="[[https://source-link]]" rel="noopener">[[Source name]]</a>.',
			),
			'h3' => array(
				array( 'What it means for you', '[[Practical impact for a manufacturer or distributor, and any action to take. Link to a relevant DotOne or AI services page where it genuinely helps, e.g. <a href="/erp-software/accounting-gst-software/">GST accounting software</a>.]]' ),
			),
		),
		array(
			'h2' => '[[News item 2 headline]]',
			'p'  => array(
				'[[What happened.]] Source: <a href="[[https://source-link]]" rel="noopener">[[Source name]]</a>.',
			),
			'h3' => array(
				array( 'What it means for you', '[[Practical impact.]]' ),
			),
		),
		array(
			'h2' => '[[News item 3 headline]]',
			'p'  => array(
				'[[What happened.]] Source: <a href="[[https://source-link]]" rel="noopener">[[Source name]]</a>.',
			),
			'h3' => array(
				array( 'What it means for you', '[[Practical impact.]]' ),
			),
		),
		array(
			'h2' => 'AI tool of the week',
			'p'  => array(
				'[[One AI tool or feature, what it does, and a concrete way a manufacturer or distributor could use it. For background see <a href="/chatgpt-vs-claude-vs-gemini-vs-deepseek-for-business/">ChatGPT vs Claude vs Gemini vs DeepSeek</a>.]]',
			),
		),
		array(
			'h2' => 'Need help acting on this?',
			'p'  => array(
				'Talk to our team about <a href="/erp-software/">DotOne ERP</a> or <a href="/ai-services/">AI services</a>, or <a href="/contact-us/">book a call</a>.',
			),
		),
	),
);
