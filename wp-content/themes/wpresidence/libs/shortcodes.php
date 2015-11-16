<?php
////////////////////////////////////////////////////////////////////////////////
// place list 
////////////////////////////////////////////////////////////////////////////////

if (!function_exists('wpestate_places_list_function')):

    function wpestate_places_list_function($attributes, $content = null) {
        global $full_page;
        global $is_shortcode;
        global $row_number_col;
        global $place_id;
        global $place_per_row;
        $is_shortcode = 1;
        $place_list = '';
        $return_string = '';
        $extra_class_name = '';

        $attributes = shortcode_atts(
                array(
            'place_list' => '',
            'place_per_row' => 4,
            'extra_class_name' => '',
                ), $attributes);


        $post_number_total = $attributes['place_per_row'];
        if (isset($attributes['place_per_row'])) {
            $row_number = $attributes['place_per_row'];
        }


        // max 4 per row
        if ($row_number > 4) {
            $row_number = 4;
        }

        if ($row_number == 4) {
            $row_number_col = 3; // col value is 3 
        } else if ($row_number == 3) {
            $row_number_col = 4; // col value is 4
        } else if ($row_number == 2) {
            $row_number_col = 6; // col value is 6
        } else if ($row_number == 1) {
            $row_number_col = 12; // col value is 12
            if ($attributes['align'] == 'vertical') {
                $row_number_col = 0;
            }
        }


        if (isset($attributes['place_list'])) {
            $place_list = $attributes['place_list'];
        }
        if (isset($attributes['place_per_row'])) {
            $place_per_row = $attributes['place_per_row'];
        }

        if ($place_per_row > 5) {
            $place_per_row = 5;
        }

        if (isset($attributes['extra_class_name'])) {
            $extra_class_name = $attributes['extra_class_name'];
        }



        $all_places_array = explode(',', $place_list);




        ob_start();

        foreach ($all_places_array as $place_id) {
            $place_id = intval($place_id);
            get_template_part('templates/places_unit');
        }

        $return_string = '<div class="article_container">' . ob_get_contents() . '</div>';
        ob_end_clean();
        return $return_string;
    }

endif;



////////////////////////////////////////////////////////////////////////////////////////////
///  shortcode - users list
////////////////////////////////////////////////////////////////////////////////////////////


if (!function_exists('wpestate_list_users_function')):

    function wpestate_list_users_function() {
     
        $sql = 'SELECT * FROM w4a_users AS u JOIN fl_user_data as fud ON fud.id_user = u.ID WHERE fud.user_status IN (1,2) GROUP BY u.ID LIMIT 4;';
         
        global $wpdb;
             
        $query = $wpdb->get_results($sql);
         
        $currency = esc_html(get_option('wp_estate_currency_symbol', ''));
        $where_currency = esc_html(get_option('wp_estate_where_currency_symbol', ''));
         
        ob_start(); 
        foreach ($query as $q) { 
        $fl_user_data = get_fl_data($q->ID);
        $first_name = esc_attr(get_the_author_meta('first_name', $q->ID));
        $last_name = esc_attr(get_the_author_meta('last_name', $q->ID));
        $user_facebook = get_the_author_meta('facebook', $q->ID);
        $user_twitter = get_the_author_meta('twitter', $q->ID);
        $user_linkedin = get_the_author_meta('linkedin', $q->ID);
        $user_pinterest = get_the_author_meta('pinterest', $q->ID);
        $photo_url = get_the_author_meta('custom_picture', $q->ID); 
        $user_gender = !empty($fl_user_data->user_gender) ? $fl_user_data->user_gender : '';
        $user_age = !empty($fl_user_data->user_age) ? $fl_user_data->user_age : '';
        $looking_where = !empty($fl_user_data->looking_where) ? $fl_user_data->looking_where : '';
        $rent_amount = !empty($fl_user_data->rent_amount) ? $fl_user_data->rent_amount : ''; 
            $user_gender_array = array(
                '2' => __('female', 'wpestate'),
                '1' => __('male', 'wpestate')
            ); 
            $author_url = esc_url(get_author_posts_url($q->ID));
            $thumb_prop = '<img src="' . $photo_url . '" alt="agent-images">';

            if ($photo_url == '') {
                $thumb_prop = '<img src="' . get_template_directory_uri() . '/img/default_user.png" alt="agent-images">';
            }
            ?> 
            <div class="col-md-3 listing_wrapper">
                <div class="agent_unit" data-link="<?php print $author_url; ?>"> 
                    <div class="agent-unit-img-wrapper person-<?php echo (int) $q->ID ?>">
                        <?php
                        print $thumb_prop;
                        print '<div class="listing-cover"></div>
                            <a href="' . $author_url . '"> <span class="listing-cover-plus">+</span></a>';
                        
                        print '<span class="user_euro_unit">';
                
                        if ($rent_amount != '') {
                            print __('', 'wpestate') . ' ' . wpestate_show_price_floor($rent_amount, $currency, $where_currency, 1);
                        }
                 
                    print '</span>';
                        
                        ?>
                    </div>
                    <div class="user_unit_info">
                        <?php
                        print '<h4> <a href="' . $author_url . '">' . esc_attr($first_name) . ' ' . esc_attr($last_name) . '</a></h4>
                            <div class="agent_position">' . esc_attr($looking_where) . '</div>';
                        if ($user_age) {
                            print '<div class="agent_detail">' . __('Age', 'wpestate') . ': ' . esc_attr($user_age) . '</div>';
                        }
                        if ($user_gender) {
                            print '<img src="' . get_bloginfo('template_url') . '/img/' . $user_gender_array[$user_gender] . '.png" class="user_gender_image">';
                        }
                        ?>
                    </div> 
                    <div class="agent_unit_social">
                        <div class="social-wrapper">

                            <?php
                            if ($user_facebook != '') {
                                print ' <a href="' . esc_url($user_facebook) . '"><i class="fa fa-facebook"></i></a>';
                            }
                            if ($user_twitter != '') {
                                print ' <a href="' . esc_url($user_twitter) . '"><i class="fa fa-twitter"></i></a>';
                            }
                            if ($user_linkedin != '') {
                                print ' <a href="' . esc_url($user_linkedin) . '"><i class="fa fa-linkedin"></i></a>';
                            }
                            if ($user_pinterest != '') {
                                print ' <a href="' . esc_url($user_pinterest) . '"><i class="fa fa-pinterest"></i></a>';
                            }
                            ?> 
                        </div>
                    </div>
                </div>
            </div> 
            <?php
        } // end foreach

        
        $templates = ob_get_contents();
        ob_end_clean();
        $return_string = $templates;
        wp_reset_query();
        $is_shortcode = 0;
        return $return_string;
    }

endif;

////////////////////////////////////////////////////////////////////////////////////////////
///  shortcode - agent list
////////////////////////////////////////////////////////////////////////////////////////////


