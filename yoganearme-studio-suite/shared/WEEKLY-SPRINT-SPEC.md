# 2-Hour Marketing Sprint
## Feature Specification v1.0

**Feature:** Weekly Marketing Sprint
**Date:** January 24, 2026
**Version:** 1.0
**Status:** Draft
**Parent:** Virtual Marketing Department (Co-Pilot)

---

## 1. Overview

### What It Is

The Weekly Marketing Sprint is the signature experience of the YogaNearMe Co-Pilot. Every week, the system analyzes the studio's marketing health and surfaces the **top 3 most impactful actions** that can be completed in approximately **2 hours total**.

### Why It Matters

Studio owners are "reluctant marketers" with limited time. They don't want to:
- Figure out what to do
- Decide what's most important
- Spend hours on marketing

The Sprint reframes marketing from "overwhelming obligation" to "2 hours of caring for your community."

### The Promise

> "We analyzed your studio this week. Here are the 3 things that will make the biggest difference. Total time: 2 hours."

---

## 2. User Experience

### 2.1 Sprint Delivery

**When:** Every Sunday evening (configurable)

**How:**
- Push notification (mobile)
- Email digest
- Dashboard banner

**Notification:**
```
Your Marketing Sprint is ready

3 actions · ~2 hours · Biggest impact this week

[Start Sprint →]
```

### 2.2 Sprint Dashboard

```
┌─────────────────────────────────────────────────────────────┐
│  Your Marketing Sprint                                       │
│  Week of January 20-26                                      │
├─────────────────────────────────────────────────────────────┤
│                                                              │
│  This week's focus: Reviews & Visibility                    │
│  Estimated time: 1 hour 45 minutes                          │
│                                                              │
│  ─────────────────────────────────────────────────────────  │
│                                                              │
│  1. RESPOND TO 3 NEW REVIEWS                    [35 min]    │
│     ⭐⭐⭐⭐⭐ "Amazing class with Sarah!"                    │
│     ⭐⭐⭐⭐⭐ "Best studio in the neighborhood"              │
│     ⭐⭐ "Class was too crowded" ← Priority                  │
│                                                              │
│     Why this matters: You have a 2-star review without      │
│     a response. Responding shows potential students you     │
│     care and can turn a negative into a positive.           │
│                                                              │
│     [Respond to Reviews →]                                  │
│                                                              │
│  ─────────────────────────────────────────────────────────  │
│                                                              │
│  2. POST TO GOOGLE BUSINESS PROFILE             [20 min]    │
│     You haven't posted in 18 days.                          │
│                                                              │
│     Suggested post (edit or use as-is):                     │
│     "New to yoga? Our Gentle Basics class every Tuesday     │
│     at 10am is perfect for beginners. No experience         │
│     needed. [Book your first class →]"                      │
│                                                              │
│     Why this matters: Studios that post weekly get          │
│     23% more profile views.                                 │
│                                                              │
│     [Post This →] [Edit First →]                            │
│                                                              │
│  ─────────────────────────────────────────────────────────  │
│                                                              │
│  3. SEND REMINDER TO 4 INTRO STUDENTS           [15 min]    │
│     These students bought intro packages 2+ weeks ago       │
│     and haven't returned:                                   │
│                                                              │
│     • Sarah M. — 2 classes left, last visit Jan 8          │
│     • Mike T. — 3 classes left, last visit Jan 5           │
│     • Lisa K. — 1 class left, expires Jan 28               │
│     • James R. — 4 classes left, last visit Jan 3          │
│                                                              │
│     Suggested message:                                      │
│     "Hi [Name], we noticed you still have [X] classes       │
│     on your intro package. We'd love to see you back!       │
│     Here's this week's schedule: [link]"                    │
│                                                              │
│     Why this matters: 60% of intro students who don't       │
│     return within 2 weeks never come back.                  │
│                                                              │
│     [Review & Send →]                                       │
│                                                              │
│  ─────────────────────────────────────────────────────────  │
│                                                              │
│  [Start Sprint]                    [Snooze This Week]       │
│                                                              │
│  ─────────────────────────────────────────────────────────  │
│                                                              │
│  Last week: You completed 2/3 actions                       │
│  Your Marketing Health improved: 67 → 71 (+4)               │
│                                                              │
└─────────────────────────────────────────────────────────────┘
```

### 2.3 Action Execution Flow

When user clicks an action:

**Review Response Flow:**
1. Show review with AI-drafted response
2. User edits or approves
3. One-click post to Google (if GBP connected)
4. Mark action complete

**GBP Post Flow:**
1. Show suggested post with image options
2. User edits or approves
3. One-click post to GBP
4. Mark action complete

**Student Outreach Flow:**
1. Show student list with suggested message
2. User selects recipients and edits message
3. Preview SMS/email
4. One-click send
5. Mark action complete

### 2.4 Completion States

