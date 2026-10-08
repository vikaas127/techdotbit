<?php
/**
 * 404 page.
 */
get_header(); ?>

<section class="lqd-section banner bg-no-repeat bg-center bg-cover py-70 px-70 md:px-0">
  <div class="container">
    <div class="row">
      <div class="col col-12 col-lg-8">
        <div class="ld-fancy-heading">
          <h6 class="ld-fh-element text-white mb-1em"><?php esc_html_e( 'Error 404', 'ace' ); ?></h6>
          <h1 class="ld-fh-element mb-0/35em text-white"><?php esc_html_e( 'We couldn’t find that page', 'ace' ); ?></h1>
          <p class="text-white"><?php esc_html_e( 'The page may have moved or no longer exists. Try one of the links below or search the site.', 'ace' ); ?></p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="lqd-section pt-75 pb-75">
  <div class="container">
    <div class="row">
      <div class="col col-12 col-lg-6 mb-30">
        <?php get_search_form(); ?>
      </div>
      <div class="col col-12">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-solid text-white bg-primary rounded-4">
          <span class="inline-flex py-1/15em px-2/1em items-center"><span class="btn-txt"><?php esc_html_e( 'Back to home', 'ace' ); ?></span></span>
        </a>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
