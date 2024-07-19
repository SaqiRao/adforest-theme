<div class="panel panel-default">
<div class="panel-heading" role="tab" id="headingEight">
    <h4 class="ad-widget-title"><a class="collapsed" role="button" data-bs-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="true" aria-controls="collapseEight"><i class="more-less fa fa-plus"></i>
            <?php echo esc_html($title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title'])); ?></a></h4>
</div>
    <?php
   if (isset($instance['open_widget']) && $instance['open_widget'] == '1') { $expand = 'show';}
    global $wp;
   $user_types = isset($_GET['user_type']) ? $_GET['user_type'] : "";
               // User type Search Start
    $html_user_search = "";
  //  if(isset($is_display_currency) && $is_display_currency != 0){
        $user_type = "";
        $taxonomy = 'premium_badge';
        if(isset($taxonomy) &&  $taxonomy != ""){
        $terms = get_terms(array(
            'taxonomy' => $taxonomy,
            'hide_empty' => false, // Set to true if you want to hide empty terms
        ));
        foreach ($terms as $term) : 
            $user_type .= '<option value="' . esc_html($term->term_id) . '" ' . selected($user_types, $term->term_id, false) . '>' . esc_html($term->name) . '</option>';
        endforeach;
        }
        $html_user_search .= '<select class=" form-control" name="user_type"  id="user-type-select" data-placeholder="' . __('Select User Type', 'adforest') . '">
        <option label="' . __('Select User Type', 'adforest') . '" value="">' . __('Select User Type', 'adforest') . '</option>
                ' . $user_type . '
        </select>';
  //  }
    ?>
    <form method="get" class="get_user_type" action="<?php echo get_the_permalink()?>" >
        <div id="collapseEight" class="panel-collapse collapse <?php echo esc_attr($expand); ?>" role="tabpanel" aria-labelledby="headingFive">
            <div class="panel-body">
                <div class="search-widget">
          <?php
              echo $html_user_search ;
          ?>      
                </div>
            </div>
        </div>
        <?php
        echo adforest_search_params('user_type');
        ?>
    </form>
</div>