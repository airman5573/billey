<?php

namespace Billey_Elementor;

defined( 'ABSPATH' ) || exit;

class Widget_Init {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function initialize() {
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );

		// Registered Widgets.
		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );
		//add_action( 'elementor/widgets/register', [ $this, 'remove_unwanted_widgets' ], 15 );

		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'after_register_scripts' ] );
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'after_register_styles' ] );

		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'enqueue_editor_scripts' ] );

		add_filter( 'elementor/utils/get_the_archive_title', [ $this, 'change_portfolio_archive_title' ] );

		// Modify original widgets settings.
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/original/modify-base.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/original/section.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/original/column.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/original/accordion.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/original/animated-headline.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/original/counter.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/original/form.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/original/heading.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/original/icon-box.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/original/progress.php';
	}

	/**
	 * Register scripts for widgets.
	 */
	public function after_register_scripts() {
		// Fix Wordpress old version not registered this script.
		if ( ! wp_script_is( 'imagesloaded', 'registered' ) ) {
			wp_register_script( 'imagesloaded', BILLEY_THEME_URI . '/assets/libs/imagesloaded/imagesloaded.min.js', array( 'jquery' ), null, true );
		}

		wp_register_script( 'circle-progress', BILLEY_THEME_URI . '/assets/libs/circle-progress/circle-progress.min.js', array( 'jquery' ), null, true );
		wp_register_script( 'billey-widget-circle-progress', BILLEY_ELEMENTOR_URI . '/assets/js/widgets/widget-circle-progress.js', array(
			'jquery',
			'circle-progress',
		), null, true );

		wp_register_script( 'billey-swiper-wrapper', BILLEY_THEME_URI . '/assets/js/swiper-wrapper.js', array( 'swiper' ), BILLEY_THEME_VERSION, true );
		wp_register_script( 'billey-group-widget-carousel', BILLEY_ELEMENTOR_URI . '/assets/js/widgets/group-widget-carousel.js', array(
			'jquery',
			'swiper',
			'hoverIntent',
			'billey-swiper-wrapper',
		), null, true );
		$billey_swiper_js = array(
			'prevText'              => esc_html__( 'Prev', 'billey' ),
			'nextText'              => esc_html__( 'Next', 'billey' ),
			'fractionSeparatorText' => _x( 'Of', 'slider fraction separator', 'billey' ),
		);
		wp_localize_script( 'billey-swiper-wrapper', '$billeySwiper', $billey_swiper_js );

		wp_register_script( 'isotope-masonry', BILLEY_THEME_URI . '/assets/libs/isotope/js/isotope.pkgd.js', array( 'jquery' ), BILLEY_THEME_VERSION, true );
		wp_register_script( 'isotope-packery', BILLEY_THEME_URI . '/assets/libs/packery-mode/packery-mode.pkgd.js', array( 'jquery' ), BILLEY_THEME_VERSION, true );

		wp_register_script( 'billey-grid-layout', BILLEY_THEME_ASSETS_URI . '/js/grid-layout.js', array(
			'jquery',
			'imagesloaded',
			'isotope-masonry',
			'isotope-packery',
		), null, true );
		wp_register_script( 'billey-grid-query', BILLEY_ELEMENTOR_URI . '/assets/js/widgets/grid-query.js', array( 'jquery' ), null, true );

		wp_register_script( 'billey-widget-grid-post', BILLEY_ELEMENTOR_URI . '/assets/js/widgets/widget-grid-post.js', array( 'billey-grid-layout' ), null, true );
		wp_register_script( 'billey-group-widget-grid', BILLEY_ELEMENTOR_URI . '/assets/js/widgets/group-widget-grid.js', array( 'billey-grid-layout' ), null, true );

		wp_register_script( 'billey-widget-google-map', BILLEY_ELEMENTOR_URI . '/assets/js/widgets/widget-google-map.js', array( 'jquery' ), null, true );

		wp_register_script( 'vivus', BILLEY_ELEMENTOR_URI . '/assets/libs/vivus/vivus.js', array( 'jquery' ), null, true );
		wp_register_script( 'billey-widget-icon-box', BILLEY_ELEMENTOR_URI . '/assets/js/widgets/widget-icon-box.js', array(
			'jquery',
			'vivus',
		), null, true );

		wp_register_script( 'billey-widget-flip-box', BILLEY_ELEMENTOR_URI . '/assets/js/widgets/widget-flip-box.js', array(
			'jquery',
			'imagesloaded',
		), null, true );

		wp_register_script( 'billey-widget-accordion', BILLEY_ELEMENTOR_URI . '/assets/js/widgets/widget-accordion.js', array(
			'jquery',
		), null, true );

		wp_register_script( 'billey-widget-tabs', BILLEY_ELEMENTOR_URI . '/assets/js/widgets/widget-tabs.js', array(
			'jquery',
		), null, true );

		wp_register_script( 'chart', BILLEY_ELEMENTOR_URI . '/assets/libs/chart/Chart.min.js', array( 'jquery' ), null, true );
		wp_register_script( 'billey-group-widget-chart', BILLEY_ELEMENTOR_URI . '/assets/js/widgets/group-widget-chart.js', array(
			'jquery',
			'chart',
		), null, true );
	}

	/**
	 * enqueue scripts in editor mode.
	 */
	public function enqueue_editor_scripts() {
		wp_enqueue_script( 'billey-elementor-editor', BILLEY_ELEMENTOR_URI . '/assets/js/editor.js', array( 'jquery' ), null, true );
	}

	/**
	 * Register styles for widgets.
	 */
	public function after_register_styles() {

	}

	/**
	 * @param \Elementor\Elements_Manager $elements_manager
	 *
	 * Add category.
	 */
	function add_elementor_widget_categories( $elements_manager ) {
		$elements_manager->add_category( 'billey', [
			'title' => esc_html__( 'By Billey', 'billey' ),
			'icon'  => 'fa fa-plug',
		] );
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @param \Elementor\Widgets_Manager $widget_manager
	 *
	 * @since  1.0.0
	 *
	 * @access public
	 * @throws \Exception
	 */
	public function init_widgets( $widget_manager ) {

		// Include Widget files.
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/base.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/posts/posts-base.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/carousel/carousel-base.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/carousel/posts-carousel-base.php';

		require_once BILLEY_ELEMENTOR_DIR . '/widgets/accordion.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/tabs.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/button.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/circle-progress-chart.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/google-map.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/heading.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/icon.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/icon-box.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/image-box.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/image-layers.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/image-gallery.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/gif-player.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/banner.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/flip-box.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/attribute-list.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/list.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/gradation.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/pricing-table.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/twitter.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/team-member.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/social-networks.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/popup-video.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/separator.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/shapes.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/table.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/full-page.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/testimonial-grid.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/portfolio-details.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/typed-headline.php';

		require_once BILLEY_ELEMENTOR_DIR . '/widgets/grid/grid-base.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/grid/static-grid.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/grid/client-logo.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/grid/view-demo.php';

		require_once BILLEY_ELEMENTOR_DIR . '/widgets/posts/blog.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/posts/portfolio.php';

		require_once BILLEY_ELEMENTOR_DIR . '/widgets/carousel/static-carousel.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/carousel/team-member-carousel.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/carousel/testimonial-carousel.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/carousel/portfolio-carousel.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/carousel/case-study-carousel.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/carousel/image-carousel.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/carousel/modern-carousel.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/carousel/modern-slider.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/carousel/modern-background-carousel.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/carousel/running-campaigns-carousel.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/carousel/image-box-carousel.php';

		require_once BILLEY_ELEMENTOR_DIR . '/widgets/chart/chart-base.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/chart/bar-chart.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/chart/line-chart.php';
		require_once BILLEY_ELEMENTOR_DIR . '/widgets/chart/pie-chart.php';

		// Register Widgets.
		$widget_manager->register( new Widget_Accordion() );
		$widget_manager->register( new Widget_Tabs() );
		$widget_manager->register( new Widget_Button() );
		$widget_manager->register( new Widget_Client_Logo() );
		$widget_manager->register( new Widget_Circle_Progress_Chart() );
		$widget_manager->register( new Widget_Google_Map() );
		$widget_manager->register( new Widget_Heading() );
		$widget_manager->register( new Widget_Typed_Headline() );
		$widget_manager->register( new Widget_Icon() );
		$widget_manager->register( new Widget_Icon_Box() );
		$widget_manager->register( new Widget_Image_Box() );
		$widget_manager->register( new Widget_Image_Layers() );
		$widget_manager->register( new Widget_Image_Gallery() );
		$widget_manager->register( new Widget_Image_Carousel() );
		$widget_manager->register( new Widget_Gif_Player() );
		$widget_manager->register( new Widget_Banner() );
		$widget_manager->register( new Widget_Modern_Carousel() );
		$widget_manager->register( new Widget_Modern_Slider() );
		$widget_manager->register( new Widget_Modern_Background_Carousel() );
		$widget_manager->register( new Widget_Flip_Box() );
		$widget_manager->register( new Widget_Blog() );
		$widget_manager->register( new Widget_Portfolio() );
		$widget_manager->register( new Widget_Portfolio_Carousel() );
		$widget_manager->register( new Widget_Portfolio_Details() );
		$widget_manager->register( new Widget_Case_Study_Carousel() );
		$widget_manager->register( new Widget_Attribute_List() );
		$widget_manager->register( new Widget_List() );
		$widget_manager->register( new Widget_Gradation() );
		$widget_manager->register( new Widget_Pricing_Table() );
		$widget_manager->register( new Widget_Twitter() );
		$widget_manager->register( new Widget_Team_Member() );
		$widget_manager->register( new Widget_Team_Member_Carousel() );
		$widget_manager->register( new Widget_Testimonial_Carousel() );
		$widget_manager->register( new Widget_Testimonial_Grid() );
		$widget_manager->register( new Widget_Social_Networks() );
		$widget_manager->register( new Widget_Popup_Video() );
		$widget_manager->register( new Widget_Separator() );
		$widget_manager->register( new Widget_Table() );
		$widget_manager->register( new Widget_Full_Page() );
		$widget_manager->register( new Widget_View_Demo() );
		$widget_manager->register( new Widget_Bar_Chart() );
		$widget_manager->register( new Widget_Line_Chart() );
		$widget_manager->register( new Widget_Pie_Chart() );
		$widget_manager->register( new Widget_Shapes() );
		$widget_manager->register( new Widget_Running_campaigns_Carousel() );
		$widget_manager->register( new Widget_Image_Box_Carousel() );

		/**
		 * Include & Register Dependency Widgets.
		 */
		if ( defined( 'BOS_PLUGIN_VERSION' ) ) { // Booking.com Official Search Box plugin.
			require_once BILLEY_ELEMENTOR_DIR . '/widgets/booking-form.php';

			$widget_manager->register( new Widget_Booking_Form() );
		}

		if ( \Billey_Woo::instance()->is_activated() ) {
			require_once BILLEY_ELEMENTOR_DIR . '/widgets/posts/product.php';
			require_once BILLEY_ELEMENTOR_DIR . '/widgets/product-categories.php';

			$widget_manager->register( new Widget_Product() );
			$widget_manager->register( new Widget_Product_Categories() );
		}
	}

	public function change_portfolio_archive_title( $title ) {
		if ( \Billey_Portfolio::instance()->is_archive() ) {
			$title = \Billey::setting( 'title_bar_archive_portfolio_title' );
		}

		if ( '' === $title ) {
			$title = 'Archive Title';
		}

		return $title;
	}
}

Widget_Init::instance()->initialize();
