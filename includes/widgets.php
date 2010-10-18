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
    'name' => 'Primary Widget Area',
    'id' => 'primary-widget-area',
    'description' => __( 'The primary widget area' , 'pdx' ),
    'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  // Area 2
  register_sidebar( array (
    'name' => 'Secondary Widget Area',
    'id' => 'secondary-widget-area',
    'description' => __( 'The secondary widget area' , 'pdx' ),
    'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  // Area 3
  register_sidebar( array (
    'name' => 'Footer Widget Area',
    'id' => 'footer-widget-area',
    'description' => __( 'The footer widget area' , 'pdx' ),
    'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
}
add_action( 'init', 'pdx_widgets_init' );
