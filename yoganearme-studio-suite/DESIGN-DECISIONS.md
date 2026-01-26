# Virtual Marketing Department — Design Decisions

**Purpose:** Single source of truth for all product decisions. Updated in real-time as Eddie answers.

**Last Updated:** January 25, 2026

---

## 1. Architecture & Interaction

### 1.1 Primary Interaction Surface
**Question:** How do studio owners primarily interact with the Co-Pilot?

Options:
- **Dashboard-first** — Owner logs into web app, sees everything in one place
- **Notification-first** — Co-Pilot pushes alerts/tasks to owner (email, SMS, push)
- **Chat-first** — Owner talks to Maya via conversational interface
- **Hybrid** — Notification-first with dashboard for deeper dives

**Decision:** Hybrid — Notification-first with dashboard for deeper dives

**Rationale:** Aligns with Co-Pilot architecture in MRD. Owners don't want to log in and check dashboards — they want to be told what matters. Dashboard exists for when they want to dig deeper.

---

### 1.2 Autonomy Level
**Question:** How much should the Co-Pilot do without asking permission?

Options:
- **Suggest-only** — Co-Pilot recommends, owner executes everything
- **One-click approve** — Co-Pilot drafts, owner approves with one click
- **Auto-execute with notification** — Co-Pilot acts, owner gets notified after
- **Tiered** — Starts with suggest-only, earns autonomy over time (trust ladder)

**Decision:** Tiered — Starts with suggest-only, earns autonomy over time (trust ladder)

**Rationale:** Builds trust progressively. Week 1-4: suggest everything, owner approves. Month 2-3: auto-execute routine items. Month 4+: full partnership with owner involved only in strategy/exceptions. Aligns with AI Director Persona "Trust Ladder" framework.

---

### 1.3 Weekly Meeting Modality
**Question:** How does the weekly check-in happen?

Options:
- **Voice call** — Maya calls the owner (most human-feeling)
- **Video call** — Owner joins a video session with Maya avatar
- **Chat/text** — Async conversation via SMS or app
- **Email digest** — Weekly summary with action links
- **Hybrid** — Voice preferred, chat fallback

**Decision:** _Pending_

**Rationale:** _Pending_

---

### 1.4 Mobile vs Desktop Priority
**Question:** Where do owners primarily use this?

Options:
- **Mobile-first** — Design for phone, adapt to desktop
- **Desktop-first** — Design for web app, adapt to mobile
- **Equal priority** — Responsive design from day one

**Decision:** _Pending_

**Rationale:** _Pending_

---

## 2. Persona & Voice

### 2.1 Co-Pilot Name
**Question:** What is the AI Marketing Director called?

Options:
- **Maya** — Sanskrit for "illusion/magic," works across cultures
- **Custom per studio** — Owner chooses their own name
- **No name** — Just "Your Marketing Co-Pilot"
- **Other** — Suggest alternative

**Decision:** _Pending_

**Rationale:** _Pending_

---

### 2.2 Personality Style
**Question:** What's the Co-Pilot's communication style?

Options:
- **Warm & friendly** — Feels like a supportive friend
- **Professional & direct** — Business partner, no fluff
- **Data-driven & analytical** — Numbers-forward, insights-heavy
- **Calm & grounding** — Matches yoga studio vibe

**Decision:** _Pending_

**Rationale:** _Pending_

---

### 2.3 Proactivity Level
**Question:** How often does the Co-Pilot reach out unprompted?

Options:
- **Daily** — Morning briefing, end-of-day summary
- **Weekly** — Sunday Sprint + mid-week nudge
- **Only when urgent** — Negative review, at-risk student, competitor move
- **Owner-configured** — Let them choose frequency

**Decision:** _Pending_

**Rationale:** _Pending_

---

## 3. MVP Scope

### 3.1 MVP Pain Points
**Question:** Which pain points do we solve first? (Pick 3-4)

From MRD, ranked by urgency:
1. "Why don't people find me on Google?" — Marketing Audit
2. "I'm not getting enough reviews" — Review system
3. "Students disappear after first month" — Retention alerts
4. "I miss calls when I'm teaching" — AI Receptionist
5. "I don't know what to post on social" — Content suggestions
6. "I spend more time on admin than teaching" — Automation
7. "I can't fill off-peak classes" — Smart promotions
8. "Intro package students ghost" — Package follow-up
9. "I don't know what competitors are doing" — Competitive monitoring
10. "My photos look amateur" — Photo optimization

**Decision:** _Pending_

**Rationale:** _Pending_

---

### 3.2 Build Order
**Question:** Does this build order make sense?

Proposed:
1. Marketing Audit MVP (weeks 1-4)
2. Review Boost System (weeks 5-6)
3. Monitoring + Alerts (weeks 7-8)
4. Weekly Sprint UX (weeks 9-10)
5. GBP Optimizer (weeks 11-12)
6. Content Studio (weeks 13-14)
7. Photo Optimizer (weeks 15-16)
8. Retention Engine (weeks 17-20)
9. Smart Promotions (weeks 21-24)
10. 24/7 Front Desk / AI Receptionist (weeks 25+)

