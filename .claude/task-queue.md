# Task Queue

## Current Task

(No active task)

## Queued

- [ ] **Task 4**: Single studio listing page — WordPress implementation *(EDDIE)*
  - **Status:** Mockup complete, implementation guide created
  - **Mockup:** `content/studio-listing/single-listing-MERGED.html`
  - **Implementation Guide:** `content/studio-listing/WORDPRESS-IMPLEMENTATION-GUIDE.md`
  - **Progress Tracker:** `.claude/STUDIO_LISTING_PROGRESS.md`
  - **Next steps (Eddie):** Add GeoDirectory fields, create Elementor template, integrate shortcodes
  - Success criteria: Working template in WordPress with dynamic data

- [ ] **Task 5**: Integrate neighborhood CSVs into GeoDirectory *(EDDIE)*
  - Context: 24 new city CSVs in `/data/neighborhoods/`
  - Plus 20 more coming from Gemini (Dallas through Providence)
  - Success criteria: All neighborhoods imported and visible on site

- [x] **Task 6**: Review 34 glossary terms in `1.16 NEEDS/` subfolder *(COMPLETE)*
  - **Result:** All 34 terms reviewed — publication-ready
  - No revisions needed; upload to WordPress when ready
  - Categories: 8 philosophical + 25 poses + 1 style (partner yoga)

- [ ] **Task 7**: Mobile app strategy - PWA implementation
  - Context: See `.claude/LAUNCH-ROADMAP-2026.md` for full strategy
  - Phase 1: Convert mobile site to PWA
  - Phase 2: Evaluate native app need
  - Success criteria: PWA with offline, push notifications, add-to-homescreen

## Completed

### 2026-01-23

- [x] **Neighborhood data strategy & generation**
  - Created prompt template: `prompts/NEIGHBORHOOD-DATA-PROMPT-TEMPLATE.md`
  - Created master city list: `data/neighborhoods/CITY-MASTER-LIST.md`
  - Generated 24 city CSVs with 241 neighborhoods total
  - Tier 3 (10): Sedona, Santa Fe, Savannah, Madison, Ann Arbor, Burlington, Bend, Santa Barbara, Park City, Maui
  - Tier 4 (3): Ottawa, Edmonton, Halifax
  - Tier 5 (11): San Jose, Tucson, Richmond, Boise, Milwaukee, Chattanooga, Greenville, Albuquerque, Spokane, Wilmington, Sarasota

- [x] **Updated CLAUDE.md documentation**
  - Corrected glossary status: 120+ terms complete (was showing 11/70)
  - Marked completed tasks: Archive CSS, Nearby Studios, Onboarding Form
  - Updated Quick Reference table

### 2026-01-22

- [x] **Task 1**: Archive card CSS cleanup
  - Updated ARCHIVE-CARDS-V3.css with enhanced "No Reviews" hiding, rating+hours same line styling

- [x] **Task 2**: Nearby studios section styling
  - Created `NEARBY-STUDIOS-CARDS.css` with complete styling
  - Matches archive card styling (hides phone/email/website, rating+hours same line)
  - Responsive grid layout, hover effects, intro offer badges

- [x] **Task 3**: Studio onboarding form
  - Full HTML/CSS/JS implementation in `code/onboarding/`
  - 7 sections: Basics, Identity, Practical, Differentiators, Booking, Virtual, Optional
  - Progress tracking, completion sidebar, upsell screen
  - Copy follows Eddie voice: direct, helpful, no consultant-speak

- [x] **Bonus**: Created llm.txt for AI crawlers
- [x] **Bonus**: Created FAQ schema snippet
- [x] **Bonus**: Created AggregateRating schema snippet

## Session Log

- 2026-01-23 22:08: Session started, reviewed task status
- 2026-01-23 22:15: Updated CLAUDE.md with accurate glossary counts
- 2026-01-23 22:30: Created neighborhood data prompt template
- 2026-01-23 23:00: Generated 24 city neighborhood CSVs (241 neighborhoods)
- 2026-01-24: Created `.claude/LAUNCH-ROADMAP-2026.md` — comprehensive launch planning doc
- 2026-01-24: Added Task 7 (PWA/mobile app strategy)
- 2026-01-24: Reviewed Task 4 — HTML mockup complete, needs WordPress implementation
- 2026-01-24: Completed Task 6 — all 34 glossary terms reviewed, publication-ready
- 2026-01-24: Created Studio Visibility Report MRD + PRD (`yoganearme-studio-suite/products/studio-visibility-report/`)
- 2026-01-24: Merged visibility-optimizer-prd.md from Claude.ai conversations
- 2026-01-24: Created exploration docs for Photo Optimizer, Review Monitor, Profit Calculator
- 2026-01-24: Created WordPress Implementation Guide for Task 4 studio listing page
