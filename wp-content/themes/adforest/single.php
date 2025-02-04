<?php get_header(); ?>
<?php global $adforest_theme; ?>
<?php
if (have_posts()) {
                while (have_posts()) {
                                the_post();
?>
<div class="main-content-area clearfix">
<section class="section-padding  pattern-bgs gray">
    <div class="container">
        <div class="row">
            <?php if (isset($adforest_theme['blog_sidebar']) &&  $adforest_theme['blog_sidebar'] == 'left') get_sidebar(); ?>
            <?php if (isset($adforest_theme['blog_sidebar']) && $adforest_theme['blog_sidebar'] == 'no-sidebar') { ?>
                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                    <?php    
                                }
                                else { ?>
                    <div class="col-md-8 col-xs-12 col-sm-12 col-lg-8">
                        <?php
                                } ?>
                                     <?php 
                        if(isset($adforest_theme['single_post_advertisment_top']) &&   $adforest_theme['single_post_advertisment_top'] != ""){
                           echo $adforest_theme['single_post_advertisment_top'];
                                 }
                             ?>
                    <div class="single-blog blog-detial">
                        <div class="blog-post">
                            <?php
                                $no_img   = 'no-img';
                                $response = adforest_get_feature_image(get_the_ID() , 'adforest-single-post');
                                if (isset($response) && !empty($response) && isset($response[0]) && $response[0] != "") {
                                                $no_img   = '';
                                ?>
                                <div class="post-img">
                                    <a href="javascript:void(0);"><img class="img-fluid" src="<?php echo esc_url($response[0]); ?>" alt="<?php the_title(); ?>"></a>
                                </div>
                                <?php } ?>
                            <div class="post-info <?php echo esc_attr($no_img); ?>">
                                <a href="javascript:void(0);"><?php the_author(); ?></a>
                                <a href="javascript:void(0);"><?php echo adforest_get_date(get_the_ID()); ?></a>
                                <a href="javascript:void(0);"><?php echo adforest_get_comments(); ?></a>
                            </div>
                            <h1 class="post-title">
                               <?php the_title(); ?>
                            </h1>
                            <div class="post-excerpt post-desc">
                                <?php the_content(); ?>
                                            <?php 
                 if(isset($adforest_theme['single_post_advertisment_bottom']) &&   $adforest_theme['single_post_advertisment_bottom'] != ""){
                           echo $adforest_theme['single_post_advertisment_bottom'];
                      }

?>
                                <div class="col-md-12 add-pages margin-top-20">
                                    <?php
                                $args = array(
                                                'before' => '',
                                                'after' => '',
                                                'link_before' => '<span class="btn btn-default">',
                                                'link_after' => '</span>',
                                                'next_or_number' => 'number',
                                                'separator' => ' ',
                                                'nextpagelink' => esc_html__('Next >>', 'adforest') ,
                                                'previouspagelink' => esc_html__('<< Prev', 'adforest') ,
                                                'highlight' => 'iAmActive'
                                );

                                wp_link_pages($args); ?>
                                </div>
                                <div class="clearfix"></div>
                                <div class="tags-share clearfix">
                                    <div class="tags pull-left">
                                        <?php
                                $posttags = get_the_tags();
                                $count    = 0;
                                $tags     = '';

                                if ($posttags) { ?>
                                            <i class="fa fa-tags"></i>
                                            <ul>
                                                <?php foreach ($posttags as $tag) { ?>
                                                    <li>
                                                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" title="<?php echo esc_attr($tag->name); ?>">
                                                            #<?php echo esc_attr($tag->name); ?>
                                                        </a>
                                                    </li>
                                                    <?php
                                                } ?>
                                            </ul>
                                            <?php
                                } ?>
                                    </div>
                                </div>
                                <?php if (isset($adforest_theme['enable_share_post']) && $adforest_theme['enable_share_post']) { ?>
                                    <div class="share pull-right">
                                        <ul><?php echo adforest_social_share(); ?></ul>
                                    </div>
                                    <?php
                                } ?>
                                <div class="clearfix"></div>
                                <?php comments_template('', true); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                                if (isset($adforest_theme['blog_sidebar']) && $adforest_theme['blog_sidebar'] == 'right') get_sidebar();

                                if (!isset($adforest_theme['blog_sidebar'])) get_sidebar();
?>
            </div>
        </div>
</section>
</div>
<?php
                }
}
else {
                get_template_part('template-parts/content', 'none');
}
?>
<?php get_footer(); ?>