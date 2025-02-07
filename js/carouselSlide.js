//Created by Ganamukkula
let slideIndex = 0;

function showSlide(event) {
    const card = event.target.closest('.card');
    const slides = card.querySelectorAll('.carousel img');
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = 'none';
    }
    if (slideIndex >= slides.length) {
        slideIndex = 0;
    }
    if (slideIndex < 0) {
        slideIndex = slides.length - 1;
    }
    slides[slideIndex].style.display = 'block';
}

// Define nextSlide function
function nextSlide(event) {
    slideIndex++;
    showSlide(event);
}

// Define prevSlide function
function prevSlide(event) {
    slideIndex--;
    showSlide(event);
}

window.addEventListener('load', function() {
    // Select all previous buttons and add event listeners
    document.querySelectorAll('.prev').forEach(button => {
        button.addEventListener('click', prevSlide);
    });

    // Select all next buttons and add event listeners
    document.querySelectorAll('.next').forEach(button => {
        button.addEventListener('click', nextSlide);
    });

    // Call showSlide function initially for each card
    document.querySelectorAll('.card').forEach(card => {
        showSlide({ target: card.querySelector('.prev') }); // Pass the previous button as the event target
    });
});
