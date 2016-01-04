<?php

namespace Lumiart\BohemiaEnergy\FileManagement\Models;


class File {

	private $att_id;

	public function __construct( $att_id ) {

		$this->att_id = intval( $att_id );

	}

	/**
	 * Secure file by adding .sec to filename
	 */
	public function secure() {

		if( $this->getStatus() === 'secured' ) return;

		$file_path = get_attached_file( $this->att_id );
		if( substr( $file_path, -4 ) !== '.sec' ) {
			rename( $file_path, $file_path . '.sec' );
			//Create placeholder
			file_put_contents( $file_path, "Access Denied" );
		}

		$this->updateStatus( 'secured' );

	}

	/**
	 * Remove .sec from filename
	 */
	public function unsecure() {

		if( $this->getStatus() === 'unsecured' ) return;

		$file_path = get_attached_file( $this->att_id ) . '.sec';
		if( file_exists( $file_path ) ) {
			rename( $file_path, substr( $file_path, 0, -4 ) );
		}

		$this->updateStatus( 'unsecured' );

	}

	/**
	 * Get current file status
	 * @return string
	 */
	public function getStatus() {
		return get_post_meta( $this->att_id, '_lumi-be-secured-file', true );
	}

	/**
	 * Update file status
	 * @param $status string 'secured'|'unsecured'
	 */
	private function updateStatus( $status ) {
		update_post_meta( $this->att_id, '_lumi-be-secured-file', $status );
	}


	/**
	 * Mark att metadata for file type
	 *
	 * @param $type string
	 */
	public function markFileType( $type ) {
		update_post_meta( $this->att_id, '_lumi-be-secured-file-type', $type );
	}


	private function getFileType() {
		return get_post_meta( $this->att_id, '_lumi-be-secured-file-type', true );
	}

	/**
	 * Check, if file should be published now and return it's URL if so.
	 * @return bool|string
	 */
	public function getFileURL() {

		$secure_status = $this->getStatus();
		if( empty( $secure_status ) || $secure_status === 'unsecured' ) {
			return wp_get_attachment_url( $this->att_id );
		}

		if( $secure_status === 'secured' ) {
			//check, if we sould unsecure file

			if( $this->getFileType() !== 'ceniky' ) {
				$files = get_field( 'lumi_be_files', $this->getFileType() );
			} else {
				$files = get_field( 'lumi_be_ceniky', 'option' );
			}

			foreach( $files as $file ) {
				if( $file[ 'file' ] === $this->att_id ) {

					$publish_at = date_create( $file[ 'publish_at' ] );
					$publish_until = date_create( $file[ 'publish_until' ] );
					$now = date_create();

					if( $publish_at <= $now && $publish_until >= $now ) {
						$this->unsecure();
						return wp_get_attachment_url( $this->att_id );
					} else {
						$this->secure();
						return false;
					}

				}
			}

		}

	}

	/**
	 * Check, if this file is one of protected ones. (Was uploaded and managed through file management screen)
	 *
	 * @return bool
	 */
	public function isProtected() {
		$status = $this->getStatus();

		if( $status === 'secured' || $status === 'unsecured' ) {
			return true;
		}
		return false;
	}


}