<?php
/**
 * Final CTA — the section the whole page exists to reach.
 *
 * Always carries the #enquire id, because the hero CTA, the portfolio CTA and
 * the sticky bar all point at it, and the skip link in the header targets it too.
 *
 * Parameters:
 * - $bg             (string) 'dark' by default
 * - $heading        (string)
 * - $sub            (string)
 * - $whatsapp_intro (string) line above the WhatsApp button; '' hides the aside
 * - $whatsapp       (string) pre-filled message
 * - $form           (array)  passed straight through to the form part
 */

$args = isset( $args ) ? $args : [];

$bg             = isset( $args['bg'] ) ? $args['bg'] : 'dark';
$heading        = isset( $args['heading'] ) ? $args['heading'] : 'Ready to get started?';
$sub            = isset( $args['sub'] ) ? $args['sub'] : '';
$whatsapp_intro = isset( $args['whatsapp_intro'] ) ? $args['whatsapp_intro'] : 'Prefer to talk right now?';
$whatsapp       = isset( $args['whatsapp'] ) ? $args['whatsapp'] : '';
$form           = isset( $args['form'] ) ? (array) $args['form'] : [];

/* The intro line only makes sense above a button. With WhatsApp switched off for
   the campaign the whole aside goes, not just the link inside it. */
if ( ! bp_campaign_whatsapp_enabled() ) {
	$whatsapp_intro = '';
}

$dark = ( 'dark' === $bg );
?>

<section class="campaign-section campaign-section--<?php echo esc_attr( $bg ); ?> campaign-enquire" id="enquire" data-campaign-form-section>
  <div class="campaign-container">
    <div class="campaign-enquire__grid">

      <div class="campaign-enquire__copy">
        <h2 class="campaign-h2<?php echo $dark ? ' campaign-h2--alt' : ''; ?>" data-aos="fade-up">
          <?php echo bp_campaign_kses( $heading ); ?>
        </h2>

        <?php if ( $sub ) : ?>
          <p class="campaign-enquire__sub" data-aos="fade-up" data-aos-delay="60"><?php echo bp_campaign_kses( $sub ); ?></p>
        <?php endif; ?>

        <?php if ( $whatsapp_intro ) : ?>
          <div class="campaign-enquire__aside" data-aos="fade-up" data-aos-delay="120">
            <p class="campaign-enquire__whatsapp-intro"><?php echo esc_html( $whatsapp_intro ); ?></p>
            <?php
			bp_campaign_part( 'whatsapp-link', [
				'message'  => $whatsapp,
				'modifier' => 'campaign-whatsapp--solid',
			] );
			?>
          </div>
        <?php endif; ?>
      </div>

      <div class="campaign-enquire__form" data-aos="fade-up" data-aos-delay="80">
        <?php bp_campaign_part( 'form', $form ); ?>
      </div>

    </div>
  </div>
</section>
