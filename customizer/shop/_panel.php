<?php
$panel    = 'shop';
$priority = 1;

Billey_Kirki::add_section( 'shop_general', array(
	'title'    => esc_html__( 'General', 'billey' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Billey_Kirki::add_section( 'shop_archive', array(
	'title'    => esc_html__( 'Shop Archive', 'billey' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Billey_Kirki::add_section( 'shop_single', array(
	'title'    => esc_html__( 'Shop Single', 'billey' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Billey_Kirki::add_section( 'shopping_cart', array(
	'title'    => esc_html__( 'Shopping Cart', 'billey' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Billey_Kirki::add_section( 'woo_my_account', array(
	'title'    => esc_html__( 'My Account', 'billey' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
