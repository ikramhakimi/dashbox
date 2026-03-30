const isImageFile = (file) => typeof file.type === 'string' && file.type.startsWith('image/');

const setInputFile = (input_element, file) => {
  if (!(input_element instanceof HTMLInputElement)) {
    return;
  }

  if (typeof DataTransfer === 'undefined') {
    return;
  }

  const transfer = new DataTransfer();
  transfer.items.add(file);
  input_element.files = transfer.files;
  input_element.dispatchEvent(new Event('change', { bubbles: true }));
};

const initSingleDropzone = (dropzone_element) => {
  const input_element = dropzone_element.querySelector('[data-dropzone-input]');
  const surface_element = dropzone_element.querySelector('[data-dropzone-surface]');
  const preview_wrap_element = dropzone_element.querySelector('[data-dropzone-preview-wrap]');
  const preview_element = dropzone_element.querySelector('[data-dropzone-preview]');
  const file_name_element = dropzone_element.querySelector('[data-dropzone-file-name]');
  const clear_element = dropzone_element.querySelector('[data-dropzone-clear]');

  if (
    !(input_element instanceof HTMLInputElement) ||
    !(surface_element instanceof HTMLElement) ||
    !(preview_wrap_element instanceof HTMLElement) ||
    !(preview_element instanceof HTMLImageElement) ||
    !(file_name_element instanceof HTMLElement) ||
    !(clear_element instanceof HTMLButtonElement)
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

  const resetState = () => {
    clearPreviewUrl();
    preview_element.removeAttribute('src');
    preview_wrap_element.classList.add('hidden');
    clear_element.classList.add('hidden');
    file_name_element.textContent = 'No file selected';
  };

  const applyFile = (file) => {
    if (!(file instanceof File)) {
      resetState();
      return;
    }

    clearPreviewUrl();
    file_name_element.textContent = file.name;
    clear_element.classList.remove('hidden');

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

  clear_element.addEventListener('click', () => {
    input_element.value = '';
    resetState();
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
      setInputFile(input_element, dropped_file);
    }
  });
};

export const initDropzone = () => {
  const dropzones = document.querySelectorAll('[data-dropzone]');
  if (dropzones.length === 0) {
    return;
  }

  dropzones.forEach((dropzone_element) => {
    if (dropzone_element instanceof HTMLElement) {
      initSingleDropzone(dropzone_element);
    }
  });
};
