# Schedule Connect PRD v1.0

**Product:** Schedule Connect  
**Date:** January 13, 2026  
**Version:** 1.0  
**Status:** Build-Ready  
**Dependencies:** YogaNearMe directory, AI Receptionist, Retention Module

---

## 1. Overview

### What Is Schedule Connect?

Schedule Connect is the foundational infrastructure layer that syncs yoga studio schedules into YogaNearMe. It is not a standalone product—it's a capability that enables:

1. **Live schedules on listing pages** — Searchers see real class times, not static info
2. **AI Receptionist functionality** — Receptionist needs schedule data to recommend classes
3. **Retention Module** — Attendance-aware messaging needs to know what classes exist
4. **Booking attribution** — Track which bookings came from YogaNearMe

### Why Build This?

**For searchers:** A directory with live schedules is dramatically more useful than static listings. "Yoga near me" becomes "yoga classes available tonight near me."

**For studios:** Connected schedule = bookings attributed to YogaNearMe = proof of value = reason to engage with listing and upgrade to premium.

**For YogaNearMe:** Schedule Connect transforms us from directory to platform. It's the primitive that enables receptionist, retention, and future products.

### Success Metrics

| Metric | Target (Month 3) | Target (Month 6) |
|--------|------------------|------------------|
| Claimed listings with connected schedule | 500 | 2,000 |
| Schedule freshness (synced <24h) | 95% | 98% |
| "Book" button CTR on listings | 3% | 5% |
| Conversion: schedule connected → receptionist trial | — | 10% |

---

## 2. User Stories

### Studio Owner

> "I claimed my listing on YogaNearMe. Now I want my class schedule to show up so students can find my classes and book."

> "I already use Mindbody. I don't want to enter my schedule twice."

> "I just use Google Calendar for my small studio. I want that to work too."

### Searcher

> "I'm looking for a vinyasa class tonight near me. I want to see what's actually available, not just studio hours."

> "I found a class I like. I want to book it without calling the studio."

### AI Receptionist

> "A caller asks about tomorrow's 9am class. I need to know if it exists and send them the booking link."

---

## 3. Connection Tiers

### Tier 1: Native Integration (Best Experience)

**Platforms:** Mindbody, WellnessLiving, Momoyoga, Vagaro

**Capabilities:**
- Real-time or near-real-time schedule sync
- Class details: name, instructor, time, duration, style, capacity
- Availability checking (where API supports)
- Deep links to specific class booking pages
- Member data access (for Receptionist Levels 2-3)

**Receptionist Mode:** Full capability (Modes 1-3)

**Setup:** OAuth authorization flow

### Tier 2: Google Calendar (Good Fallback)

**Source:** Public Google Calendar URL

**Capabilities:**
- Schedule sync (hourly for premium, nightly for standard)
- Class details: name, time, duration (from event title/description)
- Single booking link for all classes (studio provides)
- No availability checking
- No member data

**Receptionist Mode:** Link-Out Mode only

**Setup:** Paste public calendar URL + provide booking link

### Tier 3: Manual Entry (Last Resort)

**Source:** Studio enters classes in YogaNearMe dashboard

**Capabilities:**
- Studio-managed schedule
- Basic class details
- Single booking link
- No sync (manual updates only)
- No member data

**Receptionist Mode:** Link-Out Mode only

**Setup:** Form-based entry in dashboard

---

## 4. Connection Flow

### Entry Points

Schedule Connect can be triggered at two points:

1. **Listing claim flow:** Studio claims listing → "Connect your schedule to show classes on your listing"
2. **Receptionist onboarding:** Studio signs up for receptionist → "Connect your schedule to power your receptionist"

Both flows use the same connection UI and backend.

### Connection UI

```
┌─────────────────────────────────────────────────────────────┐
│  Connect Your Schedule                                       │
│                                                              │
│  How do you manage your class schedule?                      │
│                                                              │
│  ○ Mindbody                                                  │
│  ○ WellnessLiving                                            │
│  ○ Momoyoga                                                  │
│  ○ Vagaro                                                    │
│  ○ Other scheduling software                                 │
│  ○ Google Calendar                                           │
│  ○ I don't have a digital schedule                          │
│                                                              │
│                                        [Continue →]          │
└─────────────────────────────────────────────────────────────┘
```

