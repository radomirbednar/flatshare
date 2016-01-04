/* global jQuery */
( function( $ ){

	var Filtering = {

		init: function() {

			this.filtering_table = $( '[data-js-lumi-be-filtering_table]:first' );
			this.fields = this.filtering_table.find( '[data-js-lumi-be-filter]' );
			this.clear_button = $( '[data-js-lumi-be-filtering_clear]' );

			this.bindEvents();

		},

		bindEvents: function() {

			this.fields.on( 'change', $.proxy( this.filter, this ) );
			var t = this;
			this.clear_button.on( 'click', function( evt ){
				evt.preventDefault();
				t.clearFilters();
			} );

		},

		filter: function() {

			var all_items = $( '.acf-repeater .acf-row' ),
				filtered_items = [];

			//Hide all items
			all_items.hide();

			//Iterate throught all items
			var t = this;
			all_items.each( function( index, item ) {
				item = $( item );
				if( t.itemPassed( item ) ) {
					filtered_items.push( item );
				}
			} );

			//Show only those which met conditions
			$.each( filtered_items, function( i, item ){
				$( item ).show();
			} );

		},

		itemPassed: function( item ){

			//If this is row without file (ergo new file upload), always show it
			var uploader = item.find( '.acf-file-uploader' );
			if( !uploader.hasClass( 'has-value' ) ) return true;

			var fields = [ 'entita', 'komodita', 'zakaznik', 'produktova_rada', 'distribucni_oblast', 'rok', 'verze' ];

			var t = this;
			var passed = true;
			$.each( fields, function( i, field_name ){
				var filter_val = t.fields.filter( '[data-js-lumi-be-filter="' + field_name + '"]' ).val(),
					row_val = item.find( '[data-name="' + field_name + '"] select, [data-name="' + field_name + '"] input' ).val();
				if( filter_val === 'blank' ) filter_val = '';

				if( filter_val !== 'no_filter' ) {
					//filter by value
					if( filter_val != row_val ) passed = false;
				}
			} );


			return passed;

		},

		clearFilters: function() {

			this.fields.val( 'no_filter' );
			this.fields.first().trigger( 'change' );

		}

	};


	$( function() {
		Filtering.init();
	} );


} )( jQuery );