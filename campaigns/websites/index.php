<?php
/**
 * Template Name: Campaign — Websites
 *
 * Advertising landing page: we build websites for businesses in Cyprus.
 *
 * The file is copy and composition only. Every section comes from
 * campaigns/shared/parts, so this reads top to bottom as the argument the page
 * makes, and any structural change lands on every campaign at once.
 *
 * To publish: create a page, then pick this template under Page Attributes.
 */

$endpoint = 'https://formcarry.com/s/YJ-I2UYHqSD';

/**
 * What fills the device in the hero. Two options, and $hero_image wins.
 *
 * 1. A file from assets/images/campaigns. Chosen, predictable, and the artwork
 *    already contains the laptop and the phone, so it is shown whole.
 * 2. Leave $hero_image empty and a case study is queried instead, assembled into
 *    our own laptop frame with a phone beside it. $hero_case_study_slug pins
 *    which one; empty means the most recent with a featured image — which is why
 *    it drifted to a social-video graphic and is worth pinning if you go back.
 *
 * Our own site leads here on purpose: it is the one website we can claim without
 * qualification, and it keeps section 5 to client work only.
 */
$hero_image           = 'assets/images/campaigns/selected-projects.png';
$hero_case_study_slug = '';

/**
 * The websites we show in section 5.
 *
 * These are ready-made device mockups in assets/images/campaigns — each file
 * already contains the browser chrome and the phone, so the work part renders
 * them whole instead of putting them inside one of our own browser frames.
 *
 * A curated list beats querying case studies here: an ad landing page should
 * open with the six sites we most want judged on, in an order we chose, and it
 * must not change shape the next time someone publishes a case study.
 *
 * To swap one out: drop a new 2400x1260 .webp in the folder and edit a row.
 *
 * bee-possible-marketing.webp is deliberately absent — it is in the hero, and the
 * same mockup twice on one scroll reads as a thin portfolio. Add the row back if
 * you point $hero_image at something else.
 */
$showcase = [
	[
		'image'  => 'assets/images/campaigns/amira-com-cy.webp',
		'title'  => 'Amira',
		'sector' => 'Construction & development',
	],
	[
		'image'  => 'assets/images/campaigns/details-made-with-love.webp',
		'title'  => 'Details Made with Love',
		'sector' => 'Flowers & home décor online shop',
	],
	[
		'image'  => 'assets/images/campaigns/mylonas-auto-parts.webp',
		'title'  => 'Mylonas Auto Parts',
		'sector' => 'Automotive parts',
	],
	[
		'image'  => 'assets/images/campaigns/caibull.webp',
		'title'  => 'Caibull',
		'sector' => 'Forex & CFD trading',
	],
	[
		'image'  => 'assets/images/campaigns/omnicore.webp',
		'title'  => 'Omnicore',
		'sector' => 'Business messaging platform',
	],
];

/**
 * FAQs render the accordion and generate the FAQPage schema from one array,
 * so the copy Google sees can never drift from the copy visitors see.
 */
$faqs = [
	[
		'q' => 'How much does a website cost?',
		'a' => "Every project is different. The price depends on the scope, the number of pages, and the features you need. We don’t do fixed packages because we don’t build generic websites. Tell us about your project and we’ll give you an honest, specific quote.",
	],
	[
		'q' => 'How long does a project take?',
		'a' => "It depends on scope and complexity. A focused site moves faster than a full custom online shop. We’ll give you a clear timeline at the proposal stage and we stick to it.",
	],
	[
		'q' => 'I already have a website. Can you improve it, or does it need to be rebuilt?',
		'a' => "Both are possible. We look at what you have and tell you honestly whether it’s worth improving or better to start fresh. We won’t push you towards the more expensive option, just the right one.",
	],
	[
		'q' => 'Do you only work with businesses in Nicosia?',
		'a' => 'No. We work with clients across Cyprus and internationally. Our process works remotely without any compromise.',
	],
	[
		'q' => 'Will I be able to manage the site myself after it is built?',
		'a' => "Yes. We build on WordPress, one of the most widely used platforms in the world. We’ll walk you through how to use it, and we’re available if you need support.",
	],
	[
		'q' => "What if I don’t know exactly what I need yet?",
		'a' => "That’s exactly what the first call is for. Come with your business problem and we’ll figure out what the website should do together.",
	],
];

