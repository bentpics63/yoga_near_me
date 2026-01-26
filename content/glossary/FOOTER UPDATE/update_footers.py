#!/usr/bin/env python3
"""
Script to update footer CSS and HTML in all glossary HTML files
"""

import os
import re
from pathlib import Path

# Base directory
BASE_DIR = Path("/Users/eddieb/Projects/Yoganearme.info/content/glossary/completed terms as reference")

# NEW FOOTER CSS
NEW_FOOTER_CSS = """        /* ===================================
           FOOTER - New Design v3
        =================================== */
        .footer {
            background-color: var(--primary-slate-dark);
            color: #fff;
            padding: 64px 0 24px;
            margin-top: 4rem;
        }
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
        }
        .footer-section h3 {
            color: #fff;
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 16px;
        }
        .footer-section p {
            color: rgba(255,255,255,0.85);
            font-size: 0.9rem;
            line-height: 1.65;
            margin-bottom: 16px;
        }
        .footer-section ul { list-style: none; }
        .footer-section li { margin-bottom: 8px; }
        .footer-section a {
            color: rgba(255,255,255,0.85);
            font-size: 0.9rem;
            text-decoration: none;
            transition: color 0.2s ease-out;
        }
        .footer-section a:hover {
            color: #fff;
            text-decoration: underline;
            text-decoration-color: rgba(255,255,255,0.5);
        }
        .brand-stat {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 999px;
            padding: 5px 12px;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.9);
            margin-bottom: 16px;
        }
        .brand-stat svg {
            width: 14px;
            height: 14px;
            fill: var(--accent-coral);
        }
        .social-links {
            display: flex;
            gap: 8px;
            margin-top: 8px;
        }
        .social-link {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.15);
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            transition: background 0.2s ease-out, transform 0.2s ease-out;
        }
        .social-link:hover {
            background: rgba(255,255,255,0.18);
            transform: translateY(-2px);
            color: #fff;
            text-decoration: none;
        }
        .social-link svg {
            width: 16px;
            height: 16px;
            fill: currentColor;
        }
        .cities-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: rgba(255,255,255,0.7);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            margin-top: 24px;
        }
        .cities-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 8px;
        }
        .city-chip {
            padding: 6px 10px;
            border-radius: 6px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.15);
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            font-size: 0.82rem;
            transition: background 0.2s ease-out;
        }
        .city-chip:hover {
            background: rgba(255,255,255,0.18);
            text-decoration: none;
        }
        .view-all-cities {
            font-size: 0.82rem;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .view-all-cities:hover { color: #fff; }
        .view-all-cities svg {
            width: 12px;
            height: 12px;
            fill: currentColor;
        }
        .newsletter-form {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .newsletter-form input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid rgba(255,255,255,0.18);
            background: rgba(255,255,255,0.08);
            color: #fff;
            font-size: 0.9rem;
            font-family: inherit;
        }
        .newsletter-form input::placeholder { color: rgba(255,255,255,0.5); }
        .newsletter-form input:focus {
            outline: none;
            border-color: rgba(255,255,255,0.35);
            background: rgba(255,255,255,0.12);
        }
        .newsletter-form button {
            padding: 12px 16px;
            border-radius: 8px;
            border: none;
            background: var(--accent-coral);
            color: #fff;
            font-size: 0.9rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: background 0.2s ease-out;
        }
        .newsletter-form button:hover {
            background: var(--accent-coral-dark);
        }
        .newsletter-form button svg {
            width: 14px;
            height: 14px;
            fill: currentColor;
        }
        .newsletter-note {
            font-size: 0.78rem;
            color: rgba(255,255,255,0.55);
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .newsletter-note svg {
            width: 10px;
            height: 10px;
            fill: currentColor;
        }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.12);
            margin-top: 40px;
            padding-top: 16px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 24px;
            padding-right: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            font-size: 0.82rem;
            color: rgba(255,255,255,0.65);
        }
        .footer-bottom-links {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
        }
        .footer-bottom a {
            color: rgba(255,255,255,0.65);
            text-decoration: none;
        }
        .footer-bottom a:hover {
            color: #fff;
            text-decoration: underline;
        }
        .visually-hidden {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0,0,0,0);
            border: 0;
        }"""

# NEW MEDIA QUERIES
NEW_MEDIA_QUERIES_900 = """            .footer-content { grid-template-columns: repeat(2, 1fr); gap: 40px 24px; }"""

