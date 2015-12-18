<?php
global $submit_title;
global $submit_description;
global $property_price;
global $property_label;
global $property_label_before;
?>

<div class="submit_container">
    <div class="submit_container_header"><?php _e('Property Description & Price', 'wpestate'); ?></div>

    <p class="full_form">
        <label for="title"><?php _e('*Title (mandatory)', 'wpestate'); ?> </label>
        <input type="text" id="title" class="form-control" value="<?php print $submit_title; ?>" size="20" name="property_title" />
    </p>

    <p class="full_form">
        <label for="description"><?php _e('*Description (mandatory)', 'wpestate'); ?></label>
        <textarea id="description"  class="form-control"  name="description" cols="50" rows="6"><?php print $submit_description; ?></textarea>
    </p>

    <p class="half_form">
        <label for="property_price"> <?php
            _e('Price in ', 'wpestate');
            print esc_html(get_option('wp_estate_currency_symbol', '')) . ' ';
            _e('(only numbers)', 'wpestate');
            ?>  </label>
        <input type="text" id="property_price" class="form-control" size="40" name="property_price" value="<?php print $property_price; ?>">
    </p>

    <p class="half_form half_form_last">
        <label for="property_label"><?php _e('After Price Label (ex: "per month")', 'wpestate'); ?></label>

        <select class="form-control" id="property_label" name="property_label" >             
            <?php
            $property_array = array("Week", "Month");   
            foreach ($property_array as $property_) {
                $selected = "";
                if ($property_label == $property_) {
                    $selected = "selected";
                }
                echo '<option ' . $selected . ' value="' . $property_ . '">' . $property_ . '</option>';
            }
            ?> 
        </select> 
        <!--<input type="text" id="property_label" class="form-control" size="40" name="property_label" value="<?php print $property_label; ?>">--> 
    </p>  
    <p class="half_form clear clearfix">    
        <label for="property_label_before"><?php _e('Before Price Label (ex: "from ")', 'wpestate'); ?></label>
        <!--input type="text" id="property_label_before" class="form-control" size="40" name="property_label_before" value="<?php print $property_label_before; ?>"-->
 
        <select class="form-control" id="property_label_before" name="property_label_before" >  
            <?php
            $property_before_array = array('All include', '+ Charges');
            foreach ($property_before_array as $property_before) {
                $selected = "";
                if ($property_before == $property_label_before) {
                    $selected = "selected";
                }
                echo '<option ' . $selected . ' value="' . $property_before . '">' . $property_before . '</option>';
            }
            ?> 
        </select>  
    </p> 
</div>