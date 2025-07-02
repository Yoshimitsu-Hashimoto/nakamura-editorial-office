// interview-famous.js
document.addEventListener('DOMContentLoaded', function () {
const swiper = new Swiper('.interview-swiper', {
  direction: 'vertical',
  loop: true,
slidesPerView: 3,
  speed: 500,
  spaceBetween: 30,
  navigation: {
      nextEl: '.interview-content .swiper-button-next',
      prevEl: '.interview-content .swiper-button-prev',
    },
});

});
