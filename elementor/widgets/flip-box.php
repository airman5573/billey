<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Utils;
use Elementor\Icons_Manager;

defined( 'ABSPATH' ) || exit;

class Widget_Flip_Box extends Base {

	public function get_name() {
		return 'tm-flip-box';
	}

	public function get_title() {
		return esc_html__( 'Advanced Flip Box', 'billey' );
	}

	public function get_icon_part() {
		return 'eicon-flip-box';
	}

	public function get_script_depends() {
		return [ 'billey-widget-flip-box' ];
	}

	protected function _register_controls() {
		// Content Tab.
		$this->add_front_side_content_section();

		$this->add_back_side_content_section();

		$this->add_box_settings_section();

		// Style Tab - Front Side.
		$this->add_front_side_box_style_section();

		$this->add_front_side_image_style_section();

		$this->add_front_side_icon_style_section();

		$this->add_front_side_heading_style_section();

		$this->add_front_side_description_style_section();

		// Style Tab - Back Side.
		$this->add_back_side_box_style_section();

		$this->add_back_side_image_style_section();

		$this->add_back_side_icon_style_section();

		$this->add_back_side_heading_style_section();

		$this->add_back_side_description_style_section();

		$this->add_back_side_button_style_section();
	}

	private function add_front_side_content_section() {
		$this->start_controls_section( 'content_front_side_section', [
			'label' => esc_html__( 'Front', 'billey' ),
		] );

		$this->start_controls_tabs( 'side_a_content_tabs' );

		$this->start_controls_tab( 'side_a_content_tab', [ 'label' => esc_html__( 'Content', 'billey' ) ] );

		$this->add_control( 'graphic_element_a', [
			'label'       => esc_html__( 'Graphic Element', 'billey' ),
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => false,
			'options'     => [
				'none'  => [
					'title' => esc_html__( 'None', 'billey' ),
					'icon'  => 'eicon-ban',
				],
				'image' => [
					'title' => esc_html__( 'Image', 'billey' ),
					'icon'  => 'fa fa-picture-o',
				],
				'icon'  => [
					'title' => esc_html__( 'Icon', 'billey' ),
					'icon'  => 'eicon-star',
				],
			],
			'default'     => 'icon',
		] );

		$this->add_control( 'image_a', [
			'label'     => esc_html__( 'Choose Image', 'billey' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => Utils::get_placeholder_image_src(),
			],
			'dynamic'   => [
				'active' => true,
			],
			'condition' => [
				'graphic_element_a' => 'image',
			],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'image_a', // Actually its `image_a_size`
			'default'   => 'thumbnail',
			'condition' => [
				'graphic_element_a' => 'image',
			],
		] );

		$this->add_control( 'icon_a', [
			'label'     => esc_html__( 'Icon', 'billey' ),
			'type'      => Controls_Manager::ICONS,
			'default'   => [
				'value'   => 'fas fa-star',
				'library' => 'fa-solid',
			],
			'condition' => [
				'graphic_element_a' => 'icon',
			],
		] );

		$this->add_control( 'title_text_a', [
			'label'       => esc_html__( 'Title', 'billey' ),
			'label_block' => true,
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'This is the heading', 'billey' ),
			'placeholder' => esc_html__( 'Enter your title', 'billey' ),
			'dynamic'     => [
				'active' => true,
			],
		] );

