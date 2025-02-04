<?php

/* ------------------------------------------------ */
/* Search Simple */
/* ------------------------------------------------ */
if (!function_exists('search_hero2_short')) {

    function search_hero2_short() {
        $cat_array = array();
        $cat_array = apply_filters('adforest_ajax_load_categories', $cat_array, 'cat');
        vc_map(array(
            "name" => __("Search - Hero", 'adforest'),
            "base" => "search_hero2_short_base",
            "category" => __("Theme Shortcodes", 'adforest'),
            "show_settings_on_create" => true,
            "params" => array(
                array(
                    'group' => __('Shortcode Output', 'adforest'),
                    'type' => 'custom_markup',
                    'heading' => __('Shortcode Output', 'adforest'),
                    'param_name' => 'order_field_key',
                    'description' => adforest_VCImage('search_hero.png') . __('Ouput of the shortcode will be look like this.', 'adforest'),
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "attach_image",
                    "holder" => "bg_img",
                    "class" => "",
                    "heading" => __("Background Image", 'adforest'),
                    "param_name" => "bg_img",
                    "description" => __("1280x800", 'adforest'),
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Section Tagline", 'adforest'),
                    "description" => __("%count% for total ads.", 'adforest'),
                    "param_name" => "section_title",
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Main Title", 'adforest'),
                    "param_name" => "sub_title",
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textarea",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Section Description", 'adforest'),
                    "param_name" => "section_description",
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Button Text", 'adforest'),
                    "param_name" => "btn_text",
                ),
                 array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Button link", 'adforest'),
                    "param_name" => "btn_link",
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Search Block Text", 'adforest'),
                    "param_name" => "block_text",
                ),
                array(
                    "group" => __("Location type", "adforest"),
                    "type" => "dropdown",
                    "heading" => __("Location type", 'adforest'),
                    "param_name" => "location_type",
                    "admin_label" => true,
                    "value" => array(
                        __('Google', 'adforest') => 'g_locations',
                        __('Custom Location', 'adforest') => 'custom_locations',
                    ),
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                ),
                apply_filters('adforest_admin_category_load_field', array()),
                array
                    (
                    'group' => __('Categories', 'adforest'),
                    'type' => 'param_group',
                    'heading' => __('Select Category ( All or Selective )', 'adforest'),
                    'param_name' => 'cats',
                    'dependency' => array(
                        'element' => 'cat_frontend_switch',
                        'value' => array(''),
                    ),
                    'value' => '',
                    'params' => array(
                        $cat_array
                    ),
                ),
                array
                    (
                    'group' => __('Custom Loctions', 'adforest'),
                    'type' => 'param_group',
                    'heading' => __('Location', 'adforest'),
                    'param_name' => 'locations',
                    'value' => '',
                    'params' => array
                        (
                        array(
                            "type" => "dropdown",
                            "heading" => __("Location", 'adforest'),
                            "param_name" => "location",
                            "admin_label" => true,
                            "value" => adforest_cats('ad_country', 'yes'),
                        ),
                    )
                ),
            ),
        ));
    }

}

