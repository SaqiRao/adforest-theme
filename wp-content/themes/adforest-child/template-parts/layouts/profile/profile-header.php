<?php
$allow_whizchat = isset($adforest_theme['sb_ad_whizchat_chat']) ? $adforest_theme['sb_ad_whizchat_chat'] : false;
?>
<div class="profile-content">
    <!-- Profile Header -->
    <div class="profile-header">
        <!-- Profile Image -->
        <?php
        
        $image_tags = get__user_premium_meta($author->ID);
        $image_count = 1;
        if (!empty($image_tags) && is_array($image_tags)) {
            echo "<div class='premium_tag_outer'>";
        
            foreach ($image_tags as $image_tag) {
                echo $image_tag;
        
                // If it's the fourth element or the last element, close the first div and open a new one
                if ($image_count % 4 == 0 || $image_count == count($image_tags)) {
                    echo "</div>";
                    if ($image_count != count($image_tags)) {
                        echo "<div class='premium_tag_outer_right'>";
                    }
                }
        
                $image_count++;
            }
        } else {
            echo ""; // handle the case where the array is empty
        } 
        ?>
        <div class="profile-main-img">
            <!-- Profile Picture Link -->
            <a href="<?php echo adforest_set_url_param(get_author_posts_url($author->ID), 'type', 'ads'); ?>">
                <img src="<?php echo esc_attr($user_pic); ?>" id="user_dp" alt="<?php echo __('Profile Picture', 'adforest'); ?>" class="img-fluid">
            </a>
            <!-- Verified Badge -->
            <?php
            if (get_user_meta($author->ID, '_sb_is_ph_verified', true) == '1') {
            ?>
                <i class="fa fa-check-circle <?php echo get_user_meta($author->ID, '_sb_badge_type', true); ?>"></i>
            <?php
            }
            ?>
        </div>
        <!-- Profile Heading -->
        <div class="profile-heading">
            <h4><a href="<?php echo adforest_set_url_param(get_author_posts_url($author->ID), 'type', 'ads'); ?>"><?php echo esc_html($author->display_name); ?></a></h4>
            <p>
                <?php
                $user_id = $author->ID;
                $user_info = get_userdata($user_id);
                if ($user_info) {
                    $member_since_date = $user_info->user_registered;
                    $formatted_date = date('F j, Y', strtotime($member_since_date));
                    echo 'Member Since: ' . $formatted_date;
                }
                ?>
            </p>
            <!-- Detail Message -->
            <div class="detail-msg">

                <?php if ($allow_whizchat) { ?>
                    <a href="javascript:void(0)" class="btn btn-whizchat chat_toggler" id="contact_authss" data-page_id="0" data-user_id="<?php echo esc_attr($user_id) ?>">
                        <i class="fa fa-commenting-o"></i>
                        <span class=""><?php echo __('Live chat', 'adforest'); ?></span>
                    </a>
                <?php } ?>
            </div>
        </div>
        <!-- User Type -->
        <?php
        $user_type = '';
        if (get_user_meta($author->ID, '_sb_user_type', true) == 'Indiviual') {
            $user_type = __('Individual', 'adforest');
        } else if (get_user_meta($author->ID, '_sb_user_type', true) == 'Dealer') {
            $user_type = __('Dealer', 'adforest');
        }
        if ($user_type != "") {
        ?>
            <div class="profile-dealer"><span class="pro-dealer"><?php echo adforest_returnEcho($user_type); ?></span></div>
        <?php }
        if (get_user_meta($author->ID, '_sb_badge_text', true) != "" && isset($adforest_theme['sb_enable_user_badge']) && $adforest_theme['sb_enable_user_badge']) {
        ?>
            <div class="profile-dealer verify-bage"><span class="pro-dealer2 label <?php echo get_user_meta($author->ID, '_sb_badge_type', true); ?>"><?php echo adforest_returnEcho(get_user_meta($author->ID, '_sb_badge_text', true)); ?></span></div>
        <?php } ?>
    </div>

    <!-- Categories -->
    <?php
    //$author_id = $author->ID;

    $ad_type = "";
    $category = "";


    if (isset($_GET['adtype']) && $_GET['adtype'] != "") {

        if ($_GET['adtype'] == "all") {
        } else {

            $ad_type = array(
                array(
                    'taxonomy' => 'ad_type',
                    'field' => 'term_id',
                    'terms' => array($_GET['adtype']),
                ),
            );
        }
    }
    if (isset($_GET['cat_id']) && $_GET['cat_id'] != "") {
        $category = array(
            array(
                'taxonomy' => 'ad_cats',
                'field' => 'term_id',
                'terms' => array($_GET['cat_id']),
            ),
        );
    }

    $args = array(
        'post_type' => 'ad_post',
        'post_status' => 'publish',
        'author__in' => array($author_id),
        'posts_per_page' => -1,
        'tax_query' => array(
            $category,
            $ad_type,
        ),
    );

    $args = array(
        'post_type' => 'ad_post',
        'post_status' => 'publish',
        'author__in' => array($author_id),
        'posts_per_page' => -1,

    );
    
    
    

    $ad_posts_query = new WP_Query($args);
    $category_ids = array();
    if ($ad_posts_query->have_posts()) {
    ?>
<div class="categories">
<h3> Categories </h3>
<form method="get" id="search_cats_w" action="<?php echo esc_url(get_author_posts_url($author_id)); ?>">
<?php
while ($ad_posts_query->have_posts()) {
    $ad_posts_query->the_post();

    $categories = wp_get_post_terms(get_the_ID(), 'ad_cats');


    if ($categories && !is_wp_error($categories)) {
        foreach ($categories as $category) {
            $category_ids[] = $category->term_id;
        }
    }
}
wp_reset_postdata();
$category_ids = array_unique($category_ids);
//print_r($category_ids);



$ad_cats = adforest_get_cats('ad_cats', 0);

$current_cat_id = (isset($_GET['cat_id']) && $_GET['cat_id'] != "") ? $_GET['cat_id'] : '';
$ancestor_ids = get_ancestors($current_cat_id, 'ad_cats');


if ($current_cat_id != "" && !in_array($current_cat_id, $ancestor_ids)) {
   // array_push($ancestor_ids, $current_cat_id);
    $category_ids    =   array_merge($category_ids , $ancestor_ids );
    //print_r($category_ids);
}


if (count($ad_cats) > 0) {
?>
    <div class="panel-body categories">
        <input type="hidden" id="ad_admin-ajaxx" value=<?php echo admin_url('admin-ajax.php') ?> />
        <?php
        if (isset($_GET['cat_id']) && $_GET['cat_id'] != "") {
            $selected_cats = adforest_get_taxonomy_parents($_GET['cat_id'], 'ad_cats', false);
            $find = '&raquo;';
            $replace = '';
            $selected_cats = preg_replace("/$find/", $replace, $selected_cats, 1);
        }
        ?>
        <ul>
            <div class="accordion" id="accordionExample">
                <?php
                $id = '';
                foreach ($ad_cats as $ad_cat) {
                    $is_open = 'collapsed';
                    $category = get_term($ad_cat->term_id);
                    $count = ($ad_cat->count);
                    if ($count == 0 || !in_array($ad_cat->term_id, $category_ids)) {
                        continue;
                    }
                    $cat_meta = get_option("taxonomy_term_$ad_cat->term_id");
                    $icon = isset($cat_meta['ad_cat_icon']) ? $cat_meta['ad_cat_icon'] : '';
                    $auth_url = adforest_set_url_param(get_author_posts_url($author_id), 'type', 'ads');
                    $cat_search_page = add_query_arg(array('cat_id' => $ad_cat->term_id), $auth_url, 'ads');
                    $id = $ad_cat->term_id;

                    $is_open = (isset($ancestor_ids) && in_array($id, $ancestor_ids)) ? "open" : 'collapsed';
                    $is_open_Body = (isset($ancestor_ids) && in_array($id, $ancestor_ids)) ? "open" : 'collapse';
                    // $is_open_exp = (isset($ancestor_ids) && in_array($id, $ancestor_ids)) ? "true" : 'collapsed';


                    $li_class_a = (isset($ancestor_ids) && in_array($ad_cat->term_id, $ancestor_ids)) ? 'class="custom-profile-cats-sub-sidebar-main"' : '';

                ?>
                    <div class="accordion-item">
                        <li <?php echo $li_class_a; ?>>
                            <!-- Head -->
                            <div class="accordion-header" id="headingOne<?php echo $id ?>">
                                <button class="accordion-button <?php echo $is_open; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $id ?>" aria-expanded="false" aria-controls="collapseOne<?php echo $id; ?>">
                                    <a href="<?php echo esc_url($cat_search_page); ?>" data-cat-id="<?php echo esc_attr($ad_cat->term_id); ?>" class="cat_link main-a" id="cat_display">
                                        <?php echo esc_html($ad_cat->name); ?>
                                    </a>
                                </button>
                            </div>
                            <!-- Subcategories -->
        <ul>
        <div id="collapseOne<?php echo $id ?>" class="accordion-collapse <?php echo $is_open_Body; ?>" aria-labelledby="headingOne<?php echo $id ?>" data-bs-parent="#accordionExample">
        <div class="accordion-body">
        <?php
        $add_cats = adforest_get_cats('ad_cats', $ad_cat->term_id);
        foreach ($add_cats as $add_cat) {
            $category = get_term($add_cat->term_id);
            $count = ($add_cat->count);
             //print_r($count);
            if ($count == 0 || !in_array($add_cat->term_id, $category_ids)) {
               //print_r($count);
                continue;
            }
            $catch_search_page = add_query_arg(array('cat_id' => $add_cat->term_id), $auth_url, 'ads');

            $li_class_a = (isset($ancestor_ids) && in_array($add_cat->term_id, $ancestor_ids)) ? 'class="custom-profile-cats-sub-sidebar-1"' : '';

        ?>
            <li <?php echo $li_class_a; ?>>
                <a href="<?php echo esc_url($catch_search_page); ?>" data-cat-id="<?php echo esc_attr($add_cat->term_id); ?>" class="cat_link  sub-a-1" id="cat_display">
                    <?php echo   "-" . esc_html($add_cat->name); ?>
                </a>
                <!-- Sub-subcategories -->
                <ul>
                    <?php
                    $add_cats1 = adforest_get_cats('ad_cats', $add_cat->term_id);
                    foreach ($add_cats1 as $ad_cat1) {
                        $category = get_term($ad_cat1->term_id);
                        //print_r($category);
                        $count = ($ad_cat1->count);

                        if ($count == 0 || !in_array($ad_cat1->term_id, $category_ids)) {
                            continue;
                        }

                        $add_cats2 = adforest_get_cats('ad_cats', $ad_cat1->term_id);

                        $catgry_search_page = add_query_arg(array('cat_id' => $ad_cat1->term_id), $auth_url, 'ads');
                        $li_class_2 = '';
                        $li_class_2 = (isset($ancestor_ids) && in_array($add_cat->term_id, $ancestor_ids)) ? 'class="custom-profile-cats-sub-sidebar-2"' : '';
                    ?>
                        <li <?php echo $li_class_2; ?>>
                            <a href="<?php echo esc_url($catgry_search_page); ?>" data-cat-id="<?php echo esc_attr($ad_cat1->term_id); ?>" class="cat_link sub-a-2" id="cat_display">
                                <?php echo "--" . esc_html($ad_cat1->name); ?>
                            </a>
                            <?php
                            if (is_array($add_cats2) && !empty($add_cats2)) {
                                echo "<ul>";
                                foreach ($add_cats2 as $ad_cat2) {
                                    $category_level_3 = get_term($ad_cat2->term_id);
                                    if (!is_wp_error($category_level_3)) {

                                        if ($count == 0 || !in_array($ad_cat2->term_id, $category_ids)) {
                                            continue;
                                        }

                                        $catgry_search_page = add_query_arg(array('cat_id' => $ad_cat2->term_id), $auth_url, 'ads');
                                        $li_class_3 = '';
                                       
                                        $li_class_3 = (isset($ancestor_ids) && in_array($add_cat->term_id, $ancestor_ids)) ? 'class="custom-profile-cats-sub-sidebar-3"' : '';
                            ?>
                        <li <?php echo $li_class_3; ?>>
                            <a href="<?php echo esc_url($catgry_search_page); ?>" data-cat-id="<?php echo esc_attr($ad_cat2->term_id); ?>" class="cat_link sub-a-3" id="cat_display">
                                <?php echo "---" . esc_html($ad_cat2->name); ?>
                            </a>
                        </li>
            <?php

                }
            }
            echo "</ul>";
        }
            ?>
            </li>
        <?php } ?>
        </ul>
        </li>
        <?php } ?>
        </div>
        </div>
        </ul>
        </li>
    </div>
<?php } ?>
        </div>
        </ul>
        <style type="text/css">
            .custom-profile-cats-sidebar a {
                color: #ffc220;
            }

            li.custom-profile-cats-sub-sidebar-main a.main-a {
                color: #ffc220;
            }

            li.custom-profile-cats-sub-sidebar-1 a.sub-a-1 {
                color: #ffc220 !important;
            }

            li.custom-profile-cats-sub-sidebar-2 a.sub-a-2 {
                color: #ffc220 ;
            }

            li.custom-profile-cats-sub-sidebar-3 a.sub-a-3 {
                color: #ffc220;
            }
        </style>
</div>
<?php } ?>
<div id="sb_loading" style="display: none;"></div>
<input type="hidden" name="cat_id" id="cat_id" value="" />
<?php echo adforest_search_params('cat_id'); ?>
<?php apply_filters('adforest_form_lang_field', true); ?>
</form>
</div>
<?php } ?>

