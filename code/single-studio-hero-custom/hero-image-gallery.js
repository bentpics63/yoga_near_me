/**
 * Single Studio - Hero Image Gallery JavaScript
 * Add to WordPress via Customizer > Additional JS or child theme
 *
 * Features:
 * - Auto-rotating thumbnails (paid tier)
 * - Lightbox gallery with keyboard navigation
 * - Touch/swipe support for mobile
 * - GeoDirectory integration ready
 */

(function() {
    'use strict';

    // =====================================================
    // CONFIGURATION
    // =====================================================

    const CONFIG = {
        rotationInterval: 4000,      // 4 seconds between rotations
        fadeTransition: 300,         // Fade transition duration in ms
        selectors: {
            gallery: '.studio-hero-gallery',
            heroMain: '.hero-main',
            heroImage: '.hero-main img',
            thumbnails: '.hero-thumbnails',
            thumbnailSlot: '.thumbnail-slot',
            rotatingSlot: '.thumbnail-slot.rotating',
            lightbox: '.gallery-lightbox',
            lightboxImage: '.gallery-lightbox .lightbox-content img',
            lightboxCounter: '.gallery-lightbox .lightbox-counter',
            lightboxClose: '.gallery-lightbox .lightbox-close',
            lightboxPrev: '.gallery-lightbox .lightbox-prev',
            lightboxNext: '.gallery-lightbox .lightbox-next'
        }
    };

    // =====================================================
    // GALLERY STATE
    // =====================================================

    let state = {
        currentIndex: 0,
        images: [],
        rotationTimer: null,
        rotationIndex: 0,
        isLightboxOpen: false,
        touchStartX: 0,
        touchEndX: 0
    };

    // =====================================================
    // INITIALIZATION
    // =====================================================

    function init() {
        const gallery = document.querySelector(CONFIG.selectors.gallery);
        if (!gallery) return;

        // Get all gallery images from data attribute or collect from DOM
        collectGalleryImages(gallery);

        // Setup event listeners
        setupClickHandlers(gallery);
        setupLightbox();
        setupAutoRotation(gallery);
        setupKeyboardNav();
        setupTouchNav();
    }

    // =====================================================
    // IMAGE COLLECTION
    // =====================================================

    function collectGalleryImages(gallery) {
        // Option 1: Get from data attribute (preferred for GeoDirectory)
        const dataImages = gallery.dataset.images;
        if (dataImages) {
            try {
                state.images = JSON.parse(dataImages);
                return;
            } catch (e) {
                console.warn('Could not parse gallery images data:', e);
            }
        }

        // Option 2: Collect from visible images in gallery
        const heroImg = gallery.querySelector(CONFIG.selectors.heroImage);
        const thumbImgs = gallery.querySelectorAll(CONFIG.selectors.thumbnailSlot + ' img');

        state.images = [];

        if (heroImg && heroImg.src) {
            state.images.push(getFullSizeUrl(heroImg.src));
        }

        thumbImgs.forEach(img => {
            if (img.src && !img.closest('.upgrade-slot')) {
                state.images.push(getFullSizeUrl(img.src));
            }
        });
    }

    // Convert thumbnail URL to full size (for WordPress/GeoDirectory)
    function getFullSizeUrl(url) {
        // Remove WordPress thumbnail size suffixes like -150x150, -300x200, etc.
        return url.replace(/-\d+x\d+(?=\.[a-z]+$)/i, '');
    }

    // =====================================================
    // CLICK HANDLERS
    // =====================================================

    function setupClickHandlers(gallery) {
        // Hero image click
        const heroMain = gallery.querySelector(CONFIG.selectors.heroMain);
        if (heroMain) {
            heroMain.addEventListener('click', () => openLightbox(0));
        }

        // Thumbnail clicks
        const thumbSlots = gallery.querySelectorAll(CONFIG.selectors.thumbnailSlot);
        thumbSlots.forEach((slot, index) => {
            // Skip upgrade slots
            if (slot.classList.contains('upgrade-slot')) return;

            slot.addEventListener('click', () => openLightbox(index + 1));
        });

        // View all button
        const viewAllBtn = gallery.querySelector('.view-all-btn a');
        if (viewAllBtn) {
            viewAllBtn.addEventListener('click', (e) => {
                e.preventDefault();
                openLightbox(0);
            });
        }
    }

    // =====================================================
    // AUTO-ROTATION
    // =====================================================

    function setupAutoRotation(gallery) {
        const rotatingSlot = gallery.querySelector(CONFIG.selectors.rotatingSlot);
        if (!rotatingSlot || state.images.length < 3) return;

        const img = rotatingSlot.querySelector('img');
        if (!img) return;

        // Get rotation images (skip hero, use images 2-6)
        const rotationImages = state.images.slice(1, 6);
        if (rotationImages.length < 2) return;

        // Add fade transition
        img.style.transition = `opacity ${CONFIG.fadeTransition}ms ease`;

        // Start rotation
        state.rotationTimer = setInterval(() => {
            state.rotationIndex = (state.rotationIndex + 1) % rotationImages.length;

            // Fade out
            img.style.opacity = '0';

            setTimeout(() => {
                img.src = rotationImages[state.rotationIndex];
                // Fade in
                img.style.opacity = '1';
            }, CONFIG.fadeTransition);

        }, CONFIG.rotationInterval);
    }

    function pauseRotation() {
        if (state.rotationTimer) {
            clearInterval(state.rotationTimer);
            state.rotationTimer = null;
        }
    }

    function resumeRotation() {
        const gallery = document.querySelector(CONFIG.selectors.gallery);
        if (gallery && !state.rotationTimer) {
            setupAutoRotation(gallery);
        }
    }

    // =====================================================
    // LIGHTBOX
    // =====================================================

    function setupLightbox() {
        // Create lightbox if it doesn't exist
        let lightbox = document.querySelector(CONFIG.selectors.lightbox);
        if (!lightbox) {
            lightbox = createLightboxElement();
            document.body.appendChild(lightbox);
        }

        // Close button
        const closeBtn = lightbox.querySelector(CONFIG.selectors.lightboxClose);
        if (closeBtn) {
            closeBtn.addEventListener('click', closeLightbox);
        }

        // Navigation buttons
        const prevBtn = lightbox.querySelector(CONFIG.selectors.lightboxPrev);
        const nextBtn = lightbox.querySelector(CONFIG.selectors.lightboxNext);

        if (prevBtn) prevBtn.addEventListener('click', () => navigateLightbox(-1));
        if (nextBtn) nextBtn.addEventListener('click', () => navigateLightbox(1));

        // Close on background click
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) closeLightbox();
        });
    }

    function createLightboxElement() {
        const lightbox = document.createElement('div');
        lightbox.className = 'gallery-lightbox';
        lightbox.innerHTML = `
            <button class="lightbox-close" aria-label="Close gallery">
                <i class="fas fa-times"></i>
            </button>
            <button class="lightbox-nav lightbox-prev" aria-label="Previous image">
                <i class="fas fa-chevron-left"></i>
            </button>
            <div class="lightbox-content">
                <img src="" alt="Gallery Image">
            </div>
            <button class="lightbox-nav lightbox-next" aria-label="Next image">
                <i class="fas fa-chevron-right"></i>
            </button>
            <div class="lightbox-counter">1 / 1</div>
        `;
        return lightbox;
    }

    function openLightbox(index) {
        if (state.images.length === 0) return;

        state.currentIndex = Math.max(0, Math.min(index, state.images.length - 1));
        state.isLightboxOpen = true;

        updateLightboxImage();

        const lightbox = document.querySelector(CONFIG.selectors.lightbox);
        if (lightbox) {
            lightbox.classList.add('active');
        }

        document.body.style.overflow = 'hidden';
        pauseRotation();
    }

    function closeLightbox() {
        state.isLightboxOpen = false;

        const lightbox = document.querySelector(CONFIG.selectors.lightbox);
        if (lightbox) {
            lightbox.classList.remove('active');
        }

        document.body.style.overflow = '';
        resumeRotation();
    }

    function navigateLightbox(direction) {
        state.currentIndex = (state.currentIndex + direction + state.images.length) % state.images.length;
        updateLightboxImage();
    }

    function updateLightboxImage() {
        const img = document.querySelector(CONFIG.selectors.lightboxImage);
        const counter = document.querySelector(CONFIG.selectors.lightboxCounter);

        if (img && state.images[state.currentIndex]) {
            img.src = state.images[state.currentIndex];
        }

        if (counter) {
            counter.textContent = `${state.currentIndex + 1} / ${state.images.length}`;
        }
    }

    // =====================================================
    // KEYBOARD NAVIGATION
    // =====================================================

    function setupKeyboardNav() {
        document.addEventListener('keydown', (e) => {
            if (!state.isLightboxOpen) return;

            switch (e.key) {
                case 'Escape':
                    closeLightbox();
                    break;
                case 'ArrowLeft':
                    navigateLightbox(-1);
                    break;
                case 'ArrowRight':
                    navigateLightbox(1);
                    break;
            }
        });
    }

    // =====================================================
    // TOUCH/SWIPE NAVIGATION
    // =====================================================

    function setupTouchNav() {
        const lightbox = document.querySelector(CONFIG.selectors.lightbox);
        if (!lightbox) return;

        lightbox.addEventListener('touchstart', (e) => {
            state.touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        lightbox.addEventListener('touchend', (e) => {
            state.touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });
    }

    function handleSwipe() {
        const threshold = 50; // Minimum swipe distance
        const diff = state.touchStartX - state.touchEndX;

        if (Math.abs(diff) < threshold) return;

        if (diff > 0) {
            // Swipe left - next image
            navigateLightbox(1);
        } else {
            // Swipe right - previous image
            navigateLightbox(-1);
        }
    }

    // =====================================================
    // GEODIRECTORY INTEGRATION
    // =====================================================

    /**
     * Initialize gallery with GeoDirectory images
     * Call this from your GeoDirectory template or hook
     *
     * @param {Array} images - Array of image URLs
     * @param {string} gallerySelector - Optional custom gallery selector
     *
     * Usage in PHP:
     * <script>
     *   document.addEventListener('DOMContentLoaded', function() {
     *     if (typeof StudioHeroGallery !== 'undefined') {
     *       StudioHeroGallery.setImages(<?php echo json_encode($images); ?>);
     *     }
     *   });
     * </script>
     */
    function setImages(images, gallerySelector) {
        if (!Array.isArray(images)) return;

        state.images = images;

        // Optionally update the gallery DOM with new images
        const gallery = document.querySelector(gallerySelector || CONFIG.selectors.gallery);
        if (gallery && images.length > 0) {
            updateGalleryDOM(gallery, images);
        }
    }

    function updateGalleryDOM(gallery, images) {
        // Update hero image
        const heroImg = gallery.querySelector(CONFIG.selectors.heroImage);
        if (heroImg && images[0]) {
            heroImg.src = images[0];
        }

        // Update thumbnails
        const thumbSlots = gallery.querySelectorAll(CONFIG.selectors.thumbnailSlot + ':not(.upgrade-slot)');
        thumbSlots.forEach((slot, index) => {
            const img = slot.querySelector('img');
            if (img && images[index + 1]) {
                img.src = images[index + 1];
            }
        });

        // Update image count badge
        const countBadge = gallery.querySelector('.image-count');
        if (countBadge && images.length > 3) {
            countBadge.innerHTML = `<i class="fas fa-images"></i> +${images.length - 3} more`;
        }
    }

    // =====================================================
    // PUBLIC API
    // =====================================================

    window.StudioHeroGallery = {
        init: init,
        setImages: setImages,
        openLightbox: openLightbox,
        closeLightbox: closeLightbox,
        pauseRotation: pauseRotation,
        resumeRotation: resumeRotation
    };

    // =====================================================
    // AUTO-INIT ON DOM READY
    // =====================================================

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
