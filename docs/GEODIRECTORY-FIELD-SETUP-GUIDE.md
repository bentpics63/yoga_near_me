# GeoDirectory Field Setup Guide

## Overview

This guide walks you through creating custom fields in GeoDirectory that will:
1. Power the studio onboarding wizard
2. Display on single studio pages
3. Enable search filtering
4. Support tiered features (Community vs Visibility)

**Location:** WP Admin → GeoDirectory → Settings → [gd_place] → Custom Fields

---

## Field Creation Instructions

For each field below:
1. Click "Add New Field"
2. Select the field type
3. Fill in the settings exactly as specified
4. Click "Save"

---

## SECTION 1: Basic Info (Most Already Exist)

These are likely already in GeoDirectory. Verify they exist:

| Field | Key | Type | Notes |
|-------|-----|------|-------|
| Business Hours | `business_hours` | Business Hours | GD default |
| Phone | `phone` | Phone | GD default |
| Email | `email` | Email | GD default |
| Website | `website` | URL | GD default |

---

## SECTION 2: Vibe & Identity

### Vibe Tags (PRIMARY DIFFERENTIATOR)

| Setting | Value |
|---------|-------|
| **Field Type** | MultiSelect |
| **Field Label** | Studio Vibe |
| **Field Key** | `vibe_tags` |
| **Description** | How would students describe the energy? |
| **Required** | No |
| **Options** | See below |
| **Display on Listing** | Yes |
| **Display on Search** | Yes (for filtering) |

**Options (one per line in admin):**
```
Calm
High-Energy
Meditative
Warm/Heated
Community-Focused
Boutique
Inclusive
Family-Friendly
Beginner-Friendly
Fitness-Forward
Traditional
Spiritual
```

---

### Best For

| Setting | Value |
|---------|-------|
| **Field Type** | MultiSelect |
| **Field Label** | Best For |
| **Field Key** | `best_for` |
| **Description** | Who thrives at this studio? |
| **Required** | No |
| **Options** | See below |
| **Display on Listing** | Yes |

**Options:**
```
Complete Beginners
Athletes
Seniors
Prenatal & Postnatal
Injuries/Limitations
Advanced Practitioners
Kids & Teens
```

---

### Primary Style

| Setting | Value |
|---------|-------|
| **Field Type** | Select |
| **Field Label** | Primary Style |
| **Field Key** | `primary_style` |
| **Description** | What's this studio best known for? |
| **Required** | No |
| **Options** | See below |
| **Display on Listing** | Yes |

**Options:**
```
Vinyasa
Hatha
Yin
Restorative
Hot/Heated
Ashtanga
Kundalini
Power
Iyengar
Prenatal
Gentle
Multi-Style
```

---

### Languages

| Setting | Value |
|---------|-------|
| **Field Type** | MultiSelect |
| **Field Label** | Languages Offered |
| **Field Key** | `languages` |
| **Description** | Languages instruction is offered in |
| **Required** | No |
| **Options** | See below |

**Options:**
```
Spanish
Mandarin
Korean
Japanese
Hindi
French
Portuguese
Vietnamese
Tagalog
Other
```

---

## SECTION 3: Practical Info

### Drop-in Policy

| Setting | Value |
|---------|-------|
| **Field Type** | Select |
| **Field Label** | Drop-in Policy |
| **Field Key** | `dropin_policy` |
| **Description** | Can students drop in or must they book? |
| **Required** | No |
| **Options** | See below |
| **Display on Listing** | Yes |

**Options:**
```
Drop-ins welcome
Booking recommended
Booking required
First-timers must book
```

---

### Class Size

| Setting | Value |
|---------|-------|
| **Field Type** | Select |
| **Field Label** | Class Size |
| **Field Key** | `class_size` |
| **Description** | Typical class size feel |
| **Required** | No |
| **Options** | See below |

**Options:**
```
Intimate (under 10)
Community (10-25)
Large (25+)
Varies by class
```

---

### New Student Info

| Setting | Value |
|---------|-------|
| **Field Type** | MultiSelect |
| **Field Label** | First Visit Info |
| **Field Key** | `new_student_info` |
| **Description** | What first-timers should know |
| **Required** | No |
| **Options** | See below |
| **Display on Listing** | Yes |

**Options:**
```
Arrive 15 min early
Props provided
Bring your own mat
Showers available
Changing rooms
Water for purchase
Shoes off at door
Towels provided
Lockers available
```

---

### Parking & Transit

