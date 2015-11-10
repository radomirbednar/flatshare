<?php
// Single Agent
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
            $userID = get_the_author_meta("ID");
             
            
            $first_name = esc_attr(get_the_author_meta('first_name', $q->ID));
            $last_name = esc_attr(get_the_author_meta('last_name', $q->ID));
            
            
            
            $user_facebook = get_the_author_meta('facebook', $q->ID);
            $user_twitter = get_the_author_meta('twitter', $q->ID);
            $user_linkedin = get_the_author_meta('linkedin', $q->ID);
            $user_pinterest = get_the_author_meta('pinterest', $q->ID);
            $photo_url = get_the_author_meta('custom_picture', $q->ID);
            
            
            
            $user_gender = esc_attr(get_user_meta_int($q->ID, 'user_gender'));
            $user_age = esc_attr(get_user_meta_int($q->ID, 'user_age'));
            $looking_where = esc_attr(get_user_meta($q->ID, 'looking_where', true));
             
            $user_email = get_the_author_meta('user_email', $userID);
             
            $user_mobile = get_the_author_meta('mobile', $userID);
            $user_phone = get_the_author_meta('phone', $userID);
            $user_description = esc_attr(get_the_author_meta('description', $userID));
            
            $user_skype = get_the_author_meta('skype', $userID);
            $website = get_the_author_meta('website', $userID);
 
            
            $how_long = esc_attr(get_user_meta_int($userID, 'how_long'));
            $user_age = esc_attr(get_user_meta_int($userID, 'user_age'));
            $sexual_preference = esc_attr(get_user_meta_int($userID, 'sexual_preference'));
            $sleeping_span = esc_attr(get_user_meta_int($userID, 'sleeping_span'));
            $party = esc_attr(get_user_meta_int($userID, 'party'));
            $looking_for = esc_attr(get_user_meta_int($userID, 'looking_for'));
            $couple = esc_attr(get_user_meta_int($userID, 'couple'));
            $pets = esc_attr(get_user_meta_int($userID, 'pets'));
            $smoker = esc_attr(get_user_meta_int($userID, 'smoker'));
            $activity = esc_attr(get_user_meta_int($userID, 'activity'));
            $user_gender = esc_attr(get_user_meta_int($userID, 'user_gender'));

            
            $user_origin = esc_attr(get_user_meta($userID, 'user_origin', true));
            $looking_where = esc_attr(get_user_meta($userID, 'looking_where', true));

            $user_language_ids = fl_get_user_language_ids($userID);
            $user_skill_ids = fl_get_user_house_skill_ids($userID);

            $user_title = get_the_author_meta('title', $userID);
            
            $user_custom_picture = get_the_author_meta('custom_picture', $userID);
             
            $user_small_picture = get_the_author_meta('small_custom_picture', $userID);
            $image_id = get_the_author_meta('small_custom_picture', $userID);
            $about_me = get_the_author_meta('description', $userID);
            
            
            if ($user_custom_picture == '') {
                
                $user_custom_picture = get_template_directory_uri() . '/img/default_user.png';
               
            } 
            ?>
 
            <h1 class="entry-title-agent"><?php echo $first_name.' '.$last_name; ?></h1>
       
            <div class="agent_meta"><?php print $agent_posit . ' | ' . '<a href="mailto:' . $user_email . '">' . $user_email . '</a>'; ?></div>
             
            <div class="single-content single-agent">
               
                <?php include( locate_template('templates/userdetails.php')); ?>
                 
            </div>

<?php get_template_part('templates/agent_contact'); ?>
                <?php get_template_part('templates/agent_listings'); ?>

        </div>
    </div><!-- end 9col container-->    
<?php // include(locate_template('sidebar.php'));  ?>
</div>    
            <?php
            get_footer();
            ?>