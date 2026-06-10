# DESIGN.md — wpblockschool.com

Source of truth for every design decision on the WP Block School site. Theme files (`theme.json`, `style.css`, brand docs) are downstream of this file. If they disagree, this file wins.

**Locked:** 2026-06-09
**Project:** wpblockschool
**Stack:** WordPress + Sensei Pro + Sensei Course Theme (FSE block theme) + `wp-block-school-child` child theme
**Host:** DreamHost VPS (production), Local by Flywheel (dev)

## Theme structure

- **Parent:** `course` (Automattic / Sensei). Untouched. Updates ship safely.
- **Child:** `wp-block-school-child` at `/wp-content/themes/wp-block-school-child/` (Local) and matching path on VPS.
  - `style.css` — child theme header w/ `Template: course`
  - `functions.php` — enqueue parent + child stylesheets at priority 20
  - `theme.json` — palette, typography, spacing overrides
  - `assets/fonts/` — self-hosted font files
  - `templates/` + `parts/` — added as block patterns mature
- **Global Styles → Site Editor** overrides are AVOIDED — drift between Local + VPS breaks reproducibility. All design tokens live in version-controlled `theme.json`.

## Design philosophy applied

Per Bill's CLAUDE.md global design rules:
- 17px root + fluid clamp for type scale (encoded in `theme.json` `fontSizes`)
- Self-hosted woff2 only (Inter + JetBrains Mono shipped in `assets/fonts/`; no external font CDN, no FOIT)
- Colorblind/contrast-first palette
- rem for type, px for borders
- Primary/secondary/accent w/ light/dark variants

## Brand voice (compressed)

- Direct, technical, builder-to-builder
- No hype, no exclamation points, no "Hey friend!" greetings
- Acknowledge the reader's experience — they've built sites
- Show numbers, not adjectives

## Palette — Slate + Burnt Orange + Teal

Indie-tech feel. Anti-corporate. Reads as "serious solo builder" not "enterprise SaaS." All values WCAG AA for body text and colorblind-safe under deuteranopia / protanopia / tritanopia.

| Token (theme.json slug) | Hex | Use |
|---|---|---|
| `primary` | `#0f172a` | Slate near-black. Headlines, primary CTAs, focus rings |
| `primary-light` | `#334155` | Hover states on primary, light backgrounds |
| `primary-dark` | `#020617` | Active states, dark accents |
| `secondary` | `#ea580c` | Burnt orange. Links, secondary CTAs, callouts, energy |
| `secondary-light` | `#fb923c` | Hover on secondary, light callout backgrounds |
| `secondary-dark` | `#9a3412` | Active secondary CTA |
| `accent` | `#14b8a6` | Teal. Success states, module-complete checks, positive UI |
| `accent-light` | `#5eead4` | Light success backgrounds |
| `accent-dark` | `#0f766e` | Success active |
| `text` | `#1e293b` | Body text (slate-800) |
| `text-muted` | `#475569` | Secondary text, captions |
| `background` | `#fafaf9` | Warm white page background |
| `background-subtle` | `#f5f5f4` | Card / section background |
| `border` | `#e7e5e4` | Subtle borders, dividers |
| `danger` | `#dc2626` | Errors, warnings |
| `code-bg` | `#0f172a` | Code block background (slate, matches primary) |
| `code-text` | `#e2e8f0` | Code block text |

**Notes:**
- Default WP palette + duotones + gradients disabled in `theme.json` (`defaultPalette: false`) so the Site Editor only surfaces these tokens.
- Light/dark variants computed as fixed hex (not `color-mix()`) so they survive in non-modern-browser fallbacks.
- Primary slate is dark enough for CTAs against warm white background (contrast ratio 17:1).
- Secondary burnt orange on warm white = 4.7:1 (AA pass for normal text, AAA for large text).
- Accent teal on warm white = 3.1:1 (AA pass for large text only; use for icons/borders/UI only, not body links).

**Dark mode:** Deferred to v2. Sales page + course content ship light-mode-only for cohort #1.

## Typography — Inter + JetBrains Mono

Single sans family + one mono family. Self-hosted woff2 (Inter currently TTF via parent theme — see migration note).

