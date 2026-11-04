document.addEventListener('DOMContentLoaded', () => {
  const header = document.querySelector('.site-header');
  window.addEventListener('scroll', () => {
    if (window.scrollY > 40) {
      header?.classList.add('scrolled');
    } else {
      header?.classList.remove('scrolled');
    }
  });

  const counters = document.querySelectorAll('.counter');
  let counterStarted = false;

  const runCounters = () => {
    counters.forEach(counter => {
      const target = +counter.getAttribute('data-target');
      const duration = 1800;
      const stepTime = 20;
      const totalSteps = duration / stepTime;
      const increment = target / totalSteps;
      let current = 0;

      const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
          counter.innerText = target.toLocaleString();
          clearInterval(timer);
        } else {
          counter.innerText = Math.ceil(current).toLocaleString();
        }
      }, stepTime);
    });
  };

  const statsSection = document.querySelector('.stats-section');
  if (statsSection) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting && !counterStarted) {
          runCounters();
          counterStarted = true;
        }
      });
    }, { threshold: 0.2 });
    observer.observe(statsSection);
  }

  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const targetId = this.getAttribute('href');
      if (targetId && targetId !== '#') {
        const targetEl = document.querySelector(targetId);
        if (targetEl) {
          e.preventDefault();
          targetEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      }
    });
  });

  const backToTopBtn = document.getElementById('backToTop');
  if (backToTopBtn) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 400) {
        backToTopBtn.classList.add('show');
      } else {
        backToTopBtn.classList.remove('show');
      }
    });

    backToTopBtn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  const partnerContent = document.getElementById('partnerContent');
  if (partnerContent) {
    const list = [
      { icon: 'bi-cart3', text: 'SHWAPNO' },
      { icon: 'bi-shop', text: 'BFC' }
    ];
    let idx = 0;
    setInterval(() => {
      partnerContent.classList.add('fade-out');
      setTimeout(() => {
        idx = (idx + 1) % list.length;
        partnerContent.innerHTML = `<i class="bi ${list[idx].icon}"></i> <span>${list[idx].text}</span>`;
        partnerContent.classList.remove('fade-out');
      }, 300);
    }, 2800);
  }

  const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');
  if (revealElements.length > 0) {
    const revealObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('revealed');
          observer.unobserve(entry.target);
        }
      });
    }, {
      root: null,
      threshold: 0.12,
      rootMargin: '0px 0px -40px 0px'
    });

    revealElements.forEach(el => {
      revealObserver.observe(el);
      // Fallback: make visible after 1.5s in case scroll observer doesn't trigger
      setTimeout(() => el.classList.add('revealed'), 1500);
    });
  }

  const menuTrack = document.getElementById('menuTeaserTrack');
  const menuPrev = document.querySelector('.menu-slider-prev');
  const menuNext = document.querySelector('.menu-slider-next');
  if (menuTrack && menuPrev && menuNext) {
    const scrollAmount = 290;
    const parentWrapper = menuTrack.closest('.menu-teaser-slider-wrapper');
    menuPrev.addEventListener('click', () => {
      parentWrapper.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    });
    menuNext.addEventListener('click', () => {
      parentWrapper.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    });
  }
  const heroCarouselEl = document.getElementById('heroCarousel');
  if (heroCarouselEl) {
    const counterEl = document.getElementById('heroSlideCounter');
    const vertDots = document.querySelectorAll('.hero-vert-dot');
    heroCarouselEl.addEventListener('slide.bs.carousel', (e) => {
      const idx = e.to;
      const total = 5;
      if (counterEl) {
        counterEl.textContent = `0${idx + 1} / 0${total}`;
      }
      vertDots.forEach((dot, dIdx) => {
        if (dIdx === idx) {
          dot.classList.add('active');
        } else {
          dot.classList.remove('active');
        }
      });
    });
  }

  // Regular Membership AJAX Submission with Phone Validation
  const membershipForm = document.getElementById('santinoMembershipForm');
  if (membershipForm) {
    const phoneInput = membershipForm.querySelector('input[name="phone"]');
    if (phoneInput) {
      phoneInput.addEventListener('input', function() {
        this.setCustomValidity('');
      });
    }

    membershipForm.addEventListener('submit', function(e) {
      e.preventDefault();

      const phoneVal = (this.querySelector('input[name="phone"]')?.value || '').trim().replace(/[\s-]/g, '');
      const bdPhoneRegex = /^(?:\+?880|0)?1[3-9]\d{8}$/;

      if (!bdPhoneRegex.test(phoneVal)) {
        const phoneField = this.querySelector('input[name="phone"]');
        if (phoneField) {
          phoneField.focus();
          phoneField.setCustomValidity('Please enter a valid 11-digit phone number (e.g. 017XXXXXXXX)');
          phoneField.reportValidity();
        } else {
          alert('Please enter a valid phone number (e.g. 017XXXXXXXX or +88017XXXXXXXX).');
        }
        return;
      }

      const submitBtn = this.querySelector('button[type="submit"]');
      const originalText = submitBtn ? submitBtn.innerHTML : 'Submit';
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Processing Application...';
      }

      const formData = new FormData(this);
      formData.append('action', 'santino_apply_membership');
      if (typeof santino_ajax !== 'undefined') {
        formData.append('security', santino_ajax.nonce);
      }

      const ajaxUrl = (typeof santino_ajax !== 'undefined') ? santino_ajax.ajax_url : '/wp-admin/admin-ajax.php';

      fetch(ajaxUrl, {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalText;
        }
        const resBox = document.getElementById('membershipResponseBox');
        if (data.success) {
          if (resBox) {
            resBox.style.display = 'block';
            resBox.innerHTML = `
              <div class="alert alert-success rounded-4 p-4 text-center shadow-sm">
                <i class="bi bi-patch-check-fill text-success fs-1 d-block mb-2"></i>
                <h4 class="fw-bold mb-2">Membership Activated!</h4>
                <p class="mb-3 text-muted">${data.data.message}</p>
                <div class="p-3 bg-white rounded-3 border d-inline-block text-dark text-start">
                  <div class="small text-muted text-uppercase">Santino Member ID</div>
                  <div class="fs-4 fw-bold text-success font-monospace">${data.data.member_id}</div>
                  <div class="small text-muted mt-1">Tier: <strong>${data.data.tier}</strong></div>
                </div>
              </div>
            `;
            membershipForm.reset();
            resBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
          } else {
            alert(data.data.message + '\nYour ID: ' + data.data.member_id);
            membershipForm.reset();
          }
        } else {
          if (resBox) {
            resBox.style.display = 'block';
            resBox.innerHTML = `
              <div class="alert alert-danger rounded-4 p-3 text-center shadow-sm">
                <i class="bi bi-exclamation-triangle-fill text-danger fs-3 d-block mb-1"></i>
                <strong>${data.data ? data.data.message : 'Error submitting form.'}</strong>
              </div>
            `;
            resBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
          } else {
            alert(data.data ? data.data.message : 'Error submitting form.');
          }
        }
      })
      .catch(err => {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalText;
        }
        console.error('Submission error:', err);
        alert('Could not submit application. Please check network connection.');
      });
    });
  }

  // URL Hash Deep Linking for Membership / Portal Tabs
  const handleTabHash = () => {
    const rawHash = (window.location.hash || '').toLowerCase().replace('#', '').trim();
    if (!rawHash) return;

    let targetBtn = null;

    if (rawHash === 'invoice' || rawHash === 'log-invoice' || rawHash === 'invoice-pane' || rawHash === 'invoice-tab') {
      targetBtn = document.getElementById('invoice-tab');
    } else if (rawHash === 'register' || rawHash === 'join' || rawHash === 'register-pane' || rawHash === 'register-tab' || rawHash === 'coffee-club') {
      targetBtn = document.getElementById('register-tab');
    } else if (rawHash === 'stamps' || rawHash === 'stamps-pane' || rawHash === 'stamps-tab' || rawHash === 'check' || rawHash === 'lookup' || rawHash === 'stamp-status') {
      targetBtn = document.getElementById('stamps-tab');
    } else {
      targetBtn = document.querySelector(`button[data-bs-target="#${rawHash}"], button[data-bs-target="#${rawHash}-pane"], button#${rawHash}-tab, #${rawHash}`);
    }

    if (targetBtn && (targetBtn.getAttribute('data-bs-toggle') === 'pill' || targetBtn.getAttribute('data-bs-toggle') === 'tab')) {
      if (typeof bootstrap !== 'undefined' && bootstrap.Tab) {
        const tab = new bootstrap.Tab(targetBtn);
        tab.show();
      } else {
        targetBtn.click();
      }
      setTimeout(() => {
        const tabsWrapper = targetBtn.closest('.portal-card') || targetBtn.closest('#loyaltyTabs') || targetBtn;
        tabsWrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }, 150);
    }
  };

  handleTabHash();
  window.addEventListener('hashchange', handleTabHash);

  document.querySelectorAll('#loyaltyTabs button[data-bs-toggle="pill"], .portal-tabs button[data-bs-toggle="pill"]').forEach(btn => {
    btn.addEventListener('shown.bs.tab', function(e) {
      const targetId = (e.target.getAttribute('data-bs-target') || '').replace('#', '').replace('-pane', '');
      if (targetId && history.replaceState) {
        history.replaceState(null, null, '#' + targetId);
      }
    });
  });

  // Stepper handlers for Cups count
  document.addEventListener('click', function(e) {
    const plusBtn = e.target.closest('.santino-cup-plus');
    const minusBtn = e.target.closest('.santino-cup-minus');
    if (plusBtn) {
      e.preventDefault();
      const input = plusBtn.closest('.input-group')?.querySelector('.santino-cups-input') || document.querySelector('input[name="cups"]');
      if (input) {
        let val = parseInt(input.value) || 1;
        if (val < 50) input.value = val + 1;
      }
    }
    if (minusBtn) {
      e.preventDefault();
      const input = minusBtn.closest('.input-group')?.querySelector('.santino-cups-input') || document.querySelector('input[name="cups"]');
      if (input) {
        let val = parseInt(input.value) || 1;
        if (val > 1) input.value = val - 1;
      }
    }
  });

  // Real-time BD Phone live validation
  document.addEventListener('input', function(e) {
    if (e.target && (e.target.type === 'tel' || e.target.name === 'phone' || e.target.classList.contains('santino-phone-validate'))) {
      const clean = e.target.value.trim().replace(/[\s\-\(\)\.]/g, '');
      const bdPhoneRegex = /^(?:\+?880|0)1[3-9]\d{8}$/;
      if (clean.length >= 11) {
        if (bdPhoneRegex.test(clean)) {
          e.target.setCustomValidity('');
          e.target.classList.remove('is-invalid');
          e.target.classList.add('is-valid');
        } else {
          e.target.setCustomValidity('Please enter a valid 11-digit mobile number (013-019)');
          e.target.classList.remove('is-valid');
          e.target.classList.add('is-invalid');
        }
      } else {
        e.target.setCustomValidity('');
        e.target.classList.remove('is-valid', 'is-invalid');
      }
    }
  });

  // Invoice Submission Form (Supports Cups Count, Stepper & Receipt Image)
  const invoiceForm = document.getElementById('santinoInvoiceForm');
  if (invoiceForm) {
    invoiceForm.addEventListener('submit', function(e) {
      e.preventDefault();

      const phoneField = this.querySelector('input[name="phone"]');
      if (phoneField) {
        const cleanPhone = phoneField.value.trim().replace(/[\s\-\(\)\.]/g, '');
        const bdPhoneRegex = /^(?:\+?880|0)1[3-9]\d{8}$/;
        if (!bdPhoneRegex.test(cleanPhone)) {
          phoneField.focus();
          phoneField.setCustomValidity('Please enter a valid 11-digit Bangladeshi mobile number (e.g. 017XXXXXXXX).');
          phoneField.reportValidity();
          return;
        } else {
          phoneField.setCustomValidity('');
        }
      }

      const cupsInput = this.querySelector('input[name="cups"]');
      const cupsVal = cupsInput ? (parseInt(cupsInput.value) || 1) : 1;

      const fileInput = this.querySelector('input[name="invoice_image"]');
      if (fileInput && (!fileInput.files || !fileInput.files.length)) {
        fileInput.focus();
        fileInput.setCustomValidity('Receipt or memo photo upload is mandatory.');
        fileInput.reportValidity();
        return;
      } else if (fileInput) {
        fileInput.setCustomValidity('');
      }

      const submitBtn = this.querySelector('button[type="submit"]');
      const originalText = submitBtn ? submitBtn.innerHTML : 'Submit Invoice';
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Submitting Invoice...';
      }

      const formData = new FormData(this);
      formData.set('cups', cupsVal);
      formData.append('action', 'santino_submit_invoice');
      if (typeof santino_ajax !== 'undefined') {
        formData.append('security', santino_ajax.nonce);
      }

      const ajaxUrl = (typeof santino_ajax !== 'undefined') ? santino_ajax.ajax_url : '/wp-admin/admin-ajax.php';

      fetch(ajaxUrl, {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalText;
        }
        const resBox = document.getElementById('invoiceResponseBox');
        if (data.success) {
          if (resBox) {
            resBox.style.display = 'block';
            resBox.innerHTML = `
              <div class="alert alert-success rounded-4 p-3 p-md-4 text-center shadow-sm border-0" style="background: #e8f5e9; border: 1px solid #c8e6c9 !important;">
                <i class="bi bi-receipt-cutoff text-success fs-2 d-block mb-2"></i>
                <h4 class="fw-bold mb-2 text-dark font-heading" style="font-size: 1.2rem;">Invoice Logged Successfully!</h4>
                <p class="mb-2 text-muted small" style="line-height: 1.5;">${data.data.message}</p>
                <div class="mt-2 d-inline-block px-3 py-1.5 rounded-pill fw-bold text-dark text-wrap" style="background: #fef08a; color: #854d0e !important; font-size: 0.78rem; line-height: 1.35; max-width: 100%; word-break: break-word; border: 1px solid #fde047;">
                  ⏳ Status: Pending Portal Verification
                </div>
              </div>
            `;
            invoiceForm.reset();
            const resetCups = invoiceForm.querySelector('input[name="cups"]');
            if (resetCups) resetCups.value = 1;
            resBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
          } else {
            alert(data.data.message);
            invoiceForm.reset();
          }
        } else {
          if (resBox) {
            resBox.style.display = 'block';
            resBox.innerHTML = `
              <div class="alert alert-danger rounded-4 p-3 text-center shadow-sm text-wrap" style="word-break: break-word;">
                <i class="bi bi-exclamation-triangle-fill text-danger fs-3 d-block mb-1"></i>
                <strong class="small">${data.data ? data.data.message : 'Error submitting invoice.'}</strong>
              </div>
            `;
            resBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
          } else {
            alert(data.data ? data.data.message : 'Error submitting invoice.');
          }
        }
      })
      .catch(err => {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalText;
        }
        console.error('Invoice error:', err);
        alert('Could not submit invoice. Please check network connection.');
      });
    });
  }


  // Stamp Card Live Lookup Form (Shows Remaining Cups Modulo 5 & Vouchers)
  const lookupForm = document.getElementById('santinoLookupForm');
  if (lookupForm) {
    lookupForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const input = this.querySelector('input[name="query"]');
      const submitBtn = this.querySelector('button[type="submit"]');
      if (!input || !input.value.trim()) return;

      const originalText = submitBtn ? submitBtn.innerHTML : 'Check Stamps';
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Checking...';
      }

      const formData = new FormData();
      formData.append('action', 'santino_lookup_stamp_card');
      formData.append('query', input.value.trim());
      if (typeof santino_ajax !== 'undefined') {
        formData.append('security', santino_ajax.nonce);
      }

      const ajaxUrl = (typeof santino_ajax !== 'undefined') ? santino_ajax.ajax_url : '/wp-admin/admin-ajax.php';

      fetch(ajaxUrl, {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalText;
        }
        const cardBox = document.getElementById('liveStampCardContainer');
        if (data.success && cardBox) {
          const d = data.data;
          const stamps = Math.min(5, Math.max(0, parseInt(d.stamps) || 0));
          const hasUnusedVoucher = d.vouchers && d.vouchers.some(v => v.status === 'unused');
          const activeVoucher = d.vouchers ? d.vouchers.find(v => v.status === 'unused') : null;
          const activeVoucherCode = activeVoucher ? activeVoucher.code : '';

          let cupsHtml = '';
          for (let i = 1; i <= 5; i++) {
            const isActive = i <= stamps;
            cupsHtml += `
              <div class="stamp-cup-item text-center flex-grow-1" style="min-width: 0; max-width: 16.66%;">
                <div style="width: 100%; max-width: 48px; min-width: 34px; aspect-ratio: 1 / 1; margin: 0 auto; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: clamp(14px, 4vw, 18px); font-weight: 800; border: 2px solid ${isActive ? '#ffffff' : 'rgba(195, 153, 108, 0.35)'}; background: ${isActive ? 'linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%)' : 'rgba(0, 98, 93, 0.25)'}; color: ${isActive ? '#041a18' : 'rgba(255,255,255,0.45)'}; box-shadow: ${isActive ? '0 0 14px rgba(223, 190, 141, 0.5)' : 'none'}; transition: all 0.3s ease;">
                  ${isActive ? '<i class="bi bi-cup-hot-fill" style="color: #041a18;"></i>' : i}
                </div>
                <div class="text-truncate mt-1.5" style="font-size: clamp(9px, 2.5vw, 11px); font-weight: 700; color: ${isActive ? '#dfbe8d' : 'rgba(255,255,255,0.45)'};">
                  Cup ${i}${isActive ? ' ✓' : ''}
                </div>
              </div>
            `;
          }

          // 6th Cup Free Circle
          const isFreeReady = stamps >= 5 || hasUnusedVoucher;
          cupsHtml += `
            <div class="stamp-cup-item text-center flex-grow-1" style="min-width: 0; max-width: 16.66%;">
              <div style="width: 100%; max-width: 48px; min-width: 34px; aspect-ratio: 1 / 1; margin: 0 auto; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: clamp(14px, 4vw, 18px); border: 2px solid ${isFreeReady ? '#dfbe8d' : 'rgba(223, 190, 141, 0.35)'}; background: ${isFreeReady ? 'linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%)' : 'rgba(223, 190, 141, 0.12)'}; color: ${isFreeReady ? '#041a18' : 'rgba(223,190,141,0.5)'}; box-shadow: ${isFreeReady ? '0 0 18px rgba(223, 190, 141, 0.7)' : 'none'};">
                <i class="bi bi-gift-fill" style="${isFreeReady ? 'color: #041a18;' : 'color: #dfbe8d;'}"></i>
              </div>
              <div class="text-truncate mt-1.5" style="font-size: clamp(9px, 2.5vw, 11px); font-weight: 800; color: ${isFreeReady ? '#dfbe8d' : 'rgba(223, 190, 141, 0.6)'};">
                ${isFreeReady ? 'FREE #6 ★' : 'FREE #6'}
              </div>
            </div>
          `;

          let vouchersHtml = '';
          if (d.vouchers && d.vouchers.length > 0) {
            vouchersHtml = `
              <div class="mt-3 p-3 rounded-4 border" style="background: rgba(195, 153, 108, 0.08); border-color: rgba(195, 153, 108, 0.3) !important;">
                <div class="d-flex justify-content-between align-items-center mb-2.5">
                  <h6 class="fw-bold mb-0 text-white" style="font-size: 13px;"><i class="bi bi-gift-fill me-1.5" style="color: #dfbe8d;"></i> Complimentary Vouchers:</h6>
                  <span class="badge rounded-pill" style="background: rgba(223, 190, 141, 0.2); color: #dfbe8d; font-size: 10px; font-weight: 700;">${d.vouchers.filter(v => v.status === 'unused').length} Active</span>
                </div>
                <div class="d-flex flex-column gap-2">
                  ${d.vouchers.map(v => `
                    <div class="p-3 rounded-3 border d-flex flex-wrap align-items-center justify-content-between gap-2" style="background: rgba(0, 0, 0, 0.35); border-color: rgba(195,153,108,0.25) !important;">
                      <div class="d-flex align-items-center gap-2 flex-wrap">
                        <code class="fs-6 fw-bold px-2.5 py-1 rounded" style="background: rgba(223, 190, 141, 0.15); color: #dfbe8d; letter-spacing: 0.5px;">${v.code}</code>
                        <span class="badge ${v.status === 'unused' ? 'bg-success' : (v.status === 'pending_redemption' ? 'bg-warning text-dark' : 'bg-secondary')}" style="font-size: 10px;">
                          ${v.status === 'unused' ? '✓ READY TO CLAIM' : (v.status === 'pending_redemption' ? '⏳ PENDING APPROVAL' : '✓ REDEEMED')}
                        </span>
                      </div>
                      <div class="d-flex align-items-center gap-2 flex-wrap">
                        <button type="button" class="btn btn-outline-light btn-sm fw-bold px-3 py-1.5 rounded-pill santino-download-voucher-btn" data-code="${v.code}" data-name="${d.name}" data-phone="${d.phone}" data-id="${d.member_id}" data-type="voucher" data-status="${v.status}" style="font-size: 11px; border-color: rgba(223,190,141,0.4); color: #dfbe8d;">
                          <i class="bi bi-download me-1"></i> Download Voucher
                        </button>
                        ${v.status === 'unused' ? `
                          <button type="button" class="btn btn-sm fw-bold px-3.5 py-1.5 rounded-pill santino-open-redeem-btn" data-voucher="${v.code}" data-phone="${d.phone}" style="background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%); color: #041a18; font-size: 11px; border: none; font-weight: 800;">
                            <i class="bi bi-cup-hot-fill me-1"></i> Redeem Now &rarr;
                          </button>
                        ` : ''}
                      </div>
                    </div>
                  `).join('')}
                </div>
              </div>
            `;
          }

          let redeemsHtml = '';
          if (d.redeems && d.redeems.length > 0) {
            redeemsHtml = `
              <div class="mt-3 p-3 rounded-4 border" style="background: rgba(0, 98, 93, 0.15); border-color: rgba(0, 98, 93, 0.4) !important;">
                <h6 class="fw-bold mb-2 text-white" style="font-size: 13px;"><i class="bi bi-clock-history me-1.5" style="color: #dfbe8d;"></i> Recent Redemptions:</h6>
                <div class="d-flex flex-column gap-2">
                  ${d.redeems.map(r => `
                    <div class="p-2.5 rounded-3 d-flex flex-wrap align-items-center justify-content-between gap-2 border" style="background: rgba(0, 0, 0, 0.35); border-color: rgba(255,255,255,0.1) !important;">
                      <div>
                        <span class="fw-bold text-white small">${r.item}</span>
                        <div class="text-white-50" style="font-size: 11px;">#${r.code} • ${r.branch} • ${r.date}</div>
                      </div>
                      <div class="d-flex align-items-center gap-1.5 flex-wrap">
                        <button type="button" class="btn btn-outline-light btn-sm fw-bold px-2.5 py-1 rounded-pill santino-download-voucher-btn" data-code="${r.code}" data-name="${d.name}" data-phone="${d.phone}" data-id="${d.member_id}" data-item="${r.item}" data-branch="${r.branch}" data-date="${r.date}" data-type="redeem" data-status="${r.status}" style="font-size: 10px; border-color: rgba(223,190,141,0.4); color: #dfbe8d;">
                          <i class="bi bi-download me-1"></i> Download Slip
                        </button>
                        <span class="badge ${r.status === 'approved' ? 'bg-success' : (r.status === 'rejected' ? 'bg-danger' : 'bg-warning text-dark')}" style="font-size: 10px;">
                          ${r.status === 'approved' ? '✓ APPROVED (Served)' : (r.status === 'rejected' ? '✗ REJECTED' : '⏳ PENDING APPROVAL')}
                        </span>
                      </div>
                    </div>
                  `).join('')}
                </div>
              </div>
            `;
          }

          let invoicesHtml = '';
          if (d.invoices && d.invoices.length > 0) {
            invoicesHtml = `
              <div class="mt-3 p-3 rounded-4 border" style="background: rgba(0, 0, 0, 0.25); border-color: rgba(255,255,255,0.08) !important;">
                <div class="small fw-bold text-white-50 mb-2" style="font-size: 12px;"><i class="bi bi-receipt me-1" style="color: #dfbe8d;"></i> Recent Approved Invoices:</div>
                <div class="d-flex flex-wrap gap-1.5">
                  ${d.invoices.map(inv => `
                    <span class="badge p-2 rounded-2 border text-wrap text-start ${inv.status === 'approved' ? 'border-success text-success' : 'border-warning text-warning'}" style="background: rgba(0,0,0,0.5); font-size: 11px; line-height: 1.4;">
                      #${inv.invoice_no} (${inv.cups} ${inv.cups > 1 ? 'Cups' : 'Cup'}) • ${inv.status === 'approved' ? '✓ Approved' : '⏳ Pending'}
                    </span>
                  `).join('')}
                </div>
              </div>
            `;
          }

          cardBox.style.display = 'block';
          cardBox.innerHTML = `
            <div class="card border rounded-4 shadow-2xl p-3 p-sm-4 p-md-5 mb-4 position-relative overflow-hidden" style="background: radial-gradient(ellipse at 80% 20%, #005650 0%, #071f1d 55%, #031311 100%); border: 1.5px solid rgba(223, 190, 141, 0.45) !important; color: #fff; box-shadow: 0 20px 50px rgba(0,0,0,0.5);">
              
              <!-- Card Header Row -->
              <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                <div style="min-width: 0; flex: 1;">
                  <span class="badge px-3 py-1 fw-bold text-uppercase rounded-pill" style="background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%); color: #041a18; font-size: 10px; letter-spacing: 1px;">
                    <i class="bi bi-patch-check-fill me-1"></i> SANTINO COFFEE CLUB
                  </span>
                  <h3 class="fw-bold text-white mt-2 mb-0 font-heading text-truncate" style="font-size: clamp(20px, 4.5vw, 26px);">${d.name || 'Santino Regular Member'}</h3>
                  <div class="text-white-50 small mt-1 font-monospace" style="font-size: 13px;">
                    <i class="bi bi-phone me-1" style="color: #dfbe8d;"></i> ${d.phone}
                  </div>
                </div>
                
                <div class="text-end ps-2 flex-shrink-0 d-flex flex-column align-items-end">
                  <!-- Gold Metallic Chip Graphic -->
                  <div style="width: 44px; height: 32px; border-radius: 6px; background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 50%, #e8d0aa 100%); border: 1px solid rgba(255,255,255,0.4); box-shadow: 0 2px 6px rgba(0,0,0,0.3); margin-bottom: 8px; position: relative; overflow: hidden;">
                    <div style="position: absolute; inset: 6px; border: 1px solid rgba(4,26,24,0.3); border-radius: 3px;"></div>
                    <div style="position: absolute; top: 50%; left: 0; right: 0; height: 1px; background: rgba(4,26,24,0.3);"></div>
                  </div>
                  <div class="fw-bold mb-0 font-heading" style="color: #dfbe8d; font-size: clamp(22px, 6vw, 30px); line-height: 1;">${stamps}/5</div>
                  <div class="text-white-50" style="font-size: 11px;">Card Stamps</div>
                </div>
              </div>

              <!-- Unlocked Reward Banner -->
              ${hasUnusedVoucher ? `
                <div class="p-3.5 rounded-4 mb-3 d-flex flex-wrap align-items-center justify-content-between gap-3 border" style="background: linear-gradient(135deg, rgba(223, 190, 141, 0.25) 0%, rgba(195, 153, 108, 0.12) 100%); border-color: rgba(223, 190, 141, 0.5) !important;">
                  <div class="d-flex align-items-center gap-3" style="min-width: 0; flex: 1;">
                    <div style="font-size: 32px; line-height: 1;"><i class="bi bi-gift-fill" style="color: #dfbe8d;"></i></div>
                    <div style="min-width: 0;">
                      <span class="badge rounded-pill px-2.5 py-0.5 fw-bold text-uppercase" style="background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%); color: #041a18; font-size: 9px;">REWARD UNLOCKED</span>
                      <div class="fw-bold text-white mt-1" style="font-size: 14px; color: #dfbe8d !important;">1 Complimentary Coffee Available!</div>
                      <div class="text-white-50" style="font-size: 11px;">5 stamps completed! Claim your free beverage voucher directly below.</div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-sm fw-bold px-3.5 py-2 rounded-pill santino-open-redeem-btn flex-shrink-0" data-voucher="${activeVoucherCode}" data-phone="${d.phone}" style="background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%); color: #041a18; border: none; font-size: 12px; font-weight: 800; box-shadow: 0 4px 15px rgba(223, 190, 141, 0.35);">
                    <i class="bi bi-gift-fill me-1"></i> Claim Free Coffee &rarr;
                  </button>
                </div>
              ` : ''}

              <!-- 5-Cup Stamp Card Tracker Box -->
              <div class="p-3 p-md-4 rounded-4 mt-2 shadow-lg border" style="background: rgba(0, 0, 0, 0.38); border-color: rgba(195, 153, 108, 0.3) !important;">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                  <h6 class="fw-bold mb-0 text-white font-heading" style="font-size: 13px;">
                    <i class="bi bi-cup-hot-fill me-1.5" style="color: #dfbe8d;"></i> 5-Cup Stamp Card Tracker
                  </h6>
                  <span class="badge px-2.5 py-1 rounded-pill" style="background: rgba(223, 190, 141, 0.15); color: #dfbe8d; border: 1px solid rgba(223, 190, 141, 0.35); font-size: 10px; font-weight: 700; letter-spacing: 0.5px;">
                    ${5 - stamps === 0 ? '🎉 FREE COFFEE READY!' : 'BUY 5, GET 1 FREE'}
                  </span>
                </div>
                
                <div class="d-flex justify-content-between align-items-center py-2 px-0" style="gap: 4px; width: 100%;">
                  ${cupsHtml}
                </div>
                
                <div class="d-flex justify-content-between align-items-center mt-3 pt-2.5 border-top flex-wrap gap-2" style="border-color: rgba(255,255,255,0.08) !important; font-size: 11px;">
                  <span class="text-white-50"><i class="bi bi-geo-alt-fill text-warning me-1"></i> Valid across all Dhaka branches</span>
                  <span style="color: #dfbe8d;"><i class="bi bi-patch-check-fill text-success me-1"></i> Auto-Verified</span>
                </div>
                
                ${vouchersHtml}
                ${redeemsHtml}
                ${invoicesHtml}
              </div>
            </div>
          `;
          cardBox.scrollIntoView({ behavior: 'smooth', block: 'start' });
        } else {
          alert(data.data ? data.data.message : 'No member found with this number. Please join first!');
        }
      })
      .catch(err => {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalText;
        }
        console.error('Lookup error:', err);
        alert('Could not verify stamp card. Please try again.');
      });
    });
  }

  // Frontend Free Coffee Redeem Modal Handler
  document.addEventListener('click', function(e) {
    const btn = e.target.closest('.santino-open-redeem-btn');
    if (!btn) return;
    e.preventDefault();

    const voucherCode = btn.getAttribute('data-voucher') || '';
    const phone = btn.getAttribute('data-phone') || '';

    let modalEl = document.getElementById('santinoRedeemModal');
    if (!modalEl) {
      modalEl = document.createElement('div');
      modalEl.id = 'santinoRedeemModal';
      modalEl.className = 'modal fade';
      modalEl.tabIndex = -1;
      modalEl.setAttribute('aria-hidden', 'true');
      modalEl.innerHTML = `
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 460px; margin: 10px auto; padding: 0 10px; max-height: calc(100dvh - 20px);">
          <div class="modal-content rounded-4 border-0 shadow-2xl text-white overflow-hidden" style="background: #071e1b; border: 1.5px solid rgba(223,190,141,0.45) !important; box-shadow: 0 25px 60px rgba(0,0,0,0.85); max-height: calc(100dvh - 20px); display: flex; flex-direction: column;">
            <div class="modal-header border-bottom p-3 p-sm-4" style="border-color: rgba(255,255,255,0.1) !important; background: #051614; flex-shrink: 0;">
              <div>
                <span class="badge rounded-pill px-2.5 py-0.5 fw-bold text-uppercase mb-1" style="background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%); color: #041a18; font-size: 9px;">VIP COMPLIMENTARY CUP</span>
                <h5 class="modal-title fw-bold font-heading text-white mt-1 mb-0" style="font-size: 17px;">
                  <i class="bi bi-gift-fill me-1.5" style="color: #dfbe8d;"></i> Claim Free Beverage
                </h5>
              </div>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="santinoFrontendRedeemForm" style="display: flex; flex-direction: column; overflow: hidden; flex: 1;">
              <div class="modal-body p-3 p-sm-4" style="overflow-y: auto; -webkit-overflow-scrolling: touch; flex: 1 1 auto;">
                <div class="mb-3">
                  <label class="form-label small text-white-50 fw-bold">Member Mobile Number</label>
                  <input type="text" id="santinoRedeemPhone" name="phone" class="form-control" readonly style="background: rgba(255,255,255,0.06); color: #dfbe8d; border-color: rgba(255,255,255,0.15); font-weight: bold; font-family: monospace; height: 44px; border-radius: 12px;">
                </div>
                <div class="mb-3">
                  <label class="form-label small text-white-50 fw-bold">Voucher Code</label>
                  <input type="text" id="santinoRedeemVoucher" name="voucher_code" class="form-control" readonly style="background: rgba(255,255,255,0.06); color: #dfbe8d; border-color: rgba(255,255,255,0.15); font-weight: bold; font-family: monospace; height: 44px; border-radius: 12px;">
                </div>
                <div class="mb-3">
                  <label class="form-label small text-white-50 fw-bold">Select Free Beverage *</label>
                  <select id="santinoRedeemItem" name="free_item" class="form-select" required style="background: #0d2825; color: #fff; border-color: rgba(223, 190, 141, 0.4); height: 44px; border-radius: 12px; font-weight: 600;">
                    <option value="Handcrafted Cappuccino">Handcrafted Cappuccino</option>
                    <option value="Cafe Latte">Cafe Latte</option>
                    <option value="Classic Americano">Classic Americano</option>
                    <option value="Spanish Latte">Spanish Latte</option>
                    <option value="Caramel Macchiato">Caramel Macchiato</option>
                    <option value="Flat White">Flat White</option>
                    <option value="Hot Mocha">Hot Mocha</option>
                    <option value="Iced Signature Latte">Iced Signature Latte</option>
                    <option value="Cold Brew Reserve">Cold Brew Reserve</option>
                    <option value="Hot Chocolate">Hot Chocolate</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label class="form-label small text-white-50 fw-bold">Select Pickup Cafe Branch *</label>
                  <select id="santinoRedeemBranch" name="branch" class="form-select" required style="background: #0d2825; color: #fff; border-color: rgba(223, 190, 141, 0.4); height: 44px; border-radius: 12px; font-weight: 600;">
                  </select>
                </div>
                <div class="alert alert-info rounded-3 p-3 mb-0" style="background: rgba(0, 98, 93, 0.2); border: 1px solid rgba(0, 98, 93, 0.4); font-size: 11px; color: #dfbe8d; line-height: 1.5;">
                  <i class="bi bi-info-circle me-1.5"></i> Present this voucher code to your barista at your chosen branch to enjoy your complimentary handcrafted coffee.
                </div>
              </div>
              <div class="modal-footer border-top d-flex flex-row gap-2 w-100 p-2.5 p-sm-3" style="background: #051614; border-color: rgba(255,255,255,0.1) !important; flex-shrink: 0; position: sticky; bottom: 0; z-index: 10;">
                <button type="button" class="btn btn-outline-light rounded-pill flex-fill py-2.5" data-bs-dismiss="modal" style="min-height: 46px; font-weight: 700; font-size: 13.5px; border-color: rgba(255,255,255,0.3);">Cancel</button>
                <button type="submit" id="santinoRedeemSubmitBtn" class="btn fw-bold rounded-pill flex-fill py-2.5" style="background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%); color: #041a18; border: none; font-size: 14px; font-weight: 800; min-height: 46px; box-shadow: 0 4px 15px rgba(223, 190, 141, 0.35); cursor: pointer;">
                  Confirm Redemption &rarr;
                </button>
              </div>
            </form>
          </div>
        </div>
      `;
      document.body.appendChild(modalEl);

      const redeemForm = document.getElementById('santinoFrontendRedeemForm');
      redeemForm.addEventListener('submit', function(evt) {
        evt.preventDefault();
        const submitBtn = document.getElementById('santinoRedeemSubmitBtn');
        const origText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Submitting...';

        const formData = new FormData(this);
        formData.append('action', 'santino_submit_redeem');
        if (typeof santino_ajax !== 'undefined') {
          formData.append('security', santino_ajax.nonce);
        }

        const ajaxUrl = (typeof santino_ajax !== 'undefined') ? santino_ajax.ajax_url : '/wp-admin/admin-ajax.php';

        fetch(ajaxUrl, {
          method: 'POST',
          body: formData
        })
        .then(res => res.json())
        .then(resData => {
          submitBtn.disabled = false;
          submitBtn.innerHTML = origText;
          if (resData.success) {
            if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
              const modalInstance = bootstrap.Modal.getInstance(modalEl);
              if (modalInstance) modalInstance.hide();
            } else {
              modalEl.classList.remove('show');
              modalEl.style.display = 'none';
              document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
            }
            if (resData.data && resData.data.print_url) {
              if (confirm((resData.data.message || 'Coffee redemption request confirmed!') + '\n\nWould you like to print or download your 6th Cup Free POS Slip now?')) {
                window.open(resData.data.print_url, '_blank');
              }
            } else {
              alert(resData.data ? resData.data.message : 'Free coffee redemption request submitted successfully!');
            }
            const lookupForm = document.getElementById('santinoLookupForm');
            if (lookupForm) {
              lookupForm.dispatchEvent(new Event('submit'));
            }
          } else {
            alert(resData.data ? resData.data.message : 'Could not submit redemption request.');
          }
        })
        .catch(err => {
          submitBtn.disabled = false;
          submitBtn.innerHTML = origText;
          console.error('Redeem error:', err);
          alert('Network issue. Could not submit request. Please try again.');
        });
      });
    }

    document.getElementById('santinoRedeemPhone').value = phone;
    document.getElementById('santinoRedeemVoucher').value = voucherCode;

    const itemSelect = document.getElementById('santinoRedeemItem');
    if (itemSelect && typeof santino_ajax !== 'undefined' && Array.isArray(santino_ajax.redeem_items) && santino_ajax.redeem_items.length > 0) {
      itemSelect.innerHTML = santino_ajax.redeem_items.map(it => `<option value="${it}">${it}</option>`).join('');
    }

    const branchSelect = document.getElementById('santinoRedeemBranch');
    const branches = (typeof santino_ajax !== 'undefined' && Array.isArray(santino_ajax.branches) && santino_ajax.branches.length > 0)
      ? santino_ajax.branches
      : [
          'Gulshan-2 Flagship Experience Center',
          'Banani Borak Mehnur',
          'Tejgaon Roastery & Lab',
          'Dhanmondi Ahmed & Kazi Tower',
          'Uttara Liberty Tower',
          'Baridhara Diplomatic Enclave'
        ];
    branchSelect.innerHTML = branches.map(b => `<option value="${b}">${b}</option>`).join('');

    if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
      const modal = new bootstrap.Modal(modalEl);
      modal.show();
    } else {
      modalEl.classList.add('show');
      modalEl.style.display = 'block';
    }
  });
});

