<?php
/**
 * Template Name: Campaign — 360° Marketing Partner
 *
 * Advertising landing page: one agency for strategy, creatives, digital,
 * events and web.
 *
 * Copy and composition only. Every section comes from campaigns/shared/parts,
 * so this file reads top to bottom as the argument the page makes and any
 * structural change lands on every campaign at once.
 *
 * Published at /360-marketing-partner. The brief specified
 * /360-marketing-cyprus; the slug was changed on request. Nothing in this file
 * depends on it — the slug lives on the WordPress page, not here.
 *
 * To publish: create a page, then pick this template under Page Attributes.
 */

/**
 * Same endpoint as the websites campaign, on purpose.
 *
 * The form posts a SOURCE field carrying the campaign name, so one Formcarry
 * form separates leads by campaign without a second endpoint to configure,
 * pay for and keep in sync.
 */
$endpoint = 'https://formcarry.com/s/msoDaOsiOTb';

/**
 * The hero collage. Empty until the artwork exists.
 *
 * The brief asks for a collage of real work — event production, campaign
 * creatives, websites, brand photography, no stock. We have no such file yet,
 * and the mockups in assets/images/campaigns are all websites, which would
 * argue the opposite of this page: that we are a web shop.
 *
 * So the hero runs copy-only for now. That is a finished layout rather than a
 * gap — the hero part centres the column when there is no visual — and it
 * beats a placeholder box in the first screen of a page taking paid traffic.
 *
 * To turn the visual on: export the collage at 2400x1260 into
 * assets/images/campaigns and set the path here. Nothing else changes.
 */
$hero_image = '';

/**
 * The four cards in section 4.
 *
 * Written proof rather than screenshots: on a 360° page the argument is the
 * result, and "sales doubled year-on-year" lands faster than any image of it.
 *
 * Passed in rather than queried so the section cannot change shape the next
 * time someone publishes a case study, and so the order is one we chose. None
 * of them link out — see the note in the case-studies part.
 *
 * IMAGES ARE MISSING ON PURPOSE. Every card renders an outlined box at the
 * final 3:2 crop, which is the space to hand a designer. To fill one, drop the
 * file in assets/images/campaigns and add the path:
 *
 *   'image' => 'assets/images/campaigns/case-dior.webp',
 *
 * Export at 1200 × 800. A path pointing at a file that isn't there falls back
 * to the empty box rather than rendering broken.
 *
 * Decathlon is the brief's "TBD (Performance Marketing)" slot, finally filled:
 * it is the one case study carrying hard paid-media numbers. Its card image is
 * the only one still missing — case-decathlon.webp does not exist yet, so that
 * card shows the outlined box until the file lands.
 *
 * XM has no figure attached and leads on a tagline instead. Use 'result' where
 * there is a number and 'tagline' where there isn't; work whose value is not a
 * percentage still needs a headline.
 */
$case_studies = [
	[
		'client'  => 'Dior Cyprus',
		'service' => 'Event production',
		'image'   => 'assets/images/campaigns/case-dior.webp',
		'tagline' => 'A fragrance launch executed to Dior’s global standard.',
		'text'    => 'Full production of the Dior Paradise launch at La Collection Privée, Mall of Cyprus. Creative direction, VIP guest management, full supplier roster, and on-site execution from concept to close.',
		'quote'   => 'The Bee Possible team executed every aspect of the event to the highest standard, while ensuring everything remained perfectly aligned with our brand principles and guidelines.',
		'source'  => 'Dior Cyprus',
	],
	[
		'client'  => 'Decathlon Cyprus',
		'service' => 'Performance marketing',
		'image'   => 'assets/images/campaigns/case-decathlon.webp',
		'result'  => '+93% purchases on 32% more budget',
		'text'    => 'Paid media across Meta and Google. Spend scaled by roughly a third while efficiency improved rather than slipped: Meta ROAS from 10.34x to 14.69x, and Google at 49.53x with conversions up as spend fell 24%.',
	],
	[
		'client'  => 'CP Herbalist',
		'service' => 'Full digital marketing',
		'image'   => 'assets/images/campaigns/case-cp-herbalist.webp',
		'result'  => 'Sales doubled year-on-year',
		'text'    => 'Strategy, Meta advertising, email marketing, and social media management for one of the leading skincare e-commerce brands in Cyprus.',
	],
	[
		'client'  => 'XM',
		'service' => 'Creative production and social video',
		'image'   => 'assets/images/campaigns/case-xm.webp',
		'tagline' => 'Turning complex messaging into scroll-stopping content.',
		'text'    => 'Two social launch videos for the global broker: one for their presence at Devoxx Poland, one announcing their cybersecurity course. Concept, scriptwriting, motion direction and social optimisation, built to work on muted autoplay.',
	],
];

