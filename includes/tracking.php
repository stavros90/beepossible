<?php
/**
 * Marketing pixels and conversion events.
 *
 * OpenAI Ads pixel (oaiq). Consent-gated through the BeePossible Cookie Consent
 * plugin: the snippet is appended to the plugin's inert <template> via the
 * `bpcc_scripts_header` filter, so it only executes after the visitor clicks
 * Accept (and immediately for returning visitors who already accepted). The
 * page HTML is identical for everyone, so full-page caching stays safe.
 *
 * The lead_created event is included only on the thank-you page that Formcarry
 * redirects to after a successful submission, so only completed enquiries count.
 * Both lead forms (/start-a-project/ and the 360 Marketing Partner campaign)
 * share one Formcarry form and therefore one thank-you page; the hidden SOURCE
 * field on each form is what tells the leads apart in Formcarry.
 *
 * Thank-you page: /what-happens-next/  (noindex via Rank Math, excluded from
 * site search below, never linked from navigation)
 *
 * If the consent plugin is inactive, nothing is output: a tracking pixel must
 * never run without consent.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const BP_OAIQ_PIXEL_ID = 'EEZC98Kc48BjXJzcjRwssf';

/** Slug of the page Formcarry redirects to after a successful lead submission. */
const BP_THANK_YOU_SLUG = 'what-happens-next';

/**
 * Should tracking run for this request at all? (Consent is handled separately
 * by the plugin; this only excludes our own team and non-public views.)
 */
function bp_tracking_enabled() {
	if ( is_user_logged_in() || is_admin() || is_preview() || is_customize_preview() ) {
		return false;
	}
	return true;
}

/**
 * Is the current request the lead thank-you page?
 */
function bp_is_thank_you_page() {
	if ( ! is_page() ) {
		return false;
	}
	return BP_THANK_YOU_SLUG === get_post_field( 'post_name', get_queried_object_id() );
}

/**
 * The OpenAI pixel snippet (init + lead event on the thank-you page) as raw <script> markup.
 */
function bp_oaiq_snippet() {
	$pixel_id = esc_js( BP_OAIQ_PIXEL_ID );

	$html = '<script>!function(w,d,s,u){if(w.oaiq)return;var q=function(){q.q.push(arguments)};q.q=[];w.oaiq=q;var j=d.createElement(s);j.async=1;j.src=u;var f=d.getElementsByTagName(s)[0];f.parentNode.insertBefore(j,f)}(window,document,"script","https://bzrcdn.openai.com/sdk/oaiq.min.js");oaiq("init",{pixelId:"' . $pixel_id . '",debug:false});</script>' . "\n";

	if ( bp_is_thank_you_page() ) {
		// sessionStorage guard: a refresh of the thank-you page must not count a second lead.
		$html .= '<script>(function(){var k="bp_lead_created";try{if(sessionStorage.getItem(k))return;}catch(e){}oaiq("measure","lead_created",{type:"customer_action"});try{sessionStorage.setItem(k,"1");}catch(e){}})();</script>' . "\n";
	}

	return $html;
}

/**
 * Append the pixel to the consent-gated <head> scripts.
 */
add_filter( 'bpcc_scripts_header', function ( $scripts ) {
	if ( ! bp_tracking_enabled() ) {
		return $scripts;
	}
	return $scripts . "\n" . bp_oaiq_snippet();
} );

/**
 * Leave a breadcrumb for developers when the consent plugin is missing, so a
 * silent drop in conversions is easy to diagnose. Visible only in page source.
 */
add_action( 'wp_head', function () {
	if ( bp_tracking_enabled() && ! function_exists( 'bpcc_config' ) ) {
		echo "<!-- bp tracking: BeePossible Cookie Consent plugin inactive; OpenAI pixel not loaded -->\n";
	}
}, 99 );

/**
 * Keep the thank-you page out of the site's own search results. Rank Math
 * handles search engines (noindex + sitemap); this covers WordPress search.
 */
add_action( 'pre_get_posts', function ( $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! $query->is_search() ) {
		return;
	}
	$page = get_page_by_path( BP_THANK_YOU_SLUG );
	if ( $page ) {
		$query->set( 'post__not_in', array_merge( (array) $query->get( 'post__not_in' ), [ $page->ID ] ) );
	}
} );
