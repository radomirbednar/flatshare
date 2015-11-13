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
    <?php get_template_part('templates/breadcrumbs'); ?>
    
    <div class=" <?php print $options['content_class']; ?> "> 
        <?php get_template_part('templates/ajax_container'); ?>
        <div id="content_container">  
            <?php
            
            $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
            
            
            $userID = $curauth->data->ID;
 
            /*
            $sexual_preference = esc_attr(get_user_meta_int($userID, 'sexual_preference')); 
            $sleeping_span = esc_attr(get_user_meta_int($userID, 'sleeping_span'));
            $party = esc_attr(get_user_meta_int($userID, 'party'));
            $looking_for = esc_attr(get_user_meta_int($userID, 'looking_for'));
            $couple = esc_attr(get_user_meta_int($userID, 'couple'));
            $pets = esc_attr(get_user_meta_int($userID, 'pets'));
            $smoker = esc_attr(get_user_meta_int($userID, 'smoker'));
            */
             
            
            $user_origin = esc_attr(get_user_meta($userID, 'user_origin', true));
            $looking_where = esc_attr(get_user_meta($userID, 'looking_where', true));
            $user_language_ids = fl_get_user_language_ids($userID);
            $user_skill_ids = fl_get_user_house_skill_ids($userID);
            $user_title = get_the_author_meta('title', $userID);
            $user_custom_picture = get_the_author_meta('custom_picture', $userID);
            $user_small_picture = get_the_author_meta('small_custom_picture', $userID);
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
            
            $activity_array = array(
                '1' => __('Student', 'wpestate'),
                '2' => __('Professional', 'wpestate')
            );
             
            $user_gender_array = array(
                '2' => __('female', 'wpestate'),
                '1' => __('male', 'wpestate')
            );

           
            if ($user_custom_picture == '') {
                $user_custom_picture = get_template_directory_uri() . '/img/default_user.png';
            }
            ?>

            <h1 class="entry-title-agent"><?php echo $first_name . ' ' . $last_name; ?></h1> 
            <div class="agent_meta"><?php print '<a href="mailto:' . $user_email . '">' . $user_email . '</a>'; ?>

                <?php
                if ($user_age) {
                    print ' | ' . __('Age', 'wpestate') . ':  | ';
                }
                if ($user_gender) {
                    print ' <img src="' . get_bloginfo('template_url') . '/img/' . $user_gender_array[$user_gender] . '.png" class="">';
                }
                ?>    

            </div> 
            <div class="single-content single-agent">      
                <?php include( locate_template('templates/userdetails.php')); ?> 
            </div> 
         
            <?php
           
            include('templates/author_contact.php'); ?> 
             
            <?php get_template_part('templates/user_listings'); ?>  

        </div> 
    </div><!-- end 9col container-->    

    <div class="col-md-3">
        <?php
            $currency = esc_html(get_option('wp_estate_currency_symbol', ''));
            $where_currency = esc_html(get_option('wp_estate_where_currency_symbol', ''));
        ?>         
        <h4> 
            <?php
            if ($rent_amount != '') {
                print __('price: ', 'wpestate') . ' ' . wpestate_show_price_floor($rent_amount, $currency, $where_currency, 1);
            }
            ?> 
        </h4> 
        <p>
        <strong> 
            <?php 
            if( $disponibility != '' ) {  
                print __('disponibility: ', 'wpestate').' '.$disponibility; 
            }
            ?>  
        </strong>    
        </p> 
        <p>
        <strong>
            <?php 
            if( $activity != '' ) {  
                print __('activity: ', 'wpestate').' '.$activity_array[$activity]; 
            }
            ?>  
        </strong>
        </p>     
    </div> 
    <?php // include(locate_template('sidebar.php'));   ?>
</div>    
<?php
get_footer();
?>