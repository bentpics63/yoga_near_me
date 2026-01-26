# Design Improvements Guide

## CSS File Created

**File:** `/Users/eddieb/Projects/Yoganearme.info/code/single-studio-hero-custom/DESIGN-IMPROVEMENTS.css`

Copy this entire file and add it to **WordPress Customizer → Additional CSS** (at the very bottom, after your existing CSS).

## Issues Addressed

### ✅ 1. Breadcrumbs Fixed
- Breadcrumbs now display properly
- Styled with proper spacing and colors

### ✅ 2. Section Spacing
- Added proper spacing between sections (40px margin)
- Contact Information and buttons now have space between them
- Each section has its own defined space

### ✅ 3. Contact Information Card
- White card background with rounded corners
- Proper card styling with shadow and border
- Heading with orange dot and separator line
- Each contact item (address, phone, email, website) properly formatted

### ✅ 4. Hours of Operation Card
- White card background matching Contact Information
- Today's hours appear at the top (automatically ordered)
- Status indicator: "Open Now · Closes 9:00 PM" with green background
- Rest of days follow below
- Separator line between heading and data

### ✅ 5. Address Formatting
- State and USA now line up with city name
- Multi-line address properly formatted

### ✅ 6. Follow Us Section
- Added at bottom of Contact Information card
- Separated by a line
- Social media icons styled as circular buttons
- Light purple/teal color scheme

### ✅ 7. Contact Icons
- Proper icon styling for address, phone, email, website
- Grey icons that match the design

### ✅ 8. Location Pin & Status Below Title
- Location pin icon below studio title
- Open/Closes status below title
- See GeoDirectory widgets section below

### ✅ 9. Section Definitions
- Each section has proper spacing
- Cards are clearly defined
- Relaxed but efficient layout

### ✅ 10. About Section Info Icon
- Orange circle with white "i" icon instead of bullet
- Matches the design screenshot

## GeoDirectory Widgets to Use

### For Location Pin Below Title:

**Widget:** `GeoDirectory Post Meta`
- **Field:** `geodir_address` or `address`
- **Display:** Full address
- **Place:** Below studio title (H1)

**OR use:**
- **Widget:** `GeoDirectory Post Meta`
- **Field:** `geodir_city` for city name
- **Field:** `geodir_region` for state
- **Field:** `geodir_postal_code` for zip code

### For Open/Closes Status Below Title:

**Widget:** `GeoDirectory Business Hours`
- This widget can display current status
- Shows "Open Now · Closes X PM" or "Closed"

**OR use custom PHP:**
- The function `ynm_display_studio_status()` already exists in your `functions.php`
- It displays "Open · Closes X PM" or "Closed"
- Hook: `geodir_after_post_title`

### For Hours of Operation Card:

**Widget:** `GeoDirectory Business Hours`
- Displays full week schedule
- Today's hours will automatically appear at top (via CSS `order: -1`)

**Settings:**
- Enable "Show current day first" if available
- Format: Day - Time (e.g., "Monday - 6:00 AM – 9:00 PM")

## Additional Data Fields to Collect

### Recommended Custom Fields:

1. **Social Media Links**
   - `facebook_url` - Text field
   - `instagram_url` - Text field
   - `youtube_url` - Text field
   - `twitter_url` - Text field (optional)

2. **Additional Contact Info**
   - `secondary_phone` - Text field (optional)
   - `fax` - Text field (optional)

3. **Business Details**
   - `year_established` - Number field
   - `number_of_instructors` - Number field
   - `class_capacity` - Number field
   - `parking_available` - Checkbox
   - `wheelchair_accessible` - Checkbox

4. **Yoga-Specific Fields**
   - `yoga_styles` - Multi-select or checkbox field (you may already have this)
   - `class_types` - Multi-select (Beginner, Intermediate, Advanced, All Levels)
   - `teacher_training` - Checkbox
   - `workshops_offered` - Checkbox
   - `retreats_offered` - Checkbox

5. **Pricing**
   - `drop_in_price` - Number field
   - `class_pack_price` - Number field
   - `monthly_unlimited_price` - Number field
   - `first_class_free` - Checkbox

6. **Amenities** (you may already have this)
   - `amenities` - Multi-select or checkbox field
   - Options: Parking, Showers, Locker Rooms, Retail Shop, Café, WiFi, etc.

7. **Special Features**
   - `outdoor_classes` - Checkbox
   - `online_classes` - Checkbox
   - `private_sessions` - Checkbox
   - `corporate_classes` - Checkbox

### How to Add Custom Fields:

1. Go to **GeoDirectory → Settings → Custom Fields**
2. Click **Add New Field**
3. Choose field type (Text, Number, Checkbox, Multi-select, etc.)
4. Set field key (e.g., `facebook_url`)
5. Set field label (e.g., "Facebook URL")
6. Choose post type: `gd_place`
7. Save

## Elementor Widget Setup

### Contact Information Section:

1. **Add Section** → White background
2. **Add Heading Widget** → "Contact Information"
3. **Add GeoDirectory Post Meta Widgets:**
   - Address (field: `address` or `geodir_address`)
   - Phone (field: `phone` or `geodir_phone`)
   - Email (field: `email` or `geodir_email`)
   - Website (field: `website` or `geodir_website`)
4. **Add Heading Widget** → "Follow Us"
5. **Add Share Buttons Widget** → Social media icons

### Hours of Operation Section:

1. **Add Section** → White background
2. **Add Heading Widget** → "Hours of Operation"
3. **Add GeoDirectory Business Hours Widget**
4. CSS will automatically put today's hours at top

### Below Studio Title:

1. **Add GeoDirectory Post Meta Widget** → Address (for location pin)
2. **Add GeoDirectory Business Hours Widget** → Current status (for Open/Closes)

## Testing Checklist

- [ ] Breadcrumbs display correctly
- [ ] Contact Information card has white background
- [ ] Contact items have proper spacing
- [ ] Address formatting (state lines up with city)
- [ ] Follow Us section appears at bottom of Contact card
- [ ] Social icons are circular and styled correctly
- [ ] Hours card has white background
- [ ] Today's hours appear at top of hours list
- [ ] Status indicator shows "Open Now · Closes X PM"
- [ ] Location pin appears below studio title
- [ ] Open/Closes status appears below studio title
- [ ] Sections have proper spacing between them
- [ ] About section has info icon (ⓘ) instead of bullet
- [ ] All section headings have separator lines

## Troubleshooting

**Breadcrumbs not showing:**
- Make sure you're using the shortcode `[ynm_breadcrumbs]` in an HTML widget
- Check that the shortcode function is in your `functions.php`

**Contact card not white:**
- Make sure the CSS is added after your existing CSS
- Check that the section has the class `contact-information-group` or contains "Contact"

**Today's hours not at top:**
- Make sure the GeoDirectory Business Hours widget is being used
- Check that today's row has the class `today` or `geodir-hours-row.today`

**Icons not showing:**
- Make sure GeoDirectory Post Meta widgets have icons enabled
- Check that icon classes are correct in CSS

## Next Steps

1. Add the `DESIGN-IMPROVEMENTS.css` to WordPress Customizer
2. Set up GeoDirectory widgets as described above
3. Add custom fields for social media and additional data
4. Test each section
5. Adjust spacing if needed

