<?php get_header(); ?>

<main class="page-start-a-project">

  <section class="page-intro container">
    <h1 class="page-title">Let's Make Your Next Move Count</div>
    <p class="page-desc long">Whether you're launching something new or evolving what exists, we're here to help you grow with clarity, strategy, and purpose.</p>
  </section>

  <section class="container contact-container">
    <div class="contact__form">
      <form id="startHere" action="https://formcarry.com/s/msoDaOsiOTb" method="POST" enctype="multipart/form-data">
        <label class="screen-readers-only" for="FULLNAME">Name</label>
        <input type="text" id="FULLNAME" name="FULLNAME" placeholder="Full Name" required>

        <label class="screen-readers-only" for="EMAIL">Email</label>
        <input type="email" id="EMAIL" name="EMAIL" placeholder="Email" required>

        <label class="screen-readers-only" for="PHONE">Phome number</label>
        <input type="tel" id="PHONE" name="PHONE" placeholder="Phone number" required>

        <label class="screen-readers-only" for="COMPANY">Company / Brand Name (optional)</label>
        <input type="text" id="COMPANY" name="PHONE" placeholder="Company / Brand Name (optional)">

        <label for="STAGE">What stage are you in?</label>
        <select name="STAGE" id="STAGE">
          <option value="Idea Phase">Idea Phase</option>
          <option value="Rebrand or repositioning">Rebrand or repositioning</option>
          <option value="Scaling / market entry">Scaling / market entry</option>
          <option value="Ongoing support">Ongoing support</option>
          <option value="Not sure yet">Not sure yet</option>
        </select>

        <label for="INTERESTED">What are you interested in? (Select all that apply - Hold CTRL)</label>
        <select name="INTERESTED[]" id="INTERESTED" multiple style="min-height:165px;overflow-y:hidden;">
          <option value="Strategy">Strategy</option>
          <option value="Branding">Branding</option>
          <option value="Campaign/Comms">Campaign/Comms</option>
          <option value="Website / Digital">Website / Digital</option>
          <option value="E-Commerce">E-Commerce</option>
          <option value="UI/UX">UI/UX</option>
          <option value="Something Else">Something Else</option>
        </select>

        <label class="screen-readers-only" for="MESSAGE">Tell us more:</label>
        <textarea rows="4" id="MESSAGE" name="MESSAGE" placeholder="Tell us more:" required></textarea>


        <label for="TIMELINE">Timeline</label>
        <div class="timeline-options">
          <input type="radio" id="timeline-asap" name="TIMELINE" value="asap" required>
          <label for="timeline-asap">ASAP</label>

          <input type="radio" id="timeline-1-2" name="TIMELINE" value="1-2 months">
          <label for="timeline-1-2">1–2 months</label>

          <input type="radio" id="timeline-3" name="TIMELINE" value="3+ months">
          <label for="timeline-3">3+ months</label>
        </div>

        <div class="h-captcha" data-sitekey="68e83946-efae-4068-a37c-3a44401a1bfa"></div>
        <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
        
        <input type="submit" value="Start the Conversation" class="cta cta-primary">

        <p>We review every inquiry carefully. Someone from our team will be in touch within 2–3 business days.</p>
      </form>
    </div>
  </section>

  <?php get_template_part('/partials/trusted-by'); ?>

</main>

<?php get_footer(); ?> 