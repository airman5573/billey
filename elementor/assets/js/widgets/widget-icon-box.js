(
	function( $ ) {
		'use strict';

		var BilleyIconBoxHandler = function( $scope, $ ) {
			var $element = $scope.find( '.tm-icon-box' );

			elementorFrontend.waypoint( $element, function() {
				var settings = $element.data( 'vivus' );
				var vivus;
				if ( settings && 'yes' === settings.enable ) {
					var $icon = $element.find( '.billey-svg-icon' );

					if ( $icon.length > 0 ) {
						var $svg = $icon.children( 'svg' ).not( '.svg-defs-gradient' );

						var options = {
							type: settings.type,
							duration: settings.duration,
							animTimingFunction: Vivus.EASE_OUT
						};

						var Callback = function() {
						};

						if ( vivus ) {
							vivus.destroy();
						}

						var vivus = new Vivus( $svg[ 0 ], options, Callback );

						if ( 'yes' === settings.play_on_hover ) {
							$element.on( 'mouseenter', function() {
								vivus.stop()
								     .reset()
								     .play( 2 );
							} ).on( 'mouseleave', function() {
								//vivus.finish();
							} );
						}
					}
				}
			} );
		};

		$( window ).on( 'elementor/frontend/init', function() {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-icon-box.default', BilleyIconBoxHandler );
		} );
	}
)( jQuery );
