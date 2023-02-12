<?php
$section  = 'header';
$priority = 1;
$prefix   = 'header_';

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'global_header',
	'label'       => esc_html__( 'Global Header Style', 'billey' ),
	'description' => esc_html__( 'Select default header style for your site.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '01',
	'choices'     => Billey_Header::instance()->get_list(),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'global_header_overlay',
	'label'    => esc_html__( 'Global Header Overlay', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'No', 'billey' ),
		'1' => esc_html__( 'Yes', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'global_header_skin',
	'label'    => esc_html__( 'Header Skin', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'dark',
	'choices'  => array(
		'dark'  => esc_html__( 'Dark', 'billey' ),
		'light' => esc_html__( 'Light', 'billey' ),
	),
) );
