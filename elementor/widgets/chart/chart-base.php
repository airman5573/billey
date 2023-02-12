<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit;

abstract class Chart_Base extends Base {

	public function get_script_depends() {
		return [ 'billey-group-widget-chart' ];
	}

	protected function add_chart_legend_section() {
		$this->start_controls_section( 'chart_legend_section', [
			'label' => esc_html__( 'Chart Legend', 'billey' ),
		] );

		$this->add_control( 'chart_legend_show', [
			'label'        => esc_html__( 'Show Legends', 'billey' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => '1',
			'default'      => '1',
		] );

		$this->add_control( 'chart_legend_style', [
			'label'   => esc_html__( 'Style', 'billey' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'normal' => esc_html__( 'Normal', 'billey' ),
				'point'  => esc_html__( 'Use Point Style', 'billey' ),
			],
			'default' => 'normal',
		] );

		$this->add_control( 'chart_legend_position', [
			'label'   => esc_html__( 'Position', 'billey' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'top'    => esc_html__( 'Top', 'billey' ),
				'right'  => esc_html__( 'Right', 'billey' ),
				'bottom' => esc_html__( 'Bottom', 'billey' ),
				'left'   => esc_html__( 'Left', 'billey' ),
			],
			'default' => 'bottom',
		] );

		$this->add_control( 'chart_legend_onclick', [
			'label'        => esc_html__( 'Click on legends', 'billey' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => '1',
			'default'      => '1',
		] );

		$this->add_control( 'chart_legend_aspect_ratio', [
			'label'   => esc_html__( 'Aspect Ratio', 'billey' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'1:1'  => '1:1',
				'21:9' => '21:9',
				'16:9' => '16:9',
				'4:3'  => '4:3',
				'3:4'  => '3:4',
				'9:16' => '9:16',
				'9:21' => '9:21',
			],
			'default' => '4:3',
		] );

		$this->end_controls_section();
	}

	/**
	 * @param int $width canvas width
	 *
	 * @return float|int
	 */
	protected function get_chart_aspect_ratio( $width = 500 ) {
		$ar = $this->get_settings_for_display( 'chart_legend_aspect_ratio' );
		$AR = explode( ':', $ar );

		$rat1 = $AR[0];
		$rat2 = $AR[1];

		$height = ( $width / $rat1 ) * $rat2;

		return $height;
	}

	/**
	 * @param string $values multi values separate with ';'
	 *
	 * @return array List of values
	 */
	protected function parse_chart_values( $values ) {
		$values = preg_replace( '/\s+/', '', $values );

		$values = explode( ';', $values );

		return $values;
	}
}
