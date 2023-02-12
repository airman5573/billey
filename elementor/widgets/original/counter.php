<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit;

class Modify_Widget_Counter extends Modify_Base {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function initialize() {
		add_action( 'elementor/element/counter/section_title/before_section_end', [
			$this,
			'before_section_title_end',
		] );
	}

	/**
	 * @param \Elementor\Widget_Base $element The edited element.
	 */
	public function before_section_title_end( $element ) {
		$element->add_responsive_control( 'title_margin', [
			'label'      => esc_html__( 'Margin', 'billey' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .elementor-counter .elementor-counter-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$element->add_responsive_control( 'align', [
			'label'     => esc_html__( 'Text Align', 'billey' ),
			'type'      => Controls_Manager::SELECT,
			'options' => [
				'flex-end' => 'left',
				'flex-start' => 'right',
				'center' => 'center',
			],
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .elementor-counter' => 'justify-content: {{VALUE}};display: flex;flex-direction: row-reverse;',
			],
			'condition'   => [
				'style' => '02' ,
			],
		] );
		$element->add_control( 'style', [
			'label'   => esc_html__( 'Style', 'billey' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'01' => 'default',
				'02' => 'inline',
			],
			'default' => '01',
		] );
	}
}

Modify_Widget_Counter::instance()->initialize();
