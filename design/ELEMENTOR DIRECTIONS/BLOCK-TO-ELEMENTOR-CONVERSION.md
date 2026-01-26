# Block Editor to Elementor Conversion Guide
## Converting GD>SINGLE Template from Blocks to Elementor

---

## 📋 Current Template Structure (Block Editor)

Your current GD>SINGLE template uses WordPress block editor with these blocks:

```html
<!-- wp:geodirectory/geodir-widget-notifications -->
<!-- wp:geodirectory/geodir-widget-post-images {"type":"slider"} -->
<!-- wp:geodirectory/geodir-widget-single-taxonomies -->
<!-- wp:geodirectory/geodir-widget-single-tabs -->
<!-- wp:geodirectory/geodir-widget-single-next-prev -->
```

---

## 🔄 Conversion Strategy

### Option 1: Replace Entire Template with Elementor (Recommended)
**Best for:** Full design control, matching your home page design

**Steps:**
1. Open GD>SINGLE template in Elementor Theme Builder
2. Delete/replace all existing block content
3. Build new Hero Container using Elementor widgets
4. Map existing functionality to Elementor widgets

### Option 2: Keep Blocks, Add Elementor Sections
**Best for:** Gradual migration, keeping existing functionality

**Steps:**
1. Keep existing blocks
2. Add Elementor sections above/below blocks
3. Style everything with CSS

---

## 🗺️ Block to Elementor Widget Mapping

### Current Block → Elementor Widget Equivalents

| Current Block | Elementor Widget | Notes |
|--------------|-----------------|-------|
| `geodir-widget-notifications` | **GD Post Notifications** (if available) | Or remove if not needed |
| `geodir-widget-post-images` | **GD Post Images** | Same functionality |
| `geodir-widget-single-taxonomies` | **GD Post Categories** | Shows categories/styles |
| `geodir-widget-single-tabs` | **GD Post Tabs** or **Custom Tabs** | Description, reviews, etc. |
| `geodir-widget-single-next-prev` | **GD Post Navigation** | Next/Previous studio links |

---

## 🏗️ Recommended Elementor Structure

### Section 1: Hero Container (NEW - Replace Images Block)
**Replace:** `geodir-widget-post-images` block  
**With:** Custom Hero Container using Elementor

**Widgets Needed:**
- GD Post Images widget (for hero gallery)
- GD Post Title widget (H1)
- GD Post Address widget
- GD Post Rating widget
- Custom HTML widget (for badges)
- Button widgets (Book, Save, Share)

### Section 2: Meta Bar (NEW)
**Add:** Horizontal meta bar below hero

**Widgets Needed:**
- GD Post Rating widget
- GD Post Categories widget (replaces taxonomies block)
- GD Distance widget
- Button widgets (Favorite, Share)

### Section 3: Main Content (Replace Tabs Block)
**Replace:** `geodir-widget-single-tabs` block  
**With:** Custom two-column layout

**Left Column:**
- GD Post Description widget
- GD Post Amenities widget
- GD Post Categories widget (styles)

**Right Column:**
- GD Contact Info widgets
- GD Business Hours widget
- GD Map widget
- Claim CTA button

### Section 4: Navigation (Keep or Replace)
**Keep:** `geodir-widget-single-next-prev` functionality  
**Replace with:** GD Post Navigation widget in Elementor

---

## 📝 Step-by-Step Conversion Process

