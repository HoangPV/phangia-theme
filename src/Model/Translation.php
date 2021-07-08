<?php


namespace Kenhana\PgTheme\Model;


class Translation {
	/**
	 * @var
	 */
	private $domain;

	/**
	 * Load the plugin text domain for translation.
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			$this->domain,
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}

	/**
	 * @param $domain
	 *
	 * @return $this
	 */
	public function set_domain( $domain ) {
		$this->domain = $domain;
		return $this;
	}
}