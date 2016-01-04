/* global jQuery */
( function( $ ){

	var FileNaming = {

		init: function() {

			this.acf_group = $( '#acf-group_5562fc0e0ab7a' );
			if( this.acf_group.length > 0 ) {

				this.repeater = $( '.lumi_be_files:first' );
				this.bindEvents();

			}

		},

		bindEvents: function() {

			var t = this;
			this.repeater.arrive( '.acf-row', function() {
				var new_row = $( this );
				new_row.find( '.acf-file-uploader.acf-cf' ).watch( {
					properties: 'attr_class',
					callback: function( data ) {
						if( data.vals[ 0 ].indexOf( 'has-value' ) > -1 ) {
							t.checkForNewFile( $( this ) );
						}
					}
				} );
			} );

			this.repeater.arrive( '.acf-file-uploader.acf-cf.has-value', function() {
				t.checkForNewFile( $( this ) );
			} );

		},

		checkForNewFile: function( uploader ) {

			var file_name = uploader.find( '.file-info [data-name="title"]' ).text(),
				file_pattern = /^(.+?_)?(.+)$/i;

			var parsed_file_name = file_pattern.exec( file_name );

			if( parsed_file_name !== null ) {
				this.autofillData( uploader, parsed_file_name[ 2 ] );
			}

		},

		autofillData: function( uploader, data ) {

			var row = uploader.parents( '.acf-row:first' );

			row.find( '[data-name="title"] input' ).val( data );

		}

	};



	$( function() {
		FileNaming.init();
	} )

} )( jQuery );