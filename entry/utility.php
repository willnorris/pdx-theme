			<footer class="entry-utility">
				<span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php //echo twentyten_cat_list(); ?></span></span>
				<span class="meta-sep"> | </span>
				<?php //$tags_text = twentyten_tag_list(); ?>
				<?php if ( !empty($tags_text) ) : ?>
				<span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links"><?php echo $tags_text; ?></span></span>
				<span class="meta-sep"> | </span>
				<?php endif; //$tags_text ?>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyten' ), __( '1 Comment', 'twentyten' ), __( '% Comments', 'twentyten' ) ); ?></span>
        <?php edit_post_link( __( 'Edit', 'twentyten' ), "<span class=\"meta-sep\">|</span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t\n" ); ?>
			</footer><!-- #entry-utility -->
