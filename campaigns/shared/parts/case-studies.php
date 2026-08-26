<?php
/**
 * Case study cards — the written proof, four to a section.
 *
 * Distinct from the work part, which is a grid of website mockups. This one
 * leads on the result: a client name with a number next to it lands faster than
 * any screenshot of it.
 *
 * The copy is passed in, not queried. A landing page running paid traffic must
 * not change shape because someone published a case study, and the results here
 * ("sales doubled year-on-year") are claims we chose to make in this order.
 *
 * Nothing links out. The brief's alternative — link each card to its full case
 * study — is one argument away and deliberately not taken: the only outbound
 * links on a campaign page are the privacy policy and WhatsApp. Pass 'href' on
 * an item if that ever changes.
 *
 * Images: each card reserves a landscape slot at the top. Leave 'image' out and
 * the slot renders as an empty outlined box, which is the space to show a
 * designer. There is no fallback, no query and no generated composite — set the
 * path when the artwork exists and the box fills.
 *
 * Parameters:
 * - $bg      (string) 'paper' | 'white' | 'dark'
 * - $heading (string) section h2; omit when a preceding section already titled it
 * - $sub     (string) quieter line under the heading
 * - $class   (string) extra classes on the section
 * - $items   (array)  [ {
 *     'client'  => string  the brand. Required
 *     'service' => string  what we sold them, shown as the eyebrow
 *     'image'   => string  theme-relative path to the card image. Empty leaves the box
 *     'alt'     => string  alt text; defaults to the client name
 *     'result'  => string  one number, set large. The card's whole point when it has one
 *     'tagline' => string  a line of positioning, for work whose result isn't a number
 *     'text'    => string  two or three sentences on what we actually did
 *     'quote'   => string  what the client said, verbatim
 *     'source'  => string  who said it
 *     'href'    => string  optional link out. Off by default, see above
 *   }, ... ]
 */

$args = isset( $args ) ? $args : [];

$bg      = isset( $args['bg'] ) ? $args['bg'] : 'paper';
$heading = isset( $args['heading'] ) ? $args['heading'] : '';
$sub     = isset( $args['sub'] ) ? $args['sub'] : '';
$class   = isset( $args['class'] ) ? $args['class'] : '';
$items   = isset( $args['items'] ) ? (array) $args['items'] : [];

if ( ! $items ) {
	return;
}

$dark = ( 'dark' === $bg );
?>

<section class="campaign-section campaign-section--<?php echo esc_attr( $bg ); ?> campaign-proofs <?php echo esc_attr( $class ); ?>">
  <div class="campaign-container">

    <?php if ( $heading ) : ?>
      <h2 class="campaign-h2<?php echo $dark ? ' campaign-h2--alt' : ''; ?>" data-aos="fade-up"><?php echo bp_campaign_kses( $heading ); ?></h2>
    <?php endif; ?>

    <?php if ( $sub ) : ?>
      <p class="campaign-proofs__sub" data-aos="fade-up" data-aos-delay="60"><?php echo bp_campaign_kses( $sub ); ?></p>
    <?php endif; ?>

    <ul class="campaign-proofs__grid">
      <?php foreach ( array_values( $items ) as $i => $item ) : ?>
        <?php
		/* A path that points at nothing would render a broken image on an ad
		   landing page, so it has to exist before the slot uses it. Otherwise
		   the empty box shows, which is the honest state anyway. */
		$image = ( ! empty( $item['image'] ) && file_exists( get_theme_file_path( $item['image'] ) ) )
			? $item['image']
			: '';
		?>

        <li class="campaign-proofs__item" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( ( $i % 2 ) * 80 ); ?>">

          <div class="campaign-proofs__media<?php echo $image ? '' : ' campaign-proofs__media--empty'; ?>">
            <?php if ( $image ) : ?>
              <img src="<?php echo esc_url( get_theme_file_uri( $image ) ); ?>"
                   alt="<?php echo esc_attr( ! empty( $item['alt'] ) ? $item['alt'] : $item['client'] ); ?>"
                   width="1200"
                   height="800"
                   loading="lazy"
                   decoding="async">
            <?php else : ?>
              <span>Image to come</span>
            <?php endif; ?>
          </div>

          <?php if ( ! empty( $item['service'] ) ) : ?>
            <p class="campaign-proofs__service"><?php echo esc_html( $item['service'] ); ?></p>
          <?php endif; ?>

          <h3 class="campaign-proofs__client">
            <?php if ( ! empty( $item['href'] ) ) : ?>
              <a href="<?php echo esc_url( $item['href'] ); ?>"><?php echo esc_html( $item['client'] ); ?></a>
            <?php else : ?>
              <?php echo esc_html( $item['client'] ); ?>
            <?php endif; ?>
          </h3>

          <?php if ( ! empty( $item['result'] ) ) : ?>
            <p class="campaign-proofs__result"><?php echo bp_campaign_kses( $item['result'] ); ?></p>
          <?php endif; ?>

          <?php if ( ! empty( $item['tagline'] ) ) : ?>
            <p class="campaign-proofs__tagline"><?php echo bp_campaign_kses( $item['tagline'] ); ?></p>
          <?php endif; ?>

          <?php if ( ! empty( $item['text'] ) ) : ?>
            <p class="campaign-proofs__text"><?php echo bp_campaign_kses( $item['text'] ); ?></p>
          <?php endif; ?>

          <?php if ( ! empty( $item['quote'] ) ) : ?>
            <figure class="campaign-proofs__quote">
              <blockquote><?php echo bp_campaign_kses( $item['quote'] ); ?></blockquote>
              <?php if ( ! empty( $item['source'] ) ) : ?>
                <figcaption><?php echo esc_html( $item['source'] ); ?></figcaption>
              <?php endif; ?>
            </figure>
          <?php endif; ?>

        </li>
      <?php endforeach; ?>
    </ul>

  </div>
</section>
