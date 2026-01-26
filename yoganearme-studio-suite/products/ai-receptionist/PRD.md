# YogaNearMe AI Receptionist

## PRD v2.3 + Architecture Pack (Canonical, Production-Ready)

**Status:** Approved for Engineering  
**Date:** January 13, 2026  
**Version:** 2.3  
**Audience:** Product, Engineering, QA, Compliance, GTM, Leadership  
**Purpose:** Define the complete, enforceable product and system contract for production launch.

---

## 1. Vision & Strategic Wedge

### Vision

Make every yoga studio sound like a professional booking operation, 24/7, for the cost of lunch.

### Mission

Build the most domain-intelligent, reliable AI receptionist that captures missed calls and converts intent into bookings and purchases via SMS—using YogaNearMe's directory as a distribution moat.

### Strategic Wedge

We do not ask studios to sign up.  
We ask them to **Play With Me**.

---

## 2. "Play With Me" Acquisition Loop

### 2.1 User Experience

**Input:**
- Studio Website URL
- Owner Mobile Number

**Processing (≤15s):**
- Progressive loading ("Finding your schedule…", "Learning your vibe…")
- Website scrape for demo purposes only (not persistent data source)

**Demo Call (Confidence-Aware):**

*High confidence scrape:*
> "Hi! I'm the new receptionist for [Studio]. Want to hear how I handle a new student and text the booking link?"

*Medium/low confidence scrape:*
> "Hi! I'm the receptionist for your studio. I answer calls and instantly text booking and payment links—want to try?"

**SMS Closer:**
> "See how that worked? Claim this receptionist here: [Link]"

**Guarantee:**
The demo never claims availability certainty and never books. Demo operates in Link-Out Mode only.

### 2.2 Demo-to-Trial Conversion Flow

**Click "Claim this receptionist":**

1. **Landing page:** "Your receptionist is ready. Let's set it up."
2. **Account creation:** Email, password (or Google OAuth)
3. **Studio verification:** Confirm ownership via listing claim (if not already claimed) or verified email domain
4. **Trial terms:** 14 days free, full Base Tier functionality, no credit card required
5. **Onboarding:** Schedule Connect + Yoga Brain configuration (see Sections 7 and 4.2)

**Data carryover from demo:**
- Studio name, URL, phone number
- Any schedule data scraped (marked as unverified, requires confirmation)
- Owner mobile number

**Post-trial:**
- Convert to paid ($79/month) or downgrade to free tier (listing only, no receptionist)
- Early adopter pricing available (first 100 studios: $49/month for 6 months)

---

## 3. Operating Modes & Language Guarantees (Core Product Contract)

### 3.1 Operating Modes

**Mode 1 — Link-Out Mode (Default)**
- Send booking/payment/policy links
- No availability certainty
- No booking confirmations
- Available to all connection tiers

**Mode 2 — Verified Availability Mode (Read-Only)**
- Read availability from native integration
- Soft language only ("looks like there may be spots")
- Requires native integration (Mindbody, WellnessLiving, Momoyoga, Vagaro)

**Mode 3 — Read/Write Mode (Explicit Enablement)**
- Book / cancel / reschedule via API
- Verbal confirmation only after API success
- Requires native integration with write access + studio opt-in

### 3.2 Operating Mode Invariant (Non-Negotiable)

> **Once a call has started, the system may only maintain or downgrade its operating mode. The system must never upgrade its operating mode mid-call.**

**Implications:**
- If confidence or capability is lost → downgrade immediately
- If new capability becomes available mid-call → ignore until next call
- All language, tools, and confirmations must comply with the current mode

**This invariant applies to:**
- Voice responses
- SMS content
- Tool access
- Booking/payment confirmations

**Violations are P0 incidents.**

### 3.3 Connection Failure Handling

If Schedule Connect data becomes unavailable mid-call:

