<?php
/**
 * Template part for displaying single post for modern style.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Billey
 * @since   1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-wrapper' ); ?>>

	<h2 class="screen-reader-text"><?php echo esc_html( get_the_title() ); ?></h2>

	<?php Billey_Post::instance()->entry_feature(); ?>

	<div class="entry-content-wrap row">
		<div class="col-md-2">
			<?php
			$button_return_text = Billey::setting( 'single_post_button_return_text' );
			$button_return_link = Billey::setting( 'single_post_button_return_link' );
			?>
			<?php if ( ! empty( $button_return_text ) && ! empty( $button_return_link ) ): ?>
				<a href="<?php echo esc_url( $button_return_link ); ?>" class="post-return-archive">
					<?php echo esc_html( $button_return_text ); ?>
				</a>
			<?php endif; ?>
		</div>

		<div class="col-md-8">
			<div class="entry-content">
				<?php
				the_content( sprintf( /* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'billey' ), array( 'span' => array( 'class' => array() ) ) ), the_title( '<span class="screen-reader-text">"', '"</span>', false ) ) );

				Billey_Templates::page_links();
				?>
			</div>

			<div class="entry-footer">
				<div class="row row-xs-center">
					<div class="col-md-12">
						<?php if ( '1' === Billey::setting( 'single_post_tags_enable' ) && has_tag() ) : ?>
							<div class="entry-post-tags">
								<h6 class="tag-label"><?php esc_html_e( 'Tags:', 'billey' ); ?></h6>
								<div class="tagcloud">
									<?php the_tags( '', ', ', '' ); ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-2">
			<?php if ( '1' === Billey::setting( 'single_post_share_enable' ) && class_exists( 'InsightCore' ) ) : ?>
				<?php Billey_Post::instance()->entry_share(); ?>
			<?php endif; ?>
		</div>
	</div>

</article>
