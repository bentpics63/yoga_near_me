# YogaNearMe Platform Development Progress

**Last Updated:** 2025-01-20
**Latest Handoff:** [handoffs/2025-01-20-platform-setup.md](handoffs/2025-01-20-platform-setup.md)

---

## Current Phase

**Phase 0-2: From Directory to Platform**
- Transforming from static directory to lead generation platform
- Core insight: Value unit shifts from "listing" to "introductory experience"

---

## Master Task List by Phase

### Week 1: Stop the Bleeding (Days 1-5)
*Goal: Fix trust-destroying UI issues*

| Task | Status | Owner | Notes |
|------|--------|-------|-------|
| Fix or hide broken Maps API | ⚠️ Verify | Eddie | Verified working in admin, check frontend |
| Fix "No Records Found" false empty state | ✅ Done | — | PHP file exists |
| Hide placeholder email fields | ✅ Done | — | PHP file exists |
| Fix rating/review mismatch | ✅ Done | — | PHP file exists |
| Create staging site backup | ⏳ Pending | Eddie | Use UpdraftPlus |

---

### Week 2: Universal Conversion (Days 6-12)
*Goal: Every listing converts visitors to leads*

| Task | Status | Owner | Notes |
|------|--------|-------|-------|
| Add "Claim Intro Offer" CTA above fold | ✅ Done | — | Shortcodes exist |
| Build lead capture form | ✅ Done | — | Ninja Forms exists |
| Add hidden fields to form (listing attribution) | ✅ Code Ready | Eddie | Deploy `NINJA-FORMS-LEAD-CAPTURE.php` |
| Replace "Book a Class" dead end | ✅ Done | — | Direct links implemented |
| Add GA4 event tracking | ✅ Code Ready | Eddie | Deploy `GA4-TRACKING-SETUP.php` + JS |
| Route all leads to inbox | ⏳ Pending | Eddie | Depends on hidden field fix |
| Test lead form end-to-end | ⏳ Pending | Eddie | After deployment |

---

### Week 3: Studio Gift + Email Launch (Days 13-19)
*Goal: Launch outreach campaign with pre-researched offers*

| Task | Status | Owner | Notes |
|------|--------|-------|-------|
| Create Visibility Snapshot template | ⏳ Pending | Claude | PDF showing listing stats |
| Build intro offer research workflow | ⏳ Pending | Claude | Google Sheet + process |
| Research top 50 LA studios | ⏳ Pending | Eddie | Visit sites, record offers |
| Design "Claim Your Listing" landing page | ✅ Done | — | HTML template created |
| Build landing page in Elementor | ⏳ Pending | Eddie | Use template as guide |
| Draft outreach email sequence (3 emails) | ✅ Done | — | `STUDIO-OUTREACH-SEQUENCE.md` |
| Draft nurture email sequence (6 emails) | ✅ Done | — | `STUDIO-EMAIL-SEQUENCE-FLUENTCRM.md` |
| Set up FluentCRM | ⏳ Pending | Eddie | Install plugin, create automations |
| Warm up email addresses | ⏳ Pending | Eddie | Before bulk outreach |
| **EMAIL CAMPAIGN LAUNCH** | 🎯 Milestone | — | End of Week 3 |

---

### Weeks 4-6: Claim Infrastructure (Days 20-42)
*Goal: Studios can claim and customize listings*

| Task | Status | Owner | Notes |
|------|--------|-------|-------|
| Add GeoDirectory custom fields | ✅ Guide Ready | Eddie | Follow `GEODIRECTORY-FIELD-SETUP-GUIDE.md` |
| Create fields in GD admin | ⏳ Pending | Eddie | 28 fields to create |
| Install + configure Claim Listings addon | ⏳ Pending | Eddie | GeoDirectory addon |
| Build Ninja Forms onboarding wizard | ⏳ Pending | Claude/Eddie | Use `studio-onboarding-spec.md` |
| Deploy Ninja Forms → GD connector | ✅ Code Ready | Eddie | Deploy `NINJA-FORMS-TO-GEODIRECTORY.php` |
| Build post-claim welcome flow | ⏳ Pending | Claude | Email after approval |
| Create studio owner checklist page | ⏳ Pending | Claude | "What to complete next" |
| Add "Verified Studio" badge | ✅ Done | — | Shortcode exists |
| Update listing template for new fields | ⏳ Pending | Claude | Display intro offer, vibe tags |
| Build conditional field display | ⏳ Pending | Claude | Hide empty sections |

