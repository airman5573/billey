(
	function( $ ) {
		'use strict';

		var BilleyTabsHandler = function( $scope, $ ) {
			var $tabs = $scope.find( '.billey-tabs' );

			var $tabTitle = $tabs.children( '.billey-tabs-wrapper' ).children( '.billey-tab-title' );
			var $tabMobileTitle = $tabs.children( '.billey-tabs-content-wrapper' ).children( '.billey-tab-title' );
			var $tabContent = $tabs.children( '.billey-tabs-content-wrapper' ).children( '.billey-tab-content' );

			// Active first tab.
			showTab( 1 );

			$tabs.on( 'click', '.billey-tab-title', function( e ) {
				e.preventDefault();
				e.stopPropagation();

				var activeTab = $( this ).data( 'tab' );

				showTab( activeTab );
			} );

			function showTab( tabIndex ) {
				$tabContent.each( function() {
					var currentTab = $( this ).data( 'tab' );
					if ( tabIndex === currentTab ) {
						$( this ).show();
						$( this ).addClass( 'billey-active' );
					} else {
						$( this ).hide();
						$( this ).removeClass( 'billey-active' );
					}
				} );

				$tabTitle.each( function() {
					var currentTab = $( this ).data( 'tab' );

					if ( tabIndex === currentTab ) {
						$( this ).addClass( 'billey-active' );
					} else {
						$( this ).removeClass( 'billey-active' );
					}
				} );

				$tabMobileTitle.each( function() {
					var currentTab = $( this ).data( 'tab' );

					if ( tabIndex === currentTab ) {
						$( this ).addClass( 'billey-active' );
					} else {
						$( this ).removeClass( 'billey-active' );
					}
				} );
			}
		};

		$( window ).on( 'elementor/frontend/init', function() {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-tabs.default', BilleyTabsHandler );
		} );
	}
)( jQuery );
