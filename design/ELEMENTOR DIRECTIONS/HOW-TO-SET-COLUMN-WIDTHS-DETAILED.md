# How to Set Column Widths - Detailed Guide
## Step-by-Step: Setting 66% / 34% Column Widths

---

## 🎯 What You're Trying to Do

Set column widths for your Studio Info Container:
- Left Column: 66% width
- Right Column: 34% width

---

## ✅ Method 1: Click Column → Layout Tab → Width

### Step 1: Click the LEFT Column
1. **Click directly on the LEFT column** (not the container, the column itself)
2. You should see a **blue outline** around just that column
3. Settings panel opens on left automatically

### Step 2: Find Width Setting
1. In left settings panel, click **"Layout"** tab
2. Look for **"Width"** section
3. You might see:
   - A dropdown with options
   - An input field with percentage
   - A slider

### Step 3: Set Left Column to 66%
**Option A: Dropdown Method**
- Find **"Width"** dropdown
- Select **"Custom"** or **"%"**
- Enter: `66` or `66%`

**Option B: Input Field Method**
- Find **"Width"** input field
- Type: `66` or `66%`
- Press Enter or click outside

**Option C: Slider Method**
- If you see a slider, drag it to approximately 66%

### Step 4: Click the RIGHT Column
1. **Click directly on the RIGHT column**
2. Blue outline appears around right column
3. Settings panel updates

### Step 5: Set Right Column to 34%
1. **Layout tab** → **Width** section
2. Enter: `34` or `34%`

---

## ✅ Method 2: Using Column Handle/Drag

### If You See a Resize Handle:
1. **Hover over the border** between the two columns
2. You should see a **resize cursor** or **drag handle**
3. **Click and drag** the border left or right
4. Elementor will show percentages as you drag
5. Drag until left shows ~66% and right shows ~34%

---

## ✅ Method 3: Using Advanced CSS

If you can't find width settings:

### Left Column:
1. Click LEFT column
2. **Advanced tab** → **Custom CSS**
3. Add: `width: 66% !important;`

### Right Column:
1. Click RIGHT column
2. **Advanced tab** → **Custom CSS**
3. Add: `width: 34% !important;`

---

## 🔍 Where Exactly to Look

### In Layout Tab, Look For:
- **"Width"** dropdown
- **"Column Width"** input
- **"Flex"** → **"Width"** or **"Flex Basis"**
- **"Size"** option
- **"Custom Width"** field

### Common Locations:
1. **Layout tab** → **Width** section (most common)
2. **Layout tab** → **Flex** → **Width**
3. **Advanced tab** → **Custom CSS** (backup method)

---

## ⚠️ Troubleshooting

### Issue 1: Can't Click Column
**Solution:**
- Make sure container is set to **2 columns** first
- Try clicking directly on empty space in the column
- Try clicking near the column border

### Issue 2: Width Setting Not in Layout Tab
**Solution:**
- Check **Advanced tab** → **Custom CSS**
- Or look for **"Flex"** settings in Layout tab
- Some versions: Width is in **"Grid"** settings

### Issue 3: Width Shows Pixels, Not Percentages
**Solution:**
- Look for dropdown next to input (px/%/em)
- Change to **"%"**
- Then enter `66` or `34`

### Issue 4: Columns Don't Resize After Setting Width
**Solution:**
- Make sure you set BOTH columns (left AND right)
- Total should equal 100% (66% + 34% = 100%)
- Try saving and refreshing Elementor

---

## 📐 Visual Guide

```
1. Click LEFT column
   ↓
2. Left panel → Layout tab
   ↓
3. Find "Width" section
   ↓
4. Enter: 66%
   ↓
5. Click RIGHT column
   ↓
6. Left panel → Layout tab
   ↓
7. Find "Width" section
   ↓
8. Enter: 34%
```

---

## ✅ Quick Checklist

- [ ] Container is set to 2 columns
- [ ] Click LEFT column (blue outline appears)
- [ ] Layout tab → Width: 66%
- [ ] Click RIGHT column (blue outline appears)
- [ ] Layout tab → Width: 34%
- [ ] Both columns total 100%

---

## 🎯 Alternative: Describe What You See

If you still can't find it, tell me:
1. When you click a column, what tabs do you see? (Content, Style, Layout, Advanced?)
2. In Layout tab, what sections do you see?
3. Do you see any width-related settings at all?

---

**Try clicking each column individually and checking the Layout tab for a "Width" setting. If you don't see it, use the Advanced → Custom CSS method!**



