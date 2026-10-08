<?php if( have_rows('awards', 'option') ): ?>
<section class="lqd-section services py-75 inner-services bg-blue stats">
  <div class="container">
      <div class="ld-fancy-heading">
        <h2 class="mb-2em text-white text-center" data-text-rotator="true">
          Among The Top App Developers Worldwide
        </h2>
      </div>
    <div class="row justify-center">
      <div class="col col-12">
        <div class="carousel-container carousel-nav-left carousel-nav-mobile-centercarousel-nav-md carousel-dots-mobile-center carousel-dots-style1 carousel-dots-mobile-outside">
          <div class="carousel-items row flickity-enabled is-draggable lqd-carousel-ready flickity-equal-cells" data-lqd-flickity="{&quot;marquee&quot;:true,&quot;wrapAround&quot;:true,&quot;equalHeightCells&quot;:true,&quot;middleAlignContent&quot;:true,&quot;columnsAutoWidth&quot;:true,&quot;marqueeTickerSpeed&quot;:&quot;0.5&quot;,&quot;cellAlign&quot;:&quot;center&quot;,&quot;draggable&quot;:true}">
            <?php while( have_rows('awards', 'option') ) : the_row(); ?>
            <div class="carousel-item has-width w-25percent text-center md:px-15 px-30">
              <div class="carousel-item-inner">
                <div class="carousel-item-content">
                  <div class="flex items-center">
                    <?php 
                      $image = get_sub_field('icon'); 
                      if( !empty( $image ) ): 
                    ?>
                      <figure class="max-w-full inline-flex vertical-top m-0 flex-grow-1 justify-center">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="150" height="150" class="max-w-full h-auto vertical-top rounded-inherit">
                      </figure>
                        
                    <?php endif; ?>
                    
                  </div>
                </div>
              </div>
            </div>
            <?php endwhile; ?>
          </div>
        </div>
        
      </div>
      
    </div>
  </div>
</section>
<?php endif; ?>