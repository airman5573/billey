<?php
$panel    = 'advanced';
$priority = 1;

Billey_Kirki::add_section( 'advanced', array(
	'title'    => esc_html__( 'Advanced', 'billey' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Billey_Kirki::add_section( 'light_gallery', array(
	'title'    => esc_html__( 'Light Gallery', 'billey' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
