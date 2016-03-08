<?php

/*
Plugin Name: GAEM - Google Analytics Event Manager
Plugin URI: http://themeforest.net
Description: Easily add google analytics events to the buttons and pages of your website.
Version: 1.0
Author: Nicholas Koskowski
Author URI: http://nickkoskowski.com
License: GPL
*/



//TODO: ENQUEQUE ASSETS

function GAEM_get_events() {

	$events = array();

	query_posts(array('posts_per_page' => -1, 'post_type' => 'GAEM_events'));
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 


	$events[] = get_the_title();

	endwhile; endif;

	return $events;
}

function GAEM_register_events() {
	register_post_type('GAEM_events', array(
		'labels' => array(
			'name' => __('GAEM_events'),
			'singular_name' => __('GoogleEvent')
			),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'google-event'),
		'supports' => array('title')
		)
	);
}

add_action('init', 'GAEM_register_events');

function GAEM_compile_script() {

	$events = GAEM_get_events();

	$output = '<script type="text/javascript">';
	$output .= 'function trackEvent(category, action, label) { _gaq.push(["_trackEvent", category, action, label,, false]); }'."\n";

	foreach ($events as $event) {
		$output .= 'jQuery("#'.$event.'").click(function() {';
		$output .= "trackEvent('".$event."','".$event."','".$event."');";
		$output .= '});';
	}

	$output .= '</script>';

	echo $output;

}

add_action('wp_head', 'GAEM_compile_script');