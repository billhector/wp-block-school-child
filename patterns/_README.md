# Patterns — conventions

This directory holds reusable block patterns for the WP Block School child theme. WordPress auto-discovers `*.php` files in this folder and registers them as patterns visible in the editor under **Patterns → [category]**.

When `claude.ai/design` (or any contributor) ships a new section design for wpblockschool.com, the output should land here as a single `.php` file following the conventions below.

---

## File naming

`patterns/<slug>.php`

- Lowercase, kebab-case
- Prefix with section type: `hero-`, `pricing-`, `faq-`, `footer-`, `proof-`, `cohort-`, `mini-course-`, `cta-`, `feature-`, `testimonial-`
- Examples: `hero-cohort.php`, `pricing-3-tier.php`, `faq-accordion.php`, `proof-numbers.php`

`_README.md` and any file starting with `_` are ignored by WP pattern discovery.

## File header

Every pattern file MUST start with a `register_block_pattern`-compatible PHP header. WordPress parses these tags:

```php
<?php
/**
 * Title: Hero — Cohort #1
 * Slug: wpbs/hero-cohort
 * Categories: wpbs-marketing
 * Keywords: hero, sales, cohort
 * Description: Above-the-fold hero for cohort #1 sales page.
 * Viewport Width: 1280
 * Block Types: core/post-content
 */
?>
<!-- wp:group ... -->
```

**Required:**
- `Title` — human-readable, shown in editor pattern picker
- `Slug` — globally unique. Always prefix with `wpbs/` (WP Block School namespace)

**Recommended:**
- `Categories` — see categories list below
- `Description` — one-line; helps editor users decide whether to insert
- `Viewport Width` — width to render at in editor preview; 1280 for full-width, 720 for narrow

## Pattern categories

Register a category once in `functions.php` (`register_block_pattern_category()`), reuse across patterns. Current categories:

| Slug | Use for |
|---|---|
| `wpbs-marketing` | Sales page, lead-magnet opt-in, pricing, FAQ |
| `wpbs-course` | Course-page-specific (Sensei lesson layout, module cards) |
| `wpbs-structural` | Headers, footers, separators, navigational |

Categories not yet registered? Add to `functions.php` before referencing.

## Token discipline

**Never hard-code colors, fonts, or spacing.** Every visual token must come from `theme.json`. The editor + frontend then share one source of truth.

| ❌ Don't | ✅ Do |
|---|---|
| `style="color:#0f172a"` | `textColor="primary"` (block attr) OR `style="color:var(--wp--preset--color--primary)"` |
| `style="font-family:Inter"` | `fontFamily="inter"` (block attr) |
| `style="font-weight:900"` | `style="font-weight:900"` (this is fine — weight is not a preset) |
| `style="padding:24px"` | `style="padding:var(--wp--preset--spacing--50)"` |
| `style="font-size:18px"` | `fontSize="base"` (block attr) OR `style="font-size:var(--wp--preset--font-size--base)"` |

The full token list lives in `.claude/design/DESIGN.md` and `theme.json`. If a token you need isn't there, add it to `theme.json` first, then use it.

## Example skeleton

```php
<?php
/**
 * Title: Section — Example
 * Slug: wpbs/section-example
 * Categories: wpbs-marketing
 * Description: Demo of the conventions used by every pattern in this theme.
 * Viewport Width: 1280
 */
?>
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"backgroundColor":"background","layout":{"type":"constrained","contentSize":"720px"}} -->
<div class="wp-block-group alignwide has-background-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">

	<!-- wp:heading {"level":2,"fontFamily":"inter","textColor":"primary","style":{"typography":{"fontWeight":"700"}}} -->
	<h2 class="wp-block-heading has-primary-color has-text-color has-inter-font-family" style="font-weight:700">Headline goes here</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"fontFamily":"inter","textColor":"text","style":{"typography":{"fontSize":"var:preset|font-size|base","lineHeight":"1.6"}}} -->
	<p class="has-text-color has-text-color has-inter-font-family" style="font-size:var(--wp--preset--font-size--base);line-height:1.6">Body paragraph that demonstrates the token-only approach.</p>
	<!-- /wp:paragraph -->

</div>
<!-- /wp:group -->
```

## How to contribute a pattern

1. Build the design in `claude.ai/design` referencing this repo (esp. `.claude/design/DESIGN.md` for tokens)
2. Output as Gutenberg block markup OR as HTML+CSS that uses `var(--wp--preset--...)` tokens
3. Drop the file into `patterns/<section-type>-<name>.php` with a header per the conventions above
4. Commit + push — the pattern shows up in the editor's Patterns panel immediately on next page load
5. Insert into a page, screenshot via chrome-devtools, audit, iterate

## Files in this directory

- `_README.md` — this file (ignored by WP discovery)
- `example-section.php` — minimal demo of the conventions (delete once real patterns ship)
