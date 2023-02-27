const carousel = () => {
    const carousel = document.getElementById("carousel-style-1");

    if (carousel) {
        const dir = () => {
        if (document.dir == "rtl") {
            return "rtl";
        } else {
            return "ltr";
        }
        };

        new Glide(carousel, {
        direction: dir(),
        type: "carousel",
        perView: 4,
        gap: 20,
        breakpoints: {
            640: {
            perView: 1,
            },
            768: {
            perView: 2,
            },
        },
        }).mount();
    }
}

export default carousel;
