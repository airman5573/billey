<?php
$panel    = 'navigation';
$priority = 1;

Billey_Kirki::add_section( 'navigation', array(
	'title'    => esc_html__( 'Desktop Menu', 'billey' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Billey_Kirki::add_section( 'navigation_minimal_01', array(
	'title'    => esc_html__( 'Off Canvas Menu', 'billey' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Billey_Kirki::add_section( 'navigation_mobile', array(
	'title'    => esc_html__( 'Mobile Menu', 'billey' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
