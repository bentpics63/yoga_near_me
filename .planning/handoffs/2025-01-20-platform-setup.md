# HANDOFF - Session Summary

**Date:** January 20, 2025
**Session Focus:** Platform development setup, onboarding flow, email sequences

---

## COMPLETED THIS SESSION

### 1. Lead Capture Form Fix
**File:** [code/PHP ADDS/NINJA-FORMS-LEAD-CAPTURE.php](code/PHP%20ADDS/NINJA-FORMS-LEAD-CAPTURE.php)

**What it does:** Populates hidden fields (studio_name, studio_url, offer, listing_id) in your Ninja Forms lead capture form.

**Your action:**
- [ ] Add to functions.php: `require_once get_stylesheet_directory() . '/includes/NINJA-FORMS-LEAD-CAPTURE.php';`
- [ ] Verify Ninja Forms hidden fields have keys: `studio_name`, `studio_url`, `offer`, `listing_id`
- [ ] Test form submission, check email receives populated fields

---

### 2. GeoDirectory Field Setup Guide
**File:** [docs/GEODIRECTORY-FIELD-SETUP-GUIDE.md](docs/GEODIRECTORY-FIELD-SETUP-GUIDE.md)

**What it is:** Step-by-step instructions for creating 28 custom fields in GeoDirectory.

**Your action:**
- [ ] Review field list
- [ ] Create fields in WP Admin → GeoDirectory → Settings → [gd_place] → Custom Fields
- [ ] Follow guide exactly (field keys must match for connector to work)

**Key fields to create first:**
- `vibe_tags` (multiselect)
- `intro_offer` (text)
- `intro_offer_subtitle` (text)
- `booking_url` (URL)
- `offers_virtual` (checkbox)
- `offers_retreats` (checkbox)

---

### 3. Ninja Forms → GeoDirectory Connector
**File:** [code/PHP ADDS/NINJA-FORMS-TO-GEODIRECTORY.php](code/PHP%20ADDS/NINJA-FORMS-TO-GEODIRECTORY.php)

**What it does:** When studios submit the onboarding wizard, data saves directly to GeoDirectory fields.

