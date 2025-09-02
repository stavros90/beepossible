<?php get_header(); ?>

<main class="page-blog">

  <section class="page-intro container dark-section">
    <h1 class="page-title">Insights</h1>
    <p class="page-desc">
      This is where we share what we’re thinking, what we’re seeing, and what we’re making.
    </p>
  </section>

  <section class="container blog-container dark-section">
    <div class="blog-wrapper">

      <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

      <?php get_template_part('template-parts/article', 'article-template'); ?>

      <?php endwhile; endif; ?>

    </div>
  </section>

</main>

<?php get_footer(); ?> 