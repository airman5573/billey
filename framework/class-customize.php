<?php
defined( 'ABSPATH' ) || exit;

/**
 * Setup for customizer of this theme
 */
if ( ! class_exists( 'Billey_Customize' ) ) {
	class Billey_Customize {

		protected static $instance = null;

		protected static $override_settings = array();

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function initialize() {
			// Build URL for customizer.
			add_filter( 'kirki_values_get_value', array( $this, 'kirki_db_get_theme_mod_value' ), 10, 2 );

			add_filter( 'kirki_theme_stylesheet', array( $this, 'change_inline_stylesheet' ), 10, 3 );

			add_filter( 'kirki_load_fontawesome', '__return_false' );

			// Disable Telemetry module.
			add_filter( 'kirki_telemetry', '__return_false' );

			// Remove unused native sections and controls.
			add_action( 'customize_register', array( $this, 'remove_customizer_sections' ) );

			// Add custom font to font select
			add_filter( 'kirki_fonts_standard_fonts', array( $this, 'add_custom_font' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'add_custom_font_css' ) );

			// Load customizer sections when all widgets init.
			add_action( 'init', array( $this, 'load_customizer' ), 99 );

			add_action( 'customize_controls_init', array(
				$this,
				'customize_preview_css',
			) );

			/**
			 * Override kirki settings with url preset or post meta preset.
			 * Used priority 11 to wait global variables loaded.
			 *
			 * @see Billey_Global::init_global_variable()
			 */
			add_action( 'wp', array( $this, 'setup_override_settings' ), 11 );
		}

		function setup_override_settings() {
			// Make preset in meta box.
			if ( ! is_customize_preview() ) {
				$presets = apply_filters( 'billey_page_meta_box_presets', array() );

				if ( ! empty( $presets ) ) {
					foreach ( $presets as $preset ) {
						$page_preset_value = Billey_Helper::get_post_meta( $preset );
						if ( $page_preset_value !== false ) {
							$_GET[ $preset ] = $page_preset_value;
						}
					}
				}
			}

			// Setup url.
			if ( empty( self::$override_settings ) ) {
				if ( ! empty( $_GET ) ) {

					foreach ( $_GET as $key => $query_value ) {
						if ( class_exists( 'Kirki' ) && ! empty( Kirki::$fields[ $key ] ) ) {

							if ( is_array( Kirki::$fields[ $key ] ) &&
							     ( 'kirki-preset' == Kirki::$fields[ $key ]['type'] || 'kirki-select' == Kirki::$fields[ $key ]['type'] ) &&
							     ! empty( Kirki::$fields[ $key ]['args']['choices'] ) &&
							     ! empty( Kirki::$fields[ $key ]['args']['choices'][ $query_value ] ) &&
							     ! empty( Kirki::$fields[ $key ]['args']['choices'][ $query_value ]['settings'] )
							) {
								$field_choice = Kirki::$fields[ $key ]['args']['choices'];
								foreach ( $field_choice[ $query_value ]['settings'] as $kirki_setting => $kirki_value ) {
									self::$override_settings[ $kirki_setting ] = $kirki_value;
								}
							} else {
								self::$override_settings[ $key ] = $query_value;
							}
						}
					}
				}
			}
		}

		public function change_inline_stylesheet() {
			return 'billey-style';
		}

		function add_custom_font( $fonts ) {
			$fonts['CerebriSans'] = array(
				'label'    => 'CerebriSans',
				'variants' => array(
					200,
					'200italic',
					300,
					'300italic',
					'regular',
					'italic',
					500,
					'500italic',
					600,
					'600italic',
					700,
					'700italic',
					800,
					'800italic',
					900,
					'900italic',
				),
				'stack'    => 'CerebriSans, sans-serif',
			);

			$fonts['Futura'] = array(
				'label'    => 'Futura',
				'variants' => array(
					500,
					'500italic',
					700,
					'700italic',
				),
				'stack'    => 'Futura, sans-serif',
			);

			return $fonts;
		}

		function add_custom_font_css() {
			$typo_fields = Billey_Kirki::get_typography_fields_id();

			if ( ! is_array( $typo_fields ) || empty( $typo_fields ) ) {
				return;
			}

			foreach ( $typo_fields as $field ) {
				$value = Billey::setting( $field );

				if ( is_array( $value ) && isset( $value['font-family'] ) && $value['font-family'] !== '' ) {
					switch ( $value['font-family'] ) {
						case Billey::PRIMARY_FONT:
							wp_enqueue_style( 'cerebri-sans-font', BILLEY_THEME_URI . '/assets/fonts/cerebri-sans/cerebri-sans.css', null, null );
							break;

						case Billey::SECONDARY_FONT:
							wp_enqueue_style( 'futura-font', BILLEY_THEME_URI . '/assets/fonts/futura/futura.css', null, null );
							break;

						default:
							do_action( 'billey_enqueue_custom_font', $value['font-family'] ); // hook to custom do enqueue fonts
							break;
					}
				}
			}
		}

		/**
		 * Add customize preview css
		 */
		public function customize_preview_css() {
			wp_enqueue_style( 'kirki-custom-css', BILLEY_THEME_URI . '/assets/admin/css/customizer.min.css' );
		}

		/**
		 * Load Customizer.
		 */
		public function load_customizer() {
			require_once BILLEY_CUSTOMIZER_DIR . '/customizer.php';
		}

		/**
		 * Remove unused native sections and controls
		 *
		 * @param WP_Customize_Manager $wp_customize
		 */
		public function remove_customizer_sections( $wp_customize ) {
			$wp_customize->remove_section( 'nav' );
			$wp_customize->remove_section( 'colors' );
			$wp_customize->remove_section( 'background_image' );
			$wp_customize->remove_section( 'header_image' );

			$wp_customize->get_section( 'title_tagline' )->priority = '100';

			$wp_customize->remove_control( 'blogdescription' );
			$wp_customize->remove_control( 'display_header_text' );
		}

		/**
		 * Build URL for customizer
		 *
		 * @param $value
		 * @param $setting
		 *
		 * @return mixed
		 */
		public function kirki_db_get_theme_mod_value( $value, $setting ) {
			if ( ! is_customize_preview() && ! empty( self::$override_settings ) && isset( self::$override_settings["{$setting}"] ) ) {
				return self::$override_settings["{$setting}"];
			}

			return $value;
		}

		function field_social_networks_enable( $args = array() ) {
			$defaults = array(
				'type'        => 'radio-buttonset',
				'label'       => esc_html__( 'Social Networks', 'billey' ),
				'description' => '<a href="javascript:wp.customize.section( \'socials\' ).focus();">' . esc_html__( 'Edit social network links', 'billey' ) . '</a>',
				'default'     => '0',
				'choices'     => array(
					'0' => esc_html__( 'Hide', 'billey' ),
					'1' => esc_html__( 'Show', 'billey' ),
				),
			);

			$args = wp_parse_args( $args, $defaults );

			Billey_Kirki::add_field( 'theme', $args );
		}

		function field_social_sharing_enable( $args = array() ) {
			$defaults = array(
				'type'        => 'radio-buttonset',
				'label'       => esc_html__( 'Sharing', 'billey' ),
				'description' => '<a href="javascript:wp.customize.section( \'social_sharing\' ).focus();">' . esc_html__( 'Edit social sharing list', 'billey' ) . '</a>',
				'choices'     => array(
					'0' => esc_html__( 'Hide', 'billey' ),
					'1' => esc_html__( 'Show', 'billey' ),
				),
			);

			$args = wp_parse_args( $args, $defaults );

			Billey_Kirki::add_field( 'theme', $args );
		}

		/**
		 * @param string $header_style Header Style
		 * @param string $prefix       Section Prefix
		 * @param int    $priority     Field priority
		 * @param string $section      Section Name
		 * @param array  $args         Custom setting per header style.
		 *
		 * @return int $priority
		 */
		function group_field_header_button( $header_style = '01', $prefix, $priority, $section, $args = array() ) {
			$defaults = [
				'text'    => '',
				'link'    => '',
				'target'  => '0',
				'rounded' => '',
				'style'   => 'thick-border',
				'classes' => '',
			];

			$args          = wp_parse_args( $args, $defaults );
			$output_prefix = ".header-{$header_style} ";

			Billey_Kirki::add_field( 'theme', array(
				'type'     => 'custom',
				'settings' => $prefix . 'group_title_' . $priority++,
				'section'  => $section,
				'priority' => $priority++,
				'default'  => '<div class="group_title">' . esc_html__( 'Header Button', 'billey' ) . '</div>',
			) );

			Billey_Kirki::add_field( 'theme', array(
				'type'     => 'text',
				'settings' => $prefix . 'button_text',
				'label'    => esc_html__( 'Button Text', 'billey' ),
				'default'  => $args['text'],
				'section'  => $section,
				'priority' => $priority++,
			) );

			Billey_Kirki::add_field( 'theme', array(
				'type'     => 'text',
				'settings' => $prefix . 'button_link',
				'label'    => esc_html__( 'Button Link', 'billey' ),
				'default'  => $args['link'],
				'section'  => $section,
				'priority' => $priority++,
			) );

			Billey_Kirki::add_field( 'theme', array(
				'type'     => 'text',
				'settings' => $prefix . 'button_link_rel',
				'label'    => esc_html__( 'Button Link Relationship (XFN)', 'billey' ),
				'section'  => $section,
				'priority' => $priority++,
			) );

			Billey_Kirki::add_field( 'theme', array(
				'type'     => 'radio-buttonset',
				'settings' => $prefix . 'button_link_target',
				'label'    => esc_html__( 'Open link in a new tab.', 'billey' ),
				'section'  => $section,
				'priority' => $priority++,
				'default'  => $args['target'],
				'choices'  => array(
					'0' => esc_html__( 'No', 'billey' ),
					'1' => esc_html__( 'Yes', 'billey' ),
				),
			) );

			Billey_Kirki::add_field( 'theme', array(
				'type'     => 'select',
				'settings' => $prefix . 'button_style',
				'label'    => esc_html__( 'Button Style', 'billey' ),
				'section'  => $section,
				'priority' => $priority++,
				'default'  => $args['style'],
				'choices'  => Billey_Header::instance()->get_button_style(),
			) );

			Billey_Kirki::add_field( 'theme', array(
				'type'     => 'text',
				'settings' => $prefix . 'button_rounded',
				'label'    => esc_html__( 'Button Rounded', 'billey' ),
				'section'  => $section,
				'priority' => $priority++,
				'default'  => $args['rounded'],
				'output'   => array(
					array(
						'element'  => $output_prefix . '.header-buttons .tm-button',
						'property' => 'border-radius',
					),
				),
			) );

			Billey_Kirki::add_field( 'theme', array(
				'type'     => 'text',
				'settings' => $prefix . 'button_classes',
				'label'    => esc_html__( 'Button Css Class', 'billey' ),
				'section'  => $section,
				'priority' => $priority++,
				'default'  => $args['classes'],
			) );

			return $priority;
		}

		function field_language_switcher_enable( $args = array() ) {
			$defaults = array(
				'type'        => 'radio-buttonset',
				'label'       => esc_html__( 'Language Switcher', 'billey' ),
				'description' => '',
				'choices'     => array(
					'0' => esc_html__( 'Hide', 'billey' ),
					'1' => esc_html__( 'Show', 'billey' ),
				),
				'default'     => '0',
			);

			$args = wp_parse_args( $args, $defaults );

			Billey_Kirki::add_field( 'theme', $args );
		}
	}

	Billey_Customize::instance()->initialize();
}