// Global Certificate Verification Helper
window.handleCertVerify = function(e) {
  if (e) e.preventDefault();
  const inputEl = document.getElementById('certIdInput');
  if (!inputEl) return false;
  const query = inputEl.value.trim().toUpperCase();
  const btn = document.getElementById('btnVerifySubmit');
  const notFoundEl = document.getElementById('certNotFound');
  const resultEl = document.getElementById('certResultDisplay');

  if (!query) return false;

  const originalBtnHtml = btn ? btn.innerHTML : 'Verify Now';
  if (btn) {
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span><span>Verifying...</span>';
  }

  const ajaxUrl = (typeof santino_ajax !== 'undefined' && santino_ajax.ajax_url) ? santino_ajax.ajax_url : '/wp-admin/admin-ajax.php';
  const formData = new FormData();
  formData.append('action', 'santino_verify_certificate');
  formData.append('cert_id', query);

  fetch(ajaxUrl, {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(json => {
    if (json.success && json.data) {
      const data = json.data;
      if (notFoundEl) notFoundEl.style.display = 'none';

      const setEl = (id, txt) => {
        const el = document.getElementById(id);
        if (el) el.textContent = txt;
      };

      setEl('certCandidateName', data.name);
      setEl('certDisplayId', data.id);
      setEl('certInstituteTitle', data.institute);
      setEl('certCourseName', data.course);
      setEl('certDuration', data.duration);
      setEl('certIssueDate', data.issueDate);
      setEl('certStandard', data.standard);
      setEl('certGrade', data.grade);
      setEl('certTrainer', data.trainer);
      setEl('certHash', 'HASH: ' + data.hash);

      if (resultEl) {
        resultEl.style.display = 'block';
        resultEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }
    } else {
      if (resultEl) resultEl.style.display = 'none';
      const msg = (json.data && json.data.message) ? json.data.message : ('No record found for ID "' + query + '". Please verify the certificate serial code and try again.');
      const notFoundMsg = document.getElementById('notFoundMessage');
      if (notFoundMsg) notFoundMsg.textContent = msg;
      if (notFoundEl) {
        notFoundEl.style.display = 'block';
        notFoundEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }
    }
  })
  .catch(err => {
    console.error('Cert verify error:', err);
    if (resultEl) resultEl.style.display = 'none';
    const notFoundMsg = document.getElementById('notFoundMessage');
    if (notFoundMsg) notFoundMsg.textContent = 'Could not verify certificate due to network error. Please try again.';
    if (notFoundEl) notFoundEl.style.display = 'block';
  })
  .finally(() => {
    if (btn) {
      btn.disabled = false;
      btn.innerHTML = originalBtnHtml;
    }
  });

  return false;
};

window.fillAndVerify = function(id) {
  const input = document.getElementById('certIdInput');
  if (input) {
    input.value = id;
    window.handleCertVerify();
  }
};

window.resetVerification = function() {
  const input = document.getElementById('certIdInput');
  if (input) input.value = '';
  const result = document.getElementById('certResultDisplay');
  if (result) result.style.display = 'none';
  const notFound = document.getElementById('certNotFound');
  if (notFound) notFound.style.display = 'none';
  if (input) input.focus();
};

window.shareRecord = function() {
  const certIdEl = document.getElementById('certDisplayId');
  const certId = certIdEl ? certIdEl.textContent : '';
  const url = window.location.origin + window.location.pathname + '?id=' + encodeURIComponent(certId);
  if (navigator.clipboard) {
    navigator.clipboard.writeText(url).then(() => {
      alert('Verification link copied to clipboard: ' + url);
    });
  } else {
    prompt('Copy this link:', url);
  }
};

// Global Digital Voucher & Redeem Slip Generator & Downloader
window.generateAndDownloadSantinoVoucher = function(info) {
  const canvas = document.createElement('canvas');
  canvas.width = 1100;
  canvas.height = 560;
  const ctx = canvas.getContext('2d');

  const bgGrad = ctx.createLinearGradient(0, 0, 1100, 560);
  bgGrad.addColorStop(0, '#041816');
  bgGrad.addColorStop(0.5, '#08332f');
  bgGrad.addColorStop(1, '#020d0c');
  ctx.fillStyle = bgGrad;
  ctx.fillRect(0, 0, 1100, 560);

  const radialGlow = ctx.createRadialGradient(250, 150, 20, 250, 150, 450);
  radialGlow.addColorStop(0, 'rgba(195, 153, 108, 0.22)');
  radialGlow.addColorStop(1, 'rgba(0, 0, 0, 0)');
  ctx.fillStyle = radialGlow;
  ctx.fillRect(0, 0, 1100, 560);

  ctx.strokeStyle = '#c3996c';
  ctx.lineWidth = 4;
  ctx.strokeRect(16, 16, 1068, 528);

  ctx.strokeStyle = 'rgba(223, 190, 141, 0.45)';
  ctx.lineWidth = 1.5;
  ctx.setLineDash([8, 6]);
  ctx.strokeRect(28, 28, 1044, 504);
  ctx.setLineDash([]);

  ctx.strokeStyle = 'rgba(223, 190, 141, 0.5)';
  ctx.lineWidth = 2;
  ctx.setLineDash([8, 8]);
  ctx.beginPath();
  ctx.moveTo(740, 28);
  ctx.lineTo(740, 532);
  ctx.stroke();
  ctx.setLineDash([]);

  ctx.fillStyle = '#0f172a';
  ctx.beginPath();
  ctx.arc(740, 28, 20, 0, Math.PI);
  ctx.fill();
  ctx.beginPath();
  ctx.arc(740, 532, 20, Math.PI, 0);
  ctx.fill();

  ctx.fillStyle = '#dfbe8d';
  ctx.font = 'bold 16px "Montserrat", sans-serif';
  ctx.fillText('SANTINO SPECIALTY COFFEE ROASTERS', 55, 75);

  ctx.fillStyle = '#ffffff';
  ctx.font = '13px "Plus Jakarta Sans", sans-serif';
  ctx.fillText('VIP REWARD PROGRAM • DIGITAL COFFEE PASS', 55, 98);

  const lineGrad = ctx.createLinearGradient(55, 115, 680, 115);
  lineGrad.addColorStop(0, '#dfbe8d');
  lineGrad.addColorStop(1, 'rgba(223, 190, 141, 0)');
  ctx.strokeStyle = lineGrad;
  ctx.lineWidth = 2;
  ctx.beginPath();
  ctx.moveTo(55, 115);
  ctx.lineTo(680, 115);
  ctx.stroke();

  ctx.fillStyle = '#dfbe8d';
  ctx.font = 'bold 36px "Montserrat", sans-serif';
  if (info.type === 'redeem') {
    ctx.fillText('FREE COFFEE REDEEM SLIP', 55, 168);
    ctx.fillStyle = '#ffffff';
    ctx.font = 'bold 22px "Plus Jakarta Sans", sans-serif';
    ctx.fillText('Item: ' + (info.item || 'Handcrafted Cappuccino'), 55, 204);
  } else {
    ctx.fillText('1 FREE HANDCRAFTED COFFEE', 55, 168);
    ctx.fillStyle = '#ffffff';
    ctx.font = 'bold 20px "Plus Jakarta Sans", sans-serif';
    ctx.fillText('Complimentary Beverage Reward (5-Cup Stamp Completion)', 55, 204);
  }

  ctx.fillStyle = 'rgba(0, 0, 0, 0.45)';
  ctx.fillRect(55, 235, 630, 200);
  ctx.strokeStyle = 'rgba(223, 190, 141, 0.3)';
  ctx.lineWidth = 1;
  ctx.strokeRect(55, 235, 630, 200);

  ctx.fillStyle = '#94a3b8';
  ctx.font = '12px "Plus Jakarta Sans", sans-serif';
  ctx.fillText('MEMBER NAME', 80, 268);
  ctx.fillText('PHONE NUMBER', 380, 268);

  ctx.fillStyle = '#ffffff';
  ctx.font = 'bold 18px "Plus Jakarta Sans", sans-serif';
  ctx.fillText(info.name || 'Valued Regular Member', 80, 296);
  ctx.fillText(info.phone || '017XXXXXXXX', 380, 296);

  ctx.fillStyle = '#94a3b8';
  ctx.font = '12px "Plus Jakarta Sans", sans-serif';
  ctx.fillText('MEMBERSHIP VIP ID', 80, 345);
  ctx.fillText('OUTLET / LOCATION', 380, 345);

  ctx.fillStyle = '#dfbe8d';
  ctx.font = 'bold 16px "Courier New", monospace';
  ctx.fillText(info.id || 'SNT-REG-VIP', 80, 372);
  ctx.fillStyle = '#ffffff';
  ctx.font = 'bold 14px "Plus Jakarta Sans", sans-serif';
  ctx.fillText(info.branch || 'Valid Across All Santino Outlets', 380, 372);

  ctx.fillStyle = '#64748b';
  ctx.font = '11px "Plus Jakarta Sans", sans-serif';
  ctx.fillText('Status: ' + (info.status || 'Active').toUpperCase() + (info.date ? ' • Date: ' + info.date : ''), 80, 412);

  ctx.fillStyle = 'rgba(255, 255, 255, 0.6)';
  ctx.font = '11px "Plus Jakarta Sans", sans-serif';
  ctx.fillText('Present this official digital voucher pass to the barista before placing your order. Non-transferable.', 55, 478);
  ctx.fillText('Santino Specialty Coffee • ISO Accredited Barista Standards • support: sales@santino.com.bd', 55, 498);

  ctx.fillStyle = 'rgba(223, 190, 141, 0.12)';
  ctx.fillRect(765, 55, 285, 120);
  ctx.strokeStyle = 'rgba(223, 190, 141, 0.4)';
  ctx.lineWidth = 1.5;
  ctx.strokeRect(765, 55, 285, 120);

  ctx.fillStyle = '#94a3b8';
  ctx.font = 'bold 12px "Montserrat", sans-serif';
  ctx.fillText('OFFICIAL SERIAL CODE', 810, 85);

  ctx.fillStyle = '#dfbe8d';
  ctx.font = 'bold 22px "Courier New", monospace';
  ctx.fillText(info.code || 'FREE-CUP-XXXXXX', 785, 125);

  const isApprovedOrUnused = info.status === 'unused' || info.status === 'approved';
  ctx.fillStyle = isApprovedOrUnused ? '#059669' : '#d97706';
  ctx.fillRect(765, 195, 285, 34);
  ctx.fillStyle = '#ffffff';
  ctx.font = 'bold 12px "Plus Jakarta Sans", sans-serif';
  ctx.fillText(isApprovedOrUnused ? '✓ AUTHENTICATED VOUCHER' : '⏳ ' + (info.status || 'PENDING').toUpperCase(), 805, 217);

  const barX = 765;
  const barY = 250;
  const barW = 285;
  const barH = 110;
  ctx.fillStyle = '#ffffff';
  ctx.fillRect(barX, barY, barW, barH);

  ctx.fillStyle = '#000000';
  let curX = barX + 12;
  const seedStr = (info.code || 'SANTINO') + (info.phone || '8801');
  for (let i = 0; i < 48; i++) {
    const charCode = seedStr.charCodeAt(i % seedStr.length) + i;
    const w = (charCode % 4) + 1.8;
    const gap = (charCode % 3) + 2;
    if (curX + w < barX + barW - 12) {
      ctx.fillRect(curX, barY + 10, w, barH - 30);
      curX += w + gap;
    }
  }
  ctx.font = 'bold 11px "Courier New", monospace';
  ctx.fillStyle = '#333333';
  ctx.fillText(info.code || 'FREE-CUP-XXXX', barX + 50, barY + barH - 8);

  ctx.strokeStyle = 'rgba(223, 190, 141, 0.6)';
  ctx.lineWidth = 2;
  ctx.setLineDash([4, 4]);
  ctx.beginPath();
  ctx.arc(905, 440, 50, 0, Math.PI * 2);
  ctx.stroke();
  ctx.setLineDash([]);

  ctx.fillStyle = '#dfbe8d';
  ctx.font = 'bold 10px "Montserrat", sans-serif';
  ctx.fillText('SANTINO ROASTERY', 855, 425);
  ctx.fillText('VIP STAMP CARD', 860, 442);
  ctx.fillText('VERIFIED 2026', 868, 458);

  const dataUrl = canvas.toDataURL('image/png');
  const filename = `Santino-${info.type === 'redeem' ? 'Redeem-Slip' : 'Free-Coffee-Voucher'}-${info.code || 'PASS'}.png`;

  const link = document.createElement('a');
  link.download = filename;
  link.href = dataUrl;
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);

  let previewModal = document.getElementById('santinoVoucherPreviewModal');
  if (!previewModal) {
    previewModal = document.createElement('div');
    previewModal.id = 'santinoVoucherPreviewModal';
    previewModal.className = 'modal fade';
    previewModal.tabIndex = -1;
    previewModal.innerHTML = `
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow-2xl text-white" style="background: #061917; border: 1px solid rgba(195,153,108,0.4) !important;">
          <div class="modal-header border-bottom" style="border-color: rgba(255,255,255,0.1) !important;">
            <h5 class="modal-title fw-bold text-white font-heading" style="font-size: 16px;">
              🎉 Digital Voucher Pass Ready
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body p-3 p-md-4 text-center">
            <p class="small text-white-50 mb-3">Your voucher image is ready. Present this digital pass or voucher code at any partner cafe to enjoy your complimentary beverage.</p>
            <div class="rounded-3 overflow-hidden shadow-lg border" style="border-color: rgba(195,153,108,0.4) !important;">
              <img id="santinoVoucherPreviewImg" src="" alt="Santino Voucher" class="img-fluid w-100" style="display: block;">
            </div>
          </div>
          <div class="modal-footer border-top d-flex justify-content-between" style="border-color: rgba(255,255,255,0.1) !important;">
            <button type="button" class="btn btn-outline-light btn-sm rounded-pill px-3" data-bs-dismiss="modal">Close</button>
            <div class="d-flex gap-2">
              <button type="button" id="santinoVoucherPrintBtn" class="btn btn-outline-warning btn-sm fw-bold rounded-pill px-3">
                🖨️ Print Slip
              </button>
              <a id="santinoVoucherDownloadAgainBtn" href="" download="" class="btn btn-sm fw-bold rounded-pill px-3" style="background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%); color: #041a18; text-decoration: none;">
                📥 Download Again
              </a>
            </div>
          </div>
        </div>
      </div>
    `;
    document.body.appendChild(previewModal);

    document.getElementById('santinoVoucherPrintBtn').addEventListener('click', function() {
      const img = document.getElementById('santinoVoucherPreviewImg');
      const win = window.open('', '_blank');
      win.document.write(`
        <html>
          <head>
            <title>Print Santino Coffee Voucher</title>
            <style>
              body { margin: 0; display: flex; justify-content: center; align-items: center; min-height: 100vh; background: #fff; }
              img { max-width: 90%; height: auto; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.15); }
            </style>
          </head>
          <body onload="window.print(); window.close();">
            <img src="${img.src}">
          </body>
        </html>
      `);
      win.document.close();
    });
  }

  document.getElementById('santinoVoucherPreviewImg').src = dataUrl;
  const downAgain = document.getElementById('santinoVoucherDownloadAgainBtn');
  downAgain.href = dataUrl;
  downAgain.download = filename;

  if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
    const modal = new bootstrap.Modal(previewModal);
    modal.show();
  } else {
    previewModal.classList.add('show');
    previewModal.style.display = 'block';
  }
};

