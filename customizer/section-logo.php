<?php
$section  = 'logo';
$priority = 1;
$prefix   = 'logo_';

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'logo',
	'label'       => esc_html__( 'Default Logo', 'billey' ),
	'description' => esc_html__( 'Choose default logo.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'logo_dark',
	'choices'     => array(
		'logo_dark'  => esc_html__( 'Dark Logo', 'billey' ),
		'logo_light' => esc_html__( 'Light Logo', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'image',
	'settings' => 'logo_dark',
	'label'    => esc_html__( 'Dark Version', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => array(
		'url' => BILLEY_THEME_IMAGE_URI . '/logo/dark-logo.png',
	),
	'choices'  => array(
		'save_as' => 'array',
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'image',
	'settings' => 'logo_light',
	'label'    => esc_html__( 'Light Version', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => array(
		'url' => BILLEY_THEME_IMAGE_URI . '/logo/light-logo.png',
	),
	'choices'  => array(
		'save_as' => 'array',
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'logo_width',
	'label'       => esc_html__( 'Logo Width', 'billey' ),
	'description' => esc_html__( 'For e.g: 200', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '95',
	'output'      => array(
		array(
			'element'  => '.branding__logo img,
			.error404--header .branding__logo img
			',
			'property' => 'width',
			'units'    => 'px',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'spacing',
	'settings'    => $prefix . 'padding',
	'label'       => esc_html__( 'Logo Padding', 'billey' ),
	'description' => esc_html__( 'For e.g: 30px 0px 30px 0px', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'top'    => '15px',
		'right'  => '0px',
		'bottom' => '15px',
		'left'   => '0px',
	),
	'output'      => array(
		array(
			'element'  => '.branding__logo img',
			'property' => 'padding',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Sticky Logo', 'billey' ) . '</div>',
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => 'sticky_logo_width',
	'label'       => esc_html__( 'Logo Width', 'billey' ),
	'description' => esc_html__( 'Controls the width of sticky header logo. For e.g: 120', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '95',
	'output'      => array(
		array(
			'element'  => '
			.header-sticky-both .headroom.headroom--not-top .branding img,
			.header-sticky-up .headroom.headroom--not-top.headroom--pinned .branding img,
			.header-sticky-down .headroom.headroom--not-top.headroom--unpinned .branding img
			',
			'property' => 'width',
			'units'    => 'px',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'spacing',
	'settings'    => 'sticky_logo_padding',
	'label'       => esc_html__( 'Logo Padding', 'billey' ),
	'description' => esc_html__( 'Controls the padding of sticky header logo.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'top'    => '0',
		'right'  => '0',
		'bottom' => '0',
		'left'   => '0',
	),
	'output'      => array(
		array(
			'element'  => '.headroom--not-top .branding__logo .sticky-logo',
			'property' => 'padding',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Mobile Menu Logo', 'billey' ) . '</div>',
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'image',
	'settings'    => 'mobile_menu_logo',
	'label'       => esc_html__( 'Logo', 'billey' ),
	'description' => esc_html__( 'Select an image file for mobile menu logo.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'url' => BILLEY_THEME_IMAGE_URI . '/logo/dark-logo.png',
	),
	'choices'     => array(
		'save_as' => 'array',
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'mobile_logo_width',
	'label'       => esc_html__( 'Logo Width', 'billey' ),
	'description' => esc_html__( 'Controls the width of mobile menu logo. For e.g: 120', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '95',
	'output'      => array(
		array(
			'element'  => '.page-mobile-popup-logo img',
			'property' => 'width',
			'units'    => 'px',
		),
	),
) );
