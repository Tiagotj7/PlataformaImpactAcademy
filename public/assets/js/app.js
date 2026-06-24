(() => {
  const reducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function qs(sel, el = document) { return el.querySelector(sel); }
  function qsa(sel, el = document) { return [...el.querySelectorAll(sel)]; }

  function applyAosAttributes() {
    if (reducedMotion) return;

    const cards = qsa('.ia-card');
    let delay = 0;

    cards.forEach((card) => {
      if (!card.getAttribute('data-aos')) {
        card.setAttribute('data-aos', 'fade-up');
        card.setAttribute('data-aos-duration', '700');
        card.setAttribute('data-aos-delay', String(delay));
        delay = (delay + 70) % 420;
      }
    });

    qsa('.list-group-item').forEach((li, i) => {
      if (!li.getAttribute('data-aos')) {
        li.setAttribute('data-aos', 'fade-up');
        li.setAttribute('data-aos-delay', String(Math.min(i * 40, 280)));
      }
    });

    qsa('table tbody tr').forEach((tr, i) => {
      if (!tr.getAttribute('data-aos')) {
        tr.setAttribute('data-aos', 'fade-up');
        tr.setAttribute('data-aos-delay', String(Math.min(i * 40, 300)));
      }
    });
  }

  function initAOS() {
    if (reducedMotion || !window.AOS) return;
    AOS.init({ once: true, offset: 40, duration: 700, easing: 'ease-out-cubic' });
  }

  function animateCounters() {
    if (reducedMotion) return;

    const els = qsa('[data-count-to]');
    els.forEach((el) => {
      const to = parseInt(el.getAttribute('data-count-to') || '0', 10);
      const dur = parseInt(el.getAttribute('data-count-duration') || '900', 10);
      const from = parseInt(el.textContent.trim() || '0', 10);

      let start = null;
      function step(ts) {
        if (!start) start = ts;
        const p = Math.min((ts - start) / dur, 1);
        const eased = 1 - Math.pow(1 - p, 3);
        const val = Math.round(from + (to - from) * eased);
        el.textContent = val.toLocaleString('pt-BR');
        if (p < 1) requestAnimationFrame(step);
      }
      requestAnimationFrame(step);
    });
  }

  function initButtonRipple() {
    if (reducedMotion) return;

    const buttons = qsa('.btn-gold, .btn-outline-gold');
    buttons.forEach((btn) => {
      btn.style.position = btn.style.position || 'relative';
      btn.style.overflow = 'hidden';

      btn.addEventListener('click', (e) => {
        const rect = btn.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const ripple = document.createElement('span');
        const size = Math.max(rect.width, rect.height);

        ripple.style.position = 'absolute';
        ripple.style.width = ripple.style.height = `${size}px`;
        ripple.style.left = `${x - size / 2}px`;
        ripple.style.top = `${y - size / 2}px`;
        ripple.style.borderRadius = '50%';
        ripple.style.background = 'rgba(212,175,55,0.22)';
        ripple.style.transform = 'scale(0)';
        ripple.style.transition = 'transform 500ms ease, opacity 650ms ease';
        ripple.style.pointerEvents = 'none';
        ripple.style.opacity = '1';

        btn.appendChild(ripple);
        requestAnimationFrame(() => (ripple.style.transform = 'scale(1)'));
        setTimeout(() => { ripple.style.opacity = '0'; }, 220);
        setTimeout(() => ripple.remove(), 700);
      });
    });
  }

  function initNavbarScrollFX() {
    const nav = qs('.navbar');
    if (!nav) return;

    const onScroll = () => {
      const sc = window.scrollY || 0;
      if (sc > 10) {
        nav.style.backdropFilter = 'blur(10px)';
        nav.style.background = 'rgba(11,11,11,0.55)';
      } else {
        nav.style.backdropFilter = 'none';
        nav.style.background = 'transparent';
      }
    };

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  function animateFlash() {
    const flashes = qsa('.ia-flash');
    if (!flashes.length) return;

    flashes.forEach((el) => {
      el.style.transform = reducedMotion ? 'none' : 'translateY(-6px)';
      el.style.opacity = '0';
      el.style.transition = 'opacity 400ms ease, transform 450ms ease';
      requestAnimationFrame(() => {
        el.style.opacity = '1';
        el.style.transform = 'translateY(0)';
      });
    });
  }

  function confettiOnLessonSuccess() {
    if (reducedMotion || !window.confetti) return;

    const isLessonPage = window.location.pathname.includes('/aula/');
    if (!isLessonPage) return;

    const success = qs('.ia-flash[data-kind="success"]');
    if (!success) return;

    const text = (success.textContent || '').toLowerCase();
    if (!(text.includes('aula') && (text.includes('conclu') || text.includes('+10')))) return;

    confetti({ particleCount: 110, spread: 70, origin: { y: 0.72 }, colors: ['#D4AF37', '#FFFFFF', '#B0892E'] });
  }

  function initCardTilt() {
    if (reducedMotion) return;

    qsa('.ia-card').forEach((card) => {
      card.style.transition = 'transform 250ms ease, box-shadow 250ms ease';
      card.addEventListener('mousemove', (e) => {
        const r = card.getBoundingClientRect();
        const px = (e.clientX - r.left) / r.width;
        const py = (e.clientY - r.top) / r.height;
        const rotateY = (px - 0.5) * 6;
        const rotateX = (0.5 - py) * 6;

        card.style.transform = `perspective(900px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-2px)`;
        card.style.boxShadow = '0 16px 40px rgba(0,0,0,.45)';
      });

      card.addEventListener('mouseleave', () => {
        card.style.transform = 'none';
        card.style.boxShadow = '0 12px 30px rgba(0,0,0,.35)';
      });
    });
  }

  document.addEventListener('DOMContentLoaded', () => {
    applyAosAttributes();
    initAOS();
    animateCounters();
    initButtonRipple();
    initNavbarScrollFX();
    animateFlash();
    confettiOnLessonSuccess();
    initCardTilt();
  });
})();