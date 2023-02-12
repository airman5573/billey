<?php
defined( 'ABSPATH' ) || exit;

/**
 * Plugin installation and activation for WordPress themes
 */
if ( ! class_exists( 'Billey_Register_Plugins' ) ) {
	class Billey_Register_Plugins {

		protected static $instance = null;

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
					'source'   => $this->get_plugin_source_url( 'insight-core-1.7.9.2-54FPQwGKI5.zip' ),
					'version'  => '1.7.9.2',
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
					'source'   => $this->get_plugin_source_url( 'elementor-pro-3.0.9-aSAhR9Z4n2.zip' ),
					'version'  => '3.0.9',
					'required' => true,
				),
				array(
					'name'    => esc_html__( 'Revolution Slider', 'billey' ),
					'slug'    => 'revslider',
					'source'  => $this->get_plugin_source_url( 'revslider-6.3.6-kfzNVhJZ35.zip' ),
					'version' => '6.3.6',
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
					'source'  => $this->get_plugin_source_url( 'elfsight-instagram-feed-cc-4.0.1-bfaRxLvWr9.zip' ),
					'version' => '4.0.1',
				),
			);

			$plugins = array_merge( $plugins, $new_plugins );

			return $plugins;
		}

		public function get_plugin_source_url( $file_name ) {
			return 'https://api.thememove.com/download/' . $file_name;
		}

	}

	Billey_Register_Plugins::instance()->initialize();
}