// Listen for Voucher / Redeem download clicks
document.addEventListener('click', function(e) {
  const btn = e.target.closest('.santino-download-voucher-btn');
  if (!btn) return;
  e.preventDefault();

  const info = {
    code: btn.getAttribute('data-code') || '',
    name: btn.getAttribute('data-name') || '',
    phone: btn.getAttribute('data-phone') || '',
    id: btn.getAttribute('data-id') || '',
    type: btn.getAttribute('data-type') || 'voucher',
    status: btn.getAttribute('data-status') || 'unused',
    item: btn.getAttribute('data-item') || '',
    branch: btn.getAttribute('data-branch') || '',
    date: btn.getAttribute('data-date') || ''
  };

  window.generateAndDownloadSantinoVoucher(info);
});

// Global Helpers for Machines & Beans Filtering
window.filterMachines = function(cat, btn) {
  document.querySelectorAll('.branch-filter-btn').forEach(b => b.classList.remove('active'));
  if (btn) btn.classList.add('active');

  const cards = document.querySelectorAll('.machine-card-col');
  cards.forEach(card => {
    if (cat === 'all' || card.getAttribute('data-category') === cat) {
      card.style.display = '';
    } else {
      card.style.display = 'none';
    }
  });
};

window.filterBeans = function(cat, btn) {
  document.querySelectorAll('.branch-filter-btn').forEach(b => b.classList.remove('active'));
  if (btn) btn.classList.add('active');

  const cards = document.querySelectorAll('.bean-card-col');
  cards.forEach(card => {
    if (cat === 'all' || card.getAttribute('data-category') === cat) {
      card.style.display = '';
    } else {
      card.style.display = 'none';
    }
  });
};

