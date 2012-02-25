<h2><?php the_title(); ?></h2>

<?php
$args = array('showposts' => -1);
$args = apply_filters('pdx_archives_query_args', $args);
$_year = 0;
$allPosts = new WP_Query();
$allPosts->query($args);

while ($allPosts->have_posts()):
  $allPosts->the_post();

  // allow posts to be excluded from the archive list beyond what is
  // possible with arguments to WP_Query.  For example, based on post_format
  $include = apply_filters('pdx_archives_include_post', true, $post);
  if (!$include) continue;

  $year = mysql2date('Y', $post->post_date);

  if ($_year != $year):
    if ($_year > 0):
?>
  </ul>
<?php endif; ?>
  <h3><?php the_date('Y'); $_year = $year;?></h3>
  <ul>
<?php endif; ?>
    <li>
      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      <time datetime="<?php esc_attr_e( get_the_date('c') ); ?>"><?php echo get_the_date(); ?></time>
    </li>
<?php endwhile; ?>
  </ul>
<?php
  // return things back to normal
  wp_reset_postdata();
?>
