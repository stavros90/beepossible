<?php 

// Theme supports
add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );
add_theme_support( 'html5', [ 'gallery', 'caption', 'style', 'script' ] );

// Register Image Sizes 
add_image_size( 'article-list', 368, 276, true );
add_image_size( 'case-study-list', 536, 670, true );

if ( ! function_exists( 'beepossible_register_nav_menu' ) ) {

	function beepossible_register_nav_menu(){
		register_nav_menus( array(
	    	'primary_menu' => __( 'Primary Menu', 'beepossible' )
		) );
	}
	add_action( 'after_setup_theme', 'beepossible_register_nav_menu', 0 );
}