<?php

namespace Lumiart\BohemiaEnergy\FileManagement\Controllers;


use Lumiart\BohemiaEnergy\FileManagement\Models\ACFRepaterFieldObject;
use Lumiart\BohemiaEnergy\FileManagement\Models\AdminScreen;
use Lumiart\BohemiaEnergy\FileManagement\Models\File;
use Lumiart\BohemiaEnergy\FileManagement\Models\View;

/**
 * Singleton Class AdminInterface
 * Creates and modifies all backend features of this plugin
 *
 * @package Lumiart\BohemiaEnergy\FileManagement\Controllers
 */
class AdminInterface {

	/**
	 * @return AdminInterface
	 */
	public static function getInstance()
	{
		static $instance = null;
		if (null === $instance) {
			$instance = new static();
		}

		return $instance;
	}

	private $fields_map;

	/**
	 * WP hooks
	 */
	private function __construct() {

		$this->fields_map = array(
			'entita',
			'komodita',
			'zakaznik',
			'produktova_rada',
			'distribucni_oblast'
		);

		$this->addOptionsPages();

		add_filter( 'acf/settings/load_json', array( $this, 'addACFJsonPath' ) );

		add_action( 'acf/render_field', array( $this, 'markSecuredFilesInRepeater' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'registerScripts' ) );

		add_action( 'acf/render_field', array( $this, 'enqueuePluginGlobalScripts' ) );

		add_action( 'pre_get_posts', array( $this, 'dontDisplayFilesInMediaLibrary' ) );

		add_action( 'admin_head', array( $this, 'disableAccessToAttachmentEdit' ) );

		add_action( 'edit_attachment', array( $this, 'disableAttachmentManipulation' ) );
		add_action( 'delete_attachment', array( $this, 'disableAttachmentManipulation' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'maybeAddUploaderModificationScript' ) );
		
		add_action( 'acf/render_field', array( $this, 'addDefaultOptionsSelector' ) );

		add_action( 'acf/render_field', array( $this, 'addFilteringTable' ) );

		add_filter( 'acf/load_field/name=lumi_be_ceniky', array( $this, 'modifyCenikySelectorValues' ) );

	}

	/**
	 * Add ACF options pages
	 */
	private function addOptionsPages() {

		if( function_exists( 'acf_add_options_page' ) && function_exists( 'acf_add_options_sub_page' ) ) {

			acf_add_options_page( array(
				'page_title' => __( 'Ceníky', LUMI__BE__FILEMANAG__TEXTDOMAIN ),
				'capability' => LUMI__BE__FILEMANAG__CAPABILITY,
				'icon_url' => 'dashicons-media-spreadsheet',
				'position' => '32.123',
				'menu_slug' => 'lumi-be-ceniky-parent'
			) );

			acf_add_options_sub_page( array(
				'title' => __( 'Soubory ceníků', LUMI__BE__FILEMANAG__TEXTDOMAIN ),
				'slug' => 'lumi-be-ceniky',
				'parent_slug' => 'lumi-be-ceniky-parent',
				'capability' => LUMI__BE__FILEMANAG__CAPABILITY
			) );

			acf_add_options_sub_page( array(
				'title' => __( 'Číselníky', LUMI__BE__FILEMANAG__TEXTDOMAIN ),
				'slug' => 'lumi-be-ceniky-ciselniky',
				'parent_slug' => 'lumi-be-ceniky-parent',
				'capability' => LUMI__BE__FILEMANAG__CAPABILITY
			) );


		}

	}

	/**
	 * Load ACF fields from acf-json folder
	 *
	 * Has to be fired at init with prio 1 at latest.
	 */
	public function addACFJsonPath( $paths ) {
		$paths[] = plugin_dir_path( LUMI__BE__FILEMANAG__PATH ) . 'acf-json';
		return $paths;
	}

	public function markSecuredFilesInRepeater( $field ) {
		$acf_repeater_field_obj = ACFRepaterFieldObject::getInstance();
		$screen = AdminScreen::getInstance();

		if( $screen->isFilesAdmin() ) {
			if( $field[ 'key' ] !== $acf_repeater_field_obj->getFieldKeyByName( 'file' ) ) return;
		} else {
			if( !in_array( $field[ 'key' ], $acf_repeater_field_obj->getFieldKeyByName( 'file' ) ) ) return;
		}

		$file = new File( (int)$field[ 'value' ] );
		$file_status = $file->getStatus();

		if( $file_status === 'unsecured' ) {
			echo '<div class="lumi-be-files-unsecured"></div>';
		} else {
			echo '<div class="lumi-be-files-secured"></div>';
		}

		wp_enqueue_style( 'lumi-be-files-admin' );

	}

