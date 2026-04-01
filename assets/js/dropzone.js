const isImageFile = (file) => typeof file.type === 'string' && file.type.startsWith('image/');
const dragHandleIcon = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M8 6h.01M8 12h.01M8 18h.01M16 6h.01M16 12h.01M16 18h.01" stroke-linecap="round" stroke-linejoin="round"/></svg>';
const fileIcon = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M14 2H7a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/></svg>';
const removeIcon = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 6h18"/><path d="M8 6V4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>';
const fileSignature = (file) => `${file.name}::${file.size}::${file.lastModified}`;

const createDataTransferFiles = (files) => {
  if (typeof DataTransfer === 'undefined') {
    return null;
  }

  const transfer = new DataTransfer();
  files.forEach((file) => {
    if (file instanceof File) {
      transfer.items.add(file);
    }
  });
  return transfer.files;
};

const initSingleDropzone = (dropzone_element) => {
  const input_element = dropzone_element.querySelector('[data-dropzone-input]');
  const surface_element = dropzone_element.querySelector('[data-dropzone-surface]');
  const preview_wrap_element = dropzone_element.querySelector('[data-dropzone-preview-wrap]');
  const preview_element = dropzone_element.querySelector('[data-dropzone-preview]');
  const file_name_element = dropzone_element.querySelector('[data-dropzone-file-name]');
  const clear_elements = Array.from(dropzone_element.querySelectorAll('[data-dropzone-clear]'));
  const title_element = dropzone_element.querySelector('[data-dropzone-title]');

  if (
    !(input_element instanceof HTMLInputElement) ||
    !(surface_element instanceof HTMLElement) ||
    !(preview_wrap_element instanceof HTMLElement) ||
    !(preview_element instanceof HTMLImageElement) ||
    !(file_name_element instanceof HTMLElement) ||
    clear_elements.length === 0
  ) {
    return;
  }

  const previewable = dropzone_element.getAttribute('data-dropzone-previewable') !== 'false';
  let preview_url = null;

  const clearPreviewUrl = () => {
    if (typeof preview_url === 'string' && preview_url !== '') {
      URL.revokeObjectURL(preview_url);
      preview_url = null;
    }
  };

  const showClearButtons = () => {
    clear_elements.forEach((clear_element) => {
      if (clear_element instanceof HTMLButtonElement) {
        clear_element.classList.remove('hidden');
      }
    });
  };

  const hideClearButtons = () => {
    clear_elements.forEach((clear_element) => {
      if (clear_element instanceof HTMLButtonElement) {
        clear_element.classList.add('hidden');
      }
    });
  };

  const syncSurfaceTitle = (has_file) => {
    if (!(title_element instanceof HTMLElement)) {
      return;
    }

    const default_title = title_element.getAttribute('data-dropzone-title-default') || '';
    const change_title = title_element.getAttribute('data-dropzone-title-change') || default_title;
    title_element.textContent = has_file ? change_title : default_title;
  };

  const resetState = () => {
    clearPreviewUrl();
    preview_element.removeAttribute('src');
    preview_wrap_element.classList.add('hidden');
    hideClearButtons();
    file_name_element.textContent = 'No file selected';
    dropzone_element.classList.remove('dropzone--has-files');
    syncSurfaceTitle(false);
  };

  const applyFile = (file) => {
    if (!(file instanceof File)) {
      resetState();
      return;
    }

    clearPreviewUrl();
    file_name_element.textContent = file.name;
    showClearButtons();
    dropzone_element.classList.add('dropzone--has-files');
    syncSurfaceTitle(true);

    if (previewable && isImageFile(file)) {
      preview_url = URL.createObjectURL(file);
      preview_element.src = preview_url;
      preview_wrap_element.classList.remove('hidden');
      return;
    }

    preview_element.removeAttribute('src');
    preview_wrap_element.classList.add('hidden');
  };

  input_element.addEventListener('change', () => {
    const selected_file = input_element.files && input_element.files[0] ? input_element.files[0] : null;
    applyFile(selected_file);
  });

  clear_elements.forEach((clear_element) => {
    if (!(clear_element instanceof HTMLButtonElement)) {
      return;
    }

    clear_element.addEventListener('click', () => {
      input_element.value = '';
      resetState();
    });
  });

  ['dragenter', 'dragover'].forEach((event_name) => {
    surface_element.addEventListener(event_name, (event) => {
      event.preventDefault();
      if (input_element.disabled) {
        return;
      }
      dropzone_element.classList.add('dropzone--dragging');
    });
  });

  ['dragleave', 'dragend', 'drop'].forEach((event_name) => {
    surface_element.addEventListener(event_name, () => {
      dropzone_element.classList.remove('dropzone--dragging');
    });
  });

  surface_element.addEventListener('drop', (event) => {
    event.preventDefault();
    if (input_element.disabled) {
      return;
    }

    const dropped_file = event.dataTransfer && event.dataTransfer.files[0] ? event.dataTransfer.files[0] : null;
    if (dropped_file) {
      const transfer_files = createDataTransferFiles([dropped_file]);
      if (transfer_files) {
        input_element.files = transfer_files;
      }
      applyFile(dropped_file);
    }
  });
};

