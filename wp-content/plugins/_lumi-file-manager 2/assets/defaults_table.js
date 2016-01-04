/* global jQuery, LumiBEFilemanagementDefaultsTable */
( function( $ ){

	var DefaultsTable = {

		init: function() {

			this.defaults_table = $( '[data-js-lumi-be-defaults_table]:first' );
			this.default_fields = this.defaults_table.find( '[data-js-default]' );
			this.doc = $( document );

			this.bindEvents();

		},

		bindEvents: function() {

			var self = this;
			this.default_fields.on( 'keyup input paste change', function() {
				self.bindNewRowArrival();
			} );

			this.initializeTimepickers();

		},

		bindNewRowArrival: function() {

			var values = {};
			this.default_fields.each( function() {
				var field = $( this );
				values[ field.data( 'js-default' ) ] = field.val();
			} );

			var self = this;
			this.doc.unbindArrive( 'input' );
			this.doc.arrive( 'input', function() {

				var new_input = $( this );

				if( typeof new_input === 'undefined' || new_input.prop( 'name' ).indexOf( 'acf' ) !== 0 ) return; //NON-acf field

				var input_name = new_input.attr( 'name' ),
					field_id = input_name.match( /(.*)\[(.+?)\]$/ )[ 2 ],
					default_field_name = LumiBEFilemanagementDefaultsTable.default_fields_map[ field_id ],
					default_value = self.default_fields.filter( '[data-js-default="' + default_field_name + '"]:first' ).val();

				if( typeof default_value !== 'undefined' && default_value.length > 0 ) {
					new_input.val( default_value );
				}

			} );


		},

		initializeTimepickers: function() {

			this.defaults_table.find( '[data-js-timepicker]' ).datetimepicker( $.timepicker.regional['cs'], {
				dateFormat: 'dd.mm.yy'
			} ).datepicker( $.datepicker.regional[ "cs" ] );

		}


	};


	$( function() {
		DefaultsTable.init();
	} )

} )( jQuery );