### Step 1: Backup Current Template
1. Copy the current block code (you've already provided it)
2. Save it in a text file for reference
3. Note which blocks are essential vs. optional

### Step 2: Open Template in Elementor
1. Go to **WordPress Admin → Templates → Theme Builder**
2. Find **GD>SINGLE** template
3. Click **"Edit with Elementor"**

### Step 3: Clear/Replace Existing Content
**Option A: Clear Everything (Fresh Start)**
- Delete all existing sections/widgets
- Start building Hero Container from scratch

**Option B: Keep Blocks, Add Elementor Above**
- Add new Elementor sections at the top
- Keep existing blocks below (for now)
- Migrate blocks to Elementor gradually

### Step 4: Build Hero Container
Follow **HERO-CONTAINER-BUILD-GUIDE.md** but note:
- Replace `geodir-widget-post-images` block with Elementor GD Post Images widget
- Add new widgets that don't exist in blocks (Title, Address, Rating, Buttons)

### Step 5: Map Remaining Blocks
- **Taxonomies block** → GD Post Categories widget (in Meta Bar)
- **Tabs block** → Custom Elementor sections (Main Content)
- **Next/Prev block** → GD Post Navigation widget (at bottom)

---

## 🎯 Elementor Widget Names (GeoDirectory)

When searching in Elementor widget panel, look for:

- **GD Post Images** (replaces `geodir-widget-post-images`)
- **GD Post Title** (new - for H1)
- **GD Post Address** (new - for location)
- **GD Post Rating** (new - for stars/rating)
- **GD Post Categories** (replaces `geodir-widget-single-taxonomies`)
- **GD Post Description** (new - for content)
- **GD Post Tabs** (replaces `geodir-widget-single-tabs`)
- **GD Post Navigation** (replaces `geodir-widget-single-next-prev`)
- **GD Post Phone** (new)
- **GD Post Email** (new)
- **GD Post Website** (new)
- **GD Map** (new)
- **GD Business Hours** (new)

---

## ⚠️ Important Considerations

### Notifications Block
- `geodir-widget-notifications` - Usually shows admin/claim notifications
- **Decision:** Keep it? Remove it? Or add to Elementor if widget exists?
- **Recommendation:** Keep at top if it shows important messages, or remove if not needed

### Tabs Block Functionality
- `geodir-widget-single-tabs` likely contains:
  - Description tab
  - Reviews tab
  - Map tab
  - Other tabs
- **Decision:** Recreate tabs in Elementor or use separate sections?
- **Recommendation:** Use separate sections for better design control

### Image Slider Settings
- Current block uses `"type":"slider"` for images
- **Elementor:** GD Post Images widget should have slider/gallery options
- **Action:** Configure widget to match slider behavior

---

## ✅ Migration Checklist

### Before Starting:
- [ ] Backup current block template code
- [ ] Identify which blocks are essential
- [ ] Note any custom functionality in blocks
- [ ] Test current template on live site

### During Conversion:
- [ ] Open GD>SINGLE template in Elementor
- [ ] Decide: Clear all or keep blocks?
- [ ] Build Hero Container (replace images block)
- [ ] Add Meta Bar (replace taxonomies block)
- [ ] Build Main Content (replace tabs block)
- [ ] Add Navigation (replace next/prev block)
- [ ] Handle notifications block (keep/remove)

### After Conversion:
- [ ] Test on multiple studio pages
- [ ] Verify all GeoDirectory data populates
- [ ] Check mobile responsiveness
- [ ] Verify all links/buttons work
- [ ] Compare with old template functionality

---

## 🚀 Quick Start: Replace Images Block First

**Simplest approach:** Start by replacing just the images block with Hero Container

1. Open GD>SINGLE template in Elementor
2. Find the `geodir-widget-post-images` block
3. Replace it with Elementor Hero Container section
4. Build Hero Container following the guide
5. Keep other blocks for now
6. Migrate other blocks later

This gives you immediate visual improvement while maintaining existing functionality.

---

## 📚 Next Steps

1. **Decide on conversion approach** (full replacement vs. gradual)
2. **Open GD>SINGLE template in Elementor**
3. **Follow HERO-CONTAINER-BUILD-GUIDE.md** to build Hero Container
4. **Map remaining blocks** to Elementor widgets
5. **Test thoroughly** before going live

---

**Ready to convert?** Start with the Hero Container - it will have the biggest visual impact!



