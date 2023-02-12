<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

defined( 'ABSPATH' ) || exit;

abstract class Static_Carousel extends Carousel_Base {

	private $current_slide       = null;
	private $current_slide_key   = null;
	private $current_slide_index = 0;

	abstract protected function add_repeater_controls( Repeater $repeater );

	abstract protected function get_repeater_defaults();

	abstract protected function print_slide();

	protected function _register_controls() {
		$this->start_controls_section( 'slides_section', [
			'label' => esc_html__( 'Slides', 'billey' ),
		] );

		$repeater = new Repeater();

		$this->add_repeater_controls( $repeater );

		$this->add_control( 'slides', [
			'label'     => esc_html__( 'Slides', 'billey' ),
			'type'      => Controls_Manager::REPEATER,
			'fields'    => $repeater->get_controls(),
			'default'   => $this->get_repeater_defaults(),
			'separator' => 'after',
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'    => 'image_size',
			'default' => 'full',
		] );

		$this->end_controls_section();

		parent::_register_controls();
	}

	protected function get_current_slide() {
		return $this->current_slide;
	}

	protected function get_current_slide_key() {
		return $this->current_slide_key;
	}

	protected function get_current_slide_index() {
		return $this->current_slide_index;
	}

	protected function set_current_slide( $slide ) {
		$this->current_slide = $slide;
	}

	protected function set_current_slide_key( $key ) {
		$this->current_slide_key = $key;
	}

	protected function set_current_slide_index() {
		$index = $this->current_slide_index;
		$index++;

		$this->current_slide_index = $index;
	}

	protected function print_slides( array $settings ) {
		foreach ( $settings['slides'] as $slide ) :
			$item_id = $slide['_id'];
			$item_key = 'item_' . $item_id;

			$this->set_current_slide( $slide );
			$this->set_current_slide_key( $item_key );
			$this->set_current_slide_index();

			$this->add_render_attribute( $item_key, [
				'class' => [
					'swiper-slide',
					'elementor-repeater-item-' . $item_id,
				],
			] );
			?>
			<div <?php $this->print_render_attribute_string( $item_key ); ?>>
				<?php $this->print_slide(); ?>
			</div>
		<?php endforeach;
	}
}
