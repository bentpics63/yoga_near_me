# Studio Intake Questionnaire
## Master Document: Questions, Instructions & Display Mapping

**Purpose:** This questionnaire collects all data needed for your studio listing page. Every question maps directly to how your studio appears on Yoga Near Me.

**Form Platform:** Ninja Forms  
**Estimated Time:** 15-20 minutes for complete profile  
**Data Flow:** Form → GeoDirectory → Single Studio Listing Page

---

## 📋 Form Structure Overview

The questionnaire is organized into **9 sections** that match how information appears on your listing page:

1. **Basic Information** → Hero Section
2. **Vibe & Culture** → Vibe Card (The Differentiator!)
3. **Pricing & Packages** → Pricing Card
4. **Logistics & Amenities** → Logistics Card + Amenities Grid
5. **Schedule & Booking** → Schedule Card
6. **Inclusivity & Accessibility** → Inclusivity Badges
7. **Class Experience** → Class Details Section
8. **Community & Events** → Community Section
9. **Studio Background** → About Section

---

## Section 1: Basic Information
**Displays On:** Hero Section (Top of page)

### Q1.1: Studio Name *
**Field Type:** Text (Single Line)  
**Required:** Yes  
**GeoDirectory Field:** Post Title  
**Display Location:** Hero Section - Large H1 heading

**Instructions:**
> Enter your studio's official name exactly as you want it to appear. This will be the main heading on your listing page.

**Example:** "Stretch Chi" or "CorePower Yoga - La Jolla"

---

### Q1.2: Street Address *
**Field Type:** Text (Single Line)  
**Required:** Yes  
**GeoDirectory Field:** `street`  
**Display Location:** Hero Section - Below studio name

**Instructions:**
> Enter your complete street address including street number and name.

**Example:** "410 S Michigan Ave"

---

### Q1.3: City *
**Field Type:** Text (Single Line)  
**Required:** Yes  
**GeoDirectory Field:** `city`  
**Display Location:** Hero Section - Part of address line

**Instructions:**
> Enter the city where your studio is located.

**Example:** "Chicago"

---

### Q1.4: State/Province *
**Field Type:** Text (Single Line) or Select (US States)  
**Required:** Yes  
**GeoDirectory Field:** `region`  
**Display Location:** Hero Section - Part of address line

**Instructions:**
> Enter your state (or province if outside US). Use standard abbreviations (e.g., "IL" for Illinois).

**Example:** "Illinois" or "IL"

---

### Q1.5: ZIP/Postal Code *
**Field Type:** Text (Single Line)  
**Required:** Yes  
**GeoDirectory Field:** `zip`  
**Display Location:** Hero Section - Part of address line

**Instructions:**
> Enter your ZIP code (or postal code if outside US).

**Example:** "60605"

---

### Q1.6: Country *
**Field Type:** Select (Country List)  
**Required:** Yes  
**GeoDirectory Field:** `country`  
**Display Location:** Hero Section - Part of address line (if needed)

**Instructions:**
> Select your country from the dropdown list.

**Default:** "United States"

---

### Q1.7: Phone Number *
**Field Type:** Phone  
**Required:** Yes  
**GeoDirectory Field:** `phone`  
**Display Location:** Hero Section - Contact info, Right Column - Contact widget

**Instructions:**
> Enter your studio's main phone number. Include area code. This will be clickable on mobile devices.

**Example:** "(773) 800-0244" or "773-800-0244"

---

### Q1.8: Email Address *
**Field Type:** Email  
**Required:** Yes  
**GeoDirectory Field:** `email`  
**Display Location:** Right Column - Contact widget

**Instructions:**
> Enter your studio's main email address for inquiries.

**Example:** "hello@stretchchi.com"

---

### Q1.9: Website URL *
**Field Type:** URL  
**Required:** Yes  
**GeoDirectory Field:** `website`  
**Display Location:** Hero Section - "Book a Class" button link, Right Column - Contact widget

**Instructions:**
> Enter your studio's website URL. Include "https://" if you have it.

**Example:** "https://stretchchi.com" or "https://clients.mindbodyonline.com/classic/ws?studioid=20894"

---

### Q1.10: Studio Description *
**Field Type:** Textarea (Rich Text Editor)  
**Required:** Yes  
**GeoDirectory Field:** `post_desc`  
**Display Location:** Left Column - Main description section

**Instructions:**
> Write a compelling description of your studio (150-300 words). This is your chance to tell students what makes your studio special. Include:
> - What styles of yoga you offer
> - Your studio's philosophy or approach
> - What students can expect
> - Any unique features or programs
>
> **Tip:** Write in second person ("You'll find...") and focus on the student experience.

**Example:**
> "At Stretch Chi, we believe yoga is for every body. Our welcoming studio offers a variety of classes from gentle restorative to challenging power flow. Whether you're a complete beginner or an experienced practitioner, our experienced teachers will guide you through a practice that honors your body and meets you where you are. We're committed to creating an inclusive, judgment-free space where you can explore movement, breath, and mindfulness."

