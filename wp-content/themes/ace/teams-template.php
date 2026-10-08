<?php
/* Template Name: Teams Template */

get_header(); ?>

  <?php if( have_rows('banner') ):
  while( have_rows('banner') ) : the_row(); ?>
  <section class="lqd-section banner bg-no-repeat bg-center bg-cover py-70 px-140 md:px-0" id="banner" style="background-image: url(<?php the_sub_field('banner_bg'); ?>);">
    <div class="container">
      <div class="row">
        <div class="col col-12 col-lg-7 col-xl-6" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;all-childs&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 45 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
          <?php if(get_sub_field('title')): ?>
          <div class="ld-fancy-heading">
            <h1 class="ld-fh-element mb-0/35em lqd-split-lines text-white" data-split-text="true" data-split-options="{&quot;type&quot;: &quot;lines&quot;}"><?php the_sub_field('title'); ?></h1>
          </div>
          <?php endif; ?>
          <?php if(get_sub_field('paragraph')): ?>
          <div class="ld-fancy-heading">
            <p class="ld-fh-element mb-2em lqd-split-lines leading-30 text-17 text-white-80" data-split-text="true" data-split-options="{&quot;type&quot;: &quot;lines&quot;}"><?php the_sub_field('paragraph'); ?>
            </p>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
  <?php endwhile;
endif; ?>

<?php if( have_rows('business_solutions') ): ?>
  <section class="lqd-section pt-90 pb-55">
    <div class="container">
      <div class="row">
        
        <?php while( have_rows('business_solutions') ) : the_row(); ?>
            <div class="col col-12 col-md-6 col-lg-4 col-xl-3 mb-30">
                <div class="w-full flex items-center mb-25">
                  <?php 
                    $image = get_sub_field('image'); 
                    if( !empty( $image ) ): 
                  ?>
                  <figure class="max-w-full inline-flex justify-center vertical-top m-0 flex-grow-1 rounded-4">
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="660" height="460" loading="lazy" class="max-w-full h-auto vertical-top rounded-inherit">
                  </figure>
                  <?php endif; ?>
                </div>
                <h5 class="mb-0/6em"><?php the_sub_field('title'); ?></h5>
                <h6 class="mb-0/6em"><?php the_sub_field('designation'); ?></h6>
                <p class="mb-2em"><i><?php the_sub_field('paragraph'); ?></i></p>
            </div>
        <?php endwhile; ?>
        
      </div>
    </div>
  </section>
<?php endif; ?>



<?php include_once('inc/bottom-cta.php'); ?>

<?php get_footer(); ?>