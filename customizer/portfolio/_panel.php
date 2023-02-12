<?php
$panel    = 'portfolio';
$priority = 1;

Billey_Kirki::add_section( 'archive_portfolio', array(
	'title'    => esc_html__( 'Archive', 'billey' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Billey_Kirki::add_section( 'single_portfolio', array(
	'title'    => esc_html__( 'Single', 'billey' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Billey_Kirki::add_section( 'portfolio_parallel_scroll_showcase_', array(
	'title'    => esc_html__( 'Template: Parallel Scroll Showcase', 'billey' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
