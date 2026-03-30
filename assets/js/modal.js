const focusable_selector = [
  'a[href]:not([tabindex="-1"])',
  'button:not([disabled]):not([tabindex="-1"])',
  'input:not([disabled]):not([type="hidden"]):not([tabindex="-1"])',
  'select:not([disabled]):not([tabindex="-1"])',
  'textarea:not([disabled]):not([tabindex="-1"])',
  '[tabindex]:not([tabindex="-1"])',
].join(',');

const modal_state = new WeakMap();

const getFocusableElements = (container) =>
  Array.from(container.querySelectorAll(focusable_selector)).filter((element) => {
    if (!(element instanceof HTMLElement)) {
      return false;
    }
    return !element.hasAttribute('hidden') && element.offsetParent !== null;
  });

const closeModal = (modal_element) => {
  if (!modal_element) {
    return;
  }

  modal_element.classList.add('hidden');
  modal_element.classList.remove('flex');
  modal_element.setAttribute('aria-hidden', 'true');

  const has_open_modal = document.querySelector('[data-modal]:not(.hidden)');
  if (!has_open_modal) {
    document.body.classList.remove('overflow-hidden');
  }

  const state = modal_state.get(modal_element);
  if (state && state.opener && typeof state.opener.focus === 'function') {
    state.opener.focus();
  }
  modal_state.delete(modal_element);
};

const openModal = (modal_element, opener = null) => {
  if (!modal_element) {
    return;
  }

  modal_element.classList.remove('hidden');
  modal_element.classList.add('flex');
  modal_element.setAttribute('aria-hidden', 'false');
  document.body.classList.add('overflow-hidden');

  const panel_element = modal_element.querySelector('.modal__panel');
  if (!panel_element) {
    return;
  }

  modal_state.set(modal_element, {
    opener: opener instanceof HTMLElement ? opener : document.activeElement,
  });

  const initial_focus =
    panel_element.querySelector('[data-modal-initial-focus]') ||
    getFocusableElements(panel_element)[0] ||
    panel_element;

  window.requestAnimationFrame(() => {
    if (initial_focus instanceof HTMLElement) {
      initial_focus.focus();
    }
  });
};

export const initModal = () => {
  document.addEventListener('click', (event) => {
    const open_trigger = event.target.closest('[data-modal-open]');
    if (open_trigger) {
      event.preventDefault();
      const modal_id = open_trigger.getAttribute('data-modal-open');
      if (!modal_id) {
        return;
      }

      const modal_element = document.getElementById(modal_id);
      openModal(modal_element, open_trigger);
      return;
    }

    const close_trigger = event.target.closest('[data-modal-close]');
    if (close_trigger) {
      const modal_element = close_trigger.closest('[data-modal]');
      closeModal(modal_element);
    }
  });

  document.addEventListener('keydown', (event) => {
    const open_modals = document.querySelectorAll('[data-modal]:not(.hidden)');
    if (open_modals.length === 0) {
      return;
    }

    const last_modal = open_modals[open_modals.length - 1];
    if (event.key === 'Escape') {
      closeModal(last_modal);
      return;
    }

    if (event.key !== 'Tab') {
      return;
    }

    const panel_element = last_modal.querySelector('.modal__panel');
    if (!panel_element) {
      return;
    }

    const focusable_elements = getFocusableElements(panel_element);
    if (focusable_elements.length === 0) {
      event.preventDefault();
      panel_element.focus();
      return;
    }

    const first_element = focusable_elements[0];
    const last_element  = focusable_elements[focusable_elements.length - 1];
    const active_element = document.activeElement;

    if (event.shiftKey) {
      if (active_element === first_element || !panel_element.contains(active_element)) {
        event.preventDefault();
        last_element.focus();
      }
      return;
    }

    if (active_element === last_element || !panel_element.contains(active_element)) {
      event.preventDefault();
      first_element.focus();
    }
  });
};
