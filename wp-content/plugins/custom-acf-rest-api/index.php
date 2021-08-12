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

                if($slug['section'] == 'hero_slider'):
                        if (have_rows('hero_slider')):
                                $i=1;
                                while (have_rows('hero_slider')) : the_row();
                                    $image = get_sub_field('banner_image');
                                    $data['hero_section'][$i]['title'] = get_sub_field('title', $post->ID);
                                    $data['hero_section'][$i]['sub_title'] = get_sub_field('sub_title', $post->ID);
                                    $data['hero_section'][$i]['banner_img'] =$image['url'];

                                $i++;
                            endwhile;
                        endif;
                endif;

           
        endwhile;
    endif;
    
    return $data;
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
});