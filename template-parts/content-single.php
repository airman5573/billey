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
<div id="page-content" class="page-content">
	<div class="container">
		<div class="row">

			<?php Billey_Templates::render_sidebar( 'left' ); ?>

			<div class="page-main-content">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
			</div>

			<?php Billey_Templates::render_sidebar( 'right' ); ?>

		</div>
	</div>
</div>
