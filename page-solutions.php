<?php get_header(); ?>

<main class="page-solutions">

  <section class="page-intro container dark-section">
    <h1 class="page-title">Business-Defining Moments</h1>
    <p class="page-desc long">
    There are only certain defining moments in business—just like in life.<br>
    Launches. Pivots. Rebrands. Expansions. The bold moments that shape who you are and what comes next.<br><br>
    We build tailored, high-impact solutions for exactly those moments—the ones that truly matter.
    </p>
  </section>

  <section class="our-solutions container dark-section">

    <div class="solution" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
      <h2 class="solution-title">From Idea to Launch</h2>
      <div class="solution-text">
        <p>
        You’ve got the idea. We bring the structure. <br><br>From feasibility to full launch, we guide you every step of the way—building the business model, brand, strategy, and campaigns to turn your vision into a reality.
        </p>
        <a href="<?php echo esc_url(site_url('start-a-project/')); ?>" role="button" class="cta cta-secondary" name="Let's launch something powerful">Let’s launch something powerful.</a>
      </div>
    </div>

    <div class="solution" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
      <h2 class="solution-title">Strategyzer™ Licensed to Innovation Sprint</h2>
      <div class="solution-text">
        <p>
        Innovation isn’t just a phase—it’s a mindset. Our Strategyzer Sprint helps you test, validate, and evolve ideas fast. Whether you’re entering new markets, refreshing old offerings, or unlocking new thinking in your team, we keep your business future-ready.
        </p>
        <a href="<?php echo esc_url(site_url('start-a-project/')); ?>" role="button" class="cta cta-secondary" name="Let's launch something powerful">Let’s make innovation practical.</a>
      </div>
    </div>

    <div class="solution" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
      <h2 class="solution-title">Brand Revitalization</h2>
      <div class="solution-text">
        <p>
        When your brand no longer feels like you, it’s time to re-align.<br><br>We update visuals, messaging, and strategy to reflect where you’re going—not just where you’ve been.
        </p>
        <a href="<?php echo esc_url(site_url('start-a-project/')); ?>" role="button" class="cta cta-secondary" name="Let's launch something powerful">Let’s reintroduce your brand to the world.</a>
      </div>
    </div>

    <div class="solution" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
      <h2 class="solution-title">360 Market <br>Penetration Strategy</h2>
      <div class="solution-text">
        <p>
        New markets need more than marketing.<br><br>We combine research, strategy, PR, partnerships, and omnichannel marketing to help you grow with purpose—and stay ahead of the competition.
        </p>
        <a href="<?php echo esc_url(site_url('start-a-project/')); ?>" role="button" class="cta cta-secondary" name="Let's launch something powerful">Let’s expand with intent.</a>
      </div>
    </div>

    <div class="solution" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
      <h2 class="solution-title">HR Restructure</h2>
      <div class="solution-text">
        <p>
        Your people are your business. We make sure everything behind the scenes reflects that.<br><br>From org design to talent strategy and cultural alignment, we build HR frameworks that support growth, purpose, and performance.
        </p>
        <a href="<?php echo esc_url(site_url('start-a-project/')); ?>" role="button" class="cta cta-secondary" name="Let's launch something powerful">Let’s build a team that works.</a>
      </div>
    </div>

    <div class="solution" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
      <h2 class="solution-title">E-Commerce Strategy</h2>
      <div class="solution-text">
        <p>
        E-commerce isn’t just a platform—it’s a strategy.<br><br>We help you build or elevate your online presence with the right tools, user flows, and performance marketing to drive growth that lasts.
        </p>
        <a href="<?php echo esc_url(site_url('start-a-project/')); ?>" role="button" class="cta cta-secondary" name="Let's launch something powerful">Let’s make digital your strongest channel.</a>
      </div>
    </div>

    <div class="solution" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
      <h2 class="solution-title">Campaign Management</h2>
      <div class="solution-text">
        <p>
        Great campaigns aren’t just loud—they’re smart.<br><br>We handle it all, from concept to content, channels to KPIs—so your message reaches the right people, with the right impact.
        </p>
        <a href="<?php echo esc_url(site_url('start-a-project/')); ?>" role="button" class="cta cta-secondary" name="Let's launch something powerful">Let’s run a campaign that sticks.</a>
      </div>
    </div>

    <div class="solution" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
      <h2 class="solution-title">360 Business Strategy</h2>
      <div class="solution-text">
        <p>
        Growth needs a plan—and a partner.<br><br>We work with you to align vision with operations, optimize performance, and uncover opportunities for long-term success.
        </p>
        <a href="<?php echo esc_url(site_url('start-a-project/')); ?>" role="button" class="cta cta-secondary" name="Let's launch something powerful">Let’s map your next chapter.</a>
      </div>
    </div>

    <div class="solution" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
      <h2 class="solution-title">UI/UX Strategy & Design</h2>
      <div class="solution-text">
        <p>
        Growth needs a plan—and a partner.<br><br>We work with you to align vision with operations, optimize performance, and uncover opportunities for long-term success.
        </p>
        <a href="<?php echo esc_url(site_url('start-a-project/')); ?>" role="button" class="cta cta-secondary" name="Let's launch something powerful">Let’s design your next chapter.</a>
      </div>
    </div>

  </section>

  <?php get_template_part('partials/selected-projects', null , [
    'section_class' => 'selected-projects__black dark-section',
    'section_title' => 'Selected',
    ]);
  ?>
  
  <?php 
    get_template_part('partials/lets-do-this', null , [
      'section_class' => 'lets-do-this__black dark-section',
      'cta_url' => 'contact-us/',
    ]);
  ?>

</main>

<?php get_footer(); ?> 