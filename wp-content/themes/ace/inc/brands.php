<?php if( have_rows('brands', 'option') ): ?>
<section class="lqd-section clients py-55 sm:hidden border-bottom border-black-10">
    <div class="container">
      <div class="row">
        <div class="col col-12 col-lg-3 module-col">
          <div class="ld-fancy-heading">
            <h6 class="ld-fh-element mb-1em mb-1em text-14 text-black">GLOBAL EXPERTS</h6>
          </div>
        </div>
        <div class="col col-12 col-lg-9">
          <div class="carousel-container carousel-nav-left carousel-nav-mobile-centercarousel-nav-md carousel-dots-mobile-center carousel-dots-style1 carousel-dots-mobile-outside">
            <div class="carousel-items row flickity-enabled is-draggable lqd-carousel-ready flickity-equal-cells" data-lqd-flickity="{&quot;marquee&quot;:true,&quot;wrapAround&quot;:true,&quot;equalHeightCells&quot;:true,&quot;middleAlignContent&quot;:true,&quot;columnsAutoWidth&quot;:true,&quot;marqueeTickerSpeed&quot;:&quot;0.5&quot;,&quot;cellAlign&quot;:&quot;center&quot;,&quot;draggable&quot;:true}">
              <?php while( have_rows('brands', 'option') ) : the_row(); ?>
              <div class="carousel-item has-width w-20percent text-center">
                <div class="carousel-item-inner">
                  <div class="carousel-item-content">
                    <div class="flex items-center">
                      <?php 
                        $image = get_sub_field('image'); 
                        if( !empty( $image ) ): 
                      ?>
                      <figure class="max-w-full inline-flex vertical-top m-0 flex-grow-1 justify-center">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="86" height="31" loading="lazy" class="max-w-full h-auto vertical-top rounded-inherit">
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