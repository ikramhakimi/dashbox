import { initSubmenu } from './submenu.js';
import { initDropdown } from './dropdown.js';
import { initModal } from './modal.js';
import { initTabs } from './tabs.js';
import { initDropzone } from './dropzone.js';
import { initFormState } from './form-state.js';
import { initDrawer } from './drawer.js';
import { initChart } from './chart.js';
import { initFeatureEditor } from './feature-editor.js';
import { initIconFinder } from './icon-finder.js';
import { initTypographyPlayground } from './typography-playground.js';
import { initRating } from './rating.js';

const initApp = () => {
  initSubmenu();
  initDropdown();
  initModal();
  initTabs();
  initDropzone();
  initFormState();
  initDrawer();
  initChart();
  initFeatureEditor();
  initIconFinder();
  initTypographyPlayground();
  initRating();
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initApp);
} else {
  initApp();
}
