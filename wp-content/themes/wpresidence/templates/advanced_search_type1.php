<?php
global $post;
global $adv_search_type;
$adv_search_what = get_option('wp_estate_adv_search_what', '');
$show_adv_search_visible = get_option('wp_estate_show_adv_search_visible', '');
$close_class = '';

if ($show_adv_search_visible == 'no') {
    $close_class = 'adv-search-1-close';
}

$extended_search = get_option('wp_estate_show_adv_search_extended', '');
$extended_class = '';

if ($adv_search_type == 2) {
    $extended_class = 'adv_extended_class2';
}

if ($extended_search == 'yes') {
    $extended_class = 'adv_extended_class';
    if ($show_adv_search_visible == 'no') {
        $close_class = 'adv-search-1-close-extended';
    }
}
?>




<div class="adv-search-1 <?php echo $close_class . ' ' . $extended_class; ?>" id="adv-search-1" <?php echo isset($_GET['ra']) && 1 == $_GET['ra'] ? 'style="height: auto;"' : '' ?>>


    <?php
    global $wpdb;
    $sql = "
                            SELECT DISTINCT
                                looking_where
                            FROM
                                fl_user_data AS ud
                            JOIN
                                " . $wpdb->prefix . "users AS u
                            ON
                                u.ID = ud.id_user
                            WHERE
                                ud.user_status IN (1, 2)
                            AND
                                looking_where != ''";

    $where = $wpdb->get_col($sql);
    /*
      foreach ($where as $w) {
      $availableTags[] = $w;
      } */
    array_walk($where, 'esc_attr');
    ?>

    <script type="text/javascript">
        //<![CDATA[
        jQuery(document).ready(function ($) {
            var availableTags = ['<?php echo implode("','", $where) ?>'];
            jQuery("#looking_where").autocomplete({
                source: availableTags
            });

            jQuery("#disponibility").datepicker({
                dateFormat: "<?php echo DATEPICKER_FORMAT ?>",
            }, jQuery.datepicker.regional[control_vars.datepick_lang]).datepicker('widget').wrap('<div class="ll-skin-melon"/>');

            $('#what-lookup a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var tab = $(e.target).attr('aria-controls');

                switch(tab){
                    case 'roommate':
                        $('#video-wrap').show();
                        $('#gmap_wrapper').hide();
                        break;
                    case 'rental':
                        $('#video-wrap').hide();
                        $('#gmap_wrapper').show();
                        break;

                }

            })

        });
        //]]>
    </script>

    <!-- Nav tabs -->
    <ul id="what-lookup" class="nav nav-tabs" role="tablist">
        <li role="presentation" class="<?php echo!isset($_GET['tab']) || 1 == $_GET['tab'] ? 'active' : '' ?>">
            <a class="search-tab" href="#roommate" aria-controls="roommate" role="tab" data-toggle="tab"><?php _e('Roommate listings', 'wpestate'); ?></a>
        </li>
        <li role="presentation" class="<?php echo isset($_GET['tab']) && 2 == $_GET['tab'] ? 'active' : '' ?>">
            <a class="search-tab" href="#rental" aria-controls="rental" role="tab" data-toggle="tab"><?php _e('Rental listings', 'wpestate'); ?></a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane <?php echo!isset($_GET['tab']) || 1 == $_GET['tab'] ? 'active' : '' ?>" id="roommate"><!-- search roommate panel -->
            <form role="search" method="get"   action="<?php echo get_page_link(17745) ?>" >
                <input type="hidden" name="tab" value="1">

                <div class="adv1-holder triple-switch" <?php echo isset($_GET['ra']) && 1 == $_GET['ra'] ? 'style="height: auto;"' : '' ?>>

                    <div class="form-control-two">
                        <label><?php _e('Where would you like to do your flatshare', 'wpestate'); ?></label>
                        <div class="value-row">
                            <input type="text" id="looking_where" name="looking_where" class="form-control w100" placeholder="<?php _e('City', 'wpestate') ?>"  value="<?php echo esc_attr(isset($_GET['looking_where']) ? esc_attr($_GET['looking_where']) : '') ?>">
                        </div>
                    </div>

                    <div class="form-control-one">

                        <label><?php _e('Disponibility from', 'wpestate'); ?></label>
                        <div class="value-row">
                            <input type="text" id="disponibility" name="disponibility" class="form-control w100" value="<?php echo esc_attr(isset($_GET['disponibility']) ? esc_attr($_GET['disponibility']) : '') ?>">
                        </div>
                    </div>

                    <div class="form-control-half">
                        <div class="switcher">

                            <label><?php _e('Gender', 'wpestate'); ?></label>
                            <div class="value-row">

                                <input id="user-gender-nevermind" name="user_gender" type="radio" value="" class="hidden">
                                <input id="user-gender-male" name="user_gender" type="radio" value="1" class="hidden" >
                                <input id="user-gender-female" name="user_gender" type="radio" value="2" class="hidden">

                                <label for="user-gender-nevermind" class="wpb_button wpb_btn-large <?php echo empty($_GET['user_gender']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></label>
                                <label for="user-gender-male" class="wpb_button wpb_btn-large <?php echo isset($_GET['user_gender']) && 1 == $_GET['user_gender'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Male', 'wpestate'); ?></label>
                                <label for="user-gender-female" class="wpb_button wpb_btn-large <?php echo isset($_GET['user_gender']) && 2 == $_GET['user_gender'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Female', 'wpestate'); ?></label>

                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <!-- sliders -->

                    <div class="adv_search_slider"><!-- age slider -->

                        <?php
                        $age_min = 0;
                        $age_max = 99;

                        $age_min_val = isset($_GET['age_low']) ? $_GET['age_low'] : $age_min;
                        $age_max_val = isset($_GET['age_max']) ? $_GET['age_max'] : $age_max;
                        ?>

                        <script>
                            jQuery(document).ready(function ($) {
                                jQuery("#slider_age").slider({
                                    range: true,
                                    min: <?php echo (int) $age_min ?>,
                                    max: <?php echo (int) $age_max ?>,
                                    values: [<?php echo (int) $age_min_val ?>, <?php echo (int) $age_max_val ?>], // defaultni hodnoty
                                    slide: function (event, ui) {
                                        jQuery('#age_low').val(ui.values[0]);
                                        jQuery('#age_max').val(ui.values[1]);
                                        jQuery("#age_label_text").text(ui.values[0].format() + " " + control_vars.to + " " + ui.values[1].format());
                                    }
                                });
                            });
                        </script>

                        <p>
                            <label for="age" class="wauto"><?php _e('Age range:', 'wpestate'); ?></label>
                            <span id="age_label_text"><?php printf(__('%s to %s', 'wpestate'), (int) $age_min_val, (int) $age_max_val); ?></span>
                        </p>
                        <div id="slider_age" class="fl-slider"></div>
                        <input type="hidden" id="age_low"  name="age_low"  value="<?php echo (int) $age_min_val; ?>" />
                        <input type="hidden" id="age_max"  name="age_max"  value="<?php echo (int) $age_max_val; ?>" />
                    </div><!-- /age slider -->


                    <div class="adv_search_slider"><!-- price slider -->
                        <?php
                        $roommate_price_low = $current_price_low = 0;
                        $roommate_price_max = $current_price_max = 1200;

                        $where_currency = esc_html(get_option('wp_estate_where_currency_symbol', ''));
                        $currency = esc_html(get_option('wp_estate_currency_symbol', ''));



                        //$min_price_slider= ( floatval(get_option('wp_estate_show_slider_min_price','')) );
                        //$max_price_slider= ( floatval(get_option('wp_estate_show_slider_max_price','')) );

                        if (isset($_GET['rent_low'])) {
                            $current_price_low = floatval($_GET['rent_low']);
                        }

                        if (isset($_GET['rent_max'])) {
                            $current_price_max = floatval($_GET['rent_max']);
                        }

                        $price_slider_label = wpestate_show_price_label_slider($current_price_low, $current_price_max, $currency, $where_currency);
                        ?>
                        <p>
                            <label for="roommate_amount" class="wauto"><?php _e('Price range:', 'wpestate'); ?></label>
                            <span id="roommate_amount" class="slide-label"><?php echo $price_slider_label ?></span>
                        </p>
                        <div id="slider_roommate_price" data-bound_min="<?php echo (int) $roommate_price_min ?>" data-bound_max="<?php echo (int) $roommate_price_max ?>" class="fl-slider"></div>
                        <input type="hidden" value="<?php echo (int) $current_price_low ?>" name="rent_low" id="roommate_price_low">
                        <input type="hidden" value="<?php echo (int) $current_price_max ?>" name="rent_max" id="roommate_price_max">
                    </div><!-- /price slider -->


                    <!-- /sliders -->
                    <div class="clearfix"></div>

                    <div id="roommate-advance" class="form-control-full tpadding adv_extended_options_text" <?php echo isset($_GET['ra']) && 1 == $_GET['ra'] ? 'style="display: none;"' : '' ?>>
                        <?php _e('More search options', 'wpestate'); ?>
                    </div>


                    <div id="more-search-options" class="extended_search_check_wrapper" <?php echo isset($_GET['ra']) && 1 == $_GET['ra'] ? 'style="display: block;"' : '' ?>><!-- advance search block -->

                        <span id="roommate_extended_close_adv" class="adv_extended_close_adv" style="display: <?php echo isset($_GET['ra']) && 1 == $_GET['ra'] ? 'inline' : 'none' ?>;">
                            <i class="fa fa-times"></i>
                        </span>

                        <div class="form-control-half">
                            <?php
                            $arr = array(
                                1 => __('looking for a flat', 'wpestate'),
                                2 => __('looking for a roommate', 'wpestate'),
                                    //3 => __('Real estate', 'wpestate'),
                                    //4 => __('Landlord', 'wpestate'),
                            );
                            ?>
                            <label for="status"><?php _e('Looking for:', 'wpestate'); ?></label>
                            <div class="value-row">

                                <select id="status" class="form-control w100" name="status" class="w100">

                                    <option value=""><?php _e('Flat / Roommate', 'wpestate'); ?></option>

                                    <?php foreach ($arr as $key => $val): ?>
                                        <option value="<?php echo $key ?>" <?php echo isset($_GET['status']) && $_GET['status'] == $key ? ' selected="selected" ' : '' ?>><?php echo $val ?></option>
                                    <?php endforeach; ?>

                                </select>

                            </div>
                        </div>

                        <div class="form-control-half switcher">
                            <label><?php _e('For how long', 'wpestate'); ?></label>
                            <div class="value-row">
                                <input id="how_long-0" name="how_long" type="radio" value="" class="hidden">
                                <input id="how_long-1" name="how_long" type="radio" value="1" class="hidden" >
                                <input id="how_long-2" name="how_long" type="radio" value="2" class="hidden">

                                <label for="how_long-0" class="wpb_button wpb_btn-large <?php echo empty($_GET['how_long']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></label>
                                <label for="how_long-1" class="wpb_button wpb_btn-large <?php echo isset($_GET['how_long']) && 1 == $_GET['how_long'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Less than 6 months', 'wpestate'); ?></label>
                                <label for="how_long-2" class="wpb_button wpb_btn-large <?php echo isset($_GET['how_long']) && 2 == $_GET['how_long'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('+ 6 months'); ?></label>
                            </div>
                        </div>


                        <div class="form-control-half">
                            <div class="switcher">
                                <label><?php _e('Sexual preferences', 'wpestate'); ?></label>

                                <div class="value-row">
                                    <input id="sexual_preference-nevermind" name="sexual_preference" type="radio" value="" class="hidden">
                                    <input id="sexual_preference-straight" name="sexual_preference" type="radio" value="1" class="hidden" >
                                    <input id="sexual_preference-bi" name="sexual_preference" type="radio" value="2" class="hidden">

                                    <label for="sexual_preference-nevermind" class="wpb_button wpb_btn-large <?php echo empty($_GET['sexual_preference']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></label>
                                    <label for="sexual_preference-straight" class="wpb_button wpb_btn-large <?php echo isset($_GET['sexual_preference']) && 1 == $_GET['sexual_preference'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Straight', 'wpestate'); ?></label>
                                    <label for="sexual_preference-bi" class="wpb_button wpb_btn-large <?php echo isset($_GET['sexual_preference']) && 2 == $_GET['sexual_preference'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Bi / Gay', 'wpestate'); ?></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-control-half">
                            <div class="switcher">
                                <label><?php _e('Sleep during week', 'wpestate'); ?></label>

                                <div class="value-row">

                                    <input id="sleeping_span-nevermind" name="sleeping_span" type="radio" value="" class="hidden">
                                    <input id="sleeping_span-before" name="sleeping_span" type="radio" value="1" class="hidden" >
                                    <input id="sleeping_span-after" name="sleeping_span" type="radio" value="2" class="hidden">

                                    <label for="sleeping_span-nevermind" class="wpb_button wpb_btn-large <?php echo empty($_GET['sleeping_span']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></label>
                                    <label for="sleeping_span-before" class="wpb_button wpb_btn-large <?php echo isset($_GET['sleeping_span']) && 1 == $_GET['sleeping_span'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Before 11PM', 'wpestate'); ?></label>
                                    <label for="sleeping_span-after" class="wpb_button wpb_btn-large <?php echo isset($_GET['sleeping_span']) && 2 == $_GET['sleeping_span'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('After 11PM', 'wpestate'); ?></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-control-half">
                            <div class="switcher">
                                <label><?php _e('Couple', 'wpestate'); ?></label>
                                <div class="value-row">

                                    <input id="couple-nevermind" name="couple" type="radio" value="" class="hidden">
                                    <input id="couple-alone" name="couple" type="radio" value="1" class="hidden" >
                                    <input id="couple-in" name="couple" type="radio" value="2" class="hidden">

                                    <label for="couple-nevermind" class="wpb_button wpb_btn-large <?php echo empty($_GET['couple']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></label>
                                    <label for="couple-alone" class="wpb_button wpb_btn-large <?php echo isset($_GET['couple']) && 1 == $_GET['couple'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Alone', 'wpestate'); ?></label>
                                    <label for="couple-in" class="wpb_button wpb_btn-large <?php echo isset($_GET['couple']) && 2 == $_GET['couple'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('In couple', 'wpestate'); ?></label>
                                </div>

                            </div>
                        </div>

                        <div class="form-control-half">
                            <div class="switcher">
                                <label><?php _e('Smoker', 'wpestate'); ?></label>
                                <div class="value-row">

                                    <input id="smoker-nevermind" name="smoker" type="radio" value="" class="hidden">
                                    <input id="smoker-no" name="smoker" type="radio" value="1" class="hidden" >
                                    <input id="smoker-yes" name="smoker" type="radio" value="2" class="hidden">

                                    <label for="smoker-nevermind" class="wpb_button wpb_btn-large <?php echo empty($_GET['smoker']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></label>
                                    <label for="smoker-no" class="wpb_button wpb_btn-large <?php echo isset($_GET['smoker']) && 1 == $_GET['smoker'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Non-smoker', 'wpestate'); ?></label>
                                    <label for="smoker-yes" class="wpb_button wpb_btn-large <?php echo isset($_GET['smoker']) && 2 == $_GET['smoker'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Smoker', 'wpestate'); ?></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-control-half">
                            <div class="switcher">
                                <label><?php _e('Pets', 'wpestate'); ?></label>
                                <div class="value-row">
                                    <input id="pets-nevermind" name="pets" type="radio" value="" class="hidden">
                                    <input id="pets-no" name="pets" type="radio" value="1" class="hidden" >
                                    <input id="pets-yes" name="pets" type="radio" value="2" class="hidden">
                                    <label for="pets-nevermind" class="wpb_button wpb_btn-large <?php echo empty($_GET['pets']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></label>
                                    <label for="pets-no" class="wpb_button wpb_btn-large <?php echo isset($_GET['pets']) && 1 == $_GET['pets'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('No pets', 'wpestate'); ?></label>
                                    <label for="pets-yes" class="wpb_button wpb_btn-large <?php echo isset($_GET['pets']) && 2 == $_GET['pets'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Pets', 'wpestate'); ?></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-control-half">
                            <div class="switcher">
                                <label><?php _e('Activity', 'wpestate'); ?></label>
                                <div class="value-row">
                                    <input id="activity-nevermind" name="activity" type="radio" value="" class="hidden">
                                    <input id="activity-student" name="activity" type="radio" value="1" class="hidden" >
                                    <input id="activity-professional" name="activity" type="radio" value="2" class="hidden">
                                    <label for="activity-nevermind" class="wpb_button wpb_btn-large <?php echo empty($_GET['activity']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></label>
                                    <label for="activity-student" class="wpb_button wpb_btn-large <?php echo isset($_GET['activity']) && 1 == $_GET['activity'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Student', 'wpestate'); ?></label>
                                    <label for="activity-professional" class="wpb_button wpb_btn-large <?php echo isset($_GET['activity']) && 2 == $_GET['activity'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Professional', 'wpestate'); ?></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-control-quarter">
                            <label><?php _e('House skills', 'wpestate'); ?></label>
                            <p class="inline-checkboxes">
                                <?php
                                $skills = fl_get_house_skills();
                                if (!empty($skills)):
                                    foreach ($skills as $skill):

                                        $selected = '';
                                        if (isset($_GET['skill']) && is_array($_GET['skill'])) {
                                            $selected = in_array($skill->id_skill, $_GET['skill']) ? ' checked ' : '';
                                        }
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

                        <div class="form-control-quarter no-label">
                            <?php
                            $coutnries = fl_get_countries();
                            ?>
                            <p>
                                <select id="user_origin" name="user_origin" class="form-control">
                                    <option value=""><?php _e('Country of origin', 'wpestate'); ?></option>
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
                        </div>

                        <div class="form-control-half">
                            <div class="switcher">
                                <!--<input type="hidden" value="<?php echo isset($_GET['party']) ? (int) $_GET['party'] : '' ?>" name="party" id="party">-->
                                <label><?php _e('Party', 'wpestate'); ?></label>

                                <div class="value-row">
                                    <input id="party-nevermind" name="party" type="radio" value="" class="hidden">
                                    <input id="party-often" name="party" type="radio" value="1" class="hidden" >
                                    <input id="party-not-often" name="party" type="radio" value="2" class="hidden">
                                    <label for="party-nevermind" class="wpb_button wpb_btn-large <?php echo empty($_GET['party']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></label>
                                    <label for="party-often" class="wpb_button wpb_btn-large <?php echo isset($_GET['party']) && 1 == $_GET['party'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Often', 'wpestate'); ?></label>
                                    <label for="party-not-often" class="wpb_button wpb_btn-large <?php echo isset($_GET['party']) && 2 == $_GET['party'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Not often', 'wpestate'); ?></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-control-full clearfix">
                            <label><?php _e('Language skills', 'wpestate'); ?></label>
                            <p class="inline-checkboxes">
                                <?php
                                $languages = fl_get_languages();

                                if (!empty($languages)):
                                    foreach ($languages as $lang):

                                        $selected = '';
                                        if (isset($_GET['language']) && is_array($_GET['language'])) {
                                            $selected = in_array($lang->id_lang, $_GET['language']) ? ' checked ' : '';
                                        }
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
                        <input id="ra" name="ra" type="hidden" value="<?php echo isset($_GET['ra']) ? (int) $_GET['ra'] : 0 ?>">
                    </div><!-- /advance search block -->



                    <?php
                    /*
                      $custom_advanced_search = get_option('wp_estate_custom_advanced_search', '');
                      if ($custom_advanced_search == 'yes') {
                      foreach ($adv_search_what as $key => $search_field) {
                      wpestate_show_search_field('mainform', $search_field, $action_select_list, $categ_select_list, $select_city_list, $select_area_list, $key, $select_county_state_list);
                      }
                      } else {
                      $search_form = wpestate_show_search_field_classic_form('main', $action_select_list, $categ_select_list, $select_city_list, $select_area_list);
                      print $search_form;
                      }

                      if ($extended_search == 'yes') {
                      show_extended_search('adv');
                      } */
                    ?>
                </div>



                <input name="submit" type="submit" class="wpb_button  wpb_btn_adv_submit wpb_btn-large btn-action border-radius" id="advanced_submit_2" value="<?php _e('Search', 'wpestate'); ?>">
                <?php if ($adv_search_type != 2) { ?>
                    <div id="results">
                        <?php _e('We found ', 'wpestate'); ?> <span id="results_no">0</span> <?php _e('results.', 'wpestate'); ?>
                        <span id="showinpage"> <?php _e('Do you want to load the results now ?', 'wpestate'); ?> </span>
                    </div>
                <?php } ?>
            </form>


        </div><!-- /search roommate panel -->

        <div role="tabpanel" class="tab-pane <?php echo isset($_GET['tab']) && 2 == $_GET['tab'] ? 'active' : '' ?>" id="rental"><!-- rental search -->
            <form role="search" method="get"   action="<?php print $adv_submit; ?>" >
                <input type="hidden" name="tab" value="2">
                <div class="adv1-holder">

                    <?php
                    $availableTags = '';
                    $args = array('hide_empty=0');
                    $terms = get_terms('property_city', $args);
                    foreach ($terms as $term) {
                        $availableTags.= '"' . esc_attr($term->name) . '",';
                    }
                    ?>

                    <script type="text/javascript">
                        //<![CDATA[
                        jQuery(document).ready(function () {
                            var availableTags = [<?php echo $availableTags ?>];
                            jQuery("#adv_location").autocomplete({
                                source: availableTags
                            });
                        });
                        //]]>
                    </script>

                    <?php
                    $custom_advanced_search = get_option('wp_estate_custom_advanced_search', '');
                    if ($custom_advanced_search == 'yes') {
                        foreach ($adv_search_what as $key => $search_field) {
                            wpestate_show_search_field('mainform', $search_field, $action_select_list, $categ_select_list, '', $select_area_list, $key, $select_county_state_list);
                        }
                    } else {
                        $search_form = wpestate_show_search_field_classic_form('main', $action_select_list, $categ_select_list, '', $select_area_list);
                        print $search_form;
                    }

                    if ($extended_search == 'yes') {
                        show_extended_search('adv');
                    }
                    ?>
                </div>

                <input name="submit" type="submit" class="wpb_button  wpb_btn_adv_submit wpb_btn-large border-radius" id="advanced_submit_2" value="<?php _e('Search', 'wpestate'); ?>">
                <?php if ($adv_search_type != 2) { ?>
                    <div id="results">
                        <?php _e('We found ', 'wpestate'); ?> <span id="results_no">0</span> <?php _e('results.', 'wpestate'); ?>
                        <span id="showinpage"> <?php _e('Do you want to load the results now ?', 'wpestate'); ?> </span>
                    </div>
                <?php } ?>
            </form>
        </div><!-- /rental search -->

    </div>

    <!--<div id="adv-search-header-1"> <?php _e('Advanced Search', 'wpestate'); ?></div>-->

</div>