---

### Q1.11: Featured Image
**Field Type:** File Upload (Image)  
**Required:** No (but highly recommended)  
**GeoDirectory Field:** Featured Image  
**Display Location:** Hero Section - Hero image/gallery

**Instructions:**
> Upload your studio's best photo. This will be the main image displayed on your listing page. Recommended size: 1200x800px or larger. Image should show your studio space, students practicing, or your studio exterior.

**File Requirements:**
- Format: JPG, PNG, or WebP
- Max size: 5MB
- Recommended dimensions: 1200x800px (3:2 ratio)

---

### Q1.12: Additional Images
**Field Type:** File Upload (Multiple Images)  
**Required:** No  
**GeoDirectory Field:** Gallery Images  
**Display Location:** Hero Section - Image gallery/slider

**Instructions:**
> Upload additional photos of your studio (up to 10 images). These will appear in a gallery on your listing page. Include:
> - Studio interior
> - Practice space
> - Props/equipment
> - Community events
> - Teachers (with permission)

**File Requirements:**
- Format: JPG, PNG, or WebP
- Max size per image: 5MB
- Recommended dimensions: 1200x800px

---

## Section 2: Vibe & Culture
**Displays On:** Vibe Card (Prominent section below hero)

**Why This Matters:** This is what makes your directory different! Students want to know what it *feels like* to practice at your studio, not just what styles you offer.

---

### Q2.1: Spirituality Meter *
**Field Type:** Select (Single Choice)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field `spirituality_meter`  
**Display Location:** Vibe Card - Prominent badge/indicator

**Instructions:**
> Select the option that best describes your studio's overall approach to yoga practice.

**Options:**
- **Workout/Fitness Focus** - Physical practice, athletic, gym-like atmosphere
- **Mindful/Breath-Focus** - Balanced approach, emphasis on breath and mindfulness
- **Traditional (Chanting/Sanskrit/Philosophy)** - Traditional yoga, Sanskrit, chanting, philosophy discussions

**Why This Matters:** Students who love chanting won't be disappointed at a fitness-focused studio, and vice versa. This helps the *right* students find you.

---

### Q2.2: Heat Policy
**Field Type:** Select (Single Choice)  
**Required:** No (but recommended if you offer hot yoga)  
**GeoDirectory Field:** Custom Field `heat_policy`  
**Display Location:** Vibe Card - Heat indicator

**Instructions:**
> If you offer heated classes, select the temperature range that best describes your hot yoga classes.

**Options:**
- **No Hot Yoga** - All classes are room temperature
- **Warm (85-90°F)** - Warm but not hot, gentle heat
- **Hot (95-100°F)** - Traditional hot yoga temperature
- **Very Hot (105°F+)** - Bikram-style or very hot classes
- **Variable** - Different classes have different temperatures

**Additional Field:** If you selected a heated option, specify humidity level:
- **Low Humidity** - Dry heat
- **Moderate Humidity** - Some humidity
- **High Humidity** - High humidity (Bikram-style)

---

### Q2.3: Music During Classes *
**Field Type:** Select (Multiple Choice - Checkboxes)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field `music_type`  
**Display Location:** Vibe Card - Music indicator

**Instructions:**
> Select all that apply. What type of music (if any) is typically played during classes?

**Options:**
- **Top 40/Pop** - Popular music, upbeat
- **Instrumental/Ambient** - Soothing instrumental music
- **Kirtan/Mantra** - Traditional chanting, mantras
- **No Music** - Silent practice
- **Varies by Class** - Different classes have different music
- **Teacher's Choice** - Music varies by teacher

**Why This Matters:** Some students specifically seek silent studios or studios with chanting. This helps them find you.

---

### Q2.4: Scent/Incense Policy *
**Field Type:** Select (Single Choice)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field `scent_policy`  
**Display Location:** Vibe Card - Scent indicator

**Instructions:**
> Select the option that best describes your studio's scent environment.

**Options:**
- **Incense/Sage Used Frequently** - Regular use of incense, sage, or essential oils
- **Occasional Use** - Sometimes used, not every class
- **Fragrance-Free Zone** - No scents, fragrance-free environment
- **Essential Oils Only** - Essential oils used, no incense

**Why This Matters:** Critical for allergy sufferers! Students with scent sensitivities need to know this before arriving.

---

### Q2.5: Lighting Style *
**Field Type:** Select (Single Choice)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field `lighting_style`  
**Display Location:** Vibe Card - Lighting indicator

**Instructions:**
> How is your studio typically lit during classes?

**Options:**
- **Bright/Fluorescent** - Well-lit, bright lights
- **Dim/Candlelit** - Low lighting, candles, ambient
- **Natural Light** - Windows, natural daylight
- **Adjustable** - Varies by class or time of day

---

### Q2.6: Adjustment Policy *
**Field Type:** Select (Single Choice)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field `adjustment_policy`  
**Display Location:** Vibe Card - Adjustment indicator

**Instructions:**
> How do teachers provide physical adjustments during class?

