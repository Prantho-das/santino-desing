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

    revealElements.forEach(el => revealObserver.observe(el));
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

  // VIP Membership AJAX Submission
  const membershipForm = document.getElementById('santinoMembershipForm');
  if (membershipForm) {
    membershipForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const submitBtn = this.querySelector('button[type="submit"]');
      const originalText = submitBtn ? submitBtn.innerHTML : 'Submit';
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Processing VIP Application...';
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
        if (data.success) {
          const resBox = document.getElementById('membershipResponseBox');
          if (resBox) {
            resBox.style.display = 'block';
            resBox.innerHTML = `
              <div class="alert alert-success rounded-4 p-4 text-center shadow-sm">
                <i class="bi bi-patch-check-fill text-success fs-1 d-block mb-2"></i>
                <h4 class="fw-bold mb-2">VIP Membership Application Received!</h4>
                <p class="mb-3 text-muted">${data.data.message}</p>
                <div class="p-3 bg-white rounded-3 border d-inline-block text-dark text-start">
                  <div class="small text-muted text-uppercase">Your Santino VIP Member ID</div>
                  <div class="fs-4 fw-bold text-success font-monospace">${data.data.member_id}</div>
                  <div class="small text-muted mt-1">Tier: <strong>${data.data.tier}</strong> | Welcome Bonus: <strong>100 Pts</strong></div>
                </div>
              </div>
            `;
            membershipForm.reset();
            resBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
          } else {
            alert(data.data.message + '\nYour VIP ID: ' + data.data.member_id);
            membershipForm.reset();
          }
        } else {
          alert(data.data ? data.data.message : 'Error submitting form.');
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
  // Invoice Submission Form
  const invoiceForm = document.getElementById('santinoInvoiceForm');
  if (invoiceForm) {
    invoiceForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const submitBtn = this.querySelector('button[type="submit"]');
      const originalText = submitBtn ? submitBtn.innerHTML : 'Submit Invoice';
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Submitting Invoice...';
      }

      const formData = new FormData(this);
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
              <div class="alert alert-success rounded-4 p-4 text-center shadow-sm">
                <i class="bi bi-receipt-cutoff text-success fs-1 d-block mb-2"></i>
                <h4 class="fw-bold mb-2">Invoice Logged Successfully!</h4>
                <p class="mb-0 text-muted">${data.data.message}</p>
                <div class="mt-3 badge bg-warning text-dark px-3 py-2 fs-6">Status: ⏳ PENDING ADMIN VERIFICATION</div>
              </div>
            `;
            invoiceForm.reset();
            resBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
          } else {
            alert(data.data.message);
            invoiceForm.reset();
          }
        } else {
          if (resBox) {
            resBox.style.display = 'block';
            resBox.innerHTML = `
              <div class="alert alert-danger rounded-4 p-3 text-center shadow-sm">
                <i class="bi bi-exclamation-triangle-fill text-danger fs-3 d-block mb-1"></i>
                <strong>${data.data ? data.data.message : 'Error submitting invoice.'}</strong>
              </div>
            `;
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

  // Stamp Card Live Lookup Form
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
          const stamps = d.stamps;
          let cupsHtml = '';
          for (let i = 1; i <= 5; i++) {
            if (i <= stamps) {
              cupsHtml += `
                <div class="stamp-cup-item active" style="width: 60px; height: 60px; border-radius: 50%; background: #e6f4f3; border: 2px solid #00625d; display: flex; align-items: center; justify-content: center; font-size: 26px; box-shadow: 0 4px 12px rgba(0,98,93,0.15);">
                  ☕
                </div>
              `;
            } else {
              cupsHtml += `
                <div class="stamp-cup-item" style="width: 60px; height: 60px; border-radius: 50%; background: #f8fafc; border: 2px dashed #cbd5e1; display: flex; align-items: center; justify-content: center; font-size: 22px; color: #94a3b8;">
                  ${i}
                </div>
              `;
            }
          }

          let vouchersHtml = '';
          if (d.vouchers && d.vouchers.length > 0) {
            vouchersHtml = `
              <div class="mt-4 p-3 rounded-4 bg-light border">
                <h6 class="fw-bold text-success mb-2"><i class="bi bi-gift-fill me-1"></i> Your Free Coffee Vouchers:</h6>
                <div class="d-flex flex-wrap gap-2">
                  ${d.vouchers.map(v => `
                    <div class="p-2 rounded-3 bg-white border d-flex align-items-center gap-2">
                      <code class="fs-6 fw-bold text-dark">${v.code}</code>
                      <span class="badge ${v.status === 'unused' ? 'bg-success' : 'bg-secondary'}">${v.status.toUpperCase()}</span>
                    </div>
                  `).join('')}
                </div>
              </div>
            `;
          }

          cardBox.style.display = 'block';
          cardBox.innerHTML = `
            <div class="card border-0 rounded-4 shadow-xl p-4 p-md-5 mb-4 position-relative overflow-hidden" style="background: linear-gradient(135deg, #0d2b28 0%, #00625d 50%, #1a1a1a 100%); color: #fff;">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                  <span class="badge bg-warning text-dark px-3 py-1.5 fw-bold text-uppercase">${d.tier} MEMBER</span>
                  <h3 class="fw-bold text-white mt-2 mb-0">${d.name}</h3>
                  <div class="text-white-50 font-monospace small">ID: ${d.member_id} | Phone: ${d.phone}</div>
                </div>
                <div class="text-end">
                  <div class="display-6 fw-bold text-warning mb-0">${stamps}/5</div>
                  <div class="small text-white-50">Approved Cups</div>
                </div>
              </div>

              <div class="p-3 p-md-4 rounded-4 bg-white text-dark mt-3 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h6 class="fw-bold mb-0 text-dark"><i class="bi bi-cup-hot-fill text-teal me-1"></i> Digital Coffee Stamp Card</h6>
                  <span class="small fw-bold text-teal">${5 - stamps === 0 ? '🎉 Free Coffee Unlocked!' : (5 - stamps) + ' cups to next FREE COFFEE'}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center py-2 px-1">
                  ${cupsHtml}
                </div>
                ${vouchersHtml}
              </div>
            </div>
          `;
          cardBox.scrollIntoView({ behavior: 'smooth', block: 'start' });
        } else {
          alert(data.data ? data.data.message : 'No member found.');
        }
      })
      .catch(err => {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalText;
        }
        console.error('Lookup error:', err);
        alert('Could not check stamp card. Please try again.');
      });
    });
  }
});




