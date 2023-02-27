const sortable = () => {
    let element = null;

    element = document.getElementById("sortable-style-1");
    if (element) {
        const sortable = Sortable.create(element, {
        animation: 150,
        });
    }

    element = document.getElementById("sortable-style-2");
    if (element) {
        const sortable = Sortable.create(element, {
        handle: ".handle",
        animation: 150,
        });
    }

    element = document.getElementById("sortable-style-3");
    if (element) {
        const sortable = Sortable.create(element, {
        animation: 150,
        });
    }
}

export default sortable;
