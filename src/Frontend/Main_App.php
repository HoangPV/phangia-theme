<?php


namespace Kenhana\PgTheme\Frontend;


class Main_App {
	/**
	 * @var string
	 */
	private $name;
	/**
	 * @var string
	 */
	private $version;
	/**
	 * @var string
	 */
	protected $plugin_url;

	/**
	 * App constructor.
	 *
	 * @param $name
	 * @param $version
	 */
	public function __construct( $name, $version ) {

		$this->name    = $name;
		$this->version = $version;
		$theme = wp_get_theme();
		$this->plugin_url = $theme->get_stylesheet_directory_uri();

		$this->register_new_size();
	}

	/**
	 *  Register the stylesheets for the public-facing side of the site.
	 */
	public function enqueue_styles() {

		$files = [
			'bootstrap' => '/css/bootstrap.min.css',
			'animate' => 'css/animate.min.css',
			'javascript-plugins-bundle' => '/css/javascript-plugins-bundle.css',
			'menuzord' => '/js/menuzord/css/menuzord.css',
			'timeline-cp-responsive-vertical' => '/js/timeline-cp-responsive-vertical/timeline-cp-responsive-vertical.css',
			'style-main' => '/css/style-main.css',
			'menuzord-menu-skins' => '/js/menuzord/css/skins/menuzord-rounded-boxed.css',
			'responsive' => '/css/responsive.css',
			'theme-skin-color-set1' => '/css/colors/theme-skin-color-set1.css',
			'revolution-slider' => '/js/revolution-slider/css/rs6.css',
			'extra-rev-slider1' => '/js/revolution-slider/extra-rev-slider1.css'
		];


		foreach ($files as $file_name => $file_path) {
			$handle_name = $this->name . '_' . $file_name;
			$file_uri = $this->plugin_url . $file_path;
			wp_enqueue_style($handle_name, $file_uri, $this->version, [], 'all');
		}
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 */
	public function enqueue_scripts() {
		//wp_enqueue_script( $this->name, plugin_dir_url( __FILE__ ) . 'js/public.js', [ 'jquery' ], $this->version, 'all' );

	}

	public function modify_timber_context($context) {
		//$theme_css = ['container-1340px', 'rtl', 'has-side-panel', 'side-panel-right'];
		//$context['body_class'] .= " " . implode(' ', $theme_css);
		$context['t_settings'] = \Kenhana\PgTheme\Model\Config::get_instance();
		//d($context['post']['post_name']);die;
		return $context;
	}

	public function modify_class_html_tag( $output, $doctype ) {
		$theme_css = ['no-mobile', 'nivo-lightbox-notouch'];
		$output .= ' '. implode(' ', $theme_css);
		return $output;
	}

	public function load_theme_textdomain() {
		load_theme_textdomain($this->name, get_template_directory() . '/languages' );
	}

	private function register_new_size() {
		//add_image_size('pg-slide-size', 1920, 180, true);
	}

}