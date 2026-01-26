# CORRECT ELEMENTOR STRUCTURE - Step by Step

## The Problem
CSS can't fix structural issues. We need to rebuild the Elementor structure to match the design exactly.

---

## HERO SECTION STRUCTURE

### Section 1: Image Gallery
**Settings:**
- Section: Full Width
- Content Width: Boxed (1200px max)
- Column Gap: 16px

**Structure:**
```
Section (Full Width)
└── Container (Boxed)
    └── Row (2 columns: 66.66% | 33.33%)
        ├── Column 1 (66.66%)
        │   └── Image Widget (Main hero image)
        └── Column 2 (33.33%)
            ├── Image Widget (Top small image)
            └── Image Widget (Bottom small image with "+12 Photos" overlay)
```

### Section 2: Studio Header
**Settings:**
- Section: Full Width
- Content Width: Boxed (1200px max)
- Padding: Top 24px, Bottom 24px

**Structure:**
```
Section (Full Width)
└── Container (Boxed)
    └── Row (1 column: 100%)
        └── Column (100%)
            ├── HTML Widget (Badges: VERIFIED + FEATURED)
            ├── GD>Post Title Widget
            ├── Text Widget (Tagline - italic)
            └── Row (2 columns: Auto | Auto)
                ├── Column 1 (Auto width)
                │   ├── GD>Post Rating Widget
                │   ├── Icon + Text Widget (Location)
                │   └── Icon + Text Widget (Hours: "Open · Closes 9 PM")
                └── Column 2 (Auto width, align right)
                    └── Row (Horizontal buttons)
                        ├── Button Widget: "Book a Class"
                        ├── Button Widget: "Save"
                        └── Share Buttons Widget (Facebook, Twitter, LinkedIn)
```

**CRITICAL:** The buttons row must be set to:
- **Layout:** Horizontal
- **Column Gap:** 16px
- **Align:** Right

---

## MAIN CONTENT SECTION

### Section 3: Two-Column Layout
**Settings:**
- Section: Full Width
- Content Width: Boxed (1200px max)
- Column Gap: 24px

**Structure:**
```
Section (Full Width)
└── Container (Boxed)
    └── Row (2 columns: 66.66% | 33.33%)
        ├── LEFT COLUMN (66.66%)
        │   ├── Card Section 1: About
        │   │   ├── Heading Widget: "About Viveka Yoga Studio"
        │   │   └── Text Editor Widget: About text
        │   │
        │   ├── Card Section 2: Yoga Styles
        │   │   ├── Heading Widget: "Yoga Styles Offered"
        │   │   └── GD>Post Meta Widget (yoga_styles field)
        │   │
        │   ├── Card Section 3: Amenities
        │   │   ├── Heading Widget: "Amenities & Features"
        │   │   └── GD>Post Meta Widget (amenities field)
        │   │
        │   ├── Card Section 4: Schedule
        │   │   ├── Heading Widget: "Today's Schedule"
        │   │   └── Text Editor Widget: Schedule tabs + classes
        │   │
        │   └── Card Section 5: Reviews
        │       ├── Heading Widget: "Reviews"
        │       ├── GD>Post Rating Widget (large display)
        │       └── GD>Reviews Widget
        │
        └── RIGHT COLUMN (33.33% - Sidebar)
            ├── Card Section 1: Contact
            │   ├── Heading Widget: "Contact Information"
            │   ├── Icon + Text: Address
            │   ├── Icon + Text: Phone
            │   ├── Icon + Text: Email
            │   └── Icon + Text: Website
            │
            ├── Card Section 2: Hours
            │   ├── Heading Widget: "Hours of Operation"
            │   └── Text Editor Widget: Hours list
            │
            ├── Card Section 3: Map
            │   ├── Heading Widget: "Location"
            │   ├── Map Widget or Image Widget
            │   └── Button Widget: "Get Directions"
            │
            └── Card Section 4: Claim
                ├── Heading Widget: "Own This Studio?"
                ├── Text Editor Widget: Claim text
                └── Button Widget: "Claim Listing"
```

---

## NEARBY STUDIOS SECTION

### Section 4: Nearby Studios
**Settings:**
- Section: Full Width
- Content Width: Boxed (1200px max)
- Background: White
- Padding: Top 40px, Bottom 40px

**Structure:**
```
Section (Full Width)
└── Container (Boxed)
    └── Row (1 column: 100%)
        └── Column (100%)
            ├── Row (2 columns: Auto | Auto)
            │   ├── Column 1 (Auto)
            │   │   └── Heading Widget: "Nearby Yoga Studios"
            │   └── Column 2 (Auto, align right)
            │       └── Text Widget: "View All" (link)
            │
            └── Row (3 columns: 33.33% | 33.33% | 33.33%)
                ├── Column 1: Studio Card
                ├── Column 2: Studio Card
                └── Column 3: Studio Card
```

---

## CRITICAL ELEMENTOR SETTINGS

### For Button Row (Hero Section):
1. **Select the Row** containing buttons
2. **Layout Tab:**
   - Content Width: Full Width
   - Columns Gap: 16px
   - Height: Auto
3. **Advanced Tab:**
   - Margin: 0
   - Padding: 0
   - Display: Flex (if available)
4. **Each Button Widget:**
   - Width: Auto (not 100%)
   - Align: Left (not center)

### For Share Buttons Widget:
1. **Use Elementor Share Buttons Widget** (not a generic button)
2. **Style Tab:**
   - Button Style: Minimal
   - Icon Size: 20px
   - Gap: 16px
3. **Advanced Tab → Custom CSS:**
   - Use the orange styling CSS I provided

### For Two-Column Layout:
1. **Select the Row**
2. **Layout Tab:**
   - Columns Gap: 24px
   - Content Width: Boxed
3. **Left Column:**
   - Width: 66.66%
   - Content Position: Top
4. **Right Column:**
   - Width: 33.33%
   - Content Position: Top
   - Sticky: Yes (if you want sidebar to stick)

---

## WHAT TO FIX RIGHT NOW

### Issue 1: Buttons Stacked Vertically
**Fix:**
1. Select the **Row** containing "Book a Class" and "Save" buttons
2. Go to **Layout** tab
3. Set **Columns Gap** to 16px
4. Make sure each button is in its own **Column** (not stacked in one column)
5. Each Column should be **Auto width** (not 100%)

**OR** if buttons are in same column:
1. Select the **Column**
2. Go to **Advanced** tab → **Custom CSS**
3. Add:
```css
selector {
    display: flex !important;
    flex-direction: row !important;
    gap: 16px !important;
    flex-wrap: wrap !important;
}
```

### Issue 2: Share Button is Generic Teal Button
**Fix:**
1. **Delete** the generic "Share" button
2. **Add** Elementor Share Buttons widget
3. **Configure** it to show Facebook, Twitter, LinkedIn
4. **Style** it with the orange CSS I provided

### Issue 3: Icons are Gray Instead of Sage/Teal
**Fix:**
1. For each Icon widget, go to **Style** tab
2. Set **Primary Color** to `#5F7470` (sage)
3. Or use Custom CSS on the Icon widget:
```css
selector svg {
    fill: #5F7470 !important;
}
```

---

## NEXT STEPS

1. **Fix the button layout FIRST** (most critical)
2. **Replace Share button** with Share Buttons widget
3. **Fix icon colors** (sage instead of gray)
4. **Then we'll apply CSS** to polish everything

Would you like me to create a visual diagram or more specific instructions for any section?

