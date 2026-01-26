# Studio Onboarding Wizard - Design Specification

## Overview

Transform the GeoDirectory listing edit experience from a dense admin form into a guided, marketing-focused wizard that:
1. Explains why each field matters for visibility and conversions
2. Groups related fields into digestible steps
3. Introduces premium features at natural decision points
4. Celebrates progress and completion

---

## Wizard Structure

### Progress Bar
```
[1. Basics] → [2. Classes & Pricing] → [3. Your Story] → [4. Photos & Links] → [5. Go Live]
     ●              ○                      ○                   ○                  ○
```

---

## Step 1: Studio Basics (Required Core)
**Headline:** "Let's get your studio on the map"
**Subhead:** "These essentials help students find you in local searches"

### Fields:
| Field | Why It Matters (shown to user) |
|-------|-------------------------------|
| Studio Name | "This appears in search results and your listing header" |
| Address | "Powers the map and 'yoga near me' searches" |
| City/State/Zip | "Helps students filter by location" |
| Phone | "70% of mobile users call directly from listings" |
| Email | "For booking confirmations and student inquiries" |
| Website | "Links students to your full schedule and booking" |

### UX Notes:
- Map preview updates live as address is entered
- "Set Address on Map" button for fine-tuning
- Phone/email show as clickable on mobile preview

### Validation:
- Name, Address, City, State, Zip, Phone required
- Email validated format
- Website validated URL format

---

## Step 2: Classes & Pricing
**Headline:** "What do you teach?"
**Subhead:** "Students filter by style and price — complete profiles get 3x more views"

### Section A: Yoga Styles
| Field | Why It Matters |
|-------|---------------|
| Yoga Styles (multi-select) | "Students search by style. Select all you offer regularly." |
| Primary Style | "Your main specialty — highlighted in search results" |

**Options:** Vinyasa, Hatha, Hot Yoga, Yin, Restorative, Power, Ashtanga, Kundalini, Prenatal, Iyengar, Aerial, Yoga Nidra, Chair Yoga, Kids/Family

### Section B: Pricing
| Field | Why It Matters |
|-------|---------------|
| Drop-in Rate | "Helps students budget — be honest, it builds trust" |
| Price Range | "Shown in search filters ($ / $$ / $$$)" |

### Section C: The Intro Offer (CRITICAL)
**Callout Box:**
> "Your intro offer is the #1 driver of new student visits. Studios with compelling intro offers get 5x more inquiries."

| Field | Why It Matters |
|-------|---------------|
| Intro Offer Headline | "e.g., '2 Weeks Unlimited for $40' — this is your hook" |
| Intro Offer Subtitle | "e.g., 'First-time visitors only' — sets expectations" |
| Intro Offer Terms | "Any restrictions or fine print" |

**Preview Box:** Shows how the intro offer will appear on the listing (the coral/rust card design)

---

## Step 3: Your Studio Story
**Headline:** "What makes your studio special?"
**Subhead:** "Students choose studios that feel right — help them see yours"

### Section A: About
| Field | Why It Matters |
|-------|---------------|
| Studio Description | "Your voice, your vibe. 2-3 paragraphs that feel like you." |
| Tagline | "The quote under your name — what's your one-liner?" |
| Established Year | "Shows stability. 'Est. 2015' builds trust." |

**Writing Tips (collapsible):**
- Speak directly to your ideal student
- Mention what's unique (lineage, teachers, community)
- Avoid generic wellness language — be specific

### Section B: Credentials & Vibe
| Field | Why It Matters |
|-------|---------------|
| Yoga Alliance | "RYS-200/500 badges show professionalism" |
| Amenities | "Showers, parking, props — practical details matter" |
| Special Offerings | "Workshops, retreats, teacher training — your premium services" |

---

## ✨ UPSELL MOMENT: After Step 3

**Transition Screen:**
```
┌─────────────────────────────────────────────────────────────────┐
│                                                                 │
│  🎯 Your profile is looking great!                             │
│                                                                 │
│  You're on the FREE plan. Here's what you're getting:          │
│  ✓ Basic listing with map                                      │
│  ✓ Contact info display                                        │
│  ✓ Intro offer showcase                                        │
│  ✓ Up to 3 photos                                              │
│                                                                 │
│  ─────────────────────────────────────────────────────────────  │
│                                                                 │
│  UPGRADE TO GROWTH ($29/month)                                 │
│                                                                 │
│  ⭐ Featured placement in search results                       │
│  ⭐ "Featured Studio" badge on your listing                    │
│  ⭐ Unlimited photos                                           │
│  ⭐ Embedded schedule widget (Mindbody, etc.)                  │
│  ⭐ Monthly performance report                                 │
│  ⭐ Priority in "Best Yoga in [City]" pages                    │
│                                                                 │
│  [Continue with Free]          [Upgrade to Growth →]           │
│                                                                 │
└─────────────────────────────────────────────────────────────────┘
```

