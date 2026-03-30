export const initSubmenu = () => {
  const submenu_groups = document.querySelectorAll('[data-submenu]');

  submenu_groups.forEach((group) => {
    const submenu_trigger = group.querySelector('[data-submenu-trigger]');
    const submenu_panel   = group.querySelector('[data-submenu-panel]');
    const submenu_icon    = group.querySelector('[data-submenu-icon]');
    const default_open    = group.getAttribute('data-submenu-default-open') === 'true';

    if (!submenu_trigger || !submenu_panel || !submenu_icon) {
      return;
    }

    submenu_panel.classList.toggle('hidden', !default_open);
    submenu_icon.classList.toggle('rotate-180', default_open);
    submenu_trigger.setAttribute('aria-expanded', default_open ? 'true' : 'false');

    submenu_trigger.addEventListener('click', () => {
      const will_open = submenu_panel.classList.contains('hidden');

      submenu_panel.classList.toggle('hidden');
      submenu_icon.classList.toggle('rotate-180', will_open);
      submenu_trigger.setAttribute('aria-expanded', will_open ? 'true' : 'false');
    });
  });
};
