<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;

defined( 'ABSPATH' ) || exit;

class Widget_Line_Chart extends Chart_Base {

	public function get_name() {
		return 'tm-line-chart';
	}

	public function get_title() {
		return esc_html__( 'Line Chart', 'billey' );
	}

	public function get_keywords() {
		return [ 'chart', 'graphic', 'line' ];
	}

	protected function _register_controls() {
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

		$repeater->add_control( 'fill', [
			'label'       => esc_html__( 'Area Filling', 'billey' ),
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => false,
			'default'     => 'none',
			'options'     => [
				'none'   => [
					'title' => esc_html__( 'None', 'billey' ),
					'icon'  => 'eicon-ban',
				],
				'custom' => [
					'title' => esc_html__( 'Custom', 'billey' ),
					'icon'  => 'eicon-paint-brush',
				],
			],
		] );

		$repeater->add_control( 'fill_color', [
			'label'     => esc_html__( 'Fill Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'condition' => [
				'fill' => 'custom',
			],
		] );

		$repeater->add_control( 'point_style', [
			'label'   => esc_html__( 'Point Style', 'billey' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'none'     => esc_html__( 'None', 'billey' ),
				'circle'   => esc_html__( 'Circle', 'billey' ),
				'triangle' => esc_html__( 'Triangle', 'billey' ),
				'rect'     => esc_html__( 'Rectangle', 'billey' ),
				'rectRot'  => esc_html__( 'Rotated Rectangle', 'billey' ),
				'cross'    => esc_html__( 'Cross', 'billey' ),
				'crossRot' => esc_html__( 'Rotated Cross', 'billey' ),
				'star'     => esc_html__( 'Star', 'billey' ),
			],
			'default' => 'circle',
		] );

		$repeater->add_control( 'line_type', [
			'label'   => esc_html__( 'Line type', 'billey' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'normal' => esc_html__( 'Normal', 'billey' ),
				'step'   => esc_html__( 'Stepped', 'billey' ),
			],
			'default' => 'normal',
		] );

		$repeater->add_control( 'line_style', [
			'label'   => esc_html__( 'Line Style', 'billey' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'solid'  => esc_html__( 'Solid', 'billey' ),
				'dashed' => esc_html__( 'Dashed', 'billey' ),
				'dotted' => esc_html__( 'Dotted', 'billey' ),
			],
			'default' => 'solid',
		] );

		$repeater->add_control( 'thickness', [
			'label'       => esc_html__( 'Thickness', 'billey' ),
			'description' => esc_html__( 'Line and points thickness', 'billey' ),
			'type'        => Controls_Manager::SELECT,
			'options'     => [
				'thin'    => esc_html__( 'Thin', 'billey' ),
				'normal'  => esc_html__( 'Normal', 'billey' ),
				'thick'   => esc_html__( 'Thick', 'billey' ),
				'thicker' => esc_html__( 'Thicker', 'billey' ),
			],
			'default'     => 'normal',
		] );

		$repeater->add_control( 'line_tension', [
			'label'       => esc_html__( 'Line Tension', 'billey' ),
			'description' => esc_html__( 'Tension of the line ( 100 for a straight line )', 'billey' ),
			'type'        => Controls_Manager::NUMBER,
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
			'default'     => 10,
		] );

		$this->add_control( 'datasets', [
			'label'       => esc_html__( 'Datasets', 'billey' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'title'        => esc_html__( 'Item 01', 'billey' ),
					'values'       => '15; 10; 22; 19; 23; 17',
					'color'        => 'rgba(105, 59, 255, 0.55)',
					'fill'         => 'none',
					'thickness'    => 'normal',
					'point_style'  => 'circle',
					'line_style'   => 'solid',
					'line_tension' => 10,
				],
				[
					'title'        => esc_html__( 'Item 02', 'billey' ),
					'values'       => '34; 38; 35; 33; 37; 40',
					'color'        => 'rgba(0, 110, 253, 0.56)',
					'fill'         => 'none',
					'thickness'    => 'normal',
					'point_style'  => 'circle',
					'line_style'   => 'solid',
					'line_tension' => 10,
				],
			],
			'title_field' => '{{{ title }}}',
		] );

