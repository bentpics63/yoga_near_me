/**
 * Blog Template JavaScript
 * Features: Reading progress, smooth scroll, TOC highlighting, lazy loading, performance optimizations
 */

(function() {
    'use strict';

    // ===== UTILITY FUNCTIONS =====

    /**
     * Debounce function for performance optimization
     */
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    /**
     * Throttle function for scroll events
     */
    function throttle(func, limit) {
        let inThrottle;
        return function(...args) {
            if (!inThrottle) {
                func.apply(this, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }

    /**
     * Check if element is in viewport
     */
    function isInViewport(element, threshold = 0.3) {
        const rect = element.getBoundingClientRect();
        const windowHeight = window.innerHeight || document.documentElement.clientHeight;
        const windowWidth = window.innerWidth || document.documentElement.clientWidth;

        return (
            rect.top <= windowHeight * (1 - threshold) &&
            rect.bottom >= windowHeight * threshold &&
            rect.left >= 0 &&
            rect.right <= windowWidth
        );
    }

    /**
     * Get scroll percentage of the document
     */
    function getScrollPercentage() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
        return Math.min(Math.max(scrollTop / scrollHeight, 0), 1);
    }

    // ===== READING PROGRESS BAR =====

    class ReadingProgress {
        constructor() {
            this.progressBar = document.getElementById('reading-progress-bar');
            this.init();
        }

        init() {
            if (!this.progressBar) return;

            // Update progress on scroll
            const updateProgress = throttle(() => {
                const progress = getScrollPercentage();
                this.progressBar.style.width = `${progress * 100}%`;
            }, 16); // ~60fps

            window.addEventListener('scroll', updateProgress, { passive: true });

            // Initial update
            updateProgress();
        }
    }

    // ===== TABLE OF CONTENTS =====

    class TableOfContents {
        constructor() {
            this.toc = document.querySelector('.table-of-contents');
            this.tocLinks = document.querySelectorAll('.toc-link');
            this.sections = [];
            this.currentActive = null;
            this.init();
        }

        init() {
            if (!this.toc || this.tocLinks.length === 0) return;

            // Get all sections that correspond to TOC links
            this.tocLinks.forEach(link => {
                const href = link.getAttribute('href');
                if (href && href.startsWith('#')) {
                    const sectionId = href.substring(1);
                    const section = document.getElementById(sectionId);
                    if (section) {
                        this.sections.push({
                            element: section,
                            link: link,
                            id: sectionId
                        });
                    }
                }
            });

            // Set up scroll listener for active section highlighting
            const updateActiveSection = throttle(() => {
                this.updateActiveSection();
            }, 16);

            window.addEventListener('scroll', updateActiveSection, { passive: true });

            // Set up click handlers for smooth scrolling
            this.setupSmoothScrolling();

            // Initial update
            this.updateActiveSection();
        }

        setupSmoothScrolling() {
            this.tocLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const href = link.getAttribute('href');
                    if (href && href.startsWith('#')) {
                        const targetElement = document.querySelector(href);
                        if (targetElement) {
                            this.smoothScrollTo(targetElement);
                        }
                    }
                });
            });
        }

        smoothScrollTo(element) {
            const headerHeight = document.querySelector('.site-header')?.offsetHeight || 0;
            const offset = headerHeight + 20; // Extra padding
            const targetPosition = element.offsetTop - offset;

            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }

        updateActiveSection() {
            const scrollPosition = window.pageYOffset + window.innerHeight * 0.3;
            let activeSection = null;

            // Find the section that's currently in the optimal viewing position
            for (let i = this.sections.length - 1; i >= 0; i--) {
                const section = this.sections[i];
                if (section.element.offsetTop <= scrollPosition) {
                    activeSection = section;
                    break;
                }
            }

            // Update active link
            if (activeSection && activeSection !== this.currentActive) {
                // Remove active class from all links
                this.tocLinks.forEach(link => link.classList.remove('active'));

                // Add active class to current link
                if (activeSection.link) {
                    activeSection.link.classList.add('active');
                }

                this.currentActive = activeSection;
            }
        }
    }

    // ===== LAZY LOADING =====

    class LazyLoader {
        constructor() {
            this.images = document.querySelectorAll('img[loading="lazy"]');
            this.init();
        }

        init() {
            // Use Intersection Observer if available, fallback to scroll-based loading
            if ('IntersectionObserver' in window) {
                this.setupIntersectionObserver();
            } else {
                this.setupScrollBasedLoading();
            }
        }

        setupIntersectionObserver() {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        this.loadImage(img);
                        observer.unobserve(img);
                    }
                });
            }, {
                rootMargin: '50px 0px',
                threshold: 0.01
            });

            this.images.forEach(img => {
                imageObserver.observe(img);
            });
        }

        setupScrollBasedLoading() {
            const loadVisibleImages = throttle(() => {
                this.images.forEach(img => {
                    if (!img.dataset.loaded && isInViewport(img, 0.1)) {
                        this.loadImage(img);
                    }
                });
            }, 100);

            window.addEventListener('scroll', loadVisibleImages, { passive: true });
            window.addEventListener('resize', loadVisibleImages, { passive: true });

            // Initial load
            loadVisibleImages();
        }

        loadImage(img) {
            // Handle picture elements with WebP sources
            const picture = img.closest('picture');
            if (picture) {
                const sources = picture.querySelectorAll('source');
                sources.forEach(source => {
                    if (source.dataset.srcset) {
                        source.srcset = source.dataset.srcset;
                        source.removeAttribute('data-srcset');
                    }
                });
            }

            // Load the main image
            if (img.dataset.src) {
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
            }

            // Add fade-in animation
            img.style.opacity = '0';
            img.style.transition = 'opacity 0.3s ease';

            img.onload = () => {
                img.style.opacity = '1';
                img.dataset.loaded = 'true';
            };

            img.onerror = () => {
                img.style.opacity = '1';
                img.dataset.loaded = 'true';
            };
        }
    }

    // ===== MOBILE MENU =====

    class MobileMenu {
        constructor() {
            this.menuToggle = document.querySelector('.mobile-menu-toggle');
            this.navMenu = document.querySelector('.nav-menu');
            this.isOpen = false;
            this.init();
        }

        init() {
            if (!this.menuToggle || !this.navMenu) return;

            this.menuToggle.addEventListener('click', () => {
                this.toggle();
            });

            // Close menu when clicking outside
            document.addEventListener('click', (e) => {
                if (this.isOpen && !this.menuToggle.contains(e.target) && !this.navMenu.contains(e.target)) {
                    this.close();
                }
            });

            // Close menu on escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && this.isOpen) {
                    this.close();
                }
            });

            // Close menu on resize to desktop
            window.addEventListener('resize', debounce(() => {
                if (window.innerWidth >= 768 && this.isOpen) {
                    this.close();
                }
            }, 250));
        }

        toggle() {
            if (this.isOpen) {
                this.close();
            } else {
                this.open();
            }
        }

        open() {
            this.isOpen = true;
            this.menuToggle.setAttribute('aria-expanded', 'true');
            this.navMenu.classList.add('mobile-open');
            document.body.style.overflow = 'hidden';

            // Animate hamburger lines
            const lines = this.menuToggle.querySelectorAll('.hamburger-line');
            lines[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
            lines[1].style.opacity = '0';
            lines[2].style.transform = 'rotate(-45deg) translate(7px, -6px)';
        }

        close() {
            this.isOpen = false;
            this.menuToggle.setAttribute('aria-expanded', 'false');
            this.navMenu.classList.remove('mobile-open');
            document.body.style.overflow = '';

            // Reset hamburger lines
            const lines = this.menuToggle.querySelectorAll('.hamburger-line');
            lines[0].style.transform = '';
            lines[1].style.opacity = '';
            lines[2].style.transform = '';
        }
    }

    // ===== SMOOTH SCROLLING FOR ALL ANCHOR LINKS =====

    class SmoothScroll {
        constructor() {
            this.init();
        }

        init() {
            // Handle all anchor links
            document.addEventListener('click', (e) => {
                const link = e.target.closest('a[href^="#"]');
                if (!link) return;

                const href = link.getAttribute('href');
                if (href === '#') return;

                const targetElement = document.querySelector(href);
                if (!targetElement) return;

                e.preventDefault();
                this.scrollToElement(targetElement);
            });
        }

        scrollToElement(element) {
            const headerHeight = document.querySelector('.site-header')?.offsetHeight || 0;
            const offset = headerHeight + 20; // Extra padding
            const targetPosition = element.offsetTop - offset;

            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }
    }

    // ===== PERFORMANCE OPTIMIZATIONS =====

    class PerformanceOptimizer {
        constructor() {
            this.init();
        }

        init() {
            this.preloadCriticalImages();
            this.optimizeScrolling();
            this.setupResourceHints();
        }

        preloadCriticalImages() {
            // Preload hero image
            const heroImage = document.querySelector('.hero-image img');
            if (heroImage && heroImage.src) {
                const link = document.createElement('link');
                link.rel = 'preload';
                link.as = 'image';
                link.href = heroImage.src;
                document.head.appendChild(link);
            }
        }

        optimizeScrolling() {
            // Add passive event listeners for better scroll performance
            let ticking = false;

            function updateScrollElements() {
                // Any additional scroll-dependent updates can go here
                ticking = false;
            }

            function requestScrollUpdate() {
                if (!ticking) {
                    requestAnimationFrame(updateScrollElements);
                    ticking = true;
                }
            }

            window.addEventListener('scroll', requestScrollUpdate, { passive: true });
        }

        setupResourceHints() {
            // Add DNS prefetch for external domains
            const externalDomains = [
                'fonts.googleapis.com',
                'fonts.gstatic.com',
                'images.unsplash.com',
                'cdnjs.cloudflare.com'
            ];

            externalDomains.forEach(domain => {
                const link = document.createElement('link');
                link.rel = 'dns-prefetch';
                link.href = `//${domain}`;
                document.head.appendChild(link);
            });
        }
    }

    // ===== ACCESSIBILITY ENHANCEMENTS =====

    class AccessibilityEnhancer {
        constructor() {
            this.init();
        }

        init() {
            this.setupKeyboardNavigation();
            this.enhanceFocusManagement();
            this.setupReducedMotion();
        }

        setupKeyboardNavigation() {
            // Improve keyboard navigation for custom elements
            document.addEventListener('keydown', (e) => {
                // Handle escape key for various interactive elements
                if (e.key === 'Escape') {
                    const activeElement = document.activeElement;
                    if (activeElement && activeElement.blur) {
                        activeElement.blur();
                    }
                }
            });
        }

        enhanceFocusManagement() {
            // Ensure proper focus management for dynamic content
            const focusableElements = 'a[href], button, textarea, input[type="text"], input[type="radio"], input[type="checkbox"], select';

            // Skip links functionality
            const skipLink = document.querySelector('.skip-link');
            if (skipLink) {
                skipLink.addEventListener('click', (e) => {
                    e.preventDefault();
                    const target = document.querySelector(skipLink.getAttribute('href'));
                    if (target) {
                        target.setAttribute('tabindex', '-1');
                        target.focus();
                        target.addEventListener('blur', () => {
                            target.removeAttribute('tabindex');
                        }, { once: true });
                    }
                });
            }
        }

        setupReducedMotion() {
            // Respect user's motion preferences
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

            if (prefersReducedMotion.matches) {
                // Disable smooth scrolling
                document.documentElement.style.scrollBehavior = 'auto';

                // Reduce animation durations
                const style = document.createElement('style');
                style.textContent = `
                    *, *::before, *::after {
                        animation-duration: 0.01ms !important;
                        animation-iteration-count: 1 !important;
                        transition-duration: 0.01ms !important;
                    }
                `;
                document.head.appendChild(style);
            }
        }
    }

    // ===== VIDEO OPTIMIZATION =====

    class VideoOptimizer {
        constructor() {
            this.videos = document.querySelectorAll('iframe[src*="youtube"], iframe[src*="vimeo"]');
            this.init();
        }

        init() {
            if (this.videos.length === 0) return;

            // Lazy load videos using Intersection Observer
            if ('IntersectionObserver' in window) {
                this.setupVideoLazyLoading();
            }
        }

        setupVideoLazyLoading() {
            const videoObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const iframe = entry.target;

                        // Add loading attribute if not present
                        if (!iframe.hasAttribute('loading')) {
                            iframe.setAttribute('loading', 'lazy');
                        }

                        videoObserver.unobserve(iframe);
                    }
                });
            }, {
                rootMargin: '100px 0px',
                threshold: 0.01
            });

            this.videos.forEach(video => {
                videoObserver.observe(video);
            });
        }
    }

    // ===== STYLE SWITCHER (for different yoga styles) =====

    class StyleSwitcher {
        constructor() {
            this.styleColors = {
                'vinyasa': '#ff5733',
                'power': '#ff5733',
                'hatha': '#B8BD5',
                'yin': '#706677',
                'restorative': '#706677',
                'hot': '#FFD966',
                'bikram': '#FFD966',
                'kundalini': '#FFD966',
                'ashtanga': '#5f7470',
                'iyengar': '#5f7470'
            };
            this.init();
        }

        init() {
            // Detect yoga style from meta tags or data attributes
            const styleTag = document.querySelector('meta[name="yoga-style"]');
            const bodyStyle = document.body.dataset.yogaStyle;

            const yogaStyle = styleTag?.content?.toLowerCase() || bodyStyle?.toLowerCase();

            if (yogaStyle && this.styleColors[yogaStyle]) {
                this.applyStyleColor(this.styleColors[yogaStyle]);
            }
        }

        applyStyleColor(color) {
            document.documentElement.style.setProperty('--style-color', color);

            // Update theme-color meta tag for mobile browsers
            let themeColorMeta = document.querySelector('meta[name="theme-color"]');
            if (!themeColorMeta) {
                themeColorMeta = document.createElement('meta');
                themeColorMeta.name = 'theme-color';
                document.head.appendChild(themeColorMeta);
            }
            themeColorMeta.content = color;
        }
    }

    // ===== INITIALIZATION =====

    function initializeBlogTemplate() {
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }

        function init() {
            try {
                // Initialize all components
                new ReadingProgress();
                new TableOfContents();
                new LazyLoader();
                new MobileMenu();
                new SmoothScroll();
                new PerformanceOptimizer();
                new AccessibilityEnhancer();
                new VideoOptimizer();
                new StyleSwitcher();

                // Mark page as fully initialized
                document.body.classList.add('js-loaded');

                console.log('Blog template initialized successfully');
            } catch (error) {
                console.error('Error initializing blog template:', error);
            }
        }
    }

    // ===== ERROR HANDLING AND FALLBACKS =====

    window.addEventListener('error', (e) => {
        console.error('JavaScript error in blog template:', e.error);
    });

    // ===== ANALYTICS HELPERS =====

    function trackScrollDepth() {
        const scrollMilestones = [25, 50, 75, 90];
        const tracked = new Set();

        const checkScrollDepth = throttle(() => {
            const scrollPercent = getScrollPercentage() * 100;

            scrollMilestones.forEach(milestone => {
                if (scrollPercent >= milestone && !tracked.has(milestone)) {
                    tracked.add(milestone);

                    // Send to your analytics service
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'scroll_depth', {
                            event_category: 'engagement',
                            event_label: `${milestone}%`,
                            value: milestone
                        });
                    }
                }
            });
        }, 250);

        window.addEventListener('scroll', checkScrollDepth, { passive: true });
    }

    // ===== EXPORT FOR WORDPRESS/ELEMENTOR =====

    // Make functions available globally for WordPress/Elementor integration
    window.YogaBlogTemplate = {
        init: initializeBlogTemplate,
        components: {
            ReadingProgress,
            TableOfContents,
            LazyLoader,
            MobileMenu,
            SmoothScroll,
            StyleSwitcher
        },
        utils: {
            debounce,
            throttle,
            isInViewport,
            getScrollPercentage
        }
    };

    // Auto-initialize
    initializeBlogTemplate();

    // Optional: Enable scroll depth tracking
    // trackScrollDepth();

})();