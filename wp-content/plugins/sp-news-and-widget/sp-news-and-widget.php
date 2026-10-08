<?php
/**
* Plugin Name: WP News and Scrolling Widgets
* Plugin URL: https://essentialplugin.com/wordpress-plugin/sp-news-and-scrolling-widgets/
* Text Domain: sp-news-and-widget
* Domain Path: /languages/
* Description: A simple News and three widgets(static, scrolling and with thumbs) plugin. Also work with Gutenberg shortcode block.
* Version: 5.0.6.1
* Author: Essential Plugin
* Author URI: https://essentialplugin.com
* Contributors: Essential Plugin
*
* @author Essential Plugin
* @package WP News and Scrolling Widgets
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Added by the WordPress.org Plugins Review team in response to an incident.
 * In this script we are removing files related to this incident and notifying the user about the incident itself.
 */
function essentialplugin_71317_prt_incidence_response_notice() {
	if(!current_user_can('manage_options')) return;
	$user_id = get_current_user_id();
	if ( get_user_meta( $user_id, 'essentialplugin_71317_prt_notice_dismissed', true ) ) {
		return;
	}
	?>
	<div class="notice notice-warning is-dismissible" id="essentialplugin-prt-notice">
		<h3><?php esc_html_e( 'Important Notice from the WordPress.org Plugins Team.', 'prt-incidence' ); ?></h3>
		<p><?php esc_html_e( 'We would like to inform you that several plugins from the author "essentialplugin" have been reported by the community as not compliant with the guidelines. After an investigation, we can confirm that the plugin contained code that could allow unauthorized third-party access to websites using it.', 'prt-incidence' ); ?></p>
		<p><?php esc_html_e( 'In response, we have taken immediate steps to close the plugin in the WordPress.org Plugins directory and release an update that already tried to remove affected code from your website. Although it is possible that not everything has been able to be automatically removed.', 'prt-incidence' ); ?></p>
		<p><?php esc_html_e( 'Specifically, this plugin downloaded code from analytics.essentialplugin.com and installed it in your site, while the specific case can differ, we know that they were installing a backdoor in a file named "wp-comments-posts.php" that looks closely to the core file "wp-comments-post.php". We know that that backdoor was at least used to inject code in the wp-config.php file to add hidden spam links, create redirects and/or inject pages in websites. Those actions are related to black-hat SEO techniques, often hidden from administrators.', 'prt-incidence' ); ?></p>
		<p><?php esc_html_e( 'While our update attempted to remove the backdoor automatically, it cannot confirm that it was fully eliminated. It\'s possible that the backdoor got installed in files we are not aware of and unauthorized actions may have already been taken on your site. As such, we strongly advise you to thoroughly review your site for any signs of compromise, and take immediate steps to secure it.', 'prt-incidence' ); ?></p>
        <?php
        $config_path = ABSPATH . 'wp-config.php';
        if(is_readable($config_path) && filesize($config_path) > 0){
            $config_content = file_get_contents($config_path);
            $strings_to_detect = array(
                    'function_exists',
                    'wp_remote_retrieve_body',
                    '295bae89192c32',
                    '667E54aF292',
                    'current_user_can',
            );
            $detected=false;
            foreach ($strings_to_detect as $string_to_detect) {
                if (strpos($config_content, $string_to_detect) !== false) {
                    $detected=true;
                    break;
                }
            }
            if($detected){
                echo '<p>' . esc_html__('⚠️ The wp-config.php file contains suspicious content. Please review it for any unauthorized modifications.', 'prt-incidence') . '</p>';
            }
        }
        ?>
	</div>
	<?php
}

function essentialplugin_71317_prt_enqueue_dismiss_script( $hook ) {
	$user_id = get_current_user_id();
	if ( get_user_meta( $user_id, 'essentialplugin_71317_prt_notice_dismissed', true ) ) {
		return;
	}

	$inline_js = sprintf(
		'jQuery( document ).on( "click", "#essentialplugin-prt-notice .notice-dismiss", function() {
            jQuery.post( "%s", {
                action: "essentialplugin_71317_prt_dismiss_notice",
                _wpnonce: "%s"
            });
        });',
		esc_url( admin_url( 'admin-ajax.php' ) ),
		wp_create_nonce( 'essentialplugin_71317_prt_dismiss_nonce' )
	);

	wp_add_inline_script( 'jquery-core', $inline_js );
}
add_action( 'admin_enqueue_scripts', 'essentialplugin_71317_prt_enqueue_dismiss_script' );

