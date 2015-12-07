<?php
global $property_adr_text;
global $property_details_text;
global $property_features_text;
global $feature_list_array;
global $use_floor_plans;
global $property_description_text;
global $post;
$walkscore_api = esc_html(get_option('wp_estate_walkscore_api', ''));
$show_graph_prop_page = esc_html(get_option('wp_estate_show_graph_prop_page', ''));

$how_long = esc_html(get_post_meta($post->ID, 'how_long', true));
$sexual_preference = esc_html(get_post_meta($post->ID, 'sexual_preference', true));
$user_gender = esc_html(get_post_meta($post->ID, 'user_gender', true));
$sleeping_span = esc_html(get_post_meta($post->ID, 'sleeping_span', true));
$couple = esc_html(get_post_meta($post->ID, 'couple', true));
$pets = esc_html(get_post_meta($post->ID, 'pets', true));
$smoker = esc_html(get_post_meta($post->ID, 'smoker', true));
$party = esc_html(get_post_meta($post->ID, 'party', true));
$rent_amount = esc_html(get_post_meta($post->ID, 'rent_amount', true));
$user_origin = esc_html(get_post_meta($post->ID, 'user_origin', true));
$activity = esc_html(get_post_meta($post->ID, 'activity', true));
$language = get_post_meta($post->ID, 'language', true);
$skill = get_post_meta($post->ID, 'skill', true);

 


    
$activity_array = array(
    '1' => __('Student', 'wpestate'),
    '2' => __('Professional', 'wpestate'),
    '3' => __('Never mind', 'wpestate')
);

$user_gender_array = array(
    '2' => __('female', 'wpestate'),
    '1' => __('male', 'wpestate'),
    '3' => __('Never mind', 'wpestate')
);

$how_long_array = array(
    '1' => __('short term', 'wpestate'),
    '2' => __('long term', 'wpestate'),
    '3' => __('Never mind', 'wpestate')
);

$looking_for_array = array(
    '1' => array(
        '<i class="icon-icon_roommate"></i>',
        __('roomate', 'wpestate'))
    ,
    '2' => array(
        '<i class="icon-icon_flat"> </i>',
        __('flat', 'wpestate')
    ),
    '3' => array(
        '<i class="icon-icon_flat"> </i>',
        __('Never mind', 'wpestate')
    )
);

$sexual_preference_array = array(
    '1' => array(
        '<i class="icon-icon_sex-straight"></i>',
        __('straight', 'wpestate'))
    ,
    '2' => array(
        '<i class="icon-icon_sex-gay"> </i>',
        __('BI/GAY', 'wpestate')
    ),
    '3' => array(
        '<i class="icon-icon_sex-gay"> </i>',
        __('Never mind', 'wpestate')
    )
);

$sleeping_span_array = array(
    '1' => array(
        '<i class="icon-icon_sleep"></i>',
        __('Before 11PM', 'wpestate'))
    ,
    '2' => array(
        '<i class="icon-icon_sleep"></i>',
        __('After 11PM', 'wpestate')
    ),
    '3' => array(
        '<i class="icon-icon_sleep"></i>',
        __('Never mind', 'wpestate')
    )
);

$couple_array = array(
    '1' => array(
        '<i class="icon-icon_single"> </i>',
        __('single', 'wpestate'))
    ,
    '2' => array(
        '<i class="icon-icon_couple"> </i>',
        __('in couple', 'wpestate')
    ),
    '3' => array(
        '<i class="icon-icon_couple"> </i>',
        __('Never mind', 'wpestate')
    )
);

$pets_array = array(
    '1' => array(
        '<i class="icon-icon_no-pets"> </i>',
        __('No pets', 'wpestate'))
    ,
    '2' => array(
        '<i class="icon-icon_pets"> </i>',
        __('Pets', 'wpestate')
    ),
    '3' => array(
        '<i class="icon-icon_pets"> </i>',
        __('Never mind', 'wpestate')
    )
);
$smoker_array = array(
    '1' => array(
        '<i class="icon-icon_smoking"> </i>',
        __('Non-smoker', 'wpestate'))
    ,
    '2' => array(
        '<i class="icon-icon_smoking"> </i>',
        __('Smoker', 'wpestate')
    ),
    '3' => array(
        '<i class="icon-icon_smoking"> </i>',
        __('Never mind', 'wpestate')
    )
);

