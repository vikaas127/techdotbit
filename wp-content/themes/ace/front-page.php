<?php get_header(); ?>
<style>
    .main-header, .is-not-stuck{position: fixed; top: 0px; left: 0; width: 100%; background: transparent;}
    .main-header.is-stuck{top: 0px;}
</style>

<?php
// New AI hero by default; "Classic video banner" keeps the original ACF banner.
$ace_home_mode = function_exists( 'get_field' ) && get_field( 'home_hero_mode' ) ? get_field( 'home_hero_mode' ) : 'ai';
if ( 'classic' !== $ace_home_mode ) {
  include locate_template( 'inc/ai-home-hero.php' );
}
?>
<?php if( 'classic' === $ace_home_mode && have_rows('banner') ):
  while( have_rows('banner') ) : the_row(); ?>
  <section class="lqd-section banner bg-no-repeat bg-center bg-cover py-60 md:px-0 d-flex items-center" id="banner">
    <div class="container">
      <div class="row">
        <div class="col col-12 col-lg-7 col-xl-7 lg:text-center text-start" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;all-childs&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 45 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
          <?php if(get_sub_field('title')): ?>
          <div class="ld-fancy-heading">
            <h1 class="ld-fh-element mb-0/35em lqd-split-lines text-white" data-split-text="true" data-split-options="{&quot;type&quot;: &quot;lines&quot;}"><?php the_sub_field('title'); ?></h1>
          </div>
          <?php endif; ?>
          <?php if(get_sub_field('paragraph')): ?>
          <div class="ld-fancy-heading">
            <p class="ld-fh-element mt-15 mb-2em lqd-split-lines leading-30 text-26 text-white-80" data-split-text="true" data-split-options="{&quot;type&quot;: &quot;lines&quot;}"><?php the_sub_field('paragraph'); ?>
            </p>
          </div>
          <?php endif; ?>

          <?php if(get_sub_field('link')): ?>
          <a href="<?php the_sub_field('link'); ?>" class="btn font-bold text-13 btn-solid text-white bg-primary uppercase border-thin btn-hover-swp leading-1/5em px-0/6em tracking-0/1em rounded-4 hover:bg-black hover:text-white" data-localscroll="true">
            <span class="inline-flex py-1/15em px-2/1em items-center">
              <span class="btn-txt" data-text="Explore hub">Get Started</span>
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
    <video class="hero_intro_video" poster="<?php echo esc_url( get_sub_field('banner_bg') ); ?>" autoplay muted loop playsinline preload="metadata" aria-hidden="true">
      <?php if ( get_sub_field('video_file') ) : ?><source src="<?php echo esc_url( get_sub_field('video_file') ); ?>" type="video/mp4"><?php endif; ?>
    </video>
  </section>
  <?php endwhile;
endif; ?>

  <?php include_once('inc/brands.php'); ?>

  <?php include locate_template( 'inc/ai-services-grid.php' ); ?>

  <?php include locate_template( 'inc/ai-tech-stack.php' ); ?>

<?php if( have_rows('services') ):
  while( have_rows('services') ) : the_row(); ?>
  <section class="lqd-section services pt-75 pb-45 border-bottom border-black-10" id="services">
    <div class="container">
      <div class="row justify-center">
        <?php if(get_sub_field('heading')): ?>
        <div class="col col-12 mb-40 text-center">
          <?php if(get_sub_field('sub_heading')): ?>
            <div class="ld-fancy-heading uppercase">
              <h6 class="ld-fh-element mb-1em"><?php the_sub_field('sub_heading'); ?></h6>
            </div>
          <?php endif; ?>
          <?php if(get_sub_field('heading')): ?>
            <div class="ld-fancy-heading">
              <h2 class="ld-fh-element mb-0/5em"><?php the_sub_field('heading'); ?></h2>
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
                 
                  <div class="iconbox relative block text-center mb-2em hover:opacity-100 animation-element">
                    <?php 
                      $icon = get_sub_field('icon'); 
                      if( !empty( $icon ) ): 
                    ?>
                    <div class="iconbox-icon-wrap mb-1em">
                      <span class="iconbox-icon-container w-64 h-64 text-24 text-white rounded-full">
                        <img loading="lazy" decoding="async" src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>"  width="64" height="64" loading="lazy" class="img-fluid">
                      </span>
                    </div>
                    <?php endif; ?>
                    <div class="contents">
                      <h3 class="text-15 mb-15 leading-1/5em uppercase"><?php if(get_sub_field('link')): ?><a href="<?php the_sub_field('link'); ?>"><?php endif; ?><?php the_sub_field('title'); ?><?php if(get_sub_field('link')): ?></a><?php endif; ?></h3>
                      <p><?php the_sub_field('paragraph'); ?></p>
                      
                      
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
<?php include_once('inc/awards.php'); ?>
  <?php include_once('inc/case-study.php'); ?>

