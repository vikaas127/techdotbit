<?php

function add_theme_scripts() {
  //Remove desired parent styles
  wp_dequeue_style( 'twenty-twenty-one-style' );
  // The root style.css only holds the theme header, so it is not enqueued.
  wp_enqueue_style( 'lqd-essentials-style', get_stylesheet_directory_uri() . '/assets/vendors/liquid-icon/lqd-essentials/lqd-essentials.min.css', array(), '1.1', 'all');
  wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/assets/css/theme.min.css', array(), '1.1', 'all');
  wp_enqueue_style( 'utility-style', get_stylesheet_directory_uri() . '/assets/css/utility.min.css', array(), '1.1', 'all');
  wp_enqueue_style( 'classic-style', get_stylesheet_directory_uri() . '/assets/css/demo/classic.css', array(), '1.1', 'all');
  wp_enqueue_style( 'font-style', 'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Sora:wght@500;600;700;800&display=swap', array(), null );
  wp_enqueue_style( 'Custom-style', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), '1.2', 'all');
  wp_enqueue_style( 'modern-style', get_stylesheet_directory_uri() . '/assets/css/modern.css', array( 'Custom-style' ), filemtime( get_stylesheet_directory() . '/assets/css/modern.css' ), 'all');
  wp_enqueue_style( 'ai-theme-style', get_stylesheet_directory_uri() . '/assets/css/ai-theme.css', array( 'modern-style' ), filemtime( get_stylesheet_directory() . '/assets/css/ai-theme.css' ), 'all');
  
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts', 20 );

function add_my_script() {
    wp_dequeue_script( 'twenty-twenty-one-script' );
    // Use WordPress's bundled jQuery; loading a second (older) copy here
    // overwrote it and broke plugin scripts such as the job application form.
    wp_enqueue_script('jquery-ui-script', get_stylesheet_directory_uri() . '/assets/vendors/jquery-ui/jquery-ui.min.js', array('jquery'));
    wp_enqueue_script('fastdom-script', get_stylesheet_directory_uri() . '/assets/vendors/fastdom/fastdom.min.js', array('jquery'));
    wp_enqueue_script('bootstrap-script', get_stylesheet_directory_uri() . '/assets/vendors/bootstrap/js/bootstrap.min.js', array('jquery'));
    wp_enqueue_script('lity-script', get_stylesheet_directory_uri() . '/assets/vendors/lity/lity.min.js', array('jquery'));
    wp_enqueue_script('SplitText-script', get_stylesheet_directory_uri() . '/assets/vendors/gsap/utils/SplitText.min.js', array('jquery'));
    wp_enqueue_script('flickity-script', get_stylesheet_directory_uri() . '/assets/vendors/flickity/flickity.pkgd.min.js', array('jquery'));
    wp_enqueue_script('gsap-script', get_stylesheet_directory_uri() . '/assets/vendors/gsap/minified/gsap.min.js', array('jquery'));
    wp_enqueue_script('ScrollTrigger-script', get_stylesheet_directory_uri() . '/assets/vendors/gsap/minified/ScrollTrigger.min.js', array('jquery'));
    wp_enqueue_script('fontfaceobserver-script', get_stylesheet_directory_uri() . '/assets/vendors/fontfaceobserver.js', array('jquery'));
    wp_enqueue_script('liquid-gdpr-script', get_stylesheet_directory_uri() . '/assets/js/liquid-gdpr.min.js', array('jquery'));
    wp_enqueue_script('theme-script', get_stylesheet_directory_uri() . '/assets/js/theme.min.js', array('jquery'));
    wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'));
    wp_enqueue_script('modern-script', get_stylesheet_directory_uri() . '/assets/js/modern.js', array(), filemtime( get_stylesheet_directory() . '/assets/js/modern.js' ), array( 'in_footer' => true, 'strategy' => 'defer' ));
    
}
add_action( 'wp_footer', 'add_my_script' );


add_action( 'init', 'custom_menu' );
function custom_menu() {
    register_nav_menus(
        array(
            'primary-menu' => __( 'Primary Menu' ),
            'footer-menu-1' => __( 'Footer Menu 1' ),
            'footer-menu-2' => __( 'Footer Menu 2' )
        )
    );
}



/* SECTION - project_custom_init */

add_action('init', 'project_custom_init');

