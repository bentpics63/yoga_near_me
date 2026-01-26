# Eight Limbs Content Series: Master Plan

## Overview

A comprehensive content series placing the Eight Limbs of Yoga at the center of holistic daily practice. State-of-the-art articles that are easy to read, action-oriented, spiritually grounded without being flowery, and backed by science where it supports the teaching.

**Voice:** Lisa Marie (see `knowledge/WRITER_VOICE_LISA_MARIE.md`)
**Philosophy:** Teach first, tool second. Rebellious authenticity. Honor tradition without gatekeeping.

---

## The Knowledge Web

The Eight Limbs series becomes the connective tissue for the entire site:

```
                              ┌─────────────────────┐
                              │    EIGHT LIMBS      │
                              │      (Hub)          │
                              └──────────┬──────────┘
                                         │
          ┌──────────────────────────────┼──────────────────────────────┐
          │                              │                              │
          ▼                              ▼                              ▼
┌─────────────────┐            ┌─────────────────┐            ┌─────────────────┐
│  YAMA/NIYAMA    │            │     ASANA       │            │  PRANAYAMA →    │
│  (Ethics &      │◄──────────►│   (Physical)    │◄──────────►│  MEDITATION     │
│   Self-Care)    │            │                 │            │   (Inner)       │
└────────┬────────┘            └────────┬────────┘            └────────┬────────┘
         │                              │                              │
         ▼                              ▼                              ▼
┌─────────────────┐            ┌─────────────────┐            ┌─────────────────┐
│ EVERYDAY YOGA   │            │YOGA FOR YOUR    │            │ YOGA FOR        │
│ (Glossary)      │◄──────────►│    BODY         │◄──────────►│ ANXIETY/SLEEP   │
│ Mindfulness,    │            │ Back, Hips,     │            │ (Therapeutic)   │
│ Self-Care, etc. │            │ Shoulders, etc. │            │                 │
└────────┬────────┘            └────────┬────────┘            └────────┬────────┘
         │                              │                              │
         │                              ▼                              │
         │                     ┌─────────────────┐                     │
         │                     │  STYLE PAGES    │                     │
         └────────────────────►│ Vinyasa, Hatha, │◄────────────────────┘
                               │ Iyengar, etc.   │
                               └────────┬────────┘
                                        │
                                        ▼
                               ┌─────────────────┐
                               │    GLOSSARY     │
                               │   (103 terms)   │
                               └─────────────────┘
```

---

## URL Structure

```
/eight-limbs/
├── index (Hub Article)
│
├── /yama/
│   ├── index (Overview)
│   ├── /ahimsa/
│   ├── /satya/
│   ├── /asteya/
│   ├── /brahmacharya/
│   └── /aparigraha/
│
├── /niyama/
│   ├── index (Overview)
│   ├── /saucha/
│   ├── /santosha/
│   ├── /tapas/
│   ├── /svadhyaya/
│   └── /ishvara-pranidhana/
│
├── /asana/
├── /pranayama/
├── /pratyahara/
├── /dharana/
├── /dhyana/
└── /samadhi/

/yoga-for-your-body/
├── index (Hub)
├── /back-pain/
├── /hips/
├── /neck-and-shoulders/
├── /core/
├── /posture/
└── /joint-mobility/
```

---

## Build Order

### Phase 1: Foundation (Priority)

| Order | Content | Purpose | Connections |
|-------|---------|---------|-------------|
| 1 | **Eight Limbs Hub** | Anchor article; framework overview | Links to all limbs, glossary |
| 2 | **Yoga for Back Pain** | High-traffic entry; proves value | Links to Asana, Pranayama, poses |
| 3 | **Asana (Limb 3)** | Bridges philosophy to physical | Links to poses, styles, glossary |
| 4 | **Pranayama (Limb 4)** | Bridges body to mind | Links to breath terms, anxiety/sleep |
| 5 | **Yama Overview** | Ethics foundation | Links to Ahimsa glossary, Niyama |
| 6 | **Niyama Overview** | Personal practice foundation | Links to Sadhana, Sankalpa glossary |

### Phase 2: Depth

| Order | Content | Purpose |
|-------|---------|---------|
| 7-11 | **Individual Yamas** (5 articles) | Actionable ethics |
| 12-16 | **Individual Niyamas** (5 articles) | Personal practice depth |
| 17 | **Yoga for Anxiety** | High demand; connects Pranayama + Pratyahara |
| 18 | **Pratyahara** | Modern relevance (overstimulation, screens) |
| 19 | **Yoga for Sleep** | Connects to Nidra, Restorative, Pratyahara |
| 20 | **Dharana + Dhyana + Samadhi** | Meditation arc |

### Phase 3: Expansion

- Individual "Yoga for Your Body" articles (hips, shoulders, etc.)
- Additional therapeutic articles
- Benefits articles for each limb
- Advanced practice guides

---

## Article Framework

### Structure Template

