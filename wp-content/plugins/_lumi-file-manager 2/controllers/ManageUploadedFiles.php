<?php

namespace Lumiart\BohemiaEnergy\FileManagement\Controllers;
use Lumiart\BohemiaEnergy\FileManagement\Models\ACFRepaterFieldObject;
use Lumiart\BohemiaEnergy\FileManagement\Models\AdminScreen;
use Lumiart\BohemiaEnergy\FileManagement\Models\File;

/**
 * Singleton Class ManageUploadedFiles
 * Catches uploaded files and secures them if necessary
 *
 * @package Lumiart\BohemiaEnergy\FileManagement\Controllers
 */
class ManageUploadedFiles {

	private $repeater_data_cache = null;

	/**
	 * @return ManageUploadedFiles
	 */
	public static function getInstance()
	{
		static $instance = null;
		if (null === $instance) {
			$instance = new static();
		}

		return $instance;
	}

	/**
	 * WP hooks
	 */
	private function __construct() {

		add_action( 'add_attachment', array( $this, 'checkForSecureFileUpload' ) );

		add_action( 'acf/save_post', array( $this, 'bindOptionsPageSave' ) );

		add_filter( 'upload_dir', array( $this, 'moveCenikyToMonthsFolder' ) );

	}

	/**
	 * Hook to every attachment upload and check, if it was added through our option pages
	 *
	 * @param $post_id int Just added attachment post ID
	 */
	public function checkForSecureFileUpload( $post_id ) {
		$acf_field_obj = ACFRepaterFieldObject::getInstance();
		if( isset( $_POST[ '_acfuploader' ] )
		    && in_array( $_POST[ '_acfuploader' ], $acf_field_obj->getFieldKeyByName( 'file' ) ) ) {

			$file = new File( $post_id );
			$file_type = array_search( $_POST['_acfuploader'], $acf_field_obj->getFieldKeyByName( 'file' ) );
			if( $file_type === 'files' ) {
				$file->markFileType( intval( $_POST[ 'post_id' ] ) );
			} else {
				$file->markFileType( $file_type );
			}
			$file->secure();

		}
	}

	/**
	 * Fire actions on our Options page save
	 *
	 * @param $post_id int
	 */
	public function bindOptionsPageSave( $post_id ) {
		//On options pages
		if( $post_id === 'options' ) {

			$current_screen = AdminScreen::getInstance();
			if( !$current_screen->isFilesAdmin() ) return;

			/**
			 * Bind actions
			 */
			$this->iterateAndSecureOrUnsecureAllFiles();
			$this->checkForDeletedFiles();

		}

		//On post pages
		if( !empty( $post_id ) ) {

			$this->iterateAndSecureOrUnsecureAllFiles( $post_id );
			$this->checkForDeletedFiles( $post_id );

		}

	}

	/**
	 * On save of files options page, unsecure published files and secure unpublished
	 *
	 * @param $post_id int Saved post id
	 */
	private function iterateAndSecureOrUnsecureAllFiles( $post_id = 'options' ) {

		$repeater_data = $this->getRepeaterData( $post_id );

		foreach( $repeater_data as $repeater_item ) {
			$file = new File( $repeater_item[ 'file' ] );

			if( empty( $repeater_item[ 'publish_at' ] ) && empty( $repeater_item[ 'publish_until' ] ) ) {
				$file->unsecure();
				continue;
			}

			if( empty( $repeater_item[ 'publish_at' ] ) ) {
				$publish_at = date_sub( date_create(), new \DateInterval( 'P1D' ) );
			} else {
				$publish_at = date_create( $repeater_item[ 'publish_at' ] );
			}

			if( empty( $repeater_item[ 'publish_until' ] ) ) {
				$publish_until = date_add( date_create(), new \DateInterval( 'P1D' ) );
			} else {
				$publish_until = date_create( $repeater_item[ 'publish_until' ] );
			}
			$now = date_create();

			if( $publish_at <= $now && $publish_until >= $now ) {
				$file->unsecure();
			} else {
				$file->secure();
			}

		}

	}

	/**
	 * Go through all files in repeater and delete attachments, if they were removed from repeater
	 */
	private function checkForDeletedFiles( $post_id = 'options' ) {

		$repeater_data = $this->getRepeaterData( $post_id );

		if( $post_id === 'options' ) {
			$screen = AdminScreen::getInstance();
			$screen_type = $screen->getFilesAdminType();
			$meta_value = $screen_type;
		} else {
			$meta_value = $post_id;
		}

		$meta_query = array(
			'relation' => 'AND',
			array(
				'key' => '_lumi-be-secured-file-type',
				'value' => $meta_value
			)
		);

		global $lumi__be__filemanagement__bypass_files_query_restriction;
		$lumi__be__filemanagement__bypass_files_query_restriction = true;

		$securable_attachments = new \WP_Query( array(
			'post_type' => 'attachment',
			'post_status' => 'any',
			'nopaging' => true,
			'meta_query' => $meta_query
		) );

		$repeater_ids = array();
		foreach( $repeater_data as $item ) {
			$repeater_ids[] = $item[ 'file' ];
		}

		foreach( $securable_attachments->posts as $post ) {

			if( !in_array( $post->ID, $repeater_ids ) ) {

				//Delete att with this id
				$file = new File( $post->ID );
				$file->unsecure(); //So WP delete would work as expected

				global $lumi__be__filemanagement__bypass_file_delete_restriction;
				$lumi__be__filemanagement__bypass_file_delete_restriction = true;
				wp_delete_attachment( $post->ID, true );

			}

		}


	}

	/**
	 * Cache requests for repeater data
	 *
	 * @return array Repeater data
	 */
	private function getRepeaterData( $post_id = 'options' ) {
		if( $this->repeater_data_cache === null ) {
			if( $post_id === 'options' ) {
				$screen = AdminScreen::getInstance();
				$screen_type = $screen->getFilesAdminType();
				$this->repeater_data_cache = get_field( 'lumi_be_' . $screen_type, 'option' );
			} else {
				$this->repeater_data_cache = get_field( 'lumi_be_files', $post_id );
			}
			if( empty( $this->repeater_data_cache ) ) $this->repeater_data_cache = array();
		}
		return $this->repeater_data_cache;
	}

	public function moveCenikyToMonthsFolder( $uploads ) {
		$acf_field_obj = ACFRepaterFieldObject::getInstance();
		$ceniky_upload_key = $acf_field_obj->getCenikyUploaderKey();

		if( isset( $_POST[ '_acfuploader' ] ) && $_POST[ '_acfuploader' ] === $ceniky_upload_key ) {
			//Upload via ceniky
			$subdir = '/' . LUMI__BE__FILEMANAG__CENIKY_UPLOADS_FOLDER;

			preg_match( '/(.{2})-(.{2})-(.{2})-(.{2})-(.{2})-(.{2})_(\d{4})(\d{2})(\d{2})(\d+)?\./i', $_POST[ 'name' ], $matches );
			if( !empty( $matches[ 7 ] ) ) {
				//already checked for 4-digit string by preg but to be sure
				$year = (string)(int)$matches[ 7 ];
				$subdir .= '/' . $year;
			}

			$uploads[ 'path' ] = $uploads[ 'basedir' ] . $subdir;
			$uploads[ 'url' ] = $uploads[ 'baseurl' ] . $subdir;

		}

		return $uploads;
	}


}