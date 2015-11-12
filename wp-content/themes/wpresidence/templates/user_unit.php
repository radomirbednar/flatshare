<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="col-md-3 listing_wrapper">
    <div class="agent_unit" data-link="<?php print $link; ?>">

        <div class="agent-unit-img-wrapper">
<?php
print $thumb_prop;
print '<div class="listing-cover"></div>
                            <a href="' . $author_url . '"> <span class="listing-cover-plus">+</span></a>';
?> 
        </div>   
        <div class="user_unit_info">  
<?php
print '<h4> <a href="' . $link . '">' . esc_attr($first_name) . ' ' . esc_attr($last_name) . '</a></h4>
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