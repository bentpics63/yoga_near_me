# Single Studio Hero Section - Complete Implementation Guide
## Step-by-Step Instructions for Amateur Designers

This guide will walk you through implementing the hero section design for single studio pages, matching the Viveka Yoga Studio design exactly.

---

## 📋 **PREPARATION: What You'll Need**

Before starting, make sure you have:
- ✅ Access to WordPress admin dashboard
- ✅ Access to your WordPress theme's `functions.php` file (via FTP or File Manager)
- ✅ Access to WordPress Customizer → Additional CSS (or Elementor Custom CSS)
- ✅ Basic understanding of copying/pasting code
- ✅ A test studio page to preview changes

---

## 🎯 **DESIGN OVERVIEW**

The hero section includes:
1. **Image Gallery** (70% main image, 30% side images with "+X Photos" overlay)
2. **Badges** (✓ VERIFIED in teal, FEATURED STUDIO in orange)
3. **Studio Title** (large, bold, dark gray)
4. **Tagline** (italicized, below title)
5. **Action Buttons** (top-right: Book a Class, Save, Share)
6. **Rating** (gold stars + number + review count)
7. **Location** (map pin icon + address)
8. **Operating Hours** (clock icon + "Open · Closes X PM")

---

## 📝 **STEP 1: Add PHP Code for Badges, Tagline, and Status**

### **Step 1.1: Locate Your Theme's functions.php File**

1. Log into your WordPress admin dashboard
2. Navigate to **Appearance → Theme File Editor** (if available)
   - OR use FTP/File Manager to access: `/wp-content/themes/your-theme-name/functions.php`
   - OR if using a child theme: `/wp-content/themes/your-child-theme-name/functions.php`

### **Step 1.2: Add the Include Statement**

1. Open `functions.php` in a text editor
2. Scroll to the **very bottom** of the file (after all existing code)
3. Add this line:

```php
// Include single studio hero badges and enhancements
require_once get_stylesheet_directory() . '/../code/PHP ADDS/single-studio-hero-badges.php';
```

**⚠️ IMPORTANT:** 
- If the path doesn't work, you may need to adjust it based on your file structure
- Make sure there are no syntax errors (no missing semicolons, quotes, etc.)
- Save the file

### **Step 1.3: Upload the PHP Badges File**

1. Using FTP or File Manager, navigate to: `/wp-content/themes/your-theme-name/` (or your child theme folder)
2. Create a folder called `code` if it doesn't exist
3. Inside `code`, create a folder called `PHP ADDS` if it doesn't exist
4. Upload the file `single-studio-hero-badges.php` to `/wp-content/themes/your-theme-name/code/PHP ADDS/`

**Alternative:** If you can't create folders, copy the entire PHP code from the badges file and paste it directly into your `functions.php` file (before the closing `?>` tag, or at the end if there's no closing tag).

---

## 🎨 **STEP 2: Add CSS Styling**

### **Step 2.1: Access WordPress Customizer**

1. Log into WordPress admin
2. Go to **Appearance → Customize**
3. Click on **Additional CSS** (usually at the bottom of the left menu)

### **Step 2.2: Copy and Paste CSS**

1. Open the file `single-studio-hero-custom.css`
2. **Select ALL** the CSS code (Ctrl+A or Cmd+A)
3. **Copy** it (Ctrl+C or Cmd+C)
4. In WordPress Customizer → Additional CSS, **paste** all the CSS code
5. Click **Publish** button (top right)

**Alternative:** If using Elementor:
1. Go to **Elementor → Settings → Custom CSS**
2. Paste the CSS code there
3. Save changes

---

## 🔧 **STEP 3: Set Up Custom Fields for Badges**

### **Step 3.1: Install Custom Fields Plugin (if needed)**

If you don't have a way to add custom fields:
1. Install **Advanced Custom Fields (ACF)** plugin OR
2. Use **GeoDirectory's built-in custom fields** feature

### **Step 3.2: Create Custom Fields**

Create two custom fields for each studio:

**Field 1: Studio Verified**
- Field Name: `studio_verified`
- Field Type: Checkbox or True/False
- Default Value: Unchecked

**Field 2: Studio Featured**
- Field Name: `studio_featured`
- Field Type: Checkbox or True/False
- Default Value: Unchecked

**Field 3: Studio Tagline**
- Field Name: `studio_tagline`
- Field Type: Text or Textarea
- Default Value: (empty)

### **Step 3.3: Add Custom Fields to Studio Posts**

1. Edit a studio post (single studio listing)
2. Scroll down to find your custom fields section
3. Check "Studio Verified" if the studio is verified
4. Check "Studio Featured" if it's a featured studio
5. Enter a tagline in "Studio Tagline" field (e.g., "Where tradition meets transformation in the heart of Downtown LA")
6. **Save/Update** the post

