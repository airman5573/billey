jQuery( document ).ready( function( $ ) {
	'use strict';

	initMyAccountSignInUp();

	function initMyAccountSignInUp() {
		var $formWrapper = $( '#customer_login' );
		var $forms = $formWrapper.children( '.woocommerce-form' );
		var $formTabs = $formWrapper.find( '.form-tabs' );

		$formTabs.on( 'click', 'a', function( e ) {
			e.preventDefault();

			if ( $( this ).hasClass( 'active' ) ) {
				return;
			}

			$( this ).siblings().removeClass( 'active' );
			$( this ).addClass( 'active' );

			var action = $( this ).data( 'action' );

			if ( 'register' === action ) {
				$formWrapper.children( '.form-login-title' ).hide();
				$formWrapper.children( '.form-register-title' ).show();

				$forms.filter( '.login' ).hide();
				$forms.filter( '.register' ).show();

			} else {
				$formWrapper.children( '.form-login-title' ).show();
				$formWrapper.children( '.form-register-title' ).hide();

				$forms.filter( '.login' ).show();
				$forms.filter( '.register' ).hide();
			}
		} );
	}
} );
