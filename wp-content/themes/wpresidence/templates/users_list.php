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

            foreach ($query as $q) {


                $first_name = get_the_author_meta('first_name', $q->ID);
                $last_name = get_the_author_meta('last_name', $q->ID);
                $user_email = get_the_author_meta('user_email', $q->ID);
                $user_mobile = get_the_author_meta('mobile', $q->ID);
                $user_phone = get_the_author_meta('phone', $q->ID);
                $description = get_the_author_meta('description', $q->ID);


                $user_facebook = get_the_author_meta('facebook', $q->ID);
                $user_twitter = get_the_author_meta('twitter', $q->ID);
                $user_linkedin = get_the_author_meta('linkedin', $q->ID);
                $user_pinterest = get_the_author_meta('pinterest', $q->ID);
                $user_skype = get_the_author_meta('skype', $q->ID); 
                $user_website = get_the_author_meta('website', $q->ID); 
                $photo_url = get_the_author_meta('custom_picture', $q->ID);
 
                
                
                
                //echo get_avatar($q->ID, 80);   
                /*
                  $extra = array(
                  'data-original' => $preview[0],
                  'class' => 'lazyload img-responsive',
                  );
                  $thumb_prop = get_the_post_thumbnail($post->ID, 'property_listings', $extra);
                 */ 
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

                        <div class="">
                            <?php
                            print '<h4> <a href="' . $link . '">' . $name . '</a></h4>
            <div class="agent_position">' . $agent_posit . '</div>';

                            if ($agent_phone) {
                                print '<div class="agent_detail"><i class="fa fa-phone"></i>' . $agent_phone . '</div>';
                            }
                            if ($agent_mobile) {
                                print '<div class="agent_detail"><i class="fa fa-mobile"></i>' . $agent_mobile . '</div>';
                            }

                            if ($agent_email) {
                                print '<div class="agent_detail"><i class="fa fa-envelope-o"></i>' . $agent_email . '</div>';
                            }

                            if ($agent_skype) {
                                print '<div class="agent_detail"><i class="fa fa-skype"></i>' . $agent_skype . '</div>';
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
                echo '<div id="pagination" class="clearfix">';
                echo '<span class="pages">Pages:</span>';
                $current_page = max(1, get_query_var('paged'));
                echo paginate_links(array(
                    'base' => get_pagenum_link(1) . '%_%',
                    'format' => 'page/%#%/',
                    'current' => $current_page,
                    'total' => $total_pages,
                    'prev_next' => false,
                    'type' => 'list',
                ));
                echo '</div>';
            }
            ?>         

        </div>
    </div><!-- end 9col container--> 
    <?php
    wp_suspend_cache_addition(false);
    ?>
</div>   
<?php get_footer(); ?>