// Office Calculator Global Function
window.updateCalculator = function(staff) {
  staff = parseInt(staff) || 10;
  const staffText = document.getElementById('staffCountText');
  if (staffText) staffText.innerText = staff + ' Employees';
  
  const dailyCups = Math.round(staff * 1.8);
  const dailyEl = document.getElementById('dailyCupsDisplay');
  if (dailyEl) dailyEl.innerText = dailyCups;
  
  const monthlyKg = Math.round((dailyCups * 22 * 10) / 1000);
  const beansEl = document.getElementById('monthlyBeansDisplay');
  if (beansEl) beansEl.innerText = monthlyKg + ' kg';
  
  const monthlySavings = (dailyCups * 22 * 120).toLocaleString('en-US');
  const savingsEl = document.getElementById('monthlySavingsDisplay');
  if (savingsEl) savingsEl.innerText = '৳ ' + monthlySavings;
  
  let machineName = 'Kalerm Touch Auto (Single)';
  if (staff > 120) {
    machineName = 'Victoria Arduino / CAYE Robot Hub';
  } else if (staff >= 40) {
    machineName = 'Kalerm X400 Dual-Grinder Auto';
  }
  const recEl = document.getElementById('recMachineDisplay');
  if (recEl) recEl.innerText = machineName;
};

