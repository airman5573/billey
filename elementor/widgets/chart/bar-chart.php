<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;

defined( 'ABSPATH' ) || exit;

class Widget_Bar_Chart extends Chart_Base {

	public function get_name() {
		return 'tm-bar-chart';
	}

	public function get_title() {
		return esc_html__( 'Bar Chart', 'billey' );
	}

	public function get_keywords() {
		return [ 'chart', 'graphic', 'bar', 'column' ];
	}

	protected function register_controls() {
		$this->add_chart_section();

		$this->add_chart_legend_section();
	}

	private function add_chart_section() {
		$this->start_controls_section( 'chart_section', [
			'label' => esc_html__( 'Chart', 'billey' ),
		] );

		$this->add_control( 'chart_labels', [
			'label'       => esc_html__( 'X axis labels', 'billey' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => 'Jul; Aug; Sep; Oct; Nov; Dec',
			'label_block' => true,
		] );

		$this->add_control( 'chart_direction', [
			'label'       => esc_html__( 'Direction', 'billey' ),
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => false,
			'toggle'      => false,
			'default'     => 'vertical',
			'options'     => [
				'vertical'   => [
					'title' => esc_html__( 'Vertical', 'billey' ),
					'icon'  => 'eicon-arrow-up',
				],
				'horizontal' => [
					'title' => esc_html__( 'Horizontal', 'billey' ),
					'icon'  => 'eicon-arrow-right',
				],
			],
		] );

		$this->add_control( 'border_width', [
			'label'       => esc_html__( 'Border Width', 'billey' ),
			'description' => esc_html__( 'Border width of the bars', 'billey' ),
			'type'        => Controls_Manager::NUMBER,
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
			'default'     => 0,
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'title', [
			'label'       => esc_html__( 'Title', 'billey' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Title', 'billey' ),
			'label_block' => true,
		] );

		$repeater->add_control( 'values', [
			'label'       => esc_html__( 'Values', 'billey' ),
			'description' => esc_html__( 'Text format for the tooltip (available placeholders: {d} dataset title, {x} X axis label, {y} Y axis value)', 'billey' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
		] );

		$repeater->add_control( 'color', [
			'label' => esc_html__( 'Color', 'billey' ),
			'type'  => Controls_Manager::COLOR,
		] );

		$repeater->add_control( 'fill_color', [
			'label' => esc_html__( 'Fill Color', 'billey' ),
			'type'  => Controls_Manager::COLOR,
		] );

		$repeater->add_control( 'border_color', [
			'label' => esc_html__( 'Border Color', 'billey' ),
			'type'  => Controls_Manager::COLOR,
		] );

		$this->add_control( 'datasets', [
			'label'       => esc_html__( 'Datasets', 'billey' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'title'  => esc_html__( 'Item 01', 'billey' ),
					'values' => '15; 35; 22; 19; 23; 17',
					'color'  => 'rgba(105, 59, 255, 1)',
				],
				[
					'title'  => esc_html__( 'Item 02', 'billey' ),
					'values' => '34; 38; 35; 33; 37; 40',
					'color'  => 'rgba(0, 110, 253, 1)',
				],
			],
			'title_field' => '{{{ title }}}',
		] );

		$this->end_controls_section();
	}

	private function print_chart_options() {
		$settings = $this->get_settings_for_display();
		$datasets = $settings['datasets'];

		$labels       = $this->parse_chart_values( $settings['chart_labels'] );
		$sets         = [];
		$border_width = ! empty( $settings['border_width'] ) ? intval( $settings['border_width'] ) : 0;

		foreach ( $datasets as $set ) {
			if ( empty( $set['title'] ) || empty( $set['values'] ) ) {
				continue;
			}

			$base_color   = ! empty( $set['color'] ) ? $set['color'] : 'rgba(0, 0, 0, 0.8)';
			$fill_color   = ! empty( $set['fill_color'] ) ? $set['fill_color'] : $base_color;
			$border_color = ! empty( $set['border_color'] ) ? $set['border_color'] : $base_color;

			$values = $this->parse_chart_values( $set['values'] );

			$_set = array(
				'label'           => $set['title'],
				'backgroundColor' => $fill_color,
				'borderColor'     => $border_color,
				'data'            => $values,
				'borderWidth'     => $border_width,
			);

			$sets[] = $_set;
		}

		$data = [
			'labels'   => $labels,
			'datasets' => $sets,
		];

		$options = [
			'animation'           => [ 'duration' => 2000 ],
			'maintainAspectRatio' => true,
			'tooltips'            => [
				'enabled'      => true,
				'mode'         => 'index',
				'intersect'    => false,
				'bodySpacing'  => 8,
				'titleSpacing' => 6,
				'cornerRadius' => 8,
				'xPadding'     => 10,
			],
			'legend'              => [
				'display'  => ! empty( $settings['chart_legend_show'] ) ? true : false,
				'position' => $settings['chart_legend_position'],
				'labels'   => [
					'usePointStyle' => ( 'point' == $settings['chart_legend_style'] ) ? true : false,
					'padding'       => 20,
					'boxWidth'      => 16,
				],
			],
			'scales'              => [
				'yAxes' => [
					[
						'ticks'     => [
							'fontColor'   => '111',
							'fontSize'    => 16,
							'beginAtZero' => true,
						],
						'gridLines' => [
							'color'         => '#ebebeb',
							'zeroLineColor' => '#ebebeb',
						],
					],
				],
			],
		];

		if ( empty( $settings['chart_legend_onclick'] ) ) {
			$options['legend']['onClick'] = null;
		}

		$type = 'bar';

		if ( 'horizontal' === $settings['chart_direction'] ) {
			$type = 'horizontalBar';
		}

		$chart_options = array(
			'type'    => $type,
			'data'    => $data,
			'options' => $options,
		);

		echo json_encode( $chart_options );
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['chart_labels'] ) ) {
			return;
		}

		if ( empty( $settings['datasets'] ) ) {
			return;
		}

		$this->add_render_attribute( 'wrapper', 'class', 'billey-js-chart billey-bar-chart' );

		$chart_height = $this->get_chart_aspect_ratio();

		$this->add_render_attribute( 'canvas', [
			'width'  => 500,
			'height' => $chart_height,
		] );
		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<div class="chart-data" style="display:none;"><?php $this->print_chart_options(); ?></div>
			<canvas <?php $this->print_render_attribute_string( 'canvas' ); ?>></canvas>
		</div>
		<?php
	}
}
