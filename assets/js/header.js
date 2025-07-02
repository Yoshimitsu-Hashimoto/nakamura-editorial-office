const header = document.querySelector('.header');

window.addEventListener('scroll', () => {
  const scrollY = window.scrollY;

  header.classList.remove('is-none', 'is-scroll'); // 一旦すべてリセット

  if (scrollY > 200 && scrollY <= 400) {
    header.classList.add('is-none');
  } else if (scrollY > 400) {
    header.classList.add('is-scroll');
  }
});

// メニュー開閉
const menuButton = document.querySelector(".menu-button-sp");
  const menu = document.querySelector(".menu");

  menuButton.addEventListener("click", function () {
    menu.classList.toggle("is-open");
  });
