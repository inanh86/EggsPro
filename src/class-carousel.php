<?php namespace EggsPro\src;

use \WP_Error as Baoloi;

defined('ABSPATH') || exit;

/**
 * Khởi tạo Slide Banner
 */
class Carousel {

    protected $version = '1.0';
    protected $data = [];
    protected $loi = NAME_SPACE.'error';

    public function __construct($data=NULL) {
        if( empty($data) ) {
            return new Baoloi($this->loi, __lang('Lổi yêu cầu thiết lập slide không thành công'));
        }
        // Run Slide 
        $this->data = $data;
    }
    /**
     * Tạo custom Post_Type 
     * @see link https://developer.wordpress.org/reference/functions/register_post_type/
     */
    public static function PostType_Slide() {
        register_post_type('post_slide_banner',
            [
                'labels'      => [
                        'name'          => __('Slide Banner', 'eggspro'),
                        'singular_name' => __('Slide Banner', 'eggspro'),
                    ],
                'public'      => true,
                'supports'    => [ 'title' ],
                'has_archive' => true,
                'show_ui'      => true,
		        'show_in_menu' => false,
            ]
        );
        // khởi tạo danh sách image thêm vào slide
        add_action('add_meta_boxes', function() {
            add_meta_box(
                'slide_box',                 
                __lang('Danh sách banner', false),      
                [ self::class, 'renderHTML' ],           
                'post_slide_banner'                
            );
        });
    }
    public static function AddMenu() {
        add_theme_page( 'Slide Banner', 'Theme Menu Settings', 'edit_theme_options', 'test-theme-options', 'theme_option_page' );
    }
    public static function renderHTML() {
        ?>
            <label for="wporg_field">Description for this field</label>
        <?php 
    }
    public function set() {

    }
}