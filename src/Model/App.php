<?php


namespace Kenhana\PgTheme\Model;


/**
 * Class App
 * @author Hoang Phan <phanvuhoang@gmauil.com>
 * @package Kenhana\PgTheme\Model
 */
class App {
	/**
	 * @var string
	 */
	protected $identifier;

	/**
	 * @var \Kenhana\PgTheme\Model\Loader
	 */
	protected $loader;

	/**
	 * @var string
	 */
	protected $version;

	/**
	 * App constructor.
	 */
	public function __construct() {
		$this->identifier = 'kenhana';
		$this->version    = '1.0.0';
		$this->loader     = new \Kenhana\PgTheme\Model\Loader();
		//$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * @return void
	 */
	public function execute() {
		$this->loader->execute();
	}

	/**
	 * @return void
	 */
	private function set_locale() {
		$i18n = new \Kenhana\PgTheme\Model\Translation();
		$i18n->set_domain( $this->identifier );
		$this->loader->add_action( 'plugins_loaded', $i18n, 'load_plugin_textdomain' );
	}

	/**
	 * @return void
	 */
	private function define_admin_hooks() {
		$admin = new \Kenhana\PgTheme\Adminhtml\Main_App( $this->identifier, $this->version );
		$this->loader->add_action( 'admin_enqueue_styles', $admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $admin, 'enqueue_scripts' );
	}

	/**
	 * @return void
	 */
	private function define_public_hooks() {
		$public = new \Kenhana\PgTheme\Frontend\Main_App( $this->identifier, $this->version );
		$this->loader->add_action( 'wp_enqueue_styles', $public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $public, 'enqueue_scripts' );
	}
}