### Flow by Selection

**Mindbody / WellnessLiving / Momoyoga / Vagaro:**
1. Click platform → "Connect with [Platform]" button
2. OAuth popup → Studio logs into their platform account
3. Authorize YogaNearMe to read schedule data
4. Success → "Your schedule is connected! Classes will appear on your listing within 1 hour."
5. Redirect to listing preview or dashboard

**Other scheduling software:**
1. Click → "We're adding new integrations. Tell us what you use."
2. Form: Platform name, studio name, email
3. "We'll notify you when [Platform] is supported. Meanwhile, you can use Google Calendar."
4. Option to continue with Google Calendar

**Google Calendar:**
1. Click → Instructions appear:
   - "Make your calendar public (here's how)"
   - "Copy your public calendar URL"
2. Paste URL field
3. Validate URL (attempt to fetch calendar)
4. If valid: "Where should we send students to book?"
5. Paste booking link (website, scheduling page, etc.)
6. Success → "Your schedule is connected! Classes will appear on your listing within 24 hours."

**I don't have a digital schedule:**
1. Click → Helpful guidance:
   - "A digital schedule helps students find your classes."
   - "It takes 5 minutes to set up a Google Calendar."
   - [Link: "How to create a Google Calendar for your studio"]
2. Options:
   - "Set up Google Calendar" → Opens guide
   - "Enter classes manually" → Manual entry form
   - "I'll do this later" → Skip, listing remains without schedule

### Manual Entry Form

For studios who choose manual entry:

```
┌─────────────────────────────────────────────────────────────┐
│  Add Your Classes                                            │
│                                                              │
│  Class Name: [________________________]                      │
│  Day:        [Mon ▼]                                         │
│  Time:       [9:00 AM ▼]                                     │
│  Duration:   [60 min ▼]                                      │
│  Instructor: [________________________] (optional)           │
│  Style:      [Vinyasa ▼]               (optional)           │
│                                                              │
│  [+ Add Another Class]                                       │
│                                                              │
│  Booking Link (for all classes):                            │
│  [https://______________________________]                   │
│                                                              │
│                              [Save Schedule]                 │
└─────────────────────────────────────────────────────────────┘
```

---

## 5. Listing Page Display

### Schedule Widget

Once connected, the studio listing page displays an **informational** schedule section. The primary "Book" button remains in the hero section at the top of the page.

```
┌─────────────────────────────────────────────────────────────┐
│  📅 Today's Schedule                      Full Schedule >   │
│                                                              │
│  [Today] [Tomorrow] [Wed] [Thu] [Fri] [Sat] [Sun]           │
│  ─────────────────────────────────────────────────────────  │
│                                                              │
│  6:00 AM   Morning Ashtanga      Lisa Marie    [Intermediate]│
│  75 min                                                      │
│                                                              │
│  9:00 AM   Gentle Hatha          Sarah Chen    [All Levels] │
│  60 min                                                      │
│                                                              │
│  12:00 PM  Lunch Flow            Marcus Webb   [All Levels] │
│  45 min                                                      │
│                                                              │
│  5:30 PM   Vinyasa Flow          Lisa Marie    [Intermediate]│
│  60 min                                                      │
│                                                              │
│  7:30 PM   Restorative           Anna Kim      [All Levels] │
│  75 min                                                      │
└─────────────────────────────────────────────────────────────┘
```

### Widget Behavior

**Day tabs:** Show next 7 days. "Today" is filled/highlighted, future days are outlined.

**Class rows display:**
- Time + duration (left column, prominent)
- Class name (main headline)
- Instructor name (secondary, "with [Name]")
- Level badge (right side: Intermediate, All Levels, Beginner, etc.)

**No per-class booking buttons.** The schedule is informational — it helps searchers see what's available. The single "Book" button in the hero section takes them to the studio's booking page.

**Future enhancement (v2+):** For native integrations with deep link support, consider adding subtle per-class "Book this class" links that go directly to that specific class.

