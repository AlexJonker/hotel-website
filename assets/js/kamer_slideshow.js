document.addEventListener("DOMContentLoaded", () => {
  const slides = document.querySelectorAll(".slide-container");
  let current = 0;

  function showSlide(index) {
    slides.forEach((slide, i) => {
      if (i === index) {
        slide.style.display = "";
      } else {
        slide.style.display = "none";
      }
    });
    current = index;
  }

  window.plusSlides = (n) => {
    const next = (current + n + slides.length) % slides.length;
    showSlide(next);
  };

  showSlide(current);
});