---

### Weeks 7-10: Friction Reduction (Days 43-70)
*Goal: Reduce search-to-book friction*

| Task | Status | Owner | Notes |
|------|--------|-------|-------|
| Add booking deep link buttons | ⏳ Pending | Claude | When `booking_url` exists |
| Create "Book a Class" fallback modal | ✅ Done | — | Lead capture instead |
| Add schedule_url display | ⏳ Pending | Claude | Separate from booking |
| Build Mindbody widget embed (Visibility tier) | ⏳ Pending | Claude | Research API first |
| Research booking platform integrations | ⏳ Pending | Claude | Mindbody, Momence, etc. |
| Create 5 manual intent pages | ⏳ Pending | Claude | "Best Yoga in LA", etc. |
| Upgrade search results card layout | ✅ CSS Ready | Eddie | Deploy `ARCHIVE-CARDS-V2.css` |
| Design video section (Visibility tier) | ✅ Done | — | `VIDEO-SECTION.css` + PHP |

---

### Weeks 11-14: Monetization Rails (Days 71-98)
*Goal: First revenue from paid tier*

| Task | Status | Owner | Notes |
|------|--------|-------|-------|
| Install GeoDirectory Pricing Manager | ⏳ Pending | Eddie | GD addon |
| Create Community (Free) package | ✅ Spec Ready | Eddie | See `TIER-STRUCTURE.md` |
| Create Visibility ($29/mo) package | ✅ Spec Ready | Eddie | See `TIER-STRUCTURE.md` |
| Build studio analytics preview | ⏳ Pending | Claude | Views, clicks, offer claims |
| Design upgrade prompt | ⏳ Pending | Claude | Based on performance data |
| Soft launch Visibility tier outreach | ⏳ Pending | Eddie | Email top performers |
| **FIRST REVENUE** | 🎯 Milestone | — | End of Week 14 |

---

## Additional Tasks Identified

*Tasks not in original PDF but needed:*

| Task | Phase | Status | Owner | Notes |
|------|-------|--------|-------|-------|
| Move Claude.ai specs to project folder | Setup | ⏳ Pending | Eddie | `studio-onboarding-spec.md` in Downloads |
| Define tier-gated features in code | Weeks 4-6 | ⏳ Pending | Claude | Package ID checks |
| Create retreat lead notification | Weeks 4-6 | ✅ Done | — | In connector PHP |
| Add profile completion % to listings | Weeks 4-6 | ✅ Done | — | In connector PHP |
| Create admin column for completion % | Weeks 4-6 | ✅ Done | — | In connector PHP |
| Design mobile-responsive archive cards | Week 2 | ✅ Done | — | In CSS |
| Add scroll/time tracking for engagement | Week 2 | ✅ Done | — | In GA4 JS |
| Set up email domain warming | Week 3 | ⏳ Pending | Eddie | Before outreach |
| Create "For Studios" navigation link | Week 3 | ⏳ Pending | Eddie | Link to claim page |
| Add virtual class fields | Weeks 4-6 | ✅ Spec Ready | Eddie | In GD field guide |
| Add retreat checkbox + trigger | Weeks 4-6 | ✅ Spec Ready | Eddie | In GD field guide |
| Integrate FluentCRM with form submissions | Weeks 4-6 | ⏳ Pending | Claude | Tag + trigger automation |
| Create style/city SEO pages | Weeks 7-10 | ⏳ Pending | Claude | "Vinyasa in LA", etc. |
| Link intent pages to glossary/style content | Weeks 7-10 | ⏳ Pending | Claude | Internal link network |

