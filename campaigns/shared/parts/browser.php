<?php
/**
 * Browser frame — the campaign pages' signature element.
 *
 * We sell websites, so the page is built out of the thing being sold: a real
 * screenshot rendered inside real browser chrome. Used at laptop scale in the
 * hero and at card scale across the portfolio grid.
 *
 * Parameters:
 * - $image_html (string) markup from bp_campaign_shot(); required
 * - $label      (string) text shown in the chrome address bar
 * - $modifier   (string) e.g. 'campaign-browser--laptop' | 'campaign-browser--card'
 * - $scroll     (string) 'auto' scrolls on load, 'hover' scrolls on hover/focus, '' static
 */

$args = isset( $args ) ? $args : [];

$image_html = isset( $args['image_html'] ) ? $args['image_html'] : '';
$label      = isset( $args['label'] ) ? $args['label'] : '';
$modifier   = isset( $args['modifier'] ) ? esc_attr( $args['modifier'] ) : '';
$scroll     = isset( $args['scroll'] ) ? esc_attr( $args['scroll'] ) : '';

if ( ! $image_html ) {
	return;
}

// Show a domain the way a browser does, without inventing one we can't verify.
$label = preg_replace( '#^https?://#', '', trim( $label ) );
$label = untrailingslashit( $label );
?>

<div class="campaign-browser <?php echo $modifier; ?>" <?php echo $scroll ? 'data-campaign-scrollshot="' . $scroll . '"' : ''; ?>>
  <div class="campaign-browser__chrome" aria-hidden="true">
    <span class="campaign-browser__dots">
      <i></i><i></i><i></i>
    </span>
    <?php if ( $label ) : ?>
      <span class="campaign-browser__bar">
        <svg width="10" height="12" viewBox="0 0 10 12" fill="none" aria-hidden="true">
          <path d="M2 5V3.5a3 3 0 0 1 6 0V5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
          <rect x="1" y="5" width="8" height="6" rx="1.5" fill="currentColor"/>
        </svg>
        <?php echo esc_html( $label ); ?>
      </span>
    <?php endif; ?>
  </div>

  <div class="campaign-browser__viewport">
    <?php echo $image_html; ?>
  </div>
</div>
