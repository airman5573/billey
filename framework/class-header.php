<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Billey_Header' ) ) {

	class Billey_Header {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function initialize() {

		}

		/**
		 * @return array List header types include id & name.
		 */
		public function get_type() {
			return array(
				'01' => esc_html__( 'Center Nav - Fluid', 'billey' ),
				'02' => esc_html__( 'Right Nav - Fluid', 'billey' ),
				'03' => esc_html__( 'Tiny Center Nav - Fluid', 'billey' ),
				'04' => esc_html__( 'Minimal - Fluid', 'billey' ),
				'05' => esc_html__( 'Thin Right Nav - Fluid - Mini Gutter', 'billey' ),
				'06' => esc_html__( 'Tiny Center Nav - Fluid - Filled', 'billey' ),
				'07' => esc_html__( 'Thin Right Nav - Fluid', 'billey' ),
				'08' => esc_html__( 'Center Nav', 'billey' ),
				'09' => esc_html__( 'Center Minimal - Fluid', 'billey' ),
				'10' => esc_html__( 'Right Nav', 'billey' ),
				'11' => esc_html__( 'Right Nav - Alt', 'billey' ),
				'12' => esc_html__( 'RTL', 'billey' ),
			);
		}

		/**
		 * @param bool   $default_option Show or hide default select option.
		 * @param string $default_text   Custom text for default option.
		 *
		 * @return array A list of options for select field.
		 */
		public function get_list( $default_option = false, $default_text = '' ) {
			$headers = array(
				'none' => esc_html__( 'Hide', 'billey' ),
			);

			$headers += $this->get_type();

			if ( $default_option === true ) {
				if ( $default_text === '' ) {
					$default_text = esc_html__( 'Default', 'billey' );
				}

				$headers = array( '' => $default_text ) + $headers;
			}

			return $headers;
		}

		/**
		 * Get list of button style option for customizer.
		 *
		 * @return array
		 */
		public function get_button_style() {
			return array(
				'flat'         => esc_attr__( 'Flat', 'billey' ),
				'border'       => esc_attr__( 'Border', 'billey' ),
				'thick-border' => esc_attr__( 'Thick Border', 'billey' ),
			);
		}

		public function get_button_kirki_output( $header_style, $header_skin, $hover = false ) {
			$prefix_selector = ".header-{$header_style}.header-{$header_skin} ";

			if ( $hover ) {
				$button_selector    = $prefix_selector . ".header-button:hover";
				$button_bg_selector = $prefix_selector . ".header-button:after";
			} else {
				$button_selector    = $prefix_selector . ".header-button";
				$button_bg_selector = $prefix_selector . ".header-button:before";
			}

			return array(
				array(
					'choice'   => 'color',
					'property' => 'color',
					'element'  => $button_selector,
				),
				array(
					'choice'   => 'border',
					'property' => 'border-color',
					'element'  => $button_selector,
				),
				array(
					'choice'   => 'background',
					'property' => 'background',
					'element'  => $button_bg_selector,
				),
			);
		}

		/**
		 * Add classes to the header.
		 *
		 * @var string $class Custom class.
		 */
		public function get_wrapper_class( $class = '' ) {
			$classes = array( 'page-header' );

			$header_type    = Billey_Global::instance()->get_header_type();
			$header_overlay = Billey_Global::instance()->get_header_overlay();
			$header_skin    = Billey_Global::instance()->get_header_skin();

			$classes[] = "header-{$header_type}";

			if ( $header_overlay === '1' ) {
				$classes[] = 'header-layout-fixed';
			}

			if ( ! in_array( $header_type, array( '04' ), true ) ) {
				$classes[] = ' nav-links-hover-style-01';
			}

			$classes[] = "header-{$header_skin}";

			$_sticky_logo = Billey::setting( "header_sticky_logo" );
			$classes[]    = " header-sticky-$_sticky_logo-logo";

			if ( ! empty( $class ) ) {
				if ( ! is_array( $class ) ) {
					$class = preg_split( '#\s+#', $class );
				}
				$classes = array_merge( $classes, $class );
			} else {
				// Ensure that we always coerce class to being an array.
				$class = array();
			}

			$classes = apply_filters( 'billey_header_class', $classes, $class );

			echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
		}

		/**
		 * Print WPML switcher html template.
		 *
		 * @var string $class Custom class.
		 */
		public function print_language_switcher() {
			$header_type = Billey_Global::instance()->get_header_type();
			$enabled     = Billey::setting( "header_style_{$header_type}_language_switcher_enable" );

			do_action( 'billey_before_add_language_selector_header', $header_type, $enabled );

			if ( $enabled !== '1' || ! defined( 'ICL_SITEPRESS_VERSION' ) ) {
				return;
			}
			?>
			<div id="switcher-language-wrapper" class="switcher-language-wrapper">
				<?php do_action( 'wpml_add_language_selector' ); ?>
			</div>
			<?php
		}

		public function print_social_networks( $args = array() ) {
			$header_type   = Billey_Global::instance()->get_header_type();
			$social_enable = Billey::setting( "header_style_{$header_type}_social_networks_enable" );

			if ( '1' !== $social_enable ) {
				return;
			}

			$defaults = array(
				'style' => 'icons',
			);

			$args       = wp_parse_args( $args, $defaults );
			$el_classes = 'header-social-networks';

			if ( ! empty( $args['style'] ) ) {
				$el_classes .= " style-{$args['style']}";
			}
			?>
			<div class="<?php echo esc_attr( $el_classes ); ?>">
				<div class="inner">
					<?php
					$defaults = array(
						'tooltip_position' => 'bottom-left',
					);

					if ( 'light' === Billey_Global::instance()->get_header_skin() ) {
						$defaults['tooltip_skin'] = 'white';
					}

					$args = wp_parse_args( $args, $defaults );

					Billey_Templates::social_icons( $args );
					?>
				</div>
			</div>
			<?php
		}

		public function print_widgets() {
			$header_type = Billey_Global::instance()->get_header_type();

			$enabled = Billey::setting( "header_style_{$header_type}_widgets_enable" );
			if ( '1' === $enabled ) {
				?>
				<div class="header-widgets">
					<?php Billey_Templates::generated_sidebar( 'header_widgets' ); ?>
				</div>
				<?php
			}
		}

		public function print_search_button() {
			$enable = Billey_Global::instance()->get_popup_search();
			if ( $enable !== true ) {
				return;
			}
			?>
			<div id="page-open-popup-search" class="header-icon page-open-popup-search">
				<i class="far fa-search"></i>
			</div>
			<?php
		}

		public function print_button( $args = array() ) {
			$header_type = Billey_Global::instance()->get_header_type();

			$button_style         = Billey::setting( "header_style_{$header_type}_button_style" );
			$button_text          = Billey::setting( "header_style_{$header_type}_button_text" );
			$button_link          = Billey::setting( "header_style_{$header_type}_button_link" );
			$button_link_target   = Billey::setting( "header_style_{$header_type}_button_link_target" );
			$button_link_rel      = Billey::setting( "header_style_{$header_type}_button_link_rel" );
			$button_extra_classes = Billey::setting( "header_style_{$header_type}_button_classes" );
			$sticky_button_style  = Billey::setting( "header_sticky_button_style" );

			$button_classes = 'tm-button';

			if ( ! empty( $button_extra_classes ) ) {
				$button_classes .= ' ' . $button_extra_classes;
			}

			$icon_class = Billey::setting( "header_style_{$header_type}_button_icon" );
			$icon_align = 'right';

			if ( $icon_class !== '' ) {
				$button_classes .= ' has-icon icon-right';
			}

			$defaults = array(
				'extra_class' => '',
				'style'       => '',
				'size'        => 'nm',
			);

			$args = wp_parse_args( $args, $defaults );

			if ( $args['extra_class'] !== '' ) {
				$button_classes .= " {$args['extra_class']}";
			}

			$header_button_classes = $button_classes . " tm-button-{$args['size']} header-button";
			$sticky_button_classes = $button_classes . ' tm-button-xs header-sticky-button';

			$header_button_classes .= " style-{$button_style}";
			$sticky_button_classes .= " style-{$sticky_button_style}";
			?>
			<?php if ( ! empty( $button_link ) && ! empty( $button_text ) ) : ?>

				<?php ob_start(); ?>

				<div class="button-content-wrapper">
					<?php if ( $icon_class !== '' && $icon_align === 'right' ) { ?>
						<span class="button-icon">
							<i class="<?php echo esc_attr( $icon_class ); ?>"></i>
						</span>
					<?php } ?>

					<span class="button-text">
						<?php echo esc_html( $button_text ); ?>
					</span>

					<?php if ( $icon_class !== '' && $icon_align === 'right' ) { ?>
						<span class="button-icon">
							<i class="<?php echo esc_attr( $icon_class ); ?>"></i>
						</span>
					<?php } ?>
				</div>

				<?php $button_content_html = ob_get_clean(); ?>

				<div class="header-buttons">
					<a class="<?php echo esc_attr( $header_button_classes ); ?>"
					   href="<?php echo esc_url( $button_link ); ?>"

						<?php if ( '1' === $button_link_target ) : ?>
							target="_blank"
						<?php endif; ?>

						<?php if ( ! empty ( $button_link_rel ) ) : ?>
							rel="<?php echo esc_attr( $button_link_rel ); ?>"
						<?php endif; ?>
					>
						<?php echo '' . $button_content_html; ?>
					</a>
					<a class="<?php echo esc_attr( $sticky_button_classes ); ?>"
					   href="<?php echo esc_url( $button_link ); ?>"

						<?php if ( '1' === $button_link_target ) : ?>
							target="_blank"
						<?php endif; ?>

						<?php if ( ! empty ( $button_link_rel ) ) : ?>
							rel="<?php echo esc_attr( $button_link_rel ); ?>"
						<?php endif; ?>
					>
						<?php echo '' . $button_content_html; ?>
					</a>
				</div>
			<?php endif;
		}

		public function print_open_mobile_menu_button() {
			?>
			<div id="page-open-mobile-menu" class="header-icon page-open-mobile-menu">
				<div class="burger-icon">
					<span class="burger-icon-top"></span>
					<span class="burger-icon-bottom"></span>
				</div>
			</div>
			<?php
		}

		public function print_open_off_sidebar() {
			$enable = Billey_Global::instance()->get_off_sidebar();

			if ( ! $enable ) {
				return;
			}
			?>
			<div id="page-open-off-sidebar" class="header-icon page-open-off-sidebar">
				<div class="inner">
					<div class="icon"><i></i></div>
				</div>
			</div>
			<?php
		}

		public function print_more_tools_button() {
			?>
			<div id="page-open-components" class="header-icon page-open-components">
				<div class="inner">
					<div class="circle circle-one"></div>
					<div class="circle circle-two"></div>
					<div class="circle circle-three"></div>
				</div>
			</div>
			<?php
		}

		public function print_open_canvas_menu_button( $args = array() ) {
			$defaults = array(
				'extra_class' => '',
				'style'       => '01',
			);
			$args     = wp_parse_args( $args, $defaults );

			$classes = "header-icon page-open-main-menu style-{$args['style']}";

			if ( ! empty( $args['extra_class'] ) ) {
				$classes .= " {$args['extra_class']}";
			}

			$title = Billey::setting( 'navigation_minimal_01_menu_title' );
			?>
			<div id="page-open-main-menu" class="<?php echo esc_attr( $classes ); ?>">
				<div class="burger-icon">
					<span class="burger-icon-top"></span>
					<span class="burger-icon-bottom"></span>
				</div>

				<?php if ( ! empty( $title ) ) : ?>
					<div class="burger-title"><?php echo esc_html( $title ); ?></div>
				<?php endif; ?>
			</div>
			<?php
		}
	}

	Billey_Header::instance()->initialize();
}
