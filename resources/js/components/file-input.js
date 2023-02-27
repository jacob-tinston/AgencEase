import {on} from '../helpers';

const customFileInput = () => {
    on("body", "change", 'input[type="file"]', (event) => {
        const filename = event.target.value.split("\\").pop();
        event.target.parentNode.querySelector(".file-name").innerHTML = filename;
    });
};

export default customFileInput;