1. **Immediate downgrade** to Link-Out Mode
2. **Voice response:** "It appears I've lost my connection to the schedule. Let me text you a link to [the schedule / the class you asked about]."
3. **SMS:** Send authoritative link
4. **Alert:** Immediate text to studio owner/web manager: "Your receptionist lost connection to your schedule at [time]. Please check your [platform] connection."

If connection remains failed:
- Receptionist continues in Link-Out Mode
- Daily digest to owner if not resolved within 24 hours
- Dashboard warning in YogaNearMe studio portal

---

## 4. Core Product Capabilities

### 4.1 Inbound Voice (Link-First Architecture)

- Voice handles intent + empathy
- SMS handles transactions
- AI never collects payment info by voice
- If unsure → text authoritative link

### 4.2 Yoga Brain (Domain Intelligence)

Yoga Brain is the receptionist's knowledge layer. It consists of:

**A) Studio Truth Table (Per-Studio, Configured During Onboarding)**

| Category | Data Points |
|----------|-------------|
| **Logistics** | Parking, mat rental/required, towel service, showers, lockers, changing rooms |
| **Policies** | Late arrival policy, cancellation policy, refund policy, makeup class policy |
| **Environment** | Heated (temp range), AC, humidity, scent-free policy |
| **Amenities** | Props provided, water available, retail shop, café |
| **Access** | Wheelchair accessible, elevator, stairs only |
| **Contact** | Hours, address, emergency contact, owner/manager name |

**B) Style Matrix (Global + Studio-Customizable)**

| Goal/Need | Recommended Styles | Contraindicated |
|-----------|-------------------|-----------------|
| Relaxation/stress relief | Yin, Restorative, Yoga Nidra | Power, Hot |
| Workout/fitness | Vinyasa, Power, Ashtanga, Hot | Restorative, Yin |
| Flexibility | Yin, Hatha, Stretch | — |
| Strength building | Power, Vinyasa, Ashtanga | Restorative |
| Beginner-friendly | Hatha, Gentle, Basics | Ashtanga, Advanced Vinyasa |
| Meditation focus | Yin, Restorative, Kundalini | Power, Hot |
| Back pain (general) | Gentle, Hatha, Therapeutic | Hot, Power (recommend consult) |
| Prenatal | Prenatal-specific classes only | Hot, Power, Deep twists, Inversions |
| Senior/limited mobility | Chair, Gentle, Restorative | Power, Hot, Fast Vinyasa |

**C) Safety Flags (Per-Style, Configurable)**

Each class/style can have flags:
- `prenatal_safe`: yes / no / ask_doctor
- `injury_considerations`: text field for common modifications
- `heat_level`: none / warm / hot
- `intensity`: gentle / moderate / vigorous
- `inversion_heavy`: yes / no

**D) Prenatal/Medical Handling**

If caller mentions pregnancy, injury, or medical condition:

1. **Never recommend heated classes** for prenatal
2. **Never claim a class is "safe"** for any medical condition
3. **Response pattern:** "We have prenatal-specific classes on [days]. For any class, I'd recommend checking with your doctor first. Want me to text you the prenatal schedule?"
4. If studio has no prenatal classes: "I don't see prenatal-specific classes on the schedule, but [instructor] teaches gentle classes that some expectant mothers attend. I'd recommend calling the studio to discuss your needs, or checking with your doctor."

**E) Studio-Specific Customization**

Studios can:
- Add custom style names (map "Inferno" → Hot Yoga)
- Override default recommendations
- Add instructor specialties
- Mark specific classes with safety flags
- Add custom FAQ responses

**Configuration UI:** Checklist + text fields during onboarding, editable in dashboard.

### 4.3 Yoga Brain Data Ingestion

**Initial load:** During onboarding, receptionist ingests:
- All schedule data (classes, times, instructors, descriptions)
- All booking/payment links
- Studio Truth Table data
- Style configurations

**Ongoing sync:**
- Native integrations: Real-time or near-real-time (per API)
- Google Calendar: Hourly (premium) or nightly (standard)
- Manual: On studio update

