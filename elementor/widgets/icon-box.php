<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;

defined( 'ABSPATH' ) || exit;

class Widget_Icon_Box extends Base {

	public function get_name() {
		return 'tm-icon-box';
	}

	public function get_title() {
		return esc_html__( 'Modern Icon Box', 'billey' );
	}

	public function get_icon_part() {
		return 'eicon-icon-box';
	}

	public function get_keywords() {
		return [ 'icon box', 'icon' ];
	}

	public function get_script_depends() {
		return [ 'billey-widget-icon-box' ];
	}

	protected function _register_controls() {
		$this->add_box_section();

		$this->add_icon_section();

		$this->add_icon_svg_animate_section();

		$this->add_title_section();

		$this->add_description_section();

		$this->add_button_section();

		$this->add_box_style_section();

		$this->add_icon_style_section();

		$this->add_title_style_section();

		$this->add_title_divider_style();

		$this->add_description_style_section();

		$this->add_button_style_section();
	}

	private function add_box_section() {
		$this->start_controls_section( 'icon_box_section', [
			'label' => esc_html__( 'Box', 'billey' ),
		] );

		$this->add_control( 'style', [
			'label'        => esc_html__( 'Style', 'billey' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => [
				''   => esc_html__( 'None', 'billey' ),
				'01' => esc_html__( '01', 'billey' ),
				'02' => esc_html__( '02', 'billey' ),
				'03' => esc_html__( '03', 'billey' ),
				'04' => esc_html__( '04', 'billey' ),
			],
			'default'      => '',
			'prefix_class' => 'elementor-style-',
		] );

		$this->add_control( 'link', [
			'label'       => esc_html__( 'Link', 'billey' ),
			'description' => esc_html__( 'Input box link. This option will ignore other link options.', 'billey' ),
			'type'        => Controls_Manager::URL,
			'dynamic'     => [
				'active' => true,
			],
			'placeholder' => esc_html__( 'https://your-link.com', 'billey' ),
		] );

		$this->end_controls_section();
	}

	private function add_icon_section() {
		$this->start_controls_section( 'icon_section', [
			'label' => esc_html__( 'Icon', 'billey' ),
		] );

		$this->add_control( 'icon', [
			'label'      => esc_html__( 'Icon', 'billey' ),
			'show_label' => false,
			'type'       => Controls_Manager::ICONS,
			'default'    => [
				'value'   => 'fas fa-star',
				'library' => 'fa-solid',
			],
		] );

		$this->add_control( 'view', [
			'label'        => esc_html__( 'View', 'billey' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => [
				'default'    => esc_html__( 'Default', 'billey' ),
				'stacked'    => esc_html__( 'Stacked', 'billey' ),
				'bubble'     => esc_html__( 'Bubble', 'billey' ),
				'circle'     => esc_html__( 'Fancy Circle', 'billey' ),
				'distortion' => esc_html__( 'Distortion', 'billey' ),
			],
			'default'      => 'default',
			'prefix_class' => 'billey-view-',
			'condition'    => [
				'icon[value]!' => '',
			],
			'render_type'  => 'template',
		] );

		$this->add_control( 'shape', [
			'label'        => esc_html__( 'Shape', 'billey' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => [
				'circle' => esc_html__( 'Circle', 'billey' ),
				'square' => esc_html__( 'Square', 'billey' ),
			],
			'default'      => 'circle',
			'condition'    => [
				'icon[value]!' => '',
				'view'         => [ 'stacked' ],
			],
			'prefix_class' => 'billey-shape-',
		] );

		$this->add_control( 'position', [
			'label'        => esc_html__( 'Icon Position', 'billey' ),
			'type'         => Controls_Manager::CHOOSE,
			'default'      => 'top',
			'options'      => [
				'left'  => [
					'title' => esc_html__( 'Left', 'billey' ),
					'icon'  => 'eicon-h-align-left',
				],
				'top'   => [
					'title' => esc_html__( 'Top', 'billey' ),
					'icon'  => 'eicon-v-align-top',
				],
				'right' => [
					'title' => esc_html__( 'Right', 'billey' ),
					'icon'  => 'eicon-h-align-right',
				],
			],
			'prefix_class' => 'elementor-position-',
			'toggle'       => false,
			'condition'    => [
				'icon[value]!' => '',
			],
		] );

		$this->add_control( 'content_vertical_alignment', [
			'label'        => esc_html__( 'Vertical Alignment', 'billey' ),
			'type'         => Controls_Manager::CHOOSE,
			'options'      => Widget_Utils::get_control_options_vertical_alignment(),
			'default'      => 'top',
			'prefix_class' => 'elementor-vertical-align-',
			'condition'    => [
				'icon[value]!' => '',
				'position!'    => 'top',
			],
		] );

		$this->end_controls_section();
	}

	private function add_icon_svg_animate_section() {
		$this->start_controls_section( 'icon_svg_animate_section', [
			'label'     => esc_html__( 'Icon SVG Animate', 'billey' ),
			'condition' => [
				'icon[library]' => 'svg',
			],
		] );

		$this->add_control( 'icon_svg_animate_alert', [
			'type'            => Controls_Manager::RAW_HTML,
			'content_classes' => 'elementor-control-field-description',
			'raw'             => esc_html__( 'Note: Animate works only with Stroke SVG Icon.', 'billey' ),
			'separator'       => 'after',
		] );

		$this->add_control( 'icon_svg_animate', [
			'label' => esc_html__( 'SVG Animate', 'billey' ),
			'type'  => Controls_Manager::SWITCHER,
		] );

		$this->add_control( 'icon_svg_animate_play_on_hover', [
			'label' => esc_html__( 'Play on hover', 'billey' ),
			'type'  => Controls_Manager::SWITCHER,
		] );

		$this->add_control( 'icon_svg_animate_type', [
			'label'   => esc_html__( 'Type', 'billey' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'delayed'  => esc_html__( 'Delayed', 'billey' ),
				'sync'     => esc_html__( 'Sync', 'billey' ),
				'oneByOne' => esc_html__( 'One By One', 'billey' ),
			],
			'default' => 'delayed',
		] );

		$this->add_control( 'icon_svg_animate_duration', [
			'label'   => esc_html__( 'Transition Duration', 'billey' ),
			'type'    => Controls_Manager::NUMBER,
			'default' => 120,
		] );

		$this->end_controls_section();
	}

	private function add_title_section() {
		$this->start_controls_section( 'title_section', [
			'label' => esc_html__( 'Title', 'billey' ),
		] );

		$this->add_control( 'title_text', [
			'label'       => esc_html__( 'Text', 'billey' ),
			'type'        => Controls_Manager::TEXT,
			'dynamic'     => [
				'active' => true,
			],
			'default'     => esc_html__( 'This is the heading', 'billey' ),
			'placeholder' => esc_html__( 'Enter your title', 'billey' ),
			'label_block' => true,
		] );

		$this->add_control( 'title_size', [
			'label'   => esc_html__( 'HTML Tag', 'billey' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'h1'   => 'H1',
				'h2'   => 'H2',
				'h3'   => 'H3',
				'h4'   => 'H4',
				'h5'   => 'H5',
				'h6'   => 'H6',
				'div'  => 'div',
				'span' => 'span',
				'p'    => 'p',
			],
			'default' => 'h3',
		] );

		// Divider.
		$this->add_control( 'title_divider_enable', [
			'label' => esc_html__( 'Display Divider', 'billey' ),
			'type'  => Controls_Manager::SWITCHER,
		] );

		$this->end_controls_section();
	}

	private function add_description_section() {
		$this->start_controls_section( 'description_section', [
			'label' => esc_html__( 'Description', 'billey' ),
		] );

		$this->add_control( 'description_text', [
			'label'       => esc_html__( 'Text', 'billey' ),
			'type'        => Controls_Manager::TEXTAREA,
			'dynamic'     => [
				'active' => true,
			],
			'default'     => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis.', 'billey' ),
			'placeholder' => esc_html__( 'Enter your description', 'billey' ),
			'rows'        => 10,
			'separator'   => 'none',
		] );

		$this->end_controls_section();
	}

	private function add_button_section() {
		$this->start_controls_section( 'button_section', [
			'label' => esc_html__( 'Button', 'billey' ),
		] );

		$this->add_control( 'button_text', [
			'label'       => esc_html__( 'Text', 'billey' ),
			'type'        => Controls_Manager::TEXT,
			'dynamic'     => [
				'active' => true,
			],
			'placeholder' => esc_html__( 'Enter your button text', 'billey' ),
			'label_block' => true,
		] );

		$this->add_control( 'button_link', [
			'label'       => esc_html__( 'Link', 'billey' ),
			'type'        => Controls_Manager::URL,
			'dynamic'     => [
				'active' => true,
			],
			'placeholder' => esc_html__( 'https://your-link.com', 'billey' ),
			'condition'   => [
				'link[url]' => '',
			],
		] );

		$this->end_controls_section();
	}

	private function add_box_style_section() {
		$this->start_controls_section( 'box_style_section', [
			'label' => esc_html__( 'Box', 'billey' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'text_align', [
			'label'     => esc_html__( 'Alignment', 'billey' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => Widget_Utils::get_control_options_text_align_full(),
			'selectors' => [
				'{{WRAPPER}} .icon-box-wrapper' => 'text-align: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'box_padding', [
			'label'      => esc_html__( 'Padding', 'billey' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .tm-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'box_max_width', [
			'label'      => esc_html__( 'Max Width', 'billey' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'unit' => 'px',
			],
			'size_units' => [ 'px', '%' ],
			'range'      => [
				'%'  => [
					'min' => 1,
					'max' => 100,
				],
				'px' => [
					'min' => 1,
					'max' => 1600,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .tm-icon-box' => 'max-width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'box_horizontal_alignment', [
			'label'                => esc_html__( 'Horizontal Alignment', 'billey' ),
			'label_block'          => true,
			'type'                 => Controls_Manager::CHOOSE,
			'options'              => Widget_Utils::get_control_options_horizontal_alignment(),
			'default'              => 'center',
			'toggle'               => false,
			'selectors_dictionary' => [
				'left'  => 'flex-start',
				'right' => 'flex-end',
			],
			'selectors'            => [
				'{{WRAPPER}} .elementor-widget-container' => 'display: flex; justify-content: {{VALUE}}',
			],
		] );

		$this->start_controls_tabs( 'box_colors' );

		$this->start_controls_tab( 'box_colors_normal', [
			'label' => esc_html__( 'Normal', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'box',
			'selector' => '{{WRAPPER}} .tm-icon-box',
		] );

		$this->add_group_control( Group_Control_Advanced_Border::get_type(), [
			'name'     => 'box_border',
			'selector' => '{{WRAPPER}} .tm-icon-box',
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'box',
			'selector' => '{{WRAPPER}} .tm-icon-box',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'box_colors_hover', [
			'label' => esc_html__( 'Hover', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'box_hover',
			'selector' => '{{WRAPPER}} .tm-icon-box:before',
		] );

		$this->add_group_control( Group_Control_Advanced_Border::get_type(), [
			'name'     => 'box_hover_border',
			'selector' => '{{WRAPPER}} .tm-icon-box:hover',
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'box_hover',
			'selector' => '{{WRAPPER}} .tm-icon-box:hover',
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control( 'box_line_heading', [
			'label'     => esc_html__( 'Special Line', 'billey' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => [
				'style' => [ '02' ],
			],
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'      => 'box_line',
			'selector'  => '{{WRAPPER}}.elementor-style-02 .tm-icon-box:after',
			'condition' => [
				'style' => [ '02' ],
			],
		] );

		$this->end_controls_section();
	}

	private function add_icon_style_section() {
		$this->start_controls_section( 'icon_style_section', [
			'label'     => esc_html__( 'Icon', 'billey' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'icon[value]!' => '',
			],
		] );

		$this->add_responsive_control( 'icon_wrap_height', [
			'label'     => esc_html__( 'Wrap Height', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 6,
					'max' => 300,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .billey-icon-wrap' => 'height: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->start_controls_tabs( 'icon_colors' );

		$this->start_controls_tab( 'icon_colors_normal', [
			'label' => esc_html__( 'Normal', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'icon',
			'selector' => '{{WRAPPER}} .icon',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'icon_colors_hover', [
			'label' => esc_html__( 'Hover', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'hover_icon',
			'selector' => '{{WRAPPER}} .tm-icon-box:hover .icon',
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control( 'icon_space', [
			'label'     => esc_html__( 'Spacing', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}}.elementor-position-right .billey-icon-wrap' => 'margin-left: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}}.elementor-position-left .billey-icon-wrap'  => 'margin-right: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}}.elementor-position-top .billey-icon-wrap'   => 'margin-bottom: {{SIZE}}{{UNIT}};',
				'(mobile){{WRAPPER}} .billey-icon-wrap'                  => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
			'separator' => 'before',
		] );

		$this->add_responsive_control( 'icon_size', [
			'label'     => esc_html__( 'Size', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 6,
					'max' => 300,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .billey-icon-view, {{WRAPPER}} .billey-icon' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'icon_rotate', [
			'label'     => esc_html__( 'Rotate', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'unit' => 'deg',
			],
			'selectors' => [
				'{{WRAPPER}} .billey-icon' => 'transform: rotate({{SIZE}}{{UNIT}});',
			],
		] );

		// Icon View Settings.
		$this->add_control( 'icon_view_heading', [
			'label'     => esc_html__( 'Icon View', 'billey' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => [
				'view' => [ 'stacked', 'bubble', 'distortion', 'circle' ],
			],
		] );

		$this->add_control( 'icon_padding', [
			'label'     => esc_html__( 'Padding', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'selectors' => [
				'{{WRAPPER}} .billey-icon-view' => 'padding: {{SIZE}}{{UNIT}};',
			],
			'range'     => [
				'em' => [
					'min' => 0,
					'max' => 5,
				],
			],
			'condition' => [
				'view' => [ 'stacked', 'circle' ],
			],
		] );

		$this->add_control( 'icon_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'billey' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .billey-icon-view' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'condition'  => [
				'view' => [ 'stacked' ],
			],
		] );

		$this->start_controls_tabs( 'icon_view_colors' );

		$this->start_controls_tab( 'icon_view_colors_normal', [
			'label' => esc_html__( 'Normal', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'      => 'icon_view',
			'selector'  => '{{WRAPPER}} .billey-icon-view',
			'condition' => [
				'view' => [ 'stacked', 'bubble', 'circle' ],
			],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'      => 'icon_view',
			'selector'  => '{{WRAPPER}} .billey-icon-view',
			'condition' => [
				'view' => [ 'stacked', 'bubble', 'circle' ],
			],
		] );

		$this->add_control( 'view_shape_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .billey-icon-view-shape .billey-shape-fill' => 'fill: {{VALUE}};',
			],
			'condition' => [
				'view' => [ 'distortion' ],
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'icon_view_colors_hover', [
			'label' => esc_html__( 'Hover', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'      => 'hover_icon_view',
			'selector'  => '{{WRAPPER}} .tm-icon-box:hover .billey-icon-view',
			'condition' => [
				'view' => [ 'stacked', 'bubble', 'circle' ],
			],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'      => 'hover_icon_view',
			'selector'  => '{{WRAPPER}} .tm-icon-box:hover .billey-icon-view',
			'condition' => [
				'view' => [ 'stacked', 'bubble', 'circle' ],
			],
		] );

		$this->add_control( 'hover_view_shape_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .tm-icon-box:hover .billey-icon-view-shape .billey-shape-fill' => 'fill: {{VALUE}};',
			],
			'condition' => [
				'view' => [ 'distortion' ],
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_title_style_section() {
		$this->start_controls_section( 'title_style_section', [
			'label' => esc_html__( 'Title', 'billey' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title',
			'selector' => '{{WRAPPER}} .heading',
			'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
		] );

		$this->start_controls_tabs( 'title_colors' );

		$this->start_controls_tab( 'title_color_normal', [
			'label' => esc_html__( 'Normal', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'title',
			'selector' => '{{WRAPPER}} .heading',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'title_color_hover', [
			'label' => esc_html__( 'Hover', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'title_hover',
			'selector' => '{{WRAPPER}} .tm-icon-box:hover .heading',
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_title_divider_style() {
		$this->start_controls_section( 'title_divider_style_section', [
			'label'     => esc_html__( 'Title Divider', 'billey' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'title_divider_enable' => 'yes',
			],
		] );

		$this->start_controls_tabs( 'title_divider_colors' );

		$this->start_controls_tab( 'title_divider_colors_normal', [
			'label' => esc_html__( 'Normal', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'title_divider',
			'selector' => '{{WRAPPER}} .heading-divider:before',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'title_divider_colors_hover', [
			'label' => esc_html__( 'Hover', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'hover_title_divider',
			'selector' => '{{WRAPPER}} .heading-divider:after',
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_description_style_section() {
		$this->start_controls_section( 'description_style_section', [
			'label'     => esc_html__( 'Description', 'billey' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'description_text!' => '',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'description',
			'selector' => '{{WRAPPER}} .description',
			'scheme'   => Schemes\Typography::TYPOGRAPHY_3,
		] );

		$this->start_controls_tabs( 'description_colors' );

		$this->start_controls_tab( 'description_color_normal', [
			'label' => esc_html__( 'Normal', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'description',
			'selector' => '{{WRAPPER}} .description',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'description_color_hover', [
			'label' => esc_html__( 'Hover', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'description_hover',
			'selector' => '{{WRAPPER}} .tm-icon-box:hover .description',
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control( 'description_spacing', [
			'label'      => esc_html__( 'Spacing', 'billey' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'unit' => 'px',
			],
			'size_units' => [ 'px', '%', 'em' ],
			'range'      => [
				'%'  => [
					'min' => 0,
					'max' => 100,
				],
				'px' => [
					'min' => 0,
					'max' => 200,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .description-wrap' => 'margin-top: {{SIZE}}{{UNIT}};',
			],
			'separator'  => 'before',
		] );

		$this->add_responsive_control( 'description_max_width', [
			'label'      => esc_html__( 'Max Width', 'billey' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'unit' => 'px',
			],
			'size_units' => [ 'px', '%' ],
			'range'      => [
				'%'  => [
					'min' => 1,
					'max' => 100,
				],
				'px' => [
					'min' => 1,
					'max' => 1600,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .description' => 'max-width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}

	private function add_button_style_section() {
		$this->start_controls_section( 'button_style_section', [
			'label'     => esc_html__( 'Button', 'billey' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'button_text!' => '',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'button',
			'selector' => '{{WRAPPER}} .icon-box-button',
			'scheme'   => Schemes\Typography::TYPOGRAPHY_3,
		] );

		$this->start_controls_tabs( 'button_colors' );

		$this->start_controls_tab( 'button_color_normal', [
			'label' => esc_html__( 'Normal', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'button',
			'selector' => '{{WRAPPER}} .icon-box-button',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'button_color_hover', [
			'label' => esc_html__( 'Hover', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'button_hover',
			'selector' => '{{WRAPPER}} .tm-icon-box:hover div.icon-box-button, {{WRAPPER}} a.icon-box-button:hover',
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control( 'button_spacing', [
			'label'      => esc_html__( 'Spacing', 'billey' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'unit' => 'px',
			],
			'size_units' => [ 'px', '%', 'em' ],
			'range'      => [
				'%'  => [
					'min' => 0,
					'max' => 100,
				],
				'px' => [
					'min' => 0,
					'max' => 200,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .button-wrap' => 'margin-top: {{SIZE}}{{UNIT}};',
			],
			'separator'  => 'before',
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'box', 'class', 'tm-icon-box' );

		if ( ! empty( $settings['icon_svg_animate'] ) && 'yes' === $settings['icon_svg_animate'] ) {
			$vivus_settings = [
				'enable'        => $settings['icon_svg_animate'],
				'type'          => $settings['icon_svg_animate_type'],
				'duration'      => $settings['icon_svg_animate_duration'],
				'play_on_hover' => $settings['icon_svg_animate_play_on_hover'],
			];
			$this->add_render_attribute( 'box', 'data-vivus', wp_json_encode( $vivus_settings ) );
		}

		$box_tag = 'div';

		if ( ! empty( $settings['link']['url'] ) ) {
			$box_tag = 'a';

			$this->add_render_attribute( 'box', 'class', 'link-secret' );
			$this->add_link_attributes( 'box', $settings['link'] );
		}
		?>
		<?php printf( '<%1$s %2$s>', $box_tag, $this->get_render_attribute_string( 'box' ) ); ?>

		<div class="icon-box-wrapper">
			<?php $this->print_icon( $settings ); ?>

			<div class="icon-box-content">
				<?php $this->print_title( $settings ); ?>

				<?php $this->print_description( $settings ); ?>

				<?php $this->print_button( $settings ); ?>
			</div>
		</div>

		<?php printf( '</%1$s>', $box_tag ); ?>
		<?php
	}

	protected function _content_template() {
		$id = uniqid( 'svg-gradient' );
		// @formatter:off
		?>
		<# var svg_id = '<?php echo esc_html( $id ); ?>'; #>

		<#
		view.addRenderAttribute( 'box', 'class', 'tm-icon-box' );
		var box_tag = 'div';

		if ( '' !== settings.link.url ) {
			box_tag = 'a';

			view.addRenderAttribute( 'box', 'class', 'link-secret' );
			view.addRenderAttribute( 'box', 'href', '#' );
		}

		view.addRenderAttribute( 'icon', 'class', 'billey-icon icon' );

		if ( 'svg' === settings.icon.library ) {
			view.addRenderAttribute( 'icon', 'class', 'billey-svg-icon' );
		}

		if ( 'gradient' === settings.icon_color_type ) {
			view.addRenderAttribute( 'icon', 'class', 'billey-gradient-icon' );
		} else {
			view.addRenderAttribute( 'icon', 'class', 'billey-solid-icon' );
		}

		var iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' );
		#>
		<{{{ box_tag }}} {{{ view.getRenderAttributeString( 'box' ) }}}>
			<div class="icon-box-wrapper">

				<div class="billey-icon-wrap">
					<div class="billey-icon-view first">
						<div class="billey-icon-view-inner">
							<div {{{ view.getRenderAttributeString( 'icon' ) }}}>
								<# if ( iconHTML.rendered ) { #>
									<#
									var stop_a = settings.icon_color_a_stop.size + settings.icon_color_a_stop.unit;
									var stop_b = settings.icon_color_b_stop.size + settings.icon_color_b_stop.unit;

									var iconValue = iconHTML.value;
									if ( typeof iconValue === 'string' ) {
										var strokeAttr = 'stroke="' + 'url(#' + svg_id + ')"';
										var fillAttr = 'fill="' + 'url(#' + svg_id + ')"';

										iconValue = iconValue.replace(new RegExp(/stroke="#(.*?)"/, 'g'), strokeAttr);
										iconValue = iconValue.replace(new RegExp(/fill="#(.*?)"/, 'g'), fillAttr);
									}
									#>
									<svg aria-hidden="true" focusable="false" class="svg-defs-gradient">
										<defs>
											<linearGradient id="{{{ svg_id }}}" x1="0%" y1="0%" x2="0%" y2="100%">
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

					<# if( 'bubble' === settings.view ) { #>
						<div class="billey-icon-view second"></div>
					<# } #>

				</div>

				<div class="icon-box-content">
					<# if ( settings.title_text ) { #>
						<#
						view.addRenderAttribute( 'title', 'class', 'heading' );
						#>
						<div class="heading-wrap">
							<{{{ settings.title_size }}} {{{ view.getRenderAttributeString( 'title' ) }}}>
								{{{ settings.title_text }}}
							</{{{ settings.title_size }}}>

							<# if ( 'yes' === settings.title_divider_enable ) { #>
								<div class="heading-divider-wrap">
									<div class="heading-divider"></div>
								</div>
							<# } #>
						</div>
					<# } #>

					<# if ( settings.description_text ) { #>
						<#
						view.addRenderAttribute( 'description', 'class', 'description' );
						#>
						<div class="description-wrap">
							<div {{{ view.getRenderAttributeString( 'description' ) }}}>
								{{{ settings.description_text }}}
							</div>
						</div>
					<# } #>

					<# if ( settings.button_text ) { #>
						<#
						view.addRenderAttribute( 'button', 'class', 'icon-box-button' );
						var button_tag = 'div';

						if ( '' === settings.link.url && '' !== settings.button_link.url ) {
							button_tag = 'a';
							view.addRenderAttribute( 'button', 'href', '#' );
						}
						#>
						<div class="button-wrap">
							<{{{ button_tag }}} {{{ view.getRenderAttributeString( 'button' ) }}}>
								{{{ settings.button_text }}}
							</{{{ button_tag }}}>
						</div>
					<# } #>
				</div>

			</div>
		</{{{ box_tag }}}>
		<?php
		// @formatter:off
	}

	private function print_icon( array $settings ) {
		$this->add_render_attribute( 'icon', 'class', [
			'billey-icon',
			'icon',
		] );

		$is_svg = isset( $settings['icon']['library'] ) && 'svg' === $settings['icon']['library'] ? true : false;

		if ( $is_svg ) {
			$this->add_render_attribute( 'icon', 'class', [
				'billey-svg-icon',
			] );
		}

		if ( 'gradient' === $settings['icon_color_type'] ) {
			$this->add_render_attribute( 'icon', 'class', [
				'billey-gradient-icon',
			] );
		} else {
			$this->add_render_attribute( 'icon', 'class', [
				'billey-solid-icon',
			] );
		}
		?>
		<div class="billey-icon-wrap">
			<div class="billey-icon-view first">
				<div class="billey-icon-view-inner">
					<?php if ( 'distortion' === $settings['view'] ): ?>
						<div class="billey-icon-view-shape">
							<?php echo \Billey_Helper::get_file_contents( BILLEY_THEME_DIR . '/assets/shapes/' . $settings['view'] . '.svg' ); ?>
						</div>
					<?php endif; ?>

					<div <?php $this->print_render_attribute_string( 'icon' ); ?>>
						<?php $this->render_icon( $settings, $settings['icon'], [ 'aria-hidden' => 'true' ], $is_svg, 'icon' ); ?>
					</div>
				</div>
			</div>

			<?php if( 'bubble' === $settings['view'] ) { ?>
				<div class="billey-icon-view second"></div>
			<?php } ?>
		</div>
		<?php
	}

	private function print_title( array $settings ) {
		if ( empty( $settings['title_text'] ) ) {
			return;
		}

		$this->add_render_attribute( 'title', 'class', 'heading' );
		?>
		<div class="heading-wrap">
			<?php printf( '<%1$s %2$s>%3$s</%1$s>', $settings['title_size'], $this->get_render_attribute_string( 'title' ), $settings['title_text'] ); ?>

			<?php $this->print_title_divider( $settings ); ?>
		</div>
		<?php
	}

	private function print_title_divider( array $settings ) {
		if ( empty( $settings['title_divider_enable'] ) || 'yes' !== $settings['title_divider_enable'] ) {
			return;
		}
		?>
		<div class="heading-divider-wrap">
			<div class="heading-divider"></div>
		</div>
		<?php
	}

	private function print_description( array $settings ) {
		if ( empty( $settings['description_text'] ) ) {
			return;
		}

		$this->add_render_attribute( 'description', 'class', 'description' );
		?>
		<div class="description-wrap">
			<div <?php $this->print_render_attribute_string( 'description' ); ?>>
				<?php echo wp_kses($settings['description_text'], 'billey-default'); ?>
			</div>
		</div>
		<?php
	}

	private function print_button( array $settings ) {
		if ( empty( $settings['button_text'] ) ) {
			return;
		}

		$this->add_render_attribute( 'button', 'class', 'icon-box-button' );
		$button_tag = 'div';

		if ( empty( $settings['link']['url'] ) && ! empty( $settings['button_link']['url'] ) ) {
			$button_tag = 'a';
			$this->add_link_attributes( 'button', $settings['button_link'] );
		}
		?>
		<div class="button-wrap">
			<?php printf( '<%1$s %2$s>%3$s</%1$s>', $button_tag, $this->get_render_attribute_string( 'button' ), $settings['button_text'] ); ?>
		</div>
		<?php
	}
}
