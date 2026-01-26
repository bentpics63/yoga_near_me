# Fixing Elementor Inline Styles

If CSS isn't working, Elementor might be using **inline styles** that override your CSS. Here's how to fix it:

## Option 1: Use Elementor's Custom CSS (Recommended)

### For "Save" Button:
1. **Edit page** in Elementor
2. **Click on the "Save" button widget**
3. Go to **Advanced** tab → **Custom CSS**
4. Paste this:

```css
selector.elementor-button {
    background-color: #61948B !important;
    background: #61948B !important;
    border-color: #61948B !important;
    color: #FFFFFF !important;
    border: none !important;
}

selector.elementor-button:hover {
    background-color: #4F7A73 !important;
    background: #4F7A73 !important;
}
```

### For Social Share Buttons:
1. **Click on Share Buttons widget**
2. Go to **Advanced** tab → **Custom CSS**
3. Paste this:

```css
selector .elementor-share-btn,
selector .elementor-share-buttons__button,
selector .elementor-social-icon {
    background-color: rgba(255, 87, 51, 0.1) !important;
    background: rgba(255, 87, 51, 0.1) !important;
    border-color: rgba(255, 87, 51, 0.2) !important;
    color: #FF5733 !important;
}

selector .elementor-share-btn svg,
selector .elementor-share-buttons__button svg {
    fill: #FF5733 !important;
}

selector .elementor-share-btn:hover,
selector .elementor-share-buttons__button:hover {
    background-color: #FF5733 !important;
    background: #FF5733 !important;
    color: #FFFFFF !important;
}

selector .elementor-share-btn:hover svg {
    fill: #FFFFFF !important;
}
```

### For "Claim Listing" Button:
1. **Click on Claim Listing button widget**
2. Go to **Advanced** tab → **Custom CSS**
3. Paste this:

```css
selector.elementor-button {
    background-color: #FF5733 !important;
    background: #FF5733 !important;
    border-color: #FF5733 !important;
    color: #FFFFFF !important;
    border: none !important;
}

selector.elementor-button:hover {
    background-color: #E64A2A !important;
    background: #E64A2A !important;
}
```

## Option 2: Remove Inline Styles (Advanced)

If Elementor is adding inline styles, you can remove them with JavaScript. Add this to your theme's `functions.php`:

```php
// Remove Elementor inline styles for buttons
add_action('wp_footer', function() {
    if (is_singular('gd_place')) {
        ?>
        <script>
        jQuery(document).ready(function($) {
            // Remove inline styles from Save button
            $('.elementor-widget-button:nth-child(2) .elementor-button').each(function() {
                $(this).css({
                    'background-color': '#61948B',
                    'background': '#61948B',
                    'border-color': '#61948B',
                    'color': '#FFFFFF'
                });
            });
            
            // Remove inline styles from social buttons
            $('.elementor-share-btn, .elementor-share-buttons__button').each(function() {
                $(this).css({
                    'background-color': 'rgba(255, 87, 51, 0.1)',
                    'border-color': 'rgba(255, 87, 51, 0.2)',
                    'color': '#FF5733'
                });
            });
            
            // Remove inline styles from Claim button
            $('.elementor-button[class*="claim"], .elementor-button[class*="Claim"]').each(function() {
                $(this).css({
                    'background-color': '#FF5733',
                    'background': '#FF5733',
                    'border-color': '#FF5733',
                    'color': '#FFFFFF'
                });
            });
        });
        </script>
        <?php
    }
});
```

## Option 3: Check Elementor Widget Settings

1. **Edit page** in Elementor
2. **Click on each button widget**
3. Go to **Style** tab
4. Check **Background Color** - make sure it's set correctly OR set to "Default" so CSS can override
5. Check **Text Color** - set to "Default" or white

## Button Positioning Fix

If buttons are stacking vertically instead of horizontally:

1. **Edit page** in Elementor
2. **Select the column** containing the buttons
3. Go to **Layout** tab
4. Set **Content Position** to "Top"
5. Set **Vertical Align** to "Top"
6. Go to **Advanced** tab → **Custom CSS**
7. Paste this:

```css
selector {
    display: flex !important;
    flex-direction: row !important;
    gap: 16px !important;
    flex-wrap: wrap !important;
    align-items: center !important;
}
```

## Still Not Working?

1. **Clear all caches** (browser cache, WordPress cache, Elementor cache)
2. **Check browser console** (F12) for CSS errors
3. **Inspect element** (Right-click → Inspect) to see what styles are applying
4. **Take screenshot** of the Inspector showing the computed styles
5. **Report back** with what you find

