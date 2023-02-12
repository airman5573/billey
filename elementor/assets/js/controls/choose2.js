(
	function( $ ) {
		'use strict';

		$( window ).on( 'elementor:init', function() {
			var ControlChoose2ItemView = elementor.modules.controls.Choose.extend();

			elementor.addControlView( 'choose2', ControlChoose2ItemView );
		} );

	}
)( jQuery );
