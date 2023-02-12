<?php
/**
 * Template part for displaying blog content in home.php, archive.php.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Billey
 * @since   1.0
 */
$style   = Billey::setting( 'blog_archive_style', 'grid' );
$classes = [
	'billey-main-post',
	'billey-grid-wrapper',
	'billey-blog',
	'billey-animation-zoom-in',
	'billey-blog-caption-style-02',
	'billey-blog-overlay-style-float',
	"billey-blog-" . $style,
];

if ( in_array( $style, array( 'grid' ) ) ) {
	$lg_columns = Billey::setting( 'blog_archive_lg_columns' );
	$md_columns = Billey::setting( 'blog_archive_md_columns' );
	$sm_columns = Billey::setting( 'blog_archive_sm_columns' );

	$grid_options = [
		'type'          => 'masonry',
		'columns'       => $lg_columns,
		'columnsTablet' => $md_columns,
		'columnsMobile' => $sm_columns,
		'gutter'        => 70,
		'gutterTablet'  => 30,
	];
}

if ( have_posts() ) : ?>
	<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"
	     data-grid="<?php echo esc_attr( wp_json_encode( $grid_options ) ); ?>"
	>
		<div class="billey-grid">
			<div class="grid-sizer"></div>

			<?php while ( have_posts() ) : the_post();
				$classes = array( 'grid-item', 'post-item' );
				?>
				<div <?php post_class( implode( ' ', $classes ) ); ?>>
					<div class="post-wrapper billey-box">

						<?php if ( has_post_thumbnail() ) { ?>
							<div class="post-feature post-thumbnail billey-image">
								<a href="<?php the_permalink(); ?>">
									<?php Billey_Image::the_post_thumbnail( array( 'size' => '480x320' ) ); ?>
								</a>

								<?php Billey_Post::instance()->the_category( array(
									'classes' => 'post-overlay-categories',
								) ); ?>

							</div>
						<?php } ?>

						<div class="post-caption">
							<h3 class="post-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>

							<div class="post-meta">
								<div class="post-date"><?php echo get_the_date(); ?></div>

								<div class="post-author">
									<?php esc_html_e( 'by', 'billey' ); ?>
									<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
										<?php the_author(); ?>
									</a>
								</div>
							</div>

							<div class="post-excerpt">
								<?php Billey_Templates::excerpt( array(
									'limit' => 18,
									'type'  => 'word',
								) ); ?>
							</div>

							<div class="post-read-more">
								<a href="<?php the_permalink(); ?>" class="tm-button style-text tm-button-nm">
									<span class="button-text">
										<?php esc_html_e( 'Read More', 'billey' ); ?>
									</span>
								</a>
							</div>
						</div>

					</div>
				</div>
			<?php endwhile; ?>


		</div>

		<div class="billey-grid-pagination">
			<?php Billey_Templates::paging_nav(); ?>
		</div>
	</div>

<?php else : get_template_part( 'template-parts/content', 'none' ); ?>
<?php endif; ?>
