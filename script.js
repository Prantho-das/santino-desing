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
      { icon: 'bi-cart4 text-success', text: 'SHWAPNO' },
      { icon: 'bi-shop text-danger', text: 'BFC' }
    ];
    let idx = 0;
    setInterval(() => {
      partnerContent.classList.add('fade-out');
      setTimeout(() => {
        idx = (idx + 1) % list.length;
        partnerContent.innerHTML = `<i class="bi ${list[idx].icon}"></i> <span>${list[idx].text}</span>`;
        partnerContent.classList.remove('fade-out');
      }, 350);
    }, 2500);
  }
});
