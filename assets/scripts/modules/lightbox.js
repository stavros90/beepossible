// ==================================================
// Lightweight, dependency-free gallery lightbox
// with prev/next, keyboard nav and slideshow autoplay.
//
// Usage in markup:
//   <a href="full.jpg" data-lightbox="my-group" data-caption="Alt text">
//     <img src="thumb.jpg">
//   </a>
//
// All links sharing the same data-lightbox value form one gallery.
// ==================================================

const SLIDESHOW_INTERVAL = 3500; // ms between slides when playing

function buildOverlay() {
  const overlay = document.createElement('div');
  overlay.className = 'lightbox';
  overlay.setAttribute('role', 'dialog');
  overlay.setAttribute('aria-modal', 'true');
  overlay.setAttribute('aria-hidden', 'true');

  overlay.innerHTML = `
    <span class="lightbox__counter" aria-live="polite"></span>
    <button class="lightbox__btn lightbox__play" type="button" aria-label="Play slideshow">&#9654;</button>
    <button class="lightbox__btn lightbox__close" type="button" aria-label="Close">&times;</button>
    <button class="lightbox__btn lightbox__prev" type="button" aria-label="Previous image">&#8249;</button>
    <div class="lightbox__stage">
      <img class="lightbox__image" src="" alt="">
      <span class="lightbox__caption"></span>
    </div>
    <button class="lightbox__btn lightbox__next" type="button" aria-label="Next image">&#8250;</button>
  `;

  document.body.appendChild(overlay);
  return overlay;
}

export default function initLightbox() {
  const triggers = Array.from(document.querySelectorAll('[data-lightbox]'));
  if (!triggers.length) return;

  // Group triggers by their data-lightbox value.
  const groups = {};
  triggers.forEach((el) => {
    const name = el.getAttribute('data-lightbox');
    (groups[name] = groups[name] || []).push(el);
  });

  const overlay   = buildOverlay();
  const imageEl   = overlay.querySelector('.lightbox__image');
  const captionEl = overlay.querySelector('.lightbox__caption');
  const counterEl = overlay.querySelector('.lightbox__counter');
  const playBtn   = overlay.querySelector('.lightbox__play');

  let current = [];   // slides in the active group: [{src, caption}]
  let index = 0;
  let timer = null;

  function render() {
    const slide = current[index];
    if (!slide) return;

    imageEl.classList.remove('is-loaded');
    imageEl.onload = () => imageEl.classList.add('is-loaded');
    imageEl.src = slide.src;
    imageEl.alt = slide.caption || '';

    captionEl.textContent = slide.caption || '';
    captionEl.style.display = slide.caption ? '' : 'none';
    counterEl.textContent = `${index + 1} / ${current.length}`;
  }

  function go(step) {
    index = (index + step + current.length) % current.length;
    render();
  }

  function stopSlideshow() {
    if (timer) { clearInterval(timer); timer = null; }
    playBtn.classList.remove('is-playing');
    playBtn.setAttribute('aria-label', 'Play slideshow');
    playBtn.innerHTML = '&#9654;';
  }

  function startSlideshow() {
    timer = setInterval(() => go(1), SLIDESHOW_INTERVAL);
    playBtn.classList.add('is-playing');
    playBtn.setAttribute('aria-label', 'Pause slideshow');
    playBtn.innerHTML = '&#10073;&#10073;';
  }

  function open(slides, startIndex) {
    current = slides;
    index = startIndex;
    render();
    overlay.classList.add('is-open');
    overlay.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }

  function close() {
    stopSlideshow();
    overlay.classList.remove('is-open');
    overlay.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }

  // Wire up each group's triggers.
  Object.keys(groups).forEach((name) => {
    const slides = groups[name].map((el) => ({
      src: el.getAttribute('href'),
      caption: el.getAttribute('data-caption') || '',
    }));

    groups[name].forEach((el, i) => {
      el.addEventListener('click', (e) => {
        e.preventDefault();
        open(slides, i);
      });
    });
  });

  // Controls.
  overlay.querySelector('.lightbox__close').addEventListener('click', close);
  overlay.querySelector('.lightbox__prev').addEventListener('click', () => { stopSlideshow(); go(-1); });
  overlay.querySelector('.lightbox__next').addEventListener('click', () => { stopSlideshow(); go(1); });
  playBtn.addEventListener('click', () => (timer ? stopSlideshow() : startSlideshow()));

  // Click on the backdrop (but not the image/buttons) closes.
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay || e.target.classList.contains('lightbox__stage')) close();
  });

  // Keyboard navigation.
  document.addEventListener('keydown', (e) => {
    if (!overlay.classList.contains('is-open')) return;
    if (e.key === 'Escape') close();
    else if (e.key === 'ArrowLeft')  { stopSlideshow(); go(-1); }
    else if (e.key === 'ArrowRight') { stopSlideshow(); go(1); }
  });
}
