
import './scripts';
import {productsSlider} from './modules/products-slider';
import {testimonialsSlider} from './modules/testimonials-slider';
jQuery(document).ready(function (){
});
document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('.products-slider')) {
        productsSlider;
    }
    if (document.querySelector('.testimonials__slider')) {
        testimonialsSlider;
    }
});
