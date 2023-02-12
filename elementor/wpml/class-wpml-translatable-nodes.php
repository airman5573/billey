<?php

namespace Billey_Elementor;

defined( 'ABSPATH' ) || exit;

class WPML_Translatable_Nodes {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function initialize() {
		add_action( 'init', [ $this, 'wp_init' ] );
	}

	public function wp_init() {
		add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'wpml_widgets_to_translate_filter' ] );
	}

	public function get_translatable_node() {
		require_once BILLEY_ELEMENTOR_DIR . '/wpml/class-translate-widget-google-map.php';
		require_once BILLEY_ELEMENTOR_DIR . '/wpml/class-translate-widget-list.php';
		require_once BILLEY_ELEMENTOR_DIR . '/wpml/class-translate-widget-attribute-list.php';
		require_once BILLEY_ELEMENTOR_DIR . '/wpml/class-translate-widget-gradation.php';
		require_once BILLEY_ELEMENTOR_DIR . '/wpml/class-translate-widget-pricing-table.php';
		require_once BILLEY_ELEMENTOR_DIR . '/wpml/class-translate-widget-table.php';
		require_once BILLEY_ELEMENTOR_DIR . '/wpml/class-translate-widget-modern-carousel.php';
		require_once BILLEY_ELEMENTOR_DIR . '/wpml/class-translate-widget-modern-slider.php';
		require_once BILLEY_ELEMENTOR_DIR . '/wpml/class-translate-widget-team-member-carousel.php';
		require_once BILLEY_ELEMENTOR_DIR . '/wpml/class-translate-widget-testimonial-carousel.php';
		require_once BILLEY_ELEMENTOR_DIR . '/wpml/class-translate-widget-testimonial-grid.php';
		require_once BILLEY_ELEMENTOR_DIR . '/wpml/class-translate-widget-accordion.php';
		require_once BILLEY_ELEMENTOR_DIR . '/wpml/class-translate-widget-tabs.php';

		$widgets['tm-accordion'] = [
			'fields'            => [],
			'integration-class' => '\Billey_Elementor\Translate_Widget_Accordion',
		];

		$widgets['tm-tabs'] = [
			'fields'            => [],
			'integration-class' => '\Billey_Elementor\Translate_Widget_Tabs',
		];

		$widgets['tm-attribute-list'] = [
			'fields'            => [],
			'integration-class' => '\Billey_Elementor\Translate_Widget_Attribute_List',
		];

		$widgets['tm-gradation'] = [
			'fields'            => [],
			'integration-class' => '\Billey_Elementor\Translate_Widget_Gradation',
		];

		$widgets['tm-heading'] = [
			'fields' => [
				[
					'field'       => 'title',
					'type'        => esc_html__( 'Modern Heading: Primary', 'billey' ),
					'editor_type' => 'AREA',
				],
				'title_link' => [
					'field'       => 'url',
					'type'        => esc_html__( 'Modern Heading: Link', 'billey' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'description',
					'type'        => esc_html__( 'Modern Heading: Description', 'billey' ),
					'editor_type' => 'AREA',
				],
				[
					'field'       => 'sub_title_text',
					'type'        => esc_html__( 'Modern Heading: Secondary', 'billey' ),
					'editor_type' => 'AREA',
				],
			],
		];

		$widgets['tm-button'] = [
			'fields' => [
				[
					'field'       => 'text',
					'type'        => esc_html__( 'Button: Text', 'billey' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'badge_text',
					'type'        => esc_html__( 'Button: Badge', 'billey' ),
					'editor_type' => 'LINE',
				],
				'link' => [
					'field'       => 'url',
					'type'        => esc_html__( 'Button: Link', 'billey' ),
					'editor_type' => 'LINK',
				],
			],
		];

		$widgets['tm-banner'] = [
			'fields' => [
				[
					'field'       => 'title_text',
					'type'        => esc_html__( 'Banner: Title', 'billey' ),
					'editor_type' => 'LINE',
				],
				'link' => [
					'field'       => 'url',
					'type'        => esc_html__( 'Banner: Link', 'billey' ),
					'editor_type' => 'LINK',
				],
			],
		];

		$widgets['tm-circle-progress-chart'] = [
			'fields' => [
				[
					'field'       => 'inner_content_text',
					'type'        => esc_html__( 'Circle Chart: Text', 'billey' ),
					'editor_type' => 'LINE',
				],
			],
		];

		$widgets['tm-flip-box'] = [
			'fields' => [
				[
					'field'       => 'title_text_a',
					'type'        => esc_html__( 'Flip Box: Front Title', 'billey' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'description_text_a',
					'type'        => esc_html__( 'Flip Box: Front Description', 'billey' ),
					'editor_type' => 'AREA',
				],
				[
					'field'       => 'title_text_b',
					'type'        => esc_html__( 'Flip Box: Back Title', 'billey' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'description_text_b',
					'type'        => esc_html__( 'Flip Box: Back Description', 'billey' ),
					'editor_type' => 'AREA',
				],
				[
					'field'       => 'button_text',
					'type'        => esc_html__( 'Flip Box: Button Text', 'billey' ),
					'editor_type' => 'LINE',
				],
				'link' => [
					'field'       => 'url',
					'type'        => esc_html__( 'Flip Box: Link', 'billey' ),
					'editor_type' => 'LINK',
				],
			],
		];

		$widgets['tm-google-map'] = [
			'fields'            => [],
			'integration-class' => '\Billey_Elementor\Translate_Widget_Google_Map',
		];

		$widgets['tm-icon'] = [
			'fields' => [
				'link' => [
					'field'       => 'url',
					'type'        => esc_html__( 'Icon: Link', 'billey' ),
					'editor_type' => 'LINK',
				],
			],
		];

		$widgets['tm-icon-box'] = [
			'fields' => [
				[
					'field'       => 'title_text',
					'type'        => esc_html__( 'Icon Box: Title', 'billey' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'description_text',
					'type'        => esc_html__( 'Icon Box: Description', 'billey' ),
					'editor_type' => 'AREA',
				],
				'link'        => [
					'field'       => 'url',
					'type'        => esc_html__( 'Icon Box: Link', 'billey' ),
					'editor_type' => 'LINK',
				],
				[
					'field'       => 'button_text',
					'type'        => esc_html__( 'Icon Box: Button', 'billey' ),
					'editor_type' => 'LINE',
				],
				'button_link' => [
					'field'       => 'url',
					'type'        => esc_html__( 'Icon Box: Button Link', 'billey' ),
					'editor_type' => 'LINK',
				],
			],
		];

		$widgets['tm-image-box'] = [
			'fields' => [
				[
					'field'       => 'title_text',
					'type'        => esc_html__( 'Image Box: Title', 'billey' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'description_text',
					'type'        => esc_html__( 'Image Box: Content', 'billey' ),
					'editor_type' => 'AREA',
				],
				'link' => [
					'field'       => 'url',
					'type'        => esc_html__( 'Image Box: Link', 'billey' ),
					'editor_type' => 'LINK',
				],
				[
					'field'       => 'button_text',
					'type'        => esc_html__( 'Image Box: Button', 'billey' ),
					'editor_type' => 'LINE',
				],
			],
		];

		$widgets['tm-list'] = [
			'fields'            => [],
			'integration-class' => '\Billey_Elementor\Translate_Widget_List',
		];

		$widgets['tm-popup-video'] = [
			'fields' => [
				[
					'field'       => 'video_text',
					'type'        => esc_html__( 'Popup Video: Text', 'billey' ),
					'editor_type' => 'LINE',
				],
				'video_url' => [
					'field'       => 'url',
					'type'        => esc_html__( 'Popup Video: Link', 'billey' ),
					'editor_type' => 'LINK',
				],
				[
					'field'       => 'poster_caption',
					'type'        => esc_html__( 'Popup Video: Caption', 'billey' ),
					'editor_type' => 'AREA',
				],
			],
		];

		$widgets['tm-pricing-table'] = [
			'fields'            => [
				[
					'field'       => 'heading',
					'type'        => esc_html__( 'Pricing Table: Heading', 'billey' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'sub_heading',
					'type'        => esc_html__( 'Pricing Table: Description', 'billey' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'currency',
					'type'        => esc_html__( 'Pricing Table: Currency', 'billey' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'price',
					'type'        => esc_html__( 'Pricing Table: Price', 'billey' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'period',
					'type'        => esc_html__( 'Pricing Table: Period', 'billey' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'button_text',
					'type'        => esc_html__( 'Pricing Table: Button', 'billey' ),
					'editor_type' => 'LINE',
				],
				'button_link' => [
					'field'       => 'url',
					'type'        => esc_html__( 'Pricing Table: Button Link', 'billey' ),
					'editor_type' => 'LINK',
				],
			],
			'integration-class' => '\Billey_Elementor\Translate_Widget_Pricing_Table',
		];

		$widgets['tm-table'] = [
			'fields'            => [],
			'integration-class' => [
				'\Billey_Elementor\Translate_Widget_Pricing_Table_Head',
				'\Billey_Elementor\Translate_Widget_Pricing_Table_Body',
			],
		];

		$widgets['tm-team-member'] = [
			'fields' => [
				[
					'field'       => 'name',
					'type'        => esc_html__( 'Team Member: Name', 'billey' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'content',
					'type'        => esc_html__( 'Team Member: Content', 'billey' ),
					'editor_type' => 'AREA',
				],
				[
					'field'       => 'position',
					'type'        => esc_html__( 'Team Member: Position', 'billey' ),
					'editor_type' => 'LINE',
				],
				'profile' => [
					'field'       => 'url',
					'type'        => esc_html__( 'Team Member: Profile', 'billey' ),
					'editor_type' => 'LINK',
				],
			],
		];

		$widgets['tm-modern-carousel'] = [
			'fields'            => [],
			'integration-class' => '\Billey_Elementor\Translate_Widget_Modern_Carousel',
		];

		$widgets['tm-modern-slider'] = [
			'fields'            => [],
			'integration-class' => '\Billey_Elementor\Translate_Widget_Modern_Slider',
		];

		$widgets['tm-team-member-carousel'] = [
			'fields'            => [],
			'integration-class' => '\Billey_Elementor\Translate_Widget_Team_Member_Carousel',
		];

		$widgets['tm-testimonial-carousel'] = [
			'fields'            => [],
			'integration-class' => '\Billey_Elementor\Translate_Widget_Testimonial_Carousel',
		];

		$widgets['tm-testimonial-grid'] = [
			'fields'            => [],
			'integration-class' => '\Billey_Elementor\Translate_Widget_Testimonial_Grid',
		];

		return $widgets;
	}

	public function wpml_widgets_to_translate_filter( $widgets ) {
		$billey_widgets = $this->get_translatable_node();

		foreach ( $billey_widgets as $widget_name => $widget ) {
			$widgets[ $widget_name ]               = $widget;
			$widgets[ $widget_name ]['conditions'] = [
				'widgetType' => $widget_name,
			];
		}

		return $widgets;
	}
}

WPML_Translatable_Nodes::instance()->initialize();
