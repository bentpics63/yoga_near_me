# Single Studio Page Design Plan
## Then Match Listing Page to This Design

---

## ✅ How GeoDirectory Works (Data Auto-Populates)

**Important**: We're NOT creating new pages. We're **customizing existing GeoDirectory templates** so data populates automatically.

### How It Works:
1. **GeoDirectory has built-in templates** for single studio pages
2. **Data populates automatically** from your database
3. **We customize the styling/layout** to match your brand
4. **All studios use the same template** - one design, infinite studios

### Where to Customize:
- **Option 1**: Customize via WordPress admin (GeoDirectory Settings → Pages → Details Page)
- **Option 2**: Copy template files to your theme folder (more control)
- **Option 3**: Use CSS to override default styles (quickest)

---

## 🎨 Single Studio Page Design Plan

### Current State
- Basic GeoDirectory default template
- Functional but not branded
- Doesn't match your home page design

### Target Design (Match Your Home Page)
- ✅ Same color scheme (sage, teal, terracotta)
- ✅ Same typography (Inter, Crimson Pro)
- ✅ Card-based layout
- ✅ Professional, clean, yoga-focused aesthetic

---

## 📋 Single Studio Page Sections to Design

### 1. **Hero Section**
**What to show:**
- Studio name (large, prominent)
- Address with distance
- Quick stats: Phone, Website, Hours
- Hero image/gallery

**Design:**
```
┌─────────────────────────────────────┐
│  [Studio Image/Photo Gallery]        │
│                                       │
│  Studio Name                          │
│  410 S Michigan Ave, Chicago, IL     │
│  📍 329 feet away                    │
│                                       │
│  [Phone] [Website] [Directions]      │
└─────────────────────────────────────┘
```

### 2. **Studio Info Section**
**What to show:**
- Description
- Yoga styles offered
- Amenities (Parking, Props, Mats, etc.)
- Class schedule (if available)
- Pricing info

**Design:**
- Card-based layout
- Icons for amenities
- Clean typography
- Match your home page style

### 3. **Map Section**
**What to show:**
- Interactive map
- Directions link
- Nearby studios (optional)

**Design:**
- Full-width or sidebar
- Styled to match your brand
- Clear "Get Directions" CTA

### 4. **Reviews Section** (if applicable)
**What to show:**
- Reviews/ratings
- Links to Google, Yelp, Facebook reviews

**Design:**
- Clean, readable
- Match your brand colors

### 5. **Related Studios Section**
**What to show:**
- Other studios in the area
- Similar style studios

**Design:**
- Card grid (like your home page cities grid)
- "View More Studios" CTA

---

## 🛠️ Implementation Approach

### Step 1: Design Single Studio Page (Do This First)

**Method A: CSS Override (Fastest - Start Here)**
- Add custom CSS to style GeoDirectory's default template
- Target existing classes: `.geodir-post`, `.geodir-content`, etc.
- Pros: Quick, no template changes
- Cons: Limited control

**Method B: Template Override (Best Control)**
- Copy GeoDirectory template files to your theme
- Customize HTML structure
- Pros: Full control, matches your design exactly
- Cons: More work, need to maintain

**Method C: Page Builder (Elementor/Divi)**
- Use GeoDirectory widgets in Elementor
- Build custom layout visually
- Pros: Visual editing, easy updates
- Cons: May need Pro version

### Step 2: Match Listing Page to Studio Page Design

Once single studio page is designed:
- Use same color scheme
- Use same card styles (but smaller for list view)
- Use same typography
- Use same spacing/layout principles
- Create consistent "studio card" component

---

## 🎯 Design Elements to Match

### Colors
- Primary: `#5F7470` (sage)
- Secondary: `#61948B` (teal)
- Accent: `#FF5733` (terracotta)
- Background: `#F8FAFA` (light)
- Text: `#2C3E3A` (dark)

### Typography
- Headings: Inter, 700 weight
- Body: Inter, 400 weight
- Accent: Crimson Pro, italic

### Components
- Buttons: Match home page button styles
- Cards: Same border-radius, shadows, hover effects
- Icons: Font Awesome (already in use)
- Spacing: Same spacing scale (--space-md, --space-lg, etc.)

---

## 📝 Quick Start Checklist

### Phase 1: Single Studio Page
- [ ] Review current single studio page
- [ ] Identify GeoDirectory template location
- [ ] Create custom CSS file (or template override)
- [ ] Style hero section
- [ ] Style info section
- [ ] Style map section
- [ ] Test on multiple studios
- [ ] Mobile responsive check

### Phase 2: Listing Page
- [ ] Apply same color scheme
- [ ] Create studio card component
- [ ] Style listing grid
- [ ] Match typography
- [ ] Add filters panel (styled)
- [ ] Test pagination
- [ ] Mobile responsive check

---

## 🚀 Recommended Starting Point

**I recommend starting with CSS override** because:
1. ✅ Fastest to implement
2. ✅ No risk of breaking functionality
3. ✅ Easy to test and iterate
4. ✅ Can upgrade to template override later if needed

**Then we can:**
1. Create custom CSS file matching your home page
2. Test on a single studio page
3. Refine until it looks perfect
4. Apply same styles to listing page
5. Create reusable "studio card" component

---

## 📂 Files We'll Create

1. **`single-studio-custom.css`** - Styles for single studio page
2. **`listing-page-custom.css`** - Styles for listing/search page
3. **`studio-card-component.css`** - Reusable card styles (used on both)

---

## ❓ Questions to Answer First

1. **Do you have a sample studio page URL** I can look at?
2. **Are you using Elementor** or another page builder?
3. **What's your preferred method**: CSS override, template override, or page builder?
4. **Any specific design elements** you want to highlight? (images, reviews, schedules, etc.)

---

## 🎨 Design Inspiration

Based on your home page, the single studio page should have:
- Clean, spacious layout
- Professional typography
- Subtle hover effects
- Clear CTAs (not pushy)
- Beautiful imagery
- Easy-to-scan information

---

**Next Steps:**
1. Share a sample studio page URL (if you have one)
2. I'll create the CSS file to style it
3. We'll test and refine
4. Then apply to listing page

Would you like me to:
- **A)** Create CSS override file now (I'll target common GeoDirectory classes)
- **B)** Wait for you to share a studio page URL first
- **C)** Create a template override instead



