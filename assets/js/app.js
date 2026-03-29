import { initSubmenu } from './submenu.js';
import { initDropdown } from './dropdown.js';
import { initModal } from './modal.js';

const initApp = () => {
  initSubmenu();
  initDropdown();
  initModal();
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initApp);
} else {
  initApp();
}
