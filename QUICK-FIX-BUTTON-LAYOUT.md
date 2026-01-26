# QUICK FIX: Button Layout Issues

## Problem: Buttons are Stacked Vertically Instead of Horizontal

### Solution 1: If Buttons are in Separate Columns (Recommended)

1. **Edit page** in Elementor
2. **Select the Row** that contains both buttons
3. Go to **Layout** tab
4. Set **Columns Gap** to `16px`
5. Make sure:
   - Column 1 (Book a Class): **Width = Auto** (not 100%)
   - Column 2 (Save): **Width = Auto** (not 100%)
6. **Save** and view page

### Solution 2: If Buttons are in Same Column

1. **Select the Column** containing both buttons
2. Go to **Advanced** tab → **Custom CSS**
3. Paste this:

```css
selector {
    display: flex !important;
    flex-direction: row !important;
    gap: 16px !important;
    flex-wrap: wrap !important;
    align-items: center !important;
}
```

4. **Save** and view page

### Solution 3: Rebuild Button Row (If Above Don't Work)

1. **Delete** the current button row
2. **Add new Row** (2 columns)
3. **Column 1:** Add "Book a Class" button widget
4. **Column 2:** Add "Save" button widget
5. **Select Row** → Layout tab:
   - Columns Gap: `16px`
   - Column 1 Width: `Auto`
   - Column 2 Width: `Auto`
6. **Select each Column** → Advanced tab:
   - Padding: `0`
   - Margin: `0`
7. **Save** and view page

---

## Problem: "Share" Button is Generic Teal Button

### Fix: Replace with Share Buttons Widget

1. **Delete** the generic "Share" button widget
2. **Add** Elementor Share Buttons widget (in Widgets panel, search "Share")
3. **Configure:**
   - Select: Facebook, Twitter, LinkedIn
   - Style: Minimal
   - Icon Size: 20px
4. **Style Tab:**
   - Button Style: Minimal
   - Gap: 16px
5. **Advanced Tab → Custom CSS:**
   - Paste the orange social button CSS I provided
6. **Save** and view page

---

## Problem: Icons are Gray Instead of Sage/Teal

### Fix Each Icon Widget

1. **Click on each Icon widget** (Location, Hours, Phone, Email, etc.)
2. Go to **Style** tab
3. Set **Primary Color** to `#5F7470` (sage color)
4. **Save**

**OR** use Custom CSS on each Icon widget:

1. **Click Icon widget**
2. **Advanced** tab → **Custom CSS**
3. Paste:

```css
selector svg {
    fill: #5F7470 !important;
    color: #5F7470 !important;
}
```

---

## Test After Each Fix

1. **Save** the page
2. **View** on frontend
3. **Check** if buttons are horizontal
4. **Check** if share buttons are orange circular icons
5. **Check** if icons are sage color

---

## If Still Not Working

Take a screenshot of:
1. **Elementor editor** showing the button row structure
2. **Right-click** on a button → **Inspect Element**
3. Show me the HTML structure

This will help me give you exact instructions for your specific setup.

