// Funkcja obsługująca zmianę strony na rejestrację
document.getElementById('go-to-login').addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector('.page-flip').style.animation = 'flip-page 1s forwards'; // Przewrócenie kartki na stronę rejestracji
    document.getElementById('login-form').style.display = 'none'; // Ukrycie formularza logowania
    document.getElementById('register-form').style.display = 'flex'; // Pokazanie formularza rejestracji

    // Sprawdzanie, czy zakrywa stronę rejestracji, jeśli tak, wyświetlamy powitanie
    document.querySelector('.welcome-message').innerHTML = 'Witaj, czytelniku!';
    document.querySelector('.welcome-message').style.animation = 'fadeIn 1s forwards';
    document.querySelector('.password-requirements').innerHTML = 'Wymagania hasła: 8+ znaków, wielkie litery, cyfry';
    document.querySelector('.password-requirements').style.animation = 'fadeIn 1s 1s forwards';
});

// Funkcja obsługująca zmianę strony na logowanie
document.getElementById('go-to-register').addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector('.page-flip').style.animation = 'flip-page-reverse 1s forwards'; // Cofnięcie animacji na stronę logowania
    document.getElementById('register-form').style.display = 'none'; // Ukrycie formularza rejestracji
    document.getElementById('login-form').style.display = 'flex'; // Pokazanie formularza logowania

    // Sprawdzanie, czy zakrywa formularz logowania, jeśli tak, wyświetlamy powitanie
    document.querySelector('.welcome-message').innerHTML = 'Witaj, Panie/Pani!';
    document.querySelector('.welcome-message').style.animation = 'fadeIn 1s forwards';
    document.querySelector('.welcome-image').style.animation = 'fadeIn 1s 1s forwards';
});
