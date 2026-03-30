const focusable_selector = [
  'a[href]:not([tabindex="-1"])',
  'button:not([disabled]):not([tabindex="-1"])',
  'input:not([disabled]):not([type="hidden"]):not([tabindex="-1"])',
  'select:not([disabled]):not([tabindex="-1"])',
  'textarea:not([disabled]):not([tabindex="-1"])',
  '[tabindex]:not([tabindex="-1"])',
].join(',');

const drawer_state = new WeakMap();
const transition_duration_ms = 300;

const getFocusableElements = (container) =>
  Array.from(container.querySelectorAll(focusable_selector)).filter((element) => {
    if (!(element instanceof HTMLElement)) {
      return false;
    }
    return !element.hasAttribute('hidden') && element.offsetParent !== null;
  });

const closeDrawer = (drawer_element) => {
  if (!drawer_element) {
    return;
  }

  drawer_element.classList.remove('drawer--open');
  drawer_element.setAttribute('aria-hidden', 'true');

  const has_open_overlay =
    document.querySelector('[data-modal]:not(.hidden)') || document.querySelector('[data-drawer]:not(.hidden)');
  if (!has_open_overlay) {
    document.body.classList.remove('overflow-hidden');
  }

  const state = drawer_state.get(drawer_element);
  if (state && state.opener && typeof state.opener.focus === 'function') {
    state.opener.focus();
  }

  if (state && state.close_timer) {
    window.clearTimeout(state.close_timer);
  }

  const close_timer = window.setTimeout(() => {
    if (!drawer_element.classList.contains('drawer--open')) {
      drawer_element.classList.add('hidden');
      drawer_element.classList.remove('flex');
    }

    const has_open_overlay_after_close =
      document.querySelector('[data-modal]:not(.hidden)') || document.querySelector('[data-drawer]:not(.hidden)');
    if (!has_open_overlay_after_close) {
      document.body.classList.remove('overflow-hidden');
    }

    drawer_state.delete(drawer_element);
  }, transition_duration_ms);

  drawer_state.set(drawer_element, {
    opener: state && state.opener ? state.opener : null,
    close_timer,
  });
};

const openDrawer = (drawer_element, opener = null) => {
  if (!drawer_element) {
    return;
  }

  drawer_element.classList.remove('hidden');
  drawer_element.classList.add('flex');
  drawer_element.setAttribute('aria-hidden', 'false');
  document.body.classList.add('overflow-hidden');

  const panel_element = drawer_element.querySelector('.drawer__panel');
  if (!panel_element) {
    return;
  }

  const previous_state = drawer_state.get(drawer_element);
  if (previous_state && previous_state.close_timer) {
    window.clearTimeout(previous_state.close_timer);
  }

  drawer_state.set(drawer_element, {
    opener: opener instanceof HTMLElement ? opener : document.activeElement,
  });

  window.requestAnimationFrame(() => {
    drawer_element.classList.add('drawer--open');
  });

  const initial_focus =
    panel_element.querySelector('[data-drawer-initial-focus]') ||
    getFocusableElements(panel_element)[0] ||
    panel_element;

  window.requestAnimationFrame(() => {
    if (initial_focus instanceof HTMLElement) {
      initial_focus.focus();
    }
  });
};

export const initDrawer = () => {
  document.addEventListener('click', (event) => {
    const open_trigger = event.target.closest('[data-drawer-open]');
    if (open_trigger) {
      event.preventDefault();
      const drawer_id = open_trigger.getAttribute('data-drawer-open');
      if (!drawer_id) {
        return;
      }

      const drawer_element = document.getElementById(drawer_id);
      openDrawer(drawer_element, open_trigger);
      return;
    }

    const close_trigger = event.target.closest('[data-drawer-close]');
    if (close_trigger) {
      const drawer_element = close_trigger.closest('[data-drawer]');
      closeDrawer(drawer_element);
    }
  });

  document.addEventListener('keydown', (event) => {
    const open_drawers = document.querySelectorAll('[data-drawer]:not(.hidden)');
    if (open_drawers.length === 0) {
      return;
    }

    const last_drawer = open_drawers[open_drawers.length - 1];
    if (event.key === 'Escape') {
      closeDrawer(last_drawer);
      return;
    }

    if (event.key !== 'Tab') {
      return;
    }

    const panel_element = last_drawer.querySelector('.drawer__panel');
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
