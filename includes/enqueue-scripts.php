<?php 

// Load Stylesheets
function load_stylesheets() {
    // wp_enqueue_style( 'beepossible-style', get_stylesheet_uri() );
    wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css' );
}
add_action('wp_enqueue_scripts', 'load_stylesheets');



// Load Javascripts
function load_javascripts() {
    wp_enqueue_script( 'beepossible-script', 'http://localhost:8080/app.js', [], '1', true );  
    wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true );

    // Init script
    wp_add_inline_script( 'swiper-js', '
        document.addEventListener("DOMContentLoaded", function() {
            const swiper = new Swiper(".people-swiper", {
                slidesPerView: 4,      // Show 3 cards at a time
                spaceBetween: 32,      // Gap between cards
                loop: true,            // Infinite loop
                autoplay: {
                    delay: 2500,       // 2s per slide
                    disableOnInteraction: false
                },
                grabCursor: true,      // Cursor turns into grab hand
                breakpoints: {
                    0: { slidesPerView: 1 },      // Mobile
                    768: { slidesPerView: 2 },    // Tablet
                    1024: { slidesPerView: 4 }    // Desktop
                }
            });
        });
    ');

}
add_action('wp_enqueue_scripts', 'load_javascripts');