**"Full Schedule" link:** Opens studio's external schedule/booking page in new tab.

**Truncation:** If more than 6 classes in a day, show first 5 with "Show all [N] classes" expand link.

**Empty state:** "No classes scheduled for this day."

**No schedule connected:** 
```
┌─────────────────────────────────────────────────────────────┐
│  📅 Class Schedule                                           │
│                                                              │
│  Schedule not available.                                     │
│  Contact the studio for class times.                        │
│                                                              │
│  [Call Studio]  [Visit Website]                             │
└─────────────────────────────────────────────────────────────┘
```

### Widget for Studio Owners (Embeddable)

Studios can embed their YogaNearMe schedule on their own website:

```html
<iframe src="https://yoganearme.info/embed/schedule/[studio-slug]" 
        width="100%" height="400" frameborder="0">
</iframe>
```

**Or JavaScript widget:**
```html
<div id="ynm-schedule" data-studio="[studio-slug]"></div>
<script src="https://yoganearme.info/widget.js"></script>
```

Benefits for studios:
- Always in sync with their scheduling platform
- "Powered by YogaNearMe" link drives traffic back to directory
- No maintenance required

---

## 6. Data Model

### Core Entities

```
ScheduleConnection
├── connection_id (PK)
├── studio_id (FK)
├── connection_type (enum: mindbody, wellnessliving, momoyoga, vagaro, google_calendar, manual)
├── status (enum: active, disconnected, error, pending)
├── credentials (encrypted JSON - OAuth tokens, calendar URL, etc.)
├── booking_link_default (URL)
├── last_sync_at (timestamp)
├── last_sync_status (enum: success, partial, failed)
├── sync_error_message (text, nullable)
├── created_at
├── updated_at
└── settings (JSON - sync frequency, notifications, etc.)

ScheduleClass
├── class_id (PK)
├── studio_id (FK)
├── connection_id (FK)
├── external_id (string, nullable - ID from source platform)
├── class_name (string)
├── instructor_name (string, nullable)
├── style (string, nullable - maps to yoga style taxonomy)
├── level (enum: all_levels, beginner, intermediate, advanced, nullable)
├── day_of_week (int, 0-6)
├── start_time (time)
├── duration_minutes (int)
├── is_recurring (bool)
├── booking_link (URL, nullable - overrides default for deep linking)
├── capacity (int, nullable)
├── description (text, nullable)
├── is_active (bool)
├── source_data (JSON - raw data from platform)
├── created_at
├── updated_at
└── deleted_at (soft delete)

ScheduleException
├── exception_id (PK)
├── class_id (FK)
├── exception_date (date)
├── exception_type (enum: cancelled, modified, added)
├── modified_start_time (time, nullable)
├── modified_instructor (string, nullable)
├── reason (string, nullable)
└── created_at

SyncLog
├── log_id (PK)
├── connection_id (FK)
├── sync_started_at
├── sync_completed_at
├── status (enum: success, partial, failed)
├── classes_added (int)
├── classes_updated (int)
├── classes_removed (int)
├── error_message (text, nullable)
└── raw_response (JSON, nullable - for debugging)
```

### Data Flow

```
┌──────────────┐      ┌──────────────┐      ┌──────────────┐
│   Mindbody   │      │   Google     │      │   Manual     │
│   API        │      │   Calendar   │      │   Entry      │
└──────┬───────┘      └──────┬───────┘      └──────┬───────┘
       │                     │                     │
       ▼                     ▼                     ▼
┌─────────────────────────────────────────────────────────────┐
│                    Schedule Connect                          │
│                    (Sync Service)                            │
└──────────────────────────┬──────────────────────────────────┘
                           │
                           ▼
┌─────────────────────────────────────────────────────────────┐
│                    ScheduleClass Table                       │
│                    (Normalized Data)                         │
└──────────────────────────┬──────────────────────────────────┘
                           │
          ┌────────────────┼────────────────┐
          ▼                ▼                ▼
   ┌────────────┐   ┌────────────┐   ┌────────────┐
   │  Listing   │   │   AI       │   │ Retention  │
   │  Page      │   │ Receptionist│   │  Module   │
   └────────────┘   └────────────┘   └────────────┘
```