<?php if( have_rows('steps') ): ?>
  <section class="lqd-section steps bg-gray-100 py-75 mt-55">
    <div class="container">
      
        <?php while( have_rows('steps') ) : the_row(); ?>
        
              <div class="row items-center">
                <div class="col col-12 col-md-6 col-lg-6 mb-35" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;all-childs&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;x&quot; : 35 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;x&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">

                    <div class="ld-fancy-heading lg:text-center text-start">
                      <h3 class="ld-fh-element mb-0/6em"><?php the_sub_field('heading'); ?></h3>
                    </div>
                    <div class="ld-fancy-heading lg:text-center text-start">
                      <?php the_sub_field('paragraph'); ?>
                    </div>
                    
                    <?php if(get_sub_field('link')): ?>
                    <a href="<?php the_sub_field('link'); ?>" class="btn font-bold text-13 btn-solid text-white bg-primary uppercase rounded-4 border-thin btn-hover-swp leading-1/5em tracking-0/1em rounded-4 hover:bg-black hover:text-white">
                      <span class="inline-flex py-1/15em px-2/1em items-center">
                        <span class="btn-txt" data-text="Learn more">Learn more</span>
                        <span class="btn-icon">
                          <i class="lqd-icn-ess icon-md-arrow-forward"></i>
                        </span>
                        <span class="btn-icon">
                          <i class="lqd-icn-ess icon-md-arrow-forward"></i>
                        </span>
                      </span>
                    </a>
                    <?php endif; ?>
                  <div class="w-full h-40 relative hidden module-space"></div>
                </div>
                <div class="col col-12 col-md-6 col-lg-5 offset-lg-1">
                  <?php 
                    $image = get_sub_field('image'); 
                    if( !empty( $image ) ): 
                  ?>
                  <figure class="max-w-full inline-flex vertical-top m-0 flex-grow-1 rounded-6">
                    <img loading="lazy" decoding="async" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"  width="998" height="696" loading="lazy" class="max-w-full h-auto vertical-top rounded-inherit">
                  </figure>
                  <?php endif; ?>
                </div>
              </div>
            
        <?php endwhile; ?>
            
    </div>
  </section>
