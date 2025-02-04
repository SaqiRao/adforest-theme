<?php
/* ------------------------------------------------ */
/* Post Ad  */
/* ------------------------------------------------ */
if (!function_exists('ad_post_fancy_short')) {

    function ad_post_fancy_short() {
        vc_map(array(
            "name" => __("Ad Post - Fancy", 'adforest'),
            "base" => "ad_post_fancy_short_base",
            "category" => __("Theme Shortcodes", 'adforest'),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => __("Ad Post Form Type", 'adforest'),
                    "param_name" => "ad_post_form_type",
                    "admin_label" => true,
                    "value" => array(
                        __('Select Post Form', 'adforest') => '',
                        __('Default Form', 'adforest') => 'no',
                        __('Categories Based Form', 'adforest') => 'yes',
                    ),
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                    "std" => 'no',
                    "description" => __("Select the ad post form type default or with dynamic categories based. Extra fields will only works with default form.", 'adforest'),
                ),
                adforest_generate_type(__('Terms & Condition Field', 'adforest'), 'dropdown', 'terms_switch', '', '', array(
                    __('Hide', 'adforest') => 'hide',
                    __('Show', 'adforest') => 'show',
                )),
                adforest_generate_type(__('Terms & Condition Title', 'adforest'), 'textfield', 'terms_title', '', '', '', '', 'vc_col-sm-12 vc_column', array(
                    'element' => 'terms_switch',
                    'value' => 'show',
                )),
                adforest_generate_type(__('Terms & Conditions', 'adforest'), 'vc_link', 'terms_link', '', '', '', '', 'vc_col-sm-12 vc_column', array(
                    'element' => 'terms_switch',
                    'value' => 'show',
                )),
                adforest_generate_type(__('Extra Fields Section Title', 'adforest'), 'textfield', 'extra_section_title', '', '', '', '', 'vc_col-sm-12 vc_column'),
                array
                    (
                    'group' => __('Extra Fields', 'adforest'),
                    'type' => 'param_group',
                    'heading' => __('Add field', 'adforest'),
                    'param_name' => 'fields',
                    'value' => '',
                    'dependency' => array(
                        'element' => 'ad_post_form_type',
                        'value' => 'no',
                    ),
                    'params' => array
                        (
                        adforest_generate_type(__('Title', 'adforest'), 'textfield', 'title'),
                        adforest_generate_type(__('Slug', 'adforest'), 'textfield', 'slug', __('This should be unique and if you change it the pervious data of this field will be lost', 'adforest')),
                        adforest_generate_type(__('Type', 'adforest'), 'dropdown', 'type', '', "", array("Please select" => "", "Textfield" => "text", "Select/List" => "select")),
                        adforest_generate_type(__('Values for Select/List', 'adforest'), 'textarea', 'option_values', __('Like: value1,value2,value3', 'adforest'), '', '', '', 'vc_col-sm-12 vc_column', array('element' => 'type', 'value' => 'select')),
                    )
                ),
            ),
        ));
    }

}

