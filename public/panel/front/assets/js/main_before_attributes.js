(function ($) {
    "use strict";

    const $documentOn = $(document);
    const $windowOn = $(window);

    $documentOn.ready(function () {

        //>> Mobile Menu Js Start <<//
        $('#mobile-menu').meanmenu({
            meanMenuContainer: '.mobile-menu',
            meanScreenWidth: "1199",
            meanExpand: ['<i class="far fa-plus"></i>'],
        });

        //>> Sidebar Toggle Js Start <<//
        $(".offcanvas__close,.offcanvas__overlay").on("click", function () {
            $(".offcanvas__info").removeClass("info-open");
            $(".offcanvas__overlay").removeClass("overlay-open");
        });
        $(".sidebar__toggle").on("click", function () {
            $(".offcanvas__info").addClass("info-open");
            $(".offcanvas__overlay").addClass("overlay-open");
        });

        //>> Body Overlay Js Start <<//
        $(".body-overlay").on("click", function () {
            $(".offcanvas__area").removeClass("offcanvas-opened");
            $(".df-search-area").removeClass("opened");;
            $(".body-overlay").removeClass("opened");
        });

        //>> Sticky Header Js Start <<//

        $windowOn.on("scroll", function () {
            if ($(this).scrollTop() > 250) {
                $("#header-sticky").addClass("sticky");
            } else {
                $("#header-sticky").removeClass("sticky");
            }
        });

        // Sidebar Area Start <<//
        $(".share-btn").on("click", function () {
            var target = $(this).data("target");
            $("#" + target).toggle();
        });
        $("#openButton").on("click", function (e) {
            e.preventDefault();
            $("#targetElement").removeClass("side_bar_hidden");
        });
        $("#openButton2").on("click", function (e) {
            e.preventDefault();
            $("#targetElement").removeClass("side_bar_hidden2");
        });
        $("#closeButton").on("click", function (e) {
            e.preventDefault();
            $("#targetElement").addClass("side_bar_hidden");
        });
        $("#closeButton2").on("click", function (e) {
            e.preventDefault();
            $("#targetElement2").addClass("side_bar_hidden2");
        });

        // Sidebar Area-2 Start <<//
        $(".share-btn").on("click", function () {
            var target = $(this).data("target");
            $("#" + target).toggle();
        });
        $("#openButton2").on("click", function (e) {
            e.preventDefault();
            $("#targetElement2").removeClass("side_bar_hidden2");
        });
        $("#openButton2").on("click", function (e) {
            e.preventDefault();
            $("#targetElement2").removeClass("side_bar_hidden2");
        });
        $("#closeButton2").on("click", function (e) {
            e.preventDefault();
            $("#targetElement2").addClass("side_bar_hidden2");
        });

        //>> Video Popup Start <<//
        $(".img-popup").magnificPopup({
            type: "image",
            gallery: {
                enabled: true,
            },
        });

        $('.video-popup').magnificPopup({
            type: 'iframe',
            callbacks: {
            }
        });

        //>> Counterup Start <<//
        $(".count").counterUp({
            delay: 15,
            time: 4000,
        });

        //>> Wow Animation Start <<//
        new WOW().init();

        //>> Nice Select Start <<//
        // $('select').niceSelect();

        //>> Scrolldown Start <<//
        $("#scrollDown").on("click", function () {
            setTimeout(function () {
                $("html, body").animate({ scrollTop: "+=1000px" }, "slow");
            }, 1000);
        });

        //>> Shop Slider Start <<//
        if ($('.hero-image-slider').length > 0) {
            const heroImageSlider = new Swiper(".hero-image-slider", {
                spaceBetween: 30,
                speed: 1300,
                loop: true,
                navigation: {
                    nextEl: ".array-prev",
                    prevEl: ".array-next",
                },
            });
        }

        //>> Hero-1 Slider Start <<//
        const sliderActive2 = ".hero-slider";
        const sliderInit2 = new Swiper(sliderActive2, {
            loop: false,
            slidesPerView: 1,
            effect: "fade",
            speed: 3000,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".array-prev",
                prevEl: ".array-next",
            },
            pagination: {
                el: ".dot",
                clickable: true,
            },
        });

        function animated_swiper(selector, init) {
            const animated = function animated() {
                $(selector + " [data-animation]").each(function () {
                    let anim = $(this).data("animation");
                    let delay = $(this).data("delay");
                    let duration = $(this).data("duration");
                    $(this)
                        .removeClass("anim" + anim)
                        .addClass(anim + " animated")
                        .css({
                            webkitAnimationDelay: delay,
                            animationDelay: delay,
                            webkitAnimationDuration: duration,
                            animationDuration: duration,
                        })
                        .one("animationend", function () {
                            $(this).removeClass(anim + " animated");
                        });
                });
            };
            animated();
            init.on("slideChange", function () {
                $(sliderActive2 + " [data-animation]").removeClass("animated");
            });
            init.on("slideChange", animated);
        }
        animated_swiper(sliderActive2, sliderInit2);


        if ($('.sub-swiper').length > 0) {
            const shopSlider = new Swiper(".sub-swiper", {
                spaceBetween: 30,
                speed: 1300,
                slidesPerView: 1,
                loop: true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".shop-dot",
                },
            });
        }

        const subswiper = ".sub-swiper";
        const subswiperInit2 = new Swiper(subswiper, {
            loop: false,
            slidesPerView: 1,
            effect: "slide",
            speed: 3000,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".array-prev",
                prevEl: ".array-next",
            },
            pagination: {
                el: ".dot",
                clickable: true,
            },
        });

        //>> Shop Slider Start <<//
        if ($('.shop-slider').length > 0) {
            const shopSlider = new Swiper(".shop-slider", {
                spaceBetween: 30,
                speed: 1300,
                loop: true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".shop-dot",
                },
                breakpoints: {
                    1199: {
                        slidesPerView: 5,
                    },
                    991: {
                        slidesPerView: 4,
                    },
                    767: {
                        slidesPerView: 3,
                    },
                    575: {
                        slidesPerView: 2,
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
            });
        }

        //>> Product Slider Start <<//
        if ($('.product-slider').length > 0) {
            const productSlider = new Swiper(".product-slider", {
                spaceBetween: 30,
                speed: 1300,
                loop: true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".product-dot",
                },
                breakpoints: {
                    1199: {
                        slidesPerView: 4,
                    },
                    991: {
                        slidesPerView: 3,
                    },
                    767: {
                        slidesPerView: 2,
                    },
                    575: {
                        slidesPerView: 2,
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
            });
        }

        //>> Brand Slider Start <<//
        if ($('.brand-slider').length > 0) {
            const brandSlider = new Swiper(".brand-slider", {
                spaceBetween: 30,
                speed: 1300,
                loop: true,
                centeredSlides: true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
                navigation: {
                    prevEl: ".array-prev",
                    nextEl: ".array-next",
                },
                breakpoints: {
                    1199: {
                        slidesPerView: 5,
                    },
                    991: {
                        slidesPerView: 4,
                    },
                    767: {
                        slidesPerView: 3,
                    },
                    575: {
                        slidesPerView: 2,
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
            });
        }

        //>> E-Ticket Slider Start <<//
        if ($('.eticket-slider').length > 0) {
            const eticketSlider = new Swiper(".eticket-slider", {
                spaceBetween: 20,
                speed: 1300,
                loop: true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".array-prev",
                    prevEl: ".array-next",
                },
                breakpoints: {
                    1199: {
                        slidesPerView: 4,
                    },
                    991: {
                        slidesPerView: 3,
                    },
                    767: {
                        slidesPerView: 2,
                    },
                    575: {
                        slidesPerView: 2,
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
            });
        }

        //>> Testimonial Slider Start <<//
        if ($('.nblog-slider').length > 0) {
            const nblogSlider = new Swiper(".nblog-slider", {
                spaceBetween: 20,
                speed: 2000,
                loop: true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".array-prev",
                    prevEl: ".array-next",
                },
                breakpoints: {
                    1199: {
                        slidesPerView: 3,
                    },
                    991: {
                        slidesPerView: 2,
                    },
                    767: {
                        slidesPerView: 1,
                    },
                    575: {
                        slidesPerView: 1,
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
            });
        }

        //>> Testimonial Slider Start <<//
        if ($('.testimonial-slider').length > 0) {
            const testimonialSlider = new Swiper(".testimonial-slider", {
                spaceBetween: 30,
                speed: 2000,
                loop: true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".dot",
                    clickable: true,
                },
                breakpoints: {
                    1199: {
                        slidesPerView: 3,
                    },
                    991: {
                        slidesPerView: 2,
                    },
                    767: {
                        slidesPerView: 1,
                    },
                    575: {
                        slidesPerView: 1,
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
            });
        }

        //>> Testimonial Slider2 Start <<//
        if ($('.testimonial-slider-2').length > 0) {
            const testimonialSlider2 = new Swiper(".testimonial-slider-2", {
                spaceBetween: 30,
                speed: 2000,
                loop: true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".array-prev",
                    prevEl: ".array-next",
                },
                breakpoints: {
                    1199: {
                        slidesPerView: 1,
                    },
                    991: {
                        slidesPerView: 1,
                    },
                    767: {
                        slidesPerView: 1,
                    },
                    575: {
                        slidesPerView: 1,
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
            });
        }

        //>> Testimonial Slider2 Start <<//
        if ($('.testimonial-slider-3').length > 0) {
            const testimonialSlider3 = new Swiper(".testimonial-slider-3", {
                spaceBetween: 30,
                speed: 2000,
                loop: true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
                breakpoints: {
                    1199: {
                        slidesPerView: 3,
                    },
                    991: {
                        slidesPerView: 2,
                    },
                    767: {
                        slidesPerView: 1,
                    },
                    575: {
                        slidesPerView: 1,
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
            });
        }

        //>> Instagram Slider Start <<//
        if ($('.instagram-banner-slider').length > 0) {
            const instagrambannerSlider = new Swiper(".instagram-banner-slider", {
                spaceBetween: 30,
                speed: 2000,
                loop: true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".array-prev",
                    prevEl: ".array-next",
                },
                breakpoints: {
                    1399: {
                        slidesPerView: 6,
                    },
                    1199: {
                        slidesPerView: 5,
                    },
                    991: {
                        slidesPerView: 4,
                    },
                    767: {
                        slidesPerView: 3,
                    },
                    650: {
                        slidesPerView: 2,
                    },
                    575: {
                        slidesPerView: 1,
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
            });
        }

        //>> Instagram Slider Start <<//
        if ($('.instagram-banner-slider-2').length > 0) {
            const instagrambannerSlider2 = new Swiper(".instagram-banner-slider-2", {
                spaceBetween: 30,
                speed: 2000,
                loop: true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
                breakpoints: {
                    1399: {
                        slidesPerView: 5,
                    },
                    1199: {
                        slidesPerView: 4,
                    },
                    991: {
                        slidesPerView: 3,
                    },
                    767: {
                        slidesPerView: 2,
                    },
                    650: {
                        slidesPerView: 2,
                    },
                    575: {
                        slidesPerView: 1,
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
            });
        }
        //>> Category Slider Start <<//
        if ($('.category-slider').length > 0) {
            const categorySlider = new Swiper(".category-slider", {
                spaceBetween: 20,
                speed: 1300,
                loop: true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".array-prev",
                    prevEl: ".array-next",
                },
                breakpoints: {
                    1199: {
                        slidesPerView: 4,
                    },
                    991: {
                        slidesPerView: 3,
                    },
                    767: {
                        slidesPerView: 2,
                    },
                    575: {
                        slidesPerView: 2,
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
            });
        }

        //>> Product Slider Start <<//
        if ($('.product-slider-2').length > 0) {
            const productSlider2 = new Swiper(".product-slider-2", {
                spaceBetween: 30,
                speed: 1300,
                loop: true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".array-prev",
                    prevEl: ".array-next",
                },
                breakpoints: {
                    1199: {
                        slidesPerView: 1,
                    },
                    991: {
                        slidesPerView: 1,
                    },
                    767: {
                        slidesPerView: 1,
                    },
                    575: {
                        slidesPerView: 1,
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
            });
        }

        //>> Product Slider Start <<//
        if ($('.news-slider').length > 0) {
            const newsSlider = new Swiper(".news-slider", {
                spaceBetween: 30,
                speed: 1300,
                loop: true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".array-prev",
                    prevEl: ".array-next",
                },
                breakpoints: {
                    1199: {
                        slidesPerView: 3,
                    },
                    991: {
                        slidesPerView: 2,
                    },
                    767: {
                        slidesPerView: 2,
                    },
                    575: {
                        slidesPerView: 1,
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
            });
        }


        //>> Shop Slider Start <<//
        if ($('.shop-slider-4').length > 0) {
            const shopSlider4 = new Swiper(".shop-slider-4", {
                spaceBetween: 10,
                speed: 1300,
                loop: true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".array-prev",
                    prevEl: ".array-next",
                },
                breakpoints: {
                    1199: {
                        slidesPerView: 3,
                    },
                    991: {
                        slidesPerView: 2,
                    },
                    767: {
                        slidesPerView: 2,
                    },
                    575: {
                        slidesPerView: 2,
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
            });
        }

        //>> Shop Slider Start <<//
        if ($('.sub-slider').length > 0) {
            const discoverSlider = new Swiper(".sub-slider", {
                spaceBetween: 10,
                speed: 1300,
                loop: true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".dot-5",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".array-prev",
                    prevEl: ".array-next",
                },
                breakpoints: {
                    1199: {
                        slidesPerView: 2,
                    },
                    991: {
                        slidesPerView: 2,
                    },
                    767: {
                        slidesPerView: 2,
                    },
                    575: {
                        slidesPerView: 2,
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
            });
        }


        //>> CountDown Start <<//
        let targetDate = new Date("2025-05-8 00:00:00").getTime();
        const countdownInterval = setInterval(function () {
            let currentDate = new Date().getTime();
            let remainingTime = targetDate - currentDate;

            if (remainingTime <= 0) {
                clearInterval(countdownInterval);
                // Display a message or perform any action when the countdown timer reaches zero
                $("#countdown-container").text("Countdown has ended!");
            } else {
                let days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
                let hours = Math.floor(
                    (remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
                );
                let minutes = Math.floor(
                    (remainingTime % (1000 * 60 * 60)) / (1000 * 60)
                );
                let seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

                // Pad single-digit values with leading zeros
                $("#day").text(days.toString().padStart(2, "0"));
                $("#hour").text(hours.toString().padStart(2, "0"));
                $("#min").text(minutes.toString().padStart(2, "0"));
                $("#sec").text(seconds.toString().padStart(2, "0"));
            }
        }, 1000);

        //>> Search Popup Start <<//
        const $searchWrap = $(".search-wrap");
        const $navSearch = $(".nav-search");
        const $searchClose = $("#search-close");

        $(".search-trigger").on("click", function (e) {
            e.preventDefault();
            $searchWrap.animate({ opacity: "toggle" }, 500);
            $navSearch.add($searchClose).addClass("open");
        });

        $(".search-close").on("click", function (e) {
            e.preventDefault();
            $searchWrap.animate({ opacity: "toggle" }, 500);
            $navSearch.add($searchClose).removeClass("open");
        });

        function closeSearch() {
            $searchWrap.fadeOut(200);
            $navSearch.add($searchClose).removeClass("open");
        }

        $(document.body).on("click", function (e) {
            closeSearch();
        });

        $(".search-trigger, .main-search-input").on("click", function (e) {
            e.stopPropagation();
        });


        // Offer Modal
        $windowOn.on('load', function () {
            setTimeout(function () {
                const modal = $('#exampleModal');

                // Show the modal
                modal.modal('show');

                // Remove aria-hidden when the modal is shown
                modal.on('shown.bs.modal', function () {
                    modal.removeAttr('aria-hidden');
                    modal.find('[data-focus="true"]').focus(); // Focus on the first focusable element, if specified
                });

                // Add aria-hidden back when the modal is hidden
                modal.on('hidden.bs.modal', function () {
                    modal.attr('aria-hidden', 'true');
                });
            }, 500);
        });

        // range sliger
        function getVals() {
            let parent = this.parentNode;
            let slides = parent.getElementsByTagName("input");
            let slide1 = parseFloat(slides[0].value);
            let slide2 = parseFloat(slides[1].value);
            if (slide1 > slide2) {
                let tmp = slide2;
                slide2 = slide1;
                slide1 = tmp;
            }

            let displayElement = parent.getElementsByClassName("rangeValues")[0];
            displayElement.innerHTML = "$" + slide1 + " - $" + slide2;
        }

        window.onload = function () {
            let sliderSections = document.getElementsByClassName("range-slider");
            for (let x = 0; x < sliderSections.length; x++) {
                let sliders = sliderSections[x].getElementsByTagName("input");
                for (let y = 0; y < sliders.length; y++) {
                    if (sliders[y].type === "range") {
                        sliders[y].oninput = getVals;
                        sliders[y].oninput();
                    }
                }
            }
        }

        progressBar: () => {
            const pline = document.querySelectorAll(".progressbar.line");
            const pcircle = document.querySelectorAll(".progressbar.semi-circle");
            pline.forEach(e => {
                const line = new ProgressBar.Line(e, {
                    strokeWidth: 6,
                    trailWidth: 6,
                    duration: 3000,
                    easing: 'easeInOut',
                    text: {
                        style: {
                            color: 'inherit',
                            position: 'absolute',
                            right: '0',
                            top: '-30px',
                            padding: 0,
                            margin: 0,
                            transform: null
                        },
                        autoStyleContainer: false
                    },
                    step: (state, line) => {
                        line.setText(Math.round(line.value() * 100) + ' %');
                    }
                });
                let value = e.getAttribute('data-value') / 100;
                new Waypoint({
                    element: e,
                    handler: function () {
                        line.animate(value);
                    },
                    offset: 'bottom-in-view',
                })
            });
            pcircle.forEach(e => {
                const circle = new ProgressBar.SemiCircle(e, {
                    strokeWidth: 6,
                    trailWidth: 6,
                    duration: 2000,
                    easing: 'easeInOut',
                    step: (state, circle) => {
                        circle.setText(Math.round(circle.value() * 100));
                    }
                });
                let value = e.getAttribute('data-value') / 100;
                new Waypoint({
                    element: e,
                    handler: function () {
                        circle.animate(value);
                    },
                    offset: 'bottom-in-view',
                })
            });
        }

        const rangeInput = document.querySelectorAll(".range-input input"),
            priceInput = document.querySelectorAll(".price-input input"),
            range = document.querySelector(".slider .progress");
        let priceGap = 1000;

        priceInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minPrice = parseInt(priceInput[0].value, 10),
                    maxPrice = parseInt(priceInput[1].value, 10);

                if (maxPrice - minPrice >= priceGap && maxPrice <= parseInt(rangeInput[1].max, 10)) {
                    if (e.target.className === "input-min") {
                        rangeInput[0].value = minPrice;
                        range.style.left = (minPrice / parseInt(rangeInput[0].max, 10)) * 100 + "%";
                    } else {
                        rangeInput[1].value = maxPrice;
                        range.style.right = 100 - (maxPrice / parseInt(rangeInput[1].max, 10)) * 100 + "%";
                    }
                }
            });
        });

        rangeInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minVal = parseInt(rangeInput[0].value, 10),
                    maxVal = parseInt(rangeInput[1].value, 10);

                if (maxVal - minVal < priceGap) {
                    if (e.target.className === "range-min") {
                        rangeInput[0].value = maxVal - priceGap;
                    } else {
                        rangeInput[1].value = minVal + priceGap;
                    }
                } else {
                    priceInput[0].value = minVal;
                    priceInput[1].value = maxVal;
                    range.style.left = (minVal / parseInt(rangeInput[0].max, 10)) * 100 + "%";
                    range.style.right = 100 - (maxVal / parseInt(rangeInput[1].max, 10)) * 100 + "%";
                }
            });
        });


        //>> Quantity Js Start <<//
        $(".quantity").on("click", ".plus", function () {
            let $input = $(this).prev("input.qty");
            let val = parseInt($input.val() || 0, 10); // Ensure valid number
            $input.val(val + 1).change();
        });

        $(".quantity").on("click", ".minus", function () {
            let $input = $(this).next("input.qty");
            let val = parseInt($input.val() || 0, 10); // Ensure valid number
            if (val > 1) { // Prevent negative values if needed
                $input.val(val - 1).change();
            }
        });

        //>> Quantity Cart Js Start <<//
        const quantity = 0;
        const price = 0;
        $(".cart-item-quantity-amount, .product-quant").html(quantity);
        $(".total-price, .product-pri").html(price.toFixed(2));
        $(".cart-increment, .cart-incre").on("click", function () {
            if (quantity <= 4) {
                quantity++;
                $(".cart-item-quantity-amount, .product-quant").html(quantity);
                let basePrice = $(".base-price, .base-pri").text();
                $(".total-price, .product-pri").html((basePrice * quantity).toFixed(2));
            }
        });

        $(".cart-decrement, .cart-decre").on("click", function () {
            if (quantity >= 1) {
                quantity--;
                $(".cart-item-quantity-amount, .product-quant").html(quantity);
                let basePrice = $(".base-price, .base-pri").text();
                $(".total-price, .product-pri").html((basePrice * quantity).toFixed(2));
            }
        });

        $(".cart-item-remove>a").on("click", function () {
            $(this).closest(".cart-item").hide(300);
        });

        //Cart Increment Decriemnt

        // Quantity increment and decrement
        // const quantityIncrement = document.querySelectorAll(".quantityIncrement");
        // const quantityDecrement = document.querySelectorAll(".quantityDecrement");

        // if (quantityIncrement.length && quantityDecrement.length) {
        //     quantityIncrement.forEach((increment) => {
        //         increment.addEventListener("click", function () {
        //             const input = increment.parentElement.querySelector("input");
        //             const value = parseInt(input.value || 0, 10); // Ensure valid number
        //             input.value = value + 1;
        //         });
        //     });

        //     quantityDecrement.forEach((decrement) => {
        //         decrement.addEventListener("click", function () {
        //             const input = decrement.parentElement.querySelector("input");
        //             const value = parseInt(input.value || 0, 10); // Ensure valid number
        //             if (value > 1) {
        //                 input.value = value - 1;
        //             }
        //         });
        //     });
        // }

        //>> PaymentMethod Js Start <<//
        const paymentMethod = $("input[name='pay-method']:checked").val();
        $(".payment").html(paymentMethod);
        $(".checkout-radio-single").on("click", function () {
            let paymentMethod = $("input[name='pay-method']:checked").val();
            $(".payment").html(paymentMethod);
        });

        //Quantity
        const inputs = document.querySelectorAll('#qty, #qty2, #qty3');
        const btnminus = document.querySelectorAll('.qtyminus');
        const btnplus = document.querySelectorAll('.qtyplus');

        if (inputs.length > 0 && btnminus.length > 0 && btnplus.length > 0) {

            inputs.forEach(function (input, index) {
                const min = Number(input.getAttribute('min'));
                const max = Number(input.getAttribute('max'));
                const step = Number(input.getAttribute('step'));

                function qtyminus(e) {
                    const current = Number(input.value);
                    const newval = (current - step);
                    if (newval < min) {
                        newval = min;
                    } else if (newval > max) {
                        newval = max;
                    }
                    input.value = Number(newval);
                    e.preventDefault();
                }

                function qtyplus(e) {
                    const current = Number(input.value);
                    const newval = (current + step);
                    if (newval > max) newval = max;
                    input.value = Number(newval);
                    e.preventDefault();
                }

                btnminus[index].addEventListener('click', qtyminus);
                btnplus[index].addEventListener('click', qtyplus);
            });
        }

        //>> Mouse Cursor Start <<//
        function mousecursor() {
            if ($("body")) {
                const e = document.querySelector(".cursor-inner"),
                    t = document.querySelector(".cursor-outer");
                let n,
                    i = 0,
                    o = !1;
                (window.onmousemove = function (s) {
                    o ||
                        (t.style.transform =
                            "translate(" + s.clientX + "px, " + s.clientY + "px)"),
                        (e.style.transform =
                            "translate(" + s.clientX + "px, " + s.clientY + "px)"),
                        (n = s.clientY),
                        (i = s.clientX);
                }),
                    $("body").on("mouseenter", "a, .cursor-pointer", function () {
                        e.classList.add("cursor-hover"), t.classList.add("cursor-hover");
                    }),
                    $("body").on("mouseleave", "a, .cursor-pointer", function () {
                        ($(this).is("a") && $(this).closest(".cursor-pointer").length) ||
                            (e.classList.remove("cursor-hover"),
                                t.classList.remove("cursor-hover"));
                    }),
                    (e.style.visibility = "visible"),
                    (t.style.visibility = "visible");
            }
        }
        $(function () {
            mousecursor();
        });

        //>> Back To Top Slider Start <<//
        $windowOn.on('scroll', function () {
            if ($(this).scrollTop() > 20) {
                $("#back-top").addClass("show");
            } else {
                $("#back-top").removeClass("show");
            }
        });

        $documentOn.on('click', '#back-top', function () {
            $('html, body').animate({ scrollTop: 0 }, 800);
            return false;
        });

    }); // End Document Ready Function

    function loader() {
        $windowOn.on('load', function () {
            // Animate loader off screen
            $(".preloader").addClass('loaded');
            $(".preloader").delay(600).fadeOut();
        });
    }

    loader();

})(jQuery); // End jQuery


/*$(document).ready(function() {
    function toggleButton($button) {
        var isSelected = $button.data('selected');
        var productId = $button.data('product-id');
        var $checkbox = $('#' + productId + '-checkbox');
        if (!isSelected) {
            var selectedCount = $('.shopc-button.selected').length;
            if (selectedCount >= 3) {
                alert('You can only select up to 3 products for the bundle.');
                return false;
            }
        }
        $button.data('selected', !isSelected).toggleClass('selected');
        $button.html(isSelected ? '<span class="icon">+</span> Add this' : '<span class="icon">♡</span> Added');
        if ($checkbox.length) {
            $checkbox.prop('checked', !isSelected);
        }
        return true;
    }
    $(document).on('click', '.product-collection-item', function(e) {
        if (!$(e.target).closest('.shopc-button').length) {
            var productId = $(this).data('product-id');
            var $button = $('.shopc-button[data-product-id="' + productId + '"]');
            if ($button.length) {
                toggleButton($button);
            }
        }
    });
    $(document).on('click', '.shopc-button', function(e) {
        e.stopPropagation();
        toggleButton($(this));
    });
});*/





$(document).ready(function () {
    let selectedProducts = [];
    let selectedPlan = null;
    let currentStep = 1;
    let giftPrice = 0;
    let bundleProducts = window.bundleProducts;
    let imgBasePath = window.imgBasePath;

    var $checkedPlan = $('.pricing-radio:checked');

    if ($checkedPlan.length > 0) {
        setSelectedPlan($checkedPlan);
    }

    function toggleButton($button) {
        const isSelected = $button.data('selected');
        const productId = $button.data('product-id');
        const price = parseFloat($button.data('price'));
        const addonPrice = parseFloat($button.data('addon-price'));
        const $checkbox = $(`#${productId}-checkbox`);
        const $productItem = $button.closest('.product-collection-item');
        const productName = $productItem.find('h4 a').text();
        const productImage = $productItem.find('img').attr('src');

        if (!isSelected) {
            if (selectedProducts.length >= 2) {
                toastr.error('You can only select up to 2 products for the bundle.');
                return false;
            }
            selectedProducts.push({ id: productId, name: productName, price: price, image: productImage, addonPrice: addonPrice });
        } else {
            selectedProducts = selectedProducts.filter(p => p.id !== productId);
        }

        $button.data('selected', !isSelected).toggleClass('selected');
        $button.html(isSelected ? '<span class="icon">+</span> Add this' : '<span class="icon">♡</span> Added');
        $checkbox.prop('checked', !isSelected);

        updateNextButton();
        updateCheckoutStep(); // Update selected products display in real-time
        return true;
    }

    function updateNextButton() {
        const $nextBtn = $('.step-' + currentStep + ' .next-btn');
        if (currentStep === 1) {
            // $nextBtn.prop('disabled', selectedProducts.length !== 3);
            $nextBtn.prop('disabled', selectedProducts.length !== 2);
        } else if (currentStep === 2) {
            $nextBtn.prop('disabled', !selectedPlan);
        }
    }

    function updateCheckoutStep() {
        const $selectedProductsContainer = $('.selected-products');
        $selectedProductsContainer.empty();

        selectedProducts.forEach(product => {
            let priceText = product.addonPrice > 0 ? `RM${product.addonPrice}` : 'Free';

            $selectedProductsContainer.append(`
                <div class="d-flex flex-column align-items-center justify-content-center text-center p-2">
                    <img src="${product.image}" alt="img" class="img-fluid" style="max-width:80px; height:auto;">
                    <span class="mt-1">${priceText}</span>
                </div>
            `);
        });
        if (selectedProducts.length === 2) {
            const $selectedProductsContainer = $('.selected-products');
            setTimeout(function() {
                const newItem = $(`
                    <div class="d-flex flex-column align-items-center justify-content-center text-center">
                        <img src="${imgBasePath}/img/gift.jpg" alt="Gift">
                        <span>Free</span>
                    </div>
                `).hide();

                $selectedProductsContainer.append(newItem);
                newItem.fadeIn(500, function() {
                    toastr.success('🎁 You received a gift worth RM30!', 'Congratulations');
                });
            }, 500);

            giftPrice = 30;
        }
        $('.selected-plan').text(selectedPlan ? `${selectedPlan.name} (RM${selectedPlan.price}/Month)` : 'None');
        $('.total-products').text(selectedProducts.length);
        const productTotal = selectedProducts.reduce((sum, p) => sum + p.price, 0);
        const total = productTotal + (selectedPlan ? parseFloat(selectedPlan.price) : 0) + giftPrice;
        const totalAddon = selectedProducts.reduce((sum, p) => sum + (p.addonPrice || 0), 0);
        $('.total-price').text(`RM${total.toFixed(2)}`);
        $('.addon-price').text(`RM${totalAddon.toFixed(2)}`);
    }

    function changeStep(newStep) {
        $('.step-container').removeClass('active');
        $('.step-' + newStep).addClass('active');
        $('.step-' + newStep).removeClass('disabled').addClass('active');
        currentStep = newStep;
        updateNextButton();
        if (newStep === 3) {
            updateCheckoutStep();
        }
    }

    $(document).on('click', '.product-collection-item', function (e) {
        if ($(e.target).closest('.product-details-link').length) {
            return; // skip toggleButton
        }

        if (!$(e.target).closest('.shopc-button').length && currentStep === 1) {
            const $button = $(this).find('.shopc-button');
            if ($button.length) {
                toggleButton($button);
            }
        }
    });

    $(document).on('click', '.shopc-button', function (e) {
        e.stopPropagation();
        if (currentStep === 1) {
            toggleButton($(this));
        }
    });

    function setSelectedPlan($planInput) {
        var type = $planInput.data('type');
        var today = new Date();
        var renewalDate;

        if (type === 1) {
            renewalDate = new Date(today);
            renewalDate.setMonth(today.getMonth() + 1);
        } else if (type === 2) {
            renewalDate = new Date(today);
            renewalDate.setFullYear(today.getFullYear() + 1);
        }

        var formattedDate = renewalDate.toISOString().split('T')[0]; // YYYY-MM-DD
        var displayDate = renewalDate.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        selectedPlan = {
            plan_id: $planInput.data('plan-id'),
            name: $planInput.data('title'),
            price: $planInput.val(),
            type: type,
            renewal_date: formattedDate
        };

        $('.renewal-date').text(displayDate);

        updateNextButton();
    }

    $(document).on('change', '.pricing-radio', function () {
        if (currentStep === 2) {
            setSelectedPlan($(this));
            var type = $(this).data('type');
            var today = new Date();
            var renewalDate;

            if (type === 1) {
                renewalDate = new Date(today);
                renewalDate.setMonth(today.getMonth() + 1);
            } else if (type === 2) {
                renewalDate = new Date(today);
                renewalDate.setFullYear(today.getFullYear() + 1);
            }

            var formattedDate = renewalDate.toISOString().split('T')[0]; // YYYY-MM-DD
            var displayDate = renewalDate.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            selectedPlan = {
                plan_id: $(this).data('plan-id'),
                name: $(this).data('title'),
                price: $(this).val(),
                type: $(this).data('type'),
                renewal_date: formattedDate
            };

            $('.renewal-date').text(displayDate);

            updateNextButton();
        }
    });

    $(document).on('click', '.next-btn', function () {
        if (currentStep < 3 && !$(this).prop('disabled')) {
            changeStep(currentStep + 1);
        }
    });

    $(document).on('click', '.back-btn', function () {
        if (currentStep > 1) {
            changeStep(currentStep - 1);
        }
    });

    $(document).on('click', '.checkout-btn', function () {
        // alert('Proceeding to checkout with ' + selectedProducts.length + ' products and ' + selectedPlan.name);
        $.ajax({
            url: window.baseURL + '/bundle-to-cart',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                products: selectedProducts,
                plan: selectedPlan
            },
            success: function (response) {
                if (response.success === true) {
                    window.location.href = window.baseURL + '/bundle-checkout';
                } else {
                    toastr.error(response.message || 'Something went wrong.');
                }
            },
            error: function (xhr) {
                toastr.error('Server error.');
                console.error(xhr.responseText);
            }
        });
    });
});








var animation = lottie.loadAnimation({
    container: document.getElementById('step1-animation'),
    renderer: 'svg',
    loop: true,
    autoplay: true,
    animationData: { "v": "5.12.2", "fr": 60, "ip": 0, "op": 120, "w": 48, "h": 48, "nm": "Warranty", "ddd": 0, "assets": [], "layers": [{ "ddd": 0, "ind": 1, "ty": 4, "nm": "Warranty-outline-top_s1g1_s2g2_s3g1_s4g1", "parent": 3, "sr": 1, "ks": { "o": { "a": 0, "k": 100, "ix": 11 }, "r": { "a": 0, "k": 0, "ix": 10 }, "p": { "a": 0, "k": [24, 24, 0], "ix": 2, "l": 2 }, "a": { "a": 0, "k": [24, 24, 0], "ix": 1, "l": 2 }, "s": { "a": 0, "k": [100, 100, 100], "ix": 6, "l": 2 } }, "ao": 0, "shapes": [{ "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 0, "k": { "i": [[0, 0], [0, 0]], "o": [[0, 0], [0, 0]], "v": [[13.178, 27.476], [19.367, 27.476]], "c": false }, "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0.8666666666666667, 0.5411764705882353, 0.5254901960784314], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [0, 0], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 1", "np": 2, "cix": 2, "bm": 0, "ix": 1, "mn": "ADBE Vector Group", "hd": false }, { "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 0, "k": { "i": [[0, 0], [0, 0]], "o": [[0, 0], [0, 0]], "v": [[13.178, 22.198], [19.367, 22.198]], "c": false }, "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0.8666666666666667, 0.5411764705882353, 0.5254901960784314], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [0, 0], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 2", "np": 2, "cix": 2, "bm": 0, "ix": 2, "mn": "ADBE Vector Group", "hd": false }, { "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 0, "k": { "i": [[0, 0], [0, 0]], "o": [[0, 0], [0, 0]], "v": [[13.178, 17.341], [16.21, 17.341]], "c": false }, "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0.8666666666666667, 0.5411764705882353, 0.5254901960784314], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [0, 0], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 3", "np": 2, "cix": 2, "bm": 0, "ix": 3, "mn": "ADBE Vector Group", "hd": false }], "ip": 0, "op": 120, "st": 0, "ct": 1, "bm": 0 }, { "ddd": 0, "ind": 2, "ty": 4, "nm": "Warranty-outline-top_s1g1_s2g2_s3g1_s4g1_background", "sr": 1, "ks": { "o": { "a": 0, "k": 100, "ix": 11 }, "r": { "a": 0, "k": 0, "ix": 10 }, "p": { "a": 1, "k": [{ "i": { "x": 0, "y": 1 }, "o": { "x": 0.333, "y": 0 }, "t": 0, "s": [32.625, 24, 0], "to": [0, -1.146, 0], "ti": [0, 0, 0] }, { "i": { "x": 0, "y": 1 }, "o": { "x": 0.333, "y": 0 }, "t": 60, "s": [32.625, 17.125, 0], "to": [0, 0, 0], "ti": [0, -1.146, 0] }, { "t": 119, "s": [32.625, 24, 0] }], "ix": 2, "l": 2 }, "a": { "a": 0, "k": [32.625, 24, 0], "ix": 1, "l": 2 }, "s": { "a": 0, "k": [100, 100, 100], "ix": 6, "l": 2 } }, "ao": 0, "shapes": [{ "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 0, "k": { "i": [[0, 0], [0, 0], [0, 0]], "o": [[0, 0], [0, 0], [0, 0]], "v": [[-3.242, 0.039], [-1.107, 2.174], [3.242, -2.174]], "c": false }, "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0.8666666666666667, 0.5411764705882353, 0.5254901960784314], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [32.917, 19.9], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 1", "np": 2, "cix": 2, "bm": 0, "ix": 1, "mn": "ADBE Vector Group", "hd": false }, { "ty": "tm", "s": { "a": 1, "k": [{ "i": { "x": [0.833], "y": [0.833] }, "o": { "x": [0.167], "y": [0.167] }, "t": 0, "s": [0] }, { "i": { "x": [0.833], "y": [0.833] }, "o": { "x": [0.167], "y": [0.167] }, "t": 60, "s": [100] }, { "t": 119, "s": [0] }], "ix": 1 }, "e": { "a": 1, "k": [{ "i": { "x": [0.833], "y": [0.833] }, "o": { "x": [0.167], "y": [0.167] }, "t": 0, "s": [100] }, { "t": 119, "s": [100] }], "ix": 2 }, "o": { "a": 1, "k": [{ "i": { "x": [0.833], "y": [0.833] }, "o": { "x": [0.167], "y": [0.167] }, "t": 60, "s": [0] }, { "t": 119, "s": [360] }], "ix": 3 }, "m": 1, "ix": 2, "nm": "Trim Paths 1", "mn": "ADBE Vector Filter - Trim", "hd": false }, { "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 0, "k": { "i": [[0, -1.342], [0, 0], [-1.163, -0.671], [0, 0], [-1.163, 0.671], [0, 0], [0, 1.343], [0, 0], [1.162, 0.671], [0, 0], [1.162, -0.671], [0, 0]], "o": [[0, 0], [0, 1.343], [0, 0], [1.162, 0.671], [0, 0], [1.162, -0.671], [0, 0], [0, -1.342], [0, 0], [-1.163, -0.671], [0, 0], [-1.163, 0.671]], "v": [[-8.09, -2.502], [-8.09, 2.501], [-6.211, 5.755], [-1.878, 8.257], [1.879, 8.257], [6.212, 5.755], [8.09, 2.501], [8.09, -2.502], [6.212, -5.756], [1.879, -8.257], [-1.878, -8.257], [-6.211, -5.756]], "c": true }, "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0.8666666666666667, 0.5411764705882353, 0.5254901960784314], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "fl", "c": { "a": 0, "k": [1, 1, 1], "ix": 4 }, "o": { "a": 0, "k": 100, "ix": 5 }, "r": 1, "bm": 0, "nm": "Fill 1", "mn": "ADBE Vector Graphic - Fill", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [32.917, 19.9], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 2", "np": 3, "cix": 2, "bm": 0, "ix": 3, "mn": "ADBE Vector Group", "hd": false }, { "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 1, "k": [{ "i": { "x": 0.667, "y": 1 }, "o": { "x": 0.333, "y": 0 }, "t": 0, "s": [{ "i": [[0.801, 0.717], [0, 0], [0.365, -0.315], [0, 0], [0, 1.065], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]], "o": [[0, 0], [-0.359, -0.322], [0, 0], [-0.806, 0.697], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 1.076]], "v": [[3.19, 5.164], [0.723, 2.956], [-0.544, 2.944], [-3.206, 5.243], [-5.263, 4.302], [-5.263, -0.248], [-5.263, -5.94], [5.263, -5.94], [5.263, -0.139], [5.263, 4.237]], "c": true }] }, { "i": { "x": 0.667, "y": 1 }, "o": { "x": 0.333, "y": 0 }, "t": 39.666, "s": [{ "i": [[0.801, 0.717], [0, 0], [0.365, -0.315], [0, 0], [0, 1.065], [-0.846, 1.771], [0, 0], [0, 0], [0.742, -2.386], [0, 0]], "o": [[0, 0], [-0.359, -0.322], [0, 0], [-0.806, 0.697], [0, 0], [0.846, -1.771], [0, 0], [0, 0], [-0.742, 2.386], [0, 1.076]], "v": [[-0.81, 5.19], [-3.277, 2.982], [-4.544, 2.97], [-7.206, 5.269], [-9.263, 4.328], [-6.576, -0.143], [-5.263, -5.94], [5.263, -5.94], [3.763, 0.387], [1.263, 4.263]], "c": true }] }, { "i": { "x": 0.667, "y": 1 }, "o": { "x": 0.333, "y": 0 }, "t": 79.334, "s": [{ "i": [[0.918, 0.559], [0, 0], [0.301, -0.376], [0, 0], [0.194, 1.047], [0.476, 3.468], [0, 0], [0, 0], [-0.411, -1.839], [0, 0]], "o": [[0, 0], [-0.412, -0.251], [0, 0], [-0.665, 0.832], [0, 0], [-0.218, -1.589], [0, 0], [0, 0], [0.545, 2.439], [0.196, 1.058]], "v": [[5.123, 4.724], [2.295, 3.003], [1.047, 3.222], [-1.151, 5.968], [-3.345, 5.418], [-5.393, -0.843], [-5.263, -5.94], [5.263, -5.94], [5.119, -0.661], [6.992, 3.435]], "c": true }] }, { "t": 119, "s": [{ "i": [[0.801, 0.717], [0, 0], [0.365, -0.315], [0, 0], [0, 1.065], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]], "o": [[0, 0], [-0.359, -0.322], [0, 0], [-0.806, 0.697], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 1.076]], "v": [[3.19, 5.164], [0.723, 2.956], [-0.544, 2.944], [-3.206, 5.243], [-5.263, 4.302], [-5.263, -0.248], [-5.263, -5.94], [5.263, -5.94], [5.263, -0.139], [5.263, 4.237]], "c": true }] }], "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0.8666666666666667, 0.5411764705882353, 0.5254901960784314], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "fl", "c": { "a": 0, "k": [1, 1, 1], "ix": 4 }, "o": { "a": 0, "k": 100, "ix": 5 }, "r": 1, "bm": 0, "nm": "Fill 1", "mn": "ADBE Vector Graphic - Fill", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [32.917, 29.437], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 3", "np": 3, "cix": 2, "bm": 0, "ix": 4, "mn": "ADBE Vector Group", "hd": false }], "ip": 0, "op": 120, "st": 0, "ct": 1, "bm": 0 }, { "ddd": 0, "ind": 3, "ty": 4, "nm": "Warranty-outline-bot_s1g1_s2g1_s3g1_s4g1_background", "sr": 1, "ks": { "o": { "a": 0, "k": 100, "ix": 11 }, "r": { "a": 0, "k": 0, "ix": 10 }, "p": { "a": 1, "k": [{ "i": { "x": 0.833, "y": 0.833 }, "o": { "x": 0.167, "y": 0.167 }, "t": 0, "s": [18.625, 24, 0], "to": [0, 0.688, 0], "ti": [0, 0, 0] }, { "i": { "x": 0.833, "y": 0.833 }, "o": { "x": 0.167, "y": 0.167 }, "t": 60, "s": [18.625, 28.125, 0], "to": [0, 0, 0], "ti": [0, 0.688, 0] }, { "t": 119, "s": [18.625, 24, 0] }], "ix": 2, "l": 2 }, "a": { "a": 1, "k": [{ "i": { "x": 0.833, "y": 0.833 }, "o": { "x": 0.167, "y": 0.167 }, "t": 0, "s": [18.625, 24, 0], "to": [0, 0, 0], "ti": [0, 0, 0] }, { "t": 119, "s": [18.625, 24, 0] }], "ix": 1, "l": 2 }, "s": { "a": 0, "k": [100, 100, 100], "ix": 6, "l": 2 } }, "ao": 0, "shapes": [{ "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 1, "k": [{ "i": { "x": 0.833, "y": 0.833 }, "o": { "x": 0.167, "y": 0.167 }, "t": 0, "s": [{ "i": [[-0.081, 0], [0, 0], [0, -0.328], [-2.359, 0], [0, 0], [0, 2.106], [0, 0], [-0.215, 0.089]], "o": [[0, 0], [0.328, 0], [0, 2.359], [0, 0], [-2.106, 0], [0, 0], [0, -0.247], [0.07, -0.029]], "v": [[-9.364, -2.432], [6.347, -2.432], [6.941, -1.839], [9.958, 2.432], [-6.145, 2.432], [-9.958, -1.38], [-9.958, -1.839], [-9.592, -2.387]], "c": true }] }, { "i": { "x": 0.833, "y": 0.833 }, "o": { "x": 0.167, "y": 0.167 }, "t": 60, "s": [{ "i": [[-0.079, 0], [0, 0], [-0.097, -0.313], [-2.359, 0], [0, 0], [1.286, 1.682], [0, 0], [-0.217, 0.088]], "o": [[0, 0], [0.328, 0], [0.449, 1.453], [0, 0], [-0.18, 0.057], [0, 0], [0, -0.249], [0.069, -0.028]], "v": [[-9.392, -0.057], [6.319, -0.057], [6.913, 0.536], [9.958, 2.432], [-6.145, 2.432], [-9.986, 0.995], [-9.986, 0.536], [-9.616, -0.014]], "c": true }] }, { "t": 119, "s": [{ "i": [[-0.081, 0], [0, 0], [0, -0.328], [-2.359, 0], [0, 0], [0, 2.106], [0, 0], [-0.215, 0.089]], "o": [[0, 0], [0.328, 0], [0, 2.359], [0, 0], [-2.106, 0], [0, 0], [0, -0.247], [0.07, -0.029]], "v": [[-9.364, -2.432], [6.347, -2.432], [6.941, -1.839], [9.958, 2.432], [-6.145, 2.432], [-9.958, -1.38], [-9.958, -1.839], [-9.592, -2.387]], "c": true }] }], "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0, 0, 0], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "fl", "c": { "a": 0, "k": [1, 1, 1], "ix": 4 }, "o": { "a": 0, "k": 100, "ix": 5 }, "r": 1, "bm": 0, "nm": "Fill 1", "mn": "ADBE Vector Graphic - Fill", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [16.951, 35.323], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 1", "np": 3, "cix": 2, "bm": 0, "ix": 1, "mn": "ADBE Vector Group", "hd": false }, { "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 0, "k": { "i": [[1.865, 0], [0, 0], [0, 1.866], [0, 0], [-2.007, 0], [0, 0], [0, -2.008], [0, 0]], "o": [[0, 0], [-1.865, 0], [0, 0], [0, -2.008], [0, 0], [2.007, 0], [0, 0], [0, 1.866]], "v": [[7.335, 13.757], [-7.335, 13.757], [-10.712, 10.379], [-10.712, -10.122], [-7.079, -13.757], [7.077, -13.757], [10.712, -10.122], [10.712, 10.379]], "c": true }, "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0, 0, 0], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "fl", "c": { "a": 0, "k": [1, 1, 1], "ix": 4 }, "o": { "a": 0, "k": 100, "ix": 5 }, "r": 1, "bm": 0, "nm": "Fill 1", "mn": "ADBE Vector Graphic - Fill", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [19.367, 24], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 2", "np": 3, "cix": 2, "bm": 0, "ix": 2, "mn": "ADBE Vector Group", "hd": false }], "ip": 0, "op": 120, "st": 0, "ct": 1, "bm": 0 }], "markers": [], "props": {} }
});