```
┌─────────────────────────────────────────────────────────────────┐
│  HERO                                                           │
│  Title + Subtitle (poetic but clear)                           │
│  "What you'll learn" + "What you'll practice" (2 bullets each) │
└─────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│  THE INVITATION (50-100 words)                                  │
│  Lisa Marie's voice. Sets intention. No fluff.                 │
│  Ends with: "Here's what that looks like in practice."         │
└─────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│  WHAT [CONCEPT] ACTUALLY MEANS                                  │
│  - Plain language definition                                    │
│  - Sanskrit with pronunciation                                  │
│  - Historical context (1-2 sentences, not a lecture)           │
│  - "In practical terms..." bridge to modern life               │
└─────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│  WHY IT MATTERS (WITH QUIET SCIENCE)                           │
│  3-4 key points, each structured as:                           │
│    • Bold claim from experience                                │
│    • 1-2 sentences of what this looks like                     │
│    • [Research Note] sidebar—not leading, just supporting      │
└─────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│  TRY THIS: A [TIMEFRAME] PRACTICE                              │
│  Specific, doable action. Not "try meditating"—                │
│  "Sit for 3 minutes. Breathe. Notice what arrives."            │
│  Step-by-step, numbered, simple.                               │
└─────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│  GOING DEEPER (Optional)                                        │
│  - Common misunderstandings                                     │
│  - How this shows up in different styles                       │
│  - Questions to sit with                                        │
└─────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│  THIS WEEK                                                      │
│  One micro-practice per day, 7 days                            │
│  Simple. Progressive. Memorable.                                │
└─────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│  WHERE THIS CONNECTS                                            │
│  Links to related limbs, glossary terms, style pages           │
│  "If this resonates, explore..."                               │
└─────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│  FAQ (Schema-optimized)                                         │
│  3-5 real questions, direct answers                            │
└─────────────────────────────────────────────────────────────────┘
```

---

## Action Architecture

Every article has three layers of action:

| Layer | What It Is | Example |
|-------|-----------|---------|
| **Micro** | One thing to try right now | "Before reading further, take three slow breaths." |
| **Practice** | A 5-15 minute structured practice | "Try This: A 10-Minute Pranayama Sequence" |
| **Integration** | A week of small experiments | "This Week: 7 days of noticing your breath" |

The reader always leaves with something to *do*—not just something to *know*.

---

## How Science Integrates

Lisa Marie doesn't cite studies like an academic. But she doesn't ignore them either.

### In Main Text (Her Voice):

> "Breath practice calms the nervous system—not as metaphor, but as physiology. When you lengthen your exhale, you're sending a direct signal to your body that it's safe to rest."

### In Sidebar/Callout (Quiet Backup):

> *Research note: Extended exhales activate the parasympathetic nervous system via the vagus nerve. Studies show even 5 minutes of slow breathing reduces cortisol and heart rate variability markers of stress.*

### Principles:

- Science supports, never leads
- Skeptical readers see claims aren't made up
- Spiritual readers aren't drowned in data
- Everyone gets the action

---

## Sample Content

### Eight Limbs Hub Opening

```markdown
# The Eight Limbs of Yoga
## A Complete Framework for Practice—On the Mat and Off

**What you'll learn:** The full architecture of yoga—not just poses, but ethics,
breath, focus, and presence.

**What you'll practice:** A way of approaching your day that makes the mat just
one part of a larger, sustainable rhythm.

---

Most people discover yoga through asana—the physical postures. That's not wrong.
The body is a powerful doorway.

But asana is the third limb of eight. There's a whole framework underneath and
around it—one that addresses how you treat others, how you care for yourself,
how you breathe, how you focus, and what happens when all of that comes together.

This isn't about adding more to your plate. It's about recognizing what you're
likely already doing—and giving it structure, language, and depth.

The eight limbs aren't steps you climb and leave behind. They're more like
threads in a braid—distinct but interwoven, each one strengthening the others.

Here's the map. You're probably further along than you think.

**→ Try this before reading further:** Sit for 30 seconds. Notice your breath
without changing it. Notice your posture without fixing it. That's already
three limbs—asana, pranayama, and pratyahara—happening at once.
```

### "Why It Matters" Section (Pranayama Example)

```markdown
### Why Breath Practice Matters

**It changes your state faster than anything else you can do.**
When you're anxious, your breath is shallow and fast. When you're calm, it's
slow and deep. But the relationship works both ways—change the breath, and the
nervous system follows. This isn't visualization or positive thinking. It's mechanics.

> *Research note: Slow breathing (around 6 breaths per minute) has been shown
> to increase heart rate variability and activate parasympathetic response—
> measurable shifts in how your body processes stress.*

**It teaches you that you have influence over things that feel automatic.**
Most of the day, breath happens without your input. Pranayama is the practice
of stepping in—not to control obsessively, but to discover that agency exists.
What else in your life might respond to conscious attention?

**It prepares the mind for stillness.**
Meditation is hard when the breath is jagged. Ancient practitioners figured
this out—pranayama isn't separate from meditation, it's the bridge to it.
Settle the breath first; the mind will follow.

---

**→ Try this:** Right now, exhale slowly for a count of 6. Let the inhale
come naturally. Do this three times. Notice what shifts—even slightly.
```

### "This Week" Section (Ahimsa Example)

