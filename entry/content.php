      <div class="entry-content">
        <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pdx' ) ); ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'pdx' ), 'after' => '</div>' ) ); ?>
      </div><!-- .entry-content -->
