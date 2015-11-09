<?php
global $current_user;
get_currentuserinfo();
$userID = $current_user->ID;
$user_login = $current_user->user_login;
$first_name = get_the_author_meta('first_name', $userID);
$last_name = get_the_author_meta('last_name', $userID);
$user_email = get_the_author_meta('user_email', $userID);
$user_mobile = get_the_author_meta('mobile', $userID);
$user_phone = get_the_author_meta('phone', $userID);
$description = get_the_author_meta('description', $userID);
$facebook = get_the_author_meta('facebook', $userID);
$twitter = get_the_author_meta('twitter', $userID);
$linkedin = get_the_author_meta('linkedin', $userID);
$pinterest = get_the_author_meta('pinterest', $userID);
$user_skype = get_the_author_meta('skype', $userID);
$website = get_the_author_meta('website', $userID);

//
$how_long = get_user_meta_int($userID, 'how_long');
$user_age = get_user_meta_int($userID, 'user_age');
$sexual_preference = get_user_meta_int($userID, 'sexual_preference');
$sleeping_span = get_user_meta_int($userID, 'sleeping_span');
$party = get_user_meta_int($userID, 'party');
$looking_for = get_user_meta_int($userID, 'looking_for');
$couple = get_user_meta_int($userID, 'couple');
$pets = get_user_meta_int($userID, 'pets');
$smoker = get_user_meta_int($userID, 'smoker');
$activity = get_user_meta_int($userID, 'activity');
$user_gender = get_user_meta_int($userID, 'user_gender');

$user_origin = get_user_meta($userID, 'user_origin', true);
$looking_where = get_user_meta($userID, 'looking_where', true);

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



