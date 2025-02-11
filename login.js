document.getElementById('go-to-login').addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('nowy').style.display  = 'none';
    document.getElementById('stary').style.display = 'block';
    document.getElementById('password-requirements').style.display  = 'none';
    document.querySelector('.page-flip').style.animation = 'flip-page 1s forwards';
    document.getElementById('login-form').style.display = 'none'; 
    document.getElementById('register-form').style.display = 'flex';
});

document.getElementById('go-to-register').addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('stary').style.display = 'none';
    document.getElementById('nowy').style.display = 'block';
    document.getElementById('password-requirements').style.display  = 'block';
    document.querySelector('.page-flip').style.animation = 'flip-page-reverse 1s forwards'; 
    document.getElementById('register-form').style.display = 'none';
    document.getElementById('login-form').style.display = 'flex'; 
});

document.getElementById('logo2').addEventListener('click', function () {
    window.location.href = 'warunki.html'; // Przekierowanie do warunki.html po kliknięciu
});

document.getElementById('password-reg').addEventListener('input', function () {
    const password = document.getElementById('password-reg').value;
    const length = document.getElementById('length');
    const uppercase = document.getElementById('uppercase');
    const number = document.getElementById('number');
    const special = document.getElementById('special');

    // Funkcja do dodawania efektu animacji
    function addAnimation(element, status) {
        if (status) {
            element.classList.remove('invalid');
            element.classList.add('valid');
            element.style.animation = 'glow 1s ease-in-out infinite'; // Efekt błyszczenia
        } else {
            element.classList.remove('valid');
            element.classList.add('invalid');
            element.style.animation = 'none'; // Usunięcie animacji
        }
    }

    // Sprawdzanie długości hasła
    if (password.length >= 8) {
        addAnimation(length, true);
    } else {
        addAnimation(length, false);
    }

    // Sprawdzanie, czy hasło zawiera dużą literę
    if (/[A-Z]/.test(password)) {
        addAnimation(uppercase, true);
    } else {
        addAnimation(uppercase, false);
    }

    // Sprawdzanie, czy hasło zawiera cyfrę
    if (/\d/.test(password)) {
        addAnimation(number, true);
    } else {
        addAnimation(number, false);
    }

    // Sprawdzanie, czy hasło zawiera znak specjalny
    if (/[!@#$%^&*]/.test(password)) {
        addAnimation(special, true);
    } else {
        addAnimation(special, false);
    }

    // Włączanie lub wyłączanie przycisku 'Register'
    if (password.length >= 8 && /[A-Z]/.test(password) && /\d/.test(password) && /[!@#$%^&*]/.test(password)) {
        document.getElementById('tak').disabled = false;
    } else {
        document.getElementById('tak').disabled = true;
    }
});
