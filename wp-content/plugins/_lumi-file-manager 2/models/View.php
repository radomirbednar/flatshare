<?php

namespace Lumiart\BohemiaEnergy\FileManagement\Models;


class View {

	private $name;

	public function __construct( $name ) {

		$this->name = $name;

	}

	/**
	 * Render template with given data
	 *
	 * @param array $data
	 *
	 * @return bool|string
	 */
	public function render( $data = array() ) {

		$views_path = plugin_dir_path( LUMI__BE__FILEMANAG__PATH ) . 'views';
		$view_file = $views_path . '/' . $this->name . '.php';

		if( !file_exists( $view_file ) ) return false;

		ob_start();
			extract( $data );
			include( $view_file );
		return ob_get_clean();

	}

}