/**
 * WhatsApp is off for now.
 *
 * 'whatsapp' => false is the single switch: it hides the link in the hero, the
 * "Prefer to talk right now?" aside in the final CTA, and the button in the
 * sticky bar. Nothing else on the page needs touching either way.
 *
 * To turn it back on: flip this to true, uncomment 'whatsapp_message' below and
 * the 'whatsapp' line in section 9, and confirm the number in
 * includes/campaign.php — BP_CAMPAIGN_WHATSAPP is still an unverified landline.
 */
bp_campaign_register( [
	'name'     => 'websites',
	'faqs'     => $faqs,
	'endpoint' => $endpoint,
	'whatsapp' => false,
	// 'whatsapp_message' => 'Hi Bee Possible, I would like to talk about a website for my business.',
	'service'  => 'Website design and development',
] );

/**
 * Hero case study — only looked up when $hero_image is empty. With a mockup set
 * the result is thrown away, and this is the page's first screen: no reason to
 * spend a query on it.
 */
$hero_id = 0;

if ( ! $hero_image ) {
	$hero_query_args = [
		'post_type'      => 'case-study',
		'posts_per_page' => 1,
		'meta_query'     => [ [ 'key' => '_thumbnail_id', 'compare' => 'EXISTS' ] ],
	];

	if ( $hero_case_study_slug ) {
		$hero_query_args['name'] = $hero_case_study_slug;
	}

	$hero_case = new WP_Query( $hero_query_args );
	$hero_id   = $hero_case->have_posts() ? $hero_case->posts[0]->ID : 0;
	wp_reset_postdata();
}

bp_campaign_header();
?>