NEW_MEDIA_QUERIES_640 = """            .footer-content { grid-template-columns: 1fr; gap: 40px; padding: 0 16px; }
            .footer-bottom { flex-direction: column; text-align: center; padding-left: 16px; padding-right: 16px; }
            .footer-bottom-links { justify-content: center; }"""

# NEW FOOTER HTML
NEW_FOOTER_HTML = """  <footer class="footer" role="contentinfo">
    <div class="footer-content">

      <!-- COL 1: Brand -->
      <div class="footer-section">
        <h3>Yoga Near Me</h3>
        <div class="brand-stat">
          <svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
          30,000+ studios · US &amp; Canada
        </div>
        <p>Connecting practitioners with authentic studios. Built by yoga teachers, for the yoga community.</p>
        <div class="social-links">
          <a href="https://www.facebook.com/profile.php?id=61576026377264" class="social-link" aria-label="Facebook">
            <svg viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
          </a>
          <a href="https://www.instagram.com/yoga.near.me.guide/" class="social-link" aria-label="Instagram">
            <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
          </a>
          <a href="https://x.com/yoganearmeguide" class="social-link" aria-label="X">
            <svg viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          </a>
          <a href="https://www.pinterest.com/yoganearmeguide/_profile/" class="social-link" aria-label="Pinterest">
            <svg viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.372 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738.098.119.112.224.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12 24c6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z"/></svg>
          </a>
        </div>
      </div>

      <!-- COL 2: Explore -->
      <nav class="footer-section" aria-label="Explore">
        <h3>Explore</h3>
        <ul>
          <li><a href="https://yoganearme.info/yoga-styles/">Yoga Styles</a></li>
          <li><a href="https://yoganearme.info/yoga-glossary/">Glossary</a></li>
          <li><a href="https://yoganearme.info/30-essential-questions-answered/">Essential Guide</a></li>
          <li><a href="https://yoganearme.info/benefits/">Benefits of Yoga</a></li>
          <li><a href="https://yoganearme.info/blog/">Blog</a></li>
          <li><a href="https://yoganearme.info/about/">About Us</a></li>
        </ul>
      </nav>

      <!-- COL 3: For Studios + Cities -->
      <div class="footer-section">
        <h3>For Studios</h3>
        <ul>
          <li><a href="https://yoganearme.info/add-listing/studios/">Add Your Studio</a></li>
          <li><a href="https://yoganearme.info/claim-your-listing/">Claim Listing</a></li>
          <li><a href="https://yoganearme.info/studio-business/">Grow Your Studio</a></li>
          <li><a href="https://yoganearme.info/contact/">Partner Support</a></li>
        </ul>

        <div class="cities-label">Popular Cities</div>
        <div class="cities-grid">
          <a href="https://yoganearme.info/search-page/?geodir_search=1&stype=gd_place&snear=new+york+city&sgeo_lat=40.7127281&sgeo_lon=-74.0060152" class="city-chip">NYC</a>
          <a href="https://yoganearme.info/search-page/?geodir_search=1&stype=gd_place&snear=los+angeles&sgeo_lat=34.0536909&sgeo_lon=-118.2427660" class="city-chip">LA</a>
          <a href="https://yoganearme.info/search-page/?geodir_search=1&stype=gd_place&snear=toronto&sgeo_lat=43.6534817&sgeo_lon=-79.3839347" class="city-chip">Toronto</a>
          <a href="https://yoganearme.info/search-page/?geodir_search=1&stype=gd_place&snear=chicago&sgeo_lat=41.8755616&sgeo_lon=-87.6244212" class="city-chip">Chicago</a>
          <a href="https://yoganearme.info/search-page/?geodir_search=1&stype=gd_place&snear=austin&sgeo_lat=30.2711286&sgeo_lon=-97.7436995" class="city-chip">Austin</a>
          <a href="https://yoganearme.info/search-page/?geodir_search=1&stype=gd_place&snear=seattle&sgeo_lat=47.6038321&sgeo_lon=-122.3300620" class="city-chip">Seattle</a>
        </div>
        <a href="https://yoganearme.info/studios/" class="view-all-cities">
          View all 150+ cities
          <svg viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg>
        </a>
      </div>

      <!-- COL 4: Newsletter -->
      <div class="footer-section">
        <h3>The Weekly Practice</h3>
        <p>One deep-dive article weekly. Research-backed insights, no fluff. Plus new studios in your area.</p>
        <form class="newsletter-form" action="#" method="POST">
          <label for="footer-email" class="visually-hidden">Email</label>
          <input type="email" id="footer-email" name="email" placeholder="Your email" required />
          <button type="submit">
            Subscribe
            <svg viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
          </button>
        </form>
        <p class="newsletter-note">
          <svg viewBox="0 0 24 24"><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/></svg>
          Unsubscribe anytime
        </p>
      </div>

    </div>

    <div class="footer-bottom">
      <div>&copy; 2025 Yoga Near Me</div>
      <nav class="footer-bottom-links" aria-label="Legal">
        <a href="https://yoganearme.info/editorial-guidelines/">Editorial Guidelines</a>
        <a href="https://yoganearme.info/privacy-policy/">Privacy</a>
        <a href="https://yoganearme.info/terms-of-service/">Terms</a>
        <a href="https://yoganearme.info/sitemap/">Sitemap</a>
      </nav>
    </div>
  </footer>"""


