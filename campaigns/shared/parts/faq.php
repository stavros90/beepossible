<?php
/**
 * FAQ accordion.
 *
 * Renders from the same array bp_campaign_register() used to build the FAQPage
 * schema, so the answer Google is shown and the answer a visitor reads are
 * literally the same string.
 *
 * Parameters:
 * - $bg      (string) 'paper' | 'white' | 'dark'
 * - $heading (string)
 * - $faqs    (array)  defaults to the registered campaign FAQs
 */

$args = isset( $args ) ? $args : [];

$bg      = isset( $args['bg'] ) ? $args['bg'] : 'paper';
$heading = isset( $args['heading'] ) ? $args['heading'] : 'Questions we get asked most.';
$faqs    = isset( $args['faqs'] ) ? (array) $args['faqs'] : bp_campaign_get( 'faqs', [] );

if ( ! $faqs ) {
	return;
}
?>

<section class="campaign-section campaign-section--<?php echo esc_attr( $bg ); ?> campaign-faq" id="faq">
  <div class="campaign-container campaign-container--narrow">
    <?php if ( $heading ) : ?>
      <h2 class="campaign-h2<?php echo 'dark' === $bg ? ' campaign-h2--alt' : ''; ?>" data-aos="fade-up"><?php echo bp_campaign_kses( $heading ); ?></h2>
    <?php endif; ?>

    <div class="campaign-faq__list">
      <?php foreach ( array_values( $faqs ) as $i => $faq ) : ?>
        <div class="campaign-faq__item" data-aos="fade-up">
          <h3 class="campaign-faq__heading">
            <button
              type="button"
              class="campaign-faq__question"
              id="faq-q-<?php echo esc_attr( $i ); ?>"
              aria-expanded="false"
              aria-controls="faq-a-<?php echo esc_attr( $i ); ?>"
            >
              <span><?php echo esc_html( $faq['q'] ); ?></span>
              <span class="campaign-faq__marker" aria-hidden="true"></span>
            </button>
          </h3>

          <div
            class="campaign-faq__answer"
            id="faq-a-<?php echo esc_attr( $i ); ?>"
            role="region"
            aria-labelledby="faq-q-<?php echo esc_attr( $i ); ?>"
            hidden
          >
            <p><?php echo esc_html( $faq['a'] ); ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
