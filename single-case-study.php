<?php get_header(); ?>

<main class="single-project">
  <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

  <section class="project-intro">
    <div class="container">
      <h1 class="project-title">        
        <a href="<?php echo esc_url(site_url('case-studies/')); ?>">
          <svg width="66" height="57" viewBox="0 0 66 57" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M31.2281 56.6392C29.1286 56.6392 27.0291 56.6392 24.9296 56.5853C25.1987 45.5495 16.9622 35.1058 6.24937 32.6294C4.25753 31.9834 2.10419 32.0911 0.00468228 31.8758C0.0046821 29.7763 0.00468192 27.6768 0.00468174 25.6311C4.04219 25.4158 8.13354 24.8236 11.6865 22.7779C19.6539 18.5789 24.9834 9.91171 24.9834 0.867687C27.0829 0.867687 29.1824 0.867687 31.2281 0.867686C31.2819 10.5039 26.5446 19.9786 18.7387 25.6849C34.2428 25.6311 49.8006 25.6849 65.3047 25.6849C65.2509 27.7306 65.2509 29.8301 65.3047 31.9296C49.8545 31.7681 34.3504 31.8758 18.8464 31.8219C24.2836 36.1286 28.6441 41.9965 30.2591 48.7795C30.9051 51.3096 31.1743 54.0013 31.2281 56.6392Z" fill="#131313"/></svg>
        </a>
        <span><?php the_title(); ?></span>
      </h1>

      <div class="project-details">
        <div class="client">
          <h2>Client</h2>
          <p><?php echo get_field('client'); ?></p>
        </div>

        <div class="whatwehavedone">
          <h2>What we have done</h2>
          <?php
            $terms_list = get_the_term_list( 
                get_the_ID(), 
                'case-study-cat', 
                '<ul class="project-categories"><li>', 
                '<li>', 
                '</ul>' 
            );

            if ( $terms_list && ! is_wp_error( $terms_list ) ) {
                echo $terms_list;
            }
          ?>
        </div>

        <div class="year">
          <h2>Year</h2>
          <p><?php echo get_field('year'); ?></p>
        </div>
      </div>
    </div>
  </section>

  <section class="project-description">
    <div class="container container__large">
      <?php if(has_post_thumbnail()) : the_post_thumbnail(); endif; ?>
    </div>

    <div class="container container__small">
      <?php 
        $extraTitle = get_field('second_title'); 
        $projectDesc = get_field('project_description');
        $delivered = get_field('what_we_delivered');
        $projectRequests = get_field('what_client_requested');
        $impact = get_field('measurable_impact'); 
      ?>
      <h3 class="secondary-title"><?php echo $extraTitle; ?></h3>
      <div class="project-desc"><?php echo $projectDesc; ?></div>

      <?php if($projectRequests) : ?>
        <h3 class="case-study-title">What did our client Requested </h3>
        <div class="project-desc"><?php echo $projectRequests; ?></div>
      <?php endif; ?>

      <h3 class="case-study-title">What we Delivered</h3>
      <div class="project-desc"><?php echo $delivered; ?></div>
    </div>

    <?php
    $images = get_field('image_gallery');

    if( $images ) : ?>
    <div class="container">
    <div class="gallery">
        <?php 
        $counter = 0;
        foreach( $images as $image ) : 
          if ( $counter >= 3 ) break;

          $img_url = is_array($image) ? $image['sizes']['large'] : $image;
          $img_alt = is_array($image) ? $image['alt'] : '';
          ?>
          
          <div class="gallery-item" <?php if($counter % 2 == 0) : echo "data-aos='fade-left'"; else : echo "data-aos='fade-right'"; endif; ?>>
            <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>">
          </div>
          
          <?php 
          $counter++;
        endforeach; 
        ?>
      </div>
    </div>
    <?php endif; ?>

    <?php $videoUrl = get_field('video_url'); 
    if($videoUrl) : ?>

    <div class="container container__large">
      <div class="video-area" data-aos="fade-left" data-aos-delay="100" data-aos-duration="1000">
        <video class="case-study-video" controls>
          <source src="<?php echo $videoUrl; ?>" type="video/mp4">
        Your browser does not support the video tag.
        </video>
      </div>
    </div>

    <?php endif; ?>

    <?php if($impact) : ?>
      <div class="results-badge">
        <div class="container impact">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
          <path d="M20.6216 4.04316C20.582 3.69619 20.3083 3.4224 19.9613 3.38283C16.2551 2.96017 12.3947 4.17038 9.55021 7.01484C8.88174 7.6833 8.30339 8.40811 7.81525 9.174L7.81221 9.17412C7.73554 9.29444 7.66109 9.41579 7.58886 9.53809C6.8687 10.7576 6.37029 12.0714 6.09344 13.4211C6.04278 13.668 6.11956 13.9239 6.29781 14.1021L9.897 17.7013C10.0752 17.8795 10.331 17.9563 10.5779 17.9057C11.9273 17.6291 13.2409 17.1311 14.4602 16.4114C15.3627 15.8787 16.2129 15.225 16.987 14.4509L16.9887 14.4525C19.8325 11.6087 21.0434 7.74873 20.6216 4.04316ZM16.0256 7.9789C16.9258 8.87906 16.9258 10.3385 16.0256 11.2387C15.1254 12.1388 13.666 12.1388 12.7658 11.2387C11.8657 10.3385 11.8657 8.87906 12.7658 7.9789C13.666 7.07874 15.1254 7.07874 16.0256 7.9789Z" fill="#FFC300"/>
          <g opacity="0.4">
            <path d="M14.6581 17.4512C13.4304 18.1328 12.1208 18.611 10.779 18.8861C10.5636 18.9302 10.3454 18.9328 10.1348 18.8971C10.2562 19.6285 10.2445 20.3779 10.0994 21.1066C10.0431 21.3891 10.1536 21.6789 10.3838 21.8522C10.6139 22.0255 10.923 22.0516 11.179 21.9195C11.7838 21.6072 12.3507 21.1979 12.8562 20.6924C13.7819 19.7667 14.3825 18.639 14.6581 17.4512Z" fill="#FFC300"/>
            <path d="M5.10306 13.8669C5.06703 13.6558 5.06956 13.437 5.11385 13.221C5.38883 11.8806 5.86653 10.5722 6.54731 9.3457C5.36096 9.62166 4.23474 10.222 3.31006 11.1467C2.80493 11.6518 2.39581 12.2182 2.08364 12.8226C1.95144 13.0786 1.97753 13.3876 2.15076 13.6178C2.324 13.848 2.61377 13.9586 2.89631 13.9024C3.62408 13.7576 4.37256 13.7459 5.10306 13.8669Z" fill="#FFC300"/>
            <path d="M3.02999 20.2509C3.04423 20.6438 3.35945 20.9592 3.75233 20.9735H3.75359L3.75563 20.9736L3.76201 20.9738L3.78365 20.9744C3.79963 20.9748 3.82141 20.9753 3.84838 20.9758L3.86026 20.976C3.92521 20.977 4.01713 20.9777 4.12877 20.9764C4.35087 20.974 4.65669 20.9641 4.98628 20.9333C5.3122 20.9028 5.68219 20.8501 6.02511 20.7558C6.34627 20.6675 6.74721 20.516 7.03927 20.2239C7.93943 19.3238 7.93943 17.8643 7.03927 16.9642C6.13911 16.064 4.67967 16.064 3.77951 16.9642C3.48745 17.2562 3.33593 17.6572 3.24762 17.9783C3.15333 18.3213 3.10066 18.6913 3.0702 19.0172C3.0394 19.3468 3.02944 19.6526 3.02702 19.8747C3.0258 19.9863 3.02647 20.0782 3.02748 20.1432C3.02798 20.1757 3.02857 20.2015 3.02905 20.2198L3.02968 20.2414L3.02988 20.2478L3.02999 20.2509Z" fill="#FFC300"/>
          </g>
        </svg>
        <?php echo $impact; ?>
        </div>
      </div>
    <?php endif; ?>
  </section>

  <?php endwhile; endif; ?>

  <?php get_template_part('partials/selected-projects', null , [
    'section_title' => 'More',
    'section_subtitle' => 'Case Studies'
    ]);
  ?>
</main>

<?php get_footer(); ?>