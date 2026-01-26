# City Hub & Style-in-City Templates
## Implementation Guide

---

## 📋 Quick Reference

**Two templates provided:**
1. **City Hub** (`best-yoga-studios-city-hub-template.html`) — For `/best-yoga-studios/[city]/`
2. **Style-in-City** (`best-style-yoga-in-city-template.html`) — For `/best-yoga-studios/[city]/[style]/`

---

## 🎨 Design Philosophy Implemented

✅ **Calm, Optimistic, Excited**
- Full-width images within 1200px container (load speed optimized)
- Massive whitespace between sections
- Warm gold accents (#FBBF24) for links only—never pushy buttons
- 3-paragraph magazine copy (editorial tone)
- Minimal CTAs (1-2 per page)
- Roboto font throughout (mobile-friendly)

✅ **Images Are the Hero**
- Studio images 16:9 aspect ratio
- Full-width in container, responsive on mobile
- Hover effects subtle (slight scale + border highlight)

✅ **Subtle Studio CTAs**
- "About [Studio Name]" as small text link (not a button)
- Styled in warm gold, placed at end of each studio card
- Feels editorial, not salesy

---

## 🛠️ How to Use in Elementor

### Step 1: Create New Page in GeoDirectory
- URL: `/best-yoga-studios/austin/` (City Hub) or `/best-yoga-studios/austin/vinyasa-yoga/` (Style-in-City)

### Step 2: Add Elementor → HTML Widget
- Copy the entire template HTML into an Elementor **HTML widget**
- (Don't use Elementor's page builder—you're pasting pre-built HTML)

### Step 3: Replace Placeholders
All placeholders are in `{{DOUBLE-BRACES}}`. Examples:

```
{{CITY}}              → Austin
{{CITY-SLUG}}         → austin
{{STYLE}}             → Vinyasa
{{STYLE-SLUG}}        → vinyasa-yoga
{{YEAR}}              → 2025
{{NEIGHBORHOOD}}      → Downtown / South Austin
{{STUDIO-1-NAME}}     → The Yoga Loft
{{STUDIO-1-SLUG}}     → the-yoga-loft
{{ADDRESS-1}}         → 123 Main St, Suite 200
{{STUDIO-1-IMAGE-URL}} → https://yourcdn.com/studio-1.jpg
```

### Step 4: Add GeoDirectory Shortcodes (Separate Widget)
The templates include **comments** showing where to add GeoDirectory:

```html
<!-- 
  ADD ELEMENTOR SHORTCODE WIDGET HERE with:
  [gd_map post_type="gd_place" show_filters="1" 
   search_filter="1" filter_button="1" layout="1" 
   mapzoom="12" geodir_location_name="{{CITY}}" 
   category="{{STYLE-SLUG}}"]
-->
```

**Do this:**
1. Below the HTML widget, add a new **Elementor Shortcode widget**
2. Paste the shortcode(s) shown in the comment
3. For **City Hub**: use `geodir_location_name="Austin"` (no style filter)
4. For **Style-in-City**: use both `geodir_location_name="Austin"` AND `category="vinyasa-yoga"` (filters by style)

---

## 📝 City Hub Template — What to Fill In

**Hero Section:**
- H1: "Best Yoga Studios in {{CITY}}"
- Deck: 2-3 sentences about {{CITY}}'s yoga scene
- CTAs: "Browse All {{CITY}} Studios" and "Compare Styles"

**Top Styles Section (3 Cards):**
Each card needs:
- Image URL (`{{VINYASA-IMAGE-URL}}`)
- Style name (`{{VINYASA}}`)
- 1-2 sentence description
- Link to style-in-city page (auto-populated if you use {{CITY-SLUG}} and {{STYLE-SLUG}})

**Curated Top Studios (List):**
- 3-7 studios with:
  - Studio name
  - Neighborhood
  - 1-line "best for" descriptor
  - Link to studio page

**City Context Section:**
- 3 paragraphs describing why yoga thrives in {{CITY}}
- Local neighborhoods, character, demographics
- Why students choose studios here

---

## 📸 Style-in-City Template — What to Fill In

**Hero Section:**
- H1: "Best {{STYLE}} Yoga in {{CITY}}"
- Deck: 2 sentences about {{STYLE}} in {{CITY}}
- CTAs: Link to "12 Benefits of {{STYLE}}" and back to City Hub

**Intro Box:**
- "New to {{STYLE}}?" educational callout
- Links to your Style Guide + Benefits page

**Studio Cards (Top 7):**
Each card has:
- Full-width image (16:9)
- Studio name + neighborhood
- **Paragraph 1:** Location, studio intro, specific philosophy
- **Paragraph 2:** What makes them special, teaching approach, amenities
- **Paragraph 3:** Who this serves, why they choose this studio, neighborhood context
- "Best for:" line (italicized)
- "About [Studio]" link (subtle gold text link)

**Live Directory Section:**
- Brief note about filters
- Shortcode widgets for map + list (inserted separately)

---

## 🔗 Linking Strategy

### From City Hub:
- Style card links → `/best-yoga-studios/{{CITY-SLUG}}/{{STYLE-SLUG}}/`
- Primary CTA → `/location/{{CITY-SLUG}}/` (GeoDirectory city page)
- Studio list items → `/studios/{{CITY-SLUG}}/{{STUDIO-SLUG}}/`

### From Style-in-City:
- Hero buttons → `/yoga-styles/{{STYLE-SLUG}}/` and `/yoga-styles/{{STYLE-SLUG}}/{{STYLE-SLUG}}-yoga-12-benefits/`
- "About [Studio]" → `/studios/{{CITY-SLUG}}/{{STUDIO-SLUG}}/`
- Back button → `/best-yoga-studios/{{CITY-SLUG}}/`
- Footer nav → Both guides above

### Schema (Breadcrumbs):
Both templates include breadcrumb schema. URLs auto-populate if you use the {{SLUGS}} correctly.

---

## 🎨 Design Decisions Made

| Element | Style | Why |
|---------|-------|-----|
| Images | 1200px max-width | Load speed + readability |
| Image ratio | 16:9 | Standard, works well on all devices |
| Hero CTA | Warm gold button | Warm, optimistic, inviting (not urgent) |
| Studio CTA | Small gold text link | Editorial, subtle, "not salesy" |
| Whitespace | Generous | Calm, breathing room between sections |
| Font | Roboto throughout | Mobile-optimized, readable |
| Color accents | Gold (#FBBF24) only | Pop of optimism, but not aggressive |
| Borders | Light gray (#E5E7EB) | Minimal, subtle structure |
| Headings | Sage (#5F7470) | Grounding, professional |
| Body text | Dark ink (#1a1a1a) | High contrast, readable |

---

## 📱 Mobile Behavior

- **Hero text**: Scales down gracefully (clamp values)
- **Images**: Full-width, maintain 16:9 aspect ratio
- **Cards**: 1 column on mobile (<640px), 2-3 on tablet/desktop
- **Typography**: Font sizes use `clamp()` for fluid scaling
- **CTAs**: Flex-wrap to stack on small screens

All responsive without media query breakpoints (modern CSS approach).

---

## 🚀 Quick Start Checklist

- [ ] Create new GeoDirectory page (or Elementor page)
- [ ] Add Elementor HTML widget
- [ ] Paste template HTML
- [ ] Replace all {{PLACEHOLDERS}} with real data
- [ ] Add image URLs for studio photos
- [ ] Add Elementor Shortcode widget below for GeoDirectory map/list
- [ ] Test on mobile
- [ ] Add internal links in your menu to point to City Hub pages
- [ ] Set up breadcrumbs (schema is already in template)

---

## ❓ FAQ

**Q: Can I use different colors?**
A: Yes. The CSS uses `--css-variables` at the top. Change:
```css
--warm-gold: #FBBF24;
--sage: #5F7470;
--teal: #61948B;
```
to your preferred colors.

**Q: Can I add more studios?**
A: Yes. The templates show 2-3 examples. Copy/paste the card pattern for up to 7 studios per page. Adjust image paths and copy.

**Q: How do I add the GeoDirectory shortcodes?**
A: Don't put them in the HTML widget (HTML widgets don't execute shortcodes). Add a separate **Elementor Shortcode widget** directly below the HTML widget with the shortcode pasted in.

**Q: Should I customize the copy?**
A: Absolutely. The templates use placeholder paragraphs. Replace with your own voice using the YNM writing style guide (welcoming, authentic, yoga-focused).

**Q: Can I use this with other builders (not Elementor)?**
A: Yes—it's just HTML + CSS. Paste it into any HTML/code widget and adjust URLs/placeholders.

---

## 📞 Troubleshooting

**Images not showing?**
- Check URLs are correct and accessible
- Make sure image filenames don't have special characters

**GeoDirectory not appearing?**
- Make sure you added it as a **Shortcode widget**, not in the HTML widget
- Verify shortcode parameters match your GeoDirectory setup
- Check that studio categories/taxonomies match `category="vinyasa-yoga"`

**Links not working?**
- Verify {{CITY-SLUG}} and {{STYLE-SLUG}} are lowercase with hyphens
- Make sure pages exist at those URLs before linking

**Styling looks off?**
- Check that no conflicting CSS from your theme is overriding styles
- The template uses namespaced classes (`.ynm-city`, `.ynm-sc`) to avoid conflicts
- Inspect in browser to see if styles are applying

---

## 🎯 What's Next?

1. **Test with first city** (e.g., Austin + Vinyasa)
2. **Duplicate template** for next style
3. **Create City Hub** aggregating top 3 styles
4. **Link everything together** (City → Styles → Benefits)
5. **Track performance** (dwell time, clicks to GeoDirectory, rankings for "best [style] in [city]")

---

Created: November 2025 | YNM Style Guide Edition