**Key:** No hard gate. They can continue free, but this is the natural pause point where they've invested effort and see value.

---

## Step 4: Photos & Links
**Headline:** "Show off your space"
**Subhead:** "Listings with 5+ photos get 2x more clicks"

### Section A: Images
| Field | Why It Matters |
|-------|---------------|
| Featured Image | "Your main photo — shows in search results and at top of listing" |
| Logo | "Appears next to your name — keep it square" |
| Gallery Images | "Show your studio, teachers, classes in action" |

**Tips:**
- Natural light > flash
- Show real students (with permission)
- Include: lobby, practice room, props area, exterior

**Free Plan Note:** "You can upload 3 photos. [Upgrade for unlimited →]"

### Section B: Social & Booking Links
| Field | Why It Matters |
|-------|---------------|
| Schedule URL | "Direct link to your class schedule — reduces booking friction" |
| Instagram | "Most-checked platform for yoga studios" |
| Facebook | "Where local communities discover you" |
| Google Reviews URL | "Link to your Google Business reviews" |

---

## Step 5: Review & Go Live
**Headline:** "Ready to meet new students?"
**Subhead:** "Review your listing and publish"

### Preview Panel:
Full preview of how the listing will appear on the site:
- Desktop view toggle
- Mobile view toggle
- Hero section with images
- Intro offer card
- About section
- Contact info

### Completion Checklist:
```
✓ Basic info complete
✓ At least one yoga style selected
✓ Intro offer added
✓ Description written
○ Add at least one photo (optional but recommended)
○ Add social links (optional)
```

### Final CTA:
```
┌─────────────────────────────────────────────────────┐
│                                                     │
│  [← Back to Edit]        [Publish My Listing →]    │
│                                                     │
│  Your listing will be live within 24 hours after   │
│  our team verifies your information.               │
│                                                     │
└─────────────────────────────────────────────────────┘
```

---

## Post-Submission: Welcome Email + Dashboard

### Immediate Actions:
1. Confirmation email with:
   - Link to their listing (pending or live)
   - Reminder of what plan they chose
   - If Free: soft upsell to Growth
   - Next steps: "Share your listing on social"

2. Redirect to simple dashboard:
   - "Your Listing" with edit link
   - Basic stats (coming soon)
   - Upgrade prompt if on Free

---

## Technical Implementation Options

### Option A: Ninja Forms Multi-Part (Recommended)
- Use Ninja Forms with Multi-Part Forms add-on
- Custom styling to match YNM brand
- Conditional logic for upsell screens
- Submits to GeoDirectory via custom action or Zapier

**Pros:** You already have Ninja Forms, quick to build
**Cons:** Limited preview functionality, needs custom CSS

### Option B: Custom Elementor Flow
- Build as Elementor pages with form widgets
- Use JetEngine or custom PHP to save to GeoDirectory
- Full design control

**Pros:** Beautiful, on-brand, preview possible
**Cons:** More complex integration

### Option C: GeoDirectory Frontend Add-on + Custom Styling
- Use GD's built-in frontend submission
- Heavy CSS/JS customization to create wizard feel
- Add custom sections between field groups

**Pros:** Native integration, no sync issues
**Cons:** Fighting the plugin's UX

### Recommendation: Option A (Ninja Forms) for MVP
Build the wizard in Ninja Forms, prove it converts, then invest in a custom solution if needed.

---

## Field Mapping to GeoDirectory

| Wizard Field | GeoDirectory Field Key |
|--------------|----------------------|
| Studio Name | post_title |
| Tagline | tagline (custom) |
| Description | post_content |
| Address | street |
| City | city |
| State | region |
| Zip | zip |
| Phone | phone |
| Email | email |
| Website | website |
| Yoga Styles | yoga_styles |
| Drop-in Rate | price |
| Price Range | price_range |
| Intro Offer | intro_offer |
| Intro Offer Subtitle | intro_offer_subtitle |
| Established Year | established_year |
| Yoga Alliance | yoga_alliance |
| Schedule URL | schedule_url |
| Amenities | amenities |
| Special Offers | special_offers |
| Featured Image | featured_image |
| Logo | logo |
| Gallery | post_images |
| Facebook | facebook |
| Instagram | instagram |
| Package | package_id |

---

## Success Metrics

| Metric | Current (Est.) | Target |
|--------|---------------|--------|
| Form completion rate | ~20% | 60%+ |
| Fields filled per listing | ~8 | 15+ |
| Intro offer completion | ~10% | 80%+ |
| Photo upload rate | ~30% | 70%+ |
| Upgrade to Growth | 0% | 10-15% |

---

## Next Steps

1. [ ] Finalize field list with Eddie
2. [ ] Design wizard screens in Figma/Canva
3. [ ] Build Step 1-2 in Ninja Forms as MVP
4. [ ] Test with 5 real studios
5. [ ] Add upsell screen
6. [ ] Full rollout

