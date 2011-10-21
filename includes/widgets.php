<?php

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override pdx_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since pdx 1.0
 * @uses register_sidebar
 */
function pdx_widgets_init() {
  // Area 1
  register_sidebar( array (
    'name' => __('Primary Sidebar', 'pdx'),
    'id' => 'pdx-sidebar-1',
    'description' => __( 'The main sidebar' , 'pdx' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  // Area 2
  register_sidebar( array (
    'name' => __('Secondary Sidebar', 'pdx'),
    'id' => 'pdx-sidebar-2',
    'description' => __( 'The optional secondary sidebar' , 'pdx' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  // Area 3
  register_sidebar( array (
    'name' => __('Footer Widget Area', 'pdx'),
    'id' => 'pdx-footer-1',
    'description' => __( 'Optional footer area for widgets' , 'pdx' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
}
add_action( 'widgets_init', 'pdx_widgets_init' );
