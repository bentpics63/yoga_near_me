# Virtual Marketing Department
## Master Market Requirements Document (MRD) v1.0

**Product:** YogaNearMe Virtual Marketing Department
**Date:** January 24, 2026
**Version:** 1.0
**Status:** Draft
**Architecture:** Co-Pilot (AI-first orchestration layer)

---

## 1. Executive Summary

**Product:** A unified AI-powered marketing system that monitors, alerts, suggests, and executes marketing tasks for yoga studio owners—functioning as their "Virtual Marketing Department."

**Vision:** Make every yoga studio owner feel like they have a full-time marketing person on staff, for the cost of a class pack.

**Core Insight:** Studio owners are **"reluctant marketers."** They opened a studio to teach, not to manage SEO or respond to Google reviews. We don't sell them "software"—we give them back time to teach.

**Category Name:** "Virtual Marketing Department" or "Yoga Studio Marketing Department-in-a-Box"

**Strategic Model:** Diagnose → Prescribe → Fix → Monitor

---

## 2. The Reluctant Marketer Problem

### Who They Are

Studio owners who:
- Opened a studio to teach yoga, not run a business
- Have 2-5 hours per week for marketing (max)
- Feel overwhelmed by marketing jargon (Schema, LCP, SERPs)
- Are burned out on admin work
- Know they "should" do marketing but don't know where to start
- Have been exploited by Yelp, ClassPass, and agencies

### What They Need

Not more tools. They need:
- Someone to tell them **what to do first**
- Confidence they're doing the **right things**
- Tasks that fit into **small time windows**
- Proof that it's **working**
- Permission to **stop worrying**

### The Emotional Truth

> "I didn't open a yoga studio to stare at Google Analytics. I opened it to help people find their practice."

Our job: Give them back time on the mat by handling what happens off it.

---

## 3. The Co-Pilot Architecture

### What It Is

An AI-powered orchestration layer that:
- **Monitors** all marketing channels (GBP, reviews, website, social, competitors)
- **Alerts** owners to problems and opportunities
- **Suggests** prioritized actions with one-click execution
- **Executes** approved tasks automatically
- **Reports** on what's working

### How It Differs from "Tool Suite"

| Tool Suite Approach | Co-Pilot Approach |
|---------------------|-------------------|
| "Here are 10 apps" | "Here's what to do this week" |
| Owner decides what to use | AI decides what matters |
| Dashboard-heavy | Notification-first |
| Owner must check each tool | Co-Pilot surfaces what's urgent |
| Sells features | Sells outcomes |

### The "2-Hour Marketing Sprint"

The signature experience of the Co-Pilot:

```
┌─────────────────────────────────────────────────────────────┐
│  Your Marketing Sprint This Week                            │
│  Estimated time: 2 hours                                    │
├─────────────────────────────────────────────────────────────┤
│                                                              │
│  1. Respond to 3 new reviews                    [15 min]    │
│     ⭐ One is 2 stars — draft response ready                │
│     [Respond Now →]                                         │
│                                                              │
│  2. Post this to Instagram                      [10 min]    │
│     "Tuesday morning flow with Sarah..."                    │
│     [Preview & Post →]                                      │
│                                                              │
│  3. Send reminder to 4 intro package students   [5 min]     │
│     They haven't visited in 2 weeks                         │
│     [Review & Send →]                                       │
│                                                              │
│  ─────────────────────────────────────────────────────────  │
│                                                              │
│  [Start Sprint]              [Snooze This Week]             │
│                                                              │
└─────────────────────────────────────────────────────────────┘
```

This reframes marketing as: "Care for your community, consistently" — not "do SEO."

---

## 4. Pain Points Addressed

Based on customer research, ranked by urgency:

