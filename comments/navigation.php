  <?php if ( get_comment_pages_count() > 1 ) : ?>
      <nav class="navigation">
        <div class="nav-previous"><?php previous_comments_link( __('&larr; Older Comments', 'pdx') ); ?></div>
        <div class="nav-next"><?php next_comments_link( __('Newer Comments &rarr;', 'pdx') ); ?></div>
      </nav>
  <?php endif; ?>