```markdown
### This Week: Seven Days with Ahimsa

You don't need to become a perfect person. You just need to notice.

| Day | Practice |
|-----|----------|
| **Monday** | Notice one moment when you speak harshly to yourself. Don't fix it—just notice. |
| **Tuesday** | Before reacting to frustration, pause for one breath. |
| **Wednesday** | Eat one meal slowly, with attention. Notice if you rush or criticize your choices. |
| **Thursday** | In conversation, listen without planning your response. |
| **Friday** | Move your body without pushing past discomfort. Find the edge, then back off 10%. |
| **Saturday** | Notice one moment of unnecessary criticism—of yourself, someone else, or the world. |
| **Sunday** | Sit quietly for 5 minutes. When harsh thoughts arise, meet them with "I see you." |

**What you're building:** Not perfection—awareness. Ahimsa starts with noticing
where harm hides in the ordinary.
```

---

## Content Specifications

| Element | Specification |
|---------|--------------|
| **Voice** | Lisa Marie—experiential, poetic, grounded |
| **Tone** | Invitational, never preachy; confident, never arrogant |
| **Science** | Supports claims quietly; sidebar or brief note, not leading |
| **Length** | Hub: 2,000-2,500 words / Individual limbs: 1,500-2,000 words |
| **Action layers** | Micro (now), Practice (10-15 min), Integration (weekly) |
| **Structure** | Scannable; clear headers; numbered steps for practices |
| **Internal links** | 5-8 per article; glossary terms, related limbs, styles |
| **Schema** | Article + FAQ + BreadcrumbList |
| **SEO** | Title 50-60 chars, Meta 150-160 chars |

---

## Connection Map: Eight Limbs to Existing Content

### Limb 1: Yama → Existing Content

| New Article | Links To |
|-------------|----------|
| Yama Overview | Glossary: Yama |
| Ahimsa | Glossary: Ahimsa |
| Satya | Glossary: Mantra (speaking truth) |
| All Yamas | Everyday Yoga glossary section |

### Limb 2: Niyama → Existing Content

| New Article | Links To |
|-------------|----------|
| Niyama Overview | Glossary: Niyama |
| Santosha | Glossary: Gratitude Practice |
| Tapas | Glossary: Sadhana |
| Svadhyaya | Glossary: Yoga Sutras (new) |
| Ishvara Pranidhana | Glossary: Bhakti, Om/Aum |

### Limb 3: Asana → Existing Content

| New Article | Links To |
|-------------|----------|
| Asana Overview | All 40 pose glossary terms |
| | All style pages (Vinyasa, Hatha, etc.) |
| | Yoga for Your Body series |

### Limb 4: Pranayama → Existing Content

| New Article | Links To |
|-------------|----------|
| Pranayama Overview | Glossary: Pranayama, Prana |
| | Glossary: Ujjayi, Kapalabhati, Nadi Shodhana |
| | Glossary: Bandhas |
| | Glossary: Breathwork |

### Limbs 5-8: Inner Practices → Existing Content

| New Article | Links To |
|-------------|----------|
| Pratyahara | Glossary: Meditation, Mindfulness, Drishti |
| | Glossary: Yoga Nidra, Restorative Yoga |
| Dharana | Glossary: Drishti, Mantra, Mudra, Japa |
| Dhyana | Glossary: Dhyana, Meditation |
| Samadhi | Glossary: Samadhi |

---

## New Glossary Terms Needed

These should be created to support the series:

### Philosophy (to complete Eight Limbs coverage)
- Pratyahara
- Dharana
- Yoga Sutras of Patanjali
- Satya
- Asteya
- Brahmacharya
- Aparigraha
- Saucha
- Santosha
- Tapas
- Svadhyaya
- Ishvara Pranidhana

### Poses (high SEO value, supports Asana limb)
- Pigeon Pose (Eka Pada Rajakapotasana)
- Tree Pose (Vrksasana)
- Cat-Cow (Marjaryasana-Bitilasana)
- Seated Forward Fold (Paschimottanasana)
- Happy Baby (Ananda Balasana)
- Legs Up the Wall (Viparita Karani)
- Crow Pose (Bakasana)

---

## Quality Checks

### The Lisa Test
Before publishing, ask: **Would Lisa Marie say this to a private student?**

If it sounds like:
- Marketing copy ❌
- Generic wellness content ❌
- Academic research paper ❌
- Fitness industry promotion ❌

Revise toward: **Sincerity, precision, and genuine invitation.**

### Action Check
Every article must answer:
- What can the reader do RIGHT NOW? (micro)
- What can they practice THIS WEEK? (integration)
- Where do they go NEXT? (connection)

### Science Check
- Does research support the claim? (verify)
- Is it in a sidebar, not leading? (placement)
- Does the reader still get the action without it? (independence)

---

## Next Steps

1. Draft Eight Limbs Hub article
2. Review and refine with brand voice check
3. Create HTML template for series
4. Build out Phase 1 content
5. Establish internal linking structure
6. Create supporting glossary terms as needed

---

*Last updated: January 2026*
*Series Owner: Lisa Marie (voice) / Eddie (strategy)*
