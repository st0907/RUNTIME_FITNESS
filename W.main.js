/*Programmer Name: YEO PEI WEN (TP077057)
Program Name: W.main.js
Description: Homepage for workout page
First Written on: Wednesday, 18-June-2025
Edited on: 08-JULY-2025*/

//Scroll navigation effect//
window.addEventListener('scroll', () => {
  const navbar = document.querySelector('.navbar');
  navbar.style.background = window.scrollY > 50
    ? 'rgba(255, 255, 255, 0.98)'
    : 'rgba(255, 255, 255, 0.95)';
});

// Animate feature cards on scroll
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.style.opacity = 1;
      entry.target.style.transform = 'translateY(0)';
    }
  });
}, { threshold: 0.1 });

document.querySelectorAll('.feature-card').forEach(card => {
  card.style.opacity = 0;
  card.style.transform = 'translateY(30px)';
  card.style.transition = 'all 0.6s ease';
  observer.observe(card);
});
