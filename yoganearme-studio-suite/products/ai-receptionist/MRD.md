# Market Requirements Document (MRD) v4.4

**Product:** YogaNearMe AI Receptionist  
**Date:** January 13, 2026  
**Version:** 4.4  
**Status:** Build-Ready  
**Companion Document:** PRD v2.2

---

## 1. Executive Summary

**Product:** YogaNearMe AI Receptionist — Vertical SaaS voice + SMS assistant for yoga studios.

**Vision:** A studio-grade receptionist that answers every call instantly, recommends the right class, and converts intent into bookings and purchases via secure links—while increasing retention with attendance-aware nudges and weekly planning texts.

**Primary Outcome:** More booked classes and fewer missed-call losses.

**Secondary Outcome:** Higher retention and better weekly attendance consistency (via optional Retention Module).

**Target Market (v1):** Yoga studios in North America, 1–4 locations, with online schedules and willingness to use compliant SMS.

**Wedge:** Instant demo ("Play With Me") + link-out conversion + yoga-native guidance + distribution to 30,000 listed studios.

---

## 2. ICP and Anti-ICP

### ICP v1

- 1–4 locations, lean front desk or owner-run
- Uses Mindbody, WellnessLiving, Vagaro, Momoyoga, or Google Calendar for scheduling
- Has intro offer and consistent weekly schedule
- Wants fewer missed calls + better retention

### Anti-ICP

- No digital schedule and unwilling to create one
- Refuses texting or cannot capture consent
- Extremely custom, constantly changing pricing/policies without a single source of truth
- Very low call volume (<10 calls/month)

---

## 3. Competitive Positioning

### Why Not Mindbody/WellnessLiving Built-in Messaging?

- Limited to transactional notifications
- Not conversational—can't recommend classes or answer questions
- No phone answering capability

### Why Not Generic AI Receptionists (Smith.ai, Ruby)?

- Don't know yoga—can't explain vinyasa vs. power, recommend classes for back pain, or understand studio terminology
- Expensive per-minute pricing ($200-400/month for typical call volume)
- Not integrated with yoga scheduling platforms

### Why Not DIY (Owner Answers the Phone)?

- Doesn't scale—owner is teaching, not at the desk
- Leads to burnout and missed calls during peak hours
- No after-hours coverage

### Our Defensible Wedge

- **Yoga-native intelligence:** Understands styles, levels, modifications, studio terminology
- **Distribution:** 30,000 listed studios on YogaNearMe, already in relationship with us
- **Price:** Flat monthly fee undercutting per-minute competitors
- **Integration:** Schedule Connect works with platforms studios already use

**Note:** Yoga-native knowledge is copyable over time. Our durable advantage is distribution + trust + integrated ecosystem (directory → receptionist → retention → full Studio Suite).

---

## 4. Product Experience

### A) "Play With Me" Instant Demo

**Promise (safe):** "I answer questions and text the exact link to book or buy."

**Avoid promising:** Real-time booking unless integrated and verified.

**Demo Flow:**

1. Visitor enters studio website URL + phone number
2. System scrapes website (≤15s with progressive loading)
3. Demo call adapts language to scrape confidence level
4. Call demonstrates: greeting → recommendation → SMS with link
5. SMS closer: "Claim this receptionist here: [Link]"

**Demo Guarantee:** Demo operates in Link-Out Mode only. Never claims availability certainty. Never books.

**Demo-to-Trial Flow:**

1. Click claim link → landing page
2. Account creation (email or Google OAuth)
3. Studio verification
4. Trial: 14 days free, full Base Tier, no credit card
5. Onboarding: Schedule Connect + Yoga Brain configuration

### B) Core Inbound Call Handling (MVP)

**Must reliably do:**

- Answer instantly, confirm studio identity
- Recommend class/style based on goals and constraints
- Provide accurate basics via link-first policy (pricing, intro offers, schedule, policies)
- Text links: booking, intro offer, secure payment, waiver, directions, cancellation policy
- Escalate to humans with clear handoff paths

