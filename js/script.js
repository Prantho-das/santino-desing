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
});


