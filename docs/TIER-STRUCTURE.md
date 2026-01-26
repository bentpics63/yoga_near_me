# YogaNearMe Studio Tiers

## Tier Philosophy

Tier names should tell studios what they GET, not what they PAY.
- Bad: "Free Tier," "Pro Tier," "Premium Tier"
- Good: Names that communicate the benefit

---

## Tier Structure

### COMMUNITY (Free)

**Tagline:** "Get found by local students"

**What's Included:**
| Feature | Details |
|---------|---------|
| Basic listing | Name, address, contact, hours |
| Map placement | Appears in local searches |
| Intro offer display | Headline + subtitle |
| 3 photos | Featured image + 2 gallery |
| Yoga styles | Multi-select tags |
| Vibe tags | Up to 3 |
| Basic analytics | Monthly email with view count |
| Google rating pull | Automatic sync |
| Claim & edit | Full control of listing |

**What's NOT Included:**
- Featured placement
- Schedule embed
- Video
- Additional photos
- Priority support
- "Verified" badge upgrade to "Featured"

**Best For:**
- New studios testing the platform
- Studios with limited marketing budget
- Studios who want basic visibility

---

### VISIBILITY ($29/month)

**Tagline:** "Stand out in search results"

**Everything in Community, PLUS:**

| Feature | Details |
|---------|---------|
| ⭐ Featured badge | Gold "Featured" badge on listing |
| 📍 Priority placement | Appear higher in search results |
| 📸 15 photos | 3 base + 12 additional |
| 🎥 Video embed | YouTube/Vimeo on listing page |
| 📅 Schedule widget | Mindbody/Momence embed |
| 📊 Enhanced analytics | Weekly report + offer click tracking |
| 🏷️ Offer highlight | Intro offer shown on search cards |
| 🎯 Category features | Priority in "Best [Style] in [City]" pages |
| 📧 Lead routing | Inquiries go directly to your email |

**Pricing:**
- Monthly: $29/month
- Annual: $290/year (save $58 = 2 months free)

**Best For:**
- Studios actively growing
- Studios with strong intro offers
- Studios wanting to compete with aggregators

---

### PARTNERSHIP (Custom / Future)

**Tagline:** "We grow together"

**Everything in Visibility, PLUS:**

| Feature | Details |
|---------|---------|
| 🤝 Dedicated support | Direct line to YogaNearMe team |
| 📈 Custom reporting | Detailed conversion analytics |
| 🎪 Event promotion | Workshops, retreats featured |
| ✍️ Content features | Blog features, style page mentions |
| 🔗 Booking integration | Deep link optimization |
| 🏆 Verified Partner badge | Premium trust signal |
| 📣 Social promotion | Featured in YNM social channels |

**Pricing:** Custom ($99-299/month based on needs)

**Best For:**
- Multi-location studios
- Teacher training programs
- Studios wanting marketing partnership

**Note:** Don't launch this tier yet. Build when you have 50+ Visibility subscribers.

---

## Tier Comparison Table

| Feature | Community | Visibility | Partnership |
|---------|:---------:|:----------:|:-----------:|
| Basic listing | ✅ | ✅ | ✅ |
| Map placement | ✅ | ✅ | ✅ |
| Intro offer | ✅ | ✅ | ✅ |
| Photos | 3 | 15 | Unlimited |
| Video | ❌ | ✅ | ✅ |
| Featured badge | ❌ | ✅ | ✅ |
| Priority placement | ❌ | ✅ | ✅ |
| Schedule embed | ❌ | ✅ | ✅ |
| Offer on search cards | ❌ | ✅ | ✅ |
| Enhanced analytics | ❌ | ✅ | ✅ |
| Lead routing | ❌ | ✅ | ✅ |
| Dedicated support | ❌ | ❌ | ✅ |
| Event promotion | ❌ | ❌ | ✅ |
| Content features | ❌ | ❌ | ✅ |
| **Price** | Free | $29/mo | Custom |

---

## Upgrade Prompts

### When to Show Upgrade Prompts

**Trigger 1: After 10+ offer clicks**
> "Students are interested! 12 people clicked your intro offer this month. Upgrade to Visibility to appear higher in search and get even more."

**Trigger 2: Photo limit reached**
> "You've uploaded 3 photos. Want to add more? Visibility members can upload up to 15 photos + video."

**Trigger 3: Schedule request**
> "Want to embed your Mindbody schedule directly on your listing? That's a Visibility feature."

**Trigger 4: After 30 days on Community**
> "You've been on YogaNearMe for a month. Your listing got [X] views. Ready to stand out? Upgrade to Visibility."

---

## GeoDirectory Package Setup

In GeoDirectory → Pricing Manager:

### Package 1: Community
- Name: Community
- Price: $0
- Duration: Unlimited
- Listings allowed: 1
- Features:
  - featured_image: Yes
  - gallery_limit: 3
  - video: No

### Package 2: Visibility
- Name: Visibility
- Price: $29
- Billing: Monthly (or $290 annual)
- Duration: Until cancelled
- Listings allowed: 1
- Features:
  - featured_image: Yes
  - gallery_limit: 15
  - video: Yes
  - is_featured: Yes

---

## Conditional Display Logic

### Show video section only for Visibility tier:

```php
// In listing template
<?php
$package_id = geodir_get_post_meta($post->ID, 'package_id', true);
$visibility_package_id = 2; // Update with actual package ID

if ($package_id == $visibility_package_id) {
    $video_url = geodir_get_post_meta($post->ID, 'video_url', true);
    if ($video_url) {
        // Display video embed
    }
}
?>
```

### Show "Upgrade" prompt for Community tier:

```php
<?php
$package_id = geodir_get_post_meta($post->ID, 'package_id', true);
$community_package_id = 1;

if ($package_id == $community_package_id && is_user_logged_in()) {
    // Check if current user owns this listing
    if (get_current_user_id() == $post->post_author) {
        ?>
        <div class="ynm-upgrade-prompt">
            <p>Want more visibility? <a href="/upgrade">Upgrade to Visibility</a></p>
        </div>
        <?php
    }
}
?>
```

---

## Pricing Psychology

**Why $29/month:**
- Below the "needs approval" threshold for most small businesses
- Monthly Netflix/gym membership mental anchor
- Annual option ($290) gives urgency without pressure

**Why not lower:**
- $9-19 feels "too cheap to be valuable"
- Attracts less committed customers
- Harder to provide support at scale

**Why not higher:**
- $49+ requires more proof of ROI
- Competes with actual marketing spend
- Studios need to see value first

---

## Launch Strategy

**Phase 1: Community only (Now)**
- All listings are Community tier
- Build value, prove platform works
- Collect data on what studios want

**Phase 2: Introduce Visibility (After 50 claimed studios)**
- Soft launch to top performers
- "You got [X] clicks. Want more?"
- Refine features based on feedback

**Phase 3: Scale Visibility (After 10 paying studios)**
- Add to claim flow as option
- Upgrade prompts in dashboard
- Annual discount push

**Phase 4: Partnership tier (After 50 Visibility subscribers)**
- Custom outreach to multi-location studios
- Teacher training programs
- Retreat centers
