<?php

global $user_id;

$statuses                       = fl_user_statuses();
$fl_user_data                   = get_fl_data($user_id);
$how_long                       = !empty($fl_user_data->how_long) ? $fl_user_data->how_long : '';
$sexual_preference              = !empty($fl_user_data->sexual_preference) ? $fl_user_data->sexual_preference : '';
$sleeping_span                  = !empty($fl_user_data->sleeping_span) ? $fl_user_data->sleeping_span : '';
$party                          = !empty($fl_user_data->party) ? $fl_user_data->party : '';
$looking_for                    = !empty($fl_user_data->looking_for) ? $fl_user_data->looking_for : '';
$couple                         = !empty($fl_user_data->couple) ? $fl_user_data->couple : '';
$pets                           = !empty($fl_user_data->pets) ? $fl_user_data->pets : '';
$smoker                         = !empty($fl_user_data->smoker) ? $fl_user_data->smoker : '';
$activity                       = !empty($fl_user_data->activity) ? $fl_user_data->activity : '';
$user_gender                    = !empty($fl_user_data->user_gender) ? $fl_user_data->user_gender : '';
$user_status                    = !empty($fl_user_data->user_status) ? $fl_user_data->user_status : '';
$user_origin                    = !empty($fl_user_data->user_origin) ? $fl_user_data->user_origin : '';
$looking_where                  = !empty($fl_user_data->looking_where) ? $fl_user_data->looking_where : '';
$user_rent                      = !empty($fl_user_data->rent_amount) ? $fl_user_data->rent_amount : 200;

$user_language_ids              = fl_get_user_language_ids($user_id);
$user_skill_ids                 = fl_get_user_house_skill_ids($user_id);



$when_move = '';

//if (!empty($fl_user_data->disponibility)) {
$when_move = !empty($fl_user_data->disponibility) ? DATETIME::createFromFormat("Y-m-d", $fl_user_data->disponibility) : new DateTime();
//}


if (!empty($fl_user_data->birthdate)) {
    $birthdate = !empty($fl_user_data->birthdate) ? DATETIME::createFromFormat("Y-m-d", $fl_user_data->birthdate) : new DateTime();
}


$image_id = get_the_author_meta('small_custom_picture', $user_id);

$user_custom_picture = get_the_author_meta('custom_picture', $user_id);
$user_small_picture = get_the_author_meta('small_custom_picture', $user_id);

if ($user_custom_picture == '') {
    $user_custom_picture = get_template_directory_uri() . '/img/default_user.png';
}
?>


<script>
    jQuery(document).ready(function ($) {
        jQuery("#when_move").datepicker({
            dateFormat: "<?php echo DATEPICKER_FORMAT ?>",
            defaultDate: new Date(),
        }, jQuery.datepicker.regional[admin_control_vars.datepick_lang]).datepicker('widget').wrap('<div class="ll-skin-melon"/>');

        jQuery("#birthdate").datepicker({
            changeYear: true,
            dateFormat: "<?php echo DATEPICKER_FORMAT ?>",
        }, jQuery.datepicker.regional[admin_control_vars.datepick_lang]).datepicker('widget').wrap('<div class="ll-skin-melon"/>');
    });
</script>

