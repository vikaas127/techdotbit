<?php if( have_rows('development_life_cycle', 'option') ): ?>
<section class="lqd-section services pt-75 pb-50 inner-services">
  <div class="container">
    <div class="ld-fancy-heading text-center">
      <h2 class="ld-fh-element mb-0/4em" data-split-text="true" data-split-options="{&quot;type&quot;: &quot;lines&quot;}">Our Development Life Cycle Process</h2>
    </div>
    <div class="row justify-center mt-40">
      <div class="col col-12">
        <div class="-mr-15 -ml-15" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;.animation-element&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 35 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
          <div class="container-fluid">

            <div class="row">
              <?php while( have_rows('development_life_cycle', 'option') ) : the_row(); ?>
              <div class="col col-6 col-md-3 col-lg-2 mb-20">
                <div class="iconbox relative flex-row items-stretch justify-start text-start mb-2em hover:opacity-100 animation-element">
                  <?php 
                    $icon = get_sub_field('icon'); 
                    if( !empty( $icon ) ): 
                  ?>
                  <div class="iconbox-icon-wrap">
                    <span class="iconbox-icon-container w-64 h-64">
                      <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" width="64" height="64" loading="lazy" class="img-fluid">
                    </span>
                  </div>
                  <?php endif; ?>
                  
                  <div class="contents">
                    <h3 class="text-15 leading-1/5em uppercase"><?php the_sub_field('text'); ?></h3>
                  </div>
                </div>
              </div>
              <?php endwhile; ?>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</section>
<?php endif; ?>