<?php
/**
 * WP Block School child theme functions.
 *
 * Parent: Sensei Course theme.
 * Strategy: theme.json drives palette + typography + spacing overrides.
 * functions.php stays minimal — keeps the child theme block-native end-to-end.
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue parent + child stylesheets.
 *
 * Parent uses wp_enqueue_scripts; child piggybacks at priority 20 so it loads after.
 */
add_action(
	'wp_enqueue_scripts',
	static function (): void {
		$parent_handle = 'course-style';
		wp_enqueue_style(
			$parent_handle,
			get_template_directory_uri() . '/style.css',
			array(),
			wp_get_theme( 'course' )->get( 'Version' )
		);
		wp_enqueue_style(
			'wp-block-school-style',
			get_stylesheet_uri(),
			array( $parent_handle ),
			wp_get_theme()->get( 'Version' )
		);
	},
	20
);