def update_footer_css(content):
    """Replace old footer CSS with new footer CSS."""
    # Pattern to match old footer CSS section (from /* Footer */ or .site-footer to the media queries)
    # This is a complex pattern that needs to handle variations

    # First, try to find where the footer CSS starts
    patterns = [
        (r'/\* Footer \*/\s*\.site-footer\s*\{.*?\.footer-legal a:hover \{ color: white; \}', re.DOTALL),
        (r'\.site-footer\s*\{[^}]*background:\s*var\(--primary-slate-dark\);.*?\.footer-legal a:hover \{ color: white; \}', re.DOTALL),
    ]

    for pattern, flags in patterns:
        if re.search(pattern, content, flags):
            content = re.sub(pattern, NEW_FOOTER_CSS, content, flags=flags)
            return content, True

    return content, False


def update_media_queries(content):
    """Update media queries to use .footer-content instead of .footer-grid."""
    # Replace 900px media query
    content = re.sub(
        r'\.footer-grid \{ grid-template-columns: 1fr 1fr; gap: 2rem; \}\s*\.footer-brand \{ grid-column: 1 / -1; max-width: none; \}',
        NEW_MEDIA_QUERIES_900,
        content
    )

    # Replace 640px media query - more complex pattern
    pattern_640 = r'\.site-footer \{ padding: 3rem 1rem 1\.5rem; \}\s*\.footer-grid \{ grid-template-columns: 1fr; gap: 2rem; \}\s*\.footer-bottom \{ flex-direction: column; text-align: center; \}\s*\.footer-legal \{ justify-content: center; \}\s*\.newsletter-form \{ flex-direction: column; \}\s*\.newsletter-btn \{ width: 100%; \}'

    content = re.sub(pattern_640, NEW_MEDIA_QUERIES_640, content)

    return content


def update_footer_html(content):
    """Replace old footer HTML with new footer HTML."""
    # Pattern to match old footer HTML (from <footer class="site-footer"> to </footer>)
    pattern = r'<footer class="site-footer">.*?</footer>'

    if re.search(pattern, content, re.DOTALL):
        content = re.sub(pattern, NEW_FOOTER_HTML, content, flags=re.DOTALL)
        return content, True

    return content, False


def process_file(filepath):
    """Process a single HTML file."""
    try:
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()

        # Update CSS
        content, css_updated = update_footer_css(content)

        # Update media queries
        content = update_media_queries(content)

        # Update HTML
        content, html_updated = update_footer_html(content)

        if css_updated or html_updated:
            with open(filepath, 'w', encoding='utf-8') as f:
                f.write(content)
            return True, None
        else:
            return False, "No footer patterns found"

    except Exception as e:
        return False, str(e)


def main():
    """Main function to process all files."""
    success_count = 0
    failed_files = []
    skipped_files = []

    # Get all HTML files except template
    html_files = []
    for file in BASE_DIR.rglob("*.html"):
        if "GLOSSARY DEFINITION TEMPLATE" not in str(file):
            html_files.append(file)

    print(f"Found {len(html_files)} HTML files to process")
    print()

    for filepath in sorted(html_files):
        filename = filepath.name
        success, error = process_file(filepath)

        if success:
            print(f"✓ {filename}")
            success_count += 1
        elif error:
            print(f"✗ {filename}: {error}")
            failed_files.append((filename, error))
        else:
            print(f"- {filename}: Skipped")
            skipped_files.append(filename)

    print()
    print("="*60)
    print(f"Successfully updated: {success_count}")
    print(f"Failed: {len(failed_files)}")
    print(f"Skipped: {len(skipped_files)}")

    if failed_files:
        print("\nFailed files:")
        for filename, error in failed_files:
            print(f"  - {filename}: {error}")


if __name__ == "__main__":
    main()
