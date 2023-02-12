<div class="entry-post-meta">
	<?php if ( Billey::setting( 'single_post_author_enable' ) === '1' ) : ?>
		<div class="entry-author-meta">
			<?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?>

			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
				<?php the_author(); ?>
			</a>
		</div>
	<?php endif; ?>

	<?php if ( Billey::setting( 'single_post_categories_enable' ) === '1' && has_category() ) : ?>
		<div class="entry-post-categories">
			<?php the_category( ', ' ); ?>
		</div>
	<?php endif; ?>

	<?php if ( Billey::setting( 'single_post_date_enable' ) === '1' ) : ?>
		<div class="post-date"><?php echo get_the_date(); ?></div>
	<?php endif; ?>

	<?php if ( Billey::setting( 'single_post_comment_count_enable' ) === '1' ) : ?>
		<div class="post-comments-number">
			<?php
			$comment_count = get_comments_number();
			$comment_count .= $comment_count > 1 ? esc_html__( ' Comments', 'billey' ) : esc_html__( ' Comment', 'billey' );
			?>
			<a href="#comments" class="smooth-scroll-link"><span
					class="fal fa-comment-alt meta-icon"></span><?php echo esc_html( $comment_count ); ?></a>
		</div>
	<?php endif; ?>
</div>
