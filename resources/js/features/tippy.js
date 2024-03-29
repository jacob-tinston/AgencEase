import tippy from 'tippy.js';

document.addEventListener('DOMContentLoaded', () => {
  // Menu tooltip
  tippy('[data-toggle="tooltip-menu"]', {
    touch: ["hold", 500],
    theme: "light-border tooltip",
    offset: [0, 12],
    interactive: true,
    animation: "scale",
    placement: "right",
    appendTo: () => document.body,
  });

  // General tooltip
  tippy('[data-toggle="tooltip"]', {
    theme: "light-border tooltip",
    touch: ["hold", 500],
    offset: [0, 12],
    interactive: true,
    animation: "scale",
    appendTo: () => document.body,
  });

  // Popover
  tippy('[data-toggle="popover"]', {
    theme: "light-border popover",
    offset: [0, 12],
    interactive: true,
    allowHTML: true,
    trigger: "click",
    animation: "shift-toward-extreme",
    content: (reference) => {
        const title = reference.dataset.popoverTitle;
        const content = reference.dataset.popoverContent;
        const popover =
          "<h5>" + title + "</h5>" + '<div class="mt-5">' + content + "</div>";
        return popover;
    },
    appendTo: () => document.body,
  });

  // Dropdown
  tippy('[data-toggle="dropdown-menu"]', {
    theme: "light-border",
    offset: [0, 8],
    arrow: false,
    placement: "bottom-start",
    interactive: true,
    allowHTML: true,
    animation: "shift-toward-extreme",
    content: (reference) => {
        let dropdownMenu = reference
          .closest(".dropdown")
          .querySelector(".dropdown-menu");
        dropdownMenu = dropdownMenu.outerHTML;
        return dropdownMenu;
    },
    appendTo: () => document.body,
  });

  // Custom Dropdown
  tippy('[data-toggle="custom-dropdown-menu"]', {
    theme: "light-border",
    offset: [0, 8],
    arrow: false,
    placement: "bottom-start",
    interactive: true,
    allowHTML: true,
    animation: "shift-toward-extreme",
    content: (reference) => {
        let dropdownMenu = reference
          .closest(".dropdown")
          .querySelector(".custom-dropdown-menu");
        dropdownMenu = dropdownMenu.outerHTML;
        return dropdownMenu;
    },
    appendTo: () => document.body,
  });

  // Search & Select
  tippy('[data-toggle="search-select"]', {
    theme: "light-border",
    offset: [0, 8],
    maxWidth: "none",
    arrow: false,
    placement: "bottom-start",
    trigger: "click",
    interactive: true,
    allowHTML: true,
    animation: "shift-toward-extreme",
    content: (reference) => {
        let dropdownMenu = reference
          .closest(".search-select")
          .querySelector(".search-select-menu");
        dropdownMenu = dropdownMenu.outerHTML;
        return dropdownMenu;
    },
    appendTo(reference) {
        return reference.closest(".search-select");
    },
  });
})
