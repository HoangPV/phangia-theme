<?php


namespace Kenhana\PgTheme\Model;


class Config {

	private static $instance = null;

	const LOGO_CONFIG_NAME = 'logo';
	const BIG_LOGO_CONFIG_NAME = 'big_logo';
	const SLOGAN_CONFIG_NAME = 'slogan';
	const ABOUT_CONFIG_NAME = 'about_text';
	const OPEN_HOURS_CONFIG_NAME = 'open_hours';
	const FOUNDER_CONFIG_NAME = 'founder_name';
	const FOUNDER_AVATAR_CONFIG_NAME = 'founder_avatar';
	const COMPANY_CONFIG_NAME = 'founder_company';
	const FACEBOOK_CONFIG_NAME ='facebook';
	const PHONE_CONFIG_NAME = 'phone';
	const EMAIL_CONFIG_NAME = 'email_address';
	const COMPANY_ADDRESS_CONFIG_NAME = 'address';

	const POD_CONFIG_NAME = 'pg_theme_settings';

	/**
	 * @var bool|\Pods
	 */
	protected $settings;

	/**
	 * @var string
	 */
	public $logo;
	/**
	 * @var string
	 */
	public $big_logo;
	/**
	 * @var string
	 */
	public $slogan;
	/**
	 * @var string
	 */
	public $about_text;
	/**
	 * @var string
	 */
	public $open_hours;
	/**
	 * @var string
	 */
	public $founder_name;
	/**
	 * @var string
	 */
	public $founder_avatar;
	/**
	 * @var string
	 */
	public $founder_company;
	/**
	 * @var string
	 */
	public $facebook;
	/**
	 * @var string
	 */
	public $phone;
	/**
	 * @var string
	 */
	public $email_address;
	/**
	 * @var string
	 */
	public $address;

	private function __construct() {
		if (!function_exists('pods')) {
			throw new \Exception('Pods is not installed.');
		}
		$this->settings = pods(self::POD_CONFIG_NAME);
		$this->logo = $this->settings->display(self::LOGO_CONFIG_NAME);
		$this->slogan = $this->settings->display(self::SLOGAN_CONFIG_NAME);
		$this->about_text = $this->settings->display(self::ABOUT_CONFIG_NAME);
		$this->open_hours = $this->settings->display(self::ABOUT_CONFIG_NAME);
		$this->founder_name = $this->settings->display(self::FOUNDER_CONFIG_NAME);
		$this->founder_avatar = $this->settings->display(self::FOUNDER_AVATAR_CONFIG_NAME);
		$this->founder_company = $this->settings->display(self::COMPANY_CONFIG_NAME);
		$this->facebook = $this->settings->display(self::FACEBOOK_CONFIG_NAME);
		$this->email_address = $this->settings->display(self::EMAIL_CONFIG_NAME);
		$this->phone = $this->settings->display(self::PHONE_CONFIG_NAME);
		$this->address = $this->settings->display(self::COMPANY_ADDRESS_CONFIG_NAME);
		$this->big_logo = $this->settings->display(self:: BIG_LOGO_CONFIG_NAME);
	}

	/**
	 * @return \Kenhana\PgTheme\Model\Config
	 * @throws \Exception
	 */
	public static function get_instance() {
		if (!isset(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * @return string
	 */
	public function get_address() {
		return $this->address;
	}


	/**
	 * @return string
	 */
	public function get_logo() {
		return $this->logo;
	}

	/**
	 * @return string
	 */
	public function get_big_logo() {
		return $this->big_logo;
	}

	/**
	 * @return string
	 */
	public function get_slogan() {
		return $this->slogan;
	}

	/**
	 * @return string
	 */
	public function get_about_text() {
		return $this->about_text;
	}

	/**
	 * @return string
	 */
	public function get_open_hours() {
		return $this->open_hours;
	}

	/**
	 * @return string
	 */
	public function get_founder_name() {
		return $this->founder_name;
	}

	/**
	 * @return string
	 */
	public function get_founder_avatar() {
		return $this->founder_avatar;
	}

	/**
	 * @return string
	 */
	public function get_founder_company() {
		return $this->founder_company;
	}

	/**
	 * @return string
	 */
	public function get_facebook() {
		return $this->facebook;
	}

	/**
	 * @return string
	 */
	public function get_phone() {
		return $this->phone;
	}

	/**
	 * @return string
	 */
	public function get_email_address() {
		return $this->email_address;
	}


}