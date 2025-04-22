document.addEventListener("DOMContentLoaded", function () {
  let lastScrollY = window.scrollY;
  const header = document.querySelector("header");

  window.addEventListener("scroll", function () {
      if (window.scrollY > lastScrollY) {
          // Скроллим вниз – скрываем хедер
          header.classList.add("hidden");
      } else {
          // Скроллим вверх – показываем хедер
          header.classList.remove("hidden");
      }
      lastScrollY = window.scrollY;

      // Затемняем хедер при прокрутке
      if (window.scrollY > 50) {
          header.classList.add("scrolled");
      } else {
          header.classList.remove("scrolled");
      }
  });
});
