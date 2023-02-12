<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

defined( 'ABSPATH' ) || exit;

class Widget_Gif_Player extends Base {

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		wp_register_style( 'gif-player', BILLEY_ELEMENTOR_URI . '/assets/libs/gif-player/gifplayer.css', null, '0.3.4' );
		wp_register_script( 'gif-player', BILLEY_ELEMENTOR_URI . '/assets/libs/gif-player/jquery.gifplayer.js', array(), '0.3.4', true );
		wp_register_script( 'billey-widget-gif-player', BILLEY_ELEMENTOR_URI . '/assets/js/widgets/widget-gif-player.js', array(
			'elementor-frontend',
			'gif-player',
		), null, true );
	}

	public function get_script_depends() {
		return [ 'billey-widget-gif-player' ];
	}

	public function get_style_depends() {
		return [ 'gif-player' ];
	}

	public function get_name() {
		return 'tm-gif-player';
	}

	public function get_title() {
		return esc_html__( 'Gif Player', 'billey' );
	}

	public function get_icon_part() {
		return 'eicon-image';
	}

	public function get_keywords() {
		return [ 'image', 'gif', 'player' ];
	}

	protected function _register_controls() {
		$this->add_image_section();
	}

	private function add_image_section() {
		$this->start_controls_section( 'add_image_section', [
			'label' => esc_html__( 'Image', 'billey' ),
		] );

		$this->add_control( 'image', [
			'label'   => esc_html__( 'Static Image', 'billey' ),
			'type'    => Controls_Manager::MEDIA,
			'dynamic' => [
				'active' => true,
			],
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'    => 'image',
			'default' => 'full',
		] );

		$this->add_control( 'gif_image', [
			'label'   => esc_html__( 'Gif Image', 'billey' ),
			'type'    => Controls_Manager::MEDIA,
			'dynamic' => [
				'active' => true,
			],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'image', 'class', 'billey-gif-image' );

		$image_url = '';

		if ( ! empty( $settings['image']['id'] ) ) {
			$image_size = \Billey_Image::elementor_parse_image_size( $settings, 'full', 'image' );
			$image_url  = \Billey_Image::get_attachment_url_by_id( [
				'id'   => $settings['image']['id'],
				'size' => $image_size,
			] );
		} elseif ( ! empty( $settings['image']['url'] ) ) {
			$image_url = $settings['image']['url'];
		}

		if ( empty( $image_url ) ) {
			return;
		}

		$this->add_render_attribute( 'image', 'src', $image_url );

		$gif_url = '';

		if ( empty( $settings['gif_image']['url'] ) ) {
			if ( ! empty( $settings['gif_image']['id'] ) ) {
				$gif_url = \Billey_Image::get_attachment_url_by_id( $settings['gif_image']['id'] );
			}
		} else {
			$gif_url = $settings['gif_image']['url'];
		}

		if ( ! empty( $gif_url ) ) {
			$this->add_render_attribute( 'image', 'data-gif', $gif_url );
		}
		?>
		<img <?php $this->print_render_attribute_string( 'image' ); ?> />
		<?php
	}
}
