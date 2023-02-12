<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Billey_Widgets' ) ) {
	class Billey_Widgets {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function initialize() {
			// Register widget areas.
			add_action( 'widgets_init', array(
				$this,
				'register_sidebars',
			) );
		}

		/**
		 * Register widget area.
		 *
		 * @access public
		 * @link   https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 */
		public function register_sidebars() {
			$defaults = array(
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			);

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'blog_sidebar',
				'name'        => esc_html__( 'Blog Sidebar', 'billey' ),
				'description' => esc_html__( 'Add widgets here.', 'billey' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'page_sidebar',
				'name'        => esc_html__( 'Page Sidebar', 'billey' ),
				'description' => esc_html__( 'Add widgets here.', 'billey' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'shop_sidebar',
				'name'        => esc_html__( 'Shop Sidebar', 'billey' ),
				'description' => esc_html__( 'Add widgets here.', 'billey' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'off_sidebar',
				'name'        => esc_html__( 'Off Sidebar', 'billey' ),
				'description' => esc_html__( 'Add widgets here.', 'billey' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'header_widgets',
				'name'        => esc_html__( 'Header Widgets', 'billey' ),
				'description' => esc_html__( 'Add widgets here.', 'billey' ),
			) ) );
		}
	}

	Billey_Widgets::instance()->initialize();
}
