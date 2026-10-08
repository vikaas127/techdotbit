<?php 
/* Template Name: Career */
get_header(); ?>

<style>
	.ui-selectmenu-button.ui-button{
		width: 100%;
		display: flex;
		align-items: center;
		background: #fff;
	}
	.sjb-page .sjb-filters.sjb-filters-v1 .btn-search{
		border-radius: 5px;
		height: 49px;
	}
	span.job-title {
		font-size: 22px;
		font-weight: 500;
	}
	.job-description {
		margin-top: 15px;
	}
	.sjb-page .list-data .v1 .sjb-apply-now-btn a {
		margin-top: 10px;
		margin-right: 5px;
		padding: 8px 20px;
		font-size: 16px;
		letter-spacing: 1px;
	}
	.sjb-listing .list-view {
		display: flex;
		flex-wrap: wrap;
		gap: 30px 15px;
	}
	.sjb-listing .list-view > .list-data > div{
		margin: 0
	}
	.popup-outer .v1 .job-description, .popup-outer .v1 .job-features {
		display: none;
	}
	
	
	@media (min-width: 768px){
		.sjb-listing .list-view > .list-data {
			width: calc(50% - 15px);
			display: flex
		}
		.popup-outer .sjb-page {
			max-width: 650px;
		}
		.sjb-page .list-data .v1 .header-margin-top {
			width: 100%;
		}
		.sjb-page .list-data .v1 .header-margin-top > div > div {
			width: 33.33%;
		}
	}
	@media (min-width: 992px){
		.sjb-listing .list-view > .list-data {
			width: calc(33.33% - 20px);
		}
		.popup-outer .v1 {
			display: flex;
			flex-wrap: wrap;
		}
		.popup-outer .v1 header {
			width: 100%;
		}
	}
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
		<?php echo do_shortcode(' [jobpost] '); ?>
	</div>
</section>
    
<?php get_footer(); ?>