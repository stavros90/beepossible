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

          <!-- Related Articles -->
          <div class="related-articles">
            <div class="related-articles-title">Related Articles</div>
            <div class="articles-grid">
              <?php
              $categories = get_the_category();
              $category_ids = array();
              
              foreach($categories as $category) {
                $category_ids[] = $category->term_id;
              }
              
              if(!empty($category_ids)) {
                $args = array(
                  'category__in' => $category_ids,
                  'posts_per_page' => 3,
                  'post__not_in' => array(get_the_ID()),
                  'orderby' => 'date',
                  'order' => 'DESC'
                );
                
                $related_posts = new WP_Query($args);
                
                if($related_posts->have_posts()) {
                  while($related_posts->have_posts()) {
                    $related_posts->the_post();
                    ?>
                    <div class="related-article-card">
                      <a href="<?php the_permalink(); ?>" class="article-image-link">
                        <?php if(has_post_thumbnail()) : ?>
                          <?php the_post_thumbnail('medium'); ?>
                        <?php endif; ?>
                      </a>
                      <h3 class="article-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                      </h3>
                      <p class="article-excerpt">
                        <?php 
                          $excerpt = wp_trim_words(get_the_excerpt(), 10, '...');
                          echo $excerpt;
                        ?>
                      </p>
                    </div>
                    <?php
                  }
                  wp_reset_postdata();
                }
              }
              ?>
            </div>
          </div>
        </div>
      </article>

    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>