<?php

namespace Billey_Elementor;

use Elementor\Control_Choose;

defined( 'ABSPATH' ) || exit;

class Control_Choose2 extends Control_Choose {

	public function get_type() {
		return 'choose2';
	}

	public function enqueue() {
		wp_register_script( 'choose2-control', BILLEY_ELEMENTOR_URI . '/assets/js/controls/choose2.js', [ 'jquery' ], '1.0.0' );
		wp_enqueue_script( 'choose2-control' );
	}

	public function content_template() {
		$control_uid = $this->get_control_uid( '{{value}}' );
		// @formatter:off
		?>
		<div class="elementor-control-field">
			<label class="elementor-control-title">{{{ data.label }}}</label>
			<div class="elementor-control-input-wrapper">
				<div class="elementor-choices">
					<# _.each( data.options, function( options, value ) { #>
					<input id="<?php echo esc_attr( $control_uid ); ?>" type="radio" name="elementor-choose-{{ data.name }}-{{ data._cid }}" value="{{ value }}">
					<label class="elementor-choices-label tooltip-target" for="<?php echo esc_attr( $control_uid ); ?>" data-tooltip="{{ options.title }}" title="{{ options.title }}">
						<i class="{{ options.icon }}" aria-hidden="true"></i>
						<span>{{{ options.text }}}</span>
						<span class="elementor-screen-only">{{{ options.title }}}</span>
					</label>
					<# } ); #>
				</div>
			</div>
		</div>

		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
		// @formatter:off
	}
}
