# Studio Intake Questionnaire
## Complete Guide with Explanations & Metadata Mapping

**Purpose:** This document provides the complete questionnaire with detailed explanations for each question, plus exact metadata field names for GeoDirectory integration.

**Form Platform:** Ninja Forms  
**Integration:** Ninja Forms → GeoDirectory Custom Fields  
**Estimated Time:** 15-20 minutes for complete profile

---

## 📋 How This Works

### Data Flow
```
Ninja Form Submission 
    ↓
GeoDirectory Post Creation (gd_place post type)
    ↓
Custom Fields Stored as Post Meta
    ↓
Single Studio Listing Page Displays Data
```

### GeoDirectory Field Naming Convention
- **Standard Fields:** Use GeoDirectory's built-in field names (e.g., `street`, `city`, `phone`)
- **Custom Fields:** Use prefix `ynm_` for Yoga Near Me custom fields (e.g., `ynm_spirituality_meter`)
- **Storage:** All fields stored as post meta using `geodir_get_post_meta($post_id, 'field_name', true)`

---

## Section 1: Basic Information
**Purpose:** Essential contact and location information that appears in the hero section and throughout the listing.

**Displays On:** Hero Section (Top of page), Contact Widget, Schema.org markup

---

### Q1.1: Studio Name *
**Question Text:** "What is your studio's official name?"

**Field Type:** Text (Single Line)  
**Required:** Yes  
**GeoDirectory Field:** `post_title` (WordPress post title)  
**Meta Key:** N/A (uses WordPress core field)  
**Display Location:** Hero Section - Large H1 heading

**Why We Ask:**
> This is the primary identifier for your studio. It appears as the main heading on your listing page and in search results. Students will search for your studio by name.

**Instructions:**
> Enter your studio's official name exactly as you want it to appear. This will be the main heading on your listing page and in search results.

**Example:** "Stretch Chi" or "CorePower Yoga - La Jolla"

**How It's Used:**
- Primary H1 heading on listing page
- Page title for SEO
- Schema.org `name` property
- Search result title

**Ninja Forms Field Settings:**
- Field Label: "Studio Name"
- Field Key: `studio_name` (will map to post title)
- Required: Yes
- Validation: Text, max 100 characters

---

### Q1.2: Street Address *
**Question Text:** "What is your studio's street address?"

**Field Type:** Text (Single Line)  
**Required:** Yes  
**GeoDirectory Field:** `street`  
**Meta Key:** `geodir_street`  
**Display Location:** Hero Section - Below studio name, Address widget

**Why We Ask:**
> Your street address is essential for students to find your studio. It's also used for map display, directions, and local SEO.

**Instructions:**
> Enter your complete street address including street number and name. Do not include city, state, or ZIP code here (those are separate fields).

**Example:** "410 S Michigan Ave" or "123 Main Street, Suite 200"

**How It's Used:**
- Address display on listing page
- Google Maps integration
- Schema.org `address.streetAddress`
- Local SEO optimization
- Distance calculations

**Ninja Forms Field Settings:**
- Field Label: "Street Address"
- Field Key: `street_address`
- Required: Yes
- Validation: Text, max 200 characters
- **Action:** Map to GeoDirectory field `street`

---

### Q1.3: City *
**Question Text:** "What city is your studio located in?"

**Field Type:** Text (Single Line) or Select (if you have a city list)  
**Required:** Yes  
**GeoDirectory Field:** `city`  
**Meta Key:** `geodir_city`  
**Display Location:** Hero Section - Part of address line, City filters

**Why We Ask:**
> City is used for filtering studios by location, local SEO, and displaying your address. It's also used in search queries like "yoga studios in [city]".

