# Single Studio Page - Complete Rebuild Guide
## Mobile-First Elementor Pro + GeoDirectory

**Skill Level:** Novice-friendly with detailed steps
**Approach:** Mobile-first (design for mobile, then expand to desktop)
**Builder:** Elementor Pro Theme Builder + GeoDirectory Widgets

---

## Before You Start

### Open These Side-by-Side:
1. WordPress Admin → Templates → Theme Builder
2. This guide
3. Your design reference image

### Color Reference (Keep Handy):
```
Coral/Rust (Primary CTA): #e95c4b
Teal (Secondary): #61948B
Dark Text: #101828
Medium Text: #475467
Light Text: #667085
Light Background: #F9FAFB
Border Color: #E4E7EC
Success Green: #12B76A
```

---

# PHASE 1: Create the Template

## Step 1.1: Create New Single Listing Template

1. **Go to:** WordPress Admin → Templates → Theme Builder
2. **Click:** "Add New" button (top of page)
3. **Select:** "Single Post" from the dropdown
4. **Name it:** `Single Studio - Redesign v2`
5. **Click:** "Create Template"

## Step 1.2: Set Display Conditions

1. After creating, a popup appears asking "Where do you want to display?"
2. **Click:** "Add Condition"
3. **Select:**
   - First dropdown: "Singular"
   - Second dropdown: "gd_place" (this is GeoDirectory's studio post type)
4. **Click:** "Save & Close"

## Step 1.3: Set Up the Canvas

1. You're now in the Elementor editor with a blank canvas
2. **Bottom left corner:** Click the gear icon (Page Settings)
3. **Page Layout:** Select "Elementor Canvas" (removes header/footer for now - we'll add back later)
4. **Click:** Update (top right)

---

# PHASE 2: Build the Container Structure

## Understanding Containers (Important!)

Elementor uses **Containers** as building blocks. Think of them like boxes:
- **Outer Container** = The full-width wrapper
- **Inner Container** = Content inside (usually max-width 1200px, centered)
- Containers can be **horizontal** (items side by side) or **vertical** (items stacked)

**Mobile-First Rule:** Start with everything stacked (vertical), then adjust for tablet/desktop.

---

## Step 2.1: Add the Hero Image Section

### A. Create Outer Container (Hero)

1. **Click** the "+" icon in the center of the canvas
2. **Select** "Container" (the box icon)
3. A container appears. **Click on it** to select it.
4. **Left Panel → Layout tab:**
   - Content Width: `Full Width`
   - Direction: `Column` (vertical stacking)
   - Align Items: `Stretch`
   - Gap: `0px`
5. **Left Panel → Style tab → Background:**
   - Type: Classic
   - Color: `#F9FAFB` (light gray - fallback)
6. **Left Panel → Advanced tab:**
   - Padding: `0` on all sides
   - Margin: `0` on all sides

### B. Add Breadcrumbs Inside Hero Container

1. **Inside the hero container**, click the "+" to add an element
2. **Search for:** "GD Breadcrumb" widget (from GeoDirectory)
3. **Drag it** into the container
4. **Style the breadcrumbs:**
   - Left Panel → Style tab
   - Text Color: `#667085`
   - Typography: Inter, 14px, 400 weight
   - Link Color: `#e95c4b`
5. **Advanced tab:**
   - Padding: `12px` top, `16px` left/right, `0` bottom
   - Background: `#FFFFFF`

### C. Add Post Images Widget

1. **Click "+"** below breadcrumbs (still inside hero container)
2. **Search for:** "GD Post Images" widget
3. **Drag it** into position
4. **Configure:**
   - Left Panel → Content tab
   - Show: Gallery (or Slider)
   - Image Size: Large
5. **Style tab:**
   - Border Radius: `0px` (full bleed on mobile)
6. **Advanced tab:**
   - Padding: `0` all sides

---

## Step 2.2: Build the Studio Header Section

This is the section with logo, name, badges, and CTA buttons.

### A. Create Header Container

1. **Below the hero**, click "+" to add new container
2. **Layout settings:**
   - Content Width: `Full Width`
   - Direction: `Column`
   - Align Items: `Stretch`
3. **Style → Background:**
   - Color: `#FFFFFF`
4. **Advanced:**
   - Padding: `20px` all sides (mobile)
   - Margin: `0`

### B. Add Inner Container (for max-width)

1. **Inside the header container**, add another container
2. **Layout:**
   - Content Width: `Boxed`
   - Width: `1200px`
   - Direction: `Column`
   - Align Items: `Flex Start` (left align)
   - Gap: `16px`

### C. Add Logo + Title Row

1. **Inside inner container**, add another container (this will be the logo/title row)
2. **Layout:**
   - Direction: `Row` (horizontal on all devices)
   - Align Items: `Flex Start`
   - Gap: `16px`
3. **Add GD Post Badge widget** (for logo):
   - Or use "GD Post Images" set to show only featured image
   - Width: `48px` (mobile), `64px` (tablet+)
   - Border Radius: `8px`
4. **Add container** next to logo for text:
   - Direction: `Column`
   - Gap: `4px`
5. **Inside text container, add:**
   - **Heading widget** → Set to "GD Post Title" dynamic tag
     - Typography: Inter, 24px mobile / 32px desktop, 700 weight
     - Color: `#101828`
   - **Text widget** for tagline → Use "GD Post Meta" or custom field
     - Typography: Inter, 16px, 400 weight, italic
     - Color: `#475467`

### D. Add Rating + Location + Status Row

1. **Add new container** below logo/title row
2. **Layout:**
   - Direction: `Row`
   - Wrap: `Wrap` (important for mobile!)
   - Align Items: `Center`
   - Gap: `12px`
3. **Inside, add these elements:**
   - **GD Rating widget** (stars)
   - **Text widget** with location icon + "Downtown, New York"
   - **Text widget** with status "Open - Closes 9 PM"
   - **Text widget** "Est. 2015"

*For each text element:*
- Font: Inter, 14px, 400 weight
- Color: `#667085`

### E. Add Trust Badges Row

1. **Add new container** below rating row
2. **Layout:**
   - Direction: `Row`
   - Wrap: `Wrap`
   - Gap: `8px`
3. **Add badge elements** (use Button or styled text widgets):
   - "Yoga Alliance RYS-200" - Background: `#FFF7ED`, Border: `#FDBA74`
   - "Google 4.7" - Background: `#F9FAFB`, Border: `#E4E7EC`
   - "Yelp 4.5" - Background: `#F9FAFB`, Border: `#E4E7EC`
   - "Verified" - Background: `#ECFDF3`, Border: `#86EFAC`

*Badge styling:*
- Padding: `6px 12px`
- Border Radius: `6px`
- Font: Inter, 12px, 500 weight

### F. Add CTA Buttons Row

1. **Add new container** below badges
2. **Layout:**
   - Direction: `Row`
   - Wrap: `Wrap`
   - Gap: `12px`
3. **Add 3 Button widgets:**

**Button 1 - "Book a Class":**
- Background: `#e95c4b`
- Text Color: `#FFFFFF`
- Padding: `12px 24px`
- Border Radius: `8px`
- Typography: Inter, 14px, 600 weight

**Button 2 - "Website":**
- Background: `#FFFFFF`
- Text Color: `#344054`
- Border: `1px solid #E4E7EC`
- Padding: `12px 24px`
- Border Radius: `8px`

**Button 3 - "Call":**
- Same as Button 2

---

## Step 2.3: Build the Quick Info Bar

### A. Create Quick Info Container

1. **Add new container** below header section
2. **Layout:**
   - Content Width: `Full Width`
   - Direction: `Column`
3. **Style → Background:**
   - Color: `#F9FAFB`
4. **Advanced:**
   - Padding: `16px 20px`
   - Border: `1px solid #E4E7EC` (top and bottom only)

### B. Add Inner Container with Info Items

1. **Inside**, add container:
   - Content Width: `Boxed` (1200px)
   - Direction: `Row`
   - Wrap: `Wrap`
   - Justify Content: `Space Between`
   - Gap: `16px`

2. **For each info item** (Drop-in, Heated, Studio Size, Teachers, Levels, Virtual):
   - Add a container with Direction: `Row`, Gap: `8px`
   - Add Icon widget (coral color `#e95c4b`)
   - Add container with Direction: `Column`, Gap: `2px`
     - Text widget for label (12px, `#667085`, uppercase)
     - Text widget for value (14px, 600 weight, `#101828`)

---

## Step 2.4: Build Two-Column Content Area

This is the About + Contact/Map section.

### A. Create Outer Container

1. **Add new container** below quick info bar
2. **Layout:**
   - Content Width: `Full Width`
   - Direction: `Column`
3. **Style → Background:**
   - Color: `#FFFFFF`
4. **Advanced:**
   - Padding: `32px 20px`

### B. Add Inner Container (Boxed)

1. **Inside**, add container:
   - Content Width: `Boxed` (1200px)
   - Direction: `Column` on Mobile
   - Direction: `Row` on Tablet+ (use responsive controls!)
   - Gap: `32px`

### C. Add Left Column (About)

1. **Add container** inside inner container:
   - Width: `100%` mobile, `60%` tablet+
   - Direction: `Column`
   - Gap: `16px`
2. **Add section heading:**
   - Icon widget (small orange dot or icon)
   - Heading widget: "About Our Studio"
   - Typography: Inter, 20px, 700 weight, `#101828`
3. **Add GD Post Content widget:**
   - This pulls the studio description
   - Typography: Inter, 16px, 400 weight, `#475467`
   - Line Height: 1.6

### D. Add Right Column (Contact + Map)

1. **Add container** (second column):
   - Width: `100%` mobile, `40%` tablet+
   - Direction: `Column`
   - Gap: `24px`
   - Background: `#F9FAFB`
   - Padding: `24px`
   - Border Radius: `12px`

2. **Add Contact Section:**
   - Heading: "Contact"
   - GD Phone widget
   - GD Email widget
   - GD Address widget
   - "Get Directions" link

3. **Add Map:**
   - GD Map widget
   - Height: `200px`
   - Border Radius: `8px`

4. **Add Hours:**
   - GD Business Hours widget
   - Style as table

---

## Step 2.5: Build Full-Width Sections

For each remaining section, follow this pattern:

### Standard Section Container Pattern:

```
OUTER CONTAINER (Full Width)
├── Background: #FFFFFF or #F9FAFB (alternate)
├── Padding: 32px 20px
│
└── INNER CONTAINER (Boxed 1200px)
    ├── Direction: Column
    ├── Gap: 24px
    │
    ├── SECTION HEADER
    │   ├── Icon (coral dot)
    │   └── Heading (20px, bold)
    │
    └── CONTENT AREA
        └── (Varies by section)
```

---

# PHASE 3: Section-by-Section Build Instructions

## 3.1: Yoga Styles Offered Section

1. **Create outer/inner containers** (as above)
2. **Background:** `#FFFFFF`
3. **Add container for styles:**
   - Direction: `Row`
   - Wrap: `Wrap`
   - Gap: `8px`
4. **Add GD Categories widget** (shows yoga styles)
   - Style as pills
   - Or create manual buttons/badges
5. **Styling for each pill:**
   - Background: `#FFFFFF`
   - Border: `1px solid #E4E7EC`
   - Border Radius: `9999px` (full round)
   - Padding: `8px 16px`
   - Font: Inter, 14px, 500 weight
6. **Primary style (first one):**
   - Background: `#e95c4b`
   - Text Color: `#FFFFFF`
   - No border

---

## 3.2: Pricing Section

1. **Create containers** with background `#F9FAFB`
2. **Add pricing cards container:**
   - Direction: `Row`
   - Wrap: `Wrap`
   - Gap: `16px`
3. **Each pricing card:**
   - Container with Direction: `Column`
   - Width: `100%` mobile, `calc(25% - 12px)` desktop
   - Background: `#FFFFFF`
   - Border: `1px solid #E4E7EC`
   - Border Radius: `12px`
   - Padding: `20px`
   - Text Align: Center
4. **Featured card (Monthly Unlimited):**
   - Background: `linear-gradient(135deg, #e95c4b, #bd3000)`
   - Text Color: `#FFFFFF`
   - No border
5. **New Student Offer banner:**
   - Background: `#ECFDF5`
   - Border: `1px solid #12B76A`
   - Border Radius: `12px`
   - Padding: `16px 20px`
   - Full width below cards

---

## 3.3: Amenities & Features Section

1. **Create containers** with background `#FFFFFF`
2. **Add amenities container:**
   - Direction: `Row`
   - Wrap: `Wrap`
   - Gap: `8px`
3. **Use GD Custom Fields widget** or manual pills
4. **Each amenity pill:**
   - Same styling as yoga styles (white, bordered, rounded)

---

## 3.4: Our Teachers Section

1. **Create containers** with background `#F9FAFB`
2. **Add teachers grid:**
   - Direction: `Row`
   - Wrap: `Wrap`
   - Gap: `16px`
3. **Each teacher card:**
   - Width: `100%` mobile, `calc(25% - 12px)` desktop
   - Background: `#FFFFFF`
   - Border Radius: `12px`
   - Padding: `20px`
   - Text Align: Center
4. **Card contents:**
   - Avatar (64px circle)
   - Name (16px, 600 weight)
   - Role (14px, `#667085`)
   - Credential badges

---

## 3.5: Programs & Services Section

1. **Create containers** with background `#FFFFFF`
2. **Similar grid to teachers**
3. **Each program card:**
   - Icon box at top
   - Program name
   - Status/price below

---

## 3.6: First Visit Information Section

1. **Create containers** with background `#FFFFFF`
2. **Inner content container:**
   - Background: `linear-gradient(135deg, #F0F9FF, #E0F2FE)`
   - Border: `1px solid #7DD3FC`
   - Border Radius: `12px`
   - Padding: `24px`
3. **"What to Bring" items:**
   - Row of pill badges with check icons
4. **First-time visitors note:**
   - Text with slightly larger font for emphasis

---

## 3.7: Practical Information Section

1. **Create containers** with background `#F9FAFB`
2. **Add 2x3 grid:**
   - Direction: `Row`
   - Wrap: `Wrap`
   - Gap: `16px`
3. **Each info item:**
   - Width: `100%` mobile, `calc(33.33% - 11px)` desktop
   - Background: `#FFFFFF`
   - Padding: `16px`
   - Border Radius: `8px`
4. **Item structure:**
   - Icon + Label row
   - Value text below

---

## 3.8: Reviews Section

1. **Create containers** with background `#FFFFFF`
2. **Left side:** Large rating display (4.8)
3. **Right side:** Star distribution bars
4. **Below:** GD Reviews widget

---

## 3.9: Nearby Yoga Studios Section

1. **Create containers** with background `#F9FAFB`
2. **Use GD Listings widget** filtered to nearby
3. **Style as horizontal card row**
4. **Each card:** Image, name, location, rating, distance

---

# PHASE 4: Responsive Adjustments

## For Each Section, Check These Breakpoints:

### Mobile (default - 0-767px)
- Everything stacks vertically
- Full width containers
- Padding: 20px sides
- Font sizes slightly smaller

### Tablet (768-1024px)
- 2-column layouts appear
- Some grids go 2 columns
- Padding: 32px sides

### Desktop (1025px+)
- Full multi-column layouts
- Grids show 3-4 columns
- Max-width 1200px centered

## How to Set Responsive Values in Elementor:

1. **Select any element**
2. **Look at the setting you want to change** (like width, padding, direction)
3. **Click the device icon** next to the setting (looks like a desktop)
4. **Select Mobile, Tablet, or Desktop**
5. **Change the value** - it only affects that breakpoint

---

# Quick Reference: Common Settings

## Container Direction:
- **Mobile:** Column (stacked)
- **Desktop:** Row (side by side)

## Padding:
- **Mobile:** 16-20px
- **Desktop:** 32-48px

## Gap:
- **Mobile:** 12-16px
- **Desktop:** 24-32px

## Font Sizes:
- **Mobile:** Reduce by 2-4px from desktop sizes
- **Example:** 32px desktop heading → 24px mobile

---

# Troubleshooting

## "My columns won't go side by side"
- Check Direction is set to `Row`
- Check you're on the right breakpoint (tablet/desktop)
- Make sure Wrap is enabled

## "Content is too wide on mobile"
- Set inner container to `100%` width
- Check for fixed pixel widths and change to `%`

## "GeoDirectory widget not showing"
- Make sure you're editing a "Single gd_place" template
- Preview with an actual studio post

## "Colors look different"
- Check for Elementor's default styling overriding yours
- Use more specific selectors or `!important` in custom CSS

---

# Next Steps

After building the structure:
1. **Preview** with a real studio listing
2. **Test on mobile** using browser dev tools
3. **Adjust spacing and typography** as needed
4. **Add custom CSS** for fine-tuning (Phase 5)

---

**Save this file and reference it as you build each section!**
