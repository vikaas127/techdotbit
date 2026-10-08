<?php
/**
 * Homepage: selected work. Uses the projects chosen in Theme Options >
 * Case study (if set), otherwise the latest projects.
 */
$ace_work = array();
if ( function_exists( 'get_field' ) ) {
	$ace_cs = get_field( 'case_study', 'option' );
	$ace_cs = is_array( $ace_cs ) && isset( $ace_cs[0] ) ? $ace_cs[0] : $ace_cs;
	if ( ! empty( $ace_cs['list'] ) && is_array( $ace_cs['list'] ) ) {
		$ace_work = $ace_cs['list'];
	}
}
if ( ! $ace_work && post_type_exists( 'project' ) ) {
	$ace_work = get_posts( array( 'post_type' => 'project', 'numberposts' => 6 ) );
}
$ace_work = array_slice( array_filter( array_map( 'get_post', (array) $ace_work ) ), 0, 6 ); // two rows of three
if ( ! $ace_work ) {
	return;
}
?>
<section class="tdb-h tdb-work" id="work" aria-labelledby="tdb-work-title" data-tdb-inview>
	<div class="container">
		<div class="tdb-inds__top">
			<div class="tdb-h__head tdb-h__head--left">
				<p class="tdb-h__chip"><span></span><?php esc_html_e( 'Our work', 'ace' ); ?></p>
				<h2 id="tdb-work-title"><?php esc_html_e( 'Software we have built', 'ace' ); ?></h2>
			</div>
			<a class="tdb-h__link" href="<?php echo esc_url( function_exists( 'ace_portfolio_url' ) ? ace_portfolio_url() : home_url( '/' ) ); ?>"><?php esc_html_e( 'See all work', 'ace' ); ?> <span aria-hidden="true">&rarr;</span></a>
		</div>
		<div class="tdb-work__grid">
			<?php foreach ( $ace_work as $ace_i => $ace_w ) :
				$ace_terms = get_the_terms( $ace_w->ID, 'tagportfolio' );
				$ace_tag   = $ace_terms && ! is_wp_error( $ace_terms ) ? $ace_terms[0]->name : '';
				?>
				<a class="tdb-work__card" href="<?php echo esc_url( get_permalink( $ace_w ) ); ?>" style="--i: <?php echo (int) $ace_i; ?>">
					<span class="tdb-work__media">
						<?php if ( has_post_thumbnail( $ace_w ) ) : ?>
							<?php echo get_the_post_thumbnail( $ace_w, 'large', array( 'alt' => '', 'loading' => 'lazy', 'decoding' => 'async' ) ); ?>
						<?php else : ?>
							<span class="tdb-post-card__ph"></span>
						<?php endif; ?>
					</span>
					<span class="tdb-work__body">
						<?php if ( $ace_tag ) : ?><span class="tdb-work__tag"><?php echo esc_html( $ace_tag ); ?></span><?php endif; ?>
						<span class="tdb-work__title"><?php echo esc_html( get_the_title( $ace_w ) ); ?></span>
						<span class="tdb-work__more"><?php esc_html_e( 'View case study', 'ace' ); ?> <span aria-hidden="true">&rarr;</span></span>
					</span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
