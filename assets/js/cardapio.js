const carousel = document.querySelector('.carousel');
const inner = carousel.querySelector('.carousel-inner');
const prevBtn = carousel.querySelector('.prev');
const nextBtn = carousel.querySelector('.next');

let slideIndex = 0;
const totalSlides = inner.children.length;
const slidesToShow = 1; // Define quantos slides são exibidos por vez

prevBtn.addEventListener('click', () => {
    if (slideIndex > 0) {
        slideIndex--;
        updateSlidePosition();
    }
});

nextBtn.addEventListener('click', () => {
    if (slideIndex < totalSlides - slidesToShow) {
        slideIndex++;
        updateSlidePosition();
    }
});

function updateSlidePosition() {
    const slideWidth = carousel.offsetWidth;
    inner.style.transform = `translateX(${-slideWidth * slideIndex}px)`;
}