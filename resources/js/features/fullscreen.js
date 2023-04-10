import {on} from '../helpers';

window.addEventListener('DOMContentLoaded', () => {
    const root = document.documentElement;
    const fullScreenToggler = document.getElementById("fullScreenToggler");

    if (fullScreenToggler) {
        // Open fullscreen
        const openFullscreen = () => {
            if (root.requestFullscreen) {
                root.requestFullscreen();
            } else if (root.mozRequestFullScreen) {
                root.mozRequestFullScreen();
            } else if (root.webkitRequestFullscreen) {
                root.webkitRequestFullscreen();
            } else if (root.msRequestFullscreen) {
                root.msRequestFullscreen();
            }
        };

        // Close fullscreen
        const closeFullscreen = () => {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        };

        // Check fullscreen
        const checkFullscreen = () => {
            return document.fullscreenElement ||
                document.webkitFullscreenElement ||
                document.mozFullScreenElement ||
                document.msFullscreenElement;
        };

        // Toggle Button Icon
        const togglerBtnIcon = () => {
            if (fullScreenToggler.classList.contains("la-expand-arrows-alt")) {
                fullScreenToggler.classList.remove("la-expand-arrows-alt");
                fullScreenToggler.classList.add("la-compress-arrows-alt");
            } else {
                fullScreenToggler.classList.remove("la-compress-arrows-alt");
                fullScreenToggler.classList.add("la-expand-arrows-alt");
            }
        };

        on("body", "click", "#fullScreenToggler", () => {
            checkFullscreen() ? closeFullscreen() : openFullscreen();
            togglerBtnIcon();
        });
    }
})
