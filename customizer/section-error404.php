<?php
$section  = 'error404_page';
$priority = 1;
$prefix   = 'error404_page_';

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => 'error404_page_background_body',
	'label'       => esc_html__( 'Background', 'billey' ),
	'description' => esc_html__( 'Controls outer background area in boxed mode.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '#FFE9D9',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'fixed',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.error404',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'image',
	'settings' => 'error404_page_image',
	'label'    => esc_html__( 'Image', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => BILLEY_THEME_IMAGE_URI . '/page-404-image.png',
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'error404_page_title',
	'label'       => esc_html__( 'Title', 'billey' ),
	'description' => esc_html__( 'Controls the title that display on error 404 page.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'ERROR 404', 'billey' ),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => 'error404_page_text',
	'label'       => esc_html__( 'Text', 'billey' ),
	'description' => esc_html__( 'Controls the text that display below title', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Ooops, something went wrong', 'billey' ),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'      => 'kirki_typography',
	'settings'  => 'error404_page_title_typography',
	'label'     => esc_html__( 'Title Typography', 'billey' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => array(
		'font-family'    => Billey::PRIMARY_FONT,
		'variant'        => '700',
		'font-size'      => '46px',
		'line-height'    => '1.29',
		'letter-spacing' => '0em',
		'text-transform' => 'uppercase',
		'color'          => '#383FC1',
	),
	'output'    => array(
		array(
			'element' => '.error404 .error-404-title',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'      => 'kirki_typography',
	'settings'  => 'error404_page_text_typography',
	'label'     => esc_html__( 'Text Typography', 'billey' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => array(
		'font-family'    => Billey::SECONDARY_FONT,
		'variant'        => '500',
		'font-size'      => '22px',
		'line-height'    => '1.4',
		'letter-spacing' => '0em',
		'text-transform' => '',
		'color'          => '#111',
	),
	'output'    => array(
		array(
			'element' => '.error404 .error-404-text',
		),
	),
) );
