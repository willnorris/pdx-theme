    <div class="comment-meta"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php
        printf( '<time datetime="%1$s" class="entry-date">%2$s</time>',
          esc_attr( get_comment_time('c') ),
          /* translators: 1: date, 2: time */
          sprintf( __( '%1$s at %2$s', 'pdx' ), get_comment_date(),  get_comment_time() )
        );
    ?></a>
        <?php edit_comment_link( __( '(Edit)', 'pdx' ), ' ' ); ?>
    </div><!-- .comment-meta -->

