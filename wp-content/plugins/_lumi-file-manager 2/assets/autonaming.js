/* global LumiBEFilemanagementAutonaming, jQuery */
( function( $  ){

	var Autonaming = {

		init: function() {

			this.repeater = $( '.lumi_be_files:first' );

			this.bindEvents();

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

			var file_name = uploader.find( '.file-info p:eq(1) a' ).text(),
				file_pattern = /(.{2})-(.{2})-(.{2})-(.{2})-(.{2})-(.{2})_(\d{4})(\d{2})(\d{2})(\d+)?\./i;

			var parsed_file_name = file_pattern.exec( file_name );

			if( parsed_file_name !== null ) {
				this.autofillData( uploader, parsed_file_name );
			}

		},

		autofillData: function( uploader, data ) {

			var row = uploader.parents( '.acf-row:first' );

			var selects_map = {
				1: 'entita',
				3: 'komodita',
				4: 'zakaznik',
				5: 'produktova_rada',
				6: 'distribucni_oblast'
			};

			$.each( selects_map, function( data_index, name ) {
				var select = row.find( '[data-name="' + name + '"] select' ),
					value = data[ data_index ],
					option = select.find( 'option[value="' + value + '"]' );

				if( option.length > 0 ) {
					select.val( data[ data_index ] ).trigger( 'change' );
				}

			} );

			row.find( '[data-name="rok"] input' ).val( data[ 7 ] );

			if( $( '[data-js-default="publish_at"]' ).val() == "" ) {

				var new_publish_date = new Date( data[ 7 ], data[ 8 ], data[ 9 ] );
				row.find( '[data-name="publish_at"] input' ).val(
					new_publish_date.getDate() + "." + new_publish_date.getMonth() + "." + new_publish_date.getFullYear() + " 00:00" ) //18.08.2015 00:00
					.trigger( 'change' );

				console.log( new_publish_date );

			}

			var version_input = row.find( '[data-name="verze"] input' );
			if( typeof data[ 10 ] != 'undefined' ) {
				version_input.val( parseInt( data[ 10 ] ) + 1 );
			} else {
				version_input.val( '1' );
			}
			version_input.trigger( 'change' );

		}

	};


	$( function(){
		Autonaming.init();
	} );

} )( jQuery );