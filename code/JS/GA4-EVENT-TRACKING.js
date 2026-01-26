/**
 * YogaNearMe.info - GA4 Event Tracking
 *
 * Tracks user interactions for:
 * 1. Studio listing performance (views, clicks)
 * 2. Conversion actions (offer claims, phone clicks, booking clicks)
 * 3. Search behavior (filters, results)
 *
 * REQUIREMENTS:
 * - GA4 installed on site (gtag.js loaded)
 * - ynmPageData object populated by PHP (see below)
 *
 * INSTALLATION:
 * 1. Add GA4 tracking code to site (Google Site Kit or manual)
 * 2. Enqueue this script in functions.php
 * 3. Add ynm_localize_tracking_data() to populate page data
 *
 * @version 1.0.0
 */

(function() {
    'use strict';

    // =============================================================================
    // CHECK DEPENDENCIES
    // =============================================================================

    // Verify gtag exists
    if (typeof gtag !== 'function') {
        console.warn('YNM Tracking: gtag not found. GA4 events will not fire.');
        return;
    }

    // Get page data (populated by PHP)
    var pageData = window.ynmPageData || {};

    // =============================================================================
    // UTILITY FUNCTIONS
    // =============================================================================

    /**
     * Send event to GA4
     */
    function trackEvent(eventName, params) {
        params = params || {};

        // Add common parameters
        params.page_type = pageData.pageType || 'unknown';

        gtag('event', eventName, params);

        // Debug logging (remove in production)
        if (pageData.debug) {
            console.log('YNM Event:', eventName, params);
        }
    }

    /**
     * Get listing data from closest card or page
     */
    function getListingData(element) {
        var card = element.closest('[data-listing-id]') ||
                   element.closest('.geodir-post') ||
                   document.querySelector('[data-listing-id]');

        if (card) {
            return {
                listing_id: card.dataset.listingId || '',
                studio_name: card.dataset.studioName || '',
                city: card.dataset.city || '',
                has_offer: card.dataset.hasOffer || 'false',
                position: card.dataset.position || ''
            };
        }

        // Fallback to page data (single listing page)
        return {
            listing_id: pageData.listingId || '',
            studio_name: pageData.studioName || '',
            city: pageData.city || '',
            has_offer: pageData.hasOffer || 'false'
        };
    }

    // =============================================================================
    // PAGE VIEW TRACKING
    // =============================================================================

    /**
     * Track single listing page view
     */
    if (pageData.pageType === 'single_listing') {
        trackEvent('listing_view', {
            listing_id: pageData.listingId,
            studio_name: pageData.studioName,
            city: pageData.city,
            has_offer: pageData.hasOffer,
            has_photos: pageData.hasPhotos,
            profile_completion: pageData.profileCompletion
        });
    }

    /**
     * Track search results page view
     */
    if (pageData.pageType === 'search_results') {
        trackEvent('search_view', {
            search_query: pageData.searchQuery || '',
            result_count: pageData.resultCount || 0,
            location: pageData.searchLocation || ''
        });
    }

    // =============================================================================
    // CARD IMPRESSION TRACKING (Search Results)
    // =============================================================================

    /**
     * Track when listing cards scroll into view
     */
    if ('IntersectionObserver' in window) {
        var cardObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var card = entry.target;
                    var data = getListingData(card);

                    trackEvent('card_impression', {
                        listing_id: data.listing_id,
                        studio_name: data.studio_name,
                        position: data.position,
                        has_offer: data.has_offer
                    });

                    // Only track once per page load
                    cardObserver.unobserve(card);
                }
            });
        }, {
            threshold: 0.5 // Card must be 50% visible
        });

        // Observe all listing cards
        document.querySelectorAll('.geodir-post, [data-listing-id]').forEach(function(card) {
            cardObserver.observe(card);
        });
    }

    // =============================================================================
    // CLICK TRACKING
    // =============================================================================

    document.addEventListener('click', function(e) {

        // ----- Card Click (from search results) -----
        var card = e.target.closest('.geodir-post, .ynm-card');
        if (card && !e.target.closest('a, button')) {
            // Click on card but not on a specific link
            var data = getListingData(card);
            trackEvent('card_click', {
                listing_id: data.listing_id,
                studio_name: data.studio_name,
                position: data.position
            });
        }

        // ----- Claim Offer Button -----
        var claimBtn = e.target.closest('.claim-offer-btn, .ynm-claim-btn, [class*="claim-offer"], [data-action="claim-offer"]');
        if (claimBtn) {
            var data = getListingData(claimBtn);
            trackEvent('claim_offer_click', {
                listing_id: data.listing_id,
                studio_name: data.studio_name,
                offer_text: claimBtn.dataset.offer || pageData.introOffer || ''
            });
        }

        // ----- Book Online Button -----
        var bookBtn = e.target.closest('.book-class-btn, [class*="book-online"], [data-action="book"], a[href*="book"]');
        if (bookBtn && !bookBtn.closest('.claim-offer-btn')) {
            var data = getListingData(bookBtn);
            trackEvent('booking_click', {
                listing_id: data.listing_id,
                studio_name: data.studio_name,
                booking_url: bookBtn.href || ''
            });
        }

        // ----- Phone Click -----
        var phoneLink = e.target.closest('a[href^="tel:"]');
        if (phoneLink) {
            var data = getListingData(phoneLink);
            trackEvent('phone_click', {
                listing_id: data.listing_id,
                studio_name: data.studio_name
            });
        }

        // ----- Email Click -----
        var emailLink = e.target.closest('a[href^="mailto:"]');
        if (emailLink) {
            var data = getListingData(emailLink);
            trackEvent('email_click', {
                listing_id: data.listing_id,
                studio_name: data.studio_name
            });
        }

        // ----- Directions Click -----
        var directionsLink = e.target.closest('a[href*="maps.google"], a[href*="maps.apple"], [data-action="directions"]');
        if (directionsLink) {
            var data = getListingData(directionsLink);
            trackEvent('directions_click', {
                listing_id: data.listing_id,
                studio_name: data.studio_name
            });
        }

        // ----- Website Click -----
        var websiteLink = e.target.closest('.website-link, [data-action="website"]');
        if (websiteLink) {
            var data = getListingData(websiteLink);
            trackEvent('website_click', {
                listing_id: data.listing_id,
                studio_name: data.studio_name,
                destination_url: websiteLink.href || ''
            });
        }

        // ----- Social Link Clicks -----
        var socialLink = e.target.closest('a[href*="instagram.com"], a[href*="facebook.com"], a[href*="tiktok.com"]');
        if (socialLink) {
            var data = getListingData(socialLink);
            var platform = 'unknown';
            if (socialLink.href.includes('instagram')) platform = 'instagram';
            if (socialLink.href.includes('facebook')) platform = 'facebook';
            if (socialLink.href.includes('tiktok')) platform = 'tiktok';

            trackEvent('social_click', {
                listing_id: data.listing_id,
                studio_name: data.studio_name,
                platform: platform
            });
        }

        // ----- View Schedule Click -----
        var scheduleLink = e.target.closest('[data-action="schedule"], .schedule-link, a[href*="schedule"]');
        if (scheduleLink && !scheduleLink.closest('.book-class-btn')) {
            var data = getListingData(scheduleLink);
            trackEvent('schedule_click', {
                listing_id: data.listing_id,
                studio_name: data.studio_name
            });
        }

    });

    // =============================================================================
    // FORM SUBMISSION TRACKING
    // =============================================================================

    /**
     * Track lead form submission
     * Works with Ninja Forms
     */
    document.addEventListener('nfFormSubmitResponse', function(e) {
        var formData = e.detail || {};

        trackEvent('lead_form_submit', {
            listing_id: pageData.listingId || '',
            studio_name: pageData.studioName || '',
            form_id: formData.id || ''
        });
    });

    /**
     * Fallback: Track any form with data-track="lead-form"
     */
    document.querySelectorAll('form[data-track="lead-form"]').forEach(function(form) {
        form.addEventListener('submit', function() {
            trackEvent('lead_form_submit', {
                listing_id: pageData.listingId || '',
                studio_name: pageData.studioName || ''
            });
        });
    });

    // =============================================================================
    // SEARCH FILTER TRACKING
    // =============================================================================

    /**
     * Track filter usage on search page
     */
    document.querySelectorAll('.geodir-search select, .geodir-search input[type="checkbox"], .geodir-filter select').forEach(function(filter) {
        filter.addEventListener('change', function() {
            trackEvent('filter_use', {
                filter_name: this.name || this.id || 'unknown',
                filter_value: this.value || this.checked || ''
            });
        });
    });

    // =============================================================================
    // SCROLL DEPTH TRACKING (Single Listing)
    // =============================================================================

    if (pageData.pageType === 'single_listing') {
        var scrollMilestones = [25, 50, 75, 100];
        var milestonesReached = [];

        window.addEventListener('scroll', function() {
            var scrollPercent = Math.round((window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100);

            scrollMilestones.forEach(function(milestone) {
                if (scrollPercent >= milestone && milestonesReached.indexOf(milestone) === -1) {
                    milestonesReached.push(milestone);
                    trackEvent('scroll_depth', {
                        listing_id: pageData.listingId,
                        percent: milestone
                    });
                }
            });
        });
    }

    // =============================================================================
    // TIME ON PAGE TRACKING
    // =============================================================================

    if (pageData.pageType === 'single_listing') {
        var timeIntervals = [30, 60, 120, 300]; // seconds
        var intervalsReached = [];

        timeIntervals.forEach(function(seconds) {
            setTimeout(function() {
                if (document.visibilityState === 'visible') {
                    intervalsReached.push(seconds);
                    trackEvent('time_on_listing', {
                        listing_id: pageData.listingId,
                        seconds: seconds
                    });
                }
            }, seconds * 1000);
        });
    }

})();
