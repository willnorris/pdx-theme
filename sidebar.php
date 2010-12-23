<?php if ( is_active_sidebar('primary-widget-area') ) : ?>
    <aside class="sidebar primary" role="complementary">
      <?php dynamic_sidebar('primary-widget-area'); ?>
    </aside>
<?php endif; ?>

<?php if ( is_active_sidebar('secondary-widget-area') ) : ?>
    <aside class="sidebar secondary" role="complementary">
      <?php dynamic_sidebar('secondary-widget-area'); ?>
    </aside>
<?php endif; ?>
