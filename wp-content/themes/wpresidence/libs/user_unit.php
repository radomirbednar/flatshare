<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?> 
<div class="col-md-3 listing_wrapper">
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
                   <div class="agent_position"> ' .__('Looking for ', 'wpestate') .esc_attr( isset($looking_for_array[$looking_for][1])) .' in '. esc_attr( $looking_where ) . '</div>';   
            if ($user_age) {
                print '<div class="agent_detail">' . __('Age', 'wpestate') . ': ' . esc_attr($user_age) . '</div>';
            }
            if ($user_gender) {
                print '<img src="' . get_bloginfo('template_url') . '/img/' . $user_gender_array[$user_gender] . '.png" class="user_gender_image">';
            }
            ?>
            <div class="agent_position author_desc">
            <?php echo $description; ?> 
            </div>     
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
                <?php !empty($couple_array[$couple][0]) ? print $couple_array[$couple][0] : '' ; ?>     
                <?php !empty($pets_array[$pets][0]) ? print $pets_array[$pets][0] : ''; ?>   
                <?php !empty($smoker_array[$smoker][0]) ? print $smoker_array[$smoker][0] : ''; ?>   
                <?php !empty($party_array[$party][0]) ? print $party_array[$party][0] : ''; ?>   
                <?php 
                /*if ($user_twitter != '') {
                    print ' <a href="' . esc_url($user_twitter) . '"><i class="fa fa-twitter"></i></a>';
                }
                if ($user_linkedin != '') {
                    print ' <a href="' . esc_url($user_linkedin) . '"><i class="fa fa-linkedin"></i></a>';
                }
                if ($user_pinterest != '') {
                    print ' <a href="' . esc_url($user_pinterest) . '"><i class="fa fa-pinterest"></i></a>';
                }*/
                ?>  
            </div>
        </div>
    </div>
</div>