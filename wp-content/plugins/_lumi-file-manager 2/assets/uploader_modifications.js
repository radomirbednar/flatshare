/* global jQuery, window.wp.media */
( function( $  ){

	$( function() {

		//Library button in uploader
		$( document ).arrive( '.media-router .media-menu-item', function() {
			var item = $( this ),
				all_items = item.parent().children();
			if( all_items.index( item ) === 1 ) {
				item.hide();
			}
			if( all_items.index( item ) === 0 ) {
				item.trigger('click');
			}
		} );

		//Not attached files
		$( document ).arrive( '.attachments.ui-sortable li', function() {
			var item = $( this );
			if( !item.hasClass( 'selected' ) ) {
				item.hide();
			}
		} );

		//Move add new file above repeater
		$('.acf-repeater' ).each( function() {
			var $repeater = $( this ),
				button = $repeater.children( '.acf-hl' );
			$repeater.prepend( button );

		} );

		//New file on top of repeater
		$( document ).arrive( '.acf-row', function() {
			var $row = $( this ),
				$table = $row.parent();

			$table.prepend( $row );

		} );

	} );

} )( jQuery );