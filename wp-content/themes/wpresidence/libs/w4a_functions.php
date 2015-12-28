<?php

DEFINE('MAX_RENT', 1200);

function fl_update_user_data($userID, $data) {

    $when_move = null;
    if (isset($data['when_move'])) {
        $when_move = DateTime::createFromFormat(PHP_DATEPICKER_FORMAT, $data['when_move']);
    }

    $birthdate = null;
    if (isset($data['birthdate'])) {
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
                " . (empty($birthdate) ? 'NULL' : "\"" . $birthdate->format('Y-m-d') . "\"") . ",
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
                " . (empty($when_move) ? 'NULL' : "\"" . $when_move->format('Y-m-d') . "\"") . "
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


function fl_get_countries() {

    $countries = array(
        "AF" => __("Afghanistan", 'wpestate'),
        "AL" => __("Albania", 'wpestate'),
        "DZ" => __("Algeria", 'wpestate'),
        "AS" => __("American Samoa", 'wpestate'),
        "AD" => __("Andorra", 'wpestate'),
        "AO" => __("Angola", 'wpestate'),
        "AI" => __("Anguilla", 'wpestate'),
        "AQ" => __("Antarctica", 'wpestate'),
        "AG" => __("Antigua and Barbuda", 'wpestate'),
        "AR" => __("Argentina", 'wpestate'),
        "AM" => __("Armenia", 'wpestate'),
        "AW" => __("Aruba", 'wpestate'),
        "AU" => __("Australia", 'wpestate'),
        "AT" => __("Austria", 'wpestate'),
        "AZ" => __("Azerbaijan", 'wpestate'),
        "BS" => __("Bahamas", 'wpestate'),
        "BH" => __("Bahrain", 'wpestate'),
        "BD" => __("Bangladesh", 'wpestate'),
        "BB" => __("Barbados", 'wpestate'),
        "BY" => __("Belarus", 'wpestate'),
        "BE" => __("Belgium", 'wpestate'),
        "BZ" => __("Belize", 'wpestate'),
        "BJ" => __("Benin", 'wpestate'),
        "BM" => __("Bermuda", 'wpestate'),
        "BT" => __("Bhutan", 'wpestate'),
        "BO" => __("Bolivia", 'wpestate'),
        "BA" => __("Bosnia and Herzegowina", 'wpestate'),
        "BW" => __("Botswana", 'wpestate'),
        "BV" => __("Bouvet Island", 'wpestate'),
        "BR" => __("Brazil", 'wpestate'),
        "IO" => __("British Indian Ocean Territory", 'wpestate'),
        "BN" => __("Brunei Darussalam", 'wpestate'),
        "BG" => __("Bulgaria", 'wpestate'),
        "BF" => __("Burkina Faso", 'wpestate'),
        "BI" => __("Burundi", 'wpestate'),
        "KH" => __("Cambodia", 'wpestate'),
        "CM" => __("Cameroon", 'wpestate'),
        "CA" => __("Canada", 'wpestate'),
        "CV" => __("Cape Verde", 'wpestate'),
        "KY" => __("Cayman Islands", 'wpestate'),
        "CF" => __("Central African Republic", 'wpestate'),
        "TD" => __("Chad", 'wpestate'),
        "CL" => __("Chile", 'wpestate'),
        "CN" => __("China", 'wpestate'),
        "CX" => __("Christmas Island", 'wpestate'),
        "CC" => __("Cocos (Keeling) Islands", 'wpestate'),
        "CO" => __("Colombia", 'wpestate'),
        "KM" => __("Comoros", 'wpestate'),
        "CG" => __("Congo", 'wpestate'),
        "CD" => __("Congo, the Democratic Republic of the", 'wpestate'),
        "CK" => __("Cook Islands", 'wpestate'),
        "CR" => __("Costa Rica", 'wpestate'),
        "CI" => __("Cote d'Ivoire", 'wpestate'),
        "HR" => __("Croatia (Hrvatska)", 'wpestate'),
        "CU" => __("Cuba", 'wpestate'),
        "CY" => __("Cyprus", 'wpestate'),
        "CZ" => __("Czech Republic", 'wpestate'),
        "DK" => __("Denmark", 'wpestate'),
        "DJ" => __("Djibouti", 'wpestate'),
        "DM" => __("Dominica", 'wpestate'),
        "DO" => __("Dominican Republic", 'wpestate'),
        "TP" => __("East Timor", 'wpestate'),
        "EC" => __("Ecuador", 'wpestate'),
        "EG" => __("Egypt", 'wpestate'),
        "SV" => __("El Salvador", 'wpestate'),
        "GQ" => __("Equatorial Guinea", 'wpestate'),
        "ER" => __("Eritrea", 'wpestate'),
        "EE" => __("Estonia", 'wpestate'),
        "ET" => __("Ethiopia", 'wpestate'),
        "FK" => __("Falkland Islands (Malvinas)", 'wpestate'),
        "FO" => __("Faroe Islands", 'wpestate'),
        "FJ" => __("Fiji", 'wpestate'),
        "FI" => __("Finland", 'wpestate'),
        "FR" => __("France", 'wpestate'),
        "FX" => __("France, Metropolitan", 'wpestate'),
        "GF" => __("French Guiana", 'wpestate'),
        "PF" => __("French Polynesia", 'wpestate'),
        "TF" => __("French Southern Territories", 'wpestate'),
        "GA" => __("Gabon", 'wpestate'),
        "GM" => __("Gambia", 'wpestate'),
        "GE" => __("Georgia", 'wpestate'),
        "DE" => __("Germany", 'wpestate'),
        "GH" => __("Ghana", 'wpestate'),
        "GI" => __("Gibraltar", 'wpestate'),
        "GR" => __("Greece", 'wpestate'),
        "GL" => __("Greenland", 'wpestate'),
        "GD" => __("Grenada", 'wpestate'),
        "GP" => __("Guadeloupe", 'wpestate'),
        "GU" => __("Guam", 'wpestate'),
        "GT" => __("Guatemala", 'wpestate'),
        "GN" => __("Guinea", 'wpestate'),
        "GW" => __("Guinea-Bissau", 'wpestate'),
        "GY" => __("Guyana", 'wpestate'),
        "HT" => __("Haiti", 'wpestate'),
        "HM" => __("Heard and Mc Donald Islands", 'wpestate'),
        "VA" => __("Holy See (Vatican City State)", 'wpestate'),
        "HN" => __("Honduras", 'wpestate'),
        "HK" => __("Hong Kong", 'wpestate'),
        "HU" => __("Hungary", 'wpestate'),
        "IS" => __("Iceland", 'wpestate'),
        "IN" => __("India", 'wpestate'),
        "ID" => __("Indonesia", 'wpestate'),
        "IR" => __("Iran (Islamic Republic of)", 'wpestate'),
        "IQ" => __("Iraq", 'wpestate'),
        "IE" => __("Ireland", 'wpestate'),
        "IL" => __("Israel", 'wpestate'),
        "IT" => __("Italy", 'wpestate'),
        "JM" => __("Jamaica", 'wpestate'),
        "JP" => __("Japan", 'wpestate'),
        "JO" => __("Jordan", 'wpestate'),
        "KZ" => __("Kazakhstan", 'wpestate'),
        "KE" => __("Kenya", 'wpestate'),
        "KI" => __("Kiribati", 'wpestate'),
        "KP" => __("Korea, Democratic People's Republic of", 'wpestate'),
        "KR" => __("Korea, Republic of", 'wpestate'),
        "KW" => __("Kuwait", 'wpestate'),
        "KG" => __("Kyrgyzstan", 'wpestate'),
        "LA" => __("Lao People's Democratic Republic", 'wpestate'),
        "LV" => __("Latvia", 'wpestate'),
        "LB" => __("Lebanon", 'wpestate'),
        "LS" => __("Lesotho", 'wpestate'),
        "LR" => __("Liberia", 'wpestate'),
        "LY" => __("Libyan Arab Jamahiriya", 'wpestate'),
        "LI" => __("Liechtenstein", 'wpestate'),
        "LT" => __("Lithuania", 'wpestate'),
        "LU" => __("Luxembourg", 'wpestate'),
        "MO" => __("Macau", 'wpestate'),
        "MK" => __("Macedonia, The Former Yugoslav Republic of", 'wpestate'),
        "MG" => __("Madagascar", 'wpestate'),
        "MW" => __("Malawi", 'wpestate'),
        "MY" => __("Malaysia", 'wpestate'),
        "MV" => __("Maldives", 'wpestate'),
        "ML" => __("Mali", 'wpestate'),
        "MT" => __("Malta", 'wpestate'),
        "MH" => __("Marshall Islands", 'wpestate'),
        "MQ" => __("Martinique", 'wpestate'),
        "MR" => __("Mauritania", 'wpestate'),
        "MU" => __("Mauritius", 'wpestate'),
        "YT" => __("Mayotte", 'wpestate'),
        "MX" => __("Mexico", 'wpestate'),
        "FM" => __("Micronesia, Federated States of", 'wpestate'),
        "MD" => __("Moldova, Republic of", 'wpestate'),
        "MC" => __("Monaco", 'wpestate'),
        "MN" => __("Mongolia", 'wpestate'),
        "MS" => __("Montserrat", 'wpestate'),
        "MA" => __("Morocco", 'wpestate'),
        "MZ" => __("Mozambique", 'wpestate'),
        "MM" => __("Myanmar", 'wpestate'),
        "NA" => __("Namibia", 'wpestate'),
        "NR" => __("Nauru", 'wpestate'),
        "NP" => __("Nepal", 'wpestate'),
        "NL" => __("Netherlands", 'wpestate'),
        "AN" => __("Netherlands Antilles", 'wpestate'),
        "NC" => __("New Caledonia", 'wpestate'),
        "NZ" => __("New Zealand", 'wpestate'),
        "NI" => __("Nicaragua", 'wpestate'),
        "NE" => __("Niger", 'wpestate'),
        "NG" => __("Nigeria", 'wpestate'),
        "NU" => __("Niue", 'wpestate'),
        "NF" => __("Norfolk Island", 'wpestate'),
        "MP" => __("Northern Mariana Islands", 'wpestate'),
        "NO" => __("Norway", 'wpestate'),
        "OM" => __("Oman", 'wpestate'),
        "PK" => __("Pakistan", 'wpestate'),
        "PW" => __("Palau", 'wpestate'),
        "PA" => __("Panama", 'wpestate'),
        "PG" => __("Papua New Guinea", 'wpestate'),
        "PY" => __("Paraguay", 'wpestate'),
        "PE" => __("Peru", 'wpestate'),
        "PH" => __("Philippines", 'wpestate'),
        "PN" => __("Pitcairn", 'wpestate'),
        "PL" => __("Poland", 'wpestate'),
        "PT" => __("Portugal", 'wpestate'),
        "PR" => __("Puerto Rico", 'wpestate'),
        "QA" => __("Qatar", 'wpestate'),
        "RE" => __("Reunion", 'wpestate'),
        "RO" => __("Romania", 'wpestate'),
        "RU" => __("Russian Federation", 'wpestate'),
        "RW" => __("Rwanda", 'wpestate'),
        "KN" => __("Saint Kitts and Nevis", 'wpestate'),
        "LC" => __("Saint LUCIA", 'wpestate'),
        "VC" => __("Saint Vincent and the Grenadines", 'wpestate'),
        "WS" => __("Samoa", 'wpestate'),
        "SM" => __("San Marino", 'wpestate'),
        "ST" => __("Sao Tome and Principe", 'wpestate'),
        "SA" => __("Saudi Arabia", 'wpestate'),
        "SN" => __("Senegal", 'wpestate'),
        "SC" => __("Seychelles", 'wpestate'),
        "SL" => __("Sierra Leone", 'wpestate'),
        "SG" => __("Singapore", 'wpestate'),
        "SK" => __("Slovakia (Slovak Republic)", 'wpestate'),
        "SI" => __("Slovenia", 'wpestate'),
        "SB" => __("Solomon Islands", 'wpestate'),
        "SO" => __("Somalia", 'wpestate'),
        "ZA" => __("South Africa", 'wpestate'),
        "GS" => __("South Georgia and the South Sandwich Islands", 'wpestate'),
        "ES" => __("Spain", 'wpestate'),
        "LK" => __("Sri Lanka", 'wpestate'),
        "SH" => __("St. Helena", 'wpestate'),
        "PM" => __("St. Pierre and Miquelon", 'wpestate'),
        "SD" => __("Sudan", 'wpestate'),
        "SR" => __("Suriname", 'wpestate'),
        "SJ" => __("Svalbard and Jan Mayen Islands", 'wpestate'),
        "SZ" => __("Swaziland", 'wpestate'),
        "SE" => __("Sweden", 'wpestate'),
        "CH" => __("Switzerland", 'wpestate'),
        "SY" => __("Syrian Arab Republic", 'wpestate'),
        "TW" => __("Taiwan, Province of China", 'wpestate'),
        "TJ" => __("Tajikistan", 'wpestate'),
        "TZ" => __("Tanzania, United Republic of", 'wpestate'),
        "TH" => __("Thailand", 'wpestate'),
        "TG" => __("Togo", 'wpestate'),
        "TK" => __("Tokelau", 'wpestate'),
        "TO" => __("Tonga", 'wpestate'),
        "TT" => __("Trinidad and Tobago", 'wpestate'),
        "TN" => __("Tunisia", 'wpestate'),
        "TR" => __("Turkey", 'wpestate'),
        "TM" => __("Turkmenistan", 'wpestate'),
        "TC" => __("Turks and Caicos Islands", 'wpestate'),
        "TV" => __("Tuvalu", 'wpestate'),
        "UG" => __("Uganda", 'wpestate'),
        "UA" => __("Ukraine", 'wpestate'),
        "AE" => __("United Arab Emirates", 'wpestate'),
        "GB" => __("United Kingdom", 'wpestate'),
        "US" => __("United States", 'wpestate'),
        "UM" => __("United States Minor Outlying Islands", 'wpestate'),
        "UY" => __("Uruguay", 'wpestate'),
        "UZ" => __("Uzbekistan", 'wpestate'),
        "VU" => __("Vanuatu", 'wpestate'),
        "VE" => __("Venezuela", 'wpestate'),
        "VN" => __("Viet Nam", 'wpestate'),
        "VG" => __("Virgin Islands (British)", 'wpestate'),
        "VI" => __("Virgin Islands (U.S.)", 'wpestate'),
        "WF" => __("Wallis and Futuna Islands", 'wpestate'),
        "EH" => __("Western Sahara", 'wpestate'),
        "YE" => __("Yemen", 'wpestate'),
        "YU" => __("Yugoslavia", 'wpestate'),
        "ZM" => __("Zambia", 'wpestate'),
        "ZW" => __("Zimbabwe", 'wpestate')
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

function fl_cut_description($description) {
    preg_match('/^([^.!?]*[\.!?]+){0,2}/', strip_tags($description), $abstract);

    if ($abstract[0] != "") {
        $description = $abstract[0];
    } else {
        $description = wp_trim_words($description, $num_words = 12, $more = null);
    }

    return $description;
}
