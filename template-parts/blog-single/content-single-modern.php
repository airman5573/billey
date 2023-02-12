<?php
/**
 * The template for displaying all single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Billey
 * @since   1.0
 */
?>
<div class="blog-modern-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="entry-header">
					<?php if ( '1' === Billey::setting( 'single_post_title_enable' ) ) : ?>
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<?php endif; ?>

					<?php get_template_part( 'template-parts/blog-single/meta' ); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="page-content" class="page-content">
	<div class="container">
		<div class="row">

			<?php Billey_Templates::render_sidebar( 'left' ); ?>

			<div class="page-main-content">
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/blog-single/style', 'modern' ); ?>

				<?php endwhile; ?>
			</div>

			<?php Billey_Templates::render_sidebar( 'right' ); ?>

		</div>
	</div>

	<?php
	$next_post = get_next_post();
	?>
	<?php if ( '1' === Billey::setting( 'single_post_pagination_enable' ) && ! empty( $next_post ) ) { ?>
		<div class="post-pagination-next">
			<div class="row">
				<div class="col-md-push-2 col-md-8">
					<?php Billey_Post::instance()->entry_nav_next_link(); ?>
				</div>
			</div>
		</div>
	<?php } ?>

	<div class="entry-box-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-push-2 col-md-8">
					<?php
					$author_desc = get_the_author_meta( 'description' );
					if ( '1' === Billey::setting( 'single_post_author_box_enable' ) && ! empty( $author_desc ) ) {
						Billey_Templates::post_author();
					}

					if ( Billey::setting( 'single_post_related_enable' ) ) {
						get_template_part( 'template-parts/blog-single/content-related-posts' );
					}

					// If comments are open or we have at least one comment, load up the comment template.
					if ( '1' === Billey::setting( 'single_post_comment_enable' ) && ( comments_open() || get_comments_number() ) ) :
						comments_template();
					endif;
					?>
				</div>
			</div>
		</div>
	</div>
</div>
