<?php 
/*
Template Name: Newsroom Template
*/
?>

<?php get_header(); ?>
<style>
	.shadow {
		box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
	}
	.get-in-touch h4{font-size: 24px;}
	.date-post {
        display: flex;
        align-items: baseline;
        color: #000;
        width: 100%
    }
    .date-post h2 {
        font-size: 16px;
        font-weight: 400;
        margin-right: 4px;
    }
    .date-post span{
    	font-size: 22px; border: none; color: #482FE4;
    }
    .date-post p {
        margin: 0;
    }
    .news-thumb img {
        width: 100%;
        height: auto;
    }
    .news-content {
        padding: 30px;
    }
    .news-more-link {
		background: #3ead3c;
		color: #fff;
		border: 1px solid #3ead3c;
		display: inline-block;
		padding: 5px 25px;
		border-radius: 5px;
		margin-top: 10px;
		margin-top: 15px;
	}
    .news-more-link:hover, .news-more-link:focus {
        background: #000;
        color: #000000;
        border-color: #000;
        box-shadow: -4px 4px 5px rgb(0 0 0 / 15%);
    }
	 .latest-news .news {
		padding: 0;
	}
	.latest-news .news-inner-wrap-view {
		margin: 0;
		padding: 0;
		border: none;
	}
	.latest-news .news-inner-wrap-view .post-content-text{
		width: 100%; margin: 0
	}


	.get-in-touch{margin-left: 50px;}
		.get-in-touch > ul > li{display: flex;align-items: center;margin-bottom: 20px;}
		.get-in-touch > ul > li img{width: 48px;height: 48px;}
		.get-in-touch > ul > li a{font-size: 18px;color: #5E5E5E;padding-left: 10px;}
		.get-in-touch .news-title{margin-bottom: 10px;}
		.get-in-touch .news-title p{margin-top: 0;margin-bottom: 0;}
		.get-in-touch .news-title a{display: inline-block;font-size: 16px;line-height: 26px;color: #000;font-weight: 400;}
		.get-in-touch .news-title a:hover{color:#482FE4;}
		.get-in-touch .date-post h2{font-size: 22px;font-weight: 500;color: #482FE4;}
		.get-in-touch .date-post p{font-size: 14px;margin-top: 2px;margin-left: 5px;text-transform: uppercase;color: #482FE4;}
		.latest-news .news-thumb, .latest-news .news-content-excerpt{display:none;}
		.get-in-touch .news_pagination.wpnw-numeric {
		display: none;
	}
     #wpnw-news-2 .news-content {
    padding: 0;
    margin-top: 30px;
    }
	.news-area .news-inner-wrap-view {
		padding: 0;
		border: none;
		box-shadow: 0 4px 15px rgba(0,0,0,.15);
		background: #fff;
	}
	.news-area .news-inner-wrap-view .news-thumb {
		width: 100%;
	}	
	.news-area .news-inner-wrap-view .news-thumb .grid-news-thumb {
		height: auto;
	}
	
	.sticky-box {
		position: sticky;
		top: 130px;
	}
	
    @media(min-width:768px){
        .mt-md-70{
            margin-top:70px;
        }
    }
    @media (max-width: 767px){
        .get-in-touch{margin-left: 0px;}
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
                <p class="ld-fh-element mb-2em lqd-split-lines leading-30 text-17 text-white-90" data-split-text="true" data-split-options="{&quot;type&quot;: &quot;lines&quot;}"><?php the_sub_field('paragraph'); ?>
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

    <section class="lqd-section py-70 md:px-0">
    	<div class="container">
    		<div class="row">
    			<div class="col col-12 col-lg-8 news-area pt-30">
    				<?php echo do_shortcode('[sp_news grid="list"]'); ?>
    			</div>
    			<div class="col col-12 col-lg-4 pt-30">
                	<div class="sticky-box">
            		    <div class="get-in-touch bg-gray px-20 py-20 latest-news">
            		        <h4 class="sidebar-title">Latest Press Releases</h4>
            		        <?php echo do_shortcode('[sp_news limit="5"]'); ?>
            		    </div>
                    </div>
    			</div>
    		</div>
    	</div>
    </section>

<?php get_footer(); ?>