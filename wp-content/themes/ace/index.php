<?php

get_header(); ?>
<style>
.latest-blog-posts .article article{margin-bottom: 30px}
.latest-blog-posts .sticky {
    display: none;
}
.pagination a, .pagination span {
    display: inline-flex;
    height: 28px;
    width: 28px;
    justify-content: center;
    align-items: center;
    border: 1px solid #ddd;
    background: transparent;
}
.pagination .dots {
    border: none;
}
.pagination span.current {
    background: #000;
    color: #fff;
    border-color: #000;
}
.latest-blog-posts .pagination .prev, .pagination a.next {
    display: none;
}
</style>

  
  <section class="lqd-section blog pt-90 pb-70">
    <div class="container">
      <h1 class="h2 mb-40"><?php echo esc_html( get_option( 'page_for_posts' ) ? get_the_title( get_option( 'page_for_posts' ) ) : __( 'Blog', 'ace' ) ); ?></h1>
      <div class="row">

        <?php 

        $args = array(
            'posts_per_page' => 1,
            'post__in'  => get_option( 'sticky_posts' ) ? get_option( 'sticky_posts' ) : array( 0 ), // no sticky post => no featured slot
            'ignore_sticky_posts' => 1
        );
        $my_query = new WP_Query( $args );

        $do_not_duplicate = array();
        while ( $my_query->have_posts() ) : $my_query->the_post();
            $do_not_duplicate[] = $post->ID; ?>

          <div class="col-lg-12 col-md-12 col-sm-12 col-12 py-0 px-15 mb-30 article">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <div class="row items-center">
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
                  <h3 class="entry-title lqd-lp-title h3 mt-1/5rem relative z-2 mb-20">
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
          <?php wp_reset_postdata(); //VERY VERY IMPORTANT?>
        
          <div class="col col-12 px-15">
            <div class="lqd-lp-grid blog-wrapper latest-blog-posts">
              <div class="row">
                <div class="col-lg-8 col-md-8 px-15 py-15">

                  <h2 class="pt-30 pb-20 text-24">Latest</h2>

                  <?php 
              
              		
              
              		//$query = new WP_Query( array( 'post__not_in' => get_option( 'sticky_posts' )) );
                  if ( have_posts() ) {
					$temp = $wp_query; $wp_query = null; 
					$wp_query = new WP_Query();
					$wp_query->query('posts_per_page=12' . '&paged='.$paged);
					
                    ?>
                    <div class="row">
                      <?php while($wp_query->have_posts()) : $wp_query->the_post(); ?>
                      <div class="col col-12 py-0 px-15 article">

                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                          <div class="row">
                            <div class="col-12 col-md-6 col-lg-6 py-0 px-15">
                              <a href="<?php the_permalink(); ?>" rel="bookmark"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'large', array( 'class' => 'img-fluid', 'alt' => the_title_attribute( array( 'echo' => false ) ), 'loading' => 'lazy', 'decoding' => 'async' ) ); } ?></a>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 py-0 px-15">
                              <?php $categories = get_the_category();
                                foreach ($categories as $cat) {
                                    $category_link = get_category_link($cat->cat_ID);
                                    echo '<a class="inline-block font-medium text-14" href="' . esc_url($category_link) . '" title="' . esc_attr($cat->name) . '">' . esc_html($cat->name) . '</a>';
                                }
                              ?>
                              <h3 class="entry-title lqd-lp-title text-20 mt-10 relative z-2 mb-10">
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
                    
                      <div class="col col-12 px-15 mt-20 pagination">
                        <?php 
                          //wp_pagenavi(); 
                       		the_posts_pagination();   
                       ?>
                      </div>
                    </div>
                  <?php } $wp_query = $temp; wp_reset_postdata();?>
                </div>
                <div class="col-lg-4 col-md-4 px-15 py-15">
                  <div class="categories">
                    <h2 class="pt-30 pb-20 text-24">Categories</h2>
                    <?php
                      $categories = get_categories();
                      foreach($categories as $category) {
                         echo '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';
                      }
                     ?>
                  </div>
                  
                </div>
              </div>
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