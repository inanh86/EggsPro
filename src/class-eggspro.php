<?php namespace EggsPro\src\Run;

if (!defined('ABSPATH')) {
    exit;
}

final class EggsPro {
    /**
	 * Point Of Sale version.
	 *
	 * @var string
	 */
    public $version = '1.0.0';
    /**
	 * The single instance of the class.
	 *
	 * @since 0.1
	 */
    protected static $_instance = null;

    /**
	 * Main WpResetAPI Instance.
	 *
	 * Ensures only one instance of  WpResetAPI is loaded or can be loaded.
	 *
	 * @since 0.1
	 * @return EggsPro Main instance.
	 */
    public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	public function __construct() {
		$this->define_constants();
        $this->includes();
        $this->init_hooks();
        $this->runClass();
    }
    /**
	 * Define constant if not already set.
	 *
	 * @param string      $name  Constant name.
	 * @param string|bool $value Constant value.
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}
    /**
	 * Defined 
	 */
    private function define_constants() {
        $this->define( 'API_ABSPATH',  API_PLUGIN_FILE );
	}
	/**
	 * Hook Default
	 * @see 
	 */
    public function init_hooks() {
		// Xóa các hook mặc định không sử dụng
		$this->remove_hook();
        // chạy đầu tiên khi tiến hành active template
        add_action( 'after_switch_theme', ['\EggsPro\src\Install', 'init' ] );
		// Cài đặt thiết lập mặc định
		add_action( 'after_setup_theme',  [ $this, 'setup' ] );
		// Gọi scripts vào Template
		add_action( 'wp_enqueue_scripts', [ $this, 'scripts' ] );
		// tag
		add_filter( 'style_loader_tag',  [ $this, 'style_tags'], 10, 4 );
		add_filter( 'script_loader_tag', [ $this, 'script_tags'], 10, 3 );
	}
	/**
	 * Remove Hook mặc định đi cho nhẹ
	 */
	public function remove_hook() {
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'wp_generator');
		add_filter( 'xmlrpc_enabled', '__return_false' );
		/* Disable the Admin Bar. */
		add_filter( 'show_admin_bar', '__return_false' );
	}
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/after_setup_theme/
	 */
	public function setup() {
		/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on twentyfifteen, use a find and replace
		* to change 'twentyfifteen' to the name of your theme in all the template files
		*/
		load_theme_textdomain( 'eggspro', API_PLUGIN_FILE . '/lang' );
		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded  tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support( 'title-tag' );
		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu',      'eggspro' ),
		) );
		/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );
		/*
		* Enable support for Post Formats.
		*
		* See: https://codex.wordpress.org/Post_Formats
		*/
		add_theme_support( 'post-formats', array(
			'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
		) );
	}
	/**
	 * Registers the script if $src provided (does NOT overwrite), and enqueues it.
	 * @see https://developer.wordpress.org/reference/functions/wp_enqueue_script/
	 */
	public function scripts() {
		wp_enqueue_style( 'BootStrap', '//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css', [], '', 'all' );
		wp_enqueue_style( 'BootStrap-icon', '//cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css', [], '', 'all' );
        wp_enqueue_style( 'OwlCarousel2', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', [], '', 'all' );
        wp_enqueue_style( 'OwlCarousel2-theme', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', [], '', 'all' );
		wp_enqueue_style( 'EggsPro-style', EGGSPRO_DIR_URL .'/style.css', [], $this->version, 'all' );
		
		wp_enqueue_script( 'BootStrap', '//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js', [], '', true );
        wp_enqueue_script( 'OwlCarousel2', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', [], '', true );
		wp_enqueue_script( 'EggsPro', EGGSPRO_DIR_URL . '/src/assets/js/eggspro.js', [], $this->version, true );
	}
	public function style_tags( $tag, $handle, $src, $media ) {
		if( $handle === 'BootStrap' ) {
			$tag = "<link rel='stylesheet' id='{$handle}' href='{$src}' integrity='sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl' crossorigin='anonymous' type='text/css' media='{$media}' />";
		}
        if ( $handle === 'OwlCarousel2' ) {
            $tag = "<link rel='stylesheet' id='{$handle}' href='{$src}' integrity='sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==' crossorigin='anonymous' type='text/css' media='{$media}' />";
        }
        if ( $handle === 'OwlCarousel2-theme' ) {
            $tag = "<link rel='stylesheet' id='{$handle}' href='{$src}' integrity='sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==' crossorigin='anonymous' type='text/css' media='{$media}' />";
        }
		return $tag;
	}
	public function script_tags( $tag, $handle, $src ) {
		if ( 'BootStrap' === $handle ) {
        	$tag = '<script type="text/javascript" src="' . esc_url( $src ) . '" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>';
    	}
        if ( 'OwlCarousel2' === $handle ) {
            $tag = '<script type="text/javascript" src="' . esc_url( $src ) . '" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>';
        }
    	return $tag;
	}
	/**
	 * Import các module cần
	 */
    protected function includes() {

        // Class
        include_once API_ABSPATH . '/src/class-Install.php';

        // customize template
        include_once API_ABSPATH . '/src/class-customize.php';
        
        // Function Cores
		include_once API_ABSPATH . '/src/function-cores.php';

        // View
        $this->frontend();
    }
    /**
     * Import View
     */
	public function frontend() {

		include_once API_ABSPATH . '/src/view/menu.php';
		include_once API_ABSPATH . '/src/view/global.php';
	}
    protected function runClass() {
        $this->customize = new \EggsPro\src\UX\Customize();
        $this->customize->init();
    }
}