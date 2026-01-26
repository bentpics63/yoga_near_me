# Check Data Availability Guide

## The Problem

You're seeing empty fields for phone, email, and website. This could mean:

1. **Data doesn't exist** - The fields haven't been filled in for this studio
2. **Data exists but widgets aren't connected** - Elementor widgets aren't pulling from GeoDirectory fields
3. **Data exists but wrong field names** - The widgets are looking for wrong field names

---

## How to Check if Data Exists

### Option 1: Check in WordPress Admin

1. Go to **WordPress Admin** → **Places** (or **GeoDirectory** → **Places**)
2. Find your studio (e.g., "Viveka Yoga Studio")
3. Click **Edit**
4. Look for fields like:
   - Phone
   - Email
   - Website
   - Address

**Are these fields filled in?**

- ✅ **YES** → Data exists, widgets just need to be connected
- ❌ **NO** → Data doesn't exist, you need to add it

---

### Option 2: Check GeoDirectory Custom Fields

1. Go to **GeoDirectory** → **Settings** → **Custom Fields**
2. Look for fields like:
   - `phone`
   - `email`
   - `website`
   - `address`

**Do these fields exist?**

- ✅ **YES** → Check if they're assigned to `gd_place` post type
- ❌ **NO** → You may need to create them

---

### Option 3: Check Post Meta Directly

1. Go to **WordPress Admin** → **Places** → Edit your studio
2. Scroll down to **Custom Fields** section
3. Look for:
   - `geodir_phone`
   - `geodir_email`
   - `geodir_website`
   - `geodir_address`

**Are these filled in?**

---

## If Data EXISTS but Not Showing

### Problem: Elementor Widgets Not Connected

**Solution:** Connect GeoDirectory widgets to the correct fields

1. **In Elementor Editor:**
   - Click on the widget showing empty data
   - Look for **"Field"** or **"Data Source"** setting
   - Select the correct GeoDirectory field:
     - Phone → `geodir_phone` or `phone`
     - Email → `geodir_email` or `email`
     - Website → `geodir_website` or `website`

2. **If using Post Meta widget:**
   - Widget: **GeoDirectory** → **Post Meta**
   - Setting: **Meta Key**
   - Enter: `geodir_phone`, `geodir_email`, `geodir_website`

3. **If using Text Editor widget:**
   - Use **Dynamic Content** → **Post Meta**
   - Select the correct field

---

## If Data DOESN'T EXIST

### You Need to Add Data

1. **Go to WordPress Admin** → **Places** → Edit your studio
2. **Fill in the fields:**
   - Phone: `+1-213-555-0123`
   - Email: `hello@vivekayoga.com`
   - Website: `https://vivekayoga.com`
   - Address: `456 Spring Street, Suite 800, Los Angeles, CA 90013`

3. **Click "Update"**

4. **Refresh the frontend page**

---

## Common GeoDirectory Field Names

| What You See | GeoDirectory Field Name |
|--------------|------------------------|
| Phone | `geodir_phone` or `phone` |
| Email | `geodir_email` or `email` |
| Website | `geodir_website` or `website` |
| Address | `geodir_address` or `address` |
| City | `geodir_city` or `city` |
| State | `geodir_region` or `region` |
| Zip | `geodir_postal_code` or `postal_code` |

---

## Quick Test

**Add this to your page temporarily to see what data exists:**

1. **Add a Text Editor widget** in Elementor
2. **Use Dynamic Content** → **Post Meta**
3. **Try these field names one at a time:**
   - `geodir_phone`
   - `geodir_email`
   - `geodir_website`

**If data appears**, you know the field name is correct.

**If nothing appears**, either:
- The data doesn't exist
- The field name is wrong
- The widget isn't configured correctly

---

## Next Steps

1. **Check if data exists** (use steps above)
2. **If data exists:** Connect Elementor widgets to correct fields
3. **If data doesn't exist:** Add data to the studio listing
4. **Test:** Refresh page and check if data appears

---

## Still Not Working?

**Share with me:**
1. Do you see phone/email/website fields in WordPress admin when editing the studio?
2. What widgets are you using for contact info?
3. What field names are configured in those widgets?

Then I can help you connect them correctly!

