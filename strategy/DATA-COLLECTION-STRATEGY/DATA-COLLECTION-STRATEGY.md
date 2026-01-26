# Yoga Studio Data Collection Strategy
## Building the World's Best Yoga Directory

**Goal:** Collect data that answers specific anxieties and preferences of yoga students, going beyond generic "where" to answer "what it feels like."

---

## ✅ Your Research: Excellent Foundation

Your list is **exceptionally well thought out** and addresses real pain points. The focus on "vibe" and "feel" is exactly what will differentiate your directory.

**Key Strengths:**
- ✅ "Vibe & Culture" category is brilliant - this is the differentiator
- ✅ "Know Before You Go" logistics reduce friction
- ✅ Inclusivity & Accessibility shows modern standards
- ✅ Structured review data creates actionable insights
- ✅ Schema.org mapping ensures SEO value

---

## 📋 Suggested Additions

### 1. Pricing & Packages (Critical for Conversion)
**Why:** Students need to know cost before committing.

**Data to Collect:**
- **Drop-in Rate:** Single class price
- **Class Packages:** 5-class, 10-class, 20-class pass prices
- **Monthly/Annual Memberships:** Unlimited options and pricing
- **New Student Special:** First class free? Intro package?
- **ClassPass Availability:** Yes/No, and if yes, what tier
- **Student/Senior/Military Discounts:** Available?
- **Corporate/Group Rates:** For businesses booking classes
- **Gift Cards:** Available? Online purchase?

**Implementation Note:** Map to Schema.org `offers` property for rich snippets.

---

### 2. Schedule & Availability (Time-Based Needs)
**Why:** "What styles do you offer?" is less useful than "What can I attend Tuesday at 6pm?"

**Data to Collect:**
- **Peak Hours:** When is the studio busiest?
- **Class Frequency:** How many classes per week per style?
- **Waitlist Policy:** How does waitlist work?
- **Pre-Registration Required:** Can you drop in, or must you book ahead?
- **Cancellation Policy:** How far in advance to cancel?
- **No-Show Policy:** What happens if you don't show?

**Advanced:**
- **Live Schedule Integration:** API connection to booking platforms (Mindbody, etc.)
- **Real-time Availability:** Show if classes are full right now

---

### 3. Class Experience Details (Complements Your "Vibe" Data)
**Why:** Adds quantitative data to your qualitative "vibe" metrics.

**Data to Collect:**
- **Class Size:** Average students per class (intimate vs. large)
- **Class Duration:** Standard class length (60, 75, 90 minutes)
- **Teacher Consistency:** Same teachers weekly vs. rotating schedule
- **Music Volume:** "Loud," "Moderate," "Quiet" (complements your music type)
- **Cueing Style:** "Detailed alignment cues" vs. "Flow-based" vs. "Silent practice"
- **Photo/Video Policy:** Can students take photos? Instagram-friendly?

---

### 4. Community & Events (Beyond Regular Classes)
**Why:** Shows studio engagement and community-building.

**Data to Collect:**
- **Workshops:** Regular workshops? Monthly? Quarterly?
- **Teacher Training:** Do they offer YTT programs?
- **Retreats:** Local or international retreats?
- **Community Events:** Social gatherings, potlucks, etc.
- **Online/Virtual Classes:** Live-streamed or on-demand options?
- **App/Platform:** Do they have their own app?

---

### 5. Studio Background & Credibility
**Why:** Builds trust and helps students understand studio philosophy.

**Data to Collect:**
- **Years in Business:** Established vs. new studio
- **Yoga Alliance Registered:** Yes/No
- **Founder/Owner Background:** Brief bio or philosophy statement
- **Awards/Recognition:** Local awards, "Best of" mentions
- **Teacher Qualifications:** Average teacher experience level
- **Continuing Education:** Do teachers regularly train/update?

---

### 6. Family & Age Considerations
**Why:** Important for parents and different age groups.

**Data to Collect:**
- **Kids Classes:** Age ranges offered
- **Teen Classes:** Specific teen programs
- **Family-Friendly:** Can kids observe? Family classes?
- **Prenatal/Postnatal:** Specialized classes
- **Senior-Friendly:** Classes adapted for older adults
- **Age Restrictions:** Minimum age for regular classes?

---

### 7. Language & Communication
**Why:** Important for non-English speakers and international students.

**Data to Collect:**
- **Language of Instruction:** English, Spanish, Bilingual, etc.
- **Multilingual Teachers:** Languages spoken by staff
- **Translation Services:** Available?
- **Communication Style:** "Silent practice" vs. "Verbal instruction"

---

### 8. Technology & Booking
**Why:** Reduces friction - students need to know what app/platform to use.

**Data to Collect:**
- **Booking Platform:** Mindbody, ClassPass, Momoyoga, Glofox, Acuity, etc.
- **App Required:** Do they have their own app?
- **Online Booking:** Can you book online? Or phone only?
- **Check-in Method:** App check-in, front desk, self-service?
- **Waitlist Management:** How does waitlist work?

