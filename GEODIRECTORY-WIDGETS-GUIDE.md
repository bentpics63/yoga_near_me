# GeoDirectory Widgets Guide for Single Studio Page

## Important: Use GeoDirectory Widgets for Data

**You must use GeoDirectory widgets in Elementor to pull data from your listings.** The CSS is designed to style these widgets and hide unused fields.

## GeoDirectory Widgets to Use

### 1. **Hero Section**

#### GeoDirectory Post Images Widget
- **Widget**: `GeoDirectory Post Images`
- **Purpose**: Display studio gallery (main image + thumbnails)
- **Settings**: Configure image size, gallery layout
- **CSS**: Automatically styled with hover effects and proper grid layout

#### GeoDirectory Post Title Widget
- **Widget**: `GeoDirectory Post Title`
- **Purpose**: Studio name (h1)
- **CSS**: Styled with proper typography and spacing

#### GeoDirectory Post Meta Widget (Badges)
- **Widget**: `GeoDirectory Post Meta`
- **Purpose**: Display verification/featured badges
- **Settings**: Select custom fields: `studio_verified`, `studio_featured`
- **Note**: These are custom fields added via PHP (already in your `functions.php`)

#### GeoDirectory Post Meta Widget (Tagline)
- **Widget**: `GeoDirectory Post Meta`
- **Purpose**: Studio tagline
- **Settings**: Select custom field: `studio_tagline`
- **CSS**: Styled with italic font and accent color

#### GeoDirectory Post Meta Widget (Status)
- **Widget**: `GeoDirectory Post Meta`
- **Purpose**: "Open · Closes X PM" or "Closed"
- **Settings**: Select custom field: `business_hours` (parsed via PHP)
- **Note**: Status is calculated via PHP function `ynm_display_studio_status()` (already in your `functions.php`)

#### GeoDirectory Post Rating Widget
- **Widget**: `GeoDirectory Post Rating`
- **Purpose**: Star rating and review count
- **CSS**: Styled with gold stars and proper spacing

### 2. **About Section**

#### GeoDirectory Post Content Widget
- **Widget**: `GeoDirectory Post Content`
- **Purpose**: Studio description/about text
- **CSS**: Styled with proper line height and text color

### 3. **Yoga Styles Section**

#### GeoDirectory Post Meta Widget
- **Widget**: `GeoDirectory Post Meta`
- **Purpose**: Display yoga styles as pills
- **Settings**: Select custom field: `yoga_styles` (or your yoga styles field name)
- **CSS**: Automatically styled as white pills with teal borders and star icons
- **Note**: If your field contains multiple values, they'll be displayed as separate pills

### 4. **Amenities Section**

#### GeoDirectory Post Meta Widget
- **Widget**: `GeoDirectory Post Meta`
- **Purpose**: Display amenities list
- **Settings**: Select custom field: `amenities` (or your amenities field name)
- **CSS**: Automatically styled as a clean grid with icons
- **Note**: Each amenity will display with its icon and label

### 5. **Contact Information Section**

#### GeoDirectory Post Meta Widget (Phone)
- **Widget**: `GeoDirectory Post Meta`
- **Purpose**: Phone number
- **Settings**: Select field: `phone` or `geodir_phone`
- **CSS**: Styled as clean list item with icon

#### GeoDirectory Post Meta Widget (Email)
- **Widget**: `GeoDirectory Post Meta`
- **Purpose**: Email address
- **Settings**: Select field: `email` or `geodir_email`
- **CSS**: Styled as clean list item with icon, clickable link

#### GeoDirectory Post Meta Widget (Website)
- **Widget**: `GeoDirectory Post Meta`
- **Purpose**: Website URL
- **Settings**: Select field: `website` or `geodir_website`
- **CSS**: Styled as clean list item with icon, clickable link

### 6. **Hours Section**

#### GeoDirectory Business Hours Widget
- **Widget**: `GeoDirectory Business Hours`
- **Purpose**: Display hours of operation
- **CSS**: Automatically styled as clean list with today's hours highlighted
- **Note**: If using custom field, use `GeoDirectory Post Meta` widget instead

### 7. **Reviews Section**

#### GeoDirectory Post Rating Widget (Summary)
- **Widget**: `GeoDirectory Post Rating`
- **Purpose**: Large rating display with star distribution
- **CSS**: Styled with large rating number and bar chart

#### GeoDirectory Post Reviews Widget
- **Widget**: `GeoDirectory Post Reviews`
- **Purpose**: Individual review items
- **CSS**: Styled with avatars, ratings, and helpful buttons

### 8. **Location Section**

#### GeoDirectory Post Map Widget
- **Widget**: `GeoDirectory Post Map`
- **Purpose**: Display map with studio location
- **CSS**: Styled with rounded corners and proper sizing

### 9. **Nearby Studios Section**

#### GeoDirectory Nearby Posts Widget
- **Widget**: `GeoDirectory Nearby Posts`
- **Purpose**: Display nearby yoga studios
- **Settings**: Configure number of posts, distance, post type
- **CSS**: Automatically styled as grid of cards with hover effects

## Hiding Unused Fields

The CSS automatically hides:
- Empty GeoDirectory fields
- Unused social media fields (fax, twitter, linkedin, youtube, tiktok, pinterest)
- Placeholder text

### To Hide Additional Fields

If you need to hide other GeoDirectory fields, add them to the CSS section:

```css
/* Hide specific unused GeoDirectory fields */
body.single-gd_place .geodir-post-meta[data-key*="field_name"] {
    display: none !important;
}
```

Replace `field_name` with the actual field key you want to hide.

## Widget Configuration Tips

1. **Post Meta Widget**: When using `GeoDirectory Post Meta`, make sure to select the correct field from the dropdown. The widget will pull the actual data from your listing.

2. **Empty Fields**: If a field is empty, it will be automatically hidden by the CSS. No need to manually hide empty fields.

3. **Multiple Values**: If a field contains multiple values (like yoga styles), they'll be displayed as separate items (pills for yoga styles, grid items for amenities).

4. **Custom Fields**: Make sure your custom fields (like `studio_verified`, `studio_featured`, `studio_tagline`, `yoga_styles`, `amenities`) are properly configured in GeoDirectory → Settings → Custom Fields.

5. **Widget Order**: Place widgets in the order you want them to appear on the page. The CSS will style them appropriately based on their GeoDirectory widget class.

## Testing

After adding GeoDirectory widgets:
1. Check that data is displaying correctly
2. Verify empty fields are hidden
3. Test responsive design on mobile
4. Ensure all links (email, website) are clickable
5. Verify map displays correctly

## Troubleshooting

**Problem**: Widget shows "Placeholder" or no data
- **Solution**: Make sure the listing has data for that field. Check GeoDirectory → Listings → Edit your listing.

**Problem**: Field is showing but should be hidden
- **Solution**: Add the field to the "Hide specific unused GeoDirectory fields" section in the CSS.

**Problem**: Styling doesn't match design
- **Solution**: Check that you're using the correct GeoDirectory widget (not a generic Elementor widget). The CSS targets GeoDirectory-specific classes.

**Problem**: Multiple values not displaying correctly
- **Solution**: Check your custom field settings in GeoDirectory. Some fields may need to be configured as "multiple values" or "checkbox" type.