<h3><?php _e('Personal Information', 'wpestate') ?></h3>
<table class="form-table">

    
    <tr>
        <th>
            <?php _e('Profile image', 'wpestate') ?>
        </th>
        <td>
            <div class="profile_div col-md-4" id="profile-div">
                <?php
                print '<img id="profile-image" src="' . $user_custom_picture . '" alt="user image" data-profileurl="' . $user_custom_picture . '" data-smallprofileurl="' . $image_id . '" >';

                //print '/ '.$user_small_picture;
                ?>
                
                <input id="profile-imagefileurl" name="custom_picture" type="hidden" value="<?php echo esc_url($user_custom_picture) ?>">
                <input id="profile-smallprofileurl" name="small_custom_picture" type="hidden" value="<?php echo (int) $image_id ?>">

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
        </td>
    </tr>
    
    
    <tr>
        <th>
            <?php _e('Status', 'wpestate') ?>
        </th>
        <td>
            <select id="user_status" name="user_status" class="w100">
                <?php foreach ($statuses as $key => $val): ?>
                    <option value="<?php echo $key ?>" <?php echo $user_status == $key ? ' selected="selected" ' : '' ?>><?php echo $val ?></option>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>

    <tr>
        <th>
            <?php _e('For how long', 'wpestate') ?>
        </th>
        <td>
            <div class="value-row">
                <label>
                    <input id="how_long-1" name="how_long" type="radio" value="1"  <?php echo isset($how_long) && 1 == $how_long ? ' checked="checked" ' : '' ?>>
                    <?php _e('Short term', 'wpestate'); ?>
                </label>
                <label>
                    <input id="how_long-2" name="how_long" type="radio" value="2"  <?php echo isset($how_long) && 2 == $how_long ? ' checked="checked" ' : '' ?>>
                    <?php _e('Long term', 'wpestate'); ?>
                </label>
            </div>
        </td>
    </tr>

    <tr>
        <th>
            <?php _e('Looking for', 'wpestate'); ?>
        </th>
        <td>
            <div class="value-row">
                <label>
                    <input id="looking_for-1" name="looking_for" type="radio" value="1" <?php echo isset($looking_for) && 1 == $looking_for ? ' checked="checked" ' : '' ?>>
                    <?php _e('Room', 'wpestate'); ?>
                </label>
                <label>
                    <input id="looking_for-2" name="looking_for" type="radio" value="2" <?php echo isset($looking_for) && 2 == $looking_for ? ' checked="checked" ' : '' ?>>
                    <?php _e('Flat', 'wpestate'); ?>
                </label>
            </div>
        </td>
    </tr>

    <tr>
        <th>
            <?php _e('Sexual preferences', 'wpestate'); ?>
        </th>
        <td>
            <div class="value-row">
                <label>
                    <input id="sexual_preference-1" name="sexual_preference" type="radio" value="1" <?php echo empty($sexual_preference) || 1 == $sexual_preference ? ' checked="checked" ' : '' ?>>
                    <?php _e('Straight', 'wpestate'); ?>
                </label>
                <label>
                    <input id="sexual_preference-2" name="sexual_preference" type="radio" value="2" <?php echo isset($sexual_preference) && 2 == $sexual_preference ? ' checked="checked" ' : '' ?>>
                    <?php _e('Bi / Gay', 'wpestate'); ?>
                </label>
            </div>
        </td>
    </tr>

    <tr>
        <th>
            <?php _e('Gender', 'wpestate'); ?>
        </th>
        <td>
            <div class="value-row">
                <label>
                    <input id="user_gender-1" name="user_gender" type="radio" value="1"  <?php echo isset($user_gender) && 1 == $user_gender ? ' checked="checked" ' : '' ?>>
                    <?php _e('Female', 'wpestate'); ?>
                </label>
                <label>
                    <input id="user_gender-2" name="user_gender" type="radio" value="2"  <?php echo empty($user_gender) || 2 == $user_gender ? ' checked="checked" ' : '' ?>>
                    <?php _e('Male', 'wpestate'); ?>
                </label>
            </div>
        </td>
    </tr>

    <tr>
        <th>
            <?php _e('Sleep during week', 'wpestate'); ?>
        </th>
        <td>
            <div class="value-row">
                <label>
                    <input id="sleeping_span-1" name="sleeping_span" type="radio" value="1"  <?php echo empty($sleeping_span) || 1 == $sleeping_span ? ' checked="checked" ' : '' ?>>
                    <?php _e('Before 11PM', 'wpestate'); ?>
                </label>
                <label>
                    <input id="sleeping_span-2" name="sleeping_span" type="radio" value="2"  <?php echo isset($sleeping_span) && 2 == $sleeping_span ? ' checked="checked" ' : '' ?>>
                    <?php _e('After 11PM', 'wpestate'); ?>
                </label>
            </div>
        </td>
    </tr>

    <tr>
        <th>
            <?php _e('Couple', 'wpestate'); ?>
        </th>
        <td>
            <div class="value-row">
                <label>
                    <input id="couple-1" name="couple" type="radio" value="1"  <?php echo empty($couple) || 1 == $couple ? ' checked="checked" ' : '' ?>>
                    <?php _e('Single', 'wpestate'); ?>
                </label>
                <label>
                    <input id="couple-2" name="couple" type="radio" value="2"  <?php echo isset($couple) && 2 == $couple ? ' checked="checked" ' : '' ?>>
                    <?php _e('In couple', 'wpestate'); ?>
                </label>
            </div>
        </td>
    </tr>

    <tr>
        <th>
            <?php _e('Pets', 'wpestate'); ?>
        </th>
        <td>
            <div class="value-row">
                <label>
                    <input id="pets-1" name="pets" type="radio" value="1"  <?php echo empty($pets) || 1 == $pets ? ' checked="checked" ' : '' ?>>
                    <?php _e('No pets', 'wpestate'); ?>
                </label>
                <label>
                    <input id="pets-2" name="pets" type="radio" value="2"  <?php echo isset($pets) && 2 == $pets ? ' checked="checked" ' : '' ?>>
                    <?php _e('Pets', 'wpestate'); ?>
                </label>
            </div>
        </td>
    </tr>

    <tr>
        <th>
            <?php _e('Smoker', 'wpestate'); ?>
        </th>
        <td>
            <div class="value-row">
                <label>
                    <input id="smoker-1" name="smoker" type="radio" value="1"  <?php echo empty($smoker) || 1 == $smoker ? ' checked="checked" ' : '' ?>>
                    <?php _e('Non-smoker', 'wpestate'); ?>
                </label>
                <label>
                    <input id="smoker-2" name="smoker" type="radio" value="2"  <?php echo isset($smoker) && 2 == $smoker ? ' checked="checked" ' : '' ?>>
                    <?php _e('Smoker', 'wpestate'); ?>
                </label>
            </div>
        </td>
    </tr>

    <tr>
        <th>
            <?php _e('Party', 'wpestate'); ?>
        </th>
        <td>
            <div class="value-row">
                <label>
                    <input id="party-1" name="party" type="radio" value="1"  <?php echo empty($party) || 1 == $party ? ' checked="checked" ' : '' ?>>
                    <?php _e('Often', 'wpestate'); ?>
                </label>
                <label>
                    <input id="party-2" name="party" type="radio" value="2"  <?php echo isset($party) && 2 == $party ? ' checked="checked" ' : '' ?>>
                    <?php _e('Not often', 'wpestate'); ?>
                </label>
            </div>
        </td>
    </tr>

    <tr>
        <th>
            <?php _e('Where would you like to do your flatshare', 'wpestate'); ?>
        </th>
        <td>
            <div class="value-row">
                <input  data-value="all" type="text" id="looking_where" class="form-control" value="<?php echo esc_attr($looking_where) ?>"  name="looking_where">
            </div>

            <script>
                function loadScript(src, callback) {
                    var script = document.createElement("script");
                    script.type = "text/javascript";
                    if (callback)
                        script.onload = callback;
                    document.getElementsByTagName("head")[0].appendChild(script);
                    script.src = src;
                }

                loadScript('http://maps.googleapis.com/maps/api/js?v=3&sensor=false&libraries=places&language=en&callback=initialize');

                function initialize() {
                    var options = {
                        types: ['(cities)']
                        //componentRestrictions: {country: "cz"}
                    };
                    var input = document.getElementById('looking_where');
                    var autocomplete = new google.maps.places.Autocomplete(input, options);
                    autocomplete.addListener('place_changed', function () {
                    var place = autocomplete.getPlace();
                    var city = place.address_components[0].long_name;
                    document.getElementById("looking_where").value = city;

                    });
                }
                //ONLY CITY - RESTRICT TO THE LANGUAGE
            </script>
        </td>
    </tr>

    <tr>
        <th>
            <?php _e('How much do you want to pay?:', 'wpestate'); ?>
        </th>
        <td>
            <div class="fl-row adv_search_slider">

                <script>

                    jQuery(document).ready(function ($) {
                        jQuery("#slider_rent").slider({
                            //range: true,
                            "value": <?php echo (int) $user_rent ?>,
                            min: parseInt(0),
                            max: parseInt(<?php echo MAX_RENT ?>),
                            //values: [$('#age_low').val(), $('#age_max').val()], // defaultni hodnoty
                            slide: function (event, ui) {
                                //console.log(ui);
                                //jQuery('#rent_label_text').val(ui.values[0]);
                                jQuery('#rent_amount').val(ui.value);
                                jQuery("#rent_label_text").text(ui.value);
                            }
                        });
                    });
                </script>

                <?php
                $currency = esc_html(get_option('wp_estate_currency_symbol', ''));
                ?>
                <p>
                    <span id="rent_label_text" class="slide-label"><?php printf(__('%s', 'dokan'), (int) $user_rent); ?></span> <?php echo esc_html($currency) ?>
                </p>

                <div id="slider_rent" class="fl-slider"></div>
                <input type="hidden" id="rent_amount"  name="rent_amount"  value="<?php echo (int) $user_rent; ?>">
            </div>
        </td>
    </tr>

    <tr>
        <th>
            <?php _e('Disponibility', 'wpestate'); ?>
        </th>
        <td>
            <div class="value-row">
                <input type="text" id="when_move" class="form-control" value="<?php echo empty($when_move) ? '' : $when_move->format(PHP_DATEPICKER_FORMAT); ?>"  name="when_move">
            </div>
        </td>
    </tr>
    

    <tr>
        <th>
            <?php _e('Country of origin', 'wpestate'); ?>
        </th>
        <td>            
            <?php
            $coutnries = fl_get_countries();
            ?>            
            <div class="value-row">
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
            </div>            
        </td>
    </tr>                
                
    <tr>
        <th>
            <?php _e('Birthdate', 'wpestate'); ?>
        </th>
        <td>
            <div class="value-row">
                <input type="text" id="birthdate" class="form-control" value="<?php echo empty($birthdate) ? '' : $birthdate->format(PHP_DATEPICKER_FORMAT); ?>"  name="birthdate">
            </div>
        </td>
    </tr>


    <tr>
        <th>
            <?php _e('Activity', 'wpestate'); ?>
        </th>
        <td>
            <div class="value-row">
                <label>
                    <input id="activity-1" name="activity" type="radio" value="1"  <?php echo empty($activity) || 1 == $activity ? ' checked="checked" ' : '' ?>>
                    <?php _e('Student', 'wpestate'); ?>
                </label>
                <label>
                    <input id="activity-2" name="activity" type="radio" value="2"  <?php echo isset($activity) && 2 == $activity ? ' checked="checked" ' : '' ?>>
                    <?php _e('Professional', 'wpestate'); ?>
                </label>
            </div>
        </td>
    </tr>

    <tr>
        <th>
            <?php _e('House skills', 'wpestate'); ?>
        </th>
        <td>
            <div class="value-row">
                <p class="inline-checkboxes">
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
                <div class="clearfix"></div>
            </div>
        </td>
    </tr>


    <tr>
        <th>
            <?php _e('Language skills', 'wpestate'); ?>
        </th>
        <td>
            <div class="value-row">
                <p class="inline-checkboxes">

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
        </td>
    </tr>

</table>