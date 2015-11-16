<?php
global $options;
global $prop_id;
global $post;
global $agent_url;
global $agent_urlc;

$pict_size = 5;
$content_size = 7;

if ($options['content_class'] == 'col-md-12') {
    $pict_size = 4;
    $content_size = '8';
}

if (get_post_type($prop_id) == 'estate_property') {
    $pict_size = 4;
    $content_size = 8;
    if ($options['content_class'] == 'col-md-12') {
        $pict_size = 3;
        $content_size = '9';
    }
}


//link to user
  
$link = esc_url(get_author_posts_url($user_ID));
 
?> 
<div class="col-md-<?php print $pict_size; ?> agentpic-wrapper">
    <div class="agent-listing-img-wrapper" data-link="<?php echo $link; ?>">  
        <a href="<?php print $link; ?>">
            <img src="<?php print $user_custom_picture; ?>"  alt="agent picture" class="img-responsive agentpict"/>
        </a>     
        <div class="listing-cover"></div>
        <div class="listing-cover-title"><a href="<?php echo $link; ?>"><?php echo $name; ?></a></div> 
    </div>  
    <div class="agent_unit_social_single">
        <div class="social-wrapper">  
            <?php
            if ($user_facebook != '') {
                print ' <a href="' . $user_facebook . '" target="_blank"><i class="fa fa-facebook"></i></a>';
            }
            if ($user_twitter != '') {
                print ' <a href="' . $user_twitter . '" target="_blank"><i class="fa fa-twitter"></i></a>';
            }
            if ($user_linkedin != '') {
                print ' <a href="' . $user_linkedin . '" target="_blank"><i class="fa fa-linkedin"></i></a>';
            }
            if ($user_pinterest != '') {
                print ' <a href="' . $user_pinterest . '" target="_blank"><i class="fa fa-pinterest"></i></a>';
            }
            ?> 
        </div>
    </div>
</div>   
<div class="col-md-<?php print $content_size; ?> agent_details">    
    <div class="mydetails"> 
        <?php _e('My Contacts', 'wpestate'); ?>
    </div>
    <?php
    print '<h3><a href="' . $link . '">' . $name . '</a></h3>';
    if ($user_phone) {
        print '<div class="agent_detail"><i class="fa fa-phone"></i><a href="tel:' . $user_phone . '">' . $user_phone . '</a></div>';
    }
    if ($user_mobile) {
        print '<div class="agent_detail"><i class="fa fa-mobile"></i><a href="tel:' . $user_mobile . '">' . $user_mobile . '</a></div>';
    }
    if ($user_email) {
        print '<div class="agent_detail agent_email_class"><i class="fa fa-envelope-o"></i><a href="mailto:' . $user_email . '">' . $user_email . '</a></div>';
    }
    if ($user_skype) {
        print '<div class="agent_detail"><i class="fa fa-skype"></i>' . $user_skype . '</div>';
    }
    if ($agent_urlc) {
        print '<div class="agent_detail"><i class="fa fa-desktop"></i><a href="http://' . $agent_urlc . '" target="_blank">' . $agent_urlc . '</a></div>';
    }
    ?> 
</div> 
<?php //if ()) {  ?>  
<div class="agent_content col-md-12">
    <h4><?php _e('About Me ', 'wpestate'); ?></h4>                      
    <?php echo $user_description; ?>  
</div> 
<?php
//} ?>