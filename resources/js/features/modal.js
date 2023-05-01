import {on, animateCSS, showBackdrop, hideBackdrop} from '../helpers';

document.addEventListener('DOMContentLoaded', () => {
  // Show
  const showModal = (modal) => {
    showBackdrop();
    modal.classList.add("active");
    const animation = modal.dataset.animations.split(", ")[0];
    const modalContent = modal.querySelector(".modal-content");
    animateCSS(modalContent, animation);

    modal.addEventListener("click", (event) => {
      if (modal.dataset.staticBackdrop !== undefined) return;
      if (modal !== event.target) return;
      closeModal(modal);
    });
  };

  // Close
  const closeModal = (modal) => {
    hideBackdrop();
    const animation = modal.dataset.animations.split(", ")[1];
    const modalContent = modal.querySelector(".modal-content");
    animateCSS(modalContent, animation).then(() => {
      modal.classList.remove("active");
    });
  };

  on("body", "click", '[data-toggle="modal"]', (event) => {
    const modalTrigger = event.target.closest('[data-toggle="modal"]');
    const modal = document.querySelector('.' + modalTrigger.dataset.toggle);
    showModal(modal);
  });

  on(".modal", "click", '[data-dismiss="modal"]', (event) => {
    const modal = event.target.closest(".modal");
    closeModal(modal);
  });
})