**Options:**
- **Hands-on Adjustments Common** - Teachers regularly provide physical adjustments
- **Consent Cards Used** - Students indicate consent with cards
- **Verbal Cues Only** - No physical adjustments, verbal guidance only
- **Ask First** - Teachers ask before adjusting
- **Varies by Teacher** - Different teachers have different approaches

**Why This Matters:** Some students prefer hands-on adjustments, others prefer not to be touched. This helps match expectations.

---

## Section 3: Pricing & Packages
**Displays On:** Pricing Card (Right Column or dedicated section)

---

### Q3.1: Drop-in Rate *
**Field Type:** Number (Currency)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field `drop_in_rate`  
**Display Location:** Pricing Card - Prominently displayed

**Instructions:**
> Enter the price for a single drop-in class. Enter numbers only (no dollar sign).

**Example:** "25" (will display as $25)

---

### Q3.2: Class Packages
**Field Type:** Repeater Field (Package Name, Number of Classes, Price)  
**Required:** No  
**GeoDirectory Field:** Custom Field `class_packages` (JSON array)  
**Display Location:** Pricing Card - Package list

**Instructions:**
> List your class packages. For each package, provide:
> - Package name (e.g., "5-Class Pass")
> - Number of classes included
> - Price

**Example:**
- Package 1: "5-Class Pass" | 5 classes | $100
- Package 2: "10-Class Pass" | 10 classes | $180
- Package 3: "20-Class Pass" | 20 classes | $320

---

### Q3.3: Monthly/Annual Memberships
**Field Type:** Repeater Field (Membership Type, Price, Benefits)  
**Required:** No  
**GeoDirectory Field:** Custom Field `memberships` (JSON array)  
**Display Location:** Pricing Card - Membership options

**Instructions:**
> If you offer monthly or annual memberships, list them here. Include:
> - Membership name (e.g., "Unlimited Monthly")
> - Price
> - What's included (e.g., "Unlimited classes, 10% off workshops")

**Example:**
- "Unlimited Monthly" | $150/month | Unlimited classes, 10% off workshops
- "Annual Membership" | $1,500/year | Unlimited classes, 20% off workshops, free mat rental

---

### Q3.4: New Student Special *
**Field Type:** Text (Single Line) + Number (Price)  
**Required:** No (but highly recommended)  
**GeoDirectory Field:** Custom Field `intro_offer`  
**Display Location:** Pricing Card - Prominent "New Student" badge

**Instructions:**
> Describe your new student special. This will be prominently displayed to attract first-time visitors.

**Examples:**
- "First Class Free"
- "$20 for 2 Weeks Unlimited"
- "3 Classes for $30"

**Additional Fields:**
- **Special Price:** Enter the price (if applicable)
- **Valid For:** How long is the offer valid? (e.g., "First visit only", "Valid for 30 days")

---

### Q3.5: ClassPass Availability
**Field Type:** Select (Yes/No) + Text (Tier Info)  
**Required:** No  
**GeoDirectory Field:** Custom Field `classpass_available`  
**Display Location:** Pricing Card - ClassPass badge

**Instructions:**
> Are you available on ClassPass?

**Options:**
- **Yes** - We accept ClassPass
- **No** - We don't accept ClassPass
- **Limited** - Only certain classes/times

**If Yes:** Which ClassPass tier(s) are you available on?
- Tier 1 (Lowest credits)
- Tier 2
- Tier 3
- Tier 4 (Highest credits)

---

### Q3.6: Discounts Available
**Field Type:** Checkboxes (Multiple Choice)  
**Required:** No  
**GeoDirectory Field:** Custom Field `discounts`  
**Display Location:** Pricing Card - Discount badges

**Instructions:**
> Select all discounts you offer.

**Options:**
- **Student Discount** - Discount for students (specify % or amount)
- **Senior Discount** - Discount for seniors (specify % or amount)
- **Military Discount** - Discount for military/veterans (specify % or amount)
- **First Responder Discount** - Discount for first responders
- **Corporate/Group Rates** - Discounts for groups or corporate bookings

**Additional Field:** For each selected discount, specify the discount amount or percentage.

---

### Q3.7: Gift Cards Available
**Field Type:** Select (Yes/No) + URL (Purchase Link)  
**Required:** No  
**GeoDirectory Field:** Custom Field `gift_cards`  
**Display Location:** Pricing Card - Gift card info

**Instructions:**
> Do you offer gift cards?

**If Yes:**
- Can they be purchased online? (Yes/No)
- Purchase URL (if available online)

---

## Section 4: Logistics & Amenities
**Displays On:** Logistics Card + Amenities Grid

---

### Q4.1: Mat Rental *
**Field Type:** Select (Single Choice)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field `mat_rental`  
**Display Location:** Logistics Card - Mat rental info

**Instructions:**
> Do you provide yoga mats for students?

**Options:**
- **Free** - Mats provided at no charge
- **Rental Fee** - Mats available for rent (specify price: $___)
- **Not Available** - Students must bring their own mats

---

