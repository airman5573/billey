(
	function( $ ) {
		'use strict';

		var BilleyGridHandler = function( $scope, $ ) {
			var $element = $scope.find( '.billey-grid-wrapper' );

			$element.BilleyGridLayout();
		};

		$( window ).on( 'elementor/frontend/init', function() {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-image-gallery.default', BilleyGridHandler );
			elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-testimonial-grid.default', BilleyGridHandler );
			elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-product-categories.default', BilleyGridHandler );
		} );
	}
)( jQuery );
