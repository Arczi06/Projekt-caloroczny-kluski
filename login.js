document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('go-to-login').addEventListener('click', function (e) {
        e.preventDefault();
        document.getElementById('nowy').style.display  = 'none';
        document.getElementById('stary').style.display = 'block';
        document.getElementById('password-requirements').style.display  = 'none';
        document.querySelector('.page-flip').style.animation = 'flip-page 1s forwards';
        document.getElementById('login-form').style.display = 'none'; 
        document.getElementById('register-form').style.display = 'flex';
        resetRoleSelection();
    });

    document.getElementById('go-to-register').addEventListener('click', function (e) {
        e.preventDefault();
        document.getElementById('stary').style.display = 'none';
        document.getElementById('nowy').style.display = 'block';
        document.getElementById('password-requirements').style.display  = 'block';
        document.querySelector('.page-flip').style.animation = 'flip-page-reverse 1s forwards'; 
        document.getElementById('register-form').style.display = 'none';
        document.getElementById('login-form').style.display = 'flex'; 
        resetRoleSelection();
    });

    document.getElementById('logo2').addEventListener('click', function () {
        window.location.href = 'warunki.html';
    });

    document.getElementById('password-reg').addEventListener('input', function () {
        const password = this.value;
        const requirements = {
            length: password.length >= 8,
            uppercase: /[A-Z]/.test(password),
            number: /\d/.test(password),
            special: /[!@#$%^&*]/.test(password)
        };

        Object.entries(requirements).forEach(([key, isValid]) => {
            const element = document.getElementById(key);
            element.classList.toggle('valid', isValid);
            element.classList.toggle('invalid', !isValid);
            element.style.animation = isValid ? 'glow 1s ease-in-out infinite' : 'none';
        });

        document.getElementById('tak').disabled = !Object.values(requirements).every(Boolean);
    });

    const roleToggle = document.getElementById("roleToggle");
    const roleDropdown = document.getElementById("roleDropdown");
    const roleBtns = document.querySelectorAll(".role-btn");
    const selectedRole = document.getElementById("selectedRole");
    const roleInput = document.getElementById("roleInput");

    roleToggle.addEventListener("click", function (event) {
        event.preventDefault();
        event.stopPropagation();
        roleDropdown.classList.toggle("hidden");
    });

    roleBtns.forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            selectedRole.innerText = this.innerText;
            roleInput.value = this.getAttribute("data-role");
            roleDropdown.classList.add("hidden");
        });
    });

    document.addEventListener("click", function (event) {
        if (!roleToggle.contains(event.target) && !roleDropdown.contains(event.target)) {
            roleDropdown.classList.add("hidden");
        }
    });

    function resetRoleSelection() {
        selectedRole.innerText = "Wybierz rolę";
        roleInput.value = "";
        roleDropdown.classList.add("hidden");
    }
});
