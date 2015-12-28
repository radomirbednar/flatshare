<?php
global $post;
$user_id = $post->post_author;


$currency = esc_html(get_option('wp_estate_currency_symbol', ''));
$where_currency = esc_html(get_option('wp_estate_where_currency_symbol', ''));

$fl_user_data = get_fl_data($user_id);

$description = get_the_author_meta('description', $user_id);
$first_name = esc_attr(get_the_author_meta('first_name', $user_id));
$last_name = esc_attr(get_the_author_meta('last_name', $user_id));
$user_facebook = get_the_author_meta('facebook', $user_id);

$photo_url = get_the_author_meta('custom_picture', $user_id);

$user_gender = !empty($fl_user_data->user_gender) ? $fl_user_data->user_gender : '';
$user_age = !empty($fl_user_data->user_age) ? $fl_user_data->user_age : '';
$looking_where = !empty($fl_user_data->looking_where) ? $fl_user_data->looking_where : '';

$looking_for = !empty($fl_user_data->looking_for) ? $fl_user_data->looking_for : '';
$looking_for_array = array(
    '1' => array(
        '<i class="icon-icon_roommate" data-toggle="tooltip" data-placement="top" title="' . __('roomate', 'wpestate') . '"></i>',
        __('roomate', 'wpestate'))
    ,
    '2' => array(
        '<i class="icon-icon_flat"  data-toggle="tooltip" data-placement="top" title="' . __('flat', 'wpestate') . '"> </i>',
        __('flat', 'wpestate')
    )
);



$sexual_preference = !empty($fl_user_data->sexual_preference) ? $fl_user_data->sexual_preference : '';
$sleeping_span = !empty($fl_user_data->sleeping_span) ? $fl_user_data->sleeping_span : '';
$couple = !empty($fl_user_data->couple) ? $fl_user_data->couple : '';
$smoker = !empty($fl_user_data->smoker) ? $fl_user_data->smoker : '';
$pets = !empty($fl_user_data->pets) ? $fl_user_data->pets : '';
$user_origin = !empty($fl_user_data->user_origin) ? $fl_user_data->user_origin : '';
$party = !empty($fl_user_data->party) ? $fl_user_data->party : '';
$looking_when = !empty($fl_user_data->looking_when) ? $fl_user_data->looking_when : '';

$sexual_preference_array = array(
    '1' => array(
        '<i class="icon-icon_sex-straight" data-toggle="tooltip" data-placement="top" title="' . __('straight', 'wpestate') . '"></i>',
        __('straight', 'wpestate'))
    ,
    '2' => array(
        '<i class="icon-icon_sex-gay" data-toggle="tooltip" data-placement="top" title="' . __('BI/GAY', 'wpestate') . '"> </i>',
        __('BI/GAY', 'wpestate')
    )
);

$sleeping_span_array = array(
    '1' => array(
        '<i class="icon-icon_sleep" data-toggle="tooltip" data-placement="top" title="' . __('Before 11PM', 'wpestate') . '" ></i>',
        __('Before 11PM', 'wpestate'))
    ,
    '2' => array(
        '<i class="icon-icon_sleep" data-toggle="tooltip" data-placement="top" title="' . __('After 11PM', 'wpestate') . '" ></i>',
        __('After 11PM', 'wpestate')
    )
);

$couple_array = array(
    '1' => array(
        '<i class="icon-icon_single" data-toggle="tooltip" data-placement="top" title="' . __('single', 'wpestate') . '"  > </i>',
        __('single', 'wpestate'))
    ,
    '2' => array(
        '<i class="icon-icon_couple" data-toggle="tooltip" data-placement="top" title="' . __('in couple', 'wpestate') . '"  > </i>',
        __('in couple', 'wpestate')
    )
);

$pets_array = array(
    '1' => array(
        '<i class="icon-icon_no-pets" data-toggle="tooltip" data-placement="top" title="' . __('No pets', 'wpestate') . '"> </i>',
        __('No pets', 'wpestate'))
    ,
    '2' => array(
        '<i class="icon-icon_pets" data-toggle="tooltip" data-placement="top" title="' . __('Pets', 'wpestate') . '"> </i>',
        __('Pets', 'wpestate')
    )
);
$smoker_array = array(
    '1' => array(
        '<i class="icon-icon_smoking" data-toggle="tooltip" data-placement="top" title="' . __('Non-smoker', 'wpestate') . '"> </i>',
        __('Non-smoker', 'wpestate'))
    ,
    '2' => array(
        '<i class="icon-icon_smoking" data-toggle="tooltip" data-placement="top" title="' . __('Smoker', 'wpestate') . '"> </i>',
        __('Smoker', 'wpestate')
    )
);

