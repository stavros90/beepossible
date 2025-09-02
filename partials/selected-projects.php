<?php
/**
 * Reusable "Selected Projects" Section
 *
 * Parameters:
 * - $section_class (string - selected-projects__white)
 * - $section_title (string)
 * - $order (string)
 * - $showMore (string)
 */

  $args = isset($args) ? $args : [];
  extract($args);

  // Set defaults
  $section_class = isset($section_class) ? esc_attr($section_class) : '';
  $section_title = isset($section_title) ? esc_html($section_title) : "Selected";
  $secion_subtitle = isset($section_subtitle) ? esc_html($section_subtitle) : "Projects";
  $orderby = isset($orderby) ? esc_html($orderby) : "rand";
  $show_more = isset($show_more) ? esc_html($show_more) : "false";

?>

<section class="selected-projects <?php echo $section_class; ?>">
  <h3 class="font-display"><?php echo $section_title; ?> <span data-aos="zoom-out-down"><?php echo $secion_subtitle; ?></span></h3>
  
  <div class="container-fluid">
    <div class="section-project-grid">

      <?php $case_studies = new WP_Query([
        'post_type' => 'case-study',
        'posts_per_page' => 3,
        'orderby' => $orderby,
      ]);
      
      if($case_studies->have_posts()) : while($case_studies->have_posts()) : $case_studies->the_post(); ?>

      <project class="project-card" data-aos="flip-left" data-aos-duration="1000">
        <a href="<?php the_permalink(); ?>">
          <?php the_post_thumbnail( 'case-study-list', ["class" => "project-card__image"]); ?>      
        </a>
        <h4 class="project-card__title" data-aos="fade-up" data-aos-delay="50"><?php the_title(); ?></h4>
        <?php if(get_field('measurable_impact')) : ?>
          <p class="project-card__desc"><?php the_field('measurable_impact'); ?></p>
        <?php endif; ?>
      </project>

      <?php endwhile; endif; wp_reset_postdata(); ?>
    </div>
    
    <?php if($show_more == 'true') : ?>
    <div class="cta-centered">
      <a href="<?php echo esc_url(site_url('case-studies/')); ?>" role="button" class="cta cta-white">View more case studies</a>
    </div>
    <?php endif; ?>

  </div>
</section>