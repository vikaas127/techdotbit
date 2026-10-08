<?php

/**
 * The template for displaying all single posts
 */

get_header(); ?>


<?php if( is_singular('portfolio') ): ?>
	<?php $loop = new WP_Query(array('post_type' => 'portfolio')); ?>
	<div class="inner-banner-area">
		<div class="container">
			<div class="d-flex flex-wrap">
				
				<div class="w-100 portfolio-details">
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
					<span class="d-block"><?php echo $term->name; ?></span>
					<?php 
						$logo = get_field('logo'); 
						if( !empty( $logo ) ): 
					?>
					
						<img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>"  width="139" height="59" loading="lazy" class="img-fluid">
					
					<?php endif; ?>

					<h1 class="heading text-white mt-15"><?php the_title(); ?></h1>
					<p class="text-white">Company Name: <?php the_field('brief'); ?></p>
				</div>
			</div>
		</div>
	</div>

	<?php if( have_rows('technology_used') ): ?>	    		
	<div class="container text-center mt-70 mt-lg-100">
		<?php while( have_rows('technology_used') ) : the_row(); ?>
		<h2 class="heading"><?php the_sub_field('heading'); ?></h2>
		<?php if( have_rows('list') ): ?>
		<ul class="list-unstyled techno-use mt-45">
			<?php while( have_rows('list') ) : the_row(); ?>
			<li>
				<?php 
					$icon = get_sub_field('icon'); 
					if( !empty( $icon ) ): 
				?>
				<img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" width="50" height="50" loading="lazy">
				<?php endif; ?>
				<span><?php the_sub_field('text'); ?></span>
			</li>
			<?php endwhile; ?>
		</ul>
		<?php endif; ?>
		<?php endwhile; ?>
	</div>
	<?php endif; ?>

	<?php if( have_rows('key_objective') ): ?>
	<?php while( have_rows('key_objective') ) : the_row(); ?>
	<div class="container mt-70 mt-lg-100 mt-xl-150">
		<div class="bg-light d-flex flex-wrap gap-30">
			<div class="w-100 agency-box p-3 p-md-30 py-lg-50 text-center text-lg-left">
				<h2 class="heading"><?php the_sub_field('heading'); ?></h2>

				<?php if( have_rows('list') ): ?>
				<ul class="list-unstyled objectives">
					<?php while( have_rows('list') ) : the_row(); ?>
					<li>
						<?php if(get_sub_field('item_heading')): ?><h4><?php the_sub_field('item_heading'); ?></h4><?php endif; ?>
						<?php the_sub_field('item'); ?>
					</li>
					<?php endwhile; ?>
				</ul>
				<?php endif; ?>
			</div>

			<?php if( have_rows('slider') ): ?>
				<div class="w-100 agency-box objectives-slider">
					<?php while( have_rows('slider') ) : the_row(); ?>
					<?php 
						$slide = get_sub_field('slide'); 
						if( !empty( $slide ) ): 
					?>
					<div>
						<img src="<?php echo esc_url($slide['url']); ?>" alt="<?php echo esc_attr($slide['alt']); ?>" class="w-100">
					</div>
					<?php endif; ?>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
			
		</div>
	</div>
	<?php endwhile; ?>
	<?php endif; ?>

	<?php if( have_rows('development_process') ): ?>
	<?php while( have_rows('development_process') ) : the_row(); ?>
	<div class="container d-process text-center mt-70 mt-lg-100 mt-xl-150 mb-lg-100 mb-xl-150">
		<h2 class="heading w-lg-9 mx-auto"><?php the_sub_field('heading'); ?></h2>

		<?php if( have_rows('list') ): ?>
			<ul class="d-flex flex-wrap mt-60 text-left list-unstyled">
			<?php while( have_rows('list') ) : the_row(); ?>
			<li class="<?php the_sub_field('width_choice'); ?>">
				<?php if(get_sub_field('itme')): ?><h3><?php the_sub_field('itme'); ?></h3><?php endif; ?>
				<?php if(get_sub_field('paragraph')): ?><p><?php the_sub_field('paragraph'); ?></p><?php endif; ?>
			</li>
			<?php endwhile; ?>
		</ul>
		<?php endif; ?>
	</div>
	<?php endwhile; ?>
	<?php endif; ?>


	<?php 
		include_once('inc/stats.php');
		include_once('inc/bottom-form.php');
	?>

