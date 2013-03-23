<?php if ( !post_password_required() ): ?>
    <aside id="comments" class="comments-area">
  <?php if ( have_comments() ) : ?>
        <h3 id="comments-title"><?php pdx_comments_title(); ?></h3>
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <nav id="comment-nav-above" class="navigation-comment" role="navigation">
              <div class="previous"><?php previous_comments_link( __('&larr; Older Comments', 'pdx') ); ?></div>
              <div class="next"><?php next_comments_link( __('Newer Comments &rarr;', 'pdx') ); ?></div>
            </nav>
        <?php endif; ?>

        <ol class="comment-list">
<?php wp_list_comments( array( 'callback' => 'pdx_comment')); ?>
        </ol>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <nav id="comment-nav-above" class="navigation-comment" role="navigation">
              <div class="previous"><?php previous_comments_link( __('&larr; Older Comments', 'pdx') ); ?></div>
              <div class="next"><?php next_comments_link( __('Newer Comments &rarr;', 'pdx') ); ?></div>
            </nav>
        <?php endif; ?>
  <?php else : // no comments so far ?>
    <?php if ( comments_open() ) : // comments are open, but there are no comments ?>
    <?php else : // comments are closed ?>
      <?php pdx_comments_closed(); ?>
    <?php endif; ?>
  <?php endif; ?>

  <?php comment_form(); ?>
    </aside><!-- #comments -->
<?php endif; ?>
