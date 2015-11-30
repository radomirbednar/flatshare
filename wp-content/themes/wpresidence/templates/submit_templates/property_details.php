<?php
global $unit;
global $property_size;
global $property_lot_size;
global $property_rooms;
global $property_bedrooms;
global $property_bathrooms;
global $custom_fields_array;
global $owner_notes;
$measure_sys = esc_html(get_option('wp_estate_measure_sys', ''));
?> 


<div class="submit_container">
    <div class="submit_container_header"><?php _e('Listing Details', 'wpestate'); ?></div>

    <p class="half_form">
        <label for="property_size"> <?php
            _e('Size in', 'wpestate');
            print ' ' . $measure_sys . '<sup>2</sup>';
            ?></label>
        <input type="text" id="property_size" size="40" class="form-control"  name="property_size" value="<?php print $property_size; ?>">
    </p>

    <p class="half_form half_form_last">
        <label for="property_lot_size"> <?php
            _e('Lot Size in', 'wpestate');
            print ' ' . $measure_sys . '<sup>2</sup>';
            ?> </label>
        <input type="text" id="property_lot_size" size="40" class="form-control"  name="property_lot_size" value="<?php print $property_lot_size; ?>">
    </p>

    <p class="half_form ">
        <label for="property_rooms"><?php _e('Rooms', 'wpestate'); ?></label>
        <input type="text" id="property_rooms" size="40" class="form-control"  name="property_rooms" value="<?php print $property_rooms; ?>">
    </p>

    <p class="half_form half_form_last">
        <label for="property_bedrooms "><?php _e('Bedrooms', 'wpestate'); ?></label>
        <input type="text" id="property_bedrooms" size="40" class="form-control"  name="property_bedrooms" value="<?php print $property_bedrooms; ?>">
    </p>

    <p class="half_form ">
        <label for="property_bathrooms"><?php _e('Bathrooms', 'wpestate'); ?></label>
        <input type="text" id="property_bathrooms" size="40" class="form-control"  name="property_bathrooms" value="<?php print $property_bathrooms; ?>">
    </p>

    <!-- Add custom details -->

    <?php
    $custom_fields = get_option('wp_estate_custom_fields', true);
 
    
    

    $i = 0;
    if (!empty($custom_fields)) {
        while ($i < count($custom_fields)) {
            $name = $custom_fields[$i][0];
            $label = $custom_fields[$i][1];
            $type = $custom_fields[$i][2];
            $order = $custom_fields[$i][3];
            $dropdown_values = $custom_fields[$i][4];
            $slug = str_replace(' ', '_', $name); 
            $slug = wpestate_limit45(sanitize_title($name));
            $slug = sanitize_key($slug);
            $post_id = $post->ID;
            $show = 1;
            $i++; 
            if (function_exists('icl_translate')) {
                $label = icl_translate('wpestate', 'wp_estate_property_custom_front_' . $label, $label);
            } 
            if ($i % 2 != 0) {
                print '<p class="half_form half_form_last">';
            } else {
                print '<p class="half_form">';
            }
            $value = $custom_fields_array[$slug];
            wpestate_show_custom_field($show, $slug, $name, $label, $type, $order, $dropdown_values, $post_id, $value);
        }
    }
    ?>  

    <p class="full_form ">
        <label for="owner_notes"><?php _e('Owner/Agent notes (*not visible on front end)', 'wpestate'); ?></label>  
        <textarea id="owner_notes" class="form-control"  name="owner_notes" ><?php print $owner_notes; ?></textarea>
    </p> 
</div>   
</div>  
 
<?php  
 
        $how_long = (int)( $_POST['how_long'] );       
        $sexual_preference = (int)( $_POST['sexual_preference'] ); 
        $user_gender = (int)( $_POST['user_gender'] );  
        $sleeping_span = (int)( $_POST['sleeping_span'] ); 
        $couple = (int)( $_POST['couple'] );
        $pets = (int)( $_POST['pets']); 
        $smoker = (int)( $_POST['smoker']);
        $party = (int)( $_POST['party']);
        
        
        
        
        
        
        
        
         