| theme.json slug | Stack | Use |
|---|---|---|
| `inter` | `Inter, system-ui, -apple-system, sans-serif` | Body, UI, headings (weights differentiate) |
| `jetbrains-mono` | `'JetBrains Mono', ui-monospace, 'SF Mono', Menlo, monospace` | Code blocks, preformatted |

**Font files (all woff2, latin subset, self-hosted at `wp-block-school-child/assets/fonts/`):**

| File | Weight | Style | Size |
|---|---|---|---|
| `inter-v20-latin-regular.woff2` | 400 | normal | ~24KB |
| `inter-v20-latin-italic.woff2` | 400 | italic | ~25KB |
| `inter-v20-latin-700.woff2` | 700 | normal | ~24KB |
| `inter-v20-latin-700italic.woff2` | 700 | italic | ~26KB |
| `inter-v20-latin-900.woff2` | 900 | normal | ~24KB |
| `jetbrains-mono-v24-latin-regular.woff2` | 400 | normal | ~21KB |

Total font payload: ~144KB across 6 files. Loaded as needed via `theme.json` fontFace declarations.

**Why Inter for both body + heading:** single typeface family, weight differentiation. H1 stands apart at 900 (extra-bold), all other heading levels (H2–H6) at 700 (bold). Industry-standard for tech/SaaS courses.

**Font weights used:**
- **400** — body text, base UI
- **400 italic** — emphasis in body
- **700** — H2 through H6, button labels, table headers, emphasized inline text
- **700 italic** — emphasized + italic inline (rare)
- **900** — H1 only (page hero headlines)

**Heading weight rule (locked):**
- H1 → 900
- H2, H3, H4, H5, H6 → 700

**Avoid:** weights other than 400/700/900 (no files shipped for them), italics on display sizes (Inter italics under-perform at H1/H2 scale), all-caps body text (H6 is the only token that uses uppercase).

## Type scale (fluid, 17px root)

Encoded in `theme.json` `settings.typography.fontSizes`. Clamp between viewport widths 400px and 1280px.

| Slug | clamp() | Approx range | Element use |
|---|---|---|---|
| `xs` | `clamp(0.75rem, 0.71rem + 0.18vw, 0.875rem)` | 12–14px | Captions, badges |
| `sm` | `clamp(0.875rem, 0.83rem + 0.21vw, 1rem)` | 14–17px | Secondary text, code |
| `base` | `clamp(1rem, 0.95rem + 0.24vw, 1.125rem)` | 17–19px | Body |
| `lg` | `clamp(1.125rem, 1.05rem + 0.36vw, 1.375rem)` | 19–23px | Lead paragraph, H5 |
| `xl` | `clamp(1.25rem, 1.13rem + 0.59vw, 1.625rem)` | 21–28px | H4 |
| `2xl` | `clamp(1.5rem, 1.31rem + 0.94vw, 2rem)` | 25–34px | H3 |
| `3xl` | `clamp(1.875rem, 1.55rem + 1.62vw, 2.625rem)` | 32–45px | H2 |
| `4xl` | `clamp(2.25rem, 1.78rem + 2.35vw, 3.375rem)` | 38–57px | Section hero |
| `5xl` | `clamp(2.75rem, 2.08rem + 3.35vw, 4.25rem)` | 47–72px | Page H1 |

**Line height:**
- Body: 1.6
- UI/captions: 1.4
- Headlines: 1.1 (H1), 1.2 (H2), 1.3 (H3+)

**Letter spacing:**
- H1: `-0.02em` (tight)
- H2: `-0.01em` (slightly tight)
- H6: `0.05em` + uppercase (label-style)
- Body + other: default

## Spacing scale

Encoded in `theme.json` `settings.spacing.spacingSizes`. Custom-rem-based.

| theme.json slug | rem | px equiv |
|---|---|---|
| `10` | `0.25rem` | 4px |
| `20` | `0.5rem` | 8px |
| `30` | `0.75rem` | 12px |
| `40` | `1rem` | 17px (= root) |
| `50` | `1.5rem` | 25.5px |
| `60` | `2rem` | 34px |
| `70` | `3rem` | 51px |
| `80` | `4rem` | 68px |
| `90` | `5rem` | 85px |
| `100` | `7rem` | 119px |

