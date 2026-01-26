# Archive/Search Results Page Redesign

## Current Problems (from screenshot)

1. **No images** - Gray placeholder boxes instead of studio photos
2. **Tiny, unreadable text** - Studio names barely visible
3. **No value proposition** - No intro offers, no "why choose this studio"
4. **Confusing colored bars** - Sage/coral bars don't convey meaning
5. **"No Reviews" everywhere** - Negative signal, should hide if empty
6. **No CTAs** - No clear action for users to take
7. **No differentiation** - All cards look identical and empty
8. **Wasted space** - Large empty areas with no content

---

## New Card Design

### Card Anatomy (Top to Bottom)

```
┌─────────────────────────────────────────────────────────────┐
│ ┌─────────────────────────────────────────────────────────┐ │
│ │                                                         │ │
│ │                    STUDIO IMAGE                         │ │
│ │                      (16:9)                             │ │
│ │                                                         │ │
│ │  ┌──────────────┐                    ┌───────────────┐  │ │
│ │  │ ⭐ Featured  │                    │  Hot Yoga 🔥  │  │ │
│ │  └──────────────┘                    └───────────────┘  │ │
│ └─────────────────────────────────────────────────────────┘ │
│                                                             │
│  Studio Name Here                                           │
│  ━━━━━━━━━━━━━━━━━━━━━━━━━                                  │
│  📍 Silver Lake, Los Angeles  •  1.2 mi                     │
│                                                             │
│  ⭐ 4.8 (127)  •  Vinyasa, Hatha, Yin                       │
│                                                             │
│  ┌─────────────────────────────────────────────────────┐   │
│  │  🎁  2 Weeks Unlimited — $40                        │   │
│  │      First-time visitors only                       │   │
│  └─────────────────────────────────────────────────────┘   │
│                                                             │
│  [    View Studio    ]  [  Claim Offer  ]                  │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

### Design Specifications

#### Image Area
- **Aspect ratio:** 16:9 (or 3:2 for taller cards)
- **Height:** 200px minimum
- **Fallback:** Gradient with yoga silhouette icon if no image
- **Badges:** Positioned bottom-left and bottom-right
  - Featured badge (gold): Bottom-left
  - Style badge (if heated/specialty): Bottom-right

#### Studio Name
- **Font:** Inter Bold, 18px
- **Color:** `--ynm-text-dark` (#2C3E3A)
- **Max lines:** 2 (truncate with ellipsis)

#### Location & Distance
- **Font:** Inter Regular, 14px
- **Color:** `--ynm-text-medium` (#6B7C78)
- **Format:** "Neighborhood, City • X.X mi"
- **Icon:** Map pin in sage color

#### Rating & Styles
- **Rating:** Stars + number + review count
- **Hide if:** No rating exists (don't show "No Reviews")
- **Styles:** Top 3 yoga styles, comma-separated
- **Truncate:** "Vinyasa, Hatha, +3 more"

#### Intro Offer Card (THE KEY DIFFERENTIATOR)
- **Background:** Light coral/rust tint (`rgba(189, 55, 26, 0.08)`)
- **Border-left:** 3px solid `--ynm-rust`
- **Icon:** Gift icon
- **Headline:** Bold, offer summary
- **Subtext:** Terms/restrictions in lighter text
- **If no offer:** Hide this section entirely (don't show empty)

#### CTA Buttons
- **Primary:** "View Studio" - Teal background
- **Secondary:** "Claim Offer" - Rust/coral outline
- **If no offer:** Single full-width "View Studio" button

---

## Data to Display (Priority Order)

| Priority | Field | Why | Fallback |
|----------|-------|-----|----------|
| 1 | Featured Image | Visual hook, 3x click rate | Gradient + icon |
| 2 | Studio Name | Identity | Required field |
| 3 | Neighborhood + Distance | Location relevance | City name only |
| 4 | Intro Offer | Conversion driver | Hide section |
| 5 | Rating + Reviews | Social proof | Hide if none |
| 6 | Yoga Styles | Filtering/matching | "Yoga Studio" |
| 7 | Featured Badge | Premium visibility | Hide if not featured |
| 8 | Open/Closed Status | Practical info | Hide |

---

## Additional Data Collection Opportunities

### Passive Data (No Extra Effort from Studios)

| Data Point | How to Collect | Value to Us |
|------------|---------------|-------------|
| **Card impressions** | GA4 event on scroll into view | Know which studios get seen |
| **Card clicks** | GA4 event on click | Measure card effectiveness |
| **Offer claim clicks** | GA4 event | Conversion tracking |
| **Search refinements** | Track filter usage | Understand user intent |
| **Distance preferences** | Track which distances get clicks | Optimize default radius |
| **Time on page** | GA4 | Content engagement |
| **Bounce after search** | GA4 | Search quality signal |

### Data to Request from Studios (Non-Intrusive)

| Field | Why Helpful | How to Ask |
|-------|-------------|------------|
| **Primary Yoga Style** | Better search matching | "What's your studio best known for?" |
| **Vibe Tags** | Personality matching | "Select 3 words that describe your studio" |
| **Best For** | Audience targeting | "Who thrives at your studio?" (Beginners, Athletes, Seniors, etc.) |
| **Class Size** | Preference matching | "Average students per class" |
| **Booking Required?** | Reduces friction | "Can students drop in, or must they pre-book?" |
| **Languages** | Accessibility | "Languages your teachers instruct in" |
| **Parking Situation** | Practical decision factor | Quick dropdown |

### Data That Helps US Help THEM

| Field | Why We Need It | Studio Benefit |
|-------|---------------|----------------|
| **Email open rate** | Measure engagement | We can tell them their visibility |
| **Listing views** | Performance metric | "Your listing got 234 views this month" |
| **Offer claims** | Conversion metric | "12 students claimed your intro offer" |
| **Click-to-call** | Lead tracking | "8 people called from your listing" |
| **Peak search times** | Optimization | "Students search for you most on Mondays" |
| **Competitor comparison** | Benchmarking | "You're in the top 20% for your area" |

---

## Card States

### State 1: Complete Listing (Claimed + All Fields)
Full card with image, offer, rating, all elements

### State 2: Claimed but Incomplete
- Show image (or fallback)
- Show name, location
- Hide rating if none
- Hide offer if none
- Show "Complete your profile" prompt to owner (if logged in)

### State 3: Unclaimed Listing
- Fallback image with "Claim this studio" overlay
- Basic info only (name, address)
- "Is this your studio?" CTA
- Subtle visual difference (slightly muted?)

### State 4: Featured Listing
- Gold "Featured" badge
- Slightly larger card OR gold border
- Appears first in results
- Premium placement indicator

---

## CSS Implementation

```css
/* ==========================================================================
   ARCHIVE CARDS - REDESIGN v2
   ========================================================================== */