**All Actions Complete:**
```
┌─────────────────────────────────────────────────────────────┐
│  Sprint Complete! 🎯                                         │
│                                                              │
│  You finished this week's marketing in 1 hour 32 minutes.   │
│                                                              │
│  What you accomplished:                                     │
│  ✓ Responded to 3 reviews (including 1 negative)           │
│  ✓ Posted to Google Business Profile                       │
│  ✓ Re-engaged 4 intro students                             │
│                                                              │
│  Projected impact:                                          │
│  • +5 points to Marketing Health Score                      │
│  • 4 students reminded about unused classes                 │
│  • 1 negative review addressed                              │
│                                                              │
│  See you next Sunday with your next Sprint.                 │
│                                                              │
│  [View Marketing Health →]                                  │
└─────────────────────────────────────────────────────────────┘
```

**Partial Completion:**
```
┌─────────────────────────────────────────────────────────────┐
│  Sprint: 2/3 Complete                                        │
│                                                              │
│  ✓ Responded to reviews                                     │
│  ✓ Posted to GBP                                            │
│  ○ Student outreach (skipped)                               │
│                                                              │
│  [Finish Remaining Action]  [Mark Sprint Done]              │
└─────────────────────────────────────────────────────────────┘
```

**Snoozed:**
```
┌─────────────────────────────────────────────────────────────┐
│  Sprint Snoozed                                              │
│                                                              │
│  No worries — we'll check in next week.                     │
│                                                              │
│  If you have 15 minutes, the most important action is:      │
│  → Respond to your 2-star review                            │
│                                                              │
│  [Do Just This One →]                                       │
└─────────────────────────────────────────────────────────────┘
```

---

## 3. Action Prioritization Algorithm

### 3.1 Action Categories

| Category | Action Types | Typical Time |
|----------|--------------|--------------|
| **Reviews** | Respond to new reviews, request reviews | 5-15 min each |
| **Content** | GBP posts, social posts, photo uploads | 10-20 min each |
| **Outreach** | Student reminders, win-back messages, lead follow-up | 10-15 min each |
| **Optimization** | Update hours, add photos, fix NAP | 5-10 min each |
| **Competitive** | Respond to competitor moves | 10-15 min |

### 3.2 Prioritization Factors

Each potential action is scored on:

| Factor | Weight | Description |
|--------|--------|-------------|
| **Urgency** | 30% | Time-sensitive (negative review, expiring package) |
| **Impact** | 30% | Expected improvement to Marketing Health Score |
| **Effort** | 20% | Inverse of time required (quick wins preferred) |
| **Recency** | 10% | How long since this type of action was taken |
| **Readiness** | 10% | Is data/content ready (draft available, students identified) |

### 3.3 Action Scoring Examples

**High Priority (Score 85+):**
- Unanswered negative review (2 stars or below)
- Intro student with expiring package (< 7 days)
- No GBP post in 21+ days
- Competitor gained 10+ reviews this month

**Medium Priority (Score 60-84):**
- Unanswered positive reviews (3+ days old)
- Students with unused package classes (2+ weeks inactive)
- GBP post opportunity (event, holiday, new class)
- Photo count below competitor average

**Lower Priority (Score <60):**
- Routine review requests
- Social content when GBP is current
- Minor profile optimizations

### 3.4 Sprint Composition Rules

1. **Max 3 actions per Sprint** (keeps it achievable)
2. **Total time target: 2 hours** (adjust action count if needed)
3. **At least 1 high-priority action** if any exist
4. **Variety:** Don't repeat same action type 3 weeks in a row
5. **Respect user preferences:** If user always skips social, reduce its priority

---

## 4. AI Content Generation

### 4.1 Review Response Drafts

**For positive reviews (4-5 stars):**
```
Template variables: [REVIEWER_NAME], [SPECIFIC_MENTION], [STUDIO_NAME]

"Thank you so much, [REVIEWER_NAME]! We're thrilled you enjoyed
[SPECIFIC_MENTION]. Our teachers put so much heart into every class.
We hope to see you on the mat again soon!"
```

**For negative reviews (1-3 stars):**
```
Template variables: [REVIEWER_NAME], [ISSUE_MENTIONED], [RESOLUTION_OFFER]

"Hi [REVIEWER_NAME], thank you for taking the time to share your
experience. We're sorry to hear [ISSUE_MENTIONED]. We take this
feedback seriously. [RESOLUTION_OFFER]. Please reach out to us
directly at [EMAIL] so we can make this right."
```

**Tone adaptation:**
- Matches studio's configured voice (Warm, Professional, Calm)
- Never defensive or dismissive
- Always offers resolution path for negatives

### 4.2 GBP Post Suggestions

**Post types rotated:**
1. Class highlight ("New to yoga? Try our Gentle Basics...")
2. Teacher spotlight ("Meet Sarah, teaching Vinyasa for 10 years...")
3. Student testimonial (with permission)
4. Tips/education ("3 things to bring to your first yoga class")
5. Event/workshop promotion
6. Seasonal ("Start the new year with intention...")

