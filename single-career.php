<?php get_header(); ?>

<main class="single-post light-section">
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

      <article class="container">
        <?php if (function_exists("rank_math_the_breadcrumbs")) rank_math_the_breadcrumbs(); ?>
        <h1 class="the-title"><?php the_title(); ?></h1>

        <?php the_category( '', null ); ?>

        <?php if(has_post_thumbnail()) : 
          the_post_thumbnail(); 
        endif; ?>

        <div class="the-content">
          <?php the_content(); ?>
          
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
                <input type="hidden" name="POSITION" id="POSITION" placeholder="Position applying for" value="<?php the_title(); ?>" required>

                <input type="text" name="LINKEDIN" id="LINKEDIN" placeholder="LinkedIn profile (optional)">
                <input type="text" name="INSTAGRAM" id="INSTAGRAM" placeholder="Instagram profile (optional)">
                <input type="text" name="PORTFOLIO" id="PORTFOLIO" placeholder="Website or portfolio (optional)">

                <label class="screen-readers-only" id="cv" for="CV">Upload your CV (PDF Only)</label>
                <input type="file" name="CV" id="CV" accept="application/pdf">

                <label class="screen-readers-only" for="COVERLETTER">Cover Letter</label>
                <textarea rows="4" id="COVERLETTER" name="COVERLETTER" placeholder="Cover Letter"></textarea>

                <div class="h-captcha" data-sitekey="68e83946-efae-4068-a37c-3a44401a1bfa"></div>
                <script src="https://js.hcaptcha.com/1/api.js" async defer></script>

                <input class="cta cta-primary" type="submit" value="Apply">
              </form>
            </section>
        </div>
      </article>

    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>