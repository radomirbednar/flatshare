<?php

function get_languages(){    
    global $wpdb;
    $sql = "SELECT * FROM fl_language_user ORDER BY position";
    $result = $wpdb->get_results($sql);
    return $result;
}
