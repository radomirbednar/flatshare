<?php

DEFINE('MAX_RENT', 1200);

function fl_update_user_data($userID, $data){
    
        $when_move = null;        
        if(isset($data['when_move'])){
            $when_move = DateTime::createFromFormat(PHP_DATEPICKER_FORMAT, $data['when_move']);
        }
        
        $birthdate = null;        
        if(isset($data['birthdate'])){
            $birthdate = DateTime::createFromFormat(PHP_DATEPICKER_FORMAT, $data['birthdate']);
        }        
        
        

        global $wpdb;

        $sql = "
            REPLACE INTO
                fl_user_data (
                    id_user,
                    how_long,
                    birthdate,
                    user_gender,
                    sexual_preference,
                    sleeping_span,
                    couple,
                    smoker,
                    pets,
                    activity,
                    user_origin,
                    party,
                    looking_when,
                    user_status,
                    looking_for,
                    looking_where,
                    rent_amount,
                    disponibility
                )
            VALUES (
                \"" . (int) $userID . "\",
                \"" . (empty($data['how_long']) ? '' : (int) $data['how_long']) . "\",
                "   . (empty($birthdate) ? 'NULL' : "\"" . $birthdate->format('Y-m-d') . "\"") . ",
                \"" . (empty($data['user_gender']) ? '' : (int) $data['user_gender']) . "\",
                \"" . (empty($data['sexual_preference']) ? "''" : (int) $data['sexual_preference']) . "\",
                \"" . (empty($data['sleeping_span']) ? '' : (int) $data['sleeping_span']) . "\",
                \"" . (empty($data['couple']) ? '' : (int) $data['couple']) . "\",
                \"" . (empty($data['smoker']) ? '' : (int) $data['smoker']) . "\",
                \"" . (empty($data['pets']) ? '' : (int) $data['pets']) . "\",
                \"" . (empty($data['activity']) ? '' : (int) $data['activity']) . "\",
                \"" . (empty($data['user_origin']) ? '' : esc_sql($data['user_origin'])) . "\",
                \"" . (empty($data['party']) ? '' : (int) $data['party']) . "\",
                \"" . (empty($data['looking_when']) ? '' : (int) $data['looking_when']) . "\",
                \"" . (empty($data['user_status']) ? '' : (int) $data['user_status']) . "\",
                \"" . (empty($data['looking_for']) ? '' : (int) $data['looking_for']) . "\",
                \"" . (empty($data['looking_where']) ? '' : esc_sql($data['looking_where'])) . "\",
                \"" . (empty($data['rent_amount']) ? '' : esc_sql($data['rent_amount'])) . "\",
                "   . (empty($when_move) ? 'NULL' : "\"" . $when_move->format('Y-m-d') . "\"") . "
            )
        ";

        $result = $wpdb->query($sql);    
        return $result;    
}

function fl_user_statuses() {

    $arr = array(
        3 => __('inactive', 'wpestate'),
        1 => __('Looking for a flat', 'wpestate'),
        2 => __('Looking for a roommate', 'wpestate'),
            //   4 => __('Landlord', 'wpestate'),
    );

    return $arr;
}

function fl_get_languages() {
    global $wpdb;
    $sql = "SELECT * FROM fl_language_user ORDER BY position";
    $result = $wpdb->get_results($sql);
    return $result;
}

function fl_get_user_languages_name($user_id) {
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
            l2u.id_user = '" . (int) $user_id . "'";

    $result = $wpdb->get_col($sql);
    return $result;
}

