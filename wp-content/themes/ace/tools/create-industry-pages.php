<?php
/**
 * Industry pages (software development by industry) on the AI Landing Page
 * template, and a grouped "Industries" menu:
 *   Core industries: Healthcare, FinTech, Logistics & Supply Chain, Manufacturing, Automotive
 *   Commerce & experience: Retail & eCommerce, Real Estate, EdTech, Travel & Hospitality
 *
 * Run from the WordPress root:
 *   wp eval-file wp-content/themes/ace/tools/create-industry-pages.php           # add missing pages, publish, update menu
 *   wp eval-file wp-content/themes/ace/tools/create-industry-pages.php refresh   # also re-write pages created by this script
 *   wp eval-file wp-content/themes/ace/tools/create-industry-pages.php nomenu    # skip the menu step
 *
 * Existing pages not created by this script are never changed. The menu step
 * replaces the links under "Industries" (old pages are kept; an "All
 * industries" link to the existing /industries/ page is added if it exists).
 */

if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
	exit; // CLI only.
}

$ace_args    = isset( $args ) ? (array) $args : array();
$ace_refresh = in_array( 'refresh', $ace_args, true );
$ace_menu    = ! in_array( 'nomenu', $ace_args, true );

$ace_groups = array(
	'core'     => 'Core industries',
	'commerce' => 'Commerce & experience',
);

/* -------------------------------------------------------------------------
 * Industries
 * ---------------------------------------------------------------------- */
