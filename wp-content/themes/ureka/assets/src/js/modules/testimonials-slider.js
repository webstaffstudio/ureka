import Swiper from 'swiper';
import {Autoplay, Navigation, EffectFade} from 'swiper/modules';

Swiper.use([Autoplay, Navigation, EffectFade]);
const testimonialsSlider = () => {

    const slider = document.querySelector('.testimonials__slider');

    new Swiper(slider, {
        slidesPerView: 2,
        loop: true,
        resizeObserver: true,
        keyboard: true,
        observer: true,
        enabled: true,
        spaceBetween: 20,
        navigation: {
            nextEl: document.querySelector('.products-carousel-nav-right'),
            prevEl: document.querySelector('.products-carousel-nav-left'),
        },
    });
}
export default testimonialsSlider();
