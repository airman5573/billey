<?php
$panel    = 'title_bar';
$priority = 1;

Billey_Kirki::add_section( 'title_bar', array(
	'title'    => esc_html__( 'General', 'billey' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Billey_Kirki::add_section( 'title_bar_01', array(
	'title'    => esc_html__( 'Style 01', 'billey' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
