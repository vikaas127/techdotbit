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
					<p class="text-light mb-25">Category:<span class="block text-white font-medium"><?php echo ( $terms && ! is_wp_error( $terms ) ) ? esc_html( $terms[0]->name ) : ''; ?></span></p>
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
                            <img loading="lazy" decoding="async" src="<?php the_sub_field('screen_image'); ?>" alt="<?php the_sub_field('heading'); ?>" class="max-w-full h-auto vertical-top rounded-inherit">
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
                            <img loading="lazy" decoding="async" src="<?php the_sub_field('screen_image'); ?>" alt="<?php the_sub_field('heading'); ?>" class="max-w-full h-auto vertical-top rounded-inherit">
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
                            <img loading="lazy" decoding="async" src="<?php the_sub_field('screen_image'); ?>" alt="<?php the_sub_field('heading'); ?>" class="max-w-full h-auto vertical-top rounded-inherit">
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
              <ul class="list-unstyled d-flex py-30" id="tabs-features">
                <?php while ( have_rows('tabs') ) : the_row(); ?>
                 <li><a href="#tab<?php echo $i++; ?>" class="text-white"><?php the_sub_field('tab_name'); ?></a></li>
                <?php endwhile; ?>
              </ul>
              <?php endif; ?>
              <?php if( have_rows('tabs') ):  
              $i = 1; // Set the increment variable ?>
              <div class="tab-list" id="tabs-features-content">
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
                 <li><a href="#tech-<?php echo esc_attr( sanitize_title( get_sub_field('tab_heading') ) ); ?>"><?php the_sub_field('tab_heading'); ?></a></li>
                <?php endwhile; ?>
              </ul>
            </div>
            <div class="col col-12 col-md-8 col-lg-9 text-center md:text-start" data-custom-animations="true" data-ca-options="{&quot;triggerHandler&quot;: &quot;inview&quot;, &quot;animationTarget&quot;: &quot;all-childs&quot;, &quot;duration&quot;: &quot;1800&quot;, &quot;delay&quot;: &quot;180&quot;, &quot;ease&quot;: &quot;power4.out&quot;, &quot;direction&quot;: &quot;forward&quot;, &quot;initValues&quot;: {&quot;y&quot; : 45 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 0} , &quot;animations&quot;: {&quot;y&quot; : 0 , &quot;transformOriginX&quot; : 50 , &quot;transformOriginY&quot; : 50 , &quot;transformOriginZ&quot;: &quot;0px&quot;, &quot;opacity&quot; : 1}}">
              <div class="tab-list" id="tabs-tools-content">
                <?php while ( have_rows('tech_stack') ) : the_row(); ?>
                 <div class="tab-content" id="tech-<?php echo esc_attr( sanitize_title( get_sub_field('tab_heading') ) ); ?>">
                     <?php if( have_rows('list') ): ?>
                     <ul class="list-unstyled tools-list d-flex flex-wrap">
                         <?php while ( have_rows('list') ) : the_row(); ?>
                         <li>
                             <a href="<?php the_sub_field('link'); ?>">
                                 <figure>
                                     <img loading="lazy" decoding="async" src="<?php the_sub_field('icon'); ?>" alt="<?php the_sub_field('title'); ?> Icon" width="64" height="64" loading="lazy" class="img-fluid">
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
                        <img loading="lazy" decoding="async" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="427" height="494" class="max-w-full h-auto vertical-top rounded-inherit">
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

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
		$ace_cat      = get_the_category();
		$ace_cat      = $ace_cat ? $ace_cat[0] : null;
		$ace_blog_url = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/' );
		$ace_share    = rawurlencode( get_permalink() );
		$ace_stitle   = rawurlencode( get_the_title() );
		?>
	<article <?php post_class( 'tdb-article' ); ?>>
		<header class="tdb-article__head">
			<div class="container">
				<nav class="tdb-crumbs" aria-label="Breadcrumb">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'ace' ); ?></a>
					<span aria-hidden="true">/</span>
					<a href="<?php echo esc_url( $ace_blog_url ); ?>"><?php esc_html_e( 'Blog', 'ace' ); ?></a>
					<?php if ( $ace_cat ) : ?>
						<span aria-hidden="true">/</span>
						<a href="<?php echo esc_url( get_category_link( $ace_cat ) ); ?>"><?php echo esc_html( $ace_cat->name ); ?></a>
					<?php endif; ?>
				</nav>
				<?php if ( $ace_cat ) : ?><a class="tdb-post-card__cat" href="<?php echo esc_url( get_category_link( $ace_cat ) ); ?>"><?php echo esc_html( $ace_cat->name ); ?></a><?php endif; ?>
				<h1 class="tdb-article__title"><?php the_title(); ?></h1>
				<?php if ( has_excerpt() ) : ?><p class="tdb-article__lead"><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>
				<div class="tdb-article__meta">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 40, '', '', array( 'class' => 'tdb-article__avatar' ) ); ?>
					<span class="tdb-article__author"><?php the_author(); ?></span>
					<span aria-hidden="true">·</span>
					<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
					<span aria-hidden="true">·</span>
					<span><?php echo esc_html( sprintf( __( '%d min read', 'ace' ), ace_reading_time( get_the_ID() ) ) ); ?></span>
				</div>
			</div>
		</header>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="container">
				<figure class="tdb-article__cover"><?php the_post_thumbnail( 'large', array( 'alt' => the_title_attribute( array( 'echo' => false ) ), 'loading' => 'eager', 'fetchpriority' => 'high' ) ); ?></figure>
			</div>
		<?php endif; ?>

		<div class="container">
			<div class="tdb-article__layout">
				<aside class="tdb-article__side">
					<div class="tdb-article__sticky">
						<?php $ace_toc = do_shortcode( '[TOC]' ); if ( false !== strpos( $ace_toc, '<li' ) ) : ?>
							<div class="tdb-article__toc"><?php echo $ace_toc; // phpcs:ignore -- theme shortcode ?></div>
						<?php endif; ?>
						<div class="tdb-share">
							<p class="tdb-share__title"><?php esc_html_e( 'Share this article', 'ace' ); ?></p>
							<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $ace_share; ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Share on LinkedIn', 'ace' ); ?>"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3 9.5h4V21H3V9.5Zm7 0h3.8v1.6h.1c.5-1 1.8-2 3.8-2 4 0 4.8 2.6 4.8 6V21h-4v-5.1c0-1.2 0-2.8-1.7-2.8s-2 1.3-2 2.7V21h-4V9.5Z"/></svg></a>
							<a href="https://twitter.com/intent/tweet?url=<?php echo $ace_share; ?>&amp;text=<?php echo $ace_stitle; ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Share on X', 'ace' ); ?>"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.8 3h3.1l-6.8 7.7L22 21h-6.2l-4.9-6.4L5.3 21H2.2l7.2-8.3L1.8 3h6.4l4.4 5.8L17.8 3Zm-1.1 16.2h1.7L7.4 4.7H5.6l11.1 14.5Z"/></svg></a>
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $ace_share; ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Share on Facebook', 'ace' ); ?>"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M14 8.5V6.8c0-.8.2-1.3 1.4-1.3H17V2.3c-.3 0-1.3-.1-2.4-.1-2.4 0-4 1.5-4 4.1v2.2H8v3.2h2.6V22H14v-10.3h2.7l.4-3.2H14Z"/></svg></a>
							<a href="https://wa.me/?text=<?php echo $ace_stitle . '%20' . $ace_share; ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Share on WhatsApp', 'ace' ); ?>"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2Zm0 18.2a8.2 8.2 0 0 1-4.2-1.2l-.3-.2-3 .8.8-2.9-.2-.3A8.2 8.2 0 1 1 12 20.2Zm4.5-6.1c-.2-.1-1.5-.7-1.7-.8s-.4-.1-.6.1-.7.8-.8 1-.3.2-.5.1a6.7 6.7 0 0 1-3.3-2.9c-.3-.4.2-.4.7-1.3.1-.2 0-.3 0-.4l-.8-1.8c-.2-.5-.4-.4-.6-.4h-.5a1 1 0 0 0-.7.3 3 3 0 0 0-.9 2.2 5.2 5.2 0 0 0 1.1 2.7 11.8 11.8 0 0 0 4.5 4c1.7.7 2.3.8 3.2.6.5-.1 1.5-.6 1.7-1.2s.2-1.1.2-1.2-.2-.2-.5-.3Z"/></svg></a>
						</div>
					</div>
				</aside>
				<div class="tdb-article__body entry-content">
					<?php the_content(); ?>
					<div class="tdb-article__cta">
						<div>
							<p class="tdb-article__cta-title"><?php esc_html_e( 'Want to put this into practice?', 'ace' ); ?></p>
							<p><?php esc_html_e( 'Talk to our team about AI agents, ERP or custom software for your business.', 'ace' ); ?></p>
						</div>
						<a class="tdb-article__cta-btn" href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>"><?php esc_html_e( 'Book a free consultation', 'ace' ); ?> <span aria-hidden="true">&rarr;</span></a>
					</div>
				</div>
			</div>
		</div>
	</article>
	<?php endwhile; endif; ?>

	<?php
	$ace_related = new WP_Query( array(
		'posts_per_page'      => 3,
		'post__not_in'        => array( get_queried_object_id() ),
		'category__in'        => wp_get_post_categories( get_queried_object_id() ),
		'ignore_sticky_posts' => 1,
	) );
	if ( $ace_related->have_posts() ) : ?>
		<section class="tdb-related-posts">
			<div class="container">
				<h2 class="tdb-related-posts__title"><?php esc_html_e( 'Related articles', 'ace' ); ?></h2>
				<div class="tdb-post-grid">
					<?php while ( $ace_related->have_posts() ) : $ace_related->the_post(); include locate_template( 'inc/blog/card.php' ); endwhile; ?>
				</div>
			</div>
		</section>
	<?php endif; wp_reset_postdata(); ?>
<?php  endif; ?>

<?php include_once('inc/bottom-cta.php'); ?>
	
<?php if ( is_single() && 'post' == get_post_type() ) { add_action( 'wp_footer', function () { ?>

<script type="text/javascript">
	jQuery(document).ready(function($){
		var topMenu = jQuery(".table-of-contents"),
                offset = 40,
                topMenuHeight = topMenu.outerHeight()+offset,
                // All list items
                menuItems =  topMenu.find('a'),
                // Anchors corresponding to menu items
                scrollItems = menuItems.map(function(){
                  var href = jQuery(this).attr("href"),
                  id = href.substring(href.indexOf('#')),
                  item = id.length > 1 ? jQuery(document.getElementById(id.slice(1))) : jQuery();
                  //console.log(item)
                  if (item.length) { return item; }
                });

            // so we can get a fancy scroll animation
            menuItems.click(function(e){
              var href = jQuery(this).attr("href"),
                id = href.substring(href.indexOf('#'));
                  target = id.length > 1 ? jQuery(document.getElementById(id.slice(1))) : jQuery(),
                  offsetTop = target.length ? target.offset().top-topMenuHeight+1 : 0;
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

<?php }, 100 ); } ?>

<?php get_footer(); ?>
