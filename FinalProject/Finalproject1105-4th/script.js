const pageLoad = () => {
    const wrapper = document.querySelector(".wrapper");
    const carousel = document.querySelector(".carousel");
    const arrowBtns = document.querySelectorAll(".wrapper i");
    const firstCardWidth = carousel.querySelector(".card").offsetWidth;
    const carouselChildrens = [...carousel.children];

    let isDragging = false, startX, startScrollLeft, timeoutId;

    let cardPerView = Math.round(carousel.offsetWidth / firstCardWidth);

    carouselChildrens.slice(-cardPerView-2).reverse().forEach(card => {
        carousel.insertAdjacentHTML("afterbegin", card.outerHTML);
    });

    carouselChildrens.slice(0, cardPerView+3).forEach(card => {
        carousel.insertAdjacentHTML("beforeend", card.outerHTML);
    });


    arrowBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            carousel.scrollLeft += btn.id === "left" ? -firstCardWidth : firstCardWidth;
        });
    });

    const dragStart = (e) => {
        isDragging = true;
        carousel.classList.add("dragging");
        startX = e.pageX;
        startScrollLeft = carousel.scrollLeft;
    }

    const dragging = (e) => {
        if (!isDragging) return;
        carousel.scrollLeft = startScrollLeft - (e.pageX - startX); // Corrected e.pageX
    }

    const dragStop = () => {
        isDragging = false;
        carousel.classList.remove("dragging"); // Corrected "dragging"
    }

    const autoplay = () => {
        if(window.innerWidth < 800) return;
        timeoutId = setTimeout(() => carousel.scrollLeft +=  firstCardWidth, 2500);
    }
    autoplay();


    const infiniteScroll = () => {
        if(carousel.scrollLeft === 0) {
            carousel.classList.add("no-transition");
            carousel.scrollLeft = carousel.scrollWidth - (2 * carousel.offsetWidth);
            carousel.classList.remove("no-transition");

        }
        else if(Math.ceil(carousel.scrollLeft) === carousel.scrollWidth - carousel.offsetWidth){
            carousel.classList.add("no-transition");
            carousel.scrollLeft = carousel.offsetWidth;
            carousel.classList.remove("no-transition");
        }
        clearTimeout(timeoutId);
        if(!wrapper.matches(":hover")) autoplay();

    }

    carousel.addEventListener("mousedown", dragStart);
    carousel.addEventListener("mousemove", dragging);
    document.addEventListener("mouseup", dragStop);
    carousel.addEventListener("scroll", infiniteScroll);
    wrapper.addEventListener("mouseenter", () => clearTimeout(timeoutId));
    wrapper.addEventListener("mouseleave", autoplay);

}
window.onbeforeunload = function () {
    window.scrollTo(0, 0);
};
window.onload = pageLoad;


