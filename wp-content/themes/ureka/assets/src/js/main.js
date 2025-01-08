
import './scripts';
import {productsSlider} from './modules/products-slider';
import {testimonialsSlider} from './modules/testimonials-slider';
import {interactiveUaMap} from './modules/interactive-ua-map';
import {customSelect, eventClickCustomSelect} from "./modules/custom-select";
jQuery(document).ready(function (){
});
document.addEventListener('DOMContentLoaded', () => {



    const langSwitcherSelects = document.querySelectorAll('.ureka-lang-switcher');
    langSwitcherSelects.forEach((select) => {
        customSelect(select, ['ureka-lang-switcher-container', 'rd-navbar-search_collapsable']);
    });
    if (document.querySelector(".ureka-custom-select")) {
        eventClickCustomSelect();
    }
    if (document.querySelector('.products-slider')) {
        productsSlider;
    }
    if (document.querySelector('.testimonials__slider')) {
        testimonialsSlider;
    }
    if (document.querySelector('.ua-map')) {
        interactiveUaMap;
    }

});
