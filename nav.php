<?php 
  global $pdx_nav_id;
  if ( $wp_query->max_num_pages > 1 ) : 
?>
  <nav id="nav-<?php echo $pdx_nav_id ?>" class="navigation">
    <div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&larr;</span> Older posts', 'pdx' )); ?></div>
    <div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&rarr;</span>', 'pdx' )); ?></div>
  </nav>
<?php endif; ?>
