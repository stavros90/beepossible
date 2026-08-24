<?php
/**
 * Process — a numbered sequence.
 *
 * Numbered because the order genuinely carries information: you cannot review a
 * build before there is a proposal. If the steps of a campaign could be read in
 * any order, use the cards part instead.
 *
 * Parameters:
 * - $bg      (string) 'paper' | 'white' | 'dark'
 * - $heading (string)
 * - $steps   (array)  [ [ 'title' => string, 'text' => string ], ... ]
 */

$args = isset( $args ) ? $args : [];

$bg      = isset( $args['bg'] ) ? $args['bg'] : 'paper';
$heading = isset( $args['heading'] ) ? $args['heading'] : '';
$steps   = isset( $args['steps'] ) ? (array) $args['steps'] : [];

if ( ! $steps ) {
	return;
}
?>

<section class="campaign-section campaign-section--<?php echo esc_attr( $bg ); ?> campaign-process">
  <div class="campaign-container">
    <?php if ( $heading ) : ?>
      <h2 class="campaign-h2<?php echo 'dark' === $bg ? ' campaign-h2--alt' : ''; ?>" data-aos="fade-up"><?php echo bp_campaign_kses( $heading ); ?></h2>
    <?php endif; ?>

    <ol class="campaign-process__list">
      <?php foreach ( array_values( $steps ) as $i => $step ) : ?>
        <li class="campaign-process__step" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $i * 80 ); ?>">
          <span class="campaign-process__num"><?php echo esc_html( str_pad( $i + 1, 2, '0', STR_PAD_LEFT ) ); ?></span>
          <h3><?php echo esc_html( $step['title'] ); ?></h3>
          <p><?php echo esc_html( $step['text'] ); ?></p>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>