// Menu Category Filter
window.filterByCategory = function(cat) {
  const catBtn = document.querySelector(`.btn-cat-tab[data-filter="${cat}"]`);
  if (catBtn) {
    catBtn.click();
    const gridSec = document.getElementById('menuGridSection');
    if (gridSec) gridSec.scrollIntoView({ behavior: 'smooth' });
  }
};

// Shwapno & BFC Search and Filters

window.filterBfcByTag = function(tag, btn) {
  if (btn) {
    document.querySelectorAll('#outlets .branch-filter-btn').forEach(function(b) { b.classList.remove('active'); });
    btn.classList.add('active');
  }
  var cards = document.querySelectorAll('#bfcOutletGrid [data-zone]');
  cards.forEach(function(card) {
    var zone = (card.getAttribute('data-zone') || '').toLowerCase();
    if (tag === 'all' || zone.indexOf(tag.toLowerCase()) !== -1) {
      card.style.display = '';
    } else {
      card.style.display = 'none';
    }
  });
};

window.filterShwapnoZone = function(zoneTag, btn) {
  if (btn) {
    document.querySelectorAll('#store-locator .branch-filter-btn').forEach(function(b) { b.classList.remove('active'); });
    btn.classList.add('active');
  }
  var cards = document.querySelectorAll('#shwapnoOutletGrid [data-zone]');
  cards.forEach(function(card) {
    var zone = (card.getAttribute('data-zone') || '').toLowerCase();
    if (zoneTag === 'all' || zone.indexOf(zoneTag.toLowerCase()) !== -1) {
      card.style.display = '';
    } else {
      card.style.display = 'none';
    }
  });
};

