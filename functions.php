<?php

require_once dirname(__FILE__) . '/includes/template-modules.php';
require_once dirname(__FILE__) . '/includes/widgets.php';


/**
 * Setup pdx theme.
 */
function pdx_setup() {
  // Add default posts and comments RSS feed links to head
  add_theme_support( 'automatic-feed-links' );

  // Make theme available for translation
  // Translations can be filed in the /languages/ directory
  load_theme_textdomain( 'pdx', TEMPLATEPATH . '/languages' );

  $locale = get_locale();
  $locale_file = TEMPLATEPATH . "/languages/$locale.php";
  if ( is_readable( $locale_file ) ) {
    require_once( $locale_file );
  }

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'primary' => __( 'Primary Navigation', 'pdx' ),
  ) );
}
add_action('after_setup_theme', 'pdx_setup');


/**
 * Remove wrapping <div> from around page menu.
 */
function pdx_page_menu( $menu, $args ) {
  $menu = preg_replace('|^<div.+?>(.+)</div>$|', '\\1', $menu);
  return $menu;
}
add_filter('wp_page_menu', 'pdx_page_menu', 10, 2);


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since pdx 1.0
 */
function pdx_page_menu_args( $args ) {
  $args['show_home'] = true;
  return $args;
}
add_filter( 'wp_page_menu_args', 'pdx_page_menu_args' );


/**
 * Build HTML page <title>.
 */
function pdx_title() {
  $sep = apply_filters('pdx_title_separator', '&#8212;');
  $location = ( is_front_page() || is_home() ) ? '' : 'right';
  $location = apply_filters('pdx_title_sep_location', $location);

  echo wp_title($sep, false, $location);
}


/**
 * Customize wp_title based on the type of page.  Include page number if applicable as well as the blog name.
 */
function pdx_filter_title($title, $sep, $seplocation) {
  global $paged, $page;

  if ( is_category() ) {
    $title .= sprintf( __('Category Archives %s ', 'pdx'), $sep);
  } else if ( is_tag() ) {
    $title .= sprintf( __('Tag Archives %s ', 'pdx'), $sep);
  } else if ( is_archive() ) {
    $title .= sprintf( __('Archives %s ', 'pdx'), $sep);
  }

  if ( is_front_page() && $title == '' ) {
    $title = get_bloginfo('description');
    if ( $seplocation == 'right' ) {
      $title .= " $sep ";
    } else {
      $title = " $sep " . $title;
    }
  }

  // add page number
  if ( $paged >= 2 || $page >= 2 ) {
    if ( $seplocation == 'right' ) {
      $title .= sprintf( __('Page %s', 'pdx'), max($paged, $page) ) . " $sep ";
    } else {
      $title .= " $sep " . sprintf( __('Page %s', 'pdx'), max($paged, $page) );
    }
  }

  // add blog name
  if ( $seplocation == 'right') {
    $title .= get_bloginfo('name');
  } else {
    $title = get_bloginfo('name') . $title;
  }

  return $title;
}
add_filter('wp_title', 'pdx_filter_title', 10, 3);


/**
 * Use blog description as title for home page.
 */
function pdx_single_post_title($title, $post) {
  if ( is_home() ) {
    $title = get_bloginfo('description');
  }
  return $title;
}
add_filter('single_post_title', 'pdx_single_post_title', 10, 2);


/**
 * Cleanup a few core WordPress things.
 */
function pdx_cleanup_wp() {
  // remove 'capital_P_dangit'
  foreach ( array( 'the_content', 'the_title', 'comment_text' ) as $filter ) {
    remove_filter( $filter, 'capital_P_dangit', 11 );
  }

  // remove the default styles that are packaged with the Recent Comments widget.
  global $wp_widget_factory;
  remove_action( 'wp_head', 
    array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );

  // remove rpc related links if not necessary
  if ( !get_option('enable_xmlrpc') ) {
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
  }

  // remove adjacent links for pages
  if ( is_page() ) {
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
  }
}
add_action('wp', 'pdx_cleanup_wp', 99);


function pdx_comment_start( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  $GLOBALS['comment_args'] = $args;
  $GLOBALS['comment_depth'] = $depth;

  get_template_module('comment');
}


function pdx_comment_end( $comment, $args, $depth ) {
?>
  </article>
<?php
}


/**
 * pdx javascript
 */
function pdx_js() {
  $offload_js = !WP_DEBUG;
  $offload_js = apply_filters('pdx_offload_js', $offload_js);

  if ( $offload_js ) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js', 
      false, '1.4.2');
    wp_register_script('modernizr', 'http://cachedcommons.org/cache/modernizr/1.5.0/javascripts/modernizr-min.js',
      false, '1.5', true);
  } else {
    // do something ?
  }

  wp_enqueue_script('modernizr');
}
add_action('wp', 'pdx_js', 5);


/**
 * Add the default stylesheet.
 */
function pdx_add_style() {
  wp_enqueue_style('style', get_stylesheet_uri());
}
add_action('wp_head', 'pdx_add_style', 5);


/**
 * Add 'no-js' class to html element if modernizr is present.
 */
function pdx_modernizr_no_js($attributes) {
  $modernizr = apply_filters('include_modernizr', false);
  if ( $modernizr || wp_script_is('modernizr', 'queue') ) {
    $attributes .= ' class="no-js"';
  }
  return $attributes;
}
add_filter('language_attributes', 'pdx_modernizr_no_js');


/**
 * Handle 'safe_email' shortcode which converts email address into spambot-safe link.
 */
function pdx_safe_email($atts, $content=null) {
    return '<a href="mailto:' . antispambot($content) . '">' . antispambot($content) . '</a>';
}
add_shortcode('safe_email', 'pdx_safe_email');

