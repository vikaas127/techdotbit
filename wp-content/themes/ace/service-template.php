<?php
/* Template Name: Service Template */

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
          <?php if(get_sub_field('link')): ?>
          <a href="<?php the_sub_field('link'); ?>" class="btn font-bold text-13 btn-solid text-white bg-primary uppercase border-thin btn-hover-swp leading-1/5em px-0/6em tracking-0/1em rounded-4 hover:bg-black hover:text-white" data-localscroll="true">
            <span class="inline-flex py-1/15em px-2/1em items-center">
              <span class="btn-txt" data-text="Explore hub">Contact Us</span>
              <span class="btn-icon">
                <i class="lqd-icn-ess icon-md-arrow-forward"></i>
              </span>
              <span class="btn-icon">
                <i class="lqd-icn-ess icon-md-arrow-forward"></i>
              </span>
            </span>
          </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
  <?php endwhile;
endif; ?>

<?php include_once('inc/brands.php'); ?>

<?php if( have_rows('services') ):
  while( have_rows('services') ) : the_row(); ?>
  <section class="lqd-section services pt-75 inner-services">
    <div class="container">
      <div class="row justify-center">
        <?php if(get_sub_field('heading')): ?>
        <div class="col col-12 mb-40 text-center md:text-start">
          <?php if(get_sub_field('sub_heading')): ?>
            <div class="ld-fancy-heading uppercase">
              <h6 class="ld-fh-element mb-1em"><?php the_sub_field('sub_heading'); ?></h6>
            </div>
          <?php endif; ?>
          <?php if(get_sub_field('heading')): ?>
            <div class="ld-fancy-heading">
              <h2 class="ld-fh-element mb-0/5em px-15percent lg:px-0 sm:text-start"><?php the_sub_field('heading'); ?></h2>
            </div>
          <?php endif; ?>
          <?php if(get_sub_field('paragraph')): ?>
            <p class="ld-fh-element mb-2em leading-28 text-17"><?php the_sub_field('paragraph'); ?></p>
          <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if( have_rows('service_list') ): ?>
        <div class="col col-12">
          <div class="-mr-15 -ml-15" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;.animation-element&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 35 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
            <div class="container-fluid">
              <div class="row">
                <?php while( have_rows('service_list') ) : the_row(); ?>
                <div class="col col-12 col-md-6 col-lg-4 mb-20">
                  <div class="iconbox relative flex-row items-stretch justify-start text-start mb-2em hover:opacity-100 animation-element">
                    <?php 
                      $icon = get_sub_field('icon'); 
                      if( !empty( $icon ) ): 
                    ?>
                    <div class="iconbox-icon-wrap">
                      <span class="iconbox-icon-container w-55 h-55 text-24 bg-primary text-white rounded-full">
                        <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>"  width="32" height="32" loading="lazy" class="img-fluid">
                      </span>
                    </div>
                    <?php endif; ?>
                    
                    <div class="contents">
                      <h3 class="text-15 mb-15 leading-1\5em uppercase"><?php the_sub_field('title'); ?></h3>
                      <p><?php the_sub_field('paragraph'); ?></p>
                      <?php if(get_sub_field('link')): ?>
                        <a href="<?php the_sub_field('link'); ?>" class="link">View More</a>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <?php endwhile; ?>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <?php endwhile;
endif; ?>

<?php include_once('inc/case-study.php'); ?>

<?php if( have_rows('why_choose') ): 
  while( have_rows('why_choose') ) : the_row(); ?>
  <section class="lqd-section why-ace py-90">
    <div class="container">
      <div class="row items-center">
      	<div class="col col-12 col-lg-5 mb-35 ca-initvalues-applied lqd-animations-done">
      		
      		<div class="ld-fancy-heading lqd-unit-animation-done" style="">
      		   <h3 class="ld-fh-element mb-0/6em"><?php the_sub_field('heading'); ?></h3>
      		</div>
      		<div class="ld-fancy-heading lqd-unit-animation-done" style="">
      		   <?php the_sub_field('paragraph'); ?>
      		</div>
      	</div>
      	<div class="col col-12 col-lg-6 offset-lg-1 mb-35">
          <?php 
            $image = get_sub_field('image'); 
            if( !empty( $image ) ): 
          ?>
          <figure class="max-w-full inline-flex vertical-top m-0 flex-grow-1 rounded-6">
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"  width="998" height="696" loading="lazy" class="max-w-full h-auto vertical-top rounded-inherit">
          </figure>
          <?php endif; ?>
      		
      	</div>
      </div>
  	</div>
  </section>
  <?php endwhile;