var animation = lottie.loadAnimation({
    container: document.getElementById('step2-animation'),
    renderer: 'svg',
    loop: true,
    autoplay: true,
    animationData: { "v": "5.12.2", "fr": 60, "ip": 0, "op": 70, "w": 48, "h": 48, "nm": "Product", "ddd": 0, "assets": [], "layers": [{ "ddd": 0, "ind": 1, "ty": 4, "nm": "product-outline-bot_s1g1_s2g2_s3g1_s4g1", "parent": 2, "sr": 1, "ks": { "o": { "a": 0, "k": 100, "ix": 11 }, "r": { "a": 0, "k": 0, "ix": 10 }, "p": { "a": 0, "k": [24, 24, 0], "ix": 2, "l": 2 }, "a": { "a": 0, "k": [24, 24, 0], "ix": 1, "l": 2 }, "s": { "a": 0, "k": [100, 100, 100], "ix": 6, "l": 2 } }, "ao": 0, "shapes": [{ "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 0, "k": { "i": [[0, -0.523], [0, 0], [0.301, -0.11], [0, 0], [0, 0.529], [0, 0], [-0.31, 0.105], [0, 0]], "o": [[0, 0], [0, 0.321], [0, 0], [-0.498, 0.181], [0, 0], [0, -0.327], [0, 0], [0.495, -0.168]], "v": [[2.874, -3.723], [2.874, 2.178], [2.372, 2.895], [-1.848, 4.434], [-2.874, 3.717], [-2.874, -2.288], [-2.355, -3.01], [1.865, -4.447]], "c": true }, "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0.8666666666666667, 0.5411764705882353, 0.5254901960784314], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [33.361, 20.241], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 1", "np": 2, "cix": 2, "bm": 0, "ix": 1, "mn": "ADBE Vector Group", "hd": false }, { "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 0, "k": { "i": [[0, 0], [0, 0]], "o": [[0, 0], [0, 0]], "v": [[-1.332, 0.515], [1.332, -0.515]], "c": false }, "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0.8666666666666667, 0.5411764705882353, 0.5254901960784314], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [30.487, 32.458], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 2", "np": 2, "cix": 2, "bm": 0, "ix": 2, "mn": "ADBE Vector Group", "hd": false }], "ip": 0, "op": 70, "st": 0, "ct": 1, "bm": 0 }, { "ddd": 0, "ind": 2, "ty": 4, "nm": "product-outline-bot_s1g1_s2g1_s3g1_s4g1_background", "sr": 1, "ks": { "o": { "a": 0, "k": 100, "ix": 11 }, "r": { "a": 1, "k": [{ "i": { "x": [0.667], "y": [1] }, "o": { "x": [0.333], "y": [0] }, "t": 0, "s": [0] }, { "i": { "x": [0.667], "y": [1] }, "o": { "x": [0.333], "y": [0] }, "t": 20, "s": [-4] }, { "i": { "x": [0.667], "y": [1] }, "o": { "x": [0.333], "y": [0] }, "t": 50, "s": [4] }, { "t": 69, "s": [0] }], "ix": 10 }, "p": { "a": 1, "k": [{ "i": { "x": 0.667, "y": 1 }, "o": { "x": 0.333, "y": 0 }, "t": 0, "s": [24, 41, 0], "to": [0, -0.563, 0], "ti": [0, 0, 0] }, { "i": { "x": 0.667, "y": 1 }, "o": { "x": 0.333, "y": 0 }, "t": 35, "s": [24, 37.625, 0], "to": [0, 0, 0], "ti": [0, -0.563, 0] }, { "t": 69, "s": [24, 41, 0] }], "ix": 2, "l": 2 }, "a": { "a": 0, "k": [24, 41, 0], "ix": 1, "l": 2 }, "s": { "a": 1, "k": [{ "i": { "x": [0.833, 0.833, 0.833], "y": [0.833, 0.833, 0.833] }, "o": { "x": [0.167, 0.167, 0.167], "y": [0.167, 0.167, 0.167] }, "t": 0, "s": [100, 100, 100] }, { "i": { "x": [0.833, 0.833, 0.833], "y": [0.833, 0.833, 0.833] }, "o": { "x": [0.167, 0.167, 0.167], "y": [0.167, 0.167, 0.167] }, "t": 35, "s": [91.223, 100, 100] }, { "t": 69, "s": [100, 100, 100] }], "ix": 6, "l": 2 } }, "ao": 0, "shapes": [{ "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 0, "k": { "i": [[0, 0], [0, 0]], "o": [[0, 0], [0, 0]], "v": [[24.06, 19.594], [24.06, 40.5]], "c": false }, "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0, 0, 0], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [0, 0], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 3", "np": 2, "cix": 2, "bm": 0, "ix": 1, "mn": "ADBE Vector Group", "hd": false }, { "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 0, "k": { "i": [[0, 0], [0, 0]], "o": [[0, 0], [0, 0]], "v": [[-8.492, 2.89], [8.492, -2.89]], "c": false }, "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0, 0, 0], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [23.738, 13.078], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 4", "np": 2, "cix": 2, "bm": 0, "ix": 2, "mn": "ADBE Vector Group", "hd": false }, { "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 0, "k": { "i": [[0, 0], [0, 0], [0, 0]], "o": [[0, 0], [0, 0], [0, 0]], "v": [[-15.729, -2.872], [0.027, 2.872], [15.729, -2.473]], "c": false }, "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0, 0, 0], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [24.034, 16.722], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 5", "np": 2, "cix": 2, "bm": 0, "ix": 3, "mn": "ADBE Vector Group", "hd": false }, { "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 0, "k": { "i": [[0, -2.53], [0, 0], [-2.359, -0.912], [0, 0], [-1.42, 0.549], [0, 0], [0, 2.53], [0, 0], [2.359, 0.912], [0, 0], [1.42, -0.549], [0, 0]], "o": [[0, 0], [0, 2.53], [0, 0], [1.42, 0.549], [0, 0], [2.359, -0.912], [0, 0], [0, -2.53], [0, 0], [-1.42, -0.549], [0, 0], [-2.359, 0.912]], "v": [[-17.031, -6.398], [-17.031, 6.398], [-13.115, 12.109], [-2.208, 16.326], [2.208, 16.326], [13.115, 12.109], [17.031, 6.398], [17.031, -6.398], [13.115, -12.109], [2.208, -16.326], [-2.208, -16.326], [-13.115, -12.109]], "c": true }, "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0, 0, 0], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "fl", "c": { "a": 0, "k": [1, 1, 1], "ix": 4 }, "o": { "a": 0, "k": 100, "ix": 5 }, "r": 1, "bm": 0, "nm": "Fill 1", "mn": "ADBE Vector Graphic - Fill", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [24.06, 23.982], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 6", "np": 3, "cix": 2, "bm": 0, "ix": 4, "mn": "ADBE Vector Group", "hd": false }], "ip": 0, "op": 70, "st": 0, "ct": 1, "bm": 0 }], "markers": [], "props": {} }
});

