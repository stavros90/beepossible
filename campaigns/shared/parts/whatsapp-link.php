<?php
/**
 * WhatsApp click-to-chat link.
 *
 * Parameters:
 * - $message  (string) pre-filled first message; falls back to the campaign default
 * - $label    (string) visible text
 * - $modifier (string) '' | 'campaign-whatsapp--solid' | 'campaign-whatsapp--icon'
 *
 * Renders nothing when the campaign was registered with 'whatsapp' => false. The
 * guard lives here as well as in the callers, so a page that has WhatsApp turned
 * off can never leak a click-to-chat link through a part that forgot to ask.
 */

if ( ! bp_campaign_whatsapp_enabled() ) {
	return;
}

$args = isset( $args ) ? $args : [];

$message  = isset( $args['message'] ) ? $args['message'] : '';
$label    = isset( $args['label'] ) ? $args['label'] : 'Message us on WhatsApp';
$modifier = isset( $args['modifier'] ) ? $args['modifier'] : '';
?>

<a class="campaign-whatsapp <?php echo esc_attr( $modifier ); ?>"
   href="<?php echo esc_url( bp_campaign_whatsapp_url( $message ) ); ?>"
   target="_blank"
   rel="noopener">
  <?php bp_campaign_part( 'whatsapp-icon' ); ?>
  <span><?php echo esc_html( $label ); ?></span>
</a>
