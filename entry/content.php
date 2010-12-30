  <?php if ( is_archive() || is_search() ) : //Only display Excerpts for archives & search ?>
      <div class="entry-summary">
        <?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pdx' ) ); ?>
      </div><!-- .entry-summary -->
  <?php else : ?>
      <div class="entry-content">
        <?php the_content( __( 'Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'pdx' ) ); ?>
        <?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'pdx' ) . '&after=</div>'); ?>
      </div><!-- .entry-content -->
  <?php endif; ?>
