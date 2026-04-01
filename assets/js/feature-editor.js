const getPriceLabel = (value) => {
  const raw_value = value.trim();
  if (raw_value === '') {
    return 'RM 0';
  }

  if (raw_value.toUpperCase().startsWith('RM')) {
    return raw_value;
  }

  return 'RM ' + raw_value;
};

const getFeatureInputs = (root_element) =>
  Array.from(root_element.querySelectorAll('[data-feature-item] .feature-editor__input'));

const getPreviewElement = (root_element, selector) => {
  const local_element = root_element.querySelector(selector);
  if (local_element) {
    return local_element;
  }

  const editor_id = root_element.id;
  if (editor_id === '') {
    return null;
  }

  return document.querySelector(`${selector}[data-feature-preview-for="${editor_id}"]`);
};

const updateFeatureEditor = (root_element) => {
  const title_input = document.getElementById('product-name');
  const price_input = document.getElementById('product-price');
  const title_preview = getPreviewElement(root_element, '[data-feature-preview-title]');
  const price_preview = getPreviewElement(root_element, '[data-feature-preview-price]');
  const list_preview = getPreviewElement(root_element, '[data-feature-preview-list]');
  const count_preview = root_element.querySelector('[data-feature-count]');
  const add_button = root_element.querySelector('[data-feature-add]');
  const max_features = Number(root_element.getAttribute('data-max-features') || '8');

  const feature_inputs = getFeatureInputs(root_element);
  const feature_items = feature_inputs
    .map((input_element) => input_element.value.trim())
    .filter((item) => item !== '');

  const title_value = title_input instanceof HTMLInputElement ? title_input.value.trim() : '';
  const price_value = price_input instanceof HTMLInputElement ? price_input.value : '';

  if (title_preview) {
    title_preview.textContent = title_value !== '' ? title_value : 'Package title preview';
  }

  if (price_preview) {
    price_preview.textContent = getPriceLabel(price_value);
  }

  if (count_preview) {
    count_preview.textContent = `${feature_inputs.length}/${max_features}`;
  }

  if (add_button instanceof HTMLButtonElement) {
    add_button.disabled = feature_inputs.length >= max_features;
  }

  if (list_preview) {
    list_preview.innerHTML = '';
    if (feature_items.length === 0) {
      const empty_item = document.createElement('li');
      empty_item.textContent = 'No features yet';
      list_preview.appendChild(empty_item);
    } else {
      feature_items.slice(0, 6).forEach((item) => {
        const list_item = document.createElement('li');
        list_item.textContent = item;
        list_preview.appendChild(list_item);
      });
    }
  }

  const can_remove = feature_inputs.length > 1;
  root_element.querySelectorAll('[data-feature-remove]').forEach((button_element) => {
    if (button_element instanceof HTMLButtonElement) {
      button_element.disabled = !can_remove;
    }
  });

  root_element.querySelectorAll('[data-feature-item]').forEach((item_element, index) => {
    if (!(item_element instanceof HTMLElement)) {
      return;
    }

    const index_element = item_element.querySelector('[data-feature-index]');
    if (index_element instanceof HTMLElement) {
      index_element.textContent = `${index + 1}.`;
    }

    const input_element = item_element.querySelector('.feature-editor__input');
    if (input_element instanceof HTMLInputElement) {
      input_element.setAttribute('aria-label', `Feature ${index + 1}`);
    }
  });
};

const initSingleFeatureEditor = (root_element) => {
  const list_element = root_element.querySelector('[data-feature-list]');
  const template_element = root_element.querySelector('[data-feature-template]');
  const add_button = root_element.querySelector('[data-feature-add]');

  if (!list_element || !(template_element instanceof HTMLTemplateElement)) {
    return;
  }

  root_element.addEventListener('click', (event) => {
    const remove_button = event.target.closest('[data-feature-remove]');
    if (remove_button) {
      const item_element = remove_button.closest('[data-feature-item]');
      if (!item_element) {
        return;
      }

      const all_items = root_element.querySelectorAll('[data-feature-item]');
      if (all_items.length <= 1) {
        return;
      }

      item_element.remove();
      updateFeatureEditor(root_element);
      return;
    }

    const add_trigger = event.target.closest('[data-feature-add]');
    if (!add_trigger) {
      return;
    }

    const max_features = Number(root_element.getAttribute('data-max-features') || '8');
    const current_features = getFeatureInputs(root_element).length;
    if (current_features >= max_features) {
      return;
    }

    const fragment = template_element.content.cloneNode(true);
    list_element.appendChild(fragment);

    const last_input = getFeatureInputs(root_element).pop();
    if (last_input instanceof HTMLInputElement) {
      last_input.focus();
    }

    updateFeatureEditor(root_element);
  });

  root_element.addEventListener('input', () => {
    updateFeatureEditor(root_element);
  });

  const title_input = document.getElementById('product-name');
  const price_input = document.getElementById('product-price');
  if (title_input instanceof HTMLInputElement) {
    title_input.addEventListener('input', () => updateFeatureEditor(root_element));
  }
  if (price_input instanceof HTMLInputElement) {
    price_input.addEventListener('input', () => updateFeatureEditor(root_element));
  }

  if (add_button instanceof HTMLButtonElement) {
    add_button.type = 'button';
  }

  updateFeatureEditor(root_element);
};

export const initFeatureEditor = () => {
  const feature_editors = document.querySelectorAll('[data-feature-editor]');
  if (feature_editors.length === 0) {
    return;
  }

  feature_editors.forEach((root_element) => {
    if (!(root_element instanceof HTMLElement)) {
      return;
    }
    initSingleFeatureEditor(root_element);
  });
};
