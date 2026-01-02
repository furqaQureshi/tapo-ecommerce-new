/*----------------------------------------------------------------------------------- 


------------------------------------------------------
   JS INDEX
-----------------------------------------------------

	# Main Menu
	# Offcanvas Overlay
	# Preloader
	# Sticky
	# Magnific-Popup JS
	# Counter JS
	# Nice Select Js
	# AOS Animation
	# GSAP Animation

-------------------------------------------------------    */

(function($) {
	'use strict';

	//===== Main Menu

	function mainMenu() {
		var var_window = $(window),
			navContainer = $('.header-navigation'),
			navbarToggler = $('.navbar-toggler'),
			navMenu = $('.theme-nav-menu'),
			navMenuLi = $('.theme-nav-menu ul li ul li'),
			closeIcon = $('.navbar-close');
		navbarToggler.on('click', function() {
			navbarToggler.toggleClass('active');
			navMenu.toggleClass('menu-on');
		});
		closeIcon.on('click', function() {
			navMenu.removeClass('menu-on');
			navbarToggler.removeClass('active');
		});
		navMenu.find("li a").each(function() {
			if ($(this).children('.dd-trigger').length < 1) {
				if ($(this).next().length > 0) {
					$(this).append('<span class="dd-trigger"><i class="far fa-angle-down"></i></span>')
				}
			}
		});
		navMenu.on('click', '.dd-trigger', function(e) {
			e.preventDefault();
			$(this).parent().parent().siblings().children('ul.sub-menu').slideUp();
			$(this).parent().next('ul.sub-menu').stop(true, true).slideToggle(350);
			$(this).toggleClass('sub-menu-open');
		});

	};

	//===== Offcanvas Overlay

	function offCanvas() {
		const $overlay = $(".offcanvas__overlay");
		const $toggler = $(".navbar-toggler");
		const $menu = $(".theme-nav-menu");
		$toggler.add($overlay).add(".navbar-close, .panel-close-btn").on("click", function() {
			$overlay.toggleClass("overlay-open");
			if ($(this).is($overlay)) {
				$toggler.removeClass("active");
				$menu.removeClass("menu-on");
			}
		});
		$(window).on("resize", function() {
			if ($(window).width() > 991) $overlay.removeClass("overlay-open");
		});
	}

	//===== Preloader

	$(window).on('load', function(event) {
		$('.preloader').delay(500).fadeOut(500);
	})

	//===== Sticky

	$(document).ready(function () {
        function initStickyHeader(headerSelector) {
            const header = $(headerSelector);
            let lastScroll = 0;
    
            $(window).on('scroll', function () {
                const currentScroll = $(this).scrollTop();
                if (currentScroll > 200) {
                    if (currentScroll < lastScroll) {
                        if (!header.hasClass('sticky')) {
                            header.addClass('sticky');
                        }
                    } else {
                        header.removeClass('sticky');
                    }
                } else if (currentScroll === 0) {
                    header.removeClass('sticky');
                }
                lastScroll = currentScroll;
            });
        }
        initStickyHeader('.header-area');
    });


	//===== Magnific-popup js

	if ($('.video-popup').length) {
		$('.video-popup').magnificPopup({
			type: 'iframe',
			removalDelay: 300,
			mainClass: 'mfp-fade'
		});
	}
	if ($('.play-btn').length) {
		$('.play-btn').magnificPopup({
			type: 'iframe',
			removalDelay: 300,
			mainClass: 'mfp-fade'
		});
	}
	// ===== Counter

	if ($('.counter').length) {
		const observer = new IntersectionObserver((entries, observer) => {
			entries.forEach(entry => {
				if (entry.isIntersecting) {
					$(entry.target).counterUp({
						delay: 100,
						time: 4000
					});
					observer.unobserve(entry.target);
				}
			});
		}, {
			threshold: 1.0
		});
		$('.counter').each(function() {
			observer.observe(this);
		});
	}

	

  	//====== Aos 

	AOS.init({
		offset: 0
	});

	//===== Gasp Registration

	gsap.registerPlugin(SplitText, ScrollTrigger, ScrollSmoother);

	// Gsap ScrollSmoother

	if (window.innerWidth > 991) {
		ScrollSmoother.create({
		  smooth: 1,
		  effects: true
		});
	}

	// Gsap Text Animation

	if ($('.text-anm').length) {
		const animatedTextElements = document.querySelectorAll('.text-anm');
		animatedTextElements.forEach((element) => {
			let animationSplitText = new SplitText(element, {
				type: "chars,words"
			});
			gsap.from(animationSplitText.chars, {
				duration: .8,
				delay: 0.3,
				x: 50,
				autoAlpha: 0,
				stagger: 0.050,
				ease: "power2.out",
				scrollTrigger: {
					trigger: element,
					start: "top 85%"
				}
			});
		});
	}

	// Document Ready

	$(function() {
		mainMenu();
		offCanvas();
	});

})(window.jQuery);


