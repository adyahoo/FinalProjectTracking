import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

const swiper = new Swiper('.swiper', {
    direction: 'horizontal',
    loop: true,

    pagination: {
        el: '.swiper-pagination',
    },
    
      // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    
      // And if we need scrollbar
    scrollbar: {
        el: '.swiper-scrollbar',
    },
});