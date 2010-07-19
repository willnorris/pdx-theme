<?php if ( $wp_query->max_num_pages > 1 ) : ?>
  <nav id="nav-above" class="navigation">
		<div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&larr;</span> Older posts', 'base' )); ?></div>
		<div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&rarr;</span>', 'base' )); ?></div>
	</nav>
<?php endif; ?>

<?php get_template_module('loop'); ?>

<?php if ( $wp_query->max_num_pages > 1 ) : ?>
  <nav id="nav-below" class="navigation">
		<div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&larr;</span> Older posts', 'base' )); ?></div>
		<div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&rarr;</span>', 'base' )); ?></div>
	</nav>
<?php endif; ?>
