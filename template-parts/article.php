<?php       
  $imgUrl = get_template_directory_uri() . '/assets/images/no-image.webp';
?>

<article class="article article-list" data-aos="flip-up">
  <div class="article__image">
    <a href="<?php the_permalink(); ?>">
      <?php the_post_thumbnail('article-list', ['class' => 'article-img', 'title' => get_the_title() ]); ?>
    </a>
  </div>

  <div class="article__text">
    <?php the_category('', '<ul>'); ?>
    <h2 class="article-title">
      <a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
      </a>
    </h2>
    <p class="article-excerpt"><?php the_excerpt(); ?></p>
  </div>
</article>