**Decision:** _Pending_

**Rationale:** _Pending_

---

### 3.3 Social Content
**Question:** Build our own social posting or integrate with existing tools?

Options:
- **Build** — Native social content creation and scheduling
- **Integrate** — Connect to Buffer, Later, Hootsuite, etc.
- **Skip for MVP** — Focus on GBP posts only, social comes later
- **Hybrid** — GBP native, social via integration

**Decision:** _Pending_

**Rationale:** _Pending_

---

### 3.4 Booking System Integration
**Question:** Which booking systems do we integrate with first?

Options:
- **MindBody** — Market leader, most studios use
- **WellnessLiving** — Growing competitor
- **Momoyoga** — Popular with smaller studios
- **Multiple from start** — MindBody + WellnessLiving + Momoyoga
- **None for MVP** — Manual data entry or CSV upload first

**Decision:** _Pending_

**Rationale:** _Pending_

---

## 4. Business Model

### 4.1 Pricing Tiers
**Question:** Are these tiers right?

Proposed:
| Tier | Name | Price | Includes |
|------|------|-------|----------|
| Starter | "Monitor" | $29/mo | Audit + Monitoring + Alerts |
| Visibility | "Growth Specialist" | $79/mo | Starter + Reviews + Content + Photos |
| Operations | "Front Desk" | $149/mo | AI Receptionist + Smart Promotions |
| Retention | "Student Keeper" | $49/mo | Retention Tracker + Package Follow-up |
| Full | "Complete Team" | $199/mo | Everything |

**Decision:** _Pending_

**Rationale:** _Pending_

---

### 4.2 Target Customer
**Question:** Yoga-only or expand to other verticals?

Options:
- **Yoga-only** — Focus, dominate, then expand
- **Yoga + Pilates + Barre** — Adjacent fitness (same booking systems)
- **All wellness** — Yoga, pilates, massage, acupuncture, etc.
- **Expandable architecture** — Build for yoga, design to add verticals later

**Decision:** _Pending_

**Rationale:** _Pending_

---

### 4.3 Launch Strategy
**Question:** How do we get first customers?

Options:
- **Directory-first** — Leverage 30,000 YogaNearMe listings
- **Score preview outreach** — Pre-compute scores, email studios
- **Partnership** — Co-launch with MindBody or similar
- **Paid acquisition** — Ads from day one
- **Combination** — Directory activation + score preview

**Decision:** _Pending_

**Rationale:** _Pending_

---

## 5. Weekly Sprint Feature

### 5.1 Gamification
**Question:** Add streaks, badges, or leaderboards?

Options:
- **Yes — full gamification** — Streaks, badges, leaderboards, achievements
- **Light gamification** — Completion streaks only
- **No gamification** — Keep it simple, professional
- **Test later** — Launch without, add based on feedback

**Decision:** _Pending_

**Rationale:** _Pending_

---

### 5.2 Team Support
**Question:** If studio has multiple users, who gets the Sprint?

Options:
- **Owner only** — Single user per studio
- **All users** — Everyone sees same Sprint
- **Assignable** — Owner assigns Sprint to specific team member
- **Role-based** — Marketing role gets Sprint, others don't

**Decision:** _Pending_

**Rationale:** _Pending_

---

### 5.3 Carry-Over
**Question:** If an action isn't completed, does it appear next week?

Options:
- **Yes, always** — Incomplete actions roll over
- **Yes, if still relevant** — Roll over only if action still valid
- **No** — Fresh Sprint each week
- **Owner choice** — Let them configure

**Decision:** _Pending_

**Rationale:** _Pending_

---

## 6. Technical

### 6.1 GBP Integration Method
**Question:** How do we connect to Google Business Profile?

Options:
- **Official API** — Full integration, requires Google approval
- **OAuth connection** — User authorizes, we read/write via API
- **Manual with guidance** — We draft, user copy-pastes
- **Hybrid** — OAuth for reading, manual for posting (lower risk)

**Decision:** _Pending_

**Rationale:** _Pending_

---

### 6.2 Voice AI Provider
**Question:** If we do voice meetings, which provider?

Options:
- **Retell.ai** — Purpose-built for voice AI agents
- **Vapi** — Another voice AI platform
- **ElevenLabs + custom** — Voice synthesis + our own logic
- **Skip voice for MVP** — Start with text/email only

**Decision:** _Pending_

**Rationale:** _Pending_

---

## Decision Log

| # | Question | Decision | Date | Notes |
|---|----------|----------|------|-------|
| 1 | 1.1 Interaction Surface | Hybrid (notification-first + dashboard) | 2026-01-25 | Per MRD Co-Pilot architecture |
| 2 | 1.2 Autonomy Level | Tiered (trust ladder) | 2026-01-25 | Progressive autonomy over time |

---

## How This Document Works

1. Eddie answers a question
2. I immediately update the **Decision** and **Rationale** fields
3. I add an entry to the **Decision Log** at the bottom
4. Document is always current

---