**Non-negotiable guardrail:** If uncertain, agent does not guess—it texts the authoritative link or escalates.

**Connection failure handling:** If schedule data becomes unavailable mid-call, receptionist immediately texts owner, informs caller ("I've lost my connection to the schedule"), and provides authoritative link.

### C) Configuration: Outcomes, Not Settings

Owners configure what they want to happen, not technical settings:

**Base Tier (Receptionist) — $79/month**
- Instant answering
- Class recommendations via Yoga Brain
- FAQ handling
- Link texting (booking, payment, policies)
- Human escalation paths
- Single location included

**Retention Module (Add-On) — $39/month**
- Attendance-aware check-ins
- Weekly planning texts
- Lead freshening (re-engage cold inquiries)
- Student refreshening (re-engage lapsed members)
- Milestone celebrations

**Pro Tier — $149/month (Future)**
- Everything in Base + Retention
- Review request automation
- Waitlist capture and management
- Reactivation campaigns with offers
- Multi-location support (up to 4 locations)
- Priority support

**Additional locations:** +$29/month each

---

## 5. Schedule Connect (Foundational Capability)

### Purpose

Schedule Connect is the infrastructure layer that enables YogaNearMe to display studio schedules on listing pages and power the AI Receptionist. It is not a product itself—it's a capability that multiple products depend on.

### Why It Matters

- **For searchers:** Live schedules on listing pages make YogaNearMe more useful than static directory listings
- **For studios:** Connected schedule = bookings attributed to YogaNearMe = reason to engage with their listing
- **For receptionist:** Schedule data is required for class recommendations and booking handoffs
- **For retention module:** Attendance-aware messaging requires knowing what classes exist and when

### Connection Tiers

| Tier | Source | Schedule Display | Booking | Receptionist Mode |
|------|--------|------------------|---------|-------------------|
| **Native Integration** | Mindbody, WellnessLiving, Vagaro, Momoyoga | Real-time | Deep link or in-app (integration-dependent) | Full capability (Modes 1-3) |
| **Google Calendar** | Public Google Calendar link | Hourly (premium) / nightly (standard) | Link-out to studio-provided URL | Link-Out Mode only |
| **Manual Entry** | Studio enters classes in YogaNearMe dashboard | Manual updates by studio | Link-out to studio-provided URL | Link-Out Mode only |

### Connection Points

Schedule Connect can be configured at two points:
1. **Listing claim flow:** Studio claims listing → prompted to connect schedule → schedule appears on listing page
2. **Receptionist onboarding:** Studio signs up for receptionist → must connect schedule to proceed

### Connection UI

Checkbox list during onboarding:

```
"How do you manage your schedule?"

○ Mindbody → [OAuth flow]
○ WellnessLiving → [OAuth flow]  
○ Vagaro → [OAuth flow]
○ Momoyoga → [OAuth flow]
○ Other scheduling software → [Contact us to discuss integration]
○ Google Calendar → [Paste public calendar URL + provide booking link]
○ I don't have a digital schedule yet → [5-minute guide to creating Google Calendar]
```

### Native Integration Priority

Based on estimated platform distribution across directory:

1. **Mindbody** — largest market share, API mature, partner approval required for booking
2. **WellnessLiving** — solid API, common Mindbody alternative
3. **Momoyoga** — growing in yoga-specific market, may be eager for distribution partnership
4. **Vagaro** — API more limited, may require link-out only initially

ClassPass is treated separately—it's a demand source, not a studio management platform.

### Google Calendar Fallback

For studios without scheduling software:

**Setup flow:**

1. Studio selects "Google Calendar" as schedule source
2. Prompted to paste public Google Calendar URL
3. System validates URL and pulls initial schedule
4. Studio provides a booking link (website, form, email—whatever they use)
5. Schedule displays on listing page; "Book" button goes to their link

**Sync frequency:** Nightly for standard, hourly for premium listings or receptionist subscribers

### No Digital Schedule Path

For studios with no digital schedule at all:

