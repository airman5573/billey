jQuery( document ).ready( function( $ ) {
	'use strict';

	var $body = $( 'body' );

	initQuantityButtons();
	initProductImagesSlider();
	initQuickViewPopup();

	function initQuantityButtons() {
		$( document ).on( 'click', '.increase, .decrease', function() {

			// Get values
			var $qty       = $( this ).siblings( '.qty' ),
			    currentVal = parseFloat( $qty.val() ),
			    max        = parseFloat( $qty.attr( 'max' ) ),
			    min        = parseFloat( $qty.attr( 'min' ) ),
			    step       = $qty.attr( 'step' );

			// Format values
			if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) {
				currentVal = 0;
			}
			if ( max === '' || max === 'NaN' ) {
				max = '';
			}
			if ( min === '' || min === 'NaN' ) {
				min = 0;
			}
			if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) {
				step = 1;
			}

			// Change the value
			if ( $( this ).is( '.increase' ) ) {

				if ( max && (
					max == currentVal || currentVal > max
				) ) {
					$qty.val( max );
				} else {
					$qty.val( currentVal + parseFloat( step ) );
				}

			} else {

				if ( min && (
					min == currentVal || currentVal < min
				) ) {
					$qty.val( min );
				} else if ( currentVal > 0 ) {
					$qty.val( currentVal - parseFloat( step ) );
				}

			}

			// Trigger change event.
			$qty.trigger( 'change' );
		} );
	}

	function initProductImagesSlider() {
		if ( $billey.isProduct === '1' && $billey.productFeatureStyle === 'slider' ) {
			var $sliderWrap = $( '#woo-single-info' ).find( '.woo-single-gallery' );

			var options = {};
			if ( $sliderWrap.hasClass( 'has-thumbs-slider' ) ) {
				var thumbsSlider = $sliderWrap.children( '.billey-thumbs-swiper' ).BilleySwiper();
				options = {
					thumbs: {
						swiper: thumbsSlider
					}
				};
			}
			var mainSlider = $sliderWrap.children( '.billey-main-swiper' ).BilleySwiper( options );

			var $form = $( '.variations_form' );
			var variations = $form.data( 'product_variations' );

			$form.find( 'select' ).on( 'change', function() {
				var test = true;
				var globalAttrs = {};

				var formValues = $form.serializeArray();

				for ( var i = 0; i < formValues.length; i ++ ) {

					var _name = formValues[ i ].name;
					if ( _name.substring( 0, 10 ) === 'attribute_' ) {

						globalAttrs[ _name ] = formValues[ i ].value;

						if ( formValues[ i ].value === '' ) {
							test = false;

							break;
						}
					}
				}

				if ( test === true ) {
					globalAttrs = JSON.stringify( globalAttrs );

					for ( var i = variations.length - 1; i >= 0; i -- ) {
						var attributes = variations[ i ].attributes;
						var loopAttributes = JSON.stringify( attributes );

						if ( loopAttributes == globalAttrs ) {
							var url = variations[ i ].image.url;

							mainSlider.$wrapperEl.find( '.swiper-slide' ).each( function( index ) {
								var fullImage = $( this ).attr( 'data-src' );

								if ( fullImage === url ) {
									mainSlider.slideTo( index );

									return false;
								}
							} );
						}
					}
				} else {
					// Reset to main image.
					var $mainImage = mainSlider.$wrapperEl.find( '.product-main-image' );
					var index = $mainImage.index();
					mainSlider.slideTo( index );
				}
			} );
		}
	}

	function initQuickViewPopup() {
		$( '.billey-product' ).on( 'click', '.quick-view-btn', function( e ) {
			e.preventDefault();
			e.stopPropagation();

			var $button = $( this );

			var $actions = $button.parents( '.product-actions' ).first();
			$actions.addClass( 'refresh' );

			$button.addClass( 'loading' );
			var productID = $button.data( 'pid' );

			/**
			 * Avoid duplicate ajax request.
			 */
			var $popup = $body.children( '#' + 'popup-product-quick-view-content-' + productID );
			if ( $popup.length > 0 ) {
				openQuickViewPopup( $popup, $button );
			} else {
				var data = {
					action: 'product_quick_view',
					pid: productID
				};

				$.ajax( {
					url: $billey.ajaxurl,
					type: 'POST',
					data: $.param( data ),
					dataType: 'json',
					success: function( results ) {
						$popup = $( results.template );
						$body.append( $popup );
						openQuickViewPopup( $popup, $button );
					},
				} );
			}
		} );
	}

	function openQuickViewPopup( $popup, $button ) {
		$button.removeClass( 'loading' );

		$.magnificPopup.open( {
			mainClass: 'mfp-fade popup-product-quick-view',
			items: {
				src: $popup.html(),
				type: 'inline'
			},
			callbacks: {
				open: function() {
					var $sliderWrap = this.content.find( '.woo-single-gallery' );
					var thumbsSlider = $sliderWrap.children( '.billey-thumbs-swiper' ).BilleySwiper();
					var mainSlider = $sliderWrap.children( '.billey-main-swiper' ).BilleySwiper( {
						thumbs: {
							swiper: thumbsSlider
						}
					} );

					this.content.find( '.entry-summary .inner-content' ).perfectScrollbar( {
						suppressScrollX: true
					} );
				},
			}
		} );
	}
} );
