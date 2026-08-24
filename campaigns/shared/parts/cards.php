<?php
/**
 * Cards — the repeating "here are three things" section.
 *
 * Two shapes, because these are the two that keep coming back on landing pages:
 *
 *   variant 'rule'   pain points or arguments. Larger text, a yellow rule
 *                    marking where each one starts. No boxes: a card border
 *                    around a sentence adds weight without adding meaning.
 *   variant 'pillar' short benefit statements, optionally with an icon.
 *
 * Parameters:
 * - $bg      (string) 'paper' | 'white' | 'dark'
 * - $id      (string) anchor id
 * - $heading (string)
 * - $layout  (string) 'stack' heading above the cards | 'split' heading left, intro right
 * - $intro   (array)  paragraphs. Each item is a string, or [ 'text' => string, 'lead' => bool ]
 * - $cards   (array)  [ [ 'title' => string, 'text' => string, 'icon' => svg markup ], ... ]
 * - $variant (string) 'rule' | 'pillar'
 * - $outro   (string) closing line, centred under the cards
 * - $class   (string) extra classes on the section
 */

$args = isset( $args ) ? $args : [];

$bg      = isset( $args['bg'] ) ? $args['bg'] : 'paper';
$id      = isset( $args['id'] ) ? $args['id'] : '';
$heading = isset( $args['heading'] ) ? $args['heading'] : '';
$layout  = isset( $args['layout'] ) ? $args['layout'] : 'stack';
$intro   = isset( $args['intro'] ) ? (array) $args['intro'] : [];
$cards   = isset( $args['cards'] ) ? (array) $args['cards'] : [];
$variant = isset( $args['variant'] ) ? $args['variant'] : 'rule';
$outro   = isset( $args['outro'] ) ? $args['outro'] : '';
$class   = isset( $args['class'] ) ? $args['class'] : '';

if ( ! $cards && ! $heading ) {
	return;
}

$dark = ( 'dark' === $bg );
?>

<section
  class="campaign-section campaign-section--<?php echo esc_attr( $bg ); ?> campaign-cards <?php echo esc_attr( $class ); ?>"
  <?php echo $id ? 'id="' . esc_attr( $id ) . '"' : ''; ?>
>
  <div class="campaign-container">

    <?php if ( 'split' === $layout && $intro ) : ?>
      <div class="campaign-cards__intro">
        <h2 class="campaign-h2<?php echo $dark ? ' campaign-h2--alt' : ''; ?>" data-aos="fade-up"><?php echo bp_campaign_kses( $heading ); ?></h2>

        <div class="campaign-cards__body" data-aos="fade-up" data-aos-delay="80">
          <?php foreach ( $intro as $paragraph ) : ?>
            <?php
			$text = is_array( $paragraph ) ? $paragraph['text'] : $paragraph;
			$lead = is_array( $paragraph ) && ! empty( $paragraph['lead'] );
			?>
            <p<?php echo $lead ? ' class="campaign-cards__lead"' : ''; ?>><?php echo bp_campaign_kses( $text ); ?></p>
          <?php endforeach; ?>
        </div>
      </div>

    <?php else : ?>
      <?php if ( $heading ) : ?>
        <h2 class="campaign-h2<?php echo $dark ? ' campaign-h2--alt' : ''; ?>" data-aos="fade-up"><?php echo bp_campaign_kses( $heading ); ?></h2>
      <?php endif; ?>

      <?php if ( $intro ) : ?>
        <div class="campaign-cards__body" data-aos="fade-up">
          <?php foreach ( $intro as $paragraph ) : ?>
            <?php
			$text = is_array( $paragraph ) ? $paragraph['text'] : $paragraph;
			$lead = is_array( $paragraph ) && ! empty( $paragraph['lead'] );
			?>
            <p<?php echo $lead ? ' class="campaign-cards__lead"' : ''; ?>><?php echo bp_campaign_kses( $text ); ?></p>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    <?php endif; ?>

    <?php if ( $cards ) : ?>
      <ul class="campaign-cards__list campaign-cards__list--<?php echo esc_attr( $variant ); ?>">
        <?php foreach ( array_values( $cards ) as $i => $card ) : ?>
          <li class="campaign-cards__item" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( ( $i % 3 ) * 80 ); ?>">
            <?php if ( ! empty( $card['icon'] ) ) : ?>
              <span class="campaign-cards__icon" aria-hidden="true"><?php echo $card['icon']; ?></span>
            <?php endif; ?>

            <?php if ( ! empty( $card['title'] ) ) : ?>
              <h3><?php echo bp_campaign_kses( $card['title'] ); ?></h3>
            <?php endif; ?>

            <?php if ( ! empty( $card['text'] ) ) : ?>
              <p><?php echo bp_campaign_kses( $card['text'] ); ?></p>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <?php if ( $outro ) : ?>
      <p class="campaign-cards__outro" data-aos="fade-up"><?php echo bp_campaign_kses( $outro ); ?></p>
    <?php endif; ?>

  </div>
</section>
