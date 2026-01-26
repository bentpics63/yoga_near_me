# YogaNearMe.info Brand Identity

## Brand Positioning

### The "Punks of Western Yoga"

Eddie and Lisa Marie position themselves as the "punks of Western yoga"—challenging the commercialization and commodification of yoga while honoring ancient tradition. This isn't rebellion for its own sake; it's a commitment to authenticity over marketing, substance over style, and practitioners over profits.

**Core Philosophy: "Teach First, Tool Second"**

Every piece of content, every tool, every resource starts with education. We don't sell solutions to manufactured problems. We identify real pain points, explain them thoroughly, and then offer tools that genuinely help.

**Brand Tagline: "A Curated Guide for the Modern Yogi"**

This tagline reflects our editorial approach—we're not a generic directory or wellness blog. We curate, we guide, we meet practitioners where they are. "Modern yogi" acknowledges that our audience lives in the real world, balancing practice with work, family, and life. The tagline appears in footers, The Guide hub page, and practitioner-facing communications.

### What We Stand For

- **Challenging yoga's commercialization** without dismissing modern innovation
- **Honoring tradition** while remaining accessible to beginners
- **Science-driven credibility** without rejecting spirituality
- **Accessible over exclusive** — no gatekeeping, no guru worship
- **Sincere over performative** — real help over marketing fluff

### What We Reject

- Generic wellness industry aesthetics (stock images of thin white women in impossible poses)
- Pseudoscience and unsubstantiated health claims
- Corporate yoga-speak and fitness industry jargon
- Elitist attitudes that make yoga feel inaccessible
- Treating yoga as a workout or weight-loss program

---

## Voice & Tone

### Two Distinct Voices

**Lisa Marie** writes all yoga practice content (glossary terms, style pages, practice guides, philosophical content). Her voice is poetic, invitational, and sincere—a teacher sharing wisdom with students.

**Eddie** writes all business and technical content (studio owner guides, SEO articles, market analysis, email communications). His voice is data-driven, peer-level, and pragmatic—a colleague sharing what actually works.

Both voices share the "punks of Western yoga" philosophy. Neither oversells. Neither talks down to readers. Both prioritize genuine helpfulness over conversion metrics.

See: `WRITER_VOICE_EDDIE.md` and `WRITER_VOICE_LISA_MARIE.md` for detailed voice profiles.

---

## Visual Design System

### Design Philosophy

**Typography as Architecture** — Structure and hierarchy should be clear from type alone. No decoration needed when typography is doing its job.

**Color as Punctuation, Not Decoration** — Color appears intentionally, as an event. Backgrounds recede; accent colors create moments of emphasis.

**Controlled Asymmetry** — The underlying grid exists, but we break it intentionally. Visual tension without chaos.

**Editorial Magazine Aesthetic** — Think MacGuffin Magazine, Communication Arts. Sophisticated without being pretentious. Credibility-first design that respects the reader's intelligence.

### Cinematic Influences

Eddie's visual sensibility draws from:
- **Jean-Pierre Jeunet** — Obsessive compositional control that looks effortless, eccentric warmth that's never sentimental
- **Stanley Kubrick** — Tension and precision masquerading as restraint
- **David Fincher** — Cool intelligence underneath everything, saturated color used sparingly for impact

### Color Palette

**Primary Tokens:**
```css
--ynm-sage:        #5F7470;  /* Primary brand green — headings, nav, grounding */
--ynm-teal:        #61948B;  /* Links, accents, interactive elements */
--ynm-rust:        #bd371a;  /* CTAs, highlights, hover states, drop caps */
--ynm-paper:       #F8FAFA;  /* Light backgrounds, breathing room */
--ynm-text-dark:   #2C3E3A;  /* Primary body text */
--ynm-text-medium: #6B7C78;  /* Secondary text */
```

