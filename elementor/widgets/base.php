<?php

namespace Billey_Elementor;

use Elementor\Widget_Base;
use Elementor\Icons_Manager;

defined( 'ABSPATH' ) || exit;

abstract class Base extends Widget_Base {

	protected function get_icon_part() {
		return 'eicon-elementor-square';
	}

	public function get_icon() {
		return 'billey-badge ' . $this->get_icon_part();
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the button widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since  2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'billey' ];
	}

	/**
	 * Get Render Icon
	 *
	 * Used to render Icon for \Elementor\Controls_Manager::ICONS
	 *
	 * @param array  $icon       Icon Type, Icon value
	 * @param array  $attributes Icon HTML Attributes
	 * @param string $tag        Icon HTML tag, defaults to <i>
	 *
	 * @return mixed|string
	 */
	protected function get_icons_html( $icon, $attributes = [], $tag = 'i' ) {
		ob_start();

		Icons_Manager::render_icon( $icon, $attributes, $tag );

		$template = ob_get_clean();

		return $template;
	}

	protected function render_icon( $settings, $icon, $attributes = [], $svg = false, $color_prefix = 'icon' ) {
		$template = $this->get_render_icon( $settings, $icon, $attributes, $svg, $color_prefix );

		echo '' . $template;
	}

	protected function get_render_icon( $settings, $icon, $attributes = [], $svg = false, $color_prefix = 'icon' ) {
		$tag = 'i';

		ob_start();
		Icons_Manager::render_icon( $icon, $attributes, $tag );
		$template = ob_get_clean();

		if ( $svg === true ) {
			$id = uniqid( 'svg-gradient' );

			$stroke_attr = 'stroke="' . "url(#{$id})" . '"';
			$fill_attr   = 'fill="' . "url(#{$id})" . '"';

			$template = preg_replace( '/stroke="#(.*?)"/', $stroke_attr, $template );
			$template = preg_replace( '/fill="#(.*?)"/', $fill_attr, $template );

			$svg_defs = $this->get_svg_gradient_defs( $settings, $color_prefix, $id );

			if ( ! empty( $svg_defs ) ) {
				$template = $svg_defs . $template;
			}
		}

		return $template;
	}

	protected function get_svg_gradient_defs( array $settings, $name, $id ) {
		if ( 'gradient' !== $settings["{$name}_color_type"] ) {
			return false;
		}

		$color_a_stop = $settings["{$name}_color_a_stop"];
		$color_b_stop = $settings["{$name}_color_b_stop"];

		$color_a_stop_value = $color_a_stop['size'] . $color_a_stop['unit'];
		$color_b_stop_value = $color_b_stop['size'] . $color_a_stop['unit'];

		ob_start();
		?>
		<svg aria-hidden="true" focusable="false" class="svg-defs-gradient">
			<defs>
				<linearGradient id="<?php echo esc_attr( $id ); ?>" x1="0%" y1="0%" x2="0%" y2="100%">
					<stop class="stop-a" offset="<?php echo esc_attr( $color_a_stop_value ); ?>"/>
					<stop class="stop-b" offset="<?php echo esc_attr( $color_b_stop_value ); ?>"/>
				</linearGradient>
			</defs>
		</svg>
		<?php
		return ob_get_clean();
	}
}