if (!function_exists('wpestate_list_agents_function')):

    function wpestate_list_agents_function($attributes, $content = null) {
        global $options;
        global $align;
        global $align_class;
        global $post;
        global $currency;
        global $where_currency;
        global $is_shortcode;
        global $show_compare_only;
        global $row_number_col;
        global $current_user;
        global $curent_fav;
        global $property_unit_slider;

        get_currentuserinfo();

        $title = '';
        if (isset($attributes['title'])) {
            $title = $attributes['title'];
        }

        $attributes = shortcode_atts(
                array(
            'title' => '',
            'type' => 'estate_agent',
            'category_ids' => '',
            'action_ids' => '',
            'city_ids' => '',
            'area_ids' => '',
            'number' => 4,
            'rownumber' => 4,
            'align' => 'vertical',
            'link' => '',
            'show_featured_only' => 'no',
            'random_pick' => 'no'
                ), $attributes);




        $userID = $current_user->ID;
        $user_option = 'favorites' . $userID;
        $curent_fav = get_option($user_option);
        $property_unit_slider = get_option('wp_estate_prop_list_slider', '');


        $options = wpestate_page_details($post->ID);
        $return_string = '';
        $pictures = '';
        $button = '';
        $class = '';
        $category = $action = $city = $area = '';

        $currency = esc_html(get_option('wp_estate_currency_symbol', ''));
        $where_currency = esc_html(get_option('wp_estate_where_currency_symbol', ''));
        $is_shortcode = 1;
        $show_compare_only = 'no';
        $row_number_col = '';
        $row_number = '';
        $show_featured_only = '';
        $random_pick = '';
        $orderby = 'ID';



        if (isset($attributes['category_ids'])) {
            $category = $attributes['category_ids'];
        }


        if (isset($attributes['category_ids'])) {
            $category = $attributes['category_ids'];
        }

        if (isset($attributes['action_ids'])) {
            $action = $attributes['action_ids'];
        }

        if (isset($attributes['city_ids'])) {
            $city = $attributes['city_ids'];
        }

        if (isset($attributes['area_ids'])) {
            $area = $attributes['area_ids'];
        }



        if (isset($attributes['random_pick'])) {
            $random_pick = $attributes['random_pick'];
            if ($random_pick === 'yes') {
                $orderby = 'rand';
            }
        }

        $post_number_total = $attributes['number'];
        if (isset($attributes['rownumber'])) {
            $row_number = $attributes['rownumber'];
        }

        // max 4 per row
        if ($row_number > 4) {
            $row_number = 4;
        }

        if ($row_number == 4) {
            $row_number_col = 3; // col value is 3 
        } else if ($row_number == 3) {
            $row_number_col = 4; // col value is 4
        } else if ($row_number == 2) {
            $row_number_col = 6; // col value is 6
        } else if ($row_number == 1) {
            $row_number_col = 12; // col value is 12
            if ($attributes['align'] == 'vertical') {
                $row_number_col = 0;
            }
        }

        $align = '';
        $align_class = '';
        if (isset($attributes['align']) && $attributes['align'] == 'horizontal') {
            $align = "col-md-12";
            $align_class = 'the_list_view';
            $row_number_col = '12';
        }



        $type = 'estate_agent';

        $category_array = '';
        $action_array = '';
        $city_array = '';
        $area_array = '';

        // build category array
        if ($category != '') {
            $category_of_tax = array();
            $category_of_tax = explode(',', $category);
            $category_array = array(
                'taxonomy' => 'property_category_agent',
                'field' => 'term_id',
                'terms' => $category_of_tax
            );
        }


        // build action array
        if ($action != '') {
            $action_of_tax = array();
            $action_of_tax = explode(',', $action);
            $action_array = array(
                'taxonomy' => 'property_action_category_agent',
                'field' => 'term_id',
                'terms' => $action_of_tax
            );
        }

        // build city array
        if ($city != '') {
            $city_of_tax = array();
            $city_of_tax = explode(',', $city);
            $city_array = array(
                'taxonomy' => 'property_city_agent',
                'field' => 'term_id',
                'terms' => $city_of_tax
            );
        }

        // build city array
        if ($area != '') {
            $area_of_tax = array();
            $area_of_tax = explode(',', $area);
            $area_array = array(
                'taxonomy' => 'property_area_agent',
                'field' => 'term_id',
                'terms' => $area_of_tax
            );
        }


        $meta_query = array();
        if ($show_featured_only == 'yes') {
            $compare_array = array();
            $compare_array['key'] = 'prop_featured';
            $compare_array['value'] = 1;
            $compare_array['type'] = 'numeric';
            $compare_array['compare'] = '=';
            $meta_query[] = $compare_array;
        }


        $args = array(
            'post_type' => 'estate_agent',
            'post_status' => 'publish',
            'paged' => 0,
            'posts_per_page' => $post_number_total,
            'orderby' => $orderby,
            'order' => 'DESC',
            'tax_query' => array(
                $category_array,
                $action_array,
                $city_array,
                $area_array
            )
        );




        if (isset($attributes['link']) && $attributes['link'] != '') {
            $button .= '<div class="listinglink-wrapper">
               <a href="' . $attributes['link'] . '"> <span class="wpb_button  wpb_btn-info wpb_btn-large vc_button">' . __('more listings', 'wpestate') . ' </span></a> 
               </div>';
        } else {
            $class = "nobutton";
        }




        $recent_posts = new WP_Query($args);


        $return_string .= '<div class="article_container bottom-' . $type . ' ' . $class . '" >';
        if ($title != '') {
            $return_string .= '<h2 class="shortcode_title">' . $title . '</h2>';
        }

        ob_start();
        while ($recent_posts->have_posts()): $recent_posts->the_post();
            print '<div class="col-md-' . $row_number_col . ' listing_wrapper">';
            get_template_part('templates/agent_unit');
            print '</div>';
        endwhile;

        $templates = ob_get_contents();
        ob_end_clean();
        $return_string .=$templates;
        $return_string .=$button;
        $return_string .= '</div>';
        wp_reset_query();
        $is_shortcode = 0;
        return $return_string;
    }

endif; // end   wpestate_recent_posts_pictures 
////////////////////////////////////////////////////////////////////////////////////////////
///  shortcode - recent post with picture
////////////////////////////////////////////////////////////////////////////////////////////

