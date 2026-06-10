# wp-block-school-child

Child theme for **wpblockschool.com** — an online course teaching WordPress site owners how to migrate off Elementor (and other page builders) onto the native WordPress block editor + Full-Site Editing (FSE).

Built in public. The site that teaches "go native WP, drop the page builder" runs on... native WP, with no page builder.

## What it is

- **Parent theme:** [Course](https://wordpress.org/themes/course/) by Automattic / Sensei LMS
- **Override strategy:** `theme.json` drives palette, typography, and spacing. `parts/` overrides the parent header + footer. `style.css` carries the child-theme header only — no CSS overrides yet.
- **Built for:** the wpblockschool.com cohort #1 sales page + course delivery (Sensei Pro + Sensei Course Theme).

## Design system

See [`/.claude/design/DESIGN.md`](./.claude/design/DESIGN.md) — the source of truth for every visual decision. If a token disagrees with `theme.json`, `theme.json` is the bug; if a token disagrees with `DESIGN.md`, DESIGN.md wins.

Highlights:
- Palette: Slate `#0f172a` + Burnt Orange `#ea580c` + Teal `#14b8a6` on warm white `#fafaf9`
- Typography: Inter (400, 700, 900) + JetBrains Mono (400) — self-hosted woff2, no external CDN
- Type scale: 17px root with fluid `clamp()`
- Spacing: 10 custom rem-based steps
- WCAG AA + colorblind-safe

## Structure

```
wp-block-school-child/
├── style.css                 # child theme header (Template: course)
├── functions.php             # parent + child stylesheet enqueue at priority 20
├── theme.json                # palette / typography / spacing / element + block overrides
├── parts/
│   ├── header.html           # site title + Free Mini-Course link + Log in button
│   └── footer.html           # 4-col grid (brand + course + account + legal)
├── assets/
│   └── fonts/                # self-hosted Inter (5 files) + JetBrains Mono (1 file)
└── .claude/
    └── design/
        └── DESIGN.md         # source of truth for the design system
```

## Local setup

1. Install the parent [Course](https://wordpress.org/themes/course/) theme via WP admin
2. Clone this repo into `wp-content/themes/wp-block-school-child/`
3. Activate the child theme in `Appearance → Themes`

Parent theme must remain installed and updated. The child inherits all templates and patterns from Course; only the parts and tokens overridden here change.

## Brand context

WP Block School teaches:
- Why Elementor is a long-term tax (license, autoload bloat, JS payload, lock-in)
- How to migrate a real site through 8 checkpointed stages
- How to ship the result as a native block theme, not "Elementor with extra steps"

Voice: direct, technical, builder-to-builder. No hype, no exclamation marks. The course is opinionated; the theme should feel the same.

## License

GPL-2.0-or-later — inherited from WordPress core and the parent Course theme.

## Maintainer

Bill Hector — [wpblockschool.com](https://wpblockschool.com) · [@billhector on GitHub](https://github.com/billhector)
