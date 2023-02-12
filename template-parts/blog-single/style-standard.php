<?php
/**
 * Template part for displaying single post for standard style.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Billey
 * @since   1.0
 */
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-wrapper' ); ?>>

		<h2 class="screen-reader-text"><?php echo esc_html( get_the_title() ); ?></h2>

		<div class="entry-header">
			<?php if ( '1' === Billey::setting( 'single_post_title_enable' ) ) : ?>
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php endif; ?>

			<?php get_template_part( 'template-parts/blog-single/meta' ); ?>

			<?php Billey_Post::instance()->entry_feature(); ?>
		</div>

		<div class="entry-content">
			<?php
			the_content( sprintf( /* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'billey' ), array( 'span' => array( 'class' => array() ) ) ), the_title( '<span class="screen-reader-text">"', '"</span>', false ) ) );

			Billey_Templates::page_links();
			?>
		</div>


		<?php
		$content_footer_classes = 'col-md-6';
		$has_tag                = false;
		$has_share              = false;

		if ( '1' === Billey::setting( 'single_post_tags_enable' ) && has_tag() ) {
			$has_tag = true;
		}

		if ( '1' === Billey::setting( 'single_post_share_enable' ) && class_exists( 'InsightCore' ) ) {
			$has_share = true;
		}

		if ( ! $has_tag || ! $has_share ) {
			$content_footer_classes = 'col-md-12';
		}
		?>
		<div class="entry-footer">
			<div class="row row-xs-center">
				<?php if ( $has_tag ) : ?>
					<div class="<?php echo esc_attr( $content_footer_classes ); ?>">
						<div class="entry-post-tags">
							<h6 class="tag-label"><?php esc_html_e( 'Tags:', 'billey' ); ?></h6>
							<div class="tagcloud">
								<?php the_tags( '', ', ', '' ); ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<?php if ( $has_share ) : ?>
					<div class="<?php echo esc_attr( $content_footer_classes ); ?>">
						<?php Billey_Post::instance()->entry_share(); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

	</article>
<?php
$author_desc = get_the_author_meta( 'description' );
if ( '1' === Billey::setting( 'single_post_author_box_enable' ) && ! empty( $author_desc ) ) {
	Billey_Templates::post_author();
}

if ( '1' === Billey::setting( 'single_post_pagination_enable' ) ) {
	Billey_Post::instance()->nav_page_links();
}

if ( Billey::setting( 'single_post_related_enable' ) ) {
	get_template_part( 'template-parts/blog-single/content-related-posts' );
}

// If comments are open or we have at least one comment, load up the comment template.
if ( '1' === Billey::setting( 'single_post_comment_enable' ) && ( comments_open() || get_comments_number() ) ) :
	comments_template();
endif;
