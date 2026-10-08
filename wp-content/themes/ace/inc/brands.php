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
<style id="tdb-clients-critical">
/* Essential layout inline so the grid can never render unstyled, even if an
   optimisation cache serves an outdated stylesheet. Full styles: ai-theme.css */
.tdb-clients{padding:clamp(48px,6vw,80px) 0;background:#fff}
.tdb-clients__title{margin:0 0 clamp(28px,4vw,44px);text-align:center;color:#6b7690;font-size:13px;font-weight:600;letter-spacing:.16em;text-transform:uppercase}
.tdb-clients__grid{display:grid;grid-template-columns:repeat(6,minmax(0,1fr));gap:clamp(28px,4vw,48px) clamp(16px,3vw,40px);margin:0;padding:0;list-style:none}
.tdb-clients__item{display:flex;flex-direction:column;align-items:center;gap:14px;list-style:none}
.tdb-clients__item::marker{content:none}
.tdb-clients__logo{display:flex;align-items:center;justify-content:center;width:100%;height:64px}
.tdb-clients__logo img{width:auto!important;height:auto!important;max-width:min(160px,100%);max-height:56px;object-fit:contain;filter:grayscale(1);opacity:.7;transition:filter .3s,opacity .3s}
.tdb-clients__item:hover img{filter:none;opacity:1}
@media (max-width:991px){.tdb-clients__grid{grid-template-columns:repeat(3,minmax(0,1fr))}}
@media (max-width:575px){.tdb-clients__grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
</style>
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
