<?php
$section  = 'color_';
$priority = 1;
$prefix   = 'color_';

Billey_Kirki::add_field( 'theme', array(
	'type'      => 'color',
	'settings'  => 'primary_color',
	'label'     => esc_html__( 'Primary Color', 'billey' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => Billey::PRIMARY_COLOR,
) );

Billey_Kirki::add_field( 'theme', array(
	'type'      => 'color',
	'settings'  => 'secondary_color',
	'label'     => esc_html__( 'Secondary Color', 'billey' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => Billey::SECONDARY_COLOR,
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'body_color',
	'label'       => esc_html__( 'Text Color', 'billey' ),
	'description' => esc_html__( 'Controls the default color of all text.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Billey::TEXT_COLOR,
	'output'      => array(
		array(
			'element'  => 'body, .gmap-marker-wrap',
			'property' => 'color',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => 'link_color',
	'label'       => esc_html__( 'Link Color', 'billey' ),
	'description' => esc_html__( 'Controls the default color of all links.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'normal' => esc_attr__( 'Normal', 'billey' ),
		'hover'  => esc_attr__( 'Hover', 'billey' ),
	),
	'default'     => array(
		'normal' => '#111',
		'hover'  => Billey::PRIMARY_COLOR,
	),
	'output'      => array(
		array(
			'choice'   => 'normal',
			'element'  => 'a',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '
			a:hover,
			a:focus,
			.billey-map-overlay-info a:hover
			',
			'property' => 'color',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'heading_color',
	'label'       => esc_html__( 'Heading Color', 'billey' ),
	'description' => esc_html__( 'Controls the color of heading.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Billey::HEADING_COLOR,
	'output'      => array(
		array(
			'element'  => '
			h1,h2,h3,h4,h5,h6,caption,th,
			.heading-color,
			.billey-grid-wrapper.filter-style-01 .btn-filter.current,
			.billey-grid-wrapper.filter-style-01 .btn-filter:hover,
			.elementor-accordion .elementor-tab-title,
			.tm-table.style-01 td,
			.tm-table caption,
            .single-product form.cart .label > label,
            .single-product form.cart .quantity-button-wrapper > label,
            .single-product form.cart .wccpf_label > label
			',
			'property' => 'color',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Button Color', 'billey' ) . '</div>',
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => 'button_color',
	'label'       => esc_html__( 'Button Color', 'billey' ),
	'description' => esc_html__( 'Controls the color of buttons.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'color'      => esc_attr__( 'Color', 'billey' ),
		'background' => esc_attr__( 'Background', 'billey' ),
		'border'     => esc_attr__( 'Border', 'billey' ),
	),
	'default'     => array(
		'color'      => '#fff',
		'background' => Billey::PRIMARY_COLOR,
		'border'     => Billey::PRIMARY_COLOR,
	),
	'output'      => array(
		array(
			'choice'   => 'color',
			'element'  => Billey_Helper::get_button_css_selector(),
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => Billey_Helper::get_button_css_selector(),
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => Billey_Helper::get_button_css_selector(),
			'property' => 'background-color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.wp-block-button.is-style-outline',
			'property' => 'color',
		),
		array(
			'choice'   => 'color',
			'element'  => '.billey-booking-form #flexi_searchbox #b_searchboxInc .b_submitButton_wrapper .b_submitButton',
			'suffix'   => '!important',
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => '.billey-booking-form #flexi_searchbox #b_searchboxInc .b_submitButton_wrapper .b_submitButton',
			'suffix'   => '!important',
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.billey-booking-form #flexi_searchbox #b_searchboxInc .b_submitButton_wrapper .b_submitButton',
			'suffix'   => '!important',
			'property' => 'background-color',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => 'button_hover_color',
	'label'       => esc_html__( 'Button Hover Color', 'billey' ),
	'description' => esc_html__( 'Controls the color of buttons when hover.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'color'      => esc_attr__( 'Color', 'billey' ),
		'background' => esc_attr__( 'Background', 'billey' ),
		'border'     => esc_attr__( 'Border', 'billey' ),
	),
	'default'     => array(
		'color'      => '#fff',
		'background' => Billey::SECONDARY_COLOR,
		'border'     => Billey::SECONDARY_COLOR,
	),
	'output'      => array(
		array(
			'choice'   => 'color',
			'element'  => Billey_Helper::get_button_hover_css_selector(),
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => Billey_Helper::get_button_hover_css_selector(),
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => Billey_Helper::get_button_hover_css_selector(),
			'property' => 'background-color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.wp-block-button.is-style-outline .wp-block-button__link:hover',
			'property' => 'color',
		),
		array(
			'choice'   => 'color',
			'element'  => '.billey-booking-form #flexi_searchbox #b_searchboxInc .b_submitButton_wrapper .b_submitButton:hover',
			'suffix'   => '!important',
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => '.billey-booking-form #flexi_searchbox #b_searchboxInc .b_submitButton_wrapper .b_submitButton:hover',
			'suffix'   => '!important',
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.billey-booking-form #flexi_searchbox #b_searchboxInc .b_submitButton_wrapper .b_submitButton:hover',
			'suffix'   => '!important',
			'property' => 'background-color',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Form Color', 'billey' ) . '</div>',
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => 'form_input_color',
	'label'       => esc_html__( 'Color', 'billey' ),
	'description' => esc_html__( 'Controls the color of form inputs.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'color'      => esc_attr__( 'Color', 'billey' ),
		'background' => esc_attr__( 'Background', 'billey' ),
		'border'     => esc_attr__( 'Border', 'billey' ),
	),
	'default'     => array(
		'color'      => '#777',
		'background' => '#fff',
		'border'     => '#ddd',
	),
	'output'      => array(
		array(
			'choice'   => 'color',
			'element'  => Billey_Helper::get_form_input_css_selector(),
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => Billey_Helper::get_form_input_css_selector(),
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => Billey_Helper::get_form_input_css_selector(),
			'property' => 'background-color',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => 'form_input_focus_color',
	'label'       => esc_html__( 'Focus Color', 'billey' ),
	'description' => esc_html__( 'Controls the color of form inputs when focus.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'color'      => esc_attr__( 'Color', 'billey' ),
		'background' => esc_attr__( 'Background', 'billey' ),
		'border'     => esc_attr__( 'Border', 'billey' ),
	),
	'default'     => array(
		'color'      => '#777',
		'background' => '#fff',
		'border'     => Billey::PRIMARY_COLOR,
	),
	'output'      => array(
		array(
			'choice'   => 'color',
			'element'  => Billey_Helper::get_form_input_focus_css_selector(),
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => Billey_Helper::get_form_input_focus_css_selector(),
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => Billey_Helper::get_form_input_focus_css_selector(),
			'property' => 'background-color',
		),
	),
) );
