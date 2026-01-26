# Product Requirements Document (PRD) v1.0

**Product:** YogaNearMe Studio Visibility Report
**Date:** January 24, 2026
**Version:** 1.0
**Status:** Draft
**Companion Document:** MRD v1.0

---

## 1. Vision & Strategic Role

### Vision

Show every yoga studio owner exactly what's broken in their online presence—for free, in 30 seconds—then offer to help fix it.

### Strategic Role

The Visibility Report is the **trust-building entry point** to the Studio Suite:

```
[Visibility Report] → [Claim Listing] → [Schedule Connect] → [AI Receptionist]
      FREE              FREE             FREE              $79/month
```

**Primary goal:** Build trust by demonstrating expertise and giving genuine value.
**Secondary goal:** Capture emails and drive listing claims.

---

## 2. User Experience

### 2.1 Entry Points

**A) Listing Page Widget**
On every studio listing page (claimed or unclaimed):
```
┌────────────────────────────────────┐
│  📊 Check Your Visibility         │
│  See how [Studio] appears in      │
│  local search                     │
│        [Run Free Audit →]         │
└────────────────────────────────────┘
```

**B) Dedicated Landing Page**
URL: `yoganearme.info/visibility` or `yoganearme.info/audit`

```
┌─────────────────────────────────────────────────────┐
│                                                     │
│     How Visible Is Your Yoga Studio?               │
│                                                     │
│  Most studios are invisible in local search.       │
│  Find out where you stand in 30 seconds.           │
│                                                     │
│  ┌─────────────────────────────────────────────┐   │
│  │ Enter your studio name or website URL       │   │
│  └─────────────────────────────────────────────┘   │
│              [Check My Visibility →]               │
│                                                     │
│  ✓ Free  ✓ Instant  ✓ No login required           │
│                                                     │
└─────────────────────────────────────────────────────┘
```

**C) Email Campaign Entry**
Direct link with pre-filled studio: `yoganearme.info/visibility?studio=studio-slug`

### 2.2 Input Flow

**Step 1: Studio Identification**

User enters:
- Studio name (fuzzy search against our 30K database), OR
- Website URL (we extract/match)

If match found in our database:
> "Found: [Studio Name] in [City, State]"
> [This is my studio] [Search again]

If no match:
> "We couldn't find [input] in our database."
> [Add this studio] [Search again]

**Step 2: Processing (10-15 seconds)**

Progressive loading with educational messaging:
```
┌─────────────────────────────────────────────────────┐
│                                                     │
│           Checking your visibility...              │
│                                                     │
│  ████████████░░░░░░░░                              │
│                                                     │
│  ✓ Finding your Google Business Profile            │
│  ◉ Checking your review presence...               │
│  ○ Analyzing your website basics                   │
│  ○ Comparing to nearby studios                     │
│                                                     │
│  Did you know?                                      │
│  76% of people who search for local yoga           │
│  visit a studio within 24 hours.                   │
│                                                     │
└─────────────────────────────────────────────────────┘
```

Messages rotate during loading:
- "89% of students research studios online before visiting."
- "Studios with 10+ photos get 35% more clicks."
- "Responding to reviews increases trust by 53%."

### 2.3 The Report

**Overall Score (Above the Fold)**

```
┌─────────────────────────────────────────────────────┐
│                                                     │
│           [STUDIO NAME]                            │
│           [City, State]                            │
│                                                     │
│              VISIBILITY SCORE                      │
│                                                     │
│                  67                                 │
│                ─────                                │
│                 100                                 │
│                                                     │
│        ████████████████░░░░░░░░                    │
│                                                     │
│      "Good foundation, but you're                  │
│       missing 3 quick wins"                        │
│                                                     │
│  ┌─────────────────────────────────────────────┐   │
│  │ 📧 Email me the full report               │   │
│  │    [your@email.com          ] [Send →]    │   │
│  └─────────────────────────────────────────────┘   │
│                                                     │
│           [See Full Breakdown ↓]                   │
│                                                     │
└─────────────────────────────────────────────────────┘
```

**Score Interpretation:**

| Range | Label | Color | Message |
|-------|-------|-------|---------|
| 0-40 | Needs Attention | Red | "Your studio is hard to find online. Let's fix that." |
| 41-60 | Getting There | Orange | "You have a foundation. A few fixes will help a lot." |
| 61-80 | Good | Yellow | "Good foundation, but you're missing some quick wins." |
| 81-90 | Strong | Light Green | "You're ahead of most studios. Fine-tune to stand out." |
| 91-100 | Excellent | Green | "You're a visibility leader. Keep it up!" |

