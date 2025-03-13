const menuToggle = document.getElementById('menu-toggle');
const navMenu = document.querySelector('nav ul');

menuToggle.addEventListener('change', function () {
    if (this.checked) {
        navMenu.style.maxHeight = '500px'; // Rozwiń menu
        navMenu.style.display = 'flex';
    } else {
        navMenu.style.maxHeight = '0'; // Zwiń menu
        navMenu.style.display = 'none';
    }
});