### Q4.2: Props Available *
**Field Type:** Checkboxes (Multiple Choice)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field `props_available`  
**Display Location:** Amenities Grid - Props icons

**Instructions:**
> Which props are available for student use? Select all that apply.

**Options:**
- **Blocks** - Yoga blocks
- **Straps** - Yoga straps
- **Bolsters** - Yoga bolsters
- **Blankets** - Yoga blankets
- **Eye Pillows** - Eye pillows for relaxation
- **Chairs** - Chairs for modifications
- **All Props Free** - All props available at no charge
- **Props for Rent** - Props available for rental fee

---

### Q4.3: Water Station *
**Field Type:** Select (Single Choice)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field `water_station`  
**Display Location:** Logistics Card - Water info

**Instructions:**
> Do you have a water station or water available?

**Options:**
- **Filtered Water Station** - Filtered water dispenser
- **Water Fountain** - Standard water fountain
- **Bottled Water for Sale** - Bottled water available for purchase
- **No Water Available** - Students should bring their own

---

### Q4.4: Showers *
**Field Type:** Select (Single Choice)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field `showers`  
**Display Location:** Logistics Card - Shower info

**Instructions:**
> Do you have shower facilities?

**Options:**
- **Yes, Showers Available** - Shower facilities available
- **No Showers** - No shower facilities
- **Showers Nearby** - Showers available in building (not in studio)

**Why This Matters:** Critical for morning/lunch crowds who need to shower before work.

---

### Q4.5: Lockers/Storage *
**Field Type:** Select (Single Choice)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field `lockers`  
**Display Location:** Logistics Card - Storage info

**Instructions:**
> What storage options do you provide for students' belongings?

**Options:**
- **Lockers with Keys** - Lockers available, keys provided
- **Lockers with Codes** - Lockers available, combination codes
- **Cubbies in Room** - Open cubbies in practice room
- **Coat Rack Only** - Basic coat rack, no secure storage
- **No Storage** - No storage available

---

### Q4.6: Mirrors *
**Field Type:** Select (Single Choice)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field `mirrors`  
**Display Location:** Logistics Card - Mirror info

**Instructions:**
> Does your studio have mirrors?

**Options:**
- **Mirrored Walls** - Full wall mirrors
- **Partial Mirrors** - Some mirrors
- **No Mirrors** - Mirror-free studio

**Why This Matters:** Some students specifically seek mirror-free studios to avoid body image triggers.

---

### Q4.7: Arrival Policy *
**Field Type:** Textarea  
**Required:** Yes  
**GeoDirectory Field:** Custom Field `arrival_policy`  
**Display Location:** Logistics Card - Arrival policy

**Instructions:**
> Describe your arrival/late entry policy. This is crucial information for students.

**Key Points to Include:**
- Is there a "hard lock" policy? (Doors lock X minutes before class - no late entry)
- How early should students arrive?
- What happens if students arrive late?

**Example:**
> "Doors lock 5 minutes before class starts. No late entry allowed. Please arrive at least 10 minutes early to check in and set up your mat."

---

### Q4.8: Parking *
**Field Type:** Select (Single Choice) + Text (Details)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field `parking`  
**Display Location:** Logistics Card - Parking info

**Instructions:**
> What parking options are available?

**Options:**
- **Dedicated Lot** - Studio has its own parking lot
- **Street Parking** - Street parking available
- **Parking Validation** - Parking validation available (specify location)
- **Paid Parking Garage** - Nearby paid parking garage
- **No Parking** - No parking available, public transit recommended

**Additional Field:** Provide specific details (e.g., "Free parking in rear lot", "Metered street parking, $2/hour", "Parking validation at front desk for garage across street")

---

### Q4.9: Additional Amenities
**Field Type:** Checkboxes (Multiple Choice)  
**Required:** No  
**GeoDirectory Field:** Custom Field `amenities`  
**Display Location:** Amenities Grid - Icons

**Instructions:**
> Select all additional amenities your studio offers.

**Options:**
- **Retail Shop** - Yoga gear/clothing for sale
- **Cafe/Juice Bar** - Food or drinks available
- **Changing Rooms** - Dedicated changing areas
- **Bathrooms** - Restroom facilities
- **WiFi** - Free WiFi available
- **Charging Stations** - Phone charging available
- **Outdoor Space** - Outdoor practice area
- **Multiple Studios** - More than one practice room
- **Workshop Space** - Dedicated space for workshops
- **Teacher Training Space** - Space for teacher training

---

## Section 5: Schedule & Booking
**Displays On:** Schedule Card + Booking Info

---

### Q5.1: Booking Platform *
**Field Type:** Select (Single Choice) + URL (Booking Link)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field `booking_platform`  
**Display Location:** Hero Section - "Book a Class" button, Schedule Card

**Instructions:**
> Which booking platform do you use? This helps students know which app/website they need.

