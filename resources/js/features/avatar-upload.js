// const forms = document.querySelectorAll("form");

// forms.forEach(form => {
//     const avatar = form.querySelector("input[name='avatar']");

//     if (avatar) {

//     }
// });

import { on } from '../helpers';

document.addEventListener('DOMContentLoaded', () => {
    on("form", "change", "[name='avatar']", (event, parent) => {
        const image = parent.querySelector('[data-avatar-img]');
        const file = event.target.files[0];

        console.log(image.previousElementSibling)

        if (!file) {
            image.previousElementSibling.classList.remove('hidden');
            image.classList.add('hidden');
            return;
        }

        if (file.type.match(/image.*/)) {
            image.file = file;

            const reader = new FileReader();
            reader.onload = (function(img) { 
                return function(e) { 
                    img.src = e.target.result; 
                }; 
            })(image);
            reader.readAsDataURL(file);

            image.previousElementSibling.classList.add('hidden');
            image.classList.remove('hidden');
        }
    });
})