?>

<div class="submit_container">  
    <div class="submit_container_header"><?php _e('Listing Details 2', 'wpestate'); ?></div>  
    <div class="half_form">  
        <div class="switcher fl-row"> 
            <label><?php _e('For how long', 'wpestate'); ?></label> 
            <div class="value-row">
                <input id="how_long-1" name="how_long" type="radio" value="1" class="hidden" <?php echo isset($how_long) && 1 == $how_long ? ' checked="checked" ' : '' ?>>
                <input id="how_long-2" name="how_long" type="radio" value="2" class="hidden" <?php echo isset($how_long) && 2 == $how_long ? ' checked="checked" ' : '' ?>> 
                <input id="how_long-3" name="how_long" type="radio" value="3" class="hidden" <?php echo isset($how_long) && 3 == $how_long ? ' checked="checked" ' : '' ?>>      
                <label for="how_long-1" class="wpb_button wpb_btn-large <?php echo empty($how_long) || 1 == $how_long ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Short term', 'wpestate'); ?></label>
                <label for="how_long-2" class="wpb_button wpb_btn-large <?php echo isset($how_long) && 2 == $how_long ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Long term', 'wpestate'); ?></label> 
                <label for="how_long-3" class="wpb_button wpb_btn-large <?php echo isset($how_long) && 3 == $how_long ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Never mind', 'wpestate'); ?></label>  
            </div>                 
        </div>  
    </div> 
    
    <div class="half_form">   
        <div class="switcher fl-row"> 
            <label><?php _e('Sexual preferences', 'wpestate'); ?></label> 
            <div class="value-row">                
                <input id="sexual_preference-1" name="sexual_preference" type="radio" value="1" class="hidden" <?php echo empty($sexual_preference) || 1 == $sexual_preference ? ' checked="checked" ' : '' ?>>
                <input id="sexual_preference-2" name="sexual_preference" type="radio" value="2" class="hidden" <?php echo isset($sexual_preference) && 2 == $sexual_preference ? ' checked="checked" ' : '' ?>>
                <input id="sexual_preference-3" name="sexual_preference" type="radio" value="3" class="hidden" <?php echo isset($sexual_preference) && 3 == $sexual_preference ? ' checked="checked" ' : '' ?>> 
                <label for="sexual_preference-1" class="wpb_button wpb_btn-large <?php echo empty($sexual_preference) || 1 == $sexual_preference ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Straight', 'wpestate'); ?></label>
                <label for="sexual_preference-2" class="wpb_button wpb_btn-large <?php echo isset($sexual_preference) && 2 == $sexual_preference ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Bi / Gay', 'wpestate'); ?></label> 
                <label for="sexual_preference-3" class="wpb_button wpb_btn-large <?php echo isset($sexual_preference) && 3 == $sexual_preference ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Never mind', 'wpestate'); ?></label>
            </div> 
        </div>
    </div> 
    
    <div class="half_form">   
        <div class="switcher fl-row">
                <!--<input type="hidden" id="user_gender" name="user_gender" value="<?php echo (int) $user_gender ?>">-->
            <label><?php _e('Gender', 'wpestate'); ?></label> 
            <div class="value-row">
                <input id="user_gender-1" name="user_gender" type="radio" value="1" class="hidden" <?php echo isset($user_gender) && 1 == $user_gender ? ' checked="checked" ' : '' ?>>
                <input id="user_gender-2" name="user_gender" type="radio" value="2" class="hidden" <?php echo empty($user_gender) || 2 == $user_gender ? ' checked="checked" ' : '' ?>> 
                <input id="user_gender-3" name="user_gender" type="radio" value="3" class="hidden" <?php echo empty($user_gender) || 3 == $user_gender ? ' checked="checked" ' : '' ?>>  
                <label for="user_gender-2" class="wpb_button wpb_btn-large <?php echo empty($user_gender) || 2 == $user_gender ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Female', 'wpestate'); ?></label>
                <label for="user_gender-1" class="wpb_button wpb_btn-large <?php echo isset($user_gender) && 1 == $user_gender ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Male', 'wpestate'); ?></label>                    
                <label for="user_gender-3" class="wpb_button wpb_btn-large <?php echo isset($user_gender) && 3 == $user_gender ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Never mind', 'wpestate'); ?></label>     
            </div> 
            <!--
            <button class="wpb_button wpb_btn-large <?php echo $user_gender == 1 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#user_gender" data-value="1"><?php _e('Male', 'wpestate'); ?></button>
            <button class="wpb_button wpb_btn-large <?php echo $user_gender == 2 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#user_gender" data-value="2"><?php _e('Female', 'wpestate'); ?></button>
            -->
        </div>
    </div>  
    
    <div class="half_form"> 
        <div class="switcher fl-row">
                 <!--<input type="hidden" id="sleeping_span" name="sleeping_span" value="<?php echo (int) $sleeping_span ?>">-->
            <label><?php _e('Sleep during week', 'wpestate'); ?></label> 
            <div class="value-row">
                <input id="sleeping_span-1" name="sleeping_span" type="radio" value="1" class="hidden" <?php echo empty($sleeping_span) || 1 == $sleeping_span ? ' checked="checked" ' : '' ?>>
                <input id="sleeping_span-2" name="sleeping_span" type="radio" value="2" class="hidden" <?php echo isset($sleeping_span) && 2 == $sleeping_span ? ' checked="checked" ' : '' ?>>
                <input id="sleeping_span-3" name="sleeping_span" type="radio" value="3" class="hidden" <?php echo isset($sleeping_span) && 3 == $sleeping_span ? ' checked="checked" ' : '' ?>> 
                <label for="sleeping_span-1" class="wpb_button wpb_btn-large <?php echo empty($sleeping_span) || 1 == $sleeping_span ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Before 11PM', 'wpestate'); ?></label>
                <label for="sleeping_span-2" class="wpb_button wpb_btn-large <?php echo isset($sleeping_span) && 2 == $sleeping_span ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('After 11PM', 'wpestate'); ?></label> 
                <label for="sleeping_span-3" class="wpb_button wpb_btn-large <?php echo isset($sleeping_span) && 3 == $sleeping_span ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Never mind', 'wpestate'); ?></label> 
            </div> 
        </div>
    </div> 
    
    <div class="half_form"> 
        <div class="switcher fl-row">
                    <!--<input type="hidden" id="couple" name="couple" value="<?php echo (int) $couple ?>">-->
            <label><?php _e('Couple', 'wpestate'); ?></label> 
            <div class="value-row">
                <input id="couple-1" name="couple" type="radio" value="1" class="hidden" <?php echo empty($couple) || 1 == $couple ? ' checked="checked" ' : '' ?>>
                <input id="couple-2" name="couple" type="radio" value="2" class="hidden" <?php echo isset($couple) && 2 == $couple ? ' checked="checked" ' : '' ?>>
                <input id="couple-3" name="couple" type="radio" value="3" class="hidden" <?php echo isset($couple) && 3 == $couple ? ' checked="checked" ' : '' ?>> 
                <label for="couple-1" class="wpb_button wpb_btn-large <?php echo empty($couple) || 1 == $couple ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Single', 'wpestate'); ?></label>
                <label for="couple-2" class="wpb_button wpb_btn-large <?php echo isset($couple) && 2 == $couple ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('In couple', 'wpestate'); ?></label>
                <label for="couple-3" class="wpb_button wpb_btn-large <?php echo isset($couple) && 3 == $couple ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Never mind', 'wpestate'); ?></label> 
            </div> 
        </div> 
    </div>  
    <div class="half_form"> 
        <div class="switcher fl-row">
                 <!--<input type="hidden" id="pets" name="pets" value="<?php echo (int) $pets ?>">-->
            <label><?php _e('Pets', 'wpestate'); ?></label> 
            <div class="value-row">
                <input id="pets-1" name="pets" type="radio" value="1" class="hidden" <?php echo empty($pets) || 1 == $pets ? ' checked="checked" ' : '' ?>>
                <input id="pets-2" name="pets" type="radio" value="2" class="hidden" <?php echo isset($pets) && 2 == $pets ? ' checked="checked" ' : '' ?>> 
                <input id="pets-3" name="pets" type="radio" value="3" class="hidden" <?php echo isset($pets) && 3 == $pets ? ' checked="checked" ' : '' ?>> 
                <label for="pets-1" class="wpb_button wpb_btn-large <?php echo empty($pets) || 1 == $pets ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('No pets', 'wpestate'); ?></label>
                <label for="pets-2" class="wpb_button wpb_btn-large <?php echo isset($pets) && 2 == $pets ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Pets', 'wpestate'); ?></label> 
                <label for="pets-3" class="wpb_button wpb_btn-large <?php echo isset($pets) && 3 == $pets ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Never mind', 'wpestate'); ?></label> 
            </div>
            <!--
            <button class="wpb_button wpb_btn-large <?php echo $pets == 1 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#pets" data-value="1"><?php _e('No pets', 'wpestate'); ?></button>
            <button class="wpb_button wpb_btn-large <?php echo $pets == 2 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#pets" data-value="2"><?php _e('Pets', 'wpestate'); ?></button>
            -->
        </div>
    </div>     
    <div class="half_form">      
        <div class="switcher fl-row">
            <!--<input type="hidden" id="smoker" name="smoker" value="<?php echo (int) $smoker ?>">-->
            <label><?php _e('Smoker', 'wpestate'); ?></label> 
            <div class="value-row">
                <input id="smoker-1" name="smoker" type="radio" value="1" class="hidden" <?php echo empty($smoker) || 1 == $smoker ? ' checked="checked" ' : '' ?>>
                <input id="smoker-2" name="smoker" type="radio" value="2" class="hidden" <?php echo isset($smoker) && 2 == $smoker ? ' checked="checked" ' : '' ?>>   
                <input id="smoker-3" name="smoker" type="radio" value="3" class="hidden" <?php echo isset($smoker) && 3 == $smoker ? ' checked="checked" ' : '' ?>> 
                <label for="smoker-1" class="wpb_button wpb_btn-large <?php echo empty($smoker) || 1 == $smoker ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Non-smoker', 'wpestate'); ?></label>
                <label for="smoker-2" class="wpb_button wpb_btn-large <?php echo isset($smoker) && 2 == $smoker ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Smoker', 'wpestate'); ?></label> 
                <label for="smoker-3" class="wpb_button wpb_btn-large <?php echo isset($smoker) && 3 == $smoker ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Never mind', 'wpestate'); ?></label> 
            </div>
            <!--
            <button class="wpb_button wpb_btn-large <?php echo $smoker == 1 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#smoker" data-value="1"><?php _e('Non-smoker', 'wpestate'); ?></button>
            <button class="wpb_button wpb_btn-large <?php echo $smoker == 2 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#smoker" data-value="2"><?php _e('Smoker', 'wpestate'); ?></button>
            -->
        </div>
    </div> 
    <div class="half_form">
        <div class="switcher fl-row">
            <!--<input type="hidden" id="party" name="party" value="<?php echo (int) $party ?>">-->
            <label><?php _e('Party', 'wpestate'); ?></label>
            <div class="value-row">
                <input id="party-1" name="party" type="radio" value="1" class="hidden" <?php echo empty($party) || 1 == $party ? ' checked="checked" ' : '' ?>>
                <input id="party-2" name="party" type="radio" value="2" class="hidden" <?php echo isset($party) && 2 == $party ? ' checked="checked" ' : '' ?>>             
                <input id="party-3" name="party" type="radio" value="3" class="hidden" <?php echo isset($party) && 3 == $party ? ' checked="checked" ' : '' ?>> 
                <label for="party-1" class="wpb_button wpb_btn-large <?php echo empty($party) || 1 == $party ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Often', 'wpestate'); ?></label>
                <label for="party-2" class="wpb_button wpb_btn-large <?php echo isset($party) && 2 == $party ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Not often', 'wpestate'); ?></label>
                <label for="party-3" class="wpb_button wpb_btn-large <?php echo isset($party) && 3 == $party ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Never mind', 'wpestate'); ?></label> 
            </div>  
            <!--
            <button class="wpb_button wpb_btn-large <?php echo $party == 1 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#party" data-value="1"><?php _e('Often', 'wpestate'); ?></button>
            <button class="wpb_button wpb_btn-large <?php echo $party == 2 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#party" data-value="2"><?php _e('Not often', 'wpestate'); ?></button>
            -->
        </div> 
    </div>    
    
    
    
    <?php $user_rent = "0"; ?>
    
    <div class="half_form">
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
                        jQuery("#rent_label_text").text(ui.value.format());
                    }
                });
            });
        </script>  
        <?php
            $currency = esc_html(get_option('wp_estate_currency_symbol', ''));
        ?> 
        <p>
            <label for="rent_amount" class="wauto"><?php _e('How much do you want to pay?:', 'wpestate'); ?></label>
            <span id="rent_label_text" class="slide-label"><?php printf(__('%s', 'dokan'), (int) $user_rent); ?> <?php echo esc_html($currency); ?></span>
        </p>  
        <div id="slider_rent" class="fl-slider"></div>
        <input type="hidden" id="rent_amount"  name="rent_amount"  value="<?php echo (int) $user_rent; ?>">
    </div>
    </div>
        
        
    <div class="half_form">
        <div class="fl-row">
            <?php
            $coutnries = fl_get_countries();
            $user_origin = "";
            ?>
            <label for="user_origin"><?php _e('Country of origin', 'wpestate'); ?></label>
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
        </div>
    </div>    

    <div class="half_form">
        <div class="switcher fl-row">
            <!--<input type="hidden" id="activity" name="activity" value="<?php echo (int) $activity ?>">--> 
            <label><?php _e('Activity', 'wpestate'); ?></label> 
            <div class="value-row">
                <input id="activity-1" name="activity" type="radio" value="1" class="hidden" <?php echo empty($activity) || 1 == $activity ? ' checked="checked" ' : '' ?>>
                <input id="activity-2" name="activity" type="radio" value="2" class="hidden" <?php echo isset($activity) && 2 == $activity ? ' checked="checked" ' : '' ?>> 
                <input id="activity-3" name="activity" type="radio" value="3" class="hidden" <?php echo isset($activity) && 3 == $activity ? ' checked="checked" ' : '' ?>> 
                <label for="activity-1" class="wpb_button wpb_btn-large <?php echo empty($activity) || 1 == $activity ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Student', 'wpestate'); ?></label>
                <label for="activity-2" class="wpb_button wpb_btn-large <?php echo isset($activity) && 2 == $activity ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Professional', 'wpestate'); ?></label> 
                <label for="activity-3" class="wpb_button wpb_btn-large <?php echo isset($activity) && 3 == $activity ? 'wpb_btn-on' : 'wpb_btn-off' ?>"><?php _e('Never mind', 'wpestate'); ?></label> 
            </div> 
            <!--
            <button class="wpb_button wpb_btn-large <?php echo $activity == 1 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#activity" data-value="1"><?php _e('Student', 'wpestate'); ?></button>
            <button class="wpb_button wpb_btn-large <?php echo $activity == 2 ? " wpb_btn-on" : " wpb_btn-off" ?>" data-target="#activity" data-value="2"><?php _e('Professional', 'wpestate'); ?></button>
            -->
        </div>
    </div>
     
    <div class="col-xs-12">
        <div class="fl-row">
            <label><?php _e('Language skills', 'wpestate'); ?></label>
            <p class="inline-checkboxes">                 
                <?php 
                $user_language_ids = array(); 
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
</div> 