<?php

define("GAEM_URL", plugins_url( 'GAEM-Google-Analytics-Event-Manager'));

// 1. customize ACF path
add_filter('acf/settings/path', 'my_acf_settings_path');

function my_acf_settings_path( $path ) {

    // update path
	$path = GAEM_URL.'/acf/';

    // return
	return $path;

}


// 2. customize ACF dir
add_filter('acf/settings/dir', 'my_acf_settings_dir');

function my_acf_settings_dir( $dir ) {

    // update path
	$dir = GAEM_URL.'/acf/';

    // return
	return $dir;

}


// 3. Hide ACF field group menu item
//add_filter('acf/settings/show_admin', '__return_false');


// 4. Include ACF
include_once( GAEM_URL . '/acf/acf.php' );


//5. Add an options page

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}


//6. Get FieldSets
?>