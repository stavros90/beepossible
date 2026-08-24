<?php
/**
 * Portfolio grid — our websites, two cards to a row.
 *
 * Two sources, one grid:
 *
 * 1. $items — a curated list of ready-made device mockups shipped with the
 *    theme. Use this when the images already contain their own browser chrome
 *    and phone, which is the case for everything in assets/images/campaigns.
 *    Those files are composed artwork, so they are shown whole and never fed
 *    through the browser part — that part adds chrome, and the result would be
 *    two address bars on one card.
 *
 * 2. No $items — a live query of the case-study post type, shown inside our own
 *    browser frames, so the grid stays current without anyone editing a landing
 *    page. Only case studies with a featured image are queried: an empty frame
 *    is worse than one fewer card.
 *
 * Parameters:
 * - $bg        (string) 'paper' | 'white' | 'dark'; dark by default, the grid is built for it
 * - $heading   (string)
 * - $sub       (string)
 * - $items     (array)  curated cards, each [ 'image', 'title', 'sector', 'alt' ] where
 *                       image is a theme-relative path. Bypasses the case-study query.
 * - $count     (int)    how many cards; trims $items too
 * - $exclude   (array)  post IDs to skip, e.g. the one already in the hero. Query mode only
 * - $invite    (string) the large line above the closing CTA
 * - $cta_text  (string) '' hides the CTA
 * - $cta_href  (string)
 */

$args = isset( $args ) ? $args : [];

$bg       = isset( $args['bg'] ) ? $args['bg'] : 'dark';
$heading  = isset( $args['heading'] ) ? $args['heading'] : 'The work.';
$sub      = isset( $args['sub'] ) ? $args['sub'] : '';
$items    = isset( $args['items'] ) ? (array) $args['items'] : [];
$count    = isset( $args['count'] ) ? (int) $args['count'] : 6;
$exclude  = isset( $args['exclude'] ) ? array_filter( (array) $args['exclude'] ) : [];
$invite   = isset( $args['invite'] ) ? $args['invite'] : 'Yours could be here.';
$cta_text = isset( $args['cta_text'] ) ? $args['cta_text'] : 'Contact us';
$cta_href = isset( $args['cta_href'] ) ? $args['cta_href'] : '#enquire';

$dark = ( 'dark' === $bg );

/* A mistyped filename would render a broken card on an ad landing page, so the
   file has to exist before it earns a slot in the grid. */
if ( $items ) {
	$items = array_values( array_filter( $items, function ( $item ) {
		return ! empty( $item['image'] ) && file_exists( get_theme_file_path( $item['image'] ) );
	} ) );

	$items = array_slice( $items, 0, $count );
}

$work = null;

if ( ! $items ) {
	$work = new WP_Query( [
		'post_type'      => 'case-study',
		'posts_per_page' => $count,
		'post__not_in'   => $exclude,
		'meta_query'     => [ [ 'key' => '_thumbnail_id', 'compare' => 'EXISTS' ] ],
	] );

	if ( ! $work->have_posts() ) {
		wp_reset_postdata();
		return;
	}
}
?>

<section class="campaign-section campaign-section--<?php echo esc_attr( $bg ); ?> campaign-work">
  <div class="campaign-container">
    <header class="campaign-work__head">
      <h2 class="campaign-h2<?php echo $dark ? ' campaign-h2--alt' : ''; ?>" data-aos="fade-up"><?php echo bp_campaign_kses( $heading ); ?></h2>
      <?php if ( $sub ) : ?>
        <p class="campaign-work__sub" data-aos="fade-up" data-aos-delay="60"><?php echo esc_html( $sub ); ?></p>
      <?php endif; ?>
    </header>

    <div class="campaign-work__grid<?php echo $items ? ' campaign-work__grid--mockups' : ''; ?>">
      <?php if ( $items ) : ?>

        <?php foreach ( $items as $index => $item ) :
			$title  = isset( $item['title'] ) ? $item['title'] : '';
			$sector = isset( $item['sector'] ) ? $item['sector'] : '';
			$alt    = isset( $item['alt'] ) ? $item['alt'] : trim( $title . ' website, designed and built by Bee Possible' );
			?>
          <article class="campaign-work__item" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( ( $index % 2 ) * 80 ); ?>">
            <div class="campaign-work__mockup">
              <img src="<?php echo esc_url( get_theme_file_uri( $item['image'] ) ); ?>"
                   alt="<?php echo esc_attr( $alt ); ?>"
                   width="2400"
                   height="1260"
                   loading="lazy"
                   decoding="async">
            </div>

            <?php if ( $title || $sector ) : ?>
              <div class="campaign-work__meta">
                <?php if ( $title ) : ?>
                  <h3><?php echo esc_html( $title ); ?></h3>
                <?php endif; ?>
                <?php if ( $sector ) : ?>
                  <p><?php echo esc_html( $sector ); ?></p>
                <?php endif; ?>
              </div>
            <?php endif; ?>
          </article>
        <?php endforeach; ?>

      <?php else : ?>
      <?php
		$index = 0;

		while ( $work->have_posts() ) :
			$work->the_post();

			/* Some case studies have the client field filled in as "N/A"; the post
			   title is a better fallback than printing that on an ad landing page. */
			$client = trim( (string) get_field( 'client' ) );
			if ( '' === $client || preg_match( '/^n\/?a\.?$/i', $client ) ) {
				$client = get_the_title();
			}

			/* Prefer a written industry descriptor; the case-study-cat taxonomy
			   describes the service we sold, not the client's sector. */
			$sector = trim( (string) get_field( 'industry' ) );
			if ( '' === $sector ) {
				$terms  = get_the_terms( get_the_ID(), 'case-study-cat' );
				$sector = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->name : '';
			}

			$label = get_field( 'website_url' ) ?: $client;
			$shot  = bp_campaign_shot(
				get_the_ID(),
				'large',
				$client . ' website, built by Bee Possible',
				[ 'loading' => 'lazy' ]
			);
			?>

        <article class="campaign-work__item" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( ( $index % 3 ) * 80 ); ?>">
          <?php
			/* Browser chrome is a claim that what's inside is the live site. With
			   no screenshot we show the brand image as a plain plate instead of an
			   empty browser window. */
			if ( $shot['is_screenshot'] ) {
				bp_campaign_part( 'browser', [
					'image_html' => $shot['html'],
					'label'      => $label,
					'modifier'   => 'campaign-browser--card',
					'scroll'     => 'hover',
				] );
			} else {
				echo '<div class="campaign-work__plate">' . $shot['html'] . '</div>';
			}
			?>

          <div class="campaign-work__meta">
            <h3><?php echo esc_html( $client ); ?></h3>
            <?php if ( $sector ) : ?>
              <p><?php echo esc_html( $sector ); ?></p>
            <?php endif; ?>
          </div>
        </article>

			<?php
			$index++;
		endwhile;

		wp_reset_postdata();
		?>

      <?php endif; ?>
    </div>

    <?php if ( $invite || $cta_text ) : ?>
      <div class="campaign-work__cta" data-aos="fade-up">
        <?php if ( $invite ) : ?>
          <p class="campaign-work__invite"><?php echo esc_html( $invite ); ?></p>
        <?php endif; ?>

        <?php if ( $cta_text ) : ?>
          <a class="cta cta-primary cta--lg" href="<?php echo esc_url( $cta_href ); ?>" data-campaign-scroll><?php echo esc_html( $cta_text ); ?></a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
