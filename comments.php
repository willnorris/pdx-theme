    <aside id="comments">
<?php if ( post_password_required() ): ?>
      <div class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'pdx' ); ?></div>
<?php else: ?>
  <?php if ( have_comments() ) : ?>
        <h3 id="comments-title"><?php pdx_comments_title(); ?></h3>
        <?php if ( get_comment_pages_count() > 1 ) : ?>
            <nav id="comment-nav-above" class="navigation">
              <div class="nav-previous"><?php previous_comments_link( __('&larr; Older Comments', 'pdx') ); ?></div>
              <div class="nav-next"><?php next_comments_link( __('Newer Comments &rarr;', 'pdx') ); ?></div>
            </nav>
        <?php endif; ?>

        <?php pdx_list_comments(); ?>

        <?php if ( get_comment_pages_count() > 1 ) : ?>
            <nav id="comment-nav-above" class="navigation">
              <div class="nav-previous"><?php previous_comments_link( __('&larr; Older Comments', 'pdx') ); ?></div>
              <div class="nav-next"><?php next_comments_link( __('Newer Comments &rarr;', 'pdx') ); ?></div>
            </nav>
        <?php endif; ?>
  <?php else : // no comments so far ?>
    <?php if ( comments_open() ) : // comments are open, but there are no comments ?>
    <?php else : // comments are closed ?>
      <?php pdx_comments_closed(); ?>
    <?php endif; ?>
  <?php endif; ?>

  <?php comment_form(); ?>
<?php endif; ?>
    </aside><!-- #comments -->
