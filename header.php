<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/manrope-v19-latin-regular.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <meta property="og:title" content="Bee Possible – Your True 360° Partner in Strategy, Marketing & Growth">
    <meta property="og:description" content="Bee Possible is a Nicosia-based consulting & creative firm offering expansion strategy, marketing coordination, website audits, and more to help businesses grow with clarity and purpose.">
    <meta property="og:url" content="https://beepossible.com/">
    <meta property="og:type" content="website">
    <!-- <meta property="og:image" content="https://beepossible.com/path-to-your-image.jpg"> -->

    <?php wp_head(); ?>
</head>

<body <?php body_class();?>> 

    <header class="header">

        <div class="brand">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="bookmark" name="Click logo to go to homepage">
                <?php get_template_part('/assets/images/svg/logo-white'); ?>
            </a>
        </div>

        <!-- Hamburger for mobile -->
        <button class="hamburger" aria-label="Open Menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="main-navigation">
            <?php 
                wp_nav_menu([
                    'menu' => 'primary_menu'
                ]);
            ?>
        </nav>

        <nav class="mobile-navigation">
            <?php 
                wp_nav_menu([
                    'menu' => 'primary_menu'
                ]);
            ?>
        </nav>

    </header>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const hamburger = document.querySelector(".hamburger");
            const nav = document.querySelector(".mobile-navigation");

            if (hamburger && nav) {
                hamburger.addEventListener("click", function() {
                    nav.classList.toggle("active");
                    hamburger.classList.toggle("active");
                });
            }
        });

    </script>