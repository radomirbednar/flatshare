<?php

function fl_get_languages(){    
    global $wpdb;
    $sql = "SELECT * FROM fl_language_user ORDER BY position";
    $result = $wpdb->get_results($sql);
    return $result;
}

function fl_get_countries(){
    global $wpdb;
    $sql = "SELECT * FROM fl_country ORDER BY name ASC";
    $result = $wpdb->get_results($sql);
    return $result;    
}

function fl_get_house_skills(){
    global $wpdb;
    $sql = "SELECT * FROM fl_skill_user ORDER BY position ASC";
    $result = $wpdb->get_results($sql);
    return $result;    
}

//
function update_user_meta_int($user_id, $meta_key, $meta_value){
    global $wpdb;
    $sql = "REPLACE INTO fl_user_meta_int (id_user, meta_key, meta_value) VALUES ('" . (int) $user_id . "', '" . esc_sql($meta_key) . "', '" . esc_sql($meta_value) . "') ";
    $result = $wpdb->query($sql);
    return $result;        
}

function delete_user_meta_int($user_id, $meta_key){
    global $wpdb;
    $sql = "DELETE FROM fl_user_meta_int WHERE id_user = '" . (int) $user_id . "' AND meta_key = '" . esc_sql($meta_key) . "' ";
    $result = $wpdb->query($sql);
    return $result;        
}