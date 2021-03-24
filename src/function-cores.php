<?php 
use EggsPro\src\Carousel;
use \WP_Error as Baoloi;

defined('ABSPATH') || exit;

/**
 * Thiết lập đa ngôn ngữ WP
 * @param string $string
 * @param bool $show
 * @see link 
 * @version 1.0.0
 */
if (!function_exists('__lang')) {
    function __lang($string=null, $show=false) {
        if(empty($string)) {
            return new Baoloi( CODE_ERR ,__lang('lổi không tìm thấy chuỗi nhập vào') );
        }
        $lang =  __($string, 'eggspro');
        if( $show ) {
            echo $lang;
        } else {
            return $lang;
        }
    }
}

/**
 * Slide Banner 
 * @param array $value
 * @version 1.0.0
 */
function carousel($value=null) {
    
}