if (!function_exists('wpestate_slider_recent_posts_pictures')):

    function wpestate_slider_recent_posts_pictures($attributes, $content = null) {
        global $options;
        global $align;
        global $align_class;
        global $post;
        global $currency;
        global $where_currency;
        global $is_shortcode;
        global $show_compare_only;
        global $row_number_col;
        global $curent_fav;
        global $current_user;
        global $property_unit_slider;
        global $prop_unit;
        $prop_unit = 'grid';
        $options = wpestate_page_details($post->ID);
        $return_string = '';
        $pictures = '';
        $button = '';
        $class = '';
        $category = $action = $city = $area = '';
        $title = '';
        $currency = esc_html(get_option('wp_estate_currency_symbol', ''));
        $where_currency = esc_html(get_option('wp_estate_where_currency_symbol', ''));
        $is_shortcode = 1;
        $show_compare_only = 'no';
        $row_number_col = '';
        $row_number = '';
        $show_featured_only = '';
        $autoscroll = '';
        $property_unit_slider = get_option('wp_estate_prop_list_slider', '');
        $templates = '';

        get_currentuserinfo();
        $userID = $current_user->ID;
        $user_option = 'favorites' . $userID;
        $curent_fav = get_option($user_option);



        $title = '';
        if (isset($attributes['title'])) {
            $title = $attributes['title'];
        }



        $attributes = shortcode_atts(
                array(
            'title' => '',
            'type' => 'properties',
            'category_ids' => '',
            'action_ids' => '',
            'city_ids' => '',
            'area_ids' => '',
            'number' => 4,
            'show_featured_only' => 'no',
            'random_pick' => 'no',
            'autoscroll' => 0,
                ), $attributes);


        if (isset($attributes['category_ids'])) {
            $category = $attributes['category_ids'];
        }


        if (isset($attributes['category_ids'])) {
            $category = $attributes['category_ids'];
        }

        if (isset($attributes['action_ids'])) {
            $action = $attributes['action_ids'];
        }

        if (isset($attributes['city_ids'])) {
            $city = $attributes['city_ids'];
        }

        if (isset($attributes['area_ids'])) {
            $area = $attributes['area_ids'];
        }

        if (isset($attributes['show_featured_only'])) {
            $show_featured_only = $attributes['show_featured_only'];
        }
        if (isset($attributes['autoscroll'])) {
            $autoscroll = intval($attributes['autoscroll']);
        }

        $post_number_total = $attributes['number'];
        if (isset($attributes['rownumber'])) {
            $row_number = $attributes['rownumber'];
        }


        if ($row_number == 4) {
            $row_number_col = 3; // col value is 3 
        } else if ($row_number == 3) {
            $row_number_col = 4; // col value is 4
        } else if ($row_number == 2) {
            $row_number_col = 6; // col value is 6
        } else if ($row_number == 1) {
            $row_number_col = 12; // col value is 12
        }

        $align = '';
        $align_class = '';
        if (isset($attributes['align']) && $attributes['align'] == 'horizontal') {
            $align = "col-md-12";
            $align_class = 'the_list_view';
            $row_number_col = '12';
        }



        if ($attributes['type'] == 'properties') {
            $type = 'estate_property';

            $category_array = '';
            $action_array = '';
            $city_array = '';
            $area_array = '';

            // build category array
            if ($category != '') {
                $category_of_tax = array();
                $category_of_tax = explode(',', $category);
                $category_array = array(
                    'taxonomy' => 'property_category',
                    'field' => 'term_id',
                    'terms' => $category_of_tax
                );
            }


            // build action array
            if ($action != '') {
                $action_of_tax = array();
                $action_of_tax = explode(',', $action);
                $action_array = array(
                    'taxonomy' => 'property_action_category',
                    'field' => 'term_id',
                    'terms' => $action_of_tax
                );
            }

            // build city array
            if ($city != '') {
                $city_of_tax = array();
                $city_of_tax = explode(',', $city);
                $city_array = array(
                    'taxonomy' => 'property_city',
                    'field' => 'term_id',
                    'terms' => $city_of_tax
                );
            }

            // build city array
            if ($area != '') {
                $area_of_tax = array();
                $area_of_tax = explode(',', $area);
                $area_array = array(
                    'taxonomy' => 'property_area',
                    'field' => 'term_id',
                    'terms' => $area_of_tax
                );
            }


            $meta_query = array();
            if ($show_featured_only == 'yes') {
                $compare_array = array();
                $compare_array['key'] = 'prop_featured';
                $compare_array['value'] = 1;
                $compare_array['type'] = 'numeric';
                $compare_array['compare'] = '=';
                $meta_query[] = $compare_array;
            }

            $args = array(
                'post_type' => $type,
                'post_status' => 'publish',
                'paged' => 0,
                'posts_per_page' => $post_number_total,
                'meta_key' => 'prop_featured',
                'orderby' => 'meta_value',
                'order' => 'DESC',
                'meta_query' => $meta_query,
                'tax_query' => array(
                    $category_array,
                    $action_array,
                    $city_array,
                    $area_array
                )
            );
        } else {
            $type = 'post';
            $args = array(
                'post_type' => $type,
                'post_status' => 'publish',
                'paged' => 0,
                'posts_per_page' => $post_number_total,
                'cat' => $category
            );
        }


        if (isset($attributes['link']) && $attributes['link'] != '') {
            if ($attributes['type'] == 'properties') {
                $button .= '<div class="listinglink-wrapper">
               <a href="' . $attributes['link'] . '"> <span class="wpb_button  wpb_btn-info wpb_btn-large vc_button">' . __('more listings', 'wpestate') . ' </span></a> 
               </div>';
            } else {
                $button .= '<div class="listinglink-wrapper">
               <a href="' . $attributes['link'] . '"> <span class="wpb_button  wpb_btn-info wpb_btn-large vc_button">  ' . __('more articles', 'wpestate') . ' </span></a> 
               </div>';
            }
        } else {
            $class = "nobutton";
        }






        if ($attributes['type'] == 'properties') {
            add_filter('posts_orderby', 'wpestate_my_order');
            $recent_posts = new WP_Query($args);
            $count = 1;
            remove_filter('posts_orderby', 'wpestate_my_order');
        } else {
            $recent_posts = new WP_Query($args);
            $count = 1;
        }

        $return_string .= '<div class="article_container slider_container bottom-' . $type . ' ' . $class . '" >';

        $return_string .= '<div class="slider_control_left"><i class="fa fa-angle-left"></i></div>
                       <div class="slider_control_right"><i class="fa fa-angle-right"></i></div>';

        if ($title != '') {
            $return_string .= '<h2 class="shortcode_title title_slider">' . $title . '</h2>';
        }

        $is_autoscroll = '';

        $is_autoscroll = ' data-auto="' . $autoscroll . '" ';


        $return_string .= '<div class="shortcode_slider_wrapper" ' . $is_autoscroll . '><ul class="shortcode_slider_list">';


        ob_start();
        while ($recent_posts->have_posts()): $recent_posts->the_post();
            print '<li>';
            if ($type == 'estate_property') {
                get_template_part('templates/property_unit');
            } else {
                if (isset($attributes['align']) && $attributes['align'] == 'horizontal') {
                    get_template_part('templates/blog_unit');
                } else {
                    get_template_part('templates/blog_unit2');
                }
            }
            print '</li>';
        endwhile;

        $templates = ob_get_contents();
        ob_end_clean();
        $return_string .=$templates;
        $return_string .=$button;

        $return_string .= '</ul></div>'; // end shrcode wrapper
        $return_string .= '</div>';
        wp_reset_query();
        wp_reset_postdata();
        $is_shortcode = 0;


        return $return_string;
    }

endif; // end   wpestate_recent_posts_pictures 
////////////////////////////////////////////////////////////////////////////////////
/// wpestate_icon_container_function
////////////////////////////////////////////////////////////////////////////////////

