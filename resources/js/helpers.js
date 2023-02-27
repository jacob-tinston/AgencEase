// Event delegation
export const on = (selector, eventType, childSelector, eventHandler) => {
    const elements = document.querySelectorAll(selector);

    elements.forEach(element => {
        element.addEventListener(eventType, (eventOnElement) => {
            if (eventOnElement.target.closest(childSelector)) {
              eventHandler(eventOnElement);
            }
        });
    })
};

// AnimateCSS
export const animateCSS = (element, animation, prefix = "animate__") => {
    return new Promise((resolve, reject) => {
        const animationName = `${prefix}${animation}`;
        const node = element;

        node.classList.add(`${prefix}animated`, `${prefix}faster`, animationName);

        const handleAnimationEnd = (event) => {
            event.stopPropagation();

            node.classList.remove(
                `${prefix}animated`,
                `${prefix}faster`,
                animationName
            );

            resolve("Animation Ended.");
        };

        node.addEventListener("animationend", handleAnimationEnd, { once: true });
    });
};

// Open Collapse
export const openCollapse = (collapse, callback) => {
    setTimeout(() => {
        collapse.style.height = collapse.scrollHeight + "px";
        collapse.style.opacity = 1;
    }, 200);

    collapse.addEventListener("transitionend", () => {
        collapse.classList.add("open");

        collapse.style.removeProperty("height");
        collapse.style.removeProperty("opacity");

        if (typeof callback === "function") callback();
    }, { once: true });
};

// Close Collapse
export const closeCollapse = (collapse, callback) => {
    collapse.style.overflowY = "hidden";
    collapse.style.height = collapse.scrollHeight + "px";

    setTimeout(() => {
        collapse.style.height = 0;
        collapse.style.opacity = 0;
    }, 200);

    collapse.addEventListener("transitionend", () => {
        collapse.classList.remove("open");

        collapse.style.removeProperty("overflow-y");
        collapse.style.removeProperty("height");
        collapse.style.removeProperty("opacity");

        if (typeof callback === "function") callback();
    }, { once: true });
};

// Show Backdrop
export const showBackdrop = (workspace) => {
    if (document.querySelector(".backdrop")) return;
  
    document.body.classList.add("backdrop-show");
  
    const backdrop = document.createElement("div");
    if (workspace) {
      backdrop.setAttribute("class", "backdrop backdrop_workspace");
    } else {
      backdrop.setAttribute("class", "backdrop");
    }
  
    document.body.appendChild(backdrop);
    backdrop.classList.add("active");
};
  
// Hide Backdrop
export const hideBackdrop = () => {
    backdropToRemove = document.querySelector(".backdrop");
  
    if (!backdropToRemove) return;
  
    document.body.classList.remove("backdrop-show");
  
    backdropToRemove.classList.remove("active");
    document.body.removeChild(backdropToRemove);
};
