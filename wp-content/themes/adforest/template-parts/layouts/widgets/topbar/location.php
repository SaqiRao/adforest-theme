<?php
$sb_search_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_search_page']);
?>
<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
    <form method="get" action="<?php echo get_the_permalink($sb_search_page); ?>">
        <div class="form-group">
            <label><?php
                $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
                echo esc_html($title);
                ?>
            </label>
            <div class="input-group add-on">
                <input class="form-control" placeholder="<?php echo esc_html($title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title'])); ?>" type="text" name="location" value="<?php echo esc_attr($location); ?>" id="sb_user_address" />           
            </div>
        </div>
        <?php
        echo adforest_search_params('location');
        ?>
    </form>
    <?php
    adforest_widget_counter();
    ?>
</div>
<?php adforest_advance_search_container(); ?>