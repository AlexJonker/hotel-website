document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelectorAll('.slideshow-slide');
    let current = 0;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            if (i === index) {
                slide.style.display = '';
            } else {
                slide.style.display = 'none'; // Verstop de andere afbeeldingen
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