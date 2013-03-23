<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php get_header(); ?>
<body <?php body_class(); ?>>
  <div id="page" class="hfeed site">
    <?php do_action( 'before' ); ?>

    <header id="masthead" class="site-header" role="banner">
<?php get_template_module('header/title'); ?>
<?php get_template_module('header/nav'); ?>
    </header>

    <div id="main" class="site-main">
      <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">
<?php get_template_module('content'); ?>
        </div><!-- #content -->
      </div><!-- #primary -->
      <?php get_sidebar(); ?>
    </div>

    <footer id="footer" class="site-footer" role="contentinfo">
      <?php get_template_module('footer'); ?>
    </footer>
  </div>

<?php wp_footer(); ?>
</body>
</html>
