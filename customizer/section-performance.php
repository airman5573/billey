<?php
$section  = 'performance';
$priority = 1;
$prefix   = 'performance_';

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'disable_emoji',
	'label'       => esc_html__( 'Disable Emojis', 'billey' ),
	'description' => esc_html__( 'Remove Wordpress Emojis functionality.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'disable_embeds',
	'label'       => esc_html__( 'Disable Embeds', 'billey' ),
	'description' => esc_html__( 'Remove Wordpress Embeds functionality.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'disable_woo_scripts',
	'label'       => esc_html__( 'Disable Woocommerce', 'billey' ),
	'description' => esc_html__( 'Disable all Woocommerce styles & scripts. Except (shop, cart, checkout) pages. You can enable for other specify post/page below.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 0,
) );

Billey_Kirki::add_field( 'theme', array(
	'type'            => 'text',
	'settings'        => 'woo_scripts_on',
	'label'           => esc_html__( 'Woocommerce Scripts On', 'billey' ),
	'description'     => esc_html__( 'Input post/page id that you want to enable woocommerce styles & scripts. Separate with a comma.', 'billey' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => '',
	'active_callback' => array(
		array(
			'setting'  => 'disable_woo_scripts',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
