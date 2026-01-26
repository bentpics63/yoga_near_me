# Studio Claim Form - Field Specifications

## Overview
This document specifies new fields to add to the GeoDirectory studio claim form, organized by priority and section.

---

## HIGH PRIORITY FIELDS

### Section: Yoga Styles & Classes

#### Yoga Styles Offered
- **Field Type:** Multi-select checkboxes
- **Field Name:** `yoga_styles`
- **Required:** Yes
- **Options:**
  - [ ] Vinyasa / Flow
  - [ ] Hatha
  - [ ] Hot Yoga / Bikram
  - [ ] Yin
  - [ ] Restorative
  - [ ] Power Yoga
  - [ ] Ashtanga
  - [ ] Kundalini
  - [ ] Prenatal
  - [ ] Iyengar
  - [ ] Aerial / Antigravity
  - [ ] Yoga Nidra
  - [ ] Chair Yoga
  - [ ] Kids / Family Yoga
  - [ ] Other (specify)
- **Help Text:** "Select all yoga styles regularly offered at your studio"

#### Class Levels Offered
- **Field Type:** Multi-select checkboxes
- **Field Name:** `class_levels`
- **Required:** Yes
- **Options:**
  - [ ] Beginner / Intro
  - [ ] All Levels
  - [ ] Intermediate
  - [ ] Advanced
- **Help Text:** "Select all experience levels you accommodate"

#### Heated Classes
- **Field Type:** Radio buttons
- **Field Name:** `heated_classes`
- **Required:** Yes
- **Options:**
  - ( ) Yes - Heated classes available
  - ( ) No - Non-heated only
  - ( ) Both heated and non-heated
- **Help Text:** "Do you offer heated/hot yoga classes?"

#### Class Schedule Link
- **Field Type:** URL
- **Field Name:** `schedule_url`
- **Required:** No
- **Placeholder:** "https://yourstudio.com/schedule"
- **Help Text:** "Link to your full class schedule (MindBody, Momence, website, etc.)"

#### Booking Platform
- **Field Type:** Dropdown
- **Field Name:** `booking_platform`
- **Required:** No
- **Options:**
  - MindBody
  - Momence
  - Vagaro
  - WellnessLiving
  - ClassPass
  - Studio website
  - Phone/walk-in only
  - Other
- **Help Text:** "How do students book classes?"

---

### Section: Pricing

#### Drop-In Rate
- **Field Type:** Number (currency)
- **Field Name:** `dropin_rate`
- **Required:** Yes
- **Placeholder:** "25"
- **Help Text:** "Single class drop-in price in USD"

#### Class Pack Options
- **Field Type:** Textarea (structured)
- **Field Name:** `class_packs`
- **Required:** No
- **Placeholder:**
  ```
  5-class pack: $100
  10-class pack: $180
  20-class pack: $320
  ```
- **Help Text:** "List your class pack options with prices"

#### Monthly Unlimited Rate
- **Field Type:** Number (currency)
- **Field Name:** `unlimited_rate`
- **Required:** No
- **Placeholder:** "150"
- **Help Text:** "Monthly unlimited membership price in USD (leave blank if not offered)"

#### New Student Offer
- **Field Type:** Text
- **Field Name:** `new_student_offer`
- **Required:** No
- **Placeholder:** "First class free" or "2 weeks unlimited $40"
- **Help Text:** "Special offer for first-time students"

#### New Student Offer Expiration
- **Field Type:** Date
- **Field Name:** `new_student_offer_expires`
- **Required:** No
- **Help Text:** "When does this offer expire? Leave blank if ongoing"

---

### Section: Teachers

#### Lead Teacher / Owner Name
- **Field Type:** Text
- **Field Name:** `lead_teacher`
- **Required:** No
- **Placeholder:** "Jane Smith"