---

## 3. Scoring Algorithm

### 3.1 Categories and Weights

| Category | Weight | Max Points |
|----------|--------|------------|
| Google Business Profile | 40% | 40 |
| Reviews | 25% | 25 |
| Website | 20% | 20 |
| YogaNearMe Listing | 15% | 15 |
| **Total** | **100%** | **100** |

### 3.2 Google Business Profile (40 points)

| Factor | Points | Scoring |
|--------|--------|---------|
| Profile exists | 10 | Yes = 10, No = 0 |
| Photos | 8 | 0 photos = 0, 1-4 = 3, 5-9 = 5, 10+ = 8 |
| Hours listed | 5 | Complete = 5, Partial = 2, None = 0 |
| Description | 5 | 150+ chars = 5, 50-149 = 3, <50 = 0 |
| Categories | 5 | Primary = yoga = 5, Related = 3, Other = 0 |
| Recent posts (30 days) | 4 | 2+ = 4, 1 = 2, 0 = 0 |
| Phone/website listed | 3 | Both = 3, One = 1, Neither = 0 |

### 3.3 Reviews (25 points)

| Factor | Points | Scoring |
|--------|--------|---------|
| Rating | 10 | 4.5+ = 10, 4.0-4.4 = 7, 3.5-3.9 = 4, <3.5 = 0 |
| Review count | 8 | 50+ = 8, 25-49 = 6, 10-24 = 4, 5-9 = 2, <5 = 0 |
| Recent reviews (90 days) | 5 | 5+ = 5, 2-4 = 3, 1 = 1, 0 = 0 |
| Owner response rate | 2 | 80%+ = 2, 50-79% = 1, <50% = 0 |

### 3.4 Website (20 points)

| Factor | Points | Scoring |
|--------|--------|---------|
| Mobile-friendly | 6 | Pass = 6, Fail = 0 |
| Load speed | 6 | <3s = 6, 3-5s = 3, >5s = 0 |
| HTTPS | 4 | Yes = 4, No = 0 |
| Has schema markup | 4 | LocalBusiness = 4, Any = 2, None = 0 |

### 3.5 YogaNearMe Listing (15 points)

| Factor | Points | Scoring |
|--------|--------|---------|
| Claimed | 5 | Yes = 5, No = 0 |
| Profile completeness | 5 | 80%+ = 5, 50-79% = 3, <50% = 1 |
| Schedule connected | 3 | Yes = 3, No = 0 |
| Photos on listing | 2 | 3+ = 2, 1-2 = 1, 0 = 0 |

---

## 4. Report Sections (Detail View)

### Section 1: Google Business Profile

```
┌─────────────────────────────────────────────────────┐
│  📍 GOOGLE BUSINESS PROFILE                   28/40 │
├─────────────────────────────────────────────────────┤
│                                                     │
│  ✅ Profile found                           +10    │
│  ⚠️  Only 3 photos (10+ recommended)         +3/8  │
│  ✅ Hours complete                           +5    │
│  ⚠️  Description too short (47 chars)       +0/5  │
│  ✅ Category: Yoga Studio                    +5    │
│  ❌ No posts in last 30 days                 +0/4  │
│  ✅ Phone and website listed                 +3    │
│                                                     │
│  ┌───────────────────────────────────────────────┐ │
│  │ 🎯 QUICK WIN                                  │ │
│  │                                               │ │
│  │ Add 7 more photos to your Google profile.    │ │
│  │ Studios with 10+ photos get 35% more clicks. │ │
│  │                                               │ │
│  │ [How to add photos →]                        │ │
│  └───────────────────────────────────────────────┘ │
│                                                     │
└─────────────────────────────────────────────────────┘
```

### Section 2: Reviews

