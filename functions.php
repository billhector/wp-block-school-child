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

/**
 * Inject SVG favicon link into <head>.
 *
 * Modern browsers prefer SVG favicons (one file, infinite resolution).
 * Priority 1 runs before most plugins / parent theme so the icon shows up consistently.
 */
add_action(
	'wp_head',
	static function (): void {
		$favicon_uri = get_stylesheet_directory_uri() . '/assets/brand/favicon.svg';
		echo '<link rel="icon" type="image/svg+xml" href="' . esc_url( $favicon_uri ) . '">' . "\n";
	},
	1
);

/**
 * Register pattern categories for the wpbs/* patterns.
 *
 * Categories scope where patterns appear in the editor's Patterns panel.
 * All wpbs patterns prefix their category slugs with `wpbs-` so they group
 * together and don't collide with parent-theme or core categories.
 */
add_action(
	'init',
	static function (): void {
		register_block_pattern_category(
			'wpbs-marketing',
			array( 'label' => __( 'WP Block School — Marketing', 'wp-block-school' ) )
		);
		register_block_pattern_category(
			'wpbs-course',
			array( 'label' => __( 'WP Block School — Course', 'wp-block-school' ) )
		);
		register_block_pattern_category(
			'wpbs-structural',
			array( 'label' => __( 'WP Block School — Structural', 'wp-block-school' ) )
		);
	}
);
