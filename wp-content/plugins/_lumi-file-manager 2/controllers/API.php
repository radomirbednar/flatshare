<?php

namespace Lumiart\BohemiaEnergy\FileManagement\Controllers;


use Lumiart\BohemiaEnergy\FileManagement\Models\File;

class API {

	/**
	 * Check, if attachment with this ID is secured and return URL if not.
	 *
	 * @param $att_id int Attachment ID
	 *
	 * @return bool|string URL on succes, false on failure
	 */
	public static function be_get_file_url( $att_id ) {
		$att_id = (int)$att_id;

		$attachment = get_post( $att_id );

		if( empty( $attachment ) ) return false;

		$file = new File( $att_id );
		return $file->getFileURL();

	}

}