---

## Files Created (This Project)

### Plugin (RECOMMENDED - Use This)
| File | Purpose | Status |
|------|---------|--------|
| `plugin/ynm-custom-functions/ynm-custom-functions.php` | **ALL PHP combined** - Lead capture, GA4, GD connector, Video section | **Ready to Upload** |

**Installation:** Upload `plugin/ynm-custom-functions/` folder to `wp-content/plugins/` and activate.

### PHP (Individual Files - Now Combined in Plugin Above)
| File | Purpose | Status |
|------|---------|--------|
| `code/PHP ADDS/NINJA-FORMS-LEAD-CAPTURE.php` | Populates hidden fields in lead form | In Plugin |
| `code/PHP ADDS/NINJA-FORMS-TO-GEODIRECTORY.php` | Saves wizard data to GD | Ready (needs GD fields) |
| `code/PHP ADDS/GA4-TRACKING-SETUP.php` | Enqueues tracking + page data | Ready |
| `code/PHP ADDS/HIDE-PLACEHOLDER-EMAILS.php` | Hides info@yoganearme.info | Deployed? |
| `code/PHP ADDS/FIX-NO-RECORDS-FOUND.php` | Fixes false empty state | Deployed? |
| `code/PHP ADDS/FIX-RATING-REVIEW-MISMATCH.php` | Unified rating display | Deployed? |
| `code/PHP ADDS/CLAIM-BUTTON-SHORTCODE.php` | Claim/book buttons | Deployed? |
| `code/PHP ADDS/VIDEO-SECTION-CONDITIONAL.php` | Video section for Visibility tier | Ready |

### JavaScript
| File | Purpose | Status |
|------|---------|--------|
| `code/JS/GA4-EVENT-TRACKING.js` | Tracks user interactions | Ready |

### CSS
| File | Purpose | Status |
|------|---------|--------|
| `code/CSS/ARCHIVE-CARDS-V2.css` | Redesigned search result cards | Ready |
| `code/CSS/VIDEO-SECTION.css` | Video section styles (Visibility tier) | Ready |

### Documentation
| File | Purpose |
|------|---------|
| `docs/GEODIRECTORY-FIELD-SETUP-GUIDE.md` | Step-by-step GD field creation |
| `docs/TIER-STRUCTURE.md` | Community / Visibility tier definitions |

### Templates
| File | Purpose |
|------|---------|
| `templates/CLAIM-LANDING-PAGE/CLAIM-YOUR-LISTING.html` | Landing page HTML |
| `templates/EMAILS/STUDIO-EMAIL-SEQUENCE-FLUENTCRM.md` | 6 nurture emails |
| `templates/EMAILS/STUDIO-OUTREACH-SEQUENCE.md` | 3 cold outreach emails |
| `templates/STUDIO-ONBOARDING-WIZARD/WIZARD-DESIGN-SPEC.md` | Form design spec |
| `templates/ARCHIVE-PAGE-REDESIGN/ARCHIVE-CARDS-DESIGN-SPEC.md` | Card design spec |

### External (Need to Move to Project)
| File | Current Location | Move To |
|------|------------------|---------|
| `studio-onboarding-spec.md` | ~/Downloads/9191/ | `templates/STUDIO-ONBOARDING-WIZARD/` |
| `studio-email-sequence.md` | ~/Downloads/9191/ | `templates/EMAILS/` |

---

## Pending Tasks (Priority Order)

