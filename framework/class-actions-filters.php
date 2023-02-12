<?php
defined( 'ABSPATH' ) || exit;

/**
 * Custom filters that act independently of the theme templates
 */
if ( ! class_exists( 'Billey_Actions_Filters' ) ) {
	class Billey_Actions_Filters {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function initialize() {
			/* Move post count inside the link */
			add_filter( 'wp_list_categories', array( $this, 'move_post_count_inside_link_category' ) );
			/* Move post count inside the link */
			add_filter( 'get_archives_link', array( $this, 'move_post_count_inside_link_archive' ) );

			// Change comment form fields order.
			add_filter( 'comment_form_fields', array( $this, 'move_comment_field_to_bottom' ) );

			add_filter( 'embed_oembed_html', array( $this, 'add_wrapper_for_video' ), 10, 3 );
			add_filter( 'video_embed_html', array( $this, 'add_wrapper_for_video' ) ); // Jetpack.

			add_filter( 'excerpt_length', array(
				$this,
				'custom_excerpt_length',
			), 999 ); // Change excerpt length is set to 55 words by default.

			// Adds custom classes to the array of body classes.
			add_filter( 'body_class', array( $this, 'body_classes' ) );

			// Adds custom attributes to body tag.
			add_filter( 'billey_body_attributes', array( $this, 'add_attributes_to_body' ) );

			if ( ! is_admin() ) {
				add_action( 'pre_get_posts', array( $this, 'alter_search_loop' ), 1 );
				add_filter( 'pre_get_posts', array( $this, 'search_filter' ) );
				add_filter( 'pre_get_posts', array( $this, 'empty_search_filter' ) );
			}

			add_filter( 'insightcore_bmw_nav_args', array( $this, 'add_extra_params_to_insightcore_bmw' ) );
		}

		function add_extra_params_to_insightcore_bmw( $args ) {
			$args['link_before'] = '<div class="menu-item-wrap"><span class="menu-item-title">';
			$args['link_after']  = '</span></div>';

			return $args;
		}

		function move_post_count_inside_link_category( $links ) {
			// First remove span that added by woocommerce.
			$links = str_replace( '<span class="count">', '', $links );
			$links = str_replace( '</span>', '', $links );

			// Then add span again for both blog & shop.

			$links = str_replace( '</a> ', ' <span class="count">', $links );
			$links = str_replace( ')', ')</span></a>', $links );

			return $links;
		}

		function move_post_count_inside_link_archive( $links ) {
			$links = str_replace( '</a>&nbsp;(', ' (', $links );
			$links = str_replace( ')', ')</a>', $links );

			$links = str_replace( '(', ' <span class="count">(', $links );
			$links = str_replace( ')', ')</span>', $links );

			return $links;
		}

		function change_widget_tag_cloud_args( $args ) {
			$args['separator'] = ', ';

			return $args;
		}

		function move_comment_field_to_bottom( $fields ) {
			// Move comment field to bottom of fields.
			$comment_field = $fields['comment'];
			unset( $fields['comment'] );
			$fields['comment'] = $comment_field;

			// If comments cookies opt-in checkbox checked then move it below of comment field.
			if ( isset( $fields['cookies'] ) ) {
				$cookie_field = $fields['cookies'];
				unset( $fields['cookies'] );
				$fields['cookies'] = $cookie_field;
			}

			return $fields;
		}

		/**
		 * @param WP_Query $query Query instance.
		 */
		public function alter_search_loop( $query ) {
			if ( $query->is_main_query() && $query->is_search() ) {
				$number_results = Billey::setting( 'search_page_number_results' );
				$query->set( 'posts_per_page', $number_results );
			}
		}

		/**
		 * @param WP_Query $query Query instance.
		 *
		 * @return WP_Query $query
		 *
		 * Apply filters to the search query.
		 * Determines if we only want to display posts/pages and changes the query accordingly
		 */
		public function search_filter( $query ) {
			if ( $query->is_main_query() && $query->is_search ) {
				$filter = Billey::setting( 'search_page_filter' );
				if ( $filter !== 'all' ) {
					$query->set( 'post_type', $filter );
				}
			}

			return $query;
		}

		/**
		 * Make wordpress respect the search template on an empty search
		 */
		public function empty_search_filter( $query ) {
			if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) && $query->is_main_query() ) {
				$query->is_search = true;
				$query->is_home   = false;
			}

			return $query;
		}

		public function custom_excerpt_length() {
			return 999;
		}

		/**
		 * Add responsive container to embeds
		 */
		public function add_wrapper_for_video( $html, $url ) {
			$array = array(
				'youtube.com',
				'wordpress.tv',
				'vimeo.com',
				'dailymotion.com',
				'hulu.com',
			);

			if ( Billey_Helper::strposa( $url, $array ) ) {
				$html = '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
			}

			return $html;
		}

		public function add_attributes_to_body( $attrs ) {
			$site_width = Billey_Helper::get_post_meta( 'site_width', '' );
			if ( $site_width === '' ) {
				$site_width = Billey::setting( 'site_width' );
			}
			$attrs['data-site-width']    = $site_width;
			$attrs['data-content-width'] = 1200;

			$font = Billey_Helper::get_body_font();

			$attrs['data-font'] = $font;

			$header_sticky_height               = Billey::setting( 'header_sticky_height' );
			$attrs['data-header-sticky-height'] = $header_sticky_height;

			return $attrs;
		}

		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 *
		 * @return array
		 */
		public function body_classes( $classes ) {
			if ( ! is_user_logged_in() ) {
				$classes[] = 'anonymous';
			} else {
				$classes[] = 'logged-in';
			}

			// Adds a class for mobile device.
			if ( Billey::is_mobile() ) {
				$classes[] = 'mobile';
			}

			// Adds a class for tablet device.
			if ( Billey::is_tablet() ) {
				$classes[] = 'tablet';
			}

			// Adds a class for handheld device.
			if ( Billey::is_handheld() ) {
				$classes[] = 'handheld mobile-menu';
			}

			// Adds a class for desktop device.
			if ( Billey::is_desktop() ) {
				$classes[] = 'desktop desktop-menu';
			}

			if ( ! is_home() && ( function_exists( 'elementor_location_exits' ) && elementor_location_exits( 'archive', true ) ) ) {
				$classes[] = 'elementor-archive-page';
			}

			$mobile_menu_effect = Billey::setting( 'mobile_menu_effect' );
			$classes[]          = "mobile-menu-{$mobile_menu_effect}";

			if ( Billey_Woo::instance()->is_activated() ) {
				$classes[] = 'woocommerce';

				if ( Billey_Woo::instance()->is_product_archive() ) {
					$classes[] = 'archive-shop';

					$archive_shop_layout = Billey::setting( 'shop_archive_layout' );
					$classes[]           = "archive-shop-{$archive_shop_layout}";
				}

				if ( is_singular( 'product' ) ) {
					$product_feature_style = Billey_Woo::instance()->get_single_product_style();
					$classes[]             = "single-product-{$product_feature_style}";
				}
			}

			$one_page_enable = Billey_Helper::get_post_meta( 'menu_one_page', '' );
			if ( $one_page_enable === '1' ) {
				$classes[] = 'one-page';
			}

			if ( is_singular( 'portfolio' ) ) {
				$skin = Billey_Helper::get_post_meta( 'portfolio_site_skin', '' );
				if ( $skin === '' ) {
					$skin = Billey::setting( 'single_portfolio_site_skin' );
				}
				$classes[] = "page-skin-$skin";

				$style = Billey_Helper::get_post_meta( 'portfolio_layout_style', '' );
				if ( $style === '' ) {
					$style = Billey::setting( 'single_portfolio_style' );
				}
				$classes[] = "single-portfolio-style-$style";
			}

			if ( is_singular( 'post' ) ) {
				$blog_style = Billey_Helper::get_post_meta( 'single_post_style', '' );

				if ( empty( $blog_style ) ) {
					$blog_style = Billey::setting( 'single_post_style' );
				}

				$classes[] = "single-blog-style-$blog_style";
			}

			$header_sticky_behaviour = Billey::setting( 'header_sticky_behaviour' );
			$classes[]               = "header-sticky-$header_sticky_behaviour";

			$site_layout = Billey_Helper::get_post_meta( 'site_layout', '' );
			if ( $site_layout === '' ) {
				$site_layout = Billey::setting( 'site_layout' );
			}
			$classes[] = $site_layout;

			$site_class = Billey_Helper::get_post_meta( 'site_class', '' );
			if ( $site_class !== '' ) {
				$classes[] = $site_class;
			}

			$sidebar_status = Billey_Global::instance()->get_sidebar_status();

			if ( $sidebar_status === 'one' ) {
				$classes[] = 'page-has-sidebar page-one-sidebar';
			} elseif ( $sidebar_status === 'both' ) {
				$classes[] = 'page-has-sidebar page-both-sidebar';
			} else {
				$classes[] = 'page-has-no-sidebar';
			}

			return $classes;
		}
	}

	Billey_Actions_Filters::instance()->initialize();
}