add_action('vc_before_init', 'ad_post_fancy_short');
if (!function_exists('ad_post_fancy_short_base_func')) {

    function ad_post_fancy_short_base_func($atts, $content = '') {
        extract(shortcode_atts(array(
            'extra_section_title' => '',
            'tips_description' => '',
            'fields' => '',
            'ad_post_form_type' => 'no',
            'terms_link' => '',
            'terms_title' => '',
            'terms_switch' => 'hide',
                        ), $atts));

        extract($atts);

       
        global $adforest_theme;
        do_action('adforest_validate_phone_verification');
        $size_arr = explode('-', $adforest_theme['sb_upload_size']);
        $display_size = $size_arr[1];
        $actual_size = $size_arr[0];

        adforest_user_not_logged_in();

        $description = '';
        $title = '';
        $price = '';
        $poster_name = '';
        $poster_ph = '';
        $ad_location = '';
        $ad_condition = '';
        $is_update = '';
        $level = '';

        $cats_html = '';
        $sub_cats_html = '';
        $sub_sub_cats_html = '';
        $sub_sub_sub_cats_html = '';

        $type_selected = '';

        $ad_type = '';
        $ad_warranty = '';
        $tags = '';
        $id = '';

        $ad_yvideo = '';

        $ad_map_lat = '';
        $ad_map_long = '';
        $ad_bidding = '';

        $ad_price_type = '';
        $is_feature_ad = 0;

        $ad_currency = '';
        $levelz = '';
        $country_html = '';
        $country_states = '';
        $country_cities = '';
        $country_towns = '';
         $user_address_html  = "";  

        $ad_bidding_date = '';

         
         $current_user = get_current_user_id();
         $user_packages_images = get_user_meta($current_user, '_sb_num_of_images', true);
            if (isset($user_packages_images) && $user_packages_images == '-1') {
                $user_upload_max_images = 'null';
            } else if (isset($user_packages_images) && $user_packages_images > 0) {
                $user_upload_max_images = $user_packages_images;
            }





        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $my_url = adforest_get_current_url();
            if (strpos($my_url, 'adforest.scriptsbundle.com') !== false && !is_super_admin(get_current_user_id())) {
                echo adforest_redirect(home_url('/'));
                exit;
            }
            if (get_post_field('post_author', $id) != get_current_user_id() && !is_super_admin(get_current_user_id())) {
                echo adforest_redirect(home_url('/'));
                exit;
            } else {
                $post = get_post($id);
                $description = $post->post_content;
                $title = esc_html($post->post_title);
                $price = get_post_meta($id, '_adforest_ad_price', true);
                $poster_name = get_post_meta($id, '_adforest_poster_name', true);
                $poster_ph = get_post_meta($id, '_adforest_poster_contact', true);
                $ad_location = get_post_meta($id, '_adforest_ad_location', true);
                $ad_condition = get_post_meta($id, '_adforest_ad_condition', true);
                $ad_type = get_post_meta($id, '_adforest_ad_type', true);
                $ad_warranty = get_post_meta($id, '_adforest_ad_warranty', true);
                $ad_yvideo = get_post_meta($id, '_adforest_ad_yvideo', true);
                $ad_map_lat = get_post_meta($id, '_adforest_ad_map_lat', true);
                $ad_map_long = get_post_meta($id, '_adforest_ad_map_long', true);
                $ad_bidding = get_post_meta($id, '_adforest_ad_bidding', true);
                $ad_price_type = get_post_meta($id, '_adforest_ad_price_type', true);
                $is_feature_ad = get_post_meta($id, '_adforest_is_feature', true);
                $ad_currency = get_post_meta($id, '_adforest_ad_currency', true);
                $ad_bidding_date = get_post_meta($id, '_adforest_ad_bidding_date', true);
                $tags_array = wp_get_object_terms($id, 'ad_tags', array('fields' => 'names'));
                $tags = implode(',', $tags_array);

                $is_update = $id;
                $cats = adforest_get_ad_cats($id);

    
                $level = count($cats);
                /* Make cats selected on update ad */
                $ad_cats = adforest_get_cats('ad_cats', 0, 0, 'post_ad');
                $cats_html = '';
                foreach ($ad_cats as $ad_cat) {
                    $selected = '';
                    if ($level > 0 && $ad_cat->term_id == $cats[0]['id']) {
                        $selected = ' selected="selected"';
                    }
                    $cats_html .= '<option value="' . $ad_cat->term_id . '" ' . $selected . '>' . $ad_cat->name . '</option>';
                }

                if ($level >= 2) {
                    $ad_sub_cats = adforest_get_cats('ad_cats', $cats[0]['id'], 0, 'post_ad');
                    $sub_cats_html = '';
                    foreach ($ad_sub_cats as $ad_cat) {
                        $selected = '';
                        if ($level > 0 && $ad_cat->term_id == $cats[1]['id']) {
                            $selected = ' selected="selected"';
                        }
                        $sub_cats_html .= '<option value="' . $ad_cat->term_id . '" ' . $selected . '>' . $ad_cat->name . '</option>';
                    }
                }

                if ($level >= 3) {
                    $ad_sub_sub_cats = adforest_get_cats('ad_cats', $cats[1]['id'], 0, 'post_ad');
                    $sub_sub_cats_html = '';
                    foreach ($ad_sub_sub_cats as $ad_cat) {
                        $selected = '';
                        if ($level > 0 && $ad_cat->term_id == $cats[2]['id']) {
                            $selected = ' selected="selected"';
                        }
                        $sub_sub_cats_html .= '<option value="' . $ad_cat->term_id . '" ' . $selected . '>' . $ad_cat->name . '</option>';
                    }
                }

                if ($level >= 4) {
                    $ad_sub_sub_sub_cats = adforest_get_cats('ad_cats', $cats[2]['id'], 0, 'post_ad');
                    $sub_sub_sub_cats_html = '';
                    foreach ($ad_sub_sub_sub_cats as $ad_cat) {
                        $selected = '';
                        if ($level > 0 && $ad_cat->term_id == $cats[3]['id']) {
                            $selected = ' selected="selected"';
                        }
                        $sub_sub_sub_cats_html .= '<option value="' . $ad_cat->term_id . '" ' . $selected . '>' . $ad_cat->name . '</option>';
                    }
                }
                //Countries
                $countries = adforest_get_ad_cats($id, '', true);
                $levelz = count($countries);
                /* Make cats selected on update ad */
                $ad_countries = adforest_get_cats('ad_country', 0, 0, 'post_ad');

                $country_html = '';
                foreach ($ad_countries as $ad_country) {
                    $selected = '';
                    if ($levelz > 0 && $ad_country->term_id == $countries[0]['id']) {
                        $selected = 'selected="selected"';
                    }
                    $country_html .= '<option value="' . $ad_country->term_id . '" ' . $selected . '>' . $ad_country->name . '</option>';
                }

                if ($levelz >= 2) {
                    $ad_states = adforest_get_cats('ad_country', $countries[0]['id'], 0, 'post_ad');
                    $country_states = '';
                    foreach ($ad_states as $ad_state) {
                        $selected = '';
                        if ($levelz > 0 && $ad_state->term_id == $countries[1]['id']) {
                            $selected = 'selected="selected"';
                        }
                        $country_states .= '<option value="' . $ad_state->term_id . '" ' . $selected . '>' . $ad_state->name . '</option>';
                    }
                }

                if ($levelz >= 3) {
                    $ad_country_cities = adforest_get_cats('ad_country', $countries[1]['id'], 0, 'post_ad');
                    $country_cities = '';
                    foreach ($ad_country_cities as $ad_city) {
                        $selected = '';
                        if ($levelz > 0 && $ad_city->term_id == $countries[2]['id']) {
                            $selected = 'selected="selected"';
                        }
                        $country_cities .= '<option value="' . $ad_city->term_id . '" ' . $selected . '>' . $ad_city->name . '</option>';
                    }
                }

                if ($levelz >= 4) {
                    $ad_country_town = adforest_get_cats('ad_country', $countries[2]['id'], 0, 'post_ad');
                    $country_towns = '';
                    foreach ($ad_country_town as $ad_town) {
                        $selected = '';
                        if ($levelz > 0 && $ad_town->term_id == $countries[3]['id']) {
                            $selected = 'selected="selected"';
                        }
                        $country_towns .= '<option value="' . $ad_town->term_id . '" ' . $selected . '>' . $ad_town->name . '</option>';
                    }
                }
            }
        } else {
            if (!$adforest_theme['admin_allow_unlimited_ads']) {
                adforest_check_validity();
            }
            if (!is_super_admin(get_current_user_id())) {
                adforest_check_validity();
            }

                  $user_info =  get_userdata(get_current_user_id());
                  
                
              $poster_name = $user_info->display_name;
            $poster_ph = get_user_meta($user_info->ID, '_sb_contact', true);
            //$ad_location	=	get_user_meta($profile->user_info->ID, '_sb_address', true );

            $ad_cats = adforest_get_cats('ad_cats', 0, 0, 'post_ad');
            $cats_html = '';
            foreach ($ad_cats as $ad_cat) {
                $cats_html .= '<option value="' . $ad_cat->term_id . '">' . $ad_cat->name . '</option>';
            }
            //Countries
            $ad_country = adforest_get_cats('ad_country', 0, 0, 'post_ad');
            $country_html = '';
            foreach ($ad_country as $ad_count) {
                $country_html .= '<option value="' . $ad_count->term_id . '">' . $ad_count->name . '</option>';
            }
        }

        $ad_type_html = '';
        if (!apply_filters('adforest_directory_enabled', false)) {
            $ad_type_html .= '<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
			    <div class="adf-information-box">
                                <div class="form-group">
                                    <label class="control-label">' . __('Type of Ad', 'adforest') . '</label>';
            $ad_type_html .= '<select class="category form-control" id="type" name="buy_sell">
					<option value="">' . __('Select Option', 'adforest') . '</option>';
            $types = adforest_get_cats('ad_type', 0);
            foreach ($types as $type) {
                $selected = '';
                if ($ad_type == $type->name) {
                    $selected = ' selected="selected"';
                }
                $ad_type_html .= '<option value="' . $type->term_id . '|' . $type->name . '"' . $selected . '>' . $type->name . '</option>';
            }
            $ad_type_html .= '</select>';
            $ad_type_html .= '</div></div></div>';
        }


        $ad_condition_html = '';
        if ($adforest_theme['allow_tax_condition']) {
            $ad_condition_html = '
			  
			  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                          <div class="adf-information-box">
			  <div class="form-group">
			  <label class="control-label">' . __('Item Condition', 'adforest') . '</label><select class="category form-control" id="condition" name="condition">
						<option value="">' . __('Select Option', 'adforest') . '</option>';
            $conditions = adforest_get_cats('ad_condition', 0);
            foreach ($conditions as $con) {
                $selected = '';
                if ($ad_condition == $con->name) {
                    $selected = ' selected="selected"';
                }

                $ad_condition_html .= '<option value="' . $con->term_id . '|' . $con->name . '"' . $selected . '>' . $con->name . '</option>';
            }
            $ad_condition_html .= '</select></div></div></div>';
        }
        $ad_warranty_html = '';
        if ($adforest_theme['allow_tax_warranty']) {
            $ad_warranty_html = '
			  <!-- Category  -->
			  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                          <div class="adf-information-box">
			  <div class="form-group">
			  <label class="control-label">' . __('Warranty', 'adforest') . '</label><select class="category form-control" id="warranty" name="ad_warranty">
						<option value="">' . __('Select Option', 'adforest') . '</option>';
            $ad_warraty = adforest_get_cats('ad_warranty', 0);
            foreach ($ad_warraty as $warranty) {
                $selected = '';
                if ($ad_warranty == $warranty->name) {
                    $selected = ' selected="selected"';
                }
                $ad_warranty_html .= '<option value="' . $warranty->term_id . '|' . $warranty->name . '"' . $selected . '>' . $warranty->name . '</option>';
            }
            $ad_warranty_html .= '</select></div></div></div>';
        }

        $extra_fields_html = '';
        // Making fields
        if (isset($atts['fields'])) {

            if (isset($adforest_elementor) && $adforest_elementor) {
                $rows = ($atts['fields']);
            } else {
                $rows = vc_param_group_parse_atts($atts['fields']);
            }
            if ( isset($rows) ) {
                $total_fileds = 1;
                $extra_fields_html .= '<div class="adf-st-information-box">
                                        <div class="row">
                                        <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                            <div class="adf-information-box">
                                                <div class="adf-information-text"><h4>' . $extra_section_title . '</h4></div>
                                            </div>
                                           </div> 
                                        </div>';

                foreach ($rows as $row) {
                    if (isset($row['title']) && isset($row['type']) && isset($row['slug'])) {
                        $extra_fields_html .= '<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                            <div class="adf-information-box">
                                            <div class="form-group">
				 <label class="control-label">' . $row['title'] . ' <span class="required">*</span></label>';

                        if ($row['type'] == 'text') {
                            $extra_fields_html .= '<input class="form-control" value="' . get_post_meta($id, '_sb_extra_' . $row['slug'], true) . '" type="text" name="sb_extra_' . $total_fileds . '" id="sb_extra_' . $total_fileds . '" data-parsley-required="true" data-parsley-error-message="' . __('This field is required.', 'adforest') . '">';
                        }
                        if ($row['type'] == 'select' && isset($row['option_values'])) {
                            $extra_fields_html .= '<select class="category form-control" id="sb_extra_' . $total_fileds . '" name="sb_extra_' . $total_fileds . '">';
                            $extra_fields_html .= '<option value="">' . __('None', 'adforest') . '</option>';
                            $options = explode(',', $row['option_values']);
                            foreach ($options as $key => $value) {
                                $is_select = '';
                                if ($value == get_post_meta($id, '_sb_extra_' . $row['slug'], true)) {
                                    $is_select = 'selected';
                                }
                                $extra_fields_html .= '<option value="' . $value . '" ' . $is_select . '>' . $value . '</option>';
                            }
                            $extra_fields_html .= '</select>';
                        }
                        $extra_fields_html .= '<input type="hidden" name="title_' . $total_fileds . '" value="' . $row['slug'] . '">';

                        $extra_fields_html .= '</div></div></div>';
                        $total_fileds++;
                    }
                }
                $total_fileds = $total_fileds - 1;
                $extra_fields_html .= '<input type="hidden" name="sb_total_extra" value="' . $total_fileds . '">';
                $extra_fields_html .= '</div>';
            }
        }

        /* Only need on this page so inluded here don't want to increase page size for optimizaion by adding extra scripts in all the web */
      
        wp_enqueue_style('jquery-tagsinput', trailingslashit(get_template_directory_uri()) . 'assests/css/jquery.tagsinput.min.css');
        wp_enqueue_style('jquery-te', trailingslashit(get_template_directory_uri()) . 'assests/css/jquery-te.css');
        wp_enqueue_style('dropzone', trailingslashit(get_template_directory_uri()) . 'assests/css/dropzone.css');
        wp_enqueue_style('adforest-dt', trailingslashit(get_template_directory_uri()) . 'assests/css/datepicker.min.css');

    
        adforest_load_search_countries(1);
        wp_enqueue_script('google-map-callback');
        wp_enqueue_script('adforest-dt');

        $update_notice = '';
        if (isset($id) && $id != "") {
            $update_notice = '<div class="row">
  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
<div role="alert" class="alert alert-info alert-dismissible ">
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
' . $adforest_theme['sb_ad_update_notice'] . '
</div>
</div>
</div>';
        }

        $isCustom = $ad_post_form_type;

        $imageStaticHTML = $priceStaticHTML =  $videoStaticHTML = $priceTypeHTML = $ad_curreny_html = $someStaticHTML = $customDynamicFields = $customDynamicAdType = '';
        if ($isCustom == 'no') {

            $price_fixed = '';
            $price_negotiable = '';
            $price_on_call = '';
            $free = '';
            $no_price = '';
            $price_auction = '';
            if ($ad_price_type == 'Fixed') {
                $price_fixed = 'selected=selected';
            } else if ($ad_price_type == 'Negotiable') {
                $price_negotiable = 'selected=selected';
            } else if ($ad_price_type == 'on_call') {
                $price_on_call = 'selected=selected';
            } else if ($ad_price_type == 'free') {
                $free = 'selected=selected';
            } else if ($ad_price_type == 'no_price') {
                $no_price = 'selected=selected';
            } else if ($ad_price_type == 'auction') {
                $price_auction = 'selected=selected';
            }

            $sb_price_types_strings = array('Fixed' => __('Fixed', 'adforest'), 'Negotiable' => __('Negotiable', 'adforest'), 'on_call' => __('Price on call', 'adforest'), 'auction' => __('Auction', 'adforest'), 'free' => __('Free', 'adforest'), 'no_price' => __('No price', 'adforest'));


            if (isset($adforest_theme['sb_price_types']) && count($adforest_theme['sb_price_types']) > 0) {
                $sb_price_types = $adforest_theme['sb_price_types'];
            } else if (isset($adforest_theme['sb_price_types']) && count($adforest_theme['sb_price_types']) == 0 && isset($adforest_theme['sb_price_types_more']) && $adforest_theme['sb_price_types_more'] == "") {
                $sb_price_types = array('Fixed', 'Negotiable', 'on_call', 'auction', 'free', 'no_price');
            } else {
                $sb_price_types = array();
            }
            $sb_price_types_html = '';
            if (count($sb_price_types) > 0) {
                foreach ($sb_price_types as $p_type) {
                    $p_selected = '';
                    if ($p_type == $ad_price_type)
                        $p_selected = 'selected="selected"';

                    $sb_price_types_html .= '<option value="' . $p_type . '" ' . $p_selected . '>' . $sb_price_types_strings[$p_type] . '</option>';
                }
            }
            if (isset($adforest_theme['sb_price_types_more']) && $adforest_theme['sb_price_types_more'] != "") {
                $sb_price_types_more_array = explode('|', $adforest_theme['sb_price_types_more']);
                foreach ($sb_price_types_more_array as $p_type_more) {
                    $p_selected = '';
                    if ($p_type_more == $ad_price_type)
                        $p_selected = 'selected="selected"';

                    $sb_price_types_html .= '<option value="' . $p_type_more . '" ' . $p_selected . '>' . $p_type_more . '</option>';
                }
            }

            $priceTypeHTML = '<div class="col-lg-6 col-sm-12 col-md-12 col-xs-12">
                                         <div class="adf-information-box">
                                            <div class="form-group">
			 <label class="control-label">' . __('Price', 'adforest') . ' <span class="required">*</span></label>
			 <input class="form-control" type="text" name="ad_price" id="ad_price" data-parsley-required="true" data-parsley-pattern="/^[0-9]+\.?[0-9]*$/" data-parsley-error-message="' . __('only numbers allowed.', 'adforest') . '" value="' . $price . '">
		  </div>
                                         </div>
				      </div>';

            $priceTypeHTML = apply_filters('adforest_directory_simple_ad_post_price', $priceTypeHTML);

            if (isset($adforest_theme['allow_price_type'])) {
                if ($adforest_theme['allow_price_type']) {
                    $priceStaticHTML = '<div class="col-lg-6 col-sm-12 col-md-12 col-xs-12">
                                         <div class="adf-information-box">
                                            <div class="form-group">
                                            <label class="control-label">' . __('Price Type', 'adforest') . '</label>
                                            <select class="form-control" name="ad_price_type" id="ad_price_type">
                                                           <option value="">' . __('None', 'adforest') . '</option>
                                                           ' . $sb_price_types_html . '
                                           </select>
                                           </div>
                                         </div>
				      </div>';
                }
            }
            $priceStaticHTML .= $priceTypeHTML;

            $_sb_video_links = get_user_meta(get_current_user_id(), '_sb_video_links', true);
            $_sb_allow_tags = get_user_meta(get_current_user_id(), '_sb_allow_tags', true);

            $video_html = '';
            if (isset($_sb_video_links) && $_sb_video_links == "" || $_sb_video_links == 'no') {
                $video_html = '';
            } else {

                $valid_text = __('Should be valid youtube video url.', 'adforest');


                $video_html = '<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                <div class="adf-information-box">                              
                                     <label class="control-label">' . __('Youtube Video Link', 'adforest') . '</label>
                                     <input data-parsley-required="false" id="ad_yvideo" data-parsley-error-message="' . $valid_text . '" data-parsley-pattern="/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/" class="form-control" type="text" name="ad_yvideo" value="' . $ad_yvideo . '">
                                
                                </div>	 
                             </div>';
            }


            $tags_html = '';
            if (isset($_sb_allow_tags) && !empty($_sb_allow_tags) && $_sb_allow_tags == 'no') {
                $tags_html = '';
            } else {
                $tags_html = '<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                    <div class="adf-information-box">
                                        <div class="form-group">
					    <label class="control-label">' . __('Tags', 'adforest') . ' <small>' . __('Comma(,) separated', 'adforest') . '</small></label>
					    <input class="form-control" name="tags" id="tags" value="' . $tags . '" >
                                       </div>
                                    </div>   
				</div>';
            }


            $sb_default_img_required = isset($adforest_theme['sb_default_img_required']) && $adforest_theme['sb_default_img_required'] ? true : false; // get image req or not in default template ad post
            $req_images_html = '';
            if ($sb_default_img_required && $isCustom == 'no') {
                $req_images_html = '<span class="required">*</span>';
            }
            
              $req_video_html   =  "";
              $max_upload_vid_limit_opt = isset($adforest_theme['sb_upload_video_limit'])  ?    $adforest_theme['sb_upload_video_limit'] : "";
              $max_upload_vid_size =        isset($adforest_theme['sb_upload_video_mb_limit'])  ?  $adforest_theme['sb_upload_video_mb_limit'] : 2;


            $imageStaticHTML = '<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                  <div class="adf-information-box">
                                    <div class="form-group">
			             <label class="control-label">' . __('Click the box below to ad photos', 'adforest') . ' ' . $req_images_html . ' <small>' . __('upload only jpg, png and jpeg files with a max file size of', 'adforest') . " " . $display_size . '</small></label>
			             <div id="dropzone" class="dropzone"></div>
		                    </div>
                                  </div>
                                </div>';
              if(isset($adforest_theme['sb_allow_upload_video']) &&  $adforest_theme['sb_allow_upload_video']){
            
               $videoStaticHTML = '<div class="form-group"><div class="row">
		  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
			 <label class="control-label">' . __('Click the box below to ad Videos', 'adforest') . ' ' . $req_video_html . ' <small>' . __('upload only videos (mp4, ogg, webm) files with a max file size of', 'adforest') . " " . $max_upload_vid_size . '</small></label>
			 <div id="dropzone_video" class="dropzone"></div>
		  </div>
		</div></div>';
               
              }

            $imageStaticHTML = apply_filters('adforest_directory_brand_fields', $imageStaticHTML);

            $someStaticHTML = '<!-- Adforest Tags  -->
                                ' . $tags_html . '
			
		   <!-- Ad Type  -->
		   	  
                                    ' . $ad_type_html . '
                                
		   <!-- Ad Condition  -->
				' . $ad_condition_html . '
		   <!-- Ad Warranty  -->
				' . $ad_warranty_html . '
				<!-- Youtube Video  -->
                                ' . $video_html . '';

            $currenies = adforest_get_cats('ad_currency', 0);
            if (count($currenies) > 0) {
                $ad_curreny_html = '
			<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                        <div class="adf-information-box">
			     <div class="form-group">
			<label class="control-label">' . __('Select Currency', 'adforest') . '</label><select class="category form-control" id="ad_currency" name="ad_currency" data-parsley-required="true" data-parsley-error-message="' . __('This field is required.', 'adforest') . '">
					<option value="">' . __('Select Option', 'adforest') . '</option>';

                foreach ($currenies as $currency) {
                    $selected = '';
                    if ($ad_currency == $currency->name) {
                        $selected = ' selected="selected"';
                    }

                    if ($ad_currency == "" && isset($adforest_theme['sb_multi_currency_default']) && $adforest_theme['sb_multi_currency_default'] != "") {
                        if ($adforest_theme['sb_multi_currency_default'] == $currency->term_id) {
                            $selected = ' selected="selected"';
                        }
                    }

                    $ad_curreny_html .= '<option value="' . $currency->term_id . '|' . $currency->name . '"' . $selected . '>' . $currency->name . '</option>';
                }
                $ad_curreny_html .= '</select></div></div></div>';
            }
        } else {

            $customDynamicAdType = '';
            $customDynamicFields = '<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12"><div id="dynamic-fields"> ' . adforest_returnHTML($id) . ' </div></div>';
        }
        $mapType = adforest_mapType();
        $lat_long_html = '';
        $lat_lon_script = '';
        $for_g_map = '';
        $is_allow_map = 1;

        if (isset($adforest_theme['allow_lat_lon']) && !$adforest_theme['allow_lat_lon']) {
            $is_allow_map = 2;
        } else {
            $pin_lat = $ad_map_lat;
            $pin_long = $ad_map_long;
            if ($ad_map_lat == "" && $ad_map_long == "" && isset($adforest_theme['sb_default_lat']) && $adforest_theme['sb_default_lat'] && isset($adforest_theme['sb_default_long']) && $adforest_theme['sb_default_long']) {
                $pin_lat = $adforest_theme['sb_default_lat'];
                $pin_long = $adforest_theme['sb_default_long'];
            }

            $libutton = '';
            if ($mapType != 'leafletjs_map') {
                $libutton = '<li><a href="javascript:void(0);" id="your_current_location" title="' . __('You Current Location', 'adforest') . '"><i class="fa fa-crosshairs"></i></a></li>';
            }

            $for_g_map = '<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                            <div id="dvMap" style="width: 100%; height: 350px"></div>
                            <ul id="google-map-btn" class="ad-post-map">' . $libutton . '</ul>
                            <em><small>' . __('Drag pin for your pin-point location.', 'adforest') . '</small></em>
			  </div>';


            if ($mapType == 'leafletjs_map') {


                $lat_lon_script = '<script type="text/javascript">

	
var mymap = L.map(\'dvMap\').setView([' . $pin_lat . ', ' . $pin_long . '], 13);
	L.tileLayer(\'https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}{r}.png\', {
		maxZoom: 18,
		attribution: \'\'
	}).addTo(mymap);
	var markerz = L.marker([' . $pin_lat . ', ' . $pin_long . '],{draggable: true}).addTo(mymap);
	var searchControl 	=	new L.Control.Search({
		url: \'//nominatim.openstreetmap.org/search?format=json&q={s}\',
		jsonpParam: \'json_callback\',
		propertyName: \'display_name\',
		propertyLoc: [\'lat\',\'lon\'],
		marker: markerz,
		autoCollapse: true,
		autoType: true,
		minLength: 2,
	});
	searchControl.on(\'search:locationfound\', function(obj) {
		
		var lt	=	obj.latlng + \'\';
		var res = lt.split( "LatLng(" );
		res = res[1].split( ")" );
		res = res[0].split( "," );
		document.getElementById(\'ad_map_lat\').value = res[0];
		document.getElementById(\'ad_map_long\').value = res[1];
	});
	mymap.addControl( searchControl );
	
	markerz.on(\'dragend\', function (e) {
	  document.getElementById(\'ad_map_lat\').value = markerz.getLatLng().lat;
	  document.getElementById(\'ad_map_long\').value = markerz.getLatLng().lng;
	});
</script>';
            } else if ($mapType == 'google_map') {
                $lat_lon_script = '<script type="text/javascript">
			var my_map;
			var marker;
			var markers = [
				{
					"title": "",
					"lat": "' . $pin_lat . '",
					"lng": "' . $pin_long . '",
				},
			];
			window.onload = function () {
					my_g_map(markers);
				}
				function my_g_map(markers1)
				{
					var mapOptions = {
					center: new google.maps.LatLng(markers1[0].lat, markers1[0].lng),
					zoom: 12,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				var infoWindow = new google.maps.InfoWindow();
				var latlngbounds = new google.maps.LatLngBounds();
				var geocoder = geocoder = new google.maps.Geocoder();
				my_map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
                                
					var data = markers1[0]
					var myLatlng = new google.maps.LatLng(data.lat, data.lng);
					marker = new google.maps.Marker({
						position: myLatlng,
						map: my_map,
						title: data.title,
						draggable: true,
						animation: google.maps.Animation.DROP
					});
					(function (marker, data) {
						google.maps.event.addListener(marker, "click", function (e) {
							infoWindow.setContent(data.description);
							infoWindow.open(map, marker);
						});
						google.maps.event.addListener(marker, "dragend", function (e) {
							document.getElementById("sb_loading").style.display	= "block";
							var lat, lng, address;
							geocoder.geocode({ "latLng": marker.getPosition() }, function (results, status) {
								
								if (status == google.maps.GeocoderStatus.OK) {
									lat = marker.getPosition().lat();
									lng = marker.getPosition().lng();
									address = results[0].formatted_address;
									document.getElementById("ad_map_lat").value = lat;
									document.getElementById("ad_map_long").value = lng;
									document.getElementById("sb_user_address").value = address;
									document.getElementById("sb_loading").style.display	= "none";
									//alert("Latitude: " + lat + "\nLongitude: " + lng + "\nAddress: " + address);
								}
							});
						});
					})(marker, data);
					latlngbounds.extend(marker.position);
				}
				jQuery(document).ready(function($) {
			$("#your_current_location").click(function() {
				$.ajax({
				url: "https://geolocation-db.com/jsonp",
				jsonpCallback: "callback",
				dataType: "jsonp",
				success: function( location ) {
					var pos = new google.maps.LatLng(location.latitude, location.longitude);
					my_map.setCenter(pos);
					my_map.setZoom(12);
					
					$("#sb_user_address").val(location.city + ", " + location.state + ", " + location.country_name );
					document.getElementById("ad_map_long").value = location.longitude;
					document.getElementById("ad_map_long").value = location.longitude;
					
				var markers2 = [
				{
					title: "",
					lat: location.latitude,
					lng: location.longitude,
				},
			];
			my_g_map(markers2);
				}
			});		
			});
			
				});
		</script>';
            }
            $lat_long_html = $for_g_map . '
			  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="adf-information-box">
                              <div class="form-group">
				 <label class="control-label">' . __('Latitude', 'adforest') . '</label>
				 <input class="form-control" type="text" name="ad_map_lat" id="ad_map_lat" value="' . $pin_lat . '">
			  </div>
                          </div>
                          </div>
                          
			  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                <div class="adf-information-box">
                              <div class="form-group">
				 <label class="control-label">' . __('Longitude', 'adforest') . '</label>
				 <input class="form-control" name="ad_map_long" id="ad_map_long" value="' . $pin_long . '" type="text">
			  </div>
                          </div>
                          </div>';
        }

        // Check phone is required or not
        $ph_reg = '';
        if (isset($adforest_theme['sb_phone_verification']) && $adforest_theme['sb_phone_verification'] && isset($adforest_theme['sb_change_ph']) && $adforest_theme['sb_change_ph'] == false) {
            $phone_html = '<input class="form-control"  id="adforest_contact_number" name="sb_contact_number" readonly value="' . get_user_meta(get_current_user_id(), '_sb_contact', true) . '" type="text">';
        } else {
            $phone_html = '<input class="form-control"  id="adforest_contact_number" name="sb_contact_number" data-parsley-required="true" data-parsley-error-message="' . __('This field is required.', 'adforest') . '" value="' . $poster_ph . '" type="text">';
            $ph_reg = '<span class="required">*</span>';
            if (isset($adforest_theme['sb_user_phone_required']) && !$adforest_theme['sb_user_phone_required']) {
                $phone_html = '<input class="form-control"  id="adforest_contact_number" name="sb_contact_number" value="' . $poster_ph . '" type="text">';
                $ph_reg = '';
            }
        }

        $categorize_bid = true;
        $categorize_bid = apply_filters('adforest_make_bid_categ', $categorize_bid);

        $bid_style_cat = '';
        if (!$categorize_bid) {
            $bid_style_cat = ' style="display:none" ';
        }



        $bidable = '';
        if (isset($adforest_theme['sb_enable_comments_offer']) && $adforest_theme['sb_enable_comments_offer'] && isset($adforest_theme['sb_enable_comments_offer_user']) && $adforest_theme['sb_enable_comments_offer_user']) {

            $bidable .= '<div class="bidding-content adf-categories"' . $bid_style_cat . '>';
            $bidable .= '<div class="adf-information-text"> <h4>' . $adforest_theme['sb_enable_comments_offer_user_title'] . '</h4></div>';
            $bid_on = '';
            $bid_off = '';
            if ($ad_bidding == 1) {
                $bid_on = 'selected=selected';
            } else {
                $bid_off = 'selected=selected';
            }
            $bidding_options = '<option value="1" ' . $bid_on . '>' . __('ON', 'adforest') . '</option>';
            $bidding_options .= '<option value="0" ' . $bid_off . '>' . __('OFF', 'adforest') . '</option>';
            $bidable .= '<div class="row"><div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                            <div class="form-group">
			 <select class="form-control" name="ad_bidding" id="ad_bidding" data-parsley-required="true" data-parsley-error-message="' . __('This field is required.', 'adforest') . '">
					' . $bidding_options . '
			</select>
                        </div>
		  </div></div>';
            if (isset($adforest_theme['bidding_timer']) && $adforest_theme['bidding_timer']) {
                $bidable .= '<div class="row biddind_div">
                                <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                   <div class="form-group">
                                      <label class="control-label">' . __('Bidding close date', 'adforest') . '<small>' . __('For countdown', 'adforest') . '</small></label>
                                      <input class="form-control" autocomplete="off" placeholder="' . __('Click to select', 'adforest') . '" type="text" name="ad_bidding_date" id="ad_bidding_date"  value="' . $ad_bidding_date . '">
                                   </div>
                               </div>
                            </div>';
            }
            $bidable .= '</div>';
        }

        $bump_ad_html = '';
        $sb_packages_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_packages_page']);
        if (isset($is_update) && $is_update != "") {

            $is_package_notification = true;

            if (isset($adforest_theme['sb_allow_free_bump_up']) && $adforest_theme['sb_allow_free_bump_up']) {
                $is_package_notification = false;

                $bump_ad_html = '<div class="adf-content">
                                    <input type="checkbox" name="sb_bump_up" id="sb_bump_up" />
                                    <span>' . __('Bump it up', 'adforest') . '</span><small>' . __('Bump-up ads remaining: unlimited', 'adforest') . '</small>
                                    ' . __('Bump it up on the top of the list.', 'adforest') . '
                                </div>';
            } else if (get_user_meta(get_current_user_id(), '_sb_expire_ads', true) == '-1' || get_user_meta(get_current_user_id(), '_sb_expire_ads', true) >= date('Y-m-d')) {
                if (get_user_meta(get_current_user_id(), '_sb_bump_ads', true) > 0 || get_user_meta(get_current_user_id(), '_sb_bump_ads', true) == '-1') {
                    $is_package_notification = false;
                    $bump_remaining = get_user_meta(get_current_user_id(), '_sb_bump_ads', true);
                    if (get_user_meta(get_current_user_id(), '_sb_bump_ads', true) == '-1') {
                        $bump_remaining = __('unlimited', 'adforest');
                    }
                    $bump_ad_html = '<div class="adf-content checkbox-wrap">
                                            <input type="checkbox" name="sb_bump_up" id="sb_bump_up" />
                                            <span>' . __('Bump it up', 'adforest') . '</span><small>' . __('Bump-up ads remaining:', 'adforest') . '<span> ( ' . $bump_remaining . ' ) </span></small>
                                            ' . __('Bump it up on the top of the list.', 'adforest') . '
                                        </div>';
                }
            }


            if ($is_package_notification && isset($adforest_theme['sb_show_bump_up_notification']) && $adforest_theme['sb_show_bump_up_notification']) {
                $bump_ad_html = '<div class="col-md-12 col-sm-12 col-xs-12"><div role="alert" class="alert alert-info alert-dismissible">
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				' . __('If you want to bump it up then please have a look on', 'adforest') . ' 
				<a href="' . get_the_permalink($sb_packages_page) . '" class="sb_anchor" target="_blank">
				' . __('Packages. ', 'adforest') . '
                </a></div></div>';
            }
        }

        $simple_feature_html = '';
        if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

            if (isset($adforest_theme['allow_featured_on_ad']) && $adforest_theme['allow_featured_on_ad'] && $is_feature_ad == 0 && ( get_user_meta(get_current_user_id(), '_sb_expire_ads', true) == '-1' || get_user_meta(get_current_user_id(), '_sb_expire_ads', true) >= date('Y-m-d') )) {

                if (get_user_meta(get_current_user_id(), '_sb_featured_ads', true) == '-1' || get_user_meta(get_current_user_id(), '_sb_featured_ads', true) > 0) {

                    $count_featured_ads = __('Featured ads remaining: Unlimited', 'adforest');

                    if (get_user_meta(get_current_user_id(), '_sb_featured_ads', true) > 0) {
                        $count_featured_ads = __('Featured ads remaining :', 'adforest') . '<span> ( ' . get_user_meta(get_current_user_id(), '_sb_featured_ads', true) . ' ) </span>';
                    }
                    $feature_text = '';
                    if (isset($adforest_theme['sb_feature_desc']) && $adforest_theme['sb_feature_desc'] != "") {
                        $feature_text = $adforest_theme['sb_feature_desc'];
                    }
                    $simple_feature_html = '<div class="adf-content checkbox-wrap">
                                                <input type="checkbox" name="sb_make_it_feature" id="sb_make_it_feature" />
                                                <span>' . __('Make it featured', 'adforest') . ' </span><small>' . $count_featured_ads . '</small>
                                                 <p>' . $feature_text . '</p>
                                            </div>';
                } else {
                    $simple_feature_html = '<div role="alert" class="alert alert-info alert-dismissible">
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				' . __('If you want to make it featured then please have a look on', 'adforest') . ' 
				<a href="' . get_the_permalink($sb_packages_page) . '" class="sb_anchor" target="_blank">
				' . __('Packages. ', 'adforest') . '
                </a></div>';
                }
            } else {
                $simple_feature_html = '<div role="alert" class="alert alert-info alert-dismissible">
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			' . __('If you want to make it featured then please have a look on', 'adforest') . ' 
			<a href="' . get_the_permalink($sb_packages_page) . '" class="sb_anchor" target="_blank">
			' . __('Packages. ', 'adforest') . '
			</a></div>';
            }

            if ($is_feature_ad == 1) {
                $simple_feature_html = '<div role="alert" class="alert alert-info alert-dismissible">
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				' . __('This ad is already featured.', 'adforest') . '</div>';
            }
        }



        $custom_locations_html = '';
        if (isset($adforest_theme['sb_custom_location']) && $adforest_theme['sb_custom_location']) {
            $loc_lvl_1 = __('Select Your Country', 'adforest');
            $loc_lvl_2 = __('Select Your State', 'adforest');
            $loc_lvl_3 = __('Select Your City', 'adforest');
            $loc_lvl_4 = __('Select Your Town', 'adforest');
            if (isset($adforest_theme['sb_location_titles']) && $adforest_theme['sb_location_titles'] != "") {
                $titles_array = explode("|", $adforest_theme['sb_location_titles']);
                if (count($titles_array) > 0) {
                    if (isset($titles_array[0]))
                        $loc_lvl_1 = $titles_array[0];
                    if (isset($titles_array[1]))
                        $loc_lvl_2 = $titles_array[1];
                    if (isset($titles_array[2]))
                        $loc_lvl_3 = $titles_array[2];
                    if (isset($titles_array[3]))
                        $loc_lvl_4 = $titles_array[3];
                }
            }
            $custom_locations_html = '<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                       <div class="form-group">
                                         <label class="control-label">' . $loc_lvl_1 . ' <span class="required">*</span></label>
                                         <select class="country form-control" id="ad_country" name="ad_country" data-parsley-required="true" data-parsley-error-message="' . esc_html__('This field is required.', 'adforest') . '"><option value="">Select Option</option>' . $country_html . '</select>
                                         </div>   
                                         <input type="hidden" name="ad_country_id" id="ad_country_id" value="" />
                                    </div>
                    		       <div id="ad_country_sub_div">
                    			  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" >
                                              <div class="adf-information-box">
                                      <div class="form-group">
                    			         <label class="control-label">' . $loc_lvl_2 . '</label><select class="category form-control" id="ad_country_states" name="ad_country_states">' . $country_states . '</select></div>
                                              </div>
                                              </div></div>
                                            
                    			 <div  id="ad_country_sub_sub_div" ><div class="col-md-12 col-lg-12 col-xs-12 col-sm-12"><div class="adf-information-box">
                                      <div class="form-group">
                    			         <label class="control-label">' . $loc_lvl_3 . '</label><select class="category form-control" id="ad_country_cities" name="ad_country_cities">' . $country_cities . '</select></div>
                                        </div></div></div>
                                            
                    			 <div  id="ad_country_sub_sub_sub_div">
                    			  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                              <div class="adf-information-box">
                                      <div class="form-group"><label class="control-label">' . $loc_lvl_4 . '</label><select class="category form-control" id="ad_country_towns" name="ad_country_towns">' . $country_towns . '</select>
                    			  </div></div></div></div>';
        }

        $ad_post_title_limit = isset($adforest_theme['ad_post_title_limit']) ? $adforest_theme['ad_post_title_limit'] : 50;
        $tems_cond_field = '';
//        if (isset($terms_link) && $terms_link != "") {
//            $res = adforest_extarct_link($terms_link);
//            $terms_text = esc_html__('Terms & conditions', 'adforest');
//            if (isset($terms_title) && !empty($terms_title)) {
//                $terms_text = $terms_title;
//            }
//            if (isset($terms_switch) && $terms_switch == 'show') {
//                $tems_cond_field = '<div class="adf-content checkbox-wrap">
//                                        <input  type="checkbox" id="minimal-checkbox-25" name="minimal-checkbox-25" data-parsley-required="true" data-parsley-error-message="' . __('Please accept terms and conditions.', 'adforest') . '">
//                                        <span  for="minimal-checkbox-25">' . __('I agree to', 'adforest') . ' <a href="' . $res['url'] . '" title="' . $res['title'] . '" target="' . $res['target'] . '">' . $terms_text . '</a> </span>
//                                    </div>';
//            }
//        }


        $term_link_html = '';
        if (isset($terms_link) && $terms_link != "") {

            $terms_text = esc_html__('Terms & conditions', 'adforest');
            if (isset($terms_title) && !empty($terms_title)) {
                $terms_text = $terms_title;
            }
            
            if (isset($adforest_elementor) && $adforest_elementor) {
                $btn_args = array(
                    'btn_key' => $terms_link,
                    'adforest_elementor' => $adforest_elementor,
                    'btn_class' => '',
                    'iconBefore' => '',
                    'iconAfter' => '',
                    'titleText' => $terms_text,
                );
                $term_link_html = apply_filters('adforest_elementor_url_field', $term_link_html, $btn_args);
            } else {
                $res = adforest_extarct_link($terms_link);
                $term_link_html = '<a href="' . $res['url'] . '" title="' . $res['title'] . '" target="' . $res['target'] . '"> ' . $terms_text . '</a>';
            }

            if (isset($terms_switch) && $terms_switch == 'show') {
                //$tems_cond_field = '<div class="form-group adforest-ad-post-terms"><div class="row"><div class="col-xs-12 col-md-12 col-sm-12"><div class="skin-minimal"><ul class="list"><li><input  type="checkbox" id="minimal-checkbox-1" name="minimal-checkbox-1" data-parsley-required="true" data-parsley-error-message="' . __('Please accept terms and conditions.', 'adforest') . '"><label for="minimal-checkbox-1">' . __('I agree to', 'adforest') . $term_link_html . ' </label></li></ul></div></div></div></div>';

                $tems_cond_field = '<div class="adf-content checkbox-wrap">
                                        <input  type="checkbox" id="minimal-checkbox-25" name="minimal-checkbox-25" data-parsley-required="true" data-parsley-error-message="' . __('Please accept terms and conditions.', 'adforest') . '">
                                        <span  for="minimal-checkbox-25">' . __('I agree to', 'adforest') . $term_link_html . ' </span>
                                    </div>';
            }
        }




        global $adforest_theme;
        $stricts = '';
        if (isset($adforest_theme['sb_location_allowed']) && !$adforest_theme['sb_location_allowed'] && isset($adforest_theme['sb_list_allowed_country'])) {
            $stricts = "componentRestrictions: {country: " . json_encode($adforest_theme['sb_list_allowed_country']) . "}";
        }
        $types = "'(cities)'";
        if (isset($adforest_theme['sb_location_type']) && $adforest_theme['sb_location_type'] != "") {
            if ($adforest_theme['sb_location_type'] == 'regions')
                $types = "";
            else
                $types = "'(cities)'";
        }
        $loc_scropts = '';
        if (isset($adforest_theme['map-setings-map-type']) && $adforest_theme['map-setings-map-type'] == 'google_map') {
            $loc_scropts = "<script>
	   function adforest_location() {
	   var options = {
                    types: [" . $types . "],
                    " . $stricts . "
                   };
                    var input = document.getElementById('sb_user_address');
                    var action_on_complete	=	'1';
                    var autocomplete = new google.maps.places.Autocomplete(input, options);
                       if( action_on_complete )
                       {
                        new google.maps.event.addListener(autocomplete, 'place_changed', function() {
                            var place = autocomplete.getPlace();
                            document.getElementById('ad_map_lat').value = place.geometry.location.lat();
                            document.getElementById('ad_map_long').value = place.geometry.location.lng();
                                var markers = [
                                {
                                    'title': '',
                                    'lat': place.geometry.location.lat(),
                                    'lng': place.geometry.location.lng(),
                                },
                                ];
                             my_g_map(markers);
                       });
                    }
             }
        </script>";
        }

        $ad_post_cat_html_custom = '<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">' . __('Category', 'adforest') . ' <span class="required">*</span></label>
                                        <select class="category form-control" id="ad_cat" name="ad_cat" data-parsley-required="true" data-parsley-error-message="' . __('This field is required.', 'adforest') . '">
                                               <option value="">' . __('Select Option', 'adforest') . '</option>
                                               ' . $cats_html . '
                                        </select>
                                        <input type="hidden" name="ad_cat_id" id="ad_cat_id" value="" />
                                    </div>
                             </div>
                             <!-- Sub Category  -->
                             <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" id="ad_cat_sub_div">
                                    <div class="adf-information-box-1">
                                        <div class="form-group">
                                   <!-- Sub Category  -->
                                         <select class="category form-control" id="ad_cat_sub" name="ad_cat_sub">
                                                 ' . $sub_cats_html . '
                                         </select>
                             </div>
                            </div>
                            </div>
                             <!-- sub sub Category  -->
                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" id="ad_cat_sub_sub_div">
                            <div class="adf-information-box-2">
                                        <div class="form-group">
                                         <select class="category form-control" id="ad_cat_sub_sub" name="ad_cat_sub_sub">
                                                 ' . $sub_sub_cats_html . '
                                         </select>
                          </div> </div> </div>
                          <!-- sub sub sub Category  -->
                          <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" id="ad_cat_sub_sub_sub_div">
                                    <div class="adf-information-box-3">
                                        <div class="form-group">
                                      <select class="category form-control" id="ad_cat_sub_sub_sub" name="ad_cat_sub_sub_sub">
                                              ' . $sub_sub_sub_cats_html . '
                                      </select>
                          </div></div></div>';


        $ad_post_cat_html_simple = '<div class="adf-categories">
                            <div class="row">
                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                <div class="adf-information-text">
                                    <h4>'.esc_html__('Categories','adforest').'</h4>
                                </div>
                            </div>
                             ' . $ad_post_cat_html_custom . '   
                            </div>
                </div>';
        $cat_html_simple = '';
        $cus_cat_html_swipe = '';
        if ($isCustom == 'no') {
            $cat_html_simple = $ad_post_cat_html_simple;
        } else {
            $cus_cat_html_swipe = $ad_post_cat_html_custom;
        }
        $directory_post_args = array(
            'is_update' => $is_update,
            'ad_style' => 'fancy',
        );
        $directory_ad_post_html = apply_filters('adforest_directory_ad_post_fields_frontend', '', $directory_post_args);

        $ad_id = get_user_meta(get_current_user_id(), 'ad_in_progress', true);
        $bid_ad_id = isset($_GET['id']) && !empty($_GET['id']) ? $_GET['id'] : $ad_id;


       $address_req   =  isset($adforest_theme['sb_default_ad_addres_required'])  ?  $adforest_theme['sb_default_ad_addres_required']  :  true;

          $is_allowed_addres = isset($adforest_theme['sb_allow_address']) ? $adforest_theme['sb_allow_address'] : true;
       
       
       $user_address_html  =  "";
       if($is_allowed_addres ){
  
        if($address_req){
        $user_address_html   =      ' <label class="control-label">' . __('Address', 'adforest') . ' <span class="required">*</span></label>
                         <input class="form-control" value="' . $ad_location . '" type="text" name="sb_user_address" id="sb_user_address" data-parsley-required="true" data-parsley-error-message="' . __('This field is required.', 'adforest') . '" placeholder="' . __('Enter a location', 'adforest') . '" onkeydown="return (event.keyCode!=13);">';
        }
        else {
            
             $user_address_html   =      ' <label class="control-label">' . __('Address', 'adforest') . ' </label>
                         <input class="form-control" value="' . $ad_location . '" type="text" name="sb_user_address" id="sb_user_address" data-parsley-required="false" data-parsley-error-message="' . __('This field is required.', 'adforest') . '" placeholder="' . __('Enter a location', 'adforest') . '" onkeydown="return (event.keyCode!=13);">';
        }
        
       }
 $video_logo_url = get_template_directory_uri() . '/images/video-logo.jpg';

        return '<section class="adfancy-post-ad section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
                        <form  class="submit-form" id="ad_post_form">
                            <div class ="row">
                            <div class="col-lg-8 col-xs-12 col-sm-12 col-md-8">
                                <div class="adf-st-information-box">
                                  <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                        <div class="adf-information-box">
                                            <div class="adf-information-text">
                                                <h4>' . __('Ad Information', 'adforest') . '</h4>
                                            </div>
                                            <div class="adf-search-bar">
                                                <div class="form-group">
                                                    <label class="control-label">' . __('Title', 'adforest') . ' <span class="required">*</span></label>
						        <input maxlength="' . $ad_post_title_limit . '" data-parsley-maxlength="' . $ad_post_title_limit . '" class="form-control" placeholder="' . __('Enter title  character limit', 'adforest') . ' (' . $ad_post_title_limit . '). " type="text" name="ad_title" id="ad_title" data-parsley-required="true" data-parsley-error-message="' . __('This field is required.', 'adforest') . '" value="' . $title . '" autocomplete="off">
                                                        <input type="hidden" id="is_update" name="is_update" value="' . $is_update . '" />
                                                        <input type="hidden" id="bid_ad_id" name="bid_ad_id" value="' . $bid_ad_id . '" />    
                                                        <input type="hidden" id="is_level" name="is_level" value="' . $level . '" />
                                                        <input type="hidden" id="country_level" name="country_level" value="' . $levelz . '" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     ' . $cus_cat_html_swipe . '
				' . $imageStaticHTML . '
                                    '.$videoStaticHTML.'
                                   </div>
                                </div><!-- ad information section end -->
                                <div class="adf-st-information-box">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                        <div class="adf-information-box">
                                            <div class="adf-information-text">
                                                <h4>' . __('Ad Detail', 'adforest') . '</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xs-12  col-sm-12">
						 <label class="control-label">' . __('Ad Description', 'adforest') . ' <small>' . __('Enter long description.', 'adforest') . '</small></label>
						 <textarea rows="12" class="form-control" name="ad_description" id="ad_description">' . $description . '</textarea>
                                    </div>
                                        ' . $customDynamicAdType . '
                                        ' . $priceStaticHTML . '
                                        ' . $ad_curreny_html . '
					 ' . $someStaticHTML . '
                                        ' . $customDynamicFields . '
                                       
                                </div>
                                </div>
                                <!-- Extra Fields code -->
                                ' . $extra_fields_html . '  
                                  ' . $directory_ad_post_html . '
                                        ' . $simple_feature_html . '
					' . $bump_ad_html . '
                                        ' . $tems_cond_field . ' 
                                
                            </div>
                            <div class="col-lg-4 col-xs-12 col-sm-12 col-md-4">
                                ' . $cat_html_simple . '
                                <!-- Bidding Section -->
                                ' . $bidable . '
                                <div class="adf-categories">
                                 <div class="row">
                                    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                        <div class="adf-information-text">
                                            <h4>' . __('User Information', 'adforest') . '</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                          <div class="form-group">
						 <label class="control-label">' . __('Your Name', 'adforest') . ' <span class="required">*</span></label>
						 <input class="form-control" type="text" name="sb_user_name" data-parsley-required="true" data-parsley-error-message="' . __('This field is required.', 'adforest') . '" value="' . $poster_name . '">
				          </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                         <div class="form-group">
						<label class="control-label">' . __('Mobile Number', 'adforest') . $ph_reg . '</label>
						 ' . $phone_html . '
                                         </div>            
				    </div> 
                                    ' . apply_filters('adforest_directory_ad_post_user_fields', '') . '
                                    ' . $custom_locations_html . '
                                    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                        <div class="adf-information-box"> 
                                            <div class="form-group">
						
                                           '.$user_address_html.'
                                    </div>
                                        </div>
                                    </div>    
                                        ' . $lat_long_html . '
					' . $lat_lon_script . '
                                    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">        
                                        <div class="adf-submit-form">
                                            <button type="submit" class="btn btn-theme submit_ad_now" data-btn-val="1">' . __('Submit', 'adforest') . '</button>
                                        </div>
                                    </div>
                                 </div>    
                                </div>
                            </div>
                            </div>
                            
                        <input type="hidden" id="dictDefaultMessage" value="' . __('Drop files here or click to upload.', 'adforest') . '" />
                        <input type="hidden" id="dictFallbackMessage" value="' . __('Your browser does not support drag\'n\'drop file uploads.', 'adforest') . '" />
                        <input type="hidden" id="dictFallbackText" value="' . __('Please use the fallback form below to upload your files like in the olden days.', 'adforest') . '" />
                        <input type="hidden" id="dictFileTooBig" value="' . __('File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.', 'adforest') . '" />
                        <input type="hidden" id="dictInvalidFileType" value="' . __('You can\'t upload files of this type.', 'adforest') . '" />
                        <input type="hidden" id="dictResponseError" value="' . __('Server responded with {{statusCode}} code.', 'adforest') . '" />
                        <input type="hidden" id="dictCancelUpload" value="' . __('Cancel upload', 'adforest') . '" />
                        <input type="hidden" id="dictCancelUploadConfirmation" value="' . __('Are you sure you want to cancel this upload?', 'adforest') . '" />
                        <input type="hidden" id="dictRemoveFile" value="' . __('Remove file', 'adforest') . '" />
                        <input type="hidden" id="dictMaxFilesExceeded" value="' . __('You can not upload any more files.', 'adforest') . '" />
                        <input type="hidden" id="wizard_previous" value="' . __('Previous', 'adforest') . '" />
                        <input type="hidden" id="wizard_next" value="' . __('Next', 'adforest') . '" />
                        <input type="hidden" id="wizard_submit" value="' . __('Submit', 'adforest') . '" />
                        <input type="hidden" id="wizard_preview" value="' . __('Preview', 'adforest') . '" />
                        <input type="hidden" id="pre_sub" value="1" />
                        <input type="hidden" id="sb_form_is_custom" name="sb_form_is_custom" value="' . $isCustom . '" />

                         <input type="hidden" id="ad_posted" value="' . __('Ad Posted successfully.', 'adforest') . '" />
    <input type="hidden" id="ad_updated" value="' . __('Ad updated successfully.', 'adforest') . '" />
                        <input type="hidden" id="is_bidding_on" value="' . $ad_bidding . '" />
                        <input type="hidden" id="is_allow_map" value="' . $is_allow_map . '" />
                        <input type="hidden" id="sb-post-token" value="' . wp_create_nonce('sb_post_secure') . '" />
                            <input type="hidden" id="is_sub_active" value="1" />
                             <input type="hidden" id="sb_upload_video_limit" value="' . $max_upload_vid_limit_opt . '" />
            <input type="hidden" id="video_logo_url" value="' . $video_logo_url . '" />
                      
                        </form>
                    </div>
                </div>
            </div>
        </section>';
    }

}
if (function_exists('adforest_add_code')) {
    adforest_add_code('ad_post_fancy_short_base', 'ad_post_fancy_short_base_func');
}