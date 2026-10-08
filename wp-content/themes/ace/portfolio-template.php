<?php
/* Template Name: Portfolio Template */

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
        </div>
      </div>
    </div>
  </section>
  <?php endwhile;
endif; ?>

  <?php include_once('inc/brands.php'); ?>

  <section class="lqd-section py-70">
    <div class="container">
        <?php
          $terms = get_terms("tagportfolio");
          $count = count($terms);
          echo '<ul id="portfolio-filter">';
          echo '<li><a href="javascript:void(0)" title="All" data-rel="all" class="active">All</a></li>';
            if ( $count > 0 )
            { 
              foreach ( $terms as $term ) {
                $termname = strtolower($term->name);
                $termname = str_replace(' ', '-', $termname);
                echo '<li><a href="javascript:void(0)" title="'.$term->name.'" data-rel="'.$termname.'">'.$term->name.'</a></li>';
              }
            }
          echo "</ul>";
        ?>

       <?php 
        $loop = new WP_Query(array('post_type' => 'project', 'posts_per_page' => -1));
        $count =0;
      ?>
        <div id="portfolio-wrapper">
            <ul id="portfolio-list" class="list-unstyled">
            <?php if ( $loop ) : 

                while ( $loop->have_posts() ) : $loop->the_post(); ?>

                    <?php
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

                    <?php $infos = get_post_custom_values('_url'); ?>

                    <li class="w-100 portfolio-item <?php echo strtolower($tax); ?> all" style="">
                        <figure>
                            <?php the_post_thumbnail('full', [ 'alt' => esc_html ( get_the_title() ) ] ); ?>
                            <figcaption>
                                <span><?php echo ( $terms && ! is_wp_error( $terms ) ) ? esc_html( $terms[0]->name ) : ''; ?></span>
                                <h3><?php the_title(); ?></h3>
                                
                                <a href="<?php the_permalink() ?>" class="link">View Portfolio</a>
                            </figcaption>
                        </figure>
                    </li>

                    <?php endwhile; else: ?>
                    <li class="error-not-found">Sorry, no portfolio entries found.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
  </section>

  <?php include_once('inc/testimonials.php'); ?>

  <?php include_once('inc/bottom-cta.php'); ?>

<?php get_footer(); ?>

<script>
jQuery(document).ready(function(){
    jQuery('#portfolio-filter li a').click(function(){
        // reset active class
        jQuery('#portfolio-filter li a').removeClass("active");
        // add active class to selected
        jQuery(this).addClass("active");
        // return needed to make function work
        return false;
    });


    jQuery(function() {
        // create an empty variable
        var selectedClass = "";
        // call function when item is clicked
        jQuery("#portfolio-filter li a").click(function(){
            // assigns class to selected item
            selectedClass = jQuery(this).attr("data-rel");
            // fades out all portfolio items
            jQuery("#portfolio-list .portfolio-item").hide();
            // fades in selected category
            jQuery("#portfolio-list .portfolio-item." + selectedClass).show();
        });
    });

}); // document ready
</script>