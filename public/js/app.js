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


var partnerSwiper = new Swiper(".topsellerswiper", {
    slidesPerView: 3,
    speed: 1500,
    loop: true,
    spaceBetween: 5,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    autoplay: true,
    breakpoints: {
        1100: {
            slidesPerView: 3.5,
        },

        900: {
            slidesPerView: 2.5,
        },

        576: {
            slidesPerView: 2,
        },
    },
});