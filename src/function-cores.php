<?php 
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
function carousel( $value=null ) {
    
}
/**
 * Gọi view
 * @use get_template_part()
 * @see https://developer.wordpress.org/reference/functions/get_template_part/
 */
function eggspro_get_view($slug=null) {
    if( empty($slug) ) {
        return new WP_Error( CODE_ERR, 'lổi không gọi được view', ['status'=>500] );
    }
    $import = get_template_part('src/view/'.$slug);
    return $import;
}
/**
 * Get Componets 
 * @version 1.0
 */
function eggspro_get_componet($name) {
    $comp = eggspro_get_view('components/'.$name);
    return $comp;
}