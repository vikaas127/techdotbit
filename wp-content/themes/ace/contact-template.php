<?php
/* Template Name: Contact Template */

get_header(); ?>

<style>
  .border{border: 1px solid #ddd; background: #eee;}
  .border p{margin-bottom: 0}
  .btns{list-style: none; padding: 0; display: flex; gap: 15px; border-bottom: 1px solid #3ead3c; margin-bottom: 30px;}
</style>

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

<section class="lqd-section py-70">
  <div class="container">
    <ul class="btns">
      <li><a href="#" class="btn font-medium btn-solid text-white bg-primary border-none text-11 leading-1/5em tracking-0/1em rounded-4"><span class="inline-flex py-0/85em px-1/5em">
                      <span class="btn-txt" data-text="Request Free Audit">For Business</span>
                    </span></a></li>
      <li><a href="<?php echo site_url(); ?>/career/" class="btn font-medium btn-solid text-white bg-secondary border-none text-11 leading-1/5em tracking-0/1em rounded-4"><span class="inline-flex py-0/85em px-1/5em">
                      <span class="btn-txt" data-text="Request Free Audit">For Career</span>
                    </span></a></li>
    </ul>
    <div class="row">
      <div class="col col-12 col-lg-6 col-xl-5">
        <h2><?php the_field('heading'); ?></h2>
        <p class="text-15"><?php the_field('paragraph'); ?></p>
        <address class="mt-30">
          <h5 class="text-16 mb-15">Address</h5>
          <?php the_field('address'); ?>

          <div class="d-flex items-center">
            <h5 class="text-16 my-1" style="margin-right: 15px;">Phone:</h5>
            <a href="tel:<?php the_field('phone'); ?>"><?php the_field('phone'); ?></a>
          </div>
          <div class="d-flex items-center">
            <h5 class="text-16 my-1" style="margin-right: 15px;">Email:</h5>
            <a href="mailto:<?php the_field('email'); ?>"><?php the_field('email'); ?></a>
          </div>
        </address>

        <?php if( have_rows('more_locations') ): ?>
          <?php while( have_rows('more_locations') ) : the_row(); ?>
            <address class="border p-20">
              <h5 class="text-16 mb-15"><?php the_sub_field('location'); ?></h5>
              <?php the_field('address'); ?>

              <?php if(get_sub_field('phone')): ?>
                <div class="d-flex items-center">
                  <h5 class="text-16 my-1" style="margin-right: 15px;">Phone:</h5>
                  <a href="tel:<?php the_sub_field('phone'); ?>"><?php the_field('phone'); ?></a>
                </div>
              <?php endif; ?>
              <?php if(get_sub_field('email')): ?>
                <div class="d-flex items-center">
                  <h5 class="text-16 my-1" style="margin-right: 15px;">Email:</h5>
                  <a href="mailto:<?php the_sub_field('email'); ?>"><?php the_field('email'); ?></a>
                </div>
              <?php endif; ?>
            </address>
          <?php endwhile; ?>
        <?php endif; ?>

        

      </div>
      <div class="col col-12 col-lg-6 col-xl-6 offset-xl-1 contact-form">
        <?php echo do_shortcode('[contact-form-7 id="b3de3ca" title="Contact Us Form"]'); ?>
      </div>
    </div>
  </div>
</section>

<?php include_once('inc/brands.php'); ?>
<?php get_footer(); ?>