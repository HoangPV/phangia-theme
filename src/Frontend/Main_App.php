<?php


namespace Kenhana\PgTheme\Frontend;


class Main_App {
	/**
	 * @var
	 */
	private $name;
	/**
	 * @var
	 */
	private $version;

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
	 *  Register the stylesheets for the public-facing side of the site.
	 */
	public function enqueue_styles() {
		//wp_enqueue_style( $this->name, plugin_dir_url( __FILE__ ) . 'css/public.css', [], $this->version, 'all' );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 */
	public function enqueue_scripts() {
		//wp_enqueue_script( $this->name, plugin_dir_url( __FILE__ ) . 'js/public.js', [ 'jquery' ], $this->version, 'all' );
	}
}