$(document).ready(function() {
    // Open cart function
    window.openCart = function() {
        $('.sb-sidebar-overlay').addClass('sb-active');
        $('.sb-cart-sidebar').addClass('sb-active');
        $('body').css('overflow', 'hidden');
    }

    // Close cart function
    window.closeCart = function() {
        $('.sb-sidebar-overlay').removeClass('sb-active');
        $('.sb-cart-sidebar').removeClass('sb-active');
        $('body').css('overflow', 'auto');
    }

    // Add to cart button click
    $(document).on('click', '.sb-addtocart-btn', function() {
        openCart();
    });

    // Header cart icon click (if exists)
    $(document).on('click', '.cartbtn', function() {
        openCart();
    });

    // Close button click
    $(document).on('click', '.sb-close-btn', function() {
        closeCart();
    });

    // Overlay click to close
    $(document).on('click', '.sb-sidebar-overlay', function() {
        closeCart();
    });

    // Escape key to close cart
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCart();
        }
    });

    // Progress bar animation on load
    setTimeout(function() {
        // $('.sb-progress-bar').css('width', '70%');
    }, 500);

    // Test function
    console.log('Cart script loaded successfully!');
});

// Alternative global functions for inline onclick
function sbOpenCart() {
    $('.sb-sidebar-overlay').addClass('sb-active');
    $('.sb-cart-sidebar').addClass('sb-active');
    $('body').css('overflow', 'hidden');
}

function sbCloseCart() {
    $('.sb-sidebar-overlay').removeClass('sb-active');
    $('.sb-cart-sidebar').removeClass('sb-active');
    $('body').css('overflow', 'auto');
}

// Load More Reviews Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Load More Reviews
    document.getElementById('loadMoreBtn').addEventListener('click', function() {
        const hiddenReviews = document.querySelectorAll('.sn-review-item.sn-hidden');
        const reviewsToShow = Array.from(hiddenReviews).slice(0, 2);
        
        reviewsToShow.forEach(review => {
            review.classList.remove('sn-hidden');
            review.style.opacity = '0';
            setTimeout(() => {
                review.style.transition = 'opacity 0.5s ease';
                review.style.opacity = '1';
            }, 10);
        });
        
        const remainingReviews = document.querySelectorAll('.sn-review-item.sn-hidden').length;
        if (remainingReviews === 0) {
            this.innerHTML = '<i class="fas fa-check me-2"></i>All Reviews Loaded';
            this.disabled = true;
        } else {
            this.innerHTML = `<i class="fas fa-chevron-down me-2"></i>Load More Reviews (${remainingReviews} remaining)`;
        }
    });
    
    // Initialize load more button text
    const totalHiddenReviews = document.querySelectorAll('.sn-review-item.sn-hidden').length;
    document.getElementById('loadMoreBtn').innerHTML = `<i class="fas fa-chevron-down me-2"></i>Load More Reviews (${totalHiddenReviews} more)`;
});
function toggleReviewForm() {
    const formContainer = document.getElementById('reviewFormContainer');
    formContainer.classList.toggle('show');
}