<?php else: ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div class="inner-banner-area">
		<div class="container">
			<div class="banner">
				<div class="breadcrumb d-flex flex-wrap">
					<a href="#">Home</a>
					<a href="#">Blog</a>
					<?php $category = get_the_category();
					if ( ! empty( $category ) ) { ?>
						<a href="<?php echo esc_url( get_category_link( $category[0]->term_id ) ); ?>"><?php echo $category[0]->cat_name; ?></a>
					<?php } ?>
					<span><?php the_title(); ?></span>
				</div>
				<h1><?php the_title(); ?></h1>
			</div>
		</div>
	</div>

	<article class="single-blog-post mt-70 mt-lg-100">
		<div class="container d-md-flex align-items-md-center entry-header">
			<div class="w-md-6 pe-lg-50">
				<span class="d-block"><?php $cat = get_the_category(); echo $cat[0]->cat_name; ?></span>
				<h2 class="heading mt-15"><?php the_title(); ?></h2>
				<!--<p><--?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>-->
				<div class="d-flex author-profile align-items-center mt-30 mt-lg-45">
					<div class="author-img mr-3">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 64 ); ?>
					</div>
					<div class="author-content">
						<h4><?php the_author(); ?></h4>
						<span class="d-inline-flex align-items-center pr-md-3"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/calendar.webp" alt="Calnder" class="mr-2"><?php the_date(); ?></span> <span class="d-inline-flex align-items-center"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Clock.png" alt="Clock" class="mr-2"><?php echo do_shortcode('[rt_reading_time postfix="Min Read" postfix_singular="Min Read"]'); ?></span>
					</div>
				</div>
			</div>
			<div class="w-md-6 mt-15 mt-md-0">
				<?php if(has_post_thumbnail()){ ?>
					<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" alt="<?php the_title(); ?>" class="img-fluid post-thumbnail rounded mt-lg-0">
				<?php } ?>
			</div>
		</div>



		<div class="container d-lg-flex justify-content-center mt-15 mt-lg-45">
			<?php if ( is_single() && 'post' == get_post_type() ) { ?>
			<div class="w-lg-3">
				<div class="left-box pe-30">
					<?php echo do_shortcode('[TOC]'); ?>
					<hr class="mt-30 mb-30">
					<div class="share-box">
						<span class="d-block ">Share this article</span>
						<?php echo do_shortcode('[social]'); ?>
					</div>
				</div>
			</div>
			<?php } ?>

			<div class="w-lg-9 entry-content mt-0 pl-lg-5">
				<?php the_content(); ?>
				<div class="author-box p-3 p-lg-30 bg-light mt-45 text-center text-md-left">
					<div class="d-md-flex flex-md-wrap">
						<div class="w-md-3 w-lg-2 mr-3">
							<?php echo get_avatar( get_the_author_meta('ID')); ?>
						</div>
						<div class="w-md-9 w-lg-10 mt-15 mt-md-0">
							<h5><?php the_author(); ?></h5>
							<p class="the_content" style="line-height: 1.25em"><small><?php the_author_description(); ?></small></p>
						</div>		
					</div>
				</div>
			</div>
		</div>
	</article>


	<div class="container mt-70 mt-lg-100 mt-xl-150">
	<div class="newsletter  d-md-flex align-items-center bg-yellow">
		<div class="w-md-5 text-center p-3"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/demo/Online-Meeting.webp" class="img-fluid" alt="Online-Meeting"></div> 
		<div class="w-md-7 p-3 p-md-30">
			<!-- <h6 class="mt-3">Subscribe our newsletter</h6> -->
			<p class="mb-4 px-3" style="color: black">Subscribe to our email newsletter today to receive updates on the latest news, tutorials and special offers!</p>
			<?php echo do_shortcode('[email-subscribers namefield="NO" desc="" group="Subscribe"]');?>
		</div> 
	</div>
	</div>

	<?php endwhile; endif; ?>

	<?php if ( is_single() && 'post' == get_post_type() ) { 

	$cat = get_the_category(); 
	?>
		<div class="container mt-70 mt-lg-100 mt-xl-150">
			<h2 class="heading">Related Posts</h2>
			<div class="d-flex flex-wrap mt-60 blog-posts">
				<?php
					$related = get_posts( array('posts_per_page' => 3));
					foreach( $related as $post ){
						setup_postdata( $post ); ?>
						<div class="w-100 bg-light">
							<article>
								<a href="<?php get_permalink(); ?>"><?php echo get_the_post_thumbnail( get_the_ID(), 'full' ); ?></a>
								<div class="post-content p-15 p-md-20">
									<span><?php $cat = get_the_category(); echo $cat[0]->cat_name; ?></span>
									<h3 class="py-15"><a href="'<?php get_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
									<p><?php echo get_the_excerpt(); ?></p>
								</div>
								<div class="author-box p-3 d-flex justify-content-between">
									<?php the_author(); ?>
									<span class="d-inline-flex align-items-center"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/calendar.webp" alt="Calnder" class="mr-2"><?php the_date(); ?></span>
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
</script>

<?php } ?>