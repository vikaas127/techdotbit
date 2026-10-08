<?php

/**
 * The template for displaying all single posts
 */

get_header(); ?>


<?php if( is_singular('project') ): ?>
	<?php $loop = new WP_Query(array('post_type' => 'project')); ?>
	<section class="portfolio-banner py-50 bg-blue" >
		<div class="container">
			<div class="row items-center">
				
				<div class="col col-12 col-md-7 col-lg-7 portfolio-details">
					<?php $terms = get_the_terms( $post->ID, 'tagportfolio' ); 
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
					
					<h1 class="text-white mt-15 mb-25"><?php the_title(); ?></h1>
					<div class="hidden md:block">
						<?php the_post_thumbnail('full', [ 'alt' => esc_html ( get_the_title() ) ] ); ?>
					</div>
					<p class="text-light mb-25">Category:<span class="block text-white font-medium"><?php echo $term->name; ?></span></p>
					<p class="text-white mb-0"><?php the_field('short_description'); ?></p>
					
				</div>
				<div class="col col-12 col-md-5 col-lg-4  offset-lg-1 md:hidden">
					<?php the_post_thumbnail('full', [ 'alt' => esc_html ( get_the_title() ) ] ); ?>
				</div>
			</div>
		</div>
	</section>
    
    <?php if( have_rows('about_project') ): ?>
        <?php while( have_rows('about_project') ) : the_row(); ?>
    	<section class="lqd-section py-75">
    		<div class="container">
    			<div class="row items-center">
    			    <div class="col col-12 col-md-6" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;all-childs&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 45 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
    			        <figure class="max-w-full inline-flex vertical-top m-0 flex-grow-1 justify-center">
                            <img src="<?php the_sub_field('screen_image'); ?>" alt="<?php the_sub_field('heading'); ?>" class="max-w-full h-auto vertical-top rounded-inherit">
                        </figure>
    			    </div>
    			    <div class="col col-12 col-md-6" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;all-childs&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 45 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
    			        <div class="ld-fancy-heading md:text-center text-start">
                            <h2 class="ld-fh-element mb-0/4em" data-split-text="true" data-split-options="{&quot;type&quot;: &quot;lines&quot;}"><?php the_sub_field('heading'); ?></h2>
                        </div>
                        <div class="ld-fancy-heading lqd-unit-animation-done" style="">
                           <?php the_sub_field('content'); ?>
                        </div>
    			    </div>
    			</div>
    		</div>
    	</section>
    	<?php endwhile; ?>
    <?php endif; ?>
    
    <?php if( have_rows('results') ): ?>
        <?php while( have_rows('results') ) : the_row(); ?>
    	<section class="lqd-section pb-75 project-results">
    		<div class="container">
    			<div class="row items-center">
    			    
    			    <div class="col col-12 col-md-6" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;all-childs&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 45 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
    			        <div class="ld-fancy-heading md:text-center text-start">
                            <h2 class="ld-fh-element mb-0/4em" data-split-text="true" data-split-options="{&quot;type&quot;: &quot;lines&quot;}"><?php the_sub_field('heading'); ?></h2>
                        </div>
                        <div class="ld-fancy-heading lqd-unit-animation-done" style="">
                           <?php the_sub_field('content'); ?>
                        </div>
    			    </div>
    			    
    			    <div class="col col-12 col-md-6" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;all-childs&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 45 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
    			        <figure class="max-w-full inline-flex vertical-top m-0 flex-grow-1 justify-center">
                            <img src="<?php the_sub_field('screen_image'); ?>" alt="<?php the_sub_field('heading'); ?>" class="max-w-full h-auto vertical-top rounded-inherit">
                        </figure>
    			    </div>
    			</div>
    		</div>
    	</section>
    	<?php endwhile; ?>
    <?php endif; ?>
    
    <?php if( have_rows('mission') ): ?>
        <?php while( have_rows('mission') ) : the_row(); ?>
    	<section class="lqd-section pb-75">
    		<div class="container">
    			<div class="row items-center">
    			    <div class="col col-12 col-md-6" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;all-childs&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 45 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
    			        <figure class="max-w-full inline-flex vertical-top m-0 flex-grow-1 justify-center">
                            <img src="<?php the_sub_field('screen_image'); ?>" alt="<?php the_sub_field('heading'); ?>" class="max-w-full h-auto vertical-top rounded-inherit">
                        </figure>
    			    </div>
    			    <div class="col col-12 col-md-6" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;all-childs&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 45 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
    			        <div class="ld-fancy-heading md:text-center text-start">
                            <h2 class="ld-fh-element mb-0/4em" data-split-text="true" data-split-options="{&quot;type&quot;: &quot;lines&quot;}"><?php the_sub_field('heading'); ?></h2>
                        </div>
                        <div class="ld-fancy-heading lqd-unit-animation-done" style="">
                           <?php the_sub_field('content'); ?>
                        </div>
    			    </div>
    			</div>
    		</div>
    	</section>
    	<?php endwhile; ?>
    <?php endif; ?>
    
    <?php if( have_rows('features') ): ?>
      <?php while ( have_rows('features') ) : the_row(); ?>
      <section class="lqd-section case-studies pt-90 pb-70 bg-blue">
        <div class="container">
          <div class="ld-fancy-heading">
            <h2 class="ld-fh-element mb-0/4em text-white" data-split-text="true" data-split-options="{&quot;type&quot;: &quot;lines&quot;}"><?php the_sub_field('heading'); ?></h2>
          </div>
    
        
          <div class="row mt-30">
            <div class="col col-12 feature-tab" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;all-childs&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 45 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
              <?php if( have_rows('tabs') ):  
              $i = 1; // Set the increment variable ?>
              <ul class="list-unstyled d-flex py-30" id="tabs-tools">
                <?php while ( have_rows('tabs') ) : the_row(); ?>
                 <li><a href="#tab<?php echo $i++; ?>" class="text-white"><?php the_sub_field('tab_name'); ?></a></li>
                <?php endwhile; ?>
              </ul>
              <?php endif; ?>
              <?php if( have_rows('tabs') ):  
              $i = 1; // Set the increment variable ?>
              <div class="tab-list" id="tabs-tools-content">
                <?php while ( have_rows('tabs') ) : the_row(); ?>
                 <div class="tab-content text-white" id="tab<?php echo $i++; ?>">
                     <?php if( have_rows('tab_content') ): ?>
                     <div class="row">
                         <?php while ( have_rows('tab_content') ) : the_row(); ?>
                         <div class="col col-12 col-md-6 col-lg-3">
                             <?php the_sub_field('content'); ?>
                         </div>
                         <?php endwhile; ?>
                     </div>
                    <?php endif; ?>
                 </div>
                 <?php endwhile; ?>
              </div>
              <?php endif; ?>
            </div>
          </div>
          
          
        </div>
      </section>
      <?php endwhile; ?>
  <?php endif; ?>
	
	<?php include_once('inc/development-cycle.php'); ?>
	
	<?php if( have_rows('tech_stack') ): 
      $i = 1; // Set the increment variable ?>
      <section class="lqd-section case-studies pt-90 pb-70 bg-gray-100">
        <div class="container">
          <div class="ld-fancy-heading text-center">
            <h2 class="ld-fh-element mb-0/4em" data-split-text="true" data-split-options="{&quot;type&quot;: &quot;lines&quot;}">Tools & Technologies</h2>
          </div>
    
          <div class="row mt-45">
            <div class="col col-12 col-md-4 col-lg-3" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;all-childs&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 45 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
              <ul class="list-unstyled text-center md:text-start tools-tab py-30" id="tabs-tools">
                <?php while ( have_rows('tech_stack') ) : the_row(); ?>
                 <li><a href="#<?php the_sub_field('tab_heading'); ?>"><?php the_sub_field('tab_heading'); ?></a></li>
                <?php endwhile; ?>
              </ul>
            </div>
            <div class="col col-12 col-md-8 col-lg-9 text-center md:text-start" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;all-childs&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 45 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
              <div class="tab-list" id="tabs-tools-content">
                <?php while ( have_rows('tech_stack') ) : the_row(); ?>
                 <div class="tab-content" id="<?php the_sub_field('tab_heading'); ?>">
                     <?php if( have_rows('list') ): ?>
                     <ul class="list-unstyled tools-list d-flex flex-wrap">
                         <?php while ( have_rows('list') ) : the_row(); ?>
                         <li>
                             <a href="<?php the_sub_field('link'); ?>">
                                 <figure>
                                     <img src="<?php the_sub_field('icon'); ?>" alt="<?php the_sub_field('title'); ?> Icon" width="64" height="64" loading="lazy" class="img-fluid">
                                     <figcaption><?php the_sub_field('title'); ?></figcaption>
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


  <?php if( have_rows('screens') ): ?>
    <section class="lqd-section services py-75 inner-services bg-gray">
        <div class="carousel-container carousel-nav-left carousel-nav-mobile-centercarousel-nav-md carousel-dots-mobile-center carousel-dots-style1 carousel-dots-mobile-outside">
          <div class="carousel-items row flickity-enabled is-draggable lqd-carousel-ready flickity-equal-cells" data-lqd-flickity="{&quot;marquee&quot;:true,&quot;wrapAround&quot;:true,&quot;equalHeightCells&quot;:true,&quot;middleAlignContent&quot;:true,&quot;columnsAutoWidth&quot;:true,&quot;marqueeTickerSpeed&quot;:&quot;2&quot;,&quot;cellAlign&quot;:&quot;center&quot;,&quot;draggable&quot;:true}">
            <?php while( have_rows('screens') ) : the_row(); ?>
            <div class="carousel-item has-width w-25percent text-center md:px-15 px-30">
              <div class="carousel-item-inner">
                <div class="carousel-item-content">
                  <div class="flex items-center">
                    <?php 
                      $image = get_sub_field('image'); 
                      if( !empty( $image ) ): 
                    ?>
                      <figure class="max-w-full inline-flex vertical-top m-0 flex-grow-1 justify-center">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="427" height="494" class="max-w-full h-auto vertical-top rounded-inherit">
                      </figure>
                        
                    <?php endif; ?>
                    
                  </div>
                </div>
              </div>
            </div>
            <?php endwhile; ?>
          </div>
        </div>
        
