<?php
$section  = 'shop_archive';
$priority = 1;
$prefix   = 'shop_archive_';

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
	'settings'    => 'product_archive_header_type',
	'label'       => esc_html__( 'Header Style', 'billey' ),
	'description' => esc_html__( 'Select default header style that displays on archive product page.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => Billey_Header::instance()->get_list( true, esc_html__( 'Use Global Header Style', 'billey' ) ),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'product_archive_header_overlay',
	'label'    => esc_html__( 'Header Overlay', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		''  => esc_html__( 'Use Global', 'billey' ),
		'0' => esc_html__( 'No', 'billey' ),
		'1' => esc_html__( 'Yes', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'product_archive_header_skin',
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
	'settings'    => 'product_archive_title_bar_layout',
	'label'       => esc_html__( 'Title Bar Style', 'billey' ),
	'description' => esc_html__( 'Select default Title Bar that displays on all archive product (included cart, checkout, my-account...) pages.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '01',
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
	'settings'    => 'product_archive_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'billey' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on product archive pages.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'shop_sidebar',
	'choices'     => $registered_sidebars,
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_archive_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'billey' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on product archive pages.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'product_archive_page_sidebar_position',
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
	'type'     => 'radio-buttonset',
	'settings' => 'shop_archive_layout',
	'label'    => esc_html__( 'Layout', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'boxed',
	'choices'  => array(
		'boxed' => esc_html__( 'Boxed', 'billey' ),
		'wide'  => esc_html__( 'Wide', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop_archive_sorting',
	'label'       => esc_html__( 'Sorting & Results Text', 'billey' ),
	'description' => esc_html__( 'Turn on to show sorting select options & results text that displays above products list.', 'billey' ),
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
	'settings'    => 'shop_archive_hover_image',
	'label'       => esc_html__( 'Hover Image', 'billey' ),
	'description' => esc_html__( 'Turn on to show first gallery image when hover', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'None', 'billey' ),
		'1' => esc_html__( 'Yes', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop_archive_quick_view',
	'label'       => esc_html__( 'Quick View', 'billey' ),
	'description' => esc_html__( 'Turn on to display quick view button', 'billey' ),
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
	'settings'    => 'shop_archive_compare',
	'label'       => esc_html__( 'Compare', 'billey' ),
	'description' => esc_html__( 'Turn on to display compare button', 'billey' ),
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
	'settings'    => 'shop_archive_wishlist',
	'label'       => esc_html__( 'Wishlist', 'billey' ),
	'description' => esc_html__( 'Turn on to display love button', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'billey' ),
		'1' => esc_html__( 'On', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'shop_archive_number_item',
	'label'       => esc_html__( 'Number items', 'billey' ),
	'description' => esc_html__( 'Controls the number of products display on shop archive page', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 8,
	'choices'     => array(
		'min'  => 1,
		'max'  => 50,
		'step' => 1,
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Shop Columns', 'billey' ) . '</div>',
) );

Billey_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'shop_archive_lg_columns',
	'label'     => esc_html__( 'Large Device', 'billey' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 2,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 6,
		'step' => 1,
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'shop_archive_md_columns',
	'label'     => esc_html__( 'Medium Device', 'billey' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 2,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 6,
		'step' => 1,
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'shop_archive_sm_columns',
	'label'     => esc_html__( 'Small Device', 'billey' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 1,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 6,
		'step' => 1,
	),
) );
