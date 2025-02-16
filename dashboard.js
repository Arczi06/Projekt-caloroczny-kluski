const userName = document.querySelector('.user-name');
userName.addEventListener('animationend', () => {
    userName.style.opacity = 1;
});

const avatar = document.querySelector('.user-avatar');
avatar.addEventListener('animationiteration', () => {
    avatar.style.transform = 'scale(1)';
});
