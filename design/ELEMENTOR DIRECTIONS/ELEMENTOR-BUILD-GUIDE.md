# Elementor Build Guide
## Step-by-Step: Building Your Single Studio Page Design

Based on your design inspiration, here's exactly how to build it in Elementor.

---

## 🏗️ Container Structure (Build Order)

### Level 1: Main Container
```
[FULL WIDTH CONTAINER]
├── Hero Section
├── Main Content Container (Two Columns)
└── (Future: Below Content if needed)
```

---

## 📐 Section 1: Hero Container

### Elementor Setup:
1. **Add Section** → Full Width
2. **Add Container** → Full Width, Min Height: 500px
3. **Background:** Light grey or white

### Inside Hero Container:

#### Row 1: Breadcrumbs (Optional)
- **Widget:** HTML or Text
- **Content:** Home > Search > [Studio Name]
- **Style:** Small text, grey color

#### Row 2: Image Gallery
- **Layout:** Two columns
  - **Left (70%):** Main hero image
  - **Right (30%):** Two smaller images stacked
- **Widget:** GD Post Images
- **Settings:**
  - Main image: Large size
  - Gallery: Show "+X Photos" overlay
  - Style: Rounded corners

#### Row 3: Studio Info
- **Layout:** Two columns
  - **Left:** Studio details
  - **Right:** Action buttons

**Left Column:**
- **GD Post Title** (H1)
  - Font: Inter, Bold, Large
  - Color: Dark grey/black
- **Tagline** (GD Custom Field or Description excerpt)
  - Font: Crimson Pro, Italic
  - Color: Medium grey
- **Badges Row:**
  - VERIFIED badge (custom HTML/CSS)
  - FEATURED STUDIO badge (custom HTML/CSS)
- **Rating + Location:**
  - GD Post Rating widget
  - GD Post Address widget
  - Style: Stars + text inline
- **Status:**
  - GD Custom Field (hours/status)
  - Style: "Open · Closes 9 PM"

**Right Column:**
- **Action Buttons:**
  - "Book a Class" (orange/terracotta)
  - "Save" (teal)
  - "Share" (teal)
  - Style: Rounded buttons, icons

---

## 📐 Section 2: Main Content Container

### Elementor Setup:
1. **Add Section** → Boxed Width (1200px max)
2. **Add Container** → Two Columns
   - **Left:** 66% width
   - **Right:** 34% width
   - **Gap:** 32px

---

## 📋 Left Column (66%) - Content Sections

### Section 2.1: About Section

**Container:**
- White background
- Rounded corners (8px)
- Padding: 32px
- Box shadow (subtle)

**Content:**
- **Heading:** "About [Studio Name]"
  - Font: Inter, Bold, 24px
  - Color: Dark grey
  - Icon: Red bullet point (custom)
- **GD Post Description Widget**
  - Font: Inter, Regular, 16px
  - Line height: 1.7
  - Color: Medium grey
- **"Read more" Link**
  - Custom HTML
  - Style: Teal color, underline on hover

---

### Section 2.2: Yoga Styles Offered

**Container:**
- White background
- Rounded corners
- Padding: 32px
- Margin top: 24px

**Content:**
- **Heading:** "Yoga Styles Offered"
  - Icon: Star (red/teal)
- **GD Post Categories Widget**
  - Style as: Pill badges
  - Background: Light teal/grey
  - Text: Dark grey
  - Padding: 8px 16px
  - Border radius: 20px
  - Hover: Darker background

**CSS for Pills:**
```css
.geodir-categories {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}
.geodir-category-tag {
    display: inline-block;
    padding: 8px 16px;
    background: rgba(97, 148, 139, 0.1);
    border-radius: 20px;
    font-size: 14px;
    color: #2C3E3A;
}
```

---

### Section 2.3: Amenities & Features

**Container:**
- White background
- Rounded corners
- Padding: 32px
- Margin top: 24px

**Content:**
- **Heading:** "Amenities & Features"
  - Icon: Bullet point
- **Grid Layout:**
  - 3 columns on desktop
  - 2 columns on tablet
  - 1 column on mobile
  - Gap: 16px

**Each Amenity Item:**
- Icon (Font Awesome)
- Text label
- Style: Icon + text, centered

**Widget:** GD Custom Fields (amenities)
- Or custom HTML with icons

**Example Structure:**
```
[Icon] Free Parking
[Icon] Air Conditioning
[Icon] Props Provided
... etc
```

---

### Section 2.4: Today's Schedule (Optional - Future)

**Container:**
- White background
- Rounded corners
- Padding: 32px
- Margin top: 24px

**Content:**
- **Heading:** "Today's Schedule"
  - Icon: Calendar
  - "Full Schedule >" link (right-aligned)
- **Day Selector Tabs:**
  - Custom HTML/CSS tabs
  - Today highlighted
- **Class List:**
  - Time | Class Name | Duration | Instructor | Level
  - GD Custom Fields or custom widget

**Note:** This requires schedule data in GeoDirectory

---

### Section 2.5: Reviews

**Container:**
- White background
- Rounded corners
- Padding: 32px
- Margin top: 24px

**Content:**
- **Heading Row:**
  - "Reviews" heading
  - "Write a Review" button (right)
- **Rating Summary:**
  - Large "4.8" number
  - 5 gold stars
  - "127 reviews" text
  - GD Post Rating widget
- **Star Distribution Chart:**
  - Custom HTML/CSS bar chart
  - Or use chart widget
