jQuery( document ).ready( function( $ ) {
	'use strict';

	var $body = $( 'body' );
	var $sticky = $( '.tm-sticky-column' );
	var $parent = $sticky.parents( '.tm-sticky-parent' ).first();

	initStickyElement();

	var wWidth = window.innerWidth;
	if ( wWidth < 768 ) {
		$sticky.trigger( 'sticky_kit:detach' );
	} else {
		initStickyElement();
	}

	$( window ).resize( function() {
		wWidth = window.innerWidth;
		if ( wWidth < 768 ) {
			$sticky.trigger( 'sticky_kit:detach' );
		} else {
			initStickyElement();
		}
	} );

	function initStickyElement() {
		var _offset = parseInt( $body.data( 'header-sticky-height' ) );

		if ( $body.hasClass( 'admin-bar' ) ) {
			_offset += 32;
		}

		_offset += 30;

		$sticky.stick_in_parent( {
			parent: $parent,
			'offset_top': _offset
		} );
	}
} );
