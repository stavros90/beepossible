<?php get_header(); ?>

<main class="page-blog">

  <section class="page-intro container">
    <h1 class="page-title"><?php the_archive_title(); ?></h1>
    <p class="page-desc">
      <?php the_archive_description(); ?>
    </p>
  </section>

  <section class="container">
    <div class="blog-wrapper">

      <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

        <?php get_template_part('template-parts/article', 'article-template'); ?>

      <?php endwhile; endif; ?>

    </div>
  </section>

</main>

<?php get_footer(); ?> 