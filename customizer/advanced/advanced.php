<?php
$section  = 'advanced';
$priority = 1;
$prefix   = 'advanced_';

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'smooth_scroll_enable',
	'label'       => esc_html__( 'Smooth Scroll', 'billey' ),
	'description' => esc_html__( 'Smooth scrolling experience for websites.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'scroll_top_enable',
	'label'       => esc_html__( 'Go To Top Button', 'billey' ),
	'description' => esc_html__( 'Turn on to show go to top button.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'google_api_key',
	'label'       => esc_html__( 'Google Api Key', 'billey' ),
	'description' => sprintf( wp_kses( __( 'Follow <a href="%s" target="_blank">this link</a> and click <strong>GET A KEY</strong> button.', 'billey' ), array(
		'a'      => array(
			'href'   => array(),
			'target' => array(),
		),
		'strong' => array(),
	) ), esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key' ) ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'AIzaSyDIx6UxZ-cL4yOtvlfTIyVXPV6gI7OAVZc',
	'transport'   => 'postMessage',
) );
