<?php get_header(); ?>

<main class="page-contact">

  <section class="page-intro container light-section">
    <div class="page-decor-title">Contact us</div>
    <h1 class="page-title">Let's <br>Connect</div>
  </section>

  <section class="container contact-container light-section">
    <div class="contact__form">
      <form id="contactUs" action="https://formcarry.com/s/hK0pDFOsyms" method="POST" enctype="multipart/form-data">
        <label class="screen-readers-only" for="FULLNAME">Name</label>
        <input type="text" id="FULLNAME" name="FULLNAME" placeholder="Full Name" required>

        <label class="screen-readers-only" for="EMAIL">Email</label>
        <input type="email" id="EMAIL" name="EMAIL" placeholder="Email" required>

        <label class="screen-readers-only" for="PHONE">Phome number (optional)</label>
        <input type="tel" id="PHONE" name="PHONE" placeholder="Phone number (optional)">

        <label class="screen-readers-only" for="COMPANY">Company / Brand Name (optional)</label>
        <input type="text" id="COMPANY" name="COMPANY" placeholder="Company / Brand Name (optional)">

        <select name="INQUIRY" id="INQUIRY">
          <option value="General Inquiry">General Inquiry</option>
          <option value="Press or Media">Press or Media</option>
          <option value="Collaboration / Partnership">Collaboration / Partnership</option>
          <option value="Job Opportunity">Job Opportunity</option>
          <option value="Other">Other</option>
        </select>

        <label class="screen-readers-only" for="MESSAGE">Tell us about your ideas</label>
        <textarea rows="4" id="MESSAGE" name="MESSAGE" placeholder="Tell us about your ideas" required></textarea>

        <input type="submit" value="Send Message" class="cta cta-primary">
      </form>
    </div>
    <div class="contact__details">
      <h2>Email us</h2>
      <p>info@beepossible.com</p>

      <h2>Call us</h2>
      <p>+357 22 041145</p>

      <h2>Find us</h2>
      <p>
        <address><a href="<?php echo esc_url('https://maps.app.goo.gl/wBNB8J44f56N8PFw7');?>" target="_blank" rel="noopener">Stasikratous 32, Charalambous Tower, Floor M, Offices M1-2, Nicosia 1065</a></address>
      </p>

      <iframe title="Our Location on the Map" class="contact-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3261.6582486310485!2d33.35995717634532!3d35.16514295815063!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4eee7667ef895c87%3A0xd9ed0f5b79a2f27a!2sBee%20Possible!5e0!3m2!1sen!2s!4v1756556116023!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </section>

</main>

<?php get_footer(); ?> 