<?php

namespace Lumiart\BohemiaEnergy\FileManagement\Controllers;


class FilesACFDisplayConditions {

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

	private function __construct() {

		$this->addOptionsPage();

		add_filter( 'acf/load_field/name=lumi_be_files_config_cpts', array( $this, 'addCPTsOptions' ) );
		add_filter( 'acf/load_field/name=lumi_be_files_config_templates', array( $this, 'addTemplates' ) );

		add_filter( 'acf/get_valid_field_group', array( $this, 'modifyACFLocations' ) );

	}

	private function addOptionsPage() {

		if( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page( array(
				'page_title' => __( 'Nastavení Filemanagementu', LUMI__BE__FILEMANAG__TEXTDOMAIN ),
				'capability' => LUMI__BE__FILEMANAG__CAPABILITY,
				'position' => '162.123',
				'menu_slug' => 'lumi-be-files-config'
			) );
		}

	}

	public function addCPTsOptions( $field ) {
		$post_types = get_post_types( array(
			'public' => true
		), 'objects' );
		$field[ 'choices' ] = array();
		foreach( $post_types as $post_type ) {
			$field[ 'choices' ][ $post_type->name ] = $post_type->labels->name;
		}
		return $field;
	}

	public function addTemplates( $field ) {

		if( !function_exists( 'get_page_templates' ) ) {
			return $field;
		}
		$templates = get_page_templates();

		$field[ 'choices' ] = array();
		foreach( $templates as $template_name => $template_file ) {
			$field[ 'choices' ][ $template_file ] = $template_name;
		}

		return $field;

	}

	public function modifyACFLocations( $field_group ) {
		if( $field_group[ 'key' ] !== 'group_5562fc0e0ab7a' ) return $field_group;

		$final_location = array();

		$cpts = get_field( 'lumi_be_files_config_cpts', 'option' );
		$cpts = ( is_array( $cpts ) ) ? $cpts : array();

		foreach( $cpts as $cpt ) {
			$final_location[][0] = array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => $cpt
			);
		}

		$templates = get_field( 'lumi_be_files_config_templates', 'option' );
		$templates = ( is_array( $templates ) ) ? $templates : array();

		foreach( $templates as $template ) {
			$final_location[][0] = array(
				'param' => 'page_template',
				'operator' => '==',
				'value' => $template
			);
		}

		$field_group[ 'location' ] = $final_location;

		return $field_group;
	}

}