/** Titles section 4. Sits on the logo strip, or on the cards if the strip drops out. */
$brands_heading = 'Brands we’ve worked with.';

/**
 * FAQs render the accordion and generate the FAQPage schema from one array, so
 * the copy Google sees can never drift from the copy visitors read.
 */
$faqs = [
	[
		'q' => 'Do you work with businesses outside Cyprus?',
		'a' => 'Yes. Most of our clients are based in Cyprus, but we have worked with brands across Europe. If the project is the right fit, location is not a barrier.',
	],
	[
		'q' => 'How long does it take to get started?',
		'a' => 'It depends on the scope. A single-service project moves faster than a full brand setup. Once we have an agreed plan, we will give you a clear and realistic timeline as part of the proposal.',
	],
	[
		'q' => 'What does working with you cost?',
		'a' => 'It varies by service and scale. We do not have a fixed package that we fit everyone into. After the first call we can give you a clear picture of what we would recommend and what it costs.',
	],
	[
		'q' => 'Do we need to commit to all services?',
		'a' => 'No. Some clients work with us across every service. Others focus on one area. We will tell you honestly what makes sense for where your business is.',
	],
];

/**
 * WhatsApp is off, matching the websites campaign.
 *
 * One switch: it hides the hero link, the "Prefer to talk right now?" aside in
 * the final CTA, and the button in the sticky bar. Turn it on by flipping this
 * to true and uncommenting 'whatsapp_message' — but confirm the number in
 * includes/campaign.php first, where BP_CAMPAIGN_WHATSAPP is still an
 * unverified landline.
 */
bp_campaign_register( [
	'name'     => '360-marketing-partner',
	'faqs'     => $faqs,
	'endpoint' => $endpoint,
	'whatsapp' => false,
	// 'whatsapp_message' => 'Hi Bee Possible, I would like to talk about marketing for my brand.',
	'service'  => 'Full-service marketing, advertising and event production',
] );

bp_campaign_header();
?>

