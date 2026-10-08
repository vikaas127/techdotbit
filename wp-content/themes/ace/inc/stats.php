<?php if( have_rows('stats', 'option') ): ?>
<section class="lqd-section services pt-75 pb-50 inner-services bg-blue stats">
  <div class="container">
    <div class="row justify-center">
      <div class="col col-12">
        <div class="-mr-15 -ml-15" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;.animation-element&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 35 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
          <div class="container-fluid">
            <div class="row">
              <?php while( have_rows('stats', 'option') ) : the_row(); ?>
              <div class="col col-6 col-md-3 mb-20" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;all-childs&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;x&quot; : 35 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;x&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
                <div class="iconbox relative flex-row items-stretch justify-start text-start mb-2em hover:opacity-100 animation-element">
                  <?php 
                    $icon = get_sub_field('icon'); 
                    if( !empty( $icon ) ): 
                  ?>
                  <div class="iconbox-icon-wrap">
                    <span class="iconbox-icon-container w-64 h-64">
                      <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>"  width="64" height="64" loading="lazy" class="img-fluid">
                    </span>
                  </div>
                  <?php endif; ?>
                  
                  <div class="contents">
                    <span class="text-30 mb-25 leading-1/5em"><span class="counting" data-count="<?php the_sub_field('count'); ?>" style="display: inline-block">0</span>+</span>
                    <h3 class="text-15 leading-1/5em uppercase"><?php the_sub_field('title'); ?></h3>
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