**Generation inputs:**
- Studio's class schedule
- Teacher names and specialties
- Recent reviews (for testimonial extraction)
- Upcoming events
- Seasonal calendar

### 4.3 Student Outreach Messages

**Intro package reminder:**
```
"Hi [NAME], hope you're doing well! We noticed you still have
[X] classes left on your intro package. We'd love to see you
back on the mat. Here's this week's schedule: [LINK].
See you soon! — [STUDIO]"
```

**Win-back (30+ days inactive):**
```
"Hi [NAME], we've missed you at [STUDIO]! It's been a while
since your last visit. If life got busy, we totally understand.
When you're ready to return, we have [INCENTIVE].
Here's our schedule: [LINK]. Namaste — [STUDIO]"
```

---

## 5. Data Requirements

### 5.1 Required Integrations

| Data Source | Required For | Priority |
|-------------|--------------|----------|
| Google Business Profile | Review responses, GBP posts | P0 |
| YogaNearMe listing | Marketing Health data | P0 |
| Schedule Connect | Class data for content | P1 |
| Student data (MindBody, etc.) | Outreach actions | P1 |
| Competitor data | Competitive actions | P2 |

### 5.2 Fallback Behavior

If integrations are incomplete:

| Missing | Fallback |
|---------|----------|
| GBP not connected | Show "Connect GBP to unlock review actions" |
| Student data not connected | Skip outreach actions; fill Sprint with content/optimization |
| Competitor data unavailable | Skip competitive actions |

Minimum viable Sprint requires: YogaNearMe listing + Marketing Health Score

---

## 6. Notification System

### 6.1 Weekly Sprint Notification

**Sunday 6pm local time:**

Push: "Your Marketing Sprint is ready. 3 actions, ~2 hours."

Email:
```
Subject: Your marketing sprint for the week of [DATE]

[STUDIO NAME], here's what matters most this week:

1. Respond to 3 reviews (including 1 negative)
2. Post to Google Business Profile
3. Re-engage 4 intro students

Estimated time: 2 hours

[Start Your Sprint →]

— YogaNearMe Marketing Co-Pilot
```

### 6.2 Mid-Week Nudge (Optional)

**Wednesday 2pm (if Sprint not started):**

Push: "Haven't started your Sprint? The negative review is still waiting."

### 6.3 Completion Celebration

**When Sprint completed:**

Push: "Sprint complete! You're in the top 20% of studios this week."

---

## 7. Analytics

### 7.1 Sprint Metrics

| Metric | Target |
|--------|--------|
| Sprint open rate | >60% |
| Sprint start rate | >40% |
| Sprint completion rate | >30% |
| Avg. actions completed | 2.1 / 3 |
| Avg. completion time | <2 hours |

### 7.2 User Engagement Patterns

Track:
- Which action types are completed vs. skipped
- Time of day Sprints are started
- Correlation: Sprint completion → Marketing Health improvement
- Correlation: Sprint completion → retention

### 7.3 Content Performance

Track:
- AI response acceptance rate (used as-is vs. edited)
- Post engagement (views, clicks)
- Outreach response rate

---

## 8. Configuration Options

### 8.1 Studio Preferences

| Setting | Options | Default |
|---------|---------|---------|
| Sprint delivery day | Sun/Mon/Tue | Sunday |
| Sprint delivery time | Morning/Afternoon/Evening | Evening (6pm) |
| Mid-week nudge | On/Off | On |
| Action types to include | Reviews/Content/Outreach/All | All |
| Voice/tone | Warm/Professional/Calm | Warm |

### 8.2 Admin Controls

- Force-include specific action (e.g., "Always prioritize negative reviews")
- Exclude action types (e.g., "Never suggest social posts")
- Custom message templates
- Disable Sprint entirely (manual mode)

---

## 9. Success Criteria

### MVP Launch Criteria

- [ ] Sprint generated for all paying users weekly
- [ ] At least 2 action types working (Reviews + Content)
- [ ] AI content generation produces usable drafts 80% of time
- [ ] One-click execution works for GBP posts and review responses
- [ ] Completion tracking accurate

### V1 Success Metrics (Month 3)

- [ ] 40% of users open Sprint weekly
- [ ] 30% complete at least 1 action
- [ ] Average completion time <2 hours
- [ ] NPS for Sprint feature >50

---

## 10. Open Questions

1. **Gamification:** Should we add streaks, badges, or leaderboards?
2. **Team support:** If studio has multiple users, who gets the Sprint?
3. **Carry-over:** If action isn't completed, does it appear next week?
4. **Customization:** How much should users be able to customize their Sprint?

---

## Document History

| Version | Date | Changes |
|---------|------|---------|
| v1.0 | Jan 24, 2026 | Initial spec based on external evaluation insights |
