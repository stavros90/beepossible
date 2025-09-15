<?php get_header();?>

<main class="career-page">

  <section class="page-intro container light-section">
    <h1 class="page-title">Grow With Us</div>
    <p class="page-desc long">At BeePossible, we’re always on the lookout for passionate, creative, and driven individuals to join our growing team. Whether you’re a designer, strategist, developer, or marketer, we believe in building a collaborative environment where bold ideas thrive and innovation leads the way. Explore our current openings or send us your CV — because great talent doesn’t always wait for a job listing. Let’s build the future together.</p>
  </section>

  <section class="container available-positions light-section">
    <h2 class="section-title">Available positions</h2>
    <?php 
      $jobs = new WP_Query([
        'post_type' => 'career',
        'post_status' => 'publish',
        'posts_per_page' => -1
      ]);

      if($jobs->have_posts()) : while($jobs->have_posts()) : $jobs->the_post(); 
    ?>

      <div class="job-post">
        <h3 class="job-title"><?php the_title(); ?></h3>
        <p class="job-description"><?php the_content(); ?></p>
      </div>

    <?php endwhile; else : echo '<p style="margin-bottom:3rem;font-size:1.3rem;">We don’t have any open positions at the moment. Please check back soon for future opportunities..</p>'; ?>
  
    <?php endif; wp_reset_postdata(); ?>
  </section>

  <section class="container apply-here">
    <h2 class="section-title">Apply here</h2>

    <form class="careers-form" id="careersForm" action="https://formcarry.com/s/rpxwootzWq7" method="POST" enctype="multipart/form-data">
      <label class="screen-readers-only" for="NAME">Name</label>
      <input type="text" name="NAME" id="NAME" placeholder="Name" required>

      <label class="screen-readers-only" for="EMAIL">Email</label>
      <input type="email" name="EMAIL" id="EMAIL" placeholder="Email" required>

      <label class="screen-readers-only" for="PHONE">Phone Number</label>
      <input type="TEL" name="PHONE" id="PHONE" placeholder="Phone Number (optional)">

      <label class="screen-readers-only" for="POSITION">Position applying for</label>
      <input type="text" name="POSITION" id="POSITION" placeholder="Position applying for" required>

      <label class="screen-readers-only" for="ABITMORE">Tell us a bit more (optional)</label>
      <textarea rows="4" id="ABITMORE" name="ABITMORE" placeholder="Tell us a bit more (optional)"></textarea>

      <input type="text" name="LINKEDIN" id="LINKEDIN" placeholder="LinkedIn profile (optional)">
      <input type="text" name="INSTAGRAM" id="INSTAGRAM" placeholder="Instagram profile (optional)">
      <input type="text" name="PORTFOLIO" id="PORTFOLIO" placeholder="Website or portfolio (optional)">

      <label class="screen-readers-only" id="cv" for="CV">Upload your CV (PDF Only)</label>
      <input type="file" name="CV" id="CV" accept="application/pdf">

      <div class="h-captcha" data-sitekey="68e83946-efae-4068-a37c-3a44401a1bfa"></div>
      <script src="https://js.hcaptcha.com/1/api.js" async defer></script>

      <input class="cta cta-primary" type="submit" value="Apply">
    </form>
  </section>
</main>

<?php get_footer();?>