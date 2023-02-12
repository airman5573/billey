<header id="page-header" <?php Billey_Header::instance()->get_wrapper_class(); ?>>
	<div class="page-header-place-holder"></div>
	<div id="page-header-inner" class="page-header-inner" data-sticky="1">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<div class="header-wrap">
						<?php Billey_THA::instance()->header_wrap_top(); ?>

						<?php get_template_part( 'template-parts/branding' ); ?>

						<div class="header-right">

							<div id="header-right-inner" class="header-right-inner">
								<?php Billey_THA::instance()->header_right_top(); ?>

								<?php Billey_Header::instance()->print_language_switcher(); ?>

								<?php Billey_Header::instance()->print_social_networks(); ?>

								<?php Billey_Header::instance()->print_button( array( 'size' => 'sm' ) ); ?>

								<?php Billey_THA::instance()->header_right_bottom(); ?>
							</div>

							<?php Billey_Woo::instance()->render_mini_cart(); ?>

							<?php Billey_Header::instance()->print_search_button(); ?>

							<?php Billey_Header::instance()->print_open_canvas_menu_button(); ?>

							<?php Billey_Header::instance()->print_open_mobile_menu_button(); ?>

							<?php Billey_Header::instance()->print_more_tools_button(); ?>
						</div>

						<?php Billey_THA::instance()->header_wrap_bottom(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php get_template_part( 'template-parts/off-canvas' ); ?>
</header>