const initMultiDropzone = (dropzone_element) => {
  const input_element = dropzone_element.querySelector('[data-dropzone-input]');
  const surface_element = dropzone_element.querySelector('[data-dropzone-surface]');
  const multi_wrap_element = dropzone_element.querySelector('[data-dropzone-multi-wrap]');
  const multi_grid_element = dropzone_element.querySelector('[data-dropzone-multi-grid]');
  const add_tile_element = dropzone_element.querySelector('[data-dropzone-add-tile]');
  const file_name_element = dropzone_element.querySelector('[data-dropzone-file-name]');
  const clear_element = dropzone_element.querySelector('[data-dropzone-clear]');
  const order_element = dropzone_element.querySelector('[data-dropzone-order]');

  if (
    !(input_element instanceof HTMLInputElement) ||
    !(surface_element instanceof HTMLElement) ||
    !(multi_wrap_element instanceof HTMLElement) ||
    !(multi_grid_element instanceof HTMLElement) ||
    !(file_name_element instanceof HTMLElement) ||
    !(clear_element instanceof HTMLButtonElement)
  ) {
    return;
  }

  const max_files = Number(dropzone_element.getAttribute('data-dropzone-max-files') || '0');
  const previewable = dropzone_element.getAttribute('data-dropzone-previewable') !== 'false';
  const sortable = dropzone_element.getAttribute('data-dropzone-sortable') === 'true';
  let selected_items = [];
  let drag_item_id = '';

  const syncAddTileVisibility = () => {
    if (!(add_tile_element instanceof HTMLElement)) {
      return;
    }

    const has_items = selected_items.length > 0;
    const has_slot = max_files === 0 || selected_items.length < max_files;
    add_tile_element.classList.toggle('hidden', !(has_items && has_slot));
  };

  const syncInputFiles = () => {
    const files = selected_items.map((item) => item.file);
    const transfer_files = createDataTransferFiles(files);
    if (transfer_files) {
      input_element.files = transfer_files;
    }

    if (order_element instanceof HTMLInputElement) {
      order_element.value = selected_items.map((item) => item.file.name).join('|');
    }
  };

  const revokeItemUrls = () => {
    selected_items.forEach((item) => {
      if (typeof item.preview_url === 'string' && item.preview_url !== '') {
        URL.revokeObjectURL(item.preview_url);
      }
    });
  };

  const updateMeta = () => {
    if (selected_items.length === 0) {
      file_name_element.textContent = 'No file selected';
      clear_element.classList.add('hidden');
      multi_wrap_element.classList.add('hidden');
      dropzone_element.classList.remove('dropzone--has-files');
      syncAddTileVisibility();
      return;
    }

    if (max_files > 0) {
      file_name_element.textContent = `${selected_items.length}/${max_files} files selected`;
    } else {
      file_name_element.textContent =
        selected_items.length === 1 ? '1 file selected' : `${selected_items.length} files selected`;
    }

    clear_element.classList.remove('hidden');
    multi_wrap_element.classList.remove('hidden');
    dropzone_element.classList.add('dropzone--has-files');
    syncAddTileVisibility();
  };

  const renderGrid = () => {
    multi_grid_element.innerHTML = '';

    selected_items.forEach((item) => {
      const item_element = document.createElement('div');
      item_element.className = 'dropzone__item';
      item_element.dataset.itemId = item.id;
      item_element.draggable = sortable;
      item_element.title = item.file.name;

      const header_element = document.createElement('div');
      header_element.className = 'dropzone__item-header';

      const handle_element = document.createElement('span');
      handle_element.className = 'dropzone__item-handle';
      handle_element.innerHTML = dragHandleIcon;
      handle_element.setAttribute('aria-hidden', 'true');

      const remove_element = document.createElement('button');
      remove_element.type = 'button';
      remove_element.className = 'dropzone__item-remove';
      remove_element.dataset.removeId = item.id;
      remove_element.setAttribute('aria-label', `Remove ${item.file.name}`);
      remove_element.innerHTML = removeIcon;

      header_element.appendChild(handle_element);
      header_element.appendChild(remove_element);

      const thumb_element = document.createElement('div');
      thumb_element.className = 'dropzone__item-thumb';
      thumb_element.appendChild(header_element);

      if (previewable && isImageFile(item.file) && item.preview_url !== '') {
        const image_element = document.createElement('img');
        image_element.className = 'dropzone__item-image';
        image_element.src = item.preview_url;
        image_element.alt = item.file.name;
        image_element.draggable = false;
        thumb_element.appendChild(image_element);
      } else {
        const fallback_element = document.createElement('span');
        fallback_element.className = 'dropzone__item-fallback';
        const name_parts = item.file.name.split('.');
        const extension = name_parts.length > 1 ? name_parts[name_parts.length - 1].toUpperCase() : 'FILE';
        fallback_element.innerHTML = `${fileIcon}<span>${extension}</span>`;
        thumb_element.appendChild(fallback_element);
      }

      const caption_element = document.createElement('p');
      caption_element.className = 'dropzone__item-name';
      caption_element.textContent = item.file.name;

      item_element.appendChild(thumb_element);
      item_element.appendChild(caption_element);
      multi_grid_element.appendChild(item_element);
    });

    if (add_tile_element instanceof HTMLElement) {
      multi_grid_element.appendChild(add_tile_element);
    }
  };

  const applySelection = (files) => {
    if (!Array.isArray(files) || files.length === 0) {
      return;
    }

    const signatures = new Set(selected_items.map((item) => fileSignature(item.file)));
    const next_files = files.filter((file) => file instanceof File && !signatures.has(fileSignature(file)));

    if (next_files.length === 0) {
      return;
    }

    const available_slots = max_files > 0 ? Math.max(0, max_files - selected_items.length) : next_files.length;
    if (available_slots === 0) {
      return;
    }

    next_files.slice(0, available_slots).forEach((file) => {
      if (!(file instanceof File)) {
        return;
      }

      selected_items.push({
        id: `${Date.now()}-${Math.random().toString(36).slice(2, 8)}`,
        file,
        preview_url: previewable && isImageFile(file) ? URL.createObjectURL(file) : '',
      });
    });

    syncInputFiles();
    renderGrid();
    updateMeta();
  };

  const removeItem = (item_id) => {
    const next_items = [];

    selected_items.forEach((item) => {
      if (item.id === item_id) {
        if (typeof item.preview_url === 'string' && item.preview_url !== '') {
          URL.revokeObjectURL(item.preview_url);
        }
        return;
      }
      next_items.push(item);
    });

    selected_items = next_items;
    syncInputFiles();
    renderGrid();
    updateMeta();
  };

  const clearAll = () => {
    revokeItemUrls();
    selected_items = [];
    input_element.value = '';
    if (order_element instanceof HTMLInputElement) {
      order_element.value = '';
    }
    renderGrid();
    updateMeta();
  };

  const reorderItems = (from_id, to_id) => {
    if (from_id === '' || to_id === '' || from_id === to_id) {
      return;
    }

    const from_index = selected_items.findIndex((item) => item.id === from_id);
    const to_index = selected_items.findIndex((item) => item.id === to_id);
    if (from_index < 0 || to_index < 0) {
      return;
    }

    const moved_item = selected_items[from_index];
    const next_items = selected_items.filter((item) => item.id !== from_id);
    next_items.splice(to_index, 0, moved_item);
    selected_items = next_items;
    syncInputFiles();
    renderGrid();
    updateMeta();
  };

  input_element.addEventListener('change', () => {
    const files = input_element.files ? Array.from(input_element.files) : [];
    applySelection(files);
  });

  clear_element.addEventListener('click', () => {
    clearAll();
  });

  ['dragenter', 'dragover'].forEach((event_name) => {
    surface_element.addEventListener(event_name, (event) => {
      event.preventDefault();
      if (input_element.disabled) {
        return;
      }
      dropzone_element.classList.add('dropzone--dragging');
    });
  });

  ['dragleave', 'dragend', 'drop'].forEach((event_name) => {
    surface_element.addEventListener(event_name, () => {
      dropzone_element.classList.remove('dropzone--dragging');
    });
  });

  surface_element.addEventListener('drop', (event) => {
    event.preventDefault();
    if (input_element.disabled) {
      return;
    }

    const files = event.dataTransfer && event.dataTransfer.files
      ? Array.from(event.dataTransfer.files)
      : [];
    applySelection(files);
  });

  multi_grid_element.addEventListener('click', (event) => {
    const remove_button = event.target.closest('[data-remove-id]');
    if (!remove_button) {
      return;
    }

    const remove_id = remove_button.getAttribute('data-remove-id') || '';
    removeItem(remove_id);
  });

  if (sortable) {
    multi_grid_element.addEventListener('dragstart', (event) => {
      const item_element = event.target.closest('[data-item-id]');
      if (!(item_element instanceof HTMLElement)) {
        return;
      }
      drag_item_id = item_element.dataset.itemId || '';
      item_element.classList.add('dropzone__item--dragging');
      if (event.dataTransfer) {
        event.dataTransfer.setDragImage(item_element, 24, 24);
      }
    });

    multi_grid_element.addEventListener('dragend', (event) => {
      const item_element = event.target.closest('[data-item-id]');
      if (item_element instanceof HTMLElement) {
        item_element.classList.remove('dropzone__item--dragging');
      }
      multi_grid_element.querySelectorAll('.dropzone__item--drag-over').forEach((item) => {
        item.classList.remove('dropzone__item--drag-over');
      });
      drag_item_id = '';
    });

    multi_grid_element.addEventListener('dragover', (event) => {
      event.preventDefault();
      const target_item = event.target.closest('[data-item-id]');
      if (!(target_item instanceof HTMLElement)) {
        return;
      }

      multi_grid_element.querySelectorAll('.dropzone__item--drag-over').forEach((item) => {
        item.classList.remove('dropzone__item--drag-over');
      });
      target_item.classList.add('dropzone__item--drag-over');
    });

    multi_grid_element.addEventListener('drop', (event) => {
      event.preventDefault();
      const target_item = event.target.closest('[data-item-id]');
      if (!(target_item instanceof HTMLElement)) {
        return;
      }

      const target_id = target_item.dataset.itemId || '';
      reorderItems(drag_item_id, target_id);
      multi_grid_element.querySelectorAll('.dropzone__item--drag-over').forEach((item) => {
        item.classList.remove('dropzone__item--drag-over');
      });
      drag_item_id = '';
    });

    multi_grid_element.addEventListener('dragleave', (event) => {
      if (event.target === multi_grid_element) {
        multi_grid_element.querySelectorAll('.dropzone__item--drag-over').forEach((item) => {
          item.classList.remove('dropzone__item--drag-over');
        });
      }
    });
  }

  updateMeta();
};

export const initDropzone = () => {
  const dropzones = document.querySelectorAll('[data-dropzone]');
  if (dropzones.length === 0) {
    return;
  }

  dropzones.forEach((dropzone_element) => {
    if (!(dropzone_element instanceof HTMLElement)) {
      return;
    }

    const mode = dropzone_element.getAttribute('data-dropzone-mode') || 'single';
    if (mode === 'multi') {
      initMultiDropzone(dropzone_element);
      return;
    }

    initSingleDropzone(dropzone_element);
  });
};
