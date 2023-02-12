(
	function( $ ) {
		'use strict';

		var fontFamily = $( 'body' ).data( 'font' );

		Chart.defaults.global.defaultFontFamily = fontFamily;
		Chart.defaults.global.defaultFontSize = 15;
		Chart.defaults.global.defaultFontColor = '#111';

		var ChartHandler = function( $scope, $ ) {
			var $element = $scope.find( '.billey-js-chart' );

			elementorFrontend.waypoint( $element, function() {
				var settings = $element.data();

				var legendEnable = settings.legendEnable && settings.legendEnable == '1' ? true : false;
				var legendClickable = settings.legendClickable && settings.legendClickable == '1' ? true : false;

				var dataString = $element.find( '.chart-data' ).html();
				var data = false;
				try {
					data = JSON.parse( dataString );
				} catch ( ex ) {
				}
				if ( data ) {
					var $canvas = $element.find( 'canvas' );

					var chart = new Chart( $canvas, data );

					if ( data.type === 'pie' && legendEnable ) {
						var chartLegends = $element.find( '.chart-legends' );

						chartLegends.html( chart.generateLegend() );

						if ( legendClickable ) {
							chartLegends.find( 'li' ).each( function() {
								$( this ).on( 'click', legendClickCallback );
							} );
						}
					}
				}

			} );

			function legendClickCallback( event ) {
				event = event || window.event;

				var target = event.target || event.srcElement;
				while ( target.nodeName !== 'LI' ) {
					target = target.parentElement;
				}
				var parent = target.parentElement;
				var chartId = parseInt( parent.classList[ 0 ].split( "-" )[ 0 ], 10 );
				var chart = Chart.instances[ chartId ];
				var index = Array.prototype.slice.call( parent.children ).indexOf( target );
				var meta = chart.getDatasetMeta( 0 );
				var item = meta.data[ index ];

				if ( item.hidden === null || item.hidden === false ) {
					item.hidden = true;
					target.classList.add( 'hidden' );
				} else {
					target.classList.remove( 'hidden' );
					item.hidden = null;
				}
				chart.update();
			}
		};

		$( window ).on( 'elementor/frontend/init', function() {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-bar-chart.default', ChartHandler );
			elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-line-chart.default', ChartHandler );
			elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-pie-chart.default', ChartHandler );
		} );
	}
)( jQuery );
