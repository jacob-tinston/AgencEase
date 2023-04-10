import {on} from '../helpers';

const toggleShowPassword = (showPasswordBtn) => {
    const password = showPasswordBtn.closest(".form-control-addon-within").querySelector("input");

    password.type = password.type == 'password' ? 'text' : 'password';
};

document.addEventListener('DOMContentLoaded', () => {
    on("body", "click", '[data-toggle="password-visibility"]', (event) => {
        const showPasswordBtn = event.target.closest(
            '[data-toggle="password-visibility"]'
        );
        
        toggleShowPassword(showPasswordBtn);
    });
})
