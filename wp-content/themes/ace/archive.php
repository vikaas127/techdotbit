<?php get_header(); ?>

<section class="lqd-section banner bg-no-repeat bg-center bg-cover py-70 px-70 md:px-0">
    <div class="container">
      <div class="row">
        <div class="col col-12 col-lg-7 col-xl-6" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;all-childs&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 45 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
          <div class="ld-fancy-heading">
            <h1 class="ld-fh-element mb-0/35em lqd-split-lines text-white" data-split-text="true" data-split-options="{&quot;type&quot;: &quot;lines&quot;}"><?php echo wp_kses_post( get_the_archive_title() ); ?></h1>
            <div class="breadcrumb text-14"><a href="<?php echo site_url(); ?>" class="text-white">Home</a> &nbsp;&nbsp;/&nbsp;&nbsp; <a href="<?php echo site_url(); ?>/blog/" class="text-white">Blog</a> &nbsp;&nbsp;/&nbsp;&nbsp; <span class="text-white"><?php echo esc_html( wp_strip_all_tags( get_the_archive_title() ) ); ?></span></div>
          </div>
        </div>
      </div>
    </div>
</section>

<section class="lqd-section blog pt-90 pb-70">
    <div class="container">
                
        <div class="row">
          <div class="col-lg-8 col-md-8 px-15 py-15">
            <?php
              // Check if there are any posts to display
              if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                  <div class="article mb-40">
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                      <div class="row">
                        <div class="col-12 col-md-6 py-0 px-15">
                          <a href="<?php the_permalink(); ?>" rel="bookmark"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'large', array( 'class' => 'img-fluid', 'alt' => the_title_attribute( array( 'echo' => false ) ), 'loading' => 'lazy', 'decoding' => 'async' ) ); } ?></a>
                        </div>
                        <div class="col-12 col-md-6 py-0 px-15">
                          <?php $categories = get_the_category();
                            foreach ($categories as $cat) {
                                $category_link = get_category_link($cat->cat_ID);
                                echo '<a class="inline-block text-18 font-medium" href="' . esc_url($category_link) . '" title="' . esc_attr($cat->name) . '">' . esc_html($cat->name) . '</a>';
                            }
                          ?>
                          <h3 class="entry-title lqd-lp-title text-24 mt-1/5rem relative z-2 mb-20">
                            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                          </h3>

                          <?php the_excerpt(); ?>
                          
                          <div class="lqd-lp-author flex flex-wrap items-center relative z-3">
                           <!--  <figure class="rounded-full overflow-hidden mr-10">
                              <?php // echo get_avatar( get_the_author_meta('ID')); ?>
                            </figure> -->
                            <span class="lqd-lp-author-info">
                              <?php the_author(); ?> &nbsp;&nbsp; <?php echo esc_html( get_the_date() ); ?>
                            </span>
                          </div>
                        </div>
                      </div>
                    </article>
                  </div>
                <?php endwhile; ?>

                <div class="pagination mt-20">
                    <?php the_posts_pagination();  ?>
                </div>
            <?php else: ?>
                <p class="px-15">No post found.</p>
            <?php endif; ?>
          </div>
          <div class="col-lg-4 col-md-4 px-15 ">
            <div class="categories">
              <h2 class="pt-30 pb-20">Categories</h2>
              <?php
                $categories = get_categories();
                foreach($categories as $category) {
                   echo '<a href="' . esc_url( get_category_link($category->term_id) ) . '">' . esc_html( $category->name ) . '</a>';
                }
               ?>
            </div>
          </div>
      </div>
  </div>
</section>

<section class="lqd-section image-bg contact pt-100 pb-80 transition-all">
  <span class="row-bg-loader w-60 h-60 inline-block absolute top-50percent left-50percent -mt-30 -ml-30 transition-all"></span>
  <div class="row-bg-wrap absolute top-0 left-0 right-0 bottom-0 inline-block overflow-hidden">
    <figure class="row-bg transition-all bg-no-repeat bg-center bg-cover absolute top-0 left-0 right-0 bottom-0 inline-block overflow-hidden" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/demo/classic/image-bg/bg-3%402x-scaled.jpg);"></figure>
  </div>
  <div class="liquid-row-overlay bg-black-30 w-full h-full absolute block rounded-inherit top-0 left-0 transition-all"></div>
  <div class="container">
    <div class="row items-center">
      <div class="col col-12 col-lg-7" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;.lqd-lines > .split-inner&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 90} , &quot;animations&quot;: {&quot;y&quot; : 0}}">
        <div class="ld-fancy-heading mask-text mb-45">
          <h2 class="ld-fh-element mb-0 lqd-split-lines text-44 tracking-0 text-white" data-split-text="true" data-split-options="{&quot;type&quot;: &quot;lines&quot;}" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;.lqd-lines > .split-inner&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 90} , &quot;animations&quot;: {&quot;y&quot; : 0}}">We build digital products that help you unlock opportunities and embrace innovation.</h2>
        </div>
      </div>
      <div class="col col-12 col-lg-5 text-end md:text-start" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;all-childs&quot;, &quot;duration&quot; : 700 , &quot;delay&quot; : 100 , &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 39 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
        <a href="#header-contact-modal" class="btn font-bold text-13 btn-solid text-white bg-primary uppercase border-thin btn-hover-swp leading-1/5em tracking-0/1em rounded-4 hover:text-white" data-lity="#header-contact-modal">
          <span class="inline-flex py-1/5em px-3/5em items-center">
            <span class="btn-txt" data-text="get in touch">get in touch</span>
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

<?php get_footer(); ?>