| Rank | Pain Point | Co-Pilot Solution |
|------|------------|-------------------|
| 1 | "Why don't people find me on Google?" | Marketing Audit + ongoing monitoring |
| 2 | "I'm not getting enough reviews" | Review requests + response drafts |
| 3 | "Students disappear after first month" | Retention alerts + re-engagement sequences |
| 4 | "I miss calls when I'm teaching" | AI Receptionist (24/7 Front Desk) |
| 5 | "I don't know what to post on social" | Content suggestions + scheduling |
| 6 | "I spend more time on admin than teaching" | Automation + 2-Hour Sprint |
| 7 | "I can't fill off-peak classes" | Smart promotions + targeted outreach |
| 8 | "Intro package students ghost" | Package follow-up automation |
| 9 | "I don't know what competitors are doing" | Competitive monitoring + alerts |
| 10 | "My photos look amateur" | Photo optimization + suggestions |

---

## 5. Product Components

The Virtual Marketing Department consists of these integrated components:

### Core (MVP)

| Component | Pain Points | Status |
|-----------|-------------|--------|
| **Marketing Audit** | #1 | PRD v1.0 |
| **Review System** | #2 | Exploration |
| **Monitoring + Alerts** | #9, #10 | Partial (in Visibility Optimizer) |
| **Weekly Sprint** | #6 | NEW - needs spec |

### Growth

| Component | Pain Points | Status |
|-----------|-------------|--------|
| **GBP Optimizer** | #1 | In Visibility Optimizer PRD |
| **Content Studio** | #5 | MISSING |
| **Photo Optimizer** | #10 | Exploration |

### Advanced

| Component | Pain Points | Status |
|-----------|-------------|--------|
| **Retention Engine** | #3, #8 | In Receptionist PRD |
| **Smart Promotions** | #7 | MISSING |
| **24/7 Front Desk** (AI Receptionist) | #4 | PRD v2.3 |

---

## 6. Pricing Structure

### Three Bundles + Full Department

| Tier | Name | Pain Points | Components | Price |
|------|------|-------------|------------|-------|
| **Starter** | "The Insurance Policy" | #1, #9 | Audit + Monitoring + Alerts | $29/mo |
| **Visibility** | "The Growth Specialist" | #1, #2, #5, #6, #9, #10 | Starter + Reviews + Content + Photos | $79/mo |
| **Operations** | "The Front Desk" | #4, #7 | 24/7 Receptionist + Smart Promotions | $149/mo |
| **Retention** | "The Student Keeper" | #3, #8 | Retention Tracker + Package Follow-up | $49/mo |
| **Full Department** | "The Complete Marketing Team" | All 10 | Everything | $199/mo |

### Bundle Logic

Studios can mix:
- Visibility + Retention = $128/mo (common combo)
- Operations + Retention = $198/mo (full service without content)
- Full Department = $199/mo (best value, all-in)

### Launch Pricing (First 100 Studios)

- All tiers: 40% off for 6 months
- Full Department: $119/mo (locked for 12 months if annual)

---

## 7. Go-To-Market Strategy

### Phase 1: Directory Activation (Owned Distribution)

**Tactic 1: Score Preview Outreach**

Pre-compute Marketing Health Scores for all 30,000 listings. Send automated teaser emails:

```
Subject: Your Studio's Marketing Health Score is 47/100

Hi [Name],

We analyzed [Studio Name]'s online presence and compared it to
the 12 other yoga studios in [Neighborhood].

Your score: 47/100 (Below average)

Top issue: You have 18 Google reviews. The neighborhood average is 47.
This is likely costing you $2,400/month in lost bookings.

[See Your Full Report →]

— YogaNearMe
```

**Tactic 2: Marketing Health Badge on Listings**

Every listing page displays a badge:

- **Claimed + connected:** "Marketing Health: 72/100 ✓"
- **Claimed, not connected:** "Marketing Health: Check your score →"
- **Unclaimed:** Blurred score — "This studio's marketing health is below city average. [Claim to see why →]"

This creates FOMO and drives claims using owned real estate.

### Phase 2: Authority Content

**"State of Yoga Marketing" Annual Report**

Using 30,000-studio data, publish:
- National benchmarks report
- City-specific reports ("The Los Angeles Yoga Report")
- Style-specific insights ("Hot Yoga Studio Marketing Trends")

