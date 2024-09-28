
// Select all elements with the class 'sidebar-links'
const sidebarLinks = document.querySelectorAll('.sidebar-links');

// Iterate over each 'sidebar-links' element
sidebarLinks.forEach(link => {
    // Add a click event listener to each link
    link.addEventListener('click', function() {
        // Remove the 'active' class from all 'sidebar-links' elements
        sidebarLinks.forEach(el => el.classList.remove('active'));

        // Add the 'active' class to the clicked link
        this.classList.add('active');
    });
});
/* end of effects on side bars */

/* Effects on image carousel */
let slideIndex = 0;
const slides = document.querySelectorAll('.carousel-slide');

document.querySelector('.carousel-prev').addEventListener('click', () => {
    slideIndex = (slideIndex > 0) ? slideIndex - 1 : slides.length - 1;
    updateCarousel();
});

document.querySelector('.carousel-next').addEventListener('click', () => {
    slideIndex = (slideIndex < slides.length - 1) ? slideIndex + 1 : 0;
    updateCarousel();
});

function updateCarousel() {
    const offset = -slideIndex * 100; // Assuming each slide is 100% width
    slides.forEach(slide => {
        slide.style.transform = `translateX(${offset}%)`;
    });
}
/* End of effects on image carousel */