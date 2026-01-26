# **Claude Code Prompt: Yoga Near Me Blog Template**

## **Project Overview**

Create a production-ready, magazine-style blog template for Yoga Near Me that excels in UI/UX design principles, SEO optimization, and reading experience. This template will be used for in-depth yoga style articles targeting athletic-minded individuals seeking spiritual practice outside traditional Western religious frameworks.

---

## **Design Requirements**

### **Style Guide Compliance**

**CRITICAL**: Follow the attached `yoganearme-style-guide.md` exactly for:

* Color palette and usage  
* Typography specifications  
* Layout structure  
* Component designs  
* Brand voice and tone

### **Design Philosophy Priority Order**

1. **Reading experience first** \- This is long-form educational content  
2. **Mobile optimization** \- Must be excellent on phones, not just "responsive"  
3. **Performance** \- Fast loading is essential for SEO and UX  
4. **Accessibility** \- WCAG 2.1 AA compliance minimum  
5. **SEO structure** \- Semantic HTML optimized for search engines

---

## **UI/UX Best Practices to Implement**

### **Visual Hierarchy**

* Create clear F-pattern or Z-pattern reading flow  
* Ensure 3-second comprehension test passes (user understands content type immediately)  
* Progressive disclosure for complex information  
* Strategic use of white space to guide eye movement  
* Contrast ratio: 4.5:1 minimum for body text, 3:1 for large text

### **Reading Experience Optimization**

* **Optimal line length**: 60-75 characters per line  
* **Line height**: 1.7-1.8 for body text  
* **Paragraph spacing**: 1.5-2em between paragraphs  
* **Font size**: Minimum 18px for body text (comfortable reading without zoom)  
* **Scanning aids**: Clear subheadings every 3-4 paragraphs, bullet points for lists  
* **Visual breaks**: Pull quotes, images, callout boxes to prevent wall-of-text

### **Navigation & Wayfinding**

* Sticky header with minimal height (50-60px)  
* Breadcrumbs for context  
* Reading progress indicator (top of page, style-colored)  
* Table of contents with auto-highlighting active section  
* "Back to top" button appearing after scroll  
* Clear next/previous article navigation

### **Interaction Design**

* **Touch targets**: Minimum 44x44px on mobile  
* **Hover states**: Smooth transitions (0.3s) with visual feedback  
* **Loading states**: Skeleton screens or progressive loading for images  
* **Error prevention**: Form validation, confirmation for destructive actions  
* **Feedback**: Clear visual response to all user actions  
* **Animation**: Purposeful, not decorative \- respects prefers-reduced-motion

### **Mobile-First Approach**

* Design for 375px width first, scale up  
* Thumb-zone optimization (important actions in easy-reach areas)  
* Simplified navigation for mobile (hamburger menu with clear close)  
* Touch-friendly spacing (16px minimum between interactive elements)  
* Horizontal scrolling avoided (except intentional carousels)  
* Image optimization for mobile bandwidth

### **Performance Optimization**

* **Critical CSS**: Inline above-the-fold styles  
* **Lazy loading**: Images below fold, iframes, heavy components  
* **Font loading**: font-display: swap to prevent FOIT  
* **Image formats**: WebP with JPEG fallback, proper sizing  
* **Code splitting**: Separate critical from non-critical JavaScript  
* **Target metrics**:  
  * First Contentful Paint: \< 1.8s  
  * Largest Contentful Paint: \< 2.5s  
  * Cumulative Layout Shift: \< 0.1  
  * Time to Interactive: \< 3.8s  
  * Total page weight: \< 1MB

---

## **SEO Optimization Requirements**

### **HTML Structure (CRITICAL)**

