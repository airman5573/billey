(
	function( $ ) {
		'use strict';

		var SwiperHandler = function( $scope, $ ) {
			var $element = $scope.find( '.tm-slider-widget' );

			$element.BilleySwiper();
		};

		var SwiperLinkedHandler = function( $scope, $ ) {
			var $element = $scope.find( '.tm-slider-widget' );

			if ( $scope.hasClass( 'billey-swiper-linked-yes' ) ) {
				var thumbsSlider = $element.filter( '.billey-thumbs-swiper' ).BilleySwiper( {
					thumbs: {
						swiper: mainSlider,
					},
				} );
				var mainSlider = $element.filter( '.billey-main-swiper' ).BilleySwiper( {
					thumbs: {
						swiper: thumbsSlider,
					}
				} );
			} else {
				$element.BilleySwiper();
			}
		};

		var SwiperBackgroundHandler = function( $scope, $ ) {
			var $element = $scope.find( '.tm-slider-widget' );

			var $swiper = $element.BilleySwiper();

			var bgList = $element.find( '.slider-bg-list' );

			$swiper.on( 'slideChangeTransitionEnd', function() {
				var index = $swiper.activeIndex;
				var slides = $swiper.$wrapperEl.find( '.swiper-slide' );
				var currentSlide = slides.eq( index );

				$( currentSlide ).siblings().removeClass( 'swiper-slide-hovered' );
				$( currentSlide ).addClass( 'swiper-slide-hovered' );

				handlerSliderModernBG( $swiper.realIndex );
			} );

			$element.find( '.swiper-slide' ).hoverIntent( function() {
				if ( $( this ).hasClass( 'swiper-slide-hovered' ) ) {
					return;
				}

				// Get real index both case of loop or not.
				var index = typeof  $( this ).data( 'swiper-slide-index' ) !== 'undefined' ? $( this ).data( 'swiper-slide-index' ) : $( this ).index();

				$( this ).siblings().removeClass( 'swiper-slide-hovered' );
				$( this ).addClass( 'swiper-slide-hovered' );

				handlerSliderModernBG( index );
			}, function() {
			} );

			handlerSliderModernBG( 0 );

			function handlerSliderModernBG( index ) {
				var current = bgList.children().eq( index );

				current.siblings().removeClass( 'current' );
				current.addClass( 'current' );
			}
		};

		$( window ).on( 'elementor/frontend/init', function() {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-image-carousel.default', SwiperHandler );
			elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-modern-carousel.default', SwiperHandler );
			elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-modern-slider.default', SwiperHandler );
			elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-team-member-carousel.default', SwiperHandler );
			elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-portfolio-carousel.default', SwiperHandler );
			elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-case-study-carousel.default', SwiperHandler );
			elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-running-campaigns-carousel.default', SwiperHandler );
			elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-image-box-carousel.default', SwiperHandler );

			elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-testimonial.default', SwiperLinkedHandler );

			elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-modern-background-carousel.default', SwiperBackgroundHandler );
		} );
	}
)( jQuery );
