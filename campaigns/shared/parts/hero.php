<?php
/**
 * Hero — first screen of any campaign.
 *
 * The copy changes per campaign, the composition does not: eyebrow, headline,
 * one supporting paragraph, a primary CTA next to a WhatsApp link, and a visual
 * slot on the right.
 *
 * Parameters:
 * - $eyebrow  (string)
 * - $title    (string) em / strong / br allowed; <em> is the accent colour
 * - $sub      (string)
 * - $cta_text (string) default 'Contact us'
 * - $cta_href (string) default '#enquire'
 * - $whatsapp (bool|string) false to hide, or a pre-filled message
 * - $visual   (string) markup for the right column, e.g. from the devices part
 */

$args = isset( $args ) ? $args : [];

$eyebrow  = isset( $args['eyebrow'] ) ? $args['eyebrow'] : '';
$title    = isset( $args['title'] ) ? $args['title'] : '';
$sub      = isset( $args['sub'] ) ? $args['sub'] : '';
$cta_text = isset( $args['cta_text'] ) ? $args['cta_text'] : 'Contact us';
$cta_href = isset( $args['cta_href'] ) ? $args['cta_href'] : '#enquire';
$whatsapp = isset( $args['whatsapp'] ) ? $args['whatsapp'] : true;
$visual   = isset( $args['visual'] ) ? $args['visual'] : '';
?>

<section class="campaign-hero<?php echo $visual ? '' : ' campaign-hero--copy-only'; ?>" data-campaign-hero>
  <div class="campaign-container campaign-hero__grid">

    <div class="campaign-hero__copy">
      <?php if ( $eyebrow ) : ?>
        <p class="campaign-eyebrow" data-aos="fade-up"><?php echo esc_html( $eyebrow ); ?></p>
      <?php endif; ?>

      <h1 class="campaign-hero__title" data-aos="fade-up" data-aos-delay="50">
        <?php echo bp_campaign_kses( $title ); ?>
      </h1>

      <?php if ( $sub ) : ?>
        <p class="campaign-hero__sub" data-aos="fade-up" data-aos-delay="100">
          <?php echo bp_campaign_kses( $sub ); ?>
        </p>
      <?php endif; ?>

      <div class="campaign-hero__actions" data-aos="fade-up" data-aos-delay="150">
        <a class="cta cta-primary cta--lg" href="<?php echo esc_url( $cta_href ); ?>" data-campaign-scroll><?php echo esc_html( $cta_text ); ?></a>

        <?php
		if ( false !== $whatsapp ) {
			bp_campaign_part( 'whatsapp-link', [
				'message' => is_string( $whatsapp ) ? $whatsapp : '',
			] );
		}
		?>
      </div>
    </div>

    <?php if ( $visual ) : ?>
      <div class="campaign-hero__visual" data-aos="fade-left" data-aos-delay="200">
        <?php echo $visual; ?>
      </div>
    <?php endif; ?>

  </div>
</section>
