# YogaNearMe Launch Roadmap 2026

**Created:** 2026-01-23
**For:** Eddie's Review
**Status:** Planning Document

---

## Table of Contents

1. [Work Completed to Date](#work-completed-to-date)
2. [Mobile App Strategy](#mobile-app-strategy)
3. [Gap Analysis: What's Missing](#gap-analysis-whats-missing)
4. [Complete Task List to Launch](#complete-task-list-to-launch)
5. [Recommended Launch Sequence](#recommended-launch-sequence)
6. [Post-Launch Growth](#post-launch-growth)

---

## Work Completed to Date

### Content & SEO (Completed)

| Item | Status | Notes |
|------|--------|-------|
| Glossary terms | ✅ 120+ terms | Was showing 11, actually complete |
| Style pages | ✅ 6 complete | Vinyasa, Hatha, Hot, Iyengar, Kundalini, Prenatal |
| Neighborhood data | ✅ 24 cities, 241 neighborhoods | + 20 more from Gemini incoming |
| Prompt template | ✅ Created | For generating additional cities |
| City master list | ✅ 69 cities planned | Full US/Canada coverage |

### Design & CSS (Completed)

| Item | Status | Files |
|------|--------|-------|
| Archive card CSS | ✅ Complete | `ARCHIVE-CARDS-V3.css` |
| Nearby studios CSS | ✅ Complete | `NEARBY-STUDIOS-CARDS.css` |
| Hero gallery CSS | ✅ Complete | `hero-image-gallery.css` |
| Design system tokens | ✅ Defined | Sage, Teal, Rust, Paper |

### Studio Owner Tools (Completed)

| Item | Status | Files |
|------|--------|-------|
| Onboarding form | ✅ Complete | HTML/CSS/JS in `code/onboarding/` |
| Claim button shortcode | ✅ Created | `CLAIM-BUTTON-SHORTCODE.php` |
| Dynamic about shortcode | ✅ Created | `DYNAMIC-ABOUT-SHORTCODE.php` |

### Technical Infrastructure (Completed)

| Item | Status |
|------|--------|
| 30,000+ studio listings | ✅ Imported |
| GeoDirectory Pro | ✅ Configured |
| Google Maps API | ✅ Working |
| SSL, Analytics, Search Console | ✅ Active |
| llm.txt for AI crawlers | ✅ Created |
| FAQ schema snippet | ✅ Created |
| AggregateRating schema | ✅ Created |

---

## Mobile App Strategy

### The Core Question: App vs. Mobile Web?

**Recommendation: Progressive Web App (PWA) First, Native Later**

#### Why PWA First?

| Factor | PWA Advantage |
|--------|---------------|
| Development cost | 70% cheaper than native |
| Time to market | Weeks, not months |
| Maintenance | Single codebase |
| SEO | Fully indexed by Google |
| User acquisition | No app store friction |
| Updates | Instant, no app store approval |

#### What PWA Can Do

- Offline access to saved studios
- Push notifications (class reminders, new studios nearby)
- Add to home screen (looks like native app)
- Geolocation for "Near Me" search
- Fast, app-like navigation
- Camera access for check-ins or photo uploads

#### When to Go Native

Consider native apps when:
- Revenue exceeds $50K/month
- User base demands native features
- Need Apple Watch/Health integration
- Require background location tracking
- Building booking/payment system

### App vs. Website: Feature Comparison

| Feature | Website | PWA/App |
|---------|---------|---------|
| **Discovery** | Full glossary, style pages, city guides | Streamlined - focus on search |
| **Search** | All filters, map view, list view | Quick search, GPS-first |
| **Listings** | Full details, reviews, photos | Essential info, quick actions |
| **Actions** | Click to call, get directions, visit site | One-tap call, navigate, save |
| **Saved Studios** | Account-based | Local storage + sync |
| **Notifications** | Email newsletter | Push: new studios, class reminders |
| **Offline** | Requires connection | Cached favorites viewable |

### App-Specific Features (Not on Website)

1. **"Studios Near Me Now"** - GPS-triggered, shows what's within 10 min walk
2. **Quick Filters** - Swipe cards: Hot/Not Hot, Drop-in/Membership, Open Now
3. **Check-in Rewards** - Gamification for visiting studios (future)
4. **Class Time Alerts** - "Your saved studio has a class in 30 min"
5. **Saved Routes** - Commute-based studio suggestions
6. **Widget** - iOS/Android home screen widget showing next class

### Technical Approach

**Phase 1: PWA (Q2 2026)**
- Convert existing mobile site to PWA
- Add service worker for offline
- Implement push notifications
- Add "Add to Home Screen" prompt
- Cost estimate: $5-10K or DIY

**Phase 2: Native (Q4 2026 or later)**
- React Native or Flutter
- iOS and Android simultaneously
- Integrate with booking APIs
- Cost estimate: $50-100K

### App Monetization (Future)

| Revenue Stream | Model |
|----------------|-------|
| Premium features | $2.99/month for saved studios sync, alerts |
| Studio promoted listings | Pay for top placement in app |
| Booking commission | 5-10% on in-app bookings |
| Class pass partnerships | Affiliate revenue |

---

## Gap Analysis: What's Missing

### Critical Path (Must Have for Launch)

| Gap | Impact | Effort | Priority |
|-----|--------|--------|----------|
| Single studio listing page design | Users can't effectively view studios | High | **P0** |
| Gallery/image display fix | Poor user experience | Medium | **P0** |
| Shortcode rendering issues | Broken page elements | Medium | **P0** |
| Schema markup on listings | SEO, rich snippets | Medium | **P0** |
| Claim flow end-to-end test | Can't onboard studios | Medium | **P0** |
| Mobile usability audit | 60%+ traffic is mobile | Medium | **P0** |

### Important (Should Have for Launch)

| Gap | Impact | Effort | Priority |
|-----|--------|--------|----------|
| City landing pages | Local SEO, user navigation | High | **P1** |
| Neighborhood integration | Local SEO | Medium | **P1** |
| 404 error page | User experience | Low | **P1** |
| Contact form testing | Lead capture | Low | **P1** |
| Cross-browser testing | QA | Medium | **P1** |
| Page speed optimization | Core Web Vitals, SEO | Medium | **P1** |

### Nice to Have (Can Launch Without)

| Gap | Impact | Effort | Priority |
|-----|--------|--------|----------|
| Remaining glossary terms (34) | Content depth | Medium | **P2** |
| PWA implementation | Mobile app alternative | Medium | **P2** |
| Studio owner dashboard | Self-service | High | **P2** |
| Teacher profiles section | Content richness | Medium | **P2** |
| Class schedule integration | Premium feature | High | **P3** |

### Not Started (Post-Launch)

| Item | Notes |
|------|-------|
| AI Receptionist | Bankruptcy Ready crossover tech |
| SEO Audit tool for studios | Revenue product |
| Photo optimization tool | Revenue product |
| Booking integration | MindBody, Momence, Vagaro |
| Native mobile apps | After PWA proves demand |
| Studio Suite products | Full product line |

---

## Complete Task List to Launch

### Phase A: Single Studio Listing (Current Focus)

- [ ] **A1**: Complete single listing page HTML/CSS
  - Implement all 15 sections from STUDIO_LISTING_PROGRESS.md
  - Integrate GeoDirectory shortcodes
  - Add conditional logic for empty states

- [ ] **A2**: Fix gallery/image display
  - Debug `ynm_hero_gallery` shortcode
  - Test image upload flow
  - Implement lightbox

- [ ] **A3**: Fix shortcode rendering
  - Audit all GD shortcodes on listing page
  - Fix Yoga Styles display
  - Test with sample listings

- [ ] **A4**: Add new GeoDirectory fields
  - 12+ new fields (drop_in_price, heated, studio_size, etc.)
  - Update claim/edit form
  - Set validation rules

- [ ] **A5**: Create Elementor template
  - Build single studio template
  - Add HTML widgets with code
  - Configure for GeoDirectory

### Phase B: SEO & Technical

- [ ] **B1**: Schema markup
  - LocalBusiness schema on all listings
  - Verify with Rich Results Test
  - Add FAQ schema where appropriate

- [ ] **B2**: Sitemaps
  - Verify XML sitemaps include all locations
  - Submit to Google Search Console
  - Submit to Bing Webmaster Tools

- [ ] **B3**: Page speed
  - Run Core Web Vitals audit
  - Optimize images
  - Minimize CSS/JS
  - Configure caching

- [ ] **B4**: Neighborhood data import
  - Import 24 Claude-generated CSVs
  - Import 20 Gemini-generated CSVs
  - Verify all neighborhoods display correctly

- [ ] **B5**: City landing pages
  - Create template
  - Generate for top 20 markets first
  - Include neighborhood sections

### Phase C: Studio Owner Features

- [ ] **C1**: Test claim flow end-to-end
  - Register as new user
  - Claim a listing
  - Verify email notifications
  - Test approval process

- [ ] **C2**: Studio owner dashboard
  - Basic editing capability
  - Photo upload
  - Hours/contact management

- [ ] **C3**: Onboarding form integration
  - Connect form to WordPress
  - Test submission flow
  - Email notifications

### Phase D: Quality Assurance

- [ ] **D1**: Mobile testing
  - iOS Safari
  - Android Chrome
  - Test at 768px, 480px breakpoints

- [ ] **D2**: Cross-browser testing
  - Chrome, Safari, Firefox, Edge
  - Desktop and mobile

- [ ] **D3**: Content review
  - Proofread all public pages
  - Verify all links work
  - Check image loading

- [ ] **D4**: Load testing
  - Simulate traffic spike
  - Verify hosting can handle

### Phase E: Launch Prep

- [ ] **E1**: Legal compliance
  - Privacy policy links from all pages
  - Terms of service accessible
  - Cookie consent (if needed)
  - CCPA compliance

- [ ] **E2**: Analytics verification
  - GA4 tracking working
  - Search Console connected
  - Set up key event tracking

- [ ] **E3**: Soft launch
  - Open to limited audience
  - Gather feedback
  - Fix critical issues

- [ ] **E4**: Public launch
  - Remove beta notices
  - Social media announcement
  - Studio owner outreach

### Phase F: Mobile App (Post-Launch)

- [ ] **F1**: PWA implementation
  - Service worker
  - Offline capability
  - Push notifications
  - Add to home screen

- [ ] **F2**: App-specific features
  - GPS-first search
  - Quick filters
  - Saved studios sync

- [ ] **F3**: Native app evaluation
  - Assess PWA adoption
  - Determine native need
  - Spec requirements

---

## Recommended Launch Sequence

### Week 1-2: Foundation
- Complete single studio listing page (A1-A5)
- Fix all shortcode/gallery issues
- Add GeoDirectory fields

### Week 3: SEO
- Schema markup (B1)
- Sitemaps (B2)
- Page speed (B3)
- Import neighborhoods (B4)

### Week 4: Testing
- Mobile testing (D1)
- Cross-browser (D2)
- Content review (D3)

### Week 5: Soft Launch
- Limited release
- Gather feedback
- Fix issues

### Week 6: Public Launch
- Full release
- Studio outreach begins
- Marketing push

### Week 7+: Growth
- City landing pages
- PWA implementation
- Studio Suite products

---

## Post-Launch Growth

### Month 1: Stabilize
- Monitor for bugs
- Respond to studio owner inquiries
- Fix critical issues
- Begin studio outreach

### Month 2: Expand
- Complete remaining glossary terms
- Add more city landing pages
- PWA implementation
- First studio success stories

### Month 3+: Monetize
- Premium listing tiers
- Studio marketing packages
- Booking integration exploration
- AI Receptionist pilot

---

## Decision Points for Eddie

### Immediate Decisions Needed

1. **App Strategy:** Confirm PWA-first approach?
2. **Launch Timeline:** Target week for soft launch?
3. **Studio Outreach:** When to begin contacting studios?
4. **Monetization:** Launch free or with premium tier?

### Technical Decisions

1. **Booking APIs:** Which to support first? (MindBody, Momence, Vagaro)
2. **Native App:** Build in-house or outsource?
3. **Hosting:** Current capacity sufficient for launch traffic?

---

## Files to Review

| File | Purpose |
|------|---------|
| This document | Overall roadmap and strategy |
| `.claude/task-queue.md` | Current task queue |
| `.claude/STUDIO_LISTING_PROGRESS.md` | Single listing page details |
| `yoganearme-studio-suite/operations/yoganearme-launch-checklist.md` | Original launch checklist |
| `prompts/NEIGHBORHOOD-DATA-PROMPT-TEMPLATE.md` | For generating more cities |
| `data/neighborhoods/CITY-MASTER-LIST.md` | Full city coverage plan |

---

*This document consolidates all planning materials and identifies gaps for a state-of-the-art platform launch.*
