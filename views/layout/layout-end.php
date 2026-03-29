  <script>
    const submenu_trigger = document.querySelector('[data-submenu-trigger]');
    const submenu_panel = document.querySelector('[data-submenu-panel]');
    const submenu_icon = document.querySelector('[data-submenu-icon]');

    if (submenu_trigger && submenu_panel && submenu_icon) {
      submenu_trigger.addEventListener('click', () => {
        submenu_panel.classList.toggle('hidden');
        submenu_icon.classList.toggle('rotate-180');
      });
    }

    const close_modal = (modal_element) => {
      if (!modal_element) {
        return;
      }

      modal_element.classList.add('hidden');
      modal_element.classList.remove('flex');
      modal_element.setAttribute('aria-hidden', 'true');

      const has_open_modal = document.querySelector('[data-modal]:not(.hidden)');
      if (!has_open_modal) {
        document.body.classList.remove('overflow-hidden');
      }
    };

    const open_modal = (modal_element) => {
      if (!modal_element) {
        return;
      }

      modal_element.classList.remove('hidden');
      modal_element.classList.add('flex');
      modal_element.setAttribute('aria-hidden', 'false');
      document.body.classList.add('overflow-hidden');
    };

    document.addEventListener('click', (event) => {
      const open_trigger = event.target.closest('[data-modal-open]');
      if (open_trigger) {
        event.preventDefault();
        const modal_id = open_trigger.getAttribute('data-modal-open');
        if (!modal_id) {
          return;
        }

        const modal_element = document.getElementById(modal_id);
        open_modal(modal_element);
        return;
      }

      const close_trigger = event.target.closest('[data-modal-close]');
      if (close_trigger) {
        const modal_element = close_trigger.closest('[data-modal]');
        close_modal(modal_element);
      }
    });

    document.addEventListener('keydown', (event) => {
      if (event.key !== 'Escape') {
        return;
      }

      const open_modals = document.querySelectorAll('[data-modal]:not(.hidden)');
      if (open_modals.length === 0) {
        return;
      }

      const last_modal = open_modals[open_modals.length - 1];
      close_modal(last_modal);
    });
  </script>
</body>
</html>
