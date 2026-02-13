<?php get_header();?>

<main class="career-page">

  <section class="page-intro container light-section">
    <h1 class="page-title">Grow With Us</div>
    <p class="page-desc long">At BeePossible, we’re always on the lookout for passionate, creative, and driven individuals to join our growing team. Whether you’re a designer, strategist, developer, or marketer, we believe in building a collaborative environment where bold ideas thrive and innovation leads the way. Explore our current openings or send us your CV — because great talent doesn’t always wait for a job listing. Let’s build the future together.</p>
  </section>

  <section class="container available-positions light-section">
    <h2 class="section-title">Available positions</h2>
    <ul>
    <?php 
      $jobs = new WP_Query([
        'post_type' => 'career',
        'post_status' => 'publish',
        'posts_per_page' => -1
      ]);

      if($jobs->have_posts()) : while($jobs->have_posts()) : $jobs->the_post(); 
    ?>

      <div class="job-post">
        <li><h3 class="job-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3></li>
      </div>

    <?php endwhile; ?>
    </ul>
    <?php else : echo '<p style="margin-bottom:3rem;font-size:1.3rem;">We don’t have any open positions at the moment. Please check back soon for future opportunities..</p>'; ?>
  
    <?php endif; wp_reset_postdata(); ?>
  </section>

</main>

<?php get_footer();?>