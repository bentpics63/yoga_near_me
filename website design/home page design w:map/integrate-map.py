#!/usr/bin/env python3
"""
Integrate the working standalone map into the homepage
"""

# Read the standalone map HTML
with open('/Users/eddieb/Projects/Yoganearme.info/interactive-map-50-cities.html', 'r') as f:
    standalone_html = f.read()

# Read the homepage HTML
with open('/Users/eddieb/Projects/Yoganearme.info/index-with-new-faq.html', 'r') as f:
    homepage_html = f.read()

# Extract the standalone map CSS (between <style> tags, after the :root variables)
import re

# Find the standalone CSS
standalone_css_match = re.search(r'<style>(.*?)</style>', standalone_html, re.DOTALL)
if standalone_css_match:
    standalone_css = standalone_css_match.group(1)
    # Extract just the map-related CSS (everything after body style)
    map_css_match = re.search(r'(\.container \{.*?@media.*?1600px.*?\}.*?\})', standalone_css, re.DOTALL)
    if map_css_match:
        map_specific_css = map_css_match.group(1)

        # Now insert this CSS into homepage before the closing </style>
        homepage_html = homepage_html.replace('</style>', f'\n        /* STANDALONE MAP STYLES */\n{map_specific_css}\n    </style>', 1)

# Extract the standalone map HTML structure (from <div class="container"> to end of </div>)
map_html_match = re.search(r'(<div class="container">.*?<script>)', standalone_html, re.DOTALL)
if map_html_match:
    map_html_structure = map_html_match.group(1)

    # Find and replace the current map section in homepage
    # Remove from <!-- INTERACTIVE MAP SECTION --> to <!-- FOR STUDIO OWNERS SECTION -->
    homepage_html = re.sub(
        r'    <!-- INTERACTIVE MAP SECTION -->.*?    <!-- FOR STUDIO OWNERS SECTION -->',
        f'    <!-- INTERACTIVE MAP SECTION -->\n    {map_html_structure}\n\n    <!-- FOR STUDIO OWNERS SECTION -->',
        homepage_html,
        flags=re.DOTALL
    )

# Extract the JavaScript
js_match = re.search(r'(<script>.*?</script>)', standalone_html, re.DOTALL)
if js_match:
    map_js = js_match.group(1)

    # Add the JavaScript before the closing </body> tag
    homepage_html = homepage_html.replace('</body>', f'    {map_js}\n</body>')

# Write the updated homepage
with open('/Users/eddieb/Projects/Yoganearme.info/index-with-integrated-map.html', 'w') as f:
    f.write(homepage_html)

print("✓ Map integrated successfully!")
print("✓ New file created: index-with-integrated-map.html")
