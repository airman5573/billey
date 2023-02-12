<?php
$section  = 'title_bar';
$priority = 1;
$prefix   = 'title_bar_';

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'layout',
	'label'       => esc_html__( 'Global Title Bar', 'billey' ),
	'description' => esc_html__( 'Select default title bar that displays on all pages.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '01',
	'choices'     => Billey_Helper::get_title_bar_list(),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Heading', 'billey' ) . '</div>',
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'search_title',
	'label'       => esc_html__( 'Search Heading', 'billey' ),
	'description' => esc_html__( 'Enter text prefix that displays on search results page.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Search results for: ', 'billey' ),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'home_title',
	'label'       => esc_html__( 'Home Heading', 'billey' ),
	'description' => esc_html__( 'Enter text that displays on front latest posts page.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Blog', 'billey' ),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_category_title',
	'label'       => esc_html__( 'Archive Category Heading', 'billey' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive category page.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Category: ', 'billey' ),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_tag_title',
	'label'       => esc_html__( 'Archive Tag Heading', 'billey' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive tag page.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Tag: ', 'billey' ),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_author_title',
	'label'       => esc_html__( 'Archive Author Heading', 'billey' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive author page.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Author: ', 'billey' ),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_year_title',
	'label'       => esc_html__( 'Archive Year Heading', 'billey' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive year page.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Year: ', 'billey' ),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_month_title',
	'label'       => esc_html__( 'Archive Month Heading', 'billey' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive month page.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Month: ', 'billey' ),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_day_title',
	'label'       => esc_html__( 'Archive Day Heading', 'billey' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive day page.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Day: ', 'billey' ),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'single_blog_title',
	'label'       => esc_html__( 'Single Blog Heading', 'billey' ),
	'description' => esc_html__( 'Enter text that displays on single blog posts. Leave blank to use post title.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Blog', 'billey' ),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_portfolio_title',
	'label'       => esc_html__( 'Archive Portfolio Heading', 'billey' ),
	'description' => esc_html__( 'Enter text that displays on archive portfolio pages.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Portfolios', 'billey' ),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'single_portfolio_title',
	'label'       => esc_html__( 'Single Portfolio Heading', 'billey' ),
	'description' => esc_html__( 'Enter text that displays on single portfolio pages. Leave blank to use portfolio title.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Portfolio', 'billey' ),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'single_product_title',
	'label'       => esc_html__( 'Single Product Heading', 'billey' ),
	'description' => esc_html__( 'Enter text that displays on single product pages. Leave blank to use product title.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Shop', 'billey' ),
) );
