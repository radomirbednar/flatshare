<?php

namespace Lumiart\BohemiaEnergy\FileManagement\Models;


class ACFRepaterFieldObject {

	private $repeater_object;
	private $repeater_object_files;
	private $repeater_object_ceniky;
	private $both = false;
	private $ceniky_uploader_key_cache = null;

	/**
	 * @return ACFRepaterFieldObject
	 */
	public static function getInstance()
	{
		static $instance = null;
		if (null === $instance) {
			$instance = new static();
		}

		return $instance;
	}

	private function __construct() {

		$this->repeater_object = $this->get_repeater_object();

	}

	private function get_repeater_object() {

		$screen = AdminScreen::getInstance();

		switch( $screen->getFilesAdminType() ) {
			case( 'files' ):
				$field_name = 'lumi_be_files';
				break;
			case( 'ceniky' ):
				$field_name = 'lumi_be_ceniky';
				break;
			default:
				$field_name = 'both';
		}

		if( $field_name !== 'both' ) return get_field_object( $field_name );

		$this->both = true;
		$this->repeater_object_files = get_field_object( 'lumi_be_files' );
		$this->repeater_object_ceniky = get_field_object( 'lumi_be_ceniky' );

	}

	/**
	 * Returins ACF field key provided field name.
	 * On screens, where we know, if it's file management screen returns key as string.
	 * On screens like upload ajax will return array with keys for both files and ceniky.
	 *
	 * @param $name
	 *
	 * @return array|bool
	 */
	public function getFieldKeyByName( $name ) {

		if( $this->both === false ) {

			$name_key_arr = $this->mergeKeyNamesArray( $this->repeater_object );

			return ( isset( $name_key_arr[ $name ] ) ) ? $name_key_arr[ $name ] : false;

		} else {
			//We don't know, on which admin page we are

			$name_key_arr_files = $this->mergeKeyNamesArray( $this->repeater_object_files );
			$name_key_arr_ceniky = $this->mergeKeyNamesArray( $this->repeater_object_ceniky );

			$final_keys = array();
			if( isset( $name_key_arr_files[ $name ] ) ) $final_keys[ 'files' ] = $name_key_arr_files[ $name ];
			if( isset( $name_key_arr_ceniky[ $name ] ) ) $final_keys[ 'ceniky' ] = $name_key_arr_ceniky[ $name ];

			return( !empty( $final_keys ) ) ? $final_keys : false;

		}


	}

	private function mergeKeyNamesArray( $input ) {
		$name_key_arr = array();
		foreach( $input[ 'sub_fields' ] as $field ) {
			$name_key_arr[ $field[ 'name' ] ] = $field[ 'key' ];
		}
		return $name_key_arr;
	}

	public function getRepeaterKey() {
		return $this->repeater_object[ 'key' ];
	}

	public function getCenikyUploaderKey() {
		if( $this->ceniky_uploader_key_cache !== null ) return $this->ceniky_uploader_key_cache;

		foreach( $this->repeater_object_ceniky[ 'sub_fields' ] as $field ){
			if( $field[ 'name' ] === 'file' ) {
				$key = $field[ 'key' ];
				break;
			}
		};
		$key = ( isset( $key ) ) ? $key : false;

		$this->ceniky_uploader_key_cache = $key;
		return $key;
	}

}