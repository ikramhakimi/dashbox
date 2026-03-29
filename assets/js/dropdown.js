export const initDropdown = () => {
  const getOpenDropdowns = () => document.querySelectorAll('[data-dropdown].dropdown--open');

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

      getOpenDropdowns().forEach((open_dropdown) => {
        if (open_dropdown !== dropdown_element) {
          closeDropdown(open_dropdown);
        }
      });

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
    if (event.key !== 'Escape') {
      return;
    }

    getOpenDropdowns().forEach((dropdown_element) => {
      closeDropdown(dropdown_element);
    });
  });
};