> "It takes 5 minutes to set up a Google Calendar for your classes. Here's how: [simple guide]. Once it's ready, come back and connect it."

We do not offer or resell scheduling software. We recommend third-party options:

- **Momoyoga** — yoga-specific, reasonable pricing
- **Square Appointments** — simple, free tier available

### Manual Entry (Last Resort)

- YogaNearMe dashboard allows manual class entry
- Studio responsible for keeping it updated
- Not recommended; creates support burden and stale data risk
- May be deprecated if usage is low

### Website Scrape (Demo Only)

For the "Play With Me" demo, we scrape studio websites for schedule information.

**Boundaries:**
- Demo use only—not a persistent data source
- Scraped data marked as "unverified," requires confirmation during onboarding
- Scrape confidence determines demo language, not operating mode
- All demo calls operate in Link-Out Mode regardless of scrape confidence

### Connection Failure Handling

**During call:**
1. Immediate downgrade to Link-Out Mode
2. Receptionist informs caller: "I've lost my connection to the schedule. Let me text you a link."
3. Sends authoritative link via SMS
4. Immediate text alert to studio owner/web manager

**Persistent failure:**
- Retry with exponential backoff
- After 3 failures: Alert to owner
- After 24 hours: Dashboard warning + daily digest
- Receptionist continues in Link-Out Mode with last known data

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

### Studio Controls

- Studio chooses connection method
- Studio can disconnect at any time
- Schedule visibility can be toggled (connected but hidden)
- Booking link can be updated anytime

---

## 6. Yoga Brain (Domain Intelligence)

Yoga Brain is the receptionist's knowledge layer—what makes it "yoga-native" rather than generic.

### Components

**A) Studio Truth Table (Per-Studio)**

Configured during onboarding, editable in dashboard:

| Category | Data Points |
|----------|-------------|
| **Logistics** | Parking, mat rental/required, towel service, showers, lockers |
| **Policies** | Late arrival, cancellation, refund, makeup class |
| **Environment** | Heated (temp), AC, humidity, scent-free |
| **Amenities** | Props provided, water, retail, café |
| **Access** | Wheelchair accessible, elevator, stairs |
| **Contact** | Hours, address, emergency contact, owner name |

**B) Style Matrix (Global + Studio-Customizable)**

| Goal/Need | Recommended Styles | Contraindicated |
|-----------|-------------------|-----------------|
| Relaxation | Yin, Restorative, Yoga Nidra | Power, Hot |
| Workout/fitness | Vinyasa, Power, Ashtanga, Hot | Restorative |
| Flexibility | Yin, Hatha, Stretch | — |
| Strength | Power, Vinyasa, Ashtanga | Restorative |
| Beginner | Hatha, Gentle, Basics | Ashtanga, Advanced |
| Meditation focus | Yin, Restorative, Kundalini | Power, Hot |
| Back pain | Gentle, Hatha, Therapeutic | Hot, Power |
| Prenatal | Prenatal-specific only | Hot, Power, Deep twists |
| Senior/limited mobility | Chair, Gentle, Restorative | Power, Hot |

**C) Safety Flags (Per-Style)**

Each class/style can have:
- `prenatal_safe`: yes / no / ask_doctor
- `injury_considerations`: text field
- `heat_level`: none / warm / hot
- `intensity`: gentle / moderate / vigorous
- `inversion_heavy`: yes / no

**D) Medical/Prenatal Handling**

If caller mentions pregnancy, injury, or medical condition:

1. Never recommend heated classes for prenatal
2. Never claim any class is "safe" for medical conditions
3. Response pattern: "We have prenatal-specific classes on [days]. I'd recommend checking with your doctor first. Want me to text you the prenatal schedule?"
4. If no prenatal classes: Suggest gentle options + recommend calling studio to discuss + defer to doctor

**E) Studio Customization**

Studios can:
- Add custom style names (map "Inferno" → Hot Yoga)
- Override default recommendations
- Add instructor specialties
- Mark classes with safety flags
- Add custom FAQ responses