$ace_inds = array(
	array(
		'group' => 'core',
		'slug'  => 'healthcare-software-development',
		'nav'   => 'Healthcare',
		'title' => 'Healthcare Software Development',
		'seo'   => 'Healthcare Software Development Company | TechDotBit',
		'meta'  => 'Healthcare software development: patient apps, telemedicine, clinic and hospital systems, EHR integrations and secure AI for documents, triage and operations.',
		'focus' => 'healthcare software development',
		'intro' => 'Patient apps, clinic and hospital systems, integrations and secure AI that reduce admin work and help care teams focus on patients.',
		'points'=> array( 'Patient, clinic and hospital software', 'Secure handling of health data', 'AI for documents, triage and scheduling' ),
		'about' => array(
			'Healthcare teams lose hours to scheduling, paperwork and systems that do not talk to each other. We build software that removes that friction: patient-facing apps, clinic and hospital workflows, and integrations between labs, pharmacies, billing and records.',
			'Health data needs extra care. We design access control, audit trails, encryption and consent flows from the start, and use AI only where it is reliable and supervised, such as summarising documents, routing enquiries or predicting no-shows.',
		),
		'solutions' => array( 'Patient apps for booking, reminders, reports and payments', 'Telemedicine and remote consultation platforms', 'Clinic, diagnostic centre and hospital management systems', 'EHR/EMR integrations and HL7 or FHIR interfaces', 'AI assistants for intake, triage and document summaries', 'Analytics dashboards for occupancy, revenue and outcomes' ),
		'cards' => array( array( 'Patient experience', 'Apps and portals for appointments, reports, payments and follow-ups.' ), array( 'Telehealth', 'Video consultations, e-prescriptions and remote monitoring.' ), array( 'Clinical workflows', 'OPD, IPD, lab, pharmacy and billing workflows in one system.' ), array( 'Interoperability', 'Integrations with EHRs, labs, devices and insurance systems.' ), array( 'Healthcare AI', 'Supervised AI for documentation, triage and scheduling.' ), array( 'Security & privacy', 'Role-based access, encryption, consent and full audit trails.' ) ),
		'faq'   => array( array( 'Do you build HIPAA or ABDM-ready software?', 'We design for the regulations that apply to you, such as HIPAA in the US or ABDM guidelines in India: encryption, access control, audit logs and consent. Formal certification is done with your compliance team or auditor.' ), array( 'Can AI be used safely in healthcare software?', 'Yes, when it assists rather than decides. We use AI for drafting summaries, routing messages and predicting scheduling issues, always with clinicians reviewing outputs and clear logs of what the AI did.' ) ),
	),
	array(
		'group' => 'core',
		'slug'  => 'fintech-software-development',
		'nav'   => 'FinTech',
		'title' => 'FinTech Software Development',
		'seo'   => 'FinTech Software Development Company | TechDotBit',
		'meta'  => 'FinTech software development: digital payments, lending, wealth and insurance platforms, KYC onboarding, fraud detection and AI-powered financial operations.',
		'focus' => 'fintech software development',
		'intro' => 'Secure platforms for payments, lending, wealth and insurance, with smooth onboarding, real-time data and AI that spots risk early.',
		'points'=> array( 'Payments, lending and wealth platforms', 'KYC, onboarding and compliance flows', 'Fraud signals and risk scoring' ),
		'about' => array(
			'Financial products live or die on trust, speed and reliability. We build fintech platforms with secure architecture, clean audit trails and integrations with banks, payment gateways, credit bureaus and KYC providers.',
			'AI helps fintech teams move faster without adding risk: document verification, transaction monitoring, credit scoring support, collections prioritisation and customer support that knows the product.',
		),
		'solutions' => array( 'Digital wallets, payment and payout platforms', 'Loan origination, underwriting and collections systems', 'Wealth, trading and portfolio management apps', 'KYC and onboarding flows with document verification', 'Fraud detection and transaction monitoring', 'Reconciliation, reporting and finance operations automation' ),
		'cards' => array( array( 'Payments', 'Gateways, UPI, wallets, payouts and subscription billing.' ), array( 'Lending', 'Origination, underwriting, disbursal and collections workflows.' ), array( 'Wealth & trading', 'Portfolio tracking, advisory tools and trading interfaces.' ), array( 'Onboarding & KYC', 'Fast, compliant onboarding with document and identity checks.' ), array( 'Risk & fraud', 'Rules plus ML models that flag unusual activity in real time.' ), array( 'Finance ops', 'Automated reconciliation, reporting and audit trails.' ) ),
		'faq'   => array( array( 'How do you handle security in fintech projects?', 'Security is part of the design: encryption in transit and at rest, strong authentication, least-privilege access, audit logging, secure coding reviews and penetration testing before launch.' ), array( 'Can you integrate with banks and payment providers?', 'Yes. We regularly integrate payment gateways, banking APIs, account aggregators, credit bureaus and KYC providers, and design the platform so providers can be added or switched later.' ) ),
	),
	array(
		'group' => 'core',
		'slug'  => 'logistics-software-development',
		'nav'   => 'Logistics & Supply Chain',
		'title' => 'Logistics & Supply Chain Software Development',
		'seo'   => 'Logistics & Supply Chain Software Development | TechDotBit',
		'meta'  => 'Logistics and supply chain software development: fleet tracking, transport and warehouse management, dispatch apps, proof of delivery and AI for ETA and demand.',
		'focus' => 'logistics software development',
		'intro' => 'Fleet tracking, transport and warehouse systems, driver apps and AI forecasting that make every shipment visible and on time.',
		'points'=> array( 'Fleet, transport and warehouse software', 'Driver apps and proof of delivery', 'AI for ETAs, routes and demand' ),
		'about' => array(
			'Logistics runs on timing and visibility. We build software that shows where every vehicle, order and pallet is, and helps teams plan routes, loads and warehouse work with fewer phone calls and spreadsheets.',
			'We have built GPS and AVL tracking, fleet management and dispatch systems, and we add AI where it pays: ETA prediction, route optimisation, demand forecasting and exception alerts.',
		),
		'solutions' => array( 'Real-time fleet tracking and AVL systems', 'Transport management: booking, planning and dispatch', 'Warehouse management with barcode and bin locations', 'Driver apps with proof of delivery and e-signatures', 'Customer tracking portals and notifications', 'AI for ETA prediction, route planning and demand forecasts' ),
		'cards' => array( array( 'Fleet tracking', 'Live location, trips, fuel and driver behaviour in one view.' ), array( 'Transport management', 'Bookings, load planning, dispatch and freight billing.' ), array( 'Warehouse systems', 'Inbound, putaway, picking, packing and stock accuracy.' ), array( 'Driver apps', 'Job lists, navigation, photos, e-POD and offline mode.' ), array( 'Visibility', 'Tracking pages and alerts for customers and teams.' ), array( 'Logistics AI', 'ETA prediction, route optimisation and demand forecasting.' ) ),
		'faq'   => array( array( 'Can you integrate GPS devices and telematics?', 'Yes. We integrate GPS trackers, telematics APIs and mobile-phone location, and turn the raw data into trips, alerts, reports and customer-facing tracking.' ), array( 'Do you build warehouse management systems?', 'Yes, from simple stock and bin tracking with barcode scanning to full inbound, picking, packing and dispatch workflows integrated with your ERP or e-commerce platforms.' ) ),
	),
	array(
		'group' => 'core',
		'slug'  => 'manufacturing-software-development',
		'nav'   => 'Manufacturing',
		'title' => 'Manufacturing Software Development',
		'seo'   => 'Manufacturing Software Development Company | TechDotBit',
		'meta'  => 'Manufacturing software development: production tracking, MES and shop-floor apps, quality systems, IoT dashboards, ERP integration and AI for planning and inspection.',
		'focus' => 'manufacturing software development',
		'intro' => 'Production tracking, shop-floor apps, quality systems and AI for planning and inspection, connected to your ERP and machines.',
		'points'=> array( 'Production, MES and shop-floor apps', 'Quality, maintenance and IoT dashboards', 'AI for planning and visual inspection' ),
		'about' => array(
			'Factories generate data at every step, but much of it stays on paper, in registers or in separate machines. We build software that captures production, quality and maintenance data where the work happens and turns it into decisions.',
			'Our work ranges from custom shop-floor apps and machine dashboards to ERP integrations and AI for production planning, demand forecasting and visual quality inspection. For a complete ERP, see our [[erp-software|ERP software]] pages.',
		),
		'solutions' => array( 'Production tracking and manufacturing execution (MES)', 'Shop-floor tablet apps for job cards and output entry', 'Quality inspection, rejection and CAPA systems', 'Machine and IoT dashboards for OEE and downtime', 'Preventive maintenance scheduling', 'AI for production planning and visual inspection' ),
		'cards' => array( array( 'Production tracking', 'Real-time output, WIP and job status from the shop floor.' ), array( 'Quality systems', 'Inspections, defects, rejections and corrective actions.' ), array( 'Machine data', 'IoT dashboards for OEE, downtime and energy use.' ), array( 'Maintenance', 'Preventive schedules, breakdown logs and spares.' ), array( 'ERP integration', 'Orders, stock and costing flowing to and from your ERP.' ), array( 'Manufacturing AI', 'Planning, forecasting and computer-vision inspection.' ) ),
		'faq'   => array( array( 'Can you connect our machines to software?', 'Usually, yes. We connect PLCs and sensors through gateways, OPC UA, MQTT or existing machine software, then build dashboards and alerts for OEE, downtime and quality.' ), array( 'Do you replace our ERP or work with it?', 'Either. We integrate shop-floor software with your existing ERP, or implement a complete industry-specific ERP if your current system no longer fits.' ) ),
	),
	array(
		'group' => 'core',
		'slug'  => 'automotive-software-development',
		'nav'   => 'Automotive',
		'title' => 'Automotive Software Development',
		'seo'   => 'Automotive Software Development Company | TechDotBit',
		'meta'  => 'Automotive software development: dealer and service management, connected vehicle apps, fleet and telematics, parts and inventory systems and AI for service and sales.',
		'focus' => 'automotive software development',
		'intro' => 'Software for dealers, service centres, fleets and component makers, from connected-vehicle apps to parts, service and sales systems.',
		'points'=> array( 'Dealer, sales and service systems', 'Connected vehicle and telematics apps', 'Parts, inventory and supplier portals' ),
		'about' => array(
			'The automotive value chain spans component manufacturers, dealers, service workshops and fleet operators, and each runs on different software. We build systems that connect these steps and give customers a modern digital experience.',
			'Typical projects include dealer management and CRM, workshop and service booking, spare-parts inventory, telematics and connected-vehicle apps, and AI that predicts service needs or helps sales teams follow up.',
		),
		'solutions' => array( 'Dealer management and sales CRM', 'Service booking, job cards and workshop management', 'Spare-parts inventory and supplier portals', 'Connected vehicle and telematics apps', 'Fleet management and driver apps', 'AI for service reminders, lead scoring and parts demand' ),
		'cards' => array( array( 'Dealer systems', 'Leads, test drives, bookings, finance and delivery in one place.' ), array( 'Service workshops', 'Online booking, job cards, estimates and service history.' ), array( 'Parts & inventory', 'Parts catalogues, stock, ordering and supplier portals.' ), array( 'Connected vehicles', 'Apps and dashboards built on telematics and vehicle data.' ), array( 'Fleet software', 'Tracking, maintenance and cost control for fleets.' ), array( 'Automotive AI', 'Predictive service, lead scoring and demand forecasting.' ) ),
		'faq'   => array( array( 'Do you work with auto component manufacturers?', 'Yes. For component makers we build production, quality and traceability software and supplier portals, and integrate them with OEM requirements and the company ERP.' ), array( 'Can you build a customer app for our dealership or service network?', 'Yes. We build apps for service booking, vehicle history, reminders, payments and offers, connected to your dealer and workshop systems.' ) ),
	),
	array(
		'group' => 'commerce',
		'slug'  => 'ecommerce-software-development',
		'nav'   => 'Retail & eCommerce',
		'title' => 'Retail & eCommerce Software Development',
		'seo'   => 'Retail & eCommerce Software Development | TechDotBit',
		'meta'  => 'Retail and eCommerce software development: online stores, marketplaces, order and inventory systems, POS integration, personalisation and AI shopping assistants.',
		'focus' => 'ecommerce software development',
		'intro' => 'Online stores, marketplaces, order and inventory systems and AI that personalises shopping and support across every channel.',
		'points'=> array( 'Stores, marketplaces and B2B portals', 'Orders, inventory and POS in sync', 'Personalisation and AI assistants' ),
		'about' => array(
			'Retail now happens across websites, apps, marketplaces and physical stores at once. We build commerce platforms that keep products, prices, stock and orders consistent everywhere, and that load fast on every device.',
			'We also add AI where it moves revenue: product recommendations, smart search, shopping assistants, demand forecasting and support bots that can check orders and returns.',
		),
		'solutions' => array( 'Custom online stores and headless commerce', 'Multi-vendor marketplaces and B2B ordering portals', 'Order, inventory and warehouse integration', 'POS and omnichannel retail systems', 'Recommendations, smart search and personalisation', 'AI shopping and support assistants' ),
		'cards' => array( array( 'Online stores', 'Fast, SEO-friendly storefronts on custom or headless stacks.' ), array( 'Marketplaces', 'Multi-vendor platforms with onboarding, payouts and ratings.' ), array( 'B2B commerce', 'Dealer and distributor portals with price lists and credit.' ), array( 'Omnichannel', 'Stock, orders and customers in sync across stores and online.' ), array( 'Personalisation', 'Recommendations and search tuned to each shopper.' ), array( 'Commerce AI', 'Shopping assistants, demand forecasts and support bots.' ) ),
		'faq'   => array( array( 'Custom store or Shopify/WooCommerce?', 'If a platform fits your catalogue and process, we customise and integrate it. We build custom or headless commerce when you need unusual pricing, B2B workflows, marketplaces or deep integrations.' ), array( 'Can you connect our store to our ERP and marketplaces?', 'Yes. We sync products, stock, prices and orders between your store, marketplaces, POS and ERP so teams stop updating them by hand.' ) ),
	),
	array(
		'group' => 'commerce',
		'slug'  => 'real-estate-software-development',
		'nav'   => 'Real Estate',
		'title' => 'Real Estate Software Development',
		'seo'   => 'Real Estate Software Development Company | TechDotBit',
		'meta'  => 'Real estate software development: property portals, CRM for developers and brokers, booking and payment systems, property management and AI for leads and listings.',
		'focus' => 'real estate software development',
		'intro' => 'Property portals, CRM, booking and property-management systems, with AI that qualifies leads and keeps buyers informed.',
		'points'=> array( 'Property portals and listing platforms', 'CRM for developers and brokers', 'Booking, payments and property management' ),
		'about' => array(
			'Real estate businesses juggle leads, site visits, inventory, bookings, payments and handovers, often across spreadsheets and messaging apps. We build software that brings this into one place for developers, brokers and property managers.',
			'For rentals and hospitality-style properties we build booking and property-management platforms, and we use AI to qualify leads, answer buyer questions and draft listings.',
		),
		'solutions' => array( 'Property listing portals and search', 'Real estate CRM for leads, visits and follow-ups', 'Unit inventory, booking and payment schedules', 'Rental and villa booking platforms', 'Property and facility management systems', 'AI lead qualification and listing assistants' ),
		'cards' => array( array( 'Listing portals', 'Search, filters, maps, galleries and enquiry capture.' ), array( 'Sales CRM', 'Leads, site visits, follow-ups and broker management.' ), array( 'Inventory & booking', 'Live unit availability, bookings and payment plans.' ), array( 'Rentals', 'Booking engines, calendars, payments and guest messaging.' ), array( 'Property management', 'Tenants, maintenance requests, billing and documents.' ), array( 'Real estate AI', 'Lead scoring, chat assistants and listing generation.' ) ),
		'faq'   => array( array( 'Can you build a booking platform for rentals or villas?', 'Yes. We build booking engines with availability calendars, pricing rules, payments, guest communication and owner dashboards, and can integrate with channel managers.' ), array( 'Do you integrate with WhatsApp and property portals?', 'Yes. Leads from portals, websites and WhatsApp can flow into one CRM, with automatic assignment and follow-up reminders.' ) ),
	),
	array(
		'group' => 'commerce',
		'slug'  => 'edtech-software-development',
		'nav'   => 'EdTech',
		'title' => 'EdTech Software Development',
		'seo'   => 'EdTech & eLearning Software Development | TechDotBit',
		'meta'  => 'EdTech and eLearning software development: learning platforms, LMS, virtual classrooms, school and college ERP, assessments and AI tutors that support teachers.',
		'focus' => 'edtech software development',
		'intro' => 'Learning platforms, virtual classrooms, school and college systems and AI tutors that help learners and support teachers.',
		'points'=> array( 'LMS, courses and virtual classrooms', 'School and college management', 'AI tutors, assessments and analytics' ),
		'about' => array(
			'Education organisations need software that works for learners, teachers, parents and administrators at the same time. We build learning platforms and institution systems that are simple to use and reliable at peak times such as exams and admissions.',
			'AI is opening new possibilities in education: personalised practice, instant doubt-solving, automated grading support and early alerts for learners who need help. We build these with teachers in control.',
		),
		'solutions' => array( 'Learning management systems and course platforms', 'Live and virtual classroom tools', 'School, college and coaching management (admissions, fees, attendance)', 'Online assessments and proctoring', 'AI tutors and doubt-solving assistants', 'Learning analytics for teachers and management' ),
		'cards' => array( array( 'Learning platforms', 'Courses, video, quizzes, certificates and progress tracking.' ), array( 'Virtual classrooms', 'Live classes, recordings, chat and attendance.' ), array( 'Institution management', 'Admissions, fees, timetables, attendance and results.' ), array( 'Assessments', 'Question banks, online exams and grading support.' ), array( 'AI tutors', 'Personalised practice and instant help, supervised by teachers.' ), array( 'Analytics', 'Insights into engagement, performance and at-risk learners.' ) ),
		'faq'   => array( array( 'Can you build a custom LMS instead of using Moodle?', 'Yes. We can customise existing platforms such as Moodle, or build a custom LMS when you need a unique learning experience, business model or integrations.' ), array( 'How can AI help teachers?', 'AI can draft questions and lesson material, suggest grades for review, answer routine student questions and highlight learners who are falling behind, so teachers spend more time teaching.' ) ),
	),
	array(
		'group' => 'commerce',
		'slug'  => 'travel-software-development',
		'nav'   => 'Travel & Hospitality',
		'title' => 'Travel & Hospitality Software Development',
		'seo'   => 'Travel & Hospitality Software Development | TechDotBit',
		'meta'  => 'Travel and hospitality software development: booking engines, hotel and property management, tour and itinerary platforms, channel integrations and AI travel assistants.',
		'focus' => 'travel software development',
		'intro' => 'Booking engines, hotel and property systems, tour platforms and AI travel assistants that turn browsers into guests.',
		'points'=> array( 'Booking engines and travel portals', 'Hotel, villa and property management', 'AI assistants and dynamic pricing' ),
		'about' => array(
			'Travel and hospitality businesses compete on convenience. We build booking engines, guest apps and back-office systems that make it easy to search, book, pay and manage a stay or trip, on any device.',
			'Behind the scenes we integrate channel managers, payment gateways and supplier APIs, and add AI for itinerary planning, guest messaging, reviews analysis and pricing suggestions.',
		),
		'solutions' => array( 'Hotel, villa and holiday-rental booking engines', 'Property management and front-desk systems', 'Tour, activity and itinerary platforms', 'Channel manager and supplier API integrations', 'Guest apps for check-in, requests and offers', 'AI travel assistants and pricing suggestions' ),
		'cards' => array( array( 'Booking engines', 'Search, availability, pricing rules and secure payments.' ), array( 'Property management', 'Reservations, housekeeping, billing and reports.' ), array( 'Tours & activities', 'Itineraries, packages, guides and inventory.' ), array( 'Integrations', 'Channel managers, OTAs, payment and supplier APIs.' ), array( 'Guest experience', 'Apps for check-in, requests, upsells and feedback.' ), array( 'Travel AI', 'Trip planning assistants, messaging and pricing insights.' ) ),
		'faq'   => array( array( 'Can you integrate with OTAs and channel managers?', 'Yes. We integrate with channel managers and supplier APIs so availability and prices stay in sync across your website and online travel agencies.' ), array( 'Do you build apps for guests?', 'Yes. Guest apps can handle booking, digital check-in, service requests, local recommendations and offers, connected to your property systems.' ) ),
	),
);

