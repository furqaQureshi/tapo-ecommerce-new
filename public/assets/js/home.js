/*----------------------------------------------------------------------------------- 

------------------------------------------------------
   CSS INDEX
-----------------------------------------------------

    # Components
        # Base CSS
        # Common CSS
        # Preloader CSS
        # Offcanvas CSS
        # Animation CSS
        # Button CSS
        # Header CSS
        # Footer CSS
-------------------------------------------------------    */

(function($) {
    'use strict';

    // Bistly Food Item

    const elements = $('.bistly-food-item');
    setTimeout(() => {
        elements.each(function() {
            const element = $(this);
            const image = element.find('.hover-image');

            element.mouseenter(function() {
                gsap.to(image, {delay: 0, duration: 0, autoAlpha: 1});
            });

            element.mouseleave(function() {
                gsap.to(image, {delay: 0, duration: 0, autoAlpha: 0});
            });

            element.mousemove(function(e) {
                const contentBox = element[0].getBoundingClientRect();
                const dx = e.clientX - contentBox.x;
                const dy = e.clientY - contentBox.y;

                gsap.set(image, {delay: 0, duration: 0, x: dx, y: dy});
            });
        });
    }, 100);

    // ===== Slick Slider

    if ($('.home-gallery-slider').length) {
        $('.home-gallery-slider').slick({
            dots: false,
            arrows: false,
            infinite: true,
            speed: 600,
            autoplay: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 500,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
    }
    if ($('.testimonial-slider').length) {
        $('.testimonial-slider').slick({
            dots: false,
            arrows: true,
            infinite: true,
            speed: 900,
            autoplay: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><i class="far fa-angle-left"></i></div>',
            nextArrow: '<div class="next"><i class="far fa-angle-right"></i></div>',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        arrows: false,
                    }
                }
            ]
        });
    }
    if ($('.instagram-slider').length) {
        $('.instagram-slider').slick({
            dots: false,
            arrows: false,
            infinite: true,
            speed: 6000,
            autoplaySpeed: 0,
            autoplay: true,
            slidesToShow: 5,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><i class="far fa-arrow-left"></i></div>',
            nextArrow: '<div class="next"><i class="far fa-arrow-right"></i></div>'
        });
    }
    // ===== Slick Slider
    if ($('.menu-slider').length) {
        $('.menu-slider').slick({
            dots: false,
            arrows: true,
            infinite: true,
            speed: 600,
            autoplay: true,
            slidesToShow: 5,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1450,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 650,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
    }

})(window.jQuery);