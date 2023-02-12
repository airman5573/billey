<?php
$section  = 'blog_archive';
$priority = 1;
$prefix   = 'blog_archive_';

$sidebar_positions   = Billey_Helper::get_list_sidebar_positions();
$registered_sidebars = Billey_Helper::get_registered_sidebars();

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Header', 'billey' ) . '</div>',
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'blog_archive_header_type',
	'label'       => esc_html__( 'Header Style', 'billey' ),
	'description' => esc_html__( 'Select header style that displays on blog archive pages.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => Billey_Header::instance()->get_list( true, esc_html__( 'Use Global Header Style', 'billey' ) ),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'blog_archive_header_overlay',
	'label'    => esc_html__( 'Header Overlay', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '',
	'choices'  => array(
		''  => esc_html__( 'Use Global', 'billey' ),
		'0' => esc_html__( 'No', 'billey' ),
		'1' => esc_html__( 'Yes', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'blog_archive_header_skin',
	'label'    => esc_html__( 'Header Skin', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '',
	'choices'  => array(
		''      => esc_html__( 'Use Global', 'billey' ),
		'dark'  => esc_html__( 'Dark', 'billey' ),
		'light' => esc_html__( 'Light', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Page Title Bar', 'billey' ) . '</div>',
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'blog_archive_title_bar_layout',
	'label'       => esc_html__( 'Title Bar Style', 'billey' ),
	'description' => esc_html__( 'Select default Title Bar that displays on archive blog pages.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'choices'     => Billey_Helper::get_title_bar_list( true, esc_html__( 'Use Global Title Bar', 'billey' ) ),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Sidebar', 'billey' ) . '</div>',
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'blog_archive_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'billey' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on blog archive pages.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'blog_sidebar',
	'choices'     => $registered_sidebars,
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'blog_archive_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'billey' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on blog archive pages.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'blog_archive_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Others', 'billey' ) . '</div>',
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'blog_archive_style',
	'label'       => esc_html__( 'Blog Style', 'billey' ),
	'description' => esc_html__( 'Select blog style that display for archive pages.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'grid',
	'choices'     => array(
		'grid' => esc_attr__( 'Grid', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'            => 'custom',
	'settings'        => $prefix . 'group_title_' . $priority++,
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => '<div class="group_title">' . esc_html__( 'Grid Columns', 'billey' ) . '</div>',
	'active_callback' => array(
		array(
			'setting'  => 'blog_archive_style',
			'operator' => '==',
			'value'    => 'grid',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'            => 'slider',
	'settings'        => 'blog_archive_lg_columns',
	'label'           => esc_html__( 'Large Device', 'billey' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => 2,
	'transport'       => 'auto',
	'choices'         => array(
		'min'  => 0,
		'max'  => 6,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => 'blog_archive_style',
			'operator' => '==',
			'value'    => 'grid',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'            => 'slider',
	'settings'        => 'blog_archive_md_columns',
	'label'           => esc_html__( 'Medium Device', 'billey' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => 2,
	'transport'       => 'auto',
	'choices'         => array(
		'min'  => 0,
		'max'  => 6,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => 'blog_archive_style',
			'operator' => '==',
			'value'    => 'grid',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'            => 'slider',
	'settings'        => 'blog_archive_sm_columns',
	'label'           => esc_html__( 'Small Device', 'billey' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => 1,
	'transport'       => 'auto',
	'choices'         => array(
		'min'  => 0,
		'max'  => 6,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => 'blog_archive_style',
			'operator' => '==',
			'value'    => 'grid',
		),
	),
) );
