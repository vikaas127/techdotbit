<?php
/* Template Name: Free Audit Request Template */

get_header(); ?>

<?php include_once('inc/brands.php'); ?>

<section class="lqd-section py-70">
  <div class="container">
    <div class="row justify-center">
      <div class="col col-12 col-lg-6 col-xl-7">
        <h1 class="h2 text-center mb-30"><?php the_title(); ?></h1>
      </div>
      <div class="w-full"></div>
      <div class="col col-12 col-lg-6 col-xl-7 contact-form">
        <?php echo do_shortcode('[contact-form-7 id="af5387b" title="Free Audit Form"]'); ?>
      </div>
    </div>
  </div>
</section>
<?php include_once('inc/stats.php'); ?>
<?php include_once('inc/testimonials.php'); ?>
<?php include_once('inc/bottom-cta.php'); ?>

<?php get_footer(); ?>