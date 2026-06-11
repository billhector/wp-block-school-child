<?php
/**
 * Title: Hero — Blog post (centered text · wide featured image)
 * Slug: wpbs/hero-blog
 * Categories: wpbs-marketing
 * Keywords: hero, blog, post, single, featured image
 * Description: Single blog post hero — centered category eyebrow, title, excerpt, date, with a wide 16:9 featured image below.
 * Viewport Width: 1280
 * Block Types: core/post-content
 */
?>
<!-- wp:group {"align":"wide","className":"wpbs-hero-blog","style":{"spacing":{"padding":{"top":"clamp(4rem, 6vw, 5rem)","bottom":"0","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"blockGap":"0"}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group alignwide wpbs-hero-blog" style="padding-top:clamp(4rem, 6vw, 5rem);padding-right:var(--wp--preset--spacing--50);padding-bottom:0;padding-left:var(--wp--preset--spacing--50)">

	<!-- wp:group {"className":"wpbs-hero-blog__head","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained","contentSize":"760px","justifyContent":"center"}} -->
	<div class="wp-block-group wpbs-hero-blog__head">

		<!-- wp:post-terms {"term":"category","className":"wpbs-eyebrow","fontFamily":"jetbrains-mono","textColor":"secondary","style":{"typography":{"fontSize":"var:preset|font-size|xs","textTransform":"uppercase","letterSpacing":"0.05em","textAlign":"center"}},"textAlign":"center"} /-->

		<!-- wp:post-title {"textAlign":"center","level":1,"className":"wpbs-hero-blog__title","style":{"typography":{"fontSize":"var:preset|font-size|4xl","fontWeight":"900","lineHeight":"1.1","letterSpacing":"-0.02em","textWrap":"balance"}}} /-->

		<!-- wp:post-excerpt {"textAlign":"center","className":"wpbs-lead","fontFamily":"inter","textColor":"text-muted","style":{"typography":{"fontSize":"var:preset|font-size|xl","lineHeight":"1.6"}},"excerptLength":40} /-->

		<!-- wp:post-date {"textAlign":"center","className":"wpbs-hero-blog__date","fontFamily":"inter","textColor":"text-muted","style":{"typography":{"fontSize":"var:preset|font-size|sm"},"spacing":{"margin":{"top":"var:preset|spacing|20"}}}} /-->

	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"wpbs-hero-blog__figure-wrap","style":{"spacing":{"margin":{"top":"clamp(2rem, 5vw, 4rem)"}}},"layout":{"type":"default"}} -->
	<div class="wp-block-group wpbs-hero-blog__figure-wrap" style="margin-top:clamp(2rem, 5vw, 4rem)">

		<!-- wp:post-featured-image {"aspectRatio":"16/9","className":"wpbs-hero-blog__figure","style":{"border":{"radius":"12px","width":"1px","color":"var:preset|color|border"}}} /-->

	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
