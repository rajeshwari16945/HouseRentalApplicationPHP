//Created By Ganamukkula

window.addEventListener('load', function() {
    document.getElementById('back-button').addEventListener('click', function() { 
      let previousPath = document.referrer;
      console.log("Previous path: " + previousPath);
      window.location.href = previousPath;
    });
    const carouselInner = document.querySelector('.carousel-inner');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');
    const slides = carouselInner.children;
    const totalSlides = slides.length;
    let currentIndex = 0;
    const visibleSlides = 2;
  
    function showSlide() {
      const start = currentIndex;
      const end = Math.min(currentIndex + visibleSlides, totalSlides);
      for (let i = 0; i < totalSlides; i++) {
        slides[i].style.display = 'none';
      }
      for (let i = start; i < end; i++) {
        slides[i].style.display = 'block';
      }
    }
  
    function nextSlide() {
      currentIndex = (currentIndex + visibleSlides) % totalSlides;
      showSlide();
    }
  
    function prevSlide() {
      currentIndex = (currentIndex - visibleSlides + totalSlides) % totalSlides;
      showSlide();
    }
  
    prevBtn.addEventListener('click', prevSlide);
    nextBtn.addEventListener('click', nextSlide);
  
    showSlide(); // Show initial set of slides
  });
  