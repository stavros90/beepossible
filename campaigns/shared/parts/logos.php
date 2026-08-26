<?php
/**
 * Client logo marquee — an auto-scrolling strip of every brand we've worked with.
 *
 * Same idea as the homepage strip in partials/trusted-by.php, rebuilt to the
 * campaign kit's rules rather than reused, for two reasons:
 *
 * 1. Isolation. The homepage version leans on .carousel-* classes defined in
 *    _front-page.scss. Borrowing them would mean a landing page inherits
 *    whatever happens to that file next, which is exactly what /campaigns
 *    exists to prevent.
 * 2. No links. The homepage wraps each logo in an outbound link to the client's
 *    website. On a paid landing page every logo would be a hole in the funnel,
 *    so here they are plain images.
 *
 * The loop is CSS only. The list is printed twice and the track animates to
 * -50%, so the second copy is exactly where the first one started when the
 * animation restarts and the seam is invisible. No JS, no cloning nodes on
 * DOMContentLoaded, and no --item-count arithmetic that has to agree with the
 * markup: the duplicate *is* the measurement.
 *
 * Parameters:
 * - $bg      (string) 'paper' | 'white' | 'dark'
 * - $heading (string) section h2
 * - $sub     (string) quieter line under the heading
 * - $limit   (int)    how many logos to pull; -1 for all
 * - $class   (string) extra classes on the section
 */

$args = isset( $args ) ? $args : [];

$bg      = isset( $args['bg'] ) ? $args['bg'] : 'dark';
$heading = isset( $args['heading'] ) ? $args['heading'] : '';
$sub     = isset( $args['sub'] ) ? $args['sub'] : '';
$limit   = isset( $args['limit'] ) ? (int) $args['limit'] : -1;
$class   = isset( $args['class'] ) ? $args['class'] : '';

$clients = new WP_Query( [
	'post_type'      => 'client',
	'post_status'    => 'publish',
	'posts_per_page' => $limit,
	'orderby'        => 'rand',
	'meta_query'     => [ [ 'key' => '_thumbnail_id', 'compare' => 'EXISTS' ] ],
] );

/* A logo strip with three logos in it is an argument against us. Better to drop
   the whole section than to run a marquee that visibly has nothing to scroll. */
if ( $clients->post_count < 6 ) {
	wp_reset_postdata();
	return;
}

/* One pass at a constant speed rather than a constant duration: 40s reads as
   brisk with twelve logos and as a blur with sixty. */
$duration = max( 30, $clients->post_count * 3 );

/* Collected first so the same list can be printed twice without a second query. */
$logos = [];

while ( $clients->have_posts() ) {
	$clients->the_post();

	$logos[] = wp_get_attachment_image(
		get_post_thumbnail_id(),
		'medium_large',
		false,
		[
			'alt'      => get_the_title(),
			'loading'  => 'lazy',
			'decoding' => 'async',
		]
	);
}

wp_reset_postdata();
$dark = ( 'dark' === $bg );
?>

<section class="campaign-section campaign-section--<?php echo esc_attr( $bg ); ?> campaign-logos <?php echo esc_attr( $class ); ?>">

  <?php if ( $heading || $sub ) : ?>
    <div class="campaign-container">
      <?php if ( $heading ) : ?>
        <h2 class="campaign-h2<?php echo $dark ? ' campaign-h2--alt' : ''; ?>" data-aos="fade-up"><?php echo bp_campaign_kses( $heading ); ?></h2>
      <?php endif; ?>

      <?php if ( $sub ) : ?>
        <p class="campaign-logos__sub" data-aos="fade-up" data-aos-delay="60"><?php echo bp_campaign_kses( $sub ); ?></p>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <div class="campaign-logos__viewport" style="--c-marquee: <?php echo esc_attr( $duration ); ?>s">
    <ul class="campaign-logos__track">
      <?php foreach ( $logos as $logo ) : ?>
        <li class="campaign-logos__item"><?php echo $logo; ?></li>
      <?php endforeach; ?>

      <?php
		/* The second pass is decoration, not content: screen readers and the
		   accessibility tree have already been given every logo once. */
		foreach ( $logos as $logo ) :
			?>
        <li class="campaign-logos__item" aria-hidden="true"><?php echo $logo; ?></li>
      <?php endforeach; ?>
    </ul>
  </div>

</section>
