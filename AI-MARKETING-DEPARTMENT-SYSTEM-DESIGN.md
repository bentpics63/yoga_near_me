# AI Marketing Department - System Design Document

**Project:** YogaNearMe Studio Suite
**Document Type:** High-Level System Design
**Version:** 1.0
**Last Updated:** January 25, 2026
**Status:** In Development

---

## Table of Contents

1. [Vision & Problem Statement](#1-vision--problem-statement)
2. [The 8 Functions](#2-the-8-functions)
3. [Autonomy Framework](#3-autonomy-framework)
4. [The Weekly Meeting](#4-the-weekly-meeting)
5. [Onboarding & Questionnaire](#5-onboarding--questionnaire)
6. [Learning & Adaptation](#6-learning--adaptation)
7. [Build Phases](#7-build-phases)
8. [Vertical Portability](#8-vertical-portability)
9. [Open Decisions](#9-open-decisions)
10. [Related Documents](#10-related-documents)

---

## 1. Vision & Problem Statement

### The Problem

A yoga studio owner is great at yoga. They're terrible at marketing (or have no time for it). Today their options are:

| Option | Problem |
|--------|---------|
| Do it themselves | Inconsistent, reactive, time they don't have |
| Hire someone | $3-5K/month for a real marketing person, can't afford it |
| Use tools | Mailchimp, Hootsuite, Canva — still requires their time and expertise |
| Hire an agency | $1-2K/month minimum, generic work, doesn't understand yoga |

**None of these give them what they actually need: someone who handles marketing so they can focus on teaching.**

### The Vision

An AI marketing department that:
- Knows the yoga studio business deeply
- Operates at whatever level of independence the owner wants
- Gets smarter about THIS specific studio over time
- Costs a fraction of a human hire
- Delivers measurable results

### The Transformation

**Before:** "I should do marketing but I don't know what"
**After:** "Maya handles it. We talk Mondays."

**Before:** 5 different tools to check
**After:** One relationship

**Before:** Guilt about ignoring marketing
**After:** Peace of mind

**Before:** Reactive (problems pile up)
**After:** Proactive (someone's watching)

### Why This Wins

| Advantage | Why It Matters |
|-----------|---------------|
| Moat | No one else has an AI marketing director for SMBs |
| Scalable | Same architecture works for Pilates, dance, martial arts, medspas |
| Pricing power | This isn't a $29 tool. It's a $199+ service. |

---

## 2. The 8 Functions

The AI Marketing Department consists of 8 interconnected functions. Function 8 (Strategy & The Relationship) is the brain that orchestrates all others.

### System Architecture

```
                    ┌─────────────────────────┐
                    │  8. STRATEGY &          │
                    │     THE RELATIONSHIP    │
                    │     (Maya's Brain)      │
                    └───────────┬─────────────┘
                                │
          ┌─────────────────────┼─────────────────────┐
          │                     │                     │
          ▼                     ▼                     ▼
   ┌─────────────┐      ┌─────────────┐      ┌─────────────┐
   │ 7. ANALYTICS│◄────►│ 6. INTEL    │◄────►│ 1. VISIBILITY│
   └─────────────┘      └─────────────┘      └─────────────┘
          │                     │                     │
          │    ┌────────────────┼────────────────┐    │
          │    │                │                │    │
          ▼    ▼                ▼                ▼    ▼
   ┌─────────────┐      ┌─────────────┐      ┌─────────────┐
   │ 2. REPUTATION│◄────►│ 3. CONTENT  │◄────►│ 4. CHANNELS │
   └─────────────┘      └─────────────┘      └─────────────┘
          │                     │                     │
          └─────────────────────┼─────────────────────┘
                                │
                                ▼
                    ┌─────────────────────────┐
                    │  5. CUSTOMER            │
                    │     COMMUNICATIONS      │
                    │     (Retention Engine)  │
                    └─────────────────────────┘
```

### Function Summary

| # | Function | Core Purpose | Key Differentiator |
|---|----------|--------------|-------------------|
| 1 | Visibility | Be found | Continuous monitoring, not one-time audit |
| 2 | Reputation | Be trusted | Predictive, not reactive |
| 3 | Content | Be interesting | Learns voice, improves over time |
| 4 | Channels | Be present | Cross-channel orchestration |
| 5 | Communications | Be personal | Behavior-triggered, truly personalized |
| 6 | Intelligence | Be informed | Actionable, not just data |
| 7 | Analytics | Be accountable | Attribution and plain-language insights |
| 8 | Strategy/Relationship | Be trusted partner | The weekly meeting, the evolving trust |

---

### Function 1: VISIBILITY (Marketing Audit)

**What it does:**
- Scans the studio's digital presence
- Scores their findability (Google, social, directories)
- Identifies gaps and opportunities
- Compares to local competitors

**Inputs:**
- Studio name/address
- Google Business Profile
- Social handles
- Website URL
- Competitor list (auto-detected or provided)

**Outputs:**
- Visibility Score (0-100)
- Channel-by-channel breakdown
- Priority recommendations
- Competitor comparison

**Autonomy levels:**

| Level | Behavior |
|-------|----------|
| 1-2 | Report only, owner acts |
| 3 | Report + drafted fixes for approval |
| 4-5 | Auto-fix what can be fixed (GBP optimization, etc.) |

**State of the art:**
- Not a one-time audit — continuous monitoring
- Alerts when visibility drops or competitor gains
- Tracks improvement over time

---

### Function 2: REPUTATION (Reviews)

**What it does:**
- Monitors reviews across all platforms (Google, Yelp, Facebook, ClassPass, Mindbody)
- Alerts owner to new reviews
- Drafts or sends responses
- Generates review requests to students
- Tracks sentiment trends over time

**Inputs:**
- Connected review platforms (OAuth or scraping)
- Student contact info (from scheduling integration)
- Owner's voice/tone preferences
- Response templates (customized during onboarding)

**Outputs:**
- New review alerts (instant for negative, batched for positive)
- Drafted responses
- Review request campaigns
- Sentiment score and trends
- Monthly reputation report

**Autonomy levels:**

| Level | Positive Reviews | Negative Reviews | Review Requests |
|-------|-----------------|------------------|-----------------|
| 1 | Alert only | Alert only | Suggest who to ask |
| 2 | Draft, owner sends | Draft, owner sends | Draft message, owner approves |
| 3 | Auto-respond, notify after | Draft, owner approves | Auto-send after class, notify |
| 4 | Auto-respond silently | Draft, owner approves | Auto-send, weekly summary |
| 5 | Auto-respond silently | Auto-respond, flag for review | Fully automated |

**State of the art:**
- Sentiment analysis detects nuance ("loved the class BUT...")
- Identifies patterns ("3 reviews mention parking" → alert)
- Suggests systemic fixes, not just responses
- Tracks review velocity vs. competitors
- Smart timing for review requests (after 3rd class, not 1st)

**Key insight:** Negative reviews always require more caution. Even at Level 5, the system should flag unusual situations (legal threats, specific employee complaints, factual disputes).

---

### Function 3: CONTENT CREATION

**What it does:**
- Creates social media posts (Instagram, Facebook, TikTok concepts)
- Writes email campaigns and newsletters
- Generates ad copy (Google, Meta)
- Creates website copy updates
- Produces promotional materials (class descriptions, bios, announcements)

**Inputs:**
- Studio brand voice (from onboarding questionnaire)
- Class schedule and offerings
- Upcoming events/workshops
- Student milestones and stories (with permission)
- Seasonal/cultural calendar (holidays, awareness months)
- Photos/videos (owner-provided or stock)
- Competitor content (for differentiation)

**Outputs:**
- Weekly content calendar
- Ready-to-post social content (image + caption + hashtags)
- Email drafts (welcome series, re-engagement, promotions)
- Ad creative variations
- Suggested content themes

**Content types by priority:**

| Type | Frequency | Effort | Impact |
|------|-----------|--------|--------|
| Social posts | 3-5/week | Low | Medium |
| Stories/Reels concepts | 2-3/week | Medium | High |
| Email newsletters | 1-2/month | Medium | High |
| Promotional emails | As needed | Low | High |
| Ad copy | Ongoing optimization | Low | High |
| Blog/SEO content | 1-2/month | High | Long-term |

**Autonomy levels:**

| Level | Social | Email | Ads |
|-------|--------|-------|-----|
| 1 | Suggest ideas only | Suggest ideas only | Not involved |
| 2 | Draft content, owner posts | Draft, owner sends | Draft, owner approves |
| 3 | Draft, batch approve weekly | Draft, owner approves | Draft, owner approves budget |
| 4 | Auto-post routine, approve special | Auto-send routine, approve new | Auto-optimize within budget |
| 5 | Full control with brand guardrails | Full control | Full control within budget |

**State of the art:**
- Learns what content performs (engagement, clicks, conversions)
- A/B tests variations automatically
- Adapts tone based on platform (IG vs. email vs. Google)
- Pulls from real studio events (new teacher, workshop, holiday hours)
- Creates content clusters (theme weeks, series)
- Repurposes across channels (review quote → social → email)

**Key insight:** Content creation is where owners feel most protective of their "voice." The system must demonstrate it understands the brand before earning autonomy.

---

### Function 4: CHANNEL MANAGEMENT

**What it does:**
- Manages presence across all marketing channels
- Posts and schedules content
- Monitors and responds to engagement (comments, DMs, mentions)
- Optimizes profiles and listings
- Manages paid advertising

**Channels managed:**

| Channel | Priority | Complexity |
|---------|----------|------------|
| Google Business Profile | Critical | Medium |
| Instagram | High | Medium |
| Facebook Page | High | Low |
| Email (ESP integration) | High | Medium |
| Google Ads | Medium | High |
| Meta Ads | Medium | High |
| Yelp | Medium | Low |
| TikTok | Optional | Medium |
| Local directories | Low | Low |
| Website (if integrated) | Medium | High |

**Inputs:**
- Content from Function 3
- Platform credentials (OAuth where possible)
- Posting schedule preferences
- Ad budgets and constraints
- Engagement rules (what to respond to, what to escalate)

**Outputs:**
- Scheduled and published content
- Engagement responses (comments, DMs)
- Profile optimizations
- Ad campaigns and optimizations
- Channel health scores

**Autonomy levels:**

| Level | Posting | Engagement | Ads |
|-------|---------|------------|-----|
| 1 | Manual only | Alerts only | Not involved |
| 2 | Owner posts approved content | Draft responses | Recommendations only |
| 3 | Auto-post approved content | Auto-respond routine, escalate complex | Manage within approved budget |
| 4 | Auto-post with guardrails | Auto-respond all, report weekly | Full management, weekly report |
| 5 | Full control | Full control | Full control within budget cap |

**State of the art:**
- Cross-channel orchestration (content adapted per platform)
- Optimal timing based on audience behavior
- Engagement prioritization (respond to prospects first)
- Unified inbox (all channels in one view)
- Automated A/B testing for ads
- Budget reallocation based on performance
- Crisis detection (volume spikes, negative mentions)

**Key insight:** Channel management is where the "doing" happens. This is where autonomy creates the most time savings — but also the most risk if something goes wrong publicly.

---

### Function 5: CUSTOMER COMMUNICATIONS (Retention & Outreach)

**What it does:**
- Manages direct communication with students (current, lapsed, prospective)
- Sends personalized outreach based on behavior patterns
- Handles inquiry responses
- Executes retention campaigns
- Manages win-back sequences

**Communication types:**

| Type | Trigger | Goal |
|------|---------|------|
| Welcome sequence | New student signs up | Convert trial → member |
| Check-in | After 1st, 3rd, 10th class | Build relationship |
| At-risk outreach | Attendance drops | Prevent churn |
| Win-back | 30/60/90 days lapsed | Reactivate |
| Milestone celebration | 50th class, 1-year anniversary | Deepen loyalty |
| Inquiry response | Form fill, DM, call | Convert lead |
| Promotional | Special offer, new class | Drive booking |
| Informational | Schedule change, holiday hours | Reduce friction |

**Inputs:**
- Student data from scheduling system (Mindbody, Momence, etc.)
- Attendance patterns
- Purchase history
- Communication preferences
- Student segments (new, regular, VIP, at-risk, lapsed)

**Outputs:**
- Automated email/SMS sequences
- Personalized one-off messages
- Inquiry responses
- Outreach reports (sent, opened, converted)
- At-risk student alerts

**Autonomy levels:**

| Level | Automated Sequences | Personal Outreach | Inquiry Response |
|-------|--------------------|--------------------|------------------|
| 1 | Alert who needs contact | Alert only | Alert only |
| 2 | Suggest message, owner sends | Draft, owner sends | Draft, owner sends |
| 3 | Auto-send approved templates | Draft, owner approves | Auto-respond, escalate complex |
| 4 | Auto-send, weekly report | Auto-send routine, notify | Auto-respond all, daily digest |
| 5 | Full control | Full control | Full control with escalation rules |

**State of the art:**
- Predictive churn detection (flags students BEFORE they leave)
- Personalization beyond [First Name] (references their classes, teachers, progress)
- Channel optimization (knows who responds to SMS vs. email)
- Timing optimization (sends when they're most likely to read)
- Conversation continuity (remembers previous interactions)
- Handoff to human (knows when AI should step back)

**Key insight:** This is where the scheduling system integration is critical. Without attendance data, the system is guessing. With it, the system knows exactly who needs attention and why.

---

### Function 6: INTELLIGENCE & RESEARCH

**What it does:**
- Monitors competitors continuously
- Tracks market trends
- Analyzes local market conditions
- Gathers industry benchmarks
- Identifies opportunities and threats

**Intelligence categories:**

| Category | What's Tracked | Frequency |
|----------|---------------|-----------|
| Competitor Activity | New classes, pricing changes, reviews, social activity, closures | Daily |
| Local Market | New studios, demographic shifts, seasonal patterns | Weekly |
| Industry Trends | Yoga trends, wellness trends, technology shifts | Monthly |
| Student Behavior | Class preferences, booking patterns, churn signals | Continuous |
| Marketing Performance | What's working vs. not across channels | Continuous |

**Inputs:**
- Competitor list (auto-detected + manual)
- Local business data (Google, Yelp, social)
- Industry publications and reports
- Studio's own performance data
- Student feedback and reviews

**Outputs:**
- Competitor alerts (significant changes)
- Monthly market report
- Opportunity identification ("Competitor X dropped their 6am class — you could capture that audience")
- Threat warnings ("New studio opening 2 miles away")
- Trend recommendations ("Sound bath classes growing 40% — consider adding")

**Autonomy levels:**

| Level | Monitoring | Alerts | Acting on Intelligence |
|-------|------------|--------|----------------------|
| 1 | Passive (owner checks dashboard) | None | Owner decides |
| 2 | Active monitoring | Significant changes only | Recommendations |
| 3 | Active monitoring | All relevant changes | Recommendations with drafted actions |
| 4 | Active monitoring | Filtered by importance | Auto-draft responses, owner approves |
| 5 | Active monitoring | Summary only | Auto-act on opportunities within guardrails |

**State of the art:**
- Real-time competitor monitoring (price changes, new offerings)
- Predictive intelligence ("Based on patterns, this competitor may be struggling")
- Opportunity scoring (which insights are worth acting on)
- Cross-referencing (connects competitor weakness to studio strength)
- Market gap analysis (underserved class types, times, demographics)
- Trend velocity tracking (not just what's trending, but how fast)

**Key insight:** Intelligence without action is just noise. The system must prioritize and recommend specific actions, not just report data.

---

### Function 7: ANALYTICS & REPORTING

**What it does:**
- Aggregates data from all marketing activities
- Tracks KPIs and goals
- Attributes results to marketing actions
- Generates reports at multiple cadences
- Provides insights and recommendations

**Metrics tracked:**

| Category | Metrics |
|----------|---------|
| Visibility | Search ranking, GBP views, website traffic, social reach |
| Reputation | Review count, average rating, sentiment score, response rate |
| Engagement | Social engagement, email opens/clicks, ad CTR |
| Acquisition | New leads, trial signups, first-time students |
| Retention | Attendance frequency, churn rate, package renewals |
| Revenue | Attributed bookings, revenue per channel, ROI |

**Report types:**

| Report | Frequency | Purpose |
|--------|-----------|---------|
| Weekly Snapshot | Weekly | What happened, what's next |
| Monthly Performance | Monthly | Trends, wins, opportunities |
| Quarterly Review | Quarterly | Strategic assessment |
| Real-time Dashboard | Always on | Check anytime |
| Annual Summary | Yearly | Year in review, planning |

**Inputs:**
- All platform data (social, email, ads, reviews)
- Scheduling system data (attendance, revenue)
- Website analytics
- Campaign tracking
- Goal settings

**Outputs:**
- Real-time dashboard
- Automated reports (email summaries)
- Goal tracking and projections
- Attribution modeling ("This campaign drove X bookings")
- Recommendations based on data

**Autonomy levels:**

| Level | Reporting | Insights | Acting on Data |
|-------|-----------|----------|----------------|
| 1 | Dashboard only | None | Owner interprets |
| 2 | Automated reports | Observations highlighted | Recommendations |
| 3 | Automated reports | Insights with explanations | Drafted action plans |
| 4 | Automated reports | Prioritized insights | Auto-implement optimizations |
| 5 | Summary only | Full analysis | Continuous optimization |

**State of the art:**
- True attribution (connects marketing touch to booking)
- Cohort analysis (how different student groups behave)
- Predictive analytics ("At current pace, you'll hit goal by...")
- Anomaly detection (flags unusual patterns)
- Narrative reporting (explains data in plain language)
- Benchmarking (how you compare to similar studios)
- ROI calculation (marketing spend → revenue generated)

**Key insight:** Most studio owners don't want more data — they want to know "Is it working?" and "What should I do?" The system must translate data into answers.

---

### Function 8: STRATEGY & THE RELATIONSHIP

**What it does:**
- Synthesizes all other functions into coherent strategy
- Conducts the weekly meeting
- Sets and tracks goals
- Manages the owner relationship
- Calibrates autonomy over time
- Handles escalations and exceptions

**This is Maya.** The other 7 functions are capabilities. This function is the brain that orchestrates them.

**Strategic responsibilities:**

| Area | What Maya Does |
|------|---------------|
| Goal Setting | Helps owner set realistic, measurable goals |
| Prioritization | Decides what matters most this week |
| Resource Allocation | Recommends where to spend time/money |
| Course Correction | Identifies when strategy isn't working |
| Opportunity Capture | Spots and acts on time-sensitive opportunities |
| Crisis Management | Handles urgent issues (bad review, competitor move) |
| Long-term Planning | Thinks beyond this week (seasonal, annual) |

**Relationship management:**

| Behavior | How Maya Handles It |
|----------|---------------------|
| Owner is overwhelmed | Reduces recommendations, offers to take more control |
| Owner is disengaged | Checks in, asks if meeting frequency should change |
| Owner is micromanaging | Demonstrates competence, gently suggests more trust |
| Owner is happy | Suggests expanding autonomy |
| Owner made a mistake | Doesn't blame, offers to help fix |
| Maya made a mistake | Owns it, explains what went wrong, adjusts |

**Inputs:**
- All data from Functions 1-7
- Owner behavior patterns (approvals, edits, response time)
- Owner explicit preferences (from onboarding + ongoing)
- Calendar and timing context
- Business context (slow season, new location, etc.)

**Outputs:**
- Weekly meeting agenda and execution
- Strategic recommendations
- Autonomy calibration updates
- Escalation handling
- Goal tracking and adjustment
- Relationship health monitoring

**Autonomy levels (for the relationship itself):**

| Level | Meeting Style | Decision Making | Owner Involvement |
|-------|--------------|-----------------|-------------------|
| 1 | Owner drives agenda | Maya provides data only | High |
| 2 | Maya suggests agenda | Owner decides everything | High |
| 3 | Maya runs meeting | Shared decisions | Medium |
| 4 | Maya runs meeting | Maya decides most, owner approves strategic | Low |
| 5 | Maya sends summary | Maya decides all within guardrails | Minimal |

**State of the art:**
- Emotional intelligence (detects owner stress, adjusts accordingly)
- Contextual awareness (knows owner's schedule, busy seasons)
- Proactive relationship management (doesn't wait for problems)
- Memory across interactions (references past conversations)
- Personality consistency (feels like the same "person")
- Trust calibration (earns autonomy through demonstrated competence)
- Graceful escalation (knows when to involve the human)

**Key insight:** This is what makes it a "Marketing Director" instead of a "Marketing Tool." The relationship is the product. The weekly meeting is the ritual that makes it real.

---

## 3. Autonomy Framework

### The 5 Levels

```
LEVEL 1          LEVEL 2          LEVEL 3          LEVEL 4          LEVEL 5
───────────────────────────────────────────────────────────────────────────
TOOL             ADVISOR          PARTNER          MANAGER          AUTOPILOT

"Show me         "Tell me         "Let's decide    "Handle it,      "Handle
 the data"        what to do"      together"        tell me after"   everything"

Owner does       Owner decides    Shared           Maya decides     Maya decides
Maya reports     Maya recommends  Maya drafts,     Maya acts,       Maya acts,
                                  owner approves   owner reviews    owner trusts

│                                                                            │
└──────── MOST CONTROL ────────────────────────────── LEAST CONTROL ────────┘
```

### Level Definitions

| Level | Name | Owner Experience | Maya Behavior |
|-------|------|------------------|---------------|
| 1 | Tool | "Give me my numbers, I'll figure out what to do" | Dashboard only, no recommendations, no actions |
| 2 | Advisor | "Tell me what you think, but I decide everything" | Recommendations with reasoning, owner approves every action |
| 3 | Partner | "Let's work together on this" | Maya drafts, suggests, discusses; owner approves strategic items; Maya handles routine with notification |
| 4 | Manager | "You handle it, keep me informed" | Maya executes with judgment; owner sees weekly summary; only strategic decisions require approval |
| 5 | Autopilot | "Just make it work, I trust you" | Full autonomy; owner gets results, not tasks; monthly strategic review only |

### Autonomy by Function Matrix

| Function | Level 1 | Level 2 | Level 3 | Level 4 | Level 5 |
|----------|---------|---------|---------|---------|---------|
| Visibility | Report only | Report + recs | Report + drafted fixes | Auto-fix routine | Full optimization |
| Reviews (positive) | Alert | Draft | Auto-respond, notify | Auto-respond silent | Auto-respond |
| Reviews (negative) | Alert | Draft | Draft, must approve | Draft, must approve | Auto-respond, flag unusual |
| Content | Ideas only | Drafts | Batch approve weekly | Auto-post routine | Full control |
| Channels | Manual | Owner posts | Auto-post approved | Auto-post with guardrails | Full control |
| Communications | Alert who to contact | Suggest messages | Auto-send templates | Auto-send, report | Full control |
| Intelligence | Dashboard | Alerts | Alerts + drafted actions | Auto-draft responses | Auto-act on opportunities |
| Analytics | Dashboard | Reports | Reports + insights | Insights + auto-optimize | Continuous optimization |
| Strategy | Data only | Suggestions | Shared decisions | Maya decides most | Maya decides all |

---

## 4. The Weekly Meeting

### Structure (10 Minutes)

| Phase | Duration | What Happens |
|-------|----------|--------------|
| Connection | 1 min | Personal check-in, tone setting |
| Wins | 1 min | Celebrate what worked |
| Metrics | 2 min | Key numbers, trends |
| Insights | 2 min | What the data means |
| Recommendations | 2 min | What to do next |
| Approvals | 1 min | Owner decisions needed |
| Questions | 1 min | Maya asks owner for input |

### Modalities

| Modality | Pros | Cons | When to Use |
|----------|------|------|-------------|
| Voice call | Most human, builds relationship | Requires scheduling, no visuals | Default recommendation |
| Video call | Shows data visually | More friction | Data-heavy discussions |
| Chat/text | Async, reviewable | Less personal | Busy owners, quick updates |
| Email summary | Lowest friction | No interaction | Level 4-5 owners |

### Pre-Meeting (AI Prepares)

24 hours before the meeting, Maya:
1. Analyzes all data from the week
2. Identifies wins to celebrate
3. Spots concerning trends
4. Prepares 2-3 priority recommendations
5. Drafts content for approval
6. Formulates questions for owner
7. Generates meeting agenda

### Post-Meeting (AI Executes)

Immediately after, Maya:
1. Sends meeting summary via email
2. Executes approved actions
3. Schedules content for the week
4. Sets up monitoring for discussed items
5. Notes owner preferences for future learning

---

## 5. Onboarding & Questionnaire

### Design Philosophy

The questionnaire should:
1. **Reveal psychology** — What makes them comfortable/uncomfortable
2. **Set expectations** — What Maya will and won't do
3. **Create baseline** — Starting point for learning
4. **Feel personal** — Not a form, a conversation

### Section 1: Comfort with Technology

"Before we set up Maya, I'd like to understand how you prefer to work. There are no wrong answers—this helps me serve you better."

**Q1: When a new app or tool comes out, you typically:**
- Try it immediately — I love new technology
- Wait and see — I adopt once it's proven
- Resist until necessary — I prefer what I know
- Avoid if possible — Technology frustrates me

**Q2: When it comes to your studio's social media, you:**
- Love creating content and posting
- Know it's important but struggle to find time
- Do it occasionally when I remember
- Rarely or never post — it feels inauthentic

**Q3: How do you feel about AI writing content for your studio?**
- Excited — save me time!
- Cautiously optimistic — I'd want to review it
- Nervous — my voice is personal
- Opposed — I want to write everything myself

### Section 2: Control Preferences

"Different studio owners want different levels of involvement. Let me understand yours."

**Reviews (Positive):** "When a positive review comes in..."
- Just respond for me (I trust you)
- Draft a response and post it, then tell me
- Draft a response and wait for my approval
- Alert me and I'll write the response myself

**Reviews (Negative):** "When a negative review comes in..."
- Draft and respond, then tell me
- Draft a response, but I must approve before posting
- Alert me immediately, I'll handle it [Recommended]
- Alert me immediately, don't draft anything

**Social Media:** "For regular social media posts..."
- Create and post automatically based on what you learn
- Create posts, show me the week's plan, then post
- Create posts, I approve each one before posting
- Suggest ideas, I'll create and post myself

**Student Outreach:** "For re-engagement messages to students who haven't visited..."
- Send automatically using approved templates
- Prepare and send, then tell me what you sent
- Prepare messages, I approve before sending
- Alert me who needs outreach, I'll handle it

**Ad Spending:** "For paid advertising..."
- Set a monthly budget and let me optimize
- Suggest campaigns, I approve budget and creative
- Show me opportunities, I set up campaigns myself
- I don't want to do paid advertising

### Section 3: Communication Preferences

"How do you want to stay informed?"

**Meeting frequency:**
- Weekly (recommended) — 10 minutes every Monday
- Bi-weekly — every other Monday
- Monthly — once a month
- As-needed — only when there's something important

**Meeting format:**
- Phone call — I prefer voice
- Video — I like to see data visually
- Chat/text — I prefer written communication
- Email summary — I'll read it when I have time

**Alert preferences:** "When should Maya interrupt your day?"
- [ ] Negative reviews (1-3 stars)
- [ ] Competitor alerts (significant changes)
- [ ] Weekly metrics summary
- [ ] Content ready for approval
- [ ] Student milestones (10th class, etc.)

### Section 4: Voice and Values

"To represent your studio authentically, help me understand your voice."

**Your studio's personality is best described as:**
- Warm and nurturing — community and connection first
- Professional and polished — quality and expertise
- Casual and fun — accessible and lighthearted
- Spiritual and traditional — honoring yoga's roots
- Fitness-forward — athletic and results-oriented

**When communicating with students, you prefer:**
- Formal ("We hope to see you soon")
- Friendly ("Can't wait to see you!")
- Personal ("I hope to see you soon - Sarah")

**Words or phrases you NEVER want used:**
[Free text: e.g., "namaste" in marketing, "workout", "cleanse", etc.]

**Words or phrases that feel very "you":**
[Free text: e.g., "practice", "community", "your mat is waiting"]

### Initial Autonomy Mapping

Based on responses, Maya suggests an initial profile:

"Based on what you've shared, here's how I suggest we start:

**YOUR AUTONOMY PROFILE: PARTNER (Level 3)**

**I'll handle:**
- Responding to positive reviews (you'll see them after)
- Monitoring competitors and alerting you to changes
- Creating social content for your approval
- Tracking at-risk students and preparing outreach

**I'll ask you first:**
- Negative review responses
- Any new type of campaign
- Spending money on ads
- Messages to students (first time for each type)

Does this feel right? We can adjust anytime."

---

## 6. Learning & Adaptation

### The Learning Loop

```
                    OWNER ACTION
                         │
        ┌────────────────┼────────────────┐
        ▼                ▼                ▼
   ┌─────────┐     ┌─────────┐     ┌─────────┐
   │APPROVED │     │ EDITED  │     │REJECTED │
   │ AS-IS   │     │  THEN   │     │         │
   │         │     │APPROVED │     │         │
   └────┬────┘     └────┬────┘     └────┬────┘
        │               │               │
        ▼               ▼               ▼
   ┌─────────┐     ┌─────────┐     ┌─────────┐
   │  THIS   │     │  LEARN  │     │  DON'T  │
   │  WORKS  │     │  FROM   │     │  DO     │
   │         │     │  EDITS  │     │  THIS   │
   └────┬────┘     └────┬────┘     └────┬────┘
        │               │               │
        └───────────────┼───────────────┘
                        │
                        ▼
             ┌───────────────────┐
             │   MAYA LEARNS     │
             │                   │
             │ • Content prefs   │
             │ • Timing prefs    │
             │ • Topics to avoid │
             │ • Voice/tone      │
             └─────────┬─────────┘
                       │
                       ▼
             ┌───────────────────┐
             │ TRUST CALIBRATION │
             │                   │
             │ High approval →   │
             │   More autonomy   │
             │                   │
             │ High edit rate →  │
             │   Adapt approach  │
             │                   │
             │ High rejection →  │
             │   Pull back       │
             └───────────────────┘
```

### Autonomy Evolution Triggers

**Signals to INCREASE autonomy:**

| Signal | Maya's Response |
|--------|-----------------|
| 10+ review responses approved without edit | "I notice you approve my review responses consistently. Would you like me to post them automatically and just show you after?" |
| Owner consistently doesn't change social posts | "Your last 8 posts went out as I drafted them. Want me to just post on schedule and you review weekly?" |
| Owner says "just do it" repeatedly | "You've told me to 'just handle it' several times. Should I move to more autonomy for [category]?" |
| Owner misses approval windows | "I noticed the last few posts waited 3+ days for approval. Would it help if I posted and showed you after?" |

**Signals to DECREASE autonomy:**

| Signal | Maya's Response |
|--------|-----------------|
| Owner frequently edits content | "I notice you make changes to most posts. Help me understand what you're adjusting so I can match your voice better." |
| Owner rejects a recommendation | "I hear you. I won't suggest [that type of thing] again without asking first." |
| Owner expresses discomfort | "I can tell that didn't feel right. Let's pull back on [category] and I'll check with you first." |
| Negative outcome from autonomous action | "The post yesterday didn't perform well. I should have checked with you first. Want me to get approval on posts like that going forward?" |

### Quarterly Autonomy Review

Every 3 months, Maya initiates a check-in:

"It's been 3 months since we started working together. I'd like to do a quick autonomy check-in.

**WHAT I'VE LEARNED:**
- You prefer shorter social captions (avg edit: -15 words)
- You always approve Tuesday posts (your slow day?)
- You like to personally handle negative reviews
- You're comfortable with me sending package reminders

**CURRENT AUTONOMY LEVEL: Partner (Level 3)**

**Based on our work together, I could suggest:**
- Moving review responses to auto-post (you approve 94%)
- Keeping social at approval-required (you edit 40%)
- Moving student reminders to fully automatic

Would you like to adjust anything?"

---

## 7. Build Phases

### Phase Overview

| Phase | Name | Weeks | Core Deliverable |
|-------|------|-------|------------------|
| 1 | Foundation | 1-8 | Data collection, basic automations |
| 2 | Weekly Sprint | 9-12 | Dashboard, approvals, email summary |
| 3 | Async AI Director | 13-16 | AI reasoning layer |
| 4 | Voice Meeting | 17-20 | Retell integration, live calls |
| 5 | Full Autonomy | 21+ | Increased AI authority |

### Phase 1: Foundation (Weeks 1-8)

Build the components that feed the brain:
- Marketing Audit (visibility data)
- Review monitoring + response system
- Schedule Connect (class/attendance data integration)
- Basic competitor tracking

**No AI Director yet.** Just data collection and simple automations.

### Phase 2: Weekly Sprint (Weeks 9-12)

Build the non-conversational version:
- Dashboard shows weekly priorities
- Owner clicks to approve/execute
- Email summary of recommendations

**Validates the "what" without the "how."** Are owners engaging with weekly priorities? Are the recommendations useful?

### Phase 3: Asynchronous AI Director (Weeks 13-16)

Add AI reasoning layer:
- AI generates the weekly Sprint with explanations
- AI drafts all content
- AI writes the meeting "script"

**Delivered via email/dashboard first.** Tests the quality of AI recommendations without voice complexity.

### Phase 4: Voice Meeting (Weeks 17-20)

Add the weekly call:
- Scheduled via Retell or similar
- AI calls owner at their chosen time
- Follows prepared script but responds to questions
- Records meeting, extracts action items

**This is the magic moment.** Owner picks up the phone and talks to their marketing director.

### Phase 5: Full Autonomy (Weeks 21+)

Increase AI authority based on trust:
- Auto-post approved content types
- Auto-respond to positive reviews
- Auto-send routine outreach
- Owner only involved in strategic decisions

---

## 8. Vertical Portability

### The Shared Pattern

All "reluctant marketers" in local service businesses have identical needs—just different vocabulary.

**Core truth across verticals:**
"I became a [profession] because I love [what I do]. I didn't sign up to be a marketer."

### Target Verticals (Priority Order)

| Tier | Verticals | Similarity to Yoga |
|------|-----------|-------------------|
| 1 | Pilates, Barre, Dance | 85-95% |
| 2 | Meditation, Martial Arts, Personal Training | 70-80% |
| 3 | Med Spas, Aestheticians | 60-70% |
| 4 | Hair Salons, Day Spas, Massage | 50-60% |

### Med Spa / Aesthetician Specifics

- Market size: $15B+ industry, 10,000+ practices
- 67% invest <$2,500/mo in marketing
- Same owner psychology, different compliance requirements (HIPAA, medical advertising rules)
- Higher average transaction value
- Different vocabulary (clients vs. students, treatments vs. classes)

### Architecture for Portability

```
┌─────────────────────────────────────────────────────┐
│              UNIVERSAL CORE                         │
│  (Audit, Reviews, Retention, AI Brain)              │
└─────────────────────┬───────────────────────────────┘
                      │
┌─────────────────────┼───────────────────────────────┐
│           VERTICAL MODULES                          │
│  (Terminology, Benchmarks, Compliance)              │
└─────────────────────┬───────────────────────────────┘
                      │
┌─────────────────────┼───────────────────────────────┐
│           DIRECTORY LAYER                           │
│  (YogaNearMe, PilatesNearMe, MedSpaNearMe...)       │
└─────────────────────────────────────────────────────┘
```

---

## 9. Open Decisions

The following decisions need to be made before moving to detailed PRD/MRD:

### Build Order
- [ ] Confirm sequence: Visibility → Reputation → Analytics → Strategy → Communications → Content → Channels → Intelligence?
- [ ] Or different order?

### MVP Scope
- [ ] What's the minimum viable version of each function for Phase 1?
- [ ] Which integrations are required at launch (Mindbody? Momence? Others?)

### Pricing Model
- [ ] Flat monthly fee?
- [ ] Tiered by autonomy level?
- [ ] Tiered by functions included?
- [ ] Price points: $149? $199? $299?

### Entry Point
- [ ] Free audit (lead gen)?
- [ ] Paid audit (one-time)?
- [ ] Trial of full system?
- [ ] Audit included with first month?

### Voice vs. Text at Launch
- [ ] Does weekly meeting need voice at launch?
- [ ] Or start with dashboard/email and add voice in Phase 4?

### Default Autonomy
- [ ] Start conservative (Level 2 Advisor)?
- [ ] Start based on questionnaire responses (Level 2-3)?
- [ ] Other approach?

### Meeting Frequency
- [ ] Weekly default?
- [ ] Owner chooses during onboarding?
- [ ] What happens if owner misses meeting?

---

## 10. Related Documents

The following documents were mentioned in the original conversation as existing or planned:

| Document | Purpose | Status |
|----------|---------|--------|
| VIRTUAL-MARKETING-DEPARTMENT-MRD.md | Master strategy, pricing, build order | Mentioned |
| MARKETING-BRAIN-KNOWLEDGE-BASE.md | Frameworks, thought leaders, industry intelligence | Mentioned |
| AI-MARKETING-DIRECTOR-PERSONA.md | Maya's personality, psychology, vertical portability | Mentioned |
| WEEKLY-SPRINT-SPEC.md | The 2-hour marketing sprint experience | Mentioned |

---

## Document History

| Version | Date | Changes |
|---------|------|---------|
| 1.0 | 2026-01-25 | Initial creation from conversation synthesis |

---

*This document serves as the single source of truth for the AI Marketing Department system design. It should be updated as decisions are made and the product evolves.*
