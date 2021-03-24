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
        add_action('admin_menu', [$this, 'hook_menu'] );
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
     * add menu admin
     * @see
     */
    public function hook_menu() {
        $hook = \EggsPro\src\Carousel::AddMenu();
        return $hook;
    }
}
// Gọi cái lớp này lên khi chạy vào Admin :)) 
return new DashBroad();