<?php /* Template Name: Thank You */ ?>

<?php get_header(); ?>

<style>
    h1 span{font-size: 70px; line-height: 1em}
    h1 span::after{display: none;}

    .link-box a {
        color: #fff;
        display: inline-block;
        margin: 5px 10px;
        padding: 7px 25px;
        background: #2913b5;
        border-radius: 30px;
    }
    .link-box a:hover{
        color: #000; background: #fdc93b;
    }
    .pl-3{padding-left: 15px;}
    @media (min-width: 992px){
        .d-lg-inline{display: inline-block;}
        
    }
</style>

	<section class="inner-banner pt-70 pb-70">
		<div class="container text-center">
			<h1 class="mb-30"><span class="block mb-10">Thank You</span> We have received your message!</h1>
			<p style="max-width: unset;">
				Thank you for sharing your requirements with us. We will reach out to you with in next 6 hrs.
			</p>
			<a href="<?php echo site_url(); ?>" class="btn font-bold text-13 btn-solid text-white bg-primary uppercase border-thin btn-hover-swp leading-1/5em tracking-0/1em rounded-4 hover:text-white lqd-unit-animation-done" style="">
              <span class="inline-flex py-1/15em px-2/1em items-center">
                <span class="btn-txt" data-text="Explore Techdotbit">Back to Home</span>
                <span class="btn-icon">
                  <i class="lqd-icn-ess icon-md-arrow-forward"></i>
                </span>
                <span class="btn-icon">
                  <i class="lqd-icn-ess icon-md-arrow-forward"></i>
                </span>
				  
              </span>
            </a>
		</div>
	</section>


<?php get_footer(); ?>