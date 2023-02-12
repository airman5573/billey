<?php
$panel    = 'search';
$priority = 1;

Billey_Kirki::add_section( 'search_page', array(
	'title'    => esc_html__( 'Search Page', 'billey' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Billey_Kirki::add_section( 'search_popup', array(
	'title'    => esc_html__( 'Search Popup', 'billey' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
