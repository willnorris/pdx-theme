<?php

require_once dirname(__FILE__) . '/includes/template-modules.php';
require_once dirname(__FILE__) . '/includes/widgets.php';


/**
 * Setup pdx theme.
 */
function pdx_setup() {
  // Add default posts and comments RSS feed links to head
  add_theme_support( 'automatic-feed-links' );

  pdx_load_textdomain();

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'primary' => __( 'Primary Navigation', 'pdx' ),
  ) );
}
add_action('after_setup_theme', 'pdx_setup');


/**
 * Load the theme's translated strings from the /languages/ directory.  Also
 * load /langages/{$locale}.php theme file.
 */
function pdx_load_textdomain() {
  load_theme_textdomain( 'pdx', get_template_directory() . '/languages' );

  $locale = get_locale();
  $locale_file = get_template_directory() . "/languages/$locale.php";
  if ( is_readable( $locale_file ) ) {
    require_once( $locale_file );
  }
}


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

  if ( is_feed() ) {
    return $title;
  }

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
 * Generate page title for archive pages.
 */
function pdx_archive_page_title() {
  if ( have_posts() ) {
    the_post();
  }

  if ( is_category() ) {
    $template = __( 'Category Archives: %s', 'pdx' );
    $value = single_cat_title( '', false);
  } else if ( is_tag() ) {
    $template = __( 'Tag Archives: %s', 'pdx' );
    $value = single_tag_title( '', false);
  } else if ( is_author() ) {
    $template = __( 'Author Archives: %s', 'pdx' );
    $value = get_the_author();
  } else if ( is_day() ) {
    $template = __( 'Daily Archives: %s', 'pdx' );
    $value = get_the_date();
  } else if ( is_month() ) {
    $template = __( 'Monthly Archives: %s', 'pdx' );
    $value = get_the_date('F Y');
  } else if ( is_year() ) {
    $template = __( 'Yearly Archives: %s', 'pdx' );
    $value = get_the_date('Y');
  } else {
    $template = null;
    $title = __( 'Blog Archives', 'pdx' );
  }

  if ( $template ) {
    $title = sprintf( $template, '<span>' . $value . '</span>' );
  }

  rewind_posts();

  return apply_filters('pdx_archive_page_title', $title);
}


/**
 * Generate page title for search pages.
 */
function pdx_search_page_title() {
  $title = sprintf( __( 'Search Results for: %s', 'pdx' ), '<span>' . get_search_query() . '</span>' );
  return apply_filters('pdx_search_page_title', $title);
}


/**
 * Generate page description for archive pages.
 */
function pdx_archive_page_description() {
  if ( is_category() || is_tag() || is_tax() ) {
    $description = term_description();
  } else if ( is_author() ) {
    $description = get_the_author_meta( 'description' );
  } else {
    $description = '';
  }

  return apply_filters('pdx_archive_page_description', $description);
}


function pdx_comments_title() {
  comments_number(
    sprintf(__('No Responses to %s', 'pdx'), '<em>' . get_the_title() . '</em>'),
    sprintf(__('One Response to %s', 'pdx'), '<em>' . get_the_title() . '</em>'),
    sprintf(__('%% Responses to %s', 'pdx'), '<em>' . get_the_title() . '</em>')
  );
}


function pdx_list_comments() {
  wp_list_comments(
    array( 'style' => 'div', 'callback' => 'pdx_comment_start', 'end-callback' => 'pdx_comment_end')
  );
}


/**
 * Display notice that comments are the post are closed.
 *
 * @uses apply_filters Calls 'pdx_comments_closed' before returning the notice
 */
function pdx_comments_closed() {
  echo apply_filters('pdx_comments_closed', 
    '<p class="nocomments">' . __('Comments are closed', 'pdx') . '</p>');
}


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


/**
 * Start 'comment' template module.
 */
function pdx_comment_start( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  $GLOBALS['comment_args'] = $args;
  $GLOBALS['comment_depth'] = $depth;

  get_template_module('comment');
}


/**
 * End 'comment' template module.
 */
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
    global $wp_scripts;
    if ( wp_script_is('jquery', 'registered') ) {
      $ver = $wp_scripts->query('jquery', 'registered')->ver;
      wp_deregister_script('jquery');
      wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/' . $ver . '/jquery.min.js', 
        false, $ver);
    }
    wp_register_script('modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.0.6/modernizr.min.js',
      false, '2.0.6', true);
  } else {
    // do something ?
  }
}
add_action('wp', 'pdx_js', 5);


/**
 * Add the default stylesheet. Try to use last modified time to stylesheet URI to ensure freshness.
 * We also enqueue the main stylesheet rather than load it directly in header.php to ensure it loads
 * before scripts.
 *
 * @see http://markjaquith.wordpress.com/2009/05/04/force-css-changes-to-go-live-immediately/
 * @see http://code.google.com/speed/page-speed/docs/rtt.html#PutStylesBeforeScripts
 */
function pdx_add_style() {
  $stylesheet = get_stylesheet_uri();
  $version = false;

  $stylesheet_dir_uri = get_stylesheet_directory_uri();
  $stylesheet_dir = get_stylesheet_directory();

  if ( strstr($stylesheet, $stylesheet_dir_uri) ) {
    $file = preg_replace('|' . $stylesheet_dir_uri . '|', $stylesheet_dir, $stylesheet);
    $version = filemtime( $file );
  }

  wp_enqueue_style('style', $stylesheet, array(), $version);
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

