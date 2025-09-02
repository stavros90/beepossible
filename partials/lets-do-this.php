<?php
/**
 * Reusable "Let's Do This" Section
 *
 * Parameters:
 * - $section_class (string)
 * - $section_title (string)
 * - $cta_text (string)
 * - $cta_url (string)
 */

  $args = isset($args) ? $args : [];
  extract($args);

  // Set defaults
  $section_class = isset($section_class) ? esc_attr($section_class) : 'lets-do-this__black';
  $section_title = isset($section_title) ? esc_html($section_title) : "Let's do great things, together.";
  $cta_text = isset($cta_text) ? esc_html($cta_text) : 'Give us a call';
  $cta_url = isset($cta_url) ? $cta_url : 'start-a-project/'; 
?>

<section class="lets-do-this <?php echo $section_class; ?>">
  <div class="container">
    <div class="section-title"><?php echo $section_title; ?></div>
    <a href="<?php echo esc_url(site_url('/') . $cta_url); ?>" class="cta cta-primary" role="button"><?php echo $cta_text; ?></a>
  </div>
</section>