/* Card Container */
.geodir-post.ynm-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    overflow: hidden;
    transition: all 0.25s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.geodir-post.ynm-card:hover {
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    transform: translateY(-4px);
}

/* Image Container */
.ynm-card__image {
    position: relative;
    aspect-ratio: 16 / 9;
    overflow: hidden;
    background: linear-gradient(135deg, var(--ynm-sage) 0%, var(--ynm-teal) 100%);
}

.ynm-card__image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.ynm-card:hover .ynm-card__image img {
    transform: scale(1.05);
}

/* Image Fallback */
.ynm-card__image--fallback {
    display: flex;
    align-items: center;
    justify-content: center;
}

.ynm-card__image--fallback::after {
    content: "🧘";
    font-size: 48px;
    opacity: 0.3;
}

/* Badges on Image */
.ynm-card__badge {
    position: absolute;
    bottom: 12px;
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.ynm-card__badge--featured {
    left: 12px;
    background: linear-gradient(135deg, #D4AF37 0%, #F4D03F 100%);
    color: #1a1a1a;
}

.ynm-card__badge--heated {
    right: 12px;
    background: rgba(189, 55, 26, 0.9);
    color: #fff;
}

/* Card Content */
.ynm-card__content {
    padding: 16px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

/* Studio Name */
.ynm-card__title {
    font-size: 18px;
    font-weight: 700;
    color: var(--ynm-text-dark);
    margin: 0 0 8px 0;
    line-height: 1.3;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.ynm-card__title a {
    color: inherit;
    text-decoration: none;
}

.ynm-card__title a:hover {
    color: var(--ynm-teal);
}

/* Location */
.ynm-card__location {
    font-size: 14px;
    color: var(--ynm-text-medium);
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.ynm-card__location-icon {
    color: var(--ynm-sage);
}

.ynm-card__distance {
    color: var(--ynm-teal);
    font-weight: 500;
}

/* Rating & Styles Row */
.ynm-card__meta {
    font-size: 14px;
    color: var(--ynm-text-medium);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
}

.ynm-card__rating {
    display: flex;
    align-items: center;
    gap: 4px;
    color: var(--ynm-text-dark);
    font-weight: 500;
}

.ynm-card__stars {
    color: #F4D03F;
}

.ynm-card__styles {
    color: var(--ynm-text-medium);
}

/* Intro Offer Box */
.ynm-card__offer {
    background: rgba(189, 55, 26, 0.06);
    border-left: 3px solid var(--ynm-rust);
    border-radius: 0 8px 8px 0;
    padding: 12px;
    margin-bottom: 16px;
}

.ynm-card__offer-headline {
    font-size: 15px;
    font-weight: 600;
    color: var(--ynm-text-dark);
    display: flex;
    align-items: center;
    gap: 8px;
}

.ynm-card__offer-icon {
    color: var(--ynm-rust);
}

.ynm-card__offer-terms {
    font-size: 13px;
    color: var(--ynm-text-medium);
    margin-top: 4px;
}

/* CTA Buttons */
.ynm-card__actions {
    display: flex;
    gap: 8px;
    margin-top: auto;
}

.ynm-card__btn {
    flex: 1;
    padding: 10px 16px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 600;
    text-align: center;
    text-decoration: none;
    transition: all 0.2s ease;
    cursor: pointer;
}

.ynm-card__btn--primary {
    background: var(--ynm-teal);
    color: #fff;
    border: none;
}

.ynm-card__btn--primary:hover {
    background: var(--ynm-sage);
}

.ynm-card__btn--secondary {
    background: transparent;
    color: var(--ynm-rust);
    border: 2px solid var(--ynm-rust);
}

.ynm-card__btn--secondary:hover {
    background: var(--ynm-rust);
    color: #fff;
}

/* Grid Layout */
.ynm-archive-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    padding: 24px 0;
}

@media (max-width: 1024px) {
    .ynm-archive-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 640px) {
    .ynm-archive-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
}

/* ==========================================================================
   CONDITIONAL DISPLAY - Hide Empty Sections
   ========================================================================== */

/* Hide rating section if no rating */
.ynm-card__rating:empty,
.ynm-card__rating[data-rating="0"],
.ynm-card[data-has-rating="false"] .ynm-card__rating {
    display: none;
}

/* Hide offer section if no offer */
.ynm-card__offer:empty,
.ynm-card[data-has-offer="false"] .ynm-card__offer {
    display: none;
}

/* Hide secondary button if no offer */
.ynm-card[data-has-offer="false"] .ynm-card__btn--secondary {
    display: none;
}

.ynm-card[data-has-offer="false"] .ynm-card__btn--primary {
    flex: 1;
}

/* Unclaimed listing overlay */
.ynm-card--unclaimed .ynm-card__image::after {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(95, 116, 112, 0.7);
}

.ynm-card--unclaimed .ynm-card__claim-prompt {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    padding: 12px 20px;
    border-radius: 8px;
    font-weight: 600;
    color: var(--ynm-text-dark);
    z-index: 2;
}
```

---

## GA4 Event Tracking

```javascript
// Track card impressions (when scrolled into view)
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const card = entry.target;
            gtag('event', 'card_impression', {
                'listing_id': card.dataset.listingId,
                'studio_name': card.dataset.studioName,
                'position': card.dataset.position,
                'has_image': card.dataset.hasImage,
                'has_offer': card.dataset.hasOffer,
                'is_featured': card.dataset.isFeatured
            });
            observer.unobserve(card); // Only track once
        }
    });
}, { threshold: 0.5 });

