<?php
$panel    = 'top_bar';
$priority = 1;

Billey_Kirki::add_section( 'top_bar', array(
	'title'    => esc_html__( 'General', 'billey' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Billey_Kirki::add_section( 'top_bar_style_01', array(
	'title'    => esc_html__( 'Top Bar Style 01', 'billey' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Billey_Kirki::add_section( 'top_bar_style_02', array(
	'title'    => esc_html__( 'Top Bar Style 02', 'billey' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
