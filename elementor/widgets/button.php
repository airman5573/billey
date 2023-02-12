<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;

defined( 'ABSPATH' ) || exit;

class Widget_Button extends Base {

	public function get_name() {
		return 'tm-button';
	}

	public function get_title() {
		return esc_html__( 'Advanced Button', 'billey' );
	}

	public function get_icon_part() {
		return 'eicon-button';
	}

	protected function _register_controls() {
		$this->add_button_settings_section();

		$this->add_button_badge_section();

		$this->add_wrapper_section();

		$this->add_skin_section();

		$this->add_text_style_section();

		$this->add_icon_style_section();

		$this->add_badge_style_section();
	}

	private function add_button_settings_section() {
		$this->start_controls_section( 'button_settings_section', [
			'label' => esc_html__( 'Button', 'billey' ),
		] );

		$this->add_control( 'style', [
			'label'   => esc_html__( 'Style', 'billey' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'flat',
			'options' => Widget_Utils::get_button_style(),
		] );

		$this->add_control( 'text', [
			'label'       => esc_html__( 'Text', 'billey' ),
			'type'        => Controls_Manager::TEXT,
			'dynamic'     => [
				'active' => true,
			],
			'default'     => esc_html__( 'Click here', 'billey' ),
			'placeholder' => esc_html__( 'Click here', 'billey' ),
		] );

		$this->add_control( 'icon', [
			'label'       => esc_html__( 'Icon', 'billey' ),
			'type'        => Controls_Manager::ICONS,
			'label_block' => true,
		] );

		$this->add_control( 'action', [
			'label'       => esc_html__( 'Action', 'billey' ),
			'description' => esc_html__( 'To make smooth scroll action work then input button link like this: #about-us-section.', 'billey' ),
			'type'        => Controls_Manager::SELECT,
			'default'     => '',
			'options'     => [
				''              => esc_html__( 'Normal', 'billey' ),
				'smooth_scroll' => esc_html__( 'Smooth scroll to a section', 'billey' ),
				'popup_video'   => esc_html__( 'Open Popup Video', 'billey' ),
			],
		] );

		$this->add_control( 'link', [
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

		$this->add_control( 'view', [
			'label'   => esc_html__( 'View', 'billey' ),
			'type'    => Controls_Manager::HIDDEN,
			'default' => 'traditional',
		] );

		$this->add_control( 'button_css_id', [
			'label'       => esc_html__( 'Button ID', 'billey' ),
			'type'        => Controls_Manager::TEXT,
			'dynamic'     => [
				'active' => true,
			],
			'default'     => '',
			'title'       => esc_html__( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'billey' ),
			'label_block' => false,
			'description' => wp_kses( __( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'billey' ), 'billey-default' ),
			'separator'   => 'before',
		] );

		$this->end_controls_section();
	}

	private function add_button_badge_section() {
		$this->start_controls_section( 'button_badge_section', [
			'label' => esc_html__( 'Badge', 'billey' ),
		] );

		$this->add_control( 'badge_text', [
			'label'       => esc_html__( 'Text', 'billey' ),
			'type'        => Controls_Manager::TEXT,
			'dynamic'     => [
				'active' => true,
			],
			'placeholder' => esc_html__( '$59', 'billey' ),
		] );

		$this->end_controls_section();
	}

	private function add_wrapper_section() {
		$this->start_controls_section( 'button_wrapper_section', [
			'label' => esc_html__( 'Wrapper', 'billey' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'alignment', [
			'label'        => esc_html__( 'Alignment', 'billey' ),
			'type'         => Controls_Manager::CHOOSE,
			'options'      => Widget_Utils::get_control_options_text_align(),
			'prefix_class' => 'elementor%s-align-',
			'default'      => '',
		] );

		$this->add_control( 'size', [
			'label'          => esc_html__( 'Size', 'billey' ),
			'type'           => Controls_Manager::SELECT,
			'default'        => 'nm',
			'options'        => [
				'xs' => esc_html__( 'Extra Small', 'billey' ),
				'sm' => esc_html__( 'Small', 'billey' ),
				'nm' => esc_html__( 'Normal', 'billey' ),
				'lg' => esc_html__( 'Large', 'billey' ),
			],
			'style_transfer' => true,
		] );

		$this->add_control( 'width', [
			'label'      => esc_html__( 'Width', 'billey' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ '%', 'px' ],
			'range'      => [
				'%'  => [
					'max'  => 100,
					'step' => 1,
				],
				'px' => [
					'max'  => 1000,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .tm-button' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'padding', [
			'label'      => esc_html__( 'Padding', 'billey' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .tm-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'rounded', [
			'label'      => esc_html__( 'Rounded', 'billey' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .tm-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}

	private function add_skin_section() {
		$this->start_controls_section( 'skin_section', [
			'label' => esc_html__( 'Skin', 'billey' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->start_controls_tabs( 'button_skin_tabs' );

		$this->start_controls_tab( 'button_skin_normal_tab', [
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
				'style!' => [ 'flat', 'text', 'text-left-line' ],
			],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'button_box_shadow',
			'selector' => '{{WRAPPER}} .tm-button',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'button_skin_hover_tab', [
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
				'style!' => [ 'flat', 'text', 'text-left-line' ],
			],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'button_hover_box_shadow',
			'selector' => '{{WRAPPER}} .tm-button:hover',
		] );

		$this->add_control( 'hover_animation', [
			'label' => esc_html__( 'Hover Animation', 'billey' ),
			'type'  => Controls_Manager::HOVER_ANIMATION,
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_text_style_section() {
		$this->start_controls_section( 'text_style_section', [
			'label' => esc_html__( 'Text', 'billey' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'text',
			'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
			'selector' => '{{WRAPPER}} .tm-button .button-text',
		] );

		$this->start_controls_tabs( 'text_style_tabs' );

		$this->start_controls_tab( 'text_style_normal_tab', [
			'label' => esc_html__( 'Normal', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'text',
			'selector' => '{{WRAPPER}} .tm-button .button-content-wrapper',
		] );

		$this->add_control( 'text_border_color', [
			'label'     => esc_html__( 'Border', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .tm-button.style-text .button-text:before'           => 'background: {{VALUE}};',
				'{{WRAPPER}} .tm-button.style-text-left-line .button-text:before' => 'background: {{VALUE}};',
			],
			'condition' => [
				'style' => [ 'text', 'text-left-line' ],
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'text_style_hover_tab', [
			'label' => esc_html__( 'Hover', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'hover_text',
			'selector' => '{{WRAPPER}} .tm-button:hover .button-content-wrapper',
		] );

		$this->add_control( 'hover_text_border_color', [
			'label'     => esc_html__( 'Border', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .tm-button.style-text .button-text:after'                => 'background: {{VALUE}};',
				'{{WRAPPER}} .tm-button.style-text-text-left-line .button-text:after' => 'background: {{VALUE}};',
			],
			'condition' => [
				'style' => [ 'text', 'text-left-line' ],
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_icon_style_section() {
		$this->start_controls_section( 'icon_section', [
			'label'     => esc_html__( 'Icon', 'billey' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'icon[value]!' => '',
			],
		] );

		$this->add_control( 'icon_align', [
			'label'   => esc_html__( 'Position', 'billey' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'left',
			'options' => [
				'left'  => esc_html__( 'Left', 'billey' ),
				'right' => esc_html__( 'Right', 'billey' ),
			],
		] );

		$this->add_control( 'icon_indent', [
			'label'     => esc_html__( 'Spacing', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 50,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .tm-button.icon-left .button-icon'  => 'margin-right: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .tm-button.icon-right .button-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'icon_font_size', [
			'label'     => esc_html__( 'Font Size', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 8,
					'max' => 30,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .tm-button .button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->start_controls_tabs( 'icon_skin_tabs' );

		$this->start_controls_tab( 'icon_skin_normal_tab', [
			'label' => esc_html__( 'Normal', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'icon',
			'selector' => '{{WRAPPER}} .tm-button .button-icon',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'icon_skin_hover_tab', [
			'label' => esc_html__( 'Hover', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'icon_hover',
			'selector' => '{{WRAPPER}} .tm-button:hover .button-icon',
		] );


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_badge_style_section() {
		$this->start_controls_section( 'badge_style_section', [
			'label'     => esc_html__( 'Badge', 'billey' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'badge_text!' => '',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'badge',
			'selector' => '{{WRAPPER}} .button-badge',
		] );

		$this->add_control( 'badge_text_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .button-badge' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'badge_background_color', [
			'label'     => esc_html__( 'Background', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .button-badge' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'badge_padding', [
			'label'      => esc_html__( 'Padding', 'billey' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .tm-button .button-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'badge_rounded', [
			'label'      => esc_html__( 'Rounded', 'billey' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .tm-button .button-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'tm-button-wrapper' );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'button', $settings['link'] );
			$this->add_render_attribute( 'button', 'class', 'tm-button-link' );
		}

		$this->add_render_attribute( 'button', 'class', 'tm-button' );
		$this->add_render_attribute( 'button', 'role', 'button' );

		if ( ! empty( $settings['button_css_id'] ) ) {
			$this->add_render_attribute( 'button', 'id', $settings['button_css_id'] );
		}

		if ( ! empty( $settings['style'] ) ) {
			$this->add_render_attribute( 'button', 'class', 'style-' . $settings['style'] );
		}

		if ( ! empty( $settings['size'] ) ) {
			$this->add_render_attribute( 'button', 'class', 'tm-button-' . $settings['size'] );
		}

		if ( ! empty( $settings['action'] ) ) {
			switch ( $settings['action'] ) {
				case 'smooth_scroll';
					$this->add_render_attribute( 'button', 'class', 'smooth-scroll-link' );
					break;
				case 'popup_video';
					$this->add_render_attribute( 'wrapper', 'class', 'tm-popup-video' );
					break;
			}
		}

		if ( ! empty( $settings['icon'] ) ) {
			$this->add_render_attribute( 'button', 'class', 'icon-' . $settings['icon_align'] );
		}

		if ( $settings['hover_animation'] ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['hover_animation'] );
		}

		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<a <?php $this->print_render_attribute_string( 'button' ); ?>>
				<?php $this->render_text(); ?>

				<?php $this->print_badge(); ?>
			</a>
		</div>
		<?php
	}

	private function print_badge() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['badge_text'] ) ) {
			return;
		}
		?>
		<div class="button-badge">
			<div class="badge-text"><?php echo esc_html( $settings['badge_text'] ); ?></div>
		</div>
		<?php
	}

	protected function _content_template() {
		// @formatter:off
		?>
		<#
		view.addRenderAttribute( 'text', 'class', 'button-text' );

		view.addInlineEditingAttributes( 'text', 'none' );

		var iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' );
		#>
		<div class="tm-button-wrapper">
			<a id="{{ settings.button_css_id }}"
			   class="tm-button style-{{ settings.style }} tm-button-{{ settings.size }} elementor-animation-{{ settings.hover_animation }} icon-{{ settings.icon_align }}"
			   href="{{ settings.link.url }}" role="button">
				<div class="button-content-wrapper">

					<# if ( iconHTML.rendered && settings.icon_align == 'left' ) { #>
					<span class="button-icon">
						{{{ iconHTML.value }}}
					</span>
					<# } #>

					<# if ( settings.text ) { #>
						<span {{{ view.getRenderAttributeString( 'text' ) }}}>{{{ settings.text }}}</span>
					<# } #>

					<# if ( iconHTML.rendered && settings.icon_align == 'right' ) { #>
					<span class="button-icon">
						{{{ iconHTML.value }}}
					</span>
					<# } #>

				</div>

				<# if( settings.badge_text ) { #>
					<div class="button-badge">
						<div class="badge-text">{{{ settings.badge_text }}}</div>
					</div>
				<# } #>
			</a>
		</div>
		<?php
		// @formatter:off
	}

	private function render_text() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( [
			'content-wrapper' => [
				'class' => 'button-content-wrapper',
			],
			'button-icon'      => [
				'class' => [
					'button-icon',
				],
			],
			'button-text'            => [
				'class' => 'button-text',
			],
		] );

		$this->add_inline_editing_attributes( 'text', 'none' );
		?>
		<div <?php $this->print_render_attribute_string( 'content-wrapper' ); ?>>
			<?php if ( ! empty( $settings['icon'] ) && $settings['icon_align'] === 'left' ) : ?>
				<span <?php $this->print_render_attribute_string( 'button-icon' ); ?>>
					<?php Icons_Manager::render_icon( $settings['icon'] ); ?>
				</span>
			<?php endif; ?>

			<?php if( ! empty( $settings['text']) ) : ?>
				<span <?php $this->print_render_attribute_string( 'button-text' ); ?>><?php echo esc_html( $settings['text'] ); ?></span>
			<?php endif; ?>

			<?php if ( ! empty( $settings['icon'] ) && $settings['icon_align'] === 'right' ) : ?>
				<span <?php $this->print_render_attribute_string( 'button-icon' ); ?>>
					<?php Icons_Manager::render_icon( $settings['icon'] ); ?>
				</span>
			<?php endif; ?>
		</div>
		<?php
	}
}
