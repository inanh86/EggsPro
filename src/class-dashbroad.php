<?php namespace EggsPro\src\admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Menu admin dành cho templates
 */
class DashBroad {

    public function __construct() {
        add_action( 'init', [$this, 'hook_init'] );
        add_action('admin_menu', [$this, 'add_menu'] );
    }
    /**
     * Đăng ký Hook vào chổ này
     * @see
     */
    public function hook_init() {
        $hook = \EggsPro\src\Carousel::PostType_Slide();
        return $hook;
    }
    /**
     * Menu admin
     * @see 
     * @version 1.0
     */
    public static function add_menu() {
        // Main menu
        add_menu_page(
            __lang( 'Quản lý giao diện' ),
            'EggsPro',
            'manage_options',
            'eggspro',
            [self::class, 'main_page'],
            'dashicons-admin-customizer',
            30
        );
        // Sub Menu
        \EggsPro\src\Carousel::menu();
    }
    /**
     * Main menu
     */
    public static function main_page() {
        ?>
            Hello World
        <?php 
    }
}
// Gọi cái lớp này lên khi chạy vào Admin :)) 
return new DashBroad();