		$this->add_control( 'description_text_a', [
			'label'       => esc_html__( 'Description', 'billey' ),
			'label_block' => true,
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'billey' ),
			'placeholder' => esc_html__( 'Enter your description', 'billey' ),
			'separator'   => 'none',
			'dynamic'     => [
				'active' => true,
			],
			'rows'        => 10,
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'side_a_background_tab', [ 'label' => esc_html__( 'Background', 'billey' ) ] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'background_a',
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .front-side',
		] );

		$this->add_control( 'background_overlay_a', [
			'label'     => esc_html__( 'Background Overlay', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .front-side .overlay' => 'background-color: {{VALUE}};',
			],
			'separator' => 'before',
			'condition' => [
				'background_a_image[id]!' => '',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_back_side_content_section() {
		$this->start_controls_section( 'content_back_side_section', [
			'label' => esc_html__( 'Back', 'billey' ),
		] );

		$this->start_controls_tabs( 'side_b_content_tabs' );

		$this->start_controls_tab( 'side_b_content_tab', [ 'label' => esc_html__( 'Content', 'billey' ) ] );

		$this->add_control( 'graphic_element_b', [
			'label'       => esc_html__( 'Graphic Element', 'billey' ),
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => false,
			'options'     => [
				'none'  => [
					'title' => esc_html__( 'None', 'billey' ),
					'icon'  => 'eicon-ban',
				],
				'image' => [
					'title' => esc_html__( 'Image', 'billey' ),
					'icon'  => 'fa fa-picture-o',
				],
				'icon'  => [
					'title' => esc_html__( 'Icon', 'billey' ),
					'icon'  => 'eicon-star',
				],
			],
			'default'     => 'icon',
		] );

		$this->add_control( 'image_b', [
			'label'     => esc_html__( 'Choose Image', 'billey' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => Utils::get_placeholder_image_src(),
			],
			'dynamic'   => [
				'active' => true,
			],
			'condition' => [
				'graphic_element_b' => 'image',
			],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'image_b', // Actually its `image_b_size`
			'default'   => 'thumbnail',
			'condition' => [
				'graphic_element_b' => 'image',
			],
		] );

		$this->add_control( 'icon_b', [
			'label'     => esc_html__( 'Icon', 'billey' ),
			'type'      => Controls_Manager::ICONS,
			'default'   => [
				'value'   => 'fas fa-star',
				'library' => 'fa-solid',
			],
			'condition' => [
				'graphic_element_b' => 'icon',
			],
		] );

		$this->add_control( 'title_text_b', [
			'label'       => esc_html__( 'Title', 'billey' ),
			'label_block' => true,
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'This is the heading', 'billey' ),
			'placeholder' => esc_html__( 'Enter your title', 'billey' ),
			'dynamic'     => [
				'active' => true,
			],
		] );

		$this->add_control( 'description_text_b', [
			'label'       => esc_html__( 'Description', 'billey' ),
			'label_block' => true,
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'billey' ),
			'placeholder' => esc_html__( 'Enter your description', 'billey' ),
			'separator'   => 'none',
			'dynamic'     => [
				'active' => true,
			],
			'rows'        => 10,
		] );

		$this->add_control( 'button_heading', [
			'label'     => esc_html__( 'Button', 'billey' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'button_style', [
			'label'   => esc_html__( 'Button Style', 'billey' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'text',
			'options' => Widget_Utils::get_button_style(),
		] );

		$this->add_control( 'button_text', [
			'label'   => esc_html__( 'Button Text', 'billey' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'Click Here', 'billey' ),
			'dynamic' => [
				'active' => true,
			],
		] );

		$this->add_control( 'button_icon', [
			'label'       => esc_html__( 'Button Icon', 'billey' ),
			'type'        => Controls_Manager::ICONS,
			'label_block' => true,
		] );

		$this->add_control( 'button_icon_align', [
			'label'     => esc_html__( 'Icon Position', 'billey' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'left',
			'options'   => [
				'left'  => esc_html__( 'Left', 'billey' ),
				'right' => esc_html__( 'Right', 'billey' ),
			],
			'condition' => [
				'button_icon[value]!' => '',
			],
		] );

		$this->add_control( 'link', [
			'label'       => esc_html__( 'Link', 'billey' ),
			'type'        => Controls_Manager::URL,
			'dynamic'     => [
				'active' => true,
			],
			'placeholder' => esc_html__( 'https://your-link.com', 'billey' ),
		] );

		$this->add_control( 'link_click', [
			'label'     => esc_html__( 'Apply Link On', 'billey' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [
				'box'    => esc_html__( 'Whole Box', 'billey' ),
				'button' => esc_html__( 'Button Only', 'billey' ),
			],
			'default'   => 'button',
			'condition' => [
				'link[url]!' => '',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'side_b_background_tab', [ 'label' => esc_html__( 'Background', 'billey' ) ] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'background_b',
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .back-side',
		] );

		$this->add_control( 'background_overlay_b', [
			'label'     => esc_html__( 'Background Overlay', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .back-side .overlay' => 'background-color: {{VALUE}};',
			],
			'separator' => 'before',
			'condition' => [
				'background_b_image[id]!' => '',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_box_settings_section() {
		$this->start_controls_section( 'section_box_settings', [
			'label' => esc_html__( 'Settings', 'billey' ),
		] );

		$this->add_responsive_control( 'min_height', [
			'label'      => esc_html__( 'Min Height', 'billey' ),
			'type'       => Controls_Manager::SLIDER,
			'range'      => [
				'px' => [
					'min' => 100,
					'max' => 1000,
				],
			],
			'size_units' => [ 'px' ],
			'selectors'  => [
				'{{WRAPPER}} .billey-flip-box' => 'min-height: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'border_radius', [
			'label'      => esc_html__( 'Border Radius', 'billey' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 200,
				],
			],
			'separator'  => 'after',
			'selectors'  => [
				'{{WRAPPER}} .layer, {{WRAPPER}} .overlay' => 'border-radius: {{SIZE}}{{UNIT}}',
			],
		] );

		$this->add_control( 'flip_effect', [
			'label'        => esc_html__( 'Flip Effect', 'billey' ),
			'type'         => Controls_Manager::SELECT,
			'default'      => 'flip',
			'options'      => [
				'flip'     => 'Flip',
				'slide'    => 'Slide',
				'push'     => 'Push',
				'zoom-in'  => 'Zoom In',
				'zoom-out' => 'Zoom Out',
				'fade'     => 'Fade',
			],
			'prefix_class' => 'billey-flip-box--effect-',
		] );

		$this->add_control( 'flip_direction', [
			'label'        => esc_html__( 'Flip Direction', 'billey' ),
			'type'         => Controls_Manager::SELECT,
			'default'      => 'up',
			'options'      => [
				'left'  => esc_html__( 'Left', 'billey' ),
				'right' => esc_html__( 'Right', 'billey' ),
				'up'    => esc_html__( 'Up', 'billey' ),
				'down'  => esc_html__( 'Down', 'billey' ),
			],
			'condition'    => [
				'flip_effect!' => [
					'fade',
					'zoom-in',
					'zoom-out',
				],
			],
			'prefix_class' => 'billey-flip-box--direction-',
		] );

		$this->add_control( 'flip_3d', [
			'label'        => esc_html__( '3D Depth', 'billey' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'On', 'billey' ),
			'label_off'    => esc_html__( 'Off', 'billey' ),
			'return_value' => 'billey-flip-box--3d',
			'default'      => '',
			'prefix_class' => '',
			'condition'    => [
				'flip_effect' => 'flip',
			],
		] );

		$this->end_controls_section();
	}

	private function add_front_side_box_style_section() {
		$this->start_controls_section( 'box_style_front_side_section', [
			'label' => esc_html__( 'Front - Box', 'billey' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'padding_a', [
			'label'      => esc_html__( 'Padding', 'billey' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .front-side .layer-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'alignment_a', [
			'label'       => esc_html__( 'Alignment', 'billey' ),
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => false,
			'options'     => [
				'left'   => [
					'title' => esc_html__( 'Left', 'billey' ),
					'icon'  => 'eicon-text-align-left',
				],
				'center' => [
					'title' => esc_html__( 'Center', 'billey' ),
					'icon'  => 'eicon-text-align-center',
				],
				'right'  => [
					'title' => esc_html__( 'Right', 'billey' ),
					'icon'  => 'eicon-text-align-right',
				],
			],
			'selectors'   => [
				'{{WRAPPER}} .front-side' => 'text-align: {{VALUE}}',
			],
		] );

		$this->add_control( 'vertical_position_a', [
			'label'                => esc_html__( 'Vertical Position', 'billey' ),
			'type'                 => Controls_Manager::CHOOSE,
			'label_block'          => false,
			'options'              => [
				'top'    => [
					'title' => esc_html__( 'Top', 'billey' ),
					'icon'  => 'eicon-v-align-top',
				],
				'middle' => [
					'title' => esc_html__( 'Middle', 'billey' ),
					'icon'  => 'eicon-v-align-middle',
				],
				'bottom' => [
					'title' => esc_html__( 'Bottom', 'billey' ),
					'icon'  => 'eicon-v-align-bottom',
				],
			],
			'selectors_dictionary' => [
				'top'    => 'flex-start',
				'middle' => 'center',
				'bottom' => 'flex-end',
			],
			'selectors'            => [
				'{{WRAPPER}} .front-side .layer-inner' => 'align-items: {{VALUE}}',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'      => 'border_a',
			'selector'  => '{{WRAPPER}} .front-side',
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'box_shadow_a',
			'selector' => '{{WRAPPER}} .front-side',
		] );

		$this->end_controls_section();
	}

	private function add_front_side_image_style_section() {
		$this->start_controls_section( 'image_style_front_side_section', [
			'label'     => esc_html__( 'Front - Image', 'billey' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'graphic_element_a' => 'image',
			],
		] );

		$this->add_control( 'image_spacing_a', [
			'label'     => esc_html__( 'Spacing', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .front-side .image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'image_width_a', [
			'label'      => esc_html__( 'Size', 'billey' ) . ' (%)',
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ '%' ],
			'default'    => [
				'unit' => '%',
			],
			'range'      => [
				'%' => [
					'min' => 5,
					'max' => 100,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .front-side .image img' => 'width: {{SIZE}}{{UNIT}}',
			],
		] );

		$this->add_control( 'image_opacity_a', [
			'label'     => esc_html__( 'Opacity', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max'  => 1,
					'min'  => 0.10,
					'step' => 0.01,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .front-side .image' => 'opacity: {{SIZE}};',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'      => 'image_border_a',
			'selector'  => '{{WRAPPER}} .front-side .image img',
			'separator' => 'before',
		] );

		$this->add_control( 'image_border_radius_a', [
			'label'     => esc_html__( 'Border Radius', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 200,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .front-side .image img' => 'border-radius: {{SIZE}}{{UNIT}}',
			],
		] );

		$this->end_controls_section();
	}

	private function add_front_side_icon_style_section() {
		$this->start_controls_section( 'icon_style_front_side_section', [
			'label'     => esc_html__( 'Front - Icon', 'billey' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'graphic_element_a' => 'icon',
			],
		] );

		$this->add_control( 'icon_spacing_a', [
			'label'     => esc_html__( 'Spacing', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .front-side .billey-icon-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'icon_a',
			'selector' => '{{WRAPPER}} .front-side .icon',
		] );

		$this->add_responsive_control( 'icon_size_a', [
			'label'     => esc_html__( 'Size', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 6,
					'max' => 300,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .front-side .billey-icon-view, {{WRAPPER}} .front-side .billey-icon' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'icon_rotate_a', [
			'label'     => esc_html__( 'Rotate', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'unit' => 'deg',
			],
			'selectors' => [
				'{{WRAPPER}} .front-side .billey-icon' => 'transform: rotate({{SIZE}}{{UNIT}});',
			],
		] );

		$this->end_controls_section();
	}

	private function add_front_side_heading_style_section() {
		$this->start_controls_section( 'heading_style_front_side_section', [
			'label'     => esc_html__( 'Front - Heading', 'billey' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'title_text_a!' => '',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_a',
			'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .front-side .heading',
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'title_a',
			'selector' => '{{WRAPPER}} .front-side .heading',
		] );

		$this->end_controls_section();
	}

	private function add_front_side_description_style_section() {
		$this->start_controls_section( 'description_style_front_side_section', [
			'label'     => esc_html__( 'Front - Description', 'billey' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'description_text_a!' => '',
			],
		] );

		$this->add_control( 'description_spacing_a', [
			'label'     => esc_html__( 'Spacing', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .front-side .description-wrap' => 'margin-top: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'description_a',
			'scheme'   => Schemes\Typography::TYPOGRAPHY_3,
			'selector' => '{{WRAPPER}} .front-side .description',
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'description_a',
			'selector' => '{{WRAPPER}} .front-side .description',
		] );

		$this->end_controls_section();
	}

	private function add_back_side_box_style_section() {
		$this->start_controls_section( 'box_style_back_side_section', [
			'label' => esc_html__( 'Back - Box', 'billey' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'padding_b', [
			'label'      => esc_html__( 'Padding', 'billey' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .back-side .layer-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'alignment_b', [
			'label'       => esc_html__( 'Alignment', 'billey' ),
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => false,
			'options'     => [
				'left'   => [
					'title' => esc_html__( 'Left', 'billey' ),
					'icon'  => 'eicon-text-align-left',
				],
				'center' => [
					'title' => esc_html__( 'Center', 'billey' ),
					'icon'  => 'eicon-text-align-center',
				],
				'right'  => [
					'title' => esc_html__( 'Right', 'billey' ),
					'icon'  => 'eicon-text-align-right',
				],
			],
			'selectors'   => [
				'{{WRAPPER}} .back-side' => 'text-align: {{VALUE}}',
			],
		] );

		$this->add_control( 'vertical_position_b', [
			'label'                => esc_html__( 'Vertical Position', 'billey' ),
			'type'                 => Controls_Manager::CHOOSE,
			'label_block'          => false,
			'options'              => [
				'top'    => [
					'title' => esc_html__( 'Top', 'billey' ),
					'icon'  => 'eicon-v-align-top',
				],
				'middle' => [
					'title' => esc_html__( 'Middle', 'billey' ),
					'icon'  => 'eicon-v-align-middle',
				],
				'bottom' => [
					'title' => esc_html__( 'Bottom', 'billey' ),
					'icon'  => 'eicon-v-align-bottom',
				],
			],
			'selectors_dictionary' => [
				'top'    => 'flex-start',
				'middle' => 'center',
				'bottom' => 'flex-end',
			],
			'selectors'            => [
				'{{WRAPPER}} .back-side .layer-inner' => 'align-items: {{VALUE}}',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'      => 'border_b',
			'selector'  => '{{WRAPPER}} .back-side',
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'box_shadow_b',
			'selector' => '{{WRAPPER}} .back-side',
		] );

		$this->end_controls_section();
	}

	private function add_back_side_image_style_section() {
		$this->start_controls_section( 'image_style_back_side_section', [
			'label'     => esc_html__( 'Back - Image', 'billey' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'graphic_element_b' => 'image',
			],
		] );

		$this->add_control( 'image_spacing_b', [
			'label'     => esc_html__( 'Spacing', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .back-side .image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'image_width_b', [
			'label'      => esc_html__( 'Size', 'billey' ) . ' (%)',
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ '%' ],
			'default'    => [
				'unit' => '%',
			],
			'range'      => [
				'%' => [
					'min' => 5,
					'max' => 100,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .back-side .image img' => 'width: {{SIZE}}{{UNIT}}',
			],
		] );

		$this->add_control( 'image_opacity_b', [
			'label'     => esc_html__( 'Opacity', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max'  => 1,
					'min'  => 0.10,
					'step' => 0.01,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .back-side .image' => 'opacity: {{SIZE}};',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'      => 'image_border_b',
			'selector'  => '{{WRAPPER}} .back-side .image img',
			'separator' => 'before',
		] );

		$this->add_control( 'image_border_radius_b', [
			'label'     => esc_html__( 'Border Radius', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 200,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .back-side .image img' => 'border-radius: {{SIZE}}{{UNIT}}',
			],
		] );

		$this->end_controls_section();
	}

	private function add_back_side_icon_style_section() {
		$this->start_controls_section( 'icon_style_back_side_section', [
			'label'     => esc_html__( 'Back - Icon', 'billey' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'graphic_element_b' => 'icon',
			],
		] );

		$this->add_control( 'icon_spacing_b', [
			'label'     => esc_html__( 'Spacing', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .back-side .billey-icon-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'icon_b',
			'selector' => '{{WRAPPER}} .back-side .icon',
		] );

		$this->add_responsive_control( 'icon_size_b', [
			'label'     => esc_html__( 'Size', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 6,
					'max' => 300,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .back-side .billey-icon-view, {{WRAPPER}} .back-side .billey-icon' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'icon_rotate_b', [
			'label'     => esc_html__( 'Rotate', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'unit' => 'deg',
			],
			'selectors' => [
				'{{WRAPPER}} .back-side .billey-icon' => 'transform: rotate({{SIZE}}{{UNIT}});',
			],
		] );

		$this->end_controls_section();
	}

	private function add_back_side_heading_style_section() {
		$this->start_controls_section( 'heading_style_back_side_section', [
			'label'     => esc_html__( 'Back - Heading', 'billey' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'title_text_b!' => '',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_b',
			'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .back-side .heading',
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'title_b',
			'selector' => '{{WRAPPER}} .back-side .heading',
		] );

		$this->end_controls_section();
	}

	private function add_back_side_description_style_section() {
		$this->start_controls_section( 'description_style_back_side_section', [
			'label'     => esc_html__( 'Back - Description', 'billey' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'description_text_b!' => '',
			],
		] );

		$this->add_control( 'description_spacing_b', [
			'label'     => esc_html__( 'Spacing', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .back-side .description-wrap' => 'margin-top: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'description_b',
			'scheme'   => Schemes\Typography::TYPOGRAPHY_3,
			'selector' => '{{WRAPPER}} .back-side .description',
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'description_b',
			'selector' => '{{WRAPPER}} .back-side .description',
		] );

		$this->end_controls_section();
	}

	private function add_back_side_button_style_section() {
		$this->start_controls_section( 'button_style_back_side_section', [
			'label'      => esc_html__( 'Back - Button', 'billey' ),
			'tab'        => Controls_Manager::TAB_STYLE,
			'conditions' => [
				'relation' => 'or',
				'terms'    => [
					[
						'name'     => 'button_text',
						'operator' => '!==',
						'value'    => '',
					],
					[
						'name'     => 'button_icon[value]',
						'operator' => '!==',
						'value'    => '',
					],
				],
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'button_typography',
			'selector' => '{{WRAPPER}} .tm-button',
			'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
		] );

		$this->start_controls_tabs( 'button_tabs' );

		$this->start_controls_tab( 'normal', [
			'label' => esc_html__( 'Normal', 'billey' ),
		] );

		$this->add_control( 'button_text_color', [
			'label'     => esc_html__( 'Text Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .tm-button' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover', [
			'label' => esc_html__( 'Hover', 'billey' ),
		] );

		$this->add_control( 'button_hover_text_color', [
			'label'     => esc_html__( 'Text Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .tm-button:hover' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control( 'button_spacing', [
			'label'     => esc_html__( 'Spacing', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .button-wrap' => 'margin-top: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="billey-flip-box">
			<?php $this->print_front_side_html( $settings ); ?>

			<?php $this->print_back_side_html( $settings ); ?>
		</div>
		<?php
	}

	private function print_front_side_html( array $settings ) {
		?>
		<div class="layer front-side">
			<div class="overlay"></div>
			<div class="layer-inner">
				<div class="layer-content">
					<?php
					switch ( $settings['graphic_element_a'] ) {
						case 'image':
							$this->print_graphic_image( $settings );
							break;
						case 'icon':
							$this->print_graphic_icon( $settings );
							break;
					}
					?>

					<?php $this->print_heading( $settings ); ?>

					<?php $this->print_description( $settings ); ?>
				</div>
			</div>
		</div>
		<?php
	}

	private function print_back_side_html( array $settings ) {
		$wrapper_tag = 'div';

		$this->add_render_attribute( 'wrapper', 'class', 'layer back-side' );

		if ( ! empty( $settings['link']['url'] ) && 'box' === $settings['link_click'] ) {
			$wrapper_tag = 'a';

			$this->add_link_attributes( 'wrapper', $settings['link'] );
		}

		printf( '<%1$s %2$s>', $wrapper_tag, $this->get_render_attribute_string( 'wrapper' ) );
		?>
		<div class="overlay"></div>
		<div class="layer-inner">
			<div class="layer-content">
				<?php
				switch ( $settings['graphic_element_b'] ) {
					case 'image' :
						$this->print_graphic_image( $settings, 'b' );
						break;
					case 'icon' :
						$this->print_graphic_icon( $settings, 'b' );
						break;
				}
				?>

				<?php $this->print_heading( $settings, 'b' ); ?>

				<?php $this->print_description( $settings, 'b' ); ?>

				<?php $this->print_button( $settings ); ?>
			</div>
		</div>
		<?php
		printf( '</%1$s>', $wrapper_tag );
	}

	private function print_graphic_image( array $settings, $side = 'a' ) {
		$image_key = "image_{$side}";

		if ( empty( $settings[ $image_key ]['url'] ) ) {
			return;
		}
		?>
		<div class="image">
			<?php echo \Billey_Image::get_elementor_attachment( [
				'settings'  => $settings,
				'image_key' => $image_key,
			] ); ?>
		</div>
		<?php
	}

	private function print_graphic_icon( array $settings, $side = 'a' ) {
		if ( empty( $settings["icon_{$side}"]['value'] ) ) {
			return;
		}

		$icon_key = "icon-wrapper-{$side}";

		$this->add_render_attribute( $icon_key, 'class', [
			'billey-icon',
			'icon',
		] );

		$is_svg = isset( $settings["icon_{$side}"]['library'] ) && 'svg' === $settings["icon_{$side}"]['library'] ? true : false;

		if ( $is_svg ) {
			$this->add_render_attribute( $icon_key, 'class', [
				'billey-svg-icon',
			] );
		}

		if ( 'gradient' === $settings["icon_{$side}_color_type"] ) {
			$this->add_render_attribute( $icon_key, 'class', [
				'billey-gradient-icon',
			] );
		} else {
			$this->add_render_attribute( $icon_key, 'class', [
				'billey-solid-icon',
			] );
		}
		?>
		<div class="billey-icon-wrap">
			<div class="billey-icon-view">
				<div <?php $this->print_render_attribute_string( $icon_key ); ?>>
					<?php $this->render_icon( $settings, $settings["icon_{$side}"], [ 'aria-hidden' => 'true' ], $is_svg, "icon_{$side}" ); ?>
				</div>
			</div>
		</div>
		<?php
	}

	private function print_heading( array $settings, $side = 'a' ) {
		if ( empty( $settings["title_text_{$side}"] ) ) {
			return;
		}
		?>
		<div class="heading-wrap">
			<h3 class="heading">
				<?php echo wp_kses( $settings["title_text_{$side}"], 'billey-default' ); ?>
			</h3>
		</div>
		<?php
	}

	private function print_description( array $settings, $side = 'a' ) {
		if ( empty( $settings["description_text_{$side}"] ) ) {
			return;
		}
		?>
		<div class="description-wrap">
			<div class="description">
				<?php echo wp_kses( $settings["description_text_{$side}"], 'billey-default' ); ?>
			</div>
		</div>
		<?php
	}

	private function print_button( array $settings ) {
		if ( empty( $settings['button_text'] ) && empty( $settings['button_icon'] ) ) {
			return;
		}

		$this->add_render_attribute( 'button', 'class', 'tm-button style-' . $settings['button_style'] );

		$button_tag = 'div';

		if ( ! empty( $settings['link']['url'] ) && 'button' === $settings['link_click'] ) {
			$button_tag = 'a';

			$this->add_link_attributes( 'button', $settings['link'] );
		}

		$has_icon = false;

		if ( ! empty( $settings['button_icon'] ) ) {
			$has_icon = true;
			$this->add_render_attribute( 'button', 'class', 'icon-' . $settings['button_icon_align'] );

			$this->add_render_attribute( 'button-icon', 'class', 'button-icon' );
		}
		?>
		<div class="button-wrap">
			<?php printf( '<%1$s %2$s>', $button_tag, $this->get_render_attribute_string( 'button' ) ); ?>
			<div class="button-content-wrapper">
				<?php if ( $has_icon && 'left' === $settings['button_icon_align'] ) : ?>
					<span <?php $this->print_render_attribute_string( 'button-icon' ); ?>>
						<?php Icons_Manager::render_icon( $settings['button_icon'] ); ?>
					</span>
				<?php endif; ?>

				<?php if ( ! empty( $settings['button_text'] ) ): ?>
					<span class="button-text"><?php echo esc_html( $settings['button_text'] ); ?></span>
				<?php endif; ?>

				<?php if ( $has_icon && 'right' === $settings['button_icon_align'] ) : ?>
					<span <?php $this->print_render_attribute_string( 'button-icon' ); ?>>
						<?php Icons_Manager::render_icon( $settings['button_icon'] ); ?>
					</span>
				<?php endif; ?>
			</div>
			<?php printf( '</%1$s>', $button_tag ); ?>
		</div>
		<?php
	}

	protected function _content_template() {
		$id = uniqid( 'svg-gradient' );
		// @formatter:off
		?>
		<# var svg_id = '<?php echo esc_html( $id ); ?>'; #>

		<#
		var icon_a_svg_id = 'icon-a-' + svg_id;
		var icon_b_svg_id = 'icon-b-' + svg_id;

		// Image Front Side.
		if ( 'image' === settings.graphic_element_a && '' !== settings.image_a.url ) {
			var imageA = {
				id: settings.image_a.id,
				url: settings.image_a.url,
				size: settings.image_a_size,
				dimension: settings.image_a_custom_dimension,
				model: view.getEditModel()
			};

			var imageSideAUrl = elementor.imagesManager.getImageUrl( imageA );
			view.addRenderAttribute( 'image-a', 'src', imageSideAUrl );
		}

		// Image Back Side.
		if ( 'image' === settings.graphic_element_b && '' !== settings.image_b.url ) {
			var imageB = {
				id: settings.image_b.id,
				url: settings.image_b.url,
				size: settings.image_b_size,
				dimension: settings.image_b_custom_dimension,
				model: view.getEditModel()
			};

			var imageSideBUrl = elementor.imagesManager.getImageUrl( imageB );
			view.addRenderAttribute( 'image-b', 'src', imageSideBUrl );
		}

		var wrapperTag = 'div',
		buttonTag = 'a';

		if ( 'box' === settings.link_click ) {
			wrapperTag = 'a';
			buttonTag = 'div';
		}
		#>
		<div class="billey-flip-box">

			<div class="layer front-side">
				<div class="overlay"></div>
				<div class="layer-inner">
					<div class="layer-content">
						<# if ( 'image' === settings.graphic_element_a && '' !== settings.image_a.url ) { #>
							<div class="image">
								<img {{{ view.getRenderAttributeString( 'image-a' ) }}} />
							</div>
						<#  } else if ( 'icon' === settings.graphic_element_a ) { #>
							<#
							view.addRenderAttribute( 'iconA', 'class', 'billey-icon icon' );

							if ( 'svg' === settings.icon_a.library ) {
								view.addRenderAttribute( 'iconA', 'class', 'billey-svg-icon' );
							}

							if ( 'gradient' === settings.icon_a_color_type ) {
								view.addRenderAttribute( 'iconA', 'class', 'billey-gradient-icon' );
							} else {
								view.addRenderAttribute( 'iconA', 'class', 'billey-solid-icon' );
							}

							var iconAHTML = elementor.helpers.renderIcon( view, settings.icon_a, { 'aria-hidden': true }, 'i' , 'object' );
							#>
							<div class="billey-icon-wrap">
								<div class="billey-icon-view">
									<div {{{ view.getRenderAttributeString( 'iconA' ) }}}>
										<# if ( iconAHTML.rendered ) { #>
											<#
											var stop_a = settings.icon_a_color_a_stop.size + settings.icon_a_color_a_stop.unit;
											var stop_b = settings.icon_a_color_b_stop.size + settings.icon_a_color_b_stop.unit;

											var iconValue = iconAHTML.value;
											if ( typeof iconValue === 'string' ) {
												var strokeAttr = 'stroke="' + 'url(#' + icon_a_svg_id + ')"';
												var fillAttr = 'fill="' + 'url(#' + icon_a_svg_id + ')"';

												iconValue = iconValue.replace(new RegExp(/stroke="#(.*?)"/, 'g'), strokeAttr);
												iconValue = iconValue.replace(new RegExp(/fill="#(.*?)"/, 'g'), fillAttr);
											}
											#>
											<svg aria-hidden="true" focusable="false" class="svg-defs-gradient">
												<defs>
													<linearGradient id="{{{ icon_a_svg_id }}}" x1="0%" y1="0%" x2="0%" y2="100%">
														<stop class="stop-a" offset="{{{ stop_a }}}"/>
														<stop class="stop-b" offset="{{{ stop_b }}}"/>
													</linearGradient>
												</defs>
											</svg>

											{{{ iconValue }}}
										<# } #>
									</div>
								</div>
							</div>
						<# } #>

						<# if ( settings.title_text_a ) { #>
							<div class="heading-wrap">
								<h3 class="heading">{{{ settings.title_text_a }}}</h3>
							</div>
						<# } #>

						<# if ( settings.description_text_a ) { #>
							<div class="description-wrap">
								<div class="description">{{{ settings.description_text_a }}}</div>
							</div>
						<# } #>
					</div>
				</div>
			</div>

			<{{ wrapperTag }} class="layer back-side">
				<div class="overlay"></div>
				<div class="layer-inner">
					<div class="layer-content">
						<# if ( 'image' === settings.graphic_element_b && '' !== settings.image_b.url ) { #>
							<div class="image">
								<img {{{ view.getRenderAttributeString( 'image-b' ) }}} />
							</div>
						<#  } else if ( 'icon' === settings.graphic_element_b ) { #>
							<#
							view.addRenderAttribute( 'iconB', 'class', 'billey-icon icon' );

							if ( 'svg' === settings.icon_b.library ) {
								view.addRenderAttribute( 'iconB', 'class', 'billey-svg-icon' );
							}

							if ( 'gradient' === settings.icon_b_color_type ) {
								view.addRenderAttribute( 'iconB', 'class', 'billey-gradient-icon' );
							} else {
								view.addRenderAttribute( 'iconB', 'class', 'billey-solid-icon' );
							}

							var iconBHTML = elementor.helpers.renderIcon( view, settings.icon_b, { 'aria-hidden': true }, 'i' , 'object' );
							#>
							<div class="billey-icon-wrap">
								<div class="billey-icon-view">
									<div {{{ view.getRenderAttributeString( 'iconB' ) }}}>
										<# if ( iconBHTML.rendered ) { #>
											<#
											var stop_a = settings.icon_b_color_a_stop.size + settings.icon_b_color_a_stop.unit;
											var stop_b = settings.icon_b_color_b_stop.size + settings.icon_b_color_b_stop.unit;

											var iconValue = iconBHTML.value;
											if ( typeof iconValue === 'string' ) {
												var strokeAttr = 'stroke="' + 'url(#' + icon_b_svg_id + ')"';
												var fillAttr = 'fill="' + 'url(#' + icon_b_svg_id + ')"';

												iconValue = iconValue.replace(new RegExp(/stroke="#(.*?)"/, 'g'), strokeAttr);
												iconValue = iconValue.replace(new RegExp(/fill="#(.*?)"/, 'g'), fillAttr);
											}
											#>
											<svg aria-hidden="true" focusable="false" class="svg-defs-gradient">
												<defs>
													<linearGradient id="{{{ icon_b_svg_id }}}" x1="0%" y1="0%" x2="0%" y2="100%">
														<stop class="stop-a" offset="{{{ stop_a }}}"/>
														<stop class="stop-b" offset="{{{ stop_b }}}"/>
													</linearGradient>
												</defs>
											</svg>

											{{{ iconValue }}}
										<# } #>
									</div>
								</div>
							</div>
						<# } #>

						<# if ( settings.title_text_b ) { #>
							<div class="heading-wrap">
								<h3 class="heading">{{{ settings.title_text_b }}}</h3>
							</div>
						<# } #>

						<# if ( settings.description_text_b ) { #>
							<div class="description-wrap">
								<div class="description">{{{ settings.description_text_b }}}</div>
							</div>
						<# } #>

						<# if ( settings.button_text || settings.button_icon ) { #>
							<#
								var iconHTML = '';

								view.addRenderAttribute( 'button', 'class', 'tm-button style-' + settings.button_style );

								if( 'a' === buttonTag ) {
									view.addRenderAttribute( 'button', 'href', '#' );
								}

								if( settings.button_icon ) {
									view.addRenderAttribute( 'button', 'class', 'icon-' + settings.button_icon_align );

									iconHTML = elementor.helpers.renderIcon( view, settings.button_icon, { 'aria-hidden': true }, 'i' , 'object' );
								}
							#>
							<div class="button-wrap">
								<{{ buttonTag }} {{{ view.getRenderAttributeString( 'button' ) }}}>

									<# if( '' !== iconHTML && iconHTML.rendered && 'left' === settings.button_icon_align ) { #>
										<span class="button-icon">
											{{{ iconHTML.value }}}
										</span>
									<# } #>

									<# if( settings.button_text ) { #>
										<span class="button-text">{{{ settings.button_text }}}</span>
									<# } #>

									<# if( '' !== iconHTML && iconHTML.rendered && 'right' === settings.button_icon_align ) { #>
										<span class="button-icon">
											{{{ iconHTML.value }}}
										</span>
									<# } #>

								</{{ buttonTag }}>
							</div>
						<# } #>
					</div>
				</div>
			</{{ wrapperTag }}>

		</div>
		<?php
		// @formatter:off
	}
}
