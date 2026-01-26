# Hero Container Build Guide
## Step-by-Step Elementor Instructions

**Target:** Single Studio Page Hero Section  
**Time Estimate:** 1-2 hours  
**Priority:** CRITICAL - First visual impression

---

## ⚠️ Important: Elementor Terminology

**In modern Elementor (3.0+), you add CONTAINERS, not Sections.**

- ✅ **"Add Container"** = Click the + button to add a container
- ✅ **"Add Widget"** = Search for and add widgets (like GD Post Images)
- ❌ **"Add Section"** = Old terminology (not used in modern Elementor)

**See ELEMENTOR-TERMINOLOGY-CLARIFICATION.md for details.**

---

## 🎯 What We're Building

A full-width hero section that includes:
- Studio hero image/gallery
- Studio name (H1)
- Address and location info
- Rating and badges
- Quick action buttons

---

## 📋 Prerequisites

Before starting:
- [ ] Elementor Pro is installed and active
- [ ] GeoDirectory plugin is installed and active
- [ ] GeoDirectory Elementor widgets are available
- [ ] **You have located the "GD>SINGLE" template in Elementor Theme Builder**
- [ ] You can access and edit the GD>SINGLE template
- [ ] A test studio page is available (e.g., Stretch Chi: `https://yoganearme.info/studios/stretch-chi/`)

**Template Location Confirmation:**
- Template Name: **GD>SINGLE**
- Location: **WordPress Admin → Templates → Theme Builder**
- Post Type: **gd_place** (GeoDirectory Places)
- Applies To: All single studio listing pages

---

## 🏗️ Step 1: Access the Template

### ✅ CORRECT METHOD: Edit via Elementor Theme Builder
**Template Name:** `GD>SINGLE`  
**Location:** WordPress Admin → Templates → Theme Builder

1. Go to **WordPress Admin → Templates → Theme Builder**
2. Look for template named **"GD>SINGLE"** (GeoDirectory Single Studio template)
3. Click **"Edit with Elementor"** on the GD>SINGLE template
4. This is the template that controls all single studio pages (`gd_place` post type)

**Important:** 
- This template applies to ALL single studio pages automatically
- Any changes you make will affect every studio listing
- Make sure you're editing the correct template before proceeding

### ⚠️ Current Template Uses Block Editor
**Note:** Your current template uses WordPress block editor (Gutenberg) with these blocks:
- `geodir-widget-notifications`
- `geodir-widget-post-images` (slider)
- `geodir-widget-single-taxonomies`
- `geodir-widget-single-tabs`
- `geodir-widget-single-next-prev`

**When you open in Elementor:**
- You may see these blocks converted to Elementor widgets
- OR you may need to replace them with Elementor widgets
- See **BLOCK-TO-ELEMENTOR-CONVERSION.md** for mapping guide

### Alternative: Verify Template Location
If you can't find "GD>SINGLE":
1. Go to **WordPress Admin → GeoDirectory → Settings → Pages**
2. Check the **"Details Page"** setting
3. Note the template name/location shown there
4. Then go to **Templates → Theme Builder** and find that template

---

## 📐 Step 2: Create Hero Container Structure

### 2.1 Add New Container
1. In Elementor, click **"Add Container"** button (+ icon) - this is your main hero container
2. Click the container (gear icon appears) to open settings
3. **Layout Settings:**
   - **Content Width:** Full Width
   - **Height:** Minimum Height
   - **Minimum Height:** 500px

**Note:** In modern Elementor (3.0+), you add **Containers**, not Sections. Containers can be nested and configured with columns.

### 2.2 Container Background
1. With container selected, go to **Style → Background**
2. **Background Type:** Classic
3. **Color:** `#F8FAFA` (light background) or White `#FFFFFF`
4. **Background Overlay:** None (for now)

### 2.3 Container Padding
1. With container selected, go to **Advanced → Padding**
2. **Padding:**
   - Top: `48px`
   - Bottom: `48px`
   - Left: `0px`
   - Right: `0px`

---

## 🖼️ Step 3: Add Hero Image Container

### 3.1 Add Container for Images
1. Inside the section, click **"Add Container"**
2. Set container to **Full Width**
3. **Layout Settings:**
   - **Content Width:** Boxed
   - **Boxed Width:** 1200px (max-width)
   - **Column Gap:** 16px

### 3.2 Configure Container for Two Columns
1. With the container selected, go to **Layout Settings**
2. **Columns:** Select **2 columns** layout
3. **Column Widths:** 
   - **Left Column:** 70% width
   - **Right Column:** 30% width
4. **Column Gap:** 16px

### 3.3 Add GD Post Images Widget (Left Column - 70%)
1. Click inside the **left column** of the container
2. Click **"Add Widget"** or search for **"GD Post Images"** widget
3. Drag it into the left column, OR click the widget name to add it

