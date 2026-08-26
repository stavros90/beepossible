<?php
/**
 * Campaign lead form.
 *
 * Field names follow the convention already used by the other Formcarry forms
 * on the site (FULLNAME / EMAIL / PHONE / MESSAGE) so notification templates and
 * exports stay consistent. SOURCE and PAGE are hidden fields that tell you which
 * campaign a lead came from without needing a separate endpoint per ad.
 *
 * Parameters (all optional — they fall back to bp_campaign_register()):
 * - $endpoint (string) Formcarry form URL
 * - $form_id  (string) DOM id, used by the submit-state script
 * - $source   (string) campaign identifier stored with the lead
 * - $message_label / $message_placeholder (string) the one field whose wording
 *   changes per campaign: what we ask them to tell us about
 * - $submit_label (string) button text. Worth matching to the CTA the ad
 *   promised, so the last click on the page uses the words that got them here
 */

$args = isset( $args ) ? $args : [];

$endpoint = isset( $args['endpoint'] ) ? $args['endpoint'] : bp_campaign_get( 'endpoint' );
$form_id  = isset( $args['form_id'] ) ? esc_attr( $args['form_id'] ) : 'campaignEnquiry';
$source   = isset( $args['source'] ) ? esc_attr( $args['source'] ) : esc_attr( bp_campaign_get( 'name', 'campaign' ) );

$submit_label        = isset( $args['submit_label'] ) ? $args['submit_label'] : 'Enquire';
$message_label       = isset( $args['message_label'] ) ? $args['message_label'] : 'Tell us about your project';
$message_placeholder = isset( $args['message_placeholder'] ) ? $args['message_placeholder'] : 'What you have now, what you need it to do, anything we should know.';

if ( ! $endpoint ) {
	return;
}
?>

<form
  id="<?php echo $form_id; ?>"
  class="campaign-form"
  action="<?php echo esc_url( $endpoint ); ?>"
  method="POST"
  enctype="multipart/form-data"
>
  <div class="campaign-form__row">
    <div class="campaign-field">
      <label for="cf-name">Full name</label>
      <input type="text" id="cf-name" name="FULLNAME" autocomplete="name" required>
    </div>

    <div class="campaign-field">
      <label for="cf-business">Business name</label>
      <input type="text" id="cf-business" name="BUSINESS" autocomplete="organization" required>
    </div>
  </div>

  <div class="campaign-form__row">
    <div class="campaign-field">
      <label for="cf-email">Email address</label>
      <input type="email" id="cf-email" name="EMAIL" autocomplete="email" required>
    </div>

    <div class="campaign-field">
      <label for="cf-phone">Phone number</label>
      <input type="tel" id="cf-phone" name="PHONE" autocomplete="tel" inputmode="tel" required>
    </div>
  </div>

  <div class="campaign-field">
    <label for="cf-message"><?php echo esc_html( $message_label ); ?> <span class="campaign-field__hint">Optional</span></label>
    <textarea id="cf-message" name="MESSAGE" rows="4" placeholder="<?php echo esc_attr( $message_placeholder ); ?>"></textarea>
  </div>

  <?php /* Formcarry discards any submission that fills this in. Bots do; people can't see it. */ ?>
  <input type="text" name="_gotcha" class="campaign-form__gotcha" tabindex="-1" autocomplete="off" aria-hidden="true">

  <input type="hidden" name="SOURCE" value="<?php echo $source; ?>">
  <input type="hidden" name="PAGE" value="<?php echo esc_url( home_url( add_query_arg( [] ) ) ); ?>">

  <div class="campaign-form__captcha">
    <div class="h-captcha" data-sitekey="68e83946-efae-4068-a37c-3a44401a1bfa"></div>
    <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
  </div>

  <button type="submit" class="cta cta-primary cta--lg campaign-form__submit">
    <span class="campaign-form__submit-label"><?php echo esc_html( $submit_label ); ?></span>
  </button>

  <p class="campaign-form__reassure">
    We reply within one working day. No sales sequence, no shared data.
  </p>
</form>
