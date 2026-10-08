<?php if( have_rows('case_study', 'option') ):
  while( have_rows('case_study', 'option') ) : the_row(); ?>
  <section class="lqd-section case-study-carousel pt-60 pb-50" data-custom-animations="true" data-ca-options="{&quot;animationTarget&quot;: &quot;.animation-element&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;initValues&quot;: {&quot;y&quot;: &quot;30px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
    <div class="container">
      <div class="row items-center justify-between">
        <div class="col col-12 text-center">
          <div class="ld-fancy-heading relative animation-element">
            <h2 class="m-0 ld-fh-element m-0 inline-block pos-re"><?php the_sub_field('heading'); ?></h2>
          </div>
        </div>
        

        <?php $featured_posts = get_sub_field('list', 'option');
          if( $featured_posts ): 
          ?>
        <div class="col col-12">
          <div class="carousel-container pt-40 animation-element">
            <div class="carousel-items relative" data-lqd-flickity="{ &quot;equalHeightCells&quot;: true, &quot;filters&quot;: &quot;#pf-filter-46824385&quot;, &quot;prevNextButtons&quot;: true, &quot;navArrow&quot;:  6, &quot;fullwidthSide&quot;:  true, &quot;buttonsAppendTo&quot;:  &quot;self&quot; }">
              <?php foreach( $featured_posts as $post ): 
              // Setup this post for WP functions (variable must be named $post).
              setup_postdata($post); 
              $terms = get_the_terms( $post->ID, 'tagportfolio' );

              if ( $terms && ! is_wp_error( $terms ) ) : 
                  $links = array();
                  foreach ( $terms as $term ) 
                  {
                      $links[] = $term->name;
                  }
                  $links = str_replace(' ', '-', $links); 
                  $tax = join( " ", $links );   
              else :  
                  $tax = '';  
              endif;
              ?>
             <div class="carousel-item col-11 col-lg-5 col-xl-3 mr-60">
    <article class="lqd-pf-item lqd-pf-item-style-3 lqd-pf-overlay-bg-scale lqd-pf-content-v pf-details-h-str">
        <div class="lqd-pf-item-inner">
            <div class="lqd-pf-img overflow-hidden rounded-5 relative">
                <!-- Removed mb-2em to eliminate extra space -->
                <figure>
                    <figure class="lqd-overlay flex">
                        <?php the_post_thumbnail('full', [ 'alt' => esc_html(get_the_title()), 'class' => 'w-full h-full objfit-cover objfit-center' ]); ?>
                    </figure>
                </figure>
                <span class="lqd-pf-overlay-bg lqd-overlay flex items-center justify-center bg-transparent text-white" style="background-image: linear-gradient(180deg, rgb(0 0 0 / 75%) 0%, rgb(70 70 70 / 75%) 100%)">
                    <i class="lqd-icn-ess icon-md-arrow-forward"></i>
                </span>
            </div>
            <div class="lqd-pf-details sm:text-center text-start">
                <h2 class="lqd-pf-title mt-0 mb-1 h5"><?php the_title(); ?></h2>
                <!-- Removed leading-1/4em to reduce extra spacing -->
                <span><?php echo $term->name; ?></span>
            </div>
            <a href="<?php the_permalink(); ?>" class="lqd-overlay flex lqd-pf-overlay-link fresco" data-fresco-group="case-studies"></a>
        </div>
    </article>
</div>

              <?php endforeach; ?>
            </div>
          </div>
        </div>
        <?php wp_reset_postdata(); ?>
        <?php endif; ?>
        
        <div class="col col-12 text-end sm:text-center cs-button">
          <div class="fancy-button animation-element">
            <a href="<?php the_sub_field('page_link'); ?>" class="btn btn-naked font-bold uppercase whitespace-nowrap tracking-1/5 leading-1/4em text-green-900">
              <span class="btn-txt" data-text="see more works">see more works</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php endwhile; 
endif; ?>