**Your action:**
- [ ] Create GD fields first (see #2 above)
- [ ] Update `$onboarding_form_id` in the file to match your Ninja Form ID
- [ ] Add to functions.php
- [ ] Test: submit wizard, verify data appears in GD listing

**Bonus features included:**
- Profile completion percentage calculation
- Admin column showing completion %
- Retreat interest notification (emails you when studio checks "offers retreats")

---

### 4. GA4 Event Tracking
**Files:**
- [code/JS/GA4-EVENT-TRACKING.js](code/JS/GA4-EVENT-TRACKING.js)
- [code/PHP ADDS/GA4-TRACKING-SETUP.php](code/PHP%20ADDS/GA4-TRACKING-SETUP.php)

**What it tracks:**
- Listing views
- Card impressions (search results)
- Claim offer clicks
- Phone clicks
- Booking clicks
- Directions clicks
- Form submissions
- Scroll depth & time on page

**Your action:**
- [ ] Confirm GA4 is installed on site (check for gtag.js)
- [ ] Add GA4-TRACKING-SETUP.php to functions.php
- [ ] Copy GA4-EVENT-TRACKING.js to theme's /js/ folder
- [ ] Test: check GA4 Real-time for events firing

---

### 5. Email Sequences

#### Nurture Sequence (Post-Claim)
**File:** [templates/EMAILS/STUDIO-EMAIL-SEQUENCE-FLUENTCRM.md](templates/EMAILS/STUDIO-EMAIL-SEQUENCE-FLUENTCRM.md)

6 emails + 2 triggered emails formatted for FluentCRM:
1. Welcome (immediate)
2. Photo nudge (day 2)
3. Intro offer (day 5)
4. First student story (day 10)
5. How's it going (day 21)
6. Wake up (day 45)
+ First offer click trigger
+ Profile complete trigger

**Your action:**
- [ ] Install FluentCRM (free WordPress plugin)
- [ ] Create custom fields per the guide
- [ ] Build automation sequences
- [ ] Create tags: studio-owner, no-photos, no-intro-offer, etc.

#### Outreach Sequence (Pre-Claim)
**File:** [templates/EMAILS/STUDIO-OUTREACH-SEQUENCE.md](templates/EMAILS/STUDIO-OUTREACH-SEQUENCE.md)

3 emails for cold outreach to unclaimed studios:
1. The Gift (day 0) - "Your listing is live"
2. The Opportunity (day 3) - "We found your intro offer"
3. Social Proof (day 7) - "[X] studios claimed this week"

**Your action:**
- [ ] Review and customize copy
- [ ] Set up in Instantly.ai or send manually
- [ ] Research 50 LA studios' intro offers first (as per roadmap)

---

### 6. Tier Structure
**File:** [docs/TIER-STRUCTURE.md](docs/TIER-STRUCTURE.md)

**Tiers defined:**
| Tier | Price | Key Features |
|------|-------|--------------|
| **Community** | Free | 3 photos, basic listing, intro offer |
| **Visibility** | $29/mo | 15 photos, video, featured badge, schedule embed |
| **Partnership** | Custom | Future tier for multi-location studios |

**Your action:**
- [ ] Review tier features
- [ ] Set up in GeoDirectory Pricing Manager when ready
- [ ] Start with Community only, add Visibility after 50 claimed studios

---

### 7. Claim Your Listing Landing Page
**File:** [templates/CLAIM-LANDING-PAGE/CLAIM-YOUR-LISTING.html](templates/CLAIM-LANDING-PAGE/CLAIM-YOUR-LISTING.html)

**What it is:** Full HTML template for /claim-your-listing/ or /for-studios/ page.

**Your action:**
- [ ] Create new page in Elementor
- [ ] Use template as reference for sections
- [ ] Add studio search functionality (GeoDirectory search widget)
- [ ] Connect CTA to GD claim flow

---

### 8. Archive Cards CSS
**File:** [code/CSS/ARCHIVE-CARDS-V2.css](code/CSS/ARCHIVE-CARDS-V2.css)

**What it fixes:**
- Gray image placeholders → Gradient fallback with icon
- Tiny text → 18px bold titles
- "No Reviews" everywhere → Hidden when empty
- Confusing colored bars → Removed
- No CTAs → Button styling ready

**Your action:**
- [ ] Add CSS to Appearance → Customize → Additional CSS
- [ ] Test on search results page
- [ ] Verify mobile responsiveness

---

## PENDING / NOT YET BUILT

| Task | Status | Notes |
|------|--------|-------|
| Video section CSS (conditional display) | Pending | Will hide video section for Community tier |
| Booking platform integration research | Pending | Need to test Mindbody/Momence embeds |
| Onboarding wizard form in Ninja Forms | Pending | You need to build the form itself |
| Visibility Snapshot PDF template | Pending | For email outreach |
| Studio owner checklist page | Pending | Post-claim "what to do next" |

---

## RECOMMENDED NEXT STEPS (Priority Order)

### This Week
1. **Create GD fields** - Required before anything else works
2. **Deploy lead form fix** - Your existing form will start capturing data
3. **Add archive CSS** - Immediate visual improvement
4. **Confirm GA4 is running** - Start collecting data now

### Next Week
5. **Build Ninja Forms wizard** - Use the spec from Claude.ai
6. **Deploy connector PHP** - Link wizard to GD
7. **Build claim landing page** - In Elementor
8. **Set up FluentCRM** - Load nurture sequence

### Week After
9. **Start outreach** - Research 50 LA studios, send first emails
10. **Create Visibility Snapshot** - PDF for outreach
11. **Monitor and iterate**

---

## FILES CREATED THIS SESSION

```
/docs/
  GEODIRECTORY-FIELD-SETUP-GUIDE.md
  TIER-STRUCTURE.md

/code/PHP ADDS/
  NINJA-FORMS-LEAD-CAPTURE.php
  NINJA-FORMS-TO-GEODIRECTORY.php
  GA4-TRACKING-SETUP.php
  LEAD-CAPTURE-FORM-INTEGRATION.php (earlier version, use NINJA-FORMS version)

/code/JS/
  GA4-EVENT-TRACKING.js

/code/CSS/
  ARCHIVE-CARDS-V2.css

/templates/
  STUDIO-ONBOARDING-WIZARD/
    WIZARD-DESIGN-SPEC.md
  ARCHIVE-PAGE-REDESIGN/
    ARCHIVE-CARDS-DESIGN-SPEC.md
  CLAIM-LANDING-PAGE/
    CLAIM-YOUR-LISTING.html
  EMAILS/
    STUDIO-EMAIL-SEQUENCE-FLUENTCRM.md
    STUDIO-OUTREACH-SEQUENCE.md
```

---

## QUESTIONS FOR NEXT SESSION

1. Did the Ninja Forms hidden field fix work?
2. Were you able to create the GD fields?
3. Is GA4 installed and tracking?
4. Any issues with the archive CSS?
5. Ready to build the onboarding wizard form?

---

## CONTEXT FOR FUTURE SESSIONS

**From Claude.ai (saved locally):**
- [studio-onboarding-spec.md](studio-onboarding-spec.md) - Full form field spec
- [studio-email-sequence.md](studio-email-sequence.md) - Original email sequence

**Key decisions made:**
- Vibe > Style as primary differentiator
- Community / Visibility tier naming
- FluentCRM for nurture, Instantly.ai for outreach
- Retreats = lead gen trigger, not complex booking
- Video placement: below intro offer, above About
- No dashboard stats until real data exists (honesty)

---

*Generated by Claude Code - January 20, 2025*