**Change detection:**
- New class added → receptionist learns immediately (next sync)
- Class cancelled → receptionist knows not to recommend
- Link changed → receptionist uses new link immediately
- Alert to owner: "Your schedule was updated. Receptionist is synced."

---

## 5. Student Data & Attendance Awareness

### Levels

**Level 1: Recognition (Default)**
- Phone number → new vs returning flag
- Enables: "Welcome back" vs "first time" greeting

**Level 2: Member Context (Retention Module Required)**
- Membership status (active/inactive)
- Class pack balance / credits remaining
- Last visit date
- Membership renewal date
- Enables: "You have 3 credits left—want the schedule link?"

**Level 3: Preferences (Pro Tier, Opt-in Only)**
- Preferred class types/instructors/time windows
- Attendance patterns
- Notes (injury/pregnancy) — sensitive, OFF by default
- Enables: Personalized weekly plans, milestone celebrations

### Controls

- Field-level permissions (studio chooses what to share)
- Audit logs (what data accessed, when, why)
- Sensitive data OFF by default
- "Forget Me" workflow for students
- TCPA and CCPA compliant

---

## 6. Retention Module (Add-On, $39/month)

The Retention Module is a separate purchasable add-on, not included in Base Tier.

### Features

**Weekly Plan Texts (Lead/Student Freshener)**
- Sent Sundays (configurable)
- Opt-in only (explicit SMS consent required)
- Content: Personal note + relevant classes + schedule link
- Example: "Hi [Name], here's your week at [Studio]. Tuesday 6pm Vinyasa with [Instructor] has spots. [Link]"

**Attendance-Aware Check-ins**
- Trigger: Student hasn't visited in 14+ days (configurable)
- Content: Gentle, non-pushy ("We miss you! Here's what's coming up...")
- Frequency cap: Max 1 per 14 days

**Lead Freshening**
- Target: Inquiries who never booked
- Trigger: 7 days after initial contact, no booking
- Content: "Still thinking about trying [Studio]? Here's this week's intro offer: [Link]"

**Student Refreshening (Ghost Protocol)**
- Trigger: >30 days inactivity
- Disabled until consent verified
- Content: Re-engagement offer (if studio provides one)
- Revenue tracked as "Re-Ignited MRR"

**Milestone Celebrations (Pro Tier)**
- 10th class, 50th class, 1-year anniversary
- Configurable rewards/messages

### Compliance Requirements

- All outbound SMS requires explicit opt-in
- STOP/HELP handling mandatory
- Quiet hours enforced (no texts before 9am or after 8pm local)
- Frequency caps per recipient
- Consent logged (who, when, scope)

---

## 7. Schedule Connect (Data Access Layer)

Schedule Connect is the foundational infrastructure that enables both directory schedule display and receptionist functionality. See MRD Section 5 for full specification.

### Connection Tiers

| Tier | Source | Schedule Display | Booking | Receptionist Mode |
|------|--------|------------------|---------|-------------------|
| **Native Integration** | Mindbody, WellnessLiving, Vagaro, Momoyoga | Real-time | Deep link or in-app | Full capability (Modes 1-3) |
| **Google Calendar** | Public Google Calendar link | Hourly/nightly sync | Link-out to studio-provided URL | Link-Out Mode only |
| **Manual Entry** | Studio enters in YogaNearMe dashboard | Manual updates | Link-out to studio-provided URL | Link-Out Mode only |

### Connection Points

Schedule Connect can be configured at two points:
1. **Listing claim flow:** Studio claims listing → prompted to connect schedule → schedule appears on listing page
2. **Receptionist onboarding:** Studio signs up for receptionist → must connect schedule to proceed

### Connection UI

**"How do you manage your schedule?"**

```
○ Mindbody → [OAuth flow]
○ WellnessLiving → [OAuth flow]
○ Vagaro → [OAuth flow]
○ Momoyoga → [OAuth flow]
○ Other scheduling software → [Contact us]
○ Google Calendar → [Paste public calendar URL]
○ I don't have a digital schedule → [Guide to creating Google Calendar]
```

