<?php
global $adforest_theme;
/**
 * For full documentation, please visit: http://docs.reduxframework.com/
 * For a more extensive sample-config file, you may look at:
 * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
 */
if (!class_exists('Redux')) {
    return;
}
/* This is your option name where all the Redux data is stored. */
$opt_name = "adforest_theme";
$theme = wp_get_theme(); // For use with some settings. Not necessary.
$args = array(
    'opt_name' => 'adforest_theme',
    'dev_mode' => false,
    'display_name' => __('Theme Options - AdForest Pro Theme', 'adforest'),
    'display_version' => $theme->get( 'Version' ),
    'page_title' => __('Theme Options - AdForest Pro Theme', 'adforest'),
    'update_notice' => TRUE,
    'admin_bar' => TRUE,
    'menu_type' => 'submenu',
    'menu_title' => __('Theme Options Pro', 'adforest'),
    'allow_sub_menu' => TRUE,
    'page_parent_post_type' => 'your_post_type',
    'customizer' => TRUE,
    'default_show' => TRUE,
    'default_mark' => '*',
    'hints' => array(
        'icon_position' => 'right',
        'icon_size' => 'normal',
        'tip_style' => array(
            'color' => 'light',
        ),
        'tip_position' => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect' => array(
            'show' => array(
                'duration' => '500',
                'event' => 'mouseover',
            ),
            'hide' => array(
                'duration' => '500',
                'event' => 'mouseleave unfocus',
            ),
        ),
    ),
    'output' => TRUE,
    'output_tag' => TRUE,
    'settings_api' => TRUE,
    'cdn_check_time' => '1440',
    'compiler' => TRUE,
    'global_variable' => 'adforest_theme',
    'page_permissions' => 'manage_options',
    'save_defaults' => TRUE,
    'show_import_export' => TRUE,
    'database' => 'options',
    'transient_time' => '3600',
    'network_sites' => TRUE,
);
$args['share_icons'][] = array(
    'url' => 'https://www.facebook.com/scriptsbundle',
    'title' => __('Like us on Facebook', 'adforest'),
    'icon' => 'el el-facebook'
);
Redux::setArgs($opt_name, $args);
/*
 * ---> END ARGUMENTS
 * ---> START HELP TABS
 */
$tabs = array(
    array(
        'id' => 'redux-help-tab-1',
        'title' => __('Theme Information 1', 'adforest'),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'adforest')
    ),
    array(
        'id' => 'redux-help-tab-2',
        'title' => __('Theme Information 2', 'adforest'),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'adforest')
    )
);
Redux::set_help_tab($opt_name, $tabs);
/* Set the help sidebar */
$content = __('<p>This is the sidebar content, HTML is allowed.</p>', 'adforest');
Redux::set_help_sidebar($opt_name, $content);
/* ------------------Ad Post General Settings ----------------------- */
$payments_gateways = array();
$gateways = get_option('woocommerce_gateway_order');
if (isset($gateways) && is_array($gateways) && count($gateways) > 0) {
    foreach ($gateways as $key => $val) {
        $payments_gateways[$key] = $key;
    }
}
$time_zones_arr = array('' => __('Select Timezone', 'adforest'));
if (function_exists('adforest_timezone_list')) {
    $time_zones_arr = adforest_timezone_list('options');
}
global $adforest_theme;
$zone_currentTime = '';
if (isset($adforest_theme['bid_timezone']) && $adforest_theme['bid_timezone'] != '') {
    $date = current_time('mysql');
    if (function_exists('adforest_timezone_list') && isset($adforest_theme['bid_timezone']) && $adforest_theme['bid_timezone'] != "") {

        $date = date_create('now', timezone_open(adforest_timezone_list('', $adforest_theme['bid_timezone'])));
    }
    $zone_currentTime = __('Date & Time : ', 'adforest') . date_format($date, 'Y-m-d H:i:s');
}
$tz_subtitle = __('Set Timezone of your region that is applied to all time related theme functionalities.<br /><b>(like : bidding timer, messages time)</b>', 'adforest');
$tz_subtitle = apply_filters('adforest_directory_timezone_subtitle', $tz_subtitle);
Redux::setSection($opt_name, array(
    'title' => __('General', 'adforest'),
    'id' => 'sb_theme_generalr',
    'desc' => '',
    'icon' => 'el el-wrench',
    'fields' => array(
        array(
            'id' => 'is_demo',
            'type' => 'switch',
            'title' => __('Demo Mode', 'adforest'),
            'desc' => __('Demo mode', 'adforest'),
            'default' => false
        ),
        
        // array(
        //     'id' => 'is_directory',
        //     'type' => 'switch',
        //     'title' => __('Directory Listings option', 'adforest'),
        //     'desc' => __('This will allow user to create events , booking and other directory related features', 'adforest'),
        //     'default' => false
        // ),
        array(
            'id' => 'sb_admin_translate',
            'type' => 'switch',
            'title' => __('Is Admin translated', 'adforest'),
            'desc' => __('After saving please refresh it.', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'sb_pre_loader',
            'type' => 'switch',
            'title' => __('Pre Page Loader', 'adforest'),
            'default' => true,
        ),

        array(
            'required' => array('sb_pre_loader', '=', array('1')),
            'id' => 'loader_img_switch',
            'type' => 'switch',
            'title' => esc_html__('Preloader Image', 'adforest'),
            'subtitle' => esc_html__('Enable/Disable Preloader  /Upload your custom preloader', 'adforest'),
            'default' => false,
        ),
        array(
            'required' => array('loader_img_switch', '=', array('1')),
            'id' => 'loader_text',
            'type' => 'text',
            'title' => esc_html__('Preloader text', 'adforest'),
        ),
        array(
            'required' => array('loader_img_switch', '=', array('1')),
            'id' => 'loader_img',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Preloader image', 'adforest'),
            'compiler' => 'true',
            'subtitle' => esc_html__('Dimensions: 200 x 200', 'adforest'),
            'default' => array('url' => get_template_directory_uri() . '/images/loader.gif'),
        ),
        array(
            'id' => 'sb_block_widget',
            'type' => 'switch',
            'title' => __('Add new block widget style', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'bid_timezone',
            'type' => 'select',
            'title' => __('Timezones', 'adforest'),
            'subtitle' => $tz_subtitle,
            'desc' => $zone_currentTime,
            'options' => $time_zones_arr,
        ),
        array(
            'id' => 'cat_pkg_type',
            'type' => 'button_set',
            'title' => __('Category Package Type', 'adforest'),
            'desc' => __('<b>Parent : </b> In Parent Selection, if you buy a parent category in a package then you can also post in child categories of the paid parent category.<br /><br /><b>Child : </b>In Child Selection you have to buy each paid category whether it is a child or parent.', 'adforest'),
            'options' => array(
                'parent' => __('Parent Category', 'adforest'),
                'child' => __('Child Category', 'adforest'),
            ),
            'default' => 'parent',
        ),
        array(
            'id' => 'gmap_lang',
            'type' => 'text',
            'title' => __('Google map language', 'adforest'),
            'desc' => adforest_make_link('https://developers.google.com/maps/faq#languagesupport', __('List of available languages', 'adforest')),
            'default' => 'en',
        ),
        array(
            'id' => 'sb_rtl',
            'type' => 'switch',
            'title' => __('RTL', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'tgm_disable_notification',
            'type' => 'switch',
            'title' => __('Disable TGM Notification', 'adforest'),
            'default' => false,
            'subtitle' => __('Used to hide/show the theme required/updating plugins notifications at the top of admin dashboard.', 'adforest'),
        ),
        array(
            'id' => 'admin_bar',
            'type' => 'switch',
            'title' => __('Admin Bar', 'adforest'),
            'subtitle' => __('wordpress', 'adforest'),
            'default' => true,
        ),
        array(
            'id' => 'scroll_to_top',
            'type' => 'switch',
            'title' => __('Scroll to top', 'adforest'),
            'default' => true,
        ),
        array(
            'id' => 'sell_button',
            'type' => 'switch',
            'title' => __('Ad Post Sticky Button', 'adforest'),
            'default' => true,
        ),
        array(
            'id' => 'crop_ad_images',
            'type' => 'switch',
            'title' => esc_html__('Crop Images Forcefully', 'adforest'),
            'default' => true,
            'desc' => esc_html__('Note : After Enable/Disable Please Run the "Force Regenerate Thumbnails" plugin for regenerate image sizes.', 'adforest'),
        ),
        array(
            'id' => 'sb_cat_load_style',
            'type' => 'button_set',
            'title' => __('Categories Load Type', 'adforest'),
            'options' => array(
                'dropdown' => __('Dropdown (default)', 'adforest'),
                'live' => __('Ajax Based', 'adforest'),
            ),
            'subtitle' => __('Select Ad Categories load type in all Visual Composer Page Elements', 'adforest'),
            'desc' => __('<b class="sb-admin-note">Note : </b> For toggle these options you have to re-select the ads categories in page elements.It is use to decrease the admin query load time.', 'adforest'),
            'default' => 'dropdown'
        ),
        array(
            'id' => 'sb_video_icon',
            'type' => 'switch',
            'title' => __('Video icon on ads', 'adforest'),
            'default' => true,
        ),
        array(
            'id' => 'sticky_icon',
            'type' => 'text',
            'title' => __('Sticky Icon', 'adforest'),
            'subtitle' => __('Just like "flaticon-android"', 'adforest'),
            'required' => array('sell_button', '=', array('1')),
            'desc' => __('You can select from.', 'adforest') . ' ' . adforest_make_link('https://adforestpro.scriptsbundle.com/icons-page/', __('List', 'adforest')),
            'default' => 'flaticon-transport-9',
        ),
        array(
            'id' => 'sticky_title',
            'type' => 'text',
            'title' => __('Sticky Title', 'adforest'),
            'required' => array('sell_button', '=', array('1')),
            'default' => 'Sell',
        ),
        array(
            'id' => 'sb_android_app',
            'type' => 'switch',
            'title' => __('Android app available', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'sb_android_app_direction',
            'type' => 'button_set',
            'title' => __('Icon position', 'adforest'),
            'options' => array(
                'right' => __('Right', 'adforest'),
                'left' => __('Left', 'adforest'),
            ),
            'required' => array('sb_android_app', '=', array('1')),
            'default' => 'right'
        ),
        array(
            'id' => 'sb_android_app_text',
            'type' => 'text',
            'title' => __('App display text', 'adforest'),
            'required' => array('sb_android_app', '=', array('1')),
            'default' => 'Android App',
        ),
        array(
            'id' => 'sb_android_app_link',
            'type' => 'text',
            'title' => __('App link', 'adforest'),
            'required' => array('sb_android_app', '=', array('1')),
            'default' => '',
        ),
        array(
            'id' => 'sb_android_app_img',
            'type' => 'media',
            'url' => true,
            'title' => __('Default App picture', 'adforest'),
            'compiler' => 'true',
            'subtitle' => __('Dimensions: 60 x 106', 'adforest'),
            'required' => array('sb_android_app', '=', array('1')),
            'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'images/app-and.png'),
        ),
        array(
            'id' => 'sb_refersh_enqueued',
            'type' => 'switch',
            'subtitle' => __('Refresher is used to add a random version to each style and script file for removing cached things.', 'adforest'),
            'title' => __('Refresher', 'adforest'),
            'default' => false,
            'desc' => __('<b class="sb-admin-note">Note : </b>Enable this option if you are facing issue due to enqueued file version controlling while editing style/script file.', 'adforest'),
        ),
        array(
            'id' => 'sb_user_dp',
            'type' => 'media',
            'url' => true,
            'title' => __('Default user picture', 'adforest'),
            'compiler' => 'true',
            'subtitle' => __('Dimensions: 200 x 200', 'adforest'),
            'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'images/9.jpg'),
        ),

        array(
            'id' => 'sb_404_title',
            'type' => 'text',
            'title' => __('404 Page title', 'adforest'),
            'default' => esc_html__('Sorry, This Page Does Not Exist.','adforest'),
        ),
         array(
            'id' => 'sb_404_description',
            'type' => 'editor',
            'title' => __('404 Page Description', 'adforest'),
            'args' => array(
                'wpautop' => false,
                'media_buttons' => false,
                'textarea_rows' => 5,
                'teeny' => false,
                'quicktags' => false,
            )
        ),

      






    )
));

/* Theme Typography */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Typography Settings', 'adforest'),
    'id' => 'typo_settings',
    'subsection' => false,
    'customizer_width' => '450px',
    'icon' => 'el el-tasks',
    'fields' => array(
        array(
            'id' => 'adforest-body-typo',
            'type' => 'typography',
            'title' => esc_html__('Body', 'adforest'),
            'google' => true,
            'font-backup' => false,
            'output' => array(
                'body'
            ),
            'units' => 'px',
            'font_display' => 'false',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'adforest'),
            'default' => array(
                'color' => '#6d7c90',
                'font-style' => '400',
                'font-family' => 'Lato',
                'google' => true,
                'font-size' => '16px',
                'line-height' => '28px',
                'font_display' => 'false',
            ),
        ),
        array(
            'id' => 'opt-theme-btn-color',
            'type' => 'link_color',
            'title' => __('Theme Button Color', 'adforest'),
            'desc' => __('Please provide main theme button color', 'adforest'),
            'active' => false,
            'default' => array(
                'regular' => '#ffC220',
                'hover' => '#ffC220',
                'active' => '#ffC220',
            )
        ),
        array(
            'id' => 'opt-theme-btn-shadow-color',
            'type' => 'color_rgba',
            'title' => __('Theme button shadow color', 'adforest'),
            'subtitle' => __('Pick a show color for the theme buttons', 'adforest'),
            'mode' => 'background',
            'default' => array(
                'color' => '#ffC220',
                'alpha' => '.8',
                'rgba' => 'rgb(255 194 32,90%)'
            ),
        ),
        array(
            'id' => 'opt-theme-btn-text-color',
            'type' => 'link_color',
            'title' => __('Theme button Text color', 'adforest'),
            'subtitle' => __('Pick a show color for the theme buttons', 'adforest'),
            'active' => false,
            'default' => array(
                'regular' => '#000000',
                'hover' => '#000000',
                'active' => '#000000',
            )
        ),
        array(
            'id' => 'adforest-p-typo',
            'type' => 'typography',
            'title' => esc_html__('Paragraph', 'adforest'),
            'google' => true,
            'font-backup' => false,
            'output' => array('p'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'adforest'),
            'default' => array(
                'color' => '#777',
                'font-style' => '400',
                'font-family' => 'Lato',
                'google' => true,
                'font-size' => '16px',
                'line-height' => '30px'
            ),
        ),
        array(
            'id' => 'adforest-h1-typo',
            'type' => 'typography',
            'title' => esc_html__('Heading 1', 'adforest'),
            'google' => true,
            'font-backup' => false,
            'output' => array('h1'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'adforest'),
            'default' => array(
                'color' => '#20292f',
                'font-weight' => '700',
                'font-family' => 'Lato',
                'google' => true,
                'font-size' => '34px',
                'line-height' => '40px'
            ),
        ),
        array(
            'id' => 'adforest-h2-typo',
            'type' => 'typography',
            'title' => esc_html__('Heading 2', 'adforest'),
            'google' => true,
            'font-backup' => false,
            'output' => array(
                'h2'
            ),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'adforest'),
            'default' => array(
                'color' => '#20292f',
                'font-weight' => '700',
                'font-family' => 'Lato',
                'google' => true,
                'font-size' => '30px',
                'line-height' => '36px'
            ),
        ),
        array(
            'id' => 'adforest-h3-typo',
            'type' => 'typography',
            'title' => esc_html__('Heading 3', 'adforest'),
            'google' => true,
            'font-backup' => false,
            'output' => array(
                'h3'
            ),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'adforest'),
            'default' => array(
                'color' => '#20292f',
                'font-weight' => '700',
                'font-family' => 'Lato',
                'google' => true,
                'font-size' => '26px',
                'line-height' => '28px'
            ),
        ),
        array(
            'id' => 'adforest-h4-typo',
            'type' => 'typography',
            'title' => esc_html__('Heading 4', 'adforest'),
            'google' => true,
            'font-backup' => false,
            'output' => array(
                'h4'
            ),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'adforest'),
            'default' => array(
                'color' => '#20292f',
                'font-weight' => '700',
                'font-family' => 'Lato',
                'google' => true,
                'font-size' => '20px',
                'line-height' => '27px'
            ),
        ),
        array(
            'id' => 'adforest-h5-typo',
            'type' => 'typography',
            'title' => esc_html__('Heading 5', 'adforest'),
            'google' => true,
            'font-backup' => false,
            'output' => array(
                'h5'
            ),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'adforest'),
            'default' => array(
                'color' => '#20292f',
                'font-weight' => '700',
                'font-family' => 'Lato',
                'google' => true,
                'font-size' => '18px',
                'line-height' => '24px'
            ),
        ),
        array(
            'id' => 'adforest-h6-typo',
            'type' => 'typography',
            'title' => esc_html__('Heading 6', 'adforest'),
            'google' => true,
            'font-backup' => false,
            'output' => array(
                'h6'
            ),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'adforest'),
            'default' => array(
                'color' => '#20292f',
                'font-weight' => '700',
                'font-family' => 'Lato',
                'google' => true,
                'font-size' => '14px',
                'line-height' => '21px'
            ),
        ),
    )
));
/* ------------------Header Settings ----------------------- */




