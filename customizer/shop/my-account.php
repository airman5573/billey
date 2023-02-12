<?php
$section  = 'woo_my_account';
$priority = 1;
$prefix   = 'page_my_account_';

$sidebar_positions   = Billey_Helper::get_list_sidebar_positions();
$registered_sidebars = Billey_Helper::get_registered_sidebars();

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Header', 'billey' ) . '</div>',
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'page_my_account_header_type',
	'label'       => esc_html__( 'Header Style', 'billey' ),
	'description' => esc_html__( 'Select header style that displays on login & register page.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '04',
	'choices'     => Billey_Header::instance()->get_list( true, esc_html__( 'Use Global Header Style', 'billey' ) ),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'page_my_account_header_overlay',
	'label'    => esc_html__( 'Header Overlay', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		''  => esc_html__( 'Use Global', 'billey' ),
		'0' => esc_html__( 'No', 'billey' ),
		'1' => esc_html__( 'Yes', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'page_my_account_header_skin',
	'label'    => esc_html__( 'Header Skin', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'dark',
	'choices'  => array(
		''      => esc_html__( 'Use Global', 'billey' ),
		'dark'  => esc_html__( 'Dark', 'billey' ),
		'light' => esc_html__( 'Light', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Page Title Bar', 'billey' ) . '</div>',
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'page_my_account_title_bar_layout',
	'label'       => esc_html__( 'Title Bar Style', 'billey' ),
	'description' => esc_html__( 'Select Title Bar that displays on login & register page.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => Billey_Helper::get_title_bar_list( true, esc_html__( 'Use Global Title Bar', 'billey' ) ),
) );