```
┌─────────────────────────────────────────────────────┐
│  ⭐ REVIEWS                                   18/25 │
├─────────────────────────────────────────────────────┤
│                                                     │
│  Your Rating        4.2 ⭐              +7/10      │
│  Total Reviews      23                   +4/8       │
│  Recent (90 days)   2                    +1/5       │
│  Response Rate      30%                  +0/2       │
│                                                     │
│  Compared to nearby studios:                        │
│  ┌───────────────────────────────────────────────┐ │
│  │ Your avg: 4.2 ⭐ (23)                         │ │
│  │ Area avg: 4.4 ⭐ (47)                         │ │
│  └───────────────────────────────────────────────┘ │
│                                                     │
│  You have 4 unanswered reviews.                    │
│                                                     │
│  ┌───────────────────────────────────────────────┐ │
│  │ 🎯 QUICK WIN                                  │ │
│  │                                               │ │
│  │ Respond to your 4 unanswered reviews.         │ │
│  │ This shows students you care—and Google       │ │
│  │ considers responses when ranking.             │ │
│  │                                               │ │
│  │ [Open Google Business Profile →]             │ │
│  └───────────────────────────────────────────────┘ │
│                                                     │
└─────────────────────────────────────────────────────┘
```

### Section 3: Website

```
┌─────────────────────────────────────────────────────┐
│  🌐 WEBSITE                                   13/20 │
├─────────────────────────────────────────────────────┤
│                                                     │
│  ✅ Mobile-friendly                          +6    │
│  ⚠️  Loads in 4.2 seconds (slow)            +3/6  │
│  ✅ HTTPS secure                             +4    │
│  ❌ No LocalBusiness schema                  +0/4  │
│                                                     │
│  ┌───────────────────────────────────────────────┐ │
│  │ 🎯 QUICK WIN                                  │ │
│  │                                               │ │
│  │ Add LocalBusiness schema to your homepage.   │ │
│  │ This helps Google understand your studio     │ │
│  │ and can improve your appearance in search.   │ │
│  │                                               │ │
│  │ [Learn about schema →]                       │ │
│  └───────────────────────────────────────────────┘ │
│                                                     │
└─────────────────────────────────────────────────────┘
```

### Section 4: YogaNearMe Listing

```
┌─────────────────────────────────────────────────────┐
│  🧘 YOGANEARME LISTING                         3/15 │
├─────────────────────────────────────────────────────┤
│                                                     │
│  ❌ Not claimed                              +0/5  │
│  ⚠️  Profile 15% complete                   +1/5  │
│  ❌ Schedule not connected                   +0/3  │
│  ✅ 2 photos                                 +1/2  │
│                                                     │
│  Your listing exists, but you're not in control.   │
│  Anyone could be seeing outdated information.      │
│                                                     │
│  ┌───────────────────────────────────────────────┐ │
│  │ 🎯 QUICK WIN                                  │ │
│  │                                               │ │
│  │ Claim your free listing to:                  │ │
│  │ • Control your studio information            │ │
│  │ • Add photos and your schedule               │ │
│  │ • Respond to reviews                         │ │
│  │ • Appear higher in YogaNearMe search         │ │
│  │                                               │ │
│  │ [Claim My Free Listing →]                    │ │
│  └───────────────────────────────────────────────┘ │
│                                                     │
└─────────────────────────────────────────────────────┘
```

### Section 5: Competitor Snapshot

```
┌─────────────────────────────────────────────────────┐
│  📊 NEARBY STUDIOS                                  │
├─────────────────────────────────────────────────────┤
│                                                     │
│  Within 3 miles of your location:                  │
│                                                     │
│  1. Yoga Studio A      4.8 ⭐ (142)   Claimed ✓   │
│  2. Yoga Studio B      4.6 ⭐ (89)    Claimed ✓   │
│  ─────────────────────────────────────────────────  │
│  3. YOUR STUDIO        4.2 ⭐ (23)    ❌          │
│  ─────────────────────────────────────────────────  │
│  4. Yoga Studio C      4.1 ⭐ (31)    ❌          │
│                                                     │
│  2 of 3 nearby studios have claimed their          │
│  YogaNearMe listings and have more reviews.        │
│                                                     │
└─────────────────────────────────────────────────────┘
```

---

## 5. Call-to-Action Section

