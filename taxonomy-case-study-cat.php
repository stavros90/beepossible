<?php get_header();
$term = get_queried_object();
?>

<main class="page-projects">

  <section class="page-intro container light-section">
    <h1 class="page-title">
      <?php echo esc_html( $term->name ); ?> Case Studies
    </h1>
<!--     <p class="page-desc">
      We’ve worked with over 350 companies around the world to produce results that turn heads, drive revenue and make an impact.<br><br>Here are just some.
    </p> -->
  </section>

  <section class="container light-section">

    <div class="projects-wrapper">

      <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

      <?php get_template_part('template-parts/project', 'project-template'); ?>

      <?php endwhile; endif; ?>

    </div>

    <div class="pagination">
        <?php
        echo paginate_links( array(
            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
            'total'        => $wp_query->max_num_pages,
            'current'      => max( 1, get_query_var( 'paged' ) ),
            'format'       => '?paged=%#%',
            'show_all'     => false,
            'type'         => 'plain',
            'end_size'     => 2,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => sprintf( '<i></i> %1$s', __( 'Prev', 'beepossible' ) ),
            'next_text'    => sprintf( '%1$s <i></i>', __( 'Next', 'beepossible' ) ),
            'add_args'     => false,
            'add_fragment' => '',
        ) );
        ?>
    </div>
  </section>

  <?php 
    get_template_part('partials/lets-do-this', null , [
      'cta_url' => 'contact-us/',
      'section_class' => 'light-section',
      'section_title' => 'We truly care for our partners',
      'cta_text' => 'Let\'s have a chat',
    ]);
  ?>

</main>

<?php get_footer(); ?> 