**After selection:**
- Native: OAuth authorization flow
- Google Calendar: Paste URL → validate → provide booking link URL
- Manual: Enter classes in dashboard

### Website Scrape (Demo Only)

For the "Play With Me" demo, we scrape the studio website for schedule information.

**Boundaries:**
- Demo use only—not a persistent data source
- Scraped data marked as "unverified" and requires confirmation during onboarding
- Scrape confidence level determines demo language (see Section 2.1)
- Studios cannot opt out of scraping (it's public website data) but scraped data is never used for production receptionist without verification

**Scrape does not determine Operating Mode.** Even high-confidence scrape = Link-Out Mode only.

### Data Requirements

**Minimum (Google Calendar / Manual):**
- Class name
- Date/time
- Duration
- Booking link (one URL for all classes)

**Preferred (Native Integrations):**
- Class name and description
- Instructor name
- Date/time and duration
- Class type/style tags
- Capacity and availability
- Direct booking link per class
- Location (for multi-location studios)

### Failure Handling

See Section 3.3 for connection failure handling during calls.

**Sync failure handling:**
- Retry with exponential backoff (1min, 5min, 15min, 1hr)
- After 3 failures: Alert to studio owner
- After 24 hours: Dashboard warning + daily digest
- Receptionist continues in Link-Out Mode with last known data

---

## 8. Multi-Location Studios

### Architecture

- Each studio location gets a unique phone number
- One receptionist instance answers all locations
- Receptionist identifies location by inbound phone number
- All locations share Yoga Brain configuration (with per-location overrides)

### Configuration

**Per-location settings:**
- Phone number (assigned by system)
- Address and logistics (parking, etc.)
- Schedule (can be same or different per location)
- Booking links

**Shared settings:**
- Style Matrix and recommendations
- Policies (unless overridden)
- Owner/manager contacts
- Branding and tone

### Call Handling

1. Call comes in to location-specific number
2. Receptionist identifies location from number
3. Greeting includes location: "Thanks for calling [Studio] [Location Name]..."
4. Recommendations and links are location-specific

### Pricing

- Base tier includes 1 location
- Additional locations: +$29/month each
- Pro tier includes up to 4 locations

---

## 9. Compliance & Messaging Constraints

### Message Types

**Transactional (allowed on interaction):**
- Booking confirmations
- Schedule links requested by caller
- Payment links requested by caller
- Directions/address

**Marketing (explicit opt-in required):**
- Weekly plan texts
- Re-engagement messages
- Promotional offers
- Review requests

### Requirements

- Consent logging (who, when, scope, method)
- STOP / HELP handling (immediate, automated)
- Quiet hours: No texts before 9am or after 8pm recipient local time
- Frequency caps: Max 4 marketing messages per month per recipient
- Country-aware rules (US/Canada for v1)
- Opt-out honored within 24 hours (target: immediate)

---

## 10. Human Escalation & Safety

### Escalation Triggers

| Trigger | Response |
|---------|----------|
| Injury / pregnancy mentioned | No fitness advice; recommend prenatal classes if available; suggest consulting doctor |
| Complaint / refund request | "Let me have [owner/manager] call you back. What's the best number?" → Log for callback |
| Harassment / threat | Terminate call immediately; flag for review; log incident |
| Emergency language ("hurt," "911," "emergency") | "If this is an emergency, please call 911. Otherwise, let me connect you with the studio." |
| Explicit request for human | "Let me have someone call you back. What's the best number and time?" |
| Repeated frustration / confusion | Offer human callback after 2 failed attempts to resolve |

### Logging

All escalations are:
- Logged with timestamp, reason, and call context
- Surfaced in studio dashboard
- Included in daily digest to owner (if enabled)
- Flagged for review if harassment/threat

---

## 11. Analytics & KPIs

### Product Quality Metrics

| Metric | Target | Threshold | P0 if below |
|--------|--------|-----------|-------------|
| Call answer rate | 99%+ | 97% | 95% |
| Successful call completion | 98%+ | 95% | 90% |
| Voice latency (P50) | <500ms | <800ms | >1500ms |
| Voice latency (P95) | <1000ms | <1500ms | >2500ms |
| SMS delivery rate | 99%+ | 97% | 95% |
| Link click-through rate | >40% | >25% | <15% |
| Mode violations | 0 | 0 | >0 |
| Escalation rate | <15% | <20% | >30% |

### Business Metrics

| Metric | Target (Month 6) | Target (Month 12) |
|--------|------------------|-------------------|
| Studios on receptionist | 100 | 500 |
| Monthly recurring revenue | $8,000 | $50,000 |
| Churn rate (monthly) | <5% | <4% |
| NPS | >40 | >50 |
| Demo → trial conversion | >20% | >25% |
| Trial → paid conversion | >40% | >50% |
| Active usage (calls/week) | >5 | >5 |

---

## 12. System Architecture (Authoritative)

```
flowchart LR
    Caller --> Telco --> VoiceAI[Voice AI Platform*]
    VoiceAI --> Orchestrator
    Orchestrator --> ModeEngine
    Orchestrator --> IntentEngine
    Orchestrator --> YogaBrain
    Orchestrator --> StudentContext
    Orchestrator --> ScheduleConnect
    Orchestrator --> Consent --> SMS
    Orchestrator --> Events --> Metrics
```

*Voice AI Platform: Retell.ai or equivalent (to be confirmed)

**Invariant enforced at Orchestrator + ModeEngine boundary.**

### Component Responsibilities

| Component | Responsibility |
|-----------|----------------|
| **Telco** | Phone number provisioning, call routing |
| **Voice AI Platform** | Speech-to-text, text-to-speech, conversation management |
| **Orchestrator** | Central coordinator; enforces mode invariant |
| **ModeEngine** | Determines and locks operating mode at call start |
| **IntentEngine** | Classifies caller intent (book, ask, complain, etc.) |
| **YogaBrain** | Domain knowledge (styles, recommendations, studio truth) |
| **StudentContext** | Member data lookup (if enabled) |
| **ScheduleConnect** | Schedule data access layer |
| **Consent** | SMS permission checking and logging |
| **SMS** | Message delivery (Twilio or equivalent) |
| **Events** | Immutable event logging |
| **Metrics** | Analytics and alerting |

---

## 13. Inbound Call Sequence

```
sequenceDiagram
    participant Caller
    participant VoiceAI
    participant Orchestrator
    participant ModeEngine
    participant YogaBrain
    participant ScheduleConnect
    participant Consent
    participant SMS

    Caller->>VoiceAI: Call begins
    VoiceAI->>Orchestrator: New call event
    Orchestrator->>ModeEngine: Determine mode
    ModeEngine->>ScheduleConnect: Check connection status
    ScheduleConnect-->>ModeEngine: Connection tier + health
    ModeEngine-->>Orchestrator: Mode locked (e.g., Link-Out)
    Note right of ModeEngine: Mode may only downgrade from here
    
    Orchestrator->>YogaBrain: Load studio context
    Orchestrator->>VoiceAI: Greeting
    VoiceAI->>Caller: "Thanks for calling [Studio]..."
    
    Caller->>VoiceAI: "Do you have yoga for beginners?"
    VoiceAI->>Orchestrator: Intent: class recommendation
    Orchestrator->>YogaBrain: Query: beginner-friendly
    YogaBrain-->>Orchestrator: Recommend: Gentle, Hatha, Basics
    Orchestrator->>ScheduleConnect: Get upcoming Gentle/Hatha classes
    ScheduleConnect-->>Orchestrator: Classes + links
    Orchestrator->>VoiceAI: Response with recommendation
    VoiceAI->>Caller: "We have a Gentle Yoga class Tuesday at 6pm..."
    
    Orchestrator->>Consent: Check SMS permission
    Consent-->>Orchestrator: Permitted (transactional)
    Orchestrator->>SMS: Send booking link
    SMS->>Caller: [Booking link via SMS]
    Orchestrator->>VoiceAI: "I just texted you the link to book."
```

---

## 14. Failure & Fallback Strategy

```
flowchart TD
    Start[Call Begins] --> CheckMode[ModeEngine: Determine Mode]
    CheckMode --> LockMode[Lock Mode for Call Duration]
    LockMode --> HandleIntent[Handle Caller Intent]
    
    HandleIntent --> CheckDeps{Dependencies Available?}
    CheckDeps -->|Yes| ProcessNormally[Process with Current Mode]
    CheckDeps -->|No| Downgrade[Downgrade Mode]
    
    Downgrade --> LinkOut[Switch to Link-Out Mode]
    LinkOut --> SafeLanguage[Use Conservative Language]
    SafeLanguage --> TextLink[Text Authoritative Link]
    TextLink --> AlertOwner[Alert Studio Owner]
    
    ProcessNormally --> Success[Complete Call]
    TextLink --> Success
```

**Invariant enforced: failure → downgrade only.**

### Specific Failure Scenarios

| Failure | Response |
|---------|----------|
| ScheduleConnect timeout | Downgrade to Link-Out; use cached schedule if <24h old |
| ScheduleConnect returns stale data | Downgrade to Link-Out; flag data as potentially stale |
| Voice AI latency spike | Continue with delay; do not upgrade mode |
| SMS delivery failure | Retry once; if fails, offer verbal link; log for follow-up |
| Student context unavailable | Continue without personalization; don't claim to not recognize |
| YogaBrain query fails | Use generic safe language; don't make specific recommendations |

---

## 15. Data Model (Multi-Tenant Safe)

### Core Entities

```
Studio
├── studio_id (PK)
├── name
├── locations[]
├── schedule_connection (FK)
├── yoga_brain_config (FK)
├── settings
└── owner_contacts[]

Location
├── location_id (PK)
├── studio_id (FK)
├── phone_number (unique)
├── address
├── logistics{}
└── schedule_override (optional)

ScheduleConnection
├── connection_id (PK)
├── studio_id (FK)
├── connection_type (native|google|manual)
├── credentials (encrypted)
├── last_sync
├── sync_status
└── booking_link_default

Call
├── call_id (PK)
├── studio_id (FK)
├── location_id (FK)
├── caller_phone (hashed)
├── started_at
├── ended_at
├── mode_locked
├── mode_changes[]
├── intents[]
├── escalation_reason (nullable)
└── recording_url (if consented)

SMSMessage
├── message_id (PK)
├── call_id (FK, nullable)
├── recipient_phone (hashed)
├── message_type (transactional|marketing)
├── content
├── sent_at
├── delivered_at
├── consent_id (FK)
└── link_clicked_at (nullable)

Consent
├── consent_id (PK)
├── studio_id (FK)
├── phone (hashed)
├── scope (transactional|marketing|both)
├── granted_at
├── revoked_at (nullable)
├── method (voice|web|sms)
└── audit_log[]
```

### Data Principles

- All entities scoped by `studio_id` (multi-tenant isolation)
- Consent separated from messaging (auditable)
- Events immutable (append-only logs)
- Phone numbers hashed at rest
- PII minimized and encrypted

---

## 16. QA, Observability & Release Gates

### Required Before Shipping

| Gate | Requirement | Owner |
|------|-------------|-------|
| Mode invariant tests | 100% pass, including edge cases | QA |
| Consent logic validation | All paths tested, audit logs verified | QA + Compliance |
| Escalation paths verified | All triggers route correctly | QA |
| Fallback tests | All failure scenarios downgrade correctly | QA |
| Latency benchmarks | P50 <500ms, P95 <1000ms | Engineering |
| SMS delivery verification | >99% delivery rate in test | Engineering |
| TCPA compliance review | Legal sign-off | Compliance |
| Admin override functionality | Owner can pause/resume receptionist | Engineering |
| Monitoring dashboards | All KPIs visible and alerting | Engineering |
| Runbook documentation | Incident response documented | Engineering |

### Observability Requirements

- Real-time call monitoring dashboard
- Mode violation alerts (immediate page)
- Latency anomaly detection
- SMS delivery rate monitoring
- Consent audit trail queryable
- Per-studio usage dashboards

---

## 17. Voice Personality & Customization

### Voice Options

Studios select from 3 voice personalities during onboarding:

| Personality | Description | Best For |
|-------------|-------------|----------|
| **Warm** | Friendly, nurturing, slower pace | Studios emphasizing community, beginners, restorative focus |
| **Professional** | Clear, efficient, confident | High-volume studios, urban markets, fitness-forward branding |
| **Calm** | Soft, meditative, unhurried | Meditation-focused studios, retreats, therapeutic practices |

All voices are gender-neutral options available. Studio can preview each during onboarding and change anytime in dashboard.

### Greeting Customization

**Fixed elements (not customizable):**
- Call answer behavior
- Escalation triggers
- Safety language
- Mode-appropriate booking language

**Customizable elements:**

| Element | Default | Customizable |
|---------|---------|--------------|
| Studio name pronunciation | Auto-detected | Yes, phonetic override |
| Greeting phrase | "Thanks for calling [Studio], this is your AI assistant." | Yes, from templates |
| Owner/manager name for escalation | None | Yes |
| Closing phrase | "Is there anything else I can help with?" | Yes, from templates |
| Custom FAQ responses | None | Yes, up to 20 |
| Style name mappings | Standard names | Yes (e.g., "Inferno" → Hot Yoga) |

**Greeting templates (studio selects one):**
1. "Thanks for calling [Studio], this is your AI assistant. How can I help you today?"
2. "Hello and welcome to [Studio]. I'm here to help you find the perfect class."
3. "Namaste, you've reached [Studio]. What brings you to the mat today?"
4. "[Studio], how can I help?"

### Call Recording Policy

**Default:** Calls are recorded for quality and training purposes.

**Consent handling:**
- Greeting includes: "This call may be recorded for quality purposes."
- Studios can disable recording in dashboard
- Recordings retained for 30 days, then auto-deleted
- Studio owner can download recordings within retention window
- Student can request deletion via "Forget Me" workflow

**Compliance:**
- Two-party consent states (CA, FL, etc.): Disclosure in greeting satisfies requirement
- Recording consent is separate from SMS consent
- Recordings never shared with third parties
- Recordings not used for AI training without explicit studio consent

---

## 17b. Studio Dashboard (MVP)

### What Studio Owners See

**Home / Overview:**
- Calls today / this week / this month
- Top intents (booking inquiries, schedule questions, etc.)
- Missed calls / voicemails requiring attention
- Connection status (green = healthy, yellow = degraded, red = disconnected)
- Quick stats: SMS sent, links clicked, escalations

**Calls Tab:**
- Call log with timestamp, duration, caller (masked), outcome
- Filter by: date range, intent, escalation, mode
- Click to expand: transcript, SMS sent, recording (if enabled)
- Export to CSV

**Schedule Tab:**
- Current connection status
- Last sync time
- Preview of next 7 days
- "Reconnect" / "Change source" buttons
- Manual refresh button

**Settings Tab:**
- Voice personality selection
- Greeting customization
- Yoga Brain configuration (Truth Table, Style overrides)
- Escalation contacts
- SMS consent settings
- Recording on/off
- Notification preferences

**Analytics Tab (Growth/Pro):**
- Call volume trends
- Conversion funnel: calls → SMS sent → link clicked → (booking if trackable)
- Peak call times
- Top questions asked
- Escalation reasons breakdown
- ROI calculator: "Estimated value of answered calls"

**Retention Tab (Retention Module):**
- Upcoming scheduled messages
- Message history by recipient
- Opt-out list
- Re-engagement campaign status
- "Freshened" leads/students count

### Mobile Experience

- Dashboard is mobile-responsive
- Push notifications for: voicemails, escalations, connection failures
- Quick actions: pause receptionist, update hours, view today's calls

---

## 19. What We Don't Do (v1)

Explicitly out of scope for initial launch:

| Capability | Status | Rationale |
|------------|--------|-----------|
| Outbound calls | Deferred to v2 | Complexity + compliance risk |
| Payment processing by voice | Never | Security risk too high |
| Real-time booking without native integration | Never | Cannot guarantee accuracy |
| Multi-language (non-English) | Deferred to v2 | Spanish priority for v2 |
| Custom voice cloning | Deferred | Cost + complexity |
| Video calls | Not planned | Different product |
| Booking modifications for Google Calendar users | Never | No write access |
| Medical advice | Never | Liability |
| Fitness recommendations for medical conditions | Never | Liability; always defer to doctor |

---

## 20. Engineering Decisions (Locked)

| Decision | Choice | Rationale |
|----------|--------|-----------|
| Voice AI platform | **Retell** | Best documentation, yoga-friendly voice options, reasonable pricing |
| SMS provider | **Twilio** | Industry standard reliability, strong compliance features, proven scale |
| Voicemail fallback | **Yes, with transcription** | Captures intent when caller doesn't engage; transcription enables SMS follow-up |
| Booking attribution | **Unique links with click tracking** | Each studio gets unique booking URLs; clicks tracked for ROI proof |

### Voicemail Specification

When caller reaches voicemail (receptionist doesn't pick up or caller requests):

1. **Greeting:** "You've reached [Studio]. Leave a message and we'll text you back shortly."
2. **Recording:** Max 2 minutes
3. **Processing:** Transcription via Retell/Twilio
4. **Follow-up:** SMS to caller within 5 minutes: "Thanks for calling [Studio]. We got your message about [summary]. Here's [relevant link] or reply to this text and we'll get back to you."
5. **Alert:** Studio owner notified via dashboard + optional SMS

### Booking Attribution Specification

Each studio receives:
- Unique booking URL: `yoganearme.info/book/[studio-slug]` → redirects to their booking page
- Click tracking: timestamp, referrer, device
- Monthly report: "You received X clicks from YogaNearMe this month"
- Optional: UTM parameters appended for studios using Google Analytics

## 20b. Open Questions (Remaining)

| Question | Options | Status |
|----------|---------|--------|
| ClassPass integration | Pursue for schedule read, or treat as separate | Deferred to v2 |
| Spanish language support | Add in v2, or later | Deferred to v2 |
| Outbound appointment reminders | Voice or SMS-only | Deferred to v2 |

---

## 21. Pricing Reference

See MRD Section 7 for full pricing framework.

**Summary:**

| Tier | Price | Includes |
|------|-------|----------|
| Base (Receptionist) | $79/month | Unlimited calls, link texting, FAQ, 1 location |
| Retention Module | +$39/month | Weekly texts, attendance check-ins, lead/student freshening |
| Pro | $149/month | Base + Retention + reviews + waitlist + 4 locations |
| Additional locations | +$29/month | Per location beyond tier allowance |

**Launch pricing (first 100 studios):** $49/month base, $29/month retention (6 months)

---

## 22. Final System Invariant (Global)

> **The system is allowed to reduce its promises at any time. It is never allowed to increase its promises once a call begins.**

This invariant supersedes all other behavior.

---

## 23. Document History

| Version | Date | Changes |
|---------|------|---------|
| v2.3 | Jan 13, 2026 | Locked engineering decisions (Retell, Twilio, voicemail, attribution); added voice personality options; added greeting customization; added call recording policy; added studio dashboard MVP spec |
| v2.2 | Jan 13, 2026 | Aligned with MRD v4.4; added Yoga Brain detail; added demo→trial flow; added multi-location; added v1 scope boundaries; added pricing reference; clarified Schedule Connect tiers |
| v2.1 | Jan 13, 2026 | Operating Mode Invariant formalized |
| v2.0 | Jan 12, 2026 | Initial production-ready draft |

---

*This document defines what the system can do, what it must never do, how it fails safely, and how it earns trust at scale.*
