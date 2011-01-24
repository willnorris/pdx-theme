<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title><?php pdx_title(); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <?php
    if ( is_singular() && comments_open() && get_option('thread_comments') ) {
      wp_enqueue_script( 'comment-reply' );
    }
  ?>
<?php wp_head(); ?>
</head>
