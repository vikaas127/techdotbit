<?php
/**
 * Client logos: a clean grid of grayscale logos (full colour on hover).
 * Uses the "brands" repeater in Theme Options (sub field "image").
 * Optional sub fields, if you add them to that repeater in ACF:
 *   "name"       - company name (used for alt text when the image has none)
 *   "link"       - URL to a case study
 *   "link_label" - text under the logo, e.g. "Case study" (default)
 */
if ( have_rows( 'brands', 'option' ) ) : ?>
<section class="lqd-section tdb-clients" aria-labelledby="tdb-clients-title">
  <div class="container">
    <p id="tdb-clients-title" class="tdb-clients__title"><?php esc_html_e( 'Trusted by teams worldwide', 'ace' ); ?></p>
    <ul class="tdb-clients__grid">
      <?php while ( have_rows( 'brands', 'option' ) ) : the_row();
        $image = get_sub_field( 'image' );
        if ( empty( $image ) ) {
          continue;
        }
        $name  = get_sub_field( 'name' );
        $link  = get_sub_field( 'link' );
        $label = get_sub_field( 'link_label' );
        $url   = is_array( $image ) ? $image['url'] : $image;
        $alt   = is_array( $image ) && ! empty( $image['alt'] ) ? $image['alt'] : ( $name ? $name : __( 'Client logo', 'ace' ) );
        ?>
        <li class="tdb-clients__item">
          <span class="tdb-clients__logo">
            <img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $alt ); ?>" loading="lazy" decoding="async"<?php if ( is_array( $image ) && ! empty( $image['width'] ) ) : ?> width="<?php echo (int) $image['width']; ?>" height="<?php echo (int) $image['height']; ?>"<?php endif; ?>>
          </span>
          <?php if ( $link ) : ?>
            <a class="tdb-clients__link" href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $label ? $label : __( 'Case study', 'ace' ) ); ?></a>
          <?php endif; ?>
        </li>
      <?php endwhile; ?>
    </ul>
  </div>
</section>
<?php endif; ?>
