<?php
/* Template Name: Portfolio Template */

get_header();
require_once get_stylesheet_directory() . '/inc/project-cover.php';

$ace_ptitle = __( 'Software we have designed and built', 'ace' );
$ace_pintro = __( 'AI, web, mobile and business platforms delivered for clients across industries.', 'ace' );
$ace_terms  = get_terms( array( 'taxonomy' => 'tagportfolio', 'hide_empty' => true ) );
$ace_loop   = new WP_Query( array( 'post_type' => 'project', 'posts_per_page' => -1 ) );
?>

<section class="tdb-work-hero">
	<div class="container">
		<p class="tdb-contact__chip"><span></span><?php esc_html_e( 'Our work', 'ace' ); ?></p>
		<h1><?php echo esc_html( $ace_ptitle ); ?></h1>
		<p class="tdb-work-hero__intro"><?php echo esc_html( $ace_pintro ); ?></p>
	</div>
</section>

<section class="tdb-worklist">
	<div class="container">
		<?php if ( $ace_terms && ! is_wp_error( $ace_terms ) ) : ?>
			<div class="tdb-worklist__filters" role="toolbar" aria-label="<?php esc_attr_e( 'Filter projects', 'ace' ); ?>">
				<button type="button" class="is-active" data-filter="all"><?php esc_html_e( 'All', 'ace' ); ?> <span><?php echo (int) $ace_loop->found_posts; ?></span></button>
				<?php foreach ( $ace_terms as $ace_term ) : ?>
					<button type="button" data-filter="<?php echo esc_attr( sanitize_title( $ace_term->name ) ); ?>"><?php echo esc_html( $ace_term->name ); ?> <span><?php echo (int) $ace_term->count; ?></span></button>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( $ace_loop->have_posts() ) : ?>
			<div class="tdb-worklist__grid">
				<?php while ( $ace_loop->have_posts() ) : $ace_loop->the_post();
					$ace_pt   = get_the_terms( get_the_ID(), 'tagportfolio' );
					$ace_slugs = $ace_pt && ! is_wp_error( $ace_pt ) ? implode( ' ', array_map( function ( $x ) { return sanitize_title( $x->name ); }, $ace_pt ) ) : '';
					?>
					<a class="tdb-work__card tdb-worklist__item" href="<?php the_permalink(); ?>" data-cats="<?php echo esc_attr( $ace_slugs ); ?>">
						<span class="tdb-work__media"><?php echo ace_project_cover( get_the_ID() ); // phpcs:ignore -- escaped inside ?></span>
						<span class="tdb-work__body">
							<?php if ( $ace_pt && ! is_wp_error( $ace_pt ) ) : ?><span class="tdb-work__tag"><?php echo esc_html( $ace_pt[0]->name ); ?></span><?php endif; ?>
							<span class="tdb-work__title"><?php the_title(); ?></span>
							<span class="tdb-work__more"><?php esc_html_e( 'View case study', 'ace' ); ?> <span aria-hidden="true">&rarr;</span></span>
						</span>
					</a>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<p><?php esc_html_e( 'No projects found.', 'ace' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php include_once( 'inc/brands.php' ); ?>
<?php include_once( 'inc/testimonials.php' ); ?>

<script>
(function () {
	var bar = document.querySelector('.tdb-worklist__filters');
	if (!bar) return;
	var items = document.querySelectorAll('.tdb-worklist__item');
	bar.addEventListener('click', function (e) {
		var btn = e.target.closest('button');
		if (!btn) return;
		bar.querySelectorAll('button').forEach(function (b) { b.classList.toggle('is-active', b === btn); });
		var f = btn.getAttribute('data-filter');
		items.forEach(function (it) {
			var show = f === 'all' || (' ' + it.getAttribute('data-cats') + ' ').indexOf(' ' + f + ' ') > -1;
			it.classList.toggle('is-hidden', !show);
		});
	});
})();
</script>

<?php get_footer(); ?>