document.querySelectorAll('.ynm-card').forEach(card => observer.observe(card));

// Track card clicks
document.querySelectorAll('.ynm-card').forEach(card => {
    card.addEventListener('click', (e) => {
        const action = e.target.closest('.ynm-card__btn--secondary') ? 'claim_offer_click' : 'card_click';
        gtag('event', action, {
            'listing_id': card.dataset.listingId,
            'studio_name': card.dataset.studioName,
            'position': card.dataset.position
        });
    });
});
```

---

## Implementation Priority

### Phase 1: Visual Fix (This Week)
1. Apply new CSS to existing GeoDirectory output
2. Add conditional display rules to hide empty sections
3. Fix image fallback display

### Phase 2: Offer Integration
1. Display intro offer on cards
2. Add "Claim Offer" secondary CTA
3. Connect to lead capture form

### Phase 3: Data & Tracking
1. Add GA4 event tracking
2. Implement card impression tracking
3. Build dashboard to show studios their performance

### Phase 4: Featured Listings
1. Add featured badge styling
2. Implement premium placement logic
3. Connect to Growth tier

---

## Files to Create/Modify

| File | Action | Purpose |
|------|--------|---------|
| `/code/CSS/ARCHIVE-CARDS-V2.css` | Create | New card styling |
| `/code/PHP ADDS/ARCHIVE-CARD-TEMPLATE.php` | Create | Custom card HTML output |
| `/code/JS/ARCHIVE-TRACKING.js` | Create | GA4 event tracking |
| `ADDITIONAL-CSS-FIXED.css` | Modify | Remove old card styles |

