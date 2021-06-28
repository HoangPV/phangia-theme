<?php


namespace Kenhana\PgTheme\Adminhtml;

/**
 * Class Main_App
 * @author Hoang Phan <phanvuhoang@gmail.com>
 * @package Kenhana\PgTheme\Adminhtml
 */
class Main_App {
	/**
	 * The ID of this plugin.
	 * @var string
	 */
	private $name;

	/**
	 * The version of this plugin.
	 * @var string
	 */
	protected $version;

	/**
	 * App constructor.
	 *
	 * @param $name
	 * @param $version
	 */
	public function __construct( $name, $version ) {
		$this->name    = $name;
		$this->version = $version;
	}

	/**
	 * enqueue_styles
	 */
	public function enqueue_styles() {
		//wp_enqueue_style( $this->name, plugin_dir_url( __FILE__ ) . 'css/admin.css', [], $this->version, 'all' );
	}

	/**
	 * enqueue_scripts
	 */
	public function enqueue_scripts() {
		//wp_enqueue_script( $this->name, plugin_dir_url( __FILE__ ) . 'js/admin.js', [ 'jquery' ], $this->version, false );
	}
}