<main class="campaign-main" id="top">

  <?php
	/* ---------- 1. HERO ---------- */
	bp_campaign_part( 'hero', [
		'eyebrow' => 'Websites, built in Cyprus',
		'title'   => 'Every new client checks your website <em>before</em> they contact you.',
		'sub'     => 'We build websites for businesses across Cyprus. Custom or template, always built to reflect your brand and convert your visitors.',
		'visual'  => bp_campaign_part( 'devices', [
			'image'   => $hero_image,
			'alt'     => 'The Bee Possible website on a laptop and a phone',
			'post_id' => $hero_id,
			'note'    => 'Add a case study with a featured image to fill the hero device.',
		], true ),
	] );


	/* ---------- 2. SOCIAL PROOF ---------- */
	bp_campaign_part( 'proof', [
		'lead'    => '350+ businesses',
		'text'    => 'in Cyprus and beyond.',
		'support' => '',
	] );


	/* ---------- 3. PROBLEM ---------- */
	bp_campaign_part( 'cards', [
		'bg'      => 'paper',
		'heading' => 'Most business websites in Cyprus have the same problem.',
		'variant' => 'rule',
		'cards'   => [
			[
				'title' => "It looks fine. But it’s not converting.",
				'text'  => 'Visitors land, form an opinion in 3 seconds, and leave. You never see it happen. You just wonder why the phone isn’t ringing.',
			],
			[
				'title' => 'It was built years ago. Nothing has changed since.',
				'text'  => "Slow to load. Not optimised for mobile. Google barely registers it. The web has moved on and the website hasn’t.",
			],
			[
				'title' => 'It was built to exist, not to perform.',
				'text'  => "A website that just sits there isn’t a neutral asset. Every day it isn’t driving your business forward, it’s working against you.",
			],
		],
		'outro'   => "If any of that sounds familiar, you’re in the right place.",
	] );


	/* ---------- 4. SOLUTION ---------- */
	bp_campaign_part( 'cards', [
		'bg'      => 'white',
		'layout'  => 'split',
		'heading' => 'A website that does something for your business.',
		'intro'   => [
			'We build websites around your goals, your audience, and the single action you most want visitors to take.',
			'Whether that’s a fully custom build from scratch or a high-performance template enhanced and made uniquely yours, we start with what your business actually needs.',
			[ 'text' => 'Fast. Clean. Optimised for search. Built to grow with you.', 'lead' => true ],
		],
		'variant' => 'pillar',
		'cards'   => [
			[
				'title' => 'Built around your goals',
				'text'  => 'Not a generic page count.',
				'icon'  => '<svg width="28" height="28" viewBox="0 0 28 28" fill="none">
					<circle cx="14" cy="14" r="11" stroke="currentColor" stroke-width="1.5"/>
					<circle cx="14" cy="14" r="5.5" stroke="currentColor" stroke-width="1.5"/>
					<circle cx="14" cy="14" r="1.75" fill="currentColor"/>
				</svg>',
			],
			[
				'title' => 'Mobile-first and SEO-optimised',
				'text'  => 'From the first line of code.',
				'icon'  => '<svg width="28" height="28" viewBox="0 0 28 28" fill="none">
					<rect x="9" y="2.5" width="10" height="23" rx="2.5" stroke="currentColor" stroke-width="1.5"/>
					<path d="M12.25 5.75h3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
					<path d="M3 20.5c2.2-6 6-9.5 11-10.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
				</svg>',
			],
			[
				'title' => 'You own it completely',
				'text'  => 'It scales as your business grows.',
				'icon'  => '<svg width="28" height="28" viewBox="0 0 28 28" fill="none">
					<path d="M4 24V13M11 24V8M18 24V16M25 24V4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
				</svg>',
			],
		],
	] );


	/* ---------- 5. PORTFOLIO ----------
	   Passing 'items' shows the curated mockups from $showcase at the top of this
	   file instead of querying case studies, so what an ad visitor judges us on
	   is chosen rather than whatever was published last. */
	bp_campaign_part( 'work', [
		'heading' => 'The work.',
		'sub'     => 'Judge us before you call us.',
		'items'   => $showcase,
		'count'   => 6,
	] );


	/* ---------- 6. HOW IT WORKS ---------- */
	bp_campaign_part( 'process', [
		'heading' => 'From first conversation to live site.',
		'steps'   => [
			[
				'title' => 'Discovery call',
				'text'  => 'We start by learning your business, your goals, and your audience.',
			],
			[
				'title' => 'Proposal and design direction',
				'text'  => "We come back with a clear plan, structure, and timeline. You know exactly what you’re getting before anything is built.",
			],
			[
				'title' => 'Build and review',
				'text'  => 'You see the site as it comes to life. Feedback built in at every stage. No surprises at the end.',
			],
			[
				'title' => 'Launch and handover',
				'text'  => 'We go live when everything is exactly right. You own the site. We stay available after handover.',
			],
		],
	] );


	/* ---------- 7. TESTIMONIALS ----------
	   Reviews are typed straight into the part. Edit the text in
	   campaigns/shared/parts/testimonials.php. */
	bp_campaign_part( 'testimonials' );


	/* ---------- 8. FAQ ---------- */
	bp_campaign_part( 'faq', [
		'heading' => 'Questions we get asked most.',
	] );


	/* ---------- 9. FINAL CTA ---------- */
	bp_campaign_part( 'enquire', [
		'heading' => 'Ready to have a website that works for you?',
		'sub'     => "Tell us about your business. We’ll come back with an honest, specific answer.",
		// 'whatsapp' => 'Hi Bee Possible, I saw your website page and I would like a quote.',
		'form'     => [
			'form_id'             => 'campaignEnquiry',
			'message_label'       => 'Tell us about your website',
			'message_placeholder' => 'What you have now, what you need it to do, anything we should know.',
		],
	] );
	?>

</main>

<?php bp_campaign_footer(); ?>