function project_custom_init()
{
  // The following is all the names, in our tutorial, we use "Project" 
  $labels = array(
    'name' => _x('Portfolios', 'post type general name'),
    'singular_name' => _x('Portfolio', 'post type singular name'),
    'add_new' => _x('Add New', 'project'),
    'add_new_item' => __('Add New Portfolio'),
    'edit_item' => __('Edit Portfolio'),
    'new_item' => __('New Portfolio'),
    'view_item' => __('View Portfolio'),
    'search_items' => __('Search Portfolio'),
    'not_found' =>  __('No portfolio found'),
    'not_found_in_trash' => __('No portfolio found in Trash'),
    'parent_item_colon' => '',
    'menu_name' => 'Portfolio'
  );
    
  // Some arguments and in the last line 'supports', we say to WordPress what features are supported on the Project post type 
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => false, 'with_front' => false),
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title','editor','author','thumbnail','excerpt','comments','featured')
  );
    
  // We call this function to register the custom post type 
  register_post_type('project', $args);
  
  // Initialize Taxonomy Labels 
  $labels = array(
    'name' => _x( 'Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Categories', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Types' ),
    'all_items' => __( 'All Categories' ),
    'parent_item' => __( 'Parent Category' ),
    'parent_item_colon' => __( 'Parent Category:' ),
    'edit_item' => __( 'Edit Category' ),
    'update_item' => __( 'Update Category' ),
    'add_new_item' => __( 'Add New Category' ),
    'new_item_name' => __( 'New Category Name' ),
  );
    
  // Register Custom Taxonomy 
  register_taxonomy('tagportfolio',array('project'), array(
    'hierarchical' => true, // define whether to use a system like tags or categories 
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'tag-portfolio' ),
  ));
}

// /* #end SECTION - project_custom_init --*/
// function wptw_remove_cpt_slug( $post_link, $post ) {
 
//     if ( 'project' === $post->post_type && 'publish' === $post->post_status ) {
//         $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
//     }
 
//     return $post_link;
// }
// add_filter( 'post_type_link', 'wptw_remove_cpt_slug', 10, 2 );

function wptw_parse_request( $query ) {
 
    if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
        return;
    }
 
    if ( ! empty( $query->query['name'] ) ) {
        $query->set( 'post_type', array( 'post', 'project', 'page' ) );
    }
}
add_action( 'pre_get_posts', 'wptw_parse_request' );

function parse_request_remove_cpt_slug( $query_vars ) {
 
    // return if admin dashboard 
    if ( is_admin() ) {
        return $query_vars;
    }
 
    // return if pretty permalink isn't enabled
    if ( ! get_option( 'permalink_structure' ) ) {
        return $query_vars;
    }
 
    $cpt = 'project';
 
    // store post slug value to a variable
    if ( isset( $query_vars['pagename'] ) ) {
        $slug = $query_vars['pagename'];
    } elseif ( isset( $query_vars['name'] ) ) {
        $slug = $query_vars['name'];
    } else {
        global $wp;
        
        $path = $wp->request;
 
        // use url path as slug
        if ( $path && strpos( $path, '/' ) === false ) {
            $slug = $path;
        } else {
            $slug = false;
        }
    }
 
    if ( $slug ) {
        $post_match = get_page_by_path( $slug, 'OBJECT', $cpt );
 
        if ( ! is_admin() && $post_match ) {
 
            // remove any 404 not found error element from the query_vars array because a post match already exists in cpt
            if ( isset( $query_vars['error'] ) && $query_vars['error'] == 404 ) {
                unset( $query_vars['error'] );
            }
 
            // remove unnecessary elements from the original query_vars array
            unset( $query_vars['pagename'] );
    
            // add necessary elements in the the query_vars array
            $query_vars['post_type'] = $cpt;
            $query_vars['name'] = $slug;
            $query_vars[$cpt] = $slug; // this constructs the "cpt=>post_slug" element
        }
    }
 
    return $query_vars;
}
add_filter( 'request', "parse_request_remove_cpt_slug" , 1, 1 );

