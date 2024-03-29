import {on, animateCSS} from '../helpers';

const closeAlert = (alert) => {
    alert.style.overflowY = "hidden";
    alert.style.height = alert.offsetHeight + "px";

    animateCSS(alert, "fadeOut").then(() => {
        alert.style.opacity = 0;
        alert.style.height = 0;
        alert.style.marginTop = 0;
        alert.style.marginBottom = 0;
        alert.style.paddingTop = 0;
        alert.style.paddingBottom = 0;
        alert.style.border = 0;
    });

    alert.addEventListener("transitionend", () => {
        alert.parentNode ? alert.parentNode.removeChild(alert) : false;
    }, { once: true });
};

document.addEventListener('DOMContentLoaded', () => {
    on(".alert", "click", '[data-dismiss="alert"]', (event) => {
        const alert = event.target.closest(".alert");
        closeAlert(alert);
    });
})
