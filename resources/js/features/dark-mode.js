import {on} from '../helpers';

document.addEventListener('DOMContentLoaded', () => {
    const root = document.documentElement;
    const darkModeTogglers = document.querySelectorAll(".dark-mode-toggler");

    if (darkModeTogglers) {
        const scheme = localStorage.getItem("scheme");

        if (scheme) root.classList.add(scheme);

        if (scheme === "dark") {
            darkModeTogglers.forEach(toggler => {
                toggler.checked = "checked"
            })
        };

        // Enable Dark Mode
        const enableDarkMode = () => {
            root.classList.remove("light");
            root.classList.add("dark");
            localStorage.setItem("scheme", "dark");
        };

        // Disable Dark Mode
        const disableDarkMode = () => {
            root.classList.remove("dark");
            root.classList.add("light");
            localStorage.removeItem("scheme");
        };

        // Check Dark Mode
        const checkDarkMode = () => {
            return root.classList.contains("dark");
        };

        on("body", "change", ".dark-mode-toggler", () => {
            checkDarkMode() ? disableDarkMode() : enableDarkMode();
            
            darkModeTogglers.forEach(toggler => {
                toggler.checked = checkDarkMode();
            })
        });
    }
})
