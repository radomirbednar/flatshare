<?php
 
  
global $prop_id ;
global $agent_email;
global $agent_urlc;
$agent_id   = intval( get_post_meta($post->ID, 'property_agent', true) );
 
$prop_id    = $post->ID;  
$author_email=get_the_author_meta( 'user_email'  );
 
 
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
            $agent_urlc           = get_the_author_meta( 'website'  );
             
            $link                = get_permalink();
            
            $name                = get_the_author_meta( 'first_name' ).' '.get_the_author_meta( 'last_name');;
           
             
            include( 'userdetails.php' );
             
            include('author_contact.php');    
   
            
        //} 
?>