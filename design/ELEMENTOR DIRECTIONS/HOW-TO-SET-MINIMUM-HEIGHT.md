# How to Set Minimum Height in Elementor
## Step-by-Step Instructions

---

## ✅ Important: Minimum Height is Set on CONTAINERS, Not Widgets

**Minimum Height** is a container property, not a widget property.

---

## 📐 Step-by-Step: Setting Minimum Height

### Step 1: Select the Container (Not the Widget)
1. Click on the **container** itself (the outer box that holds your widgets)
2. You should see a blue outline around the container
3. A gear icon (⚙️) should appear - click it to open settings

### Step 2: Open Layout Settings
1. In the left settings panel, click **"Layout"** tab
2. Look for **"Height"** section

### Step 3: Set Minimum Height
1. Find **"Height"** dropdown
2. Select **"Minimum Height"** from the dropdown
3. Enter value: **500px** (or your desired height)
4. Click outside to save

---

## 🎯 Where to Find It

**Path:** Container → Gear Icon → Layout Tab → Height Section → Minimum Height

**Visual Guide:**
```
1. Click Container (blue outline appears)
2. Click Gear Icon (⚙️) 
3. Click "Layout" tab (left panel)
4. Scroll to "Height" section
5. Dropdown: Select "Minimum Height"
6. Input: Enter "500px"
```

---

## ⚠️ If You Don't See "Height" Option

### Possible Reasons:
1. **You're looking at widget settings, not container settings**
   - Solution: Click the container (outer box), not the widget inside

2. **Layout tab is collapsed**
   - Solution: Expand the "Layout" section in the left panel

3. **Different Elementor version**
   - Solution: Look for "Height" or "Min Height" in Layout settings
   - Alternative: Check "Advanced" tab → Custom CSS

### Alternative Method (If Height Option Missing):
1. Select container
2. Go to **"Advanced"** tab
3. Go to **"Custom CSS"** section
4. Add: `min-height: 500px;`

---

## 📝 Quick Reference

**Container Settings:**
- ✅ Height (Minimum Height, Fit to Screen, etc.)
- ✅ Content Width (Full Width, Boxed)
- ✅ Columns (1, 2, 3, etc.)
- ✅ Column Gap

**Widget Settings:**
- ❌ Height (not available)
- ✅ Width (in some widgets)
- ✅ Padding/Margin
- ✅ Typography, Colors, etc.

---

## 🎯 For Your Hero Container

**What to Set Minimum Height On:**
- ✅ **Main Hero Container** (the outermost container) → 500px minimum height
- ❌ **NOT** on GD Post Images widget
- ❌ **NOT** on inner containers (unless you want them taller)

**Why:**
- Ensures hero section has consistent height
- Prevents content from collapsing
- Creates visual space

---

**Still can't find it?** Try:
1. Make sure you clicked the container (not widget)
2. Check "Layout" tab is open
3. Look for "Height" dropdown
4. If still missing, use Custom CSS method above



