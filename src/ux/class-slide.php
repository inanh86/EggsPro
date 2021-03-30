<?php namespace EggsPro\src\UX;

use  WP_Customize_Media_Control as Upfile;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Tùy chỉnh UX trang chủ
 * @use Theme Customization API
 * @see https://codex.wordpress.org/Theme_Customization_API
 */
class SlideBanner  {
    
    public static function init($customize) {
        // Thay đổi section logo mặc định
        $customize->add_section( 'eggspro_slide', 
            array(
                'title'       => __lang('Slide Banner'), //Visible title of section
                'priority'    => 35, //Determines what order this appears in
                'capability'  => 'edit_theme_options', //Capability needed to tweak
                'description' => __lang('Tùy chỉnh banner slide'), //Descriptive tooltip
            ) 
        );
          //2. Register new settings to the WP database...
        $customize->add_setting( 'link_textcolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
                'default'    => '#2BA6CB', //Default setting/value to save
                'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
                'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
                'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
            ) 
        );      
            
        //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
        $customize->add_control( new Upfile( //Instantiate the color control class
            $customize, //Pass the $wp_customize object (required)
            'link_textcolor', //Set a unique ID for the control
                array(
                    'label'      => __( 'Link Color', 'mytheme' ), //Admin-visible name of the control
                    'settings'   => 'link_textcolor', //Which setting to load and manipulate (serialized is okay)
                    'priority'   => 10, //Determines the order this control appears in for the specified section
                    'section'    => 'eggspro_slide', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                ) 
        ) );
    }
}