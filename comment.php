  <article <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
<?php
  switch ( $comment->comment_type ) {
    case '':
      get_template_module( 'comment/comment' );
      break;
    case 'pingback':
    case 'trackback':
      get_template_module( 'comment/pingback' );
      break;
  }

  // closing </article> tag is handled by call to wp_list_comments()
?>