<?php endif; ?>
<?php if( have_rows('industries') ): ?>
  <?php while( have_rows('industries') ) : the_row(); ?>
  <section class="lqd-section pt-100 pb-100 bg-gray-100">
    <div class="container">
      <div class="row">
        <div class="col col-12 mb-20" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;all-childs&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;x&quot; : -35 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;x&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
            <?php if(get_sub_field('heading')): ?>
              <div class="ld-fancy-heading text-center">
                <h2 class="ld-fh-element mb-0/35em"><?php the_sub_field('heading'); ?></h2>
              </div>
            <?php endif; ?>
            <?php if(get_sub_field('paragraph')): ?>
              <div class="text-center">
                <p class="ld-fh-element mb-1em leading-28 text-17"><?php the_sub_field('paragraph'); ?></p>
              </div>
            <?php endif; ?>
        </div>

        <?php if( have_rows('list') ): ?>
            <?php while( have_rows('list') ) : the_row(); ?>
            <div class="col col-6 col-md-4 col-lg-3 col-xl-2 py-20 text-center ca-initvalues-applied lqd-animations-done" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;all-childs&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;x&quot; : 35 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;x&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
              <img loading="lazy" decoding="async" src="<?php the_sub_field('icon'); ?>" alt="<?php the_sub_field('title'); ?>"  width="64 " height="64" loading="lazy" class="img-fluid">
              <h3 class="text-16 mt-20"><?php the_sub_field('title'); ?></h3>
              <?php if(get_sub_field('paragraph')): ?>
                <p class="mt-20"><?php the_sub_field('paragraph'); ?></p>
              <?php endif; ?>
            </div>
            <?php endwhile; ?>
        <?php endif; ?>
        <div class="col col-12 mt-20 text-center">
            <a href="<?php echo site_url(); ?>/industries/" class="btn font-bold text-13 btn-solid text-white bg-primary uppercase border-thin btn-hover-swp leading-1/5em tracking-0/1em rounded-4 hover:text-white lqd-unit-animation-done" style="">
              <span class="inline-flex py-1/15em px-2/1em items-center">
                <span class="btn-txt" data-text="Explore hub">Explore TechDotBit</span>
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
<?php if( have_rows('why_choose') ): ?>
  <?php while( have_rows('why_choose') ) : the_row(); ?>
  <section class="lqd-section why-tdb pt-100 pb-100 bg-gray-100">
    <div class="container">
      <div class="row">
        <div class="col col-12">
          <div class="w-full text-center mb-20" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;all-childs&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;x&quot; : -35 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;x&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
            <?php if(get_sub_field('heading')): ?>
              <div class="ld-fancy-heading">
                <h2 class="ld-fh-element mb-0/35em"><?php the_sub_field('heading'); ?></h2>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <?php if( have_rows('list') ): ?>
            <?php while( have_rows('list') ) : the_row(); ?>
            <div class="col col-12 col-md-6 col-lg-3 mt-30">
              
              <div class="home-whytech_block">
                  <div class="home-whytech_block-inner">
                      <div class="home-whytech_block-title-container">
                          <h2 class="home-whytech_block-title-key h2 bold"><?php the_sub_field('number'); ?></h2>
                          <h5 class="home-whytech_block-title bold"><?php the_sub_field('title'); ?></h5>
                      </div>
                      <?php the_sub_field('content'); ?>
                  </div>
              </div>
              
            </div>
            <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <?php endwhile; ?>
<?php endif; ?>

<?php if( have_rows('modern_tech') ): ?>
    <?php while( have_rows('modern_tech') ) : the_row(); ?>
    <section class="lqd-section clients modern-tech py-75">
        <div class="container-fluid">
          <div class="row">
            <div class="col col-12">
              <div class="ld-fancy-heading relative animation-element text-center mb-50">
                <h2 class="m-0 ld-fh-element m-0 inline-block pos-re"><?php the_sub_field('heading'); ?></h2>
              </div>
            </div>
            <?php if( have_rows('list') ): ?>
            <div class="col col-12 px-0">
              <div class="carousel-container carousel-nav-left carousel-nav-mobile-centercarousel-nav-md carousel-dots-mobile-center carousel-dots-style1 carousel-dots-mobile-outside">
                <div class="carousel-items row flickity-enabled is-draggable lqd-carousel-ready flickity-equal-cells" data-lqd-flickity="{&quot;marquee&quot;:true,&quot;wrapAround&quot;:true,&quot;equalHeightCells&quot;:true,&quot;middleAlignContent&quot;:true,&quot;columnsAutoWidth&quot;:true,&quot;marqueeTickerSpeed&quot;:&quot;0.5&quot;,&quot;cellAlign&quot;:&quot;center&quot;,&quot;draggable&quot;:false}">
                  <?php while( have_rows('list') ) : the_row(); ?>
                  <div class="carousel-item has-width w-20percent text-center">
                    <div class="carousel-item-inner">
                      <div class="carousel-item-content">
                        <div class="flex items-center justify-center">
                          <figure class="max-w-full  m-0 text-center">
                            <img loading="lazy" decoding="async" src="<?php the_sub_field('icon'); ?>" alt="<?php the_sub_field('name'); ?>" width="64" height="64" class="max-w-full h-auto vertical-top rounded-inherit">
                            <figcaption><?php the_sub_field('name'); ?></figcaption>
                          </figure>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endwhile; ?>
                </div>
              </div>
            </div>
            <?php endif; ?>
            <?php if( have_rows('list') ): ?>
            <div class="col col-12 px-0">
              <div class="carousel-container carousel-nav-left carousel-nav-mobile-centercarousel-nav-md carousel-dots-mobile-center carousel-dots-style1 carousel-dots-mobile-outside">
                <div class="carousel-items row flickity-enabled is-draggable lqd-carousel-ready flickity-equal-cells" data-lqd-flickity="{&quot;marquee&quot;:true,&quot;wrapAround&quot;:true,&quot;equalHeightCells&quot;:true,&quot;middleAlignContent&quot;:true,&quot;columnsAutoWidth&quot;:true,&quot;marqueeTickerSpeed&quot;:&quot;0.5&quot;,&quot;cellAlign&quot;:&quot;center&quot;,&quot;draggable&quot;:false,&quot;rightToLeft&quot;:true}">
                  <?php while( have_rows('list') ) : the_row(); ?>
                  <div class="carousel-item has-width w-20percent text-center">
                    <div class="carousel-item-inner">
                      <div class="carousel-item-content">
                        <div class="flex items-center justify-center">
                          <figure class="max-w-full  m-0 text-center">
                            <img loading="lazy" decoding="async" src="<?php the_sub_field('icon'); ?>" alt="<?php the_sub_field('name'); ?>" width="64" height="64" class="max-w-full h-auto vertical-top rounded-inherit">
                            <figcaption><?php the_sub_field('name'); ?></figcaption>
                          </figure>
                        </div>
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
    <?php endwhile; ?>