---

## 7. Sync Behavior

### Sync Frequency

| Connection Type | Standard | Premium/Receptionist |
|-----------------|----------|---------------------|
| Native (Mindbody, etc.) | Every 4 hours | Real-time webhook or hourly |
| Google Calendar | Nightly (2 AM local) | Hourly |
| Manual | On save | On save |

### Sync Process

**Native integrations:**
1. Fetch classes for next 14 days from API
2. Compare with existing ScheduleClass records
3. Add new classes, update changed classes, soft-delete removed classes
4. Log sync result
5. If errors: Retry with backoff, alert studio owner after 3 failures

**Google Calendar:**
1. Fetch iCal feed from public URL
2. Parse events for next 14 days
3. Map event title → class_name, event time → start_time
4. Attempt to extract instructor from description (regex patterns)
5. Update ScheduleClass records
6. Log sync result

### Error Handling

**Connection lost (OAuth expired, URL invalid):**
1. Mark connection status = 'error'
2. Immediate alert to studio owner: "Your schedule connection needs attention"
3. Dashboard shows warning banner
4. Listing page shows "Schedule temporarily unavailable" (not empty)
5. Receptionist downgrades to Link-Out Mode

**Partial sync (some classes failed):**
1. Log which classes failed
2. Continue with successful classes
3. Mark sync status = 'partial'
4. Alert studio owner if >50% failed

**Platform API down:**
1. Retry with exponential backoff (5min, 15min, 1hr, 4hr)
2. Use cached data (last successful sync)
3. Alert studio owner after 24 hours of failures

### Freshness Indicator

Listing page shows sync freshness to build trust:

- "Schedule updated just now" (< 1 hour)
- "Schedule updated today" (< 24 hours)
- "Schedule updated 2 days ago" (> 24 hours) — with warning styling
- "Schedule may be outdated" (> 7 days or error state)

---

## 8. Native Integration Specifications

### Mindbody (Priority 1)

**API:** Mindbody Public API v6

**Required scopes:**
- `Classes:read` — Get class schedules
- `Staff:read` — Get instructor names
- `Sites:read` — Verify site ownership

**Data mapping:**
| Mindbody Field | ScheduleClass Field |
|----------------|---------------------|
| Class.Name | class_name |
| Class.Staff.Name | instructor_name |
| Class.StartDateTime | start_time + day_of_week |
| Class.EndDateTime | (calculate duration) |
| Class.ClassDescription.Program.Name | style (fuzzy match) |
| Class.MaxCapacity | capacity |
| Class.Id | external_id |

**Booking link:** `https://[studio-site].mindbody.io/classic/ws?studioid=[id]&stype=-7&sView=day&sLoc=0&date=[date]&classId=[class_id]`

**Webhook support:** Yes — subscribe to class schedule changes for real-time sync

**Partner approval:** Required. Apply through Mindbody Developer Portal.

### WellnessLiving (Priority 2)

**API:** WellnessLiving API v1

**Required scopes:**
- `schedule:read`
- `staff:read`

**Data mapping:** Similar to Mindbody

**Booking link:** Deep link to specific class

**Webhook support:** Limited — polling recommended

### Momoyoga (Priority 3)

**API:** Momoyoga API

**Notes:** 
- Smaller platform, likely more responsive to partnership
- API documentation less mature
- May need direct relationship for integration

### Vagaro (Priority 4)

**API:** Vagaro API (limited)

**Notes:**
- API more restricted than competitors
- May only support link-out, not deep class links
- Evaluate partnership opportunity

---

## 9. Google Calendar Parsing

### Event Title Patterns

Parse class name and instructor from event title:

```
"Vinyasa Flow with Sarah"     → class: "Vinyasa Flow", instructor: "Sarah"
"9AM Hot Yoga - Mike"         → class: "Hot Yoga", instructor: "Mike"
"Gentle Yoga (Beginner)"      → class: "Gentle Yoga (Beginner)", instructor: null
"Power Hour"                  → class: "Power Hour", instructor: null
```

