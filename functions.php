<?php


function base_setup() { 
  // Add default posts and comments RSS feed links to head
  add_theme_support( 'automatic-feed-links' );

  // Make theme available for translation
  // Translations can be filed in the /languages/ directory
  load_theme_textdomain( 'base', TEMPLATEPATH . '/languages' );

  $locale = get_locale();
  $locale_file = TEMPLATEPATH . "/languages/$locale.php";
  if ( is_readable( $locale_file ) ) {
    require_once( $locale_file );
  }

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'primary' => __( 'Primary Navigation', 'base' ),
  ) );
}
add_action('after_setup_theme', 'base_setup');


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Base 1.0
 */
function base_page_menu_args( $args ) {
  $args['show_home'] = true;
  return $args;
}
add_filter( 'wp_page_menu_args', 'base_page_menu_args' );


/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override base_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Base 1.0
 * @uses register_sidebar
 */
function base_widgets_init() {
  // Area 1
  register_sidebar( array (
    'name' => 'Primary Widget Area',
    'id' => 'primary-widget-area',
    'description' => __( 'The primary widget area' , 'base' ),
    'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  // Area 2
  register_sidebar( array (
    'name' => 'Secondary Widget Area',
    'id' => 'secondary-widget-area',
    'description' => __( 'The secondary widget area' , 'base' ),
    'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  // Area 3
  register_sidebar( array (
    'name' => 'Footer Widget Area',
    'id' => 'footer-widget-area',
    'description' => __( 'The footer widget area' , 'base' ),
    'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
}
add_action( 'init', 'base_widgets_init' );


function base_page_title() {
  wp_title();
}


function base_cleanup_wp() {
  // remove 'capital_P_dangit'
  foreach ( array( 'the_content', 'the_title', 'comment_text' ) as $filter ) {
    remove_filter( $filter, 'capital_P_dangit', 11 );
  }

  // remove the default styles that are packaged with the Recent Comments widget.
  global $wp_widget_factory;
  remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action('wp', 'base_cleanup_wp', 99);


function base_comment_start( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  $GLOBALS['comment_args'] = $args;
  $GLOBALS['comment_depth'] = $depth;

  get_template_module('comment');
}

function base_comment_end( $comment, $args, $depth ) {
?>
  </article>
<?php
}

function base_foo( $args ) {
  wn_die( $args );
}
//add_filter('wp_nav_menu_args', 'base_foo', 99);

/**
 * Remove wrapping <div> from around page menu.
 */
function base_page_menu( $menu, $args ) {
  $menu = preg_replace('|<div[^>]+>(.+)</div>|', '\\1', $menu);
  return $menu;
}
add_filter('wp_page_menu', 'base_page_menu', 10, 2);
