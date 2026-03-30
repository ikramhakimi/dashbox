const syncDateLimitSection = (section_element, toggle_element, fields_element) => {
  const enabled = toggle_element.checked;

  fields_element.disabled = !enabled;
  section_element.setAttribute('aria-disabled', enabled ? 'false' : 'true');
  section_element.classList.toggle('form-section--disabled', !enabled);
};

const initSingleDateLimitSection = (section_element) => {
  const toggle_element = section_element.querySelector('.switch__native');
  const fields_element = section_element.querySelector('[data-date-limit-fields]');

  if (!(toggle_element instanceof HTMLInputElement) || !(fields_element instanceof HTMLFieldSetElement)) {
    return;
  }

  syncDateLimitSection(section_element, toggle_element, fields_element);
  toggle_element.addEventListener('change', () => {
    syncDateLimitSection(section_element, toggle_element, fields_element);
  });
};

export const initFormState = () => {
  const sections = document.querySelectorAll('[data-date-limit-section]');
  if (sections.length === 0) {
    return;
  }

  sections.forEach((section_element) => {
    if (section_element instanceof HTMLElement) {
      initSingleDateLimitSection(section_element);
    }
  });
};
