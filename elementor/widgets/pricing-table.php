<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || exit;

class Widget_Pricing_Table extends Base {

	public function get_name() {
		return 'tm-pricing-table';
	}

	public function get_title() {
		return esc_html__( 'Modern Pricing', 'billey' );
	}

	public function get_icon_part() {
		return 'eicon-price-table';
	}

	public function get_keywords() {
		return [ 'modern', 'pricing', 'table' ];
	}

	protected function register_controls() {
		$this->add_layout_section();

		$this->add_header_section();

		$this->add_pricing_section();

		$this->add_features_section();

		$this->add_footer_section();

		$this->add_ribbon_section();

		$this->add_box_style_section();

		$this->add_header_style_section();

		$this->add_footer_style_section();
	}

	private function add_layout_section() {
		$this->start_controls_section( 'layout_section', [
			'label' => esc_html__( 'Layout', 'billey' ),
		] );

		$this->add_control( 'style', [
			'label'        => esc_html__( 'Style', 'billey' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => [
				'01' => esc_html__( '01', 'billey' ),
				'02' => esc_html__( '02', 'billey' ),
				'03' => esc_html__( '03', 'billey' ),
			],
			'default'      => '01',
			'prefix_class' => 'billey-pricing-style-',
		] );

		$this->end_controls_section();
	}

	private function add_header_section() {
		$this->start_controls_section( 'header_section', [
			'label' => esc_html__( 'Header', 'billey' ),
		] );

		$this->add_control( 'heading', [
			'label'   => esc_html__( 'Title', 'billey' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'Enter your title', 'billey' ),
		] );

		$this->add_control( 'sub_heading', [
			'label' => esc_html__( 'Description', 'billey' ),
			'type'  => Controls_Manager::TEXT,
		] );

		$this->add_control( 'heading_tag', [
			'label'   => esc_html__( 'Heading Tag', 'billey' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'h2' => 'H2',
				'h3' => 'H3',
				'h4' => 'H4',
				'h5' => 'H5',
				'h6' => 'H6',
			],
			'default' => 'h3',
		] );

		$this->end_controls_section();
	}

	private function add_pricing_section() {
		$this->start_controls_section( 'pricing_section', [
			'label' => esc_html__( 'Pricing', 'billey' ),
		] );

		$this->add_control( 'currency', [
			'label'   => esc_html__( 'Currency', 'billey' ),
			'type'    => Controls_Manager::TEXT,
			'default' => '$',
		] );

		$this->add_control( 'price', [
			'label'   => esc_html__( 'Price', 'billey' ),
			'type'    => Controls_Manager::TEXT,
			'default' => '39.99',
		] );

		$this->add_control( 'period', [
			'label'   => esc_html__( 'Period', 'billey' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'Monthly', 'billey' ),
		] );

		$this->end_controls_section();
	}

	private function add_features_section() {
		$this->start_controls_section( 'features_section', [
			'label' => esc_html__( 'Features', 'billey' ),
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'text', [
			'label'       => esc_html__( 'Text', 'billey' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Text', 'billey' ),
			'label_block' => true,
		] );

		$repeater->add_control( 'icon', [
			'label' => esc_html__( 'Icon', 'billey' ),
			'type'  => Controls_Manager::ICONS,
		] );

		$this->add_control( 'features', [
			/*'label'       => esc_html__( 'Features', 'billey' ),
			'show_label'  => false,*/
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'text' => esc_html__( 'List Item #1', 'billey' ),
				],
				[
					'text' => esc_html__( 'List Item #2', 'billey' ),
				],
				[
					'text' => esc_html__( 'List Item #3', 'billey' ),
				],
			],
			'title_field' => '{{{ elementor.helpers.renderIcon( this, icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}} {{{ text }}}',
		] );

		$this->end_controls_section();
	}

	private function add_footer_section() {
		$this->start_controls_section( 'footer_section', [
			'label' => esc_html__( 'Footer', 'billey' ),
		] );

		$this->add_control( 'button_style', [
			'label'   => esc_html__( 'Style', 'billey' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'flat',
			'options' => Widget_Utils::get_button_style(),
		] );

		$this->add_control( 'button_text', [
			'label'   => esc_html__( 'Button Text', 'billey' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'Get Started', 'billey' ),
		] );

		$this->add_control( 'button_link', [
			'label'       => esc_html__( 'Link', 'billey' ),
			'type'        => Controls_Manager::URL,
			'dynamic'     => [
				'active' => true,
			],
			'placeholder' => esc_attr__( 'https://your-link.com', 'billey' ),
			'default'     => [
				'url' => '#',
			],
		] );

		$this->end_controls_section();
	}

	private function add_ribbon_section() {
		$this->start_controls_section( 'ribbon_section', [
			'label' => esc_html__( 'Ribbon', 'billey' ),
		] );

		$this->add_control( 'show_ribbon', [
			'label' => esc_html__( 'Show', 'billey' ),
			'type'  => Controls_Manager::SWITCHER,
		] );

		$this->add_control( 'ribbon_style', [
			'label'        => esc_html__( 'Style', 'billey' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => [
				'01' => esc_html__( 'Normal', 'billey' ),
				'02' => esc_html__( 'Circle', 'billey' ),
			],
			'default'      => '01',
			'prefix_class' => 'billey-pricing-ribbon-style-',
		] );

		$this->add_control( 'ribbon_title', [
			'label'     => esc_html__( 'Title', 'billey' ),
			'type'      => Controls_Manager::TEXT,
			'default'   => esc_html__( 'Popular', 'billey' ),
			'condition' => [
				'show_ribbon' => 'yes',
			],
		] );

		$this->end_controls_section();
	}

	private function add_box_style_section() {
		$this->start_controls_section( 'box_style_section', [
			'label' => esc_html__( 'Box', 'billey' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'box_padding', [
			'label'      => esc_html__( 'Padding', 'billey' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .billey-pricing .inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'box_background',
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .billey-pricing .inner',
		] );

		$this->add_group_control( Group_Control_Advanced_Border::get_type(), [
			'name'     => 'box_border',
			'selector' => '{{WRAPPER}} .billey-pricing .inner',
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'box_shadow',
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .billey-pricing .inner',
		] );

		$this->end_controls_section();
	}

	private function add_header_style_section() {
		$this->start_controls_section( 'header_style_section', [
			'label' => esc_html__( 'Header', 'billey' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'title_heading', [
			'label' => esc_html__( 'Title', 'billey' ),
			'type'  => Controls_Manager::HEADING,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => esc_html__( 'Typography', 'billey' ),
			'selector' => '{{WRAPPER}} .title',
		] );

		$this->add_control( 'title_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .title' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'description_heading', [
			'label'     => esc_html__( 'Description', 'billey' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'description_typography',
			'label'    => esc_html__( 'Typography', 'billey' ),
			'selector' => '{{WRAPPER}} .description',
		] );

		$this->add_control( 'description_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .description' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'header_line_heading', [
			'label'     => esc_html__( 'Bottom Line', 'billey' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'header_line_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .billey-pricing-body' => 'border-color: {{VALUE}};',
			],
		] );

		$this->end_controls_section();
	}

	private function add_footer_style_section() {
		$this->start_controls_section( 'footer_style_section', [
			'label' => esc_html__( 'Footer', 'billey' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'button_style_heading', [
			'label' => esc_html__( 'Button', 'billey' ),
			'type'  => Controls_Manager::HEADING,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'button_typography',
			'selector' => '{{WRAPPER}} .tm-button',
		] );

		$this->start_controls_tabs( 'button_style_tabs' );

		$this->start_controls_tab( 'button_style_normal_tab', [
			'label' => esc_html__( 'Normal', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'button',
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .tm-button:before',
		] );

		$this->add_control( 'button_border_color', [
			'label'     => esc_html__( 'Border', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .tm-button' => 'border-color: {{VALUE}};',
			],
			'condition' => [
				'button_style!' => [ 'flat', 'text', 'text-left-line' ],
			],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'button_box_shadow',
			'selector' => '{{WRAPPER}} .tm-button',
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'text',
			'selector' => '{{WRAPPER}} .tm-button .button-content-wrapper',
		] );

		$this->add_control( 'button_special_line_color', [
			'label'     => esc_html__( 'Line', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .tm-button.style-text .button-text:before'           => 'background: {{VALUE}};',
				'{{WRAPPER}} .tm-button.style-text-left-line .button-text:before' => 'background: {{VALUE}};',
			],
			'condition' => [
				'button_style' => [ 'text', 'text-left-line' ],
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'button_style_hover_tab', [
			'label' => esc_html__( 'Hover', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'button_hover',
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .tm-button:after',
		] );

		$this->add_control( 'button_hover_border_color', [
			'label'     => esc_html__( 'Border', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .tm-button:hover' => 'border-color: {{VALUE}};',
			],
			'condition' => [
				'button_style!' => [ 'flat', 'text', 'text-left-line' ],
			],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'button_hover_box_shadow',
			'selector' => '{{WRAPPER}} .tm-button:hover',
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'button_hover_text',
			'selector' => '{{WRAPPER}} .tm-button:hover .button-content-wrapper',
		] );

		$this->add_control( 'button_hover_special_line_color', [
			'label'     => esc_html__( 'Border', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .tm-button.style-text .button-text:after'                => 'background: {{VALUE}};',
				'{{WRAPPER}} .tm-button.style-text-text-left-line .button-text:after' => 'background: {{VALUE}};',
			],
			'condition' => [
				'button_style' => [ 'text', 'text-left-line' ],
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'billey-pricing' );

		$this->add_render_attribute( 'heading', 'class', 'title' );
		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<div class="inner">

				<?php $this->print_pricing_ribbon(); ?>

				<div class="billey-pricing-header">
					<?php if ( ! empty( $settings['heading'] ) ) : ?>
						<div class="heading-wrap">
							<?php printf( '<%1$s %2$s>%3$s</%1$s>', $settings['heading_tag'], $this->get_render_attribute_string( 'heading' ), $settings['heading'] ); ?>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $settings['sub_heading'] ) ) : ?>
						<div class="sub-heading-wrap">
							<?php echo esc_html( $settings['sub_heading'] ); ?>
						</div>
					<?php endif; ?>
				</div>

				<?php $this->print_pricing(); ?>

				<div class="billey-pricing-body">
					<?php if ( $settings['features'] && count( $settings['features'] ) > 0 ) { ?>
						<ul class="billey-pricing-features">
							<?php foreach ( $settings['features'] as $item ) {
								$item_key = 'item_' . $item['_id'];
								$this->add_render_attribute( $item_key, 'class', 'item' );
								?>
								<li>
									<?php if ( ! empty( $item['icon']['value'] ) ) { ?>
										<div class="billey-icon icon">
											<?php $this->render_icon( $settings, $item['icon'], [ 'aria-hidden' => 'true' ], false, 'icon' ); ?>
										</div>
									<?php } ?>
									<?php echo wp_kses( $item['text'], 'billey-default' ); ?>
								</li>
							<?php } ?>
						</ul>
					<?php } ?>
				</div>

				<?php $this->print_pricing_footer(); ?>

			</div>
		</div>
		<?php
	}

	private function print_pricing_ribbon() {
		$settings = $this->get_settings_for_display();

		if ( 'yes' !== $settings['show_ribbon'] || empty( $settings['ribbon_title'] ) ) {
			return;
		}
		?>
		<div class="billey-pricing-ribbon">
			<span><?php echo esc_html( $settings['ribbon_title'] ); ?></span>
		</div>
		<?php
	}

	private function print_pricing() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['price'] ) ) {
			return;
		}
		?>
		<div class="price-wrap">
			<div class="price-wrap-inner">

				<?php if ( ! empty( $settings['currency'] ) ) : ?>
					<div class="billey-pricing-currency"><?php echo esc_html( $settings['currency'] ); ?></div>
				<?php endif; ?>

				<div class="billey-pricing-price"><?php echo esc_html( $settings['price'] ); ?></div>

				<?php if ( ! empty( $settings['period'] ) && '02' !== $settings['style'] ) : ?>
					<div class="billey-pricing-period"><?php echo esc_html( $settings['period'] ); ?></div>
				<?php endif; ?>
			</div>

			<?php if ( ! empty( $settings['period'] ) && '02' === $settings['style'] ) : ?>
				<div class="billey-pricing-period"><?php echo esc_html( $settings['period'] ); ?></div>
			<?php endif; ?>
		</div>
		<?php
	}

	private function print_pricing_footer() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['button_text'] ) || empty( $settings['button_link'] ) ) {
			return;
		}

		$this->add_render_attribute( 'button', 'class', 'billey-pricing-button tm-button' );
		$this->add_render_attribute( 'button', 'class', 'style-' . $settings['button_style'] );
		$this->add_link_attributes( 'button', $settings['button_link'] );
		?>
		<div class="billey-pricing-footer">
			<div class="tm-button-wrapper">
				<a <?php $this->print_render_attribute_string( 'button' ); ?>>
					<div class="button-content-wrapper">
						<span class="button-text">
							<?php echo esc_html( $settings['button_text'] ); ?>
						</span>
					</div>
				</a>
			</div>
		</div>
		<?php
	}
}
