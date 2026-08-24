<?php
/**
 * Social proof bar — one yellow line directly under the hero.
 *
 * Deliberately a single sentence. It is the first claim after the headline, so
 * it has to be a number a visitor can hold in their head.
 *
 * Parameters:
 * - $lead    (string) the bold part, usually a number
 * - $text    (string) the rest of the sentence
 * - $support (string) quieter second clause
 */

$args = isset( $args ) ? $args : [];

$lead    = isset( $args['lead'] ) ? $args['lead'] : '';
$text    = isset( $args['text'] ) ? $args['text'] : '';
$support = isset( $args['support'] ) ? $args['support'] : '';

if ( ! $lead && ! $text ) {
	return;
}
?>

<section class="campaign-proof">
  <div class="campaign-container">
    <p class="campaign-proof__line">
      <?php if ( $lead ) : ?><strong><?php echo esc_html( $lead ); ?></strong><?php endif; ?>
      <?php echo esc_html( $text ); ?>
      <?php if ( $support ) : ?><span><?php echo esc_html( $support ); ?></span><?php endif; ?>
    </p>
  </div>
</section>
