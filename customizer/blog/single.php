<?php
$section  = 'blog_single';
$priority = 1;
$prefix   = 'single_post_';

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
	'settings'    => 'blog_single_header_type',
	'label'       => esc_html__( 'Header Style', 'billey' ),
	'description' => esc_html__( 'Select default header style that displays on all single blog post pages.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => Billey_Header::instance()->get_list( true, esc_html__( 'Use Global Header Style', 'billey' ) ),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'blog_single_header_overlay',
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
	'settings' => 'blog_single_header_skin',
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
	'settings'    => 'blog_single_title_bar_layout',
	'label'       => esc_html__( 'Title Bar Style', 'billey' ),
	'description' => esc_html__( 'Select default Title Bar that displays on all single blog post pages.', 'billey' ),
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
	'settings'    => 'post_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'billey' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on single blog post pages.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'blog_sidebar',
	'choices'     => $registered_sidebars,
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'post_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'billey' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on single blog post pages.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'post_page_sidebar_position',
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
	'settings'    => 'single_post_style',
	'label'       => esc_html__( 'Style', 'billey' ),
	'description' => esc_html__( 'Select default single blog style', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'standard',
	'choices'     => array(
		'standard' => esc_html__( 'Standard', 'billey' ),
		'modern'   => esc_html__( 'Modern', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_feature_enable',
	'label'    => esc_html__( 'Featured Image', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'billey' ),
		'1' => esc_html__( 'Show', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_title_enable',
	'label'    => esc_html__( 'Post Title', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'billey' ),
		'1' => esc_html__( 'Show', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_categories_enable',
	'label'    => esc_html__( 'Categories', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'billey' ),
		'1' => esc_html__( 'Show', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_tags_enable',
	'label'    => esc_html__( 'Tags', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'billey' ),
		'1' => esc_html__( 'Show', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_date_enable',
	'label'    => esc_html__( 'Post Meta Date', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'billey' ),
		'1' => esc_html__( 'Show', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_comment_count_enable',
	'label'    => esc_html__( 'Comment Count', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'billey' ),
		'1' => esc_html__( 'Show', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_author_enable',
	'label'    => esc_html__( 'Author Meta', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'billey' ),
		'1' => esc_html__( 'Show', 'billey' ),
	),
) );

Billey_Customize::instance()->field_social_sharing_enable( array(
	'settings' => 'single_post_share_enable',
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_author_box_enable',
	'label'    => esc_html__( 'Author Info Box', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'billey' ),
		'1' => esc_html__( 'Show', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_pagination_enable',
	'label'    => esc_html__( 'Previous/Next Pagination', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'billey' ),
		'1' => esc_html__( 'Show', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_related_enable',
	'label'    => esc_html__( 'Related Post', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'billey' ),
		'1' => esc_html__( 'Show', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'            => 'number',
	'settings'        => 'single_post_related_number',
	'label'           => esc_html__( 'Number of related posts item', 'billey' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => 10,
	'choices'         => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => 'single_post_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_comment_enable',
	'label'    => esc_html__( 'Comments List/Form', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'billey' ),
		'1' => esc_html__( 'Show', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'button_return_text',
	'label'       => esc_html__( 'Button Return Text', 'billey' ),
	'description' => esc_html__( 'Control the text of button return to blog archive page.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Back', 'billey' ),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'button_return_link',
	'label'       => esc_html__( 'Button Return Link', 'billey' ),
	'description' => esc_html__( 'Control the link of button return to blog archive page.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '#',
) );
