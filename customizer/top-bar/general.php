<?php
$section  = 'top_bar';
$priority = 1;
$prefix   = 'top_bar_';

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'global_top_bar',
	'label'    => esc_html__( 'Default Top Bar', 'billey' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'none',
	'choices'  => Billey_Helper::get_top_bar_list(),
) );