**PR Goal:** Get cited in Yoga Journal, MindBody blog, industry publications. Position as "the McKinsey of Yoga Marketing."

**Pillar Content:**
- "Why Your Studio Doesn't Rank on Google (And How to Fix It)"
- "The Review Gap: How 29 More Reviews = 40% More Students"
- "The 2-Hour Marketing Week for Yoga Studio Owners"

### Phase 3: Partnership Marketing

**Positioning:** "You handle the booking; we handle the growth."

We are the **diagnostic layer** for booking platforms, not a competitor.

**Partnership Targets:**
- MindBody: Co-branded audit for new customers
- WellnessLiving: Integration partnership
- Momoyoga: White-label audit tool
- Yoga teacher trainings: Graduate toolkit

**Pitch:** "Your platform handles scheduling and payments. We handle the marketing that fills those classes."

### Phase 4: Paid Acquisition

Only after organic + partnerships are working:
- Retargeting directory visitors who didn't claim
- Lookalike audiences from converted studios
- "Below average marketing health" targeting

---

## 8. Build Order

Based on external evaluation consensus and strategic priorities:

| Phase | Component | Weeks | Rationale |
|-------|-----------|-------|-----------|
| **1** | Marketing Audit MVP | 1-4 | "Front door" — creates need for everything else |
| **2** | Review Boost System | 5-6 | Most visceral pain point, measurable results |
| **3** | Monitoring + Alerts | 7-8 | Creates subscription habit ($29/mo tier) |
| **4** | Weekly Sprint UX | 9-10 | The Co-Pilot signature experience |
| **5** | GBP Optimizer | 11-12 | High ROI, low complexity |
| **6** | Content Studio | 13-14 | Daily frustration solved |
| **7** | Photo Optimizer | 15-16 | Polish, completes Visibility tier |
| **8** | Retention Engine | 17-20 | Requires booking integration |
| **9** | Smart Promotions | 21-24 | Requires schedule + attendance data |
| **10** | 24/7 Front Desk | 25+ | Highest complexity, build last |

**Key Insight:** The AI Receptionist (24/7 Front Desk) has the most developed PRD, but should be built **last** due to:
- Higher support burden
- Requires stable customer base first
- Other components create pipeline for it

---

## 9. Competitive Positioning

### The "Missing Middle"

| Category | Examples | Problem |
|----------|----------|---------|
| **Free graders** | HubSpot, generic SEO tools | Generic, no yoga context, no action plan |
| **Enterprise tools** | SEMrush, Moz, BrightLocal | Expensive ($100-500/mo), overwhelming |
| **Agencies** | Local marketing agencies | $1,000-5,000/mo, overkill for small studios |

**YogaNearMe owns the gap:** Premium insight at accessible price, built for yoga.

### Our Moat

| Advantage | Why It Matters |
|-----------|----------------|
| **30,000 studio database** | Real competitor benchmarks no one else has |
| **Yoga-native intelligence** | Understands styles, levels, terminology |
| **Directory distribution** | Built-in lead generation |
| **Vertical focus** | Not trying to serve everyone |

### Positioning Statement

> "YogaNearMe Virtual Marketing Department: The marketing team you can't afford to hire, built specifically for yoga studios, powered by data from 30,000 studios across North America."

---

## 10. Success Metrics

### Product Metrics

| Metric | Target (Month 3) | Target (Month 12) |
|--------|------------------|-------------------|
| Free audits run | 2,000 | 15,000 |
| Audit → paid conversion | 10% | 15% |
| Weekly Sprint completion rate | 40% | 60% |
| Actions taken per week (paid users) | 3 | 5 |
| Marketing Health Score improvement | +15 points | +25 points |

### Business Metrics

| Metric | Target (Month 6) | Target (Month 12) |
|--------|------------------|-------------------|
| Paying studios | 200 | 1,000 |
| MRR | $20,000 | $120,000 |
| Monthly churn | <6% | <4% |
| NPS | >40 | >50 |
| LTV:CAC | 6:1 | 9:1 |

