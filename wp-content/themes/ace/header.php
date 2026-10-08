<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="#0c2340">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <?php wp_head(); ?>
	  <meta name="google-site-verification" content="OZigI0CgcPrnCJFjM6KPanzpBulY2A1hvpat0NWT1Vo" />
	  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-54W7LPM5');</script>
<!-- End Google Tag Manager -->
  </head>
  <body data-mobile-nav-breakpoint="1199" data-mobile-nav-style="classic" data-mobile-nav-scheme="gray" data-mobile-nav-trigger-alignment="right" data-mobile-header-scheme="gray" data-mobile-secondary-bar="false" data-mobile-logo-alignment="center" <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <a class="skip-link screen-reader-text" href="#lqd-site-content"><?php esc_html_e( 'Skip to content', 'ace' ); ?></a>
    <div id="wrap">
      <div class="lqd-sticky-placeholder hidden"></div>
      <header id="site-header" class="main-header" data-sticky-header="true" data-sticky-values-measured="false">
        <?php if( have_rows('header', 'option') ): ?>
          <?php while( have_rows('header', 'option') ) : the_row(); ?>
          <div class="lqd-head-sec-wrap relative md:hidden">
            <div class="lqd-head-sec container flex items-stretch justify-between p-0">
              <div class="col col-auto lqd-head-col justify-start">
                <div class="header-module module-logo no-rotate navbar-brand-plain">
                  <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> home">
                    <span class="navbar-brand-inner">
                      <?php 
                        $logo = get_sub_field('logo'); 
                        if( !empty( $logo ) ): 
                      ?>
                        <img class="max-w-full h-auto vertical-top rounded-inherit" width="250" height="50" src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr( $logo['alt'] ? $logo['alt'] : get_bloginfo( 'name' ) ); ?>">
                      <?php else: ?>
                        TechDotBit
                      <?php endif; ?>
                     
                    </span>
                  </a>
                </div>
              </div>
              <div class="col lqd-head-col justify-end">
                <div class="header-module module-primary-nav pos-stc items-stretch">
                  <nav class="navbar-collapse lqd-submenu-default-style inline-flex flex-col items-stretch flex-basic-0 h-full" id="main-header-collapse" aria-label="<?php esc_attr_e( 'Main menu', 'ace' ); ?>">
                    <?php wp_nav_menu( array( 'theme_location' => 'primary-menu' ) ); ?>
                  </nav>
                </div>
              </div>
            </div>
          </div>
          <div class="lqd-mobile-sec">
            <div class="lqd-mobile-sec-inner navbar-header flex items-stretch">
              <div class="lqd-mobile-modules-container"></div>
              <button type="button" class="navbar-toggle collapsed nav-trigger style-mobile flex relative items-center justify-end border-none bg-transparent text-black p-0" data-ld-toggle="true" data-bs-toggle="collapse" data-bs-target="#lqd-mobile-sec-nav" aria-expanded="false" data-bs-toggle-options="{&quot;changeClassnames&quot;:  {&quot;html&quot;: &quot;mobile-nav-activated&quot;} }">
                <span class="sr-only">Menu</span>
                <span class="bars inline-block relative z-1">
                  <span class="bars-inner flex flex-col w-full h-full">
                    <span class="bar inline-block"></span>
                    <span class="bar inline-block"></span>
                    <span class="bar inline-block"></span>
                  </span>
                </span>
              </button>
              <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> home">
                <span class="navbar-brand-inner">
                  <?php 
                    $logo = get_sub_field('logo'); 
                    if( !empty( $logo ) ): 
                  ?>
                    <img class="max-w-full h-auto vertical-top rounded-inherit" width="200" height="40" src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr( $logo['alt'] ? $logo['alt'] : get_bloginfo( 'name' ) ); ?>">
                  <?php else: ?>
                    TechDotBit
                  <?php endif; ?>
                </span>
              </a>
            </div>
            <div class="lqd-mobile-sec-nav">
              <nav class="mobile-navbar-collapse navbar-collapse collapse" id="lqd-mobile-sec-nav" aria-label="<?php esc_attr_e( 'Mobile menu', 'ace' ); ?>">
                <?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_id' => 'mobile-primary-menu', 'container_class' => 'menu-primary-menu-mobile-container' ) ); ?>
              </nav>
            </div>
          </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </header>
      <main class="contact z-2 transition-all bg-white" id="lqd-site-content">
        <div id="lqd-contents-wrap">