---

### 9. Health & Safety (Post-COVID & General)
**Why:** Still relevant, and shows studio care.

**Data to Collect:**
- **Air Quality:** HVAC system, air filtration
- **Cleaning Protocols:** Between-class cleaning?
- **Props Sanitization:** How are props cleaned?
- **Vaccination Policy:** If any (sensitive, but some students want to know)
- **Mask Policy:** Current policy
- **First Aid:** Staff trained? First aid kit available?

---

### 10. Special Accommodations
**Why:** Complements your accessibility section with specific accommodations.

**Data to Collect:**
- **Chronic Pain/Injury:** Modifications available?
- **Pregnancy Modifications:** Offered?
- **Large Body Support:** Props for larger bodies? Chairs available?
- **Mobility Aids:** Can students bring walkers, canes, etc.?
- **Service Animals:** Welcome?

---

## 🎯 Prioritization for Implementation

### Phase 1: Must-Have (Implement First)
1. **Pricing & Packages** - Critical for conversion
2. **Schedule & Availability** - Time-based needs
3. **Your "Vibe & Culture" data** - The differentiator
4. **Your "Know Before You Go" logistics** - Friction removers

### Phase 2: High Value (Add Soon)
5. **Inclusivity & Accessibility** - Modern standards
6. **Class Experience Details** - Complements vibe data
7. **Booking Platform Info** - Reduces friction

### Phase 3: Nice to Have (Add Later)
8. **Community & Events** - Engagement
9. **Studio Background** - Credibility
10. **Family & Age Considerations** - Niche needs
11. **Structured Review Data** - Advanced insights

---

## 💡 Implementation Strategy

### GeoDirectory Custom Fields

Your GeoDirectory plugin supports custom fields. You can add:

1. **Text Fields:** For simple data (e.g., "Music Type")
2. **Select/Dropdown Fields:** For standardized options (e.g., "Spirituality Meter")
3. **Checkbox Fields:** For multiple selections (e.g., "Amenities")
4. **Number Fields:** For quantitative data (e.g., "Temperature Range")
5. **Textarea Fields:** For longer descriptions (e.g., "Adjustment Policy")

### Schema.org Mapping

Map your custom fields to Schema.org properties:
- `offers` → Pricing packages
- `openingHours` → Schedule (already implemented)
- `amenityFeature` → Amenities
- `audience` → Inclusivity data
- Custom properties for vibe data

### Data Collection Approach

**Frame to Studio Owners:**
> "Help the *right* students find you. By collecting detailed 'personality data,' we protect you from bad reviews caused by mismatched expectations. Students who love incense and chanting will find you, while those seeking silent gym workouts will filter you out."

**Benefits for Studios:**
- ✅ Attract ideal students
- ✅ Reduce no-shows and cancellations
- ✅ Improve student retention
- ✅ Stand out from generic directories
- ✅ Better match expectations

---

## 📊 Data Collection Form Strategy

### Tier 1: Quick Setup (5 minutes)
- Basic info: Name, address, phone, website
- Pricing: Drop-in rate, intro offer
- Booking platform
- Key amenities: Mats, props, showers

### Tier 2: Complete Profile (15 minutes)
- All "Vibe & Culture" data
- Full amenities list
- Schedule details
- Inclusivity badges

### Tier 3: Advanced Details (Optional)
- Structured review prompts
- Community events
- Teacher qualifications
- Studio background

---

## 🚀 Next Steps

1. **Review this expanded list** - Decide what to include
2. **Prioritize fields** - Start with Phase 1
3. **Design custom fields** - Create GeoDirectory custom fields
4. **Update schema** - Map new fields to Schema.org
5. **Create collection form** - Make it easy for studios to fill out
6. **Display on listings** - Show this data on single studio pages

---

## 🎨 Display Strategy

**On Single Studio Page:**

1. **Hero Section:** Name, location, basic stats
2. **Vibe Card:** Spirituality meter, heat policy, sensory environment
3. **Logistics Card:** Rentals, facilities, arrival policy
4. **Pricing Card:** Packages, memberships, intro offers
5. **Schedule Card:** Class times, frequency, booking info
6. **Inclusivity Badges:** Accessibility, safe space indicators
7. **Amenities Grid:** Visual icons for all amenities
8. **Reviews:** Structured review data displayed prominently

---

## ✅ Final Thoughts

Your original research is **excellent** and covers the most important differentiators. The additions above complement your foundation by:

- Adding **quantitative data** (pricing, schedule) to your qualitative "vibe" data
- Addressing **practical needs** (booking, technology) that reduce friction
- Providing **credibility markers** (background, qualifications) that build trust
- Ensuring **completeness** (family, language, health) for all student types

**The combination of your "vibe" focus + practical logistics + inclusivity = World's best yoga directory.**



