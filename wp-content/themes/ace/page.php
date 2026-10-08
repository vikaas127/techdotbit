<?php
/**
 * Default page template (legal pages, simple content pages): compact header
 * and a readable, well-spaced text column.
 */
get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<header class="tdb-page-hero">
		<div class="container">
			<nav class="tdb-crumbs" aria-label="Breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'ace' ); ?></a>
				<span aria-hidden="true">/</span>
				<span aria-current="page"><?php the_title(); ?></span>
			</nav>
			<h1><?php the_title(); ?></h1>
			<p class="tdb-page-hero__meta"><?php echo esc_html( sprintf( __( 'Last updated %s', 'ace' ), get_the_modified_date() ) ); ?></p>
		</div>
	</header>

	<div class="tdb-page-body">
		<div class="container">
			<article class="tdb-page-content entry-content">
				<?php the_content(); ?>
			</article>
		</div>
	</div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
