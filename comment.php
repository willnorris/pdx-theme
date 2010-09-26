<?php
  global $comment_args, $comment_depth;
?>
  <article <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
<?php

  switch ( $comment->comment_type ) :
    case '' :
  ?>
    <div class="author comment-author vcard">
      <?php echo get_avatar( $comment, 40 ); ?>
      <?php printf( __( '%s <span class="says">says:</span>', 'pdx' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
    </div><!-- .comment-author .vcard -->
    <?php if ( $comment->comment_approved == '0' ) : ?>
      <em><?php _e( 'Your comment is awaiting moderation.', 'pdx' ); ?></em>
      <br />
    <?php endif; ?>

    <div class="comment-meta"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php
        /* translators: 1: date, 2: time */
        printf( __( '%1$s at %2$s', 'pdx' ), get_comment_date(),  get_comment_time() ); ?></a>
        <?php edit_comment_link( __( '(Edit)', 'pdx' ), ' ' ); ?>
    </div><!-- .comment-meta .commentmetadata -->

    <div class="comment-body"><?php comment_text(); ?></div>

    <div class="reply">
      <?php comment_reply_link( array_merge( $comment_args, array( 'depth' => $comment_depth, 'max_depth' => $comment_args['max_depth'] ) ) ); ?>
    </div><!-- .reply -->

  <?php
      break;
    case 'pingback'  :
    case 'trackback' :
  ?>
    <p><?php _e( 'Pingback:', 'pdx' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'pdx'), ' ' ); ?></p>
  <?php
      break;
  endswitch;
?>
