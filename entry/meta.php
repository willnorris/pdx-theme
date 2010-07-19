        <div class="entry-meta">
            <?php
            printf(__( '<span class="meta-prep meta-prep-author">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a> <span class="meta-sep"> by </span> <span class="author vcard"><a class="url fn n" href="%4$s" title="%5$s">%6$s</a></span>', 'twentyten'),
              get_permalink(),
              esc_attr( get_the_time() ),
              get_the_date(),
              get_author_posts_url( get_the_author_meta('ID') ),
              sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
              get_the_author()
            );
            ?>
        </div><!-- .entry-meta -->