**Instructions:**
> Enter the city where your studio is located. Use the official city name (not neighborhood name unless that's the official city).

**Example:** "Chicago" (not "Lincoln Park" unless that's the official city name)

**How It's Used:**
- Address display
- City-based filtering on directory
- Schema.org `address.addressLocality`
- Local SEO ("yoga in Chicago")
- Auto-generates Rank Math focus keyword

**Ninja Forms Field Settings:**
- Field Label: "City"
- Field Key: `city`
- Required: Yes
- Validation: Text, max 100 characters
- **Action:** Map to GeoDirectory field `city`

---

### Q1.4: State/Province *
**Question Text:** "What state or province is your studio located in?"

**Field Type:** Select (US States dropdown) or Text  
**Required:** Yes  
**GeoDirectory Field:** `region`  
**Meta Key:** `geodir_region`  
**Display Location:** Hero Section - Part of address line, State filters

**Why We Ask:**
> State/province is used for broader location filtering and is required for complete address formatting. It's also used in local SEO.

**Instructions:**
> Select your state from the dropdown (or enter province name if outside US). Use standard abbreviations (e.g., "IL" for Illinois) if your system supports it.

**Example:** "Illinois" or "IL"

**How It's Used:**
- Address display
- State-based filtering
- Schema.org `address.addressRegion`
- Local SEO ("yoga in Illinois")
- Auto-generates Rank Math focus keyword

**Ninja Forms Field Settings:**
- Field Label: "State/Province"
- Field Key: `state`
- Required: Yes
- Field Type: Select (US States) or Text
- **Action:** Map to GeoDirectory field `region`

---

### Q1.5: ZIP/Postal Code *
**Question Text:** "What is your studio's ZIP or postal code?"

**Field Type:** Text (Single Line)  
**Required:** Yes  
**GeoDirectory Field:** `zip`  
**Meta Key:** `geodir_zip`  
**Display Location:** Hero Section - Part of address line

**Why We Ask:**
> ZIP code is used for precise location mapping, distance calculations, and complete address formatting. It's also used for local SEO.

**Instructions:**
> Enter your ZIP code (or postal code if outside US). Use standard 5-digit format for US ZIP codes.

**Example:** "60605" (US) or "M5H 2N2" (Canada)

**How It's Used:**
- Address display
- Distance calculations
- Schema.org `address.postalCode`
- Local SEO optimization
- Map accuracy

**Ninja Forms Field Settings:**
- Field Label: "ZIP/Postal Code"
- Field Key: `zip_code`
- Required: Yes
- Validation: Text, max 20 characters
- **Action:** Map to GeoDirectory field `zip`

---

### Q1.6: Country *
**Question Text:** "What country is your studio located in?"

**Field Type:** Select (Country List)  
**Required:** Yes  
**GeoDirectory Field:** `country`  
**Meta Key:** `geodir_country`  
**Display Location:** Hero Section - Part of address line (if needed)

**Why We Ask:**
> Country is required for international studios and ensures proper address formatting. It's also used for country-based filtering.

**Instructions:**
> Select your country from the dropdown list.

**Default:** "United States"

**How It's Used:**
- Address display (for international studios)
- Country-based filtering
- Schema.org `address.addressCountry`
- International SEO

**Ninja Forms Field Settings:**
- Field Label: "Country"
- Field Key: `country`
- Required: Yes
- Field Type: Select (Country List)
- Default Value: "United States"
- **Action:** Map to GeoDirectory field `country`

---

### Q1.7: Phone Number *
**Question Text:** "What is your studio's main phone number?"

**Field Type:** Phone  
**Required:** Yes  
**GeoDirectory Field:** `phone`  
**Meta Key:** `geodir_phone`  
**Display Location:** Hero Section - Contact info, Right Column - Contact widget

**Why We Ask:**
> Phone number allows students to call your studio directly. It's displayed as a clickable link on mobile devices, making it easy for students to contact you.

**Instructions:**
> Enter your studio's main phone number. Include area code. You can use any format - we'll standardize it for display.

**Example:** "(773) 800-0244" or "773-800-0244" or "7738000244"

**How It's Used:**
- Clickable phone link on mobile devices
- Contact widget display
- Schema.org `telephone` property
- Contact information section

**Ninja Forms Field Settings:**
- Field Label: "Phone Number"
- Field Key: `phone_number`
- Required: Yes
- Validation: Phone number format
- **Action:** Map to GeoDirectory field `phone`

---

### Q1.8: Email Address *
**Question Text:** "What is your studio's main email address?"

**Field Type:** Email  
**Required:** Yes  
**GeoDirectory Field:** `email`  
**Meta Key:** `geodir_email`  
**Display Location:** Right Column - Contact widget

**Why We Ask:**
> Email allows students to contact you for questions, class schedules, or special requests. It's displayed as a clickable mailto link.

**Instructions:**
> Enter your studio's main email address for inquiries. This should be an email you check regularly.

**Example:** "hello@stretchchi.com" or "info@yogastudio.com"

**How It's Used:**
- Clickable email link (mailto:)
- Contact widget display
- Schema.org `email` property
- Contact form integration (if applicable)

**Ninja Forms Field Settings:**
- Field Label: "Email Address"
- Field Key: `email_address`
- Required: Yes
- Validation: Email format
- **Action:** Map to GeoDirectory field `email`

---

### Q1.9: Website URL *
**Question Text:** "What is your studio's website URL?"

**Field Type:** URL  
**Required:** Yes  
**GeoDirectory Field:** `website`  
**Meta Key:** `geodir_website`  
**Display Location:** Hero Section - "Book a Class" button link, Right Column - Contact widget, Schema.org

**Why We Ask:**
> Website URL is used for the "Book a Class" button and allows students to visit your website for more information, schedules, and online booking. It's also used in schema.org markup for SEO.

**Instructions:**
> Enter your studio's website URL. Include "https://" if you have it. If you use a booking platform like Mindbody, you can enter your booking page URL here.

**Example:** 
- "https://stretchchi.com" (studio website)
- "https://clients.mindbodyonline.com/classic/ws?studioid=20894" (booking platform)

**How It's Used:**
- "Book a Class" button link (if no separate booking URL provided)
- Contact widget - Website link
- Schema.org `url` property
- External link for more information

**Ninja Forms Field Settings:**
- Field Label: "Website URL"
- Field Key: `website_url`
- Required: Yes
- Validation: URL format
- Placeholder: "https://yourstudio.com"
- **Action:** Map to GeoDirectory field `website`

---

### Q1.10: Studio Description *
**Question Text:** "Describe your studio (150-300 words)"

**Field Type:** Textarea (Rich Text Editor - allow basic formatting)  
**Required:** Yes  
**GeoDirectory Field:** `post_desc`  
**Meta Key:** `geodir_post_desc`  
**Display Location:** Left Column - Main description section, Schema.org description

**Why We Ask:**
> Your description is the primary way students learn about your studio. It appears prominently on your listing page and helps students understand your philosophy, approach, and what makes you unique. It's also used in search results and schema.org markup.

**Instructions:**
> Write a compelling description of your studio (150-300 words). This is your chance to tell students what makes your studio special. Include:
> - What styles of yoga you offer
> - Your studio's philosophy or approach
> - What students can expect
> - Any unique features or programs
>
> **Tip:** Write in second person ("You'll find...") and focus on the student experience. Avoid generic phrases like "we offer yoga classes."

**Example:**
> "At Stretch Chi, we believe yoga is for every body. Our welcoming studio offers a variety of classes from gentle restorative to challenging power flow. Whether you're a complete beginner or an experienced practitioner, our experienced teachers will guide you through a practice that honors your body and meets you where you are. We're committed to creating an inclusive, judgment-free space where you can explore movement, breath, and mindfulness. Our classes emphasize alignment, breathwork, and mindful movement, helping you build strength, flexibility, and inner peace."

**How It's Used:**
- Main description section on listing page
- Schema.org `description` property
- Search result snippet (if no meta description)
- SEO content

**Ninja Forms Field Settings:**
- Field Label: "Studio Description"
- Field Key: `studio_description`
- Required: Yes
- Field Type: Textarea (Rich Text)
- Character Limit: 2000 characters
- Allowed Tags: `<p>`, `<br>`, `<strong>`, `<em>`, `<ul>`, `<ol>`, `<li>`
- **Action:** Map to GeoDirectory field `post_desc`

---

### Q1.11: Featured Image
**Question Text:** "Upload your studio's featured image"

**Field Type:** File Upload (Image)  
**Required:** No (but highly recommended)  
**GeoDirectory Field:** Featured Image (WordPress core)  
**Meta Key:** `_thumbnail_id` (WordPress core)  
**Display Location:** Hero Section - Hero image/gallery, Schema.org image

**Why We Ask:**
> A featured image is the main visual representation of your studio. It appears prominently in the hero section and helps students visualize your space. It's also used in search results, social media sharing, and schema.org markup.

**Instructions:**
> Upload your studio's best photo. This will be the main image displayed on your listing page. Recommended size: 1200x800px or larger. Image should show your studio space, students practicing, or your studio exterior.

**File Requirements:**
- Format: JPG, PNG, or WebP
- Max size: 5MB
- Recommended dimensions: 1200x800px (3:2 ratio)
- Aspect ratio: 3:2 or 16:9

**How It's Used:**
- Hero section main image
- Schema.org `image` property
- Social media sharing (Open Graph image)
- Search result thumbnail
- Gallery thumbnail

**Ninja Forms Field Settings:**
- Field Label: "Featured Image"
- Field Key: `featured_image`
- Required: No
- Field Type: File Upload
- Allowed File Types: jpg, jpeg, png, webp
- Max File Size: 5MB
- **Action:** Set as WordPress featured image

---

### Q1.12: Additional Images
**Question Text:** "Upload additional photos of your studio (up to 10 images)"

**Field Type:** File Upload (Multiple Images)  
**Required:** No  
**GeoDirectory Field:** Gallery Images (GeoDirectory gallery)  
**Meta Key:** `geodir_images` (stored as array)  
**Display Location:** Hero Section - Image gallery/slider

**Why We Ask:**
> Additional images help students see different aspects of your studio - the practice space, props, community events, etc. They appear in a gallery on your listing page and help students get a complete picture of your studio.

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
- Max images: 10

**How It's Used:**
- Image gallery/slider in hero section
- Gallery widget display
- Visual representation of studio

**Ninja Forms Field Settings:**
- Field Label: "Additional Images"
- Field Key: `gallery_images`
- Required: No
- Field Type: File Upload (Multiple)
- Allowed File Types: jpg, jpeg, png, webp
- Max File Size: 5MB per image
- Max Files: 10
- **Action:** Store as GeoDirectory gallery images

---

## Section 2: Vibe & Culture
**Purpose:** This is your differentiator! These questions help students understand what it *feels like* to practice at your studio, not just what styles you offer.

**Displays On:** Vibe Card (Prominent section below hero)

**Why This Section Matters:**
> Generic directories tell you *where* a studio is. The best directory tells you *what it feels like* to practice there. This data helps the *right* students find you - students who love incense and chanting will find you, while those seeking silent gym workouts will filter you out. This protects you from bad reviews caused by mismatched expectations.

---

### Q2.1: Spirituality Meter *
**Question Text:** "How would you describe your studio's overall approach to yoga practice?"

**Field Type:** Select (Single Choice - Radio Buttons)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_spirituality_meter`  
**Display Location:** Vibe Card - Prominent badge/indicator with icon

**Why We Ask:**
> This is one of the most important differentiators. Students have very different preferences - some want a workout-focused practice, others want traditional chanting and philosophy. By clearly indicating your approach, you attract students who align with your style and avoid mismatched expectations.

**Instructions:**
> Select the option that best describes your studio's overall approach to yoga practice. Think about what most of your classes emphasize.

**Options:**
- **Workout/Fitness Focus** - Physical practice, athletic, gym-like atmosphere, emphasis on strength and flexibility
- **Mindful/Breath-Focus** - Balanced approach, emphasis on breath and mindfulness, moderate spirituality
- **Traditional (Chanting/Sanskrit/Philosophy)** - Traditional yoga, Sanskrit, chanting, philosophy discussions, spiritual focus

**How It's Used:**
- Vibe Card - Large badge with icon
- Filter option on directory ("Show me mindful studios")
- Helps students find studios that match their preferences
- Reduces mismatched expectations

**Ninja Forms Field Settings:**
- Field Label: "Spirituality Meter"
- Field Key: `spirituality_meter`
- Required: Yes
- Field Type: Radio Buttons or Select
- Options:
  - `workout_fitness` - "Workout/Fitness Focus"
  - `mindful_breath` - "Mindful/Breath-Focus"
  - `traditional` - "Traditional (Chanting/Sanskrit/Philosophy)"
- **Action:** Map to GeoDirectory custom field `ynm_spirituality_meter`

---

### Q2.2: Heat Policy
**Question Text:** "Do you offer heated classes? If yes, what temperature range?"

**Field Type:** Select (Single Choice) + Number (Temperature)  
**Required:** No (but recommended if you offer hot yoga)  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_heat_policy` (stores option) + `ynm_heat_temperature` (stores number)  
**Display Location:** Vibe Card - Heat indicator badge

**Why We Ask:**
> "Hot Yoga" is too vague. Students need to know if it's 85°F warm yoga or 105°F Bikram-style. This helps students choose classes that match their heat tolerance and prevents discomfort or health issues.

**Instructions:**
> If you offer heated classes, select the temperature range that best describes your hot yoga classes. If you offer multiple temperature ranges, select the most common one.

**Options:**
- **No Hot Yoga** - All classes are room temperature (70-75°F)
- **Warm (85-90°F)** - Warm but not hot, gentle heat
- **Hot (95-100°F)** - Traditional hot yoga temperature
- **Very Hot (105°F+)** - Bikram-style or very hot classes
- **Variable** - Different classes have different temperatures

**If you selected a heated option, also specify:**
- **Humidity Level:**
  - Low Humidity - Dry heat
  - Moderate Humidity - Some humidity
  - High Humidity - High humidity (Bikram-style)

**How It's Used:**
- Vibe Card - Heat badge with temperature display
- Filter option ("Show me hot yoga studios")
- Helps students choose appropriate classes
- Safety information

**Ninja Forms Field Settings:**
- Field Label: "Heat Policy"
- Field Key: `heat_policy`
- Required: No
- Field Type: Select
- Options:
  - `none` - "No Hot Yoga"
  - `warm` - "Warm (85-90°F)"
  - `hot` - "Hot (95-100°F)"
  - `very_hot` - "Very Hot (105°F+)"
  - `variable` - "Variable"
- Conditional Field: If not "none", show humidity level field
- **Action:** Map to GeoDirectory custom field `ynm_heat_policy`

---

### Q2.3: Music During Classes *
**Question Text:** "What type of music (if any) is typically played during classes?"

**Field Type:** Checkboxes (Multiple Choice)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_music_type` (stored as array/serialized)  
**Display Location:** Vibe Card - Music indicator badge

**Why We Ask:**
> Music preference is a major factor for many students. Some specifically seek silent studios or studios with chanting. By indicating your music style, you help students find studios that match their preferences.

**Instructions:**
> Select all that apply. What type of music (if any) is typically played during classes?

**Options:**
- **Top 40/Pop** - Popular music, upbeat, contemporary
- **Instrumental/Ambient** - Soothing instrumental music, ambient sounds
- **Kirtan/Mantra** - Traditional chanting, mantras, devotional music
- **No Music** - Silent practice, no music
- **Varies by Class** - Different classes have different music
- **Teacher's Choice** - Music varies by teacher preference

**How It's Used:**
- Vibe Card - Music badge with icons
- Filter option ("Show me silent studios")
- Helps students find preferred atmosphere
- Important for students with music preferences

**Ninja Forms Field Settings:**
- Field Label: "Music During Classes"
- Field Key: `music_type`
- Required: Yes
- Field Type: Checkboxes
- Options:
  - `top_40_pop` - "Top 40/Pop"
  - `instrumental_ambient` - "Instrumental/Ambient"
  - `kirtan_mantra` - "Kirtan/Mantra"
  - `no_music` - "No Music"
  - `varies_by_class` - "Varies by Class"
  - `teachers_choice` - "Teacher's Choice"
- **Action:** Map to GeoDirectory custom field `ynm_music_type` (store as serialized array)

---

### Q2.4: Scent/Incense Policy *
**Question Text:** "Does your studio use incense, sage, or other scents?"

**Field Type:** Select (Single Choice)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_scent_policy`  
**Display Location:** Vibe Card - Scent indicator badge

**Why We Ask:**
> **Critical for allergy sufferers!** Students with scent sensitivities, asthma, or allergies need to know if your studio uses scents. This prevents health issues and helps students make informed choices.

**Instructions:**
> Select the option that best describes your studio's scent environment.

**Options:**
- **Incense/Sage Used Frequently** - Regular use of incense, sage, or strong scents
- **Occasional Use** - Sometimes used, not every class
- **Fragrance-Free Zone** - No scents, fragrance-free environment, hypoallergenic
- **Essential Oils Only** - Essential oils used, no incense

**How It's Used:**
- Vibe Card - Scent badge (important for allergies)
- Filter option ("Show me fragrance-free studios")
- Health and safety information
- Helps students with sensitivities

**Ninja Forms Field Settings:**
- Field Label: "Scent/Incense Policy"
- Field Key: `scent_policy`
- Required: Yes
- Field Type: Select
- Options:
  - `frequent` - "Incense/Sage Used Frequently"
  - `occasional` - "Occasional Use"
  - `fragrance_free` - "Fragrance-Free Zone"
  - `essential_oils_only` - "Essential Oils Only"
- **Action:** Map to GeoDirectory custom field `ynm_scent_policy`

---

### Q2.5: Lighting Style *
**Question Text:** "How is your studio typically lit during classes?"

**Field Type:** Select (Single Choice)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_lighting_style`  
**Display Location:** Vibe Card - Lighting indicator badge

**Why We Ask:**
> Lighting affects the mood and atmosphere of classes. Some students prefer bright, energizing light, while others prefer dim, calming environments. This helps students choose studios that match their preferences.

**Instructions:**
> How is your studio typically lit during classes?

**Options:**
- **Bright/Fluorescent** - Well-lit, bright lights, energizing
- **Dim/Candlelit** - Low lighting, candles, ambient, calming
- **Natural Light** - Windows, natural daylight
- **Adjustable** - Varies by class or time of day

**How It's Used:**
- Vibe Card - Lighting badge
- Atmosphere indicator
- Helps students choose preferred environment

**Ninja Forms Field Settings:**
- Field Label: "Lighting Style"
- Field Key: `lighting_style`
- Required: Yes
- Field Type: Select
- Options:
  - `bright_fluorescent` - "Bright/Fluorescent"
  - `dim_candlelit` - "Dim/Candlelit"
  - `natural_light` - "Natural Light"
  - `adjustable` - "Adjustable"
- **Action:** Map to GeoDirectory custom field `ynm_lighting_style`

---

### Q2.6: Adjustment Policy *
**Question Text:** "How do teachers provide physical adjustments during class?"

**Field Type:** Select (Single Choice)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_adjustment_policy`  
**Display Location:** Vibe Card - Adjustment indicator badge

**Why We Ask:**
> Physical adjustments are a sensitive topic. Some students love hands-on adjustments, while others prefer not to be touched. By clearly stating your policy, you help students choose studios that match their comfort level and avoid uncomfortable situations.

**Instructions:**
> How do teachers provide physical adjustments during class?

**Options:**
- **Hands-on Adjustments Common** - Teachers regularly provide physical adjustments
- **Consent Cards Used** - Students indicate consent with cards (red/yellow/green)
- **Verbal Cues Only** - No physical adjustments, verbal guidance only
- **Ask First** - Teachers ask before adjusting
- **Varies by Teacher** - Different teachers have different approaches

**How It's Used:**
- Vibe Card - Adjustment badge
- Important for student comfort and boundaries
- Helps students choose appropriate studios
- Safety and consent information

**Ninja Forms Field Settings:**
- Field Label: "Adjustment Policy"
- Field Key: `adjustment_policy`
- Required: Yes
- Field Type: Select
- Options:
  - `hands_on_common` - "Hands-on Adjustments Common"
  - `consent_cards` - "Consent Cards Used"
  - `verbal_only` - "Verbal Cues Only"
  - `ask_first` - "Ask First"
  - `varies_by_teacher` - "Varies by Teacher"
- **Action:** Map to GeoDirectory custom field `ynm_adjustment_policy`

---

## Section 3: Pricing & Packages
**Purpose:** Clear pricing information helps students make decisions and reduces friction. This section collects all pricing options.

**Displays On:** Pricing Card (Right Column or dedicated section)

---

### Q3.1: Drop-in Rate *
**Question Text:** "What is your drop-in rate for a single class?"

**Field Type:** Number (Currency)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_drop_in_rate`  
**Display Location:** Pricing Card - Prominently displayed, Schema.org offers

**Why We Ask:**
> Drop-in rate is the most common pricing question. Students need to know the cost before committing. This is displayed prominently and used in schema.org markup for rich snippets in search results.

**Instructions:**
> Enter the price for a single drop-in class. Enter numbers only (no dollar sign). We'll format it for display.

**Example:** "25" (will display as "$25")

**How It's Used:**
- Pricing Card - Large, prominent display
- Schema.org `offers` property (for rich snippets)
- Price comparison
- Booking decision factor

**Ninja Forms Field Settings:**
- Field Label: "Drop-in Rate"
- Field Key: `drop_in_rate`
- Required: Yes
- Field Type: Number
- Min: 0
- Max: 999
- Decimal Places: 2
- Prefix: "$"
- **Action:** Map to GeoDirectory custom field `ynm_drop_in_rate`

---

### Q3.2: Class Packages
**Question Text:** "Do you offer class packages? If yes, list them."

**Field Type:** Repeater Field (Package Name, Number of Classes, Price)  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_class_packages` (stored as JSON array)  
**Display Location:** Pricing Card - Package list

**Why We Ask:**
> Class packages offer better value and encourage commitment. Students want to see all their options to make the best choice for their practice.

**Instructions:**
> List your class packages. For each package, provide:
> - Package name (e.g., "5-Class Pass")
> - Number of classes included
> - Price

**Example:**
- Package 1: "5-Class Pass" | 5 classes | $100
- Package 2: "10-Class Pass" | 10 classes | $180
- Package 3: "20-Class Pass" | 20 classes | $320

**How It's Used:**
- Pricing Card - Package list with pricing
- Value comparison
- Encourages package purchases
- Schema.org `offers` property

**Ninja Forms Field Settings:**
- Field Label: "Class Packages"
- Field Key: `class_packages`
- Required: No
- Field Type: Repeater
- Sub-fields:
  - `package_name` (Text) - "Package Name"
  - `number_of_classes` (Number) - "Number of Classes"
  - `price` (Number) - "Price"
- **Action:** Map to GeoDirectory custom field `ynm_class_packages` (store as JSON)

---

### Q3.3: Monthly/Annual Memberships
**Question Text:** "Do you offer monthly or annual memberships? If yes, list them."

**Field Type:** Repeater Field (Membership Type, Price, Benefits)  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_memberships` (stored as JSON array)  
**Display Location:** Pricing Card - Membership options

**Why We Ask:**
> Memberships offer the best value for regular practitioners. Students want to see membership options and benefits to decide if it's worth it.

**Instructions:**
> If you offer monthly or annual memberships, list them here. Include:
> - Membership name (e.g., "Unlimited Monthly")
> - Price
> - What's included (e.g., "Unlimited classes, 10% off workshops")

**Example:**
- "Unlimited Monthly" | $150/month | Unlimited classes, 10% off workshops
- "Annual Membership" | $1,500/year | Unlimited classes, 20% off workshops, free mat rental

**How It's Used:**
- Pricing Card - Membership section
- Value proposition
- Encourages membership sign-ups
- Schema.org `offers` property

**Ninja Forms Field Settings:**
- Field Label: "Monthly/Annual Memberships"
- Field Key: `memberships`
- Required: No
- Field Type: Repeater
- Sub-fields:
  - `membership_name` (Text) - "Membership Name"
  - `price` (Number) - "Price"
  - `billing_period` (Select) - "Billing Period" (Monthly/Annual)
  - `benefits` (Textarea) - "What's Included"
- **Action:** Map to GeoDirectory custom field `ynm_memberships` (store as JSON)

---

### Q3.4: New Student Special *
**Question Text:** "Do you offer a new student special? If yes, describe it."

**Field Type:** Text (Single Line) + Number (Price) + Text (Valid For)  
**Required:** No (but highly recommended)  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_intro_offer` (stores description), `ynm_intro_price` (stores price), `ynm_intro_valid_for` (stores validity)  
**Display Location:** Pricing Card - Prominent "New Student" badge

**Why We Ask:**
> New student specials are powerful conversion tools. They reduce the barrier to entry and encourage first-time visitors. Displaying this prominently helps attract new students.

**Instructions:**
> Describe your new student special. This will be prominently displayed to attract first-time visitors.

**Examples:**
- "First Class Free"
- "$20 for 2 Weeks Unlimited"
- "3 Classes for $30"

**Additional Fields:**
- **Special Price:** Enter the price (if applicable)
- **Valid For:** How long is the offer valid? (e.g., "First visit only", "Valid for 30 days")

**How It's Used:**
- Pricing Card - Prominent badge/box
- Conversion tool
- Attracts new students
- Reduces barrier to entry

**Ninja Forms Field Settings:**
- Field Label: "New Student Special"
- Field Key: `intro_offer`
- Required: No
- Field Type: Text + Number + Text
- Sub-fields:
  - `offer_description` (Text) - "Offer Description"
  - `offer_price` (Number) - "Price (if applicable)"
  - `valid_for` (Text) - "Valid For"
- **Action:** Map to GeoDirectory custom fields `ynm_intro_offer`, `ynm_intro_price`, `ynm_intro_valid_for`

---

### Q3.5: ClassPass Availability
**Question Text:** "Are you available on ClassPass?"

**Field Type:** Select (Yes/No) + Select (Tier Info)  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_classpass_available` (boolean), `ynm_classpass_tier` (tier level)  
**Display Location:** Pricing Card - ClassPass badge

**Why We Ask:**
> Many students use ClassPass to try different studios. Indicating ClassPass availability helps these students find you and know which tier to use.

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

**How It's Used:**
- Pricing Card - ClassPass badge
- Helps ClassPass users find you
- Indicates which tier to use

**Ninja Forms Field Settings:**
- Field Label: "ClassPass Availability"
- Field Key: `classpass_available`
- Required: No
- Field Type: Select
- Options:
  - `yes` - "Yes"
  - `no` - "No"
  - `limited` - "Limited"
- Conditional Field: If "yes" or "limited", show tier selection
- **Action:** Map to GeoDirectory custom fields `ynm_classpass_available`, `ynm_classpass_tier`

---

### Q3.6: Discounts Available
**Question Text:** "Do you offer any discounts? Select all that apply."

**Field Type:** Checkboxes (Multiple Choice) + Number (Discount Amount)  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_discounts` (stored as array with discount details)  
**Display Location:** Pricing Card - Discount badges

**Why We Ask:**
> Discounts help students save money and make your studio more accessible. Displaying available discounts helps students take advantage of savings.

**Instructions:**
> Select all discounts you offer.

**Options:**
- **Student Discount** - Discount for students (specify % or amount)
- **Senior Discount** - Discount for seniors (specify % or amount)
- **Military Discount** - Discount for military/veterans (specify % or amount)
- **First Responder Discount** - Discount for first responders
- **Corporate/Group Rates** - Discounts for groups or corporate bookings

**Additional Field:** For each selected discount, specify the discount amount or percentage.

**How It's Used:**
- Pricing Card - Discount badges
- Helps students find savings
- Makes studio more accessible

**Ninja Forms Field Settings:**
- Field Label: "Discounts Available"
- Field Key: `discounts`
- Required: No
- Field Type: Checkboxes
- Options:
  - `student` - "Student Discount"
  - `senior` - "Senior Discount"
  - `military` - "Military Discount"
  - `first_responder` - "First Responder Discount"
  - `corporate_group` - "Corporate/Group Rates"
- For each selected, show discount amount field
- **Action:** Map to GeoDirectory custom field `ynm_discounts` (store as array)

---

### Q3.7: Gift Cards Available
**Question Text:** "Do you offer gift cards?"

**Field Type:** Select (Yes/No) + URL (Purchase Link)  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_gift_cards` (boolean), `ynm_gift_card_url` (URL)  
**Display Location:** Pricing Card - Gift card info

**Why We Ask:**
> Gift cards are popular gifts and help attract new students. Displaying gift card availability encourages purchases.

**Instructions:**
> Do you offer gift cards?

**If Yes:**
- Can they be purchased online? (Yes/No)
- Purchase URL (if available online)

**How It's Used:**
- Pricing Card - Gift card badge/link
- Encourages gift card purchases
- Attracts new students

**Ninja Forms Field Settings:**
- Field Label: "Gift Cards Available"
- Field Key: `gift_cards`
- Required: No
- Field Type: Select (Yes/No)
- Conditional Field: If "Yes", show:
  - `online_purchase` (Yes/No) - "Can be purchased online?"
  - `purchase_url` (URL) - "Purchase URL"
- **Action:** Map to GeoDirectory custom fields `ynm_gift_cards`, `ynm_gift_card_url`

---

## Section 4: Logistics & Amenities
**Purpose:** These "know before you go" details reduce friction and help students prepare for their visit. They answer practical questions that prevent surprises.

**Displays On:** Logistics Card + Amenities Grid

**Why This Section Matters:**
> These details remove barriers to entry. Students want to know what to bring, what's available, and what to expect. This information prevents awkward situations and helps students feel prepared.

---

### Q4.1: Mat Rental *
**Question Text:** "Do you provide yoga mats for students?"

**Field Type:** Select (Single Choice)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_mat_rental`  
**Display Location:** Logistics Card - Mat rental info

**Why We Ask:**
> Students need to know if they should bring a mat or if one is available. This is one of the most common questions and prevents students from showing up unprepared.

**Instructions:**
> Do you provide yoga mats for students?

**Options:**
- **Free** - Mats provided at no charge
- **Rental Fee** - Mats available for rent (specify price: $___)
- **Not Available** - Students must bring their own mats

**If Rental Fee:** Enter the rental price (e.g., "3" for $3)

**How It's Used:**
- Logistics Card - Mat rental info with icon
- Helps students prepare
- Prevents surprises

**Ninja Forms Field Settings:**
- Field Label: "Mat Rental"
- Field Key: `mat_rental`
- Required: Yes
- Field Type: Select
- Options:
  - `free` - "Free"
  - `rental_fee` - "Rental Fee"
  - `not_available` - "Not Available"
- Conditional Field: If "rental_fee", show price field
- **Action:** Map to GeoDirectory custom field `ynm_mat_rental` (+ `ynm_mat_rental_price` if rental)

---

### Q4.2: Props Available *
**Question Text:** "Which props are available for student use?"

**Field Type:** Checkboxes (Multiple Choice)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_props_available` (stored as array)  
**Display Location:** Amenities Grid - Props icons

**Why We Ask:**
> Props are essential for many yoga styles and modifications. Students want to know what's available so they can plan their practice and know what to bring if needed.

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

**How It's Used:**
- Amenities Grid - Props icons
- Helps students know what's available
- Important for Iyengar, restorative, and modified practices

**Ninja Forms Field Settings:**
- Field Label: "Props Available"
- Field Key: `props_available`
- Required: Yes
- Field Type: Checkboxes
- Options:
  - `blocks` - "Blocks"
  - `straps` - "Straps"
  - `bolsters` - "Bolsters"
  - `blankets` - "Blankets"
  - `eye_pillows` - "Eye Pillows"
  - `chairs` - "Chairs"
  - `all_free` - "All Props Free"
  - `props_rental` - "Props for Rent"
- **Action:** Map to GeoDirectory custom field `ynm_props_available` (store as serialized array)

---

### Q4.3: Water Station *
**Question Text:** "Do you have a water station or water available?"

**Field Type:** Select (Single Choice)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_water_station`  
**Display Location:** Logistics Card - Water info

**Why We Ask:**
> Students need to stay hydrated, especially during hot yoga. Knowing water availability helps students prepare and prevents dehydration.

**Instructions:**
> Do you have a water station or water available?

**Options:**
- **Filtered Water Station** - Filtered water dispenser
- **Water Fountain** - Standard water fountain
- **Bottled Water for Sale** - Bottled water available for purchase
- **No Water Available** - Students should bring their own

**How It's Used:**
- Logistics Card - Water info with icon
- Helps students prepare
- Important for hot yoga classes

**Ninja Forms Field Settings:**
- Field Label: "Water Station"
- Field Key: `water_station`
- Required: Yes
- Field Type: Select
- Options:
  - `filtered_station` - "Filtered Water Station"
  - `water_fountain` - "Water Fountain"
  - `bottled_for_sale` - "Bottled Water for Sale"
  - `not_available` - "No Water Available"
- **Action:** Map to GeoDirectory custom field `ynm_water_station`

---

### Q4.4: Showers *
**Question Text:** "Do you have shower facilities?"

**Field Type:** Select (Single Choice)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_showers`  
**Display Location:** Logistics Card - Shower info

**Why We Ask:**
> **Critical for morning/lunch crowds!** Students who practice before work or during lunch breaks need to know if they can shower. This information can be the deciding factor for many students.

**Instructions:**
> Do you have shower facilities?

**Options:**
- **Yes, Showers Available** - Shower facilities available
- **No Showers** - No shower facilities
- **Showers Nearby** - Showers available in building (not in studio)

**If "Showers Nearby":** Provide details (e.g., "Showers in building lobby, 2nd floor")

**How It's Used:**
- Logistics Card - Shower info with icon
- Critical for morning/lunch classes
- Deciding factor for many students

**Ninja Forms Field Settings:**
- Field Label: "Showers"
- Field Key: `showers`
- Required: Yes
- Field Type: Select
- Options:
  - `yes_available` - "Yes, Showers Available"
  - `no_showers` - "No Showers"
  - `nearby` - "Showers Nearby"
- Conditional Field: If "nearby", show details field
- **Action:** Map to GeoDirectory custom field `ynm_showers` (+ `ynm_showers_details` if nearby)

---

### Q4.5: Lockers/Storage *
**Question Text:** "What storage options do you provide for students' belongings?"

**Field Type:** Select (Single Choice)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_lockers`  
**Display Location:** Logistics Card - Storage info

**Why We Ask:**
> Students need to know where to store their belongings safely. This helps them prepare and feel secure about their valuables.

**Instructions:**
> What storage options do you provide for students' belongings?

**Options:**
- **Lockers with Keys** - Lockers available, keys provided
- **Lockers with Codes** - Lockers available, combination codes
- **Cubbies in Room** - Open cubbies in practice room
- **Coat Rack Only** - Basic coat rack, no secure storage
- **No Storage** - No storage available

**How It's Used:**
- Logistics Card - Storage info with icon
- Helps students prepare
- Security information

**Ninja Forms Field Settings:**
- Field Label: "Lockers/Storage"
- Field Key: `lockers`
- Required: Yes
- Field Type: Select
- Options:
  - `lockers_keys` - "Lockers with Keys"
  - `lockers_codes` - "Lockers with Codes"
  - `cubbies` - "Cubbies in Room"
  - `coat_rack` - "Coat Rack Only"
  - `no_storage` - "No Storage"
- **Action:** Map to GeoDirectory custom field `ynm_lockers`

---

### Q4.6: Mirrors *
**Question Text:** "Does your studio have mirrors?"

**Field Type:** Select (Single Choice)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_mirrors`  
**Display Location:** Logistics Card - Mirror info

**Why We Ask:**
> **Important for body image concerns!** Some students specifically seek mirror-free studios to avoid body image triggers. This information helps students choose studios that support their mental health and body positivity.

**Instructions:**
> Does your studio have mirrors?

**Options:**
- **Mirrored Walls** - Full wall mirrors
- **Partial Mirrors** - Some mirrors
- **No Mirrors** - Mirror-free studio

**How It's Used:**
- Logistics Card - Mirror info with icon
- Filter option ("Show me mirror-free studios")
- Important for body-positive practice
- Mental health consideration

**Ninja Forms Field Settings:**
- Field Label: "Mirrors"
- Field Key: `mirrors`
- Required: Yes
- Field Type: Select
- Options:
  - `mirrored_walls` - "Mirrored Walls"
  - `partial_mirrors` - "Partial Mirrors"
  - `no_mirrors` - "No Mirrors"
- **Action:** Map to GeoDirectory custom field `ynm_mirrors`

---

### Q4.7: Arrival Policy *
**Question Text:** "What is your arrival and late entry policy?"

**Field Type:** Textarea  
**Required:** Yes  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_arrival_policy`  
**Display Location:** Logistics Card - Arrival policy

**Why We Ask:**
> **Crucial information!** Late entry policies vary widely. Some studios have "hard lock" policies (doors lock X minutes before class), while others allow late entry. Students need to know this to avoid wasted trips and understand expectations.

**Instructions:**
> Describe your arrival/late entry policy. Be specific about timing and consequences.

**Key Points to Include:**
- Is there a "hard lock" policy? (Doors lock X minutes before class - no late entry)
- How early should students arrive?
- What happens if students arrive late?
- Check-in process

**Example:**
> "Doors lock 5 minutes before class starts. No late entry allowed. Please arrive at least 10 minutes early to check in and set up your mat. If you arrive late, you'll need to wait for the next class."

**How It's Used:**
- Logistics Card - Arrival policy section
- Prevents wasted trips
- Sets clear expectations
- Important for planning

**Ninja Forms Field Settings:**
- Field Label: "Arrival Policy"
- Field Key: `arrival_policy`
- Required: Yes
- Field Type: Textarea
- Character Limit: 500 characters
- Placeholder: "Describe your arrival and late entry policy..."
- **Action:** Map to GeoDirectory custom field `ynm_arrival_policy`

---

### Q4.8: Parking *
**Question Text:** "What parking options are available?"

**Field Type:** Select (Single Choice) + Textarea (Details)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_parking` (option) + `ynm_parking_details` (details)  
**Display Location:** Logistics Card - Parking info

**Why We Ask:**
> Parking can be a major barrier to entry, especially in urban areas. Students need to know parking options, costs, and availability to plan their visit.

**Instructions:**
> What parking options are available?

**Options:**
- **Dedicated Lot** - Studio has its own parking lot
- **Street Parking** - Street parking available
- **Parking Validation** - Parking validation available (specify location)
- **Paid Parking Garage** - Nearby paid parking garage
- **No Parking** - No parking available, public transit recommended

**Additional Field:** Provide specific details (e.g., "Free parking in rear lot", "Metered street parking, $2/hour", "Parking validation at front desk for garage across street")

**How It's Used:**
- Logistics Card - Parking info with icon
- Helps students plan visit
- Reduces parking-related stress
- Important for urban studios

**Ninja Forms Field Settings:**
- Field Label: "Parking"
- Field Key: `parking`
- Required: Yes
- Field Type: Select + Textarea
- Options:
  - `dedicated_lot` - "Dedicated Lot"
  - `street_parking` - "Street Parking"
  - `parking_validation` - "Parking Validation"
  - `paid_garage` - "Paid Parking Garage"
  - `no_parking` - "No Parking"
- Always show details textarea
- **Action:** Map to GeoDirectory custom fields `ynm_parking`, `ynm_parking_details`

---

### Q4.9: Additional Amenities
**Question Text:** "What other amenities does your studio offer?"

**Field Type:** Checkboxes (Multiple Choice)  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_amenities` (stored as array)  
**Display Location:** Amenities Grid - Icons

**Why We Ask:**
> Additional amenities enhance the student experience and can be deciding factors. Displaying these helps students understand the full value of your studio.

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

**How It's Used:**
- Amenities Grid - Icons for each amenity
- Value proposition
- Differentiator
- Helps students choose

**Ninja Forms Field Settings:**
- Field Label: "Additional Amenities"
- Field Key: `amenities`
- Required: No
- Field Type: Checkboxes
- Options:
  - `retail_shop` - "Retail Shop"
  - `cafe_juice_bar` - "Cafe/Juice Bar"
  - `changing_rooms` - "Changing Rooms"
  - `bathrooms` - "Bathrooms"
  - `wifi` - "WiFi"
  - `charging_stations` - "Charging Stations"
  - `outdoor_space` - "Outdoor Space"
  - `multiple_studios` - "Multiple Studios"
  - `workshop_space` - "Workshop Space"
  - `teacher_training_space` - "Teacher Training Space"
- **Action:** Map to GeoDirectory custom field `ynm_amenities` (store as serialized array)

---

## Section 5: Schedule & Booking
**Purpose:** Booking information reduces friction and helps students know how to reserve classes. This section covers booking platforms, policies, and schedules.

**Displays On:** Schedule Card + Booking Info

---

### Q5.1: Booking Platform *
**Question Text:** "Which booking platform do you use?"

**Field Type:** Select (Single Choice) + URL (Booking Link)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_booking_platform` (platform name) + `ynm_booking_url` (URL)  
**Display Location:** Hero Section - "Book a Class" button, Schedule Card

**Why We Ask:**
> **Critical for reducing friction!** Students need to know which app/platform to use. This information is used for the "Book a Class" button and helps students know what to download or where to go.

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

**How It's Used:**
- "Book a Class" button link (if URL provided)
- Schedule Card - Booking platform badge
- Helps students know what app to use
- Reduces booking friction

**Ninja Forms Field Settings:**
- Field Label: "Booking Platform"
- Field Key: `booking_platform`
- Required: Yes
- Field Type: Select + URL
- Options:
  - `mindbody` - "Mindbody"
  - `classpass` - "ClassPass"
  - `momoyoga` - "Momoyoga"
  - `glofox` - "Glofox"
  - `acuity` - "Acuity Scheduling"
  - `wix` - "Wix Bookings"
  - `own_website` - "Our Own Website"
  - `phone_only` - "Phone Only"
  - `walk_in_only` - "Walk-in Only"
  - `other` - "Other"
- Conditional Field: If not "phone_only" or "walk_in_only", show booking URL field
- **Action:** Map to GeoDirectory custom fields `ynm_booking_platform`, `ynm_booking_url`

---

### Q5.2: Pre-Registration Required
**Question Text:** "Do students need to book in advance, or can they drop in?"

**Field Type:** Select (Yes/No/Depends)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_preregistration_required`  
**Display Location:** Schedule Card - Booking info

**Why We Ask:**
> Students need to know if they can drop in or must book ahead. This affects their planning and prevents disappointment.

**Instructions:**
> Can students drop in without advance booking?

**Options:**
- **Yes, Required** - All classes require advance booking
- **No, Walk-ins Welcome** - Students can drop in anytime
- **Depends on Class** - Some classes require booking, others allow walk-ins

**How It's Used:**
- Schedule Card - Booking requirement badge
- Helps students plan
- Sets expectations

**Ninja Forms Field Settings:**
- Field Label: "Pre-Registration Required"
- Field Key: `preregistration_required`
- Required: Yes
- Field Type: Select
- Options:
  - `yes_required` - "Yes, Required"
  - `no_walkins` - "No, Walk-ins Welcome"
  - `depends` - "Depends on Class"
- **Action:** Map to GeoDirectory custom field `ynm_preregistration_required`

---

### Q5.3: Cancellation Policy *
**Question Text:** "What is your cancellation policy?"

**Field Type:** Textarea  
**Required:** Yes  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_cancellation_policy`  
**Display Location:** Schedule Card - Policy info

**Why We Ask:**
> Cancellation policies vary widely and affect student decisions. Clear policies prevent confusion and disputes. Students need to know timing requirements and fees.

**Instructions:**
> Describe your cancellation policy. Be specific about timing and fees.

**Key Points to Include:**
- How far in advance must students cancel?
- Are there cancellation fees?
- What happens to class credits if cancelled?
- Refund policy

**Example:**
> "Cancellations must be made at least 2 hours before class start time. Late cancellations or no-shows will result in loss of class credit. Unlimited members will be charged a $10 late cancellation fee."

**How It's Used:**
- Schedule Card - Cancellation policy section
- Sets clear expectations
- Prevents disputes
- Important for planning

**Ninja Forms Field Settings:**
- Field Label: "Cancellation Policy"
- Field Key: `cancellation_policy`
- Required: Yes
- Field Type: Textarea
- Character Limit: 500 characters
- Placeholder: "Describe your cancellation policy..."
- **Action:** Map to GeoDirectory custom field `ynm_cancellation_policy`

---

### Q5.4: Waitlist Policy
**Question Text:** "How does your waitlist work?"

**Field Type:** Textarea  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_waitlist_policy`  
**Display Location:** Schedule Card - Waitlist info

**Why We Ask:**
> Waitlist policies help students understand how to get into full classes. Clear policies reduce confusion and help students plan.

**Instructions:**
> How does your waitlist work?

**Key Points to Include:**
- How do students join the waitlist?
- When are waitlisted students notified?
- What happens if a spot opens up?
- Auto-booking vs. manual confirmation

**Example:**
> "If a class is full, you can join the waitlist. You'll be automatically added if a spot opens up. You'll receive an email/text notification. Please cancel if you can't make it."

**How It's Used:**
- Schedule Card - Waitlist info
- Helps students get into full classes
- Reduces confusion

**Ninja Forms Field Settings:**
- Field Label: "Waitlist Policy"
- Field Key: `waitlist_policy`
- Required: No
- Field Type: Textarea
- Character Limit: 500 characters
- **Action:** Map to GeoDirectory custom field `ynm_waitlist_policy`

---

### Q5.5: Business Hours *
**Question Text:** "What are your studio's business hours?"

**Field Type:** Business Hours Field (GeoDirectory built-in)  
**Required:** Yes  
**GeoDirectory Field:** `business_hours` (GeoDirectory built-in)  
**Meta Key:** `geodir_business_hours`  
**Display Location:** Right Column - Business Hours widget, Schema.org openingHours

**Why We Ask:**
> Business hours are essential for students to know when your studio is open. This data is also used in schema.org markup for Google search results (rich snippets showing hours).

**Instructions:**
> Set your studio's business hours. This includes both class times and when your studio is open for other activities.

**Format:** Use GeoDirectory's business hours picker to set:
- Days of the week
- Opening and closing times
- Special hours (holidays, etc.)

**Note:** This data automatically populates your schema.org markup for Google search results.

**How It's Used:**
- Business Hours widget display
- Schema.org `openingHours` property
- Google rich snippets
- Student planning

**Ninja Forms Field Settings:**
- Field Label: "Business Hours"
- Field Key: `business_hours`
- Required: Yes
- Field Type: Business Hours (use GeoDirectory field type)
- **Action:** Map to GeoDirectory field `business_hours`

---

### Q5.6: Peak Hours
**Question Text:** "When is your studio typically busiest?"

**Field Type:** Textarea  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_peak_hours`  
**Display Location:** Schedule Card - Peak hours info

**Why We Ask:**
> Peak hours information helps students plan their visits. Students who prefer less crowded classes can avoid peak times, while those who enjoy energy can seek them out.

**Instructions:**
> When is your studio typically busiest? This helps students plan their visits.

**Example:**
> "Peak hours: Weekday mornings (6-9am) and evenings (5-8pm). Weekend mornings (8-11am) are also busy. Midday classes are typically less crowded."

**How It's Used:**
- Schedule Card - Peak hours section
- Helps students plan
- Reduces surprises

**Ninja Forms Field Settings:**
- Field Label: "Peak Hours"
- Field Key: `peak_hours`
- Required: No
- Field Type: Textarea
- Character Limit: 300 characters
- **Action:** Map to GeoDirectory custom field `ynm_peak_hours`

---

## Section 6: Inclusivity & Accessibility
**Purpose:** Modern directories must highlight spaces that are safe and accessible for everyone. This section collects inclusivity and accessibility information.

**Displays On:** Inclusivity Badges (Prominent section)

**Why This Section Matters:**
> Inclusivity and accessibility are not optional - they're essential. Students need to know if your studio is safe and accessible for them. This information helps students find studios where they feel welcome and can practice safely.

---

### Q6.1: Physical Accessibility *
**Question Text:** "Is your studio physically accessible?"

**Field Type:** Checkboxes (Multiple Choice)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_accessibility_features` (stored as array)  
**Display Location:** Inclusivity Badges - Accessibility icons

**Why We Ask:**
> Physical accessibility is essential for students with mobility needs. This information helps students with disabilities find accessible studios and prevents difficult situations.

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

**How It's Used:**
- Inclusivity Badges - Accessibility icons
- Filter option ("Show me accessible studios")
- Helps students with disabilities
- Legal compliance information

**Ninja Forms Field Settings:**
- Field Label: "Physical Accessibility"
- Field Key: `accessibility_features`
- Required: Yes
- Field Type: Checkboxes
- Options:
  - `wheelchair_accessible` - "Wheelchair Accessible"
  - `elevator` - "Elevator Available"
  - `accessible_restrooms` - "Accessible Restrooms"
  - `step_free` - "Step-Free to Practice Room"
  - `accessible_parking` - "Accessible Parking"
  - `not_fully_accessible` - "Not Fully Accessible"
- Conditional Field: If "not_fully_accessible", show barriers description field
- **Action:** Map to GeoDirectory custom field `ynm_accessibility_features` (store as array)

---

### Q6.2: Gender-Neutral Facilities
**Question Text:** "Do you have gender-neutral restrooms or changing areas?"

**Field Type:** Select (Yes/No)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_gender_neutral_facilities`  
**Display Location:** Inclusivity Badges - Gender-neutral badge

**Why We Ask:**
> Gender-neutral facilities are important for transgender and non-binary students. This information helps create safe, welcoming spaces for all students.

**Instructions:**
> Do you have gender-neutral restrooms or changing areas?

**Options:**
- **Yes** - Gender-neutral facilities available
- **No** - Traditional gendered facilities only
- **Single-Occupancy** - Single-occupancy restrooms available

**How It's Used:**
- Inclusivity Badges - Gender-neutral badge
- Filter option ("Show me gender-neutral studios")
- Important for LGBTQ+ students
- Creates welcoming environment

**Ninja Forms Field Settings:**
- Field Label: "Gender-Neutral Facilities"
- Field Key: `gender_neutral_facilities`
- Required: Yes
- Field Type: Select
- Options:
  - `yes` - "Yes"
  - `no` - "No"
  - `single_occupancy` - "Single-Occupancy"
- **Action:** Map to GeoDirectory custom field `ynm_gender_neutral_facilities`

---

### Q6.3: Body Inclusivity
**Question Text:** "Is your studio committed to body inclusivity and Health At Every Size (HAES) principles?"

**Field Type:** Select (Yes/No) + Textarea (Details)  
**Required:** No (but recommended)  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_body_inclusive` (boolean) + `ynm_body_inclusive_details` (text)  
**Display Location:** Inclusivity Badges - Body-positive badge

**Why We Ask:**
> Body inclusivity is essential for creating safe spaces for all bodies. Students in larger bodies need to know if your studio is welcoming and has appropriate props and support.

**Instructions:**
> Is your studio committed to body inclusivity and Health At Every Size (HAES) principles?

**Options:**
- **Yes** - We are HAES-aligned and body-positive
- **No** - Not specifically aligned
- **Working Toward** - We're learning and improving

**If Yes:** Describe your commitment (e.g., "We welcome all bodies, avoid weight-loss language, and provide props for all body sizes")

**How It's Used:**
- Inclusivity Badges - Body-positive badge
- Filter option ("Show me body-positive studios")
- Important for students in larger bodies
- Creates welcoming environment

**Ninja Forms Field Settings:**
- Field Label: "Body Inclusivity"
- Field Key: `body_inclusive`
- Required: No
- Field Type: Select + Textarea
- Options:
  - `yes` - "Yes"
  - `no` - "No"
  - `working_toward` - "Working Toward"
- Conditional Field: If "yes" or "working_toward", show details field
- **Action:** Map to GeoDirectory custom fields `ynm_body_inclusive`, `ynm_body_inclusive_details`

---

### Q6.4: BIPOC Safe Space
**Question Text:** "Do you explicitly welcome and create safe space for BIPOC (Black, Indigenous, People of Color) students?"

**Field Type:** Select (Yes/No)  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_bipoc_safe_space`  
**Display Location:** Inclusivity Badges - BIPOC safe space badge

**Why We Ask:**
> BIPOC students need to know if your studio is explicitly welcoming and safe. This badge indicates your commitment to racial equity and inclusion.

**Instructions:**
> Do you explicitly welcome and create safe space for BIPOC students?

**Options:**
- **Yes** - We are committed to BIPOC inclusion
- **No** - Not specifically stated

**If Yes:** Consider adding a statement about your commitment (optional).

**How It's Used:**
- Inclusivity Badges - BIPOC safe space badge
- Filter option ("Show me BIPOC-friendly studios")
- Important for BIPOC students
- Indicates commitment to racial equity

**Ninja Forms Field Settings:**
- Field Label: "BIPOC Safe Space"
- Field Key: `bipoc_safe_space`
- Required: No
- Field Type: Select (Yes/No)
- **Action:** Map to GeoDirectory custom field `ynm_bipoc_safe_space`

---

### Q6.5: LGBTQ+ Safe Space
**Question Text:** "Do you explicitly welcome and create safe space for LGBTQ+ students?"

**Field Type:** Select (Yes/No)  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_lgbtq_safe_space`  
**Display Location:** Inclusivity Badges - LGBTQ+ safe space badge

**Why We Ask:**
> LGBTQ+ students need to know if your studio is explicitly welcoming and safe. This badge indicates your commitment to LGBTQ+ inclusion.

**Instructions:**
> Do you explicitly welcome and create safe space for LGBTQ+ students?

**Options:**
- **Yes** - We are committed to LGBTQ+ inclusion
- **No** - Not specifically stated

**How It's Used:**
- Inclusivity Badges - LGBTQ+ safe space badge
- Filter option ("Show me LGBTQ+ friendly studios")
- Important for LGBTQ+ students
- Creates welcoming environment

**Ninja Forms Field Settings:**
- Field Label: "LGBTQ+ Safe Space"
- Field Key: `lgbtq_safe_space`
- Required: No
- Field Type: Select (Yes/No)
- **Action:** Map to GeoDirectory custom field `ynm_lgbtq_safe_space`

---

### Q6.6: Trauma-Informed Practice
**Question Text:** "Do you offer trauma-informed yoga classes or have trauma-informed certified teachers?"

**Field Type:** Select (Yes/No)  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_trauma_informed`  
**Display Location:** Inclusivity Badges - Trauma-informed badge

**Why We Ask:**
> Trauma-informed yoga is essential for students who have experienced trauma. This information helps students find appropriate classes and teachers.

**Instructions:**
> Do you offer trauma-informed yoga classes or have trauma-informed certified teachers?

**Options:**
- **Yes** - We offer trauma-informed classes/teachers
- **No** - Not currently offered

**How It's Used:**
- Inclusivity Badges - Trauma-informed badge
- Filter option ("Show me trauma-informed studios")
- Important for trauma survivors
- Safety and healing support

**Ninja Forms Field Settings:**
- Field Label: "Trauma-Informed Practice"
- Field Key: `trauma_informed`
- Required: No
- Field Type: Select (Yes/No)
- **Action:** Map to GeoDirectory custom field `ynm_trauma_informed`

---

## Section 7: Class Experience Details
**Purpose:** These questions help students understand what to expect in classes - size, duration, teacher consistency, etc.

**Displays On:** Class Details Section

---

### Q7.1: Yoga Styles Offered *
**Question Text:** "Which yoga styles do you offer?"

**Field Type:** Checkboxes (Multiple Choice) - Standardized List  
**Required:** Yes  
**GeoDirectory Field:** Categories (`gd_placecategory` taxonomy)  
**Meta Key:** N/A (uses WordPress taxonomy)  
**Display Location:** Left Column - Categories widget, Meta Bar - Style tags, Filter options

**Why We Ask:**
> Yoga styles are the primary way students search for studios. Using standardized terms ensures students can filter and find exactly what they're looking for.

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

**How It's Used:**
- Categories widget display
- Meta Bar - Style tags
- Filter options on directory
- Schema.org `keywords` property
- Search optimization

**Ninja Forms Field Settings:**
- Field Label: "Yoga Styles Offered"
- Field Key: `yoga_styles`
- Required: Yes
- Field Type: Checkboxes
- Options: (Use standardized list above)
- **Action:** Map to GeoDirectory categories (`gd_placecategory` taxonomy)

---

### Q7.2: Average Class Size
**Question Text:** "What's the average number of students per class?"

**Field Type:** Select (Single Choice)  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_class_size`  
**Display Location:** Class Details Section

**Why We Ask:**
> Class size affects the student experience. Some students prefer intimate classes with personal attention, while others enjoy the energy of larger groups.

**Instructions:**
> What's the average number of students per class?

**Options:**
- **Intimate (5-10 students)** - Small, personal classes
- **Small (10-20 students)** - Small group classes
- **Medium (20-35 students)** - Standard class size
- **Large (35-50 students)** - Large classes
- **Very Large (50+ students)** - High-capacity classes
- **Varies** - Depends on class/time

**How It's Used:**
- Class Details Section
- Helps students choose preferred class size
- Sets expectations

**Ninja Forms Field Settings:**
- Field Label: "Average Class Size"
- Field Key: `class_size`
- Required: No
- Field Type: Select
- Options:
  - `intimate` - "Intimate (5-10 students)"
  - `small` - "Small (10-20 students)"
  - `medium` - "Medium (20-35 students)"
  - `large` - "Large (35-50 students)"
  - `very_large` - "Very Large (50+ students)"
  - `varies` - "Varies"
- **Action:** Map to GeoDirectory custom field `ynm_class_size`

---

### Q7.3: Standard Class Duration *
**Question Text:** "What are your standard class durations?"

**Field Type:** Checkboxes (Multiple Choice)  
**Required:** Yes  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_class_duration` (stored as array)  
**Display Location:** Schedule Card - Duration info

**Why We Ask:**
> Class duration affects scheduling and student planning. Students need to know how long classes are to fit them into their schedules.

**Instructions:**
> What are your standard class durations? Select all that apply.

**Options:**
- **30 minutes** - Short classes
- **45 minutes** - Mid-length classes
- **60 minutes** - Standard hour-long classes
- **75 minutes** - Extended classes
- **90 minutes** - Long classes
- **120 minutes** - Extended/workshop length

**How It's Used:**
- Schedule Card - Duration display
- Helps students plan
- Scheduling information

**Ninja Forms Field Settings:**
- Field Label: "Standard Class Duration"
- Field Key: `class_duration`
- Required: Yes
- Field Type: Checkboxes
- Options:
  - `30_min` - "30 minutes"
  - `45_min` - "45 minutes"
  - `60_min` - "60 minutes"
  - `75_min` - "75 minutes"
  - `90_min` - "90 minutes"
  - `120_min` - "120 minutes"
- **Action:** Map to GeoDirectory custom field `ynm_class_duration` (store as array)

---

### Q7.4: Teacher Consistency
**Question Text:** "How consistent are your teachers?"

**Field Type:** Select (Single Choice)  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_teacher_consistency`  
**Display Location:** Class Details Section

**Why We Ask:**
> Teacher consistency affects student experience. Some students prefer the same teacher weekly, while others enjoy variety.

**Instructions:**
> How consistent are your teachers?

**Options:**
- **Same Teachers Weekly** - Regular schedule, same teachers
- **Rotating Schedule** - Teachers rotate, but schedule is posted
- **Varied** - Teachers vary by class/time

**How It's Used:**
- Class Details Section
- Helps students choose preferred consistency
- Sets expectations

**Ninja Forms Field Settings:**
- Field Label: "Teacher Consistency"
- Field Key: `teacher_consistency`
- Required: No
- Field Type: Select
- Options:
  - `same_weekly` - "Same Teachers Weekly"
  - `rotating` - "Rotating Schedule"
  - `varied` - "Varied"
- **Action:** Map to GeoDirectory custom field `ynm_teacher_consistency`

---

### Q7.5: Teacher Qualifications
**Question Text:** "What's the typical qualification level of your teachers?"

**Field Type:** Select (Single Choice)  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_teacher_qualifications`  
**Display Location:** Class Details Section

**Why We Ask:**
> Teacher qualifications build trust and help students understand the quality of instruction. This information is important for students seeking experienced teachers.

**Instructions:**
> What's the typical qualification level of your teachers?

**Options:**
- **RYT-200 (Standard)** - 200-hour certified teachers
- **ERYT-500 (Experienced)** - 500-hour experienced teachers
- **Mixed Levels** - Various certification levels
- **Specialized Certifications** - Trauma-informed, yoga therapy, etc.

**How It's Used:**
- Class Details Section
- Builds credibility
- Helps students choose

**Ninja Forms Field Settings:**
- Field Label: "Teacher Qualifications"
- Field Key: `teacher_qualifications`
- Required: No
- Field Type: Select
- Options:
  - `ryt200` - "RYT-200 (Standard)"
  - `eryt500` - "ERYT-500 (Experienced)"
  - `mixed` - "Mixed Levels"
  - `specialized` - "Specialized Certifications"
- **Action:** Map to GeoDirectory custom field `ynm_teacher_qualifications`

---

### Q7.6: Best Class for Beginners
**Question Text:** "Which specific class would you recommend for absolute beginners?"

**Field Type:** Text (Single Line)  
**Required:** No (but highly recommended)  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_beginner_class`  
**Display Location:** Class Details Section - Prominent "Start Here" badge

**Why We Ask:**
> Beginners need guidance on where to start. Highlighting a specific beginner-friendly class reduces intimidation and encourages new students to try your studio.

**Instructions:**
> Which specific class would you recommend for absolute beginners? Include class name and day/time if possible.

**Example:** "Gentle Hatha - Tuesdays 6pm" or "Yoga Basics - Every Saturday 10am"

**How It's Used:**
- Class Details Section - "Start Here" badge
- Reduces intimidation
- Encourages beginners
- Conversion tool

**Ninja Forms Field Settings:**
- Field Label: "Best Class for Beginners"
- Field Key: `beginner_class`
- Required: No
- Field Type: Text
- Character Limit: 200 characters
- **Action:** Map to GeoDirectory custom field `ynm_beginner_class`

---

### Q7.7: Photo/Video Policy
**Question Text:** "What's your policy on students taking photos/videos?"

**Field Type:** Select (Single Choice)  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_photo_policy`  
**Display Location:** Class Details Section

**Why We Ask:**
> Photo/video policies affect student privacy and social media sharing. Some students want to share their practice, while others prefer privacy.

**Instructions:**
> What's your policy on students taking photos/videos?

**Options:**
- **Photos Allowed** - Students can take photos
- **Instagram-Friendly** - Photos encouraged, tag us!
- **No Photos During Class** - Photos allowed before/after, not during
- **No Photos** - No photography allowed

**How It's Used:**
- Class Details Section
- Privacy information
- Social media guidance

**Ninja Forms Field Settings:**
- Field Label: "Photo/Video Policy"
- Field Key: `photo_policy`
- Required: No
- Field Type: Select
- Options:
  - `allowed` - "Photos Allowed"
  - `instagram_friendly` - "Instagram-Friendly"
  - `not_during_class` - "No Photos During Class"
  - `not_allowed` - "No Photos"
- **Action:** Map to GeoDirectory custom field `ynm_photo_policy`

---

## Section 8: Community & Events
**Purpose:** Community and events show studio engagement and offer additional value beyond regular classes.

**Displays On:** Community Section (Below main content)

---

### Q8.1: Workshops Offered
**Question Text:** "Do you offer workshops beyond regular classes?"

**Field Type:** Select (Yes/No) + Textarea (Details)  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_workshops` (boolean) + `ynm_workshops_details` (text)  
**Display Location:** Community Section

**Why We Ask:**
> Workshops offer deeper learning and community building. Displaying workshop offerings shows additional value and engagement.

**Instructions:**
> Do you offer workshops beyond regular classes?

**If Yes:** Describe your workshop offerings:
- How often? (Monthly, quarterly, etc.)
- What topics? (e.g., "Arm balances", "Meditation", "Philosophy")
- Typical price range?

**How It's Used:**
- Community Section
- Shows additional value
- Encourages workshop attendance

**Ninja Forms Field Settings:**
- Field Label: "Workshops Offered"
- Field Key: `workshops`
- Required: No
- Field Type: Select (Yes/No) + Textarea
- Conditional Field: If "Yes", show details field
- **Action:** Map to GeoDirectory custom fields `ynm_workshops`, `ynm_workshops_details`

---

### Q8.2: Teacher Training Programs
**Question Text:** "Do you offer Yoga Teacher Training (YTT) programs?"

**Field Type:** Select (Yes/No) + Textarea (Details)  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_teacher_training` (boolean) + `ynm_teacher_training_details` (text)  
**Display Location:** Community Section

**Why We Ask:**
> Teacher training programs show studio credibility and offer additional revenue streams. This information helps aspiring teachers find your program.

**Instructions:**
> Do you offer Yoga Teacher Training (YTT) programs?

**If Yes:** Provide details:
- Program length (200-hour, 300-hour, etc.)
- Format (intensive, weekend, etc.)
- Next start date (if known)
- Website link for more info

**How It's Used:**
- Community Section
- Shows credibility
- Attracts teacher trainees

**Ninja Forms Field Settings:**
- Field Label: "Teacher Training Programs"
- Field Key: `teacher_training`
- Required: No
- Field Type: Select (Yes/No) + Textarea
- Conditional Field: If "Yes", show details field
- **Action:** Map to GeoDirectory custom fields `ynm_teacher_training`, `ynm_teacher_training_details`

---

### Q8.3: Retreats
**Question Text:** "Do you offer yoga retreats?"

**Field Type:** Select (Yes/No) + Textarea (Details)  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_retreats` (boolean) + `ynm_retreats_details` (text)  
**Display Location:** Community Section

**Why We Ask:**
> Retreats offer immersive experiences and community building. Displaying retreat offerings shows additional value and engagement.

**Instructions:**
> Do you offer yoga retreats?

**If Yes:** Describe:
- Local or international?
- How often?
- Typical duration?
- Website link for more info

**How It's Used:**
- Community Section
- Shows additional value
- Attracts retreat participants

**Ninja Forms Field Settings:**
- Field Label: "Retreats"
- Field Key: `retreats`
- Required: No
- Field Type: Select (Yes/No) + Textarea
- Conditional Field: If "Yes", show details field
- **Action:** Map to GeoDirectory custom fields `ynm_retreats`, `ynm_retreats_details`

---

### Q8.4: Community Events
**Question Text:** "Do you host community events beyond classes?"

**Field Type:** Select (Yes/No) + Textarea (Details)  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_community_events` (boolean) + `ynm_community_events_details` (text)  
**Display Location:** Community Section

**Why We Ask:**
> Community events build relationships and show studio engagement. Displaying events helps students connect with your community.

**Instructions:**
> Do you host community events beyond classes?

**If Yes:** Describe:
- What types? (Potlucks, social gatherings, etc.)
- How often?
- Examples of past events?

**How It's Used:**
- Community Section
- Shows community engagement
- Encourages participation

**Ninja Forms Field Settings:**
- Field Label: "Community Events"
- Field Key: `community_events`
- Required: No
- Field Type: Select (Yes/No) + Textarea
- Conditional Field: If "Yes", show details field
- **Action:** Map to GeoDirectory custom fields `ynm_community_events`, `ynm_community_events_details`

---

### Q8.5: Online/Virtual Classes
**Question Text:** "Do you offer online or virtual classes?"

**Field Type:** Select (Yes/No) + URL (Link)  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_virtual_classes` (boolean) + `ynm_virtual_classes_url` (URL)  
**Display Location:** Community Section - Virtual classes badge

**Why We Ask:**
> Virtual classes offer flexibility and accessibility. Displaying virtual options helps students who can't attend in-person classes.

**Instructions:**
> Do you offer online or virtual classes?

**Options:**
- **Live-Streamed Classes** - Real-time online classes
- **On-Demand Classes** - Pre-recorded classes
- **Hybrid** - Both live and on-demand
- **No Virtual Classes** - In-person only

**If Yes:** Provide link to virtual class platform or website.

**How It's Used:**
- Community Section - Virtual classes badge
- Shows flexibility
- Increases accessibility

**Ninja Forms Field Settings:**
- Field Label: "Online/Virtual Classes"
- Field Key: `virtual_classes`
- Required: No
- Field Type: Select + URL
- Options:
  - `live_streamed` - "Live-Streamed Classes"
  - `on_demand` - "On-Demand Classes"
  - `hybrid` - "Hybrid"
  - `none` - "No Virtual Classes"
- Conditional Field: If not "none", show URL field
- **Action:** Map to GeoDirectory custom fields `ynm_virtual_classes`, `ynm_virtual_classes_url`

---

## Section 9: Studio Background
**Purpose:** Studio background and credibility information builds trust and helps students understand your philosophy.

**Displays On:** About Section (Below main content)

---

### Q9.1: Years in Business
**Question Text:** "How many years has your studio been in business?"

**Field Type:** Number  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_years_in_business`  
**Display Location:** About Section - Credibility badge

**Why We Ask:**
> Years in business builds credibility and trust. Established studios have proven track records and experience.

**Instructions:**
> How many years has your studio been in business?

**Example:** "5" (will display as "Established 2019" or "5 years in business")

**How It's Used:**
- About Section - Credibility badge
- Builds trust
- Shows experience

**Ninja Forms Field Settings:**
- Field Label: "Years in Business"
- Field Key: `years_in_business`
- Required: No
- Field Type: Number
- Min: 0
- Max: 100
- **Action:** Map to GeoDirectory custom field `ynm_years_in_business`

---

### Q9.2: Yoga Alliance Registered
**Question Text:** "Is your studio registered with Yoga Alliance?"

**Field Type:** Select (Yes/No)  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_yoga_alliance`  
**Display Location:** About Section - Credibility badge

**Why We Ask:**
> Yoga Alliance registration shows commitment to standards and quality. This builds credibility for teacher training programs.

**Instructions:**
> Is your studio registered with Yoga Alliance?

**Options:**
- **Yes** - Registered Yoga School (RYS)
- **No** - Not registered

**How It's Used:**
- About Section - Credibility badge
- Builds trust
- Important for teacher training

**Ninja Forms Field Settings:**
- Field Label: "Yoga Alliance Registered"
- Field Key: `yoga_alliance`
- Required: No
- Field Type: Select (Yes/No)
- **Action:** Map to GeoDirectory custom field `ynm_yoga_alliance`

---

### Q9.3: Founder/Owner Philosophy
**Question Text:** "Share your studio's philosophy or founder's background."

**Field Type:** Textarea  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_founder_philosophy`  
**Display Location:** About Section

**Why We Ask:**
> Philosophy and founder background help students understand your approach and values. This creates connection and trust.

**Instructions:**
> Share your studio's philosophy or founder's background. This helps students understand your approach and values.

**Example:**
> "Founded in 2019 by Jane Smith, a 20-year yoga practitioner and ERYT-500 teacher. Our philosophy is rooted in making yoga accessible to all bodies and creating a welcoming, judgment-free community."

**How It's Used:**
- About Section
- Creates connection
- Builds trust
- Shows values

**Ninja Forms Field Settings:**
- Field Label: "Founder/Owner Philosophy"
- Field Key: `founder_philosophy`
- Required: No
- Field Type: Textarea
- Character Limit: 1000 characters
- **Action:** Map to GeoDirectory custom field `ynm_founder_philosophy`

---

### Q9.4: Awards/Recognition
**Question Text:** "Have you received any awards or recognition?"

**Field Type:** Textarea  
**Required:** No  
**GeoDirectory Field:** Custom Field  
**Meta Key:** `ynm_awards`  
**Display Location:** About Section - Awards badges

**Why We Ask:**
> Awards and recognition build credibility and trust. Displaying awards shows quality and community recognition.

**Instructions:**
> Have you received any awards or recognition? (e.g., "Best Yoga Studio 2023" from local magazine)

**Example:**
> "Best Yoga Studio - Chicago Reader 2023"
> "Top 10 Yoga Studios in Illinois - Yoga Journal 2022"

**How It's Used:**
- About Section - Awards badges
- Builds credibility
- Shows quality
- Community recognition

**Ninja Forms Field Settings:**
- Field Label: "Awards/Recognition"
- Field Key: `awards`
- Required: No
- Field Type: Textarea
- Character Limit: 500 characters
- **Action:** Map to GeoDirectory custom field `ynm_awards`

---

## 📝 Complete Metadata Mapping Summary

### Standard GeoDirectory Fields
These fields are built into GeoDirectory and don't need custom field creation:

| Form Question | GeoDirectory Meta Key | Storage Type | Display Widget |
|---------------|----------------------|--------------|----------------|
| Q1.1 Studio Name | `post_title` (WordPress core) | Post Title | GD Post Title Widget |
| Q1.2 Street Address | `geodir_street` | Text | GD Post Address Widget |
| Q1.3 City | `geodir_city` | Text | GD Post Address Widget |
| Q1.4 State/Province | `geodir_region` | Text | GD Post Address Widget |
| Q1.5 ZIP Code | `geodir_zip` | Text | GD Post Address Widget |
| Q1.6 Country | `geodir_country` | Text | GD Post Address Widget |
| Q1.7 Phone | `geodir_phone` | Text | GD Contact Info Widget |
| Q1.8 Email | `geodir_email` | Email | GD Contact Info Widget |
| Q1.9 Website | `geodir_website` | URL | GD Contact Info Widget + Button Link |
| Q1.10 Description | `geodir_post_desc` | Textarea | GD Post Description Widget |
| Q1.11 Featured Image | `_thumbnail_id` (WordPress core) | Attachment ID | GD Post Images Widget |
| Q1.12 Gallery Images | `geodir_images` | Array | GD Post Images Widget (Gallery) |
| Q5.5 Business Hours | `geodir_business_hours` | JSON/Serialized | GD Business Hours Widget |
| Q7.1 Yoga Styles | `gd_placecategory` (taxonomy) | Taxonomy Terms | GD Categories Widget |

### Custom Fields (Need to Create in GeoDirectory)
These fields need to be created as custom fields in GeoDirectory with the `ynm_` prefix:

| Form Question | Custom Field Key | Field Type | Storage Type | Display Widget |
|---------------|-----------------|------------|--------------|----------------|
| **Section 2: Vibe & Culture** |
| Q2.1 Spirituality Meter | `ynm_spirituality_meter` | Select | Text | Custom Field Widget |
| Q2.2 Heat Policy | `ynm_heat_policy` | Select | Text | Custom Field Widget |
| Q2.2 Heat Temperature | `ynm_heat_temperature` | Number | Number | Custom Field Widget |
| Q2.3 Music Type | `ynm_music_type` | Checkboxes | Serialized Array | Custom Field Widget |
| Q2.4 Scent Policy | `ynm_scent_policy` | Select | Text | Custom Field Widget |
| Q2.5 Lighting Style | `ynm_lighting_style` | Select | Text | Custom Field Widget |
| Q2.6 Adjustment Policy | `ynm_adjustment_policy` | Select | Text | Custom Field Widget |
| **Section 3: Pricing** |
| Q3.1 Drop-in Rate | `ynm_drop_in_rate` | Number | Number | Custom Field Widget |
| Q3.2 Class Packages | `ynm_class_packages` | Repeater | JSON Array | Custom Field Widget |
| Q3.3 Memberships | `ynm_memberships` | Repeater | JSON Array | Custom Field Widget |
| Q3.4 Intro Offer | `ynm_intro_offer` | Text | Text | Custom Field Widget |
| Q3.4 Intro Price | `ynm_intro_price` | Number | Number | Custom Field Widget |
| Q3.4 Intro Valid For | `ynm_intro_valid_for` | Text | Text | Custom Field Widget |
| Q3.5 ClassPass Available | `ynm_classpass_available` | Checkbox | Boolean | Custom Field Widget |
| Q3.5 ClassPass Tier | `ynm_classpass_tier` | Select | Text | Custom Field Widget |
| Q3.6 Discounts | `ynm_discounts` | Checkboxes | Serialized Array | Custom Field Widget |
| Q3.7 Gift Cards | `ynm_gift_cards` | Checkbox | Boolean | Custom Field Widget |
| Q3.7 Gift Card URL | `ynm_gift_card_url` | URL | URL | Custom Field Widget |
| **Section 4: Logistics** |
| Q4.1 Mat Rental | `ynm_mat_rental` | Select | Text | Custom Field Widget |
| Q4.1 Mat Rental Price | `ynm_mat_rental_price` | Number | Number | Custom Field Widget |
| Q4.2 Props Available | `ynm_props_available` | Checkboxes | Serialized Array | GD Amenities Widget |
| Q4.3 Water Station | `ynm_water_station` | Select | Text | Custom Field Widget |
| Q4.4 Showers | `ynm_showers` | Select | Text | Custom Field Widget |
| Q4.4 Showers Details | `ynm_showers_details` | Text | Text | Custom Field Widget |
| Q4.5 Lockers | `ynm_lockers` | Select | Text | Custom Field Widget |
| Q4.6 Mirrors | `ynm_mirrors` | Select | Text | Custom Field Widget |
| Q4.7 Arrival Policy | `ynm_arrival_policy` | Textarea | Text | Custom Field Widget |
| Q4.8 Parking | `ynm_parking` | Select | Text | Custom Field Widget |
| Q4.8 Parking Details | `ynm_parking_details` | Textarea | Text | Custom Field Widget |
| Q4.9 Amenities | `ynm_amenities` | Checkboxes | Serialized Array | GD Amenities Widget |
| **Section 5: Schedule & Booking** |
| Q5.1 Booking Platform | `ynm_booking_platform` | Select | Text | Custom Field Widget |
| Q5.1 Booking URL | `ynm_booking_url` | URL | URL | Button Link |
| Q5.2 Pre-Registration | `ynm_preregistration_required` | Select | Text | Custom Field Widget |
| Q5.3 Cancellation Policy | `ynm_cancellation_policy` | Textarea | Text | Custom Field Widget |
| Q5.4 Waitlist Policy | `ynm_waitlist_policy` | Textarea | Text | Custom Field Widget |
| Q5.6 Peak Hours | `ynm_peak_hours` | Textarea | Text | Custom Field Widget |
| **Section 6: Inclusivity** |
| Q6.1 Accessibility Features | `ynm_accessibility_features` | Checkboxes | Serialized Array | Custom Field Widget |
| Q6.2 Gender-Neutral Facilities | `ynm_gender_neutral_facilities` | Select | Text | Custom Field Widget |
| Q6.3 Body Inclusive | `ynm_body_inclusive` | Checkbox | Boolean | Custom Field Widget |
| Q6.3 Body Inclusive Details | `ynm_body_inclusive_details` | Textarea | Text | Custom Field Widget |
| Q6.4 BIPOC Safe Space | `ynm_bipoc_safe_space` | Checkbox | Boolean | Custom Field Widget |
| Q6.5 LGBTQ+ Safe Space | `ynm_lgbtq_safe_space` | Checkbox | Boolean | Custom Field Widget |
| Q6.6 Trauma-Informed | `ynm_trauma_informed` | Checkbox | Boolean | Custom Field Widget |
| **Section 7: Class Experience** |
| Q7.2 Class Size | `ynm_class_size` | Select | Text | Custom Field Widget |
| Q7.3 Class Duration | `ynm_class_duration` | Checkboxes | Serialized Array | Custom Field Widget |
| Q7.4 Teacher Consistency | `ynm_teacher_consistency` | Select | Text | Custom Field Widget |
| Q7.5 Teacher Qualifications | `ynm_teacher_qualifications` | Select | Text | Custom Field Widget |
| Q7.6 Beginner Class | `ynm_beginner_class` | Text | Text | Custom Field Widget |
| Q7.7 Photo Policy | `ynm_photo_policy` | Select | Text | Custom Field Widget |
| **Section 8: Community** |
| Q8.1 Workshops | `ynm_workshops` | Checkbox | Boolean | Custom Field Widget |
| Q8.1 Workshops Details | `ynm_workshops_details` | Textarea | Text | Custom Field Widget |
| Q8.2 Teacher Training | `ynm_teacher_training` | Checkbox | Boolean | Custom Field Widget |
| Q8.2 Teacher Training Details | `ynm_teacher_training_details` | Textarea | Text | Custom Field Widget |
| Q8.3 Retreats | `ynm_retreats` | Checkbox | Boolean | Custom Field Widget |
| Q8.3 Retreats Details | `ynm_retreats_details` | Textarea | Text | Custom Field Widget |
| Q8.4 Community Events | `ynm_community_events` | Checkbox | Boolean | Custom Field Widget |
| Q8.4 Community Events Details | `ynm_community_events_details` | Textarea | Text | Custom Field Widget |
| Q8.5 Virtual Classes | `ynm_virtual_classes` | Select | Text | Custom Field Widget |
| Q8.5 Virtual Classes URL | `ynm_virtual_classes_url` | URL | URL | Custom Field Widget |
| **Section 9: Background** |
| Q9.1 Years in Business | `ynm_years_in_business` | Number | Number | Custom Field Widget |
| Q9.2 Yoga Alliance | `ynm_yoga_alliance` | Checkbox | Boolean | Custom Field Widget |
| Q9.3 Founder Philosophy | `ynm_founder_philosophy` | Textarea | Text | Custom Field Widget |
| Q9.4 Awards | `ynm_awards` | Textarea | Text | Custom Field Widget |

**Total Custom Fields:** ~50+ custom fields with `ynm_` prefix

---

## 🔄 Next Steps

1. **Review this questionnaire** - Ensure all questions and explanations are correct
2. **Create GeoDirectory custom fields** - Set up all custom fields with `ynm_` prefix
3. **Build Ninja Form** - Create form using this structure
4. **Map Form to GeoDirectory** - Use Ninja Forms → GeoDirectory integration or custom PHP
5. **Test form submission** - Submit test listing and verify data flow
6. **Update listing page widgets** - Ensure widgets display custom field data

---

## 📚 Additional Resources

- **GeoDirectory Custom Fields Documentation:** [Link]
- **Ninja Forms GeoDirectory Integration:** [Link]
- **Schema.org YogaStudio Properties:** [Link]

---

## 🔄 Detailed Implementation Steps

### Step 1: Review & Approve Questionnaire ✅
- [x] Review all questions and explanations
- [ ] Ensure questions align with your vision
- [ ] Verify metadata field names are correct
- [ ] Approve for form building

### Step 2: Create GeoDirectory Custom Fields
**Location:** WordPress Admin → GeoDirectory → Settings → Post Types → Places → Custom Fields

**Process:**
1. Create each custom field with `ynm_` prefix
2. Set appropriate field type (Text, Select, Checkbox, Number, Textarea)
3. Configure field options (for Select/Checkbox fields)
4. Set field visibility and display settings
5. Group fields by section for easier management

**Priority Fields (Create First):**
- Section 2: Vibe & Culture (6 fields)
- Section 3: Pricing (7 fields)
- Section 4: Logistics (9 fields)
- Section 5: Booking (5 fields)

**Estimated Time:** 2-3 hours for all custom fields

### Step 3: Build Ninja Form
**Location:** WordPress Admin → Ninja Forms → Add New

**Process:**
1. Create new form: "Studio Intake Questionnaire"
2. Add form fields matching this questionnaire structure
3. Set field labels, types, and options
4. Configure conditional logic (show/hide fields based on answers)
5. Set required fields
6. Add help text/instructions for each field
7. Configure form settings (email notifications, success message)

**Form Structure:**
- Use sections/divider fields to separate the 9 sections
- Add progress indicator (if available)
- Enable save draft functionality
- Add form validation

**Estimated Time:** 4-6 hours for complete form

### Step 4: Map Form to GeoDirectory
**Method Options:**

**Option A: Ninja Forms → GeoDirectory Integration (if available)**
- Use built-in integration plugin
- Map form fields to GeoDirectory fields
- Configure post creation settings

**Option B: Custom PHP Hook**
- Use Ninja Forms `ninja_forms_after_submission` hook
- Create `gd_place` post on form submission
- Map form fields to GeoDirectory meta fields
- Handle custom field data (arrays, JSON, etc.)

**PHP Hook Example:**
```php
add_action('ninja_forms_after_submission', 'ynm_create_studio_listing', 10, 1);
function ynm_create_studio_listing($form_data) {
    // Get form field values
    $studio_name = $form_data['fields'][1]['value']; // Example
    $street = $form_data['fields'][2]['value'];
    // ... etc
    
    // Create GeoDirectory post
    $post_id = wp_insert_post(array(
        'post_title' => $studio_name,
        'post_type' => 'gd_place',
        'post_status' => 'pending' // or 'publish'
    ));
    
    // Save GeoDirectory standard fields
    update_post_meta($post_id, 'geodir_street', $street);
    // ... etc
    
    // Save custom fields
    update_post_meta($post_id, 'ynm_spirituality_meter', $spirituality_meter);
    // ... etc
}
```

**Estimated Time:** 2-4 hours for mapping and testing

### Step 5: Test Form Submission
- [ ] Submit test listing with all fields
- [ ] Verify GeoDirectory post is created
- [ ] Check all standard fields save correctly
- [ ] Verify all custom fields save correctly
- [ ] Test conditional fields (show/hide logic)
- [ ] Test file uploads (images)
- [ ] Verify business hours format
- [ ] Check categories/taxonomies assign correctly

### Step 6: Update Listing Page Widgets
**Location:** Elementor → Theme Builder → GD>SINGLE Template

**Process:**
1. Add Custom Field widgets for each custom field
2. Configure widget display settings
3. Style widgets to match design
4. Test data display on listing page
5. Verify all sections display correctly

**Widgets Needed:**
- Custom Field widgets for vibe data
- Custom Field widgets for pricing
- Custom Field widgets for logistics
- Custom Field widgets for inclusivity badges
- Custom Field widgets for community events
- Custom Field widgets for background info

**Estimated Time:** 3-4 hours for widget setup

### Step 7: Form Testing & Refinement
- [ ] Test form with real studio data
- [ ] Verify all data flows correctly
- [ ] Check for any missing fields
- [ ] Refine field labels/instructions
- [ ] Test form validation
- [ ] Optimize form user experience

### Step 8: Documentation & Training
- [ ] Create form submission guide for studio owners
- [ ] Document field explanations
- [ ] Create video tutorial (optional)
- [ ] Train staff on form review process

---

## ✅ Checklist: Ready to Build?

Before starting form building, ensure:
- [x] Questionnaire is complete and reviewed
- [x] All metadata field names are defined
- [x] GeoDirectory custom fields are planned
- [x] Form structure is understood
- [x] Data flow is mapped (Form → GeoDirectory → Display)
- [ ] GeoDirectory custom fields are created
- [ ] Ninja Form is built
- [ ] Form-to-GeoDirectory mapping is configured
- [ ] Listing page widgets are ready

---

**Document Status:** ✅ Complete - Ready for form building

**Next Action:** Review questionnaire, then create GeoDirectory custom fields, then build Ninja Form

