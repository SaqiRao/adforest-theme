<?php 

add_action('wp_enqueue_scripts', 'adforest_child_adfouser', 20);
 
 function adforest_child_adfouser(){
   
   wp_enqueue_style( 'child-style', get_stylesheet_uri());
   wp_enqueue_script('script', trailingslashit(get_stylesheet_directory_uri()) . 'js/script.js', array('jquery',), false, true);
       // Pass AJAX URL to script
   wp_localize_script('script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
 
   function register_child_theme_shortcodes()
 {

     require trailingslashit(get_stylesheet_directory()) . '/inc/theme_shortcodes/shortcodes.php';
   //  require trailingslashit(get_stylesheet_directory()) . 'inc/utilities.php';
    
}

add_action('after_setup_theme', 'register_child_theme_shortcodes' );


//widget code child theme
function register_category_search_widget() {
    register_widget('Category_Search_Widget');
}

add_action('widgets_init', 'register_category_search_widget');
class Category_Search_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'category_search_widget',
            __('Ad Category Child', 'text_domain'),
            array(
                'description' => __('A category search widget child', 'text_domain'),
            )
        );
    }

    public function widget($args, $instance) {
        $new = '';
        $used = '';
        $expand = '';
        $toggle = 'collapsed';
        if (isset($_GET['cat_id']) && $_GET['cat_id'] != '') {
            $expand = 'show';
            $toggle = '';
        }
        global $adforest_theme;
        $widget_layout = adforest_search_layout();
        if (isset($instance['open_widget']) && $instance['open_widget'] == '1') {
            $expand = 'show';
            $toggle = '';
        }
        $widget_id = 'category_search_widget_' . $this->id; // Unique ID for this widget instance
        ?>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="<?php echo $widget_id; ?>_heading">
                <h4 class="ad-widget-title">
                    <!-- <a role="button" data-bs-toggle="collapse" href="#<?php echo $widget_id; ?>_collapse" aria-expanded="true" aria-controls="<?php echo $widget_id; ?>_collapse" class="<?php echo esc_attr($toggle); ?>">
                        <i class="more-less fa fa-plus"></i></a> -->
                        <?php echo esc_html($title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']));?>
                    
                </h4>
            </div>
            <?php
           
            $sb_search_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_search_page']);
            $sb_search_page = isset($sb_search_page) && $sb_search_page != '' ? get_the_permalink($sb_search_page) : 'javascript:void(0)';
            $sb_search_page = apply_filters('adforest_category_widget_form_action', $sb_search_page, 'cat_page');
            
            ?>

    <form method="get" id="search_cats_ajax" action="<?php echo $sb_search_page; ?>">
    <!-- <div id="<?php echo $widget_id; ?>_collapse" class="panel-collapse collapse <?php echo esc_attr($expand);?>" role="tabpanel" aria-labelledby="<?php echo $widget_id; ?>_heading"> -->
        <?php

        $cats_html = ""; 
        $sub_cats_html = "";
        $level = "";
        $sub_sub_cats_html = "";
        $sub_sub_sub_cats_html = "";
        $sub_sub_sub_sub_cats_html = "";

        $ad_cats = adforest_get_cats('ad_cats', 0);
        //print_r($ad_cats);
          //$level = count($cats);
        //print_r($ad_cats);
        if (count($ad_cats) > 0) {

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
        ?>
        <div class="panel-body categoriess_form">
        <?php
                
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


            
         $categories_style_html = '<div class="form-group cats-dropdown"> <div class="row">
                                    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                    	<div class="form-group">
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
                                 
                                   <button type="submit" class="btn btn-theme submit-button">Submit</button>
                                  </div>';

        //$categories_style_html = apply_filters('adforest_adpost_modern_categories', $categories_style_html, isset($_GET['cat_id']) ? $_GET['cat_id'] : 0);

        echo $categories_style_html ;   
        ?>
            <style type="text/css">
            .custom-profile-cats-sidebar a {
                color: #ffc220;
            }

            li.custom-profile-cats-sub-sidebar-main a.main-a {
                color: #ffc220;
            }

            li.custom-profile-cats-sub-sidebar-1 a.sub-a-1 {
                color: #ffc220;
            }

            li.custom-profile-cats-sub-sidebar-2 a.sub-a-2 {
                color: #ffc220;
            }

            li.custom-profile-cats-sub-sidebar-3 a.sub-a-3 {
                color: #ffc220;
            }
        </style>
        </div>
        <?php
        }
        ?>
    <!-- </div> -->
   
    <?php //echo adforest_search_params('cat_id');?>
    <?php apply_filters('adforest_form_lang_field', true);?>
      <!-- Submit Button --><?php
      echo adforest_search_params('cat_id','ad_cat_sub','ad_cat_sub_sub','ad_cat_sub_sub_sub','ad_cat_sub_sub_sub_sub'); 

      ?>
    </form>
        </div>
        <?php
    }
    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = esc_html__('Category', 'adforest');
        }
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>" >
                <?php echo esc_html__('Title:', 'adforest'); ?>
            </label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['open_widget'] = (!empty($new_instance['open_widget']) ) ? strip_tags($new_instance['open_widget']) : '';
        return $instance;
    }
}


