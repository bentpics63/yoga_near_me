# Content Recommendations for YogaNearMe.info

**Purpose:** Specific recommended changes to glossary, style pages, and other content for improved SEO/SERP, UI/UX, and LLM searchability.

**Date:** 2026-01-22
**Status:** Recommendations only — no content changes made

---

## 1. GLOSSARY TERMS

### Structural Changes (Apply to all 70 terms)

| Change | Before | After | Why |
|--------|--------|-------|-----|
| **Opening sentence format** | Various formats | "**[Term]** is [definition]..." | LLMs extract first-sentence definitions as facts |
| **Add pronunciation in plain text** | Phonetic only | Add "sounds like..." | More accessible, LLM-extractable |
| **Add author byline** | None | "Written by Lisa Marie, 20+ years teaching" | E-E-A-T signal |
| **Add "Key Takeaway" box** | None | 2-3 sentence summary at end | LLMs extract these for answers |
| **Add "Related Terms" section** | Inline links only | Dedicated section with 3-5 terms | Internal linking + LLM context |
| **Add FAQ section** | None | 2-3 common questions per term | FAQPage schema eligibility |

### Term-Specific Recommendations

#### Completed Terms (11) — Review and Update:

**Asana**
- [ ] Change opening from descriptive to definitional: "Asana is the Sanskrit word for 'seat' and refers to..."
- [ ] Add "sounds like AH-sah-nah" after phonetic
- [ ] Add FAQ: "Is asana the same as yoga?" / "How many asanas are there?"
- [ ] Add Related Terms box: Pranayama, Hatha Yoga, Vinyasa, Yoga Nidra

**Bandhas**
- [ ] Simplify opening: "Bandhas are internal energy locks used in yoga practice..."
- [ ] Add practical "How to engage bandhas" mini-guide
- [ ] Add FAQ: "Are bandhas safe for beginners?"

**Bhakti**
- [ ] Add modern context: "Bhakti is the yoga of devotion and is practiced today through..."
- [ ] Include common bhakti practices (kirtan, mantra, seva)

**Drishti**
- [ ] Add visual diagram or description of the 9 traditional drishti points
- [ ] Add FAQ: "Where should I look during [specific pose]?"

**Hatha Yoga**
- [ ] Currently strong — add "Key Takeaway" summary box
- [ ] Add FAQ: "What's the difference between Hatha and Vinyasa?"

**Mantra**
- [ ] Add 3-5 beginner-friendly mantras with translations
- [ ] Add audio pronunciation guide (future)

**Pranayama**
- [ ] Very strong content — add FAQ schema
- [ ] Add "5 Pranayama Techniques for Beginners" internal link

**Pranayama Techniques**
- [ ] Add HowTo schema for each technique
- [ ] Add timing recommendations (when to practice each)

**Savasana**
- [ ] Add FAQ: "Why is savasana the hardest pose?" / "How long should savasana be?"
- [ ] Add modifications for people who can't lie flat

**Yoga**
- [ ] This is a cornerstone term — ensure it links to all major style pages
- [ ] Add history timeline (brief)
- [ ] Add FAQ: "Is yoga a religion?" / "Can anyone do yoga?"

**Yoga Nidra**
- [ ] Add HowTo schema for basic practice
- [ ] Link to guided resources (future content)

#### Priority Queue (Write Next) — Structure Requirements:

For each new term, ensure:

1. **Opening sentence:** "[Term] is..."
2. **Pronunciation:** Both phonetic AND "sounds like"
3. **Etymology:** Sanskrit roots if applicable
4. **Practice context:** When/how it's used in class
5. **For beginners:** Accessible explanation
6. **For teachers:** Deeper context
7. **Key Takeaway:** 2-3 sentence summary
8. **Related Terms:** 3-5 internal links
9. **FAQ:** 2-3 questions (enables FAQPage schema)
10. **Author byline:** Lisa Marie with credentials

---

## 2. STYLE PAGES

### Structural Changes (Apply to all style pages)

| Change | Why |
|--------|-----|
| **Add "At a Glance" summary box** | Quick scannable info, LLM-extractable |
| **Add "Is [Style] Right for You?" section** | Helps practitioners self-select |
| **Add comparison table** | "[Style] vs. Other Styles" |
| **Add class structure breakdown** | What to expect minute-by-minute |
| **Add author byline** | E-E-A-T signal |
| **Add FAQ section** | FAQPage schema eligibility |

### "At a Glance" Box Template:

```
[Style Name] At a Glance
━━━━━━━━━━━━━━━━━━━━━━━━━━
Pace: [Slow/Moderate/Fast]
Heat: [Unheated/Warm/Hot]
Best for: [Beginners/All levels/Experienced]
Physical intensity: [1-5 scale]
Spiritual elements: [None/Light/Significant]
Typical class length: [60/75/90 minutes]
```

### Page-Specific Recommendations:

**Vinyasa**
- [ ] Add FAQ: "Is Vinyasa good for weight loss?" / "What's the difference between Vinyasa and Power yoga?"
- [ ] Add comparison table: Vinyasa vs. Hatha vs. Ashtanga
- [ ] Add "What to expect in your first Vinyasa class"