var animation = lottie.loadAnimation({
    container: document.getElementById('step3-animation'),
    renderer: 'svg',
    loop: true,
    autoplay: true,
    animationData: { "v": "5.12.2", "fr": 60, "ip": 0, "op": 120, "w": 48, "h": 48, "nm": "To Do", "ddd": 0, "assets": [], "layers": [{ "ddd": 0, "ind": 1, "ty": 4, "nm": "Todo-outline-top_s1g1_s2g2_s3g1_s4g1_background ", "parent": 3, "sr": 1, "ks": { "o": { "a": 0, "k": 100, "ix": 11 }, "r": { "a": 0, "k": 0, "ix": 10 }, "p": { "a": 0, "k": [24, 24, 0], "ix": 2, "l": 2 }, "a": { "a": 0, "k": [24, 24, 0], "ix": 1, "l": 2 }, "s": { "a": 0, "k": [100, 100, 100], "ix": 6, "l": 2 } }, "ao": 0, "shapes": [{ "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 0, "k": { "i": [[-1.233, 0], [0, 0], [0, -1.233], [0, 0], [1.232, 0], [0, 0], [0, 1.233], [0, 0]], "o": [[0, 0], [1.232, 0], [0, 0], [0, 1.233], [0, 0], [-1.233, 0], [0, 0], [0, -1.233]], "v": [[-2.207, -4.439], [2.207, -4.439], [4.439, -2.207], [4.439, 2.207], [2.207, 4.439], [-2.207, 4.439], [-4.439, 2.207], [-4.439, -2.207]], "c": true }, "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0, 0, 0], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [17.259, 15.712], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 1", "np": 2, "cix": 2, "bm": 0, "ix": 1, "mn": "ADBE Vector Group", "hd": false }, { "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 0, "k": { "i": [[0, 0], [0, 0], [0, 0]], "o": [[0, 0], [0, 0], [0, 0]], "v": [[-2.068, 0.352], [-0.924, 1.495], [2.068, -1.495]], "c": false }, "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "tm", "s": { "a": 1, "k": [{ "i": { "x": [0.833], "y": [0.833] }, "o": { "x": [0.167], "y": [0.167] }, "t": 0, "s": [0] }, { "i": { "x": [0.833], "y": [0.833] }, "o": { "x": [0.167], "y": [0.167] }, "t": 32.727, "s": [100] }, { "t": 60, "s": [0] }], "ix": 1 }, "e": { "a": 1, "k": [{ "i": { "x": [0.833], "y": [0.833] }, "o": { "x": [0.167], "y": [0.167] }, "t": 0, "s": [100] }, { "t": 60, "s": [100] }], "ix": 2 }, "o": { "a": 1, "k": [{ "i": { "x": [0.833], "y": [0.833] }, "o": { "x": [0.167], "y": [0.167] }, "t": 32.727, "s": [0] }, { "t": 60, "s": [360] }], "ix": 3 }, "m": 1, "ix": 2, "nm": "Trim Paths 1", "mn": "ADBE Vector Filter - Trim", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0, 0, 0], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [17.382, 16.124], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 3", "np": 3, "cix": 2, "bm": 0, "ix": 2, "mn": "ADBE Vector Group", "hd": false }], "ip": 0, "op": 120, "st": 0, "ct": 1, "bm": 0 }, { "ddd": 0, "ind": 2, "ty": 4, "nm": "Todo-outline-bot_s1g1_s2g1_s3g1_s4g1", "parent": 3, "sr": 1, "ks": { "o": { "a": 0, "k": 100, "ix": 11 }, "r": { "a": 0, "k": 0, "ix": 10 }, "p": { "a": 0, "k": [24, 24, 0], "ix": 2, "l": 2 }, "a": { "a": 0, "k": [24, 24, 0], "ix": 1, "l": 2 }, "s": { "a": 0, "k": [100, 100, 100], "ix": 6, "l": 2 } }, "ao": 0, "shapes": [{ "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 0, "k": { "i": [[-1.099, 0], [0, 1.099], [1.099, 0], [0, -1.1]], "o": [[1.099, 0], [0, -1.1], [-1.099, 0], [0, 1.099]], "v": [[0, 1.99], [1.99, 0.001], [0, -1.99], [-1.99, 0.001]], "c": true }, "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0.8666666666666667, 0.5411764705882353, 0.5254901960784314], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [17.382, 33.49], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 1, "k": [{ "i": { "x": [0.833, 0.833], "y": [0.833, 0.833] }, "o": { "x": [0.167, 0.167], "y": [0.167, 0.167] }, "t": 50, "s": [100, 100] }, { "i": { "x": [0.833, 0.833], "y": [0.833, 0.833] }, "o": { "x": [0.167, 0.167], "y": [0.167, 0.167] }, "t": 60, "s": [0, 0] }, { "t": 70, "s": [100, 100] }], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 1", "np": 2, "cix": 2, "bm": 0, "ix": 1, "mn": "ADBE Vector Group", "hd": false }, { "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 0, "k": { "i": [[0, 0], [0, 0]], "o": [[0, 0], [0, 0]], "v": [[26.273, 33.512], [34.5, 33.512]], "c": false }, "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0.8666666666666667, 0.5411764705882353, 0.5254901960784314], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "tm", "s": { "a": 1, "k": [{ "i": { "x": [0.833], "y": [0.833] }, "o": { "x": [0.167], "y": [0.167] }, "t": 70, "s": [0] }, { "i": { "x": [0.833], "y": [0.833] }, "o": { "x": [0.167], "y": [0.167] }, "t": 90, "s": [100] }, { "t": 110, "s": [0] }], "ix": 1 }, "e": { "a": 1, "k": [{ "i": { "x": [0.833], "y": [0.833] }, "o": { "x": [0.167], "y": [0.167] }, "t": 70, "s": [100] }, { "t": 110, "s": [100] }], "ix": 2 }, "o": { "a": 1, "k": [{ "i": { "x": [0.833], "y": [0.833] }, "o": { "x": [0.167], "y": [0.167] }, "t": 90, "s": [0] }, { "t": 110, "s": [360] }], "ix": 3 }, "m": 1, "ix": 3, "nm": "Trim Paths 1", "mn": "ADBE Vector Filter - Trim", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0.8666666666666667, 0.5411764705882353, 0.5254901960784314], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 1, "lj": 1, "ml": 4, "bm": 0, "nm": "Stroke 2", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [0, 0], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 2", "np": 4, "cix": 2, "bm": 0, "ix": 2, "mn": "ADBE Vector Group", "hd": false }, { "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 0, "k": { "i": [[-1.099, 0], [0, 1.099], [1.099, 0], [0, -1.1]], "o": [[1.099, 0], [0, -1.1], [-1.099, 0], [0, 1.099]], "v": [[0, 1.99], [1.99, 0.001], [0, -1.99], [-1.99, 0.001]], "c": true }, "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0.8666666666666667, 0.5411764705882353, 0.5254901960784314], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [17.382, 25.5], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 1, "k": [{ "i": { "x": [0.833, 0.833], "y": [0.833, 0.833] }, "o": { "x": [0.167, 0.167], "y": [0.167, 0.167] }, "t": 20, "s": [100, 100] }, { "i": { "x": [0.833, 0.833], "y": [0.833, 0.833] }, "o": { "x": [0.167, 0.167], "y": [0.167, 0.167] }, "t": 30, "s": [0, 0] }, { "t": 40, "s": [100, 100] }], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 3", "np": 2, "cix": 2, "bm": 0, "ix": 3, "mn": "ADBE Vector Group", "hd": false }, { "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 0, "k": { "i": [[0, 0], [0, 0]], "o": [[0, 0], [0, 0]], "v": [[26.273, 25.521], [34.5, 25.521]], "c": false }, "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0.8666666666666667, 0.5411764705882353, 0.5254901960784314], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "tm", "s": { "a": 1, "k": [{ "i": { "x": [0.833], "y": [0.833] }, "o": { "x": [0.167], "y": [0.167] }, "t": 30, "s": [0] }, { "i": { "x": [0.833], "y": [0.833] }, "o": { "x": [0.167], "y": [0.167] }, "t": 50, "s": [100] }, { "t": 70, "s": [0] }], "ix": 1 }, "e": { "a": 1, "k": [{ "i": { "x": [0.833], "y": [0.833] }, "o": { "x": [0.167], "y": [0.167] }, "t": 30, "s": [100] }, { "t": 70, "s": [100] }], "ix": 2 }, "o": { "a": 1, "k": [{ "i": { "x": [0.833], "y": [0.833] }, "o": { "x": [0.167], "y": [0.167] }, "t": 50, "s": [0] }, { "t": 70, "s": [360] }], "ix": 3 }, "m": 1, "ix": 3, "nm": "Trim Paths 1", "mn": "ADBE Vector Filter - Trim", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0.8666666666666667, 0.5411764705882353, 0.5254901960784314], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 2", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [0, 0], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 4", "np": 4, "cix": 2, "bm": 0, "ix": 4, "mn": "ADBE Vector Group", "hd": false }], "ip": 0, "op": 120, "st": 0, "ct": 1, "bm": 0 }, { "ddd": 0, "ind": 3, "ty": 4, "nm": "Todo-outline-top_s1g1_s2g2_s3g1_s4g1_background", "sr": 1, "ks": { "o": { "a": 0, "k": 100, "ix": 11 }, "r": { "a": 1, "k": [{ "i": { "x": [0.833], "y": [0.833] }, "o": { "x": [0.167], "y": [0.167] }, "t": 0, "s": [0] }, { "i": { "x": [0.833], "y": [0.833] }, "o": { "x": [0.167], "y": [0.167] }, "t": 11, "s": [-3] }, { "i": { "x": [0.833], "y": [0.833] }, "o": { "x": [0.167], "y": [0.167] }, "t": 34, "s": [3] }, { "t": 52, "s": [0] }], "ix": 10 }, "p": { "a": 1, "k": [{ "i": { "x": 0, "y": 1 }, "o": { "x": 0.333, "y": 0 }, "t": 0, "s": [24, 24, 0], "to": [0, -0.667, 0], "ti": [0, 0, 0] }, { "i": { "x": 0, "y": 1 }, "o": { "x": 0.333, "y": 0 }, "t": 20, "s": [24, 20, 0], "to": [0, 0, 0], "ti": [0, -0.667, 0] }, { "t": 50, "s": [24, 24, 0] }], "ix": 2, "l": 2 }, "a": { "a": 0, "k": [24, 24, 0], "ix": 1, "l": 2 }, "s": { "a": 0, "k": [100, 100, 100], "ix": 6, "l": 2 } }, "ao": 0, "shapes": [{ "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 0, "k": { "i": [[0, 0], [0, 0]], "o": [[0, 0], [0, 0]], "v": [[26.273, 16.937], [34.5, 16.937]], "c": false }, "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "tm", "s": { "a": 1, "k": [{ "i": { "x": [0.833], "y": [0.833] }, "o": { "x": [0.167], "y": [0.167] }, "t": 0, "s": [0] }, { "i": { "x": [0.833], "y": [0.833] }, "o": { "x": [0.167], "y": [0.167] }, "t": 20, "s": [100] }, { "t": 40, "s": [0] }], "ix": 1 }, "e": { "a": 1, "k": [{ "i": { "x": [0.833], "y": [0.833] }, "o": { "x": [0.167], "y": [0.167] }, "t": 0, "s": [100] }, { "t": 40, "s": [100] }], "ix": 2 }, "o": { "a": 1, "k": [{ "i": { "x": [0.833], "y": [0.833] }, "o": { "x": [0.167], "y": [0.167] }, "t": 20, "s": [0] }, { "t": 40, "s": [360] }], "ix": 3 }, "m": 1, "ix": 2, "nm": "Trim Paths 1", "mn": "ADBE Vector Filter - Trim", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0, 0, 0], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [0, 0], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 2", "np": 3, "cix": 2, "bm": 0, "ix": 1, "mn": "ADBE Vector Group", "hd": false }, { "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 0, "k": { "i": [[3.715, 0], [0, 0], [0, 3.715], [0, 0], [-3.716, 0], [0, 0], [0, -3.715], [0, 0]], "o": [[0, 0], [-3.716, 0], [0, 0], [0, -3.715], [0, 0], [3.715, 0], [0, 0], [0, 3.715]], "v": [[10.364, 17], [-10.363, 17], [-17.091, 10.273], [-17.091, -10.273], [-10.363, -17], [10.364, -17], [17.091, -10.273], [17.091, 10.273]], "c": true }, "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0, 0, 0], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "fl", "c": { "a": 0, "k": [1, 1, 1], "ix": 4 }, "o": { "a": 0, "k": 100, "ix": 5 }, "r": 1, "bm": 0, "nm": "Fill 1", "mn": "ADBE Vector Graphic - Fill", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [24, 24], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 4", "np": 3, "cix": 2, "bm": 0, "ix": 2, "mn": "ADBE Vector Group", "hd": false }], "ip": 0, "op": 120, "st": 0, "ct": 1, "bm": 0 }], "markers": [], "props": {} }
});

var animation = lottie.loadAnimation({
    container: document.getElementById('step4-animation'),
    renderer: 'svg',
    loop: true,
    autoplay: true,
    animationData: { "v": "5.12.2", "fr": 25, "ip": 0, "op": 50, "w": 48, "h": 48, "nm": "Reliable", "ddd": 0, "assets": [], "layers": [{ "ddd": 0, "ind": 1, "ty": 4, "nm": "Reliable-outline-bot_s1g1_s2g1_s3g1_s4g1_background", "sr": 1, "ks": { "o": { "a": 0, "k": 100, "ix": 11 }, "r": { "a": 1, "k": [{ "i": { "x": [0], "y": [1] }, "o": { "x": [0.333], "y": [0] }, "t": 0, "s": [0] }, { "i": { "x": [0.215], "y": [1] }, "o": { "x": [0.333], "y": [0] }, "t": 13, "s": [-12] }, { "i": { "x": [0], "y": [1] }, "o": { "x": [0.333], "y": [0] }, "t": 37, "s": [12] }, { "t": 49, "s": [0] }], "ix": 10 }, "p": { "a": 1, "k": [{ "i": { "x": 0.215, "y": 1 }, "o": { "x": 0.333, "y": 0 }, "t": 0, "s": [9.625, 35.5, 0], "to": [0, -0.708, 0], "ti": [0, 0, 0] }, { "i": { "x": 0.215, "y": 1 }, "o": { "x": 0.333, "y": 0 }, "t": 25, "s": [9.625, 31.25, 0], "to": [0, 0, 0], "ti": [0, -0.708, 0] }, { "t": 49, "s": [9.625, 35.5, 0] }], "ix": 2, "l": 2 }, "a": { "a": 0, "k": [9.625, 35.5, 0], "ix": 1, "l": 2 }, "s": { "a": 0, "k": [100, 100, 100], "ix": 6, "l": 2 } }, "ao": 0, "shapes": [{ "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 0, "k": { "i": [[-1.089, 0], [0, 0], [0, 1.09], [0, 0], [1.089, 0], [0, 0], [0, -1.09], [0, 0]], "o": [[0, 0], [1.089, 0], [0, 0], [0, -1.09], [0, 0], [-1.089, 0], [0, 0], [0, 1.09]], "v": [[-0.781, 5.481], [0.781, 5.481], [2.753, 3.508], [2.753, -3.508], [0.781, -5.481], [-0.781, -5.481], [-2.753, -3.508], [-2.753, 3.508]], "c": true }, "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0, 0, 0], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "fl", "c": { "a": 0, "k": [1, 1, 1], "ix": 4 }, "o": { "a": 0, "k": 100, "ix": 5 }, "r": 1, "bm": 0, "nm": "Fill 1", "mn": "ADBE Vector Graphic - Fill", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [9.676, 35.517], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 1", "np": 3, "cix": 2, "bm": 0, "ix": 1, "mn": "ADBE Vector Group", "hd": false }], "ip": 0, "op": 50, "st": 0, "ct": 1, "bm": 0 }, { "ddd": 0, "ind": 2, "ty": 4, "nm": "Reliable-outline-bot_s1g1_s2g2_s3g1_s4g1_background", "parent": 1, "sr": 1, "ks": { "o": { "a": 0, "k": 100, "ix": 11 }, "r": { "a": 0, "k": 0, "ix": 10 }, "p": { "a": 0, "k": [24, 24, 0], "ix": 2, "l": 2 }, "a": { "a": 0, "k": [24, 24, 0], "ix": 1, "l": 2 }, "s": { "a": 0, "k": [100, 100, 100], "ix": 6, "l": 2 } }, "ao": 0, "shapes": [{ "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 1, "k": [{ "i": { "x": 0.667, "y": 1 }, "o": { "x": 0.333, "y": 0 }, "t": 0, "s": [{ "i": [[-1.372, 1.263], [-1.179, 0.008], [0, 0], [0, 0], [-0.501, -0.843], [0, -1.817], [0.738, -0.949], [0.878, 0], [0, 0], [0, 0], [0, 2.07], [0, 0]], "o": [[2.456, -2.262], [3.824, -0.026], [0, 0], [0.98, 0], [0.592, 0.996], [0, 2.315], [-0.538, 0.693], [0, 0], [0, 0], [-2.07, 0], [0, 0], [0, -3.407]], "v": [[-3.547, -4.753], [-0.071, -8.85], [0.31, -2.255], [3.657, -2.255], [6.045, -0.901], [7.274, 3.405], [5.981, 7.761], [3.75, 8.876], [2.755, 8.876], [-3.527, 8.876], [-7.274, 5.129], [-7.274, 1.005]], "c": true }] }, { "i": { "x": 0.667, "y": 1 }, "o": { "x": 0.333, "y": 0 }, "t": 13, "s": [{ "i": [[-0.885, 1.641], [-1.112, 0.392], [0, 0], [0, 0], [-0.501, -0.843], [0, -1.817], [0.738, -0.949], [0.878, 0], [0, 0], [0, 0], [0, 2.07], [0, 0]], "o": [[1.585, -2.939], [3.607, -1.27], [0, 0], [0.98, 0], [0.592, 0.996], [0, 2.315], [-0.538, 0.693], [0, 0], [0, 0], [-2.07, 0], [0, 0], [0, -3.407]], "v": [[-4.348, -4.361], [-2.837, -9.396], [-0.694, -2.341], [2.801, -2.437], [5.189, -1.083], [6.663, 3.275], [5.614, 7.683], [3.75, 8.876], [2.755, 8.876], [-3.527, 8.876], [-7.274, 5.129], [-7.274, 1.005]], "c": true }] }, { "t": 37, "s": [{ "i": [[-1.372, 1.263], [-1.179, 0.008], [0, 0], [0, 0], [-0.501, -0.843], [0, -1.817], [0.738, -0.949], [0.878, 0], [0, 0], [0, 0], [0, 2.07], [0, 0]], "o": [[2.456, -2.262], [3.824, -0.026], [0, 0], [0.98, 0], [0.592, 0.996], [0, 2.315], [-0.538, 0.693], [0, 0], [0, 0], [-2.07, 0], [0, 0], [0, -3.407]], "v": [[-3.547, -4.753], [-0.071, -8.85], [0.31, -2.255], [3.657, -2.255], [6.045, -0.901], [7.274, 3.405], [5.981, 7.761], [3.75, 8.876], [2.755, 8.876], [-3.527, 8.876], [-7.274, 5.129], [-7.274, 1.005]], "c": true }] }], "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0.8666666666666667, 0.5411764705882353, 0.5254901960784314], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "fl", "c": { "a": 0, "k": [1, 1, 1], "ix": 4 }, "o": { "a": 0, "k": 100, "ix": 5 }, "r": 1, "bm": 0, "nm": "Fill 1", "mn": "ADBE Vector Graphic - Fill", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [19.704, 32.121], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 1", "np": 3, "cix": 2, "bm": 0, "ix": 1, "mn": "ADBE Vector Group", "hd": false }], "ip": 0, "op": 50, "st": 0, "ct": 1, "bm": 0 }, { "ddd": 0, "ind": 3, "ty": 4, "nm": "Reliable-outline-top_s1g1_s2g2_s3g1_s4g1", "parent": 4, "sr": 1, "ks": { "o": { "a": 0, "k": 100, "ix": 11 }, "r": { "a": 0, "k": 0, "ix": 10 }, "p": { "a": 0, "k": [24, 24, 0], "ix": 2, "l": 2 }, "a": { "a": 0, "k": [24, 24, 0], "ix": 1, "l": 2 }, "s": { "a": 0, "k": [100, 100, 100], "ix": 6, "l": 2 } }, "ao": 0, "shapes": [{ "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 0, "k": { "i": [[0, 0], [0, 0], [0, 0]], "o": [[0, 0], [0, 0], [0, 0]], "v": [[-4.495, 0.054], [-1.534, 3.015], [4.495, -3.015]], "c": false }, "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0.8666666666666667, 0.5411764705882353, 0.5254901960784314], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [28.103, 20.678], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 1", "np": 2, "cix": 2, "bm": 0, "ix": 1, "mn": "ADBE Vector Group", "hd": false }, { "ty": "tm", "s": { "a": 1, "k": [{ "i": { "x": [0.667], "y": [1] }, "o": { "x": [0.333], "y": [0] }, "t": 0, "s": [0] }, { "i": { "x": [0.667], "y": [1] }, "o": { "x": [0.333], "y": [0] }, "t": 25, "s": [100] }, { "t": 49, "s": [0] }], "ix": 1 }, "e": { "a": 1, "k": [{ "i": { "x": [0.667], "y": [1] }, "o": { "x": [0.333], "y": [0] }, "t": 0, "s": [100] }, { "i": { "x": [0.667], "y": [1] }, "o": { "x": [0.333], "y": [0] }, "t": 25, "s": [100] }, { "t": 44, "s": [100] }], "ix": 2 }, "o": { "a": 1, "k": [{ "i": { "x": [0.667], "y": [1] }, "o": { "x": [0.333], "y": [0] }, "t": 25, "s": [0] }, { "t": 48, "s": [360] }], "ix": 3 }, "m": 1, "ix": 2, "nm": "Trim Paths 1", "mn": "ADBE Vector Filter - Trim", "hd": false }], "ip": 0, "op": 50, "st": 0, "ct": 1, "bm": 0 }, { "ddd": 0, "ind": 4, "ty": 4, "nm": "Reliable-outline-top_s1g1_s2g1_s3g1_s4g1_background", "sr": 1, "ks": { "o": { "a": 0, "k": 100, "ix": 11 }, "r": { "a": 0, "k": 0, "ix": 10 }, "p": { "a": 0, "k": [28, 22, 0], "ix": 2, "l": 2 }, "a": { "a": 0, "k": [28, 22, 0], "ix": 1, "l": 2 }, "s": { "a": 1, "k": [{ "i": { "x": [0.667, 0.667, 0.667], "y": [1, 1, 1] }, "o": { "x": [0.333, 0.333, 0.333], "y": [0, 0, 0] }, "t": 0, "s": [100, 100, 100] }, { "i": { "x": [0.667, 0.667, 0.667], "y": [1, 1, 1] }, "o": { "x": [0.333, 0.333, 0.333], "y": [0, 0, 0] }, "t": 25, "s": [91.173, 91.173, 100] }, { "t": 49, "s": [100, 100, 100] }], "ix": 6, "l": 2 } }, "ao": 0, "shapes": [{ "ty": "gr", "it": [{ "ind": 0, "ty": "sh", "ix": 1, "ks": { "a": 0, "k": { "i": [[1.561, -1.356], [0, 0], [2.685, 2.332], [0, 0], [0, 2.067], [0, 0], [-3.942, 0], [0, 0], [0, -3.942], [0, 0]], "o": [[0, 0], [-2.685, 2.332], [0, 0], [-1.561, -1.356], [0, 0], [0, -3.942], [0, 0], [3.943, 0], [0, 0], [0, 2.067]], "v": [[10.517, 8.178], [4.682, 13.247], [-4.682, 13.247], [-10.516, 8.178], [-12.973, 2.789], [-12.973, -8.441], [-5.835, -15.579], [5.835, -15.579], [12.973, -8.441], [12.973, 2.789]], "c": true }, "ix": 2 }, "nm": "Path 1", "mn": "ADBE Vector Shape - Group", "hd": false }, { "ty": "st", "c": { "a": 0, "k": [0, 0, 0], "ix": 3 }, "o": { "a": 0, "k": 100, "ix": 4 }, "w": { "a": 0, "k": 1, "ix": 5 }, "lc": 2, "lj": 2, "bm": 0, "nm": "Stroke 1", "mn": "ADBE Vector Graphic - Stroke", "hd": false }, { "ty": "fl", "c": { "a": 0, "k": [1, 1, 1], "ix": 4 }, "o": { "a": 0, "k": 100, "ix": 5 }, "r": 1, "bm": 0, "nm": "Fill 1", "mn": "ADBE Vector Graphic - Fill", "hd": false }, { "ty": "tr", "p": { "a": 0, "k": [28.104, 22.582], "ix": 2 }, "a": { "a": 0, "k": [0, 0], "ix": 1 }, "s": { "a": 0, "k": [100, 100], "ix": 3 }, "r": { "a": 0, "k": 0, "ix": 6 }, "o": { "a": 0, "k": 100, "ix": 7 }, "sk": { "a": 0, "k": 0, "ix": 4 }, "sa": { "a": 0, "k": 0, "ix": 5 }, "nm": "Transform" }], "nm": "Group 1", "np": 3, "cix": 2, "bm": 0, "ix": 1, "mn": "ADBE Vector Group", "hd": false }], "ip": 0, "op": 50, "st": 0, "ct": 1, "bm": 0 }], "markers": [], "props": {} }
});