	/**
	 * Enqueue scripts and style specific for filemanagement admin screens
	 */
	public function registerScripts() {

		wp_register_style( 'lumi-be-files-admin', plugin_dir_url( LUMI__BE__FILEMANAG__PATH ) . 'assets/lumi-be-files-admin.css', array(), LUMI__BE__FILEMANAG__STATIC_VER );

		wp_register_script(
			'jquery-arrive',
			plugin_dir_url( LUMI__BE__FILEMANAG__PATH ) . 'assets/libs/arrive.min.js',
			array( 'jquery' ),
			LUMI__BE__FILEMANAG__STATIC_VER,
			true
		);

		wp_register_script(
			'jquery-watch',
			plugin_dir_url( LUMI__BE__FILEMANAG__PATH ) . 'assets/libs/jquery-watch.min.js',
			array( 'jquery' ),
			LUMI__BE__FILEMANAG__STATIC_VER,
			true
		);

		wp_register_script(
			'lumi-be-files-file_naming',
			plugin_dir_url( LUMI__BE__FILEMANAG__PATH ) . 'assets/file_naming.js',
			array( 'jquery', 'jquery-arrive', 'jquery-watch' ),
			LUMI__BE__FILEMANAG__STATIC_VER,
			true
		);

	}

	public function enqueuePluginGlobalScripts( $field ) {
		if( $field[ 'key' ] !== 'field_5562fc205d3ff' && $field[ 'key' ] !== 'field_5566cc7b4f6d1' ) return;

		wp_enqueue_style( 'lumi-be-files-admin' );
		wp_enqueue_script( 'lumi-be-files-file_naming' );
	}

	/**
	 * Hide our files in all admin queries except Filemanagement pages
	 *
	 * @param $query \WP_Query
	 */
	public function dontDisplayFilesInMediaLibrary( $query ) {
		if( $query->get( 'post_type' ) !== 'attachment' || !is_admin() ) return;

		global $lumi__be__filemanagement__bypass_files_query_restriction;
		if( $lumi__be__filemanagement__bypass_files_query_restriction ) return;

		$screen = AdminScreen::getInstance();
		if( $screen->isFilesAdmin() ) return; //Don't modify query in files management screens

		$hide_atts_meta_array = array(
			'relation' => 'OR',
			array(
				'key' => '_lumi-be-secured-file',
				'compare' => 'NOT EXISTS'
			),
			array(
				'relation' => 'AND',
				array(
					'key' => '_lumi-be-secured-file',
					'compare' => '!=',
					'value' => 'secured'
				),
				array(
					'key' => '_lumi-be-secured-file',
					'compare' => '!=',
					'value' => 'unsecured'
				)
			)
		);

		if( is_array( $query->meta_query ) ) {
			$final_meta_query = array(
				'relation' => 'AND',
				$query->meta_query,
				$hide_atts_meta_array
			);
		} else {
			$final_meta_query = $hide_atts_meta_array;
		}

		$query->set( 'meta_query', $final_meta_query );
	}

	/**
	 * Disable edit screen for protected files
	 */
	public function disableAccessToAttachmentEdit() {
		$screen = get_current_screen();
		if( $screen->base !== 'post' || $screen->id !== 'attachment' ) return;

		global $post;
		$file = new File( $post->ID );

		if( $file->isProtected() ) {
			wp_die( __( 'Tento soubor je možné editovat pouze skrze menu "Soubory".', LUMI__BE__FILEMANAG__TEXTDOMAIN ) );
		}

	}

	/**
	 * Don't allow edit or delete of protected post
	 *
	 * @param $att_id int Attachment ID
	 */
	public function disableAttachmentManipulation( $att_id ) {
		global $lumi__be__filemanagement__bypass_file_delete_restriction;
		if( $lumi__be__filemanagement__bypass_file_delete_restriction === true ) return;

		$file = new File( $att_id );
		if( $file->isProtected() ) {
			wp_die( __( 'Tento soubor je možné editovat pouze skrze menu "Soubory".', LUMI__BE__FILEMANAG__TEXTDOMAIN ) );
		}

	}