| Setting | Value |
|---------|-------|
| **Field Type** | MultiSelect |
| **Field Label** | Getting There |
| **Field Key** | `parking_transit` |
| **Description** | How students get to you |
| **Required** | No |
| **Options** | See below |
| **Display on Listing** | Yes |

**Options:**
```
Free parking lot
Street parking
Paid parking nearby
Metro accessible
Bus stop nearby
Bike racks
```

---

## SECTION 4: Intro Offer (CRITICAL FOR CONVERSIONS)

### Intro Offer Headline

| Setting | Value |
|---------|-------|
| **Field Type** | Text |
| **Field Label** | Intro Offer |
| **Field Key** | `intro_offer` |
| **Placeholder** | e.g., "2 Weeks Unlimited for $40" |
| **Description** | Your new student offer headline |
| **Required** | No |
| **Max Length** | 50 |
| **Display on Listing** | Yes |
| **Display on Search** | Yes |

---

### Intro Offer Subtitle

| Setting | Value |
|---------|-------|
| **Field Type** | Text |
| **Field Label** | Intro Offer Details |
| **Field Key** | `intro_offer_subtitle` |
| **Placeholder** | e.g., "First-time visitors only" |
| **Description** | Who qualifies or restrictions |
| **Required** | No |
| **Display on Listing** | Yes |

---

### Why Students Love You

| Setting | Value |
|---------|-------|
| **Field Type** | Textarea |
| **Field Label** | Why Students Choose Us |
| **Field Key** | `why_students_love` |
| **Placeholder** | One sentence about what makes you different |
| **Description** | Shows on listing cards |
| **Required** | No |
| **Max Length** | 200 |
| **Display on Listing** | Yes |

---

### Signature Offering

| Setting | Value |
|---------|-------|
| **Field Type** | Text |
| **Field Label** | Signature Class or Teacher |
| **Field Key** | `signature_offering` |
| **Placeholder** | e.g., "Sunday Slow Flow with Maria" |
| **Required** | No |
| **Max Length** | 150 |

---

## SECTION 5: Booking & Schedule

### Booking Platform

| Setting | Value |
|---------|-------|
| **Field Type** | Select |
| **Field Label** | Booking Platform |
| **Field Key** | `booking_platform` |
| **Description** | How students book classes |
| **Required** | No |
| **Options** | See below |

**Options:**
```
Mindbody
Momence
WellnessLiving
Vagaro
ClassPass
Schedulicity
Studio website
Phone/walk-in only
Other
```

---

### Booking URL

| Setting | Value |
|---------|-------|
| **Field Type** | URL |
| **Field Label** | Booking Link |
| **Field Key** | `booking_url` |
| **Placeholder** | https://yourstudio.com/book |
| **Description** | Direct link to book a class |
| **Required** | No |
| **Display on Listing** | Yes |

---

### Schedule URL

| Setting | Value |
|---------|-------|
| **Field Type** | URL |
| **Field Label** | Schedule Link |
| **Field Key** | `schedule_url` |
| **Placeholder** | https://yourstudio.com/schedule |
| **Description** | Link to class schedule (if different from booking) |
| **Required** | No |
| **Display on Listing** | Yes |

---

### Schedule Embed Code (VISIBILITY TIER ONLY)

| Setting | Value |
|---------|-------|
| **Field Type** | Textarea |
| **Field Label** | Schedule Embed |
| **Field Key** | `schedule_embed_code` |
| **Description** | Paste Mindbody/Momence widget code (Visibility tier) |
| **Required** | No |
| **Display on Listing** | Yes (conditional) |
| **Admin Note** | Only populate for Visibility tier studios |

---

## SECTION 6: Virtual & Retreats

### Offers Virtual Classes

| Setting | Value |
|---------|-------|
| **Field Type** | Checkbox |
| **Field Label** | Virtual Classes Available |
| **Field Key** | `offers_virtual` |
| **Description** | Do you offer online classes? |
| **Required** | No |
| **Display on Listing** | Yes |

---

### Virtual Platform

| Setting | Value |
|---------|-------|
| **Field Type** | Select |
| **Field Label** | Virtual Platform |
| **Field Key** | `virtual_platform` |
| **Description** | How students join online |
| **Required** | No |
| **Options** | See below |
| **Show If** | `offers_virtual` is checked |

**Options:**
```
Zoom
YouTube Live
On-demand library
Custom app
Multiple platforms
```

---

### Virtual Class URL

| Setting | Value |
|---------|-------|
| **Field Type** | URL |
| **Field Label** | Virtual Classes Link |
| **Field Key** | `virtual_class_url` |
| **Placeholder** | Link to virtual offerings |
| **Required** | No |
| **Show If** | `offers_virtual` is checked |

