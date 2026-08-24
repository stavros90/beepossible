<?php
/**
 * Campaign landing pages — bootstrap and shared helpers.
 *
 * Everything a landing page needs lives in /campaigns. Nothing outside that
 * folder is touched, and nothing inside it is loaded on the rest of the site,
 * so the theme can carry twenty campaigns without any of them leaking into the
 * main pages. See campaigns/README.md for the shape of a new campaign.
 *
 *   campaigns/
 *     shared/            chrome, data and section parts every campaign can use
 *     <campaign>/        one folder per landing page; index.php is the template
 *
 * A campaign template announces itself by calling bp_campaign_register() at the
 * very top of the file — before the header runs wp_head() — so the head hooks
 * below know they are on a campaign page and what to output.
 */


/** Root of the campaign folder, relative to the theme. */
if ( ! defined( 'BP_CAMPAIGN_PATH' ) ) {
	define( 'BP_CAMPAIGN_PATH', 'campaigns' );
}

/**
 * WhatsApp business number, digits only, international format, no + or spaces.
 *
 * TODO (before launch): confirm the real WhatsApp business number. The number in
 * footer.php (+357 22 388858) and the one in page-contact-us.php
 * (+357 22 041145) are both landlines and differ from each other.
 *
 * Until that number is confirmed, campaigns turn WhatsApp off with
 * 'whatsapp' => false in bp_campaign_register(). See bp_campaign_whatsapp_enabled().
 */
if ( ! defined( 'BP_CAMPAIGN_WHATSAPP' ) ) {
	define( 'BP_CAMPAIGN_WHATSAPP', '35722388858' );
}


/* =============================================================================
   TEMPLATE DISCOVERY

   WordPress only scans the theme root and one level below it for "Template
   Name" headers, so campaigns/websites/index.php would never appear in the
   Page Attributes dropdown on its own. Registering the templates ourselves
   removes that depth limit, which is what lets each campaign own a folder.
   ============================================================================= */

/**
 * Every campaign template found under /campaigns, as [ relative path => label ].
 */
function bp_campaign_templates() {
	static $templates = null;

	if ( null !== $templates ) {
		return $templates;
	}

	$templates = [];
	$pattern   = get_template_directory() . '/' . BP_CAMPAIGN_PATH . '/*/index.php';

	foreach ( (array) glob( $pattern ) as $file ) {
		$header = get_file_data( $file, [ 'name' => 'Template Name' ] );

		if ( empty( $header['name'] ) ) {
			continue;
		}

		$slug               = basename( dirname( $file ) );
		$relative           = BP_CAMPAIGN_PATH . '/' . $slug . '/index.php';
		$templates[ $relative ] = $header['name'];
	}

	return $templates;
}

add_filter( 'theme_page_templates', function ( $templates ) {
	return array_merge( $templates, bp_campaign_templates() );
} );


/* =============================================================================
   PAGE CONTEXT
   ============================================================================= */

/**
 * Register the current request as a campaign page.
 *
 * @param array $context {
 *     @type string $name             Campaign slug. Becomes the lead source and the body class.
 *     @type array  $faqs             Optional. [ [ 'q' => string, 'a' => string ], ... ] used for
 *                                    both the visible accordion and the FAQPage schema.
 *     @type string $endpoint         Optional. Formcarry URL used by the form part.
 *     @type bool   $whatsapp         Optional. false hides every WhatsApp link on the page,
 *                                    including the one in the sticky bar. Default true.
 *     @type string $whatsapp_message Optional. Default pre-filled WhatsApp message.
 *     @type string $service          Optional. serviceType for the Service schema.
 * }
 */
function bp_campaign_register( $context = [] ) {
	$GLOBALS['bp_campaign'] = wp_parse_args( $context, [
		'name'             => 'campaign',
		'faqs'             => [],
		'endpoint'         => '',
		'whatsapp'         => true,
		'whatsapp_message' => '',
		'service'          => 'Website design and development',
	] );
}


