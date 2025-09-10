<?php get_header(); ?>

<main class="page-about-us">

  <section class="page-intro container light-section">
    <?php get_template_part('/assets/images/svg/logo'); ?>
    <h1 class="page-title">Who Are We?</h1>
    <p class="page-desc">
      Strategic thinkers. Creative partners. Real collaborators.
    </p>
  </section>

  <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

  <section class="container page-content light-section">

    <?php the_content(); ?>

    <a href="<?php echo esc_url(site_url('contact-us/')); ?>" class="cta cta-primary" role="button">Let's have a chat</a>

  </section>

  <?php endwhile; endif; wp_reset_postdata(); ?>

  <section class="our-people">
    <div class="container">
      <h2 class="our-people-title">Our people</h2>
    </div>
    <div class="container-fluid">

      <div class="swiper people-swiper dark-section">
        <div class="swiper-wrapper">

        <?php 
        $people = new WP_Query([
          'post_status'    => 'publish',
          'post_type'      => 'talent',
          'posts_per_page' => -1,
          'orderby'        => 'menu_order',
          'order'          => 'ASC',
        ]);

        if($people->have_posts()) : while($people->have_posts()) : $people->the_post(); ?>

          <div class="swiper-slide person">

            <div class="person-card">
              <video class="person-card__bg" autoplay muted loop playsinlinea preload="none"> 
                <source src="<?php the_field('background_video'); ?>" type="video/mp4">
              </video>
              <h3 class="person-card__name"><?php the_title(); ?></h3>
              <p class="person-card__role"><?php the_field('talent_role'); ?></p>
            </div>
          </div>

        <?php endwhile; endif; wp_reset_postdata(); ?>

        </div>
      </div>

    </div>

  </section>

  <?php 
    get_template_part('partials/lets-do-this', null , [
      'section_title'  => 'We truly care for our partners',
      'section_class' => 'light-section',
      'cta_text' => 'Let\'s have a chat',
      'cta_url' => 'contact-us/',
    ]);
  ?>


</main>

<?php get_footer(); ?>