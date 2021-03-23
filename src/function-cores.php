<?php defined('ABSPATH') || exit;

function __lang($string=null) {
    if(empty($string)) {
        echo 'lổi không tìm thấy chuỗi nhập vào';
    }
    echo __($string, 'eggspro');
}