<?php
/** URL of a published page by path, or a fallback. */
if ( ! function_exists( 'ace_page_url' ) ) {
	function ace_page_url( $path, $fallback = '' ) {
		$p = get_page_by_path( $path );
		return $p && 'publish' === $p->post_status ? get_permalink( $p ) : ( $fallback ? $fallback : home_url( '/contact-us/' ) );
	}
}
