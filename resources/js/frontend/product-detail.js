// import Swiper bundle with all modules installed
import Swiper from 'swiper/bundle';
 
// import styles bundle
import 'swiper/css/bundle';


let pd_slider = new Swiper ('.product_detail--gallery-slider', {
    slidesPerView: 1,
    centeredSlides: true,
    loopedSlides: 6, 
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});


let pd_thumbs = new Swiper ('.product_detail--gallery-thumbs', {
    slidesPerView: 'auto',
    spaceBetween: 10,
    centeredSlides: true,
    slideToClickedSlide: true,
});

pd_slider.controller.control = pd_thumbs;
pd_thumbs.controller.control = pd_slider;