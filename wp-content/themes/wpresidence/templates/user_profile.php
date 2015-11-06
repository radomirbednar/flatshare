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
$looking_where = get_user_meta_int($userID, 'looking_where');
$user_age = get_user_meta_int($userID, 'user_age');
$sexual_preference = get_user_meta_int($userID, 'sexual_preference');
$sleeping_span = get_user_meta_int($userID, 'sleeping_span');
$party = get_user_meta_int($userID, 'party');
$user_country = 'CZ';

$user_languages_ids = fl_get_user_language_ids($userID);
$user_skills_ids = fl_get_user_skill_ids($userID);

$user_title = get_the_author_meta('title', $userID);
$user_custom_picture = get_the_author_meta('custom_picture', $userID);
$user_small_picture = get_the_author_meta('small_custom_picture', $userID);
$image_id = get_the_author_meta('small_custom_picture', $userID);
$about_me = get_the_author_meta('description', $userID);
if ($user_custom_picture == '') {
    $user_custom_picture = get_template_directory_uri() . '/img/default_user.png';
}
?>

<script>
    jQuery(document).ready(function ($) {
        $(".switcher button").click(function () {
            var value = $(this).data("value");
            var target = $(this).data("target");
            //console.log(target + " " + value);
            $(target).val(value);
        });
    });
</script>

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

    <div class="add-user-personal profile-page row">

        <div class="col-md-12">

            <p class="switcher">
                <input type="hidden" id="how_long" name="how_long" value="<?php echo (int) $how_long ?>">
                <label><?php _e('For how long', 'wpestate'); ?></label>
                <button class="" data-target="#how_long" data-value="1"><?php _e('Less than 6 months', 'wpestate'); ?></button>
                <button class="" data-target="#how_long" data-value="2"><?php _e('+ 6 months', 'wpestate'); ?></button>
            </p>

            <p class="switcher">
                <input type="hidden" id="looking_for" name="looking_for" value="<?php echo (int) $looking_for ?>">
                <label><?php _e('Looking for', 'wpestate'); ?></label>
                <button class="" data-target="#looking_for" data-value="1"><?php _e('Room', 'wpestate'); ?></button>
                <button class="" data-target="#looking_for" data-value="2"><?php _e('Flat', 'wpestate'); ?></button>
            </p>

            <p>
                <label><?php _e('Where would you like to do your flatshare', 'wpestate'); ?></label>
                <input type="text" id="looking_where" class="form-control" value="<?php echo $looking_where; ?>"  name="looking_where">
            </p>



        </div>

        <div class="col-md-6">
            <p class="switcher">
                <input type="hidden" id="sexual_preference" name="sexual_preference" value="<?php echo (int) $sexual_preference ?>">
                <label><?php _e('Sexual preferences', 'wpestate'); ?></label>
                <button class="" data-target="#sexual_preference" data-value="1"><?php _e('Straight', 'wpestate'); ?></button>
                <button class="" data-target="#sexual_preference" data-value="2"><?php _e('Bi / Gay', 'wpestate'); ?></button>
            </p>
            <p class="switcher">
                <input type="hidden" id="sleeping_span" name="sleeping_span" value="<?php echo (int) $sleeping_span ?>">
                <label><?php _e('Sleep during week', 'wpestate'); ?></label>
                <button class="" data-target="#sleeping_span" data-value="1"><?php _e('Before 11PM', 'wpestate'); ?></button>
                <button class="" data-target="#sleeping_span" data-value="2"><?php _e('After 11PM', 'wpestate'); ?></button>
            </p>
            <p class="switcher">
                <input type="hidden" id="party" name="party" value="<?php echo (int) $party ?>">
                <label><?php _e('Party', 'wpestate'); ?></label>
                <button class="" data-target="#party" data-value="1"><?php _e('Often', 'wpestate'); ?></button>
                <button class="" data-target="#party" data-value="2"><?php _e('Not often', 'wpestate'); ?></button>
            </p>
        </div>

        <div class="col-md-6">
            <?php
            $coutnries = fl_get_countries();
            ?>
            <p>
                <label for="user_country"><?php _e('Country', 'wpestate'); ?></label>
                <select id="user_country" name="user_country" class="form-control">
                    <option value=""><?php _e('Select country', 'wpestate'); ?></option>
                    <?php
                    if (!empty($coutnries)):
                        foreach ($coutnries as $country):
                            ?>
                            <option value="<?php echo esc_attr($country->iso) ?>" <?php echo $user_country == $country->iso ? ' selected="selected" ' : ''; ?>><?php _e($country->name); ?></option>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </select>
            </p>

            <p>
                <label for="user_age"><?php _e('Your age', 'wpestate'); ?></label>
                <input type="text" id="user_age" class="form-control" value="<?php echo $user_age; ?>"  name="user_age">
            </p>

            <p>
                <?php _e('House skills', 'wpestate'); ?>
                <?php
                $skills = fl_get_house_skills();
                if (!empty($skills)):
                    foreach ($skills as $skill):
                        ?>
                        <span class="checkbox">
                            <label><input name="skill[]" type="checkbox" value="<?php echo (int) $skill->id_skill ?>"><?php esc_attr_e($skill->name) ?></label>
                        </span>
                        <?php
                    endforeach;
                endif;
                ?>
            </p>

        </div>

        <div class="col-md-12">


            <p>
                <?php _e('Language skills', 'wpestate'); ?>

                <?php
                $languages = fl_get_languages();

                if (!empty($languages)):
                    foreach ($languages as $lang):
                        ?>
                        <span class="checkbox">
                            <label><input name="language[]" type="checkbox" value="<?php echo (int) $lang->id_lang ?>"><?php esc_attr_e($lang->name) ?></label>
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