**Options:**
- **Mindbody** - Mindbody Online
- **ClassPass** - ClassPass app
- **Momoyoga** - Momoyoga platform
- **Glofox** - Glofox platform
- **Acuity Scheduling** - Acuity Scheduling
- **Wix Bookings** - Wix Bookings
- **Our Own Website** - Booking through your website
- **Phone Only** - Phone booking only
- **Walk-in Only** - No advance booking needed
- **Other** - Specify platform name

**Additional Field:** If you have a direct booking URL, enter it here. This will be used for the "Book a Class" button.

**Example:** "https://clients.mindbodyonline.com/classic/ws?studioid=20894"

---

### Q5.2: Pre-Registration Required
**Field Type:** Select (Yes/No/Depends)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field `preregistration_required`  
**Display Location:** Schedule Card - Booking info

**Instructions:**
> Can students drop in without advance booking?

**Options:**
- **Yes, Required** - All classes require advance booking
- **No, Walk-ins Welcome** - Students can drop in anytime
- **Depends on Class** - Some classes require booking, others allow walk-ins

---

### Q5.3: Cancellation Policy *
**Field Type:** Textarea  
**Required:** Yes  
**GeoDirectory Field:** Custom Field `cancellation_policy`  
**Display Location:** Schedule Card - Policy info

**Instructions:**
> Describe your cancellation policy. Be specific about timing and fees.

**Key Points to Include:**
- How far in advance must students cancel?
- Are there cancellation fees?
- What happens to class credits if cancelled?

**Example:**
> "Cancellations must be made at least 2 hours before class start time. Late cancellations or no-shows will result in loss of class credit. Unlimited members will be charged a $10 late cancellation fee."

---

### Q5.4: Waitlist Policy
**Field Type:** Textarea  
**Required:** No  
**GeoDirectory Field:** Custom Field `waitlist_policy`  
**Display Location:** Schedule Card - Waitlist info

**Instructions:**
> How does your waitlist work?

**Key Points to Include:**
- How do students join the waitlist?
- When are waitlisted students notified?
- What happens if a spot opens up?

**Example:**
> "If a class is full, you can join the waitlist. You'll be automatically added if a spot opens up. You'll receive an email/text notification. Please cancel if you can't make it."

---

### Q5.5: Business Hours *
**Field Type:** Business Hours Field (GeoDirectory built-in)  
**Required:** Yes  
**GeoDirectory Field:** `business_hours`  
**Display Location:** Right Column - Business Hours widget, Schema markup

**Instructions:**
> Set your studio's business hours. This includes both class times and when your studio is open for other activities.

**Format:** Use GeoDirectory's business hours picker to set:
- Days of the week
- Opening and closing times
- Special hours (holidays, etc.)

**Note:** This data automatically populates your schema.org markup for Google search results.

---

### Q5.6: Peak Hours
**Field Type:** Textarea  
**Required:** No  
**GeoDirectory Field:** Custom Field `peak_hours`  
**Display Location:** Schedule Card - Peak hours info

**Instructions:**
> When is your studio typically busiest? This helps students plan their visits.

**Example:**
> "Peak hours: Weekday mornings (6-9am) and evenings (5-8pm). Weekend mornings (8-11am) are also busy. Midday classes are typically less crowded."

---

## Section 6: Inclusivity & Accessibility
**Displays On:** Inclusivity Badges (Prominent section)

---

### Q6.1: Physical Accessibility *
**Field Type:** Checkboxes (Multiple Choice)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field `accessibility_features`  
**Display Location:** Inclusivity Badges - Accessibility icons

**Instructions:**
> Select all that apply. This helps students with mobility needs find accessible studios.

**Options:**
- **Wheelchair Accessible** - Step-free access, accessible entrance
- **Elevator Available** - Elevator access to studio
- **Accessible Restrooms** - Wheelchair-accessible restrooms
- **Step-Free to Practice Room** - No steps to enter practice space
- **Accessible Parking** - Accessible parking spaces available
- **Not Fully Accessible** - Some barriers exist (describe in notes)

**Additional Field:** If "Not Fully Accessible," describe barriers (e.g., "Studio is on second floor, no elevator")

---

### Q6.2: Gender-Neutral Facilities
**Field Type:** Select (Yes/No)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field `gender_neutral_facilities`  
**Display Location:** Inclusivity Badges - Gender-neutral badge

**Instructions:**
> Do you have gender-neutral restrooms or changing areas?

**Options:**
- **Yes** - Gender-neutral facilities available
- **No** - Traditional gendered facilities only
- **Single-Occupancy** - Single-occupancy restrooms available

---

### Q6.3: Body Inclusivity
**Field Type:** Select (Yes/No) + Textarea (Details)  
**Required:** No (but recommended)  
**GeoDirectory Field:** Custom Field `body_inclusive`  
**Display Location:** Inclusivity Badges - Body-positive badge

**Instructions:**
> Is your studio committed to body inclusivity and Health At Every Size (HAES) principles?

**Options:**
- **Yes** - We are HAES-aligned and body-positive
- **No** - Not specifically aligned
- **Working Toward** - We're learning and improving

**If Yes:** Describe your commitment (e.g., "We welcome all bodies, avoid weight-loss language, and provide props for all body sizes")

