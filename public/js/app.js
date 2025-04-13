var partnerSwiper = new Swiper(".partnerswiper", {
    slidesPerView: 2,
    speed: 1500,
    loop: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    autoplay: true,
    breakpoints: {
        1100: {
            slidesPerView: 6,
        },

        900: {
            slidesPerView: 4,
        },

        576: {
            slidesPerView: 3,
        },
    },
});