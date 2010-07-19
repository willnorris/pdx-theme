<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <title><?php base_page_title(); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
  <link rel="stylesheet" type="text/css" media="print" href="<?php bloginfo('stylesheet_directory'); ?>/print.css" />
  <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <?php wp_head(); ?>
</head>