if (!function_exists("wpestate_icon_container_function")):

    function wpestate_icon_container_function($attributes, $content = null) {
        $return_string = '';
        $link = '';
        $title = '';
        $image = '';
        $content_box = '';
        $haseffect = '';




        $title = '';
        if (isset($attributes['title'])) {
            $title = $attributes['title'];
        }



        $attributes = shortcode_atts(
                array(
            'title' => 'title',
            'image' => '',
            'content_box' => 'Content of the box goes here',
            'image_effect' => 'yes',
            'link' => ''
                ), $attributes);



        if (isset($attributes['image'])) {
            $image = $attributes['image'];
        }
        if (isset($attributes['content_box'])) {
            $content_box = $attributes['content_box'];
        }

        if (isset($attributes['link'])) {
            $link = $attributes['link'];
        }

        if (isset($attributes['image_effect'])) {
            $haseffect = $attributes['image_effect'];
        }

        $return_string .= '<div class="iconcol">';
        if ($image != '') {
            $return_string .= '<div class="icon_img">';

            if ($haseffect == 'yes') {
                $return_string .= ' <div class="listing-cover"> </div>
                 <a href="' . $link . '"> <span class="listing-cover-plus">+</span> </a>';
            }
            $return_string .= ' <img src="' . $image . '"  class="img-responsive" alt="thumb"/ >
            </div>';
        }

        $return_string .= '<h3><a href="' . $link . '">' . $title . '</a></h3>';
        $return_string .= '<p>' . do_shortcode($content_box) . '</p>';
        $return_string .= '</div>';

        return $return_string;
    }

endif;

////////////////////////////////////////////////////////////////////////////////////
/// spacer
////////////////////////////////////////////////////////////////////////////////////

if (!function_exists("wpestate_spacer_shortcode_function")):

    function wpestate_spacer_shortcode_function($attributes, $content = null) {
        $height = '';
        $type = 1;





        $attributes = shortcode_atts(
                array(
            'type' => '1',
            'height' => '40',
                ), $attributes);


        if (isset($attributes['type'])) {
            $type = $attributes['type'];
        }

        if (isset($attributes['height'])) {
            $height = $attributes['height'];
        }


        $return_string = '';
        $return_string.= '<div class="spacer" style="height:' . $height . 'px;">';
        if ($type == 2) {
            $return_string.='<span class="spacer_line"></span>';
        }
        $return_string.= '</div>';
        return $return_string;
    }

endif;



///////////////////////////////////////////////////////////////////////////////////////////
// font awesome function
///////////////////////////////////////////////////////////////////////////////////////////
if (!function_exists("wpestate_font_awesome_function")):

    function wpestate_font_awesome_function($attributes, $content = null) {
        $icon = $attributes['icon'];
        $size = $attributes['size'];
        $return_string = '<i class="' . $icon . '" style="' . $size . '"></i>';
        return $return_string;
    }

endif;


///////////////////////////////////////////////////////////////////////////////////////////
// advanced search function
///////////////////////////////////////////////////////////////////////////////////////////
if (!function_exists("wpestate_advanced_search_function")):

    function wpestate_advanced_search_function($attributes, $content = null) {
        $return_string = '';
        $random_id = '';
        $custom_advanced_search = get_option('wp_estate_custom_advanced_search', '');
        $actions_select = '';
        $categ_select = '';
        $title = '';

        if (isset($attributes['title'])) {
            $title = $attributes['title'];
        }

        $args = wpestate_get_select_arguments();
        $action_select_list = wpestate_get_action_select_list($args);
        $categ_select_list = wpestate_get_category_select_list($args);
        $select_city_list = wpestate_get_city_select_list($args);
        $select_area_list = wpestate_get_area_select_list($args);
        $select_county_state_list = wpestate_get_county_state_select_list($args);


        $adv_submit = get_adv_search_link();

        if ($title != '') {
            
        }

        $return_string .= '<h2 class="shortcode_title_adv">' . $title . '</h2>';
        $return_string .= '<div class="advanced_search_shortcode" id="advanced_search_shortcode">
        <form role="search" method="get"   action="' . $adv_submit . '" >';
        if ($custom_advanced_search == 'yes') {
            $adv_search_what = get_option('wp_estate_adv_search_what', '');
            $adv_search_label = get_option('wp_estate_adv_search_label', '');
            $adv_search_how = get_option('wp_estate_adv_search_how', '');
            $count = 0;
            ob_start();
            foreach ($adv_search_what as $key => $search_field) {
                wpestate_show_search_field('shortcode', $search_field, $action_select_list, $categ_select_list, $select_city_list, $select_area_list, $key, $select_county_state_list);
            } // end foreach
            $templates = ob_get_contents();
            ob_end_clean();
            $return_string.=$templates;
        } else {
            $return_string .= wpestate_show_search_field_classic_form('shortcode', $action_select_list, $categ_select_list, $select_city_list, $select_area_list);
        }
        $extended_search = get_option('wp_estate_show_adv_search_extended', '');
        if ($extended_search == 'yes') {
            ob_start();
            show_extended_search('short');
            $templates = ob_get_contents();
            ob_end_clean();
            $return_string = $return_string . $templates;
        }

        $return_string.='<button class="wpb_button  wpb_btn-info wpb_btn-large" id="advanced_submit_shorcode">' . __('Search', 'wpestate') . '</button>              

    </form>   
</div>';

        return $return_string;
    }

endif;




///////////////////////////////////////////////////////////////////////////////////////////
// list items by ids function
///////////////////////////////////////////////////////////////////////////////////////////
if (!function_exists('wpestate_list_items_by_id_function')):

    function wpestate_list_items_by_id_function($attributes, $content = null) {
        global $post;
        global $align;
        global $show_compare_only;
        global $currency;
        global $where_currency;
        global $col_class;
        global $is_shortcode;
        global $row_number_col;
        global $property_unit_slider;

        $property_unit_slider = get_option('wp_estate_prop_list_slider', '');
        $currency = esc_html(get_option('wp_estate_currency_symbol', ''));
        $where_currency = esc_html(get_option('wp_estate_where_currency_symbol', ''));
        $show_compare_only = 'no';
        $return_string = '';
        $pictures = '';
        $button = '';
        $class = '';
        $rows = 1;
        $ids = '';
        $ids_array = array();
        $post_number = 1;
        $title = '';
        $is_shortcode = 1;
        $row_number = '';

        global $current_user;
        global $curent_fav;
        get_currentuserinfo();
        $userID = $current_user->ID;
        $user_option = 'favorites' . $userID;
        $curent_fav = get_option($user_option);


        $title = '';
        if (isset($attributes['title'])) {
            $title = $attributes['title'];
        }



        $attributes = shortcode_atts(
                array(
            'title' => '',
            'type' => 'properties',
            'ids' => '',
            'number' => 3,
            'rownumber' => 4,
            'align' => 'vertical',
            'link' => '#',
                ), $attributes);



        if (isset($attributes['ids'])) {
            $ids = $attributes['ids'];
            $ids_array = explode(',', $ids);
        }



        $post_number_total = $attributes['number'];


        if (isset($attributes['rownumber'])) {
            $row_number = $attributes['rownumber'];
        }

        // max 4 per row
        if ($row_number > 4) {
            $row_number = 4;
        }

        if ($row_number == 4) {
            $row_number_col = 3; // col value is 3 
        } else if ($row_number == 3) {
            $row_number_col = 4; // col value is 4
        } else if ($row_number == 2) {
            $row_number_col = 6; // col value is 6
        } else if ($row_number == 1) {
            $row_number_col = 12; // col value is 12
        }


        $align = '';
        if (isset($attributes['align']) && $attributes['align'] == 'horizontal') {
            $align = "col-md-12";
        }



        if ($attributes['type'] == 'properties') {
            $type = 'estate_property';
        } else {
            $type = 'post';
        }

        if ($attributes['link'] != '') {
            if ($attributes['type'] == 'properties') {
                $button .= '<div class="listinglink-wrapper">
                           <a href="' . $attributes['link'] . '"> <span class="wpb_button  wpb_btn-info wpb_btn-large  vc_button">' . __(' more listings', 'wpestate') . ' </span></a>
                       </div>';
            } else {
                $button .= '<div class="listinglink-wrapper">
                           <a href="' . $attributes['link'] . '"> <span class="wpb_button  wpb_btn-info wpb_btn-large vc_button">' . __(' more articles', 'wpestate') . '</span></a>
                        </div>';
            }
        } else {
            $class = "nobutton";
        }





        $args = array(
            'post_type' => $type,
            'post_status' => 'publish',
            'paged' => 0,
            'posts_per_page' => $post_number_total,
            'post__in' => $ids_array,
            'orderby ' => 'none'
        );

        $recent_posts = new WP_Query($args);


        $return_string .= '<div class="article_container">';
        if ($title != '') {
            $return_string .= '<h2 class="shortcode_title">' . $title . '</h2>';
        }

        ob_start();
        while ($recent_posts->have_posts()): $recent_posts->the_post();
            if ($type == 'estate_property') {
                if (isset($attributes['align']) && $attributes['align'] == 'horizontal') {
                    $col_class = 'col-md-12';
                }
                get_template_part('templates/property_unit');
            } else {
                if (isset($attributes['align']) && $attributes['align'] == 'horizontal') {
                    get_template_part('templates/blog_unit');
                } else {
                    get_template_part('templates/blog_unit2');
                }
            }
        endwhile;

        $templates = ob_get_contents();
        ob_end_clean();
        $return_string .=$templates;
        $return_string .=$button;
        $return_string .= '</div>';
        wp_reset_query();
        $is_shortcode = 0;
        return $return_string;
    }

