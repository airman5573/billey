<div class="post-caption">

	<?php if ( 'yes' === $settings['show_caption_category'] ) : ?>
		<?php Billey_Post::instance()->the_categories(); ?>
	<?php endif; ?>

	<h3 class="post-title">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h3>

	<?php if ( ! empty( $settings['meta_data'] ) ) : ?>
		<div class="post-meta">
			<?php foreach ( $settings['meta_data'] as $data ) : ?>

				<?php if ( 'date' === $data['meta'] ) : ?>
					<div class="post-date"><?php echo get_the_date(); ?></div>
				<?php elseif ( 'author' === $data['meta'] ): ?>
					<div class="post-author">
						<?php esc_html_e( 'by', 'billey' ); ?>
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
							<?php the_author(); ?>
						</a>
					</div>
				<?php elseif ( 'comments' === $data['meta'] ): ?>
					<div class="post-comments">
						<?php
						$comment_count = get_comments_number();
						$comment_count .= $comment_count > 1 ? esc_html__( ' Comments', 'billey' ) : esc_html__( ' Comment', 'billey' );
						?>
						<?php echo esc_html( $comment_count ); ?>
					</div>
				<?php endif; ?>

			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<?php if ( 'yes' === $settings['show_caption_excerpt'] ) : ?>
		<?php
		if ( empty( $settings['excerpt_length'] ) ) {
			$settings['excerpt_length'] = 10;
		}
		?>
		<div class="post-excerpt">
			<?php Billey_Templates::excerpt( array(
				'limit' => $settings['excerpt_length'],
				'type'  => 'word',
			) ); ?>
		</div>
	<?php endif; ?>

	<?php if ( 'yes' === $settings['show_caption_read_more'] ): ?>
		<div class="post-read-more">
			<a href="<?php the_permalink(); ?>" class="tm-button style-flat tm-button-nm">
				<span class="button-text">
					<?php echo esc_html( $settings['read_more_text'] ); ?>
				</span>
			</a>
		</div>
	<?php endif; ?>

</div>
