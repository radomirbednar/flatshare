<?php
global $post;
global $adv_search_type;
$adv_search_what = get_option('wp_estate_adv_search_what', '');
$show_adv_search_visible = get_option('wp_estate_show_adv_search_visible', '');
$close_class = '';
$adv_submit = get_adv_search_link();

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


$p_id = get_the_ID();

// 17745 = roomate search result page
if(17745 == $p_id):
?>
<script>    
        jQuery(document).ready(function ($) {        
            //e.preventDefault();            
            var target = $("#scroll-to").offset().top;            
            
            //console.log(target);
            
            if(target > 100){            
                $('html, body').animate({
                    scrollTop: target
                }, 2000);
            }
        });
</script>    
<?php endif; ?>

<div class="adv-search-1 <?php echo $close_class . ' ' . $extended_class; ?>" id="adv-search-1" <?php echo isset($_GET['ra']) && 1 == $_GET['ra'] ? 'style="height: auto;"' : '' ?>>
<div class="scroll-to-wrap"><div id="scroll-to"></div></div>

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
            jQuery("#looking_where, #mo_looking_where").autocomplete({
                source: availableTags
            });

            jQuery("#disponibility, #mo_disponibility").datepicker({
                dateFormat: "<?php echo DATEPICKER_FORMAT ?>",
            }, jQuery.datepicker.regional[control_vars.datepick_lang]).datepicker('widget').wrap('<div class="ll-skin-melon"/>');

            /*
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
             
             })*/

        });
        //]]>
    </script> 
    <?php
    $template = get_page_template(); 
    // jsem na strance properties, defaultne necham aktivni rental tab
    if (is_page_template('advanced_search_results.php') && empty($_GET['tab'])){
        $_GET['tab'] = 2;
    }
    
    if (is_page_template('advanced_search_results.php')):
    ?>
    <ul id="what-lookup" class="nav nav-tabs" role="tablist">
        <li role="presentation" class="<?php echo isset($_GET['tab']) && 2 == $_GET['tab'] ? 'active' : '' ?> rental-tab">
            <a class="search-tab" href="#rental" aria-controls="rental" role="tab" data-toggle="tab"><?php _e('Rental listings', 'wpestate'); ?></a>
        </li>         
        <li role="presentation" class="<?php echo!isset($_GET['tab']) || 1 == $_GET['tab'] ? 'active' : '' ?> flatmate-tab">
            <a class="search-tab" href="#roommate" aria-controls="roommate" role="tab" data-toggle="tab"><?php _e('Roommate listings', 'wpestate'); ?></a>
        </li> 
        <li id="adv-search-header-1"> 
            <span><?php _e('', 'wpestate'); ?></span>
        </li> 
    </ul>      
    <?php
    else:
    ?> 
    <!-- Nav tabs -->
    <ul id="what-lookup" class="nav nav-tabs" role="tablist">
        <li role="presentation" class="<?php echo!isset($_GET['tab']) || 1 == $_GET['tab'] ? 'active' : '' ?> rental-tab">
            <a class="search-tab" href="#roommate" aria-controls="roommate" role="tab" data-toggle="tab"><?php _e('Roommate listings', 'wpestate'); ?></a>
        </li>
        <li role="presentation" class="<?php echo isset($_GET['tab']) && 2 == $_GET['tab'] ? 'active' : '' ?> flatmate-tab">
            <a class="search-tab" href="#rental" aria-controls="rental" role="tab" data-toggle="tab"><?php _e('Rental listings', 'wpestate'); ?></a>
        </li>  
        <li id="adv-search-header-1"> 
            <span><?php _e('', 'wpestate'); ?></span>
        </li> 
    </ul>  
    <?php endif; ?>
    <!-- Tab panes -->
    <div class="tab-content"> 
        <div role="tabpanel" class="tab-pane <?php echo!isset($_GET['tab']) || 1 == $_GET['tab'] ? 'active' : '' ?>" id="roommate"><!-- search roommate panel -->
            <?php include(locate_template('templates/form_roomate_search.php')); ?>
        </div><!-- /search roommate panel --> 
        <div role="tabpanel" class="tab-pane <?php echo isset($_GET['tab']) && 2 == $_GET['tab'] ? 'active' : '' ?>" id="rental"><!-- rental search -->
            <form role="search" method="get"   action="<?php print $adv_submit; ?>" >
                <input type="hidden" name="tab" value="2">
                <div class="adv1-holder"> 
                    <?php
                    $availableTags = array();
                    $args = array('hide_empty=0');
                    $terms = get_terms('property_city', $args);
                    foreach ($terms as $term) {
                        $availableTags[] = esc_attr($term->name);
                    }
                    ?> 
                    <script type="text/javascript">
                        //<![CDATA[
                        jQuery(document).ready(function ($) { 
                            //console.log('autocomplele load'); 
                            var availableTags = ['<?php echo implode("','", $availableTags); ?>'];
                            $("#adv_location").autocomplete({
                                source: availableTags
                            });
                        });
                        //]]>
                    </script>

                    <?php
                    $custom_advanced_search = get_option('wp_estate_custom_advanced_search', '');
                    if ($custom_advanced_search == 'yes') {
                        ?>

                        <?php
                        foreach ($adv_search_what as $key => $search_field) {
                            ?>

                            <?php
                            wpestate_show_search_field('mainform', $search_field, $action_select_list, $categ_select_list, $select_city_list, $select_area_list, $key, $select_county_state_list);
                            //wpestate_show_search_field('mainform', $search_field, $action_select_list, $categ_select_list, '', $select_area_list, $key, $select_county_state_list);
                            ?>

                            <?php
                        }
                        ?>

                        <?php
                    } else {
                        $search_form = '<div class="col-md-3">';
                        $search_form .= wpestate_show_search_field_classic_form('main', $action_select_list, $categ_select_list, '', $select_area_list);
                        $search_form .= '</div>';
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
        <div class="clearfix"></div>
    </div>
   
</div>
