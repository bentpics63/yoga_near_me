# Implementation Order - What to Do First
## Step-by-Step Guide for Single Studio Page Redesign

Based on the complete design, here's the exact order to implement everything:

---

## 🎯 **PHASE 1: SETUP & HERO SECTION** (Do This First!)

### **Step 1.1: Add PHP Code** ⚠️ CRITICAL FIRST STEP
**File:** `/code/PHP ADDS/functions.php`

1. Open your WordPress theme's `functions.php` file
2. Add this line at the very bottom:
```php
require_once get_stylesheet_directory() . '/../code/PHP ADDS/single-studio-hero-badges.php';
```
3. Upload `single-studio-hero-badges.php` to `/wp-content/themes/your-theme/code/PHP ADDS/`

**Why First:** Without this, badges, tagline, and status won't appear!

---

### **Step 1.2: Add Hero Section CSS** ⚠️ CRITICAL FIRST STEP
**File:** `single-studio-hero-custom.css`

1. Go to **WordPress Admin → Appearance → Customize → Additional CSS**
2. Copy **ALL** code from `single-studio-hero-custom.css`
3. Paste into Additional CSS
4. Click **Publish**

**Why First:** This styles the hero section (images, badges, buttons, etc.)

---

### **Step 1.3: Add Content Sections CSS** ⚠️ CRITICAL FIRST STEP
**File:** `single-studio-content-sections.css`

1. Still in **Additional CSS** (same place as Step 1.2)
2. Copy **ALL** code from `single-studio-content-sections.css`
3. Paste it **BELOW** the hero CSS (add to existing CSS)
4. Click **Publish**

**Why First:** This styles About, Yoga Styles, Amenities sections

---

### **Step 1.4: Set Up Custom Fields**
**Location:** WordPress Admin → Studio Posts

1. Install **Advanced Custom Fields (ACF)** plugin (if not installed)
2. Create these custom fields:
   - `studio_verified` (Checkbox/True-False)
   - `studio_featured` (Checkbox/True-False)
   - `studio_tagline` (Text field)
3. Edit a studio post
4. Check "Verified" and/or "Featured" if applicable
5. Add a tagline (e.g., "We love helping people feel their best.")
6. **Save** the post

**Why First:** Badges and tagline won't show without this data!

---

### **Step 1.5: Configure Image Gallery**
**Location:** Elementor Template Editor

1. Edit your single studio page template in Elementor
2. Set up image gallery widget:
   - Main image: 70% width
   - Side images: 30% width (stacked)
   - Add "+X Photos" overlay widget/text
3. Upload multiple images to a test studio
4. **Save** template

**Why First:** Hero section needs proper image layout

---

### **Step 1.6: Create Action Buttons**
**Location:** Elementor Template Editor