**Usage Rules:**
- **Sage** = Authority, grounding, section headers, navigation backgrounds
- **Rust** = Action, emphasis, CTAs, drop caps, hover states (use sparingly—it's an event)
- **Teal** = Links, interactive elements, accents
- **Paper** = Breathing room, card backgrounds, white space

**Never:**
- Use rust as a background color
- Apply multiple accent colors in the same component
- Let color compete with typography for attention

### Typography

**Primary Font:** Inter (headings + body)
**Accent Font:** Crimson Pro (pull quotes, editorial moments, hero subtitles)

**Type Hierarchy:**
- **H1:** Large, sage, authoritative
- **H2:** Section titles with orange underline accent (50% width, 3px height)
- **Body:** 1.05rem, line-height 1.7, comfortable reading
- **Pull Quotes:** Crimson Pro italic, editorial emphasis

### Layout Principles

**Content Width:** 900px max for readability
**Generous White Space:** Let content breathe
**Sticky Table of Contents:** Desktop only, for long-form content
**Hero Images:** Full-width with gradient overlay, centered text positioned at ~78% from top

### Component Patterns

**CTAs:**
- Background: sage or rust (depending on context)
- Text: white or paper
- Hover: subtle lift (translateY -3px) or color shift
- Never more than one primary CTA per section

**Cards:**
- Light background or subtle transparency
- Border-left accent (4px rust) for emphasis
- Hover: slight lift, subtle background darkening

**Benefits Preview Section:**
- Full-width dark gradient background (sage to darker sage)
- White text, rust accents for numbering
- Glass-morphism effect on cards (backdrop-filter: blur)

---

## Content Categories

### For Yoga Practitioners (Lisa Marie's Voice)

- **Glossary Terms:** ~600 words, educational, warm, inviting
- **Yoga Style Pages:** Comprehensive guides to practice styles (Vinyasa, Hatha, Kundalini, etc.)
- **Benefits Pages:** "12 Benefits of [Style]" format
- **Practice Guides:** How-to content for poses, sequences, breathwork
- **The Modern Yogi Guide (FAQ Answers):** 30 essential questions answered, 800-1200 words each, organized in three silos (Beginner's Barrier, Logistics & Pricing, Health & Wellness). Editorial magazine aesthetic with numbered sections, video embeds, contextual CTAs. Each page answers one question thoroughly with related questions linked.

### For Studio Owners (Eddie's Voice)

- **Business Articles:** SEO, marketing, operations, growth strategies
- **Tool Guides:** Photo optimization, GBP optimization, local SEO
- **Market Analysis:** Industry insights, competitive landscape
- **Case Studies:** Real results from real studios

---

## Quality Standards

### The Lisa Test
Would Lisa Marie say this to a private student? If it sounds like marketing copy or trying too hard—revise toward sincerity, precision, and genuine invitation.

### The Eddie Test
Is there data? Is the action clear? Does it sound like a peer sharing what actually works?

### Universal Standards

- **Never oversell** — Be honest about what yoga can and can't do
- **Never use pseudoscience** — If you can't cite it, caveat it
- **Never gatekeep** — Make everything accessible to beginners
- **Never use generic wellness buzzwords** — "detoxify," "cleanse," "transform your life"
- **Always prioritize practitioners** — Everything we make should genuinely help

---

## SEO & Technical Standards

### E-E-A-T Signals
- Author bios with real credentials
- "Reviewed by" or "Written by" attribution
- Sources cited where appropriate
- Lisa Marie's 20+ years practice experience
- Eddie's 30 years meditation practice + business expertise

### Schema Markup
- Article schema for blog posts
- DefinedTerm schema for glossary
- LocalBusiness schema for studio listings
- BreadcrumbList schema on all pages

### Meta Standards
- Titles: 50-60 characters, keyword-forward
- Descriptions: 150-160 characters, include call to action
- Open Graph + Twitter cards on all content pages

---

## The 30,000-Foot View

YogaNearMe.info is building the most comprehensive yoga studio directory (30,000 listings and growing) combined with the highest-quality educational content about yoga. We serve two audiences:

1. **Practitioners** looking for studios, styles, and yoga education
2. **Studio owners** looking to grow their businesses

Both audiences get genuine value—not marketing fluff, not upsells disguised as content. The directory is free. The education is free. The tools we build will follow the same "teach first, tool second" philosophy: explain the problem, show the manual solution, then offer the tool that saves time.

This is what "punks of Western yoga" means in practice: building something useful, honest, and respectful of the tradition we're serving.