**Per Bill's memory:** known FSE bug — `spacingScale: { steps: 0 }` is set in `theme.json` to disable auto-generated steps; only the explicit `spacingSizes` above are surfaced.

## Borders + radii

- All borders: px-valued
- Default border: `1px solid var(--wp--preset--color--border)`
- Card border: `1px solid var(--wp--preset--color--border)`
- Focus ring: `2px solid var(--wp--preset--color--primary)` with `outline-offset: 2px`

| Token | px | Use |
|---|---|---|
| Radius small | `4px` | Buttons, badges, small inputs |
| Radius medium | `8px` | Cards, callouts, code blocks |
| Radius large | `12px` | Hero containers, large cards |
| Radius full | `9999px` | Pills, avatars |

(These aren't yet encoded in theme.json — added per-block as needed.)

## Layout

- `contentSize`: `720px` (reading width for course content + blog)
- `wideSize`: `1200px` (wider sections for sales page, marketing, course-list grids)

## Components

All built natively with WordPress blocks + `theme.json` tokens. No custom React. No page builder.

### Buttons (core/button)

theme.json defaults:
- Background: `primary` (slate)
- Text: `background` (warm white)
- Padding: `--wp--preset--spacing--30` top/bottom, `--wp--preset--spacing--50` left/right
- Font weight: 600
- Border radius: 4px (`small` radius)
- Hover: background `primary-light`

### Headings

- H1: 5xl size, Inter **900**, primary color, tight letter-spacing (`-0.02em`)
- H2: 3xl size, Inter 700, primary color, slight letter-spacing (`-0.01em`)
- H3: 2xl size, Inter 700, primary color
- H4: xl size, Inter 700, text color
- H5: lg size, Inter 700
- H6: base size, Inter 700 uppercase, text-muted, letter-spacing label-style (`0.05em`)

### Links (core elements/link)

- Color: `secondary` (burnt orange)
- Hover: `secondary-dark`
- Underline: default WP behavior

### Code blocks (core/code, core/preformatted)

- Background: `code-bg` (slate)
- Text: `code-text` (slate-200)
- Font: `jetbrains-mono`
- Size: `sm`
- Radius: 8px
- Padding: spacing `40`

### Quote (core/quote)

- Left border: 4px solid `secondary` (burnt orange)
- Padding-left: spacing `50`
- Font style: normal (no italic — Inter italics under-perform)

### Separator (core/separator)

- Background color: `border`

### Sensei course components

- Course Theme defaults inherited. Color tokens (slate / orange / teal) bleed through automatically since theme.json palette is parent-overridable.
- Module-complete checkmark uses `accent` (teal).
- Lesson list bullets use `secondary` (orange).

## Brand mark + wordmark

Locked 2026-06-09. Source files in `assets/brand/`.

### Wordmark

- **Text:** WP BLOCK SCHOOL (always uppercase)
- **Font:** Inter 900
- **Color:** `primary` (#0f172a slate) on light bg; `background` (#fafaf9 warm white) on dark bg
- **Tracking:** `-0.01em` (header) / `-0.02em` (display sizes / footer hero)
- **Layout:** inline single-line in header nav; stacked 3-line in footer hero treatment
- **Rendered, not imaged:** the wordmark is set in live Inter via `core/site-title` block. Do NOT use a wordmark SVG/PNG — the live type stays crisp at every size and inherits the type system.

### Mark (icon / favicon)

- **Concept:** 3×3 grid of rounded squares. 8 slate squares + the center square in burnt orange. Reads as block-editor metaphor plus "find the right block."
- **Files:**
  - `assets/brand/mark.svg` — primary (slate squares + orange center) for light backgrounds. 100×100 viewBox.
  - `assets/brand/mark-dark.svg` — inverted (warm-white squares + orange center) for dark backgrounds.
  - `assets/brand/favicon.svg` — slightly tighter grid + 4px corner radius for 16px-favicon legibility. Wired via `functions.php` → `wp_head`.
- **Sizes:**
  - Header: 28×28
  - Footer corner (if used): 24×24
  - Favicon: SVG (browser scales)
  - App icon / OG image: render at 512×512 from `mark.svg`
- **Don't:** add drop shadows, gradients, animation, or recolor the orange to anything else. The orange-on-slate contrast IS the mark.

### Combined lockup

- **Default:** mark (28×28) + 12px gap + wordmark inline. Used in site header.
- **Mark-only:** favicon, app icon, social avatar.
- **Wordmark-only:** footer hero, email footer, business cards.

## Imagery + iconography

- **Photography:** real photos only. No stock. If no real photo available, use a colored block w/ icon (Phosphor or Heroicons).
- **Icons:** Phosphor Icons (woff2 icon font self-hosted, ~80KB) OR inline SVG per icon. Decide during sales-page build.
- **Illustrations:** none for cohort #1. Hero proof-bar uses real numbers in plain HTML.

## Accessibility

- All interactive elements ≥44×44px hit area
- Focus visible on every interactive element (focus ring not removed)
- All images have `alt` text
- Headings hierarchical (one H1 per page, no skip levels)
- Color is never the only differentiator (paired w/ icon or text)
- WCAG AA minimum, AAA for body text where possible
- Reduced motion respected (`prefers-reduced-motion: reduce` cuts hover transitions)
- Keyboard navigation works on every interactive element

## Performance budget

- LCP < 1.5s
- Total page weight < 200KB on sales page (HTML + CSS + critical JS)
- Font preload only the body font (Inter); lazy-load mono
- No external JS on sales page (analytics tag async-loaded with `defer`)
- Sensei course-content pages can use up to 500KB total weight

## Design skills available

You can invoke these via the Skill tool when needed:

- **`design-extractor`** — Extract a design system from a URL. Use if you find a course site or sales page whose design you want to base wpblockschool.com on (not currently planned — we're cold-locking).
- **`design-auditor`** — Audit the project's design system for inconsistencies. Run after `theme.json` lands and sales page is built, to verify nothing contradicts this file.
- **`design-system-standards`** — Validate that design tokens match Bill's design philosophy (17px root, fluid clamp, colorblind/contrast). Run before locking `theme.json` v1.
- **`frontend-design`** — Build UI components against this `DESIGN.md`. Auto-reads this file. Use when implementing sales-page hero, pricing table, FAQ accordion, etc.
- **`tailwind-patterns`** — Reference for fluid clamp, color-mix, custom property patterns. Useful if any non-block-theme CSS is needed (likely none).

## Open decisions

- **Logomark (icon)** — needed for favicon + social cards. Defer or commission?
- **Course-content typography vs sales-page typography** — same scale, or course pages use slightly larger body text for reading comfort?
- **Pattern library** — build 5–10 reusable patterns for sales page sections (hero, proof bar, pricing table, FAQ, CTA)?
- **Font preload** — preload Inter 400 (`inter-v20-latin-regular.woff2`) and Inter 900 (`inter-v20-latin-900.woff2`) for above-the-fold rendering. Lazy-load 700 + italic + mono. Wire via `wp_head` priority hooks or `add_action('wp_head', ...)` in `functions.php`.

## Changelog

- `2026-06-09` — Initial lock. Palette: Slate + Burnt Orange + Teal. Type: Inter + JetBrains Mono. Spacing + radii defined. Child theme `wp-block-school-child` created with `theme.json` wiring these tokens.
- `2026-06-09` (update) — Replaced TTF + fontsource downloads with Bill's static woff2 set (Inter 400/400i/700/700i/900 + JetBrains Mono 400, all latin subset, ~144KB total). Heading weight rule locked: H1 = 900, H2–H6 = 700.
- `2026-06-09` (brand mark) — Locked wordmark (WP BLOCK SCHOOL uppercase, Inter 900, type-rendered not imaged) + mark (3×3 grid, 8 slate + center orange, 4px corner radius). Files in `assets/brand/`: `mark.svg`, `mark-dark.svg`, `favicon.svg`. Favicon wired via functions.php `wp_head` action. Header now shows mark + wordmark lockup; footer keeps wordmark-only.
