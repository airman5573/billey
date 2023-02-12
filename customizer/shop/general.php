<?php
$section  = 'shop_general';
$priority = 1;
$prefix   = 'shop_general_';

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'shop_badge_new',
	'label'       => esc_html__( 'New Badge (Days)', 'billey' ),
	'description' => esc_html__( 'If the product was published within the newness time frame display the new badge.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0'  => esc_html__( 'None', 'billey' ),
		'1'  => esc_html__( '1 day', 'billey' ),
		'2'  => esc_html__( '2 days', 'billey' ),
		'3'  => esc_html__( '3 days', 'billey' ),
		'4'  => esc_html__( '4 days', 'billey' ),
		'5'  => esc_html__( '5 days', 'billey' ),
		'6'  => esc_html__( '6 days', 'billey' ),
		'7'  => esc_html__( '7 days', 'billey' ),
		'8'  => esc_html__( '8 days', 'billey' ),
		'9'  => esc_html__( '9 days', 'billey' ),
		'10' => esc_html__( '10 days', 'billey' ),
		'15' => esc_html__( '15 days', 'billey' ),
		'20' => esc_html__( '20 days', 'billey' ),
		'25' => esc_html__( '25 days', 'billey' ),
		'30' => esc_html__( '30 days', 'billey' ),
		'60' => esc_html__( '60 days', 'billey' ),
		'90' => esc_html__( '90 days', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'shop_badge_hot',
	'label'    => esc_html__( 'Hot Badge', 'billey' ),
	'tooltip'  => esc_html__( 'Show a "hot" label when product set featured.', 'billey' ),
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
	'settings' => 'shop_badge_sale',
	'label'    => esc_html__( 'Sale Badge', 'billey' ),
	'tooltip'  => esc_html__( 'Show a "sale" or "sale percent" label when product on sale.', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'billey' ),
		'1' => esc_html__( 'Show', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Colors', 'billey' ) . '</div>',
) );

Billey_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => 'shop_badge_new_color',
	'label'     => esc_html__( 'New Badge Color', 'billey' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'color'      => esc_attr__( 'Color', 'billey' ),
		'background' => esc_attr__( 'Background', 'billey' ),
	),
	'default'   => array(
		'color'      => '#fff',
		'background' => '#111',
	),
	'output'    => array(
		array(
			'choice'   => 'color',
			'element'  => '.woocommerce .product-badges .new',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.woocommerce .product-badges .new',
			'property' => 'background-color',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => 'shop_badge_hot_color',
	'label'     => esc_html__( 'Hot Badge Color', 'billey' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'color'      => esc_attr__( 'Color', 'billey' ),
		'background' => esc_attr__( 'Background', 'billey' ),
	),
	'default'   => array(
		'color'      => '#fff',
		'background' => '#D0021B',
	),
	'output'    => array(
		array(
			'choice'   => 'color',
			'element'  => '.woocommerce .product-badges .hot',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.woocommerce .product-badges .hot',
			'property' => 'background-color',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => 'shop_badge_sale_color',
	'label'     => esc_html__( 'Sale Badge Color', 'billey' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'color'      => esc_attr__( 'Color', 'billey' ),
		'background' => esc_attr__( 'Background', 'billey' ),
	),
	'default'   => array(
		'color'      => '#fff',
		'background' => '#38CB89',
	),
	'output'    => array(
		array(
			'choice'   => 'color',
			'element'  => '.woocommerce .product-badges .onsale',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.woocommerce .product-badges .onsale',
			'property' => 'background-color',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => 'shop_price_color',
	'label'     => esc_html__( 'Price Color', 'billey' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'regular' => esc_attr__( 'Regular Price', 'billey' ),
		'old'     => esc_attr__( 'Old Price', 'billey' ),
		'sale'    => esc_attr__( 'Sale Price', 'billey' ),
	),
	'default'   => array(
		'regular' => '#111',
		'old'     => '#ababab',
		'sale'    => '#D0021B',
	),
	'output'    => array(
		array(
			'choice'   => 'regular',
			'element'  => '
			.price,
			.amount,
			.tr-price,
			.woosw-content-item--price
			',
			'property' => 'color',
		),
		array(
			'choice'   => 'old',
			'element'  => '
			.price del,
			del .amount,
			.tr-price del,
			.woosw-content-item--price del
			',
			'property' => 'color',
		),
		array(
			'choice'   => 'sale',
			'element'  => 'ins .amount',
			'property' => 'color',
		),
	),
) );
