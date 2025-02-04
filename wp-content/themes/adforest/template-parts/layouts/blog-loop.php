<?php global $adforest_theme; ?>
<?php
if (have_posts()) {
    $cols = '';
    if (isset($adforest_theme['blog_sidebar']) && $adforest_theme['blog_sidebar'] == 'no-sidebar') {
        $cols = 'col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12';
    } else {
        $cols = 'col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12';
    }
    while (have_posts()) {
        the_post();
        ?>
        <div class="<?php echo esc_attr($cols); ?>">
            <div class="blog-post">
                <div <?php post_class(); ?>>
                    <?php
                    $no_img = 'no-img';
                    $response = adforest_get_feature_image(get_the_ID(), 'adforest_single_product');
                    if (isset($response[0]) && $response[0] != "") {
                        $no_img = '';
                        ?><div class="post-img"><a href="<?php the_permalink(); ?>"><img class="img-fluid" src="<?php echo esc_url($response[0]); ?>" alt="<?php the_title(); ?>"></a></div>
                    <?php } ?>



                    <div class="post-content">
                        <div class="post-info <?php echo esc_attr($no_img); ?>">
                        <i class="fa fa-calendar" aria-hidden="true"></i>    <a href="javascript:void(0);"><?php echo adforest_get_date(get_the_ID()); ?></a>

                        </div>
                        <h2 class="post-title"><a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h2>
                        <?php if (get_the_excerpt() != "") { ?><p class="post-excerpt"><?php echo adforest_words_count(get_the_excerpt(),200); ?></p><?php } ?>
                    </div>

                    <div class="post-info-date">
                        <a href="javascript:void(0);"><?php echo adforest_get_comments(); ?></a>
                        <a href="<?php the_permalink(); ?>"><strong><?php echo __('Read More', 'adforest'); ?></strong></a>
                    </div> 
                </div>
            </div>
        </div>
        <?php
    }
} else {
    get_template_part('template-parts/content', 'none');
}
?>