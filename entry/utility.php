      <footer class="entry-utility">
        <span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php //echo twentyten_cat_list(); ?></span></span>
        <span class="meta-sep"> | </span>
        <?php //$tags_text = twentyten_tag_list(); ?>
        <?php if ( !empty($tags_text) ) : ?>
        <span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links"><?php echo $tags_text; ?></span></span>
        <span class="meta-sep"> | </span>
        <?php endif; //$tags_text ?>
        <?php if ( comments_open() ) : ?>
        <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'pdx' ), __( '1 Comment', 'pdx' ), __( '% Comments', 'pdx' ) ); ?></span>
        <?php endif; ?>
      </footer><!-- #entry-utility -->
