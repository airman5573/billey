(
	function( $ ) {
		'use strict';

		var $sliderWrapper = $( '#billey-template-slider' );

		$( window ).on( 'resize', function() {
			pageFullHeight();
		} );

		$( document ).ready( function() {
			pageFullHeight();
			initTemplateSlider();
		} );

		function pageFullHeight() {
			var height = $( window ).height();
			var adminBar = $( '#wpadminbar' );
			if ( adminBar ) {
				height -= adminBar.outerHeight();
			}

			var $header = $( '#page-header-inner' );

			if ( $header.length > 0 ) {
				var headerHeight = $header.outerHeight();
				height -= headerHeight;
				$sliderWrapper.css( {
					paddingTop: headerHeight + 'px'
				} );
			}

			var $footer = $( '#page-footer' );
			if ( $footer.length > 0 ) {
				height -= $footer.outerHeight();
			}

			var slideHeight = (
				                  height - 20 // Slider Row Gutter.
			                  ) / 2;


			$sliderWrapper.find( '.swiper-slide' ).height( slideHeight );
		}

		function initTemplateSlider() {
			var mainSlider = $sliderWrapper.children( '.billey-main-swiper' ).BilleySwiper();
			var thumbsSlider = $sliderWrapper.children( '.billey-thumbs-swiper' ).BilleySwiper();

			mainSlider.controller.control = thumbsSlider;
			thumbsSlider.controller.control = mainSlider;
		}
	}( window.jQuery )
);
