<div id="page-title-bar" <?php Billey::title_bar_class(); ?>>
	<div class="page-title-bar-overlay"></div>

	<div class="page-title-bar-inner">
		<div class="container">
			<div class="row row-xs-center">
				<div class="col-md-12">
					<?php Billey_Templates::get_title_bar_title(); ?>
				</div>
			</div>
		</div>

		<?php get_template_part( 'template-parts/breadcrumb' ); ?>
	</div>
</div>
