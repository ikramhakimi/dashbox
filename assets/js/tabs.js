const getTabs = (tablist) =>
  Array.from(tablist.querySelectorAll('[role="tab"]:not([aria-disabled="true"])'));

const activateTab = (tablist, next_tab, should_focus = true) => {
  if (!(next_tab instanceof HTMLElement)) {
    return;
  }

  const tabs = getTabs(tablist);
  tabs.forEach((tab) => {
    tab.setAttribute('aria-selected', 'false');
    tab.setAttribute('tabindex', '-1');
    tab.classList.remove('tabs__tab--active');
  });

  next_tab.setAttribute('aria-selected', 'true');
  next_tab.setAttribute('tabindex', '0');
  next_tab.classList.add('tabs__tab--active');

  if (should_focus) {
    next_tab.focus();
  }
};

export const initTabs = () => {
  document.querySelectorAll('[role="tablist"]').forEach((tablist) => {
    if (!(tablist instanceof HTMLElement)) {
      return;
    }

    const tabs = getTabs(tablist);
    if (tabs.length === 0) {
      return;
    }

    if (!tabs.some((tab) => tab.getAttribute('aria-selected') === 'true')) {
      activateTab(tablist, tabs[0], false);
    }

    tablist.addEventListener('click', (event) => {
      const clicked_tab = event.target.closest('[role="tab"]');
      if (!clicked_tab || !(clicked_tab instanceof HTMLElement)) {
        return;
      }

      if (clicked_tab.getAttribute('aria-disabled') === 'true') {
        event.preventDefault();
        return;
      }

      activateTab(tablist, clicked_tab, false);
    });

    tablist.addEventListener('keydown', (event) => {
      const active_tab = event.target.closest('[role="tab"]');
      if (!active_tab || !(active_tab instanceof HTMLElement)) {
        return;
      }

      const current_tabs = getTabs(tablist);
      const current_index = current_tabs.indexOf(active_tab);
      if (current_index < 0) {
        return;
      }

      if (event.key === 'ArrowRight' || event.key === 'ArrowDown') {
        event.preventDefault();
        activateTab(tablist, current_tabs[(current_index + 1) % current_tabs.length]);
        return;
      }

      if (event.key === 'ArrowLeft' || event.key === 'ArrowUp') {
        event.preventDefault();
        activateTab(tablist, current_tabs[(current_index - 1 + current_tabs.length) % current_tabs.length]);
        return;
      }

      if (event.key === 'Home') {
        event.preventDefault();
        activateTab(tablist, current_tabs[0]);
        return;
      }

      if (event.key === 'End') {
        event.preventDefault();
        activateTab(tablist, current_tabs[current_tabs.length - 1]);
      }
    });
  });
};
