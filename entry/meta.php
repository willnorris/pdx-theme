        <div class="entry-meta">
          <?php
            printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'pdx' ),
              'meta-prep meta-prep-author',
              sprintf( '<time datetime="%1$s" class="entry-date">%2$s</time>',
                esc_attr( get_the_time('c') ),
                get_the_date()
              ),
              sprintf( '<span class="author entry-author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
                get_author_posts_url( get_the_author_meta( 'ID' ) ),
                sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
                get_the_author()
              )
            );
          ?>
        </div><!-- .entry-meta -->
