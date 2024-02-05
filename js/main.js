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
