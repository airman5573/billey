<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit;

abstract class Grid_Base extends Base {

	abstract protected function print_grid_items( array $settings );

	protected function _register_controls() {
		$this->start_controls_section( 'grid_options_section', [
			'label' => esc_html__( 'Grid Options', 'billey' ),
		] );

		$this->add_responsive_control( 'grid_columns', [
			'label'          => esc_html__( 'Columns', 'billey' ),
			'type'           => Controls_Manager::NUMBER,
			'min'            => 1,
			'max'            => 12,
			'step'           => 1,
			'default'        => 3,
			'tablet_default' => 2,
			'mobile_default' => 1,
			'selectors'      => [
				'{{WRAPPER}} .modern-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
			],
		] );

		$this->add_responsive_control( 'grid_column_gutter', [
			'label'     => esc_html__( 'Column Gutter', 'billey' ),
			'type'      => Controls_Manager::NUMBER,
			'min'       => 0,
			'max'       => 200,
			'step'      => 1,
			'default'   => 30,
			'selectors' => [
				'{{WRAPPER}} .modern-grid' => 'grid-column-gap: {{VALUE}}px;',
			],
		] );

		$this->add_responsive_control( 'grid_row_gutter', [
			'label'     => esc_html__( 'Row Gutter', 'billey' ),
			'type'      => Controls_Manager::NUMBER,
			'min'       => 0,
			'max'       => 200,
			'step'      => 1,
			'default'   => 30,
			'selectors' => [
				'{{WRAPPER}} .modern-grid' => 'grid-row-gap: {{VALUE}}px;',
			],
		] );

		$this->add_responsive_control( 'grid_content_position', [
			'label'                => esc_html__( 'Content Position', 'billey' ),
			'type'                 => Controls_Manager::SELECT,
			'default'              => '',
			'options'              => [
				''       => esc_html__( 'Default', 'billey' ),
				'top'    => esc_html__( 'Top', 'billey' ),
				'middle' => esc_html__( 'Middle', 'billey' ),
				'bottom' => esc_html__( 'Bottom', 'billey' ),
			],
			'selectors_dictionary' => [
				'top'    => 'flex-start',
				'middle' => 'center',
				'bottom' => 'flex-end',
			],
			'selectors'            => [
				'{{WRAPPER}} .modern-grid .grid-item' => 'align-items: {{VALUE}}',
			],
			'render_type'          => 'template',
		] );

		$this->add_responsive_control( 'grid_content_alignment', [
			'label'                => esc_html__( 'Content Alignment', 'billey' ),
			'type'                 => Controls_Manager::SELECT,
			'default'              => '',
			'options'              => [
				''       => esc_html__( 'Default', 'billey' ),
				'left'   => esc_html__( 'Left', 'billey' ),
				'center' => esc_html__( 'Center', 'billey' ),
				'right'  => esc_html__( 'Right', 'billey' ),
			],
			'selectors_dictionary' => [
				'left'  => 'flex-start',
				'right' => 'flex-end',
			],
			'selectors'            => [
				'{{WRAPPER}} .modern-grid .grid-item' => 'justify-content: {{VALUE}}',
			],
			'render_type'          => 'template',
		] );

		$this->add_responsive_control( 'grid_content_padding', [
			'label'      => esc_html__( 'Item Padding', 'billey' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'separator'  => 'after',
		] );

		$this->end_controls_section();
	}

	protected function print_grid( array $settings = null ) {
		if ( null === $settings ) {
			$settings = $this->get_active_settings();
		}

		$this->add_render_attribute( 'grid', 'class', 'modern-grid' );

		if ( ! empty( $settings['grid_content_position'] ) || ! empty( $settings['grid_content_alignment'] ) ) {
			$this->add_render_attribute( 'grid', 'class', 'flex-item' );
		}
		?>

		<div <?php $this->print_render_attribute_string( 'grid' ); ?>>
			<?php $this->print_grid_items( $settings ); ?>
		</div>
		<?php
	}
}