\<\!DOCTYPE html\>  
\<html lang="en"\>  
\<head\>  
  \<\!-- Essential Meta Tags \--\>  
  \<meta charset="UTF-8"\>  
  \<meta name="viewport" content="width=device-width, initial-scale=1.0"\>  
  \<meta name="description" content="\[150-160 char description\]"\>  
    
  \<\!-- Title Optimization \--\>  
  \<title\>\[Yoga Style\]: \[Benefit\] | Yoga Near Me\</title\>  
    
  \<\!-- Open Graph \--\>  
  \<meta property="og:title" content="\[Article Title\]"\>  
  \<meta property="og:description" content="\[Description\]"\>  
  \<meta property="og:image" content="\[1200x630 image URL\]"\>  
  \<meta property="og:url" content="\[Canonical URL\]"\>  
  \<meta property="og:type" content="article"\>  
    
  \<\!-- Twitter Card \--\>  
  \<meta name="twitter:card" content="summary\_large\_image"\>  
  \<meta name="twitter:title" content="\[Article Title\]"\>  
  \<meta name="twitter:description" content="\[Description\]"\>  
  \<meta name="twitter:image" content="\[Image URL\]"\>  
    
  \<\!-- Canonical URL \--\>  
  \<link rel="canonical" href="\[Page URL\]"\>  
    
  \<\!-- Preconnect for Performance \--\>  
  \<link rel="preconnect" href="https://fonts.googleapis.com"\>  
  \<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin\>  
    
  \<\!-- Structured Data (JSON-LD) \- SEE BELOW \--\>  
  \<script type="application/ld+json"\>  
    {/\* Article Schema \*/}  
  \</script\>  
\</head\>

### **Semantic HTML Structure**

\<body\>  
  \<\!-- Skip to main content for accessibility \--\>  
  \<a href="\#main-content" class="skip-link"\>Skip to main content\</a\>  
    
  \<header role="banner"\>  
    \<\!-- Site header with nav \--\>  
  \</header\>  
    
  \<main id="main-content" role="main"\>  
    \<article itemscope itemtype="https://schema.org/Article"\>  
      \<\!-- Article content with proper heading hierarchy \--\>  
      \<header\>  
        \<h1 itemprop="headline"\>\<\!-- Only ONE H1 per page \--\>\</h1\>  
        \<div itemprop="author" itemscope itemtype="https://schema.org/Person"\>  
          \<span itemprop="name"\>Author Name\</span\>  
        \</div\>  
        \<time itemprop="datePublished" datetime="YYYY-MM-DD"\>Date\</time\>  
      \</header\>  
        
      \<\!-- Content sections with proper H2, H3 hierarchy \--\>  
      \<div itemprop="articleBody"\>  
        \<\!-- Content here \--\>  
      \</div\>  
    \</article\>  
  \</main\>  
    
  \<footer role="contentinfo"\>  
    \<\!-- Site footer \--\>  
  \</footer\>  
\</body\>

### **Structured Data (JSON-LD)**

Include comprehensive schema.org markup:

{  
  "@context": "https://schema.org",  
  "@type": "Article",  
  "headline": "Article Title Here",  
  "description": "Article description",  
  "image": "https://yoganearme.info/images/article-image.jpg",  
  "datePublished": "2024-01-15T08:00:00+00:00",  
  "dateModified": "2024-01-15T08:00:00+00:00",  
  "author": {  
    "@type": "Person",  
    "name": "Author Name",  
    "url": "https://yoganearme.info/author/name"  
  },  
  "publisher": {  
    "@type": "Organization",  
    "name": "Yoga Near Me",  
    "logo": {  
      "@type": "ImageObject",  
      "url": "https://yoganearme.info/logo.png"  
    }  
  },  
  "mainEntityOfPage": {  
    "@type": "WebPage",  
    "@id": "https://yoganearme.info/article-url"  
  },  
  "articleSection": "Yoga Styles",  
  "keywords": \["hatha yoga", "yoga for beginners", "yoga styles"\],  
  "wordCount": "2500"  
}

### **On-Page SEO Elements**

* **Title tag**: 50-60 characters, front-load primary keyword  
* **Meta description**: 150-160 characters, compelling with call-to-action  
* **H1**: Single H1 containing primary keyword naturally  
* **H2-H6**: Logical hierarchy with semantic keywords  
* **Image alt text**: Descriptive, include keywords when natural  
* **Internal linking**: Link to related articles, use descriptive anchor text  
* **URL structure**: Clean, descriptive slugs (e.g., /blog/hatha-yoga-beginners-guide)  
* **Reading time**: Display estimated reading time (good for dwell time)

### **Content Structure for SEO**

* **Introduction**: Address search intent in first 100 words  
* **Table of contents**: Linked jump points (creates featured snippet opportunity)  
* **FAQ section**: Structured with proper markup for rich snippets  
* **Related articles**: Internal linking with relevant anchor text  
* **Author bio**: With schema markup for E-E-A-T signals

