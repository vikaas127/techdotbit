<?php if( have_rows('testimonials', 'option') ):
  while( have_rows('testimonials', 'option') ) : the_row(); ?>
  <section class="lqd-section testimonials py-90 border-bottom border-black-10">
    <div class="container">
      <div class="row justify-center">
        <div class="col col-12 col-lg-8 mb-35 text-center md:text-start">
          <?php if(get_sub_field('sub_heading')): ?>
          <div class="ld-fancy-heading uppercase">
            <h6 class="ld-fh-element mb-0/5em"><?php the_sub_field('sub_heading'); ?></h6>
          </div>
          <?php endif; ?>
          <h2 class="ld-fh-element mb-0/5em px-15percent lg:px-0"><?php the_sub_field('heading'); ?></h2>
        </div>
        <div class="col col-12 p-0"></div>

        <?php if( have_rows('list', 'option') ): ?>
        <div class="col col-12 col-lg-4 mb-20 text-start">
          <div id="testi-avatars" class="carousel-container carousel-nav-left carousel-nav-mobile-centercarousel-nav-md carousel-dots-mobile-center carousel-dots-style1 carousel-dots-mobile-outside testi-avatars">
            <div class="carousel-items -mr-15 -ml-15" data-lqd-flickity="{&quot;cellAlign&quot;: &quot;left&quot;, &quot;prevNextButtons&quot;: false, &quot;pageDots&quot;: false, &quot;groupCells&quot;: true, &quot;wrapAround&quot;: true, &quot;pauseAutoPlayOnHover&quot;: false, &quot;buttonsAppendTo&quot;: &quot;self&quot;, &quot;addSlideNumbersToArrows&quot;: false, &quot;dotsIndicator&quot;: &quot;dots&quot;, &quot;numbersStyle&quot;: &quot;circle&quot;, &quot;dotsAppendTo&quot;: &quot;self&quot;}">
              <?php while( have_rows('list', 'option') ) : the_row(); ?>
              <div class="carousel-item has-width w-full px-15">
                <div class="carousel-item-inner">
                  <div class="carousel-item-content">
                    <h5 class="flex items-center m-0">
                      <img loading="lazy" decoding="async" class="max-w-full h-auto vertical-top rounded-inherit mr-1/5rem" width="75" height="75" src="<?php the_sub_field('image'); ?>" alt="<?php the_sub_field('name'); ?>">
                      <span class="text-18">
                        <span><?php the_sub_field('name'); ?></span>
                        <br>
                        <small><?php the_sub_field('designation'); ?></small>
                      </span>
                    </h5>
                  </div>
                </div>
              </div>
              <?php endwhile; ?>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <?php if( have_rows('list', 'option') ): ?>
        <div class="col col-12 col-lg-8">
          <div class="carousel-container carousel-nav-left carousel-nav-mobile-centercarousel-nav-lg carousel-dots-mobile-left carousel-dots-style1 carousel-dots-mobile-outside">
            <div class="carousel-items -mr-15 -ml-15" data-lqd-flickity="{&quot;cellAlign&quot;: &quot;left&quot;, &quot;prevNextButtons&quot;: true, &quot;pageDots&quot;: false, &quot;groupCells&quot;: true, &quot;wrapAround&quot;: true, &quot;pauseAutoPlayOnHover&quot;: false, &quot;controllingCarousels&quot; : [&quot;#testi-avatars&quot;] , &quot;navArrow&quot;: &quot;6&quot;, &quot;buttonsAppendTo&quot;: &quot;self&quot;, &quot;addSlideNumbersToArrows&quot;: true, &quot;dotsIndicator&quot;: &quot;dots&quot;, &quot;numbersStyle&quot;: &quot;circle&quot;, &quot;dotsAppendTo&quot;: &quot;self&quot;}">
              <?php while( have_rows('list', 'option') ) : the_row(); ?>
              <div class="carousel-item has-width w-full px-15 mb-2em">
                <div class="carousel-item-inner">
                  <div class="carousel-item-content">
                    <p class="leading-32 text-gray-600 text-18">&ldquo;<?php the_sub_field('feedback'); ?>&rdquo;</p>
                  </div>
                </div>
              </div>
              <?php endwhile; ?>
            </div>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <?php endwhile;
endif; ?>