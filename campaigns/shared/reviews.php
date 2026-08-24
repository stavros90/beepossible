<?php
/**
 * Client review library.
 *
 * Paste a review here once and every landing page can use it. A campaign picks
 * the ones it wants by key:
 *
 *     bp_campaign_part( 'testimonials', [
 *       'reviews' => [ 'caibull', 'antonia' ],
 *     ] );
 *
 * Rules that keep this honest:
 *
 * - Paste the review exactly as the client wrote it. No editing for polish.
 *   Trim with an ellipsis if it is very long, never rewrite.
 * - A review with an empty quote is skipped at render time, so an unfinished
 *   entry can sit here safely without ever reaching a live page.
 * - 'source' is shown to the visitor. Only write 'Google' when the review is
 *   genuinely public on the Google Business profile.
 *
 * Fields: quote, author, role, rating (1-5), source.
 */

return [

	'Omnicore' => [
		'quote'  => 'I\'ve had the pleasure of collaborating with Electra, now known as BeePossible Consulting, for the past two years. 
		
		Throughout this time, they have provided my business with exceptional, personalised expertise that was much needed. Together, we have streamlined our actions and materials, developed innovative products, established new revenue sources, and expanded our customer base.
		
		Partnering with BeePossible Consulting has truly been one of the best professional decisions I\'ve ever made.

		Totally Recommend them!', 

		'author' => 'Michalis Poullis',
		'role'   => '',
		'rating' => 5,
		'source' => 'Google',
	],
	
	'Nostos' => [
		'quote'  => 'Working with Bee possible for over a year now and I am beyond grateful for Electra and her team! Electra helped me make my dream a reality and she is next to me every step of the way.
		Her ideas, connections, creativity and way to explain things are at another level.🔥 She cares for the business, has a no-nonsense approach and she is straight to the point. 
		Could not recommend her enough ', 

		'author' => 'Maria Laoudikou',
		'role'   => '',
		'rating' => 5,
		'source' => 'Google',
	],

	/**
	 * Add the rest below. Copy this block, give it a short key, fill it in.
	 *
	 * 'client-key' => [
	 *   'quote'  => 'Exactly what they wrote.',
	 *   'author' => 'Their name',
	 *   'role'   => 'Business name',
	 *   'rating' => 5,
	 *   'source' => 'Google',
	 * ],
	 */

];
