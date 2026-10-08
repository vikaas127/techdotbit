<?php
/* Template Name: About Template */

get_header(); ?>

<?php if( have_rows('banner') ):
  while( have_rows('banner') ) : the_row(); ?>
  <section class="lqd-section banner bg-no-repeat bg-center bg-cover py-70 px-70 md:px-0" style="background-image: url(<?php the_sub_field('banner_bg'); ?>);">
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
<?php include_once('inc/brands.php'); ?>

<?php if( have_rows('about_company') ): 
  while( have_rows('about_company') ) : the_row(); ?>
  <section class="lqd-section why-ace py-90">
    <div class="container">
      <div class="row items-center">
        <div class="col col-12 col-lg-6 mb-25">
          <?php 
            $image = get_sub_field('company_image'); 
            if( !empty( $image ) ): 
          ?>
          <figure class="max-w-full inline-flex vertical-top m-0 flex-grow-1 rounded-6">
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"  width="998" height="696" loading="lazy" class="max-w-full h-auto vertical-top rounded-inherit">
          </figure>
          <?php endif; ?>
          
        </div>
        <div class="col col-12 col-lg-5 offset-lg-1 mb-25 ca-initvalues-applied lqd-animations-done">
          
          <div class="ld-fancy-heading lqd-unit-animation-done" style="">
             <h3 class="ld-fh-element mb-0/6em"><?php the_sub_field('heading'); ?></h3>
          </div>
          <div class="ld-fancy-heading lqd-unit-animation-done" style="">
             <p><?php the_sub_field('paragraph'); ?></p>
          </div>
        </div>
        
      </div>
    </div>
  </section>
  <?php endwhile;
endif; ?>

  <section class="lqd-section services pb-75 inner-services">
    <div class="container">
      <div class="row justify-center">

        <?php if( have_rows('value_mission_vision') ): ?>
        <div class="col col-12">
          <div class="-mr-15 -ml-15" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;.animation-element&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 35 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
            <div class="container-fluid">
              <div class="row">
                <?php while( have_rows('value_mission_vision') ) : the_row(); ?>
                <div class="col col-12 col-md-6 col-lg-4 mb-20">
                  <div class="iconbox relative flex-row items-stretch justify-start text-start mb-2em hover:opacity-100 animation-element">
                    <?php 
                      $icon = get_sub_field('icon'); 
                      if( !empty( $icon ) ): 
                    ?>
                    <div class="iconbox-icon-wrap">
                      <span class="iconbox-icon-container w-90 h-90">
                        <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>"  width="90" height="90" loading="lazy" class="img-fluid">
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

<?php if( have_rows('our_team') ): ?>
	<?php while( have_rows('our_team') ) : the_row(); ?>
  <section class="lqd-section pt-90 pb-55 bg-gray-100">
    <div class="container">
	
		<div class="mb-35 ca-initvalues-applied lqd-animations-done">
          
          <div class="ld-fancy-heading lqd-unit-animation-done text-center" style="">
             <h3 class="ld-fh-element mb-0/6em"><?php the_sub_field('heading'); ?></h3>
          </div>
          <div class="ld-fancy-heading lqd-unit-animation-done text-center" style="">
             <?php the_sub_field('paragraph'); ?>
          </div>
        </div>
	<?php if( have_rows('member_list') ): ?>
      <div class="row justify-center">
        
        <?php while( have_rows('member_list') ) : the_row(); ?>
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
                <h5 class="mb-0/6em"><?php the_sub_field('name'); ?></h5>
                <h6 class="mb-0/6em"><?php the_sub_field('designation'); ?></h6>
                <p class="mb-2em"><i><?php the_sub_field('tags'); ?></i></p>
            </div>
        <?php endwhile; ?>
        
      </div>
	<?php endif; ?>
    </div>
  </section>
	<?php endwhile; ?>
<?php endif; ?>

<?php include_once('inc/stats.php'); ?>

<?php if( have_rows('why_choose') ): 
  while( have_rows('why_choose') ) : the_row(); ?>
  <section class="lqd-section why-ace py-90 bg-gray-100">
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

<?php include_once('inc/testimonials.php'); ?>
<?php include_once('inc/bottom-cta.php'); ?>
<?php get_footer(); ?>