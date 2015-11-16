<?php

function fl_get_languages(){    
    global $wpdb;
    $sql = "SELECT * FROM fl_language_user ORDER BY position";
    $result = $wpdb->get_results($sql);
    return $result;
}

function fl_get_user_languages_name($user_id){ 
    global $wpdb;  
     
    
    $sql = "SELECT 
            lu.name 
        FROM 
            fl_language_user AS lu 
        JOIN 
            fl_language2user AS l2u 
        ON 
            lu.id_lang = l2u.id_lang 
        WHERE 
            l2u.id_user = '" . (int) $user_id ."'"; 

    $result = $wpdb->get_col($sql);
    return $result;
    
}
 
function fl_get_user_language_ids($user_id){    
    global $wpdb;
    $sql = "
        SELECT 
            l2u.id_lang 
        FROM 
            fl_language_user AS lu 
        JOIN 
            fl_language2user AS l2u 
        ON 
            lu.id_lang = l2u.id_lang 
        WHERE 
            l2u.id_user = '" . (int) $user_id . "'";
    
    $result = $wpdb->get_col($sql);
    return $result;
}

function fl_get_user_languages($user_id){    
    global $wpdb;
    $sql = "SELECT * FROM fl_language_user AS lu JOIN fl_language2user AS l2u ON lu.id_lang = li.id_lang WHERE l2u.id_user = '" . (int) $user_id . "'";
    $result = $wpdb->get_results($sql);
    return $result;
}

function fl_get_countries(){
    global $wpdb;
    $sql = "SELECT * FROM fl_country WHERE active = 1 ORDER BY name ASC";
    $result = $wpdb->get_results($sql);
    return $result;    
}

function fl_get_house_skills(){
    global $wpdb;
    $sql = "SELECT * FROM fl_skill_user ORDER BY position ASC";
    $result = $wpdb->get_results($sql);
    return $result;    
}

function fl_get_user_house_skills($id_user){
    global $wpdb;
    $sql = "SELECT * FROM fl_skill_user AS su JOIN fl_skill2user AS s2u ON su.id_skill = s2u.id_skill WHERE id_user = '" . (int) $id_user . "'";
    $result = $wpdb->get_results($sql);
    return $result;    
}

function fl_get_user_house_skill_ids($id_user){
    global $wpdb;
    $sql = "
        SELECT 
            su.id_skill 
        FROM 
            fl_skill_user AS su 
        JOIN 
            fl_skill2user AS s2u 
        ON 
            su.id_skill = s2u.id_skill 
        WHERE 
            id_user = '" . (int) $id_user . "'";
    
    $result = $wpdb->get_col($sql);
    return $result;
}

function fl_update_user_language($user_id, $languages){
    global $wpdb;
    
    $sql = "DELETE FROM fl_language2user WHERE id_user = '" . (int) $user_id . "'";
    $wpdb->query($sql);
    
    if(!empty($languages)){
        foreach($languages as $lang){
            $sql = "INSERT INTO fl_language2user (id_user, id_lang) VALUES ('" . (int) $user_id . "', '" . (int) $lang . "')";
            $wpdb->query($sql);
        }
    }
}

function fl_update_user_skill($user_id, $skills){
    global $wpdb;
    
    $sql = "DELETE FROM fl_skill2user WHERE id_user = '" . (int) $user_id . "'";
    $wpdb->query($sql);
    
    if(!empty($skills)){
        foreach($skills as $skill){
            $sql = "INSERT INTO fl_skill2user (id_user, id_skill) VALUES ('" . (int) $user_id . "', '" . (int) $skill . "')";
            $wpdb->query($sql);
        }
    }    
}

//
function get_user_meta_int($user_id, $meta_key){
    global $wpdb;
    $sql = "SELECT meta_value FROM fl_user_meta_int WHERE id_user = '" . (int) $user_id . "' AND meta_key = '" . esc_sql($meta_key) . "'";
    $result = $wpdb->get_var($sql);
    return $result;
}

function update_user_meta_int($user_id, $meta_key, $meta_value){
    global $wpdb;
    $sql = "REPLACE INTO fl_user_meta_int (id_user, meta_key, meta_value) VALUES ('" . (int) $user_id . "', '" . esc_sql($meta_key) . "', '" . esc_sql($meta_value) . "') ";
    $result = $wpdb->query($sql);
    return $result;        
}

function delete_user_meta_int($user_id, $meta_key){
    global $wpdb;
    $sql = "DELETE FROM fl_user_meta_int WHERE id_user = '" . (int) $user_id . "' AND meta_key = '" . esc_sql($meta_key) . "' LIMIT 1";
    $result = $wpdb->query($sql);
    return $result;        
}

function get_fl_data($user_id){
    global $wpdb;
    $sql = "SELECT * FROM fl_user_data WHERE id_user = '" . (int) $user_id . "'";
    $result = $wpdb->get_row($sql);
    return $result;
}