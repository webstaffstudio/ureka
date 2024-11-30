import $utils, { Utils } from './welcome-slider'

document.addEventListener('DOMContentLoaded', () => {
    const element = $utils('#myElement');
    if (element.hasClass('active')) {
        element.removeClass('active').addClass('inactive');
    }

    element.on('click', () => {
        console.log('Element clicked!');
    });

    console.log(`Height: ${element.height()}px`);
});
