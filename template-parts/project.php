<project class="project-card" data-aos="flip-left" data-aos-duration="1000">
  <a href="<?php the_permalink(); ?>">
    <?php the_post_thumbnail( 'case-study-list', ["class" => "project-card__image"]); ?>      
  </a>
  <h4 class="project-card__title" data-aos="fade-up" data-aos-delay="50"><?php the_title(); ?></h4>
  <?php if(get_field('measurable_impact')) : ?>
    <p class="project-card__desc"><?php the_field('measurable_impact'); ?></p>
  <?php endif; ?>
</project>