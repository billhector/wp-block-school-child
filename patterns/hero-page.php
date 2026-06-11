<?php
/**
 * Title: Hero — Page (left text · floating featured image)
 * Slug: wpbs/hero-page
 * Categories: wpbs-marketing
 * Keywords: hero, page, about, featured image
 * Description: Default page hero — eyebrow + H1 + lead on the left, featured image on the right with stacked-block accents.
 * Viewport Width: 1280
 */
?>
<!-- wp:group {"align":"wide","className":"wpbs-hero-page","style":{"spacing":{"padding":{"top":"clamp(4rem, 7vw, 7rem)","bottom":"clamp(4rem, 7vw, 7rem)","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group alignwide wpbs-hero-page" style="padding-top:clamp(4rem, 7vw, 7rem);padding-right:var(--wp--preset--spacing--50);padding-bottom:clamp(4rem, 7vw, 7rem);padding-left:var(--wp--preset--spacing--50)">

	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"clamp(2rem, 6vw, 7rem)"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center">

		<!-- wp:column {"verticalAlignment":"center","width":"53%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:53%">

			<!-- wp:paragraph {"className":"wpbs-eyebrow","fontFamily":"jetbrains-mono","textColor":"secondary","style":{"typography":{"fontSize":"var:preset|font-size|xs","textTransform":"uppercase","letterSpacing":"0.05em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}}}} -->
			<p class="wpbs-eyebrow has-secondary-color has-text-color has-jetbrains-mono-font-family" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--50);font-size:var(--wp--preset--font-size--xs);letter-spacing:0.05em;text-transform:uppercase">About the course</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":1,"className":"wpbs-hero-page__title","style":{"typography":{"textWrap":"balance"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}}}} -->
			<h1 class="wp-block-heading wpbs-hero-page__title" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--50);text-wrap:balance">Migration-first, not migration-someday.</h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"wpbs-lead","fontFamily":"inter","textColor":"text-muted","style":{"typography":{"fontSize":"var:preset|font-size|xl","lineHeight":"1.6","textWrap":"pretty"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
			<p class="wpbs-lead has-text-muted-color has-text-color has-inter-font-family" style="margin-top:0;margin-bottom:0;font-size:var(--wp--preset--font-size--xl);line-height:1.6;text-wrap:pretty">Move a real, shipped site off Elementor and onto native WordPress blocks — one checkpointed stage at a time, with the old site running the whole way through.</p>
			<!-- /wp:paragraph -->

		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center","width":"47%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:47%">

			<!-- wp:group {"className":"wpbs-hero-page__figure","layout":{"type":"default"}} -->
			<div class="wp-block-group wpbs-hero-page__figure">

				<!-- wp:post-featured-image {"aspectRatio":"4/5","style":{"border":{"radius":"12px"}}} /-->

			</div>
			<!-- /wp:group -->

		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->
