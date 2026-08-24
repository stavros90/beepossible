/**
 * Campaign landing page behaviour.
 *
 * Scoped to .campaign so it costs nothing on the rest of the site, and scoped
 * again to .campaign-faq so it cannot collide with the accordion script that
 * footer-hooks.php prints on the marketing-agency page.
 */

const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)')

/**
 * Sticky CTA: visible only when the visitor has no other way to convert, i.e.
 * the hero CTAs have scrolled away and the form is not yet on screen.
 */
function initStickyCta(root) {
  const sticky = root.querySelector('[data-campaign-sticky]')
  const hero = root.querySelector('[data-campaign-hero]')
  const form = root.querySelector('[data-campaign-form-section]')

  if (!sticky || !hero) return

  let heroVisible = true
  let formVisible = false

  const sync = () => {
    sticky.classList.toggle('is-visible', !heroVisible && !formVisible)
  }

  if (!('IntersectionObserver' in window)) {
    // No observer support: show it rather than hide the CTA entirely.
    sticky.classList.add('is-visible')
    return
  }

  new IntersectionObserver(
    ([entry]) => {
      heroVisible = entry.isIntersecting
      sync()
    },
    { rootMargin: '-20% 0px 0px 0px' }
  ).observe(hero)

  if (form) {
    new IntersectionObserver(
      ([entry]) => {
        formVisible = entry.isIntersecting
        sync()
      },
      { threshold: 0.12 }
    ).observe(form)
  }
}

/**
 * The logo returns you to the top of the page instead of leaving it.
 */
function initScrollToTop(root) {
  root.querySelectorAll('[data-campaign-top]').forEach(button => {
    button.addEventListener('click', () => {
      window.scrollTo({
        top: 0,
        behavior: reduceMotion.matches ? 'auto' : 'smooth'
      })
    })
  })
}

/**
 * FAQ accordion. The button carries aria-expanded and the panel is a real
 * region toggled with [hidden], so the state is announced rather than implied
 * by a rotating glyph. Height is animated from the measured content height
 * because 'auto' is not an animatable value.
 */
function initFaq(root) {
  const items = root.querySelectorAll('.campaign-faq__question')

  items.forEach(button => {
    const panel = document.getElementById(button.getAttribute('aria-controls'))
    if (!panel) return

    button.addEventListener('click', () => {
      const isOpen = button.getAttribute('aria-expanded') === 'true'
      button.setAttribute('aria-expanded', String(!isOpen))

      if (reduceMotion.matches) {
        panel.hidden = isOpen
        panel.style.height = ''
        return
      }

      if (isOpen) {
        panel.style.height = `${panel.scrollHeight}px`
        requestAnimationFrame(() => {
          panel.style.height = '0px'
        })
      } else {
        panel.hidden = false
        panel.style.height = '0px'
        requestAnimationFrame(() => {
          panel.style.height = `${panel.scrollHeight}px`
        })
      }
    })

    panel.addEventListener('transitionend', event => {
      if (event.propertyName !== 'height') return

      if (button.getAttribute('aria-expanded') === 'true') {
        // Release the fixed height so the panel can reflow on resize.
        panel.style.height = 'auto'
      } else {
        panel.hidden = true
        panel.style.height = ''
      }
    })
  })
}

/**
 * Submit state, so a slow network cannot produce duplicate leads.
 */
function initFormState(root) {
  const form = root.querySelector('.campaign-form')
  if (!form) return

  form.addEventListener('submit', () => {
    const submit = form.querySelector('.campaign-form__submit')
    const label = form.querySelector('.campaign-form__submit-label')

    if (!submit || !form.checkValidity()) return

    submit.disabled = true
    if (label) label.textContent = 'Sending'
  })
}

export default function initCampaign() {
  const root = document.querySelector('.campaign')
  if (!root) return

  initStickyCta(root)
  initScrollToTop(root)
  initFaq(root)
  initFormState(root)
}
