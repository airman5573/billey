<?php
$section  = 'header_more_options';
$priority = 1;
$prefix   = 'header_more_options_';

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'background',
	'label'       => esc_html__( 'Background', 'billey' ),
	'description' => esc_html__( 'Controls the background of header more options.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '#ffffff',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.header-more-tools-opened .header-right-inner',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'icon_color',
	'label'       => esc_html__( 'Icon Color', 'billey' ),
	'description' => esc_html__( 'Controls the color of icons on header.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'normal' => esc_attr__( 'Normal', 'billey' ),
		'hover'  => esc_attr__( 'Hover', 'billey' ),
	),
	'default'     => array(
		'normal' => '#333',
		'hover'  => Billey::PRIMARY_COLOR,
	),
	'output'      => array(
		array(
			'choice'   => 'normal',
			'element'  => '
			.header-more-tools-opened .header-right-inner .header-icon,
			.header-more-tools-opened .header-right-inner .wpml-ls-item-toggle
			',
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.header-more-tools-opened .header-right-inner .header-icon:hover',
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.header-more-tools-opened .header-right-inner .wpml-ls-slot-shortcode_actions:hover > .js-wpml-ls-item-toggle',
			'property' => 'color',
			'suffix'   => '!important',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'cart_badge_color',
	'label'       => esc_html__( 'Cart Badge Color', 'billey' ),
	'description' => esc_html__( 'Controls the color of cart badge.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'color'      => esc_attr__( 'Color', 'billey' ),
		'background' => esc_attr__( 'Background', 'billey' ),
	),
	'default'     => array(
		'color'      => '#fff',
		'background' => '#111',
	),
	'output'      => array(
		array(
			'choice'   => 'color',
			'element'  => '.header-more-tools-opened .header-right-inner .mini-cart .mini-cart-icon:after',
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-more-tools-opened .header-right-inner .mini-cart .mini-cart-icon:after',
			'property' => 'background-color',
			'suffix'   => '!important',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => $prefix . 'social_networks_color',
	'label'     => esc_html__( 'Social Networks Color', 'billey' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'normal' => esc_attr__( 'Normal', 'billey' ),
		'hover'  => esc_attr__( 'Hover', 'billey' ),
	),
	'default'   => array(
		'normal' => '#333',
		'hover'  => Billey::PRIMARY_COLOR,
	),
	'output'    => array(
		array(
			'choice'   => 'normal',
			'element'  => '.header-more-tools-opened .header-right-inner .header-social-networks a',
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.header-more-tools-opened .header-right-inner .header-social-networks a:hover',
			'property' => 'color',
			'suffix'   => '!important',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => $prefix . 'button_style',
	'label'    => esc_html__( 'Button Style', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'thick-border',
	'choices'  => Billey_Header::instance()->get_button_style(),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'button_color',
	'label'    => esc_html__( 'Button Color', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '',
	'choices'  => array(
		''       => esc_html__( 'Default', 'billey' ),
		'custom' => esc_html__( 'Custom', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'            => 'multicolor',
	'settings'        => $prefix . 'button_custom_color',
	'label'           => esc_html__( 'Button Color', 'billey' ),
	'description'     => esc_html__( 'Controls the color of button.', 'billey' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'choices'         => array(
		'color'      => esc_attr__( 'Color', 'billey' ),
		'background' => esc_attr__( 'Background', 'billey' ),
		'border'     => esc_attr__( 'Border', 'billey' ),
	),
	'default'         => array(
		'color'      => Billey::PRIMARY_COLOR,
		'background' => 'rgba(0, 0, 0, 0)',
		'border'     => Billey::PRIMARY_COLOR,
	),
	'output'          => array(
		array(
			'choice'   => 'color',
			'element'  => '.header-sticky-button .tm-button',
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => '.header-sticky-button.tm-button',
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-sticky-button.tm-button:before',
			'property' => 'background',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'button_color',
			'operator' => '==',
			'value'    => 'custom',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'            => 'multicolor',
	'settings'        => $prefix . 'button_hover_custom_color',
	'label'           => esc_html__( 'Button Hover Color', 'billey' ),
	'description'     => esc_html__( 'Controls the color of button when hover.', 'billey' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'choices'         => array(
		'color'      => esc_attr__( 'Color', 'billey' ),
		'background' => esc_attr__( 'Background', 'billey' ),
		'border'     => esc_attr__( 'Border', 'billey' ),
	),
	'default'         => array(
		'color'      => '#fff',
		'background' => Billey::PRIMARY_COLOR,
		'border'     => Billey::PRIMARY_COLOR,
	),
	'output'          => array(
		array(
			'choice'   => 'color',
			'element'  => '.header-sticky-button.tm-button:hover',
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => '.header-sticky-button.tm-button:hover',
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-sticky-button.tm-button:after',
			'property' => 'background',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'button_color',
			'operator' => '==',
			'value'    => 'custom',
		),
	),
) );
