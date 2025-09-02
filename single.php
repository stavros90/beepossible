<?php get_header(); ?>

<main class="single-post light-section">
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

      <article class="container">
        <?php if (function_exists("rank_math_the_breadcrumbs")) rank_math_the_breadcrumbs(); ?>
        <h1 class="the-title"><?php the_title(); ?></h1>

        <?php the_category( '', null ); ?>

        <?php if(has_post_thumbnail()) : 
          the_post_thumbnail(); 
        endif; ?>

        <div class="the-content">
          <?php the_content(); ?>
        </div>
      </article>

    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>