add_action('wp_ajax_sb_get_sub_cat_searchss', 'adforest_get_sub_cats_search');
add_action('wp_ajax_nopriv_sb_get_sub_cat_searchss', 'adforest_get_sub_cats_search');
if (!function_exists('adforest_get_sub_cats_search')) {

    function adforest_get_sub_cats_search() {
        global $adforest_theme;
        $adpost_cat_style = isset($adforest_theme['adpost_cat_style']) && $adforest_theme['adpost_cat_style'] == 'grid' ? TRUE : FALSE;
        $search_popup_cat_disable = isset($adforest_theme['search_popup_cat_disable']) ? $adforest_theme['search_popup_cat_disable'] : false;
        $cat_id = $_POST['cat_id'];
        $load_type = isset($_POST['type']) && $_POST['type'] != '' ? $_POST['type'] : '';
        if ($load_type == 'ad_post') {
            if ($adpost_cat_style) {
                $ad_cats = adforest_get_cats('ad_cats', $cat_id, 0, 'post_ad');
            } else {
                $ad_cats = adforest_get_cats('ad_cats', 0, 0, 'post_ad');
            }
        } else {
            $ad_cats = adforest_get_cats('ad_cats', $cat_id);
        }
        $res = '';
        if (count($ad_cats) > 0) {
            $selected_cats = adforest_get_taxonomy_parents($cat_id, 'ad_cats', false);
            $find = '&raquo;';
            $replace = '';
            $selected_cats = preg_replace("/$find/", $replace, $selected_cats, 1);
            $res = '<label>' . $selected_cats . '</label>';
            $res .= '<ul class="city-select-city" >';

            foreach ($ad_cats as $ad_cat) {
                $id = 'ajax_cat';
                $count_p = ($ad_cat->count);
                $term_level = adforest_get_taxonomy_depth($ad_cat->term_id, 'ad_cats');

                $count_style = ' (' . $count_p . ')';
                if ($load_type == 'ad_post') {
                    $count_style = '';
                }

                $res .= '<li class="col-sm-4 col-xs-6 margin-top-15"><a href="javascript:void(0);" data-term-level="' . $term_level . '" data-cat-id="' . esc_attr($ad_cat->term_id) . '" id="' . $id . '">' . $ad_cat->name . $count_style . '</a></li>';
            }
            $res .= '</ul>';
           // echo adforest_returnEcho($res);
           echo "submit";
        } else {
            echo "submit";
        }
        die();
    }

}







if (!class_exists('adforest_search_custom_fields')) {

    class adforest_search_custom_fields extends WP_Widget {

        //use adforest_reuse_functions;

        /**
         * Register widget with WordPress.
         */
        function __construct() {
            $widget_ops = array(
                'classname' => 'adforest_search_custom_fields',
                'description' => __('Only for search and single ad sidebar.', 'adforest'),
            );
            // Instantiate the parent object
            parent::__construct(false, __('Custom Fields Search', 'adforest'), $widget_ops);
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args     Widget arguments.
         * @param array $instance Saved values from database.
         */
        public function widget($args, $instance) {
            $ad_code = '';
            if (isset($instance['ad_code'])) {
                $ad_code = $instance['ad_code'];
            }
            global $adforest_theme;
            $term_id = '';
            $customHTML = '';
            $widget_layout = adforest_search_layout();
             

            require trailingslashit(get_stylesheet_directory()) . 'template-parts/layouts/widgets/' . $widget_layout . '/custom.php';
            echo "" . $customHTML;
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form($instance) {

            $title = ( isset($instance['title']) ) ? $instance['title'] : esc_html__('Search By:', 'adforest');
           // $this->adforect_widget_open($instance);
            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>" >
                    <?php echo esc_html__('Title:', 'adforest'); ?> <small><?php echo esc_html__('You can leave it empty as well', 'adforest'); ?></small>
                </label> 
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
            <p><?php echo esc_html__('You can show/hide the specific type from categories custom fields where you created it.', 'adforest'); ?> </p>
            </p>

            <?php
        }

        /**
         * Sanitize widget form values as they are saved.
         *
         * @see WP_Widget::update()
         *
         * @param array $new_instance Values just sent to be saved.
         * @param array $old_instance Previously saved values from database.
         *
         * @return array Updated safe values to be saved.
         */
        public function update($new_instance, $old_instance) {
            $instance = array();
            $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
            $instance['open_widget'] = (!empty($new_instance['open_widget']) ) ? strip_tags($new_instance['open_widget']) : '';
            return $instance;
        }

    }

    /* Custom Search */
}