endif; // end   wpestate_list_items_by_id_function 
///////////////////////////////////////////////////////////////////////////////////////////
// login form  function
///////////////////////////////////////////////////////////////////////////////////////////

if (!function_exists('wpestate_login_form_function')):

    function wpestate_login_form_function($attributes, $content = null) {
        // get user dashboard link
        global $wpdb;
        $redirect = '';
        $mess = '';
        $allowed_html = array();

        $attributes = shortcode_atts(
                array(
            'register_label' => '',
            'register_url' => '',
                ), $attributes);


        $post_id = get_the_ID();
        $login_nonce = wp_nonce_field('login_ajax_nonce', 'security-login', true, false);
        $security_nonce = wp_nonce_field('forgot_ajax_nonce', 'security-forgot', true, false);
        $return_string = '<div class="login_form shortcode-login" id="login-div">
         <div class="loginalert" id="login_message_area" >' . $mess . '</div>
        
                <div class="loginrow">
                    <input type="text" class="form-control" name="log" id="login_user" placeholder="' . __('Username', 'wpestate') . '" size="20" />
                </div>
                <div class="loginrow">
                    <input type="password" class="form-control" name="pwd" id="login_pwd"  placeholder="' . __('Password', 'wpestate') . '" size="20" />
                </div>
                <input type="hidden" name="loginpop" id="loginpop" value="0">
                ' . $login_nonce . '   
                <button id="wp-login-but" class="wpb_button  wpb_btn-info wpb_btn-large vc_button">' . __('Login', 'wpestate') . '</button>
                <div class="login-links shortlog">';


        if (isset($attributes['register_label']) && $attributes['register_label'] != '') {
            $return_string.='<a href="' . $attributes['register_url'] . '">' . $attributes['register_label'] . '</a> | ';
        }
        $return_string.='<a href="#" id="forgot_pass">' . __('Forgot Password?', 'wpestate') . '</a>
                </div>';
        $facebook_status = esc_html(get_option('wp_estate_facebook_login', ''));
        $google_status = esc_html(get_option('wp_estate_google_login', ''));
        $yahoo_status = esc_html(get_option('wp_estate_yahoo_login', ''));


        if ($facebook_status == 'yes') {
            $return_string.='<div id="facebooklogin" data-social="facebook"></div>';
        }
        if ($google_status == 'yes') {
            $return_string.='<div id="googlelogin" data-social="google"></div>';
        }
        if ($yahoo_status == 'yes') {
            $return_string.='<div id="yahoologin" data-social="yahoo"></div>';
        }

        $return_string.='                 
         </div>
         <div class="login_form  shortcode-login" id="forgot-pass-div-sh">
            <div class="loginalert" id="forgot_pass_area"></div>
            <div class="loginrow">
                    <input type="text" class="form-control" name="forgot_email" id="forgot_email" placeholder="' . __('Enter Your Email Address', 'wpestate') . '" size="20" />
            </div>
            ' . $security_nonce . '  
            <input type="hidden" id="postid" value="' . $post_id . '">    
            <button class="wpb_button  wpb_btn-info wpb_btn-large  vc_button" id="wp-forgot-but" name="forgot" >' . __('Reset Password', 'wpestate') . '</button>
            <div class="login-links shortlog">
            <a href="#" id="return_login">' . __('Return to Login', 'wpestate') . '</a>
            </div>
         </div>
        
            ';
        return $return_string;
    }

endif; // end   wpestate_login_form_function 
///////////////////////////////////////////////////////////////////////////////////////////
// register form  function
///////////////////////////////////////////////////////////////////////////////////////////

if (!function_exists('wpestate_register_form_function')):

    function wpestate_register_form_function($attributes, $content = null) {

        $register_nonce = wp_nonce_field('register_ajax_nonce', 'security-register', true, false);
        $return_string = '
          <div class="login_form shortcode-login">
               <div class="loginalert" id="register_message_area" ></div>
               
                <div class="loginrow">
                    <input type="text" name="user_login_register" id="user_login_register" class="form-control" placeholder="' . __('Username', 'wpestate') . '" size="20" />
                </div>
                <div class="loginrow">
                    <input type="text" name="user_email_register" id="user_email_register" class="form-control" placeholder="' . __('Email', 'wpestate') . '" size="20" />
                </div>';

        $enable_user_pass_status = esc_html(get_option('wp_estate_enable_user_pass', ''));
        if ($enable_user_pass_status == 'yes') {
            $return_string.= '
                    <div class="loginrow">
                        <input type="password" name="user_password" id="user_password" class="form-control" placeholder="' . __('Password', 'wpestate') . '"/>
                    </div>
                    <div class="loginrow">
                        <input type="password" name="user_password_retype" id="user_password_retype" class="form-control" placeholder="' . __('Retype Password', 'wpestate') . '"  />
                    </div>
                    ';
        }


        $return_string.='        
                <input type="checkbox" name="terms" id="user_terms_register_sh">
                <label id="user_terms_register_sh_label" for="user_terms_register_sh">' . __('I agree with ', 'wpestate') . '<a href="' . get_terms_links() . '" target="_blank" id="user_terms_register_topbar_link">' . __('terms & conditions', 'wpestate') . '</a> </label>';
        if ($enable_user_pass_status != 'yes') {
            $return_string.='<p id="reg_passmail">' . __('A password will be e-mailed to you', 'wpestate') . '</p>';
        }

        $return_string.= $register_nonce . '   
                <p class="submit">
                    <button id="wp-submit-register"  class="wpb_button  wpb_btn-info wpb_btn-large vc_button">' . __('Register', 'wpestate') . '</button>
                </p>
                
        </div>
                     
    ';
        return $return_string;
    }