### **Image Optimization**

* **File names**: Descriptive, keyword-rich (hatha-yoga-warrior-pose.jpg)  
* **Alt text**: Descriptive, contextual, include keywords naturally  
* **Captions**: When relevant, provide context  
* **Lazy loading**: Below fold images only  
* **Responsive images**: srcset with multiple sizes  
* **Format**: WebP with JPEG fallback  
* **Compression**: Maintain quality at \<100KB per image when possible

---

## **Technical Requirements**

### **HTML Standards**

* Valid HTML5 markup (test with W3C validator)  
* Semantic elements (article, section, aside, nav, header, footer)  
* ARIA labels where appropriate  
* Skip links for keyboard navigation  
* Focus management for interactive elements

### **CSS Architecture**

/\* Use CSS Custom Properties for maintainability \*/  
:root {  
  /\* Colors from style guide \*/  
  \--primary-color: \#5f7470;  
  \--text-primary: \#393939;  
  \--accent-bg: \#E0E2DB;  
  \--secondary-color: \#61948B;  
  \--highlight-coral: \#ff5733;  
  \--highlight-purple: \#706677;  
  \--highlight-sage: \#B8BD5;  
  \--highlight-gold: \#FFD966;  
    
  /\* Typography \*/  
  \--font-body: 'Roboto', sans-serif;  
  \--font-heading: 'Playfair Display', serif; /\* or chosen display font \*/  
    
  /\* Spacing system \*/  
  \--space-xs: 0.5rem;  
  \--space-sm: 1rem;  
  \--space-md: 1.5rem;  
  \--space-lg: 2rem;  
  \--space-xl: 3rem;  
  \--space-xxl: 4rem;  
    
  /\* Transitions \*/  
  \--transition-fast: 0.2s ease;  
  \--transition-normal: 0.3s ease;  
  \--transition-slow: 0.5s ease;  
}

/\* Mobile-first media queries \*/  
@media (min-width: 768px) { /\* Tablet \*/ }  
@media (min-width: 1024px) { /\* Desktop \*/ }

### **JavaScript Best Practices**

* Vanilla JavaScript (no jQuery dependency)  
* Event delegation for efficiency  
* Debounce/throttle scroll events  
* Lazy loading with Intersection Observer API  
* Progressive enhancement (works without JS for core content)  
* Error handling for all async operations

### **Accessibility Checklist**

* \[ \] Keyboard navigation for all interactive elements  
* \[ \] Focus indicators visible and styled  
* \[ \] Skip links to main content  
* \[ \] ARIA labels for icon buttons  
* \[ \] Alt text for all images  
* \[ \] Color not sole indicator of meaning  
* \[ \] Form labels properly associated  
* \[ \] Heading hierarchy logical (no skipped levels)  
* \[ \] Link text descriptive (no "click here")  
* \[ \] Sufficient color contrast (test with tools)

### **Browser Support**

* Chrome, Firefox, Safari, Edge (last 2 versions)  
* iOS Safari 13+  
* Android Chrome 80+  
* Progressive enhancement for older browsers

---

## **Deliverables Required**

### **File Structure**

yoga-blog-template/  
├── index.html                 (Complete working example)  
├── css/  
│   ├── main.css              (All styles, organized by section)  
│   └── print.css             (Print-optimized styles)  
├── js/  
│   ├── main.js               (Core functionality)  
│   └── analytics.js          (Tracking setup \- placeholder)  
├── images/  
│   └── placeholder/          (Sized placeholder images)  
├── README.md                 (Implementation guide)  
└── elementor-guide.md        (How to implement in Elementor Pro)

### **CSS File Organization**

/\* 1\. CSS Reset & Base Styles \*/  
/\* 2\. CSS Custom Properties \*/  
/\* 3\. Typography \*/  
/\* 4\. Layout & Grid \*/  
/\* 5\. Components (buttons, cards, etc.) \*/  
/\* 6\. Header \*/  
/\* 7\. Hero Section \*/  
/\* 8\. Article Content \*/  
/\* 9\. Sidebar/TOC \*/  
/\* 10\. Footer \*/  
/\* 11\. Responsive (mobile-first) \*/  
/\* 12\. Print Styles \*/  
/\* 13\. Accessibility \*/

