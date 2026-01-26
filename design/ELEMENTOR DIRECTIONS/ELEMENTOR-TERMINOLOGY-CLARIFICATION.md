# Elementor Terminology Clarification
## Sections vs Containers

---

## ✅ Modern Elementor (3.0+) Uses CONTAINERS

**In current Elementor versions, you add CONTAINERS, not Sections.**

### How to Add a Container:
1. Click the **"+"** button (Add Container icon)
2. OR drag **"Container"** from the widget panel
3. OR right-click → **"Add Container"**

---

## 📐 Container Structure

```
Container (Full Width)
├── Container (Boxed, 1200px) - for content
│   ├── Container (2 columns: 70% / 30%)
│   │   ├── Widget (GD Post Images)
│   │   └── Widget (GD Post Images)
│   └── Container (2 columns: 66% / 34%)
│       ├── Widget (GD Post Title)
│       └── Widget (Buttons)
```

---

## 🔄 Old vs New Terminology

| Old Elementor (< 3.0) | Modern Elementor (3.0+) | What We'll Use |
|----------------------|------------------------|----------------|
| Section | Container | **Container** |
| Column | Container (with columns) | **Container** |
| Widget | Widget | **Widget** |

---

## ✅ Correct Steps for Hero Container

### Step 1: Add Container (Not Section!)
1. Click **"Add Container"** button (+ icon)
2. This creates your main hero container

### Step 2: Configure Container
1. Click the container (gear icon appears)
2. **Layout:**
   - **Content Width:** Full Width
   - **Height:** Minimum Height → 500px
   - **Background:** #F8FAFA

### Step 3: Add Nested Container for Images
1. Inside the first container, click **"Add Container"** again
2. This creates a nested container for your images
3. **Layout:**
   - **Content Width:** Boxed
   - **Boxed Width:** 1200px
   - **Columns:** 2 columns (70% / 30%)

### Step 4: Add Widgets
1. Click inside a container column
2. Search for widget (e.g., "GD Post Images")
3. Drag widget into container

---

## 🎯 Quick Reference

**To add structure:**
- Click **"Add Container"** (+ button)

**To add content:**
- Click **"Add Widget"** (search for widget name)

**To configure:**
- Click the container/widget → Gear icon → Settings panel

---

## 📝 Updated Guide Language

When the guide says:
- ❌ "Add Section" → ✅ **"Add Container"**
- ❌ "Add Column" → ✅ **"Add Container"** (then set to 2 columns)
- ✅ "Add Widget" → ✅ **"Add Widget"** (correct!)

---

**Bottom line:** In modern Elementor, everything is a Container. You nest containers to create layouts, then add widgets inside them.



