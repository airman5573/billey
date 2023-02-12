<?php
$section  = 'navigation';
$priority = 1;
$prefix   = 'navigation_';

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Main Menu Dropdown', 'billey' ) . '</div>',
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'dropdown_link_typography',
	'label'       => esc_html__( 'Typography', 'billey' ),
	'description' => esc_html__( 'Controls the typography for all dropdown menu items.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '400',
		'line-height'    => '1.38',
		'letter-spacing' => '0em',
		'text-transform' => 'none',
	),
	'output'      => array(
		array(
			'element' => '
			.sm-simple .children a,
			.sm-simple .children .menu-item-title
			',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'dropdown_link_font_size',
	'label'       => esc_html__( 'Font Size', 'billey' ),
	'description' => esc_html__( 'Controls the font size for dropdown menu items.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 16,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '.sm-simple .children a',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Styling
--------------------------------------------------------------*/

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'dropdown_bg_color',
	'label'       => esc_html__( 'Background', 'billey' ),
	'description' => esc_html__( 'Controls the background color for dropdown menu', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => array(
				'.sm-simple .children',
				'.primary-menu-sub-visual',
			),
			'property' => 'background-color',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'dropdown_border_bottom_color',
	'label'       => esc_html__( 'Border Bottom', 'billey' ),
	'description' => esc_html__( 'Controls the border bottom color for dropdown menu', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Billey::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => array(
				'.desktop-menu .sm-simple .children:after',
				'.primary-menu-sub-visual:after',
			),
			'property' => 'background-color',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'dropdown_box_shadow',
	'label'       => esc_html__( 'Box Shadow', 'billey' ),
	'description' => esc_html__( 'Input valid box-shadow for dropdown menu. For e.g: "0 0 37px rgba(0, 0, 0, .07)"', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0 2px 29px rgba(0, 0, 0, 0.05)',
	'output'      => array(
		array(
			'element'  => array(
				'.sm-simple .children',
				'.primary-menu-sub-visual',
			),
			'property' => 'box-shadow',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'dropdown_link_color',
	'label'       => esc_html__( 'Link Color', 'billey' ),
	'description' => esc_html__( 'Controls the color for dropdown menu items.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'normal' => esc_attr__( 'Normal', 'billey' ),
		'hover'  => esc_attr__( 'Hover', 'billey' ),
	),
	'default'     => array(
		'normal' => '#777',
		'hover'  => '#111',
	),
	'output'      => array(
		array(
			'choice'   => 'normal',
			'element'  => '.sm-simple .children a',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '
				.sm-simple .children li:hover > a,
				.sm-simple .children li:hover > a:after,
				.sm-simple .children li.current-menu-item > a,
				.sm-simple .children li.current-menu-ancestor > a
			',
			'property' => 'color',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'dropdown_link_hover_bg_color',
	'label'       => esc_html__( 'Hover Background', 'billey' ),
	'description' => esc_html__( 'Controls the background color when hover for dropdown menu items.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba(255, 255, 255, 0)',
	'output'      => array(
		array(
			'element'  => array(
				'.sm-simple .children li:hover > a',
				'.sm-simple .children li.current-menu-item > a',
				'.sm-simple .children li.current-menu-ancestor > a',
			),
			'property' => 'background-color',
		),
	),
) );