$ace_steps = array(
	array( 'title' => 'Discover', 'text' => 'We learn your business, users and constraints, and agree measurable goals.' ),
	array( 'title' => 'Design', 'text' => 'Architecture, UX and the right use of AI, shaped around your workflows.' ),
	array( 'title' => 'Build & integrate', 'text' => 'Short sprints with working software every two weeks, connected to your systems.' ),
	array( 'title' => 'Launch & improve', 'text' => 'Secure go-live, monitoring and continuous improvement after launch.' ),
);
$ace_shared_faq = array(
	array( 'question' => 'How long does a typical project take?', 'answer' => 'A focused first release usually takes a few weeks to a few months, depending on scope and integrations. We agree a roadmap with milestones after the discovery phase.' ),
	array( 'question' => 'Can you work with our existing systems?', 'answer' => 'Yes. Most projects integrate with existing software such as ERP, CRM, payment, accounting or industry systems, so data flows without manual re-entry.' ),
);

function ace_ind_links( $text ) {
	return preg_replace_callback( '/\[\[([a-z0-9-]+)\|([^\]]+)\]\]/', function ( $m ) {
		global $wpdb;
		$id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE post_name = %s AND post_type = 'page' AND post_status = 'publish' LIMIT 1", $m[1] ) );
		return $id ? '<a href="' . esc_url( get_permalink( (int) $id ) ) . '">' . esc_html( $m[2] ) . '</a>' : esc_html( $m[2] );
	}, esc_html( $text ) );
}
function ace_ind_find( $slug ) {
	global $wpdb;
	$id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'page' AND post_name = %s AND post_status NOT IN ('trash','auto-draft') ORDER BY ID ASC LIMIT 1", $slug ) );
	return $id ? get_post( (int) $id ) : null;
}

