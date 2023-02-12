<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Billey_Booking_Search_Box' ) ) {
	class Billey_Booking_Search_Box {
		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function initialize() {
			add_action( 'wp_enqueue_scripts', [ $this, 'frontend_enqueue' ], 12 );
		}

		public function frontend_enqueue() {
			/**
			 * Remove scripts & styles enqueue for all pages.
			 */
			wp_dequeue_style( 'bos_sb_main_css' );
			wp_dequeue_script( 'bos_main_js' );
			wp_dequeue_script( 'bos_date_js' );
		}
	}

	Billey_Booking_Search_Box::instance()->initialize();
}
