document.getElementById('go-to-login').addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector('.page-flip').style.animation = 'flip-page 1s forwards';
    document.getElementById('login-form').style.display = 'none'; 
    document.getElementById('register-form').style.display = 'flex'; 
    document.querySelector('.welcome-message').innerHTML = 'Witaj, czytelniku!';
    document.querySelector('.welcome-message').style.animation = 'fadeIn 1s forwards';
    document.querySelector('.password-requirements').innerHTML = 'Wymagania hasła: 8+ znaków, wielkie litery, cyfry';
    document.querySelector('.password-requirements').style.animation = 'fadeIn 1s 1s forwards';
});

document.getElementById('go-to-register').addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector('.page-flip').style.animation = 'flip-page-reverse 1s forwards'; 
    document.getElementById('register-form').style.display = 'none';
    document.getElementById('login-form').style.display = 'flex'; 
    document.querySelector('.welcome-message').innerHTML = 'Witaj, Panie/Pani!';
    document.querySelector('.welcome-message').style.animation = 'fadeIn 1s forwards';
    document.querySelector('.welcome-image').style.animation = 'fadeIn 1s 1s forwards';
});
