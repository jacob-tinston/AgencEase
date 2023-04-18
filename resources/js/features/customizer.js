import {on} from '../helpers';

document.addEventListener('DOMContentLoaded', () => {

    // Check Settings
    const checkSettings = () => {
      // Dark Mode
      const scheme = localStorage.getItem("scheme");

      const darkModeToggler = customizer.querySelector(
          '[data-toggle="dark-mode"]'
      );

      if (scheme) {
          darkModeToggler.checked = true;
      } else {
          darkModeToggler.checked = false;
      }

      // Branded Menu
      let brandedMenu = localStorage.getItem("brandedMenu");

      const brandedMenuToggler = customizer.querySelector(
          '[data-toggle="branded-menu"]'
      );

      if (brandedMenu && menuBar) {
          root.classList.add("menu_branded");
          menuBar.classList.add("menu_branded");

          brandedMenuToggler.checked = true;
      } else {
          brandedMenuToggler.checked = false;
      }

      // Theme
      let theme = localStorage.getItem("theme");

      let themeToggler;

      if (theme) {
          root.classList.add("theme-" + theme);

          themeToggler = customizer.querySelector(
              "[data-toggle='theme'][data-value='" + theme + "']"
          );
      } else {
          themeToggler = customizer.querySelector(
              "[data-toggle='theme'][data-value='default']"
          );
      }

      if (themeToggler) {
          themeToggler.classList.add("active");
      }

      // Gray
      let gray = localStorage.getItem("gray");

      let grayToggler;

      if (gray) {
          root.classList.add("gray-" + gray);

          grayToggler = customizer.querySelector(
              "[data-toggle='gray'][data-value='" + gray + "']"
          );
      } else {
          grayToggler = customizer.querySelector(
              "[data-toggle='gray'][data-value='default']"
          );
      }

      if (grayToggler) {
          grayToggler.classList.add("active");
      }

      // Font
      let font = localStorage.getItem("font");

      let fontToggler;

      if (font) {
          root.classList.add("font-" + font);

          fontToggler = customizer.querySelector(
              "[data-toggle='font'][data-value='" + font + "']"
          );
      } else {
          fontToggler = customizer.querySelector(
              "[data-toggle='font'][data-value='default']"
          );
      }

      if (fontToggler) {
          fontToggler.classList.add("active");
      }
    };

    checkSettings();
})
