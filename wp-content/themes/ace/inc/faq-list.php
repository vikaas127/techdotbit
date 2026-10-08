<?php
/*
    Display FAQ in all pages
*/
?>
<?php if( have_rows('faq') ): ?>
<section class="lqd-section py-90 faq">
  	<div class="container">
  	  <div class="row">
  	  	<div class="col col-12 col-lg-7 text-center mb-60 mx-auto">
  	  	  <div class="ld-fancy-heading">
  	  	    <h2 class="ld-fh-element mb-0/4em">
  	  	      <span>Frequently Asked Questions</span>
  	  	    </h2>
  	  	  </div>
  	  	</div>
  	  	<div class="col col-12">
  	  		<ul class="faq-list">
            <?php while( have_rows('faq') ) : the_row(); ?>
  	  			<li>
  	  				<p class="question"><?php the_sub_field('question'); ?></p>
  	  				<div class="answer">
  	  					<?php the_sub_field('answer'); ?>
  	  				</div>
  	  			</li>
  	  			<?php endwhile; ?>
  	  		</ul>
  	  	</div>
  	  </div>
  	</div>
  </section>
<?php endif; ?>