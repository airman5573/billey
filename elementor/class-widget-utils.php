<?php

namespace Billey_Elementor;

defined( 'ABSPATH' ) || exit;

class Widget_Utils {
	public static function get_control_options_horizontal_alignment() {
		return [
			'left'   => [
				'title' => esc_html__( 'Left', 'billey' ),
				'icon'  => 'eicon-h-align-left',
			],
			'center' => [
				'title' => esc_html__( 'Center', 'billey' ),
				'icon'  => 'eicon-h-align-center',
			],
			'right'  => [
				'title' => esc_html__( 'Right', 'billey' ),
				'icon'  => 'eicon-h-align-right',
			],
		];
	}

	public static function get_control_options_horizontal_alignment_full() {
		return [
			'left'    => [
				'title' => esc_html__( 'Left', 'billey' ),
				'icon'  => 'eicon-h-align-left',
			],
			'center'  => [
				'title' => esc_html__( 'Center', 'billey' ),
				'icon'  => 'eicon-h-align-center',
			],
			'right'   => [
				'title' => esc_html__( 'Right', 'billey' ),
				'icon'  => 'eicon-h-align-right',
			],
			'stretch' => [
				'title' => esc_html__( 'Stretch', 'billey' ),
				'icon'  => 'eicon-h-align-stretch',
			],
		];
	}

	public static function get_control_options_vertical_alignment() {
		return [
			'top'    => [
				'title' => esc_html__( 'Top', 'billey' ),
				'icon'  => 'eicon-v-align-top',
			],
			'middle' => [
				'title' => esc_html__( 'Middle', 'billey' ),
				'icon'  => 'eicon-v-align-middle',
			],
			'bottom' => [
				'title' => esc_html__( 'Bottom', 'billey' ),
				'icon'  => 'eicon-v-align-bottom',
			],
		];
	}

	public static function get_control_options_vertical_full_alignment() {
		return [
			'top'     => [
				'title' => esc_html__( 'Top', 'billey' ),
				'icon'  => 'eicon-v-align-top',
			],
			'middle'  => [
				'title' => esc_html__( 'Middle', 'billey' ),
				'icon'  => 'eicon-v-align-middle',
			],
			'bottom'  => [
				'title' => esc_html__( 'Bottom', 'billey' ),
				'icon'  => 'eicon-v-align-bottom',
			],
			'stretch' => [
				'title' => esc_html__( 'Stretch', 'billey' ),
				'icon'  => 'eicon-v-align-stretch',
			],
		];
	}

	public static function get_control_options_text_align() {
		return [
			'left'   => [
				'title' => esc_html__( 'Left', 'billey' ),
				'icon'  => 'eicon-text-align-left',
			],
			'center' => [
				'title' => esc_html__( 'Center', 'billey' ),
				'icon'  => 'eicon-text-align-center',
			],
			'right'  => [
				'title' => esc_html__( 'Right', 'billey' ),
				'icon'  => 'eicon-text-align-right',
			],
		];
	}

	public static function get_control_options_text_align_full() {
		return [
			'left'    => [
				'title' => esc_html__( 'Left', 'billey' ),
				'icon'  => 'eicon-text-align-left',
			],
			'center'  => [
				'title' => esc_html__( 'Center', 'billey' ),
				'icon'  => 'eicon-text-align-center',
			],
			'right'   => [
				'title' => esc_html__( 'Right', 'billey' ),
				'icon'  => 'eicon-text-align-right',
			],
			'justify' => [
				'title' => esc_html__( 'Justified', 'billey' ),
				'icon'  => 'eicon-text-align-justify',
			],
		];
	}

	public static function get_button_style() {
		return [
			'flat'           => esc_html__( 'Flat', 'billey' ),
			'border'         => esc_html__( 'Border', 'billey' ),
			'thick-border'   => esc_html__( 'Thick Border', 'billey' ),
			'text'           => esc_html__( 'Text - Bottom Line', 'billey' ),
			'text-left-line' => esc_html__( 'Text - Left Line', 'billey' ),
			'circle'         => esc_html__( 'Circle', 'billey' ),
			'icon-circle'    => esc_html__( 'Icon Circle', 'billey' ),
		];
	}

	/**
	 * Get recommended social icons for control ICONS.
	 *
	 * @return array
	 */
	public static function get_recommended_social_icons() {
		return [
			'fa-brands' => [
				'android',
				'apple',
				'behance',
				'bitbucket',
				'codepen',
				'delicious',
				'deviantart',
				'digg',
				'dribbble',
				'envelope',
				'facebook',
				"facebook-f",
				"facebook-messenger",
				"facebook-square",
				'flickr',
				'foursquare',
				'free-code-camp',
				'github',
				'gitlab',
				'globe',
				'houzz',
				'instagram',
				'jsfiddle',
				'link',
				'linkedin',
				'medium',
				'meetup',
				'mix',
				'mixcloud',
				'odnoklassniki',
				'pinterest',
				'product-hunt',
				'reddit',
				'rss',
				'shopping-cart',
				'skype',
				'slideshare',
				'snapchat',
				'soundcloud',
				'spotify',
				'stack-overflow',
				'steam',
				'telegram',
				'thumb-tack',
				'tripadvisor',
				'tumblr',
				'twitch',
				'twitter',
				'viber',
				'vimeo',
				'vk',
				'weibo',
				'weixin',
				'whatsapp',
				'wordpress',
				'xing',
				'yelp',
				'youtube',
				'500px',
			],
		];
	}

	public static function get_grid_metro_size() {
		return [
			'1:1'   => esc_html__( 'Width 1 - Height 1', 'billey' ),
			'1:2'   => esc_html__( 'Width 1 - Height 2', 'billey' ),
			'1:0.7' => esc_html__( 'Width 1 - Height 70%', 'billey' ),
			'1:1.3' => esc_html__( 'Width 1 - Height 130%', 'billey' ),
			'2:1'   => esc_html__( 'Width 2 - Height 1', 'billey' ),
			'2:2'   => esc_html__( 'Width 2 - Height 2', 'billey' ),
		];
	}
}