endif; // end   wpestate_register_form_function   
///////////////////////////////////////////////////////////////////////////////////////////
/// featured article
///////////////////////////////////////////////////////////////////////////////////////////

if (!function_exists('wpestate_featured_article')):

    function wpestate_featured_article($attributes, $content = null) {
        $return_string = '';
        $article = 0;
        $second_line = '';


        $attributes = shortcode_atts(
                array(
            'id' => '',
            'second_line' => '',
                ), $attributes);


        if (isset($attributes['id'])) {
            $article = intval($attributes['id']);
        }

        if (isset($attributes['second_line'])) {
            $second_line = $attributes['second_line'];
        }

        $args = array('post_type' => 'post',
            'p' => $article
        );


        $my_query = new WP_Query($args);
        if ($my_query->have_posts()) {
            while ($my_query->have_posts()) {
                $my_query->the_post();
                $thumb_id = get_post_thumbnail_id($article);
                $preview = wp_get_attachment_image_src(get_post_thumbnail_id(), 'property_featured');
                $previewh = wp_get_attachment_image_src(get_post_thumbnail_id(), 'property_featured');
                $avatar = wpestate_get_avatar_url(get_avatar(get_the_author_meta('email'), 55));
                $content = get_the_excerpt();
                $title = get_the_title();
                $link = get_permalink();
// <div class="featured_article_content"> ' . $content . '</div>

                $return_string.= '
            <div class="featured_article">
                
                
                <div class="featured_img">
                    <a href="' . $link . '"> <img src="' . $preview[0] . '" data-original="' . $preview[0] . '" alt="featured image" class="lazyload img-responsive" /></a>
                    <div class="listing-cover"></div>
                    <a href="' . $link . '"> <span class="listing-cover-plus">+</span></a>
                </div>
                
                <div class="featured_article_title" data-link="' . $link . '">
                    <div class="blog_author_image" style="background-image: url(' . $avatar . ');"></div>    
                    <h2 class="featured_type_2"> <a href="' . $link . '">';
                $title = get_the_title();
                $return_string .= mb_substr($title, 0, 35);
                if (mb_strlen($title) > 35) {
                    $return_string .= '...';
                }

                $return_string .= '</a></h2>
                    <div class="featured_article_secondline">' . $second_line . '</div>
                    <a href="' . $link . '"> <i class="fa fa-angle-right featured_article_right"></i> </a>
                    
                    <div class="featured_article_content">
                    ' . $content . '
                    </div>
                </div>
                
             </div>';
            }
        }

        wp_reset_query();
        return $return_string;
    }

endif; // end   featured_article   


if (!function_exists('wpestate_get_avatar_url')):

    function wpestate_get_avatar_url($get_avatar) {
        preg_match("/src='(.*?)'/i", $get_avatar, $matches);
        return $matches[1];
    }

endif; // end   wpestate_get_avatar_url   
////////////////////////////////////////////////////////////////////////////////////
/// featured property
////////////////////////////////////////////////////////////////////////////////////


if (!function_exists('wpestate_featured_property')):

    function wpestate_featured_property($attributes, $content = null) {
        $return_string = '';
        $prop_id = '';
        $property_unit_slider = get_option('wp_estate_prop_list_slider', '');
        $attributes = shortcode_atts(
                array(
            'id' => '',
            'sale_line' => '',
                ), $attributes);


        if (isset($attributes['id'])) {
            $prop_id = $attributes['id'];
        }

        $sale_line = '';
        if (isset($attributes['sale_line'])) {
            $sale_line = $attributes['sale_line'];
        }

        $args = array('post_type' => 'estate_property',
            'post_status' => 'publish',
            'p' => $prop_id
        );
 
        $my_query = new WP_Query($args);
        if ($my_query->have_posts()) {
            while ($my_query->have_posts()) {
                $my_query->the_post();
                $thumb_id = get_post_thumbnail_id($prop_id);
                $preview = wp_get_attachment_image_src(get_post_thumbnail_id(), 'property_featured');
                $link = get_permalink();
                $title = get_the_title();
                $price = floatval(get_post_meta($prop_id, 'property_price', true));
                $price_label = '<span class="price_label">' . esc_html(get_post_meta($prop_id, 'property_label', true)) . '</span>';
                $price_label_before = '<span class="price_label price_label_before">' . esc_html(get_post_meta($prop_id, 'property_label_before', true)) . '</span>';
                $currency = esc_html(get_option('wp_estate_currency_symbol', ''));
                $where_currency = esc_html(get_option('wp_estate_where_currency_symbol', ''));
                $content = wpestate_strip_words(get_the_excerpt(), 30) . ' ...';
                $gmap_lat = esc_html(get_post_meta($prop_id, 'property_latitude', true));
                $gmap_long = esc_html(get_post_meta($prop_id, 'property_longitude', true));
                $prop_stat = esc_html(get_post_meta($prop_id, 'property_status', true));

                if (function_exists('icl_translate')) {
                    $prop_stat = icl_translate('wpestate', 'wp_estate_property_status_sh_' . $prop_stat, $prop_stat);
                } 
                
                $featured = intval(get_post_meta($prop_id, 'prop_featured', true));               
                $agent_id = intval(get_post_meta($prop_id, 'property_agent', true));
                
                 
                $thumb_id = get_post_thumbnail_id($agent_id);
                      
                $user_ID = get_the_author_meta( 'ID' );   
                $photo_url = get_the_author_meta('custom_picture', $user_ID);
                
                $agent_face = wp_get_attachment_image_src($thumb_id, 'agent_picture_thumb');
                $agent_posit = esc_html(get_post_meta($agent_id, 'agent_position', true));
                $agent_permalink = get_permalink($agent_id);
                $agent_phone = esc_html(get_post_meta($agent_id, 'agent_phone', true));
                $agent_mobile = esc_html(get_post_meta($agent_id, 'agent_mobile', true));
                $agent_email = esc_html(get_post_meta($agent_id, 'agent_email', true));

                  
                if ($price != 0) {
                    $price = wpestate_show_price($prop_id, $currency, $where_currency, 1);
                } else {
                    $price = $price_label_before . $price_label;
                }

                $return_string.= '
                <div class="featured_property">
                        <div class="featured_img">';
                if ($property_unit_slider == 1) {

                    $arguments = array(
                        'numberposts' => -1,
                        'post_type' => 'attachment',
                        'post_mime_type' => 'image',
                        'post_parent' => $prop_id,
                        'post_status' => null,
                        'exclude' => get_post_thumbnail_id($prop_id),
                        'orderby' => 'menu_order',
                        'order' => 'ASC'
                    );
                    $post_attachments = get_posts($arguments);

                    $slides = '';

                    $no_slides = 0;
                    foreach ($post_attachments as $attachment) {
                        $no_slides++;
                        $preview_att = wp_get_attachment_image_src($attachment->ID, 'property_featured');
                        $slides .= '<div class="item">
                                                        <a href="' . $link . '"><img  src="' . $preview_att[0] . '" alt="' . $title . '" class="img-responsive" /></a>
                                                    </div>';
                    }// end foreach

                    $return_string .= '
                                <div id="property_unit_featured_carousel_' . $prop_id . '" class="carousel slide  " data-ride="carousel" data-interval="false">
                                    <div class="carousel-inner">         
                                        <div class="item active">    
                                            <a href="' . $link . '"><img src="' . $preview[0] . '" data-original="' . $preview[0] . '" class="lazyload img-responsive" alt="featured image"/></a>     
                                        </div>
                                        ' . $slides . '
                                    </div>
                                    <a href="' . $link . '"> </a>';
                    if ($no_slides > 1) {
                        $return_string .= '<a class="left  carousel-control" href="#property_unit_featured_carousel_' . $prop_id . '" data-slide="prev">
                                            <i class="fa fa-angle-left"></i>
                                        </a>

                                        <a class="right  carousel-control" href="#property_unit_featured_carousel_' . $prop_id . '" data-slide="next">
                                            <i class="fa fa-angle-right"></i>
                                        </a>';
                    }
                    $return_string .= '
                                </div>';
                } else {
                    $return_string .= '<a href="' . $link . '"> <img src="' . $preview[0] . '" data-original="' . $preview[0] . '" class="lazyload img-responsive" alt="featured image"/></a>
                                <div class="listing-cover featured_cover" data-link="' . $link . '"></div>
                                <a href="' . $link . '"> <span class="listing-cover-plus">+</span></a>';
                }
                $return_string.= '</div>';
                $return_string.='';

                if ($prop_stat != 'normal') {
                    $ribbon_class = str_replace(' ', '-', $prop_stat);
                    $return_string .= '<a href="' . get_permalink() . '"><div class="ribbon-wrapper-default ribbon-wrapper-' . $ribbon_class . '"><div class="ribbon-inside ' . $ribbon_class . '">' . $prop_stat . '</div></div></a>';
                }

                $return_string.= ' <div class="featured_secondline" data-link="' . $link . '">';
                if ($agent_id != '') {
                    $return_string.= '
                            <div class="agent_face">
                            
                                <img src="' . $agent_face[0] . '" width="55" height="55" class="img-responsive" alt="agent_face">
                               

                                <div class="agent_face_details">
                                    <img src="' . $agent_face[0] . '" width="120" height="120" class="img-responsive" alt="agent_face">
                                    <h4><a href="' . $agent_permalink . '" >' . get_the_title($agent_id) . '</a></h4>   
                                    <div class="agent_position">' . $agent_posit . '</div> 
                                    <a class="wpb_button_a see_my_list" href="' . $agent_permalink . '" target="_blank">
                                        <span class="wpb_button  wpb_wpb_button wpb_regularsize wpb_mail  vc_button">' . __('My Listings', 'wpestate') . '</span>
                                    </a>    
                                </div>
                            </div>';
                }
 
                if ($featured == 1) {
                    $return_string .= '<div class="featured_div"></div>';
                }
                $return_string .= '<h2><a href="' . $link . '">';
 
                $return_string .= mb_substr($title, 0, 27);
                if (mb_strlen($title) > 27) {
                    $return_string .= '...';
                } 
                $return_string.='</a></h2>
                        <div class="sale_line">' . $sale_line . '</div>
                        <div class="featured_prop_price">' . $price . ' </div>      
                 </div>'; 
                $return_string .='
                </div>';
            }
        } 
        wp_reset_query();
        return $return_string;
    } 
