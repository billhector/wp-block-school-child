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
 * Inject favicon + PWA icon links into <head>.
 *
 * PNG + .ico cover all browsers; apple-touch-icon for iOS home-screen shortcuts.
 * Web manifest declares PWA install metadata and Android theme color.
 * Priority 1 runs before most plugins / parent theme so icons resolve consistently.
 */
add_action(
	'wp_head',
	static function (): void {
		$icons = get_stylesheet_directory_uri() . '/assets/icons';

		echo '<link rel="icon" type="image/png" sizes="32x32" href="' . esc_url( $icons . '/favicon-32x32.png' ) . '">' . "\n";
		echo '<link rel="icon" type="image/png" sizes="16x16" href="' . esc_url( $icons . '/favicon-16x16.png' ) . '">' . "\n";
		echo '<link rel="shortcut icon" href="' . esc_url( $icons . '/favicon.ico' ) . '">' . "\n";
		echo '<link rel="apple-touch-icon" sizes="180x180" href="' . esc_url( $icons . '/apple-touch-icon.png' ) . '">' . "\n";
		echo '<link rel="manifest" href="' . esc_url( $icons . '/site.webmanifest' ) . '">' . "\n";
		echo '<meta name="theme-color" content="#0f172a">' . "\n";
	},
	1
);

/**
 * Inject default Open Graph + Twitter image for pages without per-page overrides.
 *
 * Rank Math (or any SEO plugin) will override these on pages where the user sets
 * a specific OG image; this hook only fills the site-wide fallback. Runs at
 * priority 5 — early enough to be picked up by social-share crawlers, late enough
 * that any plugin priority-default (10) overrides take precedence.
 */
add_action(
	'wp_head',
	static function (): void {
		$og_url = get_stylesheet_directory_uri() . '/assets/brand/wpbs-og.jpg';
		echo '<meta property="og:image" content="' . esc_url( $og_url ) . '">' . "\n";
		echo '<meta property="og:image:width" content="1200">' . "\n";
		echo '<meta property="og:image:height" content="630">' . "\n";
		echo '<meta property="og:image:type" content="image/jpeg">' . "\n";
		echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
		echo '<meta name="twitter:image" content="' . esc_url( $og_url ) . '">' . "\n";
	},
	5
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

/**
 * Register Meta Box custom fields.
 *
 * Two separate field groups (pages vs posts) so the schemas can diverge —
 * blog posts will likely accrete fields (TL;DR, reading time, code-snippet
 * intro) that don't make sense on marketing pages.
 *
 * Field IDs are reused across groups when they mean the same thing (e.g.
 * `subhead`); they're stored as separate post meta because they're on
 * different post types — no collision.
 *
 * Requires the Meta Box plugin (rilwis/meta-box). Filter is a no-op when
 * the plugin is inactive.
 */
add_filter(
	'rwmb_meta_boxes',
	static function ( array $meta_boxes ): array {
		$meta_boxes[] = array(
			'title'      => __( 'Page details', 'wp-block-school' ),
			'id'         => 'wpbs_page_details',
			'post_types' => array( 'page' ),
			'context'    => 'normal',
			'priority'   => 'high',
			'fields'     => array(
				array(
					'id'    => 'subhead',
					'name'  => __( 'Subhead', 'wp-block-school' ),
					'type'  => 'text',
					'desc'  => __( 'Lead subhead under the H1 in the page hero. Overrides the post excerpt in hero rendering.', 'wp-block-school' ),
					'size'  => 80,
				),
			),
		);

		$meta_boxes[] = array(
			'title'      => __( 'Post details', 'wp-block-school' ),
			'id'         => 'wpbs_post_details',
			'post_types' => array( 'post' ),
			'context'    => 'normal',
			'priority'   => 'high',
			'fields'     => array(
				array(
					'id'    => 'subhead',
					'name'  => __( 'Subhead', 'wp-block-school' ),
					'type'  => 'text',
					'desc'  => __( 'Lead subhead under the H1 in the blog hero. Overrides the post excerpt in hero rendering.', 'wp-block-school' ),
					'size'  => 80,
				),
			),
		);

		return $meta_boxes;
	}
);

/**
 * When a `subhead` post meta is set, surface it as the excerpt so the existing
 * wp:post-excerpt blocks in templates/page.html and patterns/hero-blog.php
 * render it without any template change. Empty subhead falls through to the
 * native post_excerpt.
 *
 * Priority 9 runs before WordPress's default formatters at priority 10 — keeps
 * our subhead text unfiltered until WP's standard pipeline picks it up.
 */
add_filter(
	'get_the_excerpt',
	static function ( string $excerpt, $post ): string {
		if ( ! function_exists( 'rwmb_meta' ) || ! $post instanceof WP_Post ) {
			return $excerpt;
		}
		$subhead = rwmb_meta( 'subhead', array(), $post->ID );
		if ( is_string( $subhead ) && '' !== trim( $subhead ) ) {
			return $subhead;
		}
		return $excerpt;
	},
	9,
	2
);
