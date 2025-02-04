<?php
global $adforest_theme;
$sb_sign_in_page = apply_filters('adforest_language_page_id', isset($adforest_theme['sb_sign_in_page']) ? $adforest_theme['sb_sign_in_page'] : "");
$sb_sign_up_page = apply_filters('adforest_language_page_id', isset($adforest_theme['sb_sign_up_page']) ? $adforest_theme['sb_sign_up_page'] : "");
$sb_notification_page = apply_filters('adforest_language_page_id', isset($adforest_theme['sb_notification_page']) ? $adforest_theme['sb_notification_page'] : "");
$site_logo = isset($adforest_theme['sb_site_logo']['url']) ? $adforest_theme['sb_site_logo']['url'] : ADFOREST_IMAGE_PATH . "/footer-logo.png";
$responsive_logo = isset($adforest_theme['sb_site_logo_mobile']['url']) ? $adforest_theme['sb_site_logo_mobile']['url'] : ADFOREST_IMAGE_PATH . "/footer-logo.png";
$home_page_logo = isset($adforest_theme['sb_home_logo']['url']) ? $adforest_theme['sb_home_logo']['url'] : ADFOREST_IMAGE_PATH . "/logo.png";
$sb_profile_page = apply_filters('adforest_language_page_id', isset($adforest_theme['sb_profile_page']) ? $adforest_theme['sb_profile_page'] : "");
$user_id = get_current_user_id();
$header_ext_class = is_front_page() ? "" : "header_home";
$is_sticky_header = isset($adforest_theme['sb_sticky_header']) && $adforest_theme['sb_sticky_header'] ? '' : 'no-sticky  ';
if (isset($adforest_theme['sb_top_bar']) && $adforest_theme['sb_top_bar'] == true) {
    $top_bar_text = isset($adforest_theme['top_bar_text']) && !empty($adforest_theme['top_bar_text']) ? $adforest_theme['top_bar_text'] : '';
    $top_bar_contact = isset($adforest_theme['top_bar_contact']) && !empty($adforest_theme['top_bar_contact']) ? $adforest_theme['top_bar_contact'] : '';
    ?>
    <div class="sb-header-top3">	
        <section class="sb-mob-top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
                        <div class="sb-mob-bar-content">
                            <ul class="list-inline sb-top-social-icons"><?php if (!empty($top_bar_text)) { ?>
                                    <li><?php echo esc_html($top_bar_text); ?></li>
                                <?php } if (!empty($top_bar_contact)) { ?>
                                    <li><i class="fa fa-phone"></i><?php echo esc_html__('Call Us', 'adforest'); ?>:<?php echo esc_html($top_bar_contact); ?></li>
                                <?php } ?></ul>
                        </div>
                        <div class="sb-mob-top-bar-location"><?php do_action('adforest_topbar_location'); ?></div>
                    </div>
                    <div class="col-xs-12 col-sm-3  col-md-4 col-lg-4 ">
                        <div class="sb-mob-top-icons-area"><ul class="list-inline sb-top-main-contents"><?php foreach ($adforest_theme['social_media'] as $index => $val) { ?> <?php if ($val != "") { ?> <li><a <?php do_action('adforest_relation_follow_links'); ?>href="<?php echo esc_url($val); ?>"><i class="<?php echo adforest_social_icons($index); ?>"></i></a></li><?php }
                            } ?></ul></div>
                    </div>
                </div>
            </div>
        </section>
    </div>	
<?php } ?>
<div class="sb-header sb-header-7   <?php echo esc_attr($is_sticky_header); ?>">
    <div class="container-fluid" >
        <!-- sb header -->
        <div class="sb-header-container">
            <!--Logo-->
            
            <div class="row">
                <div class="col-xxl-10 col-xl-10 col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                            <div class="logo" data-mobile-logo="<?php echo esc_url($responsive_logo) ?>" data-sticky-logo="<?php echo esc_url($responsive_logo) ?>">

                                <a href="<?php echo home_url('/'); ?>"><img src="<?php echo esc_url($site_logo); ?>" alt="<?php echo esc_html__('logo', 'adforest') ?>"></a>
                            </div>
                            <div class="burger-menu">
                                <div class="line-menu line-half first-line"></div>
                                <div class="line-menu"></div>
                                <div class="line-menu line-half last-line"></div>
                            </div>
                            <!--Navigation menu-->      
                            <nav class="sb-menu menu-caret submenu-top-border submenu-scale mega-menu menu-6">
                                <?php get_template_part('template-parts/layouts/main', 'nav'); ?>
                            </nav>
                        </div>

                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <?php
                            $search_title = '';
                            if (isset($_GET['ad_title']) && $_GET['ad_title'] != "") {
                                $search_title = $_GET['ad_title'];
                            }

                            $sb_search_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_search_page']);
                            ?>
                            <form class="form-inline header-6-form" method="get" action="<?php echo urldecode(get_the_permalink($sb_search_page)); ?>">
                                <div class="form-group">
                                    <input id ="lokking-for" placeholder="<?php echo __('What Are You Looking For ?', 'adforest'); ?>" type="text" name="ad_title" class="form-control" value="<?php echo esc_attr($search_title); ?>" autocomplete="off"><span class="adforest-spinner" style="display:none"><i class="fa fa-spinner spin"></i></span>
                                </div>
