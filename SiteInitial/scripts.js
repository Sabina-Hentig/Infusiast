
$(document).ready(function() {
    let slideIndex = 0;
    const slides = $(".slides img");
    const totalSlides = slides.length;

    function showSlides(n) {
        if (n >= totalSlides) {
            slideIndex = 0;
        } else if (n < 0) {
            slideIndex = totalSlides - 1;
        }
        slides.hide();
        slides.eq(slideIndex).show();
    }

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    $(".prev").click(function() {
        plusSlides(-1);
    });

    $(".next").click(function() {
        plusSlides(1);
    });

    // Initialize the slider
    showSlides(slideIndex);
});
