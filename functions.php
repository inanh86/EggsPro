<?php 

// Định nghĩa nameSpace
if ( !defined('NAME_SPACE') ) {
    define('NAME_SPACE', 'eggspro_'); 
}

// Define API_PLUGIN_FILE.
if ( ! defined( 'API_PLUGIN_FILE' ) ) {
	define( 'API_PLUGIN_FILE', get_template_directory() );
}
if( !defined('EGGSPRO_DIR_URL') ) {
	define( 'EGGSPRO_DIR_URL', get_template_directory_uri() );
}
// tải các packages đc cài bằng composer
require API_PLUGIN_FILE . './vendor/autoload.php';

// Include the main class.
if ( ! class_exists( 'EggsPro', false ) ) {
	include_once  API_PLUGIN_FILE . '/src/class-eggspro.php';
}
function EggsPro() {
	return EggsPro\src\Run\EggsPro::instance();
}
// Global for backwards compatibility.
$GLOBALS['EggsPro'] = EggsPro();