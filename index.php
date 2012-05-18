<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php get_header(); ?>
<body <?php body_class(); ?>>
  <div id="wrapper">
    <nav class="skip-links assistive-text">
      <ul>
        <li><a href="#nav"><?php _e('Skip to primary navigation'); ?></a></li>
        <li><a href="#content"><?php _e('Skip to main content'); ?></a></li>
      </ul>
    </nav>

    <header id="header" role="banner">
      <?php get_template_module('header'); ?>

      <nav id="nav" class="main-nav" role="navigation">
        <h1 class="assistive-text"><?php _e('Menu', 'pdx'); ?></h1>
        <?php wp_nav_menu( array( 'container' => '', 'theme_location' => 'primary' ) ); ?>
      </nav>
    </header>

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
