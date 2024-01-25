// pjesa e butonit hamburger per responsivity
document.addEventListener("DOMContentLoaded", function () {
  // Your existing code here
  const hamburger = document.querySelector(".hamburger");
  const navMenu = document.querySelector(".nav-menu");
  const closeIcon = document.querySelector(".close-menu");

  hamburger.addEventListener("click", () => {
    ndryshoMenu();
  });

  closeIcon.addEventListener("click", () => {
    ndryshoMenu();
  });

  document.querySelectorAll(".nav-link").forEach(n => n.addEventListener("click", () => {
    ndryshoMenu();
  }));

  function ndryshoMenu() {
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
  }
});


const slider = document.querySelector('.slider');
const prevBtn = document.querySelector('.prev');
const nextBtn = document.querySelector('.next');
let currentPosition = 0;
const step = 600;

function moveSlider(direction) {
  if (direction === 'prev') {
  currentPosition += step;
  } else {
  currentPosition -= step;
  }
  slider.style.left = currentPosition + 'px';
  }

  prevBtn.addEventListener('click', function() {
    moveSlider('prev');
    });
    nextBtn.addEventListener('click', function() {
    moveSlider('next');
    });