---

## 🖼️ **STEP 4: Set Up Image Gallery Layout**

### **Step 4.1: Configure GeoDirectory Image Gallery**

1. Go to **GeoDirectory → Settings → General**
2. Find **Image Settings** section
3. Ensure **Multiple Images** is enabled
4. Set image sizes appropriately

### **Step 4.2: Add Images to Studio Listing**

1. Edit a studio post
2. Upload multiple images (at least 3)
3. The first image will be the main large image (70% width)
4. The next images will appear in the side gallery (30% width)

### **Step 4.3: Verify Image Count Overlay**

The CSS automatically adds "+X Photos" overlay. Make sure:
- Multiple images are uploaded to the studio listing
- The gallery widget is placed in the hero section template

---

## 🔘 **STEP 5: Set Up Action Buttons**

### **Step 5.1: Create Buttons in Elementor (if using Elementor)**

1. Edit the single studio page template in Elementor
2. Add a **Button widget** for "Book a Class"
   - Text: "Book a Class"
   - Icon: Calendar icon (📅 or Font Awesome)
   - Style: Orange background (#FF5733), white text
   - Link: Your booking URL
3. Add a **Button widget** for "Save"
   - Text: "Save"
   - Icon: Heart icon (❤️ or Font Awesome)
   - Style: Teal background (#61948B), white text
4. Add a **Button widget** for "Share"
   - Text: "Share"
   - Icon: Share icon (📤 or Font Awesome)
   - Style: Teal background (#61948B), white text

### **Step 5.2: Position Buttons**

1. In Elementor, create a **Column** layout
2. Place buttons in the **right column** (top-right area)
3. Align buttons to the **right** or **center**
4. Use Elementor's spacing controls to position them properly

**Alternative:** If not using Elementor, add buttons via HTML widget or shortcode in the appropriate template location.

---

## ⭐ **STEP 6: Configure Rating Display**

### **Step 6.1: Ensure GeoDirectory Rating Widget is Active**

1. Go to **GeoDirectory → Settings → General**
2. Verify **Reviews/Ratings** are enabled
3. Check that the rating widget appears on single studio pages

### **Step 6.2: Style Rating (CSS Already Added)**

The CSS automatically styles:
- Gold stars (color: #FBBF24)
- Rating number (bold, dark gray)
- Review count (lighter gray)

No additional setup needed if GeoDirectory rating widget is active.

---

## 📍 **STEP 7: Configure Location Display**

### **Step 7.1: Ensure Address is Set**

1. Edit a studio post
2. Fill in the **Address** field in GeoDirectory
3. Include: Street, City, State, ZIP Code
4. Save the post

### **Step 7.2: Verify Address Widget**

The address widget should automatically display with:
- Map pin icon (teal color: #61948B)
- Full address text

CSS styling is already applied.

---

## 🕐 **STEP 8: Set Up Operating Hours**

### **Step 8.1: Add Business Hours**

1. Edit a studio post
2. Find **Business Hours** field (GeoDirectory)
3. Enter hours in format: `Mo 09:00-17:00, Tu 09:00-17:00, We 09:00-17:00...`
   - Mo = Monday
   - Tu = Tuesday
   - We = Wednesday
   - Th = Thursday
   - Fr = Friday
   - Sa = Saturday
   - Su = Sunday
4. Format: `Day HH:MM-HH:MM` (24-hour format)
5. Save the post

### **Step 8.2: Verify Status Display**

The PHP code automatically:
- Detects if studio is currently open
- Shows "Open · Closes X PM" if open
- Shows "Closed" if closed
- Displays clock icon (🕐)

---

## 🧪 **STEP 9: Test Your Implementation**

### **Step 9.1: Preview a Studio Page**

1. Go to a single studio listing page
2. Check that all elements appear:
   - [ ] Badges appear above title
   - [ ] Tagline appears below title
   - [ ] Buttons appear top-right
   - [ ] Rating displays with stars
   - [ ] Address shows with pin icon
   - [ ] Operating hours show with clock icon

### **Step 9.2: Test Responsive Design**

1. Resize your browser window (or use browser dev tools)
2. Check mobile view (narrow width)
3. Verify:
   - [ ] Badges stack properly on mobile
   - [ ] Buttons stack vertically on mobile
   - [ ] Text sizes adjust appropriately
   - [ ] Images resize correctly

### **Step 9.3: Test Different Studios**

1. Test with a studio that has:
   - [ ] Verified badge only
   - [ ] Featured badge only
   - [ ] Both badges
   - [ ] No badges
   - [ ] Tagline
   - [ ] No tagline
   - [ ] Business hours set
   - [ ] No business hours

---

## 🐛 **TROUBLESHOOTING**

### **Problem: Badges Don't Appear**

**Solutions:**
1. Check that custom fields `studio_verified` and `studio_featured` are set to "1" or "yes"
2. Verify PHP file is included correctly in `functions.php`
3. Check for PHP errors in WordPress debug log
4. Clear any caching plugins

### **Problem: Tagline Doesn't Show**

**Solutions:**
1. Add text to `studio_tagline` custom field
2. Or add an excerpt to the studio post
3. Verify PHP function is hooked correctly

### **Problem: CSS Not Applying**

**Solutions:**
1. Clear browser cache (Ctrl+Shift+R or Cmd+Shift+R)
2. Clear WordPress cache (if using caching plugin)
3. Verify CSS is in WordPress Customizer → Additional CSS
4. Check for CSS syntax errors (missing semicolons, brackets)
5. Use browser inspector to check if CSS is loading

### **Problem: Buttons Not Positioned Correctly**

**Solutions:**
1. In Elementor, use **Column** layout
2. Set column width to appropriate percentage
3. Use **Alignment** controls to position buttons
4. Add custom CSS for specific positioning if needed

### **Problem: Status Shows Wrong Hours**

**Solutions:**
1. Verify business hours format: `Mo 09:00-17:00`
2. Check timezone settings in WordPress
3. Ensure hours are in 24-hour format
4. Check that PHP date functions are working correctly

### **Problem: Images Not Showing in Gallery**

**Solutions:**
1. Upload multiple images to the studio post
2. Verify GeoDirectory image gallery widget is in template
3. Check image permissions/file paths
4. Clear image cache

---

## 📐 **DESIGN SPECIFICATIONS REFERENCE**

### **Colors:**
- **Teal:** #61948B (verified badge, secondary buttons, icons)
- **Orange/Terracotta:** #FF5733 (featured badge, primary button)
- **Text Dark:** #2C3E3A (headings, main text)
- **Text Medium:** #6B7C78 (tagline, secondary text)
- **Background:** #F8FAFA (light gray background)
- **White:** #FFFFFF (cards, badges text)
- **Gold:** #FBBF24 (rating stars)
- **Green:** #10B981 (open status)
- **Red:** #EF4444 (closed status)

### **Typography:**
- **Headings:** Inter Bold (700), 36px
- **Body:** Inter Regular (400), 16px
- **Tagline:** Crimson Pro Italic or Inter Italic, 18px
- **Small Text:** Inter Regular (400), 14px
- **Badges:** Inter Semi-bold (600), 12px, uppercase

### **Spacing:**
- **Badge padding:** 6px 12px
- **Badge border radius:** 20px (pill shape)
- **Button padding:** 14px 24px
- **Button border radius:** 8px
- **Section padding:** 48px vertical, 20px horizontal
- **Gap between badges:** 12px

### **Layout:**
- **Main container:** max-width 1200px, centered
- **Image gallery:** 70% main image, 30% side images
- **Buttons:** Top-right alignment, stacked vertically on mobile
- **Badges:** Above title, left-aligned
- **Tagline:** Below title, left-aligned

---

## ✅ **FINAL CHECKLIST**

Before considering the hero section complete, verify:

- [ ] PHP code added to `functions.php`
- [ ] CSS added to WordPress Customizer → Additional CSS
- [ ] Custom fields created (`studio_verified`, `studio_featured`, `studio_tagline`)
- [ ] At least one test studio has badges set
- [ ] At least one test studio has tagline set
- [ ] Business hours configured for test studio
- [ ] Images uploaded to test studio (multiple images)
- [ ] Action buttons created and positioned
- [ ] Rating widget displays correctly
- [ ] Address displays correctly
- [ ] Status indicator shows correct hours
- [ ] Mobile responsive design works
- [ ] All colors match design specifications
- [ ] Typography matches design specifications
- [ ] No console errors in browser
- [ ] No PHP errors in debug log

---

## 📞 **NEED HELP?**

If you encounter issues:
1. Check WordPress debug log: `/wp-content/debug.log`
2. Use browser developer tools (F12) to inspect elements
3. Verify all file paths are correct
4. Ensure WordPress, theme, and plugins are up to date
5. Test with default WordPress theme to isolate issues

---

## 🎉 **YOU'RE DONE!**

Once all steps are complete and tested, your hero section should match the Viveka Yoga Studio design exactly. The implementation is now ready for production use!

---

**Last Updated:** January 2025
**Version:** 1.0

