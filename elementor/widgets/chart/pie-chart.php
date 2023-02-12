<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;

defined( 'ABSPATH' ) || exit;

class Widget_Pie_Chart extends Chart_Base {

	public function get_name() {
		return 'tm-pie-chart';
	}

	public function get_title() {
		return esc_html__( 'Pie Chart', 'billey' );
	}

	public function get_keywords() {
		return [ 'chart', 'graphic', 'pie' ];
	}

	protected function _register_controls() {
		$this->add_chart_section();

		$this->add_chart_legend_section();
	}

	private function add_chart_section() {
		$this->start_controls_section( 'chart_section', [
			'label' => esc_html__( 'Chart', 'billey' ),
		] );

		$this->add_control( 'cutout', [
			'label'       => esc_html__( 'Cutting Percentage', 'billey' ),
			'description' => esc_html__( 'Amount of the inner surface to be cut off (0 for pie and 80 for example for a doughnut)', 'billey' ),
			'type'        => Controls_Manager::NUMBER,
			'min'         => 0,
			'max'         => 95,
			'step'        => 1,
			'default'     => 0,
		] );

		$this->add_control( 'border_width', [
			'label'       => esc_html__( 'Border Width', 'billey' ),
			'description' => esc_html__( 'Border width of the arcs in the dataset', 'billey' ),
			'type'        => Controls_Manager::NUMBER,
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
			'default'     => 0,
		] );

		$this->add_control( 'border_color', [
			'label'     => esc_html__( 'Border Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'condition' => [
				'border_width!' => '',
			],
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'title', [
			'label'       => esc_html__( 'Title', 'billey' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Title', 'billey' ),
			'label_block' => true,
		] );

		$repeater->add_control( 'value', [
			'label'       => esc_html__( 'Value', 'billey' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
		] );

		$repeater->add_control( 'color', [
			'label' => esc_html__( 'Color', 'billey' ),
			'type'  => Controls_Manager::COLOR,
		] );

		$this->add_control( 'datasets', [
			'label'       => esc_html__( 'Datasets', 'billey' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'title' => esc_html__( 'Item 01', 'billey' ),
					'value' => '25',
					'color' => '#75dfaa',
				],
				[
					'title' => esc_html__( 'Item 02', 'billey' ),
					'value' => '40',
					'color' => '#6b6cfe',
				],
				[
					'title' => esc_html__( 'Item 03', 'billey' ),
					'value' => '35',
					'color' => '#71aefe',
				],
			],
			'title_field' => '{{{ title }}}',
		] );

		$this->end_controls_section();
	}

	private function print_chart_options() {
		$settings = $this->get_settings_for_display();
		$datasets = $settings['datasets'];

		$labels       = [];
		$border_width = ! empty( $settings['border_width'] ) ? intval( $settings['border_width'] ) : 0;
		$border_color = ! empty( $settings['border_color'] ) ? $settings['border_width'] : 'rgba(0, 0, 0, 0)';
		$cutout       = ! empty( $settings['cutout'] ) ? intval( $settings['cutout'] ) : 0;
		$sets         = [
			'backgroundColor'      => [],
			'hoverBackgroundColor' => [],
			'data'                 => [],
			'borderWidth'          => $border_width,
			'borderColor'          => $border_color,
		];

		foreach ( $datasets as $set ) {
			if ( empty( $set['title'] ) || empty( $set['value'] ) ) {
				continue;
			}

			$labels[] = $set['title'];

			$sets['backgroundColor'][]      = $set['color'];
			$sets['hoverBackgroundColor'][] = $set['color'];
			$sets['data'][]                 = $set['value'];
		}

		$data = [
			'labels'   => $labels,
			'datasets' => [ $sets ],
		];

		$options = array(
			'animation'           => [
				'duration' => 2000,
			],
			'maintainAspectRatio' => true,
			'cutoutPercentage'    => intval( $cutout ),
			'tooltips'            => [
				'enabled'         => true,
				'bodySpacing'     => 8,
				'titleSpacing'    => 6,
				'cornerRadius'    => 8,
				'xPadding'        => 10,
				'footerFontSize'  => 15,
				'footerFontColor' => '#111',
			],
			'legend'              => [
				'display'  => false,
				'position' => $settings['chart_legend_position'],
				'labels'   => [
					'usePointStyle' => true,
					'padding'       => 16,
					'boxWidth'      => 16,
					'fontSize'      => 15,
				],
			],
		);

		$chart_options = [
			'type'    => 'pie',
			'data'    => $data,
			'options' => $options,
		];

		echo json_encode( $chart_options );
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['datasets'] ) ) {
			return;
		}

		$this->add_render_attribute( 'wrapper', 'class', 'billey-js-chart billey-pie-chart' );

		if ( ! empty( $settings['chart_legend_show'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'legends-' . $settings['chart_legend_position'] );
			$this->add_render_attribute( 'wrapper', 'data-legend-enable', '1' );
		}

		if ( ! empty( $settings['chart_legend_onclick'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'legends-clickable' );
			$this->add_render_attribute( 'wrapper', 'data-legend-clickable', '1' );
		}

		$chart_height = $this->get_chart_aspect_ratio();

		$this->add_render_attribute( 'canvas', [
			'width'  => 500,
			'height' => $chart_height,
		] );
		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<div class="chart-data" style="display:none;"><?php $this->print_chart_options(); ?></div>

			<div class="chart-wrap">
				<?php if ( ! empty( $settings['chart_legend_show'] ) && in_array( $settings['chart_legend_position'], [
						'left',
						'top',
					] ) )  : ?>
					<div class="chart-legends"></div>
				<?php endif; ?>

				<div class="chart-canvas">
					<canvas <?php $this->print_render_attribute_string( 'canvas' ); ?>></canvas>
				</div>

				<?php if ( ! empty( $settings['chart_legend_show'] ) && in_array( $settings['chart_legend_position'], [
						'right',
						'bottom',
					] ) )  : ?>
					<div class="chart-legends"></div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
