<?php

namespace Lumiart\BohemiaEnergy\FileManagement\Models;


class AdminScreen {

	private $current_screen;

	/**
	 * @return AdminScreen
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

		$this->current_screen = get_current_screen();

	}

	/**
	 * Check, if we are currently processing one of BE Files screens
	 *
	 * @return bool
	 */
	public function isFilesAdmin() {

		if( isset( $this->current_screen->id )
			&& ( $this->current_screen->id === 'toplevel_page_lumi-be-files'
		        || $this->current_screen->id === 'toplevel_page_lumi-be-ceniky' )
			) return true;

		return false;

	}

	/**
	 * Check, if we are on ceniky or soubory page
	 *
	 * @return bool|string
	 */
	public function getFilesAdminType() {

		if( !isset( $this->current_screen->id ) ) return false;

		if( $this->current_screen->id === 'toplevel_page_lumi-be-ceniky' ) return 'ceniky';
		if( $this->current_screen->id === 'toplevel_page_lumi-be-files' ) return 'files';

		return false;

	}



}