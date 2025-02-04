<?php

/* ------------------------------------------------ */
/* Process Cycle */
/* ------------------------------------------------ */
if (!function_exists('process_cycle2_short')) {

    function process_cycle2_short() {
        vc_map(array(
            "name" => __("Process Cycle 2", 'adforest'),
            "base" => "process_cycle2_short_base",
            "category" => __("Theme Shortcodes", 'adforest'),
            "params" => array(
                array(
                    'group' => __('Shortcode Output', 'adforest'),
                    'type' => 'custom_markup',
                    'heading' => __('Shortcode Output', 'adforest'),
                    'param_name' => 'order_field_key',
                    'description' => adforest_VCImage('process-cycle-2.png') . __('Ouput of the shortcode will be look like this.', 'adforest'),
                ),
                array(
                    "group" => __("Background", "adforest"),
                    "type" => "dropdown",
                    "heading" => __("Section Background", 'adforest'),
                    "param_name" => "section_bg",
                    "admin_label" => true,
                    "value" => array(
                        __('White', 'adforest') => '',
                        __('Gray', 'adforest') => 'bg-gray',
                    ),
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Section tagline", 'adforest'),
                    "param_name" => "section_tagline",
                    "value" => "",
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Section Title", 'adforest'),
                    "param_name" => "section_title",
                    "value" => "",
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textarea",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Section Description", 'adforest'),
                    "param_name" => "section_description",
                    "value" => "",
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                ),
                // Step 1
                array(
                    "group" => __("Step 1", "adforest"),
                    'type' => 'iconpicker',
                    'heading' => __('Icon', 'adforest'),
                    'param_name' => 's1_icon',
                    'settings' => array(
                        'emptyIcon' => false,
                        'type' => 'classified',
                        'iconsPerPage' => 100, // default 100, how many icons per/page to display
                    ),
                ),
                array(
                    "group" => __("Step 1", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Title", 'adforest'),
                    "param_name" => "s1_title",
                ),
                array(
                    "group" => __("Step 1", "adforest"),
                    "type" => "textarea",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Description", 'adforest'),
                    "param_name" => "s1_description",
                ),
                // Step 2
                array(
                    "group" => __("Step 2", "adforest"),
                    'type' => 'iconpicker',
                    'heading' => __('Icon', 'adforest'),
                    'param_name' => 's2_icon',
                    'settings' => array(
                        'emptyIcon' => false,
                        'type' => 'classified',
                        'iconsPerPage' => 100, // default 100, how many icons per/page to display
                    ),
                ),
                array(
                    "group" => __("Step 2", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Title", 'adforest'),
                    "param_name" => "s2_title",
                ),
                array(
                    "group" => __("Step 2", "adforest"),
                    "type" => "textarea",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Description", 'adforest'),
                    "param_name" => "s2_description",
                ),
                // Step 3
                array(
                    "group" => __("Step 3", "adforest"),
                    'type' => 'iconpicker',
                    'heading' => __('Icon', 'adforest'),
                    'param_name' => 's3_icon',
                    'settings' => array(
                        'emptyIcon' => false,
                        'type' => 'classified',
                        'iconsPerPage' => 100, // default 100, how many icons per/page to display
                    ),
                ),
                array(
                    "group" => __("Step 3", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Title", 'adforest'),
                    "param_name" => "s3_title",
                ),
                array(
                    "group" => __("Step 3", "adforest"),
                    "type" => "textarea",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Description", 'adforest'),
                    "param_name" => "s3_description",
                ),
            ),
        ));
    }

}

add_action('vc_before_init', 'process_cycle2_short');
if (!function_exists('process_cycle2_short_base_func')) {

    function process_cycle2_short_base_func($atts, $content = '') {

        extract(shortcode_atts(array(
            'section_bg' => '',
            'section_tagline' => '',
            'section_title' => '',
            'section_description' => '',
            's1_icon' => '',
            's1_title' => '',
            's1_description' => '',
            's2_icon' => '',
            's2_title' => '',
            's2_description' => '',
            's3_icon' => '',
            's3_title' => '',
            's3_description' => '',
                        ), $atts));
             extract($atts);  
            
            $s1_icon = isset($s1_icon) ? $s1_icon   : "";    
            $s2_icon = isset($s2_icon)  ? $s2_icon: "";
            $s3_icon = isset($s3_icon)  ? $s3_icon: "";
            
            
            
        $s1_icon = $s1_icon;
        if (isset($adforest_elementor) && $adforest_elementor) {
            $s1_icon = isset($s1_icon)  ? $s1_icon  :  "";
        }
        
        $s2_icon = $s2_icon;
        if (isset($adforest_elementor) && $adforest_elementor) {
            $s2_icon = isset($s2_icon)  ? $s2_icon  :  "";
        }
        
        $s3_icon = $s3_icon;
        if (isset($adforest_elementor) && $adforest_elementor) {
            $s3_icon = isset($s3_icon)  ? $s3_icon  :  "";
        }

  
        echo  '<section class="section-padding cashew-its-work ' . $section_bg . '">
            <div class="container">
            <div class="sb-short-head center">
                 <span>'. esc_html($section_tagline).'</span>
                 <h2>'.adforest_color_text($section_title).'</h2>
                 <p> '.$section_description.'</p>
           </div>     
               <div class="row">
                  <div class="col-xs-12 col-md-12 col-sm-12 ">                   
                        <div class="how-it-work text-center">
                           <div class="how-it-work-icon"> <i class="' . esc_attr($s1_icon) . '"></i> </div>
                           <h4>' . esc_html($s1_title) . '</h4>
                           <p>' . esc_html($s1_description) . '</p>
                        </div>
                        <div class="how-it-work text-center ">
                           <div class="how-it-work-icon"> <i class="' . esc_attr($s2_icon) . '"></i> </div>
                           <h4>' . esc_html($s2_title) . '</h4>
                           <p>' . esc_html($s2_description) . '</p>
                        </div>
                        <div class="how-it-work text-center">
                           <div class="how-it-work-icon "> <i class="' . esc_attr($s3_icon) . '"></i></div>
                           <h4>' . esc_html($s3_title) . '</h4>
                           <p>' . esc_html($s3_description) . '</p>
                        </div>                   
                  </div>
               </div>
            </div>
         </section>';
    }

}

if (function_exists('adforest_add_code')) {
    adforest_add_code('process_cycle2_short_base', 'process_cycle2_short_base_func');
}