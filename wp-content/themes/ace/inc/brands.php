<?php
/**
 * Client logos: one line of small grayscale logos that scrolls continuously
 * (pauses on hover, full colour on hover, static for reduced motion).
 * Uses the "brands" repeater in Theme Options (sub field "image").
 * Optional sub fields, if you add them to that repeater in ACF:
 *   "name"       - company name (used for alt text when the image has none)
 *   "link"       - URL the logo links to (e.g. a case study)
 */
// Extra client logos shipped with the theme (assets/images/clients/), shown
// after the logos from Theme Options. Change via the 'ace_extra_clients' filter.
$ace_extra_clients = apply_filters( 'ace_extra_clients', array(
  array( 'name' => 'Virgo ACP', 'file' => 'virgo-acp.png' ),
  array( 'name' => 'E3 Group', 'file' => 'e3-group.png' ),
  array( 'name' => 'Bhutan Tuff', 'file' => 'bhutan-tuff.png' ),
  array( 'name' => 'Sharman Udyog Pvt. Ltd.', 'file' => 'sharman-udyog.png' ),
  array( 'name' => 'Glupac', 'file' => 'glupac.png' ),
  array( 'name' => 'NP', 'file' => 'np.png' ),
) );
// Collect every logo first: Theme Options rows, then the theme's own files.
$ace_logos = array();
if ( have_rows( 'brands', 'option' ) ) {
  while ( have_rows( 'brands', 'option' ) ) {
    the_row();
    $image = get_sub_field( 'image' );
    if ( empty( $image ) ) {
      continue;
    }
    $name = get_sub_field( 'name' );
    $ace_logos[] = array(
      'url'  => is_array( $image ) ? $image['url'] : $image,
      'alt'  => is_array( $image ) && ! empty( $image['alt'] ) ? $image['alt'] : ( $name ? $name : __( 'Client logo', 'ace' ) ),
      'link' => get_sub_field( 'link' ),
    );
  }
}
foreach ( $ace_extra_clients as $ace_client ) {
  $ace_logos[] = array(
    'url'  => get_theme_file_uri( 'assets/images/clients/' . $ace_client['file'] ),
    'alt'  => $ace_client['name'],
    'link' => '',
  );
}
if ( $ace_logos ) : ?>
<style id="tdb-clients-critical">
/* Essential styles inline so the strip never renders unstyled, even if an
   optimisation cache serves an outdated stylesheet. */
.tdb-clients{padding:clamp(36px,4vw,56px) 0!important;background:#fff}
.tdb-clients__title{margin:0 0 24px;text-align:center;color:#6b7690;font-size:12px;font-weight:600;letter-spacing:.16em;text-transform:uppercase}
.tdb-marquee{position:relative;overflow:hidden;-webkit-mask-image:linear-gradient(90deg,transparent,#000 8%,#000 92%,transparent);mask-image:linear-gradient(90deg,transparent,#000 8%,#000 92%,transparent)}
.tdb-marquee__track{display:flex;align-items:center;gap:clamp(36px,5vw,64px);width:max-content;margin:0;padding:0;list-style:none;animation:tdb-marquee var(--tdb-marquee-time,40s) linear infinite}
.tdb-marquee:hover .tdb-marquee__track{animation-play-state:paused}
.tdb-marquee__item{flex:none;list-style:none;margin:0}
.tdb-marquee__item::marker{content:none}
.tdb-marquee__item img,.tdb-marquee__item a{display:block}
.tdb-marquee__item img{width:110px!important;height:40px!important;max-width:none;object-fit:contain;filter:grayscale(1);opacity:.6;transition:filter .3s,opacity .3s}
.tdb-marquee__item:hover img{filter:none;opacity:1}
@keyframes tdb-marquee{to{transform:translateX(calc(-50% - clamp(36px,5vw,64px) / 2))}}
@media (max-width:575px){.tdb-marquee__item img{width:90px!important;height:34px!important}}
@media (prefers-reduced-motion:reduce){.tdb-marquee{overflow-x:auto}.tdb-marquee__track{animation:none}}
</style>
<section class="lqd-section tdb-clients" aria-labelledby="tdb-clients-title">
  <div class="container">
    <p id="tdb-clients-title" class="tdb-clients__title"><?php esc_html_e( 'Trusted by teams worldwide', 'ace' ); ?></p>
  </div>
  <div class="tdb-marquee" style="--tdb-marquee-time: <?php echo (int) max( 20, count( $ace_logos ) * 3 ); ?>s">
    <ul class="tdb-marquee__track">
      <?php foreach ( array( false, true ) as $ace_copy ) : // second copy makes the loop seamless ?>
        <?php foreach ( $ace_logos as $ace_logo ) : ?>
          <li class="tdb-marquee__item"<?php echo $ace_copy ? ' aria-hidden="true"' : ''; ?>>
            <?php if ( $ace_logo['link'] ) : ?><a href="<?php echo esc_url( $ace_logo['link'] ); ?>"<?php echo $ace_copy ? ' tabindex="-1"' : ''; ?>><?php endif; ?>
            <img src="<?php echo esc_url( $ace_logo['url'] ); ?>" alt="<?php echo $ace_copy ? '' : esc_attr( $ace_logo['alt'] ); ?>" width="110" height="40" loading="lazy" decoding="async">
            <?php if ( $ace_logo['link'] ) : ?></a><?php endif; ?>
          </li>
        <?php endforeach; ?>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
<?php endif; ?>
