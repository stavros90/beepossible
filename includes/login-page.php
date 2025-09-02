<?php 
/**
 * Customized Login Page
 */
function my_login_page() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/includes/login/login.css">';
}
add_action('login_head', 'my_login_page');

// Change Logo URL
function custom_loginlogo_url($url) {
	return 'https://beepossible.com/';	
}
add_filter( 'login_headerurl', 'custom_loginlogo_url' );