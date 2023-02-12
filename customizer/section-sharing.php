<?php
$section  = 'social_sharing';
$priority = 1;
$prefix   = 'social_sharing_';

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'multicheck',
	'settings'    => $prefix . 'item_enable',
	'label'       => esc_attr__( 'Sharing Links', 'billey' ),
	'description' => esc_html__( 'Check to the box to enable social share links.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array( 'facebook', 'twitter', 'linkedin', 'tumblr' ),
	'choices'     => array(
		'facebook' => esc_attr__( 'Facebook', 'billey' ),
		'twitter'  => esc_attr__( 'Twitter', 'billey' ),
		'linkedin' => esc_attr__( 'Linkedin', 'billey' ),
		'tumblr'   => esc_attr__( 'Tumblr', 'billey' ),
		'email'    => esc_attr__( 'Email', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'sortable',
	'settings'    => $prefix . 'order',
	'label'       => esc_attr__( 'Order', 'billey' ),
	'description' => esc_html__( 'Controls the order of social share links.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'facebook',
		'twitter',
		'linkedin',
		'tumblr',
		'email',
	),
	'choices'     => array(
		'facebook' => esc_attr__( 'Facebook', 'billey' ),
		'twitter'  => esc_attr__( 'Twitter', 'billey' ),
		'linkedin' => esc_attr__( 'Linkedin', 'billey' ),
		'tumblr'   => esc_attr__( 'Tumblr', 'billey' ),
		'email'    => esc_attr__( 'Email', 'billey' ),
	),
) );