---

### Offers Retreats

| Setting | Value |
|---------|-------|
| **Field Type** | Checkbox |
| **Field Label** | Retreats Offered |
| **Field Key** | `offers_retreats` |
| **Description** | Do you organize yoga retreats? |
| **Required** | No |
| **Display on Listing** | Yes |
| **Admin Note** | When checked, triggers outreach for retreat promotion |

---

## SECTION 7: Studio Details

### Established Year

| Setting | Value |
|---------|-------|
| **Field Type** | Text |
| **Field Label** | Year Established |
| **Field Key** | `established_year` |
| **Placeholder** | e.g., 2015 |
| **Required** | No |
| **Display on Listing** | Yes |

---

### Yoga Alliance

| Setting | Value |
|---------|-------|
| **Field Type** | MultiSelect |
| **Field Label** | Yoga Alliance |
| **Field Key** | `yoga_alliance` |
| **Description** | Registration status |
| **Required** | No |
| **Options** | See below |

**Options:**
```
RYS-200
RYS-300
RYS-500
YACEP
None
```

---

### Social Links

#### Instagram

| Setting | Value |
|---------|-------|
| **Field Type** | Text |
| **Field Label** | Instagram |
| **Field Key** | `instagram` |
| **Placeholder** | @yourstudio |
| **Required** | No |

#### Facebook

| Setting | Value |
|---------|-------|
| **Field Type** | URL |
| **Field Label** | Facebook |
| **Field Key** | `facebook` |
| **Placeholder** | facebook.com/yourstudio |
| **Required** | No |

#### TikTok

| Setting | Value |
|---------|-------|
| **Field Type** | Text |
| **Field Label** | TikTok |
| **Field Key** | `tiktok` |
| **Placeholder** | @yourstudio |
| **Required** | No |

---

### Google Reviews URL

| Setting | Value |
|---------|-------|
| **Field Type** | URL |
| **Field Label** | Google Reviews Link |
| **Field Key** | `google_reviews_url` |
| **Description** | We pull your Google rating automatically |
| **Required** | No |

---

### How Students Find You (DATA FOR US)

| Setting | Value |
|---------|-------|
| **Field Type** | MultiSelect |
| **Field Label** | Student Acquisition |
| **Field Key** | `student_sources` |
| **Description** | Where do most new students come from? |
| **Required** | No |
| **Display on Listing** | No (internal data) |
| **Options** | See below |

**Options:**
```
Word of mouth
Google search
Instagram
Other directories
Walk-ins
Corporate partnerships
ClassPass
Mindbody
```

---

## SECTION 8: Tier & Media (VISIBILITY TIER)

### Video URL (VISIBILITY TIER ONLY)

| Setting | Value |
|---------|-------|
| **Field Type** | URL |
| **Field Label** | Studio Video |
| **Field Key** | `video_url` |
| **Description** | YouTube or Vimeo link (Visibility tier) |
| **Required** | No |
| **Display on Listing** | Yes (conditional) |
| **Admin Note** | Only shows if populated + Visibility tier |

---

## Field Summary by Section

| Section | Fields | Count |
|---------|--------|-------|
| Vibe & Identity | vibe_tags, best_for, primary_style, languages | 4 |
| Practical Info | dropin_policy, class_size, new_student_info, parking_transit | 4 |
| Intro Offer | intro_offer, intro_offer_subtitle, why_students_love, signature_offering | 4 |
| Booking & Schedule | booking_platform, booking_url, schedule_url, schedule_embed_code | 4 |
| Virtual & Retreats | offers_virtual, virtual_platform, virtual_class_url, offers_retreats | 4 |
| Studio Details | established_year, yoga_alliance, instagram, facebook, tiktok, google_reviews_url, student_sources | 7 |
| Visibility Tier | video_url | 1 |
| **TOTAL NEW FIELDS** | | **28** |

---

## After Creating Fields

1. **Test:** Edit a listing and verify all fields appear
2. **Order:** Drag fields into logical order in GD admin
3. **Display:** Check single listing page - fields should render
4. **Notify me:** I'll create the Ninja Forms → GD connector once fields exist

---

## Tier-Gated Fields

These fields should only be populated/displayed for Visibility tier:

| Field | Community | Visibility |
|-------|-----------|------------|
| schedule_embed_code | ❌ | ✅ |
| video_url | ❌ | ✅ |
| Extra photos (12+) | ❌ (3 max) | ✅ (15 max) |

Use GeoDirectory's package/membership features OR conditional display in templates.