endif; // end   wpestate_featured_property
////////////////////////////////////////////////////////////////////////////////////
/// featured agent
////////////////////////////////////////////////////////////////////////////////////

if (!function_exists('wpestate_featured_agent')):

    function wpestate_featured_agent($attributes, $content = null) {
        global $notes;
        $return_string = '';
        $notes = '';
 
        $attributes = shortcode_atts(
                array(
            'id' => 0,
            'notes' => '',
                ), $attributes);


        $agent_id = $attributes['id'];


        if (isset($attributes['notes'])) {
            $notes = $attributes['notes'];
        }

        $args = array(
            'post_type' => 'estate_agent',
            'p' => $agent_id
        );




        $my_query = new WP_Query($args);
        ob_start();
        while ($my_query->have_posts()): $my_query->the_post();
            get_template_part('templates/agent_unit_featured');
        endwhile;
        $return_string = ob_get_contents();
        ob_end_clean();
        wp_reset_query();
        return $return_string;
    }

endif; // end   wpestate_featured_agent   
////////////////////////////////////////////////////////////////////////////////////////////
///  shortcode - recent post with picture
////////////////////////////////////////////////////////////////////////////////////////////

if (!function_exists('wpestate_recent_posts_pictures')):

    function wpestate_recent_posts_pictures($attributes, $content = null) {
        global $options;
        global $align;
        global $align_class;
        global $post;
        global $currency;
        global $where_currency;
        global $is_shortcode;
        global $show_compare_only;
        global $row_number_col;
        global $current_user;
        global $curent_fav;
        global $property_unit_slider;


        get_currentuserinfo();

        $title = '';
        if (isset($attributes['title'])) {
            $title = $attributes['title'];
        }

        $attributes = shortcode_atts(
                array(
            'title' => '',
            'type' => 'properties',
            'category_ids' => '',
            'action_ids' => '',
            'city_ids' => '',
            'area_ids' => '',
            'number' => 4,
            'rownumber' => 4,
            'align' => 'vertical',
            'link' => '',
            'show_featured_only' => 'no',
            'random_pick' => 'no'
                ), $attributes);




        $userID = $current_user->ID;
        $user_option = 'favorites' . $userID;
        $curent_fav = get_option($user_option);
        $property_unit_slider = get_option('wp_estate_prop_list_slider', '');


        $options = wpestate_page_details($post->ID);
        $return_string = '';
        $pictures = '';
        $button = '';
        $class = '';
        $category = $action = $city = $area = '';

        $currency = esc_html(get_option('wp_estate_currency_symbol', ''));
        $where_currency = esc_html(get_option('wp_estate_where_currency_symbol', ''));
        $is_shortcode = 1;
        $show_compare_only = 'no';
        $row_number_col = '';
        $row_number = '';
        $show_featured_only = '';
        $random_pick = '';
        $orderby = 'meta_value';



        if (isset($attributes['category_ids'])) {
            $category = $attributes['category_ids'];
        }


        if (isset($attributes['category_ids'])) {
            $category = $attributes['category_ids'];
        }

        if (isset($attributes['action_ids'])) {
            $action = $attributes['action_ids'];
        }

        if (isset($attributes['city_ids'])) {
            $city = $attributes['city_ids'];
        }

        if (isset($attributes['area_ids'])) {
            $area = $attributes['area_ids'];
        }

        if (isset($attributes['show_featured_only'])) {
            $show_featured_only = $attributes['show_featured_only'];
        }

        if (isset($attributes['random_pick'])) {
            $random_pick = $attributes['random_pick'];
            if ($random_pick === 'yes') {
                $orderby = 'rand';
            }
        }

        $post_number_total = $attributes['number'];
        if (isset($attributes['rownumber'])) {
            $row_number = $attributes['rownumber'];
        }

        // max 4 per row
        if ($row_number > 4) {
            $row_number = 4;
        }

        if ($row_number == 4) {
            $row_number_col = 3; // col value is 3 
        } else if ($row_number == 3) {
            $row_number_col = 4; // col value is 4
        } else if ($row_number == 2) {
            $row_number_col = 6; // col value is 6
        } else if ($row_number == 1) {
            $row_number_col = 12; // col value is 12
            if ($attributes['align'] == 'vertical') {
                $row_number_col = 0;
            }
        }

        $align = '';
        $align_class = '';
        if (isset($attributes['align']) && $attributes['align'] == 'horizontal') {
            $align = "col-md-12";
            $align_class = 'the_list_view';
            $row_number_col = '12';
        }


        if ($attributes['type'] == 'properties') {
            $type = 'estate_property';

            $category_array = '';
            $action_array = '';
            $city_array = '';
            $area_array = '';

            // build category array
            if ($category != '') {
                $category_of_tax = array();
                $category_of_tax = explode(',', $category);
                $category_array = array(
                    'taxonomy' => 'property_category',
                    'field' => 'term_id',
                    'terms' => $category_of_tax
                );
            }


            // build action array
            if ($action != '') {
                $action_of_tax = array();
                $action_of_tax = explode(',', $action);
                $action_array = array(
                    'taxonomy' => 'property_action_category',
                    'field' => 'term_id',
                    'terms' => $action_of_tax
                );
            }

            // build city array
            if ($city != '') {
                $city_of_tax = array();
                $city_of_tax = explode(',', $city);
                $city_array = array(
                    'taxonomy' => 'property_city',
                    'field' => 'term_id',
                    'terms' => $city_of_tax
                );
            }

            // build city array
            if ($area != '') {
                $area_of_tax = array();
                $area_of_tax = explode(',', $area);
                $area_array = array(
                    'taxonomy' => 'property_area',
                    'field' => 'term_id',
                    'terms' => $area_of_tax
                );
            }


            $meta_query = array();
            if ($show_featured_only == 'yes') {
                $compare_array = array();
                $compare_array['key'] = 'prop_featured';
                $compare_array['value'] = 1;
                $compare_array['type'] = 'numeric';
                $compare_array['compare'] = '=';
                $meta_query[] = $compare_array;
            }


            $args = array(
                'post_type' => $type,
                'post_status' => 'publish',
                'paged' => 0,
                'posts_per_page' => $post_number_total,
                'meta_key' => 'prop_featured',
                'orderby' => $orderby,
                'order' => 'DESC',
                'meta_query' => $meta_query,
                'tax_query' => array(
                    $category_array,
                    $action_array,
                    $city_array,
                    $area_array
                )
            );
        } else {
            $type = 'post';



            $args = array(
                'post_type' => $type,
                'post_status' => 'publish',
                'paged' => 0,
                'posts_per_page' => $post_number_total,
                'cat' => $category
            );
        }


        if (isset($attributes['link']) && $attributes['link'] != '') {
            if ($attributes['type'] == 'properties') {
                $button .= '<div class="listinglink-wrapper">
               <a href="' . $attributes['link'] . '"> <span class="wpb_button  wpb_btn-info wpb_btn-large vc_button">' . __('more listings', 'wpestate') . ' </span></a> 
               </div>';
            } else {
                $button .= '<div class="listinglink-wrapper">
               <a href="' . $attributes['link'] . '"> <span class="wpb_button  wpb_btn-info wpb_btn-large vc_button">  ' . __('more articles', 'wpestate') . ' </span></a> 
               </div>';
            }
        } else {
            $class = "nobutton";
        }


        if ($attributes['type'] == 'properties') {
            if ($random_pick !== 'yes') {
                add_filter('posts_orderby', 'wpestate_my_order');
                $recent_posts = new WP_Query($args);
                $count = 1;
                remove_filter('posts_orderby', 'wpestate_my_order');
            } else {
                $recent_posts = new WP_Query($args);
                $count = 1;
            }
        } else {
            $recent_posts = new WP_Query($args);
            $count = 1;
        }

        $return_string .= '<div class="article_container bottom-' . $type . ' ' . $class . '" >';
        if ($title != '') {
            $return_string .= '<h2 class="shortcode_title">' . $title . '</h2>';
        }

        ob_start();
        while ($recent_posts->have_posts()): $recent_posts->the_post();
            if ($type == 'estate_property') {
                get_template_part('templates/property_unit');
            } else {
                if (isset($attributes['align']) && $attributes['align'] == 'horizontal') {
                    get_template_part('templates/blog_unit');
                } else {
                    get_template_part('templates/blog_unit2');
                }
            }
        endwhile;

        $templates = ob_get_contents();
        ob_end_clean();
        $return_string .=$templates;
        $return_string .=$button;
        $return_string .= '</div>';
        wp_reset_query();
        $is_shortcode = 0;
        return $return_string;
    }

