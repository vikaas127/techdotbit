<?php
require_once get_stylesheet_directory() . '/inc/project-cover.php';
/**
 * Blog card for the current post in the loop.
 * Set $ace_card_featured = true before including for the large lead card.
 */
$ace_card_cat  = get_the_category();
$ace_card_cat  = $ace_card_cat ? $ace_card_cat[0] : null;
$ace_card_big  = ! empty( $ace_card_featured );
$ace_card_mins = ace_reading_time( get_the_ID() );
?>
<article <?php post_class( 'tdb-post-card' . ( $ace_card_big ? ' tdb-post-card--featured' : '' ) ); ?>>
	<a class="tdb-post-card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
		<?php echo ace_cover( get_the_ID() ); // phpcs:ignore -- escaped inside ?>
	</a>
	<div class="tdb-post-card__body">
		<?php if ( $ace_card_cat ) : ?>
			<a class="tdb-post-card__cat" href="<?php echo esc_url( get_category_link( $ace_card_cat ) ); ?>"><?php echo esc_html( $ace_card_cat->name ); ?></a>
		<?php endif; ?>
		<h<?php echo $ace_card_big ? '2' : '3'; ?> class="tdb-post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h<?php echo $ace_card_big ? '2' : '3'; ?>>
		<p class="tdb-post-card__excerpt"><?php echo esc_html( wp_trim_words( wp_strip_all_tags( has_excerpt() ? get_post_field( 'post_excerpt', get_the_ID() ) : strip_shortcodes( get_post_field( 'post_content', get_the_ID() ) ) ), $ace_card_big ? 36 : 22, '…' ) ); ?></p>
		<p class="tdb-post-card__meta">
			<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
			<span aria-hidden="true">·</span>
			<span><?php echo esc_html( sprintf( _n( '%d min read', '%d min read', $ace_card_mins, 'ace' ), $ace_card_mins ) ); ?></span>
		</p>
	</div>
</article>
<?php $ace_card_featured = false; ?>
