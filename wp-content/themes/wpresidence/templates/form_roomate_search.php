<?php
if (!isset($prefix)) {
    $prefix = '';
}
?>

<form role="search" method="get"   action="<?php echo get_page_link(17745) ?>" >
    <input type="hidden" name="tab" value="1">

    <div class="form-in">

        <div class="adv1-holder triple-switch" <?php /*echo isset($_GET['ra']) && 1 == $_GET['ra'] ? 'style="height: auto;"' : '' */ ?>>

            <div class="form-control-half">

                <div class="form-control-where pull-left clearfix">
                    <div class="form-control-in">
                        <label class="two-label"><?php _e('Where would you like to live', 'wpestate'); ?></label>
                        <div class="value-row clearfix">
                            <input type="text" id="<?php echo $prefix ?>looking_where" name="looking_where" class="form-control w100" placeholder="<?php _e('City', 'wpestate') ?>"  value="<?php echo esc_attr(isset($_GET['looking_where']) ? esc_attr($_GET['looking_where']) : '') ?>">
                        </div>
                    </div>
                </div>

                <div class="form-control-disponibility pull-left clearfix">
                    <div class="form-control-in">
                        <label class="two-label"><?php _e('From', 'wpestate'); ?></label>
                        <div class="value-row clearfix">
                            <input type="text" id="<?php echo $prefix ?>disponibility" name="disponibility" class="form-control w100" value="<?php echo esc_attr(isset($_GET['disponibility']) ? esc_attr($_GET['disponibility']) : '') ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-control-half">
                <div class="form-control-in">
                    <div class="switcher">

                        <label class="two-label"><?php _e('Gender', 'wpestate'); ?></label>
                        <div class="value-row clearfix">

                            <input id="<?php echo $prefix ?>user-gender-nevermind" name="user_gender" type="radio" value="" class="hidden">
                            <input id="<?php echo $prefix ?>user-gender-male" name="user_gender" type="radio" value="1" class="hidden" >
                            <input id="<?php echo $prefix ?>user-gender-female" name="user_gender" type="radio" value="2" class="hidden">

                            <label for="<?php echo $prefix ?>user-gender-nevermind" class="wpb_button wpb_btn-large <?php echo empty($_GET['user_gender']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></label>
                            <label for="<?php echo $prefix ?>user-gender-male" class="wpb_button wpb_btn-large <?php echo isset($_GET['user_gender']) && 1 == $_GET['user_gender'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Male', 'wpestate'); ?></label>
                            <label for="<?php echo $prefix ?>user-gender-female" class="wpb_button wpb_btn-large <?php echo isset($_GET['user_gender']) && 2 == $_GET['user_gender'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Female', 'wpestate'); ?></label>

                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <!-- sliders -->

            <div class="form-control-half">
                <div class="form-control-in">
                    <div class="adv_search_slider"><!-- age slider -->

                        <?php
                        $age_min = 0;
                        $age_max = 99;

                        $age_min_val = isset($_GET['age_low']) ? $_GET['age_low'] : $age_min;
                        $age_max_val = isset($_GET['age_max']) ? $_GET['age_max'] : $age_max;
                        ?>

                        <script>
                            jQuery(document).ready(function ($) {
                                jQuery("#<?php echo $prefix ?>slider_age").slider({
                                    range: true,
                                    min: <?php echo (int) $age_min ?>,
                                    max: <?php echo (int) $age_max ?>,
                                    values: [<?php echo (int) $age_min_val ?>, <?php echo (int) $age_max_val ?>], // defaultni hodnoty
                                    slide: function (event, ui) {
                                        jQuery('#<?php echo $prefix ?>age_low').val(ui.values[0]);
                                        jQuery('#<?php echo $prefix ?>age_max').val(ui.values[1]);
                                        jQuery("#<?php echo $prefix ?>age_label_text").text(ui.values[0].format() + " " + control_vars.to + " " + ui.values[1].format());
                                    }
                                });
                            });
                        </script>

                        <p>
                            <label for="<?php echo $prefix ?>age" class="wauto"><?php _e('Age range:', 'wpestate'); ?></label>
                            <span id="<?php echo $prefix ?>age_label_text"><?php printf(__('%s to %s', 'wpestate'), (int) $age_min_val, (int) $age_max_val); ?></span>
                        </p>
                        <div id="<?php echo $prefix ?>slider_age" class="fl-slider"></div>
                        <input type="hidden" id="<?php echo $prefix ?>age_low"  name="age_low"  value="<?php echo (int) $age_min_val; ?>" />
                        <input type="hidden" id="<?php echo $prefix ?>age_max"  name="age_max"  value="<?php echo (int) $age_max_val; ?>" />
                    </div><!-- /age slider -->
                </div>
            </div>

            <div class="form-control-half">
                <div class="form-control-in">
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

                        $custom_fields = get_option('wp_estate_multi_curr', true);
                        $price_slider_label = wpestate_show_price_label_slider($current_price_low, $current_price_max, $currency, $where_currency);
                        ?>
                        <p>
                            <label for="<?php echo $prefix ?>roommate_amount" class="wauto"><?php _e('Price range:', 'wpestate'); ?></label>
                            <span id="<?php echo $prefix ?>roommate_amount" class="slide-label"><?php echo $price_slider_label ?></span>
                        </p>
                        <div id="<?php echo $prefix ?>slider_roommate_price" data-bound_min="<?php echo (int) $roommate_price_low ?>" data-bound_max="<?php echo (int) $roommate_price_max ?>" class="fl-slider"></div>
                        <input type="hidden" value="<?php echo (int) $current_price_low ?>" name="rent_low" id="<?php echo $prefix ?>roommate_price_low">
                        <input type="hidden" value="<?php echo (int) $current_price_max ?>" name="rent_max" id="<?php echo $prefix ?>roommate_price_max">
                    </div><!-- /price slider -->
                </div>
            </div>

            <!-- /sliders -->
            <div class="clearfix"></div>

            <div id="<?php echo $prefix ?>roommate-advance" class="form-control-full tpadding adv_extended_options_text" <?php echo isset($_GET['ra']) && 1 == $_GET['ra'] ? 'style="display: none;"' : '' ?>>
                <?php _e('More search options', 'wpestate'); ?>
            </div>

            <div id="<?php echo $prefix ?>more-search-options" class="extended_search_check_wrapper" <?php echo isset($_GET['ra']) && 1 == $_GET['ra'] ? 'style="display: block;"' : '' ?>><!-- advance search block -->

                <div class="form-control-half">
                    <div class="form-control-in">
                        <?php
                        $arr = array(
                            1 => __('Posting a property', 'wpestate'),
                            2 => __('Looking for a property', 'wpestate'),
                                //3 => __('Real estate', 'wpestate'),
                                //4 => __('Landlord', 'wpestate'),
                        );
                        ?>
                        <label for="<?php echo $prefix ?>status"><?php _e('Someone :', 'wpestate'); ?></label>
                        <div class="value-row clearfix">
                            <select id="<?php echo $prefix ?>status" class="form-control w100" name="status" class="w100">
                                <option value=""><?php _e('Never mind', 'wpestate'); ?></option>
                                <?php foreach ($arr as $key => $val): ?>
                                    <option value="<?php echo $key ?>" <?php echo isset($_GET['status']) && $_GET['status'] == $key ? ' selected="selected" ' : '' ?>><?php echo $val ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-control-half switcher">
                    <div class="form-control-in">
                        <label><?php _e('For how long', 'wpestate'); ?></label>
                        <div class="value-row clearfix">
                            <input id="<?php echo $prefix ?>how_long-0" name="how_long" type="radio" value="" class="hidden">
                            <input id="<?php echo $prefix ?>how_long-1" name="how_long" type="radio" value="1" class="hidden" >
                            <input id="<?php echo $prefix ?>how_long-2" name="how_long" type="radio" value="2" class="hidden">
                            <label for="<?php echo $prefix ?>how_long-0" class="wpb_button wpb_btn-large <?php echo empty($_GET['how_long']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></label>
                            <label for="<?php echo $prefix ?>how_long-1" class="wpb_button wpb_btn-large <?php echo isset($_GET['how_long']) && 1 == $_GET['how_long'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Short term', 'wpestate'); ?></label>
                            <label for="<?php echo $prefix ?>how_long-2" class="wpb_button wpb_btn-large <?php echo isset($_GET['how_long']) && 2 == $_GET['how_long'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Long term'); ?></label>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-control-half">
                    <div class="form-control-in">
                        <div class="switcher">
                            <label><?php _e('Sexual preferences', 'wpestate'); ?></label>
                            <div class="value-row clearfix">
                                <input id="<?php echo $prefix ?>sexual_preference-nevermind" name="sexual_preference" type="radio" value="" class="hidden">
                                <input id="<?php echo $prefix ?>sexual_preference-straight" name="sexual_preference" type="radio" value="1" class="hidden" >
                                <input id="<?php echo $prefix ?>sexual_preference-bi" name="sexual_preference" type="radio" value="2" class="hidden">
                                <label for="<?php echo $prefix ?>sexual_preference-nevermind" class="wpb_button wpb_btn-large <?php echo empty($_GET['sexual_preference']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></label>
                                <label for="<?php echo $prefix ?>sexual_preference-straight" class="wpb_button wpb_btn-large <?php echo isset($_GET['sexual_preference']) && 1 == $_GET['sexual_preference'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Straight', 'wpestate'); ?></label>
                                <label for="<?php echo $prefix ?>sexual_preference-bi" class="wpb_button wpb_btn-large <?php echo isset($_GET['sexual_preference']) && 2 == $_GET['sexual_preference'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Bi / Gay', 'wpestate'); ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-control-half">
                    <div class="form-control-in">
                        <div class="switcher">
                            <label><?php _e('Sleep during week', 'wpestate'); ?></label>
                            <div class="value-row clearfix">
                                <input id="<?php echo $prefix ?>sleeping_span-nevermind" name="sleeping_span" type="radio" value="" class="hidden">
                                <input id="<?php echo $prefix ?>sleeping_span-before" name="sleeping_span" type="radio" value="1" class="hidden" >
                                <input id="<?php echo $prefix ?>sleeping_span-after" name="sleeping_span" type="radio" value="2" class="hidden">
                                <label for="<?php echo $prefix ?>sleeping_span-nevermind" class="wpb_button wpb_btn-large <?php echo empty($_GET['sleeping_span']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></label>
                                <label for="<?php echo $prefix ?>sleeping_span-before" class="wpb_button wpb_btn-large <?php echo isset($_GET['sleeping_span']) && 1 == $_GET['sleeping_span'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Before 11PM', 'wpestate'); ?></label>
                                <label for="<?php echo $prefix ?>sleeping_span-after" class="wpb_button wpb_btn-large <?php echo isset($_GET['sleeping_span']) && 2 == $_GET['sleeping_span'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('After 11PM', 'wpestate'); ?></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-control-half">
                    <div class="form-control-in">
                        <div class="switcher">
                            <label><?php _e('Couple', 'wpestate'); ?></label>
                            <div class="value-row clearfix">

                                <input id="<?php echo $prefix ?>couple-nevermind" name="couple" type="radio" value="" class="hidden">
                                <input id="<?php echo $prefix ?>couple-alone" name="couple" type="radio" value="1" class="hidden" >
                                <input id="<?php echo $prefix ?>couple-in" name="couple" type="radio" value="2" class="hidden">

                                <label for="<?php echo $prefix ?>couple-nevermind" class="wpb_button wpb_btn-large <?php echo empty($_GET['couple']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></label>
                                <label for="<?php echo $prefix ?>couple-alone" class="wpb_button wpb_btn-large <?php echo isset($_GET['couple']) && 1 == $_GET['couple'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Single', 'wpestate'); ?></label>
                                <label for="<?php echo $prefix ?>couple-in" class="wpb_button wpb_btn-large <?php echo isset($_GET['couple']) && 2 == $_GET['couple'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('In couple', 'wpestate'); ?></label>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="form-control-half">
                    <div class="form-control-in">
                        <div class="switcher">
                            <label><?php _e('Smoker', 'wpestate'); ?></label>
                            <div class="value-row clearfix">

                                <input id="<?php echo $prefix ?>smoker-nevermind" name="smoker" type="radio" value="" class="hidden">
                                <input id="<?php echo $prefix ?>smoker-no" name="smoker" type="radio" value="1" class="hidden" >
                                <input id="<?php echo $prefix ?>smoker-yes" name="smoker" type="radio" value="2" class="hidden">

                                <label for="<?php echo $prefix ?>smoker-nevermind" class="wpb_button wpb_btn-large <?php echo empty($_GET['smoker']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></label>
                                <label for="<?php echo $prefix ?>smoker-no" class="wpb_button wpb_btn-large <?php echo isset($_GET['smoker']) && 1 == $_GET['smoker'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Non-smoker', 'wpestate'); ?></label>
                                <label for="<?php echo $prefix ?>smoker-yes" class="wpb_button wpb_btn-large <?php echo isset($_GET['smoker']) && 2 == $_GET['smoker'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Smoker', 'wpestate'); ?></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-control-half">
                    <div class="form-control-in">
                        <div class="switcher">
                            <label><?php _e('Pets', 'wpestate'); ?></label>
                            <div class="value-row clearfix">
                                <input id="<?php echo $prefix ?>pets-nevermind" name="pets" type="radio" value="" class="hidden">
                                <input id="<?php echo $prefix ?>pets-no" name="pets" type="radio" value="1" class="hidden" >
                                <input id="<?php echo $prefix ?>pets-yes" name="pets" type="radio" value="2" class="hidden">
                                <label for="<?php echo $prefix ?>pets-nevermind" class="wpb_button wpb_btn-large <?php echo empty($_GET['pets']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></label>
                                <label for="<?php echo $prefix ?>pets-no" class="wpb_button wpb_btn-large <?php echo isset($_GET['pets']) && 1 == $_GET['pets'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('No pets', 'wpestate'); ?></label>
                                <label for="<?php echo $prefix ?>pets-yes" class="wpb_button wpb_btn-large <?php echo isset($_GET['pets']) && 2 == $_GET['pets'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Pets', 'wpestate'); ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-control-half">
                    <div class="form-control-in">
                        <div class="switcher">
                            <label><?php _e('Activity', 'wpestate'); ?></label>
                            <div class="value-row clearfix">
                                <input id="<?php echo $prefix ?>activity-nevermind" name="activity" type="radio" value="" class="hidden">
                                <input id="<?php echo $prefix ?>activity-student" name="activity" type="radio" value="1" class="hidden" >
                                <input id="<?php echo $prefix ?>activity-professional" name="activity" type="radio" value="2" class="hidden">
                                <label for="<?php echo $prefix ?>activity-nevermind" class="wpb_button wpb_btn-large <?php echo empty($_GET['activity']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></label>
                                <label for="<?php echo $prefix ?>activity-student" class="wpb_button wpb_btn-large <?php echo isset($_GET['activity']) && 1 == $_GET['activity'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Student', 'wpestate'); ?></label>
                                <label for="<?php echo $prefix ?>activity-professional" class="wpb_button wpb_btn-large <?php echo isset($_GET['activity']) && 2 == $_GET['activity'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Professional', 'wpestate'); ?></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mobile-filter-row">
                    
                    <div class="form-control-half control-party">
                        <div class="form-control-in">
                            <div class="switcher">
                                <div class="clearfix"></div>
                                <!--<input type="hidden" value="<?php echo isset($_GET['party']) ? (int) $_GET['party'] : '' ?>" name="party" id="<?php echo $prefix ?>party">-->
                                <label><?php _e('Party', 'wpestate'); ?></label>

                                <div class="value-row clearfix">
                                    <input id="<?php echo $prefix ?>party-nevermind" name="party" type="radio" value="" class="hidden">
                                    <input id="<?php echo $prefix ?>party-often" name="party" type="radio" value="1" class="hidden" >
                                    <input id="<?php echo $prefix ?>party-not-often" name="party" type="radio" value="2" class="hidden">
                                    <label for="<?php echo $prefix ?>party-nevermind" class="wpb_button wpb_btn-large <?php echo empty($_GET['party']) ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Nevermind', 'wpestate'); ?></label>
                                    <label for="<?php echo $prefix ?>party-often" class="wpb_button wpb_btn-large <?php echo isset($_GET['party']) && 1 == $_GET['party'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Often', 'wpestate'); ?></label>
                                    <label for="<?php echo $prefix ?>party-not-often" class="wpb_button wpb_btn-large <?php echo isset($_GET['party']) && 2 == $_GET['party'] ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Not often', 'wpestate'); ?></label>
                                </div>
                            </div>
                        </div> 
                    </div>                    
                    
                    <div class="form-control-half control-skill">
                        <div class="form-control-in">
                            <div class="form-control-skills pull-left">
                                <div class="form-control-in">
                                    <label><?php _e('House skills', 'wpestate'); ?></label>
                                    <p class="inline-checkboxes control-checkboxes">
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
                            </div>


                            <div class="form-control-origin no-label pull-left clearfix">
                                <!--<div class="form-control-in">-->

                                <?php
                                $coutnries = fl_get_countries();
                                ?>
                                <p>
                                    <select id="<?php echo $prefix ?>user_origin" name="origin" class="form-control">
                                        <option value=""><?php _e('Country of origin', 'wpestate'); ?></option>
                                        <?php
                                        if (!empty($coutnries)):
                                            foreach ($coutnries as $iso => $country):
                                                ?>
                                                <option value="<?php echo $iso ?>" <?php echo isset($_GET['origin']) && $_GET['origin'] == $iso ? ' selected="selected" ' : ''; ?>><?php esc_attr_e($country); ?></option>
                                                <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </p>

                                <!--</div>-->
                            </div>

                        </div>
                    </div>

                </div>

                <!--<div class="clearfix"></div>-->
                <div class="form-control-full clearfix language-skill">
                    <div class="clearfix"></div>
                    <div class="form-control-in">
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

                </div>
                <span id="<?php echo $prefix ?>roommate_extended_close_adv" class="adv_extended_close_adv" style="display: <?php echo isset($_GET['ra']) && 1 == $_GET['ra'] ? 'inline' : 'none' ?>;">
                    <i class="fa fa-times"> </i> <?php _e('Less search options', 'wpestate'); ?>
                </span>
                <input class="ra" name="ra" type="hidden" value="<?php echo isset($_GET['ra']) ? (int) $_GET['ra'] : 0 ?>">
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

    </div>

    <input name="submit" type="submit" class="wpb_button  wpb_btn_adv_submit wpb_btn-large btn-action border-radius" id="<?php echo $prefix ?>advanced_submit_2" value="<?php _e('Search', 'wpestate'); ?>">
    <?php if ($adv_search_type != 2) { ?>
        <div id="<?php echo $prefix ?>results">
            <?php _e('We found ', 'wpestate'); ?> <span id="<?php echo $prefix ?>results_no">0</span> <?php _e('results.', 'wpestate'); ?>
            <span id="<?php echo $prefix ?>showinpage"> <?php _e('Do you want to load the results now ?', 'wpestate'); ?> </span>
        </div>
    <?php } ?>
    <div class="clearfix"></div>
</form>