### Immediate (Eddie's Actions)
1. [ ] Deploy `NINJA-FORMS-LEAD-CAPTURE.php` to functions.php
2. [ ] Verify Ninja Forms hidden field keys match: `studio_name`, `studio_url`, `offer`, `listing_id`
3. [ ] Test lead form submission → check email has populated fields
4. [ ] Add `ARCHIVE-CARDS-V2.css` to Appearance → Customize → Additional CSS
5. [ ] Confirm GA4 is installed on site (check for gtag.js)
6. [ ] Deploy `GA4-TRACKING-SETUP.php` to functions.php
7. [ ] Copy `GA4-EVENT-TRACKING.js` to theme's /js/ folder
8. [ ] Move Claude.ai specs from Downloads to project folder
9. [ ] Create staging site backup (UpdraftPlus)

### Next (Eddie's Actions)
10. [ ] Create 28 GeoDirectory custom fields per guide
11. [ ] Deploy `NINJA-FORMS-TO-GEODIRECTORY.php` (after fields exist)
12. [ ] Build claim landing page in Elementor
13. [ ] Install FluentCRM plugin
14. [ ] Set up FluentCRM automations per email guide
15. [ ] Add "For Studios" link to main navigation
16. [ ] Warm up email domain before outreach

### Then (Claude Code Can Help)
17. [ ] Build Ninja Forms onboarding wizard (multi-step)
18. [ ] Create Visibility Snapshot PDF template
19. [ ] Design video section CSS (conditional display for Visibility tier)
20. [ ] Research booking platform APIs (Mindbody, Momence, Vagaro)
21. [ ] Create studio owner checklist page (post-claim)
22. [ ] Build post-claim welcome email automation
23. [ ] Create 5 intent pages ("Best Yoga in LA", etc.)
24. [ ] Add FluentCRM integration to form connector

---

## Key Decisions Made

| Decision | Choice | Rationale |
|----------|--------|-----------|
| Primary differentiator | Vibe tags over Style | More unique, better student matching |
| Tier naming | Community / Visibility | Names communicate the benefit |
| Tier pricing | $29/mo for Visibility | Below approval threshold, monthly anchor |
| CRM for nurture | FluentCRM | Free, WordPress native |
| Outreach tool | Instantly.ai (or manual) | Cost-effective cold email |
| Retreat handling | Lead gen trigger → phone call | No complex booking system needed |
| Stats dashboard | Wait for real data | Honesty > false promises |
| Video placement | Below intro offer, above About | Natural scroll flow |
| Photo limits | Community: 3 / Visibility: 15 | Clear upgrade value |
| Form approach | Ninja Forms multi-step wizard | Already have plugin |
| Data flow | Wizard → GeoDirectory fields | Single source of truth |

---

## Metrics to Track (Once GA4 Deployed)

| Metric | Event Name | Purpose |
|--------|------------|---------|
| Listing views | `listing_view` | Studio performance |
| Card impressions | `card_impression` | Search visibility |
| Card clicks | `card_click` | Card effectiveness |
| Claim offer clicks | `claim_offer_click` | Conversion intent |
| Phone clicks | `phone_click` | High-intent leads |
| Booking clicks | `booking_click` | Outbound conversions |
| Directions clicks | `directions_click` | Local intent |
| Lead form submits | `lead_form_submit` | Actual conversions |
| Scroll depth | `scroll_depth` | Engagement |
| Time on listing | `time_on_listing` | Interest level |

---

## Deprioritized (Per PDF Appendix B)

| Feature | Why Defer | Revisit When |
|---------|-----------|--------------|
| "For You" Personalization | Need user data first | 1000+ tracked sessions |
| AI Voice Receptionist | High cost, unclear value | 100+ claimed studios |
| B2B Corporate Credits | Needs ops capacity | Remove from scope |
| MultiRatings (5 criteria) | Adds friction | Never (simple stars sufficient) |
| Unified Booking Bridge | Technically complex | 18+ months if ever |
| Verified Check-In Reviews | Needs booking ownership | After native booking |

---

## Next Session Starting Point

1. Read this file for current status
2. Ask Eddie what he's completed from "Eddie's Actions"
3. Update checkboxes based on his progress
4. Continue with next pending tasks
5. Update this file at end of session

---

*Last session: 2025-01-20 - Platform setup, onboarding flow, email sequences*
