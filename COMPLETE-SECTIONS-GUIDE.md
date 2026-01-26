# Complete Sections Guide - Green Layout with White/Off-White

## What Was Created

I've created complete section templates that match the **green layout structure** but use **white/off-white colors**. All fields are always visible with "TBD" placeholders until data is filled in.

## Files Created

1. **`COMPLETE-SECTION-TEMPLATES.css`** - CSS for complete sections
2. **`COMPLETE-SECTION-TEMPLATES.php`** - PHP functions and shortcodes

## Features

### ✅ Contact Information Section
- **Always shows:** Address, Phone, Email, Website (even if empty)
- **Icons:** Location pin, Phone, Envelope, Globe (from your screenshot)
- **Labels:** ADDRESS, PHONE, EMAIL, WEBSITE (uppercase, light grey)
- **Values:** Shows actual data or "TBD" if empty
- **Follow Us:** Section with social media icons (Facebook, Instagram, YouTube)
- **Layout:** Matches green version structure

### ✅ Hours of Operation Section
- **Status Indicator:** "Open Now · Closes 9:00 PM" or "Closed" or "TBD"
- **All 7 Days:** Always visible, shows "TBD" if hours not set
- **Today First:** Today's hours automatically appear at top
- **Layout:** Matches green version structure

## Setup Instructions

### Step 1: Add PHP Functions

Add to your `functions.php`:

```php
require_once get_stylesheet_directory() . '/../code/PHP ADDS/COMPLETE-SECTION-TEMPLATES.php';
```

### Step 2: Add CSS

Copy `COMPLETE-SECTION-TEMPLATES.css` to **WordPress Customizer → Additional CSS** (at the very bottom)

### Step 3: Use Shortcodes in Elementor

#### Contact Information Section:

1. Add an **HTML widget** in Elementor
2. Paste: `[ynm_complete_contact_info]`
3. This will display:
   - Address (with location pin icon) - "TBD" if empty
   - Phone (with phone icon) - "TBD" if empty
   - Email (with envelope icon) - "TBD" if empty
   - Website (with globe icon) - "TBD" if empty
   - Follow Us heading
   - Social media icons (if URLs are set)

#### Hours of Operation Section:

1. Add an **HTML widget** in Elementor
2. Paste: `[ynm_complete_hours]`
3. This will display:
   - Status indicator (Open Now · Closes X PM or Closed or TBD)
   - Today's hours at top
   - All 7 days of the week
   - "TBD" for days without hours set

## How It Works

### Contact Information

The shortcode checks for:
- `geodir_address` or `address` field
- `geodir_phone` or `phone` field
- `geodir_email` or `email` field
- `geodir_website` or `website` field
- `facebook_url`, `instagram_url`, `youtube_url` custom fields

**If field is empty:** Shows "TBD"  
**If field has data:** Shows the actual data (with clickable links for phone, email, website)

### Hours of Operation

The shortcode:
1. Checks for `business_hours` field
2. Parses hours if available
3. Shows status indicator (Open/Closed/TBD)
4. Displays all 7 days
5. Puts today's day at the top automatically
6. Shows "TBD" for days without hours

## Custom Fields Needed

### For Social Media Icons:

Add these custom fields in GeoDirectory:

1. **facebook_url** - Text field
2. **instagram_url** - Text field
3. **youtube_url** - Text field

**How to add:**
1. Go to **GeoDirectory → Settings → Custom Fields**
2. Click **Add New Field**
3. Field Type: **Text**
4. Field Key: `facebook_url` (or `instagram_url`, `youtube_url`)
5. Field Label: "Facebook URL" (or "Instagram URL", "YouTube URL")
6. Post Type: `gd_place`
7. Save

## Icons Used

The templates use SVG icons matching your screenshot:

1. **Location Pin** - Dark grey map pin icon
2. **Phone** - Dark grey telephone receiver icon
3. **Envelope** - Dark grey envelope icon
4. **Globe** - Dark grey globe icon

All icons are styled with:
- Size: 20px × 20px
- Color: Sage grey (`#5F7470`)
- Opacity: 0.7

## Layout Structure

### Matches Green Version:
- ✅ Same spacing between sections
- ✅ Same card structure
- ✅ Same field layout
- ✅ Same icon placement
- ✅ Today's hours at top
- ✅ Follow Us section at bottom

### Uses White/Off-White:
- ✅ White card backgrounds (`#FFFFFF`)
- ✅ Off-white for subtle differentiation where needed
- ✅ Clean, modern appearance

## Testing

After setup:

1. **Check Contact Information:**
   - All 4 fields should be visible
   - Empty fields show "TBD"
   - Icons display correctly
   - Follow Us section appears
   - Social icons show if URLs are set

2. **Check Hours of Operation:**
   - Status indicator shows (TBD if no hours)
   - All 7 days visible
   - Today's day at top
   - Empty days show "TBD"

3. **Fill in Data:**
   - Add address, phone, email, website
   - Add business hours
   - "TBD" should be replaced with actual data automatically

## Troubleshooting

**Fields not showing:**
- Make sure PHP functions are added to `functions.php`
- Check that shortcodes are used correctly: `[ynm_complete_contact_info]` and `[ynm_complete_hours]`

**Icons not displaying:**
- Check that CSS is added to WordPress Customizer
- Verify SVG icons are rendering (check browser console)

**Hours not parsing:**
- Make sure `business_hours` field format matches expected format
- Check that GeoDirectory Business Hours widget is configured correctly

**Social icons not showing:**
- Add custom fields: `facebook_url`, `instagram_url`, `youtube_url`
- Fill in the URLs in the studio listing
- Icons will appear automatically

## Next Steps

1. ✅ Add PHP functions to `functions.php`
2. ✅ Add CSS to WordPress Customizer
3. ✅ Add shortcodes to Elementor HTML widgets
4. ✅ Test with empty data (should show "TBD")
5. ✅ Fill in data and verify "TBD" is replaced
6. ✅ Add social media custom fields
7. ✅ Add social media URLs to listings

All sections now match the green layout structure with white/off-white colors! 🎉

