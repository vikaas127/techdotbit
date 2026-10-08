        </div>
        <?php if( have_rows('locations', 'option') ): ?>
      <section class="bg-gray-100 pt-20 pb-50 footer-top">
          <div class="container">
              <div class="row">
              <?php while( have_rows('locations', 'option') ) : the_row(); ?>
                <div class="col col-6 col-md-3 col-lg-3 mt-30">
                    <?php 
                    $icon = get_sub_field('icon'); 
                    if( !empty( $icon ) ): 
                  ?>
                      <img loading="lazy" decoding="async" src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>"  width="50" loading="lazy" class="img-fluid h-auto">
                  <?php endif; ?>
                  <address class="mt-20 mb-0">
                      <h5 class="mb-15"><?php the_sub_field('location'); ?></h5>
                      <?php the_sub_field('address'); ?>
                      <?php if(get_sub_field('phone')): ?>
                        <div class="d-flex items-center">
                          <span class="iconbox-icon-container m-0 text-40 text-primary">
                              <svg class="w-20 h-auto relative z-2" xmlns="http://www.w3.org/2000/svg" width="19.063" height="19.057" viewbox="0 0 19.063 19.057">
                                <path d="M1.969-18.375v1.313a7.172,7.172,0,0,1,3.65.984A7.31,7.31,0,0,1,8.2-13.494a7.172,7.172,0,0,1,.984,3.65H10.5A8.353,8.353,0,0,0,9.331-14.15a8.4,8.4,0,0,0-3.056-3.056A8.353,8.353,0,0,0,1.969-18.375Zm-6.788,1.969a1.442,1.442,0,0,0-.964.349L-7.9-13.9l.062-.041A1.966,1.966,0,0,0-8.5-12.879a2.041,2.041,0,0,0,.072,1.23A20.666,20.666,0,0,0-6.891-8.367,20.038,20.038,0,0,0-3.671-4.2,21.246,21.246,0,0,0,3.773.554h.021a2.245,2.245,0,0,0,1.2.082A2.32,2.32,0,0,0,6.07.1L8.142-1.969a1.379,1.379,0,0,0,.41-1.015A1.379,1.379,0,0,0,8.142-4L5.455-6.706a1.391,1.391,0,0,0-1.025-.41,1.391,1.391,0,0,0-1.025.41L2.112-5.394A10.206,10.206,0,0,1-.595-7.229,8.015,8.015,0,0,1-2.42-9.905l1.313-1.312a1.505,1.505,0,0,0,.431-1.077,1.234,1.234,0,0,0-.492-1.015l.062.062-2.748-2.81A1.442,1.442,0,0,0-4.819-16.406Zm6.788.656v1.313a4.5,4.5,0,0,1,2.307.615,4.558,4.558,0,0,1,1.671,1.671,4.5,4.5,0,0,1,.615,2.307H7.875a5.809,5.809,0,0,0-.8-2.974A6.127,6.127,0,0,0,4.942-14.95,5.809,5.809,0,0,0,1.969-15.75Zm-6.788.656a.253.253,0,0,1,.144.062l2.687,2.748a.142.142,0,0,1-.041.144l-1.948,1.928.144.41.267.574A11.008,11.008,0,0,0-2.81-7.875,7.98,7.98,0,0,0-1.5-6.3,11.479,11.479,0,0,0,.82-4.573,8.9,8.9,0,0,0,1.969-4l.41.185L4.368-5.8q.041-.041.062-.041t.062.041L7.26-3.035q.041.041.041.051t-.041.051L5.209-.9A.945.945,0,0,1,4.225-.7a19.676,19.676,0,0,1-6.973-4.43A19.5,19.5,0,0,1-5.763-9.044,17.408,17.408,0,0,1-7.2-12.1v-.021a.679.679,0,0,1-.021-.441.745.745,0,0,1,.226-.4l2.03-2.071A.2.2,0,0,1-4.819-15.094Zm6.788,1.969v1.313a1.9,1.9,0,0,1,1.395.574,1.9,1.9,0,0,1,.574,1.395H5.25a3.21,3.21,0,0,0-.441-1.641,3.258,3.258,0,0,0-1.2-1.2A3.21,3.21,0,0,0,1.969-13.125Z" transform="translate(8.563 18.375)" fill="currentColor"></path>
                              </svg>
                            </span>
                          <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', get_sub_field('phone') ) ); ?>"><?php the_sub_field('phone'); ?></a>
                        </div>
                      <?php endif; ?>
                      <?php if(get_sub_field('email')): ?>
                        <div class="d-flex items-center">
                          <span class="iconbox-icon-container m-0 text-40 text-primary">
                              <svg class="w-20 h-auto relative z-2" xmlns="http://www.w3.org/2000/svg" width="15.438" height="15.438" viewbox="0 0 15.438 15.438">
                                <path d="M0-14.844l-.315.2-7.4,4.824V.594H7.719V-9.815L.315-14.64Zm0,1.41L6.049-9.5,0-5.585-6.049-9.5ZM-6.531-8.405-.315-4.379l.315.2,6.531-4.23V-.594H-6.531Z" transform="translate(7.719 14.844)" fill="currentColor"></path>
                              </svg>
                            </span>
                          <a href="mailto:<?php echo esc_attr( get_sub_field('email') ); ?>"><?php the_sub_field('email'); ?></a>
                        </div>
                      <?php endif; ?>
                  </address>
                </div>
              <?php endwhile; ?>
              </div>
          </div>
      </section>
      <?php endif; ?>
      </main>
      <div class="lqd-back-to-top fixed" data-back-to-top="true">
        <a href="#wrap" class="inline-flex items-center justify-center rounded-full text-18" data-localscroll="true">
          <i class="lqd-icn-ess icon-ion-ios-arrow-up"></i>
        </a>
      </div>
      
      
      
      <footer id="site-footer" class="main-footer bg-light text-dark pt-90">
        <section class="lqd-section module-top">
          <div class="container">
            <div class="row">
              <?php if( have_rows('company_details', 'option') ): ?>
                <?php while( have_rows('company_details', 'option') ) : the_row(); ?>
                <div class="col col-12 col-lg-4">
                  <div class="w-full flex flex-col mb-35 pr-15percent module-first">
                    <div class="flex items-center mb-35">
                      <figure class="max-w-full inline-flex vertical-top m-0 flex-grow-1">
                        <?php 
                          // Use the header logo (transparent, shown dark on the light footer);
                          // the footer logo upload has a solid background on the live site.
                          $footerlogo = get_sub_field('logo');
                          $ace_hdr    = get_field( 'header', 'option' );
                          $ace_hlogo  = isset( $ace_hdr['logo'] ) ? $ace_hdr['logo'] : ( isset( $ace_hdr[0]['logo'] ) ? $ace_hdr[0]['logo'] : null );
                          if ( ! empty( $ace_hlogo['url'] ) ) { $footerlogo = $ace_hlogo; }
                          if( !empty( $footerlogo ) ): 
                        ?>
                          <img loading="lazy" decoding="async" class="max-w-full h-auto vertical-top rounded-inherit" width="200" height="40" src="<?php echo esc_url($footerlogo['url']); ?>" alt="<?php echo esc_attr($footerlogo['alt']); ?>">
                        <?php else: ?>
                          <figcaption class="h5 text-dark">TechDotBit</figcaption>
                        <?php endif; ?>
                      </figure>
                    </div>
                    <div class="ld-fancy-heading module-text">
                      <p class="ld-fh-element mb-3em"><?php the_sub_field('description'); ?></p>
                    </div>

                    <?php if( have_rows('social_media', 'option') ): ?>
                    <ul class="social-icon social-icon-border-none text-24">
                      <?php while( have_rows('social_media', 'option') ) : the_row(); ?>
                      <li>
                        <a class="text-dark text-24 hover:text-dark" href="<?php echo esc_url( get_sub_field('link') ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( get_sub_field('alt') ); ?>">
                          <img loading="lazy" decoding="async" width="24" height="24" src="<?php echo esc_url( get_sub_field('icon') ); ?>" alt="<?php echo esc_attr( get_sub_field('alt') ); ?>" loading="lazy">
                        </a>
                      </li>
                      <?php endwhile; ?>
                    </ul>
                    <?php endif; ?>
                  </div>
                </div>
                <?php endwhile; ?>
              <?php endif; ?>

              <?php if( have_rows('contact_details', 'option') ): ?>
                <?php while( have_rows('contact_details', 'option') ) : the_row(); ?>
                <div class="col col-12 col-md-6 col-lg-4">
                  <div class="w-full flex flex-col pl-15percent mb-35 bg-center bg-no-repeat bg-contain md:pl-0" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/demo/classic/footer/map%402x.png);">
                    <div class="ld-fancy-heading">
                      <h3 class="ld-fh-element mb-2em text-16 text-dark">Contact Us</h3>
                    </div>
                    <div class="iconbox relative items-center justify-start text-start mb-2em">
                      <div class="iconbox-icon-wrap flex mr-30">
                        <span class="iconbox-icon-container m-0 text-40 text-primary">
                          <svg class="w-20 h-auto relative z-2" xmlns="http://www.w3.org/2000/svg" width="19.063" height="19.057" viewbox="0 0 19.063 19.057">
                            <path d="M1.969-18.375v1.313a7.172,7.172,0,0,1,3.65.984A7.31,7.31,0,0,1,8.2-13.494a7.172,7.172,0,0,1,.984,3.65H10.5A8.353,8.353,0,0,0,9.331-14.15a8.4,8.4,0,0,0-3.056-3.056A8.353,8.353,0,0,0,1.969-18.375Zm-6.788,1.969a1.442,1.442,0,0,0-.964.349L-7.9-13.9l.062-.041A1.966,1.966,0,0,0-8.5-12.879a2.041,2.041,0,0,0,.072,1.23A20.666,20.666,0,0,0-6.891-8.367,20.038,20.038,0,0,0-3.671-4.2,21.246,21.246,0,0,0,3.773.554h.021a2.245,2.245,0,0,0,1.2.082A2.32,2.32,0,0,0,6.07.1L8.142-1.969a1.379,1.379,0,0,0,.41-1.015A1.379,1.379,0,0,0,8.142-4L5.455-6.706a1.391,1.391,0,0,0-1.025-.41,1.391,1.391,0,0,0-1.025.41L2.112-5.394A10.206,10.206,0,0,1-.595-7.229,8.015,8.015,0,0,1-2.42-9.905l1.313-1.312a1.505,1.505,0,0,0,.431-1.077,1.234,1.234,0,0,0-.492-1.015l.062.062-2.748-2.81A1.442,1.442,0,0,0-4.819-16.406Zm6.788.656v1.313a4.5,4.5,0,0,1,2.307.615,4.558,4.558,0,0,1,1.671,1.671,4.5,4.5,0,0,1,.615,2.307H7.875a5.809,5.809,0,0,0-.8-2.974A6.127,6.127,0,0,0,4.942-14.95,5.809,5.809,0,0,0,1.969-15.75Zm-6.788.656a.253.253,0,0,1,.144.062l2.687,2.748a.142.142,0,0,1-.041.144l-1.948,1.928.144.41.267.574A11.008,11.008,0,0,0-2.81-7.875,7.98,7.98,0,0,0-1.5-6.3,11.479,11.479,0,0,0,.82-4.573,8.9,8.9,0,0,0,1.969-4l.41.185L4.368-5.8q.041-.041.062-.041t.062.041L7.26-3.035q.041.041.041.051t-.041.051L5.209-.9A.945.945,0,0,1,4.225-.7a19.676,19.676,0,0,1-6.973-4.43A19.5,19.5,0,0,1-5.763-9.044,17.408,17.408,0,0,1-7.2-12.1v-.021a.679.679,0,0,1-.021-.441.745.745,0,0,1,.226-.4l2.03-2.071A.2.2,0,0,1-4.819-15.094Zm6.788,1.969v1.313a1.9,1.9,0,0,1,1.395.574,1.9,1.9,0,0,1,.574,1.395H5.25a3.21,3.21,0,0,0-.441-1.641,3.258,3.258,0,0,0-1.2-1.2A3.21,3.21,0,0,0,1.969-13.125Z" transform="translate(8.563 18.375)" fill="currentColor"></path>
                          </svg>
                        </span>
                      </div>
                      <div class="contents">
                        <h3 class="text-13 text-dark mb-0">Looking for collaboration?</h3>
                        <p>
                          <span class="text-16 text-dark">
                            <a class="text-dark" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', get_sub_field('phone') ) ); ?>"><?php the_sub_field('phone'); ?></a>
                          </span>
                        </p>
                      </div>
                    </div>
                    <div class="iconbox relative items-center justify-start text-start mb-2em">
                      <div class="iconbox-icon-wrap flex mr-30">
                        <span class="iconbox-icon-container m-0 text-40 text-primary">
                          <svg class="w-20 h-auto relative z-2" xmlns="http://www.w3.org/2000/svg" width="15.438" height="15.438" viewbox="0 0 15.438 15.438">
                            <path d="M0-14.844l-.315.2-7.4,4.824V.594H7.719V-9.815L.315-14.64Zm0,1.41L6.049-9.5,0-5.585-6.049-9.5ZM-6.531-8.405-.315-4.379l.315.2,6.531-4.23V-.594H-6.531Z" transform="translate(7.719 14.844)" fill="currentColor"></path>
                          </svg>
                        </span>
                      </div>
                      <div class="contents">
                        <h3 class="text-13 text-dark mb-0">eMail Us</h3>
                        <p>
                          <a class="text-dark" href="mailto:<?php echo esc_attr( get_sub_field('email') ); ?>"><?php the_sub_field('email'); ?></a>
                        </p>
                      </div>
                    </div>
                    <div class="iconbox relative items-center justify-start text-start mb-20">
                      <div class="iconbox-icon-wrap flex mr-30">
                        <span class="iconbox-icon-container m-0 text-40 text-primary">
                          <svg class="w-20 h-auto relative z-2" xmlns="http://www.w3.org/2000/svg" width="15.75" height="16.099" viewbox="0 0 15.75 16.099">
                            <path d="M3.938-16.406a3.8,3.8,0,0,0-1.969.533A4.013,4.013,0,0,0,.533-14.437,3.8,3.8,0,0,0,0-12.469a3.366,3.366,0,0,0,.164.984,8.121,8.121,0,0,0,.41,1.066q.472,1.046,1.148,2.235Q2.563-6.747,3.4-5.537l.533.779L5-6.316Q5.64-7.28,6.152-8.183A20.572,20.572,0,0,0,7.3-10.418a8.121,8.121,0,0,0,.41-1.066,3.366,3.366,0,0,0,.164-.984,3.8,3.8,0,0,0-.533-1.969,4.013,4.013,0,0,0-1.436-1.436A3.8,3.8,0,0,0,3.938-16.406Zm-6.583,1.271L-7.875-12.9V-.308L-2.6-2.584,2.646-.615,7.875-2.851V-8.572q-.513.984-1.312,2.256v2.6L3.281-2.317V-3.384L1.969-5.291v3.035L-1.969-3.732v-9.762l.718.267A5.446,5.446,0,0,1-.9-14.5Zm6.583.041a2.6,2.6,0,0,1,1.323.349,2.554,2.554,0,0,1,.954.954,2.6,2.6,0,0,1,.349,1.323,2.49,2.49,0,0,1-.123.625,7.614,7.614,0,0,1-.328.892Q5.742-10.131,5-8.839q-.472.82-.964,1.538l-.1.164-.1-.164q-.492-.718-.964-1.538a22.116,22.116,0,0,1-1.107-2.112,7.614,7.614,0,0,1-.328-.892,2.49,2.49,0,0,1-.123-.625,2.6,2.6,0,0,1,.349-1.323,2.554,2.554,0,0,1,.954-.954A2.6,2.6,0,0,1,3.938-15.094Zm-7.219,1.641v9.741L-6.562-2.317v-9.721Z" transform="translate(7.875 16.406)" fill="currentColor"></path>
                          </svg>
                        </span>
                      </div>
                      <div class="contents">
                        <h3 class="text-13 text-dark mb-0">Head Quarter</h3>
                        <address class="text-16 text-dark">
                          <?php the_sub_field('address'); ?>
                        </address>
                      </div>
                    </div>
                    
                  </div>
                </div>
                <?php endwhile; ?>
              <?php endif; ?>

              <div class="col col-12 col-md-6 col-lg-4">
                <div class="container-fluid mb-35 p-0">
                  <div class="row">
                    <div class="col col-6">
                      <div class="ld-fancy-heading">
                        <h3 class="ld-fh-element mb-2em text-16 text-dark">Useful Links</h3>
                      </div>
                      <div class="lqd-fancy-menu lqd-custom-menu lqd-menu-td-none ld_custom_menu_62ff6ae926ced">
                        <?php wp_nav_menu( array( 'theme_location' => 'footer-menu-1' ) ); ?>
                      </div>
                    </div>
                    <div class="col col-6">
                      <div class="ld-fancy-heading">
                        <h3 class="ld-fh-element mb-2em text-16 text-dark">Our Solutions</h3>
                      </div>
                      <div class="lqd-fancy-menu lqd-custom-menu lqd-menu-td-none ld_custom_menu_62ff6ae927f4b">
                        <?php wp_nav_menu( array( 'theme_location' => 'footer-menu-2' ) ); ?>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="lqd-section module-bottom pt-20 pb-35">
          <div class="container">
            <div class="row">
              <div class="col col-12">
                <div class="w-full relative border-top border-dark mb-30"></div>
              </div>
              <div class="col col-12 col-md-5 text-start sm:text-center">
                <div class="ld-fancy-heading">
                  <p class="ld-fh-element mb-0/5em text-13 text-dark">Copyright &copy; 2023&ndash;<?php echo esc_html( wp_date( 'Y' ) ); ?> TechDotBit. All rights reserved.</p>
                </div>
              </div>
              <div class="col col-12 col-sm-7 text-end sm:text-center">
                <div class="lqd-fancy-menu lqd-menu-td-none -mr-15 -ml-15">
                  <ul class="reset-ul inline-nav link-14">
                    <li class="w-auto relative inline-flex flex-wrap mx-15">
                      <a class="text-dark-70 hover:text-dark" href="<?php echo esc_url( get_privacy_policy_url() ? get_privacy_policy_url() : home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a>
                    </li>
                    <?php $ace_terms = get_page_by_path( 'terms-of-use' ) ? get_page_by_path( 'terms-of-use' ) : get_page_by_path( 'terms-and-conditions' ); ?>
                    <?php if ( $ace_terms ) : ?>
                    <li class="w-auto relative inline-flex flex-wrap mx-15">
                      <a class="text-dark-70 hover:text-dark" href="<?php echo esc_url( get_permalink( $ace_terms ) ); ?>">Terms of Use</a>
                    </li>
                    <?php endif; ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
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