add_action('vc_before_init', 'search_hero2_short');
if (!function_exists('search_hero2_short_base_func')) {

    function search_hero2_short_base_func($atts, $content = '') {

        extract(shortcode_atts(array(
            'bg_img' => '',
            'section_title' => '',
            'sub_title' => '',
            'section_description' => '',
            'btn_text' => '',
            'block_text' => '',
            'location_type' => '',
            'cats' => '',
            'locations' => '',
            'btn_link'=>'',
                        ), $atts));
        extract($atts);
        global $adforest_theme;
        $cats = false;
        $cats_html = '';
        $args = array();
        $jax_cat_class = '';

        $style = '';
        $search_html = '';
        
        if (isset($bg_img['url'])) {
            $bgImageURL = $bg_img['url'];

            $style = ( $bgImageURL != "" ) ? ' style="background: rgba(0, 0, 0, 0) url(' . $bgImageURL . ') center top no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"' : "";
        }
        
        else {          
            $bgImageURL = adforest_returnImgSrc($bg_img);
            $style = ( $bgImageURL != "" ) ? ' style="background: rgba(0, 0, 0, 0) url(' . $bgImageURL . ') center top no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"' : "";
        }
        
        
        if (isset($atts['cat_frontend_switch']) && $atts['cat_frontend_switch'] == 'ajax_based') {
            $jax_cat_class = 'sb-load-ajax-cats ';
        } else {

            $cats_data = isset($atts['cats']) && $atts['cats'] != '' ? $atts['cats'] : '';

            if ($cats_data != '') {
                if (isset($adforest_elementor) && $adforest_elementor) {
                    $rows = ($cats_data);
                } else if ((class_exists('WPBakeryVisualComposerAbstract'))) {
                    $rows = vc_param_group_parse_atts($cats_data);
                    $rows = apply_filters('adforest_validate_term_type', $rows);
                }

                if (isset($rows) && is_array($rows) && !empty($rows[0]) && count($rows) > 0) {
                    $cats_html .= '';
                    foreach ($rows as $row) {


                        if (isset($adforest_elementor) && $adforest_elementor) {
                            $cta_idd = $row;
                        } else {
                            $cta_idd = $row['cat'];
                        }

                        if (isset($cta_idd)) {
                            if ($cta_idd == 'all') {
                                $cats = true;
                                $cats_html = '';
                                break;
                            }
                            $term = get_term($cta_idd, 'ad_cats');
                            $cats_html .= '<option value="' . $cta_idd . '">' . $term->name . '</option>';
                        }
                    }
                    if ($cats) {
                        if (isset($adforest_theme['display_taxonomies']) && $adforest_theme['display_taxonomies'] == 'hierarchical') {
                            $args = array(
                                'type' => 'html',
                                'taxonomy' => 'ad_cats',
                                'tag' => 'option',
                                'parent_id' => 0,
                            );
                            $cats_html = apply_filters('adforest_tax_hierarchy', $cats_html, $args);
                        } else {
                            $args = array('hide_empty' => 0);
                            $args = apply_filters('adforest_wpml_show_all_posts', $args); // for all lang texonomies
                            $ad_cats = get_terms('ad_cats', $args);
                            foreach ($ad_cats as $cat) {
                                $cats_html .= '<option value="' . $cat->term_id . '">' . $cat->name . '</option>';
                            }
                        }
                    }
                }
            }
        }
        $locations_html = '';

        $loc_flag = FALSE;
        if (isset($adforest_elementor) && $adforest_elementor) {
            $rows = (isset($atts['locations']) && $atts['locations'] != '' ? $atts['locations'] : '');
            if (isset($rows[0]) && $rows[0] == 'all' && isset($location_type) && $location_type == 'custom_locations') {
                $loc_flag = TRUE;
            }
        } else {
            $rows = vc_param_group_parse_atts(isset($atts['locations']) && $atts['locations'] != '' ? $atts['locations'] : '');
            if (isset($rows[0]['location']) && $rows[0]['location'] == 'all' && isset($location_type) && $location_type == 'custom_locations') {
                $loc_flag = TRUE;
            }
        }




        if ($loc_flag) {
            $locations_html .= ' <option value="">' . esc_html__('Select location', 'adforest') . ' </option> ';
            if (isset($adforest_theme['display_taxonomies']) && $adforest_theme['display_taxonomies'] == 'hierarchical') {
                $args = array(
                    'type' => 'html',
                    'taxonomy' => 'ad_country',
                    'tag' => 'option',
                    'parent_id' => 0,
                );
                $locations_html = apply_filters('adforest_tax_hierarchy', $locations_html, $args);
            } else {
                $ad_country_arr = get_terms('ad_country', $args);
                if (isset($ad_country_arr) && count($ad_country_arr) > 0) {
                    foreach ($ad_country_arr as $loc_value) {
                        $locations_html .= ' <option value="' . intval($loc_value->term_id) . '">' . esc_html($loc_value->name) . ' </option> ';
                    }
                }
            }
        } else {

                $not_cistom_flag = FALSE;            
            if (isset($adforest_elementor) && $adforest_elementor) {
                if (count((array) $rows) > 0 && isset($rows[0]) && $rows[0] != 'all') {
                    $not_cistom_flag = TRUE;
                }
            }else{
                if (count((array) $rows) > 0 && $rows[0]['location'] != 'all') {
                   $not_cistom_flag = TRUE; 
                }
            }            


            if ($not_cistom_flag) {
                $locations_html .= '';
                if (isset($rows) && is_array($rows)) {
                    foreach ($rows as $row) {

                        if (isset($adforest_elementor) && $adforest_elementor) {
                            $loc_ids = $row;
                        } else {
                            $loc_ids = $row['location'];
                        }
                        if ($loc_ids == '') {
                            continue;
                        }



                        if (isset($loc_ids) && $loc_ids != '') {
                            $term = get_term($loc_ids, 'ad_country');
                            $locations_html .= ' <option value="' . $loc_ids . '">' . $term->name . '</option> ';
                        }
                    }
                }
            }
        }

        $search_html = '';
        $location_type_html = '';
        if (isset($location_type) && $location_type == 'custom_locations') {
            $location_type_html = '<select class="category form-control" name="country_id" data-placeholder="' . __('Select Location', 'adforest') . '">
                <option value="">' . esc_html__('Select Location', 'adforest') . '</option>
               	   ' . $locations_html . '
			   </select>';
        } else {
            ob_start();
            adforest_load_search_countries();
            $search_html .= ob_get_contents();
            ob_end_clean();
            wp_enqueue_script('google-map-callback');
            $location_type_html = '<input class="form-control" name="location" id="sb_user_address" placeholder="' . __('Location...', 'adforest') . '"  type="text">';
        }
        $count_posts = wp_count_posts('ad_post');
        $main_title = str_replace('%count%', '<b>' . $count_posts->publish . '</b>', $section_title);
       
       

        $heder_transparent_arr    =   array('transparent-2','transparent-3' ,'transparent');

        $header_type   =  isset($adforest_theme['sb_header'])  ?  $adforest_theme['sb_header'] : "";

      $class_attr   =  "";
     if(in_array( $header_type , $heder_transparent_arr)){
       $class_attr   =   'intro-hero-margin';
     }


        $cats_html = ""; 
        $sub_cats_html = "";
        $level = "";
        $sub_sub_cats_html = "";
        $sub_sub_sub_cats_html = "";
        $sub_sub_sub_sub_cats_html = "";

        $ad_cats = adforest_get_cats('ad_cats', 0);

    
       $ad_cat = isset($_GET['cat_id']) ? $_GET['cat_id'] : '';
        if(isset($ad_cat) && $ad_cat != ""){
            $style = 'display: block;';
        }
        $ad_cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : '';
        $ad_cat_sub = isset($_GET['ad_cat_sub']) ? $_GET['ad_cat_sub'] : '';
        $style1 = "display: none;";
        if(isset($ad_cat_sub) && $ad_cat_sub != ""){
            $style1 = 'display: block;';
        }
        $ad_cat_sub_sub = isset($_GET['ad_cat_sub_sub']) ? $_GET['ad_cat_sub_sub'] : '';
        $style2 = "display: none;";
        if(isset($ad_cat_sub_sub) && $ad_cat_sub_sub != ""){
              $style2 = 'display: block;';
        }
        $ad_cat_sub_sub_sub = isset($_GET['ad_cat_sub_sub_sub']) ? $_GET['ad_cat_sub_sub_sub'] : '';
         $style3 = "display: none;";
         if(isset($ad_cat_sub_sub_sub) && $ad_cat_sub_sub_sub != ""){
               $style3 = 'display: block;';
         }
          $ad_cat_sub_sub_sub_sub = isset($_GET['ad_cat_sub_sub_sub_sub']) ? $_GET['ad_cat_sub_sub_sub_sub'] : '';
         $style4 = "display: none;";
         if(isset($ad_cat_sub_sub_sub_sub) && $ad_cat_sub_sub_sub_sub != ""){
               $style4 = 'display: block;';
         }

             foreach ($ad_cats as $ad_cat) {
                    $selected = '';
                    $selected_cats_list = "";
                    if ($ad_cat->term_id == $ad_cat_id) {
                        $selected = ' selected="selected"';
                        $selected_cats_list .= '<li> ' .esc_html(  $ad_cat->name ). ' </li> ';
                    }
                    $cats_html .= '<option value="' .esc_attr( $ad_cat->term_id) . '" ' . $selected . '  data-name = "' . esc_attr($ad_cat->name ). '">' .esc_html(  $ad_cat->name ). '</option>';

                }
               // if ($level >= 2) {
                
                
                    $sub_cats_html = '';

                    if($ad_cat_id != ""){

                         $ad_sub_cats = adforest_get_cats('ad_cats', $ad_cat_id, 0, 'post_ad');
                    foreach ($ad_sub_cats as $ad_cat) {
                        $selected = '';

                        if ( $ad_cat->term_id == $ad_cat_sub) {
                            $selected = ' selected="selected"';
                            $selected_cats_list .= '<li> ' . esc_html(  $ad_cat->name ) . ' </li> ';
                        }
                        $sub_cats_html .= '<option value="' . esc_attr($ad_cat->term_id) . '" ' . $selected . '  data-name = "' . esc_attr( $ad_cat->name) . '">' .esc_html(  $ad_cat->name ). '</option>';
                    }
                }
              //  }

                 $sub_sub_cats_html = '';
                if ($ad_cat_sub != "") {
                    $ad_sub_sub_cats = adforest_get_cats('ad_cats', $ad_cat_sub, 0, 'post_ad');
                   
                    foreach ($ad_sub_sub_cats as $ad_cat) {
                        $selected = '';
                        if ( $ad_cat->term_id == $ad_cat_sub_sub) {
                            $selected = ' selected="selected"';
                            $selected_cats_list .= '<li> ' . esc_attr($ad_cat->name) . ' </li> ';
                        }
                        $sub_sub_cats_html .= '<option value="' . esc_attr( $ad_cat->term_id ). '" ' . $selected . '  data-name = "' . esc_attr($ad_cat->name) . '">' . esc_html( $ad_cat->name ). '</option>';
                    }
                }

                 $sub_sub_sub_cats_html = '';
                if ($ad_cat_sub_sub != "") {
                    $ad_sub_sub_sub_cats = adforest_get_cats('ad_cats', $ad_cat_sub_sub, 0, 'post_ad');
                    
                    
                    foreach ($ad_sub_sub_sub_cats as $ad_cat) {
                        $selected = '';
                        if ( $ad_cat->term_id == $ad_cat_sub_sub_sub) {
                            $selected = ' selected="selected"';
                            $selected_cats_list .= '<li> ' . esc_html(  $ad_cat->name ) . ' </li> ';
                        }
                        $sub_sub_sub_cats_html .= '<option value="' . esc_attr($ad_cat->term_id) . '" ' . $selected . ' data-name = "' . esc_attr($ad_cat->name) . '" >' . esc_html( $ad_cat->name ). '</option>';
                    }
                }

                    $sub_sub_sub_sub_cats_html = '';
                    if($ad_cat_sub_sub_sub != ""){
                    $ad_sub_sub_sub_sub_cats = adforest_get_cats('ad_cats', $ad_cat_sub_sub_sub, 0, 'post_ad');
                    
                    foreach ($ad_sub_sub_sub_sub_cats as $ad_cat) {
                        $selected = '';
                        if ( $ad_cat->term_id == $ad_cat_sub_sub_sub_sub) {
                            $selected = ' selected="selected"';
                            $selected_cats_list .= '<li> ' . esc_html(  $ad_cat->name ) . ' </li> ';
                        }
                        $sub_sub_sub_sub_cats_html .= '<option value="' . esc_attr($ad_cat->term_id) . '" ' . $selected . ' data-name = "' . esc_attr($ad_cat->name) . '" >' . esc_html( $ad_cat->name ). '</option>';
                    }

                 }


        $sb_search_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_search_page']);
        $sb_post_ad_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_post_ad_page']);

        $btn_link = isset($btn_link) ? $btn_link :  $sb_post_ad_page;

        $search_html .= '<section id="intro-hero" ' . $style . '  class =  '.$class_attr.'>
                <div class="container">
                  <div class="row">
                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    
                     <div class="ads-search-heading">
                      <span class="hero-title">' . $main_title . '</span>
                      <h1> ' . $sub_title . ' </h1>
                      <p class="hero-tagline"> ' . $section_description . ' </p>
                      <div class="intro-btn">
                        <a href="' . esc_url($btn_link) . '" class="btn btn-theme btn-round">' . $btn_text . '</a>
                      </div>
                      </div>
                    </div> <!-- END col-lg-6 hero-text--> 
                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                      <form class="form-join search-hero-form" action="' . urldecode(get_the_permalink($sb_search_page)) . '">
                        <span class="serach-form-heading">' . $block_text . '</span>
                      <div class="form-group  title-search-input">
                         <label for="exampleInputEmail1">' . __('Title', 'adforest') . '</label>
                          <input class="form-control" autocomplete="off" name="ad_title" placeholder="' . __('What Are You Looking For...', 'adforest') . '" type="text"> 
                       </div>


                      <div class="form-group cats-dropdown"> <div class="row">
                                    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                        <div class="form-group">
										<label for="exampleInputEmail1">' . __('Category Select', 'adforest') . '</label>
                                       <select class="category form-control" id="ad_cat" name="cat_id" data-parsley-required="true" data-parsley-error-message="' . __('This field is required.', 'adforest') . '">
                                              <option value="">' . __('Select Option', 'adforest') . '</option>
                                              ' . $cats_html . '
                                       </select>
                                       </div>
                                    </div>
                                   </div>
                                    <div class="row" id="ad_cat_sub_div" style="'. $style1 . '">
                                           <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" >
                                                <div class="form-group">
                                                 <select class="category form-control" id="ad_cat_sub" name="ad_cat_sub">
                                                         ' . $sub_cats_html . '
                                                 </select>
                                                 </div>
                                           </div>
                                         </div>
                                        <div class="row" id="ad_cat_sub_sub_div" style="'. $style2 . '" >
                                           <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                           <div class="form-group">
                                                 <select class="category form-control" id="ad_cat_sub_sub" name="ad_cat_sub_sub">
                                                         ' . $sub_sub_cats_html . '
                                                 </select>
                                                 </div>
                                           </div>
                                         </div>
                                        <div class="row" id="ad_cat_sub_sub_sub_div" style="' . $style3 . '">
                                           <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                           <div class="form-group">
                                                 <select class="category form-control" id="ad_cat_sub_sub_sub" name="ad_cat_sub_sub_sub">' . $sub_sub_sub_cats_html . '</select>
                                           </div>
                                            </div>
                                         </div>

                                         <div class="row" id="ad_cat_sub_sub_sub_sub_div" style="' . $style4 . '">
                                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                 <select class="category form-control" id="ad_cat_sub_sub_sub_sub" name="ad_cat_sub_sub_sub_sub">' . $sub_sub_sub_sub_cats_html . '</select>
                                                 </div>
                                            </div>

                                         </div>
                                 
                                  </div>


                                  
                        <div class="form-group">
                        <label for="exampleInputEmail1">' . __('Location', 'adforest') . '</label>
                           ' . $location_type_html . '
                        </div>
                        ' . apply_filters('adforest_form_lang_field', false) . '
                        <button class="btn btn-theme btn-block" type="submit">' . __('search', 'adforest') . '</button>
                        </form>
                    </div>
                  </div>
                </div>
              </section>';

        return adforest_returnEcho($search_html);
    }

}
if (function_exists('adforest_add_code')) {
    adforest_add_code('search_hero2_short_base', 'search_hero2_short_base_func');
}