<?php
/**
 * Contact — a router, not a form.
 *
 * The page used to open with one general form and a dropdown asking what the
 * enquiry was about. That put the sorting work on the visitor and landed every
 * kind of enquiry in the same inbox, so a hiring question and a six-figure
 * project arrived looking identical.
 *
 * Instead each intent gets a card that goes to the form already built for it,
 * which is where the qualifying questions live. Anything that does not fit a
 * card is a direct email, listed under the cards.
 *
 * The two-column layout is the one this page always had: the routes take the
 * column the form used to sit in, and the contact details and map keep theirs.
 * Copy is kept to one short line per card so four of them stack against the
 * map without running past it.
 */

$routes = [
	[
		'question' => 'Do you have a project in mind?',
		'title'    => 'Start a project',
		'text'     => 'Scope, timeline and where to begin.',
		'url'      => home_url( '/start-a-project/' ),
	],
	[
		'question' => 'Do you need a 360° marketing partner?',
		'title'    => 'Full-service marketing',
		'text'     => 'Strategy, creatives, digital, events and web from one team.',
		'url'      => home_url( '/360-marketing-partner/' ),
	],
	[
		'question' => 'Do you want to start a website?',
		'title'    => 'Websites',
		'text'     => 'A new site, or a rebuild of the one you have.',
		'url'      => home_url( '/websites-in-cyprus/' ),
	],
	[
		'question' => 'Are you looking for a career?',
		'title'    => 'Careers',
		'text'     => 'Open roles, and speculative applications.',
		'url'      => home_url( '/careers/' ),
	],
];

get_header();
?>

<main class="page-contact">

  <section class="page-intro container light-section">
    <div class="page-decor-title">Contact us</div>
    <h1 class="page-title">Let’s <br>Connect</h1>
    <p class="page-desc long">Tell us what you are here for. Each route goes to a short form built for that
      conversation, so the first reply you get is a useful one.</p>
  </section>

  <section class="container contact-container light-section">

    <div class="contact__routes">
      <ul class="contact-routes__list">
        <?php foreach ( $routes as $i => $route ) : ?>
          <li data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $i * 60 ); ?>">
            <a class="route-card" href="<?php echo esc_url( $route['url'] ); ?>">
              <div class="route-card__body">
                <span class="route-card__tag"><?php echo esc_html( $route['title'] ); ?></span>

                <?php /* The question is the heading: it is what someone scans for. */ ?>
                <h2 class="route-card__question"><?php echo esc_html( $route['question'] ); ?></h2>

                <p class="route-card__text"><?php echo esc_html( $route['text'] ); ?></p>
              </div>

              <?php /* Decorative: the link already reads as its tag and question. */ ?>
              <span class="route-card__go" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M5 12h14M13 6l6 6-6 6"/>
                </svg>
              </span>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>

      <p class="contact-routes__catch">
        Press, partnerships or something none of these covers?
        <?php echo do_shortcode( '[email]info@beepossible.com[/email]' ); ?>
      </p>
    </div>

    <div class="contact__details">
      <h2>Email us</h2>
      <p><?php echo do_shortcode( '[email]info@beepossible.com[/email]' ); ?></p>

      <h2>Call us</h2>
      <p><a href="tel:+35722388858">+357 22 388858</a></p>

      <h2>Find us</h2>
      <address><a href="<?php echo esc_url( 'https://maps.app.goo.gl/wBNB8J44f56N8PFw7' ); ?>" target="_blank" rel="noopener">Themistokli Dervi 42, ‘Nice Dream Building’, Nicosia, 1066</a></address>

      <iframe title="Our Location on the Map" class="contact-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3261.709306145381!2d33.35601367634535!3d35.16386985821957!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4eee7667ef895c87%3A0xd9ed0f5b79a2f27a!2sBee%20Possible!5e0!3m2!1sen!2spt!4v1773747332837!5m2!1sen!2spt" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

  </section>

</main>

<?php get_footer(); ?>
