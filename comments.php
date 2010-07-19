<?php if ( post_password_required() ): ?>
      <aside id="comments">
        <div class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'base' ); ?></div>
      </aside>
<?php
  return;
endif;
?>

    <aside id="comments">
<?php if ( have_comments() ) : ?>
      <h3 id="comments-title"><?php comments_number( 
        sprintf(__('No Responses to %s', 'base'), '<em>' . get_the_title() . '</em>'),
        sprintf(__('One Response to %s', 'base'), '<em>' . get_the_title() . '</em>'),
        sprintf(__('%% Responses to %s', 'base'), '<em>' . get_the_title() . '</em>')
      ); ?> </h3>

  <?php if ( get_comment_pages_count() > 1 ) : // are there comments to navigate through ?>
      <div class="navigation">
        <div class="nav-previous"><?php previous_comments_link( __('&larr; Older Comments', 'base') ); ?></div>
        <div class="nav-next"><?php next_comments_link( __('Newer Comments &rarr;', 'base') ); ?></div>
      </div>
  <?php endif; ?>

      <div class="commentlist">
        <?php //wp_list_comments( array('callback' => 'base_comment_start', 'end-callback' => 'base_comment_end') ); ?>
        <?php wp_list_comments( array('style' => 'div', 'callback' => 'base_comment_start', 'end-callback' => 'base_comment_end') ); ?>
      </div>

  <?php if ( get_comment_pages_count() > 1 ) : // are there comments to navigate through ?>
      <div class="navigation">
        <div class="nav-previous"><?php previous_comments_link( __('&larr; Older Comments', 'base') ); ?></div>
        <div class="nav-next"><?php next_comments_link( __('Newer Comments &rarr;', 'base') ); ?></div>
      </div>
  <?php endif; ?>

<?php else : // this is displayed if there are no comments so far ?>

  <?php if ( comments_open() ) : // If comments are open, but there are no comments ?>

  <?php else : // if comments are closed ?>

    <p class="nocomments"><?php _e('Comments are closed.', 'base'); ?></p>

  <?php endif; ?>
<?php endif; ?>

<?php comment_form(); ?>

    </aside><!-- #comments -->