---

### Q6.4: BIPOC Safe Space
**Field Type:** Select (Yes/No)  
**Required:** No  
**GeoDirectory Field:** Custom Field `bipoc_safe_space`  
**Display Location:** Inclusivity Badges - BIPOC safe space badge

**Instructions:**
> Do you explicitly welcome and create safe space for BIPOC (Black, Indigenous, People of Color) students?

**Options:**
- **Yes** - We are committed to BIPOC inclusion
- **No** - Not specifically stated

**If Yes:** Consider adding a statement about your commitment (optional).

---

### Q6.5: LGBTQ+ Safe Space
**Field Type:** Select (Yes/No)  
**Required:** No  
**GeoDirectory Field:** Custom Field `lgbtq_safe_space`  
**Display Location:** Inclusivity Badges - LGBTQ+ safe space badge

**Instructions:**
> Do you explicitly welcome and create safe space for LGBTQ+ students?

**Options:**
- **Yes** - We are committed to LGBTQ+ inclusion
- **No** - Not specifically stated

---

### Q6.6: Trauma-Informed Practice
**Field Type:** Select (Yes/No)  
**Required:** No  
**GeoDirectory Field:** Custom Field `trauma_informed`  
**Display Location:** Inclusivity Badges - Trauma-informed badge

**Instructions:**
> Do you offer trauma-informed yoga classes or have trauma-informed certified teachers?

**Options:**
- **Yes** - We offer trauma-informed classes/teachers
- **No** - Not currently offered

---

## Section 7: Class Experience Details
**Displays On:** Class Details Section

---

### Q7.1: Yoga Styles Offered *
**Field Type:** Checkboxes (Multiple Choice) - Standardized List  
**Required:** Yes  
**GeoDirectory Field:** Categories (`gd_placecategory`)  
**Display Location:** Left Column - Categories widget, Meta Bar - Style tags

**Instructions:**
> Select all yoga styles you offer. Use standardized terms so students can filter by style.

**Standardized Options:**
- **Vinyasa** - Flow-based practice
- **Hatha** - Traditional, slower-paced
- **Ashtanga** - Traditional, set sequences
- **Yin** - Long-held poses, deep stretching
- **Restorative** - Supported, relaxing poses
- **Iyengar** - Alignment-focused, props-heavy
- **Kundalini** - Spiritual, breathwork, chanting
- **Power Yoga** - Athletic, strength-focused
- **Hot Yoga** - Heated practice
- **Bikram** - 26-pose sequence, 105°F
- **Prenatal** - For pregnant students
- **Postnatal** - For new mothers
- **Yin Yang** - Combination of yin and yang
- **Aerial** - Yoga with hammocks/slings
- **Acro Yoga** - Partner yoga
- **Other** - Specify additional styles

**Note:** These will appear as filterable categories on your directory.

---

### Q7.2: Average Class Size
**Field Type:** Select (Single Choice)  
**Required:** No  
**GeoDirectory Field:** Custom Field `class_size`  
**Display Location:** Class Details Section

**Instructions:**
> What's the average number of students per class?

**Options:**
- **Intimate (5-10 students)** - Small, personal classes
- **Small (10-20 students)** - Small group classes
- **Medium (20-35 students)** - Standard class size
- **Large (35-50 students)** - Large classes
- **Very Large (50+ students)** - High-capacity classes
- **Varies** - Depends on class/time

---

### Q7.3: Standard Class Duration *
**Field Type:** Select (Multiple Choice - Checkboxes)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field `class_duration`  
**Display Location:** Schedule Card - Duration info

**Instructions:**
> What are your standard class durations? Select all that apply.

**Options:**
- **30 minutes** - Short classes
- **45 minutes** - Mid-length classes
- **60 minutes** - Standard hour-long classes
- **75 minutes** - Extended classes
- **90 minutes** - Long classes
- **120 minutes** - Extended/workshop length

---

### Q7.4: Teacher Consistency
**Field Type:** Select (Single Choice)  
**Required:** No  
**GeoDirectory Field:** Custom Field `teacher_consistency`  
**Display Location:** Class Details Section

**Instructions:**
> How consistent are your teachers?

**Options:**
- **Same Teachers Weekly** - Regular schedule, same teachers
- **Rotating Schedule** - Teachers rotate, but schedule is posted
- **Varied** - Teachers vary by class/time

---

### Q7.5: Teacher Qualifications
**Field Type:** Select (Single Choice)  
**Required:** No  
**GeoDirectory Field:** Custom Field `teacher_qualifications`  
**Display Location:** Class Details Section

**Instructions:**
> What's the typical qualification level of your teachers?

**Options:**
- **RYT-200 (Standard)** - 200-hour certified teachers
- **ERYT-500 (Experienced)** - 500-hour experienced teachers
- **Mixed Levels** - Various certification levels
- **Specialized Certifications** - Trauma-informed, yoga therapy, etc.

---

