<?php
// Single User
// Wp Estate Pack

get_header();

$options = wpestate_page_details($post->ID);
$show_compare = 1;
$currency = esc_html(get_option('wp_estate_currency_symbol', ''));
$where_currency = esc_html(get_option('wp_estate_where_currency_symbol', ''));
?> 
<div class="row"> 
    <?php //get_template_part('templates/breadcrumbs'); ?>
    <div class=" <?php print $options['content_class']; ?> "> 
        <?php get_template_part('templates/ajax_container'); ?>
        <div id="content_container">  
            <?php
            $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
            $userID = $curauth->data->ID;
            $user_origin = esc_attr(get_user_meta($userID, 'user_origin', true));
            $looking_where = esc_attr(get_user_meta($userID, 'looking_where', true));
            $user_language_ids = fl_get_user_languages_name($userID);
            $user_skill_ids = fl_get_user_house_skill_ids($userID);
            $user_title = get_the_author_meta('title', $userID); 
            $user_custom_picture = get_the_author_meta('custom_picture', $userID);           
            $user_small_picture = get_the_author_meta('small_custom_picture', $userID);  
            $user_custom_picture = wp_get_attachment_url( $user_small_picture ); 
            $image_id = get_the_author_meta('small_custom_picture', $userID);  
            $about_me = get_the_author_meta('description', $userID);

            $first_name = esc_attr(get_the_author_meta('first_name', $userID));
            $last_name = esc_attr(get_the_author_meta('last_name', $userID));
            $user_facebook = get_the_author_meta('facebook', $userID);
            $user_twitter = get_the_author_meta('twitter', $userID);
            $user_linkedin = get_the_author_meta('linkedin', $userID);
            $user_pinterest = get_the_author_meta('pinterest', $userID);
            $photo_url = get_the_author_meta('custom_picture', $userID);
            $user_email = get_the_author_meta('user_email', $userID);
            $user_mobile = get_the_author_meta('mobile', $userID);
            $user_phone = get_the_author_meta('phone', $userID);
            $user_description = esc_attr(get_the_author_meta('description', $userID));
            $user_skype = get_the_author_meta('skype', $userID);
            $website = get_the_author_meta('website', $userID);
            $fl_user_data = get_fl_data($userID);

            $user_gender = !empty($fl_user_data->user_gender) ? $fl_user_data->user_gender : '';
            $user_age = !empty($fl_user_data->user_age) ? $fl_user_data->user_age : '';
            $looking_where = !empty($fl_user_data->looking_where) ? $fl_user_data->looking_where : '';
            $rent_amount = !empty($fl_user_data->rent_amount) ? $fl_user_data->rent_amount : '';
            $activity = !empty($fl_user_data->activity) ? $fl_user_data->activity : '';
            $disponibility = !empty($fl_user_data->disponibility) ? $fl_user_data->disponibility : '';
            $how_long = !empty($fl_user_data->how_long) ? $fl_user_data->how_long : '';
            $sexual_preference = !empty($fl_user_data->sexual_preference) ? $fl_user_data->sexual_preference : '';
            $sleeping_span = !empty($fl_user_data->sleeping_span) ? $fl_user_data->sleeping_span : '';
            $couple = !empty($fl_user_data->couple) ? $fl_user_data->couple : '';
            $smoker = !empty($fl_user_data->smoker) ? $fl_user_data->smoker : '';
            $pets = !empty($fl_user_data->pets) ? $fl_user_data->pets : '';
            $user_origin = !empty($fl_user_data->user_origin) ? $fl_user_data->user_origin : '';
            $party = !empty($fl_user_data->party) ? $fl_user_data->party : '';
            $looking_when = !empty($fl_user_data->looking_when) ? $fl_user_data->looking_when : '';
            $looking_for = !empty($fl_user_data->looking_for) ? $fl_user_data->looking_for : ''; 
            $user_status = !empty($fl_user_data->user_status) ? $fl_user_data->user_status : ''; 
            $birthdate = !empty($fl_user_data->birthdate) ? $fl_user_data->birthdate : '';
   
            $date = new DateTime($birthdate);
            $now = new DateTime();
            $interval = $now->diff($date);
            $year_old = $interval->y; 
            $houseskils = fl_get_user_house_skills($userID);
 
            $activity_array = array(
                '1' => __('Student', 'wpestate'),
                '2' => __('Professional', 'wpestate')
            );

            $user_gender_array = array(
                '2' => __('female', 'wpestate'),
                '1' => __('male', 'wpestate')
            );

            $how_long_array = array(
                '1' => __('short term', 'wpestate'),
                '2' => __('long term', 'wpestate')
            );
 
            $looking_for_array = array(
                
                '1' => array(
                    '<i class="icon-icon_roommate"> </i>',
                    __('roomate', 'wpestate'))
                ,
                
                '2' => array(
                    '<i class="icon-icon_flat"> </i>',
                    __('flat', 'wpestate')
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
                )
            );

            if ($user_custom_picture == '') {
                $user_custom_picture = get_template_directory_uri() . '/img/default_user.png';
            }
             
            ?>
       
            <h1 class="entry-title-agent"><?php echo $first_name . ' ' . $last_name; ?></h1> 
            <div class="agent_meta">      
                <?php
                
                if ($user_gender) {
                    print ''.$user_gender_array[$user_gender].' <img src="' . get_bloginfo('template_url') . '/img/' . $user_gender_array[$user_gender] . '.png" class="">';
                } 
                if ($year_old) {
                    print ' | ' . __('Age', 'wpestate') . ': '.$year_old.' years | ';
                } 
                ?>  
                <?php echo __(' Looking for ', 'wpestate') . esc_attr($looking_for_array[$looking_for][1]) . ' in ' . esc_attr($looking_where); ?>  
 
                <div class="prop_social_single">  
                    <?php
                    $link = esc_url(get_author_posts_url($userID));
                    ?>  
                    <a href="http://www.facebook.com/sharer.php?u=<?php echo esc_url($link); ?>&amp;t=<?php echo $first_name . ' ' . $last_name; ?>" target="_blank" class="share_facebook"><i class="fa fa-facebook fa-2"></i></a>
                    <a href="http://twitter.com/home?status=<?php echo urlencode($first_name . ' ' . $last_name . ' ' . $link); ?>" class="share_tweet" target="_blank"><i class="fa fa-twitter fa-2"></i></a>
                    <a href="https://plus.google.com/share?url=<?php echo esc_url($link); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
                        return false;" target="_blank" class="share_google"><i class="fa fa-google-plus fa-2"></i></a> 
                        <?php if (isset($pinterest[0])) { ?>
                        <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo $pinterest[0]; ?>&amp;description=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share_pinterest"> <i class="fa fa-pinterest fa-2"></i> </a>      
                    <?php } ?> 
                </div> 
            </div> 

            <div class="single-content single-agent">      
                <?php include( locate_template('templates/userdetails.php')); ?> 
            </div>   
            <?php
            $login_url = get_permalink(240);

            if (is_user_logged_in()) {
                include('templates/author_contact.php');
            } else {
                
            }
            ?>  
            <?php
            // return '<div class="row"><div class="col-md-12"><a href="'.$login_url.'" class="wpb_button  wpb_btn-info wpb_btn-large vc_button">'. __('PLEASE LOGIN OR REGISTER TO CONTACT THIS USER', 'wpestate').' </a></div></div>';     
            echo '<div class="row"></div>';
            include('templates/user_listings.php');
            ?>   
        </div> 
    </div><!-- end 9col container-->      
    <?php if($user_status!=3): ?>   
    <div class="col-md-3">   
        <div class="mydetails"> 
            <?php _e('My Details', 'wpestate'); ?>
        </div>  
        <?php
        $currency = esc_html(get_option('wp_estate_currency_symbol', ''));
        $where_currency = esc_html(get_option('wp_estate_where_currency_symbol', ''));
        ?> 

        <div class="sub_block">
            <?php
            if ($rent_amount != '') {

                print __('<span class="sub">Price: </span><i class="icon-icon_price"></i>', 'wpestate') . ' ' . wpestate_show_price_floor($rent_amount, $currency, $where_currency, 1);
            }
            ?> 
        </div>       

        <div class="sub_block">
            <?php print __('<span class="sub">Disponibility: </span><i class="icon-icon_date"></i>', 'wpestate'); ?></span><?php
            if ($disponibility != '') {
                $date = new DateTime($disponibility);
                print $date->format('d. m. Y');
            }
            ?>
        </div> 
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
            foreach ($houseskils as $skil) {
                echo '<strong>' . $skil->name . '</strong>';
            }
            ?>     
        </div>     
        <div class="sub_block">
            <span class="sub"><?php print __('For how long: ', 'wpestate'); ?></span> 
            <i class="icon-icon_time"></i>
            <?php print $how_long_array[$how_long]; ?> 
        </div>  
        <div class="sub_block">
            <span class="sub"><?php print __('Looking for: ', 'wpestate'); ?></span> 
            <?php print ($looking_for_array[$looking_for][0]) . isset($looking_for_array[$looking_for][1]); ?> 
        </div>          
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
            <span class="sub"><?php print __('Language skills: ', 'wpestate'); ?></span>    
            <?php
            foreach ($user_language_ids as $lang) {
                echo '<strong>' . $lang . '</strong>';
            }
            ?> 
        </div>
        <div class="sub_block"> 
            <span class="sub">
                <?php print __('Country of origin: ', 'wpestate'); ?> 
            </span>    
            <?php echo $user_origin; ?>     
        </div> 
    </div>  
    <?php endif; ?> 
    <?php // include(locate_template('sidebar.php'));     ?>
</div>    
<?php
get_footer();
?>