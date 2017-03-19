<?php

/*
 * wp_dequeue bootstrap.css of the parent DevDemBootStrap3 theme
*/
function dmbs_dequeue_enqueue_scripts() {
	global $version;
	wp_dequeue_style( 'bootstrap.css' );
	wp_dequeue_script('theme-js');
	wp_enqueue_script('child-theme-js', get_stylesheet_directory_uri() . '/js/bootstrap.js', array( 'jquery' ), $version, true );
}
add_action( 'wp_enqueue_scripts', 'dmbs_dequeue_enqueue_scripts', 100 );