### Q7.6: Best Class for Beginners
**Field Type:** Text (Single Line)  
**Required:** No (but highly recommended)  
**GeoDirectory Field:** Custom Field `beginner_class`  
**Display Location:** Class Details Section - Prominent "Start Here" badge

**Instructions:**
> Which specific class would you recommend for absolute beginners? Include class name and day/time if possible.

**Example:** "Gentle Hatha - Tuesdays 6pm" or "Yoga Basics - Every Saturday 10am"

---

### Q7.7: Photo/Video Policy
**Field Type:** Select (Single Choice)  
**Required:** No  
**GeoDirectory Field:** Custom Field `photo_policy`  
**Display Location:** Class Details Section

**Instructions:**
> What's your policy on students taking photos/videos?

**Options:**
- **Photos Allowed** - Students can take photos
- **Instagram-Friendly** - Photos encouraged, tag us!
- **No Photos During Class** - Photos allowed before/after, not during
- **No Photos** - No photography allowed

---

## Section 8: Community & Events
**Displays On:** Community Section (Below main content)

---

### Q8.1: Workshops Offered
**Field Type:** Select (Yes/No) + Textarea (Details)  
**Required:** No  
**GeoDirectory Field:** Custom Field `workshops`  
**Display Location:** Community Section

**Instructions:**
> Do you offer workshops beyond regular classes?

**If Yes:** Describe your workshop offerings:
- How often? (Monthly, quarterly, etc.)
- What topics? (e.g., "Arm balances", "Meditation", "Philosophy")
- Typical price range?

---

### Q8.2: Teacher Training Programs
**Field Type:** Select (Yes/No) + Textarea (Details)  
**Required:** No  
**GeoDirectory Field:** Custom Field `teacher_training`  
**Display Location:** Community Section

**Instructions:**
> Do you offer Yoga Teacher Training (YTT) programs?

**If Yes:** Provide details:
- Program length (200-hour, 300-hour, etc.)
- Format (intensive, weekend, etc.)
- Next start date (if known)
- Website link for more info

---

### Q8.3: Retreats
**Field Type:** Select (Yes/No) + Textarea (Details)  
**Required:** No  
**GeoDirectory Field:** Custom Field `retreats`  
**Display Location:** Community Section

**Instructions:**
> Do you offer yoga retreats?

**If Yes:** Describe:
- Local or international?
- How often?
- Typical duration?
- Website link for more info

---

### Q8.4: Community Events
**Field Type:** Select (Yes/No) + Textarea (Details)  
**Required:** No  
**GeoDirectory Field:** Custom Field `community_events`  
**Display Location:** Community Section

**Instructions:**
> Do you host community events beyond classes?

**If Yes:** Describe:
- What types? (Potlucks, social gatherings, etc.)
- How often?
- Examples of past events?

---

### Q8.5: Online/Virtual Classes
**Field Type:** Select (Yes/No) + URL (Link)  
**Required:** No  
**GeoDirectory Field:** Custom Field `virtual_classes`  
**Display Location:** Community Section - Virtual classes badge

**Instructions:**
> Do you offer online or virtual classes?

**Options:**
- **Live-Streamed Classes** - Real-time online classes
- **On-Demand Classes** - Pre-recorded classes
- **Hybrid** - Both live and on-demand
- **No Virtual Classes** - In-person only

**If Yes:** Provide link to virtual class platform or website.

---

## Section 9: Studio Background
**Displays On:** About Section (Below main content)

---

### Q9.1: Years in Business
**Field Type:** Number  
**Required:** No  
**GeoDirectory Field:** Custom Field `years_in_business`  
**Display Location:** About Section - Credibility badge

**Instructions:**
> How many years has your studio been in business?

**Example:** "5" (will display as "Established 2019" or "5 years in business")

---

### Q9.2: Yoga Alliance Registered
**Field Type:** Select (Yes/No)  
**Required:** No  
**GeoDirectory Field:** Custom Field `yoga_alliance`  
**Display Location:** About Section - Credibility badge

**Instructions:**
> Is your studio registered with Yoga Alliance?

**Options:**
- **Yes** - Registered Yoga School (RYS)
- **No** - Not registered

---

### Q9.3: Founder/Owner Philosophy
**Field Type:** Textarea  
**Required:** No  
**GeoDirectory Field:** Custom Field `founder_philosophy`  
**Display Location:** About Section

**Instructions:**
> Share your studio's philosophy or founder's background. This helps students understand your approach and values.

**Example:**
> "Founded in 2019 by Jane Smith, a 20-year yoga practitioner and ERYT-500 teacher. Our philosophy is rooted in making yoga accessible to all bodies and creating a welcoming, judgment-free community."

---

### Q9.4: Awards/Recognition
**Field Type:** Textarea  
**Required:** No  
**GeoDirectory Field:** Custom Field `awards`  
**Display Location:** About Section - Awards badges

**Instructions:**
> Have you received any awards or recognition? (e.g., "Best Yoga Studio 2023" from local magazine)

**Example:**
> "Best Yoga Studio - Chicago Reader 2023"
> "Top 10 Yoga Studios in Illinois - Yoga Journal 2022"

