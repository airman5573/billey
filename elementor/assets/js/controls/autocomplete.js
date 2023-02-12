(
	function( $ ) {
		'use strict';

		$( window ).on( 'elementor:init', function() {
			var ControlAutocompleteItemView = elementor.modules.controls.BaseData.extend( {

				getValueTitles: function getValueTitles() {
					var self = this,
					    ids  = this.getControlValue();

					if ( ! ids ) {
						var option = self.getAutocompleteOptions();
						self.ui.select.select2( option );

						return;
					}

					if ( ! _.isArray( ids ) ) {
						ids = [ ids ];
					}

					$.ajax( {
						url: ajaxurl,
						type: 'POST',
						dataType: 'json',
						data: {
							action: self.model.get( 'ajax_action_render' ),
							ids: ids
						},
						success: function( results ) {
							var data = results.data;

							self.model.set( 'options', results.data );
							var option = self.getAutocompleteOptions();

							option.data = results.data;
							self.ui.select.select2( option );
						}
					} );
				},

				addControlSpinner: function addControlSpinner() {
					this.ui.select.prop( 'disabled', true );
					this.$el.find( '.elementor-control-title' ).after( '<span class="elementor-control-spinner">&nbsp;<i class="fa fa-spinner fa-spin"></i>&nbsp;</span>' );
				},

				getAutocompleteDefaultOptions: function getAutocompleteDefaultOptions() {
					var _action = this.model.get( 'ajax_action_search' );

					return {
						allowClear: true,
						dir: elementorCommon.config.isRTL ? 'rtl' : 'ltr',

						minimumInputLength: 1,
						ajax: {
							url: ajaxurl,
							dataType: 'json',
							delay: 350,
							data: function( term ) {
								return {
									q: term,
									action: _action
								};
							},
							processResults: function( data ) {
								return {
									results: data[ "data" ]
								};
							},
							cache: true
						}
					};
				},

				getAutocompleteOptions: function getAutocompleteOptions() {
					return jQuery.extend( this.getAutocompleteDefaultOptions(), this.model.get( 'select2options' ) );
				},

				onReady: function onReady() {
					this.getValueTitles();
				},
			} );

			elementor.addControlView( 'autocomplete', ControlAutocompleteItemView );
		} );

	}
)( jQuery );
