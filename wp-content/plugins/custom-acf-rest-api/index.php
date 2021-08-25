<?php
/**
 * Plugin Name: Custom ACF REST Api
 * Plugin URI: https://www.netiapps.com/
 * Description: Custom Fields Rest Api
 * Version: 1.0
 * Author: Netiapps
 * Author URI: https://www.netiapps.com/
 */

//require WPMU_PLUGIN_DIR."/custom-post-types/.php";

function wl_posts() {
	$args = [
		'numberposts' => 99999,
		'post_type' => 'post'
	];

	$posts = get_posts($args);

	$data = [];
	$i = 0;

	foreach($posts as $post) {
		$data[$i]['id'] = $post->ID;
		$data[$i]['title'] = $post->post_title;
		$data[$i]['content'] = $post->post_content;
		$data[$i]['slug'] = $post->post_name;
		$data[$i]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post->ID, 'thumbnail');
		$data[$i]['featured_image']['medium'] = get_the_post_thumbnail_url($post->ID, 'medium');
		$data[$i]['featured_image']['large'] = get_the_post_thumbnail_url($post->ID, 'large');
		$i++;
	}

	return $data;
}

function wl_post( $slug ) {
	$args = [
		'name' => $slug['slug'],
		'post_type' => 'post'
	];

	$post = get_posts($args);


	$data['id'] = $post[0]->ID;
	$data['title'] = $post[0]->post_title;
	$data['content'] = $post[0]->post_content;
	$data['slug'] = $post[0]->post_name;
	$data['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post[0]->ID, 'thumbnail');
	$data['featured_image']['medium'] = get_the_post_thumbnail_url($post[0]->ID, 'medium');
	$data['featured_image']['large'] = get_the_post_thumbnail_url($post[0]->ID, 'large');

	return $data;
}

function wl_page( $slug ){
    global $wp;
    global $post;
    $args   =   array(
                'post_type'         =>  'page',
                'post_status'       =>  'publish',
                'name' => $slug['slug'],
                );
    
    $data = [];
    $page = new WP_Query( $args );
    if ( $page->have_posts() ) :
        while ( $page->have_posts() ) : $page->the_post(); 

                if($slug['section'] == 'hero-section'):
                        if (have_rows('hero_slider')):
                                while (have_rows('hero_slider')) : the_row();
                                    $image = get_sub_field('banner_image');
                                    $data[] = [
                                                 'title' => get_sub_field('title', $post->ID),
                                                 'sub_title' => get_sub_field('sub_title', $post->ID),
                                                 'banner_img' => $image['url']
                                             ];
                            endwhile;
                        endif;
                endif;

                if($slug['section'] == 'about-us'):
                    if (have_rows('about_us')):
                           
                            while (have_rows('about_us')) : the_row();
                                $image = get_sub_field('image');
                                $data[] = [
                                            'title' => get_sub_field('title', $post->ID),
                                            'description' => get_sub_field('description', $post->ID),
                                            'image' => $image['url'],
                                            'image_title' => get_sub_field('image_title', $post->ID)
                                        ];
                        endwhile;
                    endif;
                endif;

                if($slug['section'] == 'top-influencer'):
                    if (have_rows('top_influencer')):
                            while (have_rows('top_influencer')) : the_row();
                                   $data[] =[ 'section_title' => get_sub_field('section_title', $post->ID) ];
                                   if(have_rows('influence_list')):
                                      while(have_rows('influence_list')): the_row();
                                        $photo = get_sub_field('photo');
                                        $data[] = [
                                            'name' => get_sub_field('name', $post->ID),
                                            'expert' => get_sub_field('expert', $post->ID),
                                            'photo' => $photo['url']                                           
                                        ];
                                       endwhile;
                                    endif;
                            endwhile;
                    endif;
                endif;

                if($slug['section'] == 'articles-stories'):
                    if (have_rows('aritcles_and_stories')):
                            while (have_rows('aritcles_and_stories')) : the_row();
                                   $data[] =[ 'section_title' => get_sub_field('section_title', $post->ID) ];
                                   if(have_rows('article_list')):
                                      while(have_rows('article_list')): the_row();
                                        $image = get_sub_field('image');
                                        $data[] = [
                                            'title' => get_sub_field('title', $post->ID),
                                            'description' => get_sub_field('description', $post->ID),
                                            'image' => $image['url']                                           
                                        ];
                                       endwhile;
                                    endif;
                            endwhile;
                    endif;
                endif;

                if($slug['section'] == 'client-experience'):
                    if (have_rows('client_experience')):
                            while (have_rows('client_experience')) : the_row();
                                   $data[] =[ 'section_title' => get_sub_field('section_title', $post->ID) ];
                                   if(have_rows('customer_experience_list')):
                                      while(have_rows('customer_experience_list')): the_row();
                                        $image = get_sub_field('photo');
                                        $data[] = [
                                            'content' => get_sub_field('content', $post->ID),
                                            'customer_name' => get_sub_field('customer_name', $post->ID),
                                            'photo' => $image['url']                                           
                                        ];
                                       endwhile;
                                    endif;
                            endwhile;
                    endif;
                endif;

                if($slug['section'] == 'associate-accreditation'):
                    if (have_rows('associate_accreditation')):
                            while (have_rows('associate_accreditation')) : the_row();
                                   $data[] =[ 'section_title' => get_sub_field('section_title', $post->ID) ];
                                   if(have_rows('associate_logo')):
                                      while(have_rows('associate_logo')): the_row();
                                        $image = get_sub_field('logo');
                                        $data[] = [
                                            'logo' => $image['url']                                           
                                        ];
                                       endwhile;
                                    endif;
                            endwhile;
                    endif;
                endif;

           
        endwhile;
    endif;
    
    return $data;
}

function get_menu( $data ){
     // Replace your menu name, slug or ID carefully
     return wp_get_nav_menu_items( $data[ 'slug' ] );
   //  return get_registered_nav_menus();
//    return wp_get_nav_menu_items('menu');
}

function get_article($data){
    global $wp;
    global $post;
    $title = str_replace('-', ' ', $data['slug']);
    // $args   =   array(
    //             'post_type'         =>  'articles-stories',
    //             'post_status'       =>  'publish',
    //             'title' => $title,
    //             );
  
    // $res_data = [];
    // $page = new WP_Query( $args );
    // echo "Last SQL-Query: {$page->request}";

    $args = [
		'title' => $title,
		'post_type' => 'articles-stories'
	];

	$res = get_posts($args);

   echo '<pre>';
   print_r($res);

   $banner_img = get_field_object('banner_image', $res[0]->ID);
   $description = get_field_object('description', $res[0]->ID);
   print_r($banner_img);
   print_r($description);
    // if ( $page->have_posts() ) :
    //     // while ($page->have_posts()) : $page->the_post();
    //     echo 'OCMOOSHOS';
    //     $post_id = get_the_ID();
    //     echo '<pre>';
    //     print_r($page->have_posts);
    //     echo $post_id;
    //     if (have_rows('acf')):
    //         while (have_rows('acf')) : the_row();
    //          echo 'jjjjjjjjjjjjj';
    //             // $data[] =[ 'section_title' => get_sub_field('section_title', $post->ID) ];
                
    //                     $image = get_sub_field('banner_image');
    //                     $res_data[] = [
    //                         'title' => get_sub_field('title', $post->ID),
    //                         'description' => get_sub_field('description', $post->ID),
    //                         'image' => $image['url']                                           
    //                     ];
                    
    //         endwhile;
    //     endif;
    // endif;
    return $res;
}


function contact_us($input){
    echo $name = $input['name'];
    $email = $input['email'];
    $mobile = $input['mobile'];
    $booking_id = $input['booking_id'];
   echo $to = 'janagiraman@netiapps.com';
    $subject = 'The subject';
    $body = 'The email body content';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    
    wp_mail( $to, $subject, $body, $headers );
}


add_action('rest_api_init', function() {
	register_rest_route('wl/v1', 'posts', [
		'methods' => 'GET',
		'callback' => 'wl_posts',
	]);

	register_rest_route( 'wl/v1', 'posts/(?P<slug>[a-zA-Z0-9-]+)', array(
		'methods' => 'GET',
		'callback' => 'wl_post',
    ) );
    
    register_rest_route('wl/v1', 'page/(?P<slug>[a-zA-Z0-9-]+)/(?P<section>[a-zA-Z0-9-]+)', [
		'methods' => 'GET',
		'callback' => 'wl_page',
	]);

    register_rest_route( 'wl/v1', '/menus/(?P<slug>[a-zA-Z0-9-]+)', 
    array(
      'methods'  => 'GET',
      'callback' => 'get_menu'
    )
  );

  register_rest_route( 'wl/v1', '/article/(?P<slug>[a-zA-Z0-9-]+)', 
    array(
        'methods'  => 'GET',
        'callback' => 'get_article'
    )
    );

  register_rest_route( 'wl/v1', '/contact-us', 
    array(
      'methods'  => 'POST',
      'callback' => 'contact_us'
    )
  );
});