### **JavaScript Features**

* Reading progress bar with smooth animation  
* Smooth scroll for anchor links  
* Table of contents auto-highlighting  
* Scroll-to-top button (appears after scroll)  
* Lazy loading for images and iframes  
* Social sharing functionality  
* Mobile menu toggle with accessibility  
* Analytics tracking hooks (placeholder functions)

### **Documentation**

* **README.md**: How to use the template  
* **Implementation notes**: WordPress/Elementor specific guidance  
* **Customization guide**: How to adapt for different yoga styles  
* **Performance checklist**: Optimization verification  
* **SEO checklist**: Pre-launch validation

---

## **Style-Specific Variations**

Create CSS custom property system for easy style switching:

/\* Default (Hatha) \*/  
body.yoga-hatha {  
  \--style-color: \#B8BD5;  
}

body.yoga-vinyasa {  
  \--style-color: \#ff5733;  
}

body.yoga-yin {  
  \--style-color: \#706677;  
}

body.yoga-hot {  
  \--style-color: \#FFD966;  
}

/\* Apply style color to relevant elements \*/  
.hero-overlay {  
  background: linear-gradient(135deg, var(--style-color), var(--primary-color));  
}

.section-title::after {  
  background: var(--style-color);  
}

.cta-button {  
  background: var(--style-color);  
}

---

## **Quality Assurance Checklist**

Before delivery, verify:

### **Performance**

* \[ \] PageSpeed Insights score 90+ (mobile and desktop)  
* \[ \] All images optimized and lazy loaded  
* \[ \] Critical CSS inlined  
* \[ \] No render-blocking resources  
* \[ \] Smooth 60fps scrolling

### **SEO**

* \[ \] Single H1 per page with primary keyword  
* \[ \] Logical heading hierarchy (H1→H2→H3, no skips)  
* \[ \] Meta description compelling and within character limit  
* \[ \] Structured data validates (Google Rich Results Test)  
* \[ \] Open Graph tags complete  
* \[ \] Internal linking implemented  
* \[ \] Image alt text descriptive

### **Accessibility**

* \[ \] WAVE scanner shows no errors  
* \[ \] Keyboard navigation complete  
* \[ \] Color contrast passes WCAG AA  
* \[ \] Screen reader friendly (test with NVDA/JAWS)  
* \[ \] Focus indicators visible

### **UX**

* \[ \] 3-second comprehension test passes  
* \[ \] Mobile thumb zones optimized  
* \[ \] Touch targets 44x44px minimum  
* \[ \] Loading states for async content  
* \[ \] Error handling graceful  
* \[ \] Works without JavaScript (core content)

### **Cross-Browser**

* \[ \] Chrome (latest)  
* \[ \] Firefox (latest)  
* \[ \] Safari (iOS and desktop)  
* \[ \] Edge (latest)  
* \[ \] Test on actual mobile devices

### **Responsive**

* \[ \] 375px (iPhone SE)  
* \[ \] 768px (tablet portrait)  
* \[ \] 1024px (tablet landscape)  
* \[ \] 1440px (desktop)  
* \[ \] 1920px (large desktop)

---

## **Success Metrics**

The template should achieve:

* **PageSpeed Score**: 90+ mobile, 95+ desktop  
* **Accessibility Score**: 100 (Lighthouse)  
* **SEO Score**: 95+ (Lighthouse)  
* **Reading Comfort**: 18px minimum font, 60-75 char line length  
* **Mobile Usability**: Pass Google Mobile-Friendly Test  
* **Load Time**: \< 3 seconds on 3G connection  
* **Engagement**: Average session duration 3+ minutes (via compelling design)

---

## **Additional Notes**

* Comment your code clearly for future maintenance  
* Use BEM or similar naming convention for CSS classes  
* Keep specificity low (avoid \!important)  
* Prepare for easy Elementor Pro widget conversion  
* Include sample content that demonstrates all components  
* Provide color palette as CSS variables for easy customization  
* Create print stylesheet for article printing  
* Add analytics hooks (but don't implement actual tracking)

This template should serve as the foundation for all Yoga Near Me blog articles while being flexible enough to adapt per yoga style and maintain brand consistency with the main site.

