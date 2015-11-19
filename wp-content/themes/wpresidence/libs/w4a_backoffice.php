<?php


class AdminW4aUser {

    public function __construct() {

        //add_filter('manage_users_columns', array($this, 'manage_users_columns'));
        //add_filter('manage_users_custom_column', array($this, 'manage_users_custom_column'), 10, 3);

        add_action('edit_user_profile', array($this, 'edit_user_profile'));
        add_action('user_new_form', array($this, 'edit_user_profile'));

        add_action('edit_user_profile_update', array($this, 'edit_user_profile_update'));
        add_action('user_register', array($this, 'edit_user_profile_update'));

        add_action( 'admin_enqueue_scripts', array($this, 'load_assets') );

    }


    public function load_assets($page){
        if(in_array($page, array("user-edit.php", "user-new.php"))){
            wp_enqueue_script( 'jquery-ui-datepicker' );
            wp_enqueue_script( 'jquery-ui-slider' );
            
            //wp_enqueue_script('dense', get_template_directory_uri().'/js/dense.js',array('jquery'), '1.0', true);
            //wp_enqueue_script('modernizr', get_template_directory_uri().'/js/modernizr.custom.62456.js',array(), '1.0', false);     
            //wp_enqueue_script('control', get_template_directory_uri().'/js/control.js',array('jquery'), '1.0', true);   
            
            wp_enqueue_script('ajax-upload', get_template_directory_uri().'/js/ajax-upload.js',array('jquery','plupload-handlers'), '1.0', true);  
            
            wp_localize_script('ajax-upload', 'control_vars', 
                array(  //'morg1'                 =>   __('Amount Financed:','wpestate'),
                    //'morg2'                 =>   __('Mortgage Payments:','wpestate'),
                    //'morg3'                 =>   __('Annual cost of Loan:','wpestate'),
                    //'searchtext'            =>   __('SEARCH','wpestate'),
                    //'searchtext2'           =>   __('Search here...','wpestate'),
                    //'icons'                 =>   $icons,
                    //'hovericons'            =>   $hover_icons,
                    'path'                  =>   get_template_directory_uri(),
                    'search_room'           =>  __('Type Bedrooms No.','wpestate'),
                    'search_bath'           =>  __('Type Bathrooms No.','wpestate'),
                    'search_min_price'      =>  __('Type Min. Price','wpestate'),
                    'search_max_price'      =>  __('Type Max. Price','wpestate'),
                    'contact_name'          =>  __('Your Name','wpestate'),
                    'contact_email'         =>  __('Your Email','wpestate'),
                    'contact_phone'         =>  __('Your Phone','wpestate'),
                    'contact_comment'       =>  __('Your Message','wpestate'),
                    'zillow_addres'         =>  __('Your Address','wpestate'),
                    'zillow_city'           =>  __('Your City','wpestate'),
                    'zillow_state'          =>  __('Your State Code (ex CA)','wpestate'),
                    'adv_contact_name'      =>  __('Your Name','wpestate'),
                    'adv_email'             =>  __('Your Email','wpestate'),
                    'adv_phone'             =>  __('Your Phone','wpestate'),
                    'adv_comment'           =>  __('Your Message','wpestate'),
                    'adv_search'            =>  __('Send Message','wpestate'),
                    'admin_url'             =>  get_admin_url(),
                    //'login_redirect'        =>  $login_redirect,
                    //'login_loading'         =>  __('Sending user info, please wait...','wpestate'), 
                    //'street_view_on'        =>  __('Street View','wpestate'),
                    //'street_view_off'       =>  __('Close Street View','wpestate'),
                    //'userid'                =>  $userID,
                    //'show_adv_search_map_close'=>$show_adv_search_map_close,
                    'close_map'             =>  __('close map','wpestate'),
                    'open_map'              =>  __('open map','wpestate'),
                    'fullscreen'            =>  __('Fullscreen','wpestate'),
                    'default'               =>  __('Default','wpestate'),
                    'addprop'               =>  __('Please wait while we are processing your submission!','wpestate'),
                    'deleteconfirm'         =>  __('Are you sure you wish to delete?','wpestate'),
                    'terms_cond'            =>  __('You need to agree with terms and conditions !','wpestate'),
                    'procesing'             =>  __('Processing...','wpestate'),
                    'slider_min'            =>  floatval(get_option('wp_estate_show_slider_min_price','')),
                    'slider_max'            =>  floatval(get_option('wp_estate_show_slider_max_price','')), 
                    'curency'               =>  esc_html( get_option('wp_estate_currency_symbol', '') ),
                    'where_curency'         =>  esc_html( get_option('wp_estate_where_currency_symbol', '') ),
                    //'submission_curency'    =>  $submission_curency,
                    'to'                    =>  __('to','wpestate'),
                    //'direct_pay'            =>  $direct_payment_details,
                    'send_invoice'          =>  __('Send me the invoice','wpestate'),
                    'direct_title'          =>  __('Direct payment instructions','wpestate'),
                    'direct_thx'            =>  __('Thank you. Please check your email for payment instructions.','wpestate'),
                    'direct_price'          =>  __('To be paid','wpestate'),
                    'price_separator'       =>  stripslashes ( esc_html( get_option('wp_estate_prices_th_separator', '') ) ),
                    'plan_title'            =>  __('Plan Title','wpestate'),
                    'plan_image'            =>  __('Plan Image','wpestate'),
                    'plan_desc'             =>  __('Plan Description','wpestate'),
                    'plan_size'             =>  __('Plan Size','wpestate'),
                    'plan_rooms'            =>  __('Plan Rooms','wpestate'),
                    'plan_bathrooms'        =>  __('Plan Bathrooms','wpestate'),
                    'plan_price'            =>  __('Plan Price','wpestate'),
                    'readsys'               =>  get_option('wp_estate_readsys',''),
                    'datepick_lang'         =>  $date_lang_status,
                )
            );             
            
            wp_enqueue_style('jquery.ui.theme', get_template_directory_uri() . '/css/jquery-ui.min.css');
        }
    }

    /**
     * custom html to user profile
     *
     * @global type $user_id
     * @return type
     */
    public function edit_user_profile() {

        if (!current_user_can('edit_users')) {
            return;
        }

        include 'tpl/admin/profile.php';
    }

    /**
     * update data
     *
     * @param type $user_id
     * @return type
     */
    public function edit_user_profile_update($user_id) {

        //edit_users
        if (!(current_user_can('edit_users') && is_admin())) {
            return;
        }
        $data = $_POST;

        
        fl_update_user_data($user_id, $data);
        
        /**
         * Update user languages
         */
        fl_update_user_language($user_id, empty($data['language']) ? array() : $data['language']);

        /**
         * Update user skills
         */
        fl_update_user_skill($user_id, empty($data['skill']) ? array() : $data['skill']);
        
        
        $profile_image_url_small   = wp_kses($data['custom_picture'], array());
        $img_id  = wp_kses($data['small_custom_picture'], array());

        
        update_user_meta( $user_id, 'custom_picture', $profile_image_url_small);
        update_user_meta( $user_id, 'small_custom_picture', $img_id);        
    }


}

new AdminW4aUser();