---

## 7. Student Data Connection

### Goal

Enable the receptionist to recognize callers and personalize service based on membership/attendance—without exposing sensitive data or creating privacy/compliance risk.

### Connection Levels (permissioned, studio-controlled)

**Level 1: Recognition (Low risk, v1 default)**

Data: Phone number → "new vs returning" flag

Enables:
- "Welcome back" vs "first time" greeting
- Faster routing and fewer questions
- Better conversion tracking

**Level 2: Member Context (Retention Module required)**

Data (toggleable fields):
- Membership status (active/inactive)
- Class pack balance / credits remaining
- Last visit date
- Membership renewal date

Enables:
- "You have 3 credits left—want the schedule link?"
- Attendance-aware recommendations and follow-ups

**Level 3: Preferences + History (Pro tier, opt-in only)**

Data (only if explicitly enabled):
- Preferred class types/instructors/time windows
- Attendance patterns
- Notes (injury/pregnancy) — sensitive, OFF by default

Enables:
- Highly personalized weekly plans
- Milestone celebrations
- Targeted reactivation offers

### Data Controls (Requirements)

- Studio controls which fields are connected (field-level permissions)
- Role-based access (owner/manager only for integration + exports)
- Audit trail: what data accessed, when, and for what purpose
- Data minimization: default to the smallest set needed
- "Forget me" deletion workflow for students
- TCPA and CCPA compliant from day one

---

## 8. Multi-Location Studios

### Architecture

- Each location gets a unique phone number
- One receptionist instance answers all locations
- Receptionist identifies location by inbound phone number
- All locations share Yoga Brain configuration with per-location overrides available

### Configuration

**Per-location:**
- Phone number (assigned by system)
- Address and logistics
- Schedule (can differ per location)
- Booking links

**Shared:**
- Style Matrix and recommendations
- Policies (unless overridden)
- Owner/manager contacts
- Branding and tone

### Pricing

- Base tier: 1 location
- Additional locations: +$29/month each
- Pro tier: Up to 4 locations included

---

## 9. Pricing Framework

### Philosophy

Flat monthly pricing that undercuts per-minute competitors. Studios should know exactly what they'll pay. Price competitiveness in v1 to acquire directory-listed studios; value-based pricing expansion in v2.

### Structure

| Tier | Price | Includes |
|------|-------|----------|
| **Base (Receptionist)** | $79/month | Unlimited calls, Yoga Brain, FAQ, link texting, 1 location |
| **Retention Module** | +$39/month | Weekly texts, attendance check-ins, lead/student freshening |
| **Pro** | $149/month | Base + Retention + reviews + waitlist + up to 4 locations |
| **Additional locations** | +$29/month | Per location beyond tier allowance |

### Competitive Reference

- Smith.ai: $200-400/month for comparable call volume
- Ruby: $250-500/month
- Mindbody messaging add-ons: $50-100/month (limited capability)

### Launch Pricing (First 100 Studios)

- Base Tier: $49/month (first 6 months)
- Retention Module: $29/month (first 6 months)
- Grandfather pricing for early adopters who provide testimonials/case studies

---

## 10. Success Metrics

### Product Metrics

| Metric | Target | Threshold |
|--------|--------|-----------|
| Call answer rate | 99%+ | 95% |
| Successful call completion | 98%+ | 95% |
| Escalation rate | <15% | <25% |
| SMS delivery rate | 99%+ | 97% |
| Link click-through rate | >40% | >25% |
| Mode violations | 0 | 0 |

### Business Metrics

| Metric | Target (Month 6) | Target (Month 12) |
|--------|------------------|-------------------|
| Studios on receptionist | 100 | 500 |
| Monthly recurring revenue | $8,000 | $50,000 |
| Churn rate (monthly) | <5% | <4% |
| NPS | >40 | >50 |
| Demo → trial conversion | >20% | >25% |
| Trial → paid conversion | >40% | >50% |

### Schedule Connect Metrics