<?php endif; ?>

<?php if( have_rows('process') ): ?>
  <section class="lqd-section service-plans p-model pt-100 pb-70" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;.animation-element&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;x&quot; : 35 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;x&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
    <div class="container">
      <div class="row ">
        <div class="col col-12 text-center mb-40 mx-auto">
          <div class="ld-fancy-heading">
            <h2 class="ld-fh-element mb-0/4em">
              <?php the_field('process_heading'); ?>
            </h2>
          </div>
        </div>
        <?php while( have_rows('process') ) : the_row(); ?>
        <div class="col col-12 col-md-4 ">
          <div class="iconbox relative flex-row items-stretch justify-start mb-2em hover:inner-text-white hover:inner-opacity-100 animation-element" data-shape-border="1">
            <div class="contents text-center">
              <?php 
                $icon = get_sub_field('icon'); 
                if( !empty( $icon ) ): 
              ?>
              <div class="iconbox-icon-wrap mb-1em text-center">
                <span class="iconbox-icon-container w-300  h-200  text-24 text-white rounded-full">
                  <img loading="lazy" decoding="async" src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>"  width="300 " height="200  " loading="lazy" class="img-fluid">
                </span>
              </div>
              <?php endif; ?>
              <h3 class="text-16 font-bold"><?php the_sub_field('heading'); ?></h3>
              <p><?php the_sub_field('paragraph'); ?></p>
            </div>
          </div>
        </div>
        <?php endwhile; ?>
      </div>
    </div>
  </section>
<?php endif; ?>



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
        <div class="col col-12 col-lg-8 text-center" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;all-childs&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 45 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
          <div class="ld-fancy-heading">
            <h2 class="ld-fh-element mb-0/5em lqd-split-lines text-46 text-white font-bold px-5percent md:px-0" data-split-text="true" data-split-options="{&quot;type&quot;: &quot;lines&quot;}"><?php the_sub_field('heading'); ?></h2>
          </div>
          <div class="ld-fancy-heading">
            <p class="ld-fh-element mb-2em lqd-split-lines px-15percent leading-28 text-17 text-white-80 md:px-0" data-split-text="true" data-split-options="{&quot;type&quot;: &quot;lines&quot;}"><?php the_sub_field('paragraph'); ?>
            </p>
          </div>
          <a href="<?php the_sub_field('link'); ?>" class="btn font-bold text-13 btn-solid text-white bg-primary uppercase border-thin btn-hover-swp leading-1/5em tracking-0/1em rounded-4 hover:text-white">
            <span class="inline-flex py-1/15em px-2/1em items-center">
              <span class="btn-txt" data-text="Explore hub">Explore TechDotBit</span>
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



  <?php include_once('inc/testimonials.php'); ?>

  <?php include_once('inc/faq-list.php'); ?>

  <?php include_once('inc/bottom-cta.php'); ?>

<?php get_footer(); ?>