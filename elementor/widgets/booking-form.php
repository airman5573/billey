<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit;

class Widget_Booking_Form extends Base {

	public function get_name() {
		return 'tm-booking-form';
	}

	public function get_title() {
		return esc_html__( 'Booking Form', 'billey' );
	}

	public function get_icon_part() {
		return 'eicon-form-horizontal';
	}

	public function get_keywords() {
		return [ 'booking', 'form' ];
	}

	public function get_script_depends() {
		return [
			'bos_main_js',
			'bos_date_js',
		];
	}

	public function get_style_depends() {
		return [ 'bos_sb_main_css' ];
	}

	protected function register_controls() {
		$this->start_controls_section( 'layout_section', [
			'label' => esc_html__( 'Layout', 'billey' ),
		] );

		$this->add_control( 'title_show', [
			'label'     => esc_html__( 'Title', 'billey' ),
			'type'      => Controls_Manager::SWITCHER,
			'selectors' => [
				'{{WRAPPER}} .search-box-title-1' => 'display: none',
			],
		] );

		$this->add_control( 'logo_show', [
			'label'     => esc_html__( 'Logo', 'billey' ),
			'type'      => Controls_Manager::SWITCHER,
			'selectors' => [
				'{{WRAPPER}} #b_logo' => 'display: none',
			],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$type = 'bos_searchbox_widget';

		global $wp_widget_factory;
		if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
			ob_start();
			the_widget( $type );
			$output = ob_get_clean();

			echo '<div class="billey-booking-form">' . $output . '</div>';
		}
	}
}
