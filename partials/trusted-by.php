<section class="trusted-by dark-section">
  <div class="container">
    <div class="decor-title" data-aos="fade-left" data-aos-duration="300">Trusted By 350+ Companies</div>
  </div>
  <div class="container-fluid">

    <div class="carousel-container">
      <div class="carousel-track" id="carouselTrack">
        <?php 
          $clients = new WP_Query([
            'post_type' => 'client',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'rand',
          ]);
          
          if($clients -> have_posts()) : while($clients -> have_posts()) : $clients->the_post(); 
        ?>

        <div class="carousel-item">
          <a href="<?php echo esc_url(the_field('client_website')); ?>" target="_blank" rel="noopener">
            <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>" width="313" height="105">
          </a>
        </div>

        <?php 
          endwhile; endif; wp_reset_postdata(); 
        ?>
      </div>
    </div>

  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // This simulates what you would do in WordPress
      const carouselTrack = document.getElementById('carouselTrack');
      const items = carouselTrack.querySelectorAll('.carousel-item');
      const itemCount = items.length;
      
      // Set CSS variables for dynamic calculation
      document.documentElement.style.setProperty('--item-count', itemCount);
      
      // Calculate item width (logo width + margins)
      const itemWidth = 313 + 30; // 313px width + 30px total margin
      document.documentElement.style.setProperty('--item-width', `${itemWidth}px`);
      
      // Duplicate items for seamless loop
      for (let i = 0; i < itemCount; i++) {
          const clone = items[i].cloneNode(true);
          carouselTrack.appendChild(clone);
      }
      
      // Set the track width dynamically
      carouselTrack.style.width = `calc(var(--logo-width) * ${itemCount * 2} + ${30 * itemCount * 2}px)`;
    });
  </script>
</section>