<?php apply_filters('adforest_form_lang_field', true); ?>
                                <button class="btn btn-theme" type="submit"><i class="fa fa-search"></i></button>
                            </form>



                        </div>
                    </div>
                </div>
                <div class="col-xxl-2 col-xl-2 col-lg-12 col-md-12 col-sm-12">
                    <div class="sign-in-up">
                        <ul class="list-sign-in ">
                            <?php
                            $user_id = get_current_user_id();
                            $user_info = get_userdata($user_id);
                            if (is_user_logged_in() && isset($adforest_theme['communication_mode']) && ( $adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'message' )) {
                                ?>
                                <li class="sb-bg-blue p-relative"> 
                                    <a href="<?php echo get_the_permalink($sb_notification_page); ?>"><i class="fa fa-envelope"></i>
                                        <div class="sb-notify"><?php $unread_msgs = ADFOREST_MESSAGE_COUNT;
                                    if ($unread_msgs > 0) {
                                        $msg_count = $unread_msgs; ?>
                                                <span class="sb-heartbit"></span><span class="point"></span></div>
                                <?php } ?></a> </li>
                            <?php
                            }
                            if (!is_user_logged_in()) {
                                echo '<li class="login-me"><a href="' . get_the_permalink($sb_sign_in_page) . '"><i class="fa fa-sign-in" aria-hidden="true"></i></a></li>
                                      <li class="register-me"><a href="' . get_the_permalink($sb_sign_up_page) . '" class=""><i class="fa fa-unlock" aria-hidden="true"></i></a></li>
                                         ';
                            } else {
                                ?>
                                <li class="user-loged-5"> 
                                    <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"  class="login-user">
    <?php
    $unread_msgs = ADFOREST_MESSAGE_COUNT;
    ?> 
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </a>                                  

                                    <ul class="dropdown-user-login">
                                        <li><a href="<?php echo get_the_permalink($sb_profile_page); ?>"><i class="fa fa-user"></i> <?php echo __("Profile", "adforest"); ?></a></li>
                                        <?php echo apply_filters('adforest_vendor_dashboard_profile', '', $user_id); ?>
                                        <?php
                                        if (isset($adforest_theme['communication_mode']) && ( $adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'message' )) {
                                            ?>
                                            <li><a href="<?php echo adforest_set_url_param(trailingslashit(get_the_permalink($sb_profile_page)), 'page_type', 'msg'); ?>"><i class="fa fa-envelope"></i> <?php echo __('Messages', 'adforest'); ?> <span class="badge"><?php echo esc_html($unread_msgs); ?></span></a></li>
        <?php
    } if (isset($adforest_theme['sb_cart_in_menu']) && $adforest_theme['sb_cart_in_menu'] && in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
        global $woocommerce;
        ?>
                                            <li><a href="<?php echo wc_get_cart_url(); ?>"><i class="fa fa-shopping-cart"></i> <?php echo __('Cart', 'adforest'); ?> <span class="badge"><?php echo adforest_returnEcho($woocommerce->cart->cart_contents_count); ?></span></a></li> <?php } ?>
                                       
                                        <li><a href="<?php echo wp_logout_url(get_the_permalink($sb_sign_in_page)); ?>"><i class="fa fa-power-off"></i> <?php echo __("Logout", "adforest"); ?></a></li>
                                    </ul>
                                </li>
<?php } ?>
                            <li class="ad-post-btn"><?php get_template_part('template-parts/layouts/ad', 'button') ?></li>
                        </ul>
                    </div>
                </div>
            </div>   
        </div>
    </div>
    <div class="header-shadow-wrapper">
    </div>
</div>