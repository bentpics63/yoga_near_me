# Page Architecture Tasks
## Structure Only - No Styling Yet

**Goal:** Build all containers and add all widgets BEFORE starting design work.

---

## ✅ Completed Architecture

- [x] **Hero Container Structure** - Full-width container with nested two-column layout
- [x] **Hero Image Widget** - GD Post Images widget added
- [x] **Studio Info Container** - Nested container for studio details
- [x] **Action Buttons Container** - Container for Book/Share buttons

---

## 🏗️ Remaining Architecture Tasks

### Task 1: Complete Hero Container Widgets ⚠️ IN PROGRESS
**Status:** Partially complete - need to finish Studio Info widgets

**What to Add:**
- [ ] **GD Post Title Widget** (H1) - In Studio Info Container
- [ ] **GD Post Address Widget** - Below title
- [ ] **GD Post Rating Widget** - Below address (or in Meta Bar)
- [ ] **Verification Badge Widget** (Custom HTML) - Optional, if needed

**Action Buttons:**
- [ ] **"Book a Class" Button Widget** - Link to booking URL
- [ ] **"Share" Button Widget** - Social sharing functionality

**Time Estimate:** 30-45 minutes

---

### Task 2: Meta Bar Container
**Location:** Below Hero Container

**Structure:**
- [ ] **Add Container** - Full-width, horizontal layout
- [ ] **Set Direction:** Row (horizontal)
- [ ] **Add Padding:** Top 16px, Bottom 16px
- [ ] **Add Border:** Bottom border (1px, light gray)

**Widgets to Add:**
- [ ] **GD Post Rating Widget** - Star rating display
- [ ] **GD Post Categories Widget** - Yoga styles/categories
- [ ] **GD Distance Widget** - Distance from user location
- [ ] **Favorite Button Widget** - Save/bookmark functionality
- [ ] **Share Button Widget** - Social sharing (if not in hero)

**Layout:** Horizontal row with spacing between widgets

**Time Estimate:** 30 minutes

---

### Task 3: Main Content Container Structure
**Location:** Below Meta Bar

**Structure:**
- [ ] **Add Container** - Boxed width (max 1200px), centered
- [ ] **Set Direction:** Row (two columns)
- [ ] **Column Ratio:** 66% left, 34% right
- [ ] **Add Gap:** 32px between columns
- [ ] **Responsive:** Stack columns on mobile

**Time Estimate:** 15 minutes

---

### Task 4: Left Column Widgets (Editorial Content)
**Location:** Main Content Container → Left Column (66%)

**Widgets to Add:**
- [ ] **GD Post Description Widget** - Full studio description
- [ ] **GD Post Amenities Widget** - Parking, props, mats, etc.
- [ ] **GD Post Categories Widget** - Yoga styles taught
- [ ] **GD Post Tags Widget** - Additional tags (optional)
- [ ] **GD Post Custom Fields Widget** - Any custom fields (optional)

**Layout:** Stack widgets vertically with spacing

**Time Estimate:** 20 minutes

---

### Task 5: Right Column Widgets (Actions/CTAs)
**Location:** Main Content Container → Right Column (34%)

**Widgets to Add:**
- [ ] **Claim Your Studio CTA Button** - Link to claim workflow
- [ ] **GD Contact Info Widget** - Phone, email, website
- [ ] **GD Business Hours Widget** - Opening hours display
- [ ] **Directions Button Widget** - Link to Google Maps
- [ ] **GD Map Widget** - Small map preview (optional, or full-width below)

**Layout:** Stack widgets vertically

**Time Estimate:** 30 minutes

---

### Task 6: Below Content Container Structure
**Location:** Below Main Content Container

**Structure:**
- [ ] **Add Container** - Full-width
- [ ] **Background:** Light background color (for separation)
- [ ] **Padding:** Top 48px, Bottom 48px
- [ ] **Purpose:** Holds Reviews, Map, Nearby Studios sections

