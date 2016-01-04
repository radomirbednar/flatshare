<?php

if( !function_exists( 'be_get_file_url' ) ) {
	/**
	 * @see \Lumiart\BohemiaEnergy\FileManagement\Controllers\API::be_get_file_url
	 */
	function be_get_file_url( $att_id ) {
		return \Lumiart\BohemiaEnergy\FileManagement\Controllers\API::be_get_file_url( $att_id );
	}
}