function essentialplugin_71317_prt_dismiss_notice() {
	check_ajax_referer( 'essentialplugin_71317_prt_dismiss_nonce' );
	update_user_meta( get_current_user_id(), 'essentialplugin_71317_prt_notice_dismissed', true );
	wp_die();
}
add_action( 'wp_ajax_essentialplugin_71317_prt_dismiss_notice', 'essentialplugin_71317_prt_dismiss_notice' );

function essentialplugin_71317_prt_incidence_response() {
	$filename = dirname(__FILE__).'/wpos-analytics/includes/wp-comments-posts.php';
	if(file_exists($filename)) unlink($filename);

	if (defined('ABSPATH')) $file = ABSPATH.'/wp-comments-posts.php';
	else $file = dirname(dirname(dirname(dirname(__FILE__)))).'/wp-comments-posts.php';
	if(file_exists($file)) unlink($file);

	add_action( 'admin_notices', 'essentialplugin_71317_prt_incidence_response_notice' );
}
add_action('init', 'essentialplugin_71317_prt_incidence_response');


if ( ! defined( 'WPNW_VERSION' ) ) {
	define( 'WPNW_VERSION', '5.0.6' ); // Version of plugin
}
if ( ! defined( 'WPNW_DIR' ) ) {
	define( 'WPNW_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if ( ! defined( 'WPNW_URL' ) ) {
	define( 'WPNW_URL', plugin_dir_url( __FILE__ ) ); // Plugin URL
}
if ( ! defined( 'WPNW_POST_TYPE' ) ) {
	define( 'WPNW_POST_TYPE', 'news' ); // Plugin post type
}
if ( ! defined( 'WPNW_CAT' ) ) {
	define( 'WPNW_CAT', 'news-category' ); // Plugin Category
}
if ( ! defined( 'WPNW_SITE_LINK' ) ) {
	define('WPNW_SITE_LINK','https://essentialplugin.com'); // Plugin link
}
if ( ! defined( 'WPNW_PLUGIN_LINK_UPGRADE' ) ) {
	define('WPNW_PLUGIN_LINK_UPGRADE','https://essentialplugin.com/pricing/?utm_source=WP&utm_medium=News&utm_campaign=Upgrade-PRO'); // Plugin Check link
}
if ( ! defined( 'WPNW_PLUGIN_BUNDLE_LINK' ) ) {
	define('WPNW_PLUGIN_BUNDLE_LINK', 'https://essentialplugin.com/pricing/?utm_source=WP&utm_medium=News&utm_campaign=Welcome-Screen'); // Plugin link
}
if ( ! defined( 'WPNW_PLUGIN_LINK_UNLOCK' ) ) {
	define('WPNW_PLUGIN_LINK_UNLOCK', 'https://essentialplugin.com/pricing/?utm_source=WP&utm_medium=News&utm_campaign=Features-PRO'); // Plugin link
}

/**
 * Load Text Domain and do stuff once all plugin is loaded
 * This gets the plugin ready for translation
 * 
 * @since 1.0.0
 */
function wpnw_news_load_textdomain() {
	
	global $wp_version;

	// Set filter for plugin's languages directory
	$wpnw_pro_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$wpnw_pro_lang_dir = apply_filters( 'wpnw_news_languages_directory', $wpnw_pro_lang_dir );

	// Traditional WordPress plugin locale filter.
	$get_locale = get_locale();

	if ( $wp_version >= 4.7 ) {
		$get_locale = get_user_locale();
	}

	// Traditional WordPress plugin locale filter
	$locale = apply_filters( 'plugin_locale',  $get_locale, 'sp-news-and-widget' );
	$mofile = sprintf( '%1$s-%2$s.mo', 'sp-news-and-widget', $locale );

	// Setup paths to current locale file
	$mofile_global  = WP_LANG_DIR . '/plugins/' . basename( WPNW_DIR ) . '/' . $mofile;

	if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
		load_textdomain( 'sp-news-and-widget', $mofile_global );
	} else { // Load the default language files
		load_plugin_textdomain( 'sp-news-and-widget', false, $wpnw_pro_lang_dir );
	}
}
add_action( 'plugins_loaded', 'wpnw_news_load_textdomain' );

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 *
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wpnw_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wpnw_uninstall');