		$this->end_controls_section();
	}

	private function print_chart_options() {
		$settings = $this->get_settings_for_display();
		$datasets = $settings['datasets'];

		$labels = $this->parse_chart_values( $settings['chart_labels'] );

		$sets = [];

		$_thickness = [
			'thin'    => [
				'borderWidth'           => 1,
				'pointRadius'           => 3,
				'pointHitRadius'        => 3,
				'pointBorderWidth'      => 1,
				'pointHoverRadius'      => 5,
				'pointHoverBorderWidth' => 1,
			],
			'normal'  => [
				'borderWidth'           => 2,
				'pointRadius'           => 4,
				'pointHitRadius'        => 3,
				'pointBorderWidth'      => 1,
				'pointHoverRadius'      => 5,
				'pointHoverBorderWidth' => 1,
			],
			'thick'   => [
				'borderWidth'           => 3,
				'pointRadius'           => 5,
				'pointHitRadius'        => 3,
				'pointBorderWidth'      => 1,
				'pointHoverRadius'      => 6,
				'pointHoverBorderWidth' => 1,
			],
			'thicker' => [
				'borderWidth'           => 4,
				'pointRadius'           => 6,
				'pointHitRadius'        => 3,
				'pointBorderWidth'      => 1,
				'pointHoverRadius'      => 6,
				'pointHoverBorderWidth' => 1,
			],
		];

		$_borderDash = [
			'solid'  => [],
			'dashed' => [ 16, 8 ],
			'dotted' => [ 3, 3 ],
		];

		foreach ( $datasets as $set ) {
			if ( empty( $set['title'] ) || empty( $set['values'] ) ) {
				continue;
			}

			$line_tension = isset( $set['line_tension'] ) ? $set['line_tension'] : 10;
			$line_style   = isset( $set['line_style'] ) ? $set['line_style'] : 'solid';
			$line_step    = isset( $set['line_type'] ) && $set['line_type'] === 'step' ? true : false;
			$thickness    = isset( $set['thickness'] ) ? $set['thickness'] : 'normal';
			$base_color   = $set['color'];
			$fill         = isset( $set['fill'] ) && $set['fill'] !== 'none' ? true : false;

			$fill_color = isset( $set['fill_color'] ) && $set['fill_color'] !== '' ? $set['fill_color'] : $base_color;

			$values = $this->parse_chart_values( $set['values'] );

			$_set = array(
				'label'                 => $set['title'],
				'fill'                  => $fill,
				'backgroundColor'       => $fill_color,
				'borderColor'           => $set['color'],
				'borderCapStyle'        => 'butt',
				'borderDash'            => $_borderDash[ $line_style ],
				'borderDashOffset'      => 0,
				'borderJoinStyle'       => 'miter',
				'spanGaps'              => false,
				'showLine'              => true,
				'steppedLine'           => $line_step,
				'pointStyle'            => $set['point_style'],
				'pointBorderWidth'      => 0,
				'pointHoverRadius'      => 1,
				'pointHoverBorderWidth' => 0,
				'hidden'                => false,
				'lineTension'           => ( 100 - absint( $line_tension ) ) * 0.37 / 100,
				'data'                  => $values,
			);

			$_set = wp_parse_args( $_thickness[ $thickness ], $_set );

			if ( $set['point_style'] === 'none' ) {
				$_extra = [
					'borderColor'           => 'rgba(0, 0, 0, 0)',
					'pointStyle'            => 'circle',
					'borderWidth'           => 0,
					'pointRadius'           => 0,
					'pointHitRadius'        => 0,
					'pointBorderWidth'      => 0,
					'pointHoverRadius'      => 0,
					'pointHoverBorderWidth' => 0,
				];

				$_set = wp_parse_args( $_extra, $_set );
			}

			$sets[] = $_set;
		}

		$data = [
			'labels'   => $labels,
			'datasets' => $sets,
		];

		$options = array(
			'animation'           => array(
				'duration' => 2000,
			),
			'maintainAspectRatio' => true,
			'tooltips'            => array(
				'enabled'      => true,
				'mode'         => 'index',
				'intersect'    => false,
				'bodySpacing'  => 8,
				'titleSpacing' => 6,
				'cornerRadius' => 8,
				'xPadding'     => 10,
			),
			'legend'              => array(
				'display'  => ! empty( $settings['chart_legend_show'] ) ? true : false,
				'position' => $settings['chart_legend_position'],
				'labels'   => [
					'usePointStyle' => ( 'point' == $settings['chart_legend_style'] ) ? true : false,
					'padding'       => 20,
					'boxWidth'      => 16,
				],
			),
			'scales'              => [
				'yAxes' => [
					[
						'display'    => true,
						'scaleLabel' => [
							'display'     => true,
							'fontColor'   => '#ff0000',
							'fontSize'    => 16,
							'beginAtZero' => true,
						],
						'gridLines'  => [
							'color'         => '#ebebeb',
							'zeroLineColor' => '#ebebeb',
						],
					],
				],
			],
		);

		if ( empty( $settings['chart_legend_onclick'] ) ) {
			$options['legend']['onClick'] = null;
		}

		$chart_options = array(
			'type'    => 'line',
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

		$this->add_render_attribute( 'wrapper', 'class', 'billey-js-chart billey-line-chart' );

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
