document.addEventListener("DOMContentLoaded", () => {
    const profileImage = document.querySelector(".profile-img");
    const profileHeader = document.querySelector(".profile-header");
    const profileContainer = document.querySelector(".profile-container");

    profileImage.addEventListener("load", () => {
        profileImage.classList.add("loaded");
    });

    setTimeout(() => {
        profileImage.classList.add("loaded");
        profileHeader.classList.add("fadeIn");
        profileContainer.classList.add("fadeIn");
    }, 100);

    const backButton = document.querySelector('.btn-back');
    backButton.addEventListener('click', () => {
        document.body.style.backgroundColor = '#34495e';
    });
});