/**
 * Is this request a campaign landing page?
 */
function bp_is_campaign_page() {
	return isset( $GLOBALS['bp_campaign'] );
}


/**
 * Current campaign context, or a single key from it.
 *
 * @param string|null $key     Optional key to read.
 * @param mixed       $default Returned when the key is missing or empty.
 */
function bp_campaign_get( $key = null, $default = '' ) {
	if ( ! bp_is_campaign_page() ) {
		return $default;
	}

	if ( null === $key ) {
		return $GLOBALS['bp_campaign'];
	}

	return ! empty( $GLOBALS['bp_campaign'][ $key ] ) ? $GLOBALS['bp_campaign'][ $key ] : $default;
}


/* =============================================================================
   LOADERS

   Campaign templates use these instead of get_header() / get_template_part()
   so every path into /campaigns goes through one place. The get_header and
   get_footer actions still fire, so anything a plugin hangs on them behaves
   exactly as it does on the rest of the site.
   ============================================================================= */

/**
 * Load the campaign chrome (opening <html> through the header).
 */
function bp_campaign_header() {
	do_action( 'get_header', 'campaign' );
	locate_template( BP_CAMPAIGN_PATH . '/shared/header.php', true, false );
}


/**
 * Load the campaign chrome (sticky bar, footer, closing </html>).
 */
function bp_campaign_footer() {
	do_action( 'get_footer', 'campaign' );
	locate_template( BP_CAMPAIGN_PATH . '/shared/footer.php', true, false );
}


/**
 * Render a shared section or element from campaigns/shared/parts.
 *
 * @param string $name   Part name without the extension, e.g. 'hero'.
 * @param array  $args   Passed to the part as $args.
 * @param bool   $return Return the markup instead of echoing it. Used when one
 *                       part is composed into the slot of another.
 * @return string Markup when $return is true, otherwise an empty string.
 */
function bp_campaign_part( $name, $args = [], $return = false ) {
	$slug = BP_CAMPAIGN_PATH . '/shared/parts/' . $name;

	if ( ! $return ) {
		get_template_part( $slug, null, $args );
		return '';
	}

	ob_start();
	get_template_part( $slug, null, $args );
	return ob_get_clean();
}


/* =============================================================================
   CONTENT HELPERS
   ============================================================================= */

/**
 * Should this campaign show WhatsApp at all?
 *
 * One switch for the whole page: the hero link, the enquire aside and the
 * sticky bar all ask this, so a campaign turns click-to-chat on or off in a
 * single place rather than in three.
 *
 * Read straight from the global rather than through bp_campaign_get(), which
 * treats an explicit false as "not set" and would hand back the default.
 */
function bp_campaign_whatsapp_enabled() {
	if ( ! bp_is_campaign_page() ) {
		return false;
	}

	return ! empty( $GLOBALS['bp_campaign']['whatsapp'] );
}


/**
 * Build a click-to-chat link with an optional pre-filled first message.
 *
 * @param string $message Pre-filled message. Falls back to the campaign default.
 * @return string Unescaped URL. Escape at output with esc_url().
 */
function bp_campaign_whatsapp_url( $message = '' ) {
	$url     = 'https://wa.me/' . preg_replace( '/\D/', '', BP_CAMPAIGN_WHATSAPP );
	$message = $message ? $message : bp_campaign_get( 'whatsapp_message' );

	if ( $message ) {
		// add_query_arg url-encodes the value for us; encoding here would double it.
		$url = add_query_arg( 'text', $message, $url );
	}

	return $url;
}


/**
 * Resolve the image to show inside a browser frame for a case study.
 *
 * A browser frame is a promise: what's inside it should be the website. Case
 * study featured images are brand and campaign visuals, so we look first for a
 * dedicated ACF image field named website_screenshot and only fall back to the
 * featured image. The caller uses is_screenshot to decide whether to scroll the
 * image and whether to show the phone alongside it — a logo shouldn't scroll.
 *
 * @param int    $post_id Case study ID.
 * @param string $size    Image size.
 * @param string $alt     Alt text.
 * @param array  $attrs   Extra <img> attributes.
 * @return array { @type string $html @type bool $is_screenshot }
 */
