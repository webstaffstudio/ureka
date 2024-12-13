import Swiper from 'swiper';
import {Navigation, Pagination} from 'swiper/modules';

Swiper.use([Navigation, Pagination,]);

const testimonialsSlider = () => {
    const slider = document.querySelector('.testimonials__slider');

    new Swiper(slider, {
        slidesPerView: 1,
        loop: false,
        resizeObserver: true,
        keyboard: true,
        spaceBetween: 30,
        navigation: {
            nextEl: '.slider-ureka-nav-right',
            prevEl: '.slider-ureka-nav-left',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            600: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1200: {
                slidesPerView: 3,
            },
        },

    });
};

export default testimonialsSlider();
