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
  </script>
</body>
</html>
