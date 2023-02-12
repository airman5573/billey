<?php
$text = Billey::setting( 'top_bar_style_01_text' );
?>
<div id="page-top-bar" <?php Billey::top_bar_class(); ?>>
	<div class="page-top-bar-place-holder"></div>
	<div class="top-bar-inner">
		<div class="container">
			<div class="row row-eq-height top-bar-wrap">
				<div class="col-md-6 top-bar-left">
					<?php echo '<div class="top-bar-text">' . $text . '</div>' ?>
				</div>

				<div class="col-md-6 top-bar-right">
					<?php Billey_Templates::top_bar_info(); ?>
					<?php Billey_Templates::top_bar_social_networks(); ?>
				</div>
			</div>

		</div>
	</div>
</div>