/*--- Custom Messages - project_updated_messages ---*/
  add_filter('post_updated_messages', 'project_updated_messages');
  
  function project_updated_messages( $messages ) {
    global $post, $post_ID;
    $messages['project'] = array(
    0 => '', // Unused. Messages start at index 1. 
    1 => sprintf( __('Portfolio updated. <a href="%s">View Portfolio</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Portfolio updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Portfolio restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Portfolio published. <a href="%s">View Portfolio</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Portfolio saved.'),
    8 => sprintf( __('Portfolio submitted. <a target="_blank" href="%s">Preview Portfolio</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Portfolio scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Portfolio</a>'),
      // translators: Publish box date format, see https://php.net/date 
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Portfolio draft updated. <a target="_blank" href="%s">Preview Portfolio</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );
    return $messages;
  }
  
  /*--- #end SECTION - project_updated_messages ---*/
  /*--- Demo URL meta box ---*/
  
  add_action('admin_init','portfolio_meta_init');
  
  function portfolio_meta_init()
  {
    // add a meta box for WordPress 'project' type 
    add_meta_box('portfolio_meta', 'Portfolio Infos', 'project', 'side', 'low');
   
    // add a callback function to save any data a user enters in 
    add_action('save_post','portfolio_meta_save');
  }
  
  
  function portfolio_meta_save($post_id) 
  {
    // check nonce 
    if (!isset($_POST['meta_noncename']) || !wp_verify_nonce($_POST['meta_noncename'], __FILE__)) {
    return $post_id;
    }
    // check capabilities 
    if ('post' == $_POST['post_type']) {
    if (!current_user_can('edit_post', $post_id)) {
    return $post_id;
    }
    } elseif (!current_user_can('edit_page', $post_id)) {
    return $post_id;
    }
    // exit on autosave 
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
    }
    if(isset($_POST['_url'])) 
    {
      update_post_meta($post_id, '_url', $_POST['_url']);
    } else 
    {
      delete_post_meta($post_id, '_url');
    }
  }
  
  /*--- #end Demo URL meta box ---*/


if( function_exists('acf_add_options_page') ) {
  
  acf_add_options_page(array(
    'page_title'  => 'Theme General Settings',
    'menu_title'  => 'Theme Settings',
    'menu_slug'   => 'theme-general-settings',
    'capability'  => 'edit_posts',
    'redirect'    => false
  ));
  
  acf_add_options_sub_page(array(
    'page_title'  => 'Theme Header Settings',
    'menu_title'  => 'Header Setting',
    'parent_slug' => 'theme-general-settings',
  ));
  
  acf_add_options_sub_page(array(
    'page_title'  => 'Theme Footer Settings',
    'menu_title'  => 'Footer Setting',
    'parent_slug' => 'theme-general-settings',
  ));
  
}

//upload svg 

function add_file_types_to_uploads($file_types){
  $new_filetypes = array();
  $new_filetypes['svg'] = 'image/svg+xml';
  $file_types = array_merge($file_types, $new_filetypes );
  return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');


// Table of contents

function get_toc($content) {
  // get headlines
  $headings = get_headings($content);

  // parse toc
  ob_start();
  echo "<div class='table-of-contents'>";
  echo "<h5 class='text-16 toc-headline'>Table of Contents</h5>";
  echo "<!-- Table of contents -->";
  parse_toc($headings, 0, 0);
  echo "</div>";
  return ob_get_clean();
}

function parse_toc($headings, $index, $recursive_counter) {
  // prevent errors
  if($recursive_counter > 60 || !count($headings)) return;

  // get all needed elements
  $last_element = $index > 0 ? $headings[$index - 1] : NULL;
  $current_element = $headings[$index] ?? NULL;
  $next_element = $headings[$index + 1] ?? NULL;

  // end recursive calls
  if($current_element == NULL) return;


  // get all needed variables
  $tag = intval($headings[$index]["tag"]);
  $id = $headings[$index]["id"];
  $classes = $headings[$index]["classes"] ?? array();
  $name = $headings[$index]["name"];


  // element not in toc
  if(!empty($current_element["classes"]) && in_array("nitoc", $current_element["classes"])) {
    parse_toc($headings, $index + 1, $recursive_counter + 1);
    return;
  }


  // parse toc begin or toc subpart begin
  if($last_element == NULL || $last_element["tag"] < $tag) echo '<ul class="list-unstyled">';


  // build li class
  $li_classes = "";
  if(!empty($current_element["classes"]) && in_array("toc-bold", $current_element["classes"])) $li_classes = " class='bold'";

  // parse line begin
  echo "<li" . $li_classes .">";

  // only parse name, when li is not bold
  if(!empty($current_element["classes"]) && in_array("toc-bold", $current_element["classes"])) {
    echo $name;
  } else {
    echo "<a href='#" . esc_attr($id) . "'>" . wp_strip_all_tags($name) . "</a>";
  }

  if($next_element && intval($next_element["tag"]) > $tag) {
    parse_toc($headings, $index + 1, $recursive_counter + 1);
  }

  // parse line end
  echo "</li>";

  // parse next line
  if($next_element && intval($next_element["tag"]) == $tag) {
    parse_toc($headings, $index + 1, $recursive_counter + 1);
  }


  // parse toc end or toc subpart end
  if($next_element == NULL || $next_element["tag"] < $tag) echo "</ul>";

  // parse top subpart
  if($next_element != NULL && $next_element["tag"] < $tag) {
    parse_toc($headings, $index + 1, $recursive_counter + 1);
  }
}

function get_headings($content) {
  $headings = array();
  preg_match_all("/<h([1-6])([^>]*)>(.*?)<\/h\\1>/s", $content, $matches);
  
  for($i = 0; $i < count($matches[1]); $i++) {

    $headings[$i]["tag"] = $matches[1][$i];

    // get id
    $att_string = $matches[2][$i];
    preg_match("/id=\"([^\"]*)\"/", $att_string , $id_matches);
    $headings[$i]["id"] = $id_matches[1] ?? sanitize_title(wp_strip_all_tags($matches[3][$i]));

    // get classes
    $att_string = $matches[2][$i];
    preg_match_all("/class=\"([^\"]*)\"/", $att_string , $class_matches);
    for($j = 0; $j < count($class_matches[1]); $j++) {
      $headings[$i]["classes"][] = $class_matches[1][$j];
    }

    $headings[$i]["name"] = $matches[3][$i];
  }

  return $headings;
}


// TOC 
function toc_shortcode() {
    return get_toc(get_the_content());
}
add_shortcode('TOC', 'toc_shortcode');



// Add social media
// Function to handle the thumbnail request
function get_the_post_thumbnail_src($img)
{
  return (preg_match('~\bsrc="([^"]++)"~', $img, $matches)) ? $matches[1] : '';
}
function wpvkp_social_buttons($content) {
    global $post;
    if(is_singular() || is_home()){
    
        // Get current page URL 
        $sb_url = urlencode(get_permalink());
 
        // Get current page title
        $sb_title = rawurlencode( html_entity_decode( get_the_title(), ENT_QUOTES, 'UTF-8' ) );
        
        // Get Post Thumbnail for pinterest
        $sb_thumb = get_the_post_thumbnail_src(get_the_post_thumbnail());
 
        // Construct sharing URL without using any script
        $twitterURL = 'https://twitter.com/intent/tweet?text='.$sb_title.'&amp;url='.$sb_url;
        $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$sb_url;
        $linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&amp;url='.$sb_url.'&amp;title='.$sb_title;
 
        // Add sharing button at the end of page/page content
        $content .= '<div class="social-box"><div class="social-btn">';
        $content .= '<a class="sbtn s-twitter mr-15" href="'. $twitterURL .'" target="_blank" rel="nofollow"><img src="'.site_url().'/wp-content/uploads/2023/12/twitter-icon.svg" alt="TwitterSquared" loading="lazy"></a>';
        $content .= '<a class="sbtn s-facebook mr-15" href="'.$facebookURL.'" target="_blank" rel="nofollow"><img src="'.site_url().'/wp-content/uploads/2023/12/facebook-icon.svg" alt="facebook" loading="lazy"></a>';
        $content .= '<a class="sbtn s-linkedin" href="'.$linkedInURL.'" target="_blank" rel="nofollow"><img src="'.site_url().'/wp-content/uploads/2023/12/linkedin-icon.svg" alt="LinkedIn" loading="lazy"></a>';
        $content .= '</div></div>';
        
        return $content;
    }else{
        // if not a post/page then don't include sharing button
        return $content;
    }
};
// Enable the_content if you want to automatically show social buttons below your post.

 // Share buttons are placed by the [social] shortcode in single.php; appending
 // them to every page's content duplicated them on posts.

// This will create a wordpress shortcode [social].
// Please it in any widget and social buttons appear their.
// You will need to enabled shortcode execution in widgets.
add_shortcode('social', function() { return wpvkp_social_buttons(''); });

function custom_excerpt_length( $length ) {
  return 15;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


// add_action('pre_get_posts', 'wpse161279_ignore_sticky_posts');
// // the function that does the work
// function wpse161279_ignore_sticky_posts($query)
// {
//     if (!is_admin() && $query->is_main_query()) {
//         $sticky = get_option( 'sticky_posts' );
//         $query->set( 'post__not_in', array( $sticky[0] ) );
//     }   
// }
// Function to display the subscription form
function newsletter_subscription_form() {
    ob_start();
    ?>
    <form id="newsletter-subscription-form" method="post">
        <input type="email" name="subscriber_email" required placeholder="Enter your email">
        <input type="hidden" name="action" value="subscribe_newsletter">
        <button type="submit">Subscribe</button>
        <div id="newsletter-message"></div>
    </form>
    <script type="text/javascript">
        document.getElementById('newsletter-subscription-form').addEventListener('submit', function(event) {
            event.preventDefault();
            var form = this;
            var formData = new FormData(form);

            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('newsletter-message').textContent = (data.data && data.data.message) || '';
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('newsletter_form', 'newsletter_subscription_form');

// Function to handle the form submission
function handle_newsletter_subscription() {
    if ( isset($_POST['subscriber_email']) && is_email($_POST['subscriber_email']) ) {
        $subscriber_email = sanitize_email($_POST['subscriber_email']);

        // Prepare the email
        $to = get_option('admin_email'); // You can change this to any email address
        $subject = 'New Newsletter Subscription';
        $message = 'You have a new newsletter subscription from: ' . $subscriber_email;
        $headers = array('Content-Type: text/html; charset=UTF-8');

        // Send the email
        if ( wp_mail($to, $subject, $message, $headers) ) {
            wp_send_json_success(array('message' => 'Thank you for subscribing!'));
        } else {
            wp_send_json_error(array('message' => 'There was an error sending your subscription. Please try again.'));
        }
    } else {
        wp_send_json_error(array('message' => 'Please enter a valid email address.'));
    }
}
add_action('wp_ajax_subscribe_newsletter', 'handle_newsletter_subscription');
add_action('wp_ajax_nopriv_subscribe_newsletter', 'handle_newsletter_subscription');


/**
 * Give headings in post content an id so Table of Contents links can jump to them.
 */
function ace_add_heading_ids( $content ) {
  if ( ! is_singular( 'post' ) || ! in_the_loop() ) {
    return $content;
  }
  return preg_replace_callback( '/<h([1-6])([^>]*)>(.*?)<\/h\1>/s', function ( $m ) {
    if ( preg_match( '/\sid=/', $m[2] ) ) {
      return $m[0];
    }
    $id = sanitize_title( wp_strip_all_tags( $m[3] ) );
    return $id ? '<h' . $m[1] . $m[2] . ' id="' . esc_attr( $id ) . '">' . $m[3] . '</h' . $m[1] . '>' : $m[0];
  }, $content );
}
add_filter( 'the_content', 'ace_add_heading_ids', 5 );

/**
 * The parent theme only adds sub-menu toggle buttons for its own "primary"
 * location; add them for ours so mobile visitors can open sub-menus.
 */
add_filter( 'walker_nav_menu_start_el', function ( $output, $item, $depth, $args ) {
  if ( isset( $args->theme_location ) && 'primary-menu' === $args->theme_location && 0 === $depth && in_array( 'menu-item-has-children', (array) $item->classes, true ) ) {
    $output .= '<button class="sub-menu-toggle" aria-expanded="false"><span class="icon-plus" aria-hidden="true">+</span><span class="icon-minus" aria-hidden="true">&minus;</span><span class="screen-reader-text">' . esc_html__( 'Open sub-menu', 'ace' ) . '</span></button>';
  }
  return $output;
}, 10, 4 );

/**
 * Print the Google Tag Manager <noscript> fallback right after <body>.
 */
add_action( 'wp_body_open', function () {
  echo '<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-54W7LPM5" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>' . "\n";
} );

/**
 * URL of the page that lists all portfolio projects (used by "See more works").
 */
function ace_portfolio_url() {
  $pages = get_pages( array( 'meta_key' => '_wp_page_template', 'meta_value' => 'portfolio-template.php', 'number' => 1 ) );
  if ( $pages ) {
    return get_permalink( $pages[0] );
  }
  $archive = get_post_type_archive_link( 'project' );
  return $archive ? $archive : home_url( '/' );
}

/**
 * "AI Landing Page" template: fields + assets (only on pages that use it).
 */
require_once get_stylesheet_directory() . '/inc/landing-fields.php';

add_action( 'wp_enqueue_scripts', function () {
  if ( ! is_page_template( array( 'landing-template.php', 'technology-template.php' ) ) && ! is_front_page() ) {
    return;
  }
  $dir = get_stylesheet_directory();
  $uri = get_stylesheet_directory_uri();
  wp_enqueue_style( 'ace-landing', $uri . '/assets/css/landing.css', array( 'ai-theme-style' ), filemtime( $dir . '/assets/css/landing.css' ) );
  wp_enqueue_style( 'ace-sections', $uri . '/assets/css/sections.css', array( 'ace-landing' ), filemtime( $dir . '/assets/css/sections.css' ) );
  wp_enqueue_script( 'ace-landing-orb', $uri . '/assets/js/landing-orb.js', array(), filemtime( $dir . '/assets/js/landing-orb.js' ), array( 'in_footer' => true, 'strategy' => 'defer' ) );
}, 30 );

// Body class for the landing page hero style (styles the header per style).
add_filter( 'body_class', function ( $classes ) {
  if ( is_page_template( 'landing-template.php' ) && function_exists( 'get_field' ) ) {
    $style     = get_field( 'lp_hero_style' );
    $classes[] = 'tdb-lp-style-' . sanitize_html_class( $style ? $style : 'knot' );
  }
  return $classes;
} );

/**
 * Posts that promote third-party products keep their content, but their
 * outbound links are marked rel="sponsored nofollow" as Google requires for
 * paid/promotional links. Add slugs via the 'ace_sponsored_post_slugs' filter.
 */
function ace_sponsored_post_slugs() {
  return apply_filters( 'ace_sponsored_post_slugs', array(
    'crypto-legacy-app-software',
    'crypto-legacy-apps-safeguarding-digital-wealth-for-future-generation',
    'crypto-legacy-app-the-game-changer-for-modern-cryptocurrency-traders',
    'what-is-fintechzoom',
    'what-is-fintechzoom-com',
    'what-is-alaya-ai',
  ) );
}

add_filter( 'the_content', function ( $content ) {
  if ( ! is_singular( 'post' ) || ! in_array( get_post_field( 'post_name', get_the_ID() ), ace_sponsored_post_slugs(), true ) ) {
    return $content;
  }
  $home = wp_parse_url( home_url(), PHP_URL_HOST );
  return preg_replace_callback( '/<a\s[^>]*href=("|\')(https?:\/\/[^"\']+)\1[^>]*>/i', function ( $m ) use ( $home ) {
    $tag  = $m[0];
    $host = wp_parse_url( $m[2], PHP_URL_HOST );
    if ( ! $host || $host === $home || substr( $host, -strlen( '.' . $home ) ) === '.' . $home ) {
      return $tag; // internal link
    }
    if ( preg_match( '/\srel=("|\')([^"\']*)\1/i', $tag, $r ) ) {
      $rels = array_unique( array_merge( preg_split( '/\s+/', trim( $r[2] ) ), array( 'sponsored', 'nofollow', 'noopener' ) ) );
      return str_replace( $r[0], ' rel="' . esc_attr( implode( ' ', array_filter( $rels ) ) ) . '"', $tag );
    }
    return preg_replace( '/^<a\s/i', '<a rel="sponsored nofollow noopener" ', $tag );
  }, $content );
}, 20 );

/**
 * Light theme: white, professional look (loaded after every other stylesheet,
 * including landing.css). Remove this to go back to the dark design.
 */
add_action( 'wp_enqueue_scripts', function () {
  $file = get_stylesheet_directory() . '/assets/css/light-theme.css';
  wp_enqueue_style( 'ace-light-theme', get_stylesheet_directory_uri() . '/assets/css/light-theme.css', array( 'ai-theme-style' ), filemtime( $file ) );
}, 40 );
