<?php
/**
 * Title: Example — Section Demo
 * Slug: wpbs/example-section
 * Categories: wpbs-marketing
 * Keywords: example, demo, section
 * Description: Reference pattern showing the token-only conventions used by every pattern in this theme. Delete once real patterns ship.
 * Viewport Width: 1280
 */
?>
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80","left":"var:preset|spacing|60","right":"var:preset|spacing|60"}}},"backgroundColor":"background","layout":{"type":"constrained","contentSize":"720px"}} -->
<div class="wp-block-group alignwide has-background-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--60)">

	<!-- wp:heading {"level":2,"fontFamily":"inter","textColor":"primary","style":{"typography":{"fontWeight":"700","letterSpacing":"-0.01em"}}} -->
	<h2 class="wp-block-heading has-primary-color has-text-color has-inter-font-family" style="font-weight:700;letter-spacing:-0.01em">Example section headline</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"fontFamily":"inter","textColor":"text","style":{"typography":{"lineHeight":"1.6"}}} -->
	<p class="has-text-color has-inter-font-family" style="line-height:1.6">This pattern is a reference implementation. Every token comes from <code>theme.json</code> — palette via <code>textColor</code> + <code>backgroundColor</code>, spacing via <code>var:preset|spacing|*</code>, type family via <code>fontFamily</code>, sizes via <code>var:preset|font-size|*</code>. Hard-coded hex values, font-family declarations, and pixel paddings are forbidden — see <code>patterns/_README.md</code>.</p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
	<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50)">

		<!-- wp:button {"backgroundColor":"primary","textColor":"background","fontFamily":"inter","style":{"border":{"radius":"4px"},"typography":{"fontWeight":"700"}}} -->
		<div class="wp-block-button has-inter-font-family" style="font-weight:700"><a class="wp-block-button__link has-background-color has-primary-background-color has-text-color has-background wp-element-button" style="border-radius:4px">Primary action</a></div>
		<!-- /wp:button -->

		<!-- wp:button {"textColor":"secondary","fontFamily":"inter","style":{"border":{"radius":"4px","width":"1px","color":"var:preset|color|secondary"},"typography":{"fontWeight":"700"},"color":{"background":"transparent"}}} -->
		<div class="wp-block-button has-inter-font-family" style="font-weight:700"><a class="wp-block-button__link has-secondary-color has-text-color has-background wp-element-button" style="border-color:var(--wp--preset--color--secondary);border-width:1px;border-radius:4px;background-color:transparent">Secondary action</a></div>
		<!-- /wp:button -->

	</div>
	<!-- /wp:buttons -->

</div>
<!-- /wp:group -->
