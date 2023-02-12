<?php
$section  = 'portfolio_parallel_scroll_showcase';
$priority = 1;
$prefix   = 'portfolio_parallel_scroll_showcase_';

$categories = $tags = [];

if ( is_customize_preview() ) {
	$categories = Billey_Portfolio::instance()->get_categories();
	$tags       = Billey_Portfolio::instance()->get_tags();
}

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'categories',
	'label'       => esc_html__( 'Filter By Cats', 'billey' ),
	'description' => esc_html__( 'Select categories to filter by.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'multiple'    => 1000,
	'choices'     => $categories,
	'default'     => [],
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'tags',
	'label'       => esc_html__( 'Filter By Tags', 'billey' ),
	'description' => esc_html__( 'Select tags to filter by.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'multiple'    => 1000,
	'choices'     => $tags,
	'default'     => [],
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => $prefix . 'number',
	'label'       => esc_html__( 'Number portfolios', 'billey' ),
	'description' => esc_html__( 'Controls the number of portfolios display on this template.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 10,
	'choices'     => array(
		'min'  => 3,
		'max'  => 30,
		'step' => 1,
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => $prefix . 'title',
	'label'    => esc_html__( 'Title', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => esc_html__( 'Create with colors & shapes', 'billey' ),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'textarea',
	'settings' => $prefix . 'description',
	'label'    => esc_html__( 'Description', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => esc_html__( 'Be amazed by Billey\'s breathtakingly outstanding portfolios which highlight creativity.', 'billey' ),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'textarea',
	'settings' => $prefix . 'copyright_text',
	'label'    => esc_html__( 'Copyright Text', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => esc_html__( '&copy; 2020 BilleyTheme by Thememove.', 'billey' ),
) );
