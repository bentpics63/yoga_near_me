/**
 * YogaNearMe Studio Onboarding Form
 * Interactive form logic for studio registration
 */

(function() {
  'use strict';

  // ==========================================================================
  // State Management
  // ==========================================================================

  const formState = {
    // Section 1: Basics
    studio_name: '',
    address: '',
    city: '',
    state: '',
    zip: '',
    phone: '',
    email: '',
    website: '',
    hours: {},

    // Section 2: Identity
    primary_style: '',
    vibe_tags: [],
    best_for: [],
    languages: [],
    languages_other: '',

    // Section 3: Practical
    drop_in_policy: '',
    class_size: '',
    new_student_info: [],
    parking: [],

    // Section 4: Different
    intro_offer: '',
    intro_offer_subtitle: '',
    intro_offer_subtitle_custom: '',
    why_students_love: '',
    signature_offering: '',

    // Section 5: Booking
    booking_platform: '',
    booking_url: '',
    schedule_url: '',

    // Section 6: Virtual & Retreats
    offers_virtual: '',
    virtual_platform: '',
    virtual_class_url: '',
    offers_retreats: '',

    // Section 7: Optional
    established_year: '',
    yoga_alliance: [],
    instagram: '',
    facebook: '',
    tiktok: '',
    google_reviews_url: '',
    student_sources: [],
    photos: [],

    // Upsell
    upgrade_intent: ''
  };

  // Completion tracking
  const completionChecks = {
    name: () => formState.studio_name.trim().length > 0,
    address: () => formState.address.trim().length > 0,
    email: () => formState.email.trim().length > 0 && isValidEmail(formState.email),
    hours: () => Object.keys(formState.hours).length > 0,
    style: () => formState.primary_style.length > 0,
    vibe: () => formState.vibe_tags.length > 0,
    offer: () => formState.intro_offer.trim().length > 0,
    photo: () => formState.photos.length > 0
  };

  // ==========================================================================
  // DOM Elements
  // ==========================================================================

  const form = document.getElementById('studioOnboardingForm');
  const progressFill = document.getElementById('progressFill');
  const progressPercent = document.getElementById('progressPercent');
  const checklist = document.getElementById('completionChecklist');

  // ==========================================================================
  // Utility Functions
  // ==========================================================================

  function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
  }

  function formatPhone(value) {
    const digits = value.replace(/\D/g, '');
    if (digits.length === 0) return '';
    if (digits.length <= 3) return `(${digits}`;
    if (digits.length <= 6) return `(${digits.slice(0, 3)}) ${digits.slice(3)}`;
    return `(${digits.slice(0, 3)}) ${digits.slice(3, 6)}-${digits.slice(6, 10)}`;
  }

  // ==========================================================================
  // Progress & Completion
  // ==========================================================================

  function updateProgress() {
    const totalChecks = Object.keys(completionChecks).length;
    const completedChecks = Object.values(completionChecks).filter(check => check()).length;
    const percent = Math.round((completedChecks / totalChecks) * 100);

    if (progressFill) progressFill.style.width = `${percent}%`;
    if (progressPercent) progressPercent.textContent = `${percent}%`;

    // Update checklist
    if (checklist) {
      checklist.querySelectorAll('.checklist-item').forEach(item => {
        const checkName = item.dataset.check;
        if (completionChecks[checkName] && completionChecks[checkName]()) {
          item.classList.add('is-complete');
        } else {
          item.classList.remove('is-complete');
        }
      });
    }
  }

  // ==========================================================================
  // Text Input Handlers
  // ==========================================================================

  function setupTextInputs() {
    // Studio Name
    const studioNameInput = document.getElementById('studioName');
    if (studioNameInput) {
      studioNameInput.addEventListener('input', (e) => {
        formState.studio_name = e.target.value;
        updateProgress();
      });

      studioNameInput.addEventListener('blur', (e) => {
        validateRequired(e.target, 'studioNameError', 'Studio name is required');
      });
    }

    // Address (would integrate with Google Places in production)
    const addressInput = document.getElementById('studioAddress');
    if (addressInput) {
      addressInput.addEventListener('input', (e) => {
        formState.address = e.target.value;
        updateProgress();
      });

      addressInput.addEventListener('blur', (e) => {
        validateRequired(e.target, 'studioAddressError', 'Address is required');
      });
    }

    // Email
    const emailInput = document.getElementById('studioEmail');
    if (emailInput) {
      emailInput.addEventListener('input', (e) => {
        formState.email = e.target.value;
        updateProgress();
      });

      emailInput.addEventListener('blur', (e) => {
        if (!e.target.value.trim()) {
          showError(e.target, 'studioEmailError', 'Email is required');
        } else if (!isValidEmail(e.target.value)) {
          showError(e.target, 'studioEmailError', 'Please enter a valid email');
        } else {
          clearError(e.target, 'studioEmailError');
        }
      });
    }

    // Phone (with formatting)
    const phoneInput = document.getElementById('studioPhone');
    if (phoneInput) {
      phoneInput.addEventListener('input', (e) => {
        const formatted = formatPhone(e.target.value);
        e.target.value = formatted;
        formState.phone = formatted;
      });
    }

    // Website
    const websiteInput = document.getElementById('studioWebsite');
    if (websiteInput) {
      websiteInput.addEventListener('input', (e) => {
        formState.website = e.target.value;
      });

      websiteInput.addEventListener('blur', (e) => {
        let value = e.target.value.trim();
        if (value && !value.startsWith('http://') && !value.startsWith('https://')) {
          value = 'https://' + value;
          e.target.value = value;
          formState.website = value;
        }
      });
    }

    // Section 4: Intro Offer
    const introOfferInput = document.getElementById('introOffer');
    if (introOfferInput) {
      introOfferInput.addEventListener('input', (e) => {
        formState.intro_offer = e.target.value;
        updateCharCounter('introOfferCount', e.target.value.length);
        updateProgress();
      });
    }

    // Section 4: Why Students Love You
    const whyStudentsLoveInput = document.getElementById('whyStudentsLove');
    if (whyStudentsLoveInput) {
      whyStudentsLoveInput.addEventListener('input', (e) => {
        formState.why_students_love = e.target.value;
        updateCharCounter('whyStudentsLoveCount', e.target.value.length);
      });
    }

    // Section 4: Signature Offering
    const signatureOfferingInput = document.getElementById('signatureOffering');
    if (signatureOfferingInput) {
      signatureOfferingInput.addEventListener('input', (e) => {
        formState.signature_offering = e.target.value;
        updateCharCounter('signatureOfferingCount', e.target.value.length);
      });
    }

    // Section 5: Social Inputs
    const instagramInput = document.getElementById('socialInstagram');
    if (instagramInput) {
      instagramInput.addEventListener('input', (e) => {
        // Strip @ if entered
        let value = e.target.value.replace('@', '');
        formState.instagram = value;
      });
    }

    const facebookInput = document.getElementById('socialFacebook');
    if (facebookInput) {
      facebookInput.addEventListener('input', (e) => {
        formState.facebook = e.target.value;
      });
    }

    const tiktokInput = document.getElementById('socialTiktok');
    if (tiktokInput) {
      tiktokInput.addEventListener('input', (e) => {
        let value = e.target.value.replace('@', '');
        formState.tiktok = value;
      });
    }

    // Section 5: Google Reviews
    const googleReviewsInput = document.getElementById('googleReviews');
    if (googleReviewsInput) {
      googleReviewsInput.addEventListener('input', (e) => {
        formState.google_reviews_url = e.target.value;
      });
    }

    // Section 5 (Booking): Booking URL
    const bookingUrlInput = document.getElementById('bookingUrl');
    if (bookingUrlInput) {
      bookingUrlInput.addEventListener('input', (e) => {
        formState.booking_url = e.target.value;
      });

      bookingUrlInput.addEventListener('blur', (e) => {
        let value = e.target.value.trim();
        if (value && !value.startsWith('http://') && !value.startsWith('https://')) {
          value = 'https://' + value;
          e.target.value = value;
          formState.booking_url = value;
        }
      });
    }

    // Section 5 (Booking): Schedule URL
    const scheduleUrlInput = document.getElementById('scheduleUrl');
    if (scheduleUrlInput) {
      scheduleUrlInput.addEventListener('input', (e) => {
        formState.schedule_url = e.target.value;
      });

      scheduleUrlInput.addEventListener('blur', (e) => {
        let value = e.target.value.trim();
        if (value && !value.startsWith('http://') && !value.startsWith('https://')) {
          value = 'https://' + value;
          e.target.value = value;
          formState.schedule_url = value;
        }
      });
    }

    // Section 6 (Virtual): Virtual Class URL
    const virtualClassUrlInput = document.getElementById('virtualClassUrl');
    if (virtualClassUrlInput) {
      virtualClassUrlInput.addEventListener('input', (e) => {
        formState.virtual_class_url = e.target.value;
      });

      virtualClassUrlInput.addEventListener('blur', (e) => {
        let value = e.target.value.trim();
        if (value && !value.startsWith('http://') && !value.startsWith('https://')) {
          value = 'https://' + value;
          e.target.value = value;
          formState.virtual_class_url = value;
        }
      });
    }
  }

  function updateCharCounter(counterId, length) {
    const counter = document.getElementById(counterId);
    if (counter) {
      counter.textContent = length;
    }
  }

  // ==========================================================================
  // Validation
  // ==========================================================================

  function validateRequired(input, errorId, message) {
    if (!input.value.trim()) {
      showError(input, errorId, message);
      return false;
    }
    clearError(input, errorId);
    return true;
  }

  function showError(input, errorId, message) {
    input.classList.add('has-error');
    const errorEl = document.getElementById(errorId);
    if (errorEl) {
      errorEl.textContent = message;
      errorEl.style.display = 'block';
    }
  }

  function clearError(input, errorId) {
    input.classList.remove('has-error');
    const errorEl = document.getElementById(errorId);
    if (errorEl) {
      errorEl.textContent = '';
      errorEl.style.display = 'none';
    }
  }

  // ==========================================================================
  // Hours Picker
  // ==========================================================================

  function setupHoursPicker() {
    const hoursGrid = document.getElementById('hoursGrid');
    if (!hoursGrid) return;

    const days = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];

    days.forEach(day => {
      const checkbox = document.getElementById(`hours-${day}-active`);
      const openInput = document.getElementById(`hours-${day}-open`);
      const closeInput = document.getElementById(`hours-${day}-close`);
      const row = checkbox?.closest('.hours-row');

      if (checkbox && checkbox.checked) {
        formState.hours[day] = {
          open: openInput?.value || '09:00',
          close: closeInput?.value || '21:00'
        };
      }

      checkbox?.addEventListener('change', (e) => {
        if (e.target.checked) {
          row?.classList.remove('is-closed');
          formState.hours[day] = {
            open: openInput?.value || '09:00',
            close: closeInput?.value || '21:00'
          };
        } else {
          row?.classList.add('is-closed');
          delete formState.hours[day];
        }
        updateProgress();
      });

      openInput?.addEventListener('change', (e) => {
        if (formState.hours[day]) {
          formState.hours[day].open = e.target.value;
        }
      });

      closeInput?.addEventListener('change', (e) => {
        if (formState.hours[day]) {
          formState.hours[day].close = e.target.value;
        }
      });
    });

    updateProgress();
  }

  // ==========================================================================
  // Style Buttons (Single Select)
  // ==========================================================================

  function setupStyleButtons() {
    const styleGrid = document.getElementById('primaryStyleGrid');
    if (!styleGrid) return;

    const buttons = styleGrid.querySelectorAll('.style-button');

    buttons.forEach(button => {
      button.addEventListener('click', () => {
        buttons.forEach(b => b.classList.remove('is-selected'));
        button.classList.add('is-selected');
        formState.primary_style = button.dataset.value;

        const hiddenInput = document.getElementById('primaryStyle');
        if (hiddenInput) {
          hiddenInput.value = button.dataset.value;
        }

        clearError(hiddenInput, 'primaryStyleError');
        updateProgress();
      });
    });
  }

  // ==========================================================================
  // Radio Button Stacks (Section 3)
  // ==========================================================================

  function setupRadioStacks() {
    // Drop-in Policy
    const dropinRadios = document.querySelectorAll('input[name="drop_in_policy"]');
    dropinRadios.forEach(radio => {
      radio.addEventListener('change', (e) => {
        formState.drop_in_policy = e.target.value;
      });
    });

    // Class Size
    const classSizeRadios = document.querySelectorAll('input[name="class_size"]');
    classSizeRadios.forEach(radio => {
      radio.addEventListener('change', (e) => {
        formState.class_size = e.target.value;
      });
    });

    // Offers Virtual
    const virtualRadios = document.querySelectorAll('input[name="offers_virtual"]');
    const virtualPlatformGroup = document.getElementById('virtualPlatformGroup');
    const virtualUrlGroup = document.getElementById('virtualUrlGroup');

    virtualRadios.forEach(radio => {
      radio.addEventListener('change', (e) => {
        formState.offers_virtual = e.target.value;

        // Show/hide virtual platform and URL fields
        if (e.target.value === 'yes') {
          if (virtualPlatformGroup) virtualPlatformGroup.style.display = 'block';
          if (virtualUrlGroup) virtualUrlGroup.style.display = 'block';
        } else {
          if (virtualPlatformGroup) virtualPlatformGroup.style.display = 'none';
          if (virtualUrlGroup) virtualUrlGroup.style.display = 'none';
        }
      });
    });

    // Offers Retreats
    const retreatsRadios = document.querySelectorAll('input[name="offers_retreats"]');
    retreatsRadios.forEach(radio => {
      radio.addEventListener('change', (e) => {
        formState.offers_retreats = e.target.value;
      });
    });
  }

  // ==========================================================================
  // Pill Buttons (Multi-Select)
  // ==========================================================================

  function setupPillButtons() {
    // Section 2: Vibe Tags (max 3)
    setupPillGroup('vibe', 3, (selected) => {
      formState.vibe_tags = selected;
      const hiddenInput = document.getElementById('vibeTags');
      if (hiddenInput) {
        hiddenInput.value = selected.join(',');
      }
      updateVibeCounter(selected.length);
      updateProgress();
    });

    // Section 2: Best For (unlimited)
    setupPillGroup('bestfor', Infinity, (selected) => {
      formState.best_for = selected;
      const hiddenInput = document.getElementById('bestFor');
      if (hiddenInput) {
        hiddenInput.value = selected.join(',');
      }
    });

    // Section 2: Languages (unlimited, with "Other" handling)
    setupPillGroup('languages', Infinity, (selected) => {
      formState.languages = selected;
      const hiddenInput = document.getElementById('languages');
      if (hiddenInput) {
        hiddenInput.value = selected.join(',');
      }
      const otherContainer = document.getElementById('languagesOtherContainer');
      if (otherContainer) {
        otherContainer.style.display = selected.includes('other') ? 'block' : 'none';
      }
    });

    // Other languages input
    const languagesOtherInput = document.getElementById('languagesOther');
    if (languagesOtherInput) {
      languagesOtherInput.addEventListener('input', (e) => {
        formState.languages_other = e.target.value;
      });
    }

    // Section 3: New Student Info (unlimited)
    setupPillGroup('newstudent', Infinity, (selected) => {
      formState.new_student_info = selected;
      const hiddenInput = document.getElementById('newStudentInfo');
      if (hiddenInput) {
        hiddenInput.value = selected.join(',');
      }
    });

    // Section 3: Parking (unlimited)
    setupPillGroup('parking', Infinity, (selected) => {
      formState.parking = selected;
      const hiddenInput = document.getElementById('parking');
      if (hiddenInput) {
        hiddenInput.value = selected.join(',');
      }
    });

    // Section 4: Offer Subtitle (single select with custom)
    setupPillGroup('offersubtitle', 1, (selected) => {
      formState.intro_offer_subtitle = selected[0] || '';
      const hiddenInput = document.getElementById('introOfferSubtitle');
      if (hiddenInput) {
        hiddenInput.value = selected[0] || '';
      }
      const customContainer = document.getElementById('offerSubtitleCustomContainer');
      if (customContainer) {
        customContainer.style.display = selected.includes('custom') ? 'block' : 'none';
      }
    });

    // Custom offer subtitle input
    const offerSubtitleCustomInput = document.getElementById('introOfferSubtitleCustom');
    if (offerSubtitleCustomInput) {
      offerSubtitleCustomInput.addEventListener('input', (e) => {
        formState.intro_offer_subtitle_custom = e.target.value;
      });
    }

    // Section 5: Yoga Alliance (unlimited)
    setupPillGroup('yogaalliance', Infinity, (selected) => {
      formState.yoga_alliance = selected;
      const hiddenInput = document.getElementById('yogaAlliance');
      if (hiddenInput) {
        hiddenInput.value = selected.join(',');
      }
    });

    // Section 5: Student Sources (unlimited)
    setupPillGroup('sources', Infinity, (selected) => {
      formState.student_sources = selected;
      const hiddenInput = document.getElementById('studentSources');
      if (hiddenInput) {
        hiddenInput.value = selected.join(',');
      }
    });

    // Section 5 (Booking): Booking Platform (single select)
    setupPillGroup('booking', 1, (selected) => {
      formState.booking_platform = selected[0] || '';
      const hiddenInput = document.getElementById('bookingPlatform');
      if (hiddenInput) {
        hiddenInput.value = selected[0] || '';
      }
    });

    // Section 6 (Virtual): Virtual Platform (single select)
    setupPillGroup('virtualplatform', 1, (selected) => {
      formState.virtual_platform = selected[0] || '';
      const hiddenInput = document.getElementById('virtualPlatform');
      if (hiddenInput) {
        hiddenInput.value = selected[0] || '';
      }
    });
  }

  function setupPillGroup(group, maxSelections, onChange) {
    const pills = document.querySelectorAll(`.pill-button[data-group="${group}"]`);
    let selected = [];

    pills.forEach(pill => {
      pill.addEventListener('click', () => {
        const value = pill.dataset.value;

        if (pill.classList.contains('is-selected')) {
          pill.classList.remove('is-selected');
          selected = selected.filter(v => v !== value);
        } else if (selected.length < maxSelections) {
          // For single select, deselect others first
          if (maxSelections === 1) {
            pills.forEach(p => p.classList.remove('is-selected'));
            selected = [];
          }
          pill.classList.add('is-selected');
          selected.push(value);
        }

        // Update disabled state for max selections
        if (maxSelections !== Infinity && maxSelections > 1) {
          pills.forEach(p => {
            if (!p.classList.contains('is-selected')) {
              if (selected.length >= maxSelections) {
                p.classList.add('is-disabled');
              } else {
                p.classList.remove('is-disabled');
              }
            }
          });
        }

        onChange(selected);
      });
    });
  }

  function updateVibeCounter(count) {
    const counter = document.getElementById('vibeCounter');
    if (counter) {
      counter.querySelector('.counter-current').textContent = count;
    }
  }

  // ==========================================================================
  // Quick-fill Suggestions (Section 4)
  // ==========================================================================

  function setupQuickfillSuggestions() {
    const suggestions = document.querySelectorAll('.quickfill-button');

    suggestions.forEach(button => {
      button.addEventListener('click', () => {
        const fillValue = button.dataset.fill;
        const introOfferInput = document.getElementById('introOffer');
        if (introOfferInput && fillValue) {
          introOfferInput.value = fillValue;
          formState.intro_offer = fillValue;
          updateCharCounter('introOfferCount', fillValue.length);
          updateProgress();
        }
      });
    });
  }

  // ==========================================================================
  // Year Dropdown (Section 5)
  // ==========================================================================

  function setupYearDropdown() {
    const yearSelect = document.getElementById('establishedYear');
    if (!yearSelect) return;

    const currentYear = new Date().getFullYear();
    for (let year = currentYear; year >= 1950; year--) {
      const option = document.createElement('option');
      option.value = year;
      option.textContent = year;
      yearSelect.appendChild(option);
    }

    yearSelect.addEventListener('change', (e) => {
      formState.established_year = e.target.value;
    });
  }

  // ==========================================================================
  // Photo Upload (Section 5)
  // ==========================================================================

  function setupPhotoUpload() {
    const uploadZone = document.getElementById('photoUploadZone');
    const photoInput = document.getElementById('photoInput');

    if (!uploadZone || !photoInput) return;

    // Click to upload
    uploadZone.addEventListener('click', () => {
      photoInput.click();
    });

    // File selection
    photoInput.addEventListener('change', (e) => {
      handleFiles(e.target.files);
    });

    // Drag and drop
    uploadZone.addEventListener('dragover', (e) => {
      e.preventDefault();
      uploadZone.classList.add('is-dragover');
    });

    uploadZone.addEventListener('dragleave', () => {
      uploadZone.classList.remove('is-dragover');
    });

    uploadZone.addEventListener('drop', (e) => {
      e.preventDefault();
      uploadZone.classList.remove('is-dragover');
      handleFiles(e.dataTransfer.files);
    });
  }

  function handleFiles(files) {
    Array.from(files).forEach(file => {
      if (!file.type.startsWith('image/')) return;

      const reader = new FileReader();
      reader.onload = (e) => {
        formState.photos.push({
          name: file.name,
          data: e.target.result
        });
        renderPhotoPreview();
        updateProgress();
      };
      reader.readAsDataURL(file);
    });
  }

  function renderPhotoPreview() {
    const uploadZone = document.getElementById('photoUploadZone');
    if (!uploadZone) return;

    // Check if preview grid exists, create if not
    let previewGrid = uploadZone.querySelector('.photo-preview-grid');
    if (!previewGrid) {
      previewGrid = document.createElement('div');
      previewGrid.className = 'photo-preview-grid';
      uploadZone.appendChild(previewGrid);
    }

    previewGrid.innerHTML = formState.photos.map((photo, index) => `
      <div class="photo-preview">
        <img src="${photo.data}" alt="${photo.name}">
        <button type="button" class="photo-remove" data-index="${index}">&times;</button>
      </div>
    `).join('');

    // Add remove handlers
    previewGrid.querySelectorAll('.photo-remove').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const index = parseInt(btn.dataset.index);
        formState.photos.splice(index, 1);
        renderPhotoPreview();
        updateProgress();
      });
    });
  }

  // ==========================================================================
  // Form Submission
  // ==========================================================================

  function setupFormSubmission() {
    if (!form) return;

    form.addEventListener('submit', (e) => {
      e.preventDefault();

      let isValid = true;

      const studioName = document.getElementById('studioName');
      if (!validateRequired(studioName, 'studioNameError', 'Studio name is required')) {
        isValid = false;
      }

      const address = document.getElementById('studioAddress');
      if (!validateRequired(address, 'studioAddressError', 'Address is required')) {
        isValid = false;
      }

      const email = document.getElementById('studioEmail');
      if (!email.value.trim()) {
        showError(email, 'studioEmailError', 'Email is required');
        isValid = false;
      } else if (!isValidEmail(email.value)) {
        showError(email, 'studioEmailError', 'Please enter a valid email');
        isValid = false;
      }

      if (!formState.primary_style) {
        const styleError = document.getElementById('primaryStyleError');
        if (styleError) {
          styleError.textContent = 'Please select your primary style';
          styleError.style.display = 'block';
        }
        isValid = false;
      }

      // Validate drop-in policy
      if (!formState.drop_in_policy) {
        const dropinError = document.getElementById('dropinPolicyError');
        if (dropinError) {
          dropinError.textContent = 'Please select a drop-in policy';
          dropinError.style.display = 'block';
        }
        isValid = false;
      }

      if (!isValid) {
        const firstError = form.querySelector('.has-error, .field-error[style*="block"]');
        if (firstError) {
          firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        return;
      }

      submitForm();
    });
  }

  async function submitForm() {
    const submitBtn = document.getElementById('submitBtn');
    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.textContent = 'Saving...';
    }

    try {
      const data = { ...formState };

      console.log('Form data to submit:', data);

      // Get API configuration (set by WordPress localize_script)
      const apiUrl = window.ynmOnboarding?.apiUrl || '/wp-json/yoganearme/v1/studios';
      const nonce = window.ynmOnboarding?.nonce || '';

      const response = await fetch(apiUrl, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-WP-Nonce': nonce
        },
        body: JSON.stringify(data)
      });

      const result = await response.json();

      if (!response.ok || !result.success) {
        throw new Error(result.message || 'Failed to save listing');
      }

      // Store the listing URL for success state
      formState.listing_id = result.listing_id;
      formState.listing_url = result.listing_url;

      showSuccessState(result);

    } catch (error) {
      console.error('Submission error:', error);
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Save & Preview Listing';
      }

      // Show user-friendly error
      const errorMessage = error.message || 'There was an error saving your listing. Please try again.';
      showFormError(errorMessage);
    }
  }

  function showFormError(message) {
    // Check if error container exists, create if not
    let errorContainer = document.getElementById('formErrorContainer');
    if (!errorContainer) {
      errorContainer = document.createElement('div');
      errorContainer.id = 'formErrorContainer';
      errorContainer.style.cssText = 'background: #fff5f5; border: 1px solid #c53030; border-radius: 8px; padding: 16px; margin-bottom: 20px; color: #c53030;';

      const formActions = document.querySelector('.form-actions');
      if (formActions) {
        formActions.parentNode.insertBefore(errorContainer, formActions);
      }
    }

    errorContainer.innerHTML = '<strong>Error:</strong> ' + message;
    errorContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
  }

  function showSuccessState(result) {
    const listingUrl = result?.listing_url || '#';
    const homeUrl = window.ynmOnboarding?.homeUrl || 'https://yoganearme.info';

    // Hide the form sections
    const formSections = document.querySelectorAll('.form-section');
    formSections.forEach(section => {
      section.style.display = 'none';
    });

    // Hide the hero
    const formHero = document.querySelector('.form-hero');
    if (formHero) {
      formHero.style.display = 'none';
    }

    const formActions = document.querySelector('.form-actions');
    if (formActions) {
      formActions.innerHTML = `
        <div class="success-message">
          <div class="success-icon">&#10003;</div>
          <h3 class="success-title">You're listed.</h3>
          <p class="success-text">Your listing is under review and will be live within 24 hours.<br>We've sent a confirmation to your email.</p>
          <div class="success-actions">
            <a href="${listingUrl}" class="btn-primary">Preview My Listing</a>
            <a href="${homeUrl}" class="btn-secondary">Return to Home</a>
          </div>
        </div>
      `;

      // Scroll to success message
      formActions.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    // Update progress to 100%
    if (progressFill) progressFill.style.width = '100%';
    if (progressPercent) progressPercent.textContent = '100%';
  }

  // ==========================================================================
  // UPSELL SCREEN LOGIC
  // ==========================================================================

  let upsellShown = false;
  let upsellSkipped = false;

  function setupUpsellScreen() {
    const upsellScreen = document.getElementById('upsellScreen');
    const btnSkipUpsell = document.getElementById('btnSkipUpsell');
    const btnUpgrade = document.getElementById('btnUpgrade');
    const section3 = document.getElementById('sectionPractical');
    const section4 = document.getElementById('sectionDifferent');

    if (!upsellScreen || !section3 || !section4) return;

    // Show upsell when user scrolls past section 3 (or clicks into section 4)
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting && entry.target === section4 && !upsellShown && !upsellSkipped) {
          showUpsell();
        }
      });
    }, { threshold: 0.3 });

    observer.observe(section4);

    // Skip upsell button
    if (btnSkipUpsell) {
      btnSkipUpsell.addEventListener('click', () => {
        hideUpsell();
        upsellSkipped = true;
        // Scroll to section 4
        section4.scrollIntoView({ behavior: 'smooth', block: 'start' });
      });
    }

    // Upgrade button
    if (btnUpgrade) {
      btnUpgrade.addEventListener('click', () => {
        // Store upgrade intent in form state
        formState.upgrade_intent = 'visibility_boost';

        // Show confirmation
        btnUpgrade.textContent = 'Added to submission!';
        btnUpgrade.disabled = true;
        btnUpgrade.style.background = '#38a169';

        // After 1.5s, continue to section 4
        setTimeout(() => {
          hideUpsell();
          upsellSkipped = true;
          section4.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 1500);
      });
    }
  }

  function showUpsell() {
    const upsellScreen = document.getElementById('upsellScreen');
    const section4 = document.getElementById('sectionDifferent');
    const section5 = document.getElementById('sectionBooking');
    const section6 = document.getElementById('sectionVirtual');
    const section7 = document.getElementById('sectionOptional');

    if (!upsellScreen) return;

    // Hide sections 4-7 temporarily
    if (section4) section4.style.display = 'none';
    if (section5) section5.style.display = 'none';
    if (section6) section6.style.display = 'none';
    if (section7) section7.style.display = 'none';

    // Show upsell
    upsellScreen.style.display = 'block';
    upsellScreen.scrollIntoView({ behavior: 'smooth', block: 'center' });

    upsellShown = true;
  }

  function hideUpsell() {
    const upsellScreen = document.getElementById('upsellScreen');
    const section4 = document.getElementById('sectionDifferent');
    const section5 = document.getElementById('sectionBooking');
    const section6 = document.getElementById('sectionVirtual');
    const section7 = document.getElementById('sectionOptional');

    if (!upsellScreen) return;

    // Hide upsell
    upsellScreen.style.display = 'none';

    // Show sections 4-7
    if (section4) section4.style.display = 'block';
    if (section5) section5.style.display = 'block';
    if (section6) section6.style.display = 'block';
    if (section7) section7.style.display = 'block';
  }

  // ==========================================================================
  // Initialization
  // ==========================================================================

  function init() {
    setupTextInputs();
    setupHoursPicker();
    setupStyleButtons();
    setupRadioStacks();
    setupPillButtons();
    setupQuickfillSuggestions();
    setupYearDropdown();
    setupPhotoUpload();
    setupFormSubmission();
    setupUpsellScreen();
    updateProgress();

    console.log('Studio Onboarding Form initialized');
  }

  // Initialize when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

})();