```
┌─────────────────────────────────────────────────────┐
│                                                     │
│      Ready to Improve Your Score?                  │
│                                                     │
│  Claiming your free YogaNearMe listing is the      │
│  fastest way to boost your visibility:             │
│                                                     │
│  ✓ Control your studio information                 │
│  ✓ Add photos that attract students                │
│  ✓ Connect your schedule (students see classes)    │
│  ✓ Respond to reviews from one dashboard           │
│  ✓ Appear higher in YogaNearMe search              │
│                                                     │
│          ┌─────────────────────────────┐           │
│          │  Claim My Free Listing →   │           │
│          └─────────────────────────────┘           │
│                                                     │
│  Already claimed?  [Log in to improve your score]  │
│                                                     │
│  ─────────────────────────────────────────────────  │
│                                                     │
│  📧 Get this report emailed to you                 │
│  [your@email.com              ] [Send Report →]    │
│                                                     │
└─────────────────────────────────────────────────────┘
```

---

## 6. Email Capture

### When to Ask

**Option A: Upfront Gate (Higher capture, lower completion)**
Require email before showing full report.

**Option B: Post-Report (Lower capture, better UX)**
Show full report, offer email for PDF version.

**Recommendation:** Option B (Post-Report)

Trust is the goal. Gating the report feels like the bait-and-switch tactics studios hate. Instead:
- Show full report freely
- Offer email for PDF + "personalized improvement tips"
- Capture email on claim flow anyway

### Email Content

**Subject:** Your [Studio Name] Visibility Report

**Body:**
```
Hi [Name],

Here's your Visibility Report for [Studio Name].

SCORE: 67/100 — Good Foundation

TOP 3 QUICK WINS:
1. Add 7 more photos to Google (+5 points)
2. Respond to 4 unanswered reviews (+2 points)
3. Claim your YogaNearMe listing (+5 points)

[View Full Report →]

Want to fix these issues? Claim your free listing:
[Claim Listing →]

— The YogaNearMe Team
```

---

## 7. Technical Architecture

### 7.1 System Flow

```
┌──────────┐     ┌──────────┐     ┌──────────┐     ┌──────────┐
│  User    │────▶│  Input   │────▶│  Match   │────▶│  Fetch   │
│  Entry   │     │  Handler │     │  Studio  │     │  Data    │
└──────────┘     └──────────┘     └──────────┘     └──────────┘
                                        │                │
                                        ▼                ▼
                                  ┌──────────┐     ┌──────────┐
                                  │  YNM DB  │     │  APIs    │
                                  │ (30K+)   │     │ (Google, │
                                  └──────────┘     │ PSI)     │
                                                   └──────────┘
                                        │                │
                                        ▼                ▼
                                  ┌─────────────────────────┐
                                  │    Scoring Engine       │
                                  │   (Calculate Score)     │
                                  └─────────────────────────┘
                                              │
                                              ▼
                                  ┌─────────────────────────┐
                                  │    Report Generator     │
                                  │   (Render UI/PDF)       │
                                  └─────────────────────────┘
```

### 7.2 Data Sources

| Source | Endpoint | Data Retrieved | Rate Limit |
|--------|----------|----------------|------------|
| Google Places API | Place Details | Rating, reviews, photos, hours, description | 1000/day (Essentials) |
| Google PageSpeed Insights | v5 API | Mobile score, load time, HTTPS | 25,000/day (free) |
| YogaNearMe Database | Internal | Listing status, completeness, claim status | N/A |
| Google Places API | Nearby Search | Competitor studios within radius | Included above |

### 7.3 API Integration

**Google Places API:**
```javascript
// Place Details request
const placeDetails = await googlePlaces.getDetails({
  place_id: studio.google_place_id,
  fields: [
    'rating',
    'user_ratings_total',
    'reviews',
    'photos',
    'opening_hours',
    'formatted_phone_number',
    'website',
    'business_status'
  ]
});
```

**PageSpeed Insights API:**
```javascript
// PageSpeed request
const psi = await fetch(
  `https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=${studioUrl}&strategy=mobile`
);
const { lighthouseResult } = await psi.json();
```

### 7.4 Caching Strategy

| Data | Cache Duration | Reason |
|------|----------------|--------|
| Google Places (rating, photos) | 24 hours | Doesn't change frequently |
| PageSpeed scores | 7 days | Website changes are rare |
| YNM listing data | Real-time | Our own data, always fresh |
| Competitor data | 24 hours | Same as Google Places |

### 7.5 Cost Projections

| Volume (audits/month) | Google Places | PageSpeed | Total |
|-----------------------|---------------|-----------|-------|
| 500 | $8.50 | $0 | $8.50 |
| 1,000 | $17 | $0 | $17 |
| 5,000 | $85 | $0 | $85 |
| 10,000 | $170 | $0 | $170 |

