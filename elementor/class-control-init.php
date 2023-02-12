<?php

namespace Billey_Elementor;

defined( 'ABSPATH' ) || exit;

class Control_Init {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function initialize() {
		require_once BILLEY_ELEMENTOR_DIR . '/class-font-awesome-pro.php';
		require_once BILLEY_ELEMENTOR_DIR . '/class-font-elementor.php';

		/**
		 * Register Controls.
		 */
		add_action( 'elementor/controls/controls_registered', array( $this, 'init_controls' ) );

		/**
		 * Edit Controls.
		 */
		// Add custom Motion Effect - Entrance Animation.
		add_filter( 'elementor/controls/animations/additional_animations', [
			$this,
			'add_custom_entrance_animations',
		] );

		/**
		 * Add custom shape divider
		 */
		add_filter( 'elementor/shapes/additional_shapes', [ $this, 'add_custom_shape_divider' ] );
	}

	public function add_custom_shape_divider( $additional_shapes ) {
		$additional_shapes['curve-alt'] = [
			'title'        => esc_html__( 'Curve Alt', 'billey' ),
			'has_negative' => true,
			'height_only'  => true,
			'url'          => get_template_directory_uri() . '/assets/shape-divider/curve-alt.svg',
			'path'         => get_template_directory() . '/assets/shape-divider/curve-alt.svg',
		];

		return $additional_shapes;
	}

	public function add_custom_entrance_animations( $animations ) {
		$animations['By Billey'] = [
			'billeyFadeInUp' => 'Billey - Fade In Up',
		];

		return $animations;
	}

	/**
	 * @param \Elementor\Controls_Manager $controls_manager
	 *
	 * Include controls files and register them
	 */
	public function init_controls( $controls_manager ) {
		// Include controls files.
		// require_once BILLEY_ELEMENTOR_DIR . '/controls/autocomplete.php';
		require_once BILLEY_ELEMENTOR_DIR . '/controls/choose2.php';
		require_once BILLEY_ELEMENTOR_DIR . '/controls/group-control-text-gradient.php';
		require_once BILLEY_ELEMENTOR_DIR . '/controls/group-control-text-stroke.php';
		require_once BILLEY_ELEMENTOR_DIR . '/controls/group-control-advanced-border.php';

		// Normal Control.
		// $controls_manager->register_control( 'autocomplete', new Control_Autocomplete() );
		$controls_manager->register_control( 'choose2', new Control_Choose2() );

		// Group Control.
		$controls_manager->add_group_control( Group_Control_Text_Gradient::get_type(), new Group_Control_Text_Gradient() );
		$controls_manager->add_group_control( Group_Control_Text_Stroke::get_type(), new Group_Control_Text_Stroke() );
		$controls_manager->add_group_control( Group_Control_Advanced_Border::get_type(), new Group_Control_Advanced_Border() );
	}
}

Control_Init::instance()->initialize();
