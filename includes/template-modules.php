<?php
/*
 Plugin Name: Template Modules
 Plugin URI: http://github.com/willnorris/template-modules
 Description: A plugin based implementation of Daryl Koopersmith's <a href="http://core.trac.wordpress.org/ticket/12877">Template Module</a> concept.
 Author: Will Norris
 Author URI: http://willnorris.com/
 Version: 1.0-trunk
 License: Apache License, Version 2.0 (http://www.apache.org/licenses/LICENSE-2.0.html)
 */


if ( !function_exists('get_template_module') ):
/**
 * Load a template from a folder based upon the best match from the template hierarchy.
 *
 * Makes it easy for a theme to reuse sections of code in a easy to overload way
 * for child themes.
 *
 * Includes a template from a folder within a theme based upon the most specific
 * match from the template hierarchy. If the folder contains no matching files
 * then no template will be included.
 *
 * @uses get_template_hierarchy() To build template file names.
 * @uses locate_template() To search for template files.
 *
 * @param string $module The name of the module to be included.
 * @param boolean $parent_only Only load modules from the parent template
 * @return string The file path to the loaded file. The empty string if no file was found.
 */
function get_template_module( $module, $parent_only=false ) {
  $template_hierarchy = get_template_hierarchy();
  $template_names = array();
  foreach( $template_hierarchy as $template_name ) {
    $template_names[] = $module . '/' . $template_name;
  }
  // fall backs
  $template_names[] = $module . '/index.php';
  $template_names[] = $module . '.php';

  $located = null;

  if ( $parent_only ) {
    $located = locate_parent_template($template_names, true, false);
  } else {
    $located = locate_template($template_names, true, false);
  }

  return $located;
}
endif;


if ( !function_exists('get_template_hierarchy') ):
/**
 * Returns the template hierarchy for the current page.
 *
 * @return array
 */
function get_template_hierarchy() {
  global $wp_template_hierarchy;

  if ( !isset($wp_template_hierarchy) ) {
    update_template_hierarchy();
  }

  return $wp_template_hierarchy;
}
endif;

if ( !function_exists('update_template_hierarchy') ):
/**
 * Creates a global variable that contains the template hierarchy for the current page.
 *
 * Calling update_template_hierarchy() will recalculate the template hierarchy for $wp_query.
 */
function update_template_hierarchy() {
  global $wp_template_hierarchy;

  if ( defined('WP_USE_THEMES') && WP_USE_THEMES ) :
    $templates = array();

    if ( is_404() ) {
      // see get_404_template()
      $templates[] = '404.php';
    }

    if ( is_search() ) {
      // see get_search_template()
      $templates[] = 'search.php';
    }

    if ( is_tax() ) {
      // see get_taxonomy_template()
      $term = get_queried_object();
      $taxonomy = $term->taxonomy;

      $templates[] = "taxonomy-$taxonomy-{$term->slug}.php";
      $templates[] = "taxonomy-$taxonomy.php";
      $templates[] = "taxonomy.php";
    }

    if ( is_front_page() ) {
      // see get_front_page_template()
      $templates[] = 'front-page.php';
    }

    if ( is_home() ) {
      // see get_home_template()
      $templates[] = 'home.php';
      $templates[] = 'index.php';
    }

    if ( is_attachment() ) {
      // see get_attachment_template()
      global $posts;
      $type = explode('/', $posts[0]->post_mime_type);
      $templates[] = "{$type[0]}.php";
      $templates[] = "{$type[1]}.php";
      $templates[] = "{$type[0]}_{$type[1]}.php";
      $templates[] = 'attachment.php';
    }

    if ( is_single() ) {
      // see get_single_template()
      $object = get_queried_object();
      $templates[] = "single-{$object->post_type}.php";
      $templates[] = 'single.php';
    }

    if ( is_page() ) {
      // see get_page_template()
      $id = get_queried_object_id();
      $template = get_post_meta($id, '_wp_page_template', true);
      $pagename = get_query_var('pagename');

      if ( !$pagename && $id > 0 ) {
        // If a static page is set as the front page, $pagename will not be set. Retrieve it from the queried object
        $post = get_queried_object();
        $pagename = $post->post_name;
      }

      if ( 'default' == $template )
        $template = '';

      if ( !empty($template) && !validate_file($template) )
        $templates[] = $template;
      if ( $pagename )
        $templates[] = "page-$pagename.php";
      if ( $id )
        $templates[] = "page-$id.php";
      $templates[] = "page.php";
    }

    if ( is_category() ) {
      // see get_category_template()
      $category = get_queried_object();

      $templates[] = "category-{$category->slug}.php";
      $templates[] = "category-{$category->term_id}.php";
      $templates[] = "category.php";
    }

    if ( is_tag() ) {
      // see get_tag_template()
      $tag = get_queried_object();

      $templates[] = "tag-{$tag->slug}.php";
      $templates[] = "tag-{$tag->term_id}.php";
      $templates[] = "tag.php";
    }

    if ( is_author() ) {
      // see get_author_template()
      $author = get_queried_object();

      $templates[] = "author-{$author->user_nicename}.php";
      $templates[] = "author-{$author->ID}.php";
      $templates[] = 'author.php';
    }

    if ( is_date() ) {
      // see get_date_template()
      $templates[] = 'date.php';
    }

    if ( is_archive() ) {
      // see get_archive_template()
      $post_type = get_query_var( 'post_type' );

      if ( $post_type )
        $templates[] = "archive-{$post_type}.php";
      $templates[] = 'archive.php';
    }

    if ( is_comments_popup() ) {
      // see get_comments_popup_template()
      $templates[] = 'comments-popup.php';
    }

    if ( is_paged() ) {
      // see get_paged_template()
      $templates[] = 'paged.php';
    }

    $wp_template_hierarchy = $templates;
  endif;
}
endif;


if ( !function_exists('locate_parent_template') ):
/**
 * Retrieve the name of the highest priority template file that exists.  This function is identical to locate_template,
 * except that it searches only in TEMPLATEPATH, so that only files in the parent theme will be found.
 *
 * @param string|array $template_names Template file(s) to search for, in order.
 * @param bool $load If true the template file will be loaded if it is found.
 * @param bool $require_once Whether to require_once or require. Default true. Has no effect if $load is false.
 * @return string The template filename if one is located.
 */
function locate_parent_template($template_names, $load = false, $require_once = true ) {
  $located = '';
  foreach ( (array) $template_names as $template_name ) {
    if ( !$template_name )
      continue;
    if ( file_exists(TEMPLATEPATH . '/' . $template_name) ) {
      $located = TEMPLATEPATH . '/' . $template_name;
      break;
    }
  }

  if ( $load && '' != $located )
    load_template( $located, $require_once );

  return $located;
}
endif;
