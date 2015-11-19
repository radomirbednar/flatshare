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
        

    }


}

new AdminW4aUser();