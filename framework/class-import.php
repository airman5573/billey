<?php
defined( 'ABSPATH' ) || exit;

/**
 * Initial OneClick import for this theme
 */
if ( ! class_exists( 'Billey_Import' ) ) {
	class Billey_Import {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function initialize() {
			add_filter( 'insight_core_import_demos', array( $this, 'import_demos' ) );
			//			add_filter( 'insight_core_import_generate_thumb', array( $this, 'generate_thumbnail' ) );
			add_filter( 'insight_core_import_generate_thumb', '__return_false' );
			add_filter( 'insight_core_import_delete_exist_posts', '__return_true' );
		}

		public function import_demos() {
			return array(
				'01' => array(    // Done.
				                  'screenshot' => BILLEY_THEME_URI . '/screenshot.jpg',
				                  'name'       => BILLEY_THEME_NAME . ' Main',
				                  'url'        => 'https://www.dropbox.com/s/lej1jyns5qwdqdr/billey-insightcore01-main-1.5.7.zip?dl=1',
				),
				'02' => array(    // Done.
				                  'screenshot' => BILLEY_THEME_URI . '/screenshot.jpg',
				                  'name'       => BILLEY_THEME_NAME . ' RTL',
				                  'url'        => 'https://www.dropbox.com/s/t2lzud078bi65he/billey-insightcore01-rtl-1.5.7.zip?dl=1',
				),
			);
		}

		/**
		 * Generate thumbnail while importing
		 */
		function generate_thumbnail() {
			return false;
		}
	}

	Billey_Import::instance()->initialize();
}