	/**
	 * If we are on file management screen, add Uploader modifications script
	 */
	public function maybeAddUploaderModificationScript() {

		$screen = AdminScreen::getInstance();

		if( $screen->isFilesAdmin() ) {

			wp_enqueue_script(
				'lumi-be-filemanagement-uploader_modifications',
				plugin_dir_url( LUMI__BE__FILEMANAG__PATH ) . 'assets/uploader_modifications.js',
				array( 'jquery', 'jquery-arrive' ),
				LUMI__BE__FILEMANAG__STATIC_VER
			);


			$admin_screen = AdminScreen::getInstance();
			if( $admin_screen->getFilesAdminType() === 'ceniky' ) {

				/*
				 * Defaults table
				 */
				wp_register_script(
					'lumi-be-filemanagement-defaults_table',
					plugin_dir_url( LUMI__BE__FILEMANAG__PATH ) . 'assets/defaults_table.js',
					array( 'jquery', 'jquery-arrive' ),
					LUMI__BE__FILEMANAG__STATIC_VER,
					true
				);

				$acf_fields_obj = ACFRepaterFieldObject::getInstance();
				wp_localize_script( 'lumi-be-filemanagement-defaults_table', 'LumiBEFilemanagementDefaultsTable', array(
					'default_fields_map' => array(
						$acf_fields_obj->getFieldKeyByName( 'publish_at' ) => 'publish_at',
						$acf_fields_obj->getFieldKeyByName( 'publish_until' ) => 'publish_until'
					)
				) );

				wp_enqueue_script( 'lumi-be-filemanagement-defaults_table' );


				/*
				 * Files auto-naming
				 */
				wp_register_script(
					'lumi-be-filemanagement-autonaming',
					plugin_dir_url( LUMI__BE__FILEMANAG__PATH ) . 'assets/autonaming.js',
					array( 'jquery', 'jquery-arrive', 'jquery-watch' ),
					LUMI__BE__FILEMANAG__STATIC_VER,
					true
				);

				wp_enqueue_script( 'lumi-be-filemanagement-autonaming' );

				/*
				 * Filtering
				 */
				wp_register_script(
					'lumi-be-filemanagement-filtering',
					plugin_dir_url( LUMI__BE__FILEMANAG__PATH ) . 'assets/filtering.js',
					array( 'jquery' ),
					LUMI__BE__FILEMANAG__STATIC_VER,
					true
				);

				wp_enqueue_script( 'lumi-be-filemanagement-filtering' );

			}


		}

	}

	public function addDefaultOptionsSelector( $field ) {
		$acf_fields_obj = ACFRepaterFieldObject::getInstance();
		if( $field[ 'key' ] !== $acf_fields_obj->getRepeaterKey() ) return;

		$default_options_table_view = new View( 'default_options_table' );
		echo $default_options_table_view->render();
	}

	public function addFilteringTable( $field ) {
		$acf_fields_obj = ACFRepaterFieldObject::getInstance();
		if( $field[ 'key' ] !== $acf_fields_obj->getRepeaterKey() ) return;

		$default_options_table_view = new View( 'filtering_table' );
		$data = array();

		foreach( $this->fields_map as $field ) {
			$data[ $field ] = get_field( 'lumi_be_files_vars_' . $field, 'option' );
		};

		$data[ 'fields_list' ] = $this->fields_map;

		$data[ 'years' ] = $this->getDistinctValues( 'rok' );
		$data[ 'verze' ] = $this->getDistinctValues( 'verze' );

		echo $default_options_table_view->render( $data );
	}

	private function getDistinctValues( $field_name ) {
		$all_items = get_field( 'lumi_be_ceniky', 'option' );
		$distinct_items = array();
		foreach( $all_items as $item ) {
			$distinct_items[] = $item[ $field_name ];
		}
		$distinct_items = array_filter( array_unique( $distinct_items ) );
		sort( $distinct_items, SORT_NUMERIC );


		return $distinct_items;
	}


	public function modifyCenikySelectorValues( $field ) {

		foreach( $field[ 'sub_fields' ] as $key => $subfield ) {
			if( in_array( $subfield[ 'name' ], $this->fields_map ) ) {

				$choices = get_field( 'lumi_be_files_vars_' . $subfield[ 'name' ], 'option' );
				$select = array();
				foreach( $choices as $choice ) {
					$select[ $choice[ 'tag' ] ] = $choice[ 'title' ];
				}

				$field[ 'sub_fields' ][ $key ][ 'choices' ] = $select;

			}
		}

		return $field;
	}


}