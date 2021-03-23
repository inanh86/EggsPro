<?php namespace EggsPro\src;

if(!defined('ABSPATH')) {
    exit;
}

class Install {
    /**
     * khởi chạy trình cài đặt khi active template
     * @version 1.0
     * @see https://wp86.blogspot.com
     */
    public static function init() {
        self::option();
    }
    public static function option() {
        $version = get_option('eggspro_settings');
        if (empty($version)) {
            $settings['installed_on'] = date("Y/m/d");
			$settings['version'] = '0.1';
			update_option('eggspro_settings', $settings, "no");
        }
    }
}