
document.addEventListener("DOMContentLoaded", function() {
    const currentPath = house_warden_all_tickets.php;
    const sidebarLinks = document.querySelectorAll('.sidebar a');

    sidebarLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath.substring(currentPath.lastIndexOf('/'))) {
            link.classList.add('active');
        }
    });
});
