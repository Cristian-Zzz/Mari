
// Seleccionamos el botón de hamburguesa y la lista de navegación
const hamburger = document.querySelector('.hamburger-menu');
const navLinks = document.querySelector('.nav-links');

// Cuando se hace click en la hamburguesa
hamburger.addEventListener('click', () => {
  // Alterna la clase 'active' en ambos
  hamburger.classList.toggle('active');
  navLinks.classList.toggle('active');
});