window.filterBfcOutlets = function() {
  var input = document.getElementById('bfcSearchInput');
  var q = (input ? input.value : '').toLowerCase().trim();
  var cards = document.querySelectorAll('#bfcOutletGrid [data-zone]');
  cards.forEach(function(card) {
    var zone = (card.getAttribute('data-zone') || '').toLowerCase();
    var text = (card.innerText || '').toLowerCase();
    if (!q || zone.indexOf(q) !== -1 || text.indexOf(q) !== -1) {
      card.style.display = '';
    } else {
      card.style.display = 'none';
    }
  });
};

window.filterShwapnoOutlets = function() {
  var input = document.getElementById('shwapnoSearchInput');
  var q = (input ? input.value : '').toLowerCase().trim();
  var cards = document.querySelectorAll('#shwapnoOutletGrid [data-zone]');
  cards.forEach(function(card) {
    var zone = (card.getAttribute('data-zone') || '').toLowerCase();
    var text = (card.innerText || '').toLowerCase();
    if (!q || zone.indexOf(q) !== -1 || text.indexOf(q) !== -1) {
      card.style.display = '';
    } else {
      card.style.display = 'none';
    }
  });
};

document.addEventListener('submit', function(e) {
  var form = e.target.closest('.santino-inquiry-form');
  if (!form) return;

  e.preventDefault();
  var submitBtn = form.querySelector('button[type="submit"]');
  var originalText = submitBtn ? submitBtn.innerHTML : 'Submit';
  if (submitBtn) {
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Submitting...';
  }

  var formData = new FormData(form);
  formData.append('action', 'santino_submit_inquiry');
  if (window.santino_ajax && window.santino_ajax.nonce) {
    formData.append('nonce', window.santino_ajax.nonce);
  }

  fetch(window.santino_ajax ? window.santino_ajax.ajax_url : '/wp-admin/admin-ajax.php', {
    method: 'POST',
    body: formData
  })
  .then(function(res) { return res.json(); })
  .then(function(res) {
    if (submitBtn) {
      submitBtn.disabled = false;
      submitBtn.innerHTML = originalText;
    }
    if (res.success) {
      alert(res.data.message);
      form.reset();
      var modalEl = form.closest('.modal');
      if (modalEl && window.bootstrap && window.bootstrap.Modal) {
        var modal = window.bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();
      }
    } else {
      alert(res.data && res.data.message ? res.data.message : 'Submission failed. Please check inputs.');
    }
  })
  .catch(function(err) {
    if (submitBtn) {
      submitBtn.disabled = false;
      submitBtn.innerHTML = originalText;
    }
    alert('Network error. Please try again or call us directly.');
  });
});

