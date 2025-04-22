document.addEventListener("DOMContentLoaded", function () {
  const slides = document.querySelectorAll(".slide");
  const prevBtn = document.querySelector(".prev-btn");
  const nextBtn = document.querySelector(".next-btn");
  let currentSlide = 0;

  function showSlide(index) {
      slides.forEach((slide, i) => {
          slide.classList.toggle("active", i === index);
      });
  }

  prevBtn.addEventListener("click", () => {
      currentSlide = (currentSlide === 0) ? slides.length - 1 : currentSlide - 1;
      showSlide(currentSlide);
  });

  nextBtn.addEventListener("click", () => {
      currentSlide = (currentSlide === slides.length - 1) ? 0 : currentSlide + 1;
      showSlide(currentSlide);
  });

  showSlide(currentSlide); // Показываем первый слайд
});