- **Individual Reviews:**
  - GD Reviews widget
  - Style as cards
  - Name, date, stars, text
  - "Was this helpful?" buttons

**Review Card Style:**
- White background
- Padding: 20px
- Border: Light grey
- Border radius: 8px
- Margin bottom: 16px

---

## 📋 Right Column (34%) - Sidebar

### Section 3.1: Contact Information

**Container:**
- White background
- Rounded corners
- Padding: 24px
- Margin bottom: 24px

**Content:**
- **Heading:** "Contact Information"
- **Address:**
  - GD Post Address widget
  - Icon: Location pin
- **Phone:**
  - GD Post Phone widget
  - Icon: Phone
- **Email:**
  - GD Post Email widget
  - Icon: Envelope
- **Website:**
  - GD Post Website widget
  - Icon: Globe
- **Social Media:**
  - "Follow Us" heading
  - Icons: Facebook, Instagram, YouTube
  - GD Custom Fields or HTML

**Style:**
- Each item: Icon + text, stacked
- Spacing: 16px between items

---

### Section 3.2: Hours of Operation

**Container:**
- White background
- Rounded corners
- Padding: 24px
- Margin bottom: 24px

**Content:**
- **Heading:** "Hours of Operation"
- **Status:** "Open Now · Closes 9:00 PM"
  - Green dot indicator
- **Hours List:**
  - Day | Hours
  - GD Business Hours widget (if available)
  - Or GD Custom Fields

**Style:**
- Day: Bold
- Hours: Regular
- Spacing: 12px between days

---

### Section 3.3: Location/Map

**Container:**
- White background
- Rounded corners
- Padding: 24px
- Margin bottom: 24px

**Content:**
- **Heading:** "Location"
- **GD Map Widget:**
  - Compact size
  - Rounded corners
  - Height: 200-250px
- **Buttons:**
  - "View Larger Map" (link)
  - "Get Directions" (button, teal)

---

### Section 3.4: Claim This Listing

**Container:**
- White background
- Rounded corners
- Padding: 24px
- Border: 2px solid teal (to stand out)

**Content:**
- **Heading:** "Own This Studio?"
- **Text:** Description
- **GD Claim Listing Button:**
  - Style: Teal background
  - White text
  - Icon: Checkmark
  - Full width button

---

## 🎨 Styling Guide

### Colors (Adapt to Your Brand):
- **Primary CTA:** Terracotta `#FF5733` (Book a Class)
- **Secondary:** Teal `#61948B` (Save, Share, buttons)
- **Text Dark:** `#2C3E3A`
- **Text Medium:** `#6B7C78`
- **Background:** White `#FFFFFF`
- **Card Background:** White with subtle shadow
- **Badges:** Green (verified), Pink/Terracotta (featured)

### Typography:
- **Headings:** Inter, Bold, 24-32px
- **Body:** Inter, Regular, 16px
- **Tagline:** Crimson Pro, Italic, 18px
- **Small Text:** Inter, Regular, 14px

### Spacing:
- **Section Gap:** 24-32px
- **Card Padding:** 24-32px
- **Element Gap:** 16px
- **Border Radius:** 8px (cards), 20px (pills)

---

## 🔧 GeoDirectory Widget Settings

### GD Post Title:
- HTML Tag: H1
- Font: Inter, Bold
- Size: 36-48px
- Color: Dark grey

### GD Post Images:
- Layout: Gallery
- Size: Large
- Columns: Custom (for hero layout)
- Show count: Yes ("+12 Photos")

### GD Post Rating:
- Show stars: Yes
- Show number: Yes
- Show count: Yes
- Style: Gold stars

### GD Post Categories:
- Display: As tags/pills
- Style: Custom CSS (see above)

### GD Map:
- Height: 250px
- Zoom: 15
- Style: Rounded corners

---

## 📱 Responsive Breakpoints

### Desktop (>1024px):
- Two columns (66/34)
- Full hero gallery
- 3-column amenities grid

### Tablet (768-1024px):
- Two columns (stack on small tablets)
- 2-column amenities grid
- Smaller hero images

### Mobile (<768px):
- Single column
- Stacked layout
- 1-column amenities
- Full-width buttons

---

## ✅ Build Checklist

### Hero Section:
- [ ] Breadcrumbs
- [ ] Image gallery (main + 2 smaller)
- [ ] Studio name (H1)
- [ ] Tagline
- [ ] Verified badge
- [ ] Featured badge
- [ ] Rating + location
- [ ] Status (open/closed)
- [ ] Action buttons (Book, Save, Share)

### Left Column:
- [ ] About section
- [ ] Yoga Styles pills
- [ ] Amenities grid
- [ ] Schedule (optional)
- [ ] Reviews section

### Right Column:
- [ ] Contact information
- [ ] Hours of operation
- [ ] Map
- [ ] Claim CTA

### Styling:
- [ ] Match brand colors
- [ ] Typography consistent
- [ ] Spacing correct
- [ ] Responsive on all devices

---

## 🚀 Quick Start Steps

1. **Open your blank Elementor template**
2. **Set preview content** to a real studio
3. **Start with Hero section** (most visible)
4. **Build left column** sections one by one
5. **Build right column** sidebar
6. **Style everything** to match design
7. **Test with multiple studios**
8. **Refine and polish**

---

**Ready to build?** Start with the Hero section - it's the most impactful!



