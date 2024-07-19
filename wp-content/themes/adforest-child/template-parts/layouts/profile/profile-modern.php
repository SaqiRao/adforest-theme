<?php global $adforest_theme; ?>
<?php
$author_id = get_query_var('author');
$author = get_user_by('ID', $author_id);
$user_pic = adforest_get_user_dp($author_id, 'adforest-user-profile');
$contact_num = get_user_meta($author->ID, '_sb_contact', true);
?>

<section class="profile-page st-profile-page">
<div class="container">
<div class="row">
<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
<?php require trailingslashit(get_stylesheet_directory()) . 'template-parts/layouts/profile/profile-header.php'; ?>
</div>
<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
<div class="row">
<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="add-phone">
        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <ul class="add-phone-list">
                    <li ><span><i class="icon fa fa-home"></i> <?php echo esc_html__('Located at:', 'adforest'); ?> </span> <?php echo get_user_meta($author->ID, '_sb_address', true); ?> </li>
                    <li class="hour-list"><span><i class="fa fa-calendar"></i><?php echo esc_html__('Last Active:', 'adforest') ?></span> <?php printf(_x('%s Ago', 'Last login time', 'adforest'), adforest_get_last_login($author->ID)); ?></li>

                    <?php if ($contact_num != "") {
                        if (adforest_showPhone_to_users()) {
                            $call_now = "javascript:void(0)";
                            $adforest_login_page = isset($adforest_theme['sb_sign_in_page']) ? $adforest_theme['sb_sign_in_page'] : '';
                            $adforest_login_page = apply_filters('adforest_language_page_id', $adforest_login_page);
                            if ($adforest_login_page != '') {

                                $redirect_url = adforest_login_with_redirect_url_param(adforest_get_current_url());
                                $call_now = $redirect_url;
                            }  ?>
                            <li> <a href="<?php echo esc_url($redirect_url); ?>" class="sb-click-num-user2 phone-list" id="show_ph_div" data-user_id="<?php echo esc_attr($author->ID); ?>">
                                    <span class="info-heading"><i class="fa fa-phone"></i> <?php echo esc_html__('Phone:', 'adforest') ?> </span>
                                    <span class="sb-phonenumber"><?php echo esc_html__('Login To View', 'adforest') ?></span>
                                </a></li>
                        <?php   } else { ?>
                            <li> <a href="javascript:void(0);" class="sb-click-num-user phone-list" id="show_ph_div" data-user_id="<?php echo esc_attr($author->ID); ?>">
                                    <span class="info-heading"><i class="fa fa-phone"></i> <?php echo esc_html__('Phone:', 'adforest') ?> </span>
                                    <span class="sb-phonenumber"><?php echo esc_html__('Click To View', 'adforest') ?></span>
                                </a></li>
                    <?php }
                    } ?>
                </ul>
            </div>
            <?php $profiles = adforest_social_profiles();

            if (is_array($profiles) && !empty($profiles)) {  ?>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="profile-social">

                        <div class="new-social-icons  custom-profile">
                            <h4><?php echo esc_html__('Social links', 'adforest') ?></h4>
                            <?php
                            $social_icons = '<ul class="list-inline">';

                            foreach ($profiles as $key => $value) {

                                if (get_user_meta($author->ID, '_sb_profile_' . $key, true) != "") {

                                    $social_icons .= '<li><a href="' . esc_url(get_user_meta($author->ID, '_sb_profile_' . $key, true)) . '" target="_blank"><i class="fa fa-' . $key . '"></i></a></li>';
                                }
                            }
                            $social_icons .= '</ul>';
                            echo adforest_returnEcho($social_icons);
                            ?>
                        </div>
                    </div>
                </div>

            <?php }  ?>
        </div>
    </div>
