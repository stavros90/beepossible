<?php
/**
 * Campaign footer — minimal chrome shared by every advertising landing page.
 *
 * Loaded with bp_campaign_footer().
 *
 * The only outbound link is the privacy policy, which Google Ads and Meta both
 * require a landing page to carry. Everything else is contact detail: a visitor
 * who scrolls this far should convert, not go browsing.
 */

$show_whatsapp = bp_campaign_whatsapp_enabled();
?>

  <div class="campaign-sticky" data-campaign-sticky aria-label="Get in touch">
    <button type="button" class="campaign-sticky__logo" data-campaign-top aria-label="Back to the top of the page">
      <?php get_template_part( 'assets/images/svg/logo-white' ); ?>
    </button>

    <p class="campaign-sticky__line">Ready when you are.</p>

    <div class="campaign-sticky__actions">
      <a class="cta cta-primary cta--sm" href="#enquire" data-campaign-scroll>Contact us</a>

      <?php if ( $show_whatsapp ) : ?>
        <a class="campaign-whatsapp campaign-whatsapp--icon" href="<?php echo esc_url( bp_campaign_whatsapp_url() ); ?>" target="_blank" rel="noopener" aria-label="Message us on WhatsApp">
          <?php bp_campaign_part( 'whatsapp-icon' ); ?>
          <span class="campaign-whatsapp__label">WhatsApp</span>
        </a>
      <?php endif; ?>
    </div>
  </div>

  <footer class="campaign-footer">
    <div class="campaign-container">
      <div class="campaign-footer__grid">
        <div class="campaign-footer__brand">
          <?php get_template_part( 'assets/images/svg/logo-white' ); ?>
          <p class="campaign-footer__tagline">Strategy, design and development for businesses in Cyprus and beyond.</p>
        </div>

        <div class="campaign-footer__contact">
          <p><?php echo do_shortcode( '[email]info@beepossible.com[/email]' ); ?></p>
          <p><a href="tel:+35722388858">+357 22 388858</a></p>
          <address>Themistokli Dervi 42, Nice Dream Building, Nicosia 1066</address>
        </div>
      </div>

      <div class="campaign-footer__legal">
        <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> Bee Possible Ltd. All rights reserved.</p>
        <a href="<?php echo esc_url( site_url( 'privacy-policy/' ) ); ?>" target="_blank" rel="noopener">Privacy policy</a>
      </div>
    </div>
  </footer>

  <?php wp_footer(); ?>
  </body>
</html>