document.addEventListener('click', function(e) {
  var btn = e.target.closest('.santino-add-to-cart-btn');
  if (!btn) return;

  e.preventDefault();
  var productId = btn.getAttribute('data-product-id');
  if (!productId) return;

  var originalText = btn.innerHTML;
  btn.disabled = true;
  btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';

  var formData = new FormData();
  formData.append('action', 'santino_ajax_add_to_cart');
  formData.append('product_id', productId);
  formData.append('quantity', 1);
  if (window.santino_ajax && window.santino_ajax.nonce) {
    formData.append('nonce', window.santino_ajax.nonce);
  }

  fetch(window.santino_ajax ? window.santino_ajax.ajax_url : '/wp-admin/admin-ajax.php', {
    method: 'POST',
    body: formData
  })
  .then(function(res) { return res.json(); })
  .then(function(res) {
    btn.disabled = false;
    btn.innerHTML = originalText;
    if (res.success) {
      var badge = document.querySelector('.header-cart-count');
      if (badge && res.data.cart_count !== undefined) {
        badge.innerText = res.data.cart_count;
      }
      alert('Added to cart successfully!');
    } else {
      alert(res.data && res.data.message ? res.data.message : 'Could not add to cart.');
    }
  })
  .catch(function(err) {
    btn.disabled = false;
    btn.innerHTML = originalText;
    alert('Network error. Please try again.');
  });
});