/* -------------------------------------------------------------------------
 * Pages
 * ---------------------------------------------------------------------- */
WP_CLI::log( 'Industry pages:' );
$ace_bgs = array( 'network', 'aurora', 'grid', 'streaks', 'knot' );
$ace_ids = array();
foreach ( $ace_inds as $i => $r ) {
	$page = ace_ind_find( $r['slug'] );
	if ( $page && ( ! $ace_refresh || ! get_post_meta( $page->ID, '_ace_industry_page', true ) ) ) {
		WP_CLI::log( sprintf( '  kept     %-48s ID %d', $r['title'], $page->ID ) );
		$ace_ids[ $r['slug'] ] = $page->ID;
		continue;
	}
	$name    = $r['nav'];
	$content = '<h2>' . esc_html( sprintf( 'Software for %s that fits how you work', $name ) ) . "</h2>\n";
	foreach ( $r['about'] as $p ) {
		$content .= '<p>' . ace_ind_links( $p ) . "</p>\n";
	}
	$content .= '<h2>' . esc_html( sprintf( '%s solutions we build', $name ) ) . "</h2>\n<ul>\n";
	foreach ( $r['solutions'] as $b ) {
		$content .= '<li>' . esc_html( $b ) . "</li>\n";
	}
	$content .= "</ul>\n<h2>Why TechDotBit</h2>\n<ul>\n";
	$content .= "<li><strong>Business first:</strong> we start from your process and goals, not from a technology.</li>\n";
	$content .= "<li><strong>Engineering quality:</strong> clean architecture, testing, security and DevOps on every project.</li>\n";
	$content .= "<li><strong>Applied AI:</strong> AI where it creates measurable value, with people in control.</li>\n</ul>\n";

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
	update_post_meta( $id, '_ace_industry_page', 1 );
	update_post_meta( $id, '_ace_seo_title', $r['seo'] );
	update_post_meta( $id, '_ace_seo_desc', $r['meta'] );
	$fields = array(
		'lp_hero_style'      => 'knot',
		'lp_bg_visual'       => $ace_bgs[ $i % count( $ace_bgs ) ],
		'lp_eyebrow'         => $name,
		'lp_title'           => $r['title'],
		'lp_title_highlight' => $name,
		'lp_intro'           => $r['intro'],
		'lp_points'          => array_map( function ( $t ) { return array( 'text' => $t ); }, $r['points'] ),
		'lp_cta_label'       => 'Discuss your project',
		'lp_cta2_label'      => 'See solutions',
		'lp_cta2_link'       => '#use-cases',
		'lp_form_heading'    => 'Tell us about your project',
		'lp_form_text'       => 'Share what you want to build. We will come back with ideas, an approach and a rough plan.',
		'lp_cards_eyebrow'   => 'What we build',
		'lp_cards_heading'   => $name . ' software we deliver',
		'lp_cards'           => array_map( function ( $c ) { return array( 'title' => $c[0], 'text' => $c[1], 'link' => '' ); }, $r['cards'] ),
		'lp_steps_heading'   => 'How we work',
		'lp_steps'           => $ace_steps,
		'lp_faq'             => array_merge( array_map( function ( $f ) { return array( 'question' => $f[0], 'answer' => $f[1] ); }, $r['faq'] ), $ace_shared_faq ),
		'lp_sections'        => array(),
		'lp_show_stack'      => 1,
	);
	foreach ( $fields as $fname => $value ) {
		update_field( $fname, $value, $id );
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
	WP_CLI::log( sprintf( '  %-8s %-48s ID %d', $page ? 'updated' : 'created', $r['title'], $id ) );
}

/* -------------------------------------------------------------------------
 * Menu: "Industries" -> two groups of industry pages
 * ---------------------------------------------------------------------- */
if ( $ace_menu ) {
	$locations = get_nav_menu_locations();
	$menu_id   = isset( $locations['primary-menu'] ) ? (int) $locations['primary-menu'] : 0;
	$items     = $menu_id ? wp_get_nav_menu_items( $menu_id, array( 'post_status' => 'any' ) ) : array();
	$top       = null;
	foreach ( (array) $items as $it ) {
		if ( 0 === (int) $it->menu_item_parent && preg_match( '/^\s*industr/i', $it->title ) ) {
			$top = $it;
			break;
		}
	}
	if ( ! $top ) {
		WP_CLI::warning( 'No top-level "Industries" item in the Primary Menu; add the pages to the menu manually.' );
	} else {
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
		$remove( (int) $top->ID );
		$classes = array_unique( array_filter( array_merge( (array) $top->classes, array( 'full-menu', 'industry-menu' ) ) ) );
		update_post_meta( $top->ID, '_menu_item_classes', $classes );

		$add = function ( $args ) use ( $menu_id ) {
			return wp_update_nav_menu_item( $menu_id, 0, array_merge( array( 'menu-item-status' => 'publish' ), $args ) );
		};
		$hub = ace_ind_find( 'industries' );
		$col_pos = 1;
		foreach ( $ace_groups as $g => $label ) {
			$col = $add( array(
				'menu-item-title'     => $label,
				'menu-item-url'       => $hub ? get_permalink( $hub ) : '#',
				'menu-item-type'      => 'custom',
				'menu-item-parent-id' => $top->ID,
				'menu-item-position'  => $col_pos++,
			) );
			$n = 0;
			foreach ( $ace_inds as $r ) {
				if ( $r['group'] !== $g ) {
					continue;
				}
				$add( array(
					'menu-item-title'     => $r['nav'],
					'menu-item-object'    => 'page',
					'menu-item-object-id' => $ace_ids[ $r['slug'] ],
					'menu-item-type'      => 'post_type',
					'menu-item-parent-id' => $col,
					'menu-item-position'  => ++$n,
				) );
			}
		}
		if ( $hub && 'publish' === $hub->post_status ) {
			$add( array(
				'menu-item-title'     => 'All industries',
				'menu-item-object'    => 'page',
				'menu-item-object-id' => $hub->ID,
				'menu-item-type'      => 'post_type',
				'menu-item-parent-id' => $top->ID,
				'menu-item-position'  => $col_pos,
			) );
		}
		WP_CLI::log( sprintf( '  menu     "%s" now has 2 groups / %d industries', $top->title, count( $ace_inds ) ) );
	}
}

WP_CLI::success( 'Industry pages ready. Then run: wp litespeed-purge all' );
