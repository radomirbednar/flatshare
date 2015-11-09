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
            $number = 10;
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $offset = ($paged - 1) * $number;
            $users = get_users();
            $query = get_users('&offset=' . $offset . '&number=' . $number);
            $total_users = count($users);
            $total_query = count($query);
            $total_pages = intval($total_users / $number) + 1;

            //get_user_meta() vs. get_userdata() vs. get_the_author_meta() - place for improvement


            foreach ($query as $q) {

                $first_name = get_the_author_meta('first_name', $q->ID);
                $last_name = get_the_author_meta('last_name', $q->ID);
                $user_facebook = get_the_author_meta('facebook', $q->ID);
                $user_twitter = get_the_author_meta('twitter', $q->ID);
                $user_linkedin = get_the_author_meta('linkedin', $q->ID);
                $user_pinterest = get_the_author_meta('pinterest', $q->ID);
                $photo_url = get_the_author_meta('custom_picture', $q->ID);
                $user_gender = get_user_meta_int($q->ID, 'user_gender');
                $user_age = get_user_meta_int($q->ID, 'user_age');
                $looking_where = get_user_meta($q->ID, 'looking_where', true);
                $user_gender_array = array('1' => __('female', 'wpestate'), '2' => __('male', 'wpestate'));
                $thumb_prop = '<img src="' . $photo_url . '" alt="agent-images">';


                if ($photo_url == '') {
                    $thumb_prop = '<img src="' . get_template_directory_uri() . '/img/default_user.png" alt="agent-images">';
                }
                ?>

                <div class="col-md-3 listing_wrapper">
                    <div class="agent_unit" data-link="<?php print $link; ?>"> 

                        <div class="agent-unit-img-wrapper">
                            <?php
                            print $thumb_prop;
                            print '<div class="listing-cover"></div>
                   <a href="' . $link . '"> <span class="listing-cover-plus">+</span></a>';
                            ?>
                        </div>  

                        <div class="user_unit_info"> 
                            <?php
                            print '<h4> <a href="' . $link . '">' . $first_name . ' ' . $last_name . '</a></h4>                                
                            <div class="agent_position">' . $looking_where . '</div>';
                            if ($user_age) {
                                print '<div class="agent_detail">' . __('Age', 'wpestate') . ': ' . $user_age . '</div>';
                            } 
                            if ($user_gender) { 
                                print '<img src="' . get_bloginfo('template_url') . '/img/' . $user_gender_array[$user_gender] . '.png" class="user_gender_image">';
                            }
                            ?> 
                        </div>  

                        <div class="agent_unit_social">
                            <div class="social-wrapper"> 

                                <?php
                                if ($user_facebook != '') {
                                    print ' <a href="' . $user_facebook . '"><i class="fa fa-facebook"></i></a>';
                                }

                                if ($user_twitter != '') {
                                    print ' <a href="' . $user_twitter . '"><i class="fa fa-twitter"></i></a>';
                                }

                                if ($user_linkedin != '') {
                                    print ' <a href="' . $user_linkedin . '"><i class="fa fa-linkedin"></i></a>';
                                }

                                if ($user_pinterest != '') {
                                    print ' <a href="' . $user_pinterest . '"><i class="fa fa-pinterest"></i></a>';
                                }
                                ?>

                            </div>
                        </div>
                    </div> 
                </div> 
                <?php
            }
            ?>

            <?php
            if ($total_users > $total_query) {

                $current_page = max(1, get_query_var('paged'));
                $pages = paginate_links(array(
                    'base' => get_pagenum_link(1) . '%_%',
                    'format' => 'page/%#%/',
                    'current' => $current_page,
                    'total' => $total_pages,
                    'prev_next' => false,
                    'type' => 'array',
                ));

                if (is_array($pages)) {
                    $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
                    echo '<div class="pagination-wrap"><ul class="pagination">';
                    foreach ($pages as $page) {
                        echo "<li>$page</li>";
                    }
                    echo '</ul></div>';
                }
            }
            ?>          
        </div>
    </div><!-- end 12 container--> 
    <?php
    wp_suspend_cache_addition(false);
    ?>
</div>   
<?php get_footer(); ?>