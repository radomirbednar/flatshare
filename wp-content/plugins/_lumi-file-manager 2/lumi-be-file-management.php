<?php
/*
 * Plugin name: [Bohemiaenergy.cz] File Management plugin
 * Version: 1.2
 * Description: Custom made file management plugin for Bohemia Energy website.
 * Author: Jakub Klapka
 * Author URI: https://www.lumiart.cz
 */

/**
 * Libs
 */
include_once( 'vendor/autoload.php' );
include_once( 'acf-timepicker/acf-timepicker.php' );

/**
 * Settings
 */
define( 'LUMI__BE__FILEMANAG__TEXTDOMAIN', 'lumi-bohemiaenergy-filemanagement' );
define( 'LUMI__BE__FILEMANAG__CAPABILITY', 'manage_options' );
define( 'LUMI__BE__FILEMANAG__PATH', __FILE__ );
define( 'LUMI__BE__FILEMANAG__STATIC_VER', 3 );
define( 'LUMI__BE__FILEMANAG__CENIKY_UPLOADS_FOLDER', 'ceniky' );

/**
 * Class autoloading
 */
spl_autoload_register( function( $class_name ) {
	if( strpos( $class_name, 'Lumiart\BohemiaEnergy\FileManagement\Controllers' ) !== false ) {
		include_once( 'controllers/' . str_replace( 'Lumiart\BohemiaEnergy\FileManagement\Controllers\\', '', $class_name ) . '.php' );
	}
	if( strpos( $class_name, 'Lumiart\BohemiaEnergy\FileManagement\Models' ) !== false ) {
		include_once( 'models/' . str_replace( 'Lumiart\BohemiaEnergy\FileManagement\Models\\', '', $class_name ) . '.php' );
	}
} );

/**
 * Dependencies
 */
add_action( 'tgmpa_register', function() {
	$plugins = array(
		array(
			'name'               => 'Advanced Custom Fields Pro', // The plugin name.
			'slug'               => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name).
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
		)
	);
	tgmpa( $plugins );
} );

/**
 * Fix plugins translations
 */
load_textdomain( 'acf', plugin_dir_path( LUMI__BE__FILEMANAG__PATH ) . 'acf-lang/acf-cs_CZ.mo' );

/**
 * Activation
 */
register_activation_hook( __FILE__, array( 'Lumiart\BohemiaEnergy\FileManagement\Controllers\ActivateDeactivate', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Lumiart\BohemiaEnergy\FileManagement\Controllers\ActivateDeactivate', 'deactivate' ) );

/**
 * Controllers init
 */
add_action( 'init', function() {

	\Lumiart\BohemiaEnergy\FileManagement\Controllers\AdminInterface::getInstance();

	if( is_admin() ) {
		\Lumiart\BohemiaEnergy\FileManagement\Controllers\ManageUploadedFiles::getInstance();
		\Lumiart\BohemiaEnergy\FileManagement\Controllers\FilesACFDisplayConditions::getInstance();
	}

}, 4 );

/**
 * API
 */
include_once( 'api.php' );

/**
 * DEBUG ONLY
 */
//add_filter( 'acf/settings/save_json', function( $paths ){
//	$paths = plugin_dir_path( LUMI__BE__FILEMANAG__PATH ) . 'acf-json';
//	return $paths;
//} );
