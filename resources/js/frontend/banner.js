// import Swiper bundle with all modules installed
import Swiper from 'swiper/bundle';
 
// import styles bundle
import 'swiper/css/bundle';

var swiper = new Swiper('.swiper-banner-container',{
    direction: 'horizontal',
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
});
