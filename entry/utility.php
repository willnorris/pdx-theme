      <footer class="entry-meta">
        <?php
          $tag_list = get_the_tag_list( '', ', ' );
          if ( $tag_list ) {
            $posted_in = __( 'This entry was posted in %1$s and tagged %2$s.' );
          } else {
            $posted_in = __( 'This entry was posted in %1$s.' );
          }
          printf( $posted_in . ' ', get_the_category_list( ', ' ), $tag_list );
          printf( __( 'Bookmark the <a href="%1$s" title="Permalink to %2$s" rel="bookmark">permalink</a>.' ), get_permalink(), the_title_attribute( 'echo=0' ) );;
        ?>
      </footer><!-- #entry-utility -->
