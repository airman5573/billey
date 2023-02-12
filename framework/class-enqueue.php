<?php
defined( 'ABSPATH' ) || exit;

/**
 * Enqueue scripts and styles.
 */
if ( ! class_exists( 'Billey_Enqueue' ) ) {
	class Billey_Enqueue {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function initialize() {
			// Set priority 4 to make it run before elementor register scripts.
			add_action( 'wp_enqueue_scripts', array( $this, 'register_swiper' ), 4 );

			add_action( 'wp_enqueue_scripts', array( $this, 'polyfill_script' ), 1 );

			add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ) );

			/**
			 * Make it run after main style & components.
			 */
			add_action( 'wp_enqueue_scripts', [ $this, 'rtl_styles' ], 20 );

			// Disable woocommerce all default styles.
			add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

			add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_woocommerce_styles_scripts' ), 99 );
		}

		/**
		 * Fix elementor broken on old browsers
		 * Safari < 12.1
		 * Firefox < 55
		 * Chrome < 51
		 */
		public function polyfill_script() {
			wp_enqueue_script( 'intersection-observer', BILLEY_THEME_ASSETS_URI . '/libs/polyfill/intersection-observer.min.js', null, null, true );
		}

		public function dequeue_woocommerce_styles_scripts() {
			$can_disabled = Billey::setting( 'disable_woo_scripts' );

			// Do nothing if woocommerce not active && disable in customize.
			if ( ! $can_disabled || ! function_exists( 'is_woocommerce' ) ) {
				return;
			}

			// Get specify pages turn on scripts.
			$pages = Billey::setting( 'woo_scripts_on' );
			// Remove all white spaces.
			$pages = preg_replace( '/\s+/', '', $pages );
			$pages = explode( ',', $pages );

			$post_id         = get_the_ID();
			$should_disabled = false;

			$wishlist = get_option( 'woosw_page_id' );
			$wishlist = intval( $wishlist );

			if ( ! in_array( $post_id, $pages ) &&
			     $wishlist !== $post_id &&
			     ! is_woocommerce() && ! is_cart() && ! is_checkout() && ! is_account_page() ) {
				$should_disabled = true;
			}

			if ( $should_disabled ) {
				// From Woo.
				/**
				 * Don't dequeue these scripts. It'll be not working with mini cart.
				 * 'wc-add-to-cart'
				 * 'wc-cart-fragments'
				 */
				wp_dequeue_script( 'woocommerce' );

				// From Woo Smart Compare
				wp_dequeue_script( 'woosc-frontend' );
				wp_dequeue_script( 'dragarrange' );
				wp_dequeue_script( 'table-head-fixer' );

				// From Woo Smart Wishlist.
				wp_dequeue_script( 'woosw-frontend' );

				// From Theme
				//wp_dequeue_style( 'billey-woocommerce' );
				//wp_dequeue_script( 'billey-woo' );

				wp_dequeue_style( 'magnific-popup' );
				wp_dequeue_script( 'magnific-popup' );
			}
		}

		/**
		 * Register swiper lib.
		 * Use on wp_enqueue_scripts action.
		 */
		public function register_swiper() {
			wp_register_style( 'swiper', BILLEY_THEME_URI . '/assets/libs/swiper/css/swiper.min.css', null, '5.2.0' );
			wp_register_script( 'swiper', BILLEY_THEME_URI . '/assets/libs/swiper/js/swiper.min.js', array(
				'jquery',
				'imagesloaded',
			), '5.2.0', true );

			wp_register_script( 'billey-swiper-wrapper', BILLEY_THEME_URI . '/assets/js/swiper-wrapper.js', array( 'swiper' ), BILLEY_THEME_VERSION, true );

			$billey_swiper_js = array(
				'prevText'              => esc_html__( 'Prev', 'billey' ),
				'nextText'              => esc_html__( 'Next', 'billey' ),
				'fractionSeparatorText' => _x( 'Of', 'slider fraction separator', 'billey' ),
			);
			wp_localize_script( 'billey-swiper-wrapper', '$billeySwiper', $billey_swiper_js );
		}

		/**
		 * Enqueue scripts & styles for frond-end.
		 *
		 * @access public
		 */
		public function frontend_scripts() {
			$post_type = get_post_type();
			$min       = \Billey_Enqueue::instance()->get_min_suffix();
			$rtl       = \Billey_Enqueue::instance()->get_rtl_suffix();

			// Remove prettyPhoto, default light box of woocommerce.
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );

			// Remove font awesome from Yith Wishlist plugin.
			wp_dequeue_style( 'yith-wcwl-font-awesome' );

			// Remove hint from Woo Smart Compare plugin.
			wp_dequeue_style( 'hint' );

			// Remove feather font from Woo Smart Wishlist plugin.
			wp_dequeue_style( 'woosw-feather' );

			/*
			 * Begin register scripts & styles to be enqueued later.
			 */
			wp_register_style( 'billey-woocommerce', BILLEY_THEME_URI . "/woocommerce{$rtl}{$min}.css", null, BILLEY_THEME_VERSION );

			wp_register_style( 'font-awesome-pro', BILLEY_THEME_URI . '/assets/fonts/awesome/css/fontawesome-all.min.css', null, '5.15.4' );

			wp_register_style( 'justifiedGallery', BILLEY_THEME_URI . '/assets/libs/justifiedGallery/css/justifiedGallery.min.css', null, '3.7.0' );
			wp_register_script( 'justifiedGallery', BILLEY_THEME_URI . '/assets/libs/justifiedGallery/js/jquery.justifiedGallery.min.js', array( 'jquery' ), '3.7.0', true );

			wp_register_style( 'lightgallery', BILLEY_THEME_URI . '/assets/libs/lightGallery/css/lightgallery.min.css', null, '1.6.12' );
			wp_register_script( 'lightgallery', BILLEY_THEME_URI . '/assets/libs/lightGallery/js/lightgallery-all.min.js', array(
				'jquery',
			), '1.6.12', true );

			wp_register_style( 'magnific-popup', BILLEY_THEME_URI . '/assets/libs/magnific-popup/magnific-popup.css' );
			wp_register_script( 'magnific-popup', BILLEY_THEME_URI . '/assets/libs/magnific-popup/jquery.magnific-popup.js', array( 'jquery' ), BILLEY_THEME_VERSION, true );

			wp_register_style( 'growl', BILLEY_THEME_URI . '/assets/libs/growl/css/jquery.growl.min.css', null, '1.3.3' );
			wp_register_script( 'growl', BILLEY_THEME_URI . '/assets/libs/growl/js/jquery.growl.min.js', array( 'jquery' ), '1.3.3', true );

			wp_register_script( 'matchheight', BILLEY_THEME_URI . '/assets/libs/matchHeight/jquery.matchHeight-min.js', array( 'jquery' ), BILLEY_THEME_VERSION, true );

			wp_register_script( 'smooth-scroll', BILLEY_THEME_URI . '/assets/libs/smooth-scroll-for-web/SmoothScroll.min.js', array(
				'jquery',
			), '1.4.9', true );

			// Fix Wordpress old version not registered this script.
			if ( ! wp_script_is( 'imagesloaded', 'registered' ) ) {
				wp_register_script( 'imagesloaded', BILLEY_THEME_URI . '/assets/libs/imagesloaded/imagesloaded.min.js', array( 'jquery' ), null, true );
			}

			$this->register_swiper();

			wp_register_script( 'sticky-kit', BILLEY_THEME_URI . '/assets/js/jquery.sticky-kit.min.js', array(
				'jquery',
			), BILLEY_THEME_VERSION, true );

			wp_register_script( 'picturefill', BILLEY_THEME_URI . '/assets/libs/picturefill/picturefill.min.js', array( 'jquery' ), null, true );

			wp_register_script( 'mousewheel', BILLEY_THEME_URI . '/assets/libs/mousewheel/jquery.mousewheel.min.js', array( 'jquery' ), BILLEY_THEME_VERSION, true );

			$google_api_key = Billey::setting( 'google_api_key' );
			wp_register_script( 'billey-gmap3', BILLEY_THEME_URI . '/assets/libs/gmap3/gmap3.min.js', array( 'jquery' ), BILLEY_THEME_VERSION, true );
			wp_register_script( 'billey-maps', BILLEY_PROTOCOL . '://maps.google.com/maps/api/js?key=' . $google_api_key . '&amp;language=en' );

			wp_register_script( 'isotope-masonry', BILLEY_THEME_URI . '/assets/libs/isotope/js/isotope.pkgd.js', array( 'jquery' ), BILLEY_THEME_VERSION, true );
			wp_register_script( 'isotope-packery', BILLEY_THEME_URI . '/assets/libs/packery-mode/packery-mode.pkgd.js', array( 'jquery' ), BILLEY_THEME_VERSION, true );

			wp_register_script( 'billey-grid-layout', BILLEY_THEME_ASSETS_URI . '/js/grid-layout.js', array(
				'jquery',
				'imagesloaded',
				'isotope-masonry',
				'isotope-packery',
			), null, true );
			/*
			 * End register scripts
			 */

			wp_enqueue_style( 'font-awesome-pro' );
			wp_enqueue_style( 'swiper' );
			wp_enqueue_style( 'lightgallery' );

			/*
			 * Enqueue the theme's style.css.
			 * This is recommended because we can add inline styles there
			 * and some plugins use it to do exactly that.
			 */
			if ( is_rtl() ) {
				wp_enqueue_style( 'billey-style', get_template_directory_uri() . "/style-rtl{$min}.css" );
			} else {
				wp_enqueue_style( 'billey-style', get_template_directory_uri() . "/style{$min}.css" );
			}

			if ( Billey_Woo::instance()->is_activated() ) {
				wp_enqueue_style( 'billey-woocommerce' );
			}

			if ( Billey::setting( 'header_sticky_enable' ) ) {
				wp_enqueue_script( 'headroom', BILLEY_THEME_URI . '/assets/js/headroom.min.js', array( 'jquery' ), BILLEY_THEME_VERSION, true );
			}

			if ( Billey::setting( 'smooth_scroll_enable' ) ) {
				wp_enqueue_script( 'smooth-scroll' );
			}

			/**
			 * Fix Elementor load out-date version 1.0.1
			 */
			wp_deregister_script( 'smartmenus' );
			wp_register_script( 'smartmenus', BILLEY_THEME_URI . '/assets/libs/smartmenus/jquery.smartmenus.min.js', array( 'jquery' ), '1.1.1', true );

			wp_enqueue_script( 'lightgallery' );

			/**
			 * Use theme version fixed jquery deprecated.
			 */
			wp_deregister_script( 'elementor-waypoints' );

			// Use waypoints lib edited by Elementor to avoid duplicate the script.
			if ( ! wp_script_is( 'elementor-waypoints', 'registered' ) ) {
				wp_register_script( 'elementor-waypoints', BILLEY_THEME_URI . '/assets/libs/elementor-waypoints/jquery.waypoints.min.js', array( 'jquery' ), null, true );
			}

			wp_enqueue_script( 'elementor-waypoints' );

			wp_enqueue_script( 'jquery-smooth-scroll', BILLEY_THEME_URI . '/assets/libs/smooth-scroll/jquery.smooth-scroll.min.js', array( 'jquery' ), BILLEY_THEME_VERSION, true );

			wp_enqueue_script( 'billey-swiper-wrapper' );

			wp_enqueue_script( 'billey-grid-layout' );
			wp_enqueue_script( 'smartmenus' );

			wp_enqueue_style( 'perfect-scrollbar', BILLEY_THEME_URI . '/assets/libs/perfect-scrollbar/css/perfect-scrollbar.min.css' );
			wp_enqueue_style( 'perfect-scrollbar-woosw', BILLEY_THEME_URI . '/assets/libs/perfect-scrollbar/css/custom-theme.css' );
			wp_enqueue_script( 'perfect-scrollbar', BILLEY_THEME_URI . '/assets/libs/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js', array( 'jquery' ), BILLEY_THEME_VERSION, true );

			if ( Billey::setting( 'notice_cookie_enable' ) === '1' && ! isset( $_COOKIE['notice_cookie_confirm'] ) ) {
				wp_enqueue_script( 'growl' );
				wp_enqueue_style( 'growl' );
			}

			if ( Billey_Woo::instance()->is_activated() && Billey::setting( 'shop_archive_quick_view' ) === '1' ) {
				wp_enqueue_style( 'magnific-popup' );
				wp_enqueue_script( 'magnific-popup' );
			}

			$is_product = false;

			//  Enqueue styles & scripts for single pages.
			if ( is_singular() ) {

				switch ( $post_type ) {
					case 'portfolio':
						$_sticky = Billey::setting( 'single_portfolio_sticky_detail_enable' );


						if ( $_sticky == '1' ) {
							wp_enqueue_script( 'sticky-kit' );
						}

						wp_enqueue_style( 'lightgallery' );
						wp_enqueue_script( 'lightgallery' );

						break;

					case 'product':
						$is_product = true;

						$single_product_sticky = Billey::setting( 'single_product_sticky_enable' );
						if ( $single_product_sticky == '1' ) {
							wp_enqueue_script( 'sticky-kit' );
						}

						wp_enqueue_style( 'lightgallery' );
						wp_enqueue_script( 'lightgallery' );

						break;
				}
			}

			/*
			 * The comment-reply script.
			 */
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				if ( $post_type === 'post' ) {
					if ( Billey::setting( 'single_post_comment_enable' ) === '1' ) {
						wp_enqueue_script( 'comment-reply' );
					}
				} elseif ( $post_type === 'portfolio' ) {
					if ( Billey::setting( 'single_portfolio_comment_enable' ) === '1' ) {
						wp_enqueue_script( 'comment-reply' );
					}
				} else {
					wp_enqueue_script( 'comment-reply' );
				}
			}

			/*
			 * Enqueue main JS
			 */
			wp_enqueue_script( 'billey-script', BILLEY_THEME_URI . '/assets/js/main.js', array(
				'jquery',
			), BILLEY_THEME_VERSION, true );

			if ( Billey_Woo::instance()->is_activated() ) {
				wp_enqueue_script( 'billey-woo', BILLEY_THEME_URI . '/assets/js/woo.js', array(
					'billey-script',
				), BILLEY_THEME_VERSION, true );
			}

			if ( Billey_Woo::instance()->is_activated() && ! is_user_logged_in() && is_account_page() ) {
				wp_enqueue_script( 'billey-woo-sign-in-up', BILLEY_THEME_URI . '/assets/js/woo-sign-in-up.js', array(
					'billey-script',
				), BILLEY_THEME_VERSION, true );
			}

			if ( Billey_Helper::is_page_template( 'portfolio-parallel-scroll-showcase.php' ) ) {
				wp_enqueue_script( 'billey-template-parallel-scroll-showcase', BILLEY_THEME_URI . '/assets/js/template-portfolio-parallel-scroll-showcase.js', array( 'billey-script', ), BILLEY_THEME_VERSION, true );
			}

			/*
			 * Enqueue custom variable JS
			 */

			$js_variables = array(
				'ajaxurl'                   => admin_url( 'admin-ajax.php' ),
				'header_sticky_enable'      => Billey::setting( 'header_sticky_enable' ),
				'header_sticky_height'      => Billey::setting( 'header_sticky_height' ),
				'scroll_top_enable'         => Billey::setting( 'scroll_top_enable' ),
				'light_gallery_auto_play'   => Billey::setting( 'light_gallery_auto_play' ),
				'light_gallery_download'    => Billey::setting( 'light_gallery_download' ),
				'light_gallery_full_screen' => Billey::setting( 'light_gallery_full_screen' ),
				'light_gallery_zoom'        => Billey::setting( 'light_gallery_zoom' ),
				'light_gallery_thumbnail'   => Billey::setting( 'light_gallery_thumbnail' ),
				'light_gallery_share'       => Billey::setting( 'light_gallery_share' ),
				'mobile_menu_breakpoint'    => Billey::setting( 'mobile_menu_breakpoint' ),
				'isProduct'                 => $is_product,
				'productFeatureStyle'       => Billey_Woo::instance()->get_single_product_style(),
				'noticeCookieEnable'        => Billey::setting( 'notice_cookie_enable' ),
				'noticeCookieConfirm'       => isset( $_COOKIE['notice_cookie_confirm'] ) ? 'yes' : 'no',
				'noticeCookieMessages'      => Billey_Notices::instance()->get_notice_cookie_messages(),
				'isRTL'                     => is_rtl(),
			);
			wp_localize_script( 'billey-script', '$billey', $js_variables );

			/**
			 * Custom JS
			 */
			if ( Billey::setting( 'custom_js_enable' ) == 1 ) {
				wp_add_inline_script( 'billey-script', html_entity_decode( Billey::setting( 'custom_js' ) ) );
			}
		}

		public function rtl_styles() {
			$min = $this->get_min_suffix();

			wp_register_style( 'billey-style-rtl-custom', BILLEY_THEME_URI . "/style-rtl-custom$min.css", [ 'billey-style' ], BILLEY_THEME_VERSION );

			if ( is_rtl() ) {
				wp_enqueue_style( 'billey-style-rtl-custom' );
			}
		}

		/**
		 * @return string
		 */
		public function get_min_suffix() {
			return defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ? '' : '.min';
		}

		public function get_rtl_suffix() {
			return is_rtl() ? '-rtl' : '';
		}
	}

	Billey_Enqueue::instance()->initialize();
}
