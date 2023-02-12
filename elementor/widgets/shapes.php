<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes;

defined( 'ABSPATH' ) || exit;

class Widget_Shapes extends Base {

	public function get_name() {
		return 'tm-shapes';
	}

	public function get_title() {
		return esc_html__( 'Modern Shapes', 'billey' );
	}

	public function get_icon_part() {
		return 'eicon-favorite';
	}

	public function get_keywords() {
		return [ 'shapes' ];
	}

	protected function register_controls() {
		$this->add_content_section();
	}

	private function add_content_section() {
		$this->start_controls_section( 'content_section', [
			'label' => esc_html__( 'Shape', 'billey' ),
		] );

		$this->add_control( 'type', [
			'label'        => esc_html__( 'Type', 'billey' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => [
				'circle'        => esc_html__( 'Circle', 'billey' ),
				'border-circle' => esc_html__( 'Border Circle', 'billey' ),
				'distortion'    => esc_html__( 'Distortion 01', 'billey' ),
				'distortion-02' => esc_html__( 'Distortion 02', 'billey' ),
				'distortion-03' => esc_html__( 'Distortion 03', 'billey' ),
				'distortion-04' => esc_html__( 'Distortion 04', 'billey' ),
			],
			'default'      => 'circle',
			'prefix_class' => 'billey-shape-',
			'render_type'  => 'template',
		] );

		$this->add_responsive_control( 'shape_size', [
			'label'     => esc_html__( 'Size', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 5,
					'max' => 500,
				],
			],
			'default'   => [
				'unit' => 'px',
				'size' => 50,
			],
			'selectors' => [
				'{{WRAPPER}} .shape' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} svg'    => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'shape_border_size', [
			'label'     => esc_html__( 'Border', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 1,
					'max' => 50,
				],
			],
			'default'   => [
				'unit' => 'px',
				'size' => 3,
			],
			'selectors' => [
				'{{WRAPPER}} .shape' => 'border-width: {{SIZE}}{{UNIT}};',
			],
			'condition' => [
				'type' => [ 'border-circle' ],
			],
		] );

		$this->add_control( 'shape_rotate', [
			'label'      => esc_html__( 'Rotate', 'billey' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'deg' ],
			'range'      => [
				'deg' => [
					'min'  => -360,
					'max'  => 360,
					'step' => 1,
				],
			],
			'default'    => [
				'unit' => 'deg',
			],
			'selectors'  => [
				'{{WRAPPER}} .billey-shape' => 'transform: rotate({{SIZE}}{{UNIT}});',
			],
		] );

		$this->add_control( 'shape_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .shape'            => 'color: {{VALUE}};',
				'{{WRAPPER}} .billey-shape-fill' => 'fill: {{VALUE}};',
			],
			'scheme'    => [
				'type'  => Schemes\Color::get_type(),
				'value' => Schemes\Color::COLOR_1,
			],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'box', 'class', 'billey-shape' );
		?>
		<div <?php $this->print_render_attribute_string( 'box' ) ?>>
			<?php if ( $this->is_svg_shape( $settings['type'] ) ): ?>
				<?php echo \Billey_Helper::get_file_contents( BILLEY_THEME_DIR . '/assets/modern-shapes/' . $settings['type'] . '.svg' ); ?>
			<?php else: ?>
				<div class="shape"></div>
			<?php endif; ?>
		</div>
		<?php
	}

	private function is_svg_shape( $type ) {
		if ( in_array( $type, [
			'distortion',
			'distortion-02',
			'distortion-03',
			'distortion-04',
		], true ) ) {
			return true;
		}

		return false;
	}
}
