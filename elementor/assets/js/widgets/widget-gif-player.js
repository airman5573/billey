(
	function( $ ) {
		'use strict';

		var BilleyGifPlayerHandler = function( $scope, $ ) {
			var $element = $scope.find( '.billey-gif-image' );
			$element.gifplayer();
		};

		$( window ).on( 'elementor/frontend/init', function() {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-gif-player.default', BilleyGifPlayerHandler );
		} );
	}
)( jQuery );
