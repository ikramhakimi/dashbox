export const initDropdown = () => {
  const getOpenDropdowns = () => document.querySelectorAll('[data-dropdown].dropdown--open');
  const getMenuItems = (dropdown_element) =>
    dropdown_element
      ? Array.from(dropdown_element.querySelectorAll('[data-dropdown-item]:not([aria-disabled="true"])'))
      : [];

  const focusMenuItem = (dropdown_element, index) => {
    const menu_items = getMenuItems(dropdown_element);
    if (menu_items.length === 0) {
      return;
    }

    const safe_index = ((index % menu_items.length) + menu_items.length) % menu_items.length;
    menu_items[safe_index].focus();
  };

  const closeDropdown = (dropdown_element) => {
    if (!dropdown_element) {
      return;
    }

    const trigger_element = dropdown_element.querySelector('[data-dropdown-trigger]');
    const panel_element = dropdown_element.querySelector('[data-dropdown-panel]');

    dropdown_element.classList.remove('dropdown--open');
    if (trigger_element) {
      trigger_element.setAttribute('aria-expanded', 'false');
    }
    if (panel_element) {
      panel_element.classList.add('hidden');
    }
  };

  const openDropdown = (dropdown_element) => {
    if (!dropdown_element) {
      return;
    }

    const trigger_element = dropdown_element.querySelector('[data-dropdown-trigger]');
    const panel_element = dropdown_element.querySelector('[data-dropdown-panel]');

    dropdown_element.classList.add('dropdown--open');
    if (trigger_element) {
      trigger_element.setAttribute('aria-expanded', 'true');
    }
    if (panel_element) {
      panel_element.classList.remove('hidden');
    }
  };

  const closeAllExcept = (active_dropdown = null) => {
    getOpenDropdowns().forEach((open_dropdown) => {
      if (open_dropdown !== active_dropdown) {
        closeDropdown(open_dropdown);
      }
    });
  };

  document.addEventListener('click', (event) => {
    const trigger_element = event.target.closest('[data-dropdown-trigger]');
    if (trigger_element) {
      const should_prevent_nav =
        trigger_element.tagName === 'A' &&
        trigger_element.getAttribute('data-dropdown-prevent-nav') !== 'false';

      if (should_prevent_nav) {
        event.preventDefault();
      }

      const dropdown_element = trigger_element.closest('[data-dropdown]');
      const currently_open = dropdown_element && dropdown_element.classList.contains('dropdown--open');

      closeAllExcept(dropdown_element);

      if (dropdown_element) {
        if (currently_open) {
          closeDropdown(dropdown_element);
        } else {
          openDropdown(dropdown_element);
        }
      }
      return;
    }

    const menu_item = event.target.closest('[data-dropdown-panel] a, [data-dropdown-panel] button');
    if (menu_item) {
      const dropdown_element = menu_item.closest('[data-dropdown]');
      if (dropdown_element) {
        closeDropdown(dropdown_element);
      }
      return;
    }

    getOpenDropdowns().forEach((dropdown_element) => {
      if (!dropdown_element.contains(event.target)) {
        closeDropdown(dropdown_element);
      }
    });
  });

  document.addEventListener('keydown', (event) => {
    const active_element = document.activeElement;
    const active_dropdown = active_element ? active_element.closest('[data-dropdown]') : null;

    if (event.key === 'Escape') {
      const open_dropdowns = getOpenDropdowns();
      if (open_dropdowns.length === 0) {
        return;
      }

      const last_open_dropdown = open_dropdowns[open_dropdowns.length - 1];
      closeDropdown(last_open_dropdown);
      const trigger_element = last_open_dropdown.querySelector('[data-dropdown-trigger]');
      if (trigger_element) {
        trigger_element.focus();
      }
      return;
    }

    if (!active_dropdown) {
      return;
    }

    const trigger_element = active_dropdown.querySelector('[data-dropdown-trigger]');
    const panel_element = active_dropdown.querySelector('[data-dropdown-panel]');
    const is_open = active_dropdown.classList.contains('dropdown--open');

    if (
      trigger_element &&
      active_element === trigger_element &&
      (event.key === 'ArrowDown' || event.key === 'ArrowUp' || event.key === 'Enter' || event.key === ' ')
    ) {
      event.preventDefault();
      closeAllExcept(active_dropdown);
      if (!is_open) {
        openDropdown(active_dropdown);
      }

      if (event.key === 'ArrowUp') {
        const menu_items = getMenuItems(active_dropdown);
        if (menu_items.length > 0) {
          focusMenuItem(active_dropdown, menu_items.length - 1);
        }
      } else {
        focusMenuItem(active_dropdown, 0);
      }
      return;
    }

    if (!is_open || !panel_element || !panel_element.contains(active_element)) {
      return;
    }

    const menu_items = getMenuItems(active_dropdown);
    if (menu_items.length === 0) {
      return;
    }

    const current_index = menu_items.indexOf(active_element);

    if (event.key === 'ArrowDown') {
      event.preventDefault();
      focusMenuItem(active_dropdown, current_index + 1);
      return;
    }

    if (event.key === 'ArrowUp') {
      event.preventDefault();
      focusMenuItem(active_dropdown, current_index - 1);
      return;
    }

    if (event.key === 'Home') {
      event.preventDefault();
      focusMenuItem(active_dropdown, 0);
      return;
    }

    if (event.key === 'End') {
      event.preventDefault();
      focusMenuItem(active_dropdown, menu_items.length - 1);
      return;
    }

    if (event.key === 'Tab') {
      closeDropdown(active_dropdown);
    }
  });
};
