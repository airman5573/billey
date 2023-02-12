<?php
/**
 * Template Name: Portfolio Parallel Scroll Showcase
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Billey
 * @since   1.0
 */

get_header();
$cats           = Billey::setting( 'portfolio_parallel_scroll_showcase_categories' );
$tags           = Billey::setting( 'portfolio_parallel_scroll_showcase_tags' );
$number         = Billey::setting( 'portfolio_parallel_scroll_showcase_number' );
$title          = Billey::setting( 'portfolio_parallel_scroll_showcase_title' );
$description    = Billey::setting( 'portfolio_parallel_scroll_showcase_description' );
$copyright_text = Billey::setting( 'portfolio_parallel_scroll_showcase_copyright_text' );

$billey_query_args = array(
	'post_type'      => 'portfolio',
	'orderby'        => 'date',
	'order'          => 'DESC',
	'post_status'    => 'publish',
	'posts_per_page' => $number,
	'no_found_rows'  => true,
);

if ( ! empty( $cats ) || ! empty( $tags ) ) {
	$billey_query_args['tax_query'] = array();
	$tax_queries                   = array();
	if ( ! empty( $cats ) ) {
		$tax_queries[] = array(
			'taxonomy' => 'portfolio_category',
			'field'    => 'slug',
			'terms'    => $cats,
		);
	}
	if ( ! empty( $tags ) ) {
		$tax_queries[] = array(
			'taxonomy' => 'portfolio_tags',
			'field'    => 'slug',
			'terms'    => $tags,
		);
	}
	$billey_query_args['tax_query']             = $tax_queries;
	$billey_query_args['tax_query']['relation'] = 'OR';
}

$billey_query               = new WP_Query( $billey_query_args );
$main_slider_slides_html   = '';
$thumbs_slider_slides_html = '';
$loop_count                = 0;

$main_slider_slide_loop  = 0;
$main_slider_slide_width = [
	2,
	1,
	1,
	1,
];

$thumbs_slider_slide_loop  = 0;
$thumbs_slider_slide_width = [
	1,
	1,
	2,
	2,
];
?>
<?php if ( $billey_query->have_posts() ) : ?>
	<?php
	while ( $billey_query->have_posts() ) : $billey_query->the_post();
		$slide_class = '';

		if ( $loop_count % 2 === 0 ) { // Main slides.
			if ( isset( $main_slider_slide_width[ $main_slider_slide_loop ] ) ) {
				$slide_class = "slide-width-{$main_slider_slide_width[$main_slider_slide_loop]}";
			} else {
				$main_slider_slide_loop = 0;
				$slide_class            = "slide-width-{$main_slider_slide_width[$main_slider_slide_loop]}";
			}

			$main_slider_slide_loop++;
			$main_slider_slides_html .= Billey_Portfolio::instance()->loop_parallel_scroll_showcase_template( $slide_class );
		} else { // Thumbs slides.
			if ( isset( $thumbs_slider_slide_width[ $thumbs_slider_slide_loop ] ) ) {
				$slide_class = "slide-width-{$thumbs_slider_slide_width[$thumbs_slider_slide_loop]}";
			} else {
				$thumbs_slider_slide_loop = 0;
				$slide_class              = "slide-width-{$thumbs_slider_slide_width[$thumbs_slider_slide_loop]}";
			}

			$thumbs_slider_slide_loop++;
			$thumbs_slider_slides_html .= Billey_Portfolio::instance()->loop_parallel_scroll_showcase_template( $slide_class );
		}

		$loop_count++;
	endwhile;
	?>

	<div id="page-content" class="page-content">

		<div class="row">
			<div class="col-md-3 site-info">
				<div class="site-info-wrap">
					<div class="site-info-inner">
						<h2 class="site-title"><?php echo wp_kses( $title, 'billey-default' ); ?></h2>
						<div class="site-description"><?php echo wp_kses( $description, 'billey-default' ); ?></div>

						<div class="tm-button-wrapper">
							<a class="site-button tm-button style-text"
							   href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>">
								<div class="button-content-wrapper">
									<span class="button-text"><?php esc_html_e( 'All projects', 'billey' ); ?></span>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-9 site-portfolio-sliders">
				<div id="billey-template-slider"
				     class="billey-swiper-linked-yes bullets-v-align-below portfolio-overlay-group-01 portfolio-overlay-faded"
				>

					<div class="tm-swiper billey-main-swiper"
					     data-lg-items="auto-fixed"
					     data-lg-gutter="20"
					     data-loop="1"
					     data-mousewheel="1"
					     data-simulate-touch="1"
					     data-speed="1000"
					     data-effect="slide"
					     data-looped-slides="4"
					>
						<div class="swiper-inner">
							<div class="swiper-container">
								<div class="swiper-wrapper">
									<?php echo '' . $main_slider_slides_html; ?>
								</div>
							</div>
						</div>
					</div>

					<div class="tm-swiper billey-thumbs-swiper"
					     data-lg-items="auto-fixed"
					     data-lg-gutter="20"
					     data-loop="1"
					     data-mousewheel="1"
					     data-simulate-touch="1"
					     data-speed="1000"
					     data-effect="slide"
					     data-looped-slides="4"
					>
						<div class="swiper-inner">
							<div class="swiper-container">
								<div class="swiper-wrapper">
									<?php echo '' . $thumbs_slider_slides_html; ?>
								</div>
							</div>
						</div>
					</div>

				</div>

				<div id="page-footer" class="page-footer">
					<div class="row row-xs-center">
						<div class="col-md-6">
							<div class="site-social-networks">
								<div class="inner">
									<?php Billey_Templates::social_icons( [
										'tooltip_enable' => false,
										'display'        => 'text',
									] ); ?>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="copyright-text"><?php echo wp_kses( $copyright_text, 'billey-default' ); ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>

<?php get_footer();