**Widget Settings:**
- **Layout:** Gallery
- **Image Size:** Large (or Full)
- **Columns:** 1 (for main hero image)
- **Show Image Count:** Yes (displays "+X Photos")
- **Link To:** Media File or Attachment Page

**Style Settings:**
- **Border Radius:** 8px (rounded corners)
- **Box Shadow:** Light shadow (optional)

### 3.4 Add GD Post Images Widget (Right Column - 30%)
1. Click inside the **right column** of the container
2. Click **"Add Widget"** and search for **"GD Post Images"** widget
3. Add it to the right column

**Widget Settings:**
- **Layout:** Gallery
- **Image Size:** Medium
- **Columns:** 1
- **Limit:** 2 (shows 2 smaller images stacked)

**Style Settings:**
- **Border Radius:** 8px
- **Gap:** 8px (between the two images)

---

## 📝 Step 4: Add Studio Information Container

### 4.1 Add New Container Below Images
1. Below the image container, click **"Add Container"**
2. Set to **Full Width**
3. **Content Width:** Boxed
4. **Boxed Width:** 1200px
5. **Column Gap:** 32px

### 4.2 Configure Container for Two Columns
1. With the container selected, go to **Layout Settings**
2. **Columns:** Select **2 columns** layout
3. **Column Widths:**
   - **Left Column:** 66% width (studio info)
   - **Right Column:** 34% width (action buttons)
4. **Column Gap:** 32px

---

## 🏷️ Step 5: Populate Left Column (Studio Info)

### 5.1 Add GD Post Title Widget
1. Click inside **Left Column**
2. Search for **"GD Post Title"** widget
3. Drag it in

**Content Settings:**
- **HTML Tag:** H1 (CRITICAL for SEO)
- **Link:** None (or Custom URL if needed)

**Typography Settings:**
- **Font Family:** Inter
- **Font Weight:** 700 (Bold)
- **Font Size:** 36px (Desktop), 28px (Tablet), 24px (Mobile)
- **Line Height:** 1.2
- **Color:** `#2C3E3A` (dark text)

**Spacing:**
- **Margin Bottom:** 8px

### 5.2 Add Studio Tagline/Description Excerpt
1. Add **"Text Editor"** or **"GD Post Description"** widget
2. Limit to 1-2 sentences (excerpt)

**Typography Settings:**
- **Font Family:** Crimson Pro (or Inter Italic)
- **Font Style:** Italic
- **Font Size:** 18px
- **Color:** `#6B7C78` (medium grey)
- **Line Height:** 1.5

**Spacing:**
- **Margin Bottom:** 16px

### 5.3 Add Badges Row (Verification/Featured)
1. Add **"HTML"** widget
2. Paste this code:

```html
<div class="studio-badges" style="display: flex; gap: 12px; margin-bottom: 16px;">
    <span class="badge verified" style="display: inline-block; padding: 6px 12px; background: #10B981; color: white; border-radius: 20px; font-size: 12px; font-weight: 600; text-transform: uppercase;">
        ✓ Verified
    </span>
    <span class="badge featured" style="display: inline-block; padding: 6px 12px; background: #FF5733; color: white; border-radius: 20px; font-size: 12px; font-weight: 600; text-transform: uppercase;">
        ⭐ Featured Studio
    </span>
</div>
```

**Note:** You can customize colors and add conditional logic later to show badges only when applicable.

### 5.4 Add Rating and Address Row
1. Add **"GD Post Rating"** widget

**Widget Settings:**
- **Show Stars:** Yes
- **Show Rating Number:** Yes
- **Show Review Count:** Yes
- **Star Color:** `#FBBF24` (gold)

**Typography:**
- **Font Size:** 16px
- **Color:** `#2C3E3A`

2. Add **"GD Post Address"** widget right after rating

**Widget Settings:**
- **Show Icon:** Yes (location pin)
- **Format:** Full Address

**Typography:**
- **Font Size:** 16px
- **Color:** `#6B7C78`

**Spacing:**
- **Margin Left:** 16px (if inline with rating)

### 5.5 Add Opening Hours Status
1. Add **"GD Business Hours"** widget or **"Text Editor"** widget
2. Display current status: "Open Now · Closes 9:00 PM"

**Typography:**
- **Font Size:** 14px
- **Color:** `#10B981` (green for open) or `#EF4444` (red for closed)
- **Font Weight:** 600

---

## 🔘 Step 6: Populate Right Column (Action Buttons)

### 6.1 Add Button Container
1. Click inside **Right Column**
2. Add **"Container"** widget (or use column directly)

### 6.2 Add "Book a Class" Button
1. Add **"Button"** widget
2. **Content:**
   - **Text:** "Book a Class"
   - **Link:** GD Custom Field (website URL) or Custom URL
   - **Icon:** Calendar icon (optional)