---

## 📊 Form Completion Strategy

### Tier 1: Quick Setup (5 minutes)
**Minimum Required Fields:**
- Section 1: All basic info (Q1.1-Q1.10)
- Section 2: Vibe & Culture basics (Q2.1, Q2.3, Q2.4)
- Section 3: Drop-in rate (Q3.1)
- Section 4: Key amenities (Q4.1-Q4.3)
- Section 5: Booking platform (Q5.1), Business hours (Q5.5)
- Section 7: Yoga styles (Q7.1)

**Result:** Basic listing goes live immediately.

---

### Tier 2: Complete Profile (15 minutes)
**Add All Remaining Fields:**
- Complete all sections
- Add images
- Fill in all optional fields

**Result:** Full-featured listing with all differentiators.

---

### Tier 3: Advanced Details (Optional)
**Enhancements:**
- Detailed descriptions
- Multiple images
- Community events
- Awards/recognition

**Result:** Premium listing with maximum detail.

---

## 🔄 Data Flow: Form → GeoDirectory → Display

### How Data Maps to Listing Page

| Form Question | GeoDirectory Field | Display Location | Widget/Element |
|---------------|-------------------|------------------|----------------|
| Q1.1 Studio Name | Post Title | Hero Section | GD Post Title Widget (H1) |
| Q1.2-Q1.6 Address | street, city, region, zip, country | Hero Section | GD Post Address Widget |
| Q1.7 Phone | phone | Hero + Right Column | GD Contact Info Widget |
| Q1.8 Email | email | Right Column | GD Contact Info Widget |
| Q1.9 Website | website | Hero "Book" Button + Contact | Button Link + Contact Widget |
| Q1.10 Description | post_desc | Left Column | GD Post Description Widget |
| Q1.11 Featured Image | Featured Image | Hero Section | GD Post Images Widget |
| Q2.1 Spirituality Meter | Custom: spirituality_meter | Vibe Card | Custom Field Widget |
| Q2.2 Heat Policy | Custom: heat_policy | Vibe Card | Custom Field Widget |
| Q2.3 Music Type | Custom: music_type | Vibe Card | Custom Field Widget |
| Q3.1 Drop-in Rate | Custom: drop_in_rate | Pricing Card | Custom Field Widget |
| Q3.2 Class Packages | Custom: class_packages | Pricing Card | Custom Field Widget |
| Q4.1-Q4.9 Amenities | Custom: amenities | Amenities Grid | GD Post Amenities Widget |
| Q5.1 Booking Platform | Custom: booking_platform | Hero Button + Schedule | Button Link + Schedule Card |
| Q5.5 Business Hours | business_hours | Right Column + Schema | GD Business Hours Widget |
| Q6.1-Q6.6 Inclusivity | Custom: accessibility_features | Inclusivity Badges | Custom Field Widgets |
| Q7.1 Yoga Styles | Categories (gd_placecategory) | Meta Bar + Left Column | GD Categories Widget |
| Q8.1-Q8.5 Community | Custom: workshops, etc. | Community Section | Custom Field Widgets |

---

## ✅ Form Validation & Quality Checks

### Required Field Validation
- All Section 1 fields marked with * are required
- At least one yoga style (Q7.1) must be selected
- Business hours (Q5.5) must be set

### Data Quality Checks
- Phone number format validation
- Email format validation
- URL format validation
- Image file size/format validation

### Post-Submission Actions
1. **Auto-create GeoDirectory Listing** - Form submission creates `gd_place` post
2. **Send Confirmation Email** - To studio owner with listing link
3. **Admin Notification** - Notify admin for review/approval
4. **Schema Generation** - Auto-generate schema.org markup

---

## 🎨 Design Considerations

### Form Design Should Match Listing Page
- **Same Color Scheme** - Use brand colors (sage, teal, terracotta)
- **Same Typography** - Inter font family
- **Consistent Icons** - Use same icon set as listing page
- **Progressive Disclosure** - Show sections one at a time (optional)

### User Experience
- **Progress Indicator** - Show completion percentage
- **Save Draft** - Allow saving and returning later
- **Help Text** - Contextual help for each question
- **Examples** - Show example answers for complex questions

---

## 📝 Next Steps

1. **Review This Questionnaire** - Ensure all questions align with your vision
2. **Create Ninja Form** - Build form using this structure
3. **Set Up GeoDirectory Custom Fields** - Create custom fields to match form questions
4. **Map Form to GeoDirectory** - Use Ninja Forms → GeoDirectory integration
5. **Test Form Submission** - Submit test listing and verify data flow
6. **Update Listing Page** - Ensure all widgets display form data correctly

---

## 🚀 Ready to Build?

This questionnaire is designed to:
- ✅ Collect all data needed for world-class listings
- ✅ Map directly to your listing page display
- ✅ Work seamlessly with GeoDirectory
- ✅ Create a cohesive user experience from form to listing

**Time to build:** Once you approve this questionnaire, we can create the Ninja Form and set up the GeoDirectory custom fields.