</div>
 <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="listing-head">
        <?php $auth_url = adforest_set_url_param(get_author_posts_url($author_id), 'type', 'ads');
        ?>
        <div class="found-adforest-sorting">
            <ul class="found-sort-item">

                <!-- // ad_type select Start -->
                 <span>Select Ads Type</span>
                <li>
                    <?php
                    $terms = get_terms(array(
                            'taxonomy' => 'ad_type',
                            'hide_empty' => false, 
                        ));
                       ?>
                    <form method="get" class="get_type"  action=" <?php echo $auth_url ?> ">
                        <select name="adtype" class="custom-select order_by" id="select-type"> 

                           <?php
                             $selectedAll = (empty($_GET['adtype']) || $_GET['adtype'] == 'all') ? 'selected' : '';
                             echo "<option value='all' $selectedAll>All</option>";
                           foreach ($terms as $term) {
                           $selectedOldest = ($_GET['adtype'] == $term->term_id) ? 'selected' : '';
                           echo  $term_option = "<option value= ". esc_attr($term->term_id) . "  ".$selectedOldest.">" . esc_html($term->name) . "</option>";
                            }
                            ?>
                        </select>
                    </form>
                 </li>
                <!-- // ad_type select End -->

                <span>Sort by</span>
                <li>
                    <?php
                    $selectedTitleAsc = $selectedLatest = $selectedTitleDesc = '';
                    if (isset($_GET['sort'])) {

                        $selectedOldest = ($_GET['sort'] == 'id-asc') ? 'selected' : '';
                        $selectedLatest = ($_GET['sort'] == 'id-desc') ? 'selected' : '';
                    }
                    ?>
                    <form method="get">
                        <select name="sort" class="custom-select order_by" id="select-sort">
                            <option value="id-desc" <?php echo esc_attr($selectedLatest); ?>>
                                <?php echo esc_html__('Desc', 'adforest'); ?></option>
                            <option value="id-asc" <?php echo esc_attr($selectedOldest); ?>><?php echo esc_html__('Asc', 'adforest'); ?></option>
                        </select>
                        <?php echo adforest_search_params('sort'); ?>
                    </form>
                </li>
                <?php
                $grid_view = adforest_custom_remove_url_query('view-type', 'grid');
                $list_view = adforest_custom_remove_url_query('view-type', 'list');
                if (isset($adforest_theme['search_layout_types']) && $adforest_theme['search_layout_types'] == true) {
                ?>
                    <li class="btn found-listing-icon <?php echo (is_rtl()) ? 'pull-left' : 'pull-right'; ?>">
                        <a class="filterAdType-count" href="<?php echo esc_url($grid_view); ?>" class="<?php echo (is_rtl()) ? 'pull-left' : 'pull-right'; ?>"><i class="fa fa-th"></i></a>
                    <li>
                    <li class="btn found-listing-icon-1 <?php echo (is_rtl()) ? 'pull-left' : 'pull-right'; ?>">
                        <a class="filterAdType-count" href="<?php echo esc_url($list_view); ?>" class="pull-right">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<div id="sb_loading" style="display: none;"></div>
<?php

    if (in_array('sb_framework/index.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    $selected_sort = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : 'id-desc';
    $ad_type = "";
    $category = "";
  
    if(isset($_GET['adtype']) && $_GET['adtype'] != ""){
       
       if($_GET['adtype'] == "all"){

       }
       else {

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
    'posts_per_page' => 10,
    'paged' => get_query_var('paged'),
    'tax_query' => array(
        $category,
        $ad_type,
      
    ),
    );
        // Apply sorting based on the selected option.
        if ($selected_sort === 'id-asc') {
            $args['orderby'] = 'ID';
            $args['order'] = 'ASC';
        } elseif ($selected_sort === 'id-desc') {
            $args['orderby'] = 'ID';
            $args['order'] = 'DESC';
        }
        $query = new WP_Query($args);
       // print_r($query);
        if ($query->have_posts()) {
            $total_posts = $query->found_posts;
            $posts_per_page = $query->get('posts_per_page');
            $total_pages = ceil($total_posts / $posts_per_page);

            while ($query->have_posts()) {
                $query->the_post();
                $pid = get_the_ID();

                if (isset($_GET['view-type']) && $_GET['view-type'] === 'list') {
                    
                    echo adforest_returnEcho(adforest_search_layouts_list_5($pid));
                } else {
                    echo adforest_returnEcho(adforest_search_layouts_grid_4($pid));
                }
            }
            wp_reset_postdata();
     ?>
    <div class="clearfix"></div>

    <div class="pagination-item">
        <?php 
       
        echo adforest_pagination_adss($query, $total_pages); ?>
    </div>
   <?php
    } else {

    $no_found =  get_template_directory_uri() . '/images/nothing-found.png';
     ?>
    <div class="col-xl-12 col-12 col-sm-12 col-md-12">
        <div class="nothing-found white">
            <img src="<?php echo esc_url($no_found); ?>" alt="">

            <h3><?php echo esc_html__('No Result Found', 'adforest') ?></h3>
        </div>
    </div>
<?php   }
} else {
$no_found =  get_template_directory_uri() . '/images/nothing-found.png';
?>
<div class="col-xl-12 col-12 col-sm-12 col-md-12">
    <div class="nothing-found white">
        <img src="<?php echo esc_url($no_found); ?>" alt="">
        <h3><?php echo esc_html__('No Result Found', 'adforest') ?></h3>
    </div>
</div>
<?php   }

?>
</div>
</div>
</div>
</div>
</section>