**Regex patterns:**
```
/^(.+?)\s+with\s+(.+)$/i           → class, instructor
/^(.+?)\s*[-–]\s*(.+)$/            → class, instructor (if second part is name-like)
/^(?:\d{1,2}(?::\d{2})?\s*(?:AM|PM)?\s*)?(.+)$/i  → strip leading time
```

### Event Description Parsing

Look for instructor in description:

```
"Instructor: Sarah Martinez"
"Teacher: Mike"
"Led by Lisa"
```

### Style Detection

Map class name to yoga style taxonomy:

| Keywords | Style |
|----------|-------|
| vinyasa, flow, power flow | Vinyasa |
| hatha, traditional | Hatha |
| hot, heated, bikram | Hot Yoga |
| yin, deep stretch | Yin |
| gentle, easy, beginner | Gentle |
| restorative, relax | Restorative |
| prenatal, pregnancy | Prenatal |
| kundalini, breath | Kundalini |

---

## 10. Booking Attribution

### Tracking Mechanism

Each "Book" button click is tracked:

```
GET /book/[studio-slug]?class=[class-id]&source=listing

→ Log: {
    studio_id,
    class_id (nullable),
    timestamp,
    source: "listing" | "widget" | "receptionist",
    referrer,
    user_agent
  }

→ Redirect to: booking_link (with UTM params appended)
```

### UTM Parameters

Append to booking links for studio Google Analytics:

```
?utm_source=yoganearme
&utm_medium=directory
&utm_campaign=schedule_widget
&utm_content=[class-name]
```

### Attribution Dashboard

Studios see in their dashboard:

- "Book" clicks this month: 47
- Top classes clicked: Vinyasa Flow (12), Hot Yoga (9), ...
- Peak click times: 6-8 PM (23 clicks)
- Source breakdown: Listing page (38), Widget (7), Receptionist (2)

---

## 11. Implementation Phases

### Phase 1: Google Calendar + Manual (Week 1-2)

**Goal:** Any studio can connect their schedule immediately

**Build:**
- Connection UI (Google Calendar + Manual paths)
- Google Calendar fetch and parse
- Manual entry form
- ScheduleClass data model
- Listing page schedule widget (basic)
- Sync service (nightly for GCal)

**Ship when:** 
- 10 test studios connected successfully
- Widget displays correctly on listings
- "Book" button tracks clicks

### Phase 2: Listing Page Polish (Week 3)

**Goal:** Schedule widget looks great and works perfectly

**Build:**
- Day tab navigation
- Responsive design (mobile)
- Empty states
- Freshness indicator
- Error states
- Embeddable widget for studio websites

**Ship when:**
- Passes design review
- Mobile tested on iOS + Android
- Widget embed tested on 3 studio sites

### Phase 3: Mindbody Integration (Week 4-6)

**Goal:** Studios on Mindbody get best experience

**Build:**
- Mindbody OAuth flow
- API integration (class fetch)
- Deep link booking URLs
- Webhook subscription (if approved)
- Real-time sync

**Ship when:**
- Partner approval received (or applied)
- 5 Mindbody studios connected in beta
- Sync reliability >99%

### Phase 4: Additional Integrations (Ongoing)

**Goal:** Cover majority of studio platforms

**Build (in order):**
1. WellnessLiving
2. Momoyoga
3. Vagaro (if API sufficient)

**Ship each when:**
- 3+ studios tested
- Sync reliable
- Documentation complete

---

## 12. Integration with AI Receptionist

### How Receptionist Uses Schedule Connect

When a call comes in:

1. **ModeEngine** checks ScheduleConnection status for studio
2. If `status = active` and `connection_type = native`: Mode 2 or 3 available
3. If `status = active` and `connection_type = google_calendar|manual`: Mode 1 only
4. If `status = error|disconnected`: Mode 1 with cached data (if fresh) or Link-Out with warning

### Data Access

Receptionist queries ScheduleClass for:
- "What classes do you have tomorrow morning?" → Filter by day + time range
- "Do you have vinyasa?" → Filter by style
- "What's Sarah teaching this week?" → Filter by instructor

### Link Retrieval

