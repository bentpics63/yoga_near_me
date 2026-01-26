# Hero Row Structure - Step by Step

## Understanding the Elements

**Badges (NOT buttons):**
- ✓ VERIFIED (teal badge) - Created by PHP, appears automatically
- FEATURED STUDIO (orange badge) - Created by PHP, appears automatically

**Buttons:**
- Book a Class (orange button)
- Save (teal button)
- Share buttons (Facebook, Twitter, LinkedIn - orange circular icons)

---

## Target Layout

```
[VERIFIED] [FEATURED]    Studio Title    [Book a Class] [Save] [Share Buttons]
                          Tagline
                          Rating | Location | Hours
```

**Left Side:** Badges + Title + Info
**Right Side:** Action buttons (horizontal row)

---

## Elementor Structure to Build

### Step 1: Create the Main Row

1. **Add Section** → Full Width
2. **Content Width:** Boxed (1200px max)
3. **Add Row** → 2 columns (Auto | Auto)
4. **Columns Gap:** 24px
5. **Align:** Space Between (so left content stays left, buttons stay right)

### Step 2: Left Column (Auto width)

**This column contains:**
- Badges (appear automatically via PHP)
- GD>Post Title widget
- Text widget (tagline)
- Row with rating/location/hours

**Structure:**
```
Column 1 (Auto width, align left)
├── Badges (appear automatically - no widget needed)
├── GD>Post Title Widget
├── Text Widget (Tagline - italic)
└── Row (3 columns: Auto | Auto | Auto)
    ├── Column: GD>Post Rating Widget
    ├── Column: Icon + Text (Location)
    └── Column: Icon + Text (Hours)
```

**Settings for Column 1:**
- Width: Auto
- Content Position: Top
- Horizontal Align: Left
- Vertical Align: Top

### Step 3: Right Column (Auto width)

**This column contains:**
- Row with buttons (horizontal)

**Structure:**
```
Column 2 (Auto width, align right)
└── Row (3 columns: Auto | Auto | Auto)
    ├── Column: Button Widget "Book a Class"
    ├── Column: Button Widget "Save"
    └── Column: Share Buttons Widget
```

**Settings for Column 2:**
- Width: Auto
- Content Position: Top
- Horizontal Align: Right
- Vertical Align: Top

**Settings for Button Row (inside Column 2):**
- Columns Gap: 16px
- Column widths: All Auto (not 100%)
- Height: Auto

---

## Detailed Steps

### A. Set Up Main Row

1. **Select the main Row** (2 columns)
2. **Layout Tab:**
   - Columns Gap: `24px`
   - Content Width: Full Width
   - Height: Auto
3. **Advanced Tab:**
   - Display: Flex
   - Justify Content: Space Between
   - Align Items: Flex Start

### B. Left Column Setup

1. **Select Column 1** (left column)
2. **Layout Tab:**
   - Width: Auto (or 50%)
   - Content Position: Top
   - Horizontal Align: Left
3. **Advanced Tab:**
   - Padding: `0`
   - Margin: `0`

**Add widgets in this order:**
1. **GD>Post Title** widget (badges appear above automatically)
2. **Text Editor** widget (tagline - set to italic)
3. **Row** (3 columns for rating/location/hours)

### C. Right Column Setup (Buttons Row)

1. **Select Column 2** (right column)
2. **Layout Tab:**
   - Width: Auto (or 50%)
   - Content Position: Top
   - Horizontal Align: Right
3. **Advanced Tab:**
   - Padding: `0`
   - Margin: `0`

**Inside Column 2, add a Row:**
1. **Add Row** (3 columns)
2. **Layout Tab:**
   - Columns Gap: `16px`
   - Height: Auto
3. **Column 1:** Add Button Widget "Book a Class"
4. **Column 2:** Add Button Widget "Save"
5. **Column 3:** Add Share Buttons Widget

**For each button column:**
- Width: Auto (not 100%)
- Content Position: Top
- Horizontal Align: Left

**For each Button Widget:**
- Width: Auto (not 100%)
- Align: Left

---

## If Badges Don't Appear

The badges are created by PHP code in `functions.php`. They should appear automatically above the studio title.

**To check:**
1. Make sure PHP code is in `functions.php`
2. Clear cache
3. View page source - look for `<div class="studio-badges">`

**If badges don't appear:**
- Check PHP code is active
- Check that `studio_verified` and `studio_featured` fields have values
- Check browser console for PHP errors

---

## Alternative: If Buttons Won't Stay Horizontal

If buttons still stack vertically, add this CSS to the **button row**:

1. **Select the Row** containing buttons
2. **Advanced Tab → Custom CSS**
3. Paste:

```css
selector {
    display: flex !important;
    flex-direction: row !important;
    gap: 16px !important;
    flex-wrap: wrap !important;
    align-items: center !important;
    justify-content: flex-end !important;
}

selector .elementor-column {
    width: auto !important;
    flex: 0 0 auto !important;
}
```

---

## Visual Reference

```
┌─────────────────────────────────────────────────────────────┐
│ Section: Full Width, Boxed Content                           │
│                                                               │
│ ┌─────────────────────────┐  ┌──────────────────────────┐   │
│ │ Column 1 (Auto, Left)   │  │ Column 2 (Auto, Right)   │   │
│ │                         │  │                          │   │
│ │ [VERIFIED] [FEATURED]   │  │  [Book] [Save] [Share]  │   │
│ │ Studio Title            │  │                          │   │
│ │ Tagline                 │  │                          │   │
│ │ Rating | Loc | Hours    │  │                          │   │
│ │                         │  │                          │   │
│ └─────────────────────────┘  └──────────────────────────┘   │
│                                                               │
└─────────────────────────────────────────────────────────────┘
```

---

## Quick Checklist

- [ ] Main row: 2 columns, Space Between alignment
- [ ] Left column: Auto width, Left align
- [ ] Right column: Auto width, Right align
- [ ] Button row inside right column: 3 columns, 16px gap
- [ ] Each button column: Auto width (not 100%)
- [ ] Each button widget: Auto width (not 100%)
- [ ] Share Buttons widget: Configured with Facebook, Twitter, LinkedIn

---

## Test

After building:
1. **Save** page
2. **View** frontend
3. **Check:**
   - Badges appear above title
   - Buttons are horizontal (not stacked)
   - Buttons align to the right
   - Share buttons are circular icons (not generic button)

If something's wrong, take a screenshot of the Elementor editor showing the structure and I'll help fix it!