function bp_campaign_shot( $post_id, $size = 'large', $alt = '', $attrs = [] ) {
	$base = array_merge( [ 'class' => 'campaign-browser__shot', 'alt' => $alt ], $attrs );

	$screenshot = function_exists( 'get_field' ) ? get_field( 'website_screenshot', $post_id ) : null;

	if ( $screenshot ) {
		$attachment_id = 0;

		if ( is_array( $screenshot ) && isset( $screenshot['ID'] ) ) {
			$attachment_id = (int) $screenshot['ID'];
		} elseif ( is_numeric( $screenshot ) ) {
			$attachment_id = (int) $screenshot;
		}

		if ( $attachment_id ) {
			return [
				'html'          => wp_get_attachment_image( $attachment_id, $size, false, $base ),
				'is_screenshot' => true,
			];
		}

		// ACF configured to return a URL string.
		if ( is_string( $screenshot ) ) {
			$attributes = '';
			foreach ( $base as $key => $value ) {
				$attributes .= sprintf( ' %s="%s"', esc_attr( $key ), esc_attr( $value ) );
			}

			return [
				'html'          => sprintf( '<img src="%s"%s>', esc_url( $screenshot ), $attributes ),
				'is_screenshot' => true,
			];
		}
	}

	$base['class'] .= ' campaign-browser__shot--brand';

	return [
		'html'          => get_the_post_thumbnail( $post_id, $size, $base ),
		'is_screenshot' => false,
	];
}


/**
 * Headline markup allowed in part arguments.
 *
 * Campaign copy is written by us, not submitted by anyone, but the copy still
 * passes through wp_kses so a template can only ever emphasise a word — never
 * introduce a link out of the funnel or a stray script.
 */
function bp_campaign_kses( $html ) {
	return wp_kses( $html, [
		'em'     => [],
		'strong' => [],
		'br'     => [],
		'span'   => [ 'class' => [] ],
	] );
}


/* =============================================================================
   SCHEMA
   ============================================================================= */

/**
 * FAQPage schema, generated from the same array that renders the accordion.
 *
 * Keeping one source of truth is the point: an answer edited in the template
 * can never drift away from the answer Google is shown.
 */
add_action( 'wp_head', function () {
	$faqs = bp_campaign_get( 'faqs', [] );

	if ( ! $faqs ) {
		return;
	}

	$entities = [];

	foreach ( $faqs as $faq ) {
		$entities[] = [
			'@type'          => 'Question',
			'name'           => wp_strip_all_tags( $faq['q'] ),
			'acceptedAnswer' => [
				'@type' => 'Answer',
				'text'  => wp_strip_all_tags( $faq['a'] ),
			],
		];
	}

	$schema = [
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'@id'        => get_permalink() . '#faq',
		'mainEntity' => $entities,
	];

	echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>' . "\n";
} );


/**
 * Service schema for campaign pages, so the offer itself is machine-readable.
 */
add_action( 'wp_head', function () {
	if ( ! bp_is_campaign_page() ) {
		return;
	}

	$schema = [
		'@context'    => 'https://schema.org',
		'@type'       => 'Service',
		'@id'         => get_permalink() . '#service',
		'name'        => get_the_title(),
		'serviceType' => bp_campaign_get( 'service', 'Website design and development' ),
		'provider'    => [
			'@type' => 'MarketingAgency',
			'@id'   => 'https://beepossible.com/#marketing-agency',
			'name'  => 'Bee Possible Ltd',
			'url'   => 'https://beepossible.com',
		],
		'areaServed'  => [
			'@type' => 'Country',
			'name'  => 'Cyprus',
		],
	];

	echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>' . "\n";
} );