<div id="user_profile_div" class="user_profile_div">
    <h3><?php
        _e('Welcome back, ', 'wpestate');
        echo $user_login . '!';
        ?></h3>
    <div id="profile_message">
    </div>


    <div class="add-estate profile-page row">
        <div class="profile_div col-md-4" id="profile-div">
            <?php
            print '<img id="profile-image" src="' . $user_custom_picture . '" alt="user image" data-profileurl="' . $user_custom_picture . '" data-smallprofileurl="' . $image_id . '" >';

            //print '/ '.$user_small_picture;
            ?>

            <div id="upload-container">
                <div id="aaiu-upload-container">

                    <button id="aaiu-uploader" class="wpb_button  wpb_btn-success wpb_btn-large vc_button"><?php _e('Upload Profile Image', 'wpestate'); ?></button>
                    <div id="aaiu-upload-imagelist">
                        <ul id="aaiu-ul-list" class="aaiu-upload-list"></ul>
                    </div>
                </div>
            </div>
            <span class="upload_explain"><?php _e('*minimum 314px x 180px', 'wpestate'); ?></span>
        </div>

        <div class="col-md-4">
            <p>
                <label for="firstname"><?php _e('First Name', 'wpestate'); ?></label>
                <input type="text" id="firstname" class="form-control" value="<?php echo $first_name; ?>"  name="firstname">
            </p>

            <p>
                <label for="secondname"><?php _e('Last Name', 'wpestate'); ?></label>
                <input type="text" id="secondname" class="form-control" value="<?php echo $last_name; ?>"  name="firstname">
            </p>

            <p>
                <label for="useremail"><?php _e('Email', 'wpestate'); ?></label>
                <input type="text" id="useremail"  class="form-control" value="<?php echo $user_email; ?>"  name="useremail">
            </p>

        </div>


        <div class="col-md-4">


            <p>
                <label for="userphone"><?php _e('Phone', 'wpestate'); ?></label>
                <input type="text" id="userphone" class="form-control" value="<?php echo $user_phone; ?>"  name="userphone">
            </p>
            <p>
                <label for="usermobile"><?php _e('Mobile', 'wpestate'); ?></label>
                <input type="text" id="usermobile" class="form-control" value="<?php echo $user_mobile; ?>"  name="usermobile">
            </p>

            <p>
                <label for="userskype"><?php _e('Skype', 'wpestate'); ?></label>
                <input type="text" id="userskype" class="form-control" value="<?php echo $user_skype; ?>"  name="userskype">
            </p>

            <?php wp_nonce_field('profile_ajax_nonce', 'security-profile'); ?>


        </div>
    </div>

    <h3><?php _e('Personal information', 'wpestate'); ?></h3>

    <div class="add-user-searching profile-page row border-radius">

        <div class="col-md-6">

            <p class="switcher">
                <!--<input type="hidden" id="how_long" name="how_long" value="<?php echo (int) $how_long ?>">-->
                <label><?php _e('For how long', 'wpestate'); ?></label>


                <input id="how_long-1" name="how_long" type="radio" value="1" class="hidden" <?php echo isset($how_long) && 1 == $how_long ? ' checked="checked" ' : '' ?>>
                <input id="how_long-2" name="how_long" type="radio" value="2" class="hidden" <?php echo isset($how_long) && 2 == $how_long ? ' checked="checked" ' : '' ?>>
                <label for="how_long-1" class="wpb_button wpb_btn-large <?php echo isset($how_long) && 1 == $how_long ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Less than 6 months', 'wpestate'); ?></label>
                <label for="how_long-2" class="wpb_button wpb_btn-large <?php echo isset($how_long) && 2 == $how_long ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('+ 6 months', 'wpestate'); ?></label>
                <!--
                <button class="wpb_button wpb_btn-large <?php echo $how_long == 1 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#how_long" data-value="1"><?php _e('Less than 6 months', 'wpestate'); ?></button>
                <button class="wpb_button wpb_btn-large <?php echo $how_long == 2 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#how_long" data-value="2"><?php _e('+ 6 months', 'wpestate'); ?></button>
                -->
            </p>

            <p class="switcher">
                <!--<input type="hidden" id="looking_for" name="looking_for" value="<?php echo (int) $looking_for ?>">-->
                <label><?php _e('Looking for', 'wpestate'); ?></label>

                <input id="looking_for-1" name="looking_for" type="radio" value="1" class="hidden" <?php echo isset($looking_for) && 1 == $looking_for ? ' checked="checked" ' : '' ?>>
                <input id="looking_for-2" name="looking_for" type="radio" value="2" class="hidden" <?php echo isset($looking_for) && 2 == $looking_for ? ' checked="checked" ' : '' ?>>
                <label for="looking_for-1" class="wpb_button wpb_btn-large <?php echo isset($looking_for) && 1 == $looking_for ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Room', 'wpestate'); ?></label>
                <label for="looking_for-2" class="wpb_button wpb_btn-large <?php echo isset($looking_for) && 2 == $looking_for ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Flat', 'wpestate'); ?></label>

                <!--
                <button class="wpb_button wpb_btn-large <?php echo $looking_for == 1 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#looking_for" data-value="1"><?php _e('Room', 'wpestate'); ?></button>
                <button class="wpb_button wpb_btn-large <?php echo $looking_for == 2 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#looking_for" data-value="2"><?php _e('Flat', 'wpestate'); ?></button>
                -->
            </p>

            <p class="switcher">
                <!--<input type="hidden" id="sexual_preference" name="sexual_preference" value="<?php echo (int) $sexual_preference ?>">-->
                <label><?php _e('Sexual preferences', 'wpestate'); ?></label>

                <input id="sexual_preference-1" name="sexual_preference" type="radio" value="1" class="hidden" <?php echo isset($sexual_preference) && 1 == $sexual_preference ? ' checked="checked" ' : '' ?>>
                <input id="sexual_preference-2" name="sexual_preference" type="radio" value="2" class="hidden" <?php echo isset($sexual_preference) && 2 == $sexual_preference ? ' checked="checked" ' : '' ?>>
                <label for="sexual_preference-1" class="wpb_button wpb_btn-large <?php echo isset($sexual_preference) && 1 == $sexual_preference ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Straight', 'wpestate'); ?></label>
                <label for="sexual_preference-2" class="wpb_button wpb_btn-large <?php echo isset($sexual_preference) && 2 == $sexual_preference ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Bi / Gay', 'wpestate'); ?></label>

                <!--
                <button class="wpb_button wpb_btn-large <?php echo $sexual_preference == 1 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#sexual_preference" data-value="1"><?php _e('Straight', 'wpestate'); ?></button>
                <button class="wpb_button wpb_btn-large <?php echo $sexual_preference == 2 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#sexual_preference" data-value="2"><?php _e('Bi / Gay', 'wpestate'); ?></button>
                -->
            </p>

            <p class="switcher">
                <!--<input type="hidden" id="user_gender" name="user_gender" value="<?php echo (int) $user_gender ?>">-->
                <label><?php _e('Gender', 'wpestate'); ?></label>

                <input id="user_gender-1" name="user_gender" type="radio" value="1" class="hidden" <?php echo isset($user_gender) && 1 == $user_gender ? ' checked="checked" ' : '' ?>>
                <input id="user_gender-2" name="user_gender" type="radio" value="2" class="hidden" <?php echo isset($user_gender) && 2 == $user_gender ? ' checked="checked" ' : '' ?>>
                <label for="user_gender-1" class="wpb_button wpb_btn-large <?php echo isset($user_gender) && 1 == $user_gender ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Male', 'wpestate'); ?></label>
                <label for="user_gender-2" class="wpb_button wpb_btn-large <?php echo isset($user_gender) && 2 == $user_gender ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Female', 'wpestate'); ?></label>

                <!--
                <button class="wpb_button wpb_btn-large <?php echo $user_gender == 1 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#user_gender" data-value="1"><?php _e('Male', 'wpestate'); ?></button>
                <button class="wpb_button wpb_btn-large <?php echo $user_gender == 2 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#user_gender" data-value="2"><?php _e('Female', 'wpestate'); ?></button>
                -->
            </p>

            <p class="switcher">
                <!--<input type="hidden" id="sleeping_span" name="sleeping_span" value="<?php echo (int) $sleeping_span ?>">-->
                <label><?php _e('Sleep during week', 'wpestate'); ?></label>

                <input id="sleeping_span-1" name="sleeping_span" type="radio" value="1" class="hidden" <?php echo isset($sleeping_span) && 1 == $sleeping_span ? ' checked="checked" ' : '' ?>>
                <input id="sleeping_span-2" name="sleeping_span" type="radio" value="2" class="hidden" <?php echo isset($sleeping_span) && 2 == $sleeping_span ? ' checked="checked" ' : '' ?>>
                <label for="sleeping_span-1" class="wpb_button wpb_btn-large <?php echo isset($sleeping_span) && 1 == $sleeping_span ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Before 11PM', 'wpestate'); ?></label>
                <label for="sleeping_span-2" class="wpb_button wpb_btn-large <?php echo isset($sleeping_span) && 2 == $sleeping_span ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('After 11PM', 'wpestate'); ?></label>

                <!--
                <button class="wpb_button wpb_btn-large <?php echo $sleeping_span == 1 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#sleeping_span" data-value="1"><?php _e('Before 11PM', 'wpestate'); ?></button>
                <button class="wpb_button wpb_btn-large <?php echo $sleeping_span == 2 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#sleeping_span" data-value="2"><?php _e('After 11PM', 'wpestate'); ?></button>
                -->
            </p>

            <p class="switcher">
                <!--<input type="hidden" id="couple" name="couple" value="<?php echo (int) $couple ?>">-->
                <label><?php _e('Couple', 'wpestate'); ?></label>

                <input id="couple-1" name="couple" type="radio" value="1" class="hidden" <?php echo isset($couple) && 1 == $couple ? ' checked="checked" ' : '' ?>>
                <input id="couple-2" name="couple" type="radio" value="2" class="hidden" <?php echo isset($couple) && 2 == $couple ? ' checked="checked" ' : '' ?>>
                <label for="couple-1" class="wpb_button wpb_btn-large <?php echo isset($couple) && 1 == $couple ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Alone', 'wpestate'); ?></label>
                <label for="couple-2" class="wpb_button wpb_btn-large <?php echo isset($couple) && 2 == $couple ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('In couple', 'wpestate'); ?></label>

                <!--
                <button class="wpb_button wpb_btn-large <?php echo $couple == 1 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#couple" data-value="1"><?php _e('Alone', 'wpestate'); ?></button>
                <button class="wpb_button wpb_btn-large <?php echo $couple == 2 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#couple" data-value="2"><?php _e('In couple', 'wpestate'); ?></button>
                -->
            </p>

            <p class="switcher">
                <!--<input type="hidden" id="pets" name="pets" value="<?php echo (int) $pets ?>">-->
                <label><?php _e('Pets', 'wpestate'); ?></label>

                <input id="pets-1" name="pets" type="radio" value="1" class="hidden" <?php echo isset($pets) && 1 == $pets ? ' checked="checked" ' : '' ?>>
                <input id="pets-2" name="pets" type="radio" value="2" class="hidden" <?php echo isset($pets) && 2 == $pets ? ' checked="checked" ' : '' ?>>
                <label for="pets-1" class="wpb_button wpb_btn-large <?php echo isset($pets) && 1 == $pets ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('No pets', 'wpestate'); ?></label>
                <label for="pets-2" class="wpb_button wpb_btn-large <?php echo isset($pets) && 2 == $pets ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Pets', 'wpestate'); ?></label>

                <!--
                <button class="wpb_button wpb_btn-large <?php echo $pets == 1 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#pets" data-value="1"><?php _e('No pets', 'wpestate'); ?></button>
                <button class="wpb_button wpb_btn-large <?php echo $pets == 2 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#pets" data-value="2"><?php _e('Pets', 'wpestate'); ?></button>
                -->
            </p>

            <p class="switcher">
                <!--<input type="hidden" id="smoker" name="smoker" value="<?php echo (int) $smoker ?>">-->
                <label><?php _e('Smoker', 'wpestate'); ?></label>

                <input id="smoker-1" name="smoker" type="radio" value="1" class="hidden" <?php echo isset($smoker) && 1 == $smoker ? ' checked="checked" ' : '' ?>>
                <input id="smoker-2" name="smoker" type="radio" value="2" class="hidden" <?php echo isset($smoker) && 2 == $smoker ? ' checked="checked" ' : '' ?>>
                <label for="smoker-1" class="wpb_button wpb_btn-large <?php echo isset($smoker) && 1 == $smoker ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Non-smoker', 'wpestate'); ?></label>
                <label for="smoker-2" class="wpb_button wpb_btn-large <?php echo isset($smoker) && 2 == $smoker ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Smoker', 'wpestate'); ?></label>

                <!--
                <button class="wpb_button wpb_btn-large <?php echo $smoker == 1 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#smoker" data-value="1"><?php _e('Non-smoker', 'wpestate'); ?></button>
                <button class="wpb_button wpb_btn-large <?php echo $smoker == 2 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#smoker" data-value="2"><?php _e('Smoker', 'wpestate'); ?></button>
                -->
            </p>

            <p class="switcher">
                <!--<input type="hidden" id="party" name="party" value="<?php echo (int) $party ?>">-->
                <label><?php _e('Party', 'wpestate'); ?></label>

                <input id="party-1" name="party" type="radio" value="1" class="hidden" <?php echo isset($party) && 1 == $party ? ' checked="checked" ' : '' ?>>
                <input id="party-2" name="party" type="radio" value="2" class="hidden" <?php echo isset($party) && 2 == $party ? ' checked="checked" ' : '' ?>>
                <label for="party-1" class="wpb_button wpb_btn-large <?php echo isset($party) && 1 == $party ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Often', 'wpestate'); ?></label>
                <label for="party-2" class="wpb_button wpb_btn-large <?php echo isset($party) && 2 == $party ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Not often', 'wpestate'); ?></label>

                <!--
                <button class="wpb_button wpb_btn-large <?php echo $party == 1 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#party" data-value="1"><?php _e('Often', 'wpestate'); ?></button>
                <button class="wpb_button wpb_btn-large <?php echo $party == 2 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#party" data-value="2"><?php _e('Not often', 'wpestate'); ?></button>
                -->
            </p>

        </div>



        <div class="col-md-6">

            <p>
                <label><?php _e('Where would you like to do your flatshare', 'wpestate'); ?></label>
                <input type="text" id="looking_where" class="form-control" value="<?php echo esc_attr($looking_where) ?>"  name="looking_where">
            </p>

            <script>

                function loadScript(src, callback) {
                    var script = document.createElement("script");
                    script.type = "text/javascript";
                    if (callback)
                        script.onload = callback;
                    document.getElementsByTagName("head")[0].appendChild(script);
                    script.src = src;
                }

                loadScript('http://maps.googleapis.com/maps/api/js?v=3&sensor=false&libraries=places&callback=initialize');
 
                function initialize() {
                    
                    
                    var options = {
                        types: ['(cities)'],
                        //componentRestrictions: {country: "cz"}
                    };
                    
                    var input = document.getElementById('looking_where');
                    var autocomplete = new google.maps.places.Autocomplete(input, options);
                
    
                    }

            </script>

            <script>
                jQuery(document).ready(function ($) {
                    jQuery("#when_move").datepicker({
                        dateFormat: "yy-mm-dd",
                    }, jQuery.datepicker.regional[control_vars.datepick_lang]).datepicker('widget').wrap('<div class="ll-skin-melon"/>');
                });
            </script>
            <p>
                <label><?php _e('Disponibility', 'wpestate'); ?></label>
                <input type="text" id="when_move" class="form-control" value="<?php echo esc_attr($when_move) ?>"  name="when_move">
            </p>

            <p>
                <?php
                $coutnries = fl_get_countries();
                ?>
                <label for="user_origin"><?php _e('Country of origin', 'wpestate'); ?></label>
                <select id="user_origin" name="user_origin" class="form-control">
                    <option value=""><?php _e('Select country', 'wpestate'); ?></option>
                    <?php
                    if (!empty($coutnries)):
                        foreach ($coutnries as $country):
                            ?>
                            <option value="<?php echo esc_attr($country->iso) ?>" <?php echo $user_origin == $country->iso ? ' selected="selected" ' : ''; ?>><?php _e($country->name); ?></option>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </select>
            </p>

            <p>
                <label for="user_age"><?php _e('Your age', 'wpestate'); ?></label>
                <input type="text" id="user_age" class="form-control" value="<?php echo (int) $user_age; ?>"  name="user_age">
            </p>

            <p class="switcher">
                <!--<input type="hidden" id="activity" name="activity" value="<?php echo (int) $activity ?>">-->

                <label><?php _e('Activity', 'wpestate'); ?></label>

                <input id="activity-1" name="activity" type="radio" value="1" class="hidden" <?php echo isset($activity) && 1 == $activity ? ' checked="checked" ' : '' ?>>
                <input id="activity-2" name="activity" type="radio" value="2" class="hidden" <?php echo isset($activity) && 2 == $activity ? ' checked="checked" ' : '' ?>>
                <label for="activity-1" class="wpb_button wpb_btn-large <?php echo isset($activity) && 1 == $activity ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Student', 'wpestate'); ?></label>
                <label for="activity-2" class="wpb_button wpb_btn-large <?php echo isset($activity) && 2 == $activity ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Professional', 'wpestate'); ?></label>

                <!--
                <button class="wpb_button wpb_btn-large <?php echo $activity == 1 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#activity" data-value="1"><?php _e('Student', 'wpestate'); ?></button>
                <button class="wpb_button wpb_btn-large <?php echo $activity == 2 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#activity" data-value="2"><?php _e('Professional', 'wpestate'); ?></button>
                -->
            </p>



            <p class="inline-checkboxes">
                <label><?php _e('House skills', 'wpestate'); ?></label>
                <?php
                $skills = fl_get_house_skills();
                if (!empty($skills)):
                    foreach ($skills as $skill):
                        $selected = in_array($skill->id_skill, (array) $user_skill_ids) ? ' checked ' : '';
                        ?>
                        <span class="flcheckbox">
                            <label>
                                <input name="skill[]" type="checkbox" value="<?php echo (int) $skill->id_skill ?>" <?php echo $selected ?>><?php esc_attr_e($skill->name) ?>
                            </label>
                        </span>
                        <?php
                    endforeach;
                endif;
                ?>
            </p>

        </div>

        <div class="col-xs-12">
            <p class="inline-checkboxes">
                <label><?php _e('Language skills', 'wpestate'); ?></label>

                <?php
                $languages = fl_get_languages();

                if (!empty($languages)):
                    foreach ($languages as $lang):
                        $selected = in_array($lang->id_lang, (array) $user_language_ids) ? ' checked ' : '';
                        ?>
                        <span class="flcheckbox">
                            <label><input name="language[]" type="checkbox" value="<?php echo (int) $lang->id_lang ?>" <?php echo $selected ?>><?php esc_attr_e($lang->name) ?></label>
                        </span>
                        <?php
                    endforeach;
                endif;
                ?>
            </p>
        </div>


    </div>

    <div class="add-estate profile-page row">
        <div class="col-md-4">
            <p>
                <label for="userfacebook"><?php _e('Facebook Url', 'wpestate'); ?></label>
                <input type="text" id="userfacebook" class="form-control" value="<?php echo $facebook; ?>"  name="userfacebook">
            </p>

            <p>
                <label for="usertwitter"><?php _e('Twitter Url', 'wpestate'); ?></label>
                <input type="text" id="usertwitter" class="form-control" value="<?php echo $twitter; ?>"  name="usertwitter">
            </p>

            <p>
                <label for="userlinkedin"><?php _e('Linkedin Url', 'wpestate'); ?></label>
                <input type="text" id="userlinkedin" class="form-control"  value="<?php echo $linkedin; ?>"  name="userlinkedin">
            </p>

            <p>
                <label for="userpinterest"><?php _e('Pinterest Url', 'wpestate'); ?></label>
                <input type="text" id="userpinterest" class="form-control" value="<?php echo $pinterest; ?>"  name="userpinterest">
            </p>
            <p>
                <label for="website"><?php _e('Website Url (without http)', 'wpestate'); ?></label>
                <input type="text" id="website" class="form-control" value="<?php echo $website; ?>"  name="website">
            </p>
        </div>

        <div class="col-md-8">
            <p>
                <label for="usertitle"><?php _e('Title/Position', 'wpestate'); ?></label>
                <input type="text" id="usertitle" class="form-control" value="<?php echo $user_title; ?>"  name="usertitle">
            </p>
            <p>
                <label for="about_me"><?php _e('About Me', 'wpestate'); ?></label>
                <textarea id="about_me" class="form-control" name="about_me"><?php echo $about_me; ?></textarea>
            </p>

        </div>

        <p class="fullp-button">
            <button class="wpb_button  wpb_btn-info wpb_btn-large" id="update_profile"><?php _e('Update profile', 'wpestate'); ?></button>
        </p>
    </div>



    <h3><?php _e('Change Password', 'wpestate'); ?> </h3>

    <div class="profile-page row">
        <div class="pass_note"> <?php _e('*After you change the password you will have to login again.', 'wpestate') ?></div>
        <div id="profile_pass">
        </div>

        <p  class="col-md-4">
            <label for="oldpass"><?php _e('Old Password', 'wpestate'); ?></label>
            <input  id="oldpass" value=""  class="form-control" name="oldpass" type="password">
        </p>

        <p  class="col-md-4">
            <label for="newpass"><?php _e('New Password ', 'wpestate'); ?></label>
            <input  id="newpass" value="" class="form-control" name="newpass" type="password">
        </p>
        <p  class="col-md-4">
            <label for="renewpass"><?php _e('Confirm New Password', 'wpestate'); ?></label>
            <input id="renewpass" value=""  class="form-control" name="renewpass"type="password">
        </p>

        <?php wp_nonce_field('pass_ajax_nonce', 'security-pass'); ?>
        <p class="fullp-button">
            <button class="wpb_button  wpb_btn-info wpb_btn-large vc_button" id="change_pass"><?php _e('Reset Password', 'wpestate'); ?></button>

        </p>
    </div>
</div>
