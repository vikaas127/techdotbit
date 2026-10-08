<?php
/* Template Name: Industry Inner Template */

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

  <?php if( have_rows('benefits_copy') ):
    while( have_rows('benefits_copy') ) : the_row(); ?>
    <section class="lqd-section services pt-75 pb-30 inner-services">
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
                <h2 class="ld-fh-element mb-0/5em px-15percent lg:px-0"><?php the_sub_field('heading'); ?></h2>
              </div>
            <?php endif; ?>
            <?php if(get_sub_field('paragraph')): ?>
              <p class="ld-fh-element mb-2em leading-28 text-17"><?php the_sub_field('paragraph'); ?></p>
            <?php endif; ?>
          </div>
          <?php endif; ?>

          <?php if( have_rows('expertise_list') ): ?>
          <div class="col col-12">
            <div class="-mr-15 -ml-15" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;.animation-element&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 35 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
              <div class="container-fluid">
                <div class="row">
                  <?php while( have_rows('expertise_list') ) : the_row(); ?>
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
                        <h3 class="text-15 mb-15 leading-1/5em uppercase"><?php the_sub_field('title'); ?></h3>
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


    <?php $featured_posts = get_field('case_studies'); ?>
    <?php if ( $featured_posts && is_array( $featured_posts ) ) : ?>
    <section class="lqd-section case-study-carousel pt-60 pb-100" data-custom-animations="true" data-ca-options="{&quot;animationTarget&quot;: &quot;.animation-element&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;initValues&quot;: {&quot;y&quot;: &quot;30px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
      <div class="container">
        <div class="row items-center justify-between">
          <div class="col col-12 col-md-6 md:text-center text-start">
            <div class="ld-fancy-heading relative animation-element">
              <h2 class="m-0 ld-fh-element m-0 inline-block pos-re">Case Studies</h2>
            </div>
          </div>
          <div class="col col-12 col-md-6 text-end sm:text-center">
            <div class="fancy-button animation-element">
              <a href="<?php echo esc_url( ace_portfolio_url() ); ?>" class="btn btn-naked font-bold uppercase whitespace-nowrap tracking-1/5 leading-1/4em text-green-900">
                <span class="btn-txt" data-text="see more works">see more works</span>
              </a>
            </div>
          </div>

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
                <div class="carousel-item col-12 col-lg-6 col-xl-4 mr-60">
                  <article class="lqd-pf-item lqd-pf-item-style-3 lqd-pf-overlay-bg-scale lqd-pf-content-v pf-details-h-str">
                    <div class="lqd-pf-item-inner">
                      <div class="lqd-pf-img overflow-hidden rounded-6 relative mb-2em">
                        <figure>
                          <figure class="lqd-overlay flex">
                            <?php the_post_thumbnail('large', [ 'alt' => the_title_attribute( array( 'echo' => false ) ), 'class' => 'w-full h-full objfit-cover objfit-center', 'loading' => 'lazy' ] ); ?>
        
                          </figure>
                        </figure>
                        <span class="lqd-pf-overlay-bg lqd-overlay flex items-center justify-center bg-transparent text-white" style="background-image: linear-gradient(180deg, rgb(0 0 0 / 75%) 0%, rgb(70 70 70 / 75%) 100%)">
                          <i class="lqd-icn-ess icon-md-arrow-forward"></i>
                        </span>
                      </div>
                      <div class="lqd-pf-details sm:text-center text-start">
                        <h2 class="lqd-pf-title mt-0 mb-1 h5"><?php the_title(); ?></h2>
                        
                        <span class="leading-1/4em"><?php echo ( $terms && ! is_wp_error( $terms ) ) ? esc_html( $terms[0]->name ) : ''; ?></span>
                      </div>
                      <a href="<?php the_permalink(); ?>" class="lqd-overlay flex lqd-pf-overlay-link leading-1/4em fresco" data-fresco-group="case-studies"></a>
                    </div>
                  </article>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
          <?php wp_reset_postdata(); ?>
        </div>
      </div>
    </section>
    <?php endif; ?>


  
  <?php if( have_rows('technologies') ): 
  $i = 1; // Set the increment variable ?>
  <section class="lqd-section case-studies pt-90 pb-70 bg-gray-100">
    <div class="container">
      <div class="ld-fancy-heading text-center">
        <h2 class="ld-fh-element mb-0/4em" data-split-text="true" data-split-options="{&quot;type&quot;: &quot;lines&quot;}">Tools & Technologies</h2>
      </div>

      <div class="row mt-45">
        <div class="col col-12 col-md-4 col-lg-3" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;all-childs&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 45 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
          <ul class="list-unstyled text-center md:text-start tools-tab py-30" id="tabs-tools">
            <?php while ( have_rows('technologies') ) : the_row(); ?>
             <li><a href="#tech-<?php echo esc_attr( sanitize_title( get_sub_field('tab_heading') ) ); ?>"><?php the_sub_field('tab_heading'); ?></a></li>
            <?php endwhile; ?>
          </ul>
        </div>
        <div class="col col-12 col-md-8 col-lg-9 text-center md:text-start" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;all-childs&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 45 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
          <div class="tab-list" id="tabs-tools-content">
            <?php while ( have_rows('technologies') ) : the_row(); ?>
             <div class="tab-content" id="tech-<?php echo esc_attr( sanitize_title( get_sub_field('tab_heading') ) ); ?>">
                 <?php if( have_rows('list') ): ?>
                 <ul class="list-unstyled tools-list d-flex flex-wrap">
                     <?php while ( have_rows('list') ) : the_row(); ?>
                     <li>
                         <a href="<?php the_sub_field('link'); ?>">
                             <figure>
                                 <img src="<?php the_sub_field('icon'); ?>" alt="<?php the_sub_field('tech_name'); ?> Icon" width="64" height="64" loading="lazy" class="img-fluid">
                                 <figcaption><?php the_sub_field('tech_name'); ?></figcaption>
                             </figure>
                         </a>
                     </li>
                     <?php endwhile; ?>
                 </ul>
                 <?php endif; ?>
             </div>
             <?php endwhile; ?>
          </div>
        </div>
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