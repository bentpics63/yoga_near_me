/**
 * YogaNearMe Claim Listing Overlay
 * Multi-step verification flow for claiming a studio listing
 */

(function() {
  'use strict';

  // ==========================================================================
  // State
  // ==========================================================================

  const state = {
    currentStep: 1,
    verificationMethod: 'email',
    contactInfo: {
      name: '',
      email: '',
      phone: '',
      role: ''
    },
    verificationCode: '',
    studioData: {
      id: null,
      name: 'Sunrise Yoga Studio',
      address: '1234 Peaceful Lane, Santa Monica, CA 90401'
    }
  };

  // ==========================================================================
  // DOM Elements
  // ==========================================================================

  const overlay = document.getElementById('claimOverlay');
  const openBtn = document.getElementById('openClaimOverlay');
  const closeBtn = document.getElementById('closeOverlay');
  const backdrop = document.getElementById('overlayBackdrop');

  // Step containers
  const step1 = document.getElementById('step1');
  const step2 = document.getElementById('step2');
  const step2b = document.getElementById('step2b');
  const step3 = document.getElementById('step3');

  // Progress indicators
  const progressSteps = document.querySelectorAll('.progress-step');
  const progressConnectors = document.querySelectorAll('.progress-connector');

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
  // Overlay Open/Close
  // ==========================================================================

  function openOverlay() {
    overlay.classList.add('is-open');
    overlay.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';

    // Focus first focusable element
    const firstFocusable = overlay.querySelector('button, input, [tabindex]:not([tabindex="-1"])');
    if (firstFocusable) {
      setTimeout(() => firstFocusable.focus(), 100);
    }
  }

  function closeOverlay() {
    overlay.classList.remove('is-open');
    overlay.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';

    // Reset to step 1 after close animation
    setTimeout(() => {
      goToStep(1);
      resetForm();
    }, 300);
  }

  function resetForm() {
    state.currentStep = 1;
    state.verificationMethod = 'email';
    state.contactInfo = { name: '', email: '', phone: '', role: '' };
    state.verificationCode = '';

    // Reset form inputs
    const form = document.getElementById('claimContactForm');
    if (form) form.reset();

    // Reset verification code
    const codeInput = document.getElementById('verificationCode');
    if (codeInput) codeInput.value = '';

    // Clear errors
    document.querySelectorAll('.field-error').forEach(el => {
      el.textContent = '';
      el.style.display = 'none';
    });
    document.querySelectorAll('.has-error').forEach(el => {
      el.classList.remove('has-error');
    });
  }

  // ==========================================================================
  // Step Navigation
  // ==========================================================================

  function goToStep(stepNumber) {
    state.currentStep = stepNumber;

    // Hide all steps
    [step1, step2, step2b, step3].forEach(step => {
      if (step) step.classList.remove('is-active');
    });

    // Show target step
    let targetStep;
    switch (stepNumber) {
      case 1:
        targetStep = step1;
        break;
      case 2:
        targetStep = step2;
        break;
      case '2b':
        targetStep = step2b;
        break;
      case 3:
        targetStep = step3;
        break;
    }
    if (targetStep) {
      targetStep.classList.add('is-active');
    }

    // Update progress indicators
    updateProgressIndicators(stepNumber);
  }

  function updateProgressIndicators(stepNumber) {
    const numericStep = stepNumber === '2b' ? 2 : stepNumber;

    progressSteps.forEach((step, index) => {
      const stepNum = index + 1;
      step.classList.remove('is-active', 'is-complete');

      if (stepNum < numericStep) {
        step.classList.add('is-complete');
      } else if (stepNum === numericStep) {
        step.classList.add('is-active');
      }
    });

    progressConnectors.forEach((connector, index) => {
      connector.classList.remove('is-complete');
      if (index + 1 < numericStep) {
        connector.classList.add('is-complete');
      }
    });
  }

  // ==========================================================================
  // Step 1: Verification Method
  // ==========================================================================

  function setupStep1() {
    const verificationRadios = document.querySelectorAll('input[name="verification_method"]');
    const continueBtn = document.getElementById('continueStep1');
    const cancelBtn = document.getElementById('cancelStep1');

    verificationRadios.forEach(radio => {
      radio.addEventListener('change', (e) => {
        state.verificationMethod = e.target.value;
      });
    });

    continueBtn?.addEventListener('click', () => {
      goToStep(2);
    });

    cancelBtn?.addEventListener('click', () => {
      closeOverlay();
    });
  }

  // ==========================================================================
  // Step 2: Contact Information
  // ==========================================================================

  function setupStep2() {
    const nameInput = document.getElementById('claimName');
    const emailInput = document.getElementById('claimEmail');
    const phoneInput = document.getElementById('claimPhone');
    const roleRadios = document.querySelectorAll('input[name="role"]');
    const continueBtn = document.getElementById('continueStep2');
    const backBtn = document.getElementById('backStep2');

    // Input handlers
    nameInput?.addEventListener('input', (e) => {
      state.contactInfo.name = e.target.value;
    });

    emailInput?.addEventListener('input', (e) => {
      state.contactInfo.email = e.target.value;
    });

    phoneInput?.addEventListener('input', (e) => {
      const formatted = formatPhone(e.target.value);
      e.target.value = formatted;
      state.contactInfo.phone = formatted;
    });

    roleRadios.forEach(radio => {
      radio.addEventListener('change', (e) => {
        state.contactInfo.role = e.target.value;
      });
    });

    // Navigation
    continueBtn?.addEventListener('click', () => {
      if (validateStep2()) {
        sendVerificationCode();
      }
    });

    backBtn?.addEventListener('click', () => {
      goToStep(1);
    });
  }

  function validateStep2() {
    let isValid = true;

    const nameInput = document.getElementById('claimName');
    const emailInput = document.getElementById('claimEmail');

    // Validate name
    if (!state.contactInfo.name.trim()) {
      showError(nameInput, 'claimNameError', 'Name is required');
      isValid = false;
    } else {
      clearError(nameInput, 'claimNameError');
    }

    // Validate email
    if (!state.contactInfo.email.trim()) {
      showError(emailInput, 'claimEmailError', 'Email is required');
      isValid = false;
    } else if (!isValidEmail(state.contactInfo.email)) {
      showError(emailInput, 'claimEmailError', 'Please enter a valid email');
      isValid = false;
    } else {
      clearError(emailInput, 'claimEmailError');
    }

    // Validate role
    if (!state.contactInfo.role) {
      const roleError = document.getElementById('claimRoleError');
      if (roleError) {
        roleError.textContent = 'Please select your role';
        roleError.style.display = 'block';
      }
      isValid = false;
    } else {
      const roleError = document.getElementById('claimRoleError');
      if (roleError) {
        roleError.textContent = '';
        roleError.style.display = 'none';
      }
    }

    return isValid;
  }

  function showError(input, errorId, message) {
    if (input) input.classList.add('has-error');
    const errorEl = document.getElementById(errorId);
    if (errorEl) {
      errorEl.textContent = message;
      errorEl.style.display = 'block';
    }
  }

  function clearError(input, errorId) {
    if (input) input.classList.remove('has-error');
    const errorEl = document.getElementById(errorId);
    if (errorEl) {
      errorEl.textContent = '';
      errorEl.style.display = 'none';
    }
  }

  async function sendVerificationCode() {
    const continueBtn = document.getElementById('continueStep2');
    if (continueBtn) {
      continueBtn.disabled = true;
      continueBtn.textContent = 'Sending...';
    }

    try {
      // In production, this would call the API
      // await fetch('/wp-json/yoganearme/v1/verify/send', {
      //   method: 'POST',
      //   headers: { 'Content-Type': 'application/json' },
      //   body: JSON.stringify({
      //     method: state.verificationMethod,
      //     email: state.contactInfo.email,
      //     studio_id: state.studioData.id
      //   })
      // });

      // Simulate API delay
      await new Promise(resolve => setTimeout(resolve, 1000));

      // Update email display
      const sentToEmail = document.getElementById('sentToEmail');
      if (sentToEmail) {
        sentToEmail.textContent = state.contactInfo.email;
      }

      // Go to verification code step
      goToStep('2b');

    } catch (error) {
      console.error('Error sending verification:', error);
      alert('Failed to send verification code. Please try again.');
    } finally {
      if (continueBtn) {
        continueBtn.disabled = false;
        continueBtn.textContent = 'Send verification';
      }
    }
  }

  // ==========================================================================
  // Step 2b: Verification Code
  // ==========================================================================

  function setupStep2b() {
    const codeInput = document.getElementById('verificationCode');
    const verifyBtn = document.getElementById('verifyCode');
    const backBtn = document.getElementById('backStep2b');
    const resendBtn = document.getElementById('resendCode');

    codeInput?.addEventListener('input', (e) => {
      // Only allow digits
      e.target.value = e.target.value.replace(/\D/g, '');
      state.verificationCode = e.target.value;

      // Auto-submit when 6 digits entered
      if (e.target.value.length === 6) {
        verifyCode();
      }
    });

    verifyBtn?.addEventListener('click', () => {
      verifyCode();
    });

    backBtn?.addEventListener('click', () => {
      goToStep(2);
    });

    resendBtn?.addEventListener('click', async () => {
      resendBtn.disabled = true;
      resendBtn.textContent = 'Sending...';

      await new Promise(resolve => setTimeout(resolve, 1000));

      resendBtn.disabled = false;
      resendBtn.textContent = 'Resend code';
      alert('Verification code resent to ' + state.contactInfo.email);
    });
  }

  async function verifyCode() {
    const codeInput = document.getElementById('verificationCode');
    const verifyBtn = document.getElementById('verifyCode');

    if (state.verificationCode.length !== 6) {
      showError(codeInput, 'verificationCodeError', 'Please enter the 6-digit code');
      return;
    }

    clearError(codeInput, 'verificationCodeError');

    if (verifyBtn) {
      verifyBtn.disabled = true;
      verifyBtn.textContent = 'Verifying...';
    }

    try {
      // In production, this would call the API
      // const response = await fetch('/wp-json/yoganearme/v1/verify/check', {
      //   method: 'POST',
      //   headers: { 'Content-Type': 'application/json' },
      //   body: JSON.stringify({
      //     code: state.verificationCode,
      //     email: state.contactInfo.email,
      //     studio_id: state.studioData.id
      //   })
      // });

      // Simulate API delay
      await new Promise(resolve => setTimeout(resolve, 1500));

      // For demo, accept any 6-digit code
      // In production, validate against backend

      // Success - claim the listing
      await claimListing();

      // Go to success step
      goToStep(3);

    } catch (error) {
      console.error('Verification error:', error);
      showError(codeInput, 'verificationCodeError', 'Invalid code. Please try again.');
    } finally {
      if (verifyBtn) {
        verifyBtn.disabled = false;
        verifyBtn.textContent = 'Verify';
      }
    }
  }

  async function claimListing() {
    // In production, this would call the API to:
    // 1. Associate the studio with the user's account
    // 2. Grant edit permissions
    // 3. Send welcome email
    // 4. Trigger onboarding email sequence

    console.log('Claiming listing with data:', {
      studio: state.studioData,
      contact: state.contactInfo,
      verificationMethod: state.verificationMethod
    });

    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 500));
  }

  // ==========================================================================
  // Step 3: Success
  // ==========================================================================

  function setupStep3() {
    const dashboardBtn = document.getElementById('goToDashboard');
    const editBtn = document.getElementById('editListingNow');

    dashboardBtn?.addEventListener('click', () => {
      // In production, redirect to dashboard
      window.location.href = '/studio-dashboard/';
    });

    editBtn?.addEventListener('click', () => {
      // In production, redirect to edit page
      window.location.href = '/edit-listing/?id=' + state.studioData.id;
    });
  }

  // ==========================================================================
  // Keyboard & Accessibility
  // ==========================================================================

  function setupAccessibility() {
    // Close on Escape
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && overlay.classList.contains('is-open')) {
        closeOverlay();
      }
    });

    // Trap focus within overlay
    overlay.addEventListener('keydown', (e) => {
      if (e.key !== 'Tab') return;

      const focusableElements = overlay.querySelectorAll(
        'button:not([disabled]), input:not([disabled]), [tabindex]:not([tabindex="-1"])'
      );
      const firstElement = focusableElements[0];
      const lastElement = focusableElements[focusableElements.length - 1];

      if (e.shiftKey && document.activeElement === firstElement) {
        e.preventDefault();
        lastElement.focus();
      } else if (!e.shiftKey && document.activeElement === lastElement) {
        e.preventDefault();
        firstElement.focus();
      }
    });
  }

  // ==========================================================================
  // Initialize
  // ==========================================================================

  function init() {
    // Open/close handlers
    openBtn?.addEventListener('click', openOverlay);
    closeBtn?.addEventListener('click', closeOverlay);
    backdrop?.addEventListener('click', closeOverlay);

    // Setup steps
    setupStep1();
    setupStep2();
    setupStep2b();
    setupStep3();
    setupAccessibility();

    console.log('Claim Listing Overlay initialized');
  }

  // Initialize when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

})();
