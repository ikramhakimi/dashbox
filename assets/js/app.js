import { initSubmenu } from './submenu.js';
import { initDropdown } from './dropdown.js';
import { initModal } from './modal.js';
import { initTabs } from './tabs.js';
import { initDropzone } from './dropzone.js';
import { initFormState } from './form-state.js';
import { initDrawer } from './drawer.js';

const initApp = () => {
  initSubmenu();
  initDropdown();
  initModal();
  initTabs();
  initDropzone();
  initFormState();
  initDrawer();
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initApp);
} else {
  initApp();
}
