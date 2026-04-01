export const initTypographyPlayground = () => {
  const playground_roots = document.querySelectorAll('[data-typography-playground]');

  playground_roots.forEach((playground_root) => {
    const text_select_element = playground_root.querySelector('[data-typography-playground-text]');
    const link_select_element = playground_root.querySelector('[data-typography-playground-link]');
    const icon_select_element = playground_root.querySelector('[data-typography-playground-icon]');

    const preview_text_element = playground_root.querySelector('[data-typography-playground-preview-text]');
    const preview_link_element = playground_root.querySelector('[data-typography-playground-preview-link]');
    const preview_icon_element = playground_root.querySelector('[data-typography-playground-preview-icon]');
    const preview_code_element = playground_root.querySelector('[data-typography-playground-code]');

    if (
      !text_select_element ||
      !link_select_element ||
      !icon_select_element ||
      !preview_text_element ||
      !preview_link_element ||
      !preview_icon_element ||
      !preview_code_element
    ) {
      return;
    }

    const get_allowed_classes = (element, dataset_key) => {
      const raw_value = element.getAttribute(dataset_key) || '';
      return raw_value
        .split(' ')
        .map((class_name) => class_name.trim())
        .filter((class_name) => class_name !== '');
    };

    const text_classes = get_allowed_classes(
      preview_text_element,
      'data-typography-playground-text-classes',
    );
    const link_classes = get_allowed_classes(
      preview_link_element,
      'data-typography-playground-link-classes',
    );
    const icon_classes = get_allowed_classes(
      preview_icon_element,
      'data-typography-playground-icon-classes',
    );

    const apply_class_token = (element, available_classes, next_class_name) => {
      available_classes.forEach((class_name) => {
        element.classList.remove(class_name);
      });

      if (next_class_name !== '') {
        element.classList.add(next_class_name);
      }
    };

    const sync_preview = () => {
      const text_class_name = (text_select_element.value || '').trim();
      const link_class_name = (link_select_element.value || '').trim();
      const icon_class_name = (icon_select_element.value || '').trim();

      apply_class_token(preview_text_element, text_classes, text_class_name);
      apply_class_token(preview_link_element, link_classes, link_class_name);
      apply_class_token(preview_icon_element, icon_classes, icon_class_name);

      const code_lines = [
        `<p class="type-body ${text_class_name}">...</p>`,
        `<a class="type-link ${link_class_name}" href="#">...</a>`,
        `<span class="${icon_class_name}">[icon]</span>`,
      ];
      preview_code_element.textContent = code_lines.join('\n');
    };

    text_select_element.addEventListener('change', sync_preview);
    link_select_element.addEventListener('change', sync_preview);
    icon_select_element.addEventListener('change', sync_preview);

    sync_preview();
  });
};
