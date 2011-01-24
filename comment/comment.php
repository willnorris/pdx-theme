    <?php global $comment_args, $comment_depth; ?>
    <?php  get_template_module( 'comment/author' ); ?>

    <?php if ( $comment->comment_approved == '0' ) : ?>
      <em><?php _e( 'Your comment is awaiting moderation.', 'pdx' ); ?></em>
      <br />
    <?php endif; ?>

    <?php get_template_module( 'comment/meta' ); ?>

    <div class="comment-body"><?php comment_text(); ?></div>

    <div class="reply">
      <?php comment_reply_link( array_merge( $comment_args, array( 'depth' => $comment_depth, 'max_depth' => $comment_args['max_depth'] ) ) ); ?>
    </div><!-- .reply -->