function fl_get_user_language_ids($user_id) {
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

function fl_get_user_languages($user_id) {
    global $wpdb;
    $sql = "SELECT * FROM fl_language_user AS lu JOIN fl_language2user AS l2u ON lu.id_lang = li.id_lang WHERE l2u.id_user = '" . (int) $user_id . "'";
    $result = $wpdb->get_results($sql);
    return $result;
}


    
    //$countries = array(__("Afghanistan","wpestate"),__("Albania","wpestate"),__("Algeria","wpestate"),__("American Samoa","wpestate"),__("Andorra","wpestate"),__("Angola","wpestate"),__("Anguilla","wpestate"),__("Antarctica","wpestate"),__("Antigua and Barbuda","wpestate"),__("Argentina","wpestate"),__("Armenia","wpestate"),__("Aruba","wpestate"),__("Australia","wpestate"),__("Austria","wpestate"),__("Azerbaijan","wpestate"),__("Bahamas","wpestate"),__("Bahrain","wpestate"),__("Bangladesh","wpestate"),__("Barbados","wpestate"),__("Belarus","wpestate"),__("Belgium","wpestate"),__("Belize","wpestate"),__("Benin","wpestate"),__("Bermuda","wpestate"),__("Bhutan","wpestate"),__("Bolivia","wpestate"),__("Bosnia and Herzegowina","wpestate"),__("Botswana","wpestate"),__("Bouvet Island","wpestate"),__("Brazil","wpestate"),__("British Indian Ocean Territory","wpestate"),__("Brunei Darussalam","wpestate"),__("Bulgaria","wpestate"),__("Burkina Faso","wpestate"),__("Burundi","wpestate"),__("Cambodia","wpestate"),__("Cameroon","wpestate"),__("Canada","wpestate"),__("Cape Verde","wpestate"),__("Cayman Islands","wpestate"),__("Central African Republic","wpestate"),__("Chad","wpestate"),__("Chile","wpestate"),__("China","wpestate"),__("Christmas Island","wpestate"),__("Cocos (Keeling) Islands","wpestate"),__("Colombia","wpestate"),__("Comoros","wpestate"),__("Congo","wpestate"),__("Congo, the Democratic Republic of the","wpestate"),__("Cook Islands","wpestate"),__("Costa Rica","wpestate"),__("Cote d'Ivoire","wpestate"),__("Croatia (Hrvatska)","wpestate"),__("Cuba","wpestate"),__("Cyprus","wpestate"),__("Czech Republic","wpestate"),__("Denmark","wpestate"),__("Djibouti","wpestate"),__("Dominica","wpestate"),__("Dominican Republic","wpestate"),__("East Timor","wpestate"),__("Ecuador","wpestate"),__("Egypt","wpestate"),__("El Salvador","wpestate"),__("Equatorial Guinea","wpestate"),__("Eritrea","wpestate"),__("Estonia","wpestate"),__("Ethiopia","wpestate"),__("Falkland Islands (Malvinas)","wpestate"),__("Faroe Islands","wpestate"),__("Fiji","wpestate"),__("Finland","wpestate"),__("France","wpestate"),__("France Metropolitan","wpestate"),__("French Guiana","wpestate"),__("French Polynesia","wpestate"),__("French Southern Territories","wpestate"),__("Gabon","wpestate"),__("Gambia","wpestate"),__("Georgia","wpestate"),__("Germany","wpestate"),__("Ghana","wpestate"),__("Gibraltar","wpestate"),__("Greece","wpestate"),__("Greenland","wpestate"),__("Grenada","wpestate"),__("Guadeloupe","wpestate"),__("Guam","wpestate"),__("Guatemala","wpestate"),__("Guinea","wpestate"),__("Guinea-Bissau","wpestate"),__("Guyana","wpestate"),__("Haiti","wpestate"),__("Heard and Mc Donald Islands","wpestate"),__("Holy See (Vatican City State)","wpestate"),__("Honduras","wpestate"),__("Hong Kong","wpestate"),__("Hungary","wpestate"),__("Iceland","wpestate"),__("India","wpestate"),__("Indonesia","wpestate"),__("Iran (Islamic Republic of)","wpestate"),__("Iraq","wpestate"),__("Ireland","wpestate"),__("Israel","wpestate"),__("Italy","wpestate"),__("Jamaica","wpestate"),__("Japan","wpestate"),__("Jordan","wpestate"),__("Kazakhstan","wpestate"),__("Kenya","wpestate"),__("Kiribati","wpestate"),__("Korea, Democratic People's Republic of","wpestate"),__("Korea, Republic of","wpestate"),__("Kuwait","wpestate"),__("Kyrgyzstan","wpestate"),__("Lao, People's Democratic Republic","wpestate"),__("Latvia","wpestate"),__("Lebanon","wpestate"),__("Lesotho","wpestate"),__("Liberia","wpestate"),__("Libyan Arab Jamahiriya","wpestate"),__("Liechtenstein","wpestate"),__("Lithuania","wpestate"),__("Luxembourg","wpestate"),__("Macau","wpestate"),__("Macedonia (FYROM)","wpestate"),__("Madagascar","wpestate"),__("Malawi","wpestate"),__("Malaysia","wpestate"),__("Maldives","wpestate"),__("Mali","wpestate"),__("Malta","wpestate"),__("Marshall Islands","wpestate"),__("Martinique","wpestate"),__("Mauritania","wpestate"),__("Mauritius","wpestate"),__("Mayotte","wpestate"),__("Mexico","wpestate"),__("Micronesia, Federated States of","wpestate"),__("Moldova, Republic of","wpestate"),__("Monaco","wpestate"),__("Mongolia","wpestate"),__("Montserrat","wpestate"),__("Morocco","wpestate"),__("Mozambique","wpestate"),__("Montenegro","wpestate"),__("Myanmar","wpestate"),__("Namibia","wpestate"),__("Nauru","wpestate"),__("Nepal","wpestate"),__("Netherlands","wpestate"),__("Netherlands Antilles","wpestate"),__("New Caledonia","wpestate"),__("New Zealand","wpestate"),__("Nicaragua","wpestate"),__("Niger","wpestate"),__("Nigeria","wpestate"),__("Niue","wpestate"),__("Norfolk Island","wpestate"),__("Northern Mariana Islands","wpestate"),__("Norway","wpestate"),__("Oman","wpestate"),__("Pakistan","wpestate"),__("Palau","wpestate"),__("Panama","wpestate"),__("Papua New Guinea","wpestate"),__("Paraguay","wpestate"),__("Peru","wpestate"),__("Philippines","wpestate"),__("Pitcairn","wpestate"),__("Poland","wpestate"),__("Portugal","wpestate"),__("Puerto Rico","wpestate"),__("Qatar","wpestate"),__("Reunion","wpestate"),__("Romania","wpestate"),__("Russian Federation","wpestate"),__("Rwanda","wpestate"),__("Saint Kitts and Nevis","wpestate"),__("Saint Lucia","wpestate"),__("Saint Vincent and the Grenadines","wpestate"),__("Samoa","wpestate"),__("San Marino","wpestate"),__("Sao Tome and Principe","wpestate"),__("Saudi Arabia","wpestate"),__("Senegal","wpestate"),__("Seychelles","wpestate"),__("Serbia","wpestate"),__("Sierra Leone","wpestate"),__("Singapore","wpestate"),__("Slovakia (Slovak Republic)","wpestate"),__("Slovenia","wpestate"),__("Solomon Islands","wpestate"),__("Somalia","wpestate"),__("South Africa","wpestate"),__("South Georgia and the South Sandwich Islands","wpestate"),__("Spain","wpestate"),__("Sri Lanka","wpestate"),__("St. Helena","wpestate"),__("St. Pierre and Miquelon","wpestate"),__("Sudan","wpestate"),__("Suriname","wpestate"),__("Svalbard and Jan Mayen Islands","wpestate"),__("Swaziland","wpestate"),__("Sweden","wpestate"),__("Switzerland","wpestate"),__("Syrian Arab Republic","wpestate"),__("Taiwan, Province of China","wpestate"),__("Tajikistan","wpestate"),__("Tanzania, United Republic of","wpestate"),__("Thailand","wpestate"),__("Togo","wpestate"),__("Tokelau","wpestate"),__("Tonga","wpestate"),__("Trinidad and Tobago","wpestate"),__("Tunisia","wpestate"),__("Turkey","wpestate"),__("Turkmenistan","wpestate"),__("Turks and Caicos Islands","wpestate"),__("Tuvalu","wpestate"),__("Uganda","wpestate"),__("Ukraine","wpestate"),__("United Arab Emirates","wpestate"),__("United Kingdom","wpestate"),__("United States","wpestate"),__("United States Minor Outlying Islands","wpestate"),__("Uruguay","wpestate"),__("Uzbekistan","wpestate"),__("Vanuatu","wpestate"),__("Venezuela","wpestate"),__("Vietnam","wpestate"),__("Virgin Islands (British)","wpestate"),__("Virgin Islands (U.S.)","wpestate"),__("Wallis and Futuna Islands","wpestate"),__("Western Sahara","wpestate"),__("Yemen","wpestate"),__("Zambia","wpestate"),__("Zimbabwe","wpestate"));
    
    
function fl_get_countries(){    
          
          $countries = array (
            "AF" => __("Afghanistan", 'car_share'),
            "AL" => __("Albania", 'car_share'),
            "DZ" => __("Algeria", 'car_share'),
            "AS" => __("American Samoa", 'car_share'),
            "AD" => __("Andorra", 'car_share'),
            "AO" => __("Angola", 'car_share'),
            "AI" => __("Anguilla", 'car_share'),
            "AQ" => __("Antarctica", 'car_share'),
            "AG" => __("Antigua and Barbuda", 'car_share'),
            "AR" => __("Argentina", 'car_share'),
            "AM" => __("Armenia", 'car_share'),
            "AW" => __("Aruba", 'car_share'),
            "AU" => __("Australia", 'car_share'),
            "AT" => __("Austria", 'car_share'),
            "AZ" => __("Azerbaijan", 'car_share'),
            "BS" => __("Bahamas", 'car_share'),
            "BH" => __("Bahrain", 'car_share'),
            "BD" => __("Bangladesh", 'car_share'),
            "BB" => __("Barbados", 'car_share'),
            "BY" => __("Belarus", 'car_share'),
            "BE" => __("Belgium", 'car_share'),
            "BZ" => __("Belize", 'car_share'),
            "BJ" => __("Benin", 'car_share'),
            "BM" => __("Bermuda", 'car_share'),
            "BT" => __("Bhutan", 'car_share'),
            "BO" => __("Bolivia", 'car_share'),
            "BA" => __("Bosnia and Herzegowina", 'car_share'),
            "BW" => __("Botswana", 'car_share'),
            "BV" => __("Bouvet Island", 'car_share'),
            "BR" => __("Brazil", 'car_share'),
            "IO" => __("British Indian Ocean Territory", 'car_share'),
            "BN" => __("Brunei Darussalam", 'car_share'),
            "BG" => __("Bulgaria", 'car_share'),
            "BF" => __("Burkina Faso", 'car_share'),
            "BI" => __("Burundi", 'car_share'),
            "KH" => __("Cambodia", 'car_share'),
            "CM" => __("Cameroon", 'car_share'),
            "CA" => __("Canada", 'car_share'),
            "CV" => __("Cape Verde", 'car_share'),
            "KY" => __("Cayman Islands", 'car_share'),
            "CF" => __("Central African Republic", 'car_share'),
            "TD" => __("Chad", 'car_share'),
            "CL" => __("Chile", 'car_share'),
            "CN" => __("China", 'car_share'),
            "CX" => __("Christmas Island", 'car_share'),
            "CC" => __("Cocos (Keeling) Islands", 'car_share'),
            "CO" => __("Colombia", 'car_share'),
            "KM" => __("Comoros", 'car_share'),
            "CG" => __("Congo", 'car_share'),
            "CD" => __("Congo, the Democratic Republic of the", 'car_share'),
            "CK" => __("Cook Islands", 'car_share'),
            "CR" => __("Costa Rica", 'car_share'),
            "CI" => __("Cote d'Ivoire", 'car_share'),
            "HR" => __("Croatia (Hrvatska)", 'car_share'),
            "CU" => __("Cuba", 'car_share'),
            "CY" => __("Cyprus", 'car_share'),
            "CZ" => __("Czech Republic", 'car_share'),
            "DK" => __("Denmark", 'car_share'),
            "DJ" => __("Djibouti", 'car_share'),
            "DM" => __("Dominica", 'car_share'),
            "DO" => __("Dominican Republic", 'car_share'),
            "TP" => __("East Timor", 'car_share'),
            "EC" => __("Ecuador", 'car_share'),
            "EG" => __("Egypt", 'car_share'),
            "SV" => __("El Salvador", 'car_share'),
            "GQ" => __("Equatorial Guinea", 'car_share'),
            "ER" => __("Eritrea", 'car_share'),
            "EE" => __("Estonia", 'car_share'),
            "ET" => __("Ethiopia", 'car_share'),
            "FK" => __("Falkland Islands (Malvinas)", 'car_share'),
            "FO" => __("Faroe Islands", 'car_share'),
            "FJ" => __("Fiji", 'car_share'),
            "FI" => __("Finland", 'car_share'),
            "FR" => __("France", 'car_share'),
            "FX" => __("France, Metropolitan", 'car_share'),
            "GF" => __("French Guiana", 'car_share'),
            "PF" => __("French Polynesia", 'car_share'),
            "TF" => __("French Southern Territories", 'car_share'),
            "GA" => __("Gabon", 'car_share'),
            "GM" => __("Gambia", 'car_share'),
            "GE" => __("Georgia", 'car_share'),
            "DE" => __("Germany", 'car_share'),
            "GH" => __("Ghana", 'car_share'),
            "GI" => __("Gibraltar", 'car_share'),
            "GR" => __("Greece", 'car_share'),
            "GL" => __("Greenland", 'car_share'),
            "GD" => __("Grenada", 'car_share'),
            "GP" => __("Guadeloupe", 'car_share'),
            "GU" => __("Guam", 'car_share'),
            "GT" => __("Guatemala", 'car_share'),
            "GN" => __("Guinea", 'car_share'),
            "GW" => __("Guinea-Bissau", 'car_share'),
            "GY" => __("Guyana", 'car_share'),
            "HT" => __("Haiti", 'car_share'),
            "HM" => __("Heard and Mc Donald Islands", 'car_share'),
            "VA" => __("Holy See (Vatican City State)", 'car_share'),
            "HN" => __("Honduras", 'car_share'),
            "HK" => __("Hong Kong", 'car_share'),
            "HU" => __("Hungary", 'car_share'),
            "IS" => __("Iceland", 'car_share'),
            "IN" => __("India", 'car_share'),
            "ID" => __("Indonesia", 'car_share'),
            "IR" => __("Iran (Islamic Republic of)", 'car_share'),
            "IQ" => __("Iraq", 'car_share'),
            "IE" => __("Ireland", 'car_share'),
            "IL" => __("Israel", 'car_share'),
            "IT" => __("Italy", 'car_share'),
            "JM" => __("Jamaica", 'car_share'),
            "JP" => __("Japan", 'car_share'),
            "JO" => __("Jordan", 'car_share'),
            "KZ" => __("Kazakhstan", 'car_share'),
            "KE" => __("Kenya", 'car_share'),
            "KI" => __("Kiribati", 'car_share'),
            "KP" => __("Korea, Democratic People's Republic of", 'car_share'),
            "KR" => __("Korea, Republic of", 'car_share'),
            "KW" => __("Kuwait", 'car_share'),
            "KG" => __("Kyrgyzstan", 'car_share'),
            "LA" => __("Lao People's Democratic Republic", 'car_share'),
            "LV" => __("Latvia", 'car_share'),
            "LB" => __("Lebanon", 'car_share'),
            "LS" => __("Lesotho", 'car_share'),
            "LR" => __("Liberia", 'car_share'),
            "LY" => __("Libyan Arab Jamahiriya", 'car_share'),
            "LI" => __("Liechtenstein", 'car_share'),
            "LT" => __("Lithuania", 'car_share'),
            "LU" => __("Luxembourg", 'car_share'),
            "MO" => __("Macau", 'car_share'),
            "MK" => __("Macedonia, The Former Yugoslav Republic of", 'car_share'),
            "MG" => __("Madagascar", 'car_share'),
            "MW" => __("Malawi", 'car_share'),
            "MY" => __("Malaysia", 'car_share'),
            "MV" => __("Maldives", 'car_share'),
            "ML" => __("Mali", 'car_share'),
            "MT" => __("Malta", 'car_share'),
            "MH" => __("Marshall Islands", 'car_share'),
            "MQ" => __("Martinique", 'car_share'),
            "MR" => __("Mauritania", 'car_share'),
            "MU" => __("Mauritius", 'car_share'),
            "YT" => __("Mayotte", 'car_share'),
            "MX" => __("Mexico", 'car_share'),
            "FM" => __("Micronesia, Federated States of", 'car_share'),
            "MD" => __("Moldova, Republic of", 'car_share'),
            "MC" => __("Monaco", 'car_share'),
            "MN" => __("Mongolia", 'car_share'),
            "MS" => __("Montserrat", 'car_share'),
            "MA" => __("Morocco", 'car_share'),
            "MZ" => __("Mozambique", 'car_share'),
            "MM" => __("Myanmar", 'car_share'),
            "NA" => __("Namibia", 'car_share'),
            "NR" => __("Nauru", 'car_share'),
            "NP" => __("Nepal", 'car_share'),
            "NL" => __("Netherlands", 'car_share'),
            "AN" => __("Netherlands Antilles", 'car_share'),
            "NC" => __("New Caledonia", 'car_share'),
            "NZ" => __("New Zealand", 'car_share'),
            "NI" => __("Nicaragua", 'car_share'),
            "NE" => __("Niger", 'car_share'),
            "NG" => __("Nigeria", 'car_share'),
            "NU" => __("Niue", 'car_share'),
            "NF" => __("Norfolk Island", 'car_share'),
            "MP" => __("Northern Mariana Islands", 'car_share'),
            "NO" => __("Norway", 'car_share'),
            "OM" => __("Oman", 'car_share'),
            "PK" => __("Pakistan", 'car_share'),
            "PW" => __("Palau", 'car_share'),
            "PA" => __("Panama", 'car_share'),
            "PG" => __("Papua New Guinea", 'car_share'),
            "PY" => __("Paraguay", 'car_share'),
            "PE" => __("Peru", 'car_share'),
            "PH" => __("Philippines", 'car_share'),
            "PN" => __("Pitcairn", 'car_share'),
            "PL" => __("Poland", 'car_share'),
            "PT" => __("Portugal", 'car_share'),
            "PR" => __("Puerto Rico", 'car_share'),
            "QA" => __("Qatar", 'car_share'),
            "RE" => __("Reunion", 'car_share'),
            "RO" => __("Romania", 'car_share'),
            "RU" => __("Russian Federation", 'car_share'),
            "RW" => __("Rwanda", 'car_share'),
            "KN" => __("Saint Kitts and Nevis", 'car_share'),
            "LC" => __("Saint LUCIA", 'car_share'),
            "VC" => __("Saint Vincent and the Grenadines", 'car_share'),
            "WS" => __("Samoa", 'car_share'),
            "SM" => __("San Marino", 'car_share'),
            "ST" => __("Sao Tome and Principe", 'car_share'),
            "SA" => __("Saudi Arabia", 'car_share'),
            "SN" => __("Senegal", 'car_share'),
            "SC" => __("Seychelles", 'car_share'),
            "SL" => __("Sierra Leone", 'car_share'),
            "SG" => __("Singapore", 'car_share'),
            "SK" => __("Slovakia (Slovak Republic)", 'car_share'),
            "SI" => __("Slovenia", 'car_share'),
            "SB" => __("Solomon Islands", 'car_share'),
            "SO" => __("Somalia", 'car_share'),
            "ZA" => __("South Africa", 'car_share'),
            "GS" => __("South Georgia and the South Sandwich Islands", 'car_share'),
            "ES" => __("Spain", 'car_share'),
            "LK" => __("Sri Lanka", 'car_share'),
            "SH" => __("St. Helena", 'car_share'),
            "PM" => __("St. Pierre and Miquelon", 'car_share'),
            "SD" => __("Sudan", 'car_share'),
            "SR" => __("Suriname", 'car_share'),
            "SJ" => __("Svalbard and Jan Mayen Islands", 'car_share'),
            "SZ" => __("Swaziland", 'car_share'),
            "SE" => __("Sweden", 'car_share'),
            "CH" => __("Switzerland", 'car_share'),
            "SY" => __("Syrian Arab Republic", 'car_share'),
            "TW" => __("Taiwan, Province of China", 'car_share'),
            "TJ" => __("Tajikistan", 'car_share'),
            "TZ" => __("Tanzania, United Republic of", 'car_share'),
            "TH" => __("Thailand", 'car_share'),
            "TG" => __("Togo", 'car_share'),
            "TK" => __("Tokelau", 'car_share'),
            "TO" => __("Tonga", 'car_share'),
            "TT" => __("Trinidad and Tobago", 'car_share'),
            "TN" => __("Tunisia", 'car_share'),
            "TR" => __("Turkey", 'car_share'),
            "TM" => __("Turkmenistan", 'car_share'),
            "TC" => __("Turks and Caicos Islands", 'car_share'),
            "TV" => __("Tuvalu", 'car_share'),
            "UG" => __("Uganda", 'car_share'),
            "UA" => __("Ukraine", 'car_share'),
            "AE" => __("United Arab Emirates", 'car_share'),
            "GB" => __("United Kingdom", 'car_share'),
            "US" => __("United States", 'car_share'),
            "UM" => __("United States Minor Outlying Islands", 'car_share'),
            "UY" => __("Uruguay", 'car_share'),
            "UZ" => __("Uzbekistan", 'car_share'),
            "VU" => __("Vanuatu", 'car_share'),
            "VE" => __("Venezuela", 'car_share'),
            "VN" => __("Viet Nam", 'car_share'),
            "VG" => __("Virgin Islands (British)", 'car_share'),
            "VI" => __("Virgin Islands (U.S.)", 'car_share'),
            "WF" => __("Wallis and Futuna Islands", 'car_share'),
            "EH" => __("Western Sahara", 'car_share'),
            "YE" => __("Yemen", 'car_share'),
            "YU" => __("Yugoslavia", 'car_share'),
            "ZM" => __("Zambia", 'car_share'),
            "ZW" => __("Zimbabwe", 'car_share')
    );
    
    return $countries;
    
    /*
    global $wpdb;
    $sql = "SELECT * FROM fl_country WHERE active = 1 ORDER BY name ASC";
    $result = $wpdb->get_results($sql);
    return $result;
    */    
}    
    
    


function fl_get_house_skills() {
    global $wpdb;
    $sql = "SELECT * FROM fl_skill_user ORDER BY position ASC";
    $result = $wpdb->get_results($sql);
    return $result;
}

function fl_get_user_house_skills($id_user) {
    global $wpdb;
    $sql = "SELECT * FROM fl_skill_user AS su JOIN fl_skill2user AS s2u ON su.id_skill = s2u.id_skill WHERE id_user = '" . (int) $id_user . "'";
    $result = $wpdb->get_results($sql);
    return $result;
}

function fl_get_user_house_skill_ids($id_user) {
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

function fl_update_user_language($user_id, $languages) {
    global $wpdb;

    $sql = "DELETE FROM fl_language2user WHERE id_user = '" . (int) $user_id . "'";
    $wpdb->query($sql);

    if (!empty($languages)) {
        foreach ($languages as $lang) {
            $sql = "INSERT INTO fl_language2user (id_user, id_lang) VALUES ('" . (int) $user_id . "', '" . (int) $lang . "')";
            $wpdb->query($sql);
        }
    }
}

function fl_update_user_skill($user_id, $skills) {
    global $wpdb;

    $sql = "DELETE FROM fl_skill2user WHERE id_user = '" . (int) $user_id . "'";
    $wpdb->query($sql);

    if (!empty($skills)) {
        foreach ($skills as $skill) {
            $sql = "INSERT INTO fl_skill2user (id_user, id_skill) VALUES ('" . (int) $user_id . "', '" . (int) $skill . "')";
            $wpdb->query($sql);
        }
    }
}

//
function get_user_meta_int($user_id, $meta_key) {
    global $wpdb;
    $sql = "SELECT meta_value FROM fl_user_meta_int WHERE id_user = '" . (int) $user_id . "' AND meta_key = '" . esc_sql($meta_key) . "'";
    $result = $wpdb->get_var($sql);
    return $result;
}

function update_user_meta_int($user_id, $meta_key, $meta_value) {
    global $wpdb;
    $sql = "REPLACE INTO fl_user_meta_int (id_user, meta_key, meta_value) VALUES ('" . (int) $user_id . "', '" . esc_sql($meta_key) . "', '" . esc_sql($meta_value) . "') ";
    $result = $wpdb->query($sql);
    return $result;
}

function delete_user_meta_int($user_id, $meta_key) {
    global $wpdb;
    $sql = "DELETE FROM fl_user_meta_int WHERE id_user = '" . (int) $user_id . "' AND meta_key = '" . esc_sql($meta_key) . "' LIMIT 1";
    $result = $wpdb->query($sql);
    return $result;
}

function get_fl_data($user_id) {
    global $wpdb;
    $sql = "SELECT * FROM fl_user_data WHERE id_user = '" . (int) $user_id . "'";
    $result = $wpdb->get_row($sql);
    return $result;
}