1. In Elementor, add Button widgets to hero section
2. Create three buttons:
   - **"Book a Class"**: Orange (#FF5733), calendar icon
   - **"Save"**: Teal (#61948B), heart icon  
   - **"Share"**: Teal (#61948B), share icon
3. Position buttons top-right (use columns)
4. **Save** template

**Why First:** Hero section needs these buttons

---

## ✅ **VERIFY PHASE 1 IS WORKING**

Before moving on, check:
- [ ] Badges appear above studio title
- [ ] Tagline appears below title
- [ ] Status shows "Open · Closes X PM" or "Closed"
- [ ] Action buttons appear top-right
- [ ] Image gallery shows 70/30 layout
- [ ] Rating displays with gold stars
- [ ] Address shows with pin icon

**If any of these don't work, fix them before continuing!**

---

## 🎯 **PHASE 2: CONTENT SECTIONS** (Already CSS Ready!)

### **Step 2.1: Verify Section Headings**
**Location:** Elementor Template Editor

1. Check that section headings (About, Yoga Styles, Amenities) have:
   - Orange dot icon (●) before text
   - Proper spacing
2. If icons don't appear, add class `star-icon` to heading widgets

**Status:** CSS is ready, just needs verification

---

### **Step 2.2: Set Up Yoga Styles Badges**
**Location:** Elementor or GeoDirectory

1. Add Yoga Styles widget/section
2. Ensure badges have:
   - White background
   - Teal border (#61948B)
   - Teal text
   - Small star icon (★) inside
3. Use classes: `yoga-style-badge` or `studio-yoga-style`

**Status:** CSS is ready, needs HTML structure

---

### **Step 2.3: Set Up Amenities Grid**
**Location:** Elementor Template Editor

1. Create Amenities section
2. Use grid layout (3 columns desktop, 2 tablet, 1 mobile)
3. Add icons (Font Awesome) + text for each amenity
4. Use classes: `amenity-item` or `studio-amenity`

**Status:** CSS is ready, needs HTML structure

---

### **Step 2.4: Set Up Two-Column Layout**
**Location:** Elementor Template Editor

1. Create main content wrapper
2. Left column: 66% width (About, Yoga Styles, Amenities)
3. Right column: 34% width (Contact, Hours, Location)
4. Use class: `studio-main-content-wrapper`

**Status:** CSS is ready, needs Elementor column setup

---

## ✅ **VERIFY PHASE 2 IS WORKING**

Check:
- [ ] Section headings have orange icons
- [ ] Yoga style pills have teal borders and stars
- [ ] Amenities show in 3-column grid
- [ ] Cards have white background and shadows
- [ ] Two-column layout works (left wider, right narrower)

---

## 🎯 **PHASE 3: REVIEWS SECTION** (Next Priority!)

### **Step 3.1: Create Reviews CSS File**
**Action:** I'll create this next - `single-studio-reviews.css`

**What it will include:**
- Large rating display (big "4.9" number)
- Star distribution chart (horizontal bars)
- Review card styling (avatars, layout)
- "Write a Review" button styling

**Status:** ⏳ **NEXT TASK** - I'll create this for you

---

### **Step 3.2: Set Up Reviews Section**
**Location:** Elementor Template Editor

1. Add Reviews section/widget
2. Configure GeoDirectory reviews widget
3. Apply CSS classes from reviews CSS file
4. Position "Write a Review" button top-right

**Status:** ⏳ Waiting for CSS file

---

## 🎯 **PHASE 4: NEARBY STUDIOS** (After Reviews)

### **Step 4.1: Create Nearby Studios CSS**
**Action:** I'll create this after Phase 3

**What it will include:**
- Card design (image, name, location, rating)
- Grid layout (2-3 columns)
- Hover effects (lift, shadow)
- "Sponsored" badge styling

**Status:** ⏳ After Phase 3

---

## 📋 **QUICK START CHECKLIST**

**Do These First (In Order):**

1. ✅ **Add PHP include** to `functions.php`
2. ✅ **Add Hero CSS** to WordPress Customizer
3. ✅ **Add Content CSS** to WordPress Customizer  
4. ✅ **Create custom fields** (verified, featured, tagline)
5. ✅ **Set up image gallery** in Elementor
6. ✅ **Create action buttons** in Elementor
7. ✅ **Test hero section** - verify everything works
8. ✅ **Set up content sections** in Elementor
9. ✅ **Test content sections** - verify styling
10. ⏳ **Wait for Phase 3 CSS** (Reviews section)
11. ⏳ **Wait for Phase 4 CSS** (Nearby Studios)

---

## 🚨 **MOST COMMON MISTAKES TO AVOID**

1. **Skipping PHP setup** - Badges won't appear!
2. **Not adding CSS to Customizer** - Nothing will be styled!
3. **Forgetting custom fields** - Badges/tagline won't show!
4. **Wrong CSS order** - Add hero CSS first, then content CSS
5. **Not testing after each step** - Catch errors early!

---

## 💡 **RECOMMENDED WORKFLOW**

**Day 1:**
- Steps 1.1-1.6 (Setup & Hero)
- Test hero section thoroughly

**Day 2:**
- Steps 2.1-2.4 (Content Sections)
- Test content sections thoroughly

**Day 3:**
- Wait for Phase 3 CSS (I'll create it)
- Implement Reviews section

**Day 4:**
- Wait for Phase 4 CSS (I'll create it)
- Implement Nearby Studios

---

## 🎯 **YOUR FIRST TASK RIGHT NOW**

**Start with Step 1.1: Add PHP Code**

1. Open `functions.php`
2. Add the include statement
3. Upload the badges PHP file
4. Test that badges appear (even if unstyled)

Then move to Step 1.2 (Add CSS) and continue in order.

---

**Need help with any step? Let me know which one you're on!**

