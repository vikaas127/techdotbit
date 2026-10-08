        </div>
      </main>
      <div class="lqd-back-to-top fixed" data-back-to-top="true">
        <a href="#wrap" class="inline-flex items-center justify-center rounded-full text-18" data-localscroll="true">
          <i class="lqd-icn-ess icon-ion-ios-arrow-up"></i>
        </a>
      </div>

      <?php
      require_once get_stylesheet_directory() . '/inc/home/helpers.php';
      // Logo: the header logo is white on a transparent background, ideal on the dark footer.
      $ace_flogo = null;
      $ace_hdr   = function_exists( 'get_field' ) ? get_field( 'header', 'option' ) : null;
      if ( isset( $ace_hdr['logo'] ) ) { $ace_flogo = $ace_hdr['logo']; } elseif ( isset( $ace_hdr[0]['logo'] ) ) { $ace_flogo = $ace_hdr[0]['logo']; }
      $ace_contact = function_exists( 'get_field' ) ? get_field( 'contact_details', 'option' ) : null;
      $ace_contact = isset( $ace_contact[0] ) ? $ace_contact[0] : $ace_contact;
      $ace_terms   = get_page_by_path( 'terms-of-use' ) ? get_page_by_path( 'terms-of-use' ) : get_page_by_path( 'terms-and-conditions' );
      $ace_fsvc    = array(
        'AI services'         => ace_page_url( 'ai-services' ),
        'AI agents'           => ace_page_url( 'ai-services/ai-agent-development' ),
        'AI-led development'  => ace_page_url( 'ai-services/ai-led-software-development' ),
        'Workflow automation' => ace_page_url( 'ai-services/ai-workflow-automation' ),
        'Hire AI engineers'   => ace_page_url( 'hire-ai-engineers' ),
        'ERP software'        => ace_page_url( 'erp-software' ),
      );
      ?>
      <?php // Footer styles inline, so a stale optimised-CSS cache can never leave the footer unstyled. ?>
      <style id="tdb-footer-css"><?php echo file_get_contents( get_stylesheet_directory() . '/assets/css/footer.css' ); // phpcs:ignore -- theme file ?></style>
      <footer id="site-footer" class="tdb-footer">
        <span class="tdb-footer__glow" aria-hidden="true"></span>
        <div class="container">
          <div class="tdb-footer__cta">
            <div>
              <p class="tdb-footer__cta-title"><?php esc_html_e( 'Have an idea worth building?', 'ace' ); ?></p>
              <p><?php esc_html_e( 'Let\'s turn it into intelligent software.', 'ace' ); ?></p>
            </div>
            <a class="tdb-footer__btn" href="<?php echo esc_url( ace_page_url( 'contact-us' ) ); ?>"><?php esc_html_e( 'Start a project', 'ace' ); ?> <span aria-hidden="true">&rarr;</span></a>
          </div>

          <div class="tdb-footer__grid">
            <div class="tdb-footer__brand">
              <a class="tdb-footer__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                <?php if ( ! empty( $ace_flogo['url'] ) ) : ?>
                  <img loading="lazy" decoding="async" width="200" height="40" src="<?php echo esc_url( $ace_flogo['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                <?php else : ?>
                  <span>TechDotBit</span>
                <?php endif; ?>
              </a>
              <p><?php esc_html_e( 'An AI and software engineering company building intelligent software for modern businesses.', 'ace' ); ?></p>
              <?php if ( have_rows( 'social_media', 'option' ) ) : ?>
                <ul class="tdb-footer__social">
                  <?php while ( have_rows( 'social_media', 'option' ) ) : the_row(); ?>
                    <li><a href="<?php echo esc_url( get_sub_field( 'link' ) ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( get_sub_field( 'alt' ) ); ?>"><img loading="lazy" decoding="async" width="18" height="18" src="<?php echo esc_url( get_sub_field( 'icon' ) ); ?>" alt=""></a></li>
                  <?php endwhile; ?>
                </ul>
              <?php endif; ?>
            </div>

            <nav class="tdb-footer__col" aria-label="<?php esc_attr_e( 'Services', 'ace' ); ?>">
              <p class="tdb-footer__title"><?php esc_html_e( 'Services', 'ace' ); ?></p>
              <ul>
                <?php foreach ( $ace_fsvc as $ace_label => $ace_url ) : ?>
                  <li><a href="<?php echo esc_url( $ace_url ); ?>"><?php echo esc_html( $ace_label ); ?></a></li>
                <?php endforeach; ?>
              </ul>
            </nav>

            <nav class="tdb-footer__col" aria-label="<?php esc_attr_e( 'Company', 'ace' ); ?>">
              <p class="tdb-footer__title"><?php esc_html_e( 'Company', 'ace' ); ?></p>
              <?php wp_nav_menu( array( 'theme_location' => 'footer-menu-1', 'container' => false, 'fallback_cb' => false, 'depth' => 1 ) ); ?>
            </nav>

            <nav class="tdb-footer__col" aria-label="<?php esc_attr_e( 'Solutions', 'ace' ); ?>">
              <p class="tdb-footer__title"><?php esc_html_e( 'Solutions', 'ace' ); ?></p>
              <?php wp_nav_menu( array( 'theme_location' => 'footer-menu-2', 'container' => false, 'fallback_cb' => false, 'depth' => 1 ) ); ?>
            </nav>

            <div class="tdb-footer__col tdb-footer__contact">
              <p class="tdb-footer__title"><?php esc_html_e( 'Get in touch', 'ace' ); ?></p>
              <?php if ( ! empty( $ace_contact['email'] ) ) : ?>
                <a class="tdb-footer__reach" href="mailto:<?php echo esc_attr( $ace_contact['email'] ); ?>">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
                  <span><?php echo esc_html( $ace_contact['email'] ); ?></span>
                </a>
              <?php endif; ?>
              <?php if ( ! empty( $ace_contact['phone'] ) ) : ?>
                <a class="tdb-footer__reach" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $ace_contact['phone'] ) ); ?>">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2Z"/></svg>
                  <span><?php echo esc_html( $ace_contact['phone'] ); ?></span>
                </a>
              <?php endif; ?>
              <a class="tdb-footer__dotone" href="https://dotone.biz/" target="_blank" rel="noopener">
                <span class="tdb-footer__dotone-mark" aria-hidden="true">D1</span>
                <span><small><?php esc_html_e( 'Our product', 'ace' ); ?></small><b>DotOne <span aria-hidden="true">&nearr;</span></b></span>
              </a>
            </div>
          </div>

          <?php if ( have_rows( 'locations', 'option' ) ) : ?>
            <div class="tdb-footer__offices">
              <?php while ( have_rows( 'locations', 'option' ) ) : the_row(); ?>
                <div class="tdb-footer__office">
                  <span class="tdb-footer__pin" aria-hidden="true"></span>
                  <div>
                    <b><?php echo esc_html( wp_strip_all_tags( get_sub_field( 'location' ) ) ); ?></b>
                    <span><?php echo esc_html( trim( wp_strip_all_tags( get_sub_field( 'address' ) ), " ,\n\r\t" ) ); ?></span>
                  </div>
                </div>
              <?php endwhile; ?>
            </div>
          <?php endif; ?>

          <div class="tdb-footer__bottom">
            <p>&copy; 2023&ndash;<?php echo esc_html( wp_date( 'Y' ) ); ?> TechDotBit Private Limited. <?php esc_html_e( 'All rights reserved.', 'ace' ); ?></p>
            <ul>
              <li><a href="<?php echo esc_url( get_privacy_policy_url() ? get_privacy_policy_url() : home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'ace' ); ?></a></li>
              <?php if ( $ace_terms ) : ?><li><a href="<?php echo esc_url( get_permalink( $ace_terms ) ); ?>"><?php esc_html_e( 'Terms of Use', 'ace' ); ?></a></li><?php endif; ?>
            </ul>
          </div>
        </div>
      </footer>
    </div>

    <div id="header-contact-modal" class="lqd-modal lity-hide" data-modal-type="fullscreen">
      <div class="lqd-modal-inner py-25 px-2em">
        <div class="lqd-modal-content">
          
          <div class="relative flex flex-wrap px-15 py-30 -mr-15 -ml-15 module-bottom">
            <div class="container-fluid">
              <div class="row items-center">
                
                <div class="col col-12 col-md-6 col-lg-5 mx-auto">
                  <div class="lqd-contact-form lqd-contact-form-inputs-filled lqd-contact-form-inputs-round lqd-contact-form-button-block lqd-contact-form-button-round p-30 shadow-lg bg-white">
                    <?php echo do_shortcode('[contact-form-7 id="0f5d249" title="Quote Form"]'); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="lqd-modal-foot"></div>
      </div>
    </div>

        
    <template id="lqd-temp-sticky-header-sentinel">
      <div class="lqd-sticky-sentinel invisible absolute pointer-events-none"></div>
    </template>

    <div class="lity" role="dialog" aria-label="Dialog Window (Press escape to close)" tabindex="-1" data-modal-type="default">
      <div class="lity-wrap" data-lity-close role="document">
        <div class="lity-loader" aria-hidden="true">Loading...</div>
        <div class="lity-container">
          <div class="lity-content"></div>
        </div>
        <button class="lity-close" type="button" aria-label="Close (Press escape to close)" data-lity-close>&times;</button>
      </div>
    </div>
    
    <?php wp_footer(); ?>

	<script>
		document.addEventListener( 'wpcf7mailsent', function( event ) {
		  location = '<?php echo esc_url( home_url( '/thank-you/' ) ); ?>';
		}, false );
	</script>
  </body>
</html>