<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Billey_Kses_Allowed_Html' ) ) {

	class Billey_Kses_Allowed_Html {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function initialize() {
			add_filter( 'wp_kses_allowed_html', [ $this, 'wp_kses_allowed_html' ], 2, 99 );
		}

		public function wp_kses_allowed_html( $allowed_tags, $context ) {
			$basic_atts = [
				'id'    => [],
				'class' => [],
				'style' => [],
			];

			switch ( $context ) {
				case 'billey-img':
					$allowed_tags = [
						'img' => [
							'id'     => [],
							'class'  => [],
							'style'  => [],
							'src'    => [],
							'width'  => [],
							'height' => [],
							'alt'    => [],
							'srcset' => [],
							'sizes'  => [],
						],
					];
					break;
				case 'billey-a':
					$allowed_tags = [
						'a' => [
							'id'     => [],
							'class'  => [],
							'style'  => [],
							'href'   => [],
							'target' => [],
							'rel'    => [],
							'title'  => [],
						],
					];
					break;
				case 'billey-default' :
					$allowed_tags = [
						'a'      => [
							'id'     => [],
							'class'  => [],
							'style'  => [],
							'href'   => [],
							'target' => [],
							'rel'    => [],
							'title'  => [],
						],
						'img'    => [
							'id'     => [],
							'class'  => [],
							'style'  => [],
							'src'    => [],
							'width'  => [],
							'height' => [],
							'alt'    => [],
							'srcset' => [],
							'sizes'  => [],
						],
						'br'     => [],
						'ul'     => [
							'id'    => [],
							'class' => [],
							'style' => [],
							'type'  => [],
						],
						'ol'     => [
							'id'    => [],
							'class' => [],
							'style' => [],
							'type'  => [],
						],
						'li'     => $basic_atts,
						'h1'     => $basic_atts,
						'h2'     => $basic_atts,
						'h3'     => $basic_atts,
						'h4'     => $basic_atts,
						'h5'     => $basic_atts,
						'h6'     => $basic_atts,
						'div'    => $basic_atts,
						'strong' => $basic_atts,
						'b'      => $basic_atts,
						'span'   => $basic_atts,
						'mark'   => $basic_atts,
						'i'      => $basic_atts,
						'del'    => $basic_atts,
						'ins'    => $basic_atts,
					];
					break;
				case 'billey-product-price' :
					$allowed_tags = [
						'span' => [
							'class' => [],
						],
						'del'  => [],
						'ins'  => [],
					];
					break;
				case 'billey-product-name' :
					$allowed_tags = [
						'h6' => [
							'class' => [],
						],
						'a'  => [
							'href' => [],
						],
					];
					break;
			}

			return $allowed_tags;
		}
	}

	Billey_Kses_Allowed_Html::instance()->initialize();
}