endif; // end   wpestate_recent_posts_pictures 



if (!function_exists('wpestate_limit_words')):

    function wpestate_limit_words($string, $max_no) {
        $words_no = explode(' ', $string, ($max_no + 1));

        if (count($words_no) > $max_no) {
            array_pop($words_no);
        }

        return implode(' ', $words_no);
    }

endif; // end   wpestate_limit_words  
////////////////////////////////////////////////////////////////////////////////////////////////////////////////..
///  shortcode - testimonials
////////////////////////////////////////////////////////////////////////////////////////////////////////////////..


if (!function_exists('wpestate_testimonial_function')):

    function wpestate_testimonial_function($attributes, $content = null) {
        $return_string = '';
        $title_client = '';
        $client_name = '';
        $imagelinks = '';
        $testimonial_text = '';

        $attributes = shortcode_atts(
                array(
            'client_name' => 'Name Here',
            'title_client' => "happy client",
            'imagelinks' => '',
            'testimonial_text' => ''
                ), $attributes);



        if ($attributes['client_name']) {
            $client_name = $attributes['client_name'];
        }

        if ($attributes['title_client']) {
            $title_client = $attributes['title_client'];
        }

        if ($attributes['imagelinks']) {
            $imagelinks = $attributes['imagelinks'];
        }

        if ($attributes['testimonial_text']) {
            $testimonial_text = $attributes['testimonial_text'];
        }

        $return_string .= ' <div class="testimonial-container">';
        $return_string .= '     <div class="testimonial-image" style="background-image:url(' . $imagelinks . ')"></div>';
        $return_string .= '     <div class="testimonial-text">' . $testimonial_text . '</div>';
        $return_string .= '     <div class="testimonial-author-line"><span class="testimonial-author">' . $client_name . '</span>, ' . $title_client . ' </div>';
        $return_string .= ' </div>';

        return $return_string;
    }

endif; // end   wpestate_testimonial_function 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///  shortcode - reccent post function
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if (!function_exists('wpestate_recent_posts_function')):

    function wpestate_recent_posts_function($attributes, $heading = null) {
        $return_string = '';
        extract(shortcode_atts(array(
            'posts' => 1,
                        ), $attributes));

        query_posts(array('orderby' => 'date', 'order' => 'DESC', 'showposts' => $posts));
        $return_string = '<div id="recent_posts"><ul><h3>' . $heading . '</h3>';
        if (have_posts()) :
            while (have_posts()) : the_post();
                $return_string .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            endwhile;
        endif;

        $return_string.='</div></ul>';
        wp_reset_query();

        return $return_string;
    }

endif; // end   wpestate_recent_posts_function   
?>