$(document).ready(function() {
    $('.voucher-btn').click(function() {
        $('.voucher-field').slideToggle(300);
        $('.fa-chevron-down').toggleClass('down');
    });

    $('.apply-btn').click(function() {
        let voucherCode = $('.voucher-field input').val();
        if (voucherCode) {
            alert('Voucher code applied: ' + voucherCode);
        } else {
            alert('Please enter a voucher code');
        }
    });

    $('#openPopup').click(function() {
        $('#overlay, #popup').fadeIn();
    });

    $('#overlay, #closePopup').click(function() {
        $('#overlay, #popup').fadeOut();
    });


    // Subscription page //
    let cart = [];
    const freeShippingThreshold = 300.00;
    const discountPercentage = 0.05;
    let selectedInterval = 2;

    $('.tsub-interval-btn').click(function() {
        $('.tsub-interval-btn').removeClass('active');
        $(this).addClass('active');
        selectedInterval = $(this).data('interval');
        if (selectedInterval === 'custom') {
            $('.tsub-custom-interval').addClass('active');
        } else {
            $('.tsub-custom-interval').removeClass('active');
            updateIntervalDisplay();
        }
    });

    $('#customInterval').change(function() {
        selectedInterval = parseInt($(this).val());
        updateIntervalDisplay();
    });

    $('.tsub-add-to-cart').click(function(e) {
        e.preventDefault();
        const name = $(this).data('name');
        const price = parseFloat($(this).data('price'));
        let item = cart.find(i => i.name === name);
        if (item) {
            item.quantity++;
        } else {
            cart.push({ name, price, quantity: 1 });
        }
        updateCart();
        showCart();
    });

    $(document).on('click', '.qty-minus, .qty-plus', function() {
        const name = $(this).data('name');
        const item = cart.find(i => i.name === name);
        if (!item) return;
        if ($(this).hasClass('qty-minus')) {
            if (item.quantity > 1) item.quantity--;
            else cart = cart.filter(i => i.name !== name);
        } else {
            item.quantity++;
        }
        updateCart();
    });

    $(document).on('click', '.remove-item', function() {
        const name = $(this).data('name');
        cart = cart.filter(i => i.name !== name);
        updateCart();
    });

    function updateCart() {
        let subtotal = 0;
        let html = '';
        cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            subtotal += itemTotal;
            html += `
                <div class="tsub-cart-item">
                    <div class="cname">${item.name}</div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="quantity-controls">
                            <button class="qty-btn qty-minus" data-name="${item.name}">-</button>
                            <span>${item.quantity}</span>
                            <button class="qty-btn qty-plus" data-name="${item.name}">+</button>
                        </div>
                        <div class="cprice">RM ${(itemTotal).toFixed(2)}</div>
                        <button class="remove-item" data-name="${item.name}">×</button>
                    </div>
                </div>
            `;
        });
        $('#tsub-cartItems').html(html || '<p class="text-muted">Your cart is empty</p>');
        const discount = subtotal * discountPercentage;
        const total = subtotal - discount;

        $('#tsub-subtotal').text('RM ' + subtotal.toFixed(2));
        $('#tsub-discount').text(discount.toFixed(2));
        $('#tsub-total').text('RM ' + total.toFixed(2));
    }

    function updateIntervalDisplay() {
        const intervalText = selectedInterval === 'custom' ? $('#customInterval option:selected').text() : `Every ${selectedInterval} Week${selectedInterval > 1 ? 's' : ''}`;
        $('#tsub-selected-interval').text(intervalText);
    }

    function showCart() {
        $('#tsub-cartPanel').addClass('d-block');
        $('#tsub-cartOverlay').removeClass('d-none');
    }

    $('#tsub-closeCart, #tsub-cartOverlay').click(function() {
        $('#tsub-cartPanel').removeClass('d-block');
        $('#tsub-cartOverlay').addClass('d-none');
    });

    $('#tsub-checkoutBtn').click(function() {
        if (cart.length === 0) {
            alert('Please add items to your cart!');
            return;
        }
        const intervalText = $('#tsub-selected-interval').text();
        alert(`Checkout with ${cart.length} items. Interval: ${intervalText}. Total: RM ${$('#tsub-total').text()}`);
    });

    updateCart();
    updateIntervalDisplay();
});