Redux::setSection($opt_name, array(
    'title' => __('Header', 'adforest'),
    'id' => 'sb_theme_header',
    'desc' => '',
    'icon' => 'el el-arrow-up',
    'fields' => array(
        array(
            'id' => 'sb_header',
            'type' => 'image_select',
            'title' => __('Header Style', 'adforest'),
            'options' => array(
                'white'  => array(
                'alt'   => esc_html__('Header white  (1)','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/headers/white.png',
                ),
                'black' => array(
                'alt'   => esc_html__('Header black (2)','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/headers/black.png',
                ),
                'with_ad' => array(
                'alt'   => esc_html__('Header with ad (3)','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/headers/with_ad.png',
                ),
                'light' => array(
                 'alt'   => esc_html__('Header light (4)','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/headers/light.png',
                ),
                'Decore' => array(
                 'alt'   => esc_html__('Header Decore (9)','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/headers/Decore.png',
                ),
                'modern' => array(
                 'alt'   => esc_html__('Header modern (5)','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/headers/modern.png',
                ),
                'modern2' => array(
                 'alt'   => esc_html__('Header modern2 (6)','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/headers/modern2.png',
                ),
                'modern3' => array(
                'alt'   => esc_html__('Header modern3 (7)','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/headers/modern3.png',
                ),
                'modern4' => array(
                'alt'   => esc_html__('Header modern4 (11)','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/headers/modern4.png',
                ),
                'transparent' => array(
                'alt'   => esc_html__('Header transparent (13) ','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/headers/transparent.png',
                ),
                'transparent-2' => array(
                'alt'   => esc_html__('Header transparent-2 (8)','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/headers/trasparent2.png',
                ),
                'transparent-3' => array(
                'alt'   => esc_html__('Header transparent-3 (10)','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/headers/trasnparent3.png',
                ),
                'header-classy' => array(
                'alt'   => esc_html__('Header header-classy (14)','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/headers/classy.png',
                ),
                'vendor-1' => array(
                'alt'   => esc_html__('Header vendor-1 (12)','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/headers/vendor.png',
                ),
                'elementor-pro' => array(
                'alt'   => esc_html__('Header elementor-pro','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/headers/elementor.jpg',
                ),
            ),
            'default' => 'white'
        ),
        array(
            'id' => 'sb_disable_menu',
            'type' => 'switch',
            'title' => __('Disable Menu', 'adforest'),
            'desc' => __('Enable this option to remove header menu links completely from desktop/mobile', 'adforest'),
            'default' => false,
            'required' => array('sb_header', '!=', array('2')),
        ),
        array(
            'id' => 'sb_sticky_header',
            'type' => 'switch',
            'title' => __('Sticky Menu', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'sb_top_bar',
            'type' => 'switch',
            'title' => __('Top Bar', 'adforest'),
            'default' => true,
            'force_output' => true,
            'required' => array(
                array('sb_header', '!=', 'modern'),
                array('sb_header', '!=', 'modern4'),
                array('sb_header', '!=', 'light'),
                array('sb_header', '!=', 'modern2'),
                array('sb_header', '!=', 'transparent-3'),
                array('sb_header', '!=', 'Decore'),
            )
        ),
        array(
            'id' => 'top_bar_text',
            'type' => 'text',
            'title' => __('Top Bar Text', 'adforest'),
            'default' => 'Welcome to Our Mobile Forest',
            'required' => array('sb_header', '=', array('1', 'modern3', 'transparent-2')),
        ),
        array(
            'id' => 'top_bar_contact',
            'type' => 'text',
            'title' => __('Top Bar Contact', 'adforest'),
            'default' => '123-456-78900',
            'required' => array('sb_header', '=', array('1', 'modern3', 'transparent-2')),
        ),
        array(
            'id' => 'top_bar_pages',
            'type' => 'select',
            'data' => 'pages',
            'multi' => false,
            'sortable' => true,
            'title' => __('Select Pages', 'adforest'),
            'subtitle' => __('for top bar', 'adforest'),
            'required' => array(
                array('sb_top_bar', '=', '1'),
            ),
            'default' => '',
        ),
        array(
            'id' => 'sb_top_location',
            'type' => 'switch',
            'title' => __('Top Location', 'adforest'),
            'desc' => __('Enable/Disable top bar locations', 'adforest'),
            'subtitle' => __('Use this to switch all ads according to the current location selected.', 'adforest'),
            'default' => false,
            'required' => array(
                array('sb_header', '!=', 'modern'),
                array('sb_header', '!=', 'light'),
                array('sb_header', '!=', 'modern2'),
                array('sb_header', '!=', 'vendor-1'),
            ),
        ),
        array(
            'id' => 'sb_top_location_list',
            'type' => 'select',
            'data' => 'terms',
            'args' => array('taxonomies' => array('ad_country'), 'hide_empty' => false,),
            'required' => array('sb_top_location', '=', true),
            'multi' => true,
            'sortable' => true,
            'title' => __('Select Locations', 'adforest'),
        ),
        array(
            'id' => 'sb_header_location_list',
            'type' => 'select',
            'data' => 'terms',
            'args' => array('taxonomies' => array('ad_country'), 'hide_empty' => false,),
            'required' => array('sb_header', '=', 'header-classy'),
            'multi' => true,
            'sortable' => true,
            'title' => __('Select Locations for header', 'adforest'),
        ),
        array(
            'id' => 'sb_site_logo',
            'type' => 'media',
            'url' => true,
            'title' => __('Logo', 'adforest'),
            'compiler' => 'true',
            'desc' => __('Site Logo image for the site.', 'adforest'),
            'subtitle' => __('Dimensions: 122 x 30', 'adforest'),
            'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'images/footer-logo.png'),
        ),
        array(
            'id' => 'sb_home_logo',
            'type' => 'media',
            'url' => true,
            'title' => __('Logo', 'adforest'),
            'compiler' => 'true',
            'desc' => __('logo for home page', 'adforest'),
            'subtitle' => __('Dimensions: 122 x 30', 'adforest'),
            'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'footer-logo/logo.png'),
            'required' => array('sb_header', '=', array('modern', 'transparent', 'transparent-2', 'transparent-3')),
        ),
        array(
            'id' => 'sb_site_logo_mobile',
            'type' => 'media',
            'url' => true,
            'title' => __('Logo', 'adforest'),
            'compiler' => 'true',
            'desc' => __('Site Logo image responsive', 'adforest'),
            'subtitle' => __('Dimensions: 122 x 30', 'adforest'),
            'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'images/footer-logo.png'),
            'desc' => __('data sticky logo for mobile devices', 'adforest'),
        ),

         array(
            'id' => 'sb_dashboard_logo',
            'type' => 'media',
            'url' => true,
            'title' => __('Logo', 'adforest'),
            'compiler' => 'true',
            'desc' => __('Site Logo image for dashboard.', 'adforest'),
            //'subtitle' => __('Dimensions: 122 x 30', 'adforest'),
            'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'images/footer-logo.png'),
        ),
        array(
            'id' => 'sb_menu_color',
            'type' => 'button_set',
            'title' => __('Menu Color', 'adforest'),
            'options' => array(
                '#fff' => 'White',
                '#000' => 'Black',
            ),
            'required' => array('sb_header', '=', array('modern', 'transparent-2', 'transparent-3', 'transparent')),
            'default' => '#000'
        ),
        array(
            'id' => 'sb_menu_color_single',
            'type' => 'button_set',
            'title' => __('Menu Color Ad Detail', 'adforest'),
            'options' => array(
                '#fff' => 'White',
                '#000' => 'Black',
            ),
            'required' => array('sb_header', '=', array('modern', 'transparent-2', 'transparent-3', 'transparent')),
            'default' => '#000'
        ),
        array(
            'id' => 'sb_sidebar_img',
            'type' => 'media',
            'url' => true,
            'title' => __('Logo for Sidebar', 'adforest'),
            'compiler' => 'true',
            'desc' => __('Logo for sidebar when vendor 1 header active', 'adforest'),
            'subtitle' => __('Dimensions: 260 x 264', 'adforest'),
            'required' => array('sb_header', '=', array('2')),
            'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'images/sidebar-logo.jpg'),
        ),
        array(
            'id' => 'sb_menu_product_cat_switch',
            'type' => 'switch',
            'title' => __('Product Category in Menu', 'adforest'),
            'default' => true,
            'required' => array(
                array('sb_header', '=', array('modern4')),
            ),
        ),
        
           array(
            'id' => 'sb_menu_categories_switch',
            'type' => 'switch',
            'title' => __('Menu Categories', 'adforest'),
            'default' => true,
            'required' => array(
              array('sb_header', '=', array('modern4')),
            ),
        ),
        
         array(
            'id' => 'sb_menu_categories',
            'type' => 'select',
            'multi' => true,
            'data' => 'terms',
            'args' => array('taxonomies' => 'ad_cats', 'hide_empty' => false),
            'title' => __('Select Categories', 'adforest'),
            'required' => array(
                array('sb_menu_categories_switch', '=', '1'),
            ),
            'default' => '',
        ),
         array(
            'id' => 'menu_cat_search_type',
            'type' => 'button_set',
            'title' => __('Category Search Type', 'adforest'),
            'options' => array(
                'search_page' => __('Search Page', 'adforest'),
                'cate_page' => __('Category Page', 'adforest'),
            ),
            'required' => array(
                array('sb_menu_categories_switch', '=', '1'),
            ),
            'desc' => __('Select menu categories search type.', 'adforest'),
            'default' => 'search_page',
        ),
        
        array(
            'id' => 'with_ad_720_90',
            'type' => 'textarea',
            'title' => __('Advertisement', 'adforest'),
            'subtitle' => __('720 x 90', 'adforest'),
            'required' => array('sb_header', '=', array('with_ad')),
            'default' => '<img src="' . trailingslashit(get_template_directory_uri()) . 'images/banner728.jpg" alt="' . esc_attr('image', 'adforest') . '"> ',
        ),
        array(
            'id' => 'sb_cart_in_menu',
            'type' => 'switch',
            'title' => __('Cart in user menu', 'adforest'),
            'default' => true,
        ),
        array(
            'required' => array('sb_header', '=', array('2')),
            'id' => 'sidebar_social_icons',
            'type' => 'sortable',
            'title' => __('Social Media', 'adforest'),
            'desc' => __('Social media icons for Vendor sidebar', 'adforest'),
            'label' => true,
            'options' => array(
                'Facebook' => '',
                'Twitter' => '',
                'Linkedin' => '',
                'Google' => '',
                'YouTube' => '',
                'Vimeo' => '',
                'Pinterest' => '',
                'Tumblr' => '',
                'Instagram' => '',
                'Reddit' => '',
                'Flickr' => '',
                'StumbleUpon' => '',
                'Delicious' => '',
                'dribble' => '',
                'behance' => '',
                'DeviantART' => '',
            ),
        ),
        array(
            'id' => 'sb_show_profile_stat',
            'type' => 'switch',
            'title' => __('Show User stats on profile page', 'adforest'),
            /* 'required' => array( 'sb_top_bar', '=', true ), */
            'default' => true,
        ),
        array(
            'id' => 'sb_sign_in_page',
            'type' => 'select',
            'data' => 'pages',
            'title' => __('Sign In Page', 'adforest'),
            /* 'required' => array( 'sb_top_bar', '=', true ), */
            'default' => '',
        ),
        array(
            'id' => 'sb_sign_up_page',
            'type' => 'select',
            'data' => 'pages',
            'title' => __('Sign Up Page', 'adforest'),
            /* 'required' => array( 'sb_top_bar', '=', true ), */
            'default' => '',
        ),
        array(
            'id' => 'sb_profile_page',
            'type' => 'select',
            'data' => 'pages',
            'title' => __('Profile Page', 'adforest'),
            /* 'required' => array( 'sb_top_bar', '=', true ), */
            'default' => '',
        ),

     array(
            'id' => 'sb_after_login_page',
            'type' => 'select',
            'data' => 'pages',
            'title' => __('After Login Page', 'adforest'),
            'default' => '',
             'desc' => __('After login pag will be redirected to this page','adforest'),
        ),        
     array(
            'id' => 'sb_post_ad_page',
            'type' => 'select',
            'data' => 'pages',
            'title' => __('Ad Post Page', 'adforest'),
            'default' => '',
        ),
        array(
            'id' => 'ad_in_menu',
            'type' => 'switch',
            'title' => __('Post An AD', 'adforest'),
            'subtitle' => __('Show Button in Menu', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'search_in_header',
            'type' => 'switch',
            'title' => __('Search Bar', 'adforest'),
            'subtitle' => __('in header', 'adforest'),
            'required' => array('sb_header', '=', array('black', 'modern2', 'modern3', 'modern4')),
            'default' => true,
        ),
        array(
            'id' => 'ad_in_menu_text',
            'type' => 'text',
            'title' => __('Post An AD button text', 'adforest'),
            'default' => 'Post An AD',
        ),
    )
));

$grig_layout = array(
    'grid_1' => 'Grid 1',
    'grid_2' => 'Grid 2',
    'grid_3' => 'Grid 3',
    'grid_4' => 'Grid 4',
    'grid_5' => 'Grid 5',
    'grid_6' => 'Grid 6',
    'grid_7' => 'Grid 7',
    'grid_8' => 'Grid 8',
    'grid_9' => 'Grid 9',
    'grid_10' => 'Grid 10',
    'grid_10' => 'Grid 11',
);
$featured_ads_layout = array(
    'grid_1' => 'Grid 1',
    'grid_2' => 'Grid 2',
    'grid_3' => 'Grid 3',
    'grid_4' => 'Grid 4',
    'grid_5' => 'Grid 5',
    'grid_6' => 'Grid 6',
    'grid_7' => 'Grid 7',
    'grid_8' => 'Grid 8',
    'grid_9' => 'Grid 9',
    'grid_10' => 'Grid 10',
    'grid_11' => 'Grid 11',
);
/* ------------------Ad Posing Settings ----------------------- */
Redux::setSection($opt_name, array(
    'title' => __('Ads Settings', 'adforest'),
    'id' => 'sb_ad_settings',
    'desc' => '',
    'icon' => 'el el-adjust-alt',
));

Redux::setSection($opt_name, array(
    'title' => __('General Settings', 'adforest'),
    'id' => 'sb_ad_general_settings',
    'desc' => '',
    'icon' => 'el el-cogs',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sb_location_allowed',
            'type' => 'switch',
            'title' => __('Allowed all countries', 'adforest'),
            'default' => true,
        ),
        array(
            'id' => 'sb_list_allowed_country',
            'type' => 'select',
            'options' => adforest_get_all_countries(),
            'multi' => true,
            'title' => __('Select Countries', 'adforest'),
            'required' => array('sb_location_allowed', '=', array('0')),
            'desc' => __('You can select max 5 countries as per GOOGLE limit.', 'adforest') . ' ' . adforest_make_link('https://developers.google.com/maps/documentation/javascript/3.exp/reference#ComponentRestrictions', __('Read More', 'adforest')),
        ),
        array(
            'id' => 'sb_location_type',
            'type' => 'button_set',
            'title' => __('Address Type', 'adforest'),
            'options' => array(
                'cities' => __('Cities', 'adforest'),
                'regions' => __('Adresses', 'adforest'),
            ),
            'default' => 'cities'
        ),
        array(
            'id' => 'communication_mode',
            'type' => 'button_set',
            'title' => __('Communications Mode', 'adforest'),
            'options' => array(
                'phone' => __('Phone', 'adforest'),
                'message' => __('Messages', 'adforest'),
                'both' => __('Both', 'adforest'),
            ),
            'default' => 'both'
        ),
        array(
            'id' => 'restrict_phone_show',
            'type' => 'button_set',
            'title' => __('Restrict Phone Number', 'adforest'),
            'desc' => __('Restrict phone number to show all or to login users only.', 'adforest'),
            'options' => array(
                'all' => __('All', 'adforest'),
                'login_only' => __('Login Only', 'adforest'),
            ),
            'default' => 'all'
        ),
        array(
            'id' => 'sb_custom_location',
            'type' => 'switch',
            'title' => __('Custom locations', 'adforest'),
            'default' => false,
        ),
         array(
            'id' => 'sb_location_titles',
            'type' => 'text',
            'title' => __('Location titles', 'adforest'),
            'required' => array('sb_custom_location', '=', '1'),
            'desc' => __('4-level location title separate by | like Country|State|City|Town', 'adforest'),
            'default' => 'Country|State|City|Town',
        ),
        array(
            'id' => 'sb_order_auto_approve',
            'type' => 'switch',
            'title' => __('Package order auto approval', 'adforest'),
            'subtitle' => __('after payment', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'sb_order_auto_approve_disable',
            'type' => 'select',
            'options' => $payments_gateways,
            'multi' => true,
            'title' => __('Select Payments Gateways', 'adforest'),
            'required' => array('sb_order_auto_approve', '=', '1'),
            'subtitle' => __('Disable Payments auto approval', 'adforest'),
            'desc' => __('Selected payments gateway order will not be auto approved.', 'adforest'),
        ),
        array(
            'id' => 'sb_ad_desc_html',
            'type' => 'switch',
            'title' => __('Ad description html', 'adforest'),
            'subtitle' => __('Enable this to add html in the ad description field while ad posting.', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'sb_ad_title_limit_on',
            'type' => 'switch',
            'title' => __('Ad title limit', 'adforest'),
            'subtitle' => __('in grid ad view', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'sb_ad_title_limit',
            'type' => 'text',
            'title' => __('Characters limit', 'adforest'),
            'subtitle' => __('in title', 'adforest'),
            'required' => array('sb_ad_title_limit_on', '=', '1'),
            'validate' => 'numeric',
            'default' => 200,
        ),
        array(
            'id' => 'sb_ad_location_limit_on',
            'type' => 'switch',
            'title' => __('Ad Location limit', 'adforest'),
            'subtitle' => __('in grid ad view', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'sb_ad_location_limit',
            'type' => 'text',
            'title' => __('Characters limit', 'adforest'),
            'subtitle' => __('in location', 'adforest'),
            'required' => array('sb_ad_location_limit_on', '=', '1'),
            'validate' => 'numeric',
            'default' => 200,
        ),
        array(
            'id' => 'sb_auto_slide_time',
            'type' => 'select',
            'title' => __('Ad auto slider time in seconds', 'adforest'),
            'options' => array(1000 => 1, 2000 => 2, 3000 => 3, 4000 => 4, 5000 => 5, 6000 => 6, 7000 => 7, 8000 => 8, 9000 => 9, 10000 => 10),
            'default' => 1000,
        ),
       
        array(
            'id' => 'sb_price_types',
            'type' => 'select',
            'options' => array('Fixed' => __('Fixed', 'adforest'), 'Negotiable' => __('Negotiable', 'adforest'), 'on_call' => __('Price on call', 'adforest'), 'auction' => __('Auction', 'adforest'), 'free' => __('Free', 'adforest'), 'no_price' => __('No price', 'adforest')),
            'multi' => true,
            'sortable' => true,
            'title' => __('Price Types', 'adforest'),
            'default' => array(),
        ),
        array(
            'id' => 'sb_price_types_more',
            'type' => 'text',
            'title' => __('Custom Price Type', 'adforest'),
            'desc' => __('Separated by | like option 1|option 2', 'adforest'),
            'default' => '',
        ),
        array(
            'id' => 'sb_send_email_on_ad_post',
            'type' => 'switch',
            'title' => __('Send email on Ad Post', 'adforest'),
            'default' => true,
        ),
        array(
            'id' => 'ad_post_email_value',
            'type' => 'text',
            'title' => __('Email for notification.', 'adforest'),
            'required' => array('sb_send_email_on_ad_post', '=', '1'),
            'default' => get_option('admin_email'),
        ),
        array(
            'id' => 'sb_send_email_on_message',
            'type' => 'switch',
            'title' => __('Send email on message', 'adforest'),
            'desc' => __('When someone drop a message on ad then email send to concern user.', 'adforest'),
            'default' => true,
        ),
        array(
            'id' => 'msg_notification_on',
            'type' => 'switch',
            'title' => __('Toastr notification', 'adforest'),
            'desc' => __('When someone drop a message on ad then notify to user on web via small popup.', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'msg_notification_time',
            'type' => 'text',
            'title' => __('Check Notification', 'adforest'),
            'subtitle' => __('after X second', 'adforest'),
            'desc' => __('Check notification after how many second. 1000 means 1 second.', 'adforest'),
            'required' => array('msg_notification_on', '=', array('1')),
            'default' => 10000,
        ),
        array(
            'id' => 'msg_notification_text',
            'type' => 'text',
            'title' => __('Notification text', 'adforest'),
            'desc' => __('%count% will be replace with number of messages.', 'adforest'),
            'required' => array('msg_notification_on', '=', array('1')),
            'default' => "You have %count% new messages.",
        ),
        array(
            'id' => 'sb_notification_page',
            'type' => 'select',
            'data' => 'pages',
            'title' => __('All notifications page', 'adforest'),
            'default' => '',
        ),
        array(
            'id' => 'sb_currency',
            'type' => 'text',
            'title' => __('Default currency - if using 1 currency', 'adforest'),
            'desc' => adforest_make_link('http://htmlarrows.com/currency/', __('List of Currency', 'adforest')) . " " . esc_attr__('You can use HTML code or text as well like USD etc', 'adforest'),
            'default' => '$',
        ),
        array(
            'id' => 'sb_multi_currency_default',
            'type' => 'select',
            'data' => 'terms',
            'args' => array('taxonomies' => 'ad_currency', 'hide_empty' => false,),
            'title' => __('Default selected currency', 'adforest'),
            'subtitle' => __('While posting ad in multi-currency', 'adforest'),
            'default' => '',
        ),
        array(
            'id' => 'sb_price_direction',
            'type' => 'select',
            'options' => array('left' => 'Left', 'left_with_space' => 'Left with space', 'right' => 'Right', 'right_with_space' => 'Right with space'),
            'title' => __('Price direction', 'adforest'),
            'default' => 'left',
        ),
        array(
            'id' => 'sb_price_separator',
            'type' => 'text',
            'title' => __('Thousands Separator', 'adforest'),
            'default' => ',',
        ),
        array(
            'id' => 'sb_price_decimals',
            'type' => 'text',
            'title' => __('Decimals', 'adforest'),
            'desc' => __('It should be 0 for no decimals.', 'adforest'),
            'default' => '2',
        ),
        array(
            'id' => 'sb_price_decimals_separator',
            'type' => 'text',
            'title' => __('Decimals Separator', 'adforest'),
            'default' => '.',
        ),
        array(
            'id' => 'sb_ad_approval',
            'type' => 'select',
            'options' => array('auto' => 'Auto Approved', 'manual' => 'Admin manual approval'),
            'title' => __('Ad Approval', 'adforest'),
            'default' => 'auto',
        ),
        array(
            'id' => 'sb_update_approval',
            'type' => 'select',
            'options' => array('auto' => 'Auto Approved', 'manual' => 'Admin manual approval'),
            'title' => __('Ad Update Approval', 'adforest'),
            'default' => 'auto',
        ),
        array(
            'id' => 'sb_trusted_user',
            'type' => 'switch',
            'title' => __('Turn On Trusted user', 'adforest'),
            'default' => false,
            'desc' => __('This option will allow specific users to get that ads approve even admin approval is enabled.', 'adforest'),
        ),
        array(
            'id' => 'email_on_ad_approval',
            'type' => 'switch',
            'title' => __('Email to Ad owner on approval', 'adforest'),
            'default' => true,
        ),
        array(
            'id' => 'sb_packages_page',
            'type' => 'select',
            'data' => 'pages',
            'title' => __('Ad Packages Page', 'adforest'),
            'default' => '',
        ),
        array(
            'id' => 'package_expiry_notification',
            'type' => 'switch',
            'title' => __('Package Expiry Notification', 'adforest'),
            'desc' => __('<b class="sb-admin-note"> Note : </b> This functionality works hiddenly notify the users before package expiry.This option takes a lot of load so any one who wishes to choose this option must have a good server that can support heavy load.', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'package_expire_notify_before',
            'type' => 'text',
            'title' => __('Package Expiry Notification before', 'adforest'),
            'subtitle' => __('add the number of days before package expiry notification', 'adforest'),
            'default' => 3,
            'desc' => __('should be integer value. <b>( Days )</b>', 'adforest'),
            'required' => array('package_expiry_notification', '=', array(true)),
        ),
        array(
            'id' => 'share_ads_on',
            'type' => 'switch',
            'title' => __('Enable Ad Share', 'adforest'),
            'default' => true,
        ),
        array(
            'id' => 'report_options',
            'type' => 'text',
            'title' => __('Report ad Options', 'adforest'),
            'default' => 'Spam|Offensive|Duplicated|Fake',
        ),
        array(
            'id' => 'report_limit',
            'type' => 'text',
            'title' => __('Ad Report Limit', 'adforest'),
            'desc' => __('Only integer value without spaces.', 'adforest'),
            'default' => 10,
        ),
        array(
            'id' => 'report_action',
            'type' => 'select',
            'title' => __('Action on Ad Report Limit', 'adforest'),
            'options' => array(1 => 'Auto Inactive', 2 => 'Email to Admin'),
            'default' => 1,
        ),
        array(
            'id' => 'report_email',
            'type' => 'text',
            'title' => __('Email', 'adforest'),
            'desc' => __('Email where you want to get notify.', 'adforest'),
        
            'default' => get_option('admin_email'),
        ),
        array(
            'id' => 'default_related_image',
            'type' => 'media',
            'url' => true,
            'title' => __('Default Image', 'adforest'),
            'compiler' => 'true',
            'desc' => __('If there is no image of ad then this will be show.', 'adforest'),
            'subtitle' => __('Dimensions: 300 x 225', 'adforest'),
            'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'images/no-image.jpg'),
        ),

          array(
            'id' => 'adt-set-imports',
            'type' => 'callback',
            'title' => __('Imported ad images', 'adforest'),
            'callback' => 'adforest_set_import_images'
        ),

       array(
          'id' => 'adt-make-ads-active',
          'type' => 'callback',
          'title' => __('Make ads active', 'adforest'),
          'callback' => 'adforest_make_ads_active',
          
         ),
      array(
         'id' => 'make-ads-active-days',
         'type' => 'text',
         'title' => __('Active ads days', 'adforest'),
         'desc' => __('Your ads will be activated for the specified number of days. Use -1 for unlimited days.', 'adforest'),
         'default' => 30,
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => __('Ads Post Settings', 'adforest'),
    'id' => 'sb_ad_post',
    'desc' => '',
    'icon' => 'el el-cogs',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sb_default_img_required',
            'type' => 'switch',
            'title' => __('Images Required', 'adforest'),
            'subtitle' => __('Enable/Disable Images Required for ad post default template.', 'adforest'),
            'default' => false,
        ),
       
        array(
            'id' => 'sb_allow_address',
            'type' => 'switch',
            'title' => __('Allow Adress on ad post page', 'adforest'),
            'subtitle' => __('This will hide/show address fields on ad post page', 'adforest'),
            'default' => true,
            
        ),
                
        array(
            'id' => 'is_sub_cat_required',
            'type' => 'switch',
            'title' => __('Make child Categories selection required on ad post form', 'adforest'),
            'subtitle' => __('Sub cat fields required', 'adforest'),
            'default' => false,
            
        ),

         array(
            'id' => 'sb_default_ad_addres_required',
            'type' => 'switch',
            'title' => __('address Required', 'adforest'),
            'subtitle' => __('Enable/Disable address Required for ad post.', 'adforest'),
            'default' => true,
               'required' => array('sb_allow_address', '=', array(true)),
        ),
        array(
            'id' => 'ad_post_restriction',
            'type' => 'button_set',
            'title' => __('Posting Allowed', 'adforest'),
            'subtitle' => __('Restrict Users to ad post with phone verication or not.', 'adforest'),
            'desc' => __('<b class="sb-admin-note">Note:</b> In case of <b>"Phone verified users"</b> Please enable the <b>"Phone verfication"</b> in <b>Dashboard >> Theme Options >> Users >> Phone verfication</b>', 'adforest'),
            'options' => array(
                'all' => __('All Users', 'adforest'),
                'phn_verify' => __('Phone Verified Users', 'adforest'),
            ),
            'default' => 'all',
        ),
        array(
            'id' => 'sb_standard_images_size',
            'type' => 'switch',
            'title' => __('Strict image mode', 'adforest'),
            'subtitle' => __('Not allowed less than 760x410', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'admin_allow_unlimited_ads',
            'type' => 'switch',
            'title' => __('Post unlimited free ads', 'adforest'),
            'subtitle' => __('For Administrator', 'adforest'),
            'default' => true,
        ),
        array(
            'id' => 'sb_allow_ads',
            'type' => 'switch',
            'title' => __('Free Ads', 'adforest'),
            'subtitle' => __('For new user', 'adforest'),
            'default' => true,
        ),
        array(
            'id' => 'sb_free_ads_limit',
            'type' => 'text',
            'title' => __('Free Ads limit', 'adforest'),
            'required' => array('sb_allow_ads', '=', array(true)),
            'subtitle' => __('For new user', 'adforest'),
            'desc' => __('It must be an inter value, -1 means unlimited.', 'adforest'),
            'default' => -1,
        ),


          array(
            'id' => 'sb_free_events_limit',
            'type' => 'text',
            'title' => __('Free Events limit', 'adforest'),
            //'required' => array('sb_allow_ads', '=', array(true)),
            'subtitle' => __('For new user', 'adforest'),
            'desc' => __('It must be an inter value, -1 means unlimited.', 'adforest'),
          
        ),



        array(
            'id' => 'sb_allow_featured_ads',
            'type' => 'switch',
            'title' => __('Free Featured Ads', 'adforest'),
            'subtitle' => __('For new user', 'adforest'),
            'default' => true,
        ),
        array(
            'id' => 'sb_featured_ads_limit',
            'type' => 'text',
            'title' => __('Featured Ads limit', 'adforest'),
            'subtitle' => __('For new user', 'adforest'),
            'required' => array('sb_allow_featured_ads', '=', array(true)),
            'desc' => __('It must be an inter value, -1 means unlimited.', 'adforest'),
            'default' => 1,
        ),
        array(
            'id' => 'sb_allow_bump_ads',
            'type' => 'switch',
            'title' => __('Free Bump Ads', 'adforest'),
            'subtitle' => __('For new user', 'adforest'),
            'default' => true,
        ),
        array(
            'id' => 'sb_bump_ads_limit',
            'type' => 'text',
            'title' => __('Bump Ads limit', 'adforest'),
            'subtitle' => __('For new user', 'adforest'),
            'required' => array('sb_allow_bump_ads', '=', array(true)),
            'desc' => __('It must be an inter value, -1 means unlimited.', 'adforest'),
            'default' => 1,
        ),
        array(
            'id' => 'sb_allow_free_bump_up',
            'type' => 'switch',
            'title' => __('Free Bump Ads for all users', 'adforest'),
            'subtitle' => __('without any package/restriction.', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'sb_show_bump_up_notification',
            'type' => 'switch',
            'title' => __('Bump Ad notification', 'adforest'),
            'subtitle' => __('On ad update page.', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'sb_allow_free_video_url',
            'type' => 'switch',
            'title' => __('Free Video url for new user', 'adforest'),
            'subtitle' => __('allow newly registered user to post free video url', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'sb_allow_free_tags',
            'type' => 'switch',
            'title' => __('Free tags for new user', 'adforest'),
            'subtitle' => __('allow newly registered user to post free tags.', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'ad_post_title_limit',
            'type' => 'text',
            'title' => __('Ad Post title limit', 'adforest'),
            'subtitle' => __('Enter character limit of title at the time of ad posting.', 'adforest'),
            'desc' => __('<b class="sb-admin-note">Note : </b> Should be positive integer value.', 'adforest'),
            'default' => 50,
        ),
        array(
            'id' => 'ad_post_tags_limit',
            'type' => 'text',
            'title' => __('Ad Post Tags limit', 'adforest'),
            'subtitle' => __('Enter tags limit for ad posting.', 'adforest'),
            'desc' => __('<b class="sb-admin-note">Note : </b> Should be positive integer value.Negative value means default value (10).', 'adforest'),
            'default' => 10,
        ),
        array(
            'id' => 'sb_package_validity',
            'type' => 'text',
            'title' => __('Free package validity', 'adforest'),
            'subtitle' => __('In days for new user', 'adforest'),
            'required' => array('sb_allow_ads', '=', array(true)),
            'desc' => __('It must be an inter value, -1 means never expired.', 'adforest'),
            'default' => -1,
        ),
        array(
            'id' => 'simple_ad_removal',
            'type' => 'text',
            'title' => __('Simple ad remove after', 'adforest'),
            'subtitle' => __('In DAYS', 'adforest'),
            'desc' => __('Only integer value without spaces -1 means never expired.', 'adforest'),
            'default' => -1,
        ),
        array(
            'id' => 'after_expired_ads',
            'type' => 'button_set',
            'title' => __('After Removal Ads Should be', 'adforest'),
            'options' => array(
                'published' => __('Published', 'adforest'),
                'trashed' => __('Trashed', 'adforest'),
                'expired' => __('Expired', 'adforest'),
            ),
            'default' => 'trashed'
        ),
        array(
            'id' => 'ads_remove_by',
            'type' => 'button_set',
            'subtitle' => __('ads removed/expired when you visit the page or automatically.', 'adforest'),
            'title' => __('Ads Removal/Expired By', 'adforest'),
            'options' => array(
                'visit' => __('Visit Ads', 'adforest'),
                'auto' => __('Automatically', 'adforest'),
            ),
            'default' => 'visit',
            'desc' => __('<b class="sb-admin-note">Note : </b>Automatically functionality works hiddenly schedule check.This option takes a lot of load so any one who wishes to choose this option must have a good server that can support heavy load.', 'adforest'),
        ),
        array(
            'id' => 'ad_removal_schedule',
            'type' => 'select',
            'subtitle' => __('Set ad removal schedule.', 'adforest'),
            'title' => __('Ad Removal Schedule', 'adforest'),
            'options' => array(
                'daily' => __('Daily', 'adforest'),
                'hourly' => __('Hourly', 'adforest'),
            ),
            'required' => array('ads_remove_by', '=', 'auto'),
            'default' => 'daily',
            'desc' => __('<b class="sb-admin-note">Note : </b> For changing schedule first you have to disble cron by selecting "Ads Removal/Expired By : Visit Ads" save and refresh page.After that re-select the "Ads Removal/Expired By : Automatically" and set schedule option and save. ', 'adforest'),
        ),
        array(
            'id' => 'featured_expiry',
            'type' => 'text',
            'title' => __('Feature Ad Expired', 'adforest'),
            'subtitle' => __('In DAYS', 'adforest'),
            'desc' => __('Only integer value without spaces -1 means never expired.', 'adforest'),
            'default' => 7,
        ),

         array(
            'id' => 'make_feature_paid',
            'type' => 'switch',
            'title' => __('Directly pay to make your ad featured', 'adforest'),
            'subtitle' => __('You will be able to post your ad as a featured ad and pay directly from WooCommerce with this option', 'adforest'),
            'default' => false,
        ),

        array(
            'id' => 'sb_feature_template_page',
            'type' => 'select',
            'data' => 'pages',
            'title' => __('Feature add packages page template', 'adforest'),
            'subtitle' => __('Go to pages , create page template "feature ads packages"', 'adforest'),
             'required' => array('make_feature_paid', '=', true),
            'default' => '',
        ),

        array(
            'id' => 'sb_upload_limit',
            'type' => 'select',
            'title' => __('Ad image set limit', 'adforest'),
            'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15, 16 => 16, 17 => 17, 18 => 18, 19 => 19, 20 => 20, 21 => 21, 22 => 22, 23 => 23, 24 => 24, 25 => 25),
            'default' => 5,
        ),
        array(
            'id' => 'sb_upload_size',
            'type' => 'select',
            'title' => __('Ad image max size', 'adforest'),
            'options' => array('307200-300kb' => '300kb', '614400-600kb' => '600kb', '819200-800kb' => '800kb', '1048576-1MB' => '1MB', '2097152-2MB' => '2MB', '3145728-3MB' => '3MB', '4194304-4MB' => '4MB', '5242880-5MB' => '5MB', '6291456-6MB' => '6MB', '7340032-7MB' => '7MB', '8388608-8MB' => '8MB', '9437184-9MB' => '9MB', '10485760-10MB' => '10MB', '11534336-11MB' => '11MB', '12582912-12MB' => '12MB', '13631488-13MB' => '13MB', '14680064-14MB' => '14MB', '15728640-15MB' => '15MB', '20971520-20MB' => '20MB', '26214400-25MB' => '25MB'),
            'default' => '2097152-2MB',
        ),
        array(
            'id' => 'allow_tax_condition',
            'type' => 'switch',
            'title' => __('Display Condition Taxonomy', 'adforest'),
            'default' => true,
            'desc' => __('Hide show codition taxanomy on ad post page', 'adforest'),
        ),
        array(
            'id' => 'allow_tax_warranty',
            'type' => 'switch',
            'title' => __('Display Warranty Taxonomy', 'adforest'),
            'default' => true,
            'desc' => __('Hide show Warranty taxanomy on ad post page', 'adforest'),
        ),
        array(
            'id' => 'adpost_cat_style',
            'type' => 'button_set',
            'subtitle' => __('Categories Style on ad post page.', 'adforest'),
            'title' => __('Categories Load Style', 'adforest'),
            'options' => array(
                'dropdown' => __('Dropdown', 'adforest'),
                'grid' => __('Grid', 'adforest'),
            ),
            'default' => 'dropdown',
            'desc' => __('Set the Categories style on ad post page. Paid category will work only in dropdown option', 'adforest'),
        ),
        array(
            'id' => 'allow_lat_lon',
            'type' => 'switch',
            'title' => __('Latitude & Longitude', 'adforest'),
            'desc' => __('This will be display on ad post page for pin point map', 'adforest'),
            'default' => true,
        ),
        array(
            'id' => 'sb_default_lat',
            'type' => 'text',
            'title' => __('Latitude', 'adforest'),
            'subtitle' => __('for default map.', 'adforest'),
            'required' => array('allow_lat_lon', '=', true),
            'default' => '40.7127837',
            'desc' => __('Should be integer/decimal value without any symbols. Example ( 50.7567 )', 'adforest'),
        ),
        array(
            'id' => 'sb_default_long',
            'type' => 'text',
            'title' => __('Longitude', 'adforest'),
            'subtitle' => __('for default map.', 'adforest'),
            'required' => array('allow_lat_lon', '=', true),
            'default' => '-74.00594130000002',
            'desc' => __('Should be integer/decimal value without any symbols. Example ( -30.7567 )', 'adforest'),
        ),
        array(
            'id' => 'allow_price_type',
            'type' => 'switch',
            'title' => __('Price Type', 'adforest'),
            'desc' => __('Display Price type option.', 'adforest'),
            'default' => true,
        ),
        array(
            'id' => 'sb_ad_update_notice',
            'type' => 'text',
            'title' => __('Update Ad Notice', 'adforest'),
            'default' => 'Hey, be careful you are updating this AD.',
        ),
        array(
            'id' => 'allow_featured_on_ad',
            'type' => 'switch',
            'title' => __('Allow make featured ad', 'adforest'),
            'subtitle' => __('on ad post.', 'adforest'),
            'default' => true,
        ),
        array(
            'id' => 'sb_feature_desc',
            'type' => 'textarea',
            'title' => __('Featured ad description', 'adforest'),
            'subtitle' => __('on ad post.', 'adforest'),
            'required' => array('allow_featured_on_ad', '=', true),
            'default' => 'Featured AD has more attention as compare to simple ad.',
        ),
        array(
            'id' => 'bad_words_filter',
            'type' => 'textarea',
            'title' => __('Bad Words Filter', 'adforest'),
            'subtitle' => __('Use commas to separate <br />Do not use / in the words', 'adforest'),
            'placeholder' => __('word1,word2', 'adforest'),
            'desc' => __('This words will be removed from AD Title and Description', 'adforest'),
            'default' => '',
        ),
        array(
            'id' => 'bad_words_replace',
            'type' => 'text',
            'title' => __('Bad Words Replace Word', 'adforest'),
            'desc' => __('This words will be replace with above bad words list from AD Title and Description', 'adforest'),
            'default' => '',
        ),
         array(
            'id' => 'sb_allow_upload_video',
            'type' => 'switch',
            'title' => esc_html__('Allow upload video', 'adforest'),
            'desc' => esc_html__('On/Off upload video.', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'sb_upload_video_mb_limit',
            'type' => 'select',
            'options' => array('1-1MB' => '1MB', '2-2MB' => '2MB', '3-3MB' => '3MB', '4-4MB' => '4MB', '5-5MB' => '5MB', '6-6MB' => '6MB', '7-7MB' => '7MB', '8-8MB' => '8MB', '9-9MB' => '9MB', '10-10MB' => '10MB', '11-11MB' => '11MB', '12-12MB' => '12MB', '13-13MB' => '13MB', '14-14MB' => '14MB', '15-15MB' => '15MB', '20-20MB' => '20MB', '25-25MB' => '25MB', '50-50MB' => '50MB'),
            'title' => esc_html__('Set limit in MB for video', 'carspot'),
            'default' => '2-2MB',
            'required' => array('sb_allow_upload_video', '=', true),
        ),
         array(
            'id' => 'sb_upload_video_limit',
            'type' => 'select',
            'title' => esc_html__('set limit for upload video', 'carspot'),
             'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 15 => 15, 20 => 20, 30 => 30),
            'default' => 2,
            'required' => array('sb_allow_upload_video', '=', true),
        ),
        array(
            'id' => 'sb_default_dynamic_template_on',
            'type' => 'switch',
            'title' => __('Select Dynamic Template', 'adforest'),
            'default' => false,
            'desc' => __('Select a default category whome you assign template.', 'adforest'),
        ),
        array(
            'required' => array('sb_default_dynamic_template_on', '=', true),
            'id' => 'sb_default_dynamic_template',
            'type' => 'select',
            'data' => 'terms',
            'args' => array('taxonomies' => array('ad_cats'), 'hide_empty' => false,),
            'multi' => false,
            'sortable' => false,
            'title' => __('Select Category', 'adforest'),
            'desc' => __('Select a default category whome you assign template.', 'adforest'),
            'default' => array(),
        ),
    )
));

//$taxonomy_single_styles = apply_filters('adfrest_directory_ads_styles', $taxonomy_single_styles);

Redux::setSection($opt_name, array(
    'title' => __('Ads View Settings', 'adforest'),
    'id' => 'sb_view_post',
    'desc' => '',
    'icon' => 'el el-wrench',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'ad_layout_style',
            'type' => 'button_set',
            'title' => __('Ad Style', 'adforest'),
            'options' => array(
                '1' => 'Style 1',
                '2' => 'Style 2',
            ),
            'default' => '1',
        ),
        array(
            'id' => 'cat_and_location',
            'type' => 'button_set',
            'title' => esc_html__('Taxonomy Link', 'adforest'),
            'options' => array(
                'search' => esc_html__('Search Page', 'adforest'),
                'category' => esc_html__('Category Page', 'adforest'),
            ),
            'default' => 'search'
        ),
        array(
            'id' => 'location_single_style',
            'type' => 'button_set',
            'desc' => __('choose ads location single page view', 'adforest'),
            'title' => __('Location Single Layout', 'adforest'),
            'options' => array(
                'grid' => 'Grid',
                'list' => 'List',
            ),
            'default' => 'grid',
        ),
        array(
            'id' => 'sb_2column_mobile_layout',
            'type' => 'switch',
            'title' => __('Mobile Grid 2 columns', 'adforest'),
            'default' => false,
            'desc' => __('Turn on/off 2 column layout on mobile devices.', 'adforest'),
        ),
        array(
            'id' => 'sb_optimize_img_switch',
            'type' => 'switch',
            'title' => __('Disable Optimizing images', 'adforest'),
            'default' => false,
            'subtitle' => __('only for ad detail page slider images', 'adforest'),
            'desc' => __('<b class="sb-admin-note">Note : </b> Enable this option if you want to show full size images uploaded by users on ad details page. To show full size image you must have to add the following css provided in this article.<a target="__blank" href="https://documentation.scriptsbundle.com/docs/faq/#10500"> Get Custom Style </a>', 'adforest'),
        ),
         array(
            'id' => 'sb_show_ad_id',
            'type' => 'switch',
            'title' => __('Show Ad ID on ad detail page', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'ad_slider_type',
            'type' => 'button_set',
            'title' => __('Images Slider Type', 'adforest'),
            'options' => array(
                '1' => 'With Thumbs',
                '2' => 'Without Thumbs',
            ),
           // 'required' => array('ad_layout_style', '=', array('1')),
            'default' => '1',
        ),

         array(
            'id' => 'sb_default_detail_img',
            'type' => 'switch',
            'title' => __('Default image on ad detail if not image uploded', 'adforest'),
            'default' => false,
        ),
      
         
          array(
            'id' => 'ad_features_cols',
            'type' => 'button_set',
            'title' => __('Ad Features Cols', 'adforest'),
            'options' => array(
                '12' => '1 Cols',
                '6' => '2 Cols',
                '4' => '3 Cols',
                '3' => '4 Cols',
            ),
            'default' => '4',
        ),

        array(
            'id' => 'Related_ads_on',
            'type' => 'switch',
            'title' => __('Related Ads', 'adforest'),
            'default' => true,
        ),
          array(
            'id' => 'related_ad_style',
            'type' => 'button_set',
            'title' => __('Related Ad Style', 'adforest'),
            'options' => array(
                '1' => 'Grid',
                '2' => 'List',
            ),
            'required' => array('Related_ads_on', '=', array(true)),
            'default' => '1'
        ),
        array(
            'id' => 'sb_single_ad_text',
            'type' => 'text',
            'title' => __('Single Ad Title', 'adforest'),
            'default' => 'Ad Detail',
        ),
        array(
            'id' => 'sb_link_text',
            'type' => 'text',
            'title' => __('Custom field link text', 'adforest'),
            'default' => 'View website',
        ),
        array(
            'id' => 'sb_related_ads_title',
            'type' => 'text',
            'title' => __('Related Ads Section Title', 'adforest'),
            'required' => array('Related_ads_on', '=', array(true)),
            'default' => 'Similiar Ads',
        ),
        array(
            'id' => 'max_ads',
            'type' => 'select',
            'title' => __('Max Related ads to show', 'adforest'),
            'required' => array('Related_ads_on', '=', array(true)),
            'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15),
            'default' => 5,
        ),
        array(
            'id' => 'tips_title',
            'type' => 'text',
            'title' => __('Tips Section Title', 'adforest'),
            'default' => 'Safety tips for deal',
        ),
        array(
            'id' => 'tips_for_ad',
            'type' => 'editor',
            'title' => __('Deal Tips', 'adforest'),
            'default' => '<ol>
                            <li>Use a safe location to meet seller</li>
                            <li>Avoid cash transactions</li>
                            <li>Beware of unrealistic offers</li>
                         </ol>',
            'args' => array(
                'wpautop' => false,
                'media_buttons' => false,
                'textarea_rows' => 5,
                'teeny' => false,
                'quicktags' => false,
            )
        ),
        array(
            'id' => 'owner_deal_text',
            'type' => 'editor',
            'title' => __('Owner Text', 'adforest'),
            'default' => '<p>Mention <a hraf="http://adforest.scriptsbundle.com">adforest.scriptsbundle.com</a> when calling seller to get a good deal<p>',
            'args' => array(
                'wpautop' => false,
                'media_buttons' => false,
                'textarea_rows' => 5,
                'teeny' => false,
                'quicktags' => false,
            )
        ),
        array(
            'id' => 'style_ad_720_1',
            'type' => 'textarea',
            'title' => __('Advertisement', 'adforest'),
            'subtitle' => __('720 x 90', 'adforest'),
            'desc' => __('Above the Ad description', 'adforest'),
            'default' => '<img src="' . trailingslashit(get_template_directory_uri()) . 'images/728x90.jpg" alt="' . esc_attr('image', 'adforest') . '"> ',
        ),
        array(
            'id' => 'style_ad_720_2',
            'type' => 'textarea',
            'title' => __('Advertisement', 'adforest'),
            'subtitle' => __('720 x 90', 'adforest'),
            'desc' => __('Below the Ad description', 'adforest'),
            'default' => '<img src="' . trailingslashit(get_template_directory_uri()) . 'images/728x90.jpg" alt="' . esc_attr('image', 'adforest') . '"> ',
        ),
        array(
            'id' => 'sb_ad_sold',
            'type' => 'media',
            'url' => true,
            'title' => __('Ad sold image', 'adforest'),
            'compiler' => 'true',
            'subtitle' => __('Dimensions: 700 x 423', 'adforest'),
            'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'images/sold-out.png'),
        ),
        array(
            'id' => 'sb_ad_expired',
            'type' => 'media',
            'url' => true,
            'title' => __('Ad expired image', 'adforest'),
            'compiler' => 'true',
            'subtitle' => __('Dimensions: 700 x 423', 'adforest'),
            'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'images/expired.png'),
        ),
    )
));

$featured_ads_layout = array(
    'grid_1' => 'Grid 1',
    'grid_2' => 'Grid 2',
    'grid_3' => 'Grid 3',
    'grid_4' => 'Grid 4',
    'grid_5' => 'Grid 5',
    'grid_6' => 'Grid 6',
    'grid_7' => 'Grid 7',
    'grid_8' => 'Grid 8',
    'grid_9' => 'Grid 9',
    'grid_10' => 'Grid 10',
    'grid_11' => 'Grid 11',
);
$search_styles = array(
    'grid_1' => 'Grid 1',
    'grid_2' => 'Grid 2',
    'grid_3' => 'Grid 3',
    'grid_4' => 'Grid 4',
    'grid_5' => 'Grid 5',
    'grid_6' => 'Grid 6',
    'grid_7' => 'Grid 7',
    'grid_8' => 'Grid 8',
    'grid_9' => 'Grid 9',
    'grid_10' => 'Grid 10',
    'grid_11' => 'Grid 11',
    'list_1' => 'List 1',
    'list_2' => 'List 2',
);

$taxonomy_single_styles = array(
    'grid_1' => 'Grid 1',
    'grid_2' => 'Grid 2',
    'grid_3' => 'Grid 3',
    'grid_4' => 'Grid 4',
    'grid_5' => 'Grid 5',
    'grid_6' => 'Grid 6',
    'grid_7' => 'Grid 7',
    'grid_8' => 'Grid 8',
    'grid_9' => 'Grid 9',
    'grid_10' => 'Grid 10',
    'grid_11' => 'Grid 11',
    'list_1' => 'List 1',
    'list_2' => 'List 2',
);

$grig_layout = array(
    'grid_1' => 'Grid 1',
    'grid_2' => 'Grid 2',
    'grid_3' => 'Grid 3',
    'grid_4' => 'Grid 4',
    'grid_5' => 'Grid 5',
    'grid_6' => 'Grid 6',
    'grid_7' => 'Grid 7',
    'grid_8' => 'Grid 8',
    'grid_9' => 'Grid 9',
    'grid_10' => 'Grid 10',
    'grid_11' => 'Grid 11',
);
Redux::setSection($opt_name, array(
    'title' => __('Search Settings', 'adforest'),
    'id' => 'ad_search_settings',
    'desc' => '',
    'icon' => 'el el-cogs',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sb_search_page',
            'type' => 'select',
            'data' => 'pages',
            'title' => __('Search Page', 'adforest'),
            'default' => '',
        ),
        array(
            'id' => 'search_popup_cat_disable',
            'type' => 'switch',
            'title' => __('Disable All Categories', 'adforest'),
            'subtitle' => __('Seach filter Categories', 'adforest'),
            'desc' => __('Enable this option to display only those categories who have atleast 1 ad in categories search popup.', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'search_popup_loc_disable',
            'type' => 'switch',
            'title' => __('Disable All Locations', 'adforest'),
            'subtitle' => __('Seach filter Locations', 'adforest'),
            'desc' => __('Enable this option to display only those locations who have atleast 1 ad in locations search popup.', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'display_taxonomies',
            'type' => 'button_set',
            'title' => __('Taxonomies Display Type', 'adforest'),
            'subtitle' => __('Categories/location load in search element fields.', 'adforest'),
            'desc' => __('Set taxonomies load in default way or hierarchical( parent-child relation format ) in search elements.', 'adforest'),
            'options' => array(
                'random' => 'Default',
                'hierarchical' => 'Hierarchical',
            ),
            'default' => 'random',
        ),
        array(
            'id' => 'featured_first',
            'type' => 'switch',
            'title' => __('Featured First', 'adforest'),
            'subtitle' => __('Dispaly ads in search page.', 'adforest'),
            'desc' => __('Enable this option to display featured ads at the first.', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'search_design',
            'type' => 'button_set',
            'title' => __('Search Layout', 'adforest'),
            'options' => array(
                'sidebar' => 'With sidebar',
                'topbar' => 'With Top Bar',
                'map' => 'With Map',
            ),
            'default' => 'sidebar',
        ),
        array(
            'id' => 'search_design_sidebar_mob_filter',
            'type' => 'switch',
            'title' => __('Enable Mobile Search Filters', 'adforest'),
            'desc' => __('Enable mobile search filters for the mobile devices to reduce the layout height in mobile devices.', 'adforest'),
            'default' => false,
            'required' => array(array('search_design', '=', array('sidebar'))),
        ),
        array(
            'id' => 'search_ad_layout_for_search',
            'type' => 'button_set',
            'title' => __('Search Layout', 'adforest'),
            'options' => array(
                'grid' => 'Grid',
                'list' => 'list',
            ),
            'default' => 'grid',
            'desc' => __('Default layout for search ads', 'adforest'),
        ),
        /* New OPtions Ends */
        array(
            'id' => 'search_layout_types',
            'type' => 'switch',
            'title' => __('Show Grid/List View', 'adforest'),
            'desc' => __('Show Grid/List View option on search page.', 'adforest'),
            'default' => false,
        ),
        
         array(
            'id' => 'hide_search_map',
            'type' => 'switch',
            'title' => __('Hide show map switcher on search page', 'adforest'),
            'default' => false,
             'required' => array(array('search_design', '=', array('map'))),
        ),
         array(
            'id' => 'hide_search_filters',
            'type' => 'switch',
            'title' => __('Hide show filters switcher on search page', 'adforest'),
            'default' => false,
              'required' => array(array('search_design', '=', array('map'))),
        ),
        array(
            'id' => 'search_ad_layout_for_sidebar',
            'type' => 'button_set',
            'title' => __('Search Layout', 'adforest'),
            'options' => $search_styles,
            'default' => 'grid_1',
        ),
          array(
            'id' => 'search_layout_types_list',
            'type' => 'button_set',
            'title' => __('Select List Layout', 'adforest'),
            'subtitle' => __('select layout for list option.', 'adforest'),
             'options' => array(
                'list_1' => 'List 1',
                'list_2' => 'Lst 2',
            ),
            'default' => 'list_1',
             'required' => array(array('search_layout_types', '=', true)),
          
        ),
             array(
            'id' => 'search_layout_types_grid',
            'type' => 'button_set',
            'title' => __('Select Grid Layout', 'adforest'),
            'subtitle' => __('select layout for grid option.', 'adforest'),
            'options' => $grig_layout,
            'default' => 'grid_1',
            'required' => array(array('search_layout_types', '=', true)),
        ),
        array(
            'id' => 'featured_ad_slider_layout',
            'type' => 'button_set',
            'title' => __('Featured Ads Layout', 'adforest'),
            'options' => $featured_ads_layout,
            'default' => 'grid_1',
            'required' => array('feature_on_search', '=', array(true)),
        ),
        /* New OPtions Ends */
        array(
            'id' => 'sb_radius_search',
            'type' => 'switch',
            'title' => __('Allowed radius search', 'adforest'),
            'required' => array(array('search_design', '=', array('map'))),
            'default' => true,
        ),
        array(
            'id' => 'sb_allow_cats_above_filters',
            'type' => 'switch',
            'title' => __('Allowed categories display on search filters. ', 'adforest'),

            'default' => false,
        ),
        array(
            'id' => 'sb_li_cols',
            'type' => 'button_set',
            'title' => __('Category cols', 'adforest'),
            'options' => array(
                '3' => '4 Cols',
                '4' => '3 Cols',
            ),
            'default' => '3',
            'required' => array(array('sb_allow_cats_above_filters', '=', true)),
        ),
        array(
            'id' => 'sb_max_sub_cats',
            'type' => 'select',
            'title' => __('Max sub-cats appear on load', 'adforest'),
             'required' => array(array('sb_allow_cats_above_filters', '=', true)),
            'options' => range(0, 100),
            'default' => 12,
        ),
        array(
            'id' => 'search_map_marker',
            'type' => 'media',
            'url' => true,
            'title' => __('Map marker', 'adforest'),
            'compiler' => 'true',
            'subtitle' => __('50x77', 'adforest'),
            'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'images/car-marker.png'),
            'required' => array('search_design', '=', array('map')),
        ),
        array(
            'id' => 'search_map_marker_more',
            'type' => 'media',
            'url' => true,
            'title' => __('Map marker more', 'adforest'),
            'compiler' => 'true',
            'subtitle' => __('50x77', 'adforest'),
            'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'images/car-marker-more.png'),
            'required' => array('search_design', '=', array('map')),
        ),
        array(
            'id' => 'search_map_lat',
            'type' => 'text',
            'title' => __('Default Latitude', 'adforest'),
            'required' => array('search_design', '=', array('map')),
            'default' => '39.739236',
        ),
        array(
            'id' => 'search_map_long',
            'type' => 'text',
            'title' => __('Default Longitude', 'adforest'),
            'required' => array('search_design', '=', array('map')),
            'default' => '-104.990251',
        ),
        array(
            'id' => 'search_map_zoom',
            'type' => 'select',
            'title' => __('Map', 'adforest'),
            'required' => array('search_design', '=', array('map')),
            'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15),
            'default' => 6,
        ),
        array(
            'id' => 'search_radius_type',
            'type' => 'button_set',
            'title' => __('Search Radius in', 'adforest'),
            'options' => array(
                'km' => 'Kilometer',
                'mile' => 'Miles',
            ),
            'default' => 'km',
            'subtitle' => __('Choose radius search type', 'adforest'),
        ),
        array(
            'id' => 'search_widget_limit',
            'type' => 'button_set',
            'title' => __('Default widgets show', 'adforest'),
            'options' => array(
                '200' => 'All',
                '3' => '3 Widgets',
                '6' => '6 Widgets',
                '9' => '9 Widgets',
            ),
            'default' => '6',
            'required' => array('search_design', '=', array('topbar', 'map')),
        ),
        array(
            'id' => 'feature_on_search',
            'type' => 'switch',
            'title' => __('Featured Ads', 'adforest'),
            'subtitle' => __('on search, location and category', 'adforest'),
            'default' => true,
        ),
        array(
            'id' => 'max_ads_feature',
            'type' => 'select',
            'title' => __('Max Featured ads to show', 'adforest'),
            'required' => array('feature_on_search', '=', array(true)),
            'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15),
            'default' => 5,
        ),
        array(
            'id' => 'feature_ads_title',
            'type' => 'text',
            'title' => __('Featured Ads Title', 'adforest'),
            'required' => array('feature_on_search', '=', array(true)),
            'default' => 'Featured Ads',
        ),
            /*Job alert*/
        
         array(
            'id' => 'sb_ad_alerts',
            'type' => 'switch',
            'title' => __('Category base ad alert ', 'adforest'),
            'desc' => __('Allow user to subscribe ad alerts for specific category','adforest'),
            'default' => false,
        ),        
        //   array(
        //     'id' => 'sb_ad_alerts_paid',
        //     'type' => 'switch',
        //     'title' => __('make ad alert paid', 'adforest'),
        //     'desc' => __('User have to pay to subscribe ad alerts , make category alert base package and assign it to a category','adforest'),
        //     'default' => false,
        // ),
        array(
            'id' => 'search_ad_720_1',
            'type' => 'textarea',
            'title' => __('Advertisement', 'adforest'),
            'subtitle' => __('720 x 90', 'adforest'),
            'desc' => __('Above the Ad description', 'adforest'),
            'default' => '<img src="' . trailingslashit(get_template_directory_uri()) . 'images/728x90.jpg" alt="' . esc_attr('image', 'adforest') . '"> ',
        ),
        array(
            'id' => 'search_ad_720_2',
            'type' => 'textarea',
            'title' => __('Advertisement', 'adforest'),
            'subtitle' => __('720 x 90', 'adforest'),
            'desc' => __('Below the Ad description', 'adforest'),
            'default' => '<img src="' . trailingslashit(get_template_directory_uri()) . 'images/728x90.jpg" alt="' . esc_attr('image', 'adforest') . '"> ',
        ),
        /*
         * 
         * Ad category Page
         * 
         */
        array(
            'id' => 'ad-category-start',
            'type' => 'section',
            'title' => __('Category Page', 'adforest'),
            'subtitle' => __('Set all settings of ad category page.', 'adforest'),
            'indent' => true
        ),

        array(
            'id' => 'display_cat_desc',
            'type' => 'switch',
            'subtitle' => __('At the top of the Category page.', 'adforest'),
            'title' => __('Display Category Description', 'adforest'),
            'desc' => __('Enable this to display ad category description.', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'texonomy_single_style',
            'type' => 'button_set',
            'desc' => __('choose ads category single page view', 'adforest'),
            'title' => __('Taxonomy Single Layout', 'adforest'),
            'options' => $taxonomy_single_styles,
            'default' => 'grid_1',
        ),
        array(
            'id' => 'search_cat_page',
            'type' => 'switch',
            'title' => __('Category Page Search', 'adforest'),
            'subtitle' => __('Enable Search Filters for category page.', 'adforest'),
            'desc' => __('<span class="sb-admin-note"><b>Note : </b></span>After Enabling please add widgets in the <b>"Category Search"</b> sidebar.', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'cat_sidebar_position',
            'type' => 'button_set',
            'title' => __('Search Filter Position', 'adforest'),
            'desc' => __('Set sidebar positon.', 'adforest'),
            'options' => array(
                'left' => __('Left Sidebar', 'adforest'),
                'right' => __('Right Sidebar', 'adforest'),
            ),
            'default' => 'left',
            'required' => array('search_cat_page', '=', array(true)),
        ),
        array(
            'id' => 'ad-category-end',
            'type' => 'section',
            'indent' => false,
        ),
        
        /*
         * 
         * Ad Location Page
         * 
         */
        array(
            'id' => 'ad-location-start',
            'type' => 'section',
            'title' => __('Location Page', 'adforest'),
            'subtitle' => __('Set all settings of ad location page.', 'adforest'),
            'indent' => true
        ),
        array(
            'id' => 'location_single_style',
            'type' => 'button_set',
            'desc' => __('choose ads location single page view', 'adforest'),
            'title' => __('Location Single Layout', 'adforest'),
            'options' => $taxonomy_single_styles,
            'default' => 'grid_1',
        ),
        array(
            'id' => 'search_location_page',
            'type' => 'switch',
            'title' => __('Location Page Search', 'adforest'),
            'subtitle' => __('Enable Search Filters for location page.', 'adforest'),
            'desc' => __('<span class="sb-admin-note"><b>Note : </b></span>After Enabling please add widgets in the <b>"Location Search"</b> sidebar.', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'location_sidebar_position',
            'type' => 'button_set',
            'title' => __('Search Filter Position', 'adforest'),
            'desc' => __('Set sidebar positon.', 'adforest'),
            'options' => array(
                'left' => __('Left Sidebar', 'adforest'),
                'right' => __('Right Sidebar', 'adforest'),
            ),
            'default' => 'left',
            'required' => array('search_location_page', '=', array(true)),
        ),
        array(
            'id' => 'ad-location-end',
            'type' => 'section',
            'indent' => false,
        ),
        
        
        
        
        
        
    )
));

Redux::setSection($opt_name, array(
    'title' => __('Ad Rating Settings', 'adforest'),
    'id' => 'sb_ad_rating_settings',
    'desc' => '',
    'icon' => 'el el-cogs',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sb_ad_rating',
            'type' => 'switch',
            'title' => __('Rating on ad', 'adforest'),
            'default' => false,
        ),
         array(
            'id' => 'sb_ad_rating_start',
            'type' => 'switch',
            'title' => __('Rating stars on ad', 'adforest'),
              'required' => array('sb_ad_rating', '=', array(true)),
            'default' => true,
        ),
        array(
            'id' => 'sb_update_rating',
            'type' => 'switch',
            'title' => __('Allow update the rating', 'adforest'),
            'required' => array('sb_ad_rating', '=', array(true)),
            'default' => false,
        ),
            array(
            'id' => 'ads_rewiew_delete',
            'type' => 'switch',
            'title' => __('Ads Review Delete Option', 'adforest'),
            'required' => array('sb_ad_rating', '=', array(true)),
            'default' => false,
        ),

        array(
            'id' => 'sb_ad_rating_title',
            'type' => 'text',
            'title' => __('Rating section title', 'adforest'),
            'required' => array('sb_ad_rating', '=', array(true)),
            'default' => 'Rating & Reviews',
        ),
        array(
            'id' => 'sb_rating_email_author',
            'type' => 'switch',
            'title' => __('Email to Author on rating', 'adforest'),
            'required' => array('sb_ad_rating', '=', array(true)),
            'default' => false,
        ),
        array(
            'id' => 'sb_rating_reply_email',
            'type' => 'switch',
            'title' => __('Author reply email to rator', 'adforest'),
            'required' => array('sb_ad_rating', '=', array(true)),
            'default' => false,
        ),
        array(
            'id' => 'sb_rating_max',
            'type' => 'spinner',
            'title' => __('Rating show at most', 'adforest'),
            'required' => array('sb_ad_rating', '=', array(true)),
            'default' => '5',
            'min' => '1',
            'step' => '1',
            'max' => '50',
        ),
        array(
            'id' => 'adforest_listing_review_enable_emoji',
            'type' => 'switch',
            'title' => __('Ads Rating Emojies', 'adforest'),
            'required' => array('sb_ad_rating', '=', array(true)),
            'default' => false,
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => __('Messaging Setting', 'adforest'),
    'id' => 'sb_ad_messaging_settings',
    'desc' => '',
    'icon' => 'el el-cogs',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sb_message_delay_time',
            'type' => 'text',
            'title' => __('Next add message delay time in Second', 'adforest'),
            'default' => '10',
        ),
        array(
            'id' => 'allow_media_upload_messaging',
            'type' => 'switch',
            'title' => __('Media upload on messaging', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'sb_media_upload_messaging_type',
            'required' => array('allow_media_upload_messaging', '=', array('1')),
            'type' => 'button_set',
            'title' => __('Media upload on messaging', 'adforest'),
            'options' => array(
                'images' => __('Images', 'adforest'),
                'attachments' => __('Attachment', 'adforest'),
                'both' => __('both', 'adforest')
            ),
            'default' => 'both',
        ),
        array(
            'required' => array('allow_media_upload_messaging', '=', array('1')),
            'id' => 'sb_media_image_size',
            'type' => 'select',
            'title' => esc_html__('Attachment size', 'adforest'),
            'options' => array('307200-300kb' => '300kb', '614400-600kb' => '600kb', '819200-800kb' => '800kb', '1048576-1MB' => '1MB', '2097152-2MB' => '2MB', '3145728-3MB' => '3MB', '4194304-4MB' => '4MB', '5242880-5MB' => '5MB'),
            'default' => '819200-800kb',
        ),
        array(
            'required' => array('allow_media_upload_messaging', '=', array('1')),
            'id' => 'sb_media_attachment_limit',
            'type' => 'select',
            'title' => esc_html__('Number of attachments to send', 'adforest'),
            'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10),
            'default' => '1',
        ),
        $fields = array(
    'required' => array('sb_media_upload_messaging_type', '=', array('attachments', 'both')),
    'id' => 'sb_message_attach_formats',
    'type' => 'button_set',
    'title' => __('Select attachments formats', 'adforest'),
    'desc' => __('You can select multiple file formats', 'adforest'),
    'multi' => true,
    //Must provide key => value pairs for options
    'options' => array(
        'pdf' => __('Pdf', 'adforest'),
        'doc' => __('Doc', 'adforest'),
        'docx' => __('Docx', 'adforest'),
        'txt' => __('Txt', 'adforest'),
        'zip' => __('zip', 'adforest')
    ),
    'default' => array('pdf', 'doc'),
        ),
        array(
            'id' => 'sb_ad_whatsapp_chat',
            'type' => 'switch',
            'title' => esc_html__('Allow Whatsapp chat on ad detail page', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'sb_ad_whizchat_chat',
            'type' => 'switch',
            'title' => esc_html__('Allow Whizchat  chat on ad detail page', 'adforest'),
            'desc' => esc_html__('Turn on this option only if you have whizchat plugin', 'adforest'),
            'default' => false,
        ),
    )
        )
);






Redux::setSection($opt_name, array(
    'title' => __('Claim settings', 'adforest'),
    'id' => 'sb_ad_claim_settings',
    'desc' => '',
    'icon' => 'el el-cogs',
    'subsection' => true,
    'fields' => array(
      
        array(
            'id' => 'allow_claim',
            'type' => 'switch',
            'title' => __('Allow claim on ad detail page', 'adforest'),
            'default' => false,
        ),
          array(
            'id' => 'is_claim_paid',
            'type' => 'switch',
            'title' => __('make claim paid , user have to buy package to claim on ad', 'adforest'),
            'default' => false,
            'required' => array('allow_claim', '=', array('1')),
        ),

        array(
            'id' => 'sb_listing_is_admin_email',
            'type' => 'switch',
            'title' => esc_html__('Email To Admin when someone claim on ad', 'adforest'),
           'required' => array('allow_claim', '=', array('1')),
            'default' => false,
        ),
        array(
            'id' => 'sb_listing_claim_from',
            'type' => 'text',
            'title' => esc_html__('Listing Claim Email FROM', 'adforest'),
            'desc' => esc_html__('FROM: NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
            'default' => 'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
             'required' => array('sb_listing_is_admin_email', '=', array('1')),
        ),
                
          array(
            'id' => 'sb_listing_subject',
            'type' => 'text',
            'title' => esc_html__('Listing Claim', 'adforest'),
            'desc' => '%site_name% , %ad_title% will be translated accordingly.',
            'default' => 'Listing Claim - Adforest Listing',
               'required' => array('sb_listing_is_admin_email', '=', array('1')),
        ),
        array(
            'id' => 'sb_listing_claim_message',
            'type' => 'editor',
            'title' => esc_html__('Listing Claim Template', 'adforest'),
             'required' => array('sb_listing_is_admin_email', '=', array('1')),
            'args' => array(
                'teeny' => true,
                'textarea_rows' => 10,
                'wpautop' => false,
            ),
            'desc' => '%site_name% , %ad_owner% , %ad_title% , %ad_link% , %claimed_by% , %claimer_email% , %claimer_contact% ,  %claim_details%, will be translated accordingly.',
            'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff">

A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>Admin,</b></span></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Below Listing is claimed.</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Title: %ad_title%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Link: <a href="%ad_link%">%ad_title%</a></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Listing Poster: %ad_owner%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Claimed By: %claimed_by%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Claimer Email: %claimer_email%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Claimer Contact No: %claimer_contact%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Claim Details: %claim_details%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>

<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td>
</tr>
</tbody>
</table>
</div>
&nbsp;

</div></td>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
</tr>
</tbody>
</table>
&nbsp;',
        ),
        
        
        
        
          array(
            'id' => 'sb_claim_change',
            'type' => 'text',
            'title' => esc_html__('Claim Listing Ownership Change', 'adforest'),
            'desc' => '%site_name% , %ad_title% will be translated accordingly.',
            'default' => 'Listing Claim Ownership Change - DWT Listing',
        ),
        array(
            'id' => 'sb_claim_change_from',
            'type' => 'text',
            'title' => esc_html__('Listing Ownership Chnage FROM', 'adforest'),
            'desc' => esc_html__('FROM: NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
            'default' => 'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        ),
        array(
            'id' => 'sb_claim_change_message',
            'type' => 'editor',
            'title' => esc_html__('Listing Ownership Change Template', 'adforest'),
            'args' => array(
                'teeny' => true,
                'textarea_rows' => 10,
                'wpautop' => false,
            ),
            'desc' => '%site_name% , %ad_owner% , %ad_title% , %ad_link% will be translated accordingly.', 'adforest',
            'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff">
A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"> <b>%ad_owner%,</b></span></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Ownership of your listing has been claimed.</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><b>Listing Title:</b> %ad_title%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><b>Listing Link:</b> <a href="%ad_link%">%ad_title%</a></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Due to some claims your listing ownership has been changed. For furthur information contact site admin.</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>

<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td>
</tr>
</tbody>
</table>
</div>
&nbsp;

</div></td>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
</tr>
</tbody>
</table>
&nbsp;',
        ),
        array(
            'id' => 'sb_claim_approved_change',
            'type' => 'text',
            'title' => esc_html__('Claim Listing Ownership Approved', 'adforest'),
            'desc' => '%site_name% , %ad_title% will be translated accordingly.',
            'default' => 'Listing Claim Ownership Approved - DWT Listing',
        ),
        array(
            'id' => 'sb_claim_change_approved_from',
            'type' => 'text',
            'title' => esc_html__('Listing Ownership Approved FROM', 'adforest'),
            'desc' => esc_html__('FROM: NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
            'default' => 'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        ),
        array(
            'id' => 'sb_claim_change_approved_message',
            'type' => 'editor',
            'title' => esc_html__('Listing Ownership Approved Template', 'adforest'),
            'args' => array(
                'teeny' => true,
                'textarea_rows' => 10,
                'wpautop' => false,
            ),
            'desc' => '%site_name% , %ad_owner% , %ad_title% , %ad_link% will be translated accordingly.',
            'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff">
A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"> <b>%ad_owner%,</b></span></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Congratulations! You have won the claim.</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Listing Title: %ad_title%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Listing Link: <a href="%ad_link%">%ad_title%</a></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Ownership of listing has been transferred  to you. For further  information contact site admin.</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>

<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td>
</tr>
</tbody>
</table>
</div>
&nbsp;

</div></td>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
</tr>
</tbody>
</table>
&nbsp;',
        ),
        array(
            'id' => 'sb_claim_decline_change',
            'type' => 'text',
            'title' => esc_html__('Claim Listing Decline Notification', 'adforest'),
            'desc' => '%site_name% , %ad_title% will be translated accordingly.',
            'default' => 'Listing Claim Declined - DWT Listing',
        ),
        array(
            'id' => 'sb_claim_change_decline_from',
            'type' => 'text',
            'title' => esc_html__('Listing Claim Declined FROM', 'adforest'),
            'desc' => esc_html__('FROM: NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
            'default' => 'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        ),
        array(
            'id' => 'sb_claim_change_decline_message',
            'type' => 'editor',
            'title' => esc_html__('Listing Decline Template', 'adforest'),
            'args' => array(
                'teeny' => true,
                'textarea_rows' => 10,
                'wpautop' => false,
            ),
            'desc' => '%site_name% , %claimer_name% , %ad_title% , %ad_link% will be translated accordingly.',
            'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff">

A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"> <b>%claimer_name%,</b></span></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Unfortunately! your claim has been declined.</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Claimed Listing Title: %ad_title%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Claimed Listing Link: <a href="%ad_link%">%ad_title%</a></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">your claim has been declined.For further  information contact site admin.</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>

<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td>
</tr>
</tbody>
</table>
</div>
&nbsp;

</div></td>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
</tr>
</tbody>
</table>
&nbsp;',
        ),
    )
)
);

$events_options = apply_filters('events_options', array());
$listing_options = apply_filters('sb_listings_options', array());

Redux::setSection($opt_name, $listing_options);
Redux::setSection($opt_name, $events_options);





/* ------------------Email Templates Settings ----------------------- */
Redux::setSection($opt_name, array(
    'title' => __('Email Templates', 'adforest'),
    'id' => 'sb_email_templates',
    'desc' => '',
    'icon' => 'el el-pencil',
    'fields' => array(
    )
));

Redux::setSection($opt_name, array(
    'title' => __('New Ad Email', 'adforest'),
    'id' => 'sb_email_templates1',
    'desc' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sb_msg_subject_on_new_ad',
            'type' => 'text',
            'title' => __('New Ad email subject', 'adforest'),
            'desc' => '%site_name% , %ad_owner% , %ad_title% will be translated accordingly.',
            'default' => 'You have new Ad - Adforest',
        ),
        array(
            'id' => 'sb_msg_from_on_new_ad',
            'type' => 'text',
            'title' => __('New Ad FROM', 'adforest'),
            'desc' => __('FROM: NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
            'default' => 'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        ),
        array(
            'id' => 'sb_msg_on_new_ad',
            'type' => 'editor',
            'title' => __('New Ad Posted Message', 'adforest'),
            'args' => array(
                'teeny' => true,
                'textarea_rows' => 10,
                'wpautop' => false,
            ),
            'desc' => '%site_name% , %ad_owner% , %ad_title% , %ad_link% will be translated accordingly.', 
            'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/SB-logo.png" width="80" height="80" alt="image"/><br/>
A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>Admin,</b></span></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">You\'ve new AD;</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Title: %ad_title%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Link: <a href="%ad_link%">%ad_title%</a></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Poster: %ad_owner%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p></td></tr></tbody></table></td></tr></tbody></table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td></tr></tbody></table></div>&nbsp;</div></td><td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td></tr></tbody></table>&nbsp;',
        ),
    )
));
Redux::setSection($opt_name, array(
    'title' => __('New Message Email', 'adforest'),
    'id' => 'sb_email_templates2',
    'desc' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sb_message_subject_on_new_ad',
            'type' => 'text',
            'title' => __('New Message email subject', 'adforest'),
            'desc' => '%site_name% , %ad_title% will be translated accordingly.',
            'default' => 'You have new message - Adforest',
        ),
        array(
            'id' => 'sb_message_from_on_new_ad',
            'type' => 'text',
            'title' => __('New Message FROM', 'adforest'),
            'desc' => __('FROM: NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
            'default' => 'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        ),
        array(
            'id' => 'sb_message_on_new_ad',
            'type' => 'editor',
            'title' => __('New Message template', 'adforest'),
            'args' => array(
                'teeny' => true,
                'textarea_rows' => 10,
                'wpautop' => false,
            ),
            'desc' => '%site_name% , %message% , %sender_name%, %sender_email% , %ad_title% , %ad_link% will be translated accordingly.',
            'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/SB-logo.png" width="80" height="80"  alt="image" />
<br/>A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>Admin,</b></span></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">You\'ve new Message;</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Title: %ad_title%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Link: <a href="%ad_link%">%ad_title%</a></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Sender: %sender_name%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Message: %message%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p></td></tr></tbody></table></td></tr></tbody></table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td></tr></tbody></table></div>&nbsp;</div></td><td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td></tr></tbody></table>&nbsp;',
        ),
    )
));
Redux::setSection($opt_name, array(
    'title' => __('Ad Report Email', 'adforest'),
    'id' => 'sb_email_templates3',
    'desc' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sb_report_ad_subject',
            'type' => 'text',
            'title' => __('Ad report email subject', 'adforest'),
            'desc' => '%site_name% , %ad_title% will be translated accordingly.',
            'default' => 'Ad Reported - Adforest',
        ),
        array(
            'id' => 'sb_report_ad_from',
            'type' => 'text',
            'title' => __('Ad report email FROM', 'adforest'),
            'desc' => __('FROM: NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
            'default' => 'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        ),
        array(
            'id' => 'sb_report_ad_message',
            'type' => 'editor',
            'title' => __('Ad Report template', 'adforest'),
            'args' => array(
                'teeny' => true,
                'textarea_rows' => 10,
                'wpautop' => false,
            ),
            'desc' => '%site_name% , %ad_owner% , %ad_title% , %ad_link%, %ad_report_option% will be translated accordingly.',
            'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/SB-logo.png" width="80" height="80"  alt="image"/>

A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>Admin,</b></span></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Below Ad is reported.</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Title: %ad_title%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Link: <a href="%ad_link%">%ad_title%</a></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Ad Poster: %ad_owner%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p></td></tr></tbody></table></td></tr></tbody></table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td></tr></tbody></table></div>&nbsp;</div></td><td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td></tr></tbody></table>&nbsp;',
        ),
    )
));
Redux::setSection($opt_name, array(
    'title' => __('Reset Password Email', 'adforest'),
    'id' => 'sb_email_templates4',
    'desc' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sb_forgot_password_subject',
            'type' => 'text',
            'title' => __('Reset Password email subject', 'adforest'),
            'desc' => '%site_name% will be translated accordingly.',
            'default' => 'Reset Password - Adforest',
        ),
        array(
            'id' => 'sb_forgot_password_from',
            'type' => 'text',
            'title' => __('Reset Password email FROM', 'adforest'),
            'desc' => __('FROM: NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
            'default' => get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        ),
        array(
            'id' => 'sb_forgot_password_message',
            'type' => 'editor',
            'title' => __('Reset Password template', 'adforest'),
            'args' => array(
                'teeny' => true,
                'textarea_rows' => 10,
                'wpautop' => false,
            ),
            'desc' => '%site_name% , %user% , %reset_link% will be translated accordingly.',
            'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/SB-logo.png" width="80" height="80"  alt="image"/>

A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello %user%</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>,</b></span></p>
Please use this below link to reset your password.
<br />
%reset_link%
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p></td></tr></tbody></table></td></tr></tbody></table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td></tr></tbody></table></div>&nbsp;</div></td><td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td></tr></tbody></table>&nbsp;',
        ),
    )
));
Redux::setSection($opt_name, array(
    'title' => __('New Profile Rating Email', 'adforest'),
    'id' => 'sb_email_templates5',
    'desc' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sb_new_rating_subject',
            'type' => 'text',
            'title' => __('Rating email subject', 'adforest'),
            'desc' => '%site_name% will be translated accordingly.',
            'default' => 'New Rating - Adforest',
        ),
        array(
            'id' => 'sb_new_rating_from',
            'type' => 'text',
            'title' => __('New rating email FROM', 'adforest'),
            'desc' => __('FROM: NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
            'default' => 'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        ),
        array(
            'id' => 'sb_new_rating_message',
            'type' => 'editor',
            'title' => __('New rating template', 'adforest'),
            'args' => array(
                'teeny' => true,
                'textarea_rows' => 10,
                'wpautop' => false,
            ),
            'desc' => '%site_name% , %receiver% , %rator% , %rating% , %comments% , %rating_link% will be translated accordingly.',
            'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/SB-logo.png" width="80" height="80"  alt="image"/>

A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello %receiver%</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>,</b></span></p>
You got new rating;

User who rated: %rator%

Stars: %rating%

Link: %rating_link%

Comments: %comments%
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p></td></tr></tbody></table></td></tr></tbody></table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td>
</tr></tbody></table></div>&nbsp;</div></td><td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td></tr></tbody></table>&nbsp;',
        ),
    )
));
Redux::setSection($opt_name, array(
    'title' => __('New Bid Email', 'adforest'),
    'id' => 'sb_email_templates6',
    'desc' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sb_new_bid_subject',
            'type' => 'text',
            'title' => __('Bid email subject', 'adforest'),
            'desc' => '%site_name% will be translated accordingly.',
            'default' => 'New Bid - Adforest',
        ),
        array(
            'id' => 'sb_new_bid_from',
            'type' => 'text',
            'title' => __('Bid email FROM', 'adforest'),
            'args' => array(
                'teeny' => true,
                'textarea_rows' => 10,
                'wpautop' => false,
            ),
            'desc' => __('FROM: NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
            'default' => 'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        ),
        array(
            'id' => 'sb_new_bid_message',
            'type' => 'editor',
            'title' => __('Bid email template', 'adforest'),
            'desc' => '%site_name% , %receiver% , %bidder% , %bid% , %comments% , %bid_link% will be translated accordingly.',
            'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/SB-logo.png" width="80" height="80"  alt="image" />

A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello %receiver%</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>,</b></span></p>
You got new Bid;

Bidder: %bidder%

Bid: %bid%

Link: %bid_link%

Comments: %comments%
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p></td></tr></tbody></table></td></tr></tbody></table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td></tr></tbody></table></div>&nbsp;</div></td><td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td></tr></tbody></table>&nbsp;',
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => __('New User Registration Email', 'adforest'),
    'id' => 'sb_email_templates7',
    'desc' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sb_new_user_admin_message_subject',
            'type' => 'text',
            'title' => __('New user email template subject for Admin', 'adforest'),
            'default' => 'New User Registration',
        ),
        array(
            'id' => 'sb_new_user_admin_message_from',
            'type' => 'text',
            'title' => __('New user email FROM for Admin', 'adforest'),
            'desc' => __('NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
            'default' => get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        ),
        array(
            'id' => 'sb_new_user_admin_message',
            'type' => 'editor',
            'title' => __('New user email template for Admin', 'adforest'),
            'args' => array(
                'teeny' => true,
                'textarea_rows' => 10,
                'wpautop' => false,
            ),
            'desc' => '%site_name% , %display_name%, %email% will be translated accordingly.',
            'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/SB-logo.png" width="80" height="80"  alt="image"/>

A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello Admin</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>,</b></span></p>
New user has registered on your site %site_name%;

Name: %display_name%

Email: %email%

&nbsp;
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p></td></tr></tbody></table></td></tr></tbody></table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td></tr></tbody></table></div>&nbsp;</div></td><td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td></tr></tbody></table>&nbsp;',
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => __('User account confirmation email', 'adforest'),
    'id' => 'sb_email_user_confirmation',
    'desc' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sb_new_user_account_confirmation_subject',
            'type' => 'text',
            'title' => __('New user email template subject', 'adforest'),
            'default' => 'New User Account confirmation Confirmation',
        ),
        array(
            'id' => 'sb_new_user_account_message_from',
            'type' => 'text',
            'title' => __('New user email FROM for Admin', 'adforest'),
            'desc' => __('NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
            'default' => get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        ),
        array(
            'id' => 'sb_new_user_account_confirmation_message',
            'type' => 'editor',
            'title' => __('New user email template for user', 'adforest'),
            'args' => array(
                'teeny' => true,
                'textarea_rows' => 10,
                'wpautop' => false,
            ),
            'desc' => '%site_name% , %display_name%, %email% will be translated accordingly.',
            'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"> </td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/SB-logo.png" alt="image" width="80" height="80" /> A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello %display_name%</span></p>
<p>Your account has been verified on site %site_name%;  You can log in now</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td>
</tr>
</tbody>
</table>
</div>
 </div>
</td>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"> </td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>'
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => __('User Welcome/Confirmation Email', 'adforest'),
    'id' => 'sb_email_templates8',
    'desc' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sb_new_user_message_subject',
            'type' => 'text',
            'title' => __('New user email template subject', 'adforest'),
            'default' => 'New User Registration',
        ),
        array(
            'id' => 'sb_new_user_message_from',
            'type' => 'text',
            'title' => __('New user email FROM', 'adforest'),
            'desc' => __('NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
            'default' => get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        ),
        array(
            'id' => 'sb_new_user_message',
            'type' => 'editor',
            'title' => __('New user email template', 'adforest'),
            'args' => array(
                'teeny' => true,
                'textarea_rows' => 10,
                'wpautop' => false,
            ),
            'desc' => '%site_name% , %user_name% %display_name% %verification_link% will be translated accordingly.',
            'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/SB-logo.png" width="80" height="80"  alt="image" />

A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello %display_name%</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>,</b></span></p>
Welcome to %site_name%.
<br />
Your details are below;
<br />

Username: %user_name%
<br />


&nbsp;
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p>
</td></tr></tbody></table></td></tr></tbody></table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td></tr></tbody></table></div>&nbsp;</div></td><td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td></tr></tbody></table>&nbsp;',
        ),
    )
));
Redux::setSection($opt_name, array(
    'title' => __('Ad Activation Email', 'adforest'),
    'id' => 'sb_email_templates9',
    'desc' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sb_active_ad_email_subject',
            'type' => 'text',
            'title' => __('Ad activation subject', 'adforest'),
            'default' => 'You Ad has been activated.',
        ),
        array(
            'id' => 'sb_active_ad_email_from',
            'type' => 'text',
            'title' => __('Ad activation FROM', 'adforest'),
            'desc' => __('NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
            'default' => get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        ),
        array(
            'id' => 'sb_active_ad_email_message',
            'type' => 'editor',
            'title' => __('Ad activation message', 'adforest'),
            'args' => array(
                'teeny' => true,
                'textarea_rows' => 10,
                'wpautop' => false,
            ),
            'desc' => '%site_name% , %user_name%, %ad_title% ,  %ad_link% will be translated accordingly.', 
            'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/SB-logo.png" width="80" height="80"  alt="image" />

A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello %user_name%</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>,</b></span></p>
<br />
You ad has been activated.
<br />
Details are below;
<br />

Ad Title: %ad_title%
<br />
Ad Link: %ad_link%
<br />


&nbsp;
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p></td></tr></tbody></table></td></tr></tbody></table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td>
</tr></tbody></table></div>&nbsp;</div></td><td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td></tr></tbody></table>&nbsp;',
        ),
    )
));
Redux::setSection($opt_name, array(
    'title' => __('New Ads Rating Email', 'adforest'),
    'id' => 'sb_email_templates10',
    'desc' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'ad_rating_email_subject',
            'type' => 'text',
            'title' => __('Rating email subject', 'adforest'),
            'default' => 'You have a new rating',
        ),
        array(
            'id' => 'ad_rating_email_from',
            'type' => 'text',
            'title' => __('Rating FROM', 'adforest'),
            'desc' => __('NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
            'default' => get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        ),
        array(
            'id' => 'ad_rating_email_message',
            'type' => 'editor',
            'title' => __('Rating message', 'adforest'),
            'args' => array(
                'teeny' => true,
                'textarea_rows' => 10,
                'wpautop' => false,
            ),
            'desc' => '%site_name%, %ad_title%, %ad_link%, %rating, %rating_comments%, %author_name%  will be translated accordingly.',
            'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/SB-logo.png" width="80" height="80"  alt="image" />

A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello %author_name%</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>,</b></span></p>
<br />
You have new rating, details are below;
<br />

Rating: %rating%
<br />
Comments: %rating_comments%
<br />
Ad Title: %ad_title%
<br />
Ad Link: %ad_link%
<br />


&nbsp;
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p></td></tr></tbody></table></td></tr></tbody></table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td></tr></tbody></table></div>&nbsp;</div></td><td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td></tr></tbody></table>&nbsp;',
        ),
    )
));
Redux::setSection($opt_name, array(
    'title' => __('Rating Reply Email', 'adforest'),
    'id' => 'sb_email_templates11',
    'desc' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'ad_rating_reply_email_subject',
            'type' => 'text',
            'title' => __('Rating reply email subject', 'adforest'),
            'default' => 'You got a reply on your rating',
        ),
        array(
            'id' => 'ad_rating_reply_email_from',
            'type' => 'text',
            'title' => __('Rating reply FROM', 'adforest'),
            'desc' => __('NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
            'default' => get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        ),
        array(
            'id' => 'ad_rating_reply_email_message',
            'type' => 'editor',
            'title' => __('Rating reply message', 'adforest'),
            'args' => array(
                'teeny' => true,
                'textarea_rows' => 10,
                'wpautop' => false,
            ),
            'desc' => '%site_name%, %ad_title%, %ad_link%, %rating%, %rating_comments%, %author_name%, %author_reply%  will be translated accordingly.',
            'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/SB-logo.png" width="80" height="80"  alt="image" />

A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello,</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>,</b></span></p>
<br />
You have reply on your rating, details are below;
<br />

Ad Title: %ad_title%
<br />
Ad Link: %ad_link%
<br />
Ad Author: %author_name%
<br />
Author reply: %author_reply%

<br />
Your given rating: %rating%
<br />
Your comments: %rating_comments%
<br />


&nbsp;
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p></td></tr></tbody></table></td></tr></tbody></table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td></tr></tbody></table></div>&nbsp;</div></td><td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td></tr></tbody></table>&nbsp;',
        ),
    )
));
Redux::setSection($opt_name, array(
    'title' => __('Contact From Profile', 'adforest'),
    'id' => 'sb_email_templates12',
    'desc' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sb_profile_contact_subject',
            'type' => 'text',
            'title' => __('Contact form SUBJECT', 'adforest'),
            'default' => 'Get message from Adforest profile.',
        ),
        array(
            'id' => 'sb_profile_contact_from',
            'type' => 'text',
            'title' => __('Contact form FROM', 'adforest'),
            'desc' => __('NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
            'default' => get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        ),
        array(
            'id' => 'sb_profile_contact_message',
            'type' => 'editor',
            'title' => __('Contact form MESSAGE', 'adforest'),
            'args' => array(
                'teeny' => true,
                'textarea_rows' => 10,
                'wpautop' => false,
            ),
            'desc' => __('%receiver_name%, %sender_name%, %sender_email%, %sender_subject%, %sender_message%, %author_name%, %author_reply%  will be translated accordingly.', 'adforest'),
            'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff">

A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello %receiver_name%</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>,</b></span></p>
<br />
You have received a new message from adforest, details are below;
<br />

Subject: %sender_subject%
<br />
Sender Name: %sender_name%
<br />
Sender Email: %sender_email%
<br />
Message: %sender_message%
<br />

&nbsp;
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p>
</td></tr></tbody></table></td></tr></tbody></table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td></tr></tbody></table></div>&nbsp;</div></td><td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td></tr></tbody></table>&nbsp;',
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => __('Ad Rejection ', 'adforest'),
    'id' => 'sb_email_templates13',
    'desc' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sb_ad_rejection_subject',
            'type' => 'text',
            'title' => __('Ad Rejection SUBJECT', 'adforest'),
            'default' => 'Get message from Adforest profile.',
        ),
        array(
            'id' => 'sb_ad_rejection_from',
            'type' => 'text',
            'title' => __('Ad Rejection FROM', 'adforest'),
            'desc' => __('NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
            'default' => get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        ),
        array(
            'id' => 'sb_ad_rejection_msg',
            'type' => 'editor',
            'title' => __('Ad Rejection MESSAGE', 'adforest'),
            'args' => array(
                'teeny' => true,
                'textarea_rows' => 10,
                'wpautop' => false,
            ),
            'desc' => '%site_name% , %ad_author% , %ad_title% , %ad_link% , %reject_reason% will be translated accordingly.',
            'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff">

A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello %ad_author%</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>,</b></span></p>
<br />
Your Ad %ad_title% is rejected due to following reason : 
<br />
%reject_reason%
&nbsp;
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p>
</td>
</tr></tbody></table></td></tr></tbody></table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td>
</tr></tbody></table></div>&nbsp;
</div></td><td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td></tr></tbody></table>&nbsp;',
        ),
    )
));
Redux::setSection($opt_name, array(
    'title' => __('Email Ads alerts', "adforest"),
    'id' => 'sb_email_job_alerts',
    'desc' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sb_email_job_alerts_subj',
            'type' => 'text',
            'title' => __('Email Subject', 'adforest'),
            'default' => __('Job For You', 'adforest'),
        ),
        array(
            'id' => 'sb_email_job_alerts_from',
            'type' => 'text',
            'title' => __('New user email FROM for Admin', 'adforest'),
            'desc' => __('NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
            'default' => get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        ),
        array(
            'id' => 'sb_email_job_alerts_body',
            'type' => 'editor',
            'title' => __('Ads alerts email template', 'adforest'),
            'args' => array(
                'teeny' => true,
                'textarea_rows' => 10,
                'wpautop' => false,
            ),
            'desc' => '%site_name% , %ad_title%, %ad_link% will be translated accordingly.',
            'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff">

A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>,</b></span></p>
<p>Job Title: %job_title% </p>

<p>Job Link: %job_link% </p>


&nbsp;
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td>
</tr>
</tbody>
</table>
</div>
&nbsp;

</div></td>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
</tr>
</tbody>
</table>
&nbsp;',
        ),
    )
));



Redux::setSection($opt_name, array(
    'title' => __('Welcome Social Login', 'adforest'),
    'id' => 'sb_email_templates16',
    'desc' => __('Welocme email template for new user registered by social details.', 'adforest'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sb_welcome_social_message_subject',
            'type' => 'text',
            'title' => __('New social user email template subject', 'adforest'),
            'default' => 'New Social User Registration',
        ),
        array(
            'id' => 'sb_welcome_social_message_from',
            'type' => 'text',
            'title' => __('New social user email FROM', 'adforest'),
            'desc' => __('NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
            'default' => get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        ),
        array(
            'id' => 'sb_welcome_social_message',
            'type' => 'editor',
            'title' => __('New social user email template', 'adforest'),
            'args' => array(
                'teeny' => true,
                'textarea_rows' => 10,
                'wpautop' => false,
            ),
            'desc' => '%site_name% , %display_name%, %email%, %details% will be translated accordingly.', 
            'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
            <tbody>
            <tr>
            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
            <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
            <div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
            <table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
            <tbody>
            <tr>
            <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
            <table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
            <tbody>
            <tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
            <td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/SB-logo.png" width="80" height="80"  alt="image"/>

            A Designing and development company</td>
            </tr>
            <tr>
            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
            <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello %display_name%</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>,</b></span></p>
             Welcome to %site_name%;
             Your details are below :
             Username: %email%

            &nbsp;
            <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
            <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p>
            </td></tr></tbody></table></td></tr></tbody></table><div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;"><table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td>
            </tr></tbody></table>
            </div>&nbsp;</div></td>
            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
            </tr>
            </tbody></table>&nbsp;',
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => __('Contact Seller (Widget)', 'adforest'),
    'id' => 'sb_email_template_seller_widget',
    'desc' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sb_email_template_seller_widget_subject',
            'type' => 'text',
            'title' => __('Seller Email Subject', 'adforest'),
            'desc' => '%site_name% , %ad_owner% , %ad_title% will be translated accordingly.',
            'default' => '%ad_owner% You Received A New Message - %site_name%',
        ),
        array(
            'id' => 'sb_email_template_seller_widget_from',
            'type' => 'text',
            'title' => __('New Ad FROM', 'adforest'),
            'desc' => __('FROM: NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
            'default' => 'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        ),
        array(
            'id' => 'sb_email_template_seller_widget_desc',
            'type' => 'editor',
            'title' => __('New Ad Posted Message', 'adforest'),
            'args' => array(
                'teeny' => true,
                'textarea_rows' => 10,
                'wpautop' => false,
            ),
            'desc' => "%receiver_name%, %sender_name%, %sender_email%, %sender_phone%, %sender_message%, %ad_title%, %ad_link%, %ad_owner%" . " " . __('Will be translated accordingly.', 'adforest'),
            'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"> </td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><br />A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello </span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>%receiver_name%,</b></span></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">You\'ve received a new message on your ad.;</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Title: %ad_title%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Link: <a href="%ad_link%">%ad_title%</a></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Sender Name: %sender_name%,</p>
<p>Sender Email: %sender_email%</p>
<p>Sender Phone Number: %sender_phone%</p>
<p>Sender Message:</p>
<p>%sender_message%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td>
</tr>
</tbody>
</table>
</div>
</div>
</td>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"> </td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>',
        ),
    )
));

do_action('adforest_commom_email_templates', $opt_name);

Redux::setSection($opt_name, array(
    'title' => __('Firebase', 'adforest'),
    'id' => 'sb_firebase_settings',
    'desc' => '',
    'icon' => 'el el-cog-alt',
    'fields' => array(
        array(
            'id' => 'sb_phone_verification_firebase',
            'type' => 'switch',
            'title' => __('Phone verfication Firebase', 'adforest'),
            'default' => false,
            'desc' => __('Send otp from firebase , this will allow the user to send otp using Firebase', 'adforest'),
            'required' => array('sb_phone_verification', '=', array('1')),
        ),
        array(
            'id' => 'sb_register_with_phone',
            'type' => 'switch',
            'title' => __('Register user with phone number with otp', 'adforest'),
            'default' => false,
            'desc' => __('it will allow the user to register and login with their phone number by sending otp', 'adforest'),
        ),
        array(
            'id' => 'sb_default_registration_form',
            'type' => 'button_set',
            'title' => __('Default Registeration form on page load', 'adforest'),
            'options' => array(
                'email' => __('Email / Passowrd form', 'adforest'),
                'phone' => __('Otp form', 'adforest'),
            ),
            'default' => 'email',
            'required' => array('sb_register_with_phone', '=', array('1')),
        ),
//        array(
//            'id' => 'sb_preadded_code',
//            'type' => 'switch',
//            'title' => __('auto detect country code', 'adforest'),
//            'default' => false,
//            'desc' => __('Auto detect country code and place in phone number field', 'adforest'),
//            'required' => array('sb_register_with_phone', '=', array('1')),
//        ),
        array(
            'id' => 'sb_firebase_apikey',
            'type' => 'text',
            'title' => __('Firebase Api Key', 'adforest'),
            'desc' => adforest_make_link('https://console.firebase.google.com/', __('How to Find it', 'adforest')),
        ),
        array(
            'id' => 'sb_firebase_appId',
            'type' => 'text',
            'title' => __('Firebase App ID', 'adforest'),
        ),
        array(
            'id' => 'sb_firebase_projectId',
            'type' => 'text',
            'title' => __('Firebase Project ID', 'adforest'),
        ),
        array(
            'id' => 'sb_firebase_messagingSenderId',
            'type' => 'text',
            'title' => __('Message Sender ID', 'adforest'),
        ),
    )
));

/* ------------------Users Settings ----------------------- */
Redux::setSection($opt_name, array(
    'title' => __('Users', 'adforest'),
    'id' => 'sb_user_settings',
    'desc' => '',
    'icon' => 'el el-cog-alt',
    'fields' => array(
        array(
            'id' => 'sb_phone_verification',
            'type' => 'switch',
            'title' => __('Phone verfication', 'adforest'),
            'default' => false,
            'desc' => __('If phone verification is on then system put verified batch to ad details on number so other can see this number is verified.', 'adforest'),
        ),
        array(
            'id' => 'sb_admin_approve_user',
            'type' => 'switch',
            'title' => __('Admin manually approve newly registered user', 'adforest'),
            'default' => false,
            'desc' => __('Admin manually approve newly registered user from backend', 'adforest'),
        ),
        array(
            'id' => 'sb_resend_code',
            'type' => 'text',
            'title' => __('Resend security code', 'adforest'),
            'subtitle' => __('In seconds', 'adforest'),
            'desc' => __('Only integer value without spaces, 30 means 30-seconds', 'adforest'),
            'required' => array('sb_phone_verification', '=', array('1')),
            'default' => 30,
        ),
        array(
            'id' => 'sb_change_ph',
            'type' => 'switch',
            'title' => __('Change phone number while ad posting.', 'adforest'),
            'desc' => __('If off then only user profile number will be display and can not be changeable.', 'adforest'),
            'required' => array('sb_phone_verification', '=', array('1')),
            'default' => true,
        ),
        array(
            'id' => 'sb_new_user_email_verification',
            'type' => 'switch',
            'title' => __('New user email verification', 'adforest'),
            'default' => false,
            'desc' => __('If verfication on then please update your new user email template by verification link.', 'adforest'),
        ),
        array(
            'id' => 'admin_contact_page',
            'type' => 'select',
            'data' => 'pages',
            'multi' => false,
            'title' => __('Contact to Admin', 'adforest'),
            'required' => array('sb_new_user_email_verification', '=', array('1')),
            'desc' => __('Select the page if verification email is not sent to new user.', 'adforest'),
        ),
        array(
            'id' => 'sb_new_user_email_to_admin',
            'type' => 'switch',
            'title' => __('New User Email to Admin', 'adforest'),
            'default' => true
        ),
        array(
            'id' => 'sb_new_user_email_to_user',
            'type' => 'switch',
            'title' => __('Welcome Email to User', 'adforest'),
            'default' => true
        ),
        array(
            'id' => 'sb_user_phone_required',
            'type' => 'switch',
            'title' => __('User phone number required', 'adforest'),
            'default' => true
        ),
        array(
            'id' => 'sb_user_profile_avatar',
            'type' => 'switch',
            'title' => __('Display Profile Image', 'adforest'),
            'default' => false,
            'subtitle' => __('Display profile image at admin dashboard users.', 'adforest'),
            'desc' => __('This option is used to enforce to display user frontend profile image as avatar image.', 'adforest'),
        ),
        array(
            'id' => 'sb_enable_user_badge',
            'type' => 'switch',
            'title' => __('Enable Badge', 'adforest'),
            'subtitle' => __('for display', 'adforest'),
            'default' => true,
        ),
        array(
            'id' => 'sb_enable_social_links',
            'type' => 'switch',
            'title' => __('Enable Social Profiles', 'adforest'),
            'subtitle' => __('for display', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'sb_disable_linkedin_edit',
            'type' => 'switch',
            'title' => __('Disable linkedin Editable', 'adforest'),
            'desc' => __("Enable this to restrict users to don't change the linkedin profile URL", "adforest"),
            'required' => array(
                array('sb_enable_social_links', '=', '1'),
            ),
            'default' => false,
        ),
        array(
            'id' => 'sb_enable_user_ratting',
            'type' => 'switch',
            'title' => __('Enable User Rating', 'adforest'),
            'subtitle' => __('To logged in users', 'adforest'),
            'default' => true,
        ),


          array(
            'id' => 'sb_enable_user_ratting_public_profile',
            'type' => 'switch',
            'title' => __('Enable User rating comments on the user public profile', 'adforest'),
            'subtitle' => __('This option will allow user to add a commment message on user public profile', 'adforest'),
            'default' => true,
        ),

        array(
            'id' => 'sb_rewiew_edit',
            'type' => 'switch',
            'title' => __('Review Edit Option', 'adforest'),
            'desc' => __("This option will allow the user to edit his rating on user profile", "adforest"),
            'default' => true,
        ),
        array(
            'id' => 'sb_rewiew_delete',
            'type' => 'switch',
            'title' => __('Delete posted review', 'adforest'),
            'desc' => __("User can delete his posted reviews", "adforest"),
            'default' => false,
        ),
        array(
            'id' => 'email_to_user_on_rating',
            'type' => 'switch',
            'title' => __('Send Email to user', 'adforest'),
            'subtitle' => __('on new ratting', 'adforest'),
            'required' => array('sb_enable_user_ratting', '=', '1'),
            'default' => true,
        ),
        array(
            'id' => 'user_contact_form',
            'type' => 'switch',
            'title' => __('User contact form', 'adforest'),
            'subtitle' => __('on public profile', 'adforest'),
            'default' => true,
        ),
        array(
            'id' => 'contact_form_recaptcha',
            'type' => 'switch',
            'title' => __('Contact Form Google reCAPTCHA', 'adforest'),
            'subtitle' => __('Hide/Show google recaptcha on user contact form.', 'adforest'),
            'required' => array('user_contact_form', '=', true),
            'default' => true,
            'desc' => __('After enabling please verify the <b>Google reCAPTCHA</b> API keys.', 'adforest'),
        ),
        array(
            'id' => 'author_privacy_page',
            'type' => 'select',
            'data' => 'pages',
            'multi' => false,
            'title' => __('Author Terms & Conditions Page', 'adforest'),
            'required' => array('user_contact_form', '=', true),
            'desc' => __('Select the author terms and policy page.', 'adforest'),
        ),
        array(
            'id' => 'users_per_page',
            'type' => 'spinner',
            'title' => __('Number of users on all seller page', 'adforest'),
            'subtitle' => __('per page', 'adforest'),
            'default' => '12',
            'min' => '1',
            'step' => '1',
            'max' => '100',
        ),
        array(
            'id' => 'subscribe_on_user_register',
            'type' => 'switch',
            'title' => __('Subscribe Users On Registration', 'adforest'),
            'subtitle' => __('MailChimp List ID', 'adforest'),
            'default' => false
        ),
        array(
            'id' => 'subscribe_on_user_register_listid',
            'type' => 'text',
            'title' => __('MailChimp List ID', 'adforest'),
            'required' => array('subscribe_on_user_register', '=', true),
            'default' => '',
            'desc' => adforest_make_link('http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id', __('How to Find it', 'adforest')),
        ),
        array(
            'required' => array('subscribe_on_user_register', '=', true),
            'id' => 'subscriber_checkbox_on_register',
            'type' => 'switch',
            'title' => __('Show Confirmation Checkbox', 'adforest'),
            'desc' => __('show confirmation checkbox on registraction form', 'adforest'),
            'default' => false
        ),
        array(
            'id' => 'subscriber_checkbox_on_register_text',
            'type' => 'text',
            'title' => __('Confimation checkbox text', 'adforest'),
            'required' => array('subscriber_checkbox_on_register', '=', true),
            'default' => __('subscribe for latest news and updates', 'adforest'),
        ),
        array(
            'id' => 'sb_new_user_delete_option',
            'type' => 'switch',
            'title' => __('Show Delete button', 'adforest'),
            'default' => false,
            'desc' => __('Show delete button on user profile. Due to General Data Protection Regulation (GDPR) policy. Note: This will delete the entire use data from the database who is going to delete and can not be recover again.', 'adforest'),
        ),
        array(
            'required' => array('sb_phone_verification', '=', array('1')),
            'id' => 'sb_select_sms_gateway',
            'type' => 'button_set',
            'title' => __('SMS Gateway', 'adforest'),
            'options' => array(
                'twilio' => __('Twilio', 'adforest'),
                'iletimerkezi' => __('Iletimerkezi SMS', 'adforest'),
            ),
            'default' => 'twilio'
        ),
        array(
            'required' => array('sb_phone_verification', '=', array('1')),
            'id' => 'sb_new_user_sms_verified_can',
            'type' => 'switch',
            'title' => __('Verify Users', 'adforest'),
            'default' => false,
            'desc' => __('Only profile sms verified users can send message to other users.', 'adforest'),
        ),
    )
));
/* ------------------URL Rewriting Settings ----------------------- */
Redux::setSection($opt_name, array(
    'title' => __('URL Rewriting', 'adforest'),
    'id' => 'sb_url_rewriting',
    'desc' => '',
    'icon' => 'el el-cogs',
    'fields' => array(
        array(
            'id' => 'sb_url_rewriting_enable',
            'type' => 'switch',
            'title' => __('Classified Ads', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'sb_ad_slug',
            'type' => 'text',
            'title' => __('Classified ad slug', 'adforest'),
            'required' => array('sb_url_rewriting_enable', '=', '1'),
            'default' => "",
        ),
        array(
            'id' => 'sb_url_rewriting_enable_cat',
            'type' => 'switch',
            'title' => __('Ads Category', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'sb_cat_slug',
            'type' => 'text',
            'title' => __('Classified category slug', 'adforest'),
            'subtitle' => __('Make it final before go live', 'adforest'),
            'desc' => __('After changing slug the pervious link will be throw 404 page not found.', 'adforest'),
            'required' => array('sb_url_rewriting_enable_cat', '=', '1'),
            'default' => "",
        ),
        array(
            'id' => 'sb_url_rewriting_enable_location',
            'type' => 'switch',
            'title' => __('Ads Location', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'sb_ad_location_slug',
            'type' => 'text',
            'title' => __('Classified Ad location slug', 'adforest'),
            'subtitle' => __('Make it final before go live', 'adforest'),
            'desc' => __('After changing slug the pervious link will be throw 404 page not found.', 'adforest'),
            'required' => array('sb_url_rewriting_enable_location', '=', '1'),
            'default' => "",
        ),
        array(
            'id' => 'sb_url_rewriting_enable_ad_tags',
            'type' => 'switch',
            'title' => __('Ads Tags', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'sb_ad_tags_slug',
            'type' => 'text',
            'title' => __('Classified Ad Tags slug', 'adforest'),
            'subtitle' => __('Make it final before go live', 'adforest'),
            'desc' => __('After changing slug the pervious link will be throw 404 page not found.', 'adforest'),
            'required' => array('sb_url_rewriting_enable_ad_tags', '=', '1'),
            'default' => "",
        ),
    )
));

/* ------------------Comment/Bidding Settings ----------------------- */
Redux::setSection($opt_name, array(
    'title' => __('Bidding Settings', 'adforest'),
    'id' => 'sb_comments_settings',
    'desc' => '',
    'icon' => 'el el-cogs',
    'fields' => array(
        array(
            'id' => 'sb_enable_comments_offer',
            'type' => 'switch',
            'title' => __('Enable Bidding', 'adforest'),
            'default' => false,
        ),
        array(
            'id' => 'sb_enable_comments_offer_user',
            'type' => 'switch',
            'title' => __('Give bidding option to user', 'adforest'),
            'required' => array('sb_enable_comments_offer', '=', '1'),
            'default' => false,
        ),
        array(
            'id' => 'bidding_timer',
            'type' => 'switch',
            'title' => __('Bidding Timer', 'adforest'),
            'required' => array('sb_enable_comments_offer', '=', '1'),
            'default' => false,
            'required' => array(
                array('sb_enable_comments_offer', '=', '1'),
                array('sb_enable_comments_offer_user', '=', '1'),
            ),
        ),
        array(
            'id' => 'top_bidder_limit',
            'type' => 'select',
            'title' => __('Top bidder limit', 'adforest'),
            'required' => array('sb_enable_comments_offer', '=', '1'),
            'options' => range(0, 10),
            'default' => 3,
        ),
        array(
            'id' => 'sb_enable_comments_offer_user_title',
            'type' => 'text',
            'title' => __('User Section Title', 'adforest'),
            'required' => array('sb_enable_comments_offer_user', '=', '1'),
            'default' => "Bidding",
        ),
        array(
            'id' => 'sb_email_on_new_bid_on',
            'type' => 'switch',
            'title' => __('Email to Ad author', 'adforest'),
            'subtitle' => __('on bid', 'adforest'),
            'required' => array('sb_enable_comments_offer', '=', '1'),
            'default' => false,
        ),
        array(
            'id' => 'sb_email_to_bid_winner',
            'type' => 'switch',
            'title' => __('Email to Bid winner', 'adforest'),
            'subtitle' => __('after closing bids', 'adforest'),
            'required' => array('sb_enable_comments_offer', '=', '1'),
            'default' => false,
        ),
        array(
            'id' => 'sb_comments_section_title',
            'type' => 'text',
            'title' => __('Section Title', 'adforest'),
            'required' => array('sb_enable_comments_offer', '=', '1'),
            'default' => "Bids",
        ),
        array(
            'id' => 'sb_comments_section_note',
            'type' => 'text',
            'title' => __('Disclaimer note', 'adforest'),
            'required' => array('sb_enable_comments_offer', '=', '1'),
            'default' => "*Your phone number will be shown to post author",
        ),
        array(
            'id' => 'sb_make_bid_categorised',
            'type' => 'switch',
            'title' => __('Make Bidding Categorised', 'adforest'),
            'subtitle' => __('Enable this to make bidding categorised', 'adforest'),
            'default' => true,
            'required' => array('sb_enable_comments_offer', '=', '1'),
        ),
        array(
            'id' => 'sb_make_bidding_paid',
            'type' => 'switch',
            'title' => __('Make Bidding Paid on front end', 'adforest'),
            'subtitle' => __('Enable this to make bidding Paid , package base', 'adforest'),
            'default' => false,
            'required' => array('sb_enable_comments_offer', '=', '1'),
        ),
        array(
            'id' => 'bid_categorised_type',
            'type' => 'button_set',
            'title' => __('Bidding Category Type', 'adforest'),
            'desc' => __('For selective case you have to enable checkbox in ad category meta. <b> ( dashboard >> Classified Ads >> Categories ) </b>', 'adforest'),
            'options' => array(
                'all' => __('All', 'adforest'),
                'selective' => __('Selective', 'adforest'),
            ),
            'required' => array('sb_make_bid_categorised', '=', '1'),
            'default' => 'all',
        ),
    )
));

/* Map Settings Starts From Here */
/* ------------------BreadCrumb Settings ----------------------- */
Redux::setSection($opt_name, array(
    'title' => __('Map Settings', 'adforest'),
    'id' => 'map_settings',
    'desc' => __("Here you can setup the Map Settings for the theme. We have two type of map api's.", "adforest"),
    'icon' => 'el el-map-marker-alt',
    'fields' => array(
        array(
            'id' => 'map-setings-map-type',
            'type' => 'button_set',
            'title' => __('Map Type', 'adforest'),
            'subtitle' => __('Select Map', 'adforest'),
            'desc' => __('Select map type you want to add in the theme. By default google map is activated.', 'adforest'),
            'options' => array(
                'google_map' => __('Google Map', 'adforest'),
                'leafletjs_map' => __('Leafletjs/OpenStreet Map', 'adforest'),
            /* 'no_map' => __( 'No Map', 'adforest' ), */
            ),
            'default' => 'google_map'
        ),
    )
));

/* Shop Settings Starts From Here */
/* ------------------BreadCrumb Settings ----------------------- */
Redux::setSection($opt_name, array(
    'title' => __('Shop Settings', 'adforest'),
    'id' => 'shop_settings',
    'desc' => '',
    'icon' => 'el el-shopping-cart',
    'fields' => array(
        array(
            'id' => 'shop-turn-on-info1',
            'type' => 'info',
            'style' => 'info',
            'required' => array('shop-turn-on', '=', '0'),
            'title' => __('Info', 'adforest'),
            'desc' => __('If you want to turn on shop you need to first update the package in the packages.', 'adforest') . '<img src="' . trailingslashit(get_template_directory_uri()) . "images/shop-on-ha.png" . '"  alt="image">'
        ),


    
        array(
            'id' => 'shop-turn-on',
            'type' => 'switch',
            'title' => __('Turn On Shop.', 'adforest'),
            'subtitle' => __('Add shop in Theme', 'adforest'),
            'default' => false,
            'desc' => __('If you want to turn on shop you need to first update the package in the woo-commerce.', 'adforest'),
        ),
            array(
            'id' => 'shop_change_header',
            'type' => 'switch',
            'required' => array('shop-turn-on', '=', '1'),
            'title' => __('Change header on woocomerce pages', 'adforest'),
            'desc' => __('Place woocomerce header on woocomerce pages like , product detail page ,shop page and product category archive','adforest'),
            'default' =>  false,
        ),
        array(
            'id' => 'shop-layout-col',
            'type' => 'button_set',
            'title' => __('Default shop coloumn', 'adforest'),
            'options' => array(
                'col-lg-3' => __('4 products', 'adforest'),
                'col-lg-4' => __('3 Products', 'adforest'),
            ),
            'subtitle' => __('Default: 4 products', 'adforest'),
            'desc' => __('Select shop archive layout column.', 'adforest'),
            'default' => 'col-lg-3',
            'required' => array('shop-turn-on', '=', '1'),
        ),
        array(
            'id' => 'shop-sidebar-position',
            'type' => 'button_set',
            'title' => __('Default left', 'adforest'),
            'options' => array(
                'right' => __('Right', 'adforest'),
                'left' => __('Left', 'adforest'),
            ),
            'subtitle' => __('Shop Sidebar position', 'adforest'),
            'desc' => __('Select shop/archive sidebar position', 'adforest'),
            'default' => 'left',
            'required' => array('shop-turn-on', '=', '1'),
        ),

        array(
            'id' => 'shop-title-limit',
            'type' => 'slider',
            'title' => __('Shop page product title', 'adforest'),
            'subtitle' => __('Shop page product title limit', 'adforest'),
            'default' => 25,
            'min' => 10,
            'step' => 5,
            'max' => 200,
            'display_value' => 'text',
            'required' => array('shop-turn-on', '=', '1'),
        ),
        array(
            'id' => 'shop-number-of-products',
            'type' => 'slider',
            'title' => __('No.of Products', 'adforest'),
            'subtitle' => __('No.of Products Per Page', 'adforest'),
            'desc' => __('the number of products you wanna show per page.', 'adforest'),
            'default' => 12,
            'min' => 0,
            'step' => 1,
            'max' => 500,
            'display_value' => 'text',
            'required' => array('shop-turn-on', '=', '1'),
        ),
        array(
            'id' => 'shop-turn-on-info2',
            'type' => 'info',
            'style' => 'info',
            'required' => array('shop-turn-on', '=', true),
            'title' => __('Single Page Settings', 'adforest'),
            'desc' => __('Single page settings starts from below.', 'adforest'),
        ),
        array(
            'required' => array('shop-turn-on', '=', '1'),
            'id' => 'shop-single-page-title',
            'type' => 'text',
            'title' => __('Shop Single Page Title', 'adforest'),
            'subtitle' => '',
            'desc' => '',
            'default' => __('Details', 'adforest'),
        ),
        array(
            'id' => 'single-product-banner',
            'required' => array('shop-turn-on', '=', '1'),
            'type' => 'media',
            'url' => true,
            'compiler' => 'true',
            'subtitle' => __('Dimensions: 300 x 500', 'adforest'),
            'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'images/f1.png'),
        ),
        array(
            'required' => array('shop-turn-on', '=', '1'),
            'id' => 'shop-related-single-on',
            'type' => 'switch',
            'title' => __('Turn On Related Product', 'adforest'),
            'subtitle' => __('On Single Page', 'adforest'),
            'default' => false,
            'desc' => __('Turn on related products on single page.', 'adforest'),
        ),
        array(
            'required' => array('shop-related-single-on', '=', true),
            'id' => 'shop-related-single-title',
            'type' => 'text',
            'title' => __('Related Products Title', 'adforest'),
            'subtitle' => '',
            'desc' => '',
            'default' => __('Related Products', 'adforest'),
        ),
        array(
            'id' => 'shop-number-of-related-products-single',
            'type' => 'slider',
            'title' => __('No.of Related Products', 'adforest'),
            'subtitle' => __('No.of Related Products Per Page', 'adforest'),
            'desc' => __('the number of products you wanna show on single page.', 'adforest'),
            'default' => 12,
            'min' => 0,
            'step' => 1,
            'max' => 500,
            'display_value' => 'text',
            'required' => array('shop-related-single-on', '=', true),
        ),
    )
));

/* Shop Settings Ends Here */
/* ------------------Blog Settings ----------------------- */
Redux::setSection($opt_name, array(
    'title' => __('Blog Settings', 'adforest'),
    'id' => 'sb-blog-settings',
    'desc' => '',
    'icon' => 'el el-edit',
    'fields' => array(
        array(
            'id' => 'blog_sidebar',
            'type' => 'button_set',
            'title' => __('Blog Sidebar', 'adforest'),
            'options' => array(
                'right' => 'Right',
                'left' => 'Left',
                'no-sidebar' => 'No Sidebar',
            ),
            'default' => 'right'
        ),
        array(
            'id' => 'sb_blog_single_title',
            'type' => 'text',
            'title' => __('Single Post Title', 'adforest'),
            'subtitle' => '',
            'desc' => '',
            'default' => 'Blog Details',
        ),
        array(
            'id' => 'enable_share_post',
            'type' => 'switch',
            'title' => __('Enable Share', 'adforest'),
            'subtitle' => __('on single Post', 'adforest'),
            'default' => true,
        ),


          array(
            'id' => 'blog_advertisment_top',
            'type' => 'textarea',
            'title' => __('Advertisement', 'adforest'),
            'subtitle' => __('720 x 90', 'adforest'),
            'desc' => __('Above the Blog post', 'adforest'),
           
        ),

           array(
            'id' => 'blog_advertisment_bottom',
            'type' => 'textarea',
            'title' => __('Advertisement', 'adforest'),
            'desc' => __('Bottom of Blog the post', 'adforest'),
            
        ),

            array(
            'id' => 'single_post_advertisment_top',
            'type' => 'textarea',
            'title' => __('Advertisement', 'adforest'),
            'subtitle' => __('720 x 90', 'adforest'),
            'desc' => __('At the top of blog post', 'adforest'),
           
        ),

             array(
            'id' => 'single_post_advertisment_bottom',
            'type' => 'textarea',
            'title' => __('Advertisement', 'adforest'),
            'desc' => __('Bottom of the post description', 'adforest'),
            
        ),









    )
));

$g_map_dec = '';
$gmap_restricted_api_key = Redux::get_option('adforest_theme', 'gmap_restricted_api_key');
$sb_verify_restrict_key = Redux::get_option('adforest_theme', 'sb_verify_restrict_key');
$gmap_key_type = Redux::get_option('adforest_theme', 'g-map-key-type');
$sb_verify_restrict_key = isset($sb_verify_restrict_key) && $sb_verify_restrict_key ? TRUE : FALSE;

if (isset($gmap_restricted_api_key) && $gmap_restricted_api_key != '' && 'g_key_restricted' == $gmap_key_type && $sb_verify_restrict_key) {
    $arrContextOptions = array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
        ),
    );
    $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=' . $gmap_restricted_api_key . '&address=Aurora,+CO,+USA&sensor=false', false, stream_context_create($arrContextOptions));
    $output = json_decode($geocodeFromAddr);
    if (isset($output->status) && $output->status != 'OK') {
        $g_map_dec = '<b>Error : </b><span style="color:red">' . $output->error_message . '.</span>';
    }
}

/* ------------------API Settings ----------------------- */
Redux::setSection($opt_name, array(
    'title' => __('API Settings', 'adforest'),
    'id' => 'sb-api-settings',
    'desc' => '',
    'icon' => 'el el-cogs',
    'fields' => array(
        array(
            'id' => 'google-recaptcha-type',
            'type' => 'button_set',
            'title' => __('Google reCAPTCHA', 'adforest'),
            'desc' => __('<b class="sb-admin-note">Note : </b> Please make sure you are using the valid <b> reCAPTCHA v2 site </b> OR  <b> reCAPTCHA v3 site</b> keys.', 'adforest'),
            'options' => array(
                'v2' => 'reCAPTCHA v2',
                'v3' => 'reCAPTCHA v3',
            ),
            'default' => 'v2',
        ),
        array(
            'id' => 'hide_captcha_badge',
            'type' => 'switch',
            'title' => __('Hide reCAPTCHA Badge', 'adforest'),
            'default' => false,
            'required' => array('google-recaptcha-type', '=', array('v3')),
        ),
        array(
            'id' => 'google_api_key',
            'type' => 'text',
            'title' => __('Google ReCAPTCHA API Key', 'adforest'),
            'subtitle' => '',
            'desc' => adforest_make_link('https://www.google.com/recaptcha/admin', __('How to Find it', 'adforest')),
            'default' => '',
        ),
        array(
            'id' => 'google_api_secret',
            'type' => 'text',
            'title' => __('Google ReCAPTCHA API Secret', 'adforest'),
            'subtitle' => '',
            'desc' => adforest_make_link('https://www.google.com/recaptcha/admin', __('How to Find it', 'adforest')),
            'default' => '',
        ),
        array(
            'id' => 'mailchimp_api_key',
            'type' => 'text',
            'title' => __('MailChimp API Key', 'adforest'),
            'default' => '',
            'desc' => adforest_make_link('http://kb.mailchimp.com/integrations/api-integrations/about-api-keys', __('How to Find it', 'adforest')),
        ),
        array(
            'id' => 'section-start',
            'type' => 'section',
            'title' => __('Google Api Keys', 'adforest'),
            'subtitle' => '',
            'indent' => true
        ),
        array(
            'id' => 'g-map-key-type',
            'type' => 'button_set',
            'title' => __('Google API Key Type', 'adforest'),
            'desc' => '',
            'options' => array(
                'g_key_open' => __('Open', 'adforest'),
                'g_key_restricted' => __('Restricted', 'adforest'),
            ),
            'default' => 'g_key_open',
        ),
        array(
            'id' => 'sb_verify_restrict_key',
            'type' => 'switch',
            'title' => __('Verify Key', 'adforest'),
            'desc' => __('Enable this and refresh the page to validate that your generated IP API key is valid.You can see the errors as description below the *IP API Key* field.<br /><b class="sb-admin-note">Disable switch after validating the key because this generates a num of API call that increase your billing.</b>', 'adforest'),
            'subtitle' => __('validating the IP API Key', 'adforest'),
            'default' => false,
            'required' => array('g-map-key-type', '=', array('g_key_restricted')),
        ),
        array(
            'id' => 'gmap_api_key',
            'type' => 'text',
            'title' => __('Google Map API Key', 'adforest'),
            'desc' => adforest_make_link('https://developers.google.com/maps/documentation/javascript/get-api-key', __('How to Find it', 'adforest')),
            'default' => 'AIzaSyB_La6qmewwbVnTZu5mn3tVrtu6oMaSXaI',
        ),
        array(
            'id' => 'gmap_restricted_api_key',
            'type' => 'text',
            'subtitle' => __('API key that assign to IP.', 'adforest'),
            'title' => __('IP API Key', 'adforest'),
            'desc' => $g_map_dec,
            'default' => '',
            'required' => array('g-map-key-type', '=', array('g_key_restricted')),
        ),
        array(
            'id' => 'section-end',
            'type' => 'section',
            'indent' => false,
        ),
        array(
            'id' => 'fb_api_key',
            'type' => 'text',
            'title' => __('Facebook Client ID', 'adforest'),
            'desc' => adforest_make_link('https://developers.facebook.com/?advanced_app_create=true', __('How to Make', 'adforest')),
        ),
        array(
            'id' => 'gmail_api_key',
            'type' => 'text',
            'title' => __('Gmail Client ID', 'adforest'),
            'desc' => adforest_make_link('https://console.developers.google.com/apis/credentials', __('How to Find it', 'adforest')),
        ),
        array(
            'id' => 'redirect_uri',
            'type' => 'text',
            'title' => __('Redirect URI', 'adforest'),
            'desc' => __('Must be URI where you want to redirect after thentication, it will be your web url.', 'adforest'),
        ),
        array(
            'id' => 'linkedin-section-start',
            'type' => 'section',
            'title' => __('Linkedin Api Keys', 'adforest'),
            'subtitle' => '',
            'indent' => true
        ),
        array(
            'id' => 'adforest_linkedin_api_key',
            'type' => 'text',
            'title' => esc_html__('Linkedin api key', 'adforest'),
            'desc' => adforest_make_link('https://developer.linkedin.com/support/faq', esc_html__('How to Find it', 'adforest')),
        ),
        array(
            'id' => 'adforest_linkedin_api_secret',
            'type' => 'text',
            'title' => esc_html__('Linkedin secret', 'adforest'),
        ),
        array(
            'id' => 'adforest_redirect_uri',
            'type' => 'text',
            'title' => esc_html__('Linkedin Redirect URI', 'adforest'),
            'desc' => esc_html__('Must be URI where you want to redirect after athentication, it will be your web url.', 'adforest'),
        ),
        array(
            'id' => 'linkedin-section-end',
            'type' => 'section',
            'indent' => false,
        ),
    )
));

/* ------------------Comming Soon ----------------------- */
Redux::setSection($opt_name, array(
    'title' => __('Coming Soon', 'adforest'),
    'id' => 'sb_comming_soon_section',
    'desc' => '',
    'icon' => 'el el-screen',
    'fields' => array(
        array(
            'id' => 'sb_comming_soon_mode',
            'type' => 'switch',
            'title' => __('Coming Soon Mode', 'adforest'),
            'subtitle' => '',
            'default' => false
        ),
        array(
            'required' => array('sb_comming_soon_mode', '=', true),
            'id' => 'sb_comming_soon_logo',
            'type' => 'media',
            'url' => true,
            'title' => __('Coming Soon Logo', 'adforest'),
            'compiler' => 'true',
            'subtitle' => __('Dimensions: 220 x 40', 'adforest'),
            'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'images/logo.png'),
        ),
        array(
            'required' => array('sb_comming_soon_mode', '=', true),
            'id' => 'coming_soon_notify',
            'type' => 'switch',
            'title' => __('Notify Section', 'adforest'),
            'subtitle' => '',
            'default' => false
        ),
        array(
            'required' => array('sb_comming_soon_mode', '=', true),
            'id' => 'mailchimp_notify_list_id',
            'type' => 'text',
            'title' => __('MailChimp List ID', 'adforest'),
            'desc' => adforest_make_link('http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id', __('How to Find it', 'adforest')),
        ),
        array(
            'required' => array('sb_comming_soon_mode', '=', true),
            'id' => 'sb_comming_soon_date',
            'type' => 'text',
            'title' => __('Set Date', 'adforest'),
            'subtitle' => __('When you ready to launch', 'adforest'),
            'desc' => __('YYYY/MM/DD', 'adforest'),
            'default' => '2017/06/28',
        ),
        array(
            'required' => array('sb_comming_soon_mode', '=', true),
            'id' => 'sb_comming_soon_title',
            'type' => 'textarea',
            'title' => __('Description', 'adforest'),
            'default' => 'Our website is under construction.',
        ),
        array(
            'required' => array('sb_comming_soon_mode', '=', true),
            'id' => 'social_media_soon',
            'type' => 'sortable',
            'title' => __('Social Media', 'adforest'),
            'desc' => __('You can sort it out as you want.', 'adforest'),
            'label' => true,
            'options' => array(
                'Facebook' => '',
                'Twitter' => '',
                'Linkedin' => '',
                'Google' => '',
                'YouTube' => '',
                'Vimeo' => '',
                'Pinterest' => '',
                'Tumblr' => '',
                'Instagram' => '',
                'Reddit' => '',
                'Flickr' => '',
                'StumbleUpon' => '',
                'Delicious' => '',
                'dribble' => '',
                'behance' => '',
                'DeviantART' => '',
            ),
        ),
    )
));

/* ------------------Social Media ----------------------- */
Redux::setSection($opt_name, array(
    'title' => __('Social Media', 'adforest'),
    'id' => 'sb_theme_social_media',
    'desc' => '',
    'icon' => 'el el-share',
    'fields' => array(
        array(
            'id' => 'social_follow',
            'type' => 'button_set',
            'title' => __('Social Relation', 'adforest'),
            'desc' => __('Nofollow links attributes do not allow search engine bots to follow link.', 'adforest'),
            'options' => array(
                'follow' => 'doFollow',
                'nofollow' => 'noFollow',
            ),
            'default' => 'follow',
        ),
        array(
            'id' => 'social_media',
            'type' => 'sortable',
            'title' => __('Social Media', 'adforest'),
            'desc' => __('You can sort it out as you want.', 'adforest'),
            'label' => true,
            'options' => array(
                'Facebook' => '',
                'Twitter' => '',
                'Linkedin' => '',
                'Google' => '',
                'YouTube' => '',
                'Vimeo' => '',
                'Pinterest' => '',
                'Tumblr' => '',
                'Instagram' => '',
                'Reddit' => '',
                'Flickr' => '',
                'StumbleUpon' => '',
                'Delicious' => '',
                'dribble' => '',
                'behance' => '',
                'DeviantART' => '',
            ),
        ),
    )
));

/* ------------------Theme License ----------------------- */
Redux::setSection($opt_name, array(
    'title' => __('License Management', 'adforest'),
    'id' => 'sb_theme_license_activation',
    'desc' => '',
    'icon' => 'el el-key',
    'fields' => array(
        array(
            'id' => 'opt-license-callback',
            'type' => 'callback',
            'title' => __('Theme License', 'adforest'),
            'subtitle' => __('A Friendly Message.', 'adforest'),
            'desc' => __('Thanks, for buying AdForest Theme.', 'adforest'),
            'callback' => 'adforest_theme_license_check'
        ),
    )
));

/* ------------------  Vendor Settings----------------------- */
if (class_exists('MVX')) {
    Redux::setSection($opt_name, array(
        'title' => __('Vendor', 'adforest'),
        'id' => 'sb_ad_vendor_settings',
        'desc' => '',
        'icon' => 'el el-adult',
    ));

    Redux::setSection($opt_name, array(
        'title' => __('Vendor Detail Settings', 'adforest'),
        'id' => 'sb_detail_vendor',
        'desc' => '',
        'icon' => 'el el-cog-alt',
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'sb_vendor_show_shop_prod',
                'type' => 'switch',
                'title' => __('Show Vendor Products', 'adforest'),
                'subtitle' => '',
                'default' => true
            ),
            array(
                'id' => 'sb_vendor_detail_baner_img',
                'type' => 'media',
                'url' => true,
                'title' => __('Side Banner Image', 'adforest'),
                'compiler' => 'true',
                'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'images/f1.png'),
            ),
            array(
                'id' => 'sb_vendor_detail_baner_link',
                'type' => 'text',
                'url' => true,
                'title' => __('Side Banner Link', 'adforest'),
                'compiler' => 'true',
                'required' => array('sb_vendor_show_shop_prod', '=', true),
            ),
            array(
                'id' => 'num_vendor_prod_show',
                'type' => 'text',
                'title' => __('Products on Vendor Detail Page', 'adforest'),
                'desc' => __('Input Only Numeric Value', 'adforest'),
                'default' => '6',
                'required' => array('sb_vendor_show_shop_prod', '=', true)
            ),
            array(
                'id' => 'sb_vendor_templates0',
                'type' => 'image_select',
                'title' => esc_html__('Vendor Single Page Layout', 'adforest'),
                'desc' => esc_html__('Select Vendor Single Page Layout you want to show.', 'adforest'),
                'options' => array(
                    '1' => array(
                        'alt' => esc_html__('Vendor Front Layout 1', 'adforest'),
                        'img' => esc_url(trailingslashit(get_template_directory_uri()) . 'images/vendor-template-custom.png'),
                    ),
                    '2' => array(
                        'alt' => esc_html__('No Vendor Front Layout', 'adforest'),
                        'img' => esc_url(trailingslashit(get_template_directory_uri()) . 'images/default-tem.png'),
                    ),
                ),
                'default' => '1'
            ),
            array(
                'id' => 'sb_vendor_dashboard_page',
                'type' => 'select',
                'data' => 'pages',
                'multi' => true,
                'sortable' => true,
                'title' => __('Vendor Dashboard Page', 'adforest'),
                'desc' => __('Select Page Links For The Vendor Dashboard', 'adforest'),
            ),
        )
    ));

    /* email to admin */
    Redux::setSection($opt_name, array(
        'title' => __('Vendor Email Templates', 'adforest'),
        'id' => 'sb_vendor_email_template',
        'desc' => '',
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'sb_new_vendor_admin_message_subject',
                'type' => 'text',
                'title' => __('New Vendor email template subject for Admin', 'adforest'),
                'default' => 'New User Registration',
            ),
            array(
                'id' => 'sb_new_vendor_admin_message_from',
                'type' => 'text',
                'title' => __('New Vendor email FROM for Admin', 'adforest'),
                'desc' => __('NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
                'default' => get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
            ),
            array(
                'id' => 'sb_new_vendor_admin_message',
                'type' => 'editor',
                'title' => __('New Vendor email template for Admin', 'adforest'),
                'args' => array(
                    'teeny' => true,
                    'textarea_rows' => 10,
                    'wpautop' => false,
                ),
                'desc' => '%site_name% , %display_name%, %email% will be translated accordingly.',
                'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/SB-logo.png" width="80" height="80"  alt="image"/>

A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello Admin</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>,</b></span></p>
New Vendor has registered on your site : %site_name%

Name: %vendor_name%

Email: %vendor_email%

&nbsp;
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p></td></tr></tbody></table></td></tr></tbody></table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td></tr></tbody></table></div>&nbsp;</div></td><td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td></tr></tbody></table>&nbsp;',
            ),
            array(
                'id' => 'divider_1',
                'type' => 'divide',
            ),
            array(
                'id' => 'sb_email_template_to_vendor_subject',
                'type' => 'text',
                'title' => __('New Contact Form email subject for Vendor', 'adforest'),
                'desc' => '%site_name% , %store_title%, %store_owner% will be translated accordingly.',
                'default' => __('You have new message on Vendor - Adforest', 'adforest')
            ),
            array(
                'id' => 'sb_email_template_to_vendor_from',
                'type' => 'text',
                'title' => __('Contact Email FROM', 'adforest'),
                'desc' => __('FROM: NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
                'default' => 'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
            ),
            array(
                'id' => 'sb_email_template_to_vendor_desc',
                'type' => 'editor',
                'title' => __('New Ad Posted Message', 'adforest'),
                'args' => array(
                    'teeny' => true,
                    'textarea_rows' => 10,
                    'wpautop' => false,
                ),
                'desc' => "%sender_name%, %sender_email%, %sender_subject%, %sender_message%, %store_title%, %store_link%, %store_owner%" . " " . __('Will be translated accordingly.', 'adforest'),
                'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"> </td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><br />A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello </span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>%store_owner%,</b></span></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">You\'ve received a new message on your Store.</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Title: %store_title%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Link: <a href="%store_link%">%store_link%</a></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Sender Name: %sender_name%,</p>
<p>Sender Email: %sender_email%</p>
<p>Sender Subject: %sender_subject%</p>
<p>Sender Message:</p>
<p>%sender_message%</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td>
</tr>
</tbody>
</table>
</div>
</div>
</td>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"> </td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>',
            ),
            array(
                'id' => 'divider_2',
                'type' => 'divide'
            ),
            array(
                'id' => 'sb_vendor_pending_email_subject',
                'type' => 'text',
                'title' => __('Pending Email subject', 'adforest'),
                'default' => 'Your Account is in Pending.',
            ),
            array(
                'id' => 'sb_vendor_pending_email_from',
                'type' => 'text',
                'title' => __('Pending Email FROM', 'adforest'),
                'desc' => __('NAME valid@email.com is compulsory as we gave in default.', 'adforest'),
                'default' => get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
            ),
            array(
                'id' => 'sb_vendor_pending_email_message',
                'type' => 'editor',
                'title' => __('Pending Email Message', 'adforest'),
                'args' => array(
                    'teeny' => true,
                    'textarea_rows' => 10,
                    'wpautop' => false,
                ),
                'desc' => '%site_name% , %vendor_name%, %vendor_email% will be translated accordingly.',
                'default' => '<table class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto !important;">
<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #fff; border-radius: 3px; width: 100%;">
<tbody>
<tr>
<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td class="alert" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#fff"><img class="alignnone size-full wp-image-1437" src="http://adforest.scriptsbundle.com/wp-content/uploads/2017/03/SB-logo.png" width="80" height="80"  alt="image" />

A Designing and development company</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><span style="font-family: sans-serif; font-weight: normal;">Hello %vendor_name%</span><span style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;"><b>,</b></span></p>
<br />
You vendor account is in pending.
<br />
Details are below;
<br />
Name : %vendor_name%
<br />
Email: %vendor_email%
<br />

&nbsp;
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"><strong>Thanks!</strong></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">ScriptsBundle</p></td></tr></tbody></table></td></tr></tbody></table>
<div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
<table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; font-size: 12px; vertical-align: top; color: #999999; text-align: center;"><a style="color: #999999; text-decoration: underline; font-size: 12px; text-align: center;" href="https://themeforest.net/user/scriptsbundle">Scripts Bundle</a>.</td>
</tr></tbody></table></div>&nbsp;</div></td><td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td></tr></tbody></table>&nbsp;',
            ),
        )
    ));
}

/* ------------------  Footer Settings----------------------- */
Redux::setSection($opt_name, array(
    'title' => __('Footer Settings', 'adforest'),
    'id' => 'sb-footer',
    'desc' => '',
    'icon' => 'el el-cog-alt',
    'fields' => array(
        array(
            'id' => 'footer_style',
            'type' => 'image_select',
            'title' => __('Footer Style', 'adforest'),
            'options' => array(

                '1' => array(
                'alt'   => esc_html__('footer 1','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/footers/footer1.png',
                ),
                '2' => array(
                'alt'   => esc_html__('footer 2','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/footers/footer2.png',
                ),
                '3' => array(
                'alt'   => esc_html__('footer 3','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/footers/footer3.png',
                ),
                '4' => array(
                'alt'   => esc_html__('footer 4','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/footers/footer4.png',
                ),
                '5' => array(
                'alt'   => esc_html__('footer 5','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/footers/footer5.png',
                ),
                '6' => array(
                'alt'   => esc_html__('footer 6','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/footers/footer6.png',
                ),
                '7' => array(
                'alt'   => esc_html__('footer 7','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/footers/footer7.png',
                ),
                '8' => array(
                'alt'   => esc_html__('footer 8','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/footers/footer8.png',
                ),
                '9' => array(
                'alt'   => esc_html__('footer 9','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/footers/footer9.png',
                ),
                '10' => array(
                'alt'   => esc_html__('footer 10','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/footers/footer10.png',
                ),
                '11' => array(
                'alt'   => esc_html__('footer 11','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/footers/footer11.png',
                ),
                '12' => array(
                'alt'   => esc_html__('footer 12','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/footers/footer12.png',
                ),
                '13' => array(
                'alt'   => esc_html__('elementor-pro','adforest'),
                'img'   => trailingslashit(get_template_directory_uri()) . 'images/footers/elementor.jpg',
                ),
            ),
            'default' => '1'
        ),
        array(
            'id' => 'footer_logo',
            'type' => 'media',
            'url' => true,
            'title' => __('Footer Logo', 'adforest'),
            'compiler' => 'true',
            'desc' => __('Site Logo image for the site.', 'adforest'),
            'subtitle' => __('Dimensions: 230 x 40', 'adforest'),
            //'required' => array('footer_style', '=', array('1','2')),
            'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'images/footer-logo.png'),
        ),
        array(
            'id' => 'footer_color',
            'type' => 'button_set',
            'title' => __('Footer Style', 'adforest'),
            'options' => array(
                '' => 'Black',
                'new-demo' => 'White',
            ),
            'required' => array(array('footer_style', '=', array('2'))),
            'default' => ''
        ),
        array(
            'id' => 'footer_options',
            'type' => 'button_set',
            'title' => __('Footer Style', 'adforest'),
            'options' => array(
                '' => 'Without BG',
                'with_bg' => 'With BG',
            ),
            'required' => array('footer_style', '=', array('1', '7')),
            'default' => ''
        ),
        array(
            'id' => 'footer_bg',
            'type' => 'media',
            'url' => true,
            'title' => __('Footer BG', 'adforest'),
            'compiler' => 'true',
            'required' => array('footer_options', '=', 'with_bg'),
            'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'images/footer.jpg'),
        ),
        array(
            'id' => 'footer_description',
            'type' => 'textarea',
            'title' => __('Footer Text', 'adforest'),
            'subtitle' => __('under logo', 'adforest'),
            'required' => array('footer_style', '=', array('11', '12')),
            'default' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat accusantium corrupti qui. Sapiente, dignissimos.',
            'required' => array('footer_style', '=', array('11', '12')),
        ),
        array(
            'id' => 'footer_text_under_logo',
            'type' => 'textarea',
            'title' => __('Footer Text', 'adforest'),
            'subtitle' => __('under logo', 'adforest'),
            'required' => array('footer_style', '=', array('2', '3', '9')),
            'default' => 'Aoluptas sit aspernatur aut odit aut fugit, sed elits quias horisa hinoe magni magni dolores eos qui ratione volust luptatem sequised.',
        ),
        array(
            'id' => 'footer_android_app',
            'type' => 'text',
            'title' => __('Android App Link', 'adforest'),
            'required' => array('footer_style', '=', array('2')),
            'default' => '',
        ),
        array(
            'id' => 'footer_ios_app',
            'type' => 'text',
            'title' => __('IOS App Link', 'adforest'),
            'required' => array('footer_style', '=', array('2')),
            'default' => '',
        ),
        array(
            'id' => 'footer_social_icons',
            'type' => 'sortable',
            'title' => __('Social Media', 'adforest'),
            'desc' => __('Social media icons for footer', 'adforest'),
            'required' => array('footer_style', '=', array('11', '12')),
            'label' => true,
            'options' => array(
                'Facebook' => '',
                'Twitter' => '',
                'Linkedin' => '',
                'Google' => '',
                'YouTube' => '',
                'Vimeo' => '',
                'Pinterest' => '',
                'Tumblr' => '',
                'Instagram' => '',
                'Reddit' => '',
                'Flickr' => '',
                'StumbleUpon' => '',
                'Delicious' => '',
                'dribble' => '',
                'behance' => '',
                'DeviantART' => '',
            ),
        ),
        array(
            'id' => 'footer-contact-details',
            'type' => 'sortable',
            'title' => __('Contact Info', 'adforest'),
            'subtitle' => __('Add address, phone, fax, email and timing', 'adforest'),
            'desc' => __('You can sort out it as you want.', 'adforest'),
            'required' => array('footer_style', '=', array('1', '11', '12')),
            'label' => true,
            'options' => array(
                'Address' => '75 Blue Street, PK 54000',
                'Phone' => '(+92) 12 345 6879',
                'Email' => 'contact@scriptsbundle.com',
                'Timing' => 'Mon-Fri 12:00pm - 12:00am'
            ),
            'default' => array(
                'Address' => '75 Blue Street, PK 54000',
                'Phone' => '(+92) 12 345 6879',
                'Fax' => '(+92) 98 765 4321',
                'Email' => 'contact@scriptsbundle.com',
                'Timing' => 'Mon-Fri 12:00pm - 12:00am'
            ),
        ),
        array(
            'id' => 'section_3_mc',
            'type' => 'switch',
            'title' => __('News Letter', 'adforest'),
            'subtitle' => '',
            'default' => false,
            'required' => array('footer_style', '=', array('2', '11', '12', '9')),
        ),
        array(
            'id' => 'mc_title',
            'type' => 'text',
            'title' => __('News letter title', 'adforest'),
           
            'default' => 'Will never send you spam and ueless newsletter',
           'required' => array('footer_style', '=', array('11', '12')),
        ),
        array(
            'id' => 'mc_description',
            'type' => 'textarea',
            'title' => __('News letter Description', 'adforest'),
            'subtitle' => __('Footer Section', 'adforest'),
            'required' => array('footer_style', '=', array('11', '12')),
            'default' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque molestiae, in nam soluta dicta quasi corrupti itaque laboriosam deleniti labore qui animi delectus nulla fugit.',
           
        ),
        array(
            'id' => 'mailchimp_footer_list_id',
            'type' => 'text',
            'title' => __('MailChimp List ID', 'adforest'),
            'required' => array('section_3_mc', '=', true),
            'default' => '',
            'desc' => adforest_make_link('http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id', __('How to Find it', 'adforest')),
        ),
        array(
            'id' => 'footer_post_numbers',
            'type' => 'spinner',
            'title' => __('MAX # of posts', 'adforest'),
            'subtitle' => __('In Footer', 'adforest'),
            'desc' => __('Only that post(s) will be appear that have featured image.', 'adforest'),
            'required' => array('footer_style', '=', array('1')),
            'default' => '2',
            'min' => '1',
            'step' => '1',
            'max' => '10',
        ),
        array(
            'id' => 'sb_footer_pages',
            'type' => 'select',
            'data' => 'pages',
            'multi' => true,
            'sortable' => true,
            'title' => __('Footer pages links', 'adforest'),
            'required' => array('footer_style', '=', array('1', '10')),
            'desc' => __('Select Page Links For The Footer', 'adforest'),
            'default' => array('2'),
        ),
        array(
            'id' => 'section_1_title',
            'type' => 'text',
            'title' => __('Section-1 Title', 'adforest'),
            'subtitle' => __('Footer Section', 'adforest'),
            'required' => array('footer_style', '=', array('10', '11', '12')),
            'default' => 'Quick Links',
        ),
        array(
            'id' => 'section_2_title',
            'type' => 'text',
            'title' => __('Section-2 Title', 'adforest'),
            'subtitle' => __('Footer Section', 'adforest'),
            'required' => array('footer_style', '=', array('1', '2', '3' ,'10', '11', '12', '9')),
            'default' => 'Quick Links',
        ),
        array(
            'id' => 'sb_footer_cats',
            'type' => 'select',
            'data' => 'terms',
            'args' => array(
                'taxonomies' => array('ad_cats'),
                'hide_empty' => false,
            ),
            'multi' => true,
            'sortable' => true,
            'title' => __('Categories', 'adforest'),
            'required' => array('footer_style', '=', array('9')),
            'desc' => __('Select Categories For The Footer', 'adforest'),
            'default' => array('2'),
        ),
        array(
            'id' => 'section_3_title',
            'type' => 'text',
            'title' => __('Section-3 Title', 'adforest'),
            'subtitle' => __('Footer Section', 'adforest'),
            'required' => array('footer_style', '=', array('1', '2', '3', '9', '10', '11', '12')),
            'default' => 'Recent Posts',
        ),
        array(
            'id' => 'section_3_text',
            'type' => 'text',
            'title' => __('Section-3 Description', 'adforest'),
            'subtitle' => __('Footer Section', 'adforest'),
            'required' => array('footer_style', '=', array('2', '3', '9','10')),
            'default' => 'We may send you information about related events, webinars, products and services which we believe.',
        ),
        array(
            'id' => 'footer_post_numbers',
            'type' => 'spinner',
            'title' => __('MAX # of posts', 'adforest'),
            'subtitle' => __('In Footer', 'adforest'),
            'desc' => __('Only that post(s) will be appear that have featured image.', 'adforest'),
            'required' => array('footer_style', '=', array('1')),
            'default' => '2',
            'min' => '1',
            'step' => '1',
            'max' => '10',
        ),
        array(
            'id' => 'section_4_title',
            'type' => 'text',
            'title' => __('Section-4 Title', 'adforest'),
            'subtitle' => __('Footer Section', 'adforest'),
            'required' => array('footer_style', '=', array('1', '2', '11', '12')),
            'default' => 'Quick Links',
        ),
        array(
            'id' => 'footer_4_bg',
            'type' => 'button_set',
            'title' => __('Footer BG Color', 'adforest'),
            'options' => array(
                'gray' => 'Gray',
                '' => 'White',
            ),
            'required' => array('footer_style', '=', '4'),
            'default' => 'gray'
        ),
        array(
            'id' => 'sb_footer_links',
            'type' => 'select',
            'data' => 'pages',
            'multi' => true,
            'sortable' => true,
            'title' => __('QUICK LINKS', 'adforest'),
            'required' => array('footer_style', '=', array('1', '2', '10')),
            'desc' => __('Select Page Links For The Footer', 'adforest'),
            'default' => array('2'),
        ),
        array(
            'id' => 'footer-color',
            'type' => 'color',
            'title' => __('Footer Text Color', 'adforest'),
            'subtitle' => __('Pick a text color for the footer (default: #fff).', 'adforest'),
            'default' => '#FFFFFF',
            'validate' => 'color',
            'transparent' => false,
            'required' => array('footer_style', '=', array('7')),
        ),
        array(
            'id' => 'sb_footer',
            'type' => 'editor',
            'title' => __('Footer Bar', 'adforest'),
            'default' => 'Copyright 2021 &copy; Theme Created By'
            . ' ScriptsBundle, All Rights Reserved.',
            'args' => array(
                'wpautop' => false,
                'media_buttons' => false,
                'textarea_rows' => 5,
                'teeny' => false,
                'quicktags' => false,
            )
        ),
        array(
            'id' => 'sb_dashbboard_footer',
            'type' => 'editor',
            'title' => __('Footer Dashboard', 'adforest'),
            'default' => 'Copyright 2021 &copy; Theme Created By ScriptsBundle, All Rights Reserved.',
            'args' => array(
                'wpautop' => false,
                'media_buttons' => false,
                'textarea_rows' => 5,
                'teeny' => false,
                'quicktags' => false,
            )
        ),
        array(
            'id' => 'footer_js_and_css',
            'type' => 'textarea',
            'title' => __('Custom CSS/Javascript', 'adforest'),
            'subtitle' => '',
            'desc' => __('Here you can write CSS and Javascript that will add just before closing body tag section.', 'adforest'),
            'default' => '',
        )
    )
));

$footer_sidebar_options = array();
$footer_sidebar_options = apply_filters('adforest_footer_sidebar_options', $footer_sidebar_options);
Redux::setSection($opt_name, $footer_sidebar_options);

/** Wpml settings Options */
do_action('adforest_wpml_settings_options', $opt_name);

/**
 * Custom function for the callback referenced adforest_theme_license_check
 */
if (!function_exists('adforest_theme_license_check')) {

    function adforest_theme_license_check($field, $value) {
        echo __('Always use valid license purchased from themeforest only. You can buy it from the following link.', 'adforest');
        echo ' ';
        echo adforest_make_link('https://themeforest.net/item/adforest-classified-wordpress-theme/19481695/', __('Haven\'t buy theme yet. Click Here.', 'adforest'));
        $purchase_code = get_option('_sb_purchase_code');
       if ($purchase_code != "") {
            echo '<br><br><br>';
            echo '<a href="'.admin_url( '?page=adforest-theme-info', '' ).'"  id="sb_deactivate_licensesss" class="button button-primary"> ' . esc_html__('Deactivate License', 'adforest') . '<a>';
        }
    }

}



if (!function_exists('adforest_set_import_images')) {
    function adforest_set_import_images($field, $value) {
            echo '<br><br><br>';
            echo '<a href="javascript:void(0)"  id="set_imported_images" class="button button-primary"> ' . esc_html__('Set Imported images', 'adforest') . '<a>';
           echo '<p> In cases where imported ads are missing images on the ad detail page, simply press the button to display the images. Prior to that, make sure the images are stored and properly assigned to the respective ads for the functionality to work correctly. </p>';
    }
}


if (!function_exists('adforest_make_ads_active')) {
    function adforest_make_ads_active($field, $value) {
            echo '<br><br><br>';
            echo '<a href="javascript:void(0)"  id="sb_make_ads_activated" class="button button-primary"> ' . esc_html__('Activate ads', 'adforest') . '<a>';
           echo '<p> Clicking on this will activate all inactive ads for the specified number of days .it might take couple of minutes if you have thousands of ads </p>';
    }
}