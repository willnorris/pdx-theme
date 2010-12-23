<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php get_header(); ?>
<body <?php body_class(); ?>>
  <div id="wrapper">
    <nav class="skip-links">
      <ul>
        <li><a href="#nav"><?php _e('Skip to primary navigation'); ?></a></li>
        <li><a href="#content"><?php _e('Skip to main content'); ?></a></li>
        <li><a href="#sidebar"><?php _e('Skip to sidebar'); ?></a></li>
      </ul>
    </nav>

    <header id="header" role="banner">
      <?php get_template_module('header'); ?>
    </header>

    <nav id="nav" role="navigation">
      <?php wp_nav_menu( array( 'container' => '', 'theme_location' => 'primary' ) ); ?>
    </nav>

    <div id="main" role="main">
      <div id="container">
        <div id="content">
          <?php get_template_module('content'); ?>
        </div><!-- #content -->
      </div><!-- #container -->
      <?php get_sidebar(); ?>
    </div>

    <footer id="footer">
      <?php get_template_module('footer'); ?>
    </footer>

  <?php wp_footer(); ?>
  </div>
</body>
</html>