*Based on $0.017/Place Details request. PageSpeed is free up to 25K/day.*

---

## 8. Database Schema

### New Tables

```sql
-- Audit requests
CREATE TABLE visibility_audits (
  id UUID PRIMARY KEY,
  studio_id UUID REFERENCES studios(id),
  created_at TIMESTAMP DEFAULT NOW(),

  -- Input
  input_type VARCHAR(20), -- 'name_search', 'url', 'listing_click'
  input_value TEXT,

  -- Scores
  total_score INTEGER,
  gbp_score INTEGER,
  reviews_score INTEGER,
  website_score INTEGER,
  ynm_score INTEGER,

  -- Raw data (JSON for flexibility)
  gbp_data JSONB,
  psi_data JSONB,
  competitors_data JSONB,

  -- Conversion tracking
  email_captured VARCHAR(255),
  claim_clicked BOOLEAN DEFAULT FALSE,
  claimed_after BOOLEAN DEFAULT FALSE
);

-- Audit events (for funnel analysis)
CREATE TABLE audit_events (
  id UUID PRIMARY KEY,
  audit_id UUID REFERENCES visibility_audits(id),
  event_type VARCHAR(50), -- 'started', 'completed', 'email_entered', 'cta_clicked', 'claimed'
  created_at TIMESTAMP DEFAULT NOW(),
  metadata JSONB
);
```

---

## 9. Edge Cases

| Scenario | Handling |
|----------|----------|
| Studio not in YNM database | Offer to add; show partial report (GBP + website only) |
| No Google Business Profile found | Score GBP section as 0; explain how to create one |
| No website | Score website section as 0; suggest creating one |
| Multiple Google results for name | Show disambiguation UI; let user select |
| Studio is permanently closed | Show message; don't generate report |
| API rate limit hit | Queue request; show "Report generating..." with email delivery |
| API timeout | Retry once; if fail, show partial report + "Some data unavailable" |

---

## 10. Mobile Responsiveness

Report must work on mobile (60%+ of traffic).

**Key adaptations:**
- Single column layout
- Sections stack vertically
- Score visualization shrinks but remains prominent
- CTAs are full-width buttons
- Competitor table becomes cards

---

## 11. Analytics & Tracking

### Events to Track

| Event | Trigger | Data |
|-------|---------|------|
| `audit_page_view` | Page load | source, studio_id (if prefilled) |
| `audit_started` | User clicks "Check Visibility" | input_type, input_value |
| `audit_completed` | Report rendered | total_score, all section scores |
| `email_entered` | Email submitted | email (hashed) |
| `cta_clicked` | Claim button clicked | button_location |
| `claim_completed` | Studio claimed | time_from_audit |

### Dashboards

**Product Dashboard:**
- Audits/day, week, month
- Completion rate (started → finished)
- Average score distribution
- Top "quick wins" shown

**Business Dashboard:**
- Email capture rate
- Audit → claim conversion
- Claim → Schedule Connect conversion
- Revenue attribution (claim → receptionist)

---

## 12. Marketing Health Badge (Directory Integration)

### Purpose

Display Marketing Health Scores directly on YogaNearMe listing pages to:
- Drive audit engagement from directory traffic
- Create FOMO for unclaimed listings
- Demonstrate value of claimed/connected listings

### Badge States

**State 1: Claimed + Audited (Score Available)**

```
┌─────────────────────────────────────┐
│  Marketing Health: 72/100 ✓        │
│  [See Full Report →]               │
└─────────────────────────────────────┘
```

- Shows actual score with checkmark
- Links to full audit report
- Green/yellow/red coloring based on score range

**State 2: Claimed, Not Yet Audited**

```
┌─────────────────────────────────────┐
│  Marketing Health: Check Score →   │
│  Free instant audit                │
└─────────────────────────────────────┘
```

- Prompts studio owner to run audit
- Links to audit tool with studio pre-filled

**State 3: Unclaimed Listing**

```
┌─────────────────────────────────────┐
│  Marketing Health: ██/100          │
│  Below city average                │
│  [Claim to See Score →]            │
└─────────────────────────────────────┘
```

- Score is blurred/hidden
- Shows "Below city average" or "Above city average" hint
- Links to claim flow
- Creates FOMO without revealing full data

### Placement

