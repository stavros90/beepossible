<?php 
  if (function_exists('get_template_part')) {
      get_template_part('partials/footer-scroller');
  }
?>
  
  <footer>
    <div class="container container__large">
      <div class="footer-top">
        <div class="footer-top__col">
          <div class="footer-title">Follow us</div>
            <ul class="footer-menu">
                <li><a href="<?php echo esc_url('https://www.linkedin.com/company/beepossible-consulting/'); ?>" target="_blank" rel="noopener">LinkedIn</a></li>
                <li><a href="<?php echo esc_url('https://www.instagram.com/bee.possible/'); ?>" target="_blank" rel="noopener">Instagram</a></li>
                <li><a href="<?php echo esc_url('https://www.facebook.com/beepossible.consulting'); ?>" target="_blank" rel="noopener">Facebook</a></li>
                <li><a href="<?php echo esc_url('https://www.tiktok.com/@bee_possible'); ?>" target="_blank" rel="noopener">TikTok</a></li>
            </ul>
          </div>
          <div class="footer-top__col">
            <div class="footer-title">Work with us</div>
            <ul class="footer-menu">
              <li><a href="<?php echo esc_url(site_url('careers/')); ?>">Careers</a></li>
              <li><a href="<?php echo esc_url(site_url('start-a-project/')); ?>">Start your project</a></li>
            </ul>
          </div>
          <div class="footer-top__col">
            <div class="footer-title lg-text-r">Let's connect</div>
              <p class="footer-text lg-text-r">
                  <?php echo do_shortcode('[email]info@beepossible.com[/email]'); ?>
                  <br>
                  +357 22 388858
                  <br>
                  <a class="privacy-link" href="<?php echo esc_url(site_url('privacy-policy/')); ?>">Privacy Policy</a>
              </p>
              <p class="footer-text lg-text-r">
                <address>
                  Stasikratous 32, 
                  <br>Charalambous Tower, Floor M,
                  <br>Offices M1-2, Λευκωσία
                  <br>1065
                </address>
              </p>
          </div>
        </div>
        <div class="footer-bottom">
          <div class="footer-bottom__col">
            <div class="copyrights">
              <?php get_template_part('/assets/images/svg/logo'); ?>
              <p class="copyright">
                <a href="<?php echo esc_url(site_url('sitemap_index.xml/')); ?>">Sitemap</a> All rights reserved &copy; <?php echo date('Y'); ?> Bee Possible Ltd.
              </p>
            </div>
          </div>
          <div class="footer-bottom__col">
            <p class="buildby">
              Designed and Developed by <a href="<?php echo esc_url(site_url('/')); ?>">Bee Possible</a>
            </p>
          </div>
        </div>
    </div>
  </footer>

  <?php get_template_part('partials/scroll-progress'); ?>

  <?php wp_footer();?>
  </body>
</html>