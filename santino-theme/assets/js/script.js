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

  // VIP Membership AJAX Submission with Phone Validation
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
    });
  }

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
                <div class="stamp-cup-item active text-center flex-1">
                  <div style="width: 52px; height: 52px; border-radius: 50%; background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%); display: inline-flex; align-items: center; justify-content: center; font-size: 22px; color: #041a18; box-shadow: 0 0 16px rgba(223, 190, 141, 0.5); border: 2px solid #ffffff;">
                    ☕
                  </div>
                  <div class="small fw-bold mt-1" style="color: #dfbe8d; font-size: 11px;">Cup ${i} ✓</div>
                </div>
              `;
            } else {
              cupsHtml += `
                <div class="stamp-cup-item text-center flex-1">
                  <div style="width: 52px; height: 52px; border-radius: 50%; background: rgba(0, 98, 93, 0.25); border: 2px dashed rgba(195, 153, 108, 0.35); display: inline-flex; align-items: center; justify-content: center; font-size: 18px; color: rgba(255,255,255,0.4);">
                    ${i}
                  </div>
                  <div class="small text-white-50 mt-1" style="font-size: 11px;">Cup ${i}</div>
                </div>
              `;
            }
          }

          let vouchersHtml = '';
          if (d.vouchers && d.vouchers.length > 0) {
            vouchersHtml = `
              <div class="mt-4 p-3.5 rounded-4 border" style="background: rgba(195, 153, 108, 0.1); border-color: rgba(195, 153, 108, 0.35) !important;">
                <h6 class="fw-bold mb-2" style="color: #dfbe8d;"><i class="bi bi-gift-fill me-1.5"></i> Active Free Coffee Vouchers:</h6>
                <div class="d-flex flex-wrap gap-2">
                  ${d.vouchers.map(v => `
                    <div class="p-2.5 rounded-3 d-flex align-items-center gap-2 border" style="background: #091715; border-color: rgba(195,153,108,0.3) !important;">
                      <code class="fs-6 fw-bold" style="color: #dfbe8d;">${v.code}</code>
                      <span class="badge ${v.status === 'unused' ? 'bg-success' : 'bg-secondary'}" style="font-size: 10px;">${v.status.toUpperCase()}</span>
                    </div>
                  `).join('')}
                </div>
              </div>
            `;
          }

          cardBox.style.display = 'block';
          cardBox.innerHTML = `
            <div class="card border rounded-4 shadow-2xl p-4 p-md-5 mb-4 position-relative overflow-hidden" style="background: radial-gradient(circle at 80% 20%, #005c56 0%, #071d1b 60%, #04100e 100%); border-color: rgba(195, 153, 108, 0.45) !important; color: #fff;">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                  <span class="badge px-3 py-1.5 fw-bold text-uppercase rounded-pill" style="background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%); color: #041a18; font-size: 11px;">
                    <i class="bi bi-patch-check-fill me-1"></i> SANTINO VIP MEMBER
                  </span>
                  <h3 class="fw-bold text-white mt-2 mb-0 font-heading">${d.name}</h3>
                  <div class="text-white-50 font-monospace small mt-1">VIP ID: <strong style="color: #dfbe8d;">${d.member_id}</strong> | Phone: ${d.phone}</div>
                </div>
                <div class="text-end">
                  <div class="display-6 fw-bold mb-0 font-heading" style="color: #dfbe8d;">${stamps}/5</div>
                  <div class="small text-white-50">Approved Stamps</div>
                </div>
              </div>

              <div class="p-3.5 p-md-4 rounded-4 mt-3 shadow-lg border" style="background: rgba(6, 20, 18, 0.9); border-color: rgba(195, 153, 108, 0.3) !important;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h6 class="fw-bold mb-0 text-white font-heading"><i class="bi bi-cup-hot-fill me-1.5" style="color: #dfbe8d;"></i> Digital Stamp Progress</h6>
                  <span class="small fw-bold" style="color: #dfbe8d;">${5 - stamps === 0 ? '🎉 Free 6th Coffee Unlocked!' : (5 - stamps) + ' cups to next FREE COFFEE'}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center py-2 px-1 gap-2">
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
