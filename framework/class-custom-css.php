<?php
defined( 'ABSPATH' ) || exit;

/**
 * Enqueue custom styles.
 */
if ( ! class_exists( 'Billey_Custom_Css' ) ) {
	class Billey_Custom_Css {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function initialize() {
			add_action( 'wp_enqueue_scripts', array( $this, 'extra_css' ) );
		}

		/**
		 * Responsive styles.
		 *
		 * @access public
		 */
		public function extra_css() {
			$extra_style = '';

			$custom_logo_width        = Billey_Helper::get_post_meta( 'custom_logo_width', '' );
			$custom_sticky_logo_width = Billey_Helper::get_post_meta( 'custom_sticky_logo_width', '' );

			if ( $custom_logo_width !== '' ) {
				$extra_style .= ".branding__logo img { 
                    width: {$custom_logo_width} !important; 
                }";
			}

			if ( $custom_sticky_logo_width !== '' ) {
				$extra_style .= ".headroom--not-top .branding__logo .sticky-logo { 
                    width: {$custom_sticky_logo_width} !important; 
                }";
			}

			$site_width = Billey_Helper::get_post_meta( 'site_width', '' );
			if ( $site_width === '' ) {
				$site_width = Billey::setting( 'site_width' );
			}

			if ( $site_width !== '' ) {
				$extra_style .= "
				.boxed
				{
	                max-width: $site_width;
	            }";
			}

			$site_top_spacing = Billey_Helper::get_post_meta( 'site_top_spacing', '' );

			if ( $site_top_spacing !== '' ) {
				$extra_style .= "
				.boxed
				{
	                margin-top: {$site_top_spacing};
	            }";
			}

			$site_bottom_spacing = Billey_Helper::get_post_meta( 'site_bottom_spacing', '' );

			if ( $site_bottom_spacing !== '' ) {
				$extra_style .= "
				.boxed
				{
	                margin-bottom: {$site_bottom_spacing};
	            }";
			}

			$tmp = '';

			$site_background_color = Billey_Helper::get_post_meta( 'site_background_color', '' );
			if ( $site_background_color !== '' ) {
				$tmp .= "background-color: $site_background_color !important;";
			}

			$site_background_image = Billey_Helper::get_post_meta( 'site_background_image', '' );
			if ( $site_background_image !== '' ) {
				$site_background_repeat = Billey_Helper::get_post_meta( 'site_background_repeat', '' );
				$tmp                    .= "background-image: url( $site_background_image ) !important; background-repeat: $site_background_repeat !important;";
			}

			$site_background_position = Billey_Helper::get_post_meta( 'site_background_position', '' );
			if ( $site_background_position !== '' ) {
				$tmp .= "background-position: $site_background_position !important;";
			}

			$site_background_size = Billey_Helper::get_post_meta( 'site_background_size', '' );
			if ( $site_background_size !== '' ) {
				$tmp .= "background-size: $site_background_size !important;";
			}

			$site_background_attachment = Billey_Helper::get_post_meta( 'site_background_attachment', '' );
			if ( $site_background_attachment !== '' ) {
				$tmp .= "background-attachment: $site_background_attachment !important;";
			}

			if ( $tmp !== '' ) {
				$extra_style .= "body { $tmp; }";
			}

			$tmp = '';

			$content_background_color = Billey_Helper::get_post_meta( 'content_background_color', '' );
			if ( $content_background_color !== '' ) {
				$tmp .= "background-color: $content_background_color !important;";
			}

			$content_background_image = Billey_Helper::get_post_meta( 'content_background_image', '' );
			if ( $content_background_image !== '' ) {
				$content_background_repeat = Billey_Helper::get_post_meta( 'content_background_repeat', '' );
				$tmp                       .= "background-image: url( $content_background_image ) !important; background-repeat: $content_background_repeat !important;";
			}

			$content_background_position = Billey_Helper::get_post_meta( 'content_background_position', '' );
			if ( $content_background_position !== '' ) {
				$tmp .= "background-position: $content_background_position !important;";
			}

			if ( $tmp !== '' ) {
				$extra_style .= ".site { $tmp; }";
			}

			$extra_style .= $this->primary_color_css();
			$extra_style .= $this->secondary_color_css();
			$extra_style .= $this->header_css();
			$extra_style .= $this->sidebar_css();
			$extra_style .= $this->title_bar_css();
			$extra_style .= $this->light_gallery_css();
			$extra_style .= $this->off_canvas_menu_css();
			$extra_style .= $this->mobile_menu_css();

			$extra_style = Billey_Minify::css( $extra_style );

			wp_add_inline_style( 'billey-style', html_entity_decode( $extra_style, ENT_QUOTES ) );
		}

		function header_css() {
			$header_type = Billey_Global::instance()->get_header_type();
			$css         = '';

			$nav_bg_type = Billey::setting( "header_style_{$header_type}_navigation_background_type" );

			if ( $nav_bg_type === 'gradient' ) {

				$gradient = Billey::setting( "header_style_{$header_type}_navigation_background_gradient" );
				$_color_1 = $gradient['from'];
				$_color_2 = $gradient['to'];

				$css .= "
				.header-$header_type .header-bottom {
					background: {$_color_1};
                    background: -webkit-linear-gradient(-136deg, {$_color_2} 0%, {$_color_1} 100%);
                    background: linear-gradient(-136deg, {$_color_2} 0%, {$_color_1} 100%);
				}";
			}

			return $css;
		}

		function sidebar_css() {
			$css = '';

			$page_sidebar1  = Billey_Global::instance()->get_sidebar_1();
			$page_sidebar2  = Billey_Global::instance()->get_sidebar_2();
			$sidebar_status = Billey_Global::instance()->get_sidebar_status();

			if ( 'none' !== $page_sidebar1 ) {

				if ( $sidebar_status === 'both' ) {
					$sidebars_breakpoint = Billey::setting( 'both_sidebar_breakpoint' );
				} else {
					$sidebars_breakpoint = Billey::setting( 'one_sidebar_breakpoint' );
				}

				$sidebars_below = Billey::setting( 'sidebars_below_content_mobile' );

				if ( 'none' !== $page_sidebar2 ) {
					$sidebar_width  = Billey::setting( 'dual_sidebar_width' );
					$sidebar_offset = Billey::setting( 'dual_sidebar_offset' );
					$content_width  = 100 - $sidebar_width * 2;
				} else {
					$sidebar_width  = Billey::setting( 'single_sidebar_width' );
					$sidebar_offset = Billey::setting( 'single_sidebar_offset' );
					$content_width  = 100 - $sidebar_width;
				}

				$css .= "
				@media (min-width: {$sidebars_breakpoint}px) {
					.page-sidebar {
						flex: 0 0 $sidebar_width%;
						max-width: $sidebar_width%;
					}
					.page-main-content {
						flex: 0 0 $content_width%;
						max-width: $content_width%;
					}
				}
				@media (min-width: 1200px) {
					.page-sidebar-left .page-sidebar-inner {
						padding-right: $sidebar_offset;
					}
					.page-sidebar-right .page-sidebar-inner {
						padding-left: $sidebar_offset;
					}
				}";

				$_max_width_breakpoint = $sidebars_breakpoint - 1;

				if ( $sidebars_below === '1' ) {
					$css .= "
					@media (max-width: {$_max_width_breakpoint}px) {
						.page-sidebar {
							margin-top: 100px;
						}
					
						.page-main-content {
							-webkit-order: -1;
							-moz-order: -1;
							order: -1;
						}
					}";
				}
			}

			return $css;
		}

		function title_bar_css() {
			$css = $title_bar_tmp = $overlay_tmp = '';

			$type    = Billey_Global::instance()->get_title_bar_type();
			$bg_type = Billey::setting( "title_bar_{$type}_background_type" );

			if ( 'gradient' === $bg_type ) {
				$gradient_color = Billey::setting( "title_bar_{$type}_background_gradient" );
				$color1         = $gradient_color['color_1'];
				$color2         = $gradient_color['color_2'];

				$css .= "
					.page-title-bar-inner
					{
						background-color: $color1;
						background-image: linear-gradient(-180deg, {$color1} 0%, {$color2} 100%);
					}
				";
			}

			$bg_color       = Billey_Helper::get_post_meta( 'page_title_bar_background_color', '' );
			$bg_image       = Billey_Helper::get_post_meta( 'page_title_bar_background', '' );
			$bg_overlay     = Billey_Helper::get_post_meta( 'page_title_bar_background_overlay', '' );
			$bottom_spacing = Billey_Helper::get_post_meta( 'page_title_bar_bottom_spacing', '' );

			if ( $bg_color !== '' ) {
				$title_bar_tmp .= "background-color: {$bg_color}!important;";
			}

			if ( '' !== $bg_image ) {
				$title_bar_tmp .= "background-image: url({$bg_image})!important;";
			}

			if ( '' !== $bg_overlay ) {
				$overlay_tmp .= "background-color: {$bg_overlay}!important;";
			}

			if ( '' !== $title_bar_tmp ) {
				$css .= ".page-title-bar-inner{ {$title_bar_tmp} }";
			}

			if ( '' !== $overlay_tmp ) {
				$css .= ".page-title-bar-overlay{ {$overlay_tmp} }";
			}

			if ( '' !== $bottom_spacing ) {
				$css .= "#page-title-bar{ margin-bottom: {$bottom_spacing}; }";
			}

			return $css;
		}

		function primary_color_css() {
			$color          = Billey::setting( 'primary_color' );
			$color_alpha_80 = Billey_Color::hex2rgba( $color, '0.8' );

			// Color.
			$css = "
				::-moz-selection { color: #fff; background-color: $color }
				::selection { color: #fff; background-color: $color }
                mark,
                .primary-color,
                .growl-close:hover,
                .tm-button.style-border,
				.billey-grid-loader,
				.billey-blog .post-title a:hover,
				.billey-blog .post-categories a:hover,
				.tm-portfolio .post-categories a:hover,
				.tm-portfolio .post-title a:hover,
				.billey-pricing .price-wrap,
				.tm-google-map .style-signal .animated-dot,
				.billey-list .marker,
				.billey-gradation .count,
				.billey-pricing-style-02 .billey-pricing .billey-pricing-features li i,
				.billey-pricing-style-03 .billey-pricing .price-wrap,
				.billey-pricing-style-03 .billey-pricing .billey-pricing-features li i,
				.billey-case-study-carousel .slide-tags,
				.billey-case-study-carousel .tm-button,
				.tm-social-networks .link:hover,
				.tm-social-networks.style-solid-rounded-icon .link,
				.tm-slider a:hover .heading,
				.woosw-area .woosw-inner .woosw-content .woosw-content-bot .woosw-content-bot-inner .woosw-page a:hover,
				.woosw-continue:hover,
				.tm-menu .menu-price,
				.woocommerce-widget-layered-nav-list a:hover,
				.single-post .post-meta .meta-icon,
				.single-post .post-meta .sl-icon,
				.entry-post-tags a:hover,
				.entry-post-share a:hover,
				.widget_search .search-submit,
				.widget_product_search .search-submit,
				body.search .page-main-content .search-form .search-submit,
				.page-sidebar .widget_pages .current-menu-item > a,
				.page-sidebar .widget_nav_menu .current-menu-item > a,
				.page-sidebar .insight-core-bmw .current-menu-item > a,
				.comment-list .comment-actions a:hover,
				.portfolio-nav-links.style-01 .inner > a:hover,
				.portfolio-nav-links.style-02 .nav-list .hover
				{ 
					color: {$color} 
				}";

			// Background Color.
			$css .= "
				.primary-background-color,
                .tm-button.style-flat:before,
                .tm-button.style-icon-circle:before,
                .tm-button.style-border:after,
                .hint--primary:after,
                [data-fp-section-skin='dark'] #fp-nav ul li a span,
                [data-fp-section-skin='dark'] .fp-slidesNav ul li a span,
                .page-scroll-up,
                .top-bar-01 .top-bar-button,
                .billey-team-member-style-02 .social-networks a:hover,
                .tm-social-networks.style-flat-rounded-icon .link,
				.tm-social-networks.style-flat-rounded-icon .link:hover,
				.tm-social-networks.style-solid-rounded-icon .link:hover,
				.tm-swiper .swiper-pagination-progressbar .swiper-pagination-progressbar-fill,
				.billey-pricing-ribbon-style-02 .billey-pricing-ribbon,
				.portfolio-overlay-group-01.portfolio-overlay-colored-faded .post-overlay,
				.billey-modern-carousel .slide-tag,
				.billey-light-gallery .billey-box .billey-overlay,
				.elementor-widget-tm-tabs.billey-tabs-style-01 .billey-tab-title:before,
				.nav-links a:hover,
				.single-post .entry-post-feature.post-quote,
				.single-blog-style-modern .entry-post-share .share-list a:hover,
				.entry-post-share .share-icon,
				.entry-portfolio-feature .gallery-item .overlay,
				.widget .tagcloud a:hover,
				.widget_calendar #today,
				.widget_search .search-submit:hover,
				.widget_product_search .search-submit:hover,
				body.search .page-main-content .search-form .search-submit:hover,
				.woocommerce .select2-container--default .select2-results__option--highlighted[aria-selected],
				.wp-block-tag-cloud a:hover,
				.wp-block-calendar #today
				{
					background-color: {$color};
				}";

			$css .= "
				.primary-background-color-important,
				.lg-progress-bar .lg-progress
				{
					background-color: {$color}!important;
				}";

			$css .= "
				.portfolio-overlay-group-01 .post-overlay
				{
					background-color: {$color_alpha_80};
				}";

			// Border.
			$css .= "
				.tm-button.style-border,
				.page-search-popup .search-field,
				.tm-social-networks.style-solid-rounded-icon .link,
				.tm-popup-video.type-button .video-play,
				.widget_pages .current-menu-item, 
				.widget_nav_menu .current-menu-item,
				.insight-core-bmw .current-menu-item
				{
					border-color: {$color};
				}";

			// Border Important.
			$css .= "
				.single-product .woo-single-gallery .billey-thumbs-swiper .swiper-slide:hover img,
				.single-product .woo-single-gallery .billey-thumbs-swiper .swiper-slide-thumb-active img,
				.lg-outer .lg-thumb-item.active, .lg-outer .lg-thumb-item:hover
				{
					border-color: {$color}!important;
				}";

			// Border Top.
			$css .= "
                .hint--primary.hint--top-left:before,
                .hint--primary.hint--top-right:before,
                .hint--primary.hint--top:before
                {
					border-top-color: {$color};
				}";

			// Border Right.
			$css .= "
                .hint--primary.hint--right:before
                {
					border-right-color: {$color};
				}";

			// Border Bottom.
			$css .= "
                .hint--primary.hint--bottom-left:before,
                .hint--primary.hint--bottom-right:before,
                .hint--primary.hint--bottom:before
                {
					border-bottom-color: {$color};
				}";

			// Border Left.
			$css .= "
                .hint--primary.hint--left:before,
                .tm-popup-video.type-button .video-play-icon:before
                {
                    border-left-color: {$color};
                }";

			if ( Billey_Woo::instance()->is_activated() ) {
				$css .= "
				.widget_price_filter .ui-slider,
				.billey-product .woocommerce-loop-product__title a:hover,
				.cart-collaterals .order-total .amount,
				.my-account-layout .form-tabs a.active,
				.woocommerce-mini-cart__empty-message .empty-basket,
				.woocommerce .cart_list.product_list_widget a:hover,
				.woocommerce .cart.shop_table td.product-name a:hover,
				.woocommerce ul.product_list_widget li .product-title:hover,
				.entry-product-meta a:hover,
				.popup-product-quick-view .product_title a:hover
				{
					color: {$color}
				}";

				$css .= "
				.woocommerce-info, .woocommerce-message,
				.woocommerce-MyAccount-navigation .is-active a,
				.woocommerce-MyAccount-navigation a:hover
				{ 
					background-color: {$color}; 
				}";

				$css .= "
				body.woocommerce-cart table.cart td.actions .coupon .input-text:focus,
				.woocommerce div.quantity .qty:focus,
				.woocommerce div.quantity button:hover:before,
				.woocommerce.single-product div.product .images .thumbnails .item img:hover
				{
					border-color: {$color};
				}";

				$css .= "
                .mini-cart .widget_shopping_cart_content,
				.single-product .woocommerce-tabs li.active,
				.woocommerce .select2-container .select2-choice {
					border-bottom-color: {$color};
				}";
			}

			return $css;
		}

		function secondary_color_css() {
			$color = Billey::setting( 'secondary_color' );

			// Color.
			$css = "
				.secondary-color
				{
					color: {$color} 
				}";

			// Background Color.
			$css .= "
				.tm-button.style-flat:after,
				.tm-button.style-icon-circle:after,
				.hint--secondary:after
				{
					background-color: {$color};
				}";

			// Border Top.
			$css .= "
                .hint--secondary.hint--top-left:before,
                .hint--secondary.hint--top-right:before,
                .hint--secondary.hint--top:before
                {
					border-top-color: {$color};
				}";

			// Border Right.
			$css .= "
                .hint--secondary.hint--right:before
                {
					border-right-color: {$color};
				}";

			// Border Bottom.
			$css .= "
                .hint--secondary.hint--bottom-left:before,
                .hint--secondary.hint--bottom-right:before,
                .hint--secondary.hint--bottom:before
                {
					border-bottom-color: {$color};
				}";

			// Border Left.
			$css .= "
                .hint--secondary.hint--left:before
                {
                    border-left-color: {$color};
                }";

			return $css;
		}

		function light_gallery_css() {
			$css                    = '';
			$primary_color          = Billey::setting( 'primary_color' );
			$secondary_color        = Billey::setting( 'secondary_color' );
			$cutom_background_color = Billey::setting( 'light_gallery_custom_background' );
			$background             = Billey::setting( 'light_gallery_background' );

			$tmp = '';

			if ( $background === 'primary' ) {
				$tmp .= "background-color: {$primary_color} !important;";
			} elseif ( $background === 'secondary' ) {
				$tmp .= "background-color: {$secondary_color} !important;";
			} else {
				$tmp .= "background-color: {$cutom_background_color} !important;";
			}

			$css .= ".lg-backdrop { $tmp }";

			return $css;
		}

		function off_canvas_menu_css() {
			$css  = '';
			$type = Billey::setting( 'navigation_minimal_01_background_type' );
			if ( $type === 'gradient' ) {
				$gradient = Billey::setting( 'navigation_minimal_01_background_gradient_color' );

				$css .= ".popup-canvas-menu {
				    background-color: {$gradient['color_1']};
					background-image: linear-gradient(138deg, {$gradient['color_1']} 0%, {$gradient['color_2']} 100%);
				}";
			}

			return $css;
		}

		function mobile_menu_css() {
			$css  = '';
			$type = Billey::setting( 'mobile_menu_background_type' );
			if ( $type === 'gradient' ) {
				$gradient = Billey::setting( 'mobile_menu_background_gradient_color' );

				$css .= ".page-mobile-main-menu > .inner {
				    background-color: {$gradient['color_1']};
					background-image: linear-gradient(138deg, {$gradient['color_1']} 0%, {$gradient['color_2']} 100%);
				}";
			}

			return $css;
		}
	}

	Billey_Custom_Css::instance()->initialize();
}