<!-- Introduction -->
<?php if (get_user_meta($author_id, '_sb_user_intro', true) != "") { ?>
    <div class="profile-introduction">
        <h3><?php echo __('Introduction', 'adforest'); ?></h3>
        <p><?php echo get_user_meta($author_id, '_sb_user_intro', true); ?></p>
    </div>
<?php } ?>

<!-- Contact Form Modal -->
<?php
if (isset($adforest_theme['sb_user_profile_sc'])) {
    if ($adforest_theme['sb_user_profile_sc'] == "") {
        return;
    }
}

if (isset($adforest_theme['user_contact_form']) && $adforest_theme['user_contact_form']) {
    $captcha_type = isset($adforest_theme['google-recaptcha-type']) && !empty($adforest_theme['google-recaptcha-type']) ? $adforest_theme['google-recaptcha-type'] : 'v2';
    $site_key = isset($adforest_theme['google_api_key']) && !empty($adforest_theme['google_api_key']) ? $adforest_theme['google_api_key'] : '';
    $contact_form_recaptcha = isset($adforest_theme['contact_form_recaptcha']) && !empty($adforest_theme['contact_form_recaptcha']) ? $adforest_theme['contact_form_recaptcha'] : '';
    $author_privacy_page = isset($adforest_theme['author_privacy_page']) && $adforest_theme['author_privacy_page'] != '' ? $adforest_theme['author_privacy_page'] : '';
?>
    <div class="modal fade resume-action-modal" id="myModal-job">
        <div class="modal-dialog">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="user-contact-message">
                        <h2 class="main-title text-left"><?php echo __('Contact', 'adforest'); ?></h2>
                        <!-- User Contact Form -->
                        <form id="user_contact_form">
                            <div class="seller-form-group">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" aria-describedby="emailHelp" placeholder="<?php echo __('Name', 'adforest'); ?>" data-parsley-required="true" data-parsley-error-message="<?php echo __('This field is required.', 'adforest'); ?>">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="<?php echo __('Email', 'adforest'); ?>" data-parsley-required="true" data-parsley-error-message="<?php echo __('This field is required.', 'adforest'); ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="subject" aria-describedby="emailHelp" placeholder="<?php echo __('Subject', 'adforest'); ?>" data-parsley-required="true" data-parsley-error-message="<?php echo __('This field is required.', 'adforest'); ?>">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="message" rows="3" placeholder="<?php echo __('Message', 'adforest'); ?>" data-parsley-required="true" data-parsley-error-message="<?php echo __('This field is required.', 'adforest'); ?>"></textarea>
                                </div>
                                <?php
                                $captcha = '<input type="hidden" value="no" name="is_captcha" />';
                                if (isset($contact_form_recaptcha) && $contact_form_recaptcha) {
                                    if ($captcha_type == 'v2') {
                                        if ($site_key != "") {
                                            $captcha = '<div class="form-group">
                                                <div class="g-recaptcha" data-sitekey="' . $site_key . '"></div>
                                            </div>
                                            <input type="hidden" value="yes" name="is_captcha" />';
                                        }
                                    } else {
                                        $captcha = '<input type="hidden" value="yes" name="is_captcha" />';
                                    }
                                }
                                echo adforest_returnEcho($captcha);

                                if (isset($author_privacy_page) && $author_privacy_page != '') {
                                ?>
                                    <div class="form-group checkbox-wrap sb-author-policy">
                                        <input type="checkbox" name="author_policy_checkbox" id="author_policy_checkbox" data-parsley-required="true" data-parsley-error-message="<?php echo __('Please accept the terms and policy.', 'adforest'); ?>" />
                                        <label for="author_policy_checkbox">
                                            <?php echo __(' I agree with the site. ', 'adforest') ?>
                                            <a href="<?php echo esc_url(get_permalink($author_privacy_page)); ?>" target="_blank">
                                                <?php echo __('Terms and Policy', 'adforest'); ?>
                                            </a>
                                        </label>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="sellers-button-group">
                                <button class="btn btn-msg-send btn-theme" type="submit"><?php echo __('Send Message', 'adforest'); ?></button>
                                <input type="hidden" id="receiver_id" value="<?php echo esc_attr($author_id); ?>" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
</div>