endif; ?>

<?php if( have_rows('benefits') ): 
  while( have_rows('benefits') ) : the_row(); ?>
  <section class="lqd-section case-studies pt-90 pb-70 bg-gray-100">
    <div class="container">
      <div class="row">
      	<div class="col col-12  text-center mb-60 mx-auto">
      	  <div class="ld-fancy-heading">
      	    <h2 class="ld-fh-element mb-0/4em" data-text-rotator="true">
      	      <?php the_sub_field('heading'); ?>
      	    </h2>
      	  </div>
          <?php if(get_sub_field('paragraph')): ?>
      	  <div class="ld-fancy-heading">
      	    <p class="ld-fh-element mb-0/5em leading-30 text-17"><?php the_sub_field('paragraph'); ?></p>
      	  </div>
          <?php endif; ?>
      	</div>
        <?php if( have_rows('list') ): ?>
      	<div class="col col-12">
      		<div class="row">
            <?php while( have_rows('list') ) : the_row(); ?>
      			<div class="col-12 col-lg-4 px-15 text-center mb-1em">
      				<h5 class="mb-0/6em"><?php the_sub_field('title'); ?></h5>
      				<p class="mb-2em"><?php the_sub_field('paragraph'); ?></p>
      			</div>
      			<?php endwhile; ?>
      		</div>
      	</div>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <?php endwhile;
endif; ?>

<?php include_once('inc/stats.php'); ?>

<?php if( have_rows('cta') ): ?>
  <?php while( have_rows('cta') ) : the_row(); ?>
  <section class="lqd-section image-bg help py-100 transition-all">
    <span class="row-bg-loader w-60 h-60 inline-block absolute top-50percent left-50percent -mt-30 -ml-30 transition-all"></span>
    <div class="row-bg-wrap absolute top-0 left-0 right-0 bottom-0 inline-block overflow-hidden">
      <figure class="row-bg transition-all bg-no-repeat bg-cover absolute top-0 left-0 right-0 bottom-0 inline-block overflow-hidden" style="background-image: url(<?php if(get_sub_field('bg')): ?><?php echo the_sub_field('bg'); ?><?php else: ?><?php echo get_stylesheet_directory_uri().'/assets/images/demo/classic/image-bg/bg-2%402x-scaled.jpg';?><?php endif; ?>)"></figure>
    </div>
    <div class="liquid-row-overlay bg-black-30 w-full h-full absolute block rounded-inherit top-0 left-0 transition-all"></div>
    <div class="container">
      <div class="row justify-center">
        <div class="col col-12 col-lg-8 text-center md:text-start" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;all-childs&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 45 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
          <div class="ld-fancy-heading">
            <h2 class="ld-fh-element mb-0/5em lqd-split-lines text-46 text-white font-bold px-5percent md:px-0" data-split-text="true" data-split-options="{&quot;type&quot;: &quot;lines&quot;}"><?php the_sub_field('heading'); ?></h2>
          </div>
          <div class="ld-fancy-heading">
            <p class="ld-fh-element mb-2em lqd-split-lines px-15percent leading-28 text-17 text-white-80 md:px-0" data-split-text="true" data-split-options="{&quot;type&quot;: &quot;lines&quot;}"><?php the_sub_field('paragraph'); ?>
            </p>
          </div>
          <a href="<?php the_sub_field('link'); ?>" class="btn font-bold text-13 btn-solid text-white bg-primary uppercase border-thin btn-hover-swp leading-1/5em tracking-0/1em rounded-4 hover:text-white">
            <span class="inline-flex py-1/15em px-2/1em items-center">
              <span class="btn-txt" data-text="Explore hub">Explore hub</span>
              <span class="btn-icon">
                <i class="lqd-icn-ess icon-md-arrow-forward"></i>
              </span>
              <span class="btn-icon">
                <i class="lqd-icn-ess icon-md-arrow-forward"></i>
              </span>
            </span>
          </a>
        </div>
      </div>
    </div>
  </section>
  <?php endwhile; ?>
<?php endif; ?>

<?php include_once('inc/awards.php'); ?>

<?php include_once('inc/testimonials.php'); ?>

<?php include_once('inc/faq-list.php'); ?>

<?php include_once('inc/bottom-cta.php'); ?>

<?php get_footer(); ?>