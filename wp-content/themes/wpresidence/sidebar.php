<!-- begin sidebar -->
<div class="clearfix visible-xs"></div>
<?php
//print $options['sidebar_name'].' / '.$options['sidebar_class']  ;
$sidebar_name = $options['sidebar_name'];
$sidebar_class = $options['sidebar_class'];

if (('no sidebar' != $options['sidebar_class']) && ('' != $options['sidebar_class'] ) && ('none' != $options['sidebar_class'])) {
    ?>     
    <div class="col-xs-12 <?php print $options['sidebar_class']; ?> widget-area-sidebar" id="primary" >
        <?php
        if ('estate_property' == get_post_type() && !is_tax()) {

            /* $sidebar_agent_option_value=    get_post_meta($post->ID, 'sidebar_agent_option', true);

              if($sidebar_agent_option_value =='global'){
              $enable_global_property_page_agent_sidebar= esc_html ( get_option('wp_estate_global_property_page_agent_sidebar','') );

              if($enable_global_property_page_agent_sidebar=='yes'){
              get_template_part ('/templates/property_list_agent');
              }

              }
              elseif ($sidebar_agent_option_value =='yes') {
              get_template_part ('/templates/property_list_agent');
              } */

            //show user in sidebar - always when is it post type estate_property
            //get_template_part('/templates/property_list_agent');
        ?>
         
            <div class="agent_contanct_form_sidebar">     
               <?php
                wp_reset_query();
            
                get_template_part('templates/author_unit_widget');
                get_template_part('templates/author_contact');
             
                ?> 
                
            </div> 
        <?php
    }
    ?>

        <ul class="xoxo">
        <?php generated_dynamic_sidebar($options['sidebar_name']); ?>
        </ul>

    </div>   

            <?php
        }
        ?>
<!-- end sidebar -->