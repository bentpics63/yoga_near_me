/**
 * YogaNearMe - Fix "No Records Found" False Empty State
 *
 * PURPOSE: Detects actual search results and hides/shows the empty state message
 * appropriately. Prevents the "flash" of "No Records Found" during AJAX loading.
 *
 * INSTALLATION:
 * Option A: Add to Elementor > Custom Code > </body>
 * Option B: Enqueue via functions.php
 * Option C: Add to your child theme's scripts
 *
 * DEPENDENCIES: jQuery (included with WordPress)
 */

(function($) {
    'use strict';

    // Configuration - adjust selectors if needed for your setup
    var config = {
        // Selectors for listing items (results)
        listingSelectors: [
            '.geodir-loop-container .geodir-category-list-view',
            '.geodir-loop-container .geodir-gridview',
            '.geodir-loop-container article',
            '.gd-loop-container .gd-post-item',
            '.geodir-loop-container .gd-article',
            '[class*="geodir"] .gd-post-item',
            '.geodir-post-item'
        ],

        // Selectors for "no results" messages to hide/show
        noResultsSelectors: [
            '.geodir-loop-no-found',
            '.geodir-no-listings-found',
            '.geodir-no-results',
            '.gd-no-listings-found',
            '.ynm-no-results-message',
            '.ynm-no-results-custom',
            '[class*="no-listings-found"]',
            '[class*="no-records-found"]'
        ],

        // Container to watch for changes
        containerSelectors: [
            '.geodir-loop-container',
            '.gd-loop-container',
            '.elementor-widget-geodirectory',
            '#geodir-wrapper'
        ],

        // Delay before checking (allows AJAX to complete)
        checkDelay: 150,

        // Debug mode - set to true to see console logs
        debug: false
    };

    /**
     * Log debug messages if debug mode is enabled
     */
    function log(message, data) {
        if (config.debug) {
            console.log('[YNM Search Fix] ' + message, data || '');
        }
    }

    /**
     * Count the number of listing items on the page
     */
    function countListings() {
        var count = 0;
        var selector = config.listingSelectors.join(', ');

        $(selector).each(function() {
            // Make sure it's visible and not a template
            if ($(this).is(':visible') && !$(this).hasClass('template')) {
                count++;
            }
        });

        log('Found listings:', count);
        return count;
    }

    /**
     * Get all no-results message elements
     */
    function getNoResultsElements() {
        return $(config.noResultsSelectors.join(', '));
    }

    /**
     * Main function to check results and update UI
     */
    function checkAndFixNoResults() {
        var listingCount = countListings();
        var noResultsElements = getNoResultsElements();

        if (listingCount > 0) {
            // We have results - hide no results messages
            log('Has results - hiding empty state');
            noResultsElements.hide();
            $('body').removeClass('ynm-no-results').addClass('ynm-has-results');

            // Also hide any elements with data attribute
            $('[data-show-when="empty"]').hide();
            $('[data-show-when="results"]').show();

        } else {
            // No results - show the message
            log('No results - showing empty state');
            noResultsElements.show();
            $('body').removeClass('ynm-has-results').addClass('ynm-no-results');

            // Handle data attributes
            $('[data-show-when="empty"]').show();
            $('[data-show-when="results"]').hide();
        }

        // Remove loading state
        $(config.containerSelectors.join(', ')).removeClass('loading');
    }

    /**
     * Debounce function to prevent excessive calls
     */
    function debounce(func, wait) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                func.apply(context, args);
            }, wait);
        };
    }

    // Debounced version of our check function
    var debouncedCheck = debounce(checkAndFixNoResults, config.checkDelay);

    /**
     * Initialize the fix
     */
    function init() {
        log('Initializing search results fix');

        // Mark containers as loading initially
        $(config.containerSelectors.join(', ')).addClass('loading');

        // Initial check after a short delay (allows page to render)
        setTimeout(checkAndFixNoResults, config.checkDelay);

        // Listen for AJAX completion (GeoDirectory uses AJAX for search)
        $(document).ajaxComplete(function(event, xhr, settings) {
            log('AJAX completed', settings.url);
            debouncedCheck();
        });

        // Set up MutationObserver for dynamic content changes
        if (typeof MutationObserver !== 'undefined') {
            var observer = new MutationObserver(function(mutations) {
                var shouldCheck = false;

                mutations.forEach(function(mutation) {
                    if (mutation.addedNodes.length > 0 || mutation.removedNodes.length > 0) {
                        shouldCheck = true;
                    }
                });

                if (shouldCheck) {
                    log('DOM changed - rechecking');
                    debouncedCheck();
                }
            });

            // Find and observe the container
            var containerSelector = config.containerSelectors.join(', ');
            $(containerSelector).each(function() {
                observer.observe(this, {
                    childList: true,
                    subtree: true
                });
                log('Observing container:', this.className);
            });
        }

        // Also check on window load (for cached pages)
        $(window).on('load', function() {
            setTimeout(checkAndFixNoResults, 300);
        });

        // Handle browser back/forward
        $(window).on('popstate', function() {
            setTimeout(checkAndFixNoResults, config.checkDelay);
        });

        log('Initialization complete');
    }

    // Initialize when DOM is ready
    $(document).ready(init);

    // Expose function globally for manual triggering if needed
    window.ynmCheckSearchResults = checkAndFixNoResults;

})(jQuery);
