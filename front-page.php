<?php get_header(); ?> 

<main>
  <section class="intro dark-section">
    <div class="container">
      <div class="particles">
        <img class="next-particle" alt="Bee Possible" data-gravity="0.3" data-color="#fff" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo-primary.png'); ?>">
      </div>
      <div class="intro-text">
          <h1>Your true 360° partner</h1>
          <p>Not just everywhere. Exactly where it matters.</p>
      </div>
    </div>
  </section>

  <section class="our-mission dark-section">
    <div class="container">
      <div class="decor-title" data-aos="fade-left" data-aos-duration="300">Our statement</div>
      <p data-aos="fade-up" data-aos-duration="700">From business to brand. Strategically. Creatively. Together.</p>
      <a role="button" href="#iamready" class="cta cta-white">Ready to grow?</a>
    </div>
  </section>

  <?php get_template_part('/partials/selected-projects', null , [
    'section_class' => 'selected-projects__black dark-section',
    'section_title' => 'Case',
    'section_subtitle' => 'Studies',
    'show_more' => 'true'
    ]);
  ?>

  <?php get_template_part('/partials/trusted-by'); ?>

  <section class="what-we-do light-section" id="iamready">
    <div class="container">
      <h2 class="font-display">What <span data-aos="zoom-out-down">we do</span></h2>
      <div class="services">
        <h3 class="service" data-aos="zoom-in-left" data-aos-duration="450"><a href="<?php echo esc_url(site_url('services/')); ?>">Strategy</a></h3>
        <h3 class="service" data-aos="zoom-in-right" data-aos-duration="450" data-aos-delay="150"><a href="<?php echo esc_url(site_url('services/')); ?>">Creatives</a></h3>
        <h3 class="service" data-aos="zoom-in-left" data-aos-duration="450" data-aos-delay="300"><a href="<?php echo esc_url(site_url('services/')); ?>">Digital Marketing</a></h3>
        <h3 class="service" data-aos="zoom-in-right" data-aos-duration="450" data-aos-delay="450"><a href="<?php echo esc_url(site_url('services/')); ?>">PR & Events</a></h3>
        <h3 class="service" data-aos="zoom-in-left" data-aos-duration="450" data-aos-delay="600"><a href="<?php echo esc_url(site_url('services/')); ?>">Web Development</a></h3>
      </div>
      <div class="cta-centered">
        <a href="<?php echo esc_url(site_url('services/')); ?>" role="button" class="cta cta-primary">View services</a>
      </div>
    </div>
  </section>

</main>

<script>
document.addEventListener("DOMContentLoaded", function() {
  // Run only after all assets are loaded (images, css, etc.)
  window.addEventListener("load", function() {
    const particles = document.querySelector('.particles');
    if (!particles) return;

    // Only run on larger screens
    if (window.innerWidth >= 1024) {
      particles.classList.add('active');
    }
  });
});
</script>

<?php get_footer(); ?>