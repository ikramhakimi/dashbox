export const initIconFinder = () => {
  const finder_roots = document.querySelectorAll('[data-icon-finder]');

  finder_roots.forEach((finder_root) => {
    const input_element = finder_root.querySelector('[data-icon-finder-input]');
    const empty_element = finder_root.querySelector('[data-icon-finder-empty]');
    const grid_element  = finder_root.parentElement?.querySelector('[data-icon-finder-grid]');

    if (!input_element || !empty_element || !grid_element) {
      return;
    }

    const icon_items = Array.from(grid_element.querySelectorAll('[data-icon-finder-item]'));
    const icon_groups = Array.from(grid_element.querySelectorAll('[data-icon-finder-group]'));

    const apply_filter = () => {
      const keyword = input_element.value.trim().toLowerCase();
      let visible_count = 0;

      icon_items.forEach((icon_item) => {
        const icon_name = (icon_item.getAttribute('data-icon-name') || '').toLowerCase();
        const icon_category = (icon_item.getAttribute('data-icon-category') || '').toLowerCase();
        const should_show =
          keyword === '' || icon_name.includes(keyword) || icon_category.includes(keyword);

        icon_item.classList.toggle('hidden', !should_show);
        if (should_show) {
          visible_count += 1;
        }
      });

      icon_groups.forEach((icon_group) => {
        const has_visible_item =
          icon_group.querySelector('[data-icon-finder-item]:not(.hidden)') !== null;
        icon_group.classList.toggle('hidden', !has_visible_item);
      });

      empty_element.classList.toggle('hidden', visible_count > 0);
    };

    input_element.addEventListener('input', apply_filter);
    apply_filter();
  });
};
