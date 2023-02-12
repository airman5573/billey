<?php
$panel    = 'blog';
$priority = 1;

Billey_Kirki::add_section( 'blog_archive', array(
	'title'    => esc_html__( 'Blog Archive', 'billey' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Billey_Kirki::add_section( 'blog_single', array(
	'title'    => esc_html__( 'Blog Single Post', 'billey' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