- Sidebar on desktop listing pages
- Accordion section on mobile
- Always visible above the fold

### Pre-Computation

To enable instant badge display:
1. Pre-compute Marketing Health Scores for all 30,000 listings
2. Cache scores with 7-day refresh
3. Show cached score; offer "Refresh Score" for real-time update
4. Flag stale scores (>30 days) with "Score may be outdated"

---

## 13. Score Preview Outreach Campaign

### Purpose

Proactively email studios in the directory with their Marketing Health Score preview to drive audits and claims.

### Email Sequence

**Email 1: Score Teaser (Unclaimed Listings)**

```
Subject: Your Studio's Marketing Health Score is 47/100

Hi [Studio Name],

We analyzed your online presence and compared it to the
[X] other yoga studios in [Neighborhood].

Your score: 47/100 (Below average)

Top issue found:
You have 18 Google reviews. The neighborhood average is 47.
This gap is likely costing you students.

[See Your Full Report →]

This is free. No login required. Takes 30 seconds.

— YogaNearMe
```

**Email 2: Competitor Context (3 days later, if no action)**

```
Subject: 2 studios near you are outranking you on Google

Hi [Studio Name],

We noticed [Competitor A] and [Competitor B] have claimed their
YogaNearMe listings and optimized their marketing.

They're showing up when students search for yoga in [Neighborhood].
You're not.

Your Marketing Health: 47/100
Their average: 71/100

[See What They're Doing Right →]

— YogaNearMe
```

**Email 3: Action-Focused (7 days later, if no action)**

```
Subject: 3 fixes that would boost your score to 65+

Hi [Studio Name],

Based on your Marketing Health audit, here are 3 quick wins:

1. Add 7 more photos to Google (15 min) → +8 points
2. Respond to your 4 unanswered reviews (10 min) → +5 points
3. Claim your YogaNearMe listing (5 min) → +5 points

Total time: 30 minutes
New score: ~65/100 (Above average)

[Get Your Action Plan →]

— YogaNearMe
```

### Targeting

- **Priority 1:** Studios with scores <50 (biggest improvement opportunity)
- **Priority 2:** Studios in competitive neighborhoods (most urgency)
- **Priority 3:** Studios with recent competitor claims (FOMO trigger)

### Volume

- Initial batch: 5,000 studios (test messaging)
- Scale to full 30,000 over 4 weeks
- Respect 1 email/week max frequency

---

## 15. Launch Phases

### Phase 1: Internal Testing (Week 1)
- Build with mock data
- Test all scoring scenarios
- QA on mobile and desktop

### Phase 2: Soft Launch (Week 2)
- Deploy to subset of listings (100 studios)
- Manual outreach for feedback
- Fix bugs, calibrate scoring

### Phase 3: Listing Integration (Week 3)
- Add widget to all listing pages
- Enable search on landing page
- Set up email sequences

### Phase 4: Marketing Push (Week 4+)
- Email campaign to unclaimed listings
- Blog content about visibility
- Social media promotion

---

## 16. Success Criteria (MVP)

### Must Have (Launch Blockers)
- [ ] Audit completes in <20 seconds
- [ ] Score is accurate (validated against 50 manual checks)
- [ ] Report renders correctly on mobile
- [ ] Email capture works
- [ ] Claim CTA leads to correct listing
- [ ] No API errors in 95% of audits

### Should Have (First Month)
- [ ] Pre-fill studio from listing page
- [ ] Competitor comparison
- [ ] PDF export
- [ ] Basic email follow-up sequence

### Nice to Have (V2)
- [ ] Score history tracking
- [ ] Automated improvement alerts
- [ ] Social media presence checks
- [ ] Review sentiment analysis

---

## 17. Open Technical Questions

1. **Google Place ID matching:** How do we reliably match our listings to Google Place IDs? Manual mapping or API-based?

2. **Rate limiting:** Should we rate-limit audits per IP to prevent abuse? (Competitor scraping, API cost protection)

3. **Pre-generation:** Should we pre-generate and cache reports for all 30K studios to enable instant display + proactive outreach?

4. **A/B testing:** How do we test different scoring weights and CTA copy?

---

## Document History

| Version | Date | Changes |
|---------|------|---------|
| v1.1 | Jan 24, 2026 | Added Marketing Health Badge spec, Score Preview Outreach campaign |
| v1.0 | Jan 24, 2026 | Initial draft |
