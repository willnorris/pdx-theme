<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title><?php pdx_page_title(); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <?php wp_head(); ?>
</head>
