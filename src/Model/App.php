<?php


namespace Kenhana\PgTheme\Model;


/**
 * Class App
 * @author Hoang Phan <phanvuhoang@gmauil.com>
 * @package Kenhana\PgTheme\Model
 */
class App extends \Timber\Site {
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

	//protected $image_size;

	/**
	 * App constructor.
	 */
	public function __construct( $site_name_or_id = null ) {
		add_action( 'after_setup_theme', [$this, 'theme_supports'] );
		add_filter( 'timber/context', [$this, 'add_to_context'] );
		add_filter( 'timber/twig', [$this, 'add_to_twig'] );
		add_action( 'init', [$this, 'register_post_types'] );
		add_action( 'init', [$this, 'register_taxonomies'] );

		$this->identifier = 'kenhana';
		$this->version    = '1.0.0';
		$this->loader     = new \Kenhana\PgTheme\Model\Loader();

		$this->define_admin_hooks();

		$this->define_public_hooks();

		parent::__construct( $site_name_or_id );
	}

	/**
	 * @return void
	 */
	public function execute() {
		$this->loader->execute();
	}

	public function register_post_types() {

	}

	public function register_taxonomies() {

	}

	/**
	 * @param array $context context['this'] Being the Twig's {{ this }}.
	 *
	 * @return array
	 */
	public function add_to_context( $context ) {
		$context['menu']  = new \Timber\Menu('primary-menu');
		$context['footer_menu'] = new \Timber\Menu('footer-menu');
		$context['site']  = $this;
		//$context['html_extra_class'] = 'no-mobile nivo-lightbox-notouch';
		$context['html_extra_class'] = '';
		return $context;
	}

	public function theme_supports() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			[
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			]
		);
		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordprenqueue_stylesess.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			[
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			]
		);

		add_theme_support( 'menus' );
	}



	public function trans($text) {
		return __($text, $this->identifier);
	}

	/**
	 * @param \Twig\Environment $twig
	 * @return \Twig\Environment
	 */
	public function add_to_twig( $twig ) {
		$twig->addExtension( new \Twig\Extension\StringLoaderExtension() );
		$twig->addFilter(new \Twig\TwigFilter('t', [$this, 'trans']));
		$twig->addFilter(new \Twig\TwigFilter('src', [$this, 'get_image_url']));
		$function_debug = new \Twig\TwigFunction('debug', function($xx) {
			//var_dump($xx);die;
		});
		$twig->addFilter(new \Twig\TwigFilter('src_banner', [$this, 'get_image_banner_url']));
		$twig->addFilter(new \Twig\TwigFilter('src_video_popup', [$this, 'get_video_popup_image_banner_url']));
		//$twig->addFilter(new \Twig\TwigFilter('src_bg_why_us', [$this, 'get_image_for_block_why_us']));
		$twig->addFunction($function_debug);
		$function = new \Twig\TwigFunction('should_active', function (\Timber\MenuItem $item,  $post) {
			if ($post instanceof \Timber\Post) {
				return $item->url == $post->get_permalink();
			}
			return false;
		});
		$twig->addFunction($function);
		return $twig;
	}

	public function get_image_url($id) {
		//$html = wp_get_attachment_image_src( $id, null, false);
		$html = wp_get_attachment_image_src( $id, null, false);
		//var_dump($html);
		return $html[0];
	}

	public function get_image_banner_url($id) {
		$html = wp_get_attachment_image_src( $id, [1920,1280], false);
		return $html[0];
	}

	public function get_video_popup_image_banner_url($id) {
		$html = wp_get_attachment_image_src( $id, [1919,727], false);
		return $html[0];
	}

//	public function get_image_for_block_why_us($id) {
//		$html = wp_get_attachment_image_src( $id, [1920,1280], false);
//		return $html[0];
//	}

	/**
	 * @return void
	 */
	private function set_locale() {
		$i18n = new \Kenhana\PgTheme\Model\Translation();
		$i18n->set_domain( $this->identifier )->load_plugin_textdomain();
	}

	/**
	 * @return void
	 */
	private function define_admin_hooks() {
		$admin = new \Kenhana\PgTheme\Adminhtml\Main_App( $this->identifier, $this->version );
//		$this->loader->add_action('admin_menu', $admin, 'remove_menu_links');
		//$this->loader->add_action( 'admin_enqueue_styles', $admin, 'enqueue_styles' );
		//$this->loader->add_action( 'admin_enqueue_scripts', $admin, 'enqueue_scripts' );
	}

	/**
	 * @return void
	 */
	private function define_public_hooks() {
		$public = new \Kenhana\PgTheme\Frontend\Main_App( $this->identifier, $this->version );
		//$this->loader->add_action( 'wp_enqueue_scripts', $public, 'enqueue_styles' );
		//$this->loader->add_action( 'wp_enqueue_scripts', $public, 'enqueue_scripts' );
		$this->loader->add_filter('timber_context', $public, 'modify_timber_context');
		//$this->loader->add_filter('language_attributes', $public, 'modify_class_html_tag', null, 2);
		//$this->loader->add_filter('timber_context', $public, '')
		//$this->loader->add_action('after_setup_theme', $public, 'load_theme_textdomain');
	}
}