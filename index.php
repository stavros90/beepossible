<?php get_header(); ?>

<main>
  <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

  <section class="page-intro container dark-section">
    <h1 class="page-title"><?php the_title(); ?></h1>
  </section>

  <section class="container dark-section">

      <?php the_content(); ?>

  </section>

  <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?> 