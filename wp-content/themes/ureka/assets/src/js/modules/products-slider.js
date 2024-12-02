import Swiper from 'swiper';
import {Autoplay, Navigation, EffectFade} from 'swiper/modules';

Swiper.use([Autoplay, Navigation, EffectFade]);
const productsSlider = () => {

    const slider = document.querySelector('.products-carousel');

    new Swiper(slider, {
        slidesPerView: 4,
        loop: true,
        resizeObserver: true,
        keyboard: true,
        observer: true,
        enabled: true,
        spaceBetween: 35,
        navigation: {
            nextEl: document.querySelector('.products-carousel-nav-right'),
            prevEl: document.querySelector('.products-carousel-nav-left'),
        },
    });
}
export default productsSlider();