| Metric | Target |
|--------|--------|
| % of claimed listings with connected schedule | 30% (month 6) |
| Schedule freshness (synced within 24h) | 95%+ |
| "Book" button CTR on listings | >5% |
| Schedule connected → receptionist trial | >10% |

---

## 11. Risks and Mitigations

| Risk | Likelihood | Impact | Mitigation |
|------|------------|--------|------------|
| Mindbody API approval delayed | Medium | High | Launch with Google Calendar + link-first; native integration as upgrade |
| Low call volume makes ROI unclear | Medium | Medium | Retention module adds value independent of call volume |
| Per-minute competitors drop prices | High | Medium | Differentiate on yoga-native intelligence + flat pricing simplicity |
| Studios don't connect schedules | Medium | High | Schedule Connect enables directory value first; receptionist is upsell |
| TCPA/SMS compliance issues | Low | High | Conservative opt-in flows; legal review; clear consent capture |
| Generic AI receptionists add yoga knowledge | Medium | Medium | Moat is distribution + trust + ecosystem, not just knowledge |
| Connection failures frustrate studios | Medium | Medium | Immediate alerts; graceful degradation; Link-Out Mode always works |

---

## 12. Open Questions

1. **Voice AI platform:** Retell vs. Vapi vs. Bland vs. custom? (Leaning Retell)
2. **Voicemail fallback:** Offer transcription + SMS follow-up?
3. **Multi-language:** Spanish support for v2?
4. **ClassPass integration:** Worth pursuing for schedule data?
5. **Booking attribution:** How to prove "this booking came from YogaNearMe"?

---

## 13. V1 Scope Boundaries

### In Scope

- Inbound call handling (voice + SMS)
- Link-first booking (all connection tiers)
- Yoga Brain (style recommendations, studio truth)
- Schedule Connect (native integrations + Google Calendar + manual)
- Student recognition (Level 1)
- Human escalation
- Single location (multi-location as add-on)
- English only
- US/Canada only

### Out of Scope (Deferred)

- Outbound calls
- Real-time booking via voice (requires native integration + explicit enablement)
- Payment processing by voice (never)
- Multi-language
- Custom voice cloning
- Medical/fitness advice (always defer to doctor)
- Markets outside US/Canada

---

## Appendix A: Glossary

| Term | Definition |
|------|------------|
| **Schedule Connect** | Foundational capability for syncing studio schedules to YogaNearMe |
| **Link-Out Mode** | Default operating mode; provides links rather than completing transactions |
| **Native integration** | Direct API connection to scheduling platform |
| **Yoga Brain** | Domain intelligence layer (styles, recommendations, studio truth) |
| **Retention Module** | Add-on for attendance-aware outreach and re-engagement |
| **Lead freshening** | Re-engaging inquiries who never converted |
| **Student refreshening** | Re-engaging members who have lapsed |
| **Operating Mode Invariant** | System may only maintain or downgrade mode mid-call; never upgrade |

---

## Appendix B: Integration Status Tracker

| Platform | API Available | Schedule Read | Booking Write | Member Data | Priority |
|----------|---------------|---------------|---------------|-------------|----------|
| Mindbody | Yes | Yes | Partner approval | Yes | 1 |
| WellnessLiving | Yes | Yes | Yes | Yes | 2 |
| Momoyoga | Yes | Yes | TBD | Limited | 3 |
| Vagaro | Limited | Partial | Link-out only | No | 4 |
| Google Calendar | Yes | Yes | Link-out only | No | Fallback |
| ClassPass | Special | TBD | Through ClassPass | No | Deferred |

---

## Document History

| Version | Date | Changes |
|---------|------|---------|
| v4.4 | Jan 13, 2026 | Aligned with PRD v2.2; added Yoga Brain section; added multi-location; added connection failure handling; added v1 scope boundaries |
| v4.3 | Jan 13, 2026 | Added Schedule Connect, competitive positioning, pricing, success metrics |
| v4.2 | Jan 13, 2026 | Initial draft |
