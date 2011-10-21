<?php
  global $pdx_nav_id;
  $pdx_nav_id = 'above';
  get_template_module('nav');
?>

<?php get_template_module('loop'); ?>

<?php
  $pdx_nav_id = 'below';
  get_template_module('nav');
?>
