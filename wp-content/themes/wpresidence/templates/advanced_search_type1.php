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




<div class="adv-search-1 <?php echo $close_class . ' ' . $extended_class; ?>" id="adv-search-1" >


    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a class="search-tab" href="#roommate" aria-controls="roommate" role="tab" data-toggle="tab"><?php _e('Roommate listings', 'wpestate'); ?></a>
        </li>
        <li role="presentation">
            <a class="search-tab" href="#rental" aria-controls="rental" role="tab" data-toggle="tab"><?php _e('Rental listings', 'wpestate'); ?></a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="roommate"><!-- search roommate panel -->
            <form role="search" method="get"   action="<?php print $adv_submit; ?>" >
                <div class="adv1-holder triple-switch full-label">

                    <div class="dropdown form-control-half">
                        <p>
                            <label><?php _e('Where would you like to do your flatshare', 'wpestate'); ?></label>
                            <input type="text" id="looking_where" class="form-control w100" value="<?php echo esc_attr($looking_where) ?>"  name="looking_where">
                        </p>
                    </div>

                    <div class="dropdown form-control-half">
                        <div class="switcher">
                            <input type="hidden" value="<?php echo isset($_POST['user_gender']) ? (int) $_POST['user_gender'] : '' ?>" name="user_gender" id="user_gender">
                            <label><?php _e('Gender', 'wpestate'); ?></label>
                            <button data-value="" data-target="#user_gender" class="wpb_button wpb_btn-large <?php echo empty($_POST['user_gender']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></button>
                            <button data-value="1" data-target="#user_gender" class="wpb_button wpb_btn-large <?php echo isset($_POST['user_gender']) && 1 == $_POST['user_gender'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Straight', 'wpestate'); ?></button>
                            <button data-value="2" data-target="#user_gender" class="wpb_button wpb_btn-large <?php echo isset($_POST['user_gender']) && 2 == $_POST['user_gender'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Bi / Gay', 'wpestate'); ?></button>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <!-- sliders -->

                    <div class="adv_search_slider"><!-- age slider -->
                        <script>
                            jQuery(document).ready(function ($) {
                                jQuery("#slider_age").slider({
                                    range: true,
                                    min: parseInt($('#age_low').val()),
                                    max: parseInt($('#age_max').val()),
                                    values: [$('#age_low').val(), $('#age_max').val()], // defaultni hodnoty
                                    slide: function (event, ui) {
                                        jQuery('#age_low').val(ui.values[0]);
                                        jQuery('#age_max').val(ui.values[1]);
                                        jQuery("#age_label_text").text(ui.values[0].format() + " " + control_vars.to + " " + ui.values[1].format());
                                    }
                                });
                            });
                        </script>
                        <?php
                        $age_min = 0;
                        $age_max = 99;
                        ?>
                        <p>
                            <label for="age" class="wauto"><?php _e('Age range:', 'wpestate'); ?></label>
                            <span id="age_label_text"><?php printf(__('%s to %s', 'dokan'), (int) $age_min, (int) $age_max); ?></span>
                        </p>
                        <div id="slider_age" class="fl-slider"></div>
                        <input type="hidden" id="age_low"  name="age_low"  value="<?php echo (int) $age_min; ?>" />
                        <input type="hidden" id="age_max"  name="age_max"  value="<?php echo (int) $age_max; ?>" />
                    </div><!-- /age slider -->


                    <div class="adv_search_slider"><!-- price slider -->
                        <?php
                        $roommate_price_low = 0;
                        $roommate_price_max = 1200000;
                        ?>                        
                        <p>
                            <label for="roommate_amount" class="wauto"><?php _e('Price range:', 'wpestate'); ?></label>
                            <span id="roommate_amount" class="slide-label">$ 0 to $ 1.500.000</span>
                        </p>
                        <div id="slider_roommate_price" class="fl-slider"></div>
                        <input type="hidden" value="<?php echo (int) $roommate_price_low ?>" name="roommate_price_low" id="roommate_price_low">
                        <input type="hidden" value="<?php echo (int) $roommate_price_max ?>" name="roommate_price_max" id="roommate_price_max">
                    </div><!-- /price slider -->


                    <!-- /sliders -->
                    <div class="clearfix"></div>

                    <div class="dropdown form-control-half">
                        <div class="switcher">
                            <input type="hidden" value="<?php echo isset($_POST['sexual_preference']) ? (int) $_POST['sexual_preference'] : '' ?>" name="sexual_preference" id="sexual_preference">
                            <label><?php _e('Sexual preferences', 'wpestate'); ?></label>
                            <button data-value="" data-target="#sexual_preference" class="wpb_button wpb_btn-large <?php echo empty($_POST['sexual_preference']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></button>
                            <button data-value="1" data-target="#sexual_preference" class="wpb_button wpb_btn-large <?php echo isset($_POST['sexual_preference']) && 1 == $_POST['sexual_preference'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Straight', 'wpestate'); ?></button>
                            <button data-value="2" data-target="#sexual_preference" class="wpb_button wpb_btn-large <?php echo isset($_POST['sexual_preference']) && 2 == $_POST['sexual_preference'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Bi / Gay', 'wpestate'); ?></button>
                        </div>
                    </div>

                    <div class="dropdown form-control-half">
                        <div class="switcher">
                            <input type="hidden" value="<?php echo isset($_POST['sleeping_span']) ? (int) $_POST['sleeping_span'] : '' ?>" name="sleeping_span" id="sleeping_span">
                            <label><?php _e('Sleep during week', 'wpestate'); ?></label>
                            <button data-value="" data-target="#sleeping_span" class="wpb_button wpb_btn-large <?php echo empty($_POST['sleeping_span']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></button>
                            <button data-value="1" data-target="#sleeping_span" class="wpb_button wpb_btn-large <?php echo isset($_POST['sleeping_span']) && 1 == $_POST['sleeping_span'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Straight', 'wpestate'); ?></button>
                            <button data-value="2" data-target="#sleeping_span" class="wpb_button wpb_btn-large <?php echo isset($_POST['sleeping_span']) && 2 == $_POST['sleeping_span'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Bi / Gay', 'wpestate'); ?></button>
                        </div>
                    </div>

                    <div class="dropdown form-control-half">
                        <div class="switcher">
                            <input type="hidden" value="<?php echo isset($_POST['couple']) ? (int) $_POST['couple'] : '' ?>" name="couple" id="couple">
                            <label><?php _e('Couple', 'wpestate'); ?></label>
                            <button data-value="" data-target="#couple" class="wpb_button wpb_btn-large <?php echo empty($_POST['couple']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></button>
                            <button data-value="1" data-target="#couple" class="wpb_button wpb_btn-large <?php echo isset($_POST['couple']) && 1 == $_POST['couple'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Straight', 'wpestate'); ?></button>
                            <button data-value="2" data-target="#couple" class="wpb_button wpb_btn-large <?php echo isset($_POST['couple']) && 2 == $_POST['couple'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Bi / Gay', 'wpestate'); ?></button>
                        </div>
                    </div>

                    <div class="dropdown form-control-half">
                        <div class="switcher">
                            <input type="hidden" value="<?php echo isset($_POST['smoker']) ? (int) $_POST['smoker'] : '' ?>" name="smoker" id="smoker">
                            <label><?php _e('Smoker', 'wpestate'); ?></label>
                            <button data-value="" data-target="#smoker" class="wpb_button wpb_btn-large <?php echo empty($_POST['smoker']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></button>
                            <button data-value="1" data-target="#smoker" class="wpb_button wpb_btn-large <?php echo isset($_POST['smoker']) && 1 == $_POST['smoker'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Straight', 'wpestate'); ?></button>
                            <button data-value="2" data-target="#smoker" class="wpb_button wpb_btn-large <?php echo isset($_POST['smoker']) && 2 == $_POST['smoker'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Bi / Gay', 'wpestate'); ?></button>
                        </div>
                    </div>

                    <div class="dropdown form-control-half">
                        <div class="switcher">
                            <input type="hidden" value="<?php echo isset($_POST['pets']) ? (int) $_POST['pets'] : '' ?>" name="pets" id="pets">
                            <label><?php _e('Pets', 'wpestate'); ?></label>
                            <button data-value="" data-target="#pets" class="wpb_button wpb_btn-large <?php echo empty($_POST['pets']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></button>
                            <button data-value="1" data-target="#pets" class="wpb_button wpb_btn-large <?php echo isset($_POST['pets']) && 1 == $_POST['pets'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Straight', 'wpestate'); ?></button>
                            <button data-value="2" data-target="#pets" class="wpb_button wpb_btn-large <?php echo isset($_POST['pets']) && 2 == $_POST['pets'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Bi / Gay', 'wpestate'); ?></button>
                        </div>
                    </div>

                    <div class="dropdown form-control-half">
                        <div class="switcher">
                            <input type="hidden" value="<?php echo isset($_POST['activity']) ? (int) $_POST['activity'] : '' ?>" name="activity" id="activity">
                            <label><?php _e('Activity', 'wpestate'); ?></label>
                            <button data-value="" data-target="#activity" class="wpb_button wpb_btn-large <?php echo empty($_POST['activity']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></button>
                            <button data-value="1" data-target="#activity" class="wpb_button wpb_btn-large <?php echo isset($_POST['activity']) && 1 == $_POST['activity'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Straight', 'wpestate'); ?></button>
                            <button data-value="2" data-target="#activity" class="wpb_button wpb_btn-large <?php echo isset($_POST['activity']) && 2 == $_POST['activity'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Bi / Gay', 'wpestate'); ?></button>
                        </div>
                    </div>

                    <div class="dropdown form-control-quarter">

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

                    <div class="dropdown form-control-quarter no-label">
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

                    <div class="dropdown form-control-half">
                        <div class="switcher">
                            <input type="hidden" value="<?php echo isset($_POST['party']) ? (int) $_POST['party'] : '' ?>" name="party" id="party">
                            <label><?php _e('Party', 'wpestate'); ?></label>
                            <button data-value="" data-target="#party" class="wpb_button wpb_btn-large <?php echo empty($_POST['party']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></button>
                            <button data-value="1" data-target="#party" class="wpb_button wpb_btn-large <?php echo isset($_POST['party']) && 1 == $_POST['party'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Straight', 'wpestate'); ?></button>
                            <button data-value="2" data-target="#party" class="wpb_button wpb_btn-large <?php echo isset($_POST['party']) && 2 == $_POST['party'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Bi / Gay', 'wpestate'); ?></button>
                        </div>
                    </div>

                    <div class="form-control-full">
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

                <input name="submit" type="submit" class="wpb_button  wpb_btn_adv_submit wpb_btn-large btn-action border-radius" id="advanced_submit_2" value="<?php _e('SEARCH', 'wpestate'); ?>">
                <?php if ($adv_search_type != 2) { ?>
                    <div id="results">
                        <?php _e('We found ', 'wpestate'); ?> <span id="results_no">0</span> <?php _e('results.', 'wpestate'); ?>
                        <span id="showinpage"> <?php _e('Do you want to load the results now ?', 'wpestate'); ?> </span>
                    </div>
                <?php } ?>
            </form>
        </div><!-- /search roommate panel -->

        <div role="tabpanel" class="tab-pane" id="rental"><!-- rental search -->
            <form role="search" method="get"   action="<?php print $adv_submit; ?>" >
                <div class="adv1-holder">
                    <?php
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





    <div style="clear:both;"></div>
</div>