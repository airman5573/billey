<?php
defined( 'ABSPATH' ) || exit;

/**
 * Initialize Global Variables
 */
if ( ! class_exists( 'Billey_Global' ) ) {
	class Billey_Global {

		protected static $instance         = null;
		protected static $slider           = '';
		protected static $slider_position  = 'below';
		protected static $top_bar_type     = '01';
		protected static $header_type      = '01';
		protected static $header_overlay   = '0';
		protected static $header_skin      = 'dark';
		protected static $title_bar_type   = '01';
		protected static $sidebar_1        = '';
		protected static $sidebar_2        = '';
		protected static $sidebar_position = '';
		protected static $sidebar_status   = 'none';
		protected static $popup_search     = false;
		protected static $off_sidebar      = false;
		protected static $footer           = '';

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function initialize() {
			/**
			 * Use hook wp instead of init because we need post meta setup.
			 * then we must wait for post loaded.
			 */
			add_action( 'wp', array( $this, 'init_global_variable' ) );

			/**
			 * Setup global variables.
			 * Used priority 12 to wait override settings setup.
			 *
			 * @see Billey_Customize::setup_override_settings()
			 */
			add_action( 'wp', array( $this, 'setup_global_variables' ), 12 );
		}

		public function init_global_variable() {
			global $billey_page_options;
			if ( is_singular( 'portfolio' ) ) {
				$billey_page_options = unserialize( get_post_meta( get_the_ID(), 'insight_portfolio_options', true ) );
			} elseif ( is_singular( 'post' ) ) {
				$billey_page_options = unserialize( get_post_meta( get_the_ID(), 'insight_post_options', true ) );
			} elseif ( is_singular( 'page' ) ) {
				$billey_page_options = unserialize( get_post_meta( get_the_ID(), 'insight_page_options', true ) );
			} elseif ( is_singular( 'product' ) ) {
				$billey_page_options = unserialize( get_post_meta( get_the_ID(), 'insight_product_options', true ) );
			} elseif ( is_singular( 'elementor_library' ) ) {
				$billey_page_options = unserialize( get_post_meta( get_the_ID(), 'insight_elementor_library_options', true ) );
			}
			if ( function_exists( 'is_shop' ) && is_shop() ) {
				// Get page id of shop.
				$page_id             = wc_get_page_id( 'shop' );
				$billey_page_options = unserialize( get_post_meta( $page_id, 'insight_page_options', true ) );
			}
		}

		public function setup_global_variables() {
			$this->set_slider();
			$this->set_top_bar_type();
			$this->set_header_options();
			$this->set_title_bar_type();
			$this->set_sidebars();
			$this->set_popup_search();
			$this->set_off_sidebar();
			$this->set_footer();
		}

		function set_slider() {
			$alias    = Billey_Helper::get_post_meta( 'revolution_slider', '' );
			$position = Billey_Helper::get_post_meta( 'slider_position', '' );

			self::$slider          = $alias;
			self::$slider_position = $position;
		}

		function get_slider_alias() {
			return self::$slider;
		}

		function get_slider_position() {
			return self::$slider_position;
		}

		function set_top_bar_type() {
			$type = Billey_Helper::get_post_meta( 'top_bar_type', '' );

			if ( $type === '' ) {
				$type = Billey::setting( 'global_top_bar' );
			}

			self::$top_bar_type = $type;
		}

		function get_top_bar_type() {
			return self::$top_bar_type;
		}

		function set_header_options() {
			$header_type    = Billey_Helper::get_post_meta( 'header_type', '' );
			$header_overlay = Billey_Helper::get_post_meta( 'header_overlay', '' );
			$header_skin    = Billey_Helper::get_post_meta( 'header_skin', '' );

			// Woocommerce my account login/register/forgot-pass page.
			if ( Billey_Woo::instance()->is_activated() && is_account_page() && ! is_user_logged_in() ) {

				if ( $header_type === '' ) {
					$header_type = Billey::setting( 'page_my_account_header_type' );
				}

				if ( $header_overlay === '' ) {
					$header_overlay = Billey::setting( 'page_my_account_header_overlay' );
				}

				if ( $header_skin === '' ) {
					$header_skin = Billey::setting( 'page_my_account_header_skin' );
				}

			} elseif ( Billey_Woo::instance()->is_woocommerce_page_without_product() ) {

				if ( $header_type === '' ) {
					$header_type = Billey::setting( 'product_archive_header_type' );
				}

				if ( $header_overlay === '' ) {
					$header_overlay = Billey::setting( 'product_archive_header_overlay' );
				}

				if ( $header_skin === '' ) {
					$header_skin = Billey::setting( 'product_archive_header_skin' );
				}

			} elseif ( Billey_Portfolio::instance()->is_archive() ) {

				if ( $header_type === '' ) {
					$header_type = Billey::setting( 'portfolio_archive_header_type' );
				}

				if ( $header_overlay === '' ) {
					$header_overlay = Billey::setting( 'portfolio_archive_header_overlay' );
				}

				if ( $header_skin === '' ) {
					$header_skin = Billey::setting( 'portfolio_archive_header_skin' );
				}

			} elseif ( is_archive() ) {

				if ( $header_type === '' ) {
					$header_type = Billey::setting( 'blog_archive_header_type' );
				}

				if ( $header_overlay === '' ) {
					$header_overlay = Billey::setting( 'blog_archive_header_overlay' );
				}

				if ( $header_skin === '' ) {
					$header_skin = Billey::setting( 'blog_archive_header_skin' );
				}

			} elseif ( is_singular( 'post' ) ) {

				if ( $header_type === '' ) {
					$header_type = Billey::setting( 'blog_single_header_type' );
				}

				if ( $header_overlay === '' ) {
					$header_overlay = Billey::setting( 'blog_single_header_overlay' );
				}

				if ( $header_skin === '' ) {
					$header_skin = Billey::setting( 'blog_single_header_skin' );
				}

			} elseif ( is_singular( 'portfolio' ) ) {

				if ( $header_type === '' ) {
					$header_type = Billey::setting( 'portfolio_single_header_type' );
				}

				if ( $header_overlay === '' ) {
					$header_overlay = Billey::setting( 'portfolio_single_header_overlay' );
				}

				if ( $header_skin === '' ) {
					$header_skin = Billey::setting( 'portfolio_single_header_skin' );
				}

			} elseif ( is_singular( 'product' ) ) {

				if ( $header_type === '' ) {
					$header_type = Billey::setting( 'product_single_header_type' );
				}

				if ( $header_overlay === '' ) {
					$header_overlay = Billey::setting( 'product_single_header_overlay' );
				}

				if ( $header_skin === '' ) {
					$header_skin = Billey::setting( 'product_single_header_overlay' );
				}

			} elseif ( is_singular( 'page' ) ) {

				if ( $header_type === '' ) {
					$header_type = Billey::setting( 'page_header_type' );
				}

				if ( $header_overlay === '' ) {
					$header_overlay = Billey::setting( 'page_header_overlay' );
				}

				if ( $header_skin === '' ) {
					$header_skin = Billey::setting( 'page_header_skin' );
				}

			} else {

				if ( $header_type === '' ) {
					$header_type = Billey::setting( 'global_header' );
				}

				if ( $header_overlay === '' ) {
					$header_overlay = Billey::setting( 'global_header_overlay' );
				}

				if ( $header_skin === '' ) {
					$header_skin = Billey::setting( 'global_header_skin' );
				}
			}

			if ( $header_type === '' ) {
				$header_type = Billey::setting( 'global_header' );
			}

			if ( $header_overlay === '' ) {
				$header_overlay = Billey::setting( 'global_header_overlay' );
			}

			if ( $header_skin === '' ) {
				$header_skin = Billey::setting( 'global_header_skin' );
			}

			$header_type    = apply_filters( 'billey_header_type', $header_type );
			$header_overlay = apply_filters( 'billey_header_overlay', $header_overlay );
			$header_skin    = apply_filters( 'billey_header_skin', $header_skin );

			self::$header_type    = $header_type;
			self::$header_overlay = $header_overlay;
			self::$header_skin    = $header_skin;
		}

		function get_header_type() {
			return self::$header_type;
		}

		function get_header_overlay() {
			return self::$header_overlay;
		}

		/**
		 * @return string dark|light
		 */
		function get_header_skin() {
			return self::$header_skin;
		}

		function set_title_bar_type() {
			/**
			 * Disable title bar for templates.
			 */
			if ( Billey_Helper::is_page_template( 'portfolio-parallel-scroll-showcase.php' ) ) {
				$type = 'none';
			} else {
				$type = Billey_Helper::get_post_meta( 'page_title_bar_layout', '' );

				if ( $type === '' ) {
					// Woocommerce my account login/register/forgot-pass page.
					if ( Billey_Woo::instance()->is_activated() && is_account_page() && ! is_user_logged_in() ) {
						$type = Billey::setting( 'page_my_account_title_bar_layout' );
					} elseif ( Billey_Woo::instance()->is_woocommerce_page_without_product() ) {
						$type = Billey::setting( 'product_archive_title_bar_layout' );
					} elseif ( Billey_Portfolio::instance()->is_archive() ) {
						$type = Billey::setting( 'portfolio_archive_title_bar_layout' );
					} elseif ( is_archive() || is_home() ) {
						$type = Billey::setting( 'blog_archive_title_bar_layout' );
					} elseif ( is_singular( 'post' ) ) {
						$type = Billey::setting( 'blog_single_title_bar_layout' );
					} elseif ( is_singular( 'page' ) ) {
						$type = Billey::setting( 'page_title_bar_layout' );
					} elseif ( is_singular( 'product' ) ) {
						$type = Billey::setting( 'product_single_title_bar_layout' );
					} elseif ( is_singular( 'portfolio' ) ) {
						$type = Billey::setting( 'portfolio_single_title_bar_layout' );
					} else {
						$type = Billey::setting( 'title_bar_layout' );
					}

					if ( $type === '' ) {
						$type = Billey::setting( 'title_bar_layout' );
					}
				}
			}

			$type = apply_filters( 'billey_title_bar_type', $type );

			self::$title_bar_type = $type;
		}

		function get_title_bar_type() {
			return self::$title_bar_type;
		}

		function set_sidebars() {
			if ( Billey_Woo::instance()->is_product_archive() ) {
				$page_sidebar1    = Billey::setting( 'product_archive_page_sidebar_1' );
				$page_sidebar2    = Billey::setting( 'product_archive_page_sidebar_2' );
				$sidebar_position = Billey::setting( 'product_archive_page_sidebar_position' );
			} elseif ( Billey_Portfolio::instance()->is_archive() ) {
				$page_sidebar1    = Billey::setting( 'portfolio_archive_page_sidebar_1' );
				$page_sidebar2    = Billey::setting( 'portfolio_archive_page_sidebar_2' );
				$sidebar_position = Billey::setting( 'portfolio_archive_page_sidebar_position' );
			} elseif ( is_archive() || is_home() || ( is_search() && ! is_post_type_archive( 'product' ) ) ) {
				$page_sidebar1    = Billey::setting( 'blog_archive_page_sidebar_1' );
				$page_sidebar2    = Billey::setting( 'blog_archive_page_sidebar_2' );
				$sidebar_position = Billey::setting( 'blog_archive_page_sidebar_position' );
			} elseif ( is_singular( 'post' ) ) {
				$page_sidebar1    = Billey_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2    = Billey_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				$sidebar_position = Billey_Helper::get_post_meta( 'page_sidebar_position', 'default' );

				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Billey::setting( 'post_page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Billey::setting( 'post_page_sidebar_2' );
				}

				if ( $sidebar_position === 'default' ) {
					$sidebar_position = Billey::setting( 'post_page_sidebar_position' );
				}

			} elseif ( is_singular( 'portfolio' ) ) {
				$page_sidebar1    = Billey_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2    = Billey_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				$sidebar_position = Billey_Helper::get_post_meta( 'page_sidebar_position', 'default' );

				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Billey::setting( 'portfolio_page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Billey::setting( 'portfolio_page_sidebar_2' );
				}

				if ( $sidebar_position === 'default' ) {
					$sidebar_position = Billey::setting( 'portfolio_page_sidebar_position' );
				}

			} elseif ( is_singular( 'product' ) ) {
				$page_sidebar1    = Billey_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2    = Billey_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				$sidebar_position = Billey_Helper::get_post_meta( 'page_sidebar_position', 'default' );

				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Billey::setting( 'product_page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Billey::setting( 'product_page_sidebar_2' );
				}

				if ( $sidebar_position === 'default' ) {
					$sidebar_position = Billey::setting( 'product_page_sidebar_position' );
				}

			} else {
				$page_sidebar1    = Billey_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2    = Billey_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				$sidebar_position = Billey_Helper::get_post_meta( 'page_sidebar_position', 'default' );

				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Billey::setting( 'page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Billey::setting( 'page_sidebar_2' );
				}

				if ( $sidebar_position === 'default' ) {
					$sidebar_position = Billey::setting( 'page_sidebar_position' );
				}

			}

			if ( ! is_active_sidebar( $page_sidebar1 ) ) {
				$page_sidebar1 = 'none';
			}

			if ( ! is_active_sidebar( $page_sidebar2 ) ) {
				$page_sidebar2 = 'none';
			}

			$page_sidebar1    = apply_filters( 'billey_sidebar_1', $page_sidebar1 );
			$page_sidebar2    = apply_filters( 'billey_sidebar_2', $page_sidebar2 );
			$sidebar_position = apply_filters( 'billey_sidebar_position', $sidebar_position );

			self::$sidebar_1        = $page_sidebar1;
			self::$sidebar_2        = $page_sidebar2;
			self::$sidebar_position = $sidebar_position;

			if ( $page_sidebar1 !== 'none' || $page_sidebar2 !== 'none' ) {
				self::$sidebar_status = 'one';
			}

			if ( $page_sidebar1 !== 'none' && $page_sidebar2 !== 'none' ) {
				self::$sidebar_status = 'both';
			}
		}

		function get_sidebar_1() {
			return self::$sidebar_1;
		}

		function get_sidebar_2() {
			return self::$sidebar_2;
		}

		/**
		 * @return string left|right
		 */
		function get_sidebar_position() {
			return self::$sidebar_position;
		}

		/**
		 * @return string one|both|none
		 */
		function get_sidebar_status() {
			return self::$sidebar_status;
		}

		function set_popup_search() {
			$header_type = $this->get_header_type();
			$enable      = Billey::setting( "header_style_{$header_type}_search_popup_enable" );

			if ( $enable === '1' ) {
				self::$popup_search = true;
			}
		}

		function get_popup_search() {
			return self::$popup_search;
		}

		function set_off_sidebar() {
			$header_type = $this->get_header_type();
			$enable      = Billey::setting( "header_style_{$header_type}_off_sidebar_enable" );

			if ( $enable === '1' ) {
				self::$off_sidebar = true;
			}
		}

		function get_off_sidebar() {
			return self::$off_sidebar;
		}

		function set_footer() {
			if ( Billey_Helper::is_page_template( 'portfolio-parallel-scroll-showcase.php' ) ) {
				$footer = 'none';
			} else {
				$footer = Billey_Helper::get_post_meta( 'footer_enable', '' );
			}

			$footer = apply_filters( 'billey_footer', $footer );

			self::$footer = $footer;
		}

		function get_footer() {
			return self::$footer;
		}
	}

	Billey_Global::instance()->initialize();
}
