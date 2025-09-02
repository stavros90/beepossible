<?php get_header(); ?>

<main class="page-services">

  <section class="page-intro container dark-section">
    <h1 class="page-title">What we <br>really do</h1>
    <p class="page-desc geologica">
      Together, we can take your business to the next level, unlocking your full potential to achieve everything you’ve dreamed of.
    </p>
  </section>

  <section class="our-services container dark-section">

    <div class="service" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
      <h2 class="service-title">Strategy</h2>
      <div class="service-text">
        <p>
          Our strategy services are built to help you cut through the noise, spot the real opportunities, risks and strengths and move forward with purpose. We dig deep—into your business, your market, and what’s getting in the way—then build a plan that actually works. No fluff, no filler. Just smart, tailored strategy designed to get you where you want to go—and keep you there.
        </p>
        <ul>
          <li>Business Strategy Development</li>
          <li>Brand Strategy</li>
          <li>Go-to-Market Strategy</li>
          <li>Customer &amp; Market Insights</li>
        </ul>
      </div>
    </div>

    <div class="service"  data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
      <h2 class="service-title">Creatives</h2>
      <div class="service-text">
        <p>
          Our creative services are all about making your brand feel as good as it looks. From bold visuals to sharp content and seamless digital experiences, we craft work that speaks clearly and hits home. Everything we create is rooted in your goals—because great design isn’t just pretty, it’s purposeful. Whether we’re starting from scratch or building on what’s already there, we make sure it connects, converts, and leaves a mark.
        </p>
        <ul>
          <li>Branding &amp; Identity Design</li>
          <li>Graphic Design</li>
          <li>Content Creation</li>
          <li>Web &amp; UI/UX Design</li>
        </ul>
      </div>
    </div>

    <div class="service"  data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
      <h2 class="service-title">Digital Marketing</h2>
      <div class="service-text">
        <p>
        Our digital services are built to do one thing—deliver results you can actually measure. We use smart, targeted strategies and data-driven execution to get your business in front of the right people, boost engagement, and drive real growth. No guesswork, no wasted spend—just performance that pulls its weight and keeps pushing forward.
        </p>
        <ul>
          <li>Performance</li>
          <li>Social Media Management</li>
          <li>Email Marketing &amp; Automation</li>
          <li>Analytics &amp; Reporting</li>
        </ul>
      </div>
    </div>

    <div class="service" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
      <h2 class="service-title">PR &amp; Events</h2>
      <div class="service-text">
        <p>
        Our PR and Events services are here to get people talking—for all the right reasons. Whether it’s shaping your story or bringing it to life through standout events, we make sure your message lands and lasts. From reputation management to full-scale event execution, everything we do is built to spark connection, build credibility, and produce results.
        </p>
        <ul>
          <li>Pop-Up</li>
          <li>Launch events</li>
          <li>Corporate events</li>
          <li>Clients events</li>
        </ul>
      </div>
    </div>

    <div class="service" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
      <h2 class="service-title">Web Development</h2>
      <div class="service-text">
        <p>
          Our web development services turn ideas into high-performing digital experiences. We don’t rely on bloated templates or shortcuts—we build custom WordPress themes with clean, semantic code that’s fast, optimized, and built to scale. Every site we create is designed to load quickly, rank better, and deliver a smooth experience that keeps people engaged. We make sure the foundation is solid so your business can grow without limits.
        </p>
        <ul>
          <li>Custom WordPress</li>
          <li>Semantic Code</li>
          <li>Fast &amp; Optimized</li>
          <li>Scalable</li>
        </ul>
      </div>
    </div>

  </section>

  <?php 
    get_template_part('partials/selected-projects', null, [
      'section_class' => 'selected-projects__black dark-section'
    ]); 
  ?>
  
  <?php 
    get_template_part('partials/lets-do-this', null , [
      'section_class'  => 'light-section',
      'cta_text' => 'Start Here',
      'cta_url' => 'start-a-project/',
    ]);
  ?>

</main>

<?php get_footer(); ?> 