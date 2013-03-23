<?php global $comment_args, $comment_depth; ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>" class="comment">
      <footer>
        <?php  get_template_module( 'comment/author' ); ?>

        <?php if ( $comment->comment_approved == '0' ) : ?>
          <em><?php _e( 'Your comment is awaiting moderation.', 'pdx' ); ?></em>
          <br />
        <?php endif; ?>

        <?php get_template_module( 'comment/meta' ); ?>
      </footer>

      <div class="comment-content"><?php comment_text(); ?></div>

      <div class="reply">
        <?php comment_reply_link( array_merge( $comment_args, array( 'depth' => $comment_depth, 'max_depth' => $comment_args['max_depth'] ) ) ); ?>
      </div>
    </article>