**Time Estimate:** 10 minutes

---

### Task 7: Reviews Section
**Location:** Below Content Container

**Structure:**
- [ ] **Add Container** - Boxed width (max 1200px), centered
- [ ] **Add Heading Widget** - "Reviews" (H2)

**Widgets to Add:**
- [ ] **GD Reviews Widget** - Display reviews
- [ ] **GD Post Rating Widget** - Aggregate rating display
- [ ] **External Review Links** - Custom HTML buttons for Google/Yelp/Facebook

**Time Estimate:** 20 minutes

---

### Task 8: Map Section
**Location:** Below Reviews Section (in Below Content Container)

**Structure:**
- [ ] **Add Container** - Full-width or boxed (your choice)
- [ ] **Add Heading Widget** - "Location" (H2)

**Widgets to Add:**
- [ ] **GD Map Widget** - Interactive map
- [ ] **Directions Button Widget** - "Get Directions" CTA

**Time Estimate:** 15 minutes

---

### Task 9: Nearby Studios Section
**Location:** Below Map Section (in Below Content Container)

**Structure:**
- [ ] **Add Container** - Boxed width (max 1200px), centered
- [ ] **Add Heading Widget** - "Nearby Studios" (H2)

**Widgets to Add:**
- [ ] **GD Related Posts Widget** - Show related/nearby studios
- [ ] **View More Studios Button** - Link to city/area listing page

**Layout:** Grid layout (widget should handle this)

**Time Estimate:** 20 minutes

---

### Task 10: Navigation Widget (Optional)
**Location:** Bottom of page

**Widgets to Add:**
- [ ] **GD Post Navigation Widget** - Previous/Next studio links
- [ ] **OR** Keep existing `geodir-widget-single-next-prev` block

**Time Estimate:** 10 minutes

---

## 📊 Architecture Completion Checklist

### Hero Section
- [x] Hero Container Structure
- [x] Hero Image Widget
- [ ] Studio Info Widgets (Title, Address, Rating)
- [ ] Action Buttons (Book, Share)

### Meta Bar
- [ ] Meta Bar Container
- [ ] Rating Widget
- [ ] Categories Widget
- [ ] Distance Widget
- [ ] Favorite/Share Buttons

### Main Content
- [ ] Main Content Container (Two Columns)
- [ ] Left Column Widgets (Description, Amenities, Categories)
- [ ] Right Column Widgets (Contact, Hours, Directions, Claim CTA)

### Below Content
- [ ] Below Content Container
- [ ] Reviews Section
- [ ] Map Section
- [ ] Nearby Studios Section

### Navigation
- [ ] Post Navigation Widget

---

## ⏱️ Total Time Estimate

**Architecture Phase:** 3-4 hours total
- Hero completion: 30-45 min
- Meta Bar: 30 min
- Main Content Structure: 15 min
- Left Column: 20 min
- Right Column: 30 min
- Below Content Container: 10 min
- Reviews: 20 min
- Map: 15 min
- Nearby Studios: 20 min
- Navigation: 10 min

**After Architecture:** Then move to design/styling phase

---

## 🎯 Next Steps After Architecture

Once all widgets are added and containers are structured:

1. **Typography** - Set fonts, sizes, line heights
2. **Colors** - Apply brand color scheme
3. **Spacing** - Refine padding, margins, gaps
4. **Buttons** - Style all buttons consistently
5. **Cards** - Add card styling to widgets
6. **Mobile** - Test and adjust responsive behavior
7. **Polish** - Final refinements

---

## 📝 Notes

- **Don't worry about styling yet** - Just get widgets in place
- **Use default Elementor spacing** - We'll refine later
- **Test widgets populate data** - Make sure GeoDirectory data shows
- **Mobile can wait** - Focus on desktop structure first
- **Save frequently** - Elementor auto-saves, but save manually too

---

## 🚀 Ready to Start?

Begin with **Task 1** - Complete the Hero Container widgets, then move through tasks sequentially.