$party_array = array(
    '1' => array(
        '<i class="icon-icon_party-often"> </i>',
        __('Often', 'wpestate'))
    ,
    '2' => array(
        '<i class="icon-icon_party-less"> </i>',
        __('Not often', 'wpestate')
    ),
    '3' => array(
        '<i class="icon-icon_party-less"> </i>',
        __('Never mind', 'wpestate')
    )
);
?>
<div role="tabpanel" id="tab_prpg">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#description" aria-controls="description" role="tab" data-toggle="tab">
                <?php
                if ($property_description_text != '') {
                    echo $property_description_text;
                } else {
                    _e('Description', 'wpestate');
                }
                ?>
            </a>    
        </li> 
        <li role="presentation">
            <a href="#address" aria-controls="address" role="tab" data-toggle="tab">
                <?php
                if ($property_adr_text != '') {
                    echo $property_adr_text;
                } else {
                    _e('Property Address', 'wpestate');
                }
                ?>
            </a>
        </li> 
        <li role="presentation">
            <a href="#details" aria-controls="details" role="tab" data-toggle="tab">
                <?php
                if ($property_details_text == '') {
                    print __('Property Details', 'wpestate');
                } else {
                    print $property_details_text;
                }
                ?>
            </a>
        </li>
        <?php if (count($feature_list_array) != 0 && count($feature_list_array) != 1) { ?>
            <li role="presentation">
                <a href="#features" aria-controls="features" role="tab" data-toggle="tab">
                    <?php
                    if ($property_features_text == '') {
                        print __('Amenities and Features', 'wpestate');
                    } else {
                        print $property_features_text;
                    }
                    ?>
                </a>
            </li>
        <?php } ?> 
        <?php if ($walkscore_api != '') { ?>
            <li role="presentation">
                <a href="#walkscore" aria-controls="walkscore" role="tab" data-toggle="tab">
                    <?php _e('Walkscore', 'wpestate'); ?>
                </a>
            </li>
        <?php } ?>


        <?php if ($use_floor_plans == 1) { ?>
            <li role="presentation">
                <a href="#floor" aria-controls="floor" role="tab" data-toggle="tab">
                    <?php _e('Floor Plans', 'wpestate'); ?>
                </a>
            </li>
        <?php } ?>

        <?php if ($show_graph_prop_page == 'yes') { ?>
            <li role="presentation" class="tabs_stats" data-listingid="<?php echo $post->ID; ?>">
                <a href="#stats" aria-controls="stats" role="tab" data-toggle="tab">
                    <?php _e('Page Views', 'wpestate'); ?>
                </a>
            </li>
        <?php } ?>

        <li role="presentation">
            <a href="#preferences" aria-controls="preferences" role="tab" data-toggle="tab">
                <?php _e('Preferences', 'wpestate'); ?>  
            </a>
        </li> 
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="description">
            <?php
            $content = get_the_content();
            $content = apply_filters('the_content', $content);
            $content = str_replace(']]>', ']]&gt;', $content);

            if ($content != '') {
                print $content;
            }

            get_template_part('/templates/download_pdf');
            ?>      
        </div>

        <div role="tabpanel" class="tab-pane" id="address">
            <?php print estate_listing_address($post->ID); ?>
        </div>

        <div role="tabpanel" class="tab-pane" id="details">
            <?php print estate_listing_details($post->ID); ?>  
        </div>

        <div role="tabpanel" class="tab-pane" id="features">
            <?php print estate_listing_features($post->ID); ?>
        </div>  

        <?php if ($walkscore_api != '') { ?>
            <div role="tabpanel" class="tab-pane" id="walkscore">
                <?php wpestate_walkscore_details($post->ID); ?>
            </div>
        <?php } ?> 

        <?php if ($use_floor_plans == 1) { ?>
            <div role="tabpanel" class="tab-pane" id="floor">
                <?php print estate_floor_plan($post->ID); ?>
            </div>
        <?php } ?>

        <?php if ($show_graph_prop_page == 'yes') { ?>
            <div role="tabpanel" class="tab-pane" id="stats">
                <div class="panel-body">
                    <canvas id="myChartacc"></canvas>
                </div>
            </div>
        <?php } ?>

        <div role="tabpanel" class="tab-pane" id="preferences">
            <div class="panel-body">   

                <!--<div class="sub_block">
                <?php
                $currency = esc_html(get_option('wp_estate_currency_symbol', ''));
                $where_currency = esc_html(get_option('wp_estate_where_currency_symbol', ''));
                if ($rent_amount != '') {
                    print __('<span class="sub">Price: </span><i class="icon-icon_price"></i>', 'wpestate') . ' ' . wpestate_show_price_floor($rent_amount, $currency, $where_currency, 1);
                }
                ?> 
                </div>-->        

                <!--<div class="sub_block">
                <?php /* print __('<span class="sub">Disponibility: </span><i class="icon-icon_date"></i>', 'wpestate'); ?></span><?php
                  if ($disponibility != '') {
                  $date = new DateTime($disponibility);
                  print $date->format('d. m. Y');
                  } */
                ?>
                </div>-->

                <div class="sub_block"> 
                    <?php print __('<span class="sub">Activity: </span>', 'wpestate'); ?><?php
                    if ($activity != '') {
                        print $activity_array[$activity];
                    }
                    ?>
                </div>  
                <div class="sub_block"> 
                    <span class="sub"><?php print __('House Skills: ', 'wpestate'); ?></span>       
                    <?php
                    $skills = fl_get_house_skills();
                    $skillarray = $skill;
                    if (!empty($skills)):
                        foreach ($skills as $skill):
                            if (in_array($skill->id_skill, (array) $skillarray)):
                                ?>
                                <strong> 
                                    <?php echo $skill->name; ?> 
                                </strong>
                                <?php
                            endif;
                        endforeach;
                    endif;
                    ?> 
                </div>     
                <div class="sub_block">
                    <span class="sub"><?php print __('For how long: ', 'wpestate'); ?></span> 
                    <i class="icon-icon_time"></i>
                    <?php print $how_long_array[$how_long]; ?> 
                </div>  

                <!--<div class="sub_block">
                    <span class="sub"><?php //print __('Looking for: ', 'wpestate');  ?> </span>
                <?php //print $looking_for_array[$looking_for][0] . $looking_for_array[$looking_for][1]; ?> 
                </div>-->          

                <div class="sub_block">
                    <span class="sub"><?php print __('Sexual preferences: ', 'wpestate'); ?></span> 
                    <?php print $sexual_preference_array[$sexual_preference][0] . $sexual_preference_array[$sexual_preference][1]; ?>  
                </div>   
                <div class="sub_block">         
                    <span class="sub"><?php print __('Sleep during week: ', 'wpestate'); ?></span>
                    <?php print $sleeping_span_array[$sleeping_span][0] . $sleeping_span_array[$sleeping_span][1]; ?> 
                </div>  
                <div class="sub_block">
                    <span class="sub"><?php print __('Couple: ', 'wpestate'); ?></span>   
                    <?php print $couple_array[$couple][0] . $couple_array[$couple][1]; ?>  
                </div>  
                <div class="sub_block">          
                    <span class="sub"><?php print __('Pets: ', 'wpestate'); ?></span> 
                    <?php print $pets_array[$pets][0] . $pets_array[$pets][1]; ?> 
                </div>  
                <div class="sub_block">          
                    <span class="sub"><?php print __('Smoker: ', 'wpestate'); ?></span> 
                    <?php print $smoker_array[$smoker][0] . $smoker_array[$smoker][1]; ?>  
                </div>  
                <div class="sub_block">           
                    <span class="sub"><?php print __('Party: ', 'wpestate'); ?></span> 
                    <?php print $party_array[$party][0] . $party_array[$party][1]; ?>  
                </div> 
                 <div class="sub_block"> 
                    <span class="sub">
                        <?php print __('Country of origin: ', 'wpestate'); ?> 
                    </span>    
                    <?php echo $user_origin; ?>     
                </div>  
                <div class="sub_block"> 
                    <span class="sub"><?php print __('Language skills: ', 'wpestate'); ?></span>     
                    <?php
                    $languages = fl_get_languages(); 
                    if (!empty($languages)):
                        foreach ($languages as $lang):
                            if (in_array($lang->id_lang, (array) $language)):
                                ?>
                                <strong>
                                    <?php esc_attr_e($lang->name, 'wpestate'); ?>
                                </strong>
                                <?php
                            endif;
                        endforeach;
                    endif;
                    ?> 
                </div>      
            </div>
        </div>    
    </div> 
</div>