When receptionist needs to text a booking link:
1. Check if class has specific `booking_link`
2. Fall back to `ScheduleConnection.booking_link_default`
3. Append attribution params

---

## 13. Studio Dashboard

### Schedule Connection Card

```
┌─────────────────────────────────────────────────────────────┐
│  Schedule Connection                                 [Edit]  │
│                                                              │
│  ✅ Connected to: Google Calendar                            │
│  Last synced: 2 hours ago                                   │
│  Next sync: Tonight at 2:00 AM                              │
│                                                              │
│  Booking link: https://mystudio.com/book                    │
│                                                              │
│  [Sync Now]  [Disconnect]  [Change Source]                  │
└─────────────────────────────────────────────────────────────┘
```

### Connection Error State

```
┌─────────────────────────────────────────────────────────────┐
│  ⚠️  Schedule Connection Issue                               │
│                                                              │
│  We couldn't sync your schedule.                            │
│  Error: Calendar URL is no longer accessible                │
│                                                              │
│  Your listing is showing cached schedule from 3 days ago.   │
│                                                              │
│  [Reconnect]  [Update Calendar URL]  [Get Help]             │
└─────────────────────────────────────────────────────────────┘
```

### Schedule Preview

Studios can preview what appears on their listing:

```
┌─────────────────────────────────────────────────────────────┐
│  Schedule Preview                              [Edit Classes]│
│                                                              │
│  This is what students see on your listing:                 │
│                                                              │
│  ┌─────────────────────────────────────────────────────┐    │
│  │  (embedded preview of listing schedule widget)      │    │
│  └─────────────────────────────────────────────────────┘    │
│                                                              │
│  Missing something? Check your calendar or add classes      │
│  manually.                                                  │
└─────────────────────────────────────────────────────────────┘
```

---

## 14. Notifications

### To Studio Owner

| Event | Channel | Message |
|-------|---------|---------|
| Schedule connected | Email | "Your schedule is live! Students can now see your classes on YogaNearMe." |
| Sync failed (first) | Email + Dashboard | "We couldn't sync your schedule. [Action needed]" |
| Sync failed (3x) | Email + SMS | "Your YogaNearMe schedule is offline. Students can't see your classes." |
| Connection expiring | Email | "Your Mindbody connection expires in 7 days. [Reconnect]" |
| Weekly summary | Email (optional) | "This week: 23 students viewed your schedule, 8 clicked Book" |

### To YogaNearMe Team

| Event | Channel | Action |
|-------|---------|--------|
| Native integration errors spike | Slack alert | Investigate API issues |
| New platform requested (5+ studios) | Email digest | Evaluate for integration |
| Connection success rate drops | Dashboard alert | Investigate |

---

## 15. Open Questions

| Question | Options | Recommendation |
|----------|---------|----------------|
| Sync frequency for free vs premium? | Same for all vs tiered | Tiered (hourly for premium/receptionist, nightly for free) |
| Show capacity/availability on listing? | Yes (if available) vs No | Yes for native integrations, creates urgency |
| Allow manual override of synced classes? | Yes vs No | No for v1 — sync is source of truth |
| Cache duration when connection fails? | 24h vs 7d vs indefinite | 7 days, then show "outdated" warning |

---

## 16. Success Criteria

### Phase 1 (Google Calendar + Manual) Complete When:

- [ ] 50 studios have connected schedules
- [ ] Schedule widget renders correctly on all listing pages
- [ ] "Book" click tracking working
- [ ] Sync service running reliably (>99% uptime)
- [ ] Error notifications delivered to studio owners
- [ ] Mobile experience acceptable

### Full Schedule Connect Complete When:

- [ ] Mindbody integration live
- [ ] 500+ studios with connected schedules
- [ ] AI Receptionist successfully reading schedule data
- [ ] Attribution dashboard showing value to studios
- [ ] Embeddable widget adopted by 50+ studios

---

## Document History

| Version | Date | Changes |
|---------|------|---------|
| v1.1 | Jan 13, 2026 | Updated widget to informational-only (no per-class Book buttons); added level field to data model; added truncation behavior |
| v1.0 | Jan 13, 2026 | Initial PRD |
