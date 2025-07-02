document.addEventListener('DOMContentLoaded', function () {
  const swiper = new Swiper('.bookshelf-swiper', {
    loop: true,
    slidesPerView: 2,
    spaceBetween: 30,
    breakpoints: {
      768: {
        slidesPerView: 3,
      },
      980: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
    },
    speed: 3000,
    autoplay: {
      delay: 1000,
      disableOnInteraction: false,
      pauseOnMouseEnter: true,
    },
    navigation: {
      nextEl: '.bookshelf-container .swiper-button-next',
      prevEl: '.bookshelf-container .swiper-button-prev',
    },
  });

  // ★ ナビゲーションボタンが押された時だけ speed を変更
  const nextBtn = document.querySelector('.bookshelf-container .swiper-button-next');
  const prevBtn = document.querySelector('.bookshelf-container .swiper-button-prev');

  const fastSpeed = 500;
  const slowSpeed = 3000;

  function moveNext() {
    swiper.params.speed = fastSpeed;
    swiper.slideNext();
    resetSpeed();
  }

  function movePrev() {
    swiper.params.speed = fastSpeed;
    swiper.slidePrev();
    resetSpeed();
  }

  function resetSpeed() {
    // 少し待って元のスピードに戻す（自動再生用）
    setTimeout(() => {
      swiper.params.speed = slowSpeed;
    }, fastSpeed + 100); // 少し余裕を持って
  }

  if (nextBtn && prevBtn) {
    nextBtn.addEventListener('click', moveNext);
    prevBtn.addEventListener('click', movePrev);
  }
});
