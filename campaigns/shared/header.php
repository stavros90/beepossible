<?php
/**
 * Campaign header — minimal chrome shared by every advertising landing page.
 *
 * Loaded with bp_campaign_header(), not get_header(): WordPress only looks for
 * header-*.php at the theme root, and the whole point of /campaigns is that a
 * landing page adds nothing there.
 *
 * Deliberately different from header.php: no navigation, and the logo is a
 * button that scrolls to the top rather than a link to the homepage. A visitor
 * arriving from a paid ad has one job on this page, and every link that leaves
 * it is a leak in the funnel.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="preload" href="<?php echo esc_url( get_template_directory_uri() . '/assets/fonts/manrope-v19-latin-regular.woff2' ); ?>" as="font" type="font/woff2" crossorigin="anonymous">
  <link rel="preload" href="<?php echo esc_url( get_template_directory_uri() . '/assets/fonts/bebas-neue-v15-latin-regular.woff2' ); ?>" as="font" type="font/woff2" crossorigin="anonymous">
  <?php wp_head(); ?>
</head>

<body <?php body_class( 'campaign campaign--' . esc_attr( bp_campaign_get( 'name', 'page' ) ) ); ?>>

  <a class="campaign-skip" href="#enquire">Skip to the enquiry form</a>

  <header class="campaign-header">
    <div class="campaign-header__inner">
      <button type="button" class="campaign-logo" data-campaign-top aria-label="Back to the top of the page">
        <?php get_template_part( 'assets/images/svg/logo-white' ); ?>
      </button>

      <p class="campaign-header__note">
        <span class="campaign-header__dot" aria-hidden="true"></span>
        Nicosia, Cyprus
      </p>
    </div>
  </header>
