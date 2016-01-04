<?php
/*
Plugin Name: Advanced Custom Fields: Timepicker
Version: 1.0.0
Author: Jakub Klapka
Author URI: https://www.lumiart.cz
*/


// 1. set text domain
// Reference: https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
load_plugin_textdomain( 'acf-timepicker', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );




// 2. Include field type for ACF5
// $version = 5 and can be ignored until ACF6 exists
function include_field_types_timepicker( $version ) {
	
	include_once('acf-timepicker-v5.php');
	
}

add_action('acf/include_field_types', 'include_field_types_timepicker');