**Hatha**
- [ ] Add FAQ: "Is Hatha yoga for beginners?" / "Why is it called Hatha?"
- [ ] Clarify that "Hatha" in studio schedules often means "gentle" or "basics"

**Hot Yoga**
- [ ] Add safety section (hydration, when to leave room)
- [ ] Add FAQ: "Is hot yoga safe?" / "Do I need special clothes?"
- [ ] Differentiate: Bikram vs. other hot yoga styles

**Iyengar**
- [ ] Add props section (what you'll use and why)
- [ ] Add FAQ: "Why do Iyengar classes use so many props?"

**Kundalini**
- [ ] Add what to expect (mantras, breathwork, kriyas)
- [ ] Add FAQ: "Is Kundalini yoga spiritual?" / "What is Kundalini awakening?"

**Prenatal**
- [ ] Add trimester breakdown (what's safe when)
- [ ] Add FAQ: "When can I start prenatal yoga?" / "Is yoga safe during pregnancy?"
- [ ] Add medical disclaimer

---

## 3. FAQ PAGE (30 Essential Questions)

### Schema Implementation

- [ ] Add FAQPage schema markup (PHP snippet created: `code/schema/faq-schema-snippet.php`)
- [ ] Ensure each Q&A is in proper HTML structure (`<h2>` or `<h3>` for questions)

### Content Improvements

- [ ] Add anchor links to each question
- [ ] Add "Jump to" navigation at top
- [ ] Group by category (Getting Started, Choosing a Style, Finding a Studio, etc.)
- [ ] Add internal links within answers to relevant glossary/style pages

---

## 4. BLOG POSTS

### Structural Issues Found

| Issue | Fix Required |
|-------|--------------|
| Blog cards show duplicate descriptions | Edit each post to have unique excerpt |
| Some posts mention "CorePower Yoga" in preview | Review and update excerpts |
| Missing author bylines | Add visible author on post template |

### SEO Improvements

- [ ] Add Article schema with author info
- [ ] Add publication date (visible)
- [ ] Add "Last updated" date for evergreen content
- [ ] Add estimated reading time
- [ ] Add table of contents for long posts (2,000+ words)

---

## 5. STUDIO LISTING PAGES

### Single Listing Page Improvements

| Change | Why |
|--------|-----|
| Add LocalBusiness + YogaStudio schema | Already present — verify complete |
| Add AggregateRating schema | PHP snippet created for listings with reviews |
| Add "About this studio" structured section | LLM-extractable studio info |
| Add business hours in plain text | Currently in schema only — add visible text |
| Add "First-time visitor tips" section | UX improvement |

### Archive/Search Results

| Change | Why |
|--------|-----|
| Hide "No Reviews" text | Cleaned up in CSS |
| Rating + hours same line | Cleaned up in CSS |
| Add "Open Now" filter | UX improvement (future) |
| Add distance indicator | Already present |

---

## 6. LLM SEARCHABILITY (GAI Optimization)

### Site-Wide Recommendations

| Change | Status | Notes |
|--------|--------|-------|
| Create `/llm.txt` | ✅ Done | `code/llm.txt` — upload to site root |
| Standardize entity definitions | Pending | All glossary terms start with "[Term] is..." |
| Add structured summaries | Pending | "Key Takeaway" boxes on all content |
| Plain-text hours on listings | Pending | Add visible hours alongside schema |
| FAQ sections everywhere | Pending | Enables LLM Q&A extraction |

### Content Patterns That Help LLMs

1. **Definitional openings:** "Vinyasa is a style of yoga that..."
2. **Explicit comparisons:** "Unlike Hatha, Vinyasa emphasizes..."
3. **Numbered lists:** "The 5 key benefits of Pranayama are..."
4. **Q&A format:** Questions as headings, answers as content
5. **Summary boxes:** "In summary, Kundalini yoga..."
6. **Structured attributes:** "Best for: Beginners | Intensity: Low"

---

## 7. TECHNICAL SEO

### Quick Wins

| Task | Status |
|------|--------|
| Add FAQ schema to FAQ page | PHP snippet ready |
| Add AggregateRating to studio pages | PHP snippet ready |
| Sync glossary count (70 vs 100+) | Needs manual fix |
| Add author schema to articles | Pending |
| Add HowTo schema to technique pages | Pending |

### Page Speed / Core Web Vitals

Not audited in this review — recommend running Lighthouse audit.

---

## 8. PRIORITY ACTION LIST

### Immediate (This Week)

1. [ ] Upload `llm.txt` to site root
2. [ ] Deploy FAQ schema snippet
3. [ ] Deploy AggregateRating schema snippet
4. [ ] Fix blog post excerpts (remove duplicates)

### Short-Term (2-4 Weeks)

1. [ ] Update 11 completed glossary terms with new structure
2. [ ] Add author bylines to all content
3. [ ] Add FAQ sections to top 5 glossary terms
4. [ ] Add "At a Glance" boxes to style pages

### Medium-Term (1-2 Months)

1. [ ] Write remaining 59 glossary terms with new structure
2. [ ] Add HowTo schema to pranayama/technique content
3. [ ] Create comparison content (style vs. style)
4. [ ] Add "Is X Right for You?" sections to style pages

---

## Document History

- 2026-01-22: Initial recommendations created based on site audit