$party_array = array(
    '1' => array(
        '<i class="icon-icon_party-often" data-toggle="tooltip" data-placement="top" title="' . __('Often', 'wpestate') . '"> </i>',
        __('Often', 'wpestate'))
    ,
    '2' => array(
        '<i class="icon-icon_party-less" data-toggle="tooltip" data-placement="top" title="' . __('Not often', 'wpestate') . '"> </i>',
        __('Not often', 'wpestate')
    )
);



$user_gender_array = array(
    '2' => __('female', 'wpestate'),
    '1' => __('male', 'wpestate')
);


$rent_amount = !empty($fl_user_data->rent_amount) ? $fl_user_data->rent_amount : '';


$author_url = esc_url(get_author_posts_url($user_id));
$thumb_prop = '<img src="' . $photo_url . '" alt="agent-images">';
if ($photo_url == '') {
    $thumb_prop = '<img src="' . get_template_directory_uri() . '/img/default_user.png" alt="agent-images">';
}
?>

<!-- <div class="col-md-<?php //print $col_class;    ?> listing_wrapper"> -->


<div class="listing_wrapper">
    <div class="agent_unit" data-link="<?php print $author_url; ?>">         
        <div class="agent-unit-img-wrapper person-<?php echo (int) $q->ID ?>">
            <?php
            print $thumb_prop;
            print '<div class="listing-cover"></div>
                   <a href="' . $author_url . '"> <span class="listing-cover-plus">+</span></a>';
            ?>   
            <span class="user_euro_unit">  
                <?php
                if ($rent_amount != '') {
                    print __('', 'wpestate') . ' ' . wpestate_show_price_floor($rent_amount, $currency, $where_currency, 1);
                }
                ?>  
            </span>   
        </div> 
        <div class="user_unit_info">
            <?php
            print '<h4> <a href="' . $author_url . '">' . esc_attr($first_name) . ' ' . esc_attr($last_name) . '</a></h4> 
                   <div class="agent_position"> ' . __('Looking for ', 'wpestate') . esc_attr($looking_for_array[$looking_for][1]) . ' in ' . esc_attr($looking_where) . '</div>';



            $cutted_description = fl_cut_description($description);

            if (!empty($cutted_description)):
                ?>            
                <div class="agent_position author_desc"> 
                    <?php echo wpautop($cutted_description); ?>
                </div>
            <?php endif; ?>


            <?php
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
                ?> 

                <?php !empty($sexual_preference_array[$sexual_preference][0]) ? print $sexual_preference_array[$sexual_preference][0] : ''; ?>   
                <?php !empty($sleeping_span_array[$sleeping_span][0]) ? print $sleeping_span_array[$sleeping_span][0] : ''; ?>  
                <?php !empty($couple_array[$couple][0]) ? print $couple_array[$couple][0] : ''; ?>     
                <?php !empty($pets_array[$pets][0]) ? print $pets_array[$pets][0] : ''; ?>   
                <?php !empty($smoker_array[$smoker][0]) ? print $smoker_array[$smoker][0] : ''; ?>   
                <?php !empty($party_array[$party][0]) ? print $party_array[$party][0] : ''; ?>  

                <?php
                /* if ($user_twitter != '') {
                  print ' <a href="' . esc_url($user_twitter) . '"><i class="fa fa-twitter"></i></a>';
                  }
                  if ($user_linkedin != '') {
                  print ' <a href="' . esc_url($user_linkedin) . '"><i class="fa fa-linkedin"></i></a>';
                  }
                  if ($user_pinterest != '') {
                  print ' <a href="' . esc_url($user_pinterest) . '"><i class="fa fa-pinterest"></i></a>';
                  } */
                ?>  
            </div>
        </div>
    </div>
</div>









<!-- </div>    -->
