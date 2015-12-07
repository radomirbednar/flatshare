<?php 
            global $prop_id ;
            global $agent_email;
            global $agent_urlc;
            $agent_id   = intval( get_post_meta($post->ID, 'property_agent', true) ); 
            $prop_id    = $post->ID;  

            
            $userID = get_the_author_meta( 'ID'  );
            
            $author_email=get_the_author_meta( 'user_email'  );   
            $user_origin = esc_attr(get_user_meta($userID, 'user_origin', true));
            $looking_where = esc_attr(get_user_meta($userID, 'looking_where', true));
            $user_language_ids = fl_get_user_language_ids($userID);
            $user_skill_ids = fl_get_user_house_skill_ids($userID);
          
            $user_title = get_the_author_meta('title', $userID);
            $user_custom_picture = get_the_author_meta('custom_picture', $userID);
            $user_small_picture = get_the_author_meta('small_custom_picture', $userID); 
            $image_id = get_the_author_meta('small_custom_picture', $userID);
            $about_me = get_the_author_meta('description', $userID);  
            $first_name = esc_attr(get_the_author_meta('first_name', $userID));
            $last_name = esc_attr(get_the_author_meta('last_name', $userID)); 
            $user_facebook = get_the_author_meta('facebook', $userID);
            $user_twitter = get_the_author_meta('twitter', $userID);
            $user_linkedin = get_the_author_meta('linkedin', $userID);
            $user_pinterest = get_the_author_meta('pinterest', $userID);
            $photo_url = get_the_author_meta('custom_picture', $userID); 
            $user_email = get_the_author_meta('user_email', $userID); 
            $user_mobile = get_the_author_meta('mobile', $userID);
            $user_phone = get_the_author_meta('phone', $userID);
            $user_description = esc_attr(get_the_author_meta('description', $userID)); 
            $user_skype = get_the_author_meta('skype', $userID);
            $website = get_the_author_meta('website', $userID); 
              
            $fl_user_data = get_fl_data($userID);
             
            $user_gender = !empty($fl_user_data->user_gender) ? $fl_user_data->user_gender : '';  
            $user_age = !empty($fl_user_data->user_age) ? $fl_user_data->user_age : '';
            $looking_where = !empty($fl_user_data->looking_where) ? $fl_user_data->looking_where : '';
            $rent_amount = !empty($fl_user_data->rent_amount) ? $fl_user_data->rent_amount : '';
            $activity = !empty($fl_user_data->activity) ? $fl_user_data->activity : ''; 
            $disponibility = !empty($fl_user_data->disponibility) ? $fl_user_data->disponibility : '';
            
            $how_long = !empty($fl_user_data->how_long) ? $fl_user_data->how_long : ''; 
            $sexual_preference = !empty($fl_user_data->sexual_preference) ? $fl_user_data->sexual_preference : '';
            $sleeping_span = !empty($fl_user_data->sleeping_span) ? $fl_user_data->sleeping_span : '';
            $couple = !empty($fl_user_data->couple) ? $fl_user_data->couple : '';
            $smoker = !empty($fl_user_data->smoker) ? $fl_user_data->smoker : '';   
            $pets = !empty($fl_user_data->pets) ? $fl_user_data->pets : '';
            $user_origin = !empty($fl_user_data->user_origin) ? $fl_user_data->user_origin : '';
            $party = !empty($fl_user_data->party) ? $fl_user_data->party : ''; 
            $looking_when = !empty($fl_user_data->looking_when) ? $fl_user_data->looking_when : '';
            $looking_for = !empty($fl_user_data->looking_for) ? $fl_user_data->looking_for : '';
             
            $houseskils = fl_get_user_house_skills($userID);
 
            //if ( get_the_author_meta('user_level') !=10){         
  
            $preview_img    =   get_the_author_meta( 'custom_picture'  );
             
            if($preview_img==''){
               $preview_img=get_template_directory_uri().'/img/default-user.png';
            }
        
            $agent_skype         = get_the_author_meta( 'skype'  );
            $agent_phone         = get_the_author_meta( 'phone'  );
            $agent_mobile        = get_the_author_meta( 'mobile'  );
            $agent_email         = get_the_author_meta( 'user_email'  );
            $agent_pitch         = '';
            $agent_posit         = get_the_author_meta( 'title'  );
            $agent_facebook      = get_the_author_meta( 'facebook'  );
            $agent_twitter       = get_the_author_meta( 'twitter'  );
            $agent_linkedin      = get_the_author_meta( 'linkedin'  );
            $agent_pinterest     = get_the_author_meta( 'pinterest'  );
             
            $link                = get_permalink(); 
            $name                = get_the_author_meta( 'first_name' ).' '.get_the_author_meta( 'last_name');;
            
            include( 'userdetails.php' );  
            include('author_contact.php');    
         
        //} 
?>