**Style Settings:**
- **Background Color:** `#FF5733` (terracotta)
- **Text Color:** White
- **Border Radius:** 8px
- **Padding:** 14px 24px
- **Font Weight:** 600
- **Font Size:** 16px

**Hover:**
- **Background Color:** `#E0462A` (darker terracotta)
- **Transform:** Translate Y -2px (slight lift)

**Spacing:**
- **Margin Bottom:** 12px

### 6.3 Add "Save" Button
1. Add another **"Button"** widget
2. **Content:**
   - **Text:** "Save" or "Favorite"
   - **Link:** GD Favorite/Bookmark functionality
   - **Icon:** Heart or Bookmark icon

**Style Settings:**
- **Background Color:** `#61948B` (teal)
- **Text Color:** White
- **Border Radius:** 8px
- **Padding:** 14px 24px

**Spacing:**
- **Margin Bottom:** 12px

### 6.4 Add "Share" Button
1. Add another **"Button"** widget
2. **Content:**
   - **Text:** "Share"
   - **Link:** Share functionality (can use JavaScript)
   - **Icon:** Share icon

**Style Settings:**
- **Background Color:** `#61948B` (teal)
- **Text Color:** White
- **Border Radius:** 8px
- **Padding:** 14px 24px

---

## 🎨 Step 7: Apply Brand Styling

### 7.1 Typography Consistency
Ensure all text uses:
- **Headings:** Inter, Bold (700)
- **Body:** Inter, Regular (400)
- **Accents:** Crimson Pro, Italic

### 7.2 Color Application
- **Primary Text:** `#2C3E3A`
- **Secondary Text:** `#6B7C78`
- **Primary CTA:** `#FF5733` (terracotta)
- **Secondary CTA:** `#61948B` (teal)
- **Background:** `#F8FAFA` or White

### 7.3 Spacing Consistency
- **Section Padding:** 48px top/bottom
- **Container Max Width:** 1200px
- **Column Gap:** 32px
- **Element Margins:** 16px between elements

---

## 📱 Step 8: Mobile Responsiveness

### 8.1 Hero Image Container (Mobile)
1. Select the image container
2. Go to **Responsive → Mobile**
3. **Layout:** Stack columns vertically
4. **Left Column:** 100% width
5. **Right Column:** 100% width (below)

### 8.2 Studio Info Container (Mobile)
1. Select the studio info container
2. **Responsive → Mobile:**
   - **Layout:** Stack columns
   - **Left Column:** 100% width
   - **Right Column:** 100% width (below)

### 8.3 Typography Adjustments (Mobile)
- **H1 Title:** 28px → 24px
- **Tagline:** 16px → 14px
- **Buttons:** Full width on mobile

### 8.4 Button Stacking (Mobile)
1. Select button container
2. **Responsive → Mobile:**
   - **Display:** Block
   - **Width:** 100%
   - **Margin:** 8px between buttons

---

## ✅ Step 9: Testing Checklist

Before moving on, verify:
- [ ] Hero images display correctly
- [ ] Studio name appears as H1
- [ ] Address displays correctly
- [ ] Rating shows stars and number
- [ ] Badges display (if applicable)
- [ ] Buttons are clickable and styled
- [ ] Mobile layout stacks properly
- [ ] All GeoDirectory data populates
- [ ] Colors match brand guidelines
- [ ] Typography is consistent

---

## 🔧 Step 10: Advanced Customization (Optional)

### 10.1 Add Breadcrumbs
1. Add **"Breadcrumbs"** widget above hero section
2. Style: Small text, grey color

### 10.2 Add Distance Display
1. Add **"GD Distance"** widget
2. Display: "📍 329 feet away" format

### 10.3 Add Custom CSS
If you need additional styling, add to **Advanced → Custom CSS**:

```css
/* Hero Section Custom Styles */
.studio-hero-section {
    position: relative;
}

.studio-badges .badge {
    transition: transform 0.2s ease;
}

.studio-badges .badge:hover {
    transform: translateY(-2px);
}

/* Button hover effects */
.elementor-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
```

---

## 📝 Next Steps

After completing the Hero Container:
1. ✅ Mark Hero Container task as complete
2. → Move to **Meta Bar Container** (next task)
3. → Then **Main Content Container**

---

## 🆘 Troubleshooting

### Images Not Showing
- Check GeoDirectory post has images uploaded
- Verify widget settings (image size, layout)
- Clear cache

### Widgets Not Available
- Ensure GeoDirectory Elementor integration is active
- Check plugin compatibility
- May need GeoDirectory Pro for some widgets

### Styling Not Applying
- Check Elementor cache (clear it)
- Verify CSS specificity
- Check for conflicting theme styles

### Mobile Layout Issues
- Use Elementor's responsive mode to test
- Adjust breakpoints if needed
- Ensure columns stack on mobile

---

**Ready to build?** Start with Step 1 and work through each section methodically. Take your time - this is the foundation for the entire page!

