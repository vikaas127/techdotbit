<?php
/**
 * ACF fields for the "AI Landing Page" template (landing-template.php).
 * Registered in code so they ship with the theme; they appear on any page
 * that uses that template.
 */

add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$text = function ( $key, $name, $label, $extra = array() ) {
		return array_merge( array( 'key' => 'field_tdb_lp_' . $key, 'name' => $name, 'label' => $label, 'type' => 'text' ), $extra );
	};

	acf_add_local_field_group( array(
		'key'      => 'group_tdb_landing',
		'title'    => 'AI Landing Page',
		'position' => 'acf_after_title',
		'location' => array( array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'landing-template.php' ) ) ),
		'fields'   => array(
			array( 'key' => 'field_tdb_lp_tab_hero', 'label' => 'Hero', 'type' => 'tab' ),
			array(
				'key' => 'field_tdb_lp_style', 'name' => 'lp_hero_style', 'label' => 'Hero style', 'type' => 'button_group',
				'choices' => array( 'knot' => '3D shape + form', 'streaks' => 'Minimal light streaks', 'agents' => 'Light + AI agents panel' ),
				'default_value' => 'knot', 'layout' => 'horizontal',
				'instructions' => 'With "Minimal light streaks" and "Light + AI agents panel" the form moves to its own section further down the page.',
			),
			$text( 'eyebrow', 'lp_eyebrow', 'Small label above the title', array( 'instructions' => 'e.g. "AI Development Services". Optional.' ) ),
			$text( 'title', 'lp_title', 'Headline (H1)', array( 'instructions' => 'Leave empty to use the page title. Put your main keyword here.' ) ),
			array( 'key' => 'field_tdb_lp_intro', 'name' => 'lp_intro', 'label' => 'Intro text', 'type' => 'textarea', 'rows' => 3 ),
			array(
				'key' => 'field_tdb_lp_points', 'name' => 'lp_points', 'label' => 'Bullet points (optional)', 'type' => 'repeater',
				'layout' => 'table', 'button_label' => 'Add point', 'max' => 5,
				'sub_fields' => array( $text( 'point_text', 'text', 'Point' ) ),
			),
			array(
				'key' => 'field_tdb_lp_hero_features', 'name' => 'lp_hero_features', 'label' => 'Hero feature columns (streaks style)', 'type' => 'repeater',
				'layout' => 'block', 'button_label' => 'Add column', 'max' => 4,
				'sub_fields' => array(
					$text( 'hf_title', 'title', 'Title' ),
					array( 'key' => 'field_tdb_lp_hf_text', 'name' => 'text', 'label' => 'Text', 'type' => 'textarea', 'rows' => 2 ),
					$text( 'hf_link', 'link', 'Link (optional)', array( 'type' => 'url' ) ),
				),
			),
			$text( 'cta_label', 'lp_cta_label', 'Hero button label', array( 'default_value' => 'Book a free consultation' ) ),
			$text( 'highlight', 'lp_title_highlight', 'Highlighted words in the headline (agents style)', array( 'instructions' => 'Must match part of the headline exactly, e.g. "business impact".' ) ),
			$text( 'cta2_label', 'lp_cta2_label', 'Second button label (agents style)' ),
			$text( 'cta2_link', 'lp_cta2_link', 'Second button link (agents style)', array( 'type' => 'url' ) ),
			$text( 'prompt', 'lp_prompt', 'Prompt text typed in the panel (agents style)', array( 'default_value' => 'Build an agent team to handle our support tickets' ) ),
			array(
				'key' => 'field_tdb_lp_agents', 'name' => 'lp_agents', 'label' => 'Agents shown in the panel (agents style)', 'type' => 'repeater',
				'layout' => 'table', 'button_label' => 'Add agent', 'max' => 4,
				'sub_fields' => array( $text( 'agent_name', 'name', 'Agent name' ) ),
			),
			array( 'key' => 'field_tdb_lp_visual', 'name' => 'lp_visual', 'label' => 'Hero visual (optional)', 'type' => 'image', 'return_format' => 'array', 'instructions' => 'Leave empty to show the animated 3D shape.' ),
			array( 'key' => 'field_tdb_lp_tab_form', 'label' => 'Form', 'type' => 'tab' ),
			$text( 'form_title', 'lp_form_title', 'Form title', array( 'default_value' => "Let's talk" ) ),
			$text( 'form_shortcode', 'lp_form_shortcode', 'Contact Form 7 shortcode', array( 'default_value' => '[contact-form-7 id="0f5d249" title="Quote Form"]' ) ),
			$text( 'form_note', 'lp_form_note', 'Note under the form', array( 'default_value' => 'Your data is secure with us.' ) ),
			$text( 'form_heading', 'lp_form_heading', 'Form section heading (streaks style)', array( 'default_value' => 'Tell us what you want to automate' ) ),
			array( 'key' => 'field_tdb_lp_form_text', 'name' => 'lp_form_text', 'label' => 'Form section text (streaks style)', 'type' => 'textarea', 'rows' => 2 ),
			array( 'key' => 'field_tdb_lp_tab_cards', 'label' => 'Highlights', 'type' => 'tab' ),
			$text( 'cards_eyebrow', 'lp_cards_eyebrow', 'Section label' ),
			$text( 'cards_heading', 'lp_cards_heading', 'Section heading' ),
			array( 'key' => 'field_tdb_lp_cards_intro', 'name' => 'lp_cards_intro', 'label' => 'Section intro', 'type' => 'textarea', 'rows' => 2 ),
			array(
				'key' => 'field_tdb_lp_cards', 'name' => 'lp_cards', 'label' => 'Cards', 'type' => 'repeater',
				'layout' => 'block', 'button_label' => 'Add card',
				'sub_fields' => array(
					array( 'key' => 'field_tdb_lp_card_icon', 'name' => 'icon', 'label' => 'Icon', 'type' => 'image', 'return_format' => 'array' ),
					$text( 'card_title', 'title', 'Title' ),
					$text( 'card_link', 'link', 'Link (optional)', array( 'type' => 'url' ) ),
					array( 'key' => 'field_tdb_lp_card_text', 'name' => 'text', 'label' => 'Text', 'type' => 'textarea', 'rows' => 3 ),
				),
			),
			array( 'key' => 'field_tdb_lp_tab_dash', 'label' => 'Dashboard', 'type' => 'tab' ),
			$text( 'dash_heading', 'lp_dash_heading', 'Dashboard section heading', array( 'instructions' => 'Optional "dashboard showcase" section with tabs, KPI cards and a task table. Leave the tabs empty to hide it.' ) ),
			array( 'key' => 'field_tdb_lp_dash_text', 'name' => 'lp_dash_text', 'label' => 'Dashboard intro', 'type' => 'textarea', 'rows' => 2 ),
			$text( 'dash_note', 'lp_dash_note', 'Small note under the dashboard', array( 'default_value' => 'Illustrative example. Figures vary by project.' ) ),
			array(
				'key' => 'field_tdb_lp_dash_tabs', 'name' => 'lp_dash_tabs', 'label' => 'Tabs', 'type' => 'repeater',
				'layout' => 'block', 'button_label' => 'Add tab', 'max' => 5,
				'sub_fields' => array(
					$text( 'dash_tab_label', 'label', 'Tab label' ),
					array(
						'key' => 'field_tdb_lp_dash_kpis', 'name' => 'kpis', 'label' => 'KPI cards', 'type' => 'repeater',
						'layout' => 'table', 'button_label' => 'Add KPI', 'max' => 4,
						'sub_fields' => array(
							$text( 'kpi_label', 'label', 'Label' ),
							$text( 'kpi_value', 'value', 'Value' ),
							$text( 'kpi_note', 'note', 'Note' ),
							array( 'key' => 'field_tdb_lp_kpi_trend', 'name' => 'trend', 'label' => 'Trend', 'type' => 'select', 'choices' => array( 'up' => 'Up', 'down' => 'Down' ), 'default_value' => 'up' ),
						),
					),
					array(
						'key' => 'field_tdb_lp_dash_rows', 'name' => 'rows', 'label' => 'Task rows', 'type' => 'repeater',
						'layout' => 'table', 'button_label' => 'Add row', 'max' => 6,
						'sub_fields' => array(
							$text( 'row_task', 'task', 'Task' ),
							$text( 'row_agent', 'agent', 'Run by' ),
							$text( 'row_model', 'model', 'Model' ),
							$text( 'row_status', 'status', 'Status / eval', array( 'instructions' => 'Write "Running" to show a live indicator.' ) ),
							$text( 'row_cost', 'cost', 'Cost' ),
						),
					),
				),
			),
			array( 'key' => 'field_tdb_lp_tab_steps', 'label' => 'Process', 'type' => 'tab' ),
			$text( 'steps_heading', 'lp_steps_heading', 'Heading', array( 'default_value' => 'How we work' ) ),
			array(
				'key' => 'field_tdb_lp_steps', 'name' => 'lp_steps', 'label' => 'Steps', 'type' => 'repeater',
				'layout' => 'block', 'button_label' => 'Add step',
				'sub_fields' => array(
					$text( 'step_title', 'title', 'Title' ),
					array( 'key' => 'field_tdb_lp_step_text', 'name' => 'text', 'label' => 'Text', 'type' => 'textarea', 'rows' => 2 ),
				),
			),
			array( 'key' => 'field_tdb_lp_tab_faq', 'label' => 'FAQ', 'type' => 'tab' ),
			array(
				'key' => 'field_tdb_lp_faq', 'name' => 'lp_faq', 'label' => 'Questions', 'type' => 'repeater',
				'instructions' => 'Shown on the page and added as FAQ rich-result data for Google.',
				'layout' => 'block', 'button_label' => 'Add question',
				'sub_fields' => array(
					$text( 'faq_q', 'question', 'Question' ),
					array( 'key' => 'field_tdb_lp_faq_a', 'name' => 'answer', 'label' => 'Answer', 'type' => 'textarea', 'rows' => 3 ),
				),
			),
		),
	) );
} );
