import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    const showNavButton = document.getElementById('showNavButton');
    const hideNavButton = document.getElementById('hideNavButton');
    const sidebar = document.getElementById('sidebar');

    showNavButton.addEventListener('click', function() {
        sidebar.classList.remove('-translate-x-full');
        showNavButton.style.display = 'none';
        hideNavButton.style.display = 'block';
    });

    hideNavButton.addEventListener('click', function() {
        sidebar.classList.add('-translate-x-full');
        hideNavButton.style.display = 'none';
        showNavButton.style.display = 'block';
    });

    hideNavButton.style.display = 'none';
});