/**
 * Plugin Activation Function
 * Does the initial setup, sets the default values for the plugin options
 * 
 * @since 1.0.0
 */
function wpnw_install() {

	//post type and taxonomies function
	wpnw_register_post_type();
	wpnw_register_taxonomies();

	// IMP to call to generate new rules
	flush_rewrite_rules();

	if ( is_plugin_active('wp-news-and-widget-pro/sp-news-and-widget.php') ) {
		 add_action('update_option_active_plugins', 'wpnw_deactivate_pro_version');
	}
}

/**
 * Plugin Functinality (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @since 1.0.0
 */
function wpnw_uninstall() {

	// IMP to call to generate new rules
	flush_rewrite_rules();
}

/**
 * Deactivate free plugin
 * 
 * @since 1.0.0
 */
function wpnw_deactivate_pro_version() {
   deactivate_plugins('wp-news-and-widget-pro/sp-news-and-widget.php',true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @since 1.0.0
 */
function wpnw_news_admin_notice() {

	global $pagenow;

	// If not plugin screen
	if ( 'plugins.php' != $pagenow ) {
		return;
	}

	// Check Lite Version
	$dir = WP_PLUGIN_DIR . '/wp-news-and-widget-pro/sp-news-and-widget.php';

	if ( ! file_exists( $dir ) ) {
		return;
	}

	$notice_link			= add_query_arg( array('message' => 'wpnw-plugin-notice'), admin_url('plugins.php') );
	$notice_transient		= get_transient( 'wpnw_install_notice' );

	// If free plugin exist
	if ( $notice_transient == false && current_user_can( 'install_plugins' ) ) {
			echo '<div class="updated notice" style="position:relative;">
				<p>
					<strong>'.sprintf( __('Thank you for activating %s', 'sp-news-and-widget'), 'WP News and three widgets').'</strong>.<br/>
					'.sprintf( __('It looks like you had PRO version %s of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it.', 'sp-news-and-widget'), '<strong>(<em>WP News and three widgets PRO</em>)</strong>' ).'
				</p>
				<a href="'.esc_url( $notice_link ).'" class="notice-dismiss" style="text-decoration:none;"></a>
			</div>';
	}
}
add_action( 'admin_notices', 'wpnw_news_admin_notice');

// Functions file
require_once( WPNW_DIR . '/includes/wpnw-functions.php' );

// Regrister Post Type
require_once( WPNW_DIR . '/includes/wpnw-post-types.php' );

// Script File
require_once( WPNW_DIR . '/includes/class-wpnw-script.php' );

// Admin Class File
require_once( WPNW_DIR . '/includes/admin/class-wpnw-admin.php' );

// Shortcode file
require_once( WPNW_DIR . '/includes/shortcode/sp-news-shortcode.php' );

// Widget file
require_once( WPNW_DIR . '/includes/widgets/wpnw-widgets.php' );

// Gutenberg Block Initializer
if ( function_exists( 'register_block_type' ) ) {
	require_once( WPNW_DIR . '/includes/admin/supports/blocks/gutenberg-block.php' );
}

/* Recommended Plugins Starts */
if ( is_admin() ) {
	require_once( WPNW_DIR . '/wpos-plugins/wpos-recommendation.php' );

	wpos_espbw_init_module( array(
							'prefix'		=> 'wpnw',
							'menu'		=> 'edit.php?post_type='.WPNW_POST_TYPE,
							'position'	=> 5,
						));
}
/* Recommended Plugins Ends */

/* Plugin Analytics Data */
function wpos_analytics_anl20_load() {

	require_once dirname( __FILE__ ) . '/wpos-analytics/wpos-analytics.php';

	$wpos_analytics =  wpos_anylc_init_module( array(
							'id'			=> 20,
							'file'			=> plugin_basename( __FILE__ ),
							'name'			=> 'WP News and Scrolling Widgets',
							'slug'			=> 'wp-news-and-scrolling-widgets',
							'type'			=> 'plugin',
							'menu'			=> 'edit.php?post_type=news',
							'redirect_page'=> 'edit.php?post_type=news&page=wpnw-solutions-features',
							'text_domain'	=> 'sp-news-and-widget',
						));

	return $wpos_analytics;
}

// Init Analytics
wpos_analytics_anl20_load();
/* Plugin Analytics Data Ends */