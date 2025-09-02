<?php 

/* Fix project current menu active style */
add_filter('nav_menu_css_class', function($classes, $item) {

if (
    ($item->title === 'Projects') && is_singular('project') || ($item->title === 'Insights') && is_singular('post')
) {
    $classes[] = 'current-menu-item';
}

return $classes;
}, 10, 2);




// Add page name as a custom body class
function add_page_slug_to_body_class($classes) {
    if (is_singular()) { // Only for single posts/pages
        global $post;
        if (isset($post->post_name)) {
            $classes[] = $post->post_name . '-page';
        }
    }
    return $classes;
}
add_filter('body_class', 'add_page_slug_to_body_class');
