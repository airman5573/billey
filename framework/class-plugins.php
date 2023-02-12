<?php
defined( 'ABSPATH' ) || exit;

/**
 * Plugin installation and activation for WordPress themes
 */
if ( ! class_exists( 'Billey_Register_Plugins' ) ) {
	class Billey_Register_Plugins {

		protected static $instance = null;

		const GOOGLE_DRIVER_API = 'AIzaSyBQsxIg32Eg17Ic0tmRvv1tBZYrT9exCwk';

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function initialize() {
			add_filter( 'insight_core_tgm_plugins', array( $this, 'register_required_plugins' ) );
		}

		public function register_required_plugins( $plugins ) {
			/*
			 * Array of plugin arrays. Required keys are name and slug.
			 * If the source is NOT from the .org repo, then source is also required.
			 */
			$new_plugins = array(
				array(
					'name'     => esc_html__( 'Insight Core', 'billey' ),
					'slug'     => 'insight-core',
					'source'   => 'https://www.dropbox.com/s/ng9wlaw024mjc5m/insight-core-2.6.0.zip?dl=1',
					'version'  => '2.6.0',
					'required' => true,
				),
				array(
					'name'     => esc_html__( 'Elementor', 'billey' ),
					'slug'     => 'elementor',
					'required' => true,
				),
				array(
					'name'     => esc_html__( 'Elementor Pro', 'billey' ),
					'slug'     => 'elementor-pro',
					'source'   => 'https://www.dropbox.com/s/iw023g15spgoyye/elementor-pro-3.9.2.zip?dl=1',
					'version'  => '3.9.2',
					'required' => true,
				),
				array(
					'name'    => esc_html__( 'Revolution Slider', 'billey' ),
					'slug'    => 'revslider',
					'source'  => 'https://www.dropbox.com/s/3chdbb82qzy1p26/revslider-6.6.8.zip?dl=1',
					'version' => '6.6.8',
				),
				array(
					'name' => esc_html__( 'MailChimp for WordPress', 'billey' ),
					'slug' => 'mailchimp-for-wp',
				),
				array(
					'name' => esc_html__( 'WooCommerce', 'billey' ),
					'slug' => 'woocommerce',
				),
				array(
					'name' => esc_html__( 'WPC Smart Compare for WooCommerce', 'billey' ),
					'slug' => 'woo-smart-compare',
				),
				array(
					'name' => esc_html__( 'WPC Smart Wishlist for WooCommerce', 'billey' ),
					'slug' => 'woo-smart-wishlist',
				),
				array(
					'name' => esc_html__( 'Booking.com Official Search Box', 'billey' ),
					'slug' => 'bookingcom-official-searchbox',
				),
				array(
					'name'    => esc_html__( 'Instagram Feed', 'billey' ),
					'slug'    => 'elfsight-instagram-feed-cc',
					'source'  => $this->get_plugin_google_driver_url( '10WhiFcWGxtWM7RADSdIl_9QQqGVTLLhK' ),
					'version' => '4.0.3',
				),
			);

			$plugins = array_merge( $plugins, $new_plugins );

			return $plugins;
		}

		public function get_plugin_google_driver_url( $file_id ) {
			return "https://www.googleapis.com/drive/v3/files/{$file_id}?alt=media&key=" . self::GOOGLE_DRIVER_API;
		}

	}

	Billey_Register_Plugins::instance()->initialize();
}