### Leading Indicators

- Audit page views → audit started: >50%
- Audit completed → email captured: >60%
- Email captured → paid within 30 days: >15%
- Paid → active after 90 days: >80%

---

## 11. Naming Conventions

### Product Names

| Internal Name | Customer-Facing Name |
|---------------|---------------------|
| AI Receptionist | **Your Studio's 24/7 Front Desk** |
| Visibility Report | **Marketing Health Score** |
| Visibility Optimizer | **Marketing Audit** |
| Retention Module | **Student Keeper** |
| Virtual Marketing Department | **YogaNearMe Marketing OS** |

### Tier Names

| Tier | Name | Tagline |
|------|------|---------|
| $29/mo | **Monitor** | "The insurance policy" |
| $79/mo | **Visibility** | "The growth specialist" |
| $149/mo | **Operations** | "The front desk" |
| $49/mo | **Retention** | "The student keeper" |
| $199/mo | **Full Department** | "The complete marketing team" |

---

## 12. Open Questions & Decisions

### Architecture

1. **Interaction surface:** Dashboard-first / Notification-first / Chat-first / Hybrid?
   - **Decision:** Hybrid — Notification-first with dashboard for deeper dives

2. **Autonomy level:** Suggest-only / One-click approve / Auto-execute with notification?
   - **Decision:** Tiered — Trust ladder. Suggest-only at start, earns autonomy over time.

3. **Co-Pilot persona:** Friendly / Professional / Data-driven?
   - **Decision:** _Pending_

### Scope

4. **MVP pain points:** Which 3-4 for V1?
   - **Decision:** _Pending_

5. **Build order:** Agree with Audit-first, Receptionist-last?
   - **Decision:** _Pending_

6. **Social content:** Build or integrate (Buffer, Later)?
   - **Decision:** _Pending_

### Business

7. **Pricing validation:** Are these tiers right?
   - **Decision:** _Pending_

8. **Target customer:** Yoga-only or expandable to pilates, barre, martial arts?
   - **Decision:** _Pending_

9. **Team resources:** Who's building? Timeline?
   - **Decision:** _Pending_

---

## 13. Document History

| Version | Date | Changes |
|---------|------|---------|
| v1.0 | Jan 24, 2026 | Initial draft incorporating external evaluation insights |

---

## Appendix A: External Evaluation Insights (Incorporated)

### From Evaluation 1 (Marketing Head)

- [x] "Reluctant marketers" framing
- [x] "Score Preview" proactive outreach
- [x] Three product bundles structure
- [x] Marketing Health Badge on listings
- [x] "State of Yoga Marketing" report concept
- [x] Partnership positioning as "diagnostic layer"
- [x] Tier naming (Insurance, Growth Specialist, etc.)
- [x] "Humanize the AI" — 24/7 Front Desk naming

### From Evaluation 2 (Development + Marketing)

- [x] "Diagnose → Prescribe → Fix → Monitor" framework
- [x] "2-Hour Marketing Sprint" concept
- [x] Build order recommendation (Audit first, Receptionist last)
- [x] "YogaNearMe Marketing OS" suite naming
- [x] Phased development timeline

---

## Appendix B: Related Documents

| Document | Location | Status |
|----------|----------|--------|
| Studio Visibility Report PRD | `products/studio-visibility-report/PRD.md` | v1.0 |
| Studio Visibility Report MRD | `products/studio-visibility-report/MRD.md` | v1.1 |
| AI Receptionist PRD | `products/ai-receptionist/PRD.md` | v2.3 |
| AI Receptionist MRD | `products/ai-receptionist/MRD.md` | v4.4 |
| Schedule Connect PRD | `products/schedule-connect/PRD.md` | v1.0 |
| Photo Optimizer | `products/photo-optimizer/EXPLORATION.md` | Exploration |
| Review Monitor | `products/review-monitor/EXPLORATION.md` | Exploration |
| Profit Calculator | `products/profit-calculator/EXPLORATION.md` | Exploration |
