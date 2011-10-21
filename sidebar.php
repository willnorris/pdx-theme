<?php if ( is_active_sidebar('pdx-sidebar-1') ) : ?>
    <div class="sidebar primary" role="complementary">
      <?php dynamic_sidebar('pdx-sidebar-1'); ?>
    </div>
<?php endif; ?>

<?php if ( is_active_sidebar('pdx-sidebar-2') ) : ?>
    <div class="sidebar secondary" role="complementary">
      <?php dynamic_sidebar('pdx-sidebar-2'); ?>
    </div>
<?php endif; ?>