<main class="campaign-main" id="top">

  <?php
	/* ---------- 1. HERO ---------- */
	bp_campaign_part( 'hero', [
		'eyebrow'  => 'Full-service marketing partner',
		'title'    => 'A full-service marketing agency for brands that <em>take growth seriously</em>.',
		'sub'      => 'Strategy, creatives, digital marketing, events, and web development. All under one roof, working towards one goal.',
		'cta_text' => 'Let’s talk',
		'visual'   => $hero_image
			? bp_campaign_part( 'devices', [
				'image' => $hero_image,
				'alt'   => 'Campaign creatives, event production and websites by Bee Possible',
			], true )
			: '',
	] );


	/* ---------- 2. SERVICES ----------
	   'pillar' rather than 'rule': the rule variant marks each card with a
	   yellow accent line, which reads as separate arguments when the point is
	   that the services are one offer.

	   Six cards, so the grid is a plain three across, two rows. "& more" closes
	   the list rather than pretending the five above it are exhaustive. The page
	   stylesheet turns them into panels off the --services class. */
	bp_campaign_part( 'cards', [
		'bg'      => 'white',
		'class'   => 'campaign-cards--services',
		'heading' => 'What we do.',
		'variant' => 'pillar',
		'cards'   => [
			[
				'title' => 'Strategy',
				'text'  => 'Brand positioning, market research, growth planning, and campaign architecture. The thinking that everything else is built on.',
			],
			[
				'title' => 'Creatives',
				'text'  => 'Graphic design, copywriting, photography, video, and ad creatives. The creative output that defines how a brand is seen.',
			],
			[
				'title' => 'Digital marketing',
				'text'  => 'Meta, Google, LinkedIn, and TikTok advertising. Social media management, email marketing, and performance analytics. Built to convert.',
			],
			[
				'title' => 'PR and events',
				'text'  => 'Event production, influencer partnerships, press, and brand activations. End to end, from the first concept to the final cut.',
			],
			[
				'title' => 'Web development',
				'text'  => 'Custom and template website builds. Fast, clean, and optimised for search from day one.',
			],
			[
				'title' => '&amp; more',
				'text'  => 'Brand identity, packaging and labels, signage, print and large format, merchandise. If it carries your brand, we produce it — ask us.',
			],
		],
	] );


	/* ---------- 3. THE 360° CASE ----------
	   The cards part with no cards: heading on the left, the argument on the
	   right. This is the page's thesis, so it gets a section to itself. */
	bp_campaign_part( 'cards', [
		'bg'      => 'paper',
		'class'   => 'campaign-cards--thesis',
		'layout'  => 'split',
		'heading' => 'The reason it works.',
		'intro'   => [
			'When strategy, creatives, digital, events, and web come from the same team and run off the same plan, every part of the marketing effort compounds on every other part. No briefing across agencies.',
			[
				'text' => 'That is what a 360° partner means in practice. A fundamentally different way of working.',
				'lead' => true,
			],
		],
	] );


	/* ---------- 4. BRANDS WE'VE WORKED WITH ----------
	   Two parts on one dark background: the logo strip carries the heading and
	   the case studies run flush underneath, so the pair reads as one section.

	   Captured rather than echoed straight out because the strip drops itself
	   when there are too few client logos to scroll. If that happens the
	   heading has to move down to the cards, or section 4 would arrive with no
	   title and no top padding. */
	$logo_strip = trim( bp_campaign_part( 'logos', [
		'bg'      => 'dark',
		'heading' => $brands_heading,
		'sub'     => 'Trusted by 350+ companies in Cyprus and beyond.',
	], true ) );

	echo $logo_strip; // phpcs:ignore WordPress.Security.EscapeOutput -- part output.

	bp_campaign_part( 'case-studies', [
		'bg'      => 'dark',
		'class'   => $logo_strip ? 'campaign-section--flush-top' : '',
		'heading' => $logo_strip ? '' : $brands_heading,
		'items'   => $case_studies,
	] );


	/* ---------- 5. PROCESS ---------- */
	bp_campaign_part( 'process', [
		'bg'      => 'paper',
		'heading' => 'How we start.',
		'steps'   => [
			[
				'title' => 'Discovery',
				'text'  => 'One conversation about your business, your goals, and where you are right now. We ask the right questions before we make any recommendations.',
			],
			[
				'title' => 'Proposal',
				'text'  => 'A clear view of what we would do, why, and in what order. Specific to your brand, not a standard package.',
			],
			[
				'title' => 'Execution',
				'text'  => 'We build and run everything with your team as a direct point of contact throughout. No delays in communication.',
			],
		],
	] );


	/* ---------- 6. TESTIMONIALS ----------
	   The same part the websites campaign uses, as the brief asks. Reviews are
	   typed into campaigns/shared/parts/testimonials.php — editing them there
	   changes both pages. */
	bp_campaign_part( 'testimonials' );


	/* ---------- 7. FAQ ---------- */
	bp_campaign_part( 'faq' );


	/* ---------- 8. FINAL CTA ---------- */
	bp_campaign_part( 'enquire', [
		'heading' => 'Ready to talk?',
		'sub'     => 'Get in touch and tell us what you are working on. We will take it from there.',
		// 'whatsapp' => 'Hi Bee Possible, I saw your 360 marketing page and would like to talk.',
		'form'    => [
			'form_id'             => 'campaignEnquiry',
			'fields'              => 'project', // Same field set as /start-a-project/ (stage, interests, timeline).
			'submit_label'        => 'Contact us',
			'message_label'       => 'Tell us what you are working on',
			'message_placeholder' => 'Where your brand is now, what you want to grow, and which services you have in mind.',
		],
	] );
	?>

</main>

<?php bp_campaign_footer(); ?>
