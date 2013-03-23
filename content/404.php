<h1><?php _e('Oops! That page can’t be found.', 'pdx'); ?></h1>

<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'pdx' ); ?></p>

<?php get_search_form(); ?>

<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

<div class="widget">
  <h2 class="widgettitle"><?php _e( 'Most Used Categories', 'pdx' ); ?></h2>
  <ul>
  <?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
  </ul>
</div><!-- .widget -->

<?php
$archive_content = '<p>' . __( 'Try looking in the monthly archives.', 'pdx' ) . '</p>';
the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
?>

<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