#### Lead Teacher Credentials
- **Field Type:** Multi-select
- **Field Name:** `lead_teacher_credentials`
- **Required:** No
- **Options:**
  - [ ] RYT-200
  - [ ] RYT-500
  - [ ] E-RYT 200
  - [ ] E-RYT 500
  - [ ] YACEP
  - [ ] RPYT (Prenatal)
  - [ ] RCYT (Children's)
  - [ ] Other certification
- **Help Text:** "Yoga Alliance and other credentials"

#### Number of Teachers
- **Field Type:** Number
- **Field Name:** `teacher_count`
- **Required:** No
- **Placeholder:** "8"
- **Help Text:** "How many teachers are on your roster?"

#### Teacher Page Link
- **Field Type:** URL
- **Field Name:** `teachers_url`
- **Required:** No
- **Placeholder:** "https://yourstudio.com/teachers"
- **Help Text:** "Link to your teachers/instructors page"

---

## MEDIUM PRIORITY FIELDS

### Section: Services & Programs

#### Private Sessions
- **Field Type:** Radio + conditional
- **Field Name:** `private_sessions`
- **Required:** No
- **Options:**
  - ( ) Yes
  - ( ) No
- **Conditional Field (if Yes):**
  - **Private Session Rate:** Number (currency)
  - **Field Name:** `private_session_rate`
  - **Placeholder:** "100"
  - **Help Text:** "Starting price for 1-hour private session"

#### Workshops Offered
- **Field Type:** Radio
- **Field Name:** `workshops_offered`
- **Required:** No
- **Options:**
  - ( ) Yes - Regular workshops
  - ( ) Yes - Occasional workshops
  - ( ) No

#### Teacher Training Programs
- **Field Type:** Multi-select checkboxes
- **Field Name:** `teacher_training`
- **Required:** No
- **Options:**
  - [ ] Not offered
  - [ ] 200-Hour YTT (RYS-200)
  - [ ] 300-Hour YTT (RYS-300)
  - [ ] 500-Hour YTT (RYS-500)
  - [ ] Specialty certifications
- **Help Text:** "Select if you're a Registered Yoga School"

#### Retreats Offered
- **Field Type:** Radio
- **Field Name:** `retreats_offered`
- **Required:** No
- **Options:**
  - ( ) Yes
  - ( ) No

#### Online/Virtual Classes
- **Field Type:** Radio + conditional
- **Field Name:** `virtual_classes`
- **Required:** No
- **Options:**
  - ( ) Yes - Live streaming
  - ( ) Yes - On-demand library
  - ( ) Both live and on-demand
  - ( ) No
- **Conditional Field (if Yes):**
  - **Virtual Class Platform:** Text
  - **Field Name:** `virtual_platform`
  - **Placeholder:** "Zoom, YouTube, custom app"

---

### Section: Studio Details

#### Year Established
- **Field Type:** Number (year)
- **Field Name:** `year_established`
- **Required:** No
- **Placeholder:** "2015"
- **Help Text:** "What year did your studio open?"

#### Studio Size
- **Field Type:** Dropdown
- **Field Name:** `studio_size`
- **Required:** No
- **Options:**
  - Boutique (under 15 students)
  - Medium (15-30 students)
  - Large (30+ students)
  - Multiple rooms

#### Yoga Alliance Registered
- **Field Type:** Radio + conditional
- **Field Name:** `yoga_alliance_registered`
- **Required:** No
- **Options:**
  - ( ) Yes
  - ( ) No
- **Conditional Field (if Yes):**
  - **Yoga Alliance Profile URL:** URL
  - **Field Name:** `yoga_alliance_url`

---

### Section: Practical Information

#### Parking
- **Field Type:** Multi-select + text
- **Field Name:** `parking`
- **Required:** No
- **Options:**
  - [ ] Free parking lot
  - [ ] Free street parking
  - [ ] Paid parking lot
  - [ ] Street parking (metered)
  - [ ] Parking validation available
  - [ ] No dedicated parking
- **Additional Field:**
  - **Parking Notes:** Text
  - **Field Name:** `parking_notes`
  - **Placeholder:** "Free lot behind building, enter from Oak St"

#### Public Transit
- **Field Type:** Text
- **Field Name:** `public_transit`
- **Required:** No
- **Placeholder:** "2 blocks from Central Station (Red Line)"
- **Help Text:** "Nearest subway, bus, or transit stop"

#### What to Bring - First Visit
- **Field Type:** Multi-select checkboxes
- **Field Name:** `what_to_bring`
- **Required:** No
- **Options:**
  - [ ] Yoga mat (rentals available)
  - [ ] Yoga mat (required - no rentals)
  - [ ] Towel for hot classes
  - [ ] Water bottle
  - [ ] Comfortable clothing
  - [ ] Photo ID
- **Help Text:** "What should new students bring?"

#### First Visit Instructions
- **Field Type:** Textarea
- **Field Name:** `first_visit_info`
- **Required:** No
- **Character Limit:** 500
- **Placeholder:** "Please arrive 15 minutes early to complete registration. Our studio is on the 2nd floor - elevator available."
- **Help Text:** "Any special instructions for first-time visitors"

#### Cancellation Policy
- **Field Type:** Dropdown
- **Field Name:** `cancellation_policy`
- **Required:** No
- **Options:**
  - No cancellation fee
  - 2 hours notice required
  - 4 hours notice required
  - 12 hours notice required
  - 24 hours notice required
  - Other (specify in notes)

#### Languages Spoken
- **Field Type:** Multi-select checkboxes
- **Field Name:** `languages`
- **Required:** No
- **Options:**
  - [ ] English
  - [ ] Spanish
  - [ ] French
  - [ ] Mandarin
  - [ ] Hindi
  - [ ] Japanese
  - [ ] Korean
  - [ ] Portuguese
  - [ ] Other (specify)
- **Help Text:** "Languages your teachers can instruct in"

---

## NICE TO HAVE FIELDS

### Section: Accessibility

#### Accessibility Features
- **Field Type:** Multi-select checkboxes
- **Field Name:** `accessibility`
- **Required:** No
- **Options:**
  - [ ] Wheelchair accessible entrance
  - [ ] Wheelchair accessible studio
  - [ ] Elevator available
  - [ ] Accessible restroom
  - [ ] Hearing loop
  - [ ] Large print materials
  - [ ] Adaptive equipment available
  - [ ] Teachers trained in adaptive yoga
- **Help Text:** "Select all accessibility features your studio offers"

### Section: Payment & Policies

#### Payment Methods
- **Field Type:** Multi-select checkboxes
- **Field Name:** `payment_methods`
- **Required:** No
- **Options:**
  - [ ] Credit/Debit cards
  - [ ] Cash
  - [ ] Apple Pay / Google Pay
  - [ ] Venmo / PayPal
  - [ ] HSA/FSA accepted
  - [ ] ClassPass
- **Help Text:** "Accepted payment methods"

---

## FIELD GROUPING FOR FORM UI

### Tab 1: Basic Info (existing)
- Studio name, categories, description
- Address, map, coordinates
- Phone, email, website
- Social links
- Hours of operation
- Logo, cover image

### Tab 2: Classes & Styles (NEW)
- Yoga styles offered
- Class levels
- Heated classes
- Class schedule link
- Booking platform

### Tab 3: Pricing & Offers (NEW)
- Drop-in rate
- Class pack options
- Monthly unlimited rate
- New student offer
- Price range (existing)

### Tab 4: Teachers & Programs (NEW)
- Lead teacher info
- Teacher count
- Teachers page link
- Private sessions
- Workshops
- Teacher training
- Retreats
- Virtual classes

### Tab 5: Studio Details (NEW)
- Year established
- Studio size
- Yoga Alliance registered
- Parking
- Public transit
- What to bring
- First visit instructions
- Cancellation policy
- Languages
- Accessibility features
- Payment methods

### Tab 6: Media (existing)
- Logo
- Cover image
- Video
- Gallery images

---

## VALIDATION RULES

| Field | Validation |
|-------|------------|
| yoga_styles | At least 1 required |
| class_levels | At least 1 required |
| dropin_rate | Number, 1-500 range |
| unlimited_rate | Number, 50-1000 range |
| year_established | Number, 1900-current year |
| schedule_url | Valid URL format |
| teachers_url | Valid URL format |

---

## DATABASE CONSIDERATIONS

All new fields should be:
- Indexed for search/filtering (especially yoga_styles, heated_classes, class_levels)
- Exportable for reporting
- Editable by studio owner after claim
- Visible in admin for verification

Priority filter fields for frontend search:
1. yoga_styles
2. heated_classes
3. class_levels
4. price_range
5. teacher_training
6. virtual_classes
