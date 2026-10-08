<?php
/**
 * Shared post listing for the blog, categories, tags, archives and search.
 * Expects $ace_blog = array( 'eyebrow', 'title', 'intro' ) and uses the main query.
 */
$ace_blog_url = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/' );
$ace_cats     = array_filter( get_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'number' => 14, 'hide_empty' => true ) ), function ( $c ) { return 'uncategorized' !== $c->slug; } );
$ace_cat_name = function ( $name ) {
	// Tidy slug-like names such as "crypto-legacy-app" or "android".
	return strtolower( $name ) === $name ? ucwords( str_replace( '-', ' ', $name ) ) : $name;
};
$ace_cur_cat  = is_category() ? get_queried_object_id() : 0;
$ace_feature  = is_home() && have_posts(); // 1 lead + 9 cards per page
?>
<section class="tdb-blog-hero">
	<div class="container">
		<div class="tdb-blog-hero__top">
			<div>
				<?php if ( ! empty( $ace_blog['eyebrow'] ) ) : ?><p class="tdb-chip"><span></span><?php echo esc_html( $ace_blog['eyebrow'] ); ?></p><?php endif; ?>
				<h1 class="tdb-blog-hero__title"><?php echo esc_html( $ace_blog['title'] ); ?></h1>
				<?php if ( ! empty( $ace_blog['intro'] ) ) : ?><p class="tdb-blog-hero__intro"><?php echo esc_html( $ace_blog['intro'] ); ?></p><?php endif; ?>
			</div>
			<form class="tdb-blog-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label class="screen-reader-text" for="tdb-blog-s"><?php esc_html_e( 'Search articles', 'ace' ); ?></label>
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
				<input id="tdb-blog-s" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search articles', 'ace' ); ?>">
			</form>
		</div>
		<nav class="tdb-blog-cats" aria-label="<?php esc_attr_e( 'Blog categories', 'ace' ); ?>">
			<a href="<?php echo esc_url( $ace_blog_url ); ?>"<?php echo is_home() ? ' aria-current="page"' : ''; ?>><?php esc_html_e( 'All', 'ace' ); ?></a>
			<?php foreach ( $ace_cats as $ace_c ) : ?>
				<a href="<?php echo esc_url( get_category_link( $ace_c ) ); ?>"<?php echo $ace_cur_cat === $ace_c->term_id ? ' aria-current="page"' : ''; ?>><?php echo esc_html( $ace_cat_name( $ace_c->name ) ); ?></a>
			<?php endforeach; ?>
		</nav>
	</div>
</section>

<section class="tdb-blog-list">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<?php if ( $ace_feature ) : the_post(); $ace_card_featured = true; include __DIR__ . '/card.php'; endif; ?>
			<div class="tdb-post-grid">
				<?php while ( have_posts() ) : the_post(); include __DIR__ . '/card.php'; endwhile; ?>
			</div>
			<?php
			$ace_pages = paginate_links( array( 'type' => 'array', 'prev_text' => '&larr; ' . __( 'Newer', 'ace' ), 'next_text' => __( 'Older', 'ace' ) . ' &rarr;', 'mid_size' => 1 ) );
			if ( $ace_pages ) : ?>
				<nav class="tdb-pager" aria-label="<?php esc_attr_e( 'Pages', 'ace' ); ?>"><?php echo implode( '', $ace_pages ); // phpcs:ignore -- core output ?></nav>
			<?php endif; ?>
		<?php else : ?>
			<div class="tdb-blog-empty">
				<h2><?php esc_html_e( 'No articles found', 'ace' ); ?></h2>
				<p><?php esc_html_e( 'Try another search or browse all articles.', 'ace' ); ?></p>
				<a class="tdb-btn tdb-btn--primary" href="<?php echo esc_url( $ace_blog_url ); ?>"><?php esc_html_e( 'View all articles', 'ace' ); ?></a>
			</div>
		<?php endif; ?>
	</div>
</section>
