
document.querySelectorAll('.house-link').forEach(link => {
    link.addEventListener('click', function() {
        document.querySelectorAll('.house-link').forEach(el => el.classList.remove('active'));
        this.classList.add('active');
    });
});