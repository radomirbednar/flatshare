<?php

namespace Lumiart\BohemiaEnergy\FileManagement\Controllers;

/**
 * Class ActivateDeactivate
 * Plugin installs and uninstalls
 *
 * @package Lumiart\BohemiaEnergy\FileManagement\Controllers
 */
class ActivateDeactivate {


	public function activate() {

		self::addHtaccessToUploads();
		self::insertDefaultCiselniky();

	}

	public function deactivate() {

		self::removeHtaccess();

	}


	private static function addHtaccessToUploads() {

		$uploads_path = wp_upload_dir();
		$htaccess_path = $uploads_path[ 'basedir' ] . '/.htaccess';

		if( !file_exists( $uploads_path . '/.htaccess' ) ) {

			file_put_contents( $htaccess_path, self::getHtaccessContent() );

		}

	}

	private static function removeHtaccess(){

		$uploads_path = wp_upload_dir();
		$htaccess_path = $uploads_path[ 'basedir' ] . '/.htaccess';

		if( file_exists( $htaccess_path ) ) {
			unlink( $htaccess_path );
		}

	}

	private static function getHtaccessContent() {
		return <<<HTACCESS
# Apache < 2.3
<IfModule !mod_authz_core.c>
	<FilesMatch "\.sec$">
	    Order allow,deny
	    Deny from all
	    Satisfy All
    </FilesMatch>
</IfModule>

# Apache ≥ 2.3
<IfModule mod_authz_core.c>
	<FilesMatch "\.sec$">
		Require all denied
    </FilesMatch>
</IfModule>
HTACCESS;

	}

	private static function insertDefaultCiselniky() {

		if( get_option( 'options_lumi_be_files_defaults_inserted' ) == false ) {

			include( plugin_dir_path( LUMI__BE__FILEMANAG__PATH ) . 'data/default-ciselniky.php' );

			/** @var array $default_ciselniky */
			foreach ( $default_ciselniky as $item ) {
				update_option( $item[ 'option_name' ], $item[ 'option_value' ], 'no' );
			};

			update_option( 'options_lumi_be_files_defaults_inserted', true, 'no' );

		}

	}


}