</section>
<?php endif; ?>

	<?php include_once('inc/brands.php'); ?>

<?php else: ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<section class="breadcrumb inner-banner-area bg-gray-100 py-30">
		<div class="container">
				<a href="#">Home</a> &nbsp;&nbsp;/&nbsp;&nbsp;
				<a href="#">Blog</a> &nbsp;&nbsp;/&nbsp;&nbsp;
				<?php $category = get_the_category();
				if ( ! empty( $category ) ) { ?>
					<a href="<?php echo esc_url( get_category_link( $category[0]->term_id ) ); ?>"><?php echo $category[0]->cat_name; ?></a>&nbsp;&nbsp;/&nbsp;&nbsp;
				<?php } ?>
				<span><?php the_title(); ?></span>
		</div>
	</section>

	<article class="single-blog-post pt-75">
		<div class="container entry-header">
			<div class="row items-center">
				<div class="col col-12 col-lg-6">
					<span class="d-block"><?php $cat = get_the_category(); echo $cat[0]->cat_name; ?></span>
					<h1 class="heading mt-15 text-24"><?php the_title(); ?></h1>
					<!--<p><--?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>-->
					<div class="d-flex author-profile items-center mt-30 mt-lg-45">
						<div class="author-img mr-15">
							<?php echo get_avatar( get_the_author_meta( 'ID' ), 64 ); ?>
						</div>
						<div class="author-content">
							<h4 class="text-16"><?php the_author(); ?></h4>
							<span class="d-inline-flex align-items-center pr-md-3"><?php the_date(); ?></span> 
							
						</div>
					</div>
				</div>
				<div class="col col-12 col-lg-6 col-xl-5 offset-xl-1 mt-15 mt-lg-0">
					<?php if(has_post_thumbnail()){ ?>
						<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" alt="<?php the_title(); ?>" class="img-fluid post-thumbnail rounded-4 mt-lg-0">
					<?php } ?>
				</div>
			</div>
		

			<div class="row mt-40">
				<?php if ( is_single() && 'post' == get_post_type() ) { ?>
				<div class="col col-12 col-lg-3">
					<div class="left-box pr-20">
						<?php echo do_shortcode('[TOC]'); ?>
						<hr class="mt-30 mb-30">
						<div class="share-box">
							<h5 class="text-16 mb-15">Share this article</h5>
							<?php echo do_shortcode('[social]'); ?>
						</div>
					</div>
				</div>
				<?php } ?>
				<div class="col col-12 col-lg-9 entry-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</article>



	<?php endwhile; endif; ?>

	<?php if ( is_single() && 'post' == get_post_type() ) { 

	$cat = get_the_category(); 
	?>
		<div class="container py-75">
			<h2 class="h3 py-15">Related Posts</h2>
			<div class="row mt-20 blog-posts related-post">
				<?php
					$related = get_posts( array('posts_per_page' => 3));
					foreach( $related as $post ){
						setup_postdata( $post ); ?>

						<div class="lqd-lp-column flex flex-col col-lg-4 col-md-6 col-sm-6 col-12 py-0 px-15 mb-30">
						  <article id="post-<?php the_ID(); ?>" class="article">
					      
					        <?php $categories = get_the_category();
                    foreach ($categories as $cat) {
                        $category_link = get_category_link($cat->cat_ID);
                        echo '<a class="inline-block font-medium mb-15 text-14" href="' . esc_url($category_link) . '" title="' . esc_attr($cat->name) . '">' . esc_html($cat->name) . '</a>';
                    }
                  ?>
					       
						      <figure>
						        <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'large' ); ?>" alt="<?php the_title(); ?>" width="700" height="450" class="img-fluid">
						      </figure>
						    
						      <h3 class="entry-title lqd-lp-title text-20 mt-1/5rem relative z-2 mb-20">
						        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
						      </h3>
						    	<?php the_excerpt(); ?>
					        <div class="lqd-lp-author flex flex-wrap items-center relative z-3 text-16">
                   <!--  <figure class="rounded-full overflow-hidden mr-10">
                      <?php // echo get_avatar( get_the_author_meta('ID')); ?>
                    </figure> -->
                    <span class="lqd-lp-author-info">
                      <?php the_author(); ?> &nbsp;&nbsp; <?php the_date(); ?>
                    </span>
                  </div>
						  </article>
						</div>
						
					<?php
					}
					wp_reset_postdata();
				?>
			</div>
		</div>

	<?php } ?>
<?php  endif; ?>

<?php include_once('inc/bottom-cta.php'); ?>
	
<?php get_footer(); ?>

<?php if ( is_single() && 'post' == get_post_type() ) { ?>

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('.table-of-contents ul li a').click(function(event){
			event.preventDefault();
			$('html, body').animate({
				scrollTop: $($.attr(this, 'href')).offset().top-100
			}, 500);
		});
		var topMenu = jQuery(".table-of-contents"),
                offset = 40,
                topMenuHeight = topMenu.outerHeight()+offset,
                // All list items
                menuItems =  topMenu.find('a'),
                // Anchors corresponding to menu items
                scrollItems = menuItems.map(function(){
                  var href = jQuery(this).attr("href"),
                  id = href.substring(href.indexOf('#')),
                  item = jQuery(id);
                  //console.log(item)
                  if (item.length) { return item; }
                });

            // so we can get a fancy scroll animation
            menuItems.click(function(e){
              var href = jQuery(this).attr("href"),
                id = href.substring(href.indexOf('#'));
                  offsetTop = href === "#" ? 0 : jQuery(id).offset().top-topMenuHeight+1;
              jQuery('html, body').stop().animate({ 
                  scrollTop: offsetTop
              }, 300);
              e.preventDefault();
            });

            // Bind to scroll
            jQuery(window).scroll(function(){
               // Get container scroll position
               var fromTop = jQuery(this).scrollTop()+topMenuHeight;

               // Get id of current scroll item
               var cur = scrollItems.map(function(){
                 if (jQuery(this).offset().top < fromTop)
                   return this;
               });
               // Get the id of the current element
               cur = cur[cur.length-1];
               var id = cur && cur.length ? cur[0].id : "";               

               menuItems.parent().removeClass("active");
               if(id){
                    menuItems.parent().end().filter("[href*='#"+id+"']").parent().addClass("active");
               }
            });
	});
	
	function addLineClass (pre) {
		var lines = pre.innerText.split("\n"); // can use innerHTML also
		while(pre.childNodes.length > 0) {
			pre.removeChild(pre.childNodes[0]);
		}
		for(var i = 0; i < lines.length; i++) {
			var span = document.createElement("span");
			span.className = "line";
			span.innerText = lines[i]; // can use innerHTML also
			pre.appendChild(span);
			pre.appendChild(document.createTextNode("\n"));
		}
	}
	window.addEventListener("load", function () {
		var pres = document.getElementsByTagName("pre");
		for (var i = 0; i < pres.length; i++) {
			addLineClass(pres[i]);
		}
	}, false);
</script>

<?php } ?>