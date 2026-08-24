<?php
/**
 * Device stage — a website on a laptop, with a phone alongside it.
 *
 * Pulled out of the hero so any campaign can drop the composition wherever it
 * wants it, and so the rules about what the frame is allowed to claim live in
 * one place rather than being re-derived per landing page.
 *
 * Two ways to fill it, same as the work grid:
 *
 * 1. $image — a ready-made mockup from assets/images/campaigns. Those files are
 *    composed artwork that already contains the browser chrome and the phone,
 *    which is exactly what the composition below assembles by hand. So the file
 *    is shown whole, with nothing drawn around it: our own frame on top of the
 *    artwork's frame would put two address bars in the hero.
 *
 * 2. $post_id — a case study, assembled into our own laptop and phone.
 *
 * Parameters:
 * - $image   (string) theme-relative path to a mockup. Wins over $post_id
 * - $alt     (string) alt text for the mockup
 * - $post_id (int)    case study to show; 0 renders the empty state
 * - $label   (string) address bar text; defaults to the case study's website_url
 * - $note    (string) empty-state message for editors
 * - $eager   (bool)   true in a hero, where this is the LCP image
 */

$args = isset( $args ) ? $args : [];

$image   = isset( $args['image'] ) ? $args['image'] : '';
$post_id = isset( $args['post_id'] ) ? (int) $args['post_id'] : 0;
$note    = isset( $args['note'] ) ? $args['note'] : 'Add a case study with a featured image to fill the device.';
$eager   = isset( $args['eager'] ) ? (bool) $args['eager'] : true;

/* Checked before the empty state, so a campaign using a mockup never needs a
   case study to exist at all. A missing file falls through to the case study
   rather than rendering a broken image in the first screen. */
if ( $image && file_exists( get_theme_file_path( $image ) ) ) :
	$alt = isset( $args['alt'] ) ? $args['alt'] : 'A website designed and built by Bee Possible';
	?>
  <div class="campaign-stage campaign-stage--mockup">
    <img src="<?php echo esc_url( get_theme_file_uri( $image ) ); ?>"
         alt="<?php echo esc_attr( $alt ); ?>"
         width="2400"
         height="1260"
         <?php echo $eager ? 'loading="eager" fetchpriority="high"' : 'loading="lazy" decoding="async"'; ?>>
  </div>
	<?php
	return;
endif;

if ( ! $post_id ) : ?>
  <div class="campaign-stage campaign-stage--empty">
    <p><?php echo esc_html( $note ); ?></p>
  </div>
  <?php
	return;
endif;

$label = isset( $args['label'] ) ? $args['label'] : '';

if ( '' === $label && function_exists( 'get_field' ) ) {
	$label = get_field( 'website_url', $post_id ) ?: get_field( 'client', $post_id );
}

$loading = $eager
	? [ 'loading' => 'eager', 'fetchpriority' => 'high' ]
	: [ 'loading' => 'lazy' ];

$shot = bp_campaign_shot(
	$post_id,
	'full',
	get_the_title( $post_id ) . ' — website built by Bee Possible',
	$loading
);
?>

<div class="campaign-stage">
  <?php
	bp_campaign_part( 'browser', [
		'image_html' => $shot['html'],
		/* No address bar without a real screenshot: a domain next to a brand
		   image would claim to be a rendered site. */
		'label'      => $shot['is_screenshot'] ? $label : '',
		'modifier'   => 'campaign-browser--laptop' . ( $shot['is_screenshot'] ? '' : ' campaign-browser--brand' ),
		'scroll'     => $shot['is_screenshot'] ? 'auto' : '',
	] );
	?>

  <?php
	/* The phone only appears alongside a real screenshot: a narrow crop of a
	   logo says nothing about how the site behaves on mobile. */
	if ( $shot['is_screenshot'] ) :
		$mobile = bp_campaign_shot( $post_id, 'large', '', $loading );
		?>
    <div class="campaign-phone">
      <div class="campaign-phone__screen">
        <?php echo str_replace( 'campaign-browser__shot', 'campaign-phone__shot', $mobile['html'] ); ?>
      </div>
    </div>
  <?php endif; ?>
</div>
