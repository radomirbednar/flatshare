
<?php
// Template Name: Users list
// Wp Estate Pack

get_header();
wp_suspend_cache_addition(true);
$options = wpestate_page_details($post->ID);
$col_class = 4; 
if ($options['content_class'] == 'col-md-12') {
    $col_class = 3;
}
?> 
<div class="row">
    <?php get_template_part('templates/breadcrumbs'); ?>
    <div class=" <?php print $options['content_class']; ?> ">
        <?php get_template_part('templates/ajax_container'); ?>
        <?php
        while (have_posts()) : the_post();
            if (esc_html(get_post_meta($post->ID, 'page_show_title', true)) != 'no') {
                ?>
                <h1 class="entry-title"><?php the_title(); ?></h1>
            <?php } ?>
            <div class="single-content"><?php the_content(); ?></div>
            <?php
        endwhile;
        ?>
        <div id="listing_ajax_container_agent">

            <?php
            //$number = 10;
            $total_query = 12;
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $offset = ($paged - 1) * $total_query;

            /*
              $users = get_users();
              $query = get_users('&offset=' . $offset . '&number=' . $number);
              $total_users = count($users);
              $total_query = count($query);
              $total_pages = intval($total_users / $number) + 1;
             */
            //$how_long = get_user_meta_int($userID, 'how_long');

            $user_status = !empty($_GET['status']) ? (array) $_GET['status'] : array(1, 2);
            $how_long = !empty($_GET['how_long']) ? $_GET['how_long'] : '';
            $age_from = !empty($_GET['age_low']) ? $_GET['age_low'] : 0;
            $age_to = !empty($_GET['age_max']) ? $_GET['age_max'] : '';
            $user_gender = !empty($_GET['user_gender']) ? $_GET['user_gender'] : '';
            $sexual_preference = !empty($_GET['sexual_preference']) ? $_GET['sexual_preference'] : '';
            $sleeping_span = !empty($_GET['sleeping_span']) ? $_GET['sleeping_span'] : '';
            $couple = !empty($_GET['couple']) ? $_GET['couple'] : '';
            $smoker = !empty($_GET['smoker']) ? $_GET['smoker'] : '';
            $pets = !empty($_GET['pets']) ? $_GET['pets'] : '';
            $activity = !empty($_GET['activity']) ? $_GET['activity'] : '';
            $user_origin = !empty($_GET['origin']) ? $_GET['origin'] : '';
            $party = !empty($_GET['party']) ? $_GET['party'] : '';
            $looking_where = !empty($_GET['looking_where']) ? $_GET['looking_where'] : '';
            $user_skill_ids = !empty($_GET['skill']) ? $_GET['skill'] : '';
            $user_language_ids = !empty($_GET['language']) ? $_GET['language'] : '';

            $rent_low = !empty($_GET['rent_low']) ? $_GET['rent_low'] : '';
            $rent_max = !empty($_GET['rent_max']) ? $_GET['rent_max'] : '';

            $disponibility = !empty($_GET['disponibility']) ? DATETIME::createFromFormat(PHP_DATEPICKER_FORMAT, $_GET['disponibility']) : '';

            /**
             *
             */
            $sql = "
                SELECT SQL_CALC_FOUND_ROWS
                    *
                FROM
                    " . $wpdb->prefix . "users AS u
                JOIN
                    fl_user_data as fud
                ON
                    fud.id_user = u.ID ";

            if (!empty($user_skill_ids)) {

                array_walk($user_skill_ids, 'esc_sql');

                $sql .= "
                    JOIN
                        fl_skill2user AS f2u
                    ON
                        f2u.id_user = u.ID
                    AND
                        f2u.id_skill IN (" . implode(',', $user_skill_ids) . ")
                ";
            }

            if (!empty($user_language_ids)) {

                array_walk($user_language_ids, 'esc_sql');

                $sql .= "
                    JOIN
                        fl_language2user AS l2u
                    ON
                        l2u.id_user = u.ID
                    AND
                        l2u.id_lang IN (" . implode(',', $user_language_ids) . ")
                ";
            }

            $sql .= " WHERE fud.user_status IN (" . implode(',', $user_status) . ") ";

            if (!empty($age_to)) {
                $sql .= " AND birthdate BETWEEN DATE_SUB(CURDATE(), INTERVAL " . (int) $age_to . " YEAR) AND DATE_SUB(CURDATE(), INTERVAL " . (int) $age_from . " YEAR) AND birthdate IS NOT NULL ";
            }

            if (!empty($user_gender)) {
                $sql .= " AND user_gender = '" . (int) $user_gender . "' ";
            }

            if (!empty($status)) {
                $sql .= " AND user_status = '" . (int) $user_status . "' ";
            }

            if (!empty($how_long)) {
                $sql .= " AND how_long = '" . (int) $how_long . "' ";
            }

            if (!empty($sexual_preference)) {
                $sql .= " AND sexual_preference = '" . (int) $sexual_preference . "' ";
            }

            if (!empty($sleeping_span)) {
                $sql .= " AND sleeping_span = '" . (int) $sleeping_span . "' ";
            }

            if (!empty($couple)) {
                $sql .= " AND couple = '" . (int) $couple . "' ";
            }

            if (!empty($smoker)) {
                $sql .= " AND smoker = '" . (int) $smoker . "' ";
            }

            if (!empty($pets)) {
                $sql .= " AND pets = '" . (int) $pets . "' ";
            }

            if (!empty($activity)) {
                $sql .= " AND activity = '" . (int) $activity . "' ";
            }

            if (!empty($user_origin)) {
                $sql .= " AND user_origin = '" . esc_sql($user_origin) . "' ";
            }

            if (!empty($party)) {
                $sql .= " AND party = '" . (int) $party . "' ";
            }

            if (!empty($disponibility)) {
                $sql .= " AND disponibility >= '" . $disponibility->format("Y-m-d") . "' AND disponibility IS NOT NULL ";
            }

            if (!empty($looking_where)) {
                $sql .= " AND looking_where = '" . esc_sql($looking_where) . "' ";
            }

            if (!empty($rent_max)) {
                $sql .= " AND rent_amount BETWEEN " . (int) $rent_low . " AND " . (int) $rent_max;
            }

            $sql .= " GROUP BY u.ID ";

            $sql .= " LIMIT " . (int) $offset . ", " . (int) $total_query;

            global $wpdb;

            $query = $wpdb->get_results($sql);

            $total_users = $wpdb->get_var("SELECT FOUND_ROWS() cnt");
            $total_pages = ceil($total_users / $total_query);

            $currency = esc_html(get_option('wp_estate_currency_symbol', ''));
            $where_currency = esc_html(get_option('wp_estate_where_currency_symbol', ''));

            foreach ($query as $q) {

                $fl_user_data = get_fl_data($q->ID); 
                $first_name = esc_attr(get_the_author_meta('first_name', $q->ID));
                $last_name = esc_attr(get_the_author_meta('last_name', $q->ID));
                $user_facebook = get_the_author_meta('facebook', $q->ID); 
                $photo_url = get_the_author_meta('custom_picture', $q->ID);

                $user_gender = !empty($fl_user_data->user_gender) ? $fl_user_data->user_gender : '';
                $user_age = !empty($fl_user_data->user_age) ? $fl_user_data->user_age : '';
                $looking_where = !empty($fl_user_data->looking_where) ? $fl_user_data->looking_where : '';

                $rent_amount = !empty($fl_user_data->rent_amount) ? $fl_user_data->rent_amount : '';

                $user_gender_array = array(
                    '2' => __('female', 'wpestate'),
                    '1' => __('male', 'wpestate')
                );
                
                
                $looking_for = !empty($fl_user_data->looking_for) ? $fl_user_data->looking_for : '';
                $looking_for_array = array(    
                '1' => array(
                    '<i class="icon-icon_roommate"></i>',
                    __('roomate', 'wpestate'))
                ,
                '2' => array(
                    '<i class="icon-icon_flat"> </i>',
                    __('flat', 'wpestate')  
                )
                );
                

                $author_url = esc_url(get_author_posts_url($q->ID));

                $thumb_prop = '<img src="' . $photo_url . '" alt="agent-images">';
                if ($photo_url == '') {
                    $thumb_prop = '<img src="' . get_template_directory_uri() . '/img/default_user.png" alt="agent-images">';
                }
                ?> 
                <?php  
                    include( trailingslashit( get_template_directory() ). 'libs/user_unit.php' );
                ?> 
                <?php
            }
            ?> 
            <?php if ($total_users > $total_query): ?>
                <div class="col-xs-12">
                    <?php
                    $current_page = max(1, get_query_var('paged'));
                    $query_args = (array) $_GET;
                    $args = array(
                        //'base' => get_pagenum_link(1) . '%_%',
                        //'base'          => get_page_link(get_the_ID()),
                        'base' => preg_replace('/\?.*/', '/', get_pagenum_link(1)) . '%_%',
                        'format' => 'page/%#%/',
                        'current' => $current_page,
                        'total' => $total_pages,
                        'prev_next' => false,
                        'type' => 'array',
                        'add_args' => $_GET
                    );

                    $pages = paginate_links($args);

                    if (is_array($pages)) {
                        $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
                        echo '<div class="pagination-wrap"><ul class="pagination">';
                        foreach ($pages as $key => $page) {
                            $class = $current_page == $key + 1 ? ' class="active" ' : '';
                            echo "<li " . $class . ">$page</li>";
                        }
                        echo '</ul></div>';
                    }
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div><!-- end 12 container-->
    <?php
    wp_suspend_cache_addition(false);
    ?>
</div>
<?php
get_footer();
