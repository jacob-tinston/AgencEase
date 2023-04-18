import {on} from '../helpers';

document.addEventListener('DOMContentLoaded', () => {
  const root = document.documentElement;

    const customizer = document.getElementById("customizer");
    const menuBar = document.querySelector(".menu-bar");
    const menuItems = document.querySelector(".menu-items");

    if (!customizer) return;

    // Theme Options
    const themes = [
        {
          id: "sky",
          label: "Sky",
          color: "#0284C7",
        },
        {
          id: "red",
          label: "Red",
          color: "#DC2626",
        },
        {
          id: "orange",
          label: "Orange",
          color: "#EA580C",
        },
        {
          id: "amber",
          label: "Amber",
          color: "#D97706",
        },
        {
          id: "yellow",
          label: "Yellow",
          color: "#CA8A04",
        },
        {
          id: "lime",
          label: "Lime",
          color: "#65A30D",
        },
        {
          id: "green",
          label: "Green",
          color: "#65A30D",
        },
        {
          id: "emerald",
          label: "Emerald",
          color: "#059669",
        },
        {
          id: "teal",
          label: "Teal",
          color: "#0D9488",
        },
        {
          id: "cyan",
          label: "Cyan",
          color: "#0891B2",
        },
        {
          id: "blue",
          label: "Blue",
          color: "#2563EB",
        },
        {
          id: "default",
          label: "Indigo",
          color: "#4F46E5",
        },
        {
          id: "violet",
          label: "Violet",
          color: "#7C3AED",
        },
        {
          id: "purple",
          label: "Purple",
          color: "#9333EA",
        },
        {
          id: "fuchsia",
          label: "Fuchsia",
          color: "#C026D3",
        },
        {
          id: "pink",
          label: "Pink",
          color: "#DB2777",
        },
        {
          id: "rose",
          label: "Rose",
          color: "#E11D48",
        },
    ];

    let themesHTML = "";

    themes.forEach((item) => {
        themesHTML += `
          <button data-toggle="theme" data-value=${item.id}>
            <span class="color bg-[${item.color}]"></span>
            <span>${item.label}</span>
          </button>`;
    });

    const themesContainer = document.getElementById("customizerThemes");

    themesContainer.innerHTML = themesHTML;

    // Grays Options
    const grays = [
        {
          id: "pure",
          label: "Pure",
          color: "#4B5563",
        },
        {
          id: "default",
          label: "Slate",
          color: "#475569",
        },
        {
          id: "zinc",
          label: "Zinc",
          color: "#52525B",
        },
        {
          id: "neutral",
          label: "Neutral",
          color: "#525252",
        },
        {
          id: "stone",
          label: "Stone",
          color: "#57534E",
        },
    ];

    let graysHTML = "";

    grays.forEach((item) => {
        graysHTML += `
          <button data-toggle="gray" data-value=${item.id}>
            <span class="color bg-[${item.color}]"></span>
            <span>${item.label}</span>
          </button>`;
    });

    const graysContainer = document.getElementById("customizerGrays");

    graysContainer.innerHTML = graysHTML;

    // Fonts Options
    const fontsList = [
        {
          id: "nunito",
          heading: "nunito",
          headingLabel: "Nunito",
          body: "Nunito_Sans",
          bodyLabel: "Nunito Sans",
        },
        {
          id: "montserrat",
          heading: "montserrat",
          headingLabel: "Montserrat",
          body: "Montserrat",
          bodyLabel: "Montserrat",
        },
        {
          id: "raleway",
          heading: "raleway",
          headingLabel: "Raleway",
          body: "Raleway",
          bodyLabel: "Raleway",
        },
        {
          id: "default",
          heading: "poppins",
          headingLabel: "Poppins",
          body: "Poppins",
          bodyLabel: "Poppins",
        },
        {
          id: "oswald",
          heading: "oswald",
          headingLabel: "Oswald",
          body: "Oswald",
          bodyLabel: "Oswald",
        },
        {
          id: "roboto-condensed-roboto",
          heading: "roboto-condensed-roboto",
          headingLabel: "Roboto Condensed",
          body: "Roboto",
          bodyLabel: "Roboto",
        },
        {
          id: "inter",
          heading: "inter",
          headingLabel: "Inter",
          body: "Inter",
          bodyLabel: "Inter",
        },
        {
          id: "yantramanav",
          heading: "yantramanav",
          headingLabel: "Yantramanav",
          body: "Yantramanav",
          bodyLabel: "Yantramanav",
        },
    ];

    let fontsHTML = "";

    fontsList.forEach((item) => {
        fontsHTML += `
          <button data-toggle="font" data-value=${item.id}>
            <h5 class="font-${item.heading}">${item.headingLabel}</h5>
            <p class="font-['${item.body}']">${item.bodyLabel}</p>
          </button>`;
    });

    const fontsContainer = document.getElementById("customizerFonts");

    fontsContainer.innerHTML = fontsHTML;

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

    // Toggle Customizer
    const toggleCustomizer = () => {
        if (customizer.classList.contains("open")) {
            customizer.classList.remove("open");
        } else {
            checkSettings();
          
            customizer.classList.add("open");
        }
    };

    // Toggle Dark Mode
    const toggleDarkMode = () => {
      const darkModeToggler = document.getElementById("darkModeToggler");
      darkModeToggler.click();
    };

    // Toggle Branded Menu
    const toggleBrandedMenu = () => {
      if (root.classList.contains("menu_branded")) {
        root.classList.remove("menu_branded");
        menuBar.classList.remove("menu_branded");

        localStorage.removeItem("brandedMenu");
      } else {
        root.classList.add("menu_branded");
        menuBar.classList.add("menu_branded");

        localStorage.setItem("brandedMenu", "menu_branded");
      }
    };

    // Switch Theme
    const switchTheme = (id) => {
      customizer
        .querySelectorAll("[data-toggle='theme']")
        .forEach((themeTogger) => {
          themeTogger.classList.remove("active");
        });

      const themeToggler = customizer.querySelector(
        "[data-toggle='theme'][data-value='" + id + "']"
      );

      themeToggler.classList.add("active");

      root.classList.forEach((value) => {
        if (value.startsWith("theme-")) {
          root.classList.remove(value);
        }
      });

      if (id == "default") {
        localStorage.removeItem("theme");
      } else {
        root.classList.add("theme-" + id);
        localStorage.setItem("theme", id);
      }

      const event = new Event("ThemeChanged");
      document.dispatchEvent(event);
    };

    // Switch Gray
    const switchGray = (id) => {
      customizer
        .querySelectorAll("[data-toggle='gray']")
        .forEach((grayTogger) => {
          grayTogger.classList.remove("active");
        });

      const grayToggler = customizer.querySelector(
        "[data-toggle='gray'][data-value='" + id + "']"
      );

      grayToggler.classList.add("active");

      root.classList.forEach((value) => {
        if (value.startsWith("gray-")) {
          root.classList.remove(value);
        }
      });

      if (id == "default") {
        localStorage.removeItem("gray");
      } else {
        root.classList.add("gray-" + id);
        localStorage.setItem("gray", id);
      }

      const event = new Event("ThemeChanged");
      document.dispatchEvent(event);
    };

    // Switch Fonts
    const switchFonts = (id) => {
      customizer
        .querySelectorAll("[data-toggle='font']")
        .forEach((fontTogger) => {
          fontTogger.classList.remove("active");
        });

      const fontToggler = customizer.querySelector(
        "[data-toggle='font'][data-value='" + id + "']"
      );

      fontToggler.classList.add("active");

      root.classList.forEach((value) => {
        if (value.startsWith("font-")) {
          root.classList.remove(value);
        }
      });

      if (id == "default") {
        localStorage.removeItem("font");
      } else {
        root.classList.add("font-" + id);
        localStorage.setItem("font", id);
      }

      const event = new Event("ThemeChanged");
      document.dispatchEvent(event);

      location.reload();
    };

    on("#customizer", "click", '[data-toggle="customizer"]', () => {
      toggleCustomizer();
    });

    on("#customizer", "click", '[data-toggle="dark-mode"]', () => {
      toggleDarkMode();
    });

    on("#customizer", "click", '[data-toggle="branded-menu"]', () => {
      toggleBrandedMenu();
    });

    on("#customizer", "click", '[data-toggle="theme"]', (event) => {
      const themeToggler = event.target.closest("[data-toggle='theme']");
      const id = themeToggler.dataset.value;
      switchTheme(id);
    });

    on("#customizer", "click", '[data-toggle="gray"]', (event) => {
      const grayToggler = event.target.closest("[data-toggle='gray']");
      const id = grayToggler.dataset.value;
      switchGray(id);
    });

    on("#customizer", "click", '[data-toggle="font"]', (event) => {
      const fontToggler = event.target.closest("[data-toggle='font']");
      const id = fontToggler.dataset.value;
      switchFonts(id);
    });

    checkSettings();
})
