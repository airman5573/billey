<?php
defined( 'ABSPATH' ) || exit;

/**
 * Debugging functions for developers.
 */
if ( ! class_exists( 'Billey_Debug' ) ) {
	class Billey_Debug {
		/**
		 * @param mixed $var Anything to output in debug bar.
		 */
		public static function d( $var ) {
			if ( ! function_exists( 'kint_debug_ob' ) || ! class_exists( 'Debug_Bar' ) ) {
				return;
			}

			ob_start( 'kint_debug_ob' );
			d( $var );
			ob_end_flush();
		}

		/**
		 * @param mixed $log Anything to write to log.
		 *
		 * Make sure WP_DEBUG_LOG = true.
		 */
		public static function write_log( $log ) {
			if ( true === WP_DEBUG ) {
				if ( is_array( $log ) || is_object( $log ) ) {
					error_log( print_r( $log, true ) );
				} else {
					error_log( $log );
				}
			}
		}
	}

	new Billey_Debug();
}
