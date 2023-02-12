<?php
$section  = 'single_portfolio';
$priority = 1;
$prefix   = 'single_portfolio_';

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
	'settings'    => 'portfolio_single_header_type',
	'label'       => esc_html__( 'Header Style', 'billey' ),
	'description' => esc_html__( 'Select default header style that displays on all single portfolio pages.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => Billey_Header::instance()->get_list( true, esc_html__( 'Use Global Header Style', 'billey' ) ),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'portfolio_single_header_overlay',
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
	'settings' => 'portfolio_single_header_skin',
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
	'settings'    => 'portfolio_single_title_bar_layout',
	'label'       => esc_html__( 'Page Title Bar', 'billey' ),
	'description' => esc_html__( 'Select default Title Bar that displays on all single portfolio pages.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'choices'     => Billey_Helper::get_title_bar_list( true, esc_html__( 'Use Global Title Bar', 'billey' ) ),
	'default'     => 'none',
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
	'settings'    => 'portfolio_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'billey' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on single portfolio pages.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'billey' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on single portfolio pages.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'portfolio_page_sidebar_position',
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
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_sticky_detail_enable',
	'label'       => esc_html__( 'Sticky Detail Column', 'billey' ),
	'description' => esc_html__( 'Turn on to enable sticky of detail column.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'billey' ),
		'1' => esc_html__( 'On', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_portfolio_site_skin',
	'label'       => esc_html__( 'Site Skin', 'billey' ),
	'description' => esc_html__( 'Select skin of all single portfolio post pages.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'light',
	'choices'     => array(
		'dark'  => esc_html__( 'Dark', 'billey' ),
		'light' => esc_html__( 'Light', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_portfolio_style',
	'label'       => esc_html__( 'Single Portfolio Style', 'billey' ),
	'description' => esc_html__( 'Select style of all single portfolio post pages.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'image-list',
	'choices'     => array(
		'blank'           => esc_html__( 'Blank (Build with Elementor)', 'billey' ),
		'image-list'      => esc_html__( 'Image List', 'billey' ),
		'image-list-wide' => esc_html__( 'Image List - Wide', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_portfolio_video_enable',
	'label'       => esc_html__( 'Video', 'billey' ),
	'description' => esc_html__( 'Controls the video visibility on portfolio post pages.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => array(
		'none'  => esc_html__( 'Hide', 'billey' ),
		'above' => esc_html__( 'Show Above Feature Image', 'billey' ),
		'below' => esc_html__( 'Show Below Feature Image', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_feature_caption',
	'label'       => esc_html__( 'Image Caption', 'billey' ),
	'description' => esc_html__( 'Turn on to display comments on single portfolio posts.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Hide', 'billey' ),
		'1' => esc_html__( 'Show', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_comment_enable',
	'label'       => esc_html__( 'Comments', 'billey' ),
	'description' => esc_html__( 'Turn on to display comments on single portfolio posts.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'billey' ),
		'1' => esc_html__( 'On', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_categories_enable',
	'label'       => esc_html__( 'Categories', 'billey' ),
	'description' => esc_html__( 'Turn on to display categories on single portfolio posts.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'billey' ),
		'1' => esc_html__( 'On', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_tags_enable',
	'label'       => esc_html__( 'Tags', 'billey' ),
	'description' => esc_html__( 'Turn on to display tags on single portfolio posts.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'billey' ),
		'1' => esc_html__( 'On', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_share_enable',
	'label'       => esc_html__( 'Share', 'billey' ),
	'description' => esc_html__( 'Turn on to display Share list on single portfolio posts.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'billey' ),
		'1' => esc_html__( 'On', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_related_enable',
	'label'       => esc_html__( 'Related Portfolio', 'billey' ),
	'description' => esc_html__( 'Turn on this option to display related portfolio section.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'billey' ),
		'1' => esc_html__( 'On', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'            => 'text',
	'settings'        => 'portfolio_related_title',
	'label'           => esc_html__( 'Related Title Section', 'billey' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => esc_html__( 'Related Projects', 'billey' ),
	'active_callback' => array(
		array(
			'setting'  => 'single_portfolio_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'            => 'multicheck',
	'settings'        => 'portfolio_related_by',
	'label'           => esc_attr__( 'Related By', 'billey' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => array( 'portfolio_category' ),
	'choices'         => array(
		'portfolio_category' => esc_html__( 'Portfolio Category', 'billey' ),
		'portfolio_tags'     => esc_html__( 'Portfolio Tags', 'billey' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'single_portfolio_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'            => 'number',
	'settings'        => 'portfolio_related_number',
	'label'           => esc_html__( 'Number related portfolio', 'billey' ),
	'description'     => esc_html__( 'Controls the number of related portfolio', 'billey' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => 5,
	'choices'         => array(
		'min'  => 3,
		'max'  => 30,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => 'single_portfolio_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_portfolio_pagination',
	'label'       => esc_html__( 'Previous/Next Pagination', 'billey' ),
	'description' => esc_html__( 'Select type of previous/next portfolio pagination on single portfolio posts.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '01',
	'choices'     => array(
		'none' => esc_html__( 'None', 'billey' ),
		'01'   => esc_html__( 'Style 01', 'billey' ),
		'02'   => esc_html__( 'Style 02', 'billey' ),
		'03'   => esc_html__( 'Style 03', 'billey' ),
	),
) );
