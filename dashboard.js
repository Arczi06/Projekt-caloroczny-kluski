// Witaj użytkowniku
const userName = document.querySelector('.user-name');
userName.addEventListener('animationend', () => {
    userName.style.opacity = 1; // Ustawiamy pełną widoczność po zakończeniu animacji powitania
});

// Dodaj animacje powitania dla avataru
const avatar = document.querySelector('.user-avatar');
avatar.addEventListener('animationiteration', () => {
    avatar.style.transform = 'scale(1)'; // Resetowanie animacji avataru po każdej iteracji
});
