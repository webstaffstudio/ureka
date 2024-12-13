import Swiper from 'swiper';
import {Navigation, EffectFade} from 'swiper/modules';

Swiper.use([ Navigation, EffectFade]);
const productsSlider = () => {

    const slider = document.querySelector('.products-carousel');

    new Swiper(slider, {
        slidesPerView: 1,
        loop: true,
        resizeObserver: true,
        keyboard: true,
        observer: true,
        enabled: true,
        spaceBetween: 35,
        breakpoints: {
            1200: {
                slidesPerView: 4,
            },
            767: {
                slidesPerView: 2,
            },
        },
        navigation: {
            nextEl: document.querySelector('.testimonials__slider .slider-ureka-nav-right'),
            prevEl: document.querySelector('.testimonials__slider .slider-ureka-nav-left'),
        },
    });
}
export default productsSlider();
