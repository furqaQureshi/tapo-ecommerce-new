{{-- tapu links --}}
 <!--====== Jquery js ======-->
        <script src="{{ asset('assets/js/plugins/jquery-3.7.1.min.js') }}"></script>
        <!--====== Bootstrap js ======-->
        <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
        <!--====== Bootstrap js ======-->
        <script src="assets/js/plugins/bootstrap.min.js') }}"></script>
        <!--====== Gsap Js ======-->
        <script src="{{ asset('assets/js/plugins/gsap/gsap.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/gsap/SplitText.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/gsap/ScrollSmoother.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/gsap/ScrollTrigger.min.js') }}"></script>
        <!--====== Waypoint js ======-->
        <script src="{{ asset('assets/js/plugins/jquery.waypoints.js') }}"></script>
        <!--====== CounterUp js ======-->
        <script src="{{ asset('assets/js/plugins/jquery.counterup.min.js') }}"></script>
        <!--====== Slick js ======-->
        <script src="{{ asset('assets/js/plugins/slick.min.js') }}"></script>
        <!--====== Magnific js ======-->
        <script src="{{ asset('assets/js/plugins/jquery.magnific-popup.min.js') }}"></script>
        <!--====== Nice Select js ======-->
        <script src="{{ asset('assets/js/plugins/jquery.nice-select.min.js') }}"></script>
        <!--====== AOS js ======-->
        <script src="{{ asset('assets/js/plugins/aos.js') }}"></script>
        <!--====== Main js ======-->
        <script src="{{ asset('assets/js/common.js') }}"></script>
        <!--====== home js ======-->
        <script src="{{ asset('assets/js/home.js') }}"></script>
        <!--====== InnerPage js ======-->
        <script src="{{ asset('assets/js/innerpage.js') }}"></script>
{{-- tapu links end --}}

<!--<< All JS Plugins >>-->
<script src="{{ asset('front/assets/js/jquery-3.7.1.min.js') }}"></script>
<!--<< Viewport Js >>-->
<script src="{{ asset('front/assets/js/viewport.jquery.js') }}"></script>
<!--<< Bootstrap Js >>-->
<script src="{{ asset('front/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('front/assets/js/jquery.nice-select.min.js') }}"></script>
<!--<< Waypoints Js >>-->
<script src="{{ asset('front/assets/js/jquery.waypoints.js') }}"></script>
<!--<< Counterup Js >>-->
<script src="{{ asset('front/assets/js/jquery.counterup.min.js') }}"></script>
<!--<< Swiper Slider Js >>-->
<script src="{{ asset('front/assets/js/swiper-bundle.min.js') }}"></script>
<!--<< MeanMenu Js >>-->
<script src="{{ asset('front/assets/js/jquery.meanmenu.min.js') }}"></script>
<!--<< Magnific Popup Js >>-->
<script src="{{ asset('front/assets/js/jquery.magnific-popup.min.js') }}"></script>
<!--<< Wow Animation Js >>-->
<script src="{{ asset('front/assets/js/wow.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.9.6/lottie.min.js"></script>
<script>
    window.baseURL = "{{ url('/') }}";
    window.addCartUrl = "{{ route('cart.add') }}";
    window.cartRemove = "{{ route('cart.remove') }}";
    window.csrfToken = "{{ csrf_token() }}";
    window.imgBasePath = "{{ asset('front/assets') }}"
    window.appCurrency   = "{{ config('app.currency') }}";

    window.lang = {
        maximumStockLimitIs: "{{ __('lang.Maximum_stock_limit_is') }}",
        maximumStockReached: "{{ __('lang.Maximum_stock_limit_reached') }}",
        pleaseSelectAttributes: "{{ __('lang.Please_select_attributes') }}",
        pleaseSelectVariant: "{{ __('lang.Please_select_variant') }}",
        cannotAddMore: "{{ __('lang.Cannot_add_more_than_available_stock') }}",
        areYouSure: "{{ __('lang.are_you_sure') }}",
        doYouWantRemove: "{{ __('lang.do_you_to_remove_this_item') }}",
        noItemCart: "{{ __('lang.no_item_cart') }}"
    }
</script>
<!--<< Main.js >>-->
<script src="{{ asset('front/assets/js/main.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // For nice-select to initialize
        // if ($('.nice-select').length) {
        //     $('.nice-select').niceSelect(); // if you're using nice-select plugin
        // }

        // $('#language-select').on('change', function() {
        //     var selectedLang = $(this).val();
        //     window.location.href = "/lang/" + selectedLang;
        // });
    });
</script>
<script>
    $(document).ready(function() {
        const languageSwitcher = $('#languageSwitcher');
        const languageDisplay = $('#languageDisplay');
        const languageDropdown = $('#languageDropdown');
        const currentFlag = $('#currentFlag');
        const currentLang = $('#currentLang');
        const hiddenSelect = $('#language-select');

        // Set current language based on your Laravel locale
        const currentLocale = '{{ app()->getLocale() }}'; // Replace with actual Laravel locale
        setCurrentLanguage(currentLocale);

        // Toggle dropdown
        languageDisplay.on('click', function(e) {
            e.stopPropagation();
            languageSwitcher.toggleClass('open');
        });

        // Close dropdown when clicking outside
        $(document).on('click', function() {
            languageSwitcher.removeClass('open');
        });

        // Handle language selection
        $('.language-option').on('click', function() {
            const selectedLang = $(this).data('lang');
            const selectedFlag = $(this).data('flag');
            const selectedText = $(this).find('span:last-child').text();

            // Update display
            currentFlag.text(selectedFlag);
            currentLang.text(selectedText);

            // Update active state
            $('.language-option').removeClass('active');
            $(this).addClass('active');

            // Update hidden select
            hiddenSelect.val(selectedLang);

            // Close dropdown
            languageSwitcher.removeClass('open');

            // Your existing jQuery code
            window.location.href = "/lang/" + selectedLang;
        });

        // Function to set current language
        function setCurrentLanguage(locale) {
            const option = $(`.language-option[data-lang="${locale}"]`);
            if (option.length) {
                const flag = option.data('flag');
                const text = option.find('span:last-child').text();

                currentFlag.text(flag);
                currentLang.text(text);

                $('.language-option').removeClass('active');
                option.addClass('active');

                hiddenSelect.val(locale);
            }
        }

        // Your original jQuery event handler (for compatibility)
        $('#language-select').on('change', function() {
            var selectedLang = $(this).val();
            window.location.href = "/lang/" + selectedLang;
        });
    });
</script>



<script>
    @if (Session::has('success'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-center",
            "showEasing": "swing",
        }
        toastr.success("{{ session('success') }}");
    @endif

    @if (Session::has('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-center",
            "showEasing": "swing",
        }
        toastr.error("{{ session('error') }}");
    @endif

    @if (Session::has('info'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.info("{{ session('info') }}");
    @endif

    @if (Session::has('warning'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.warning("{{ session('warning') }}");
    @endif
    $(document).ready(function() {
        $('#search-input').on('keyup blur change', function() {
            let query = $(this).val();

            if (query.length > 0) {
                $.ajax({
                    url: "{{ route('product.autocomplete') }}",
                    type: "GET",
                    data: {
                        term: query
                    },
                    success: function(data) {
                        let suggestionBox = $('#suggestion-box');
                        suggestionBox.empty().show();

                        if (data.length > 0) {
                            $.each(data, function(i, product) {
                                suggestionBox.append(`
                                <li style="padding: 8px; cursor:pointer; display:flex; align-items:center; border-bottom:1px solid #eee;">
                                    <a href="${product.url}" style="display: flex; align-items: center; text-decoration:none; color:#333;">
                                        <img src="${product.image}" width="40" height="40" style="margin-right:10px; border-radius:4px;">
                                        <span>${product.name}</span>
                                    </a>
                                </li>
                            `);
                            });
                        } else {
                            suggestionBox.append(
                                '<li style="padding: 8px;">No products found</li>');
                        }
                    }
                });
            } else {
                $('#suggestion-box').hide();
            }
        });

        // Hide on click outside
        $(document).click(function(e) {
            if (!$(e.target).closest('.search-field-holder').length) {
                $('#suggestion-box').hide();
            }
        });
    });
</script>
<script>
    $(document).on('click', '.toggle-password', function() {
        console.clear();
        const targetInput = $($(this).data('target'));
        const icon = $(this).find('i');
        if (targetInput.attr('type') === 'password') {
            targetInput.attr('type', 'text');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
            targetInput.attr('type', 'password');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        }
    });
</script>
<script>
    // $(document).on('click', '.remove-cart-item', function() {
    //     const li = $(this).closest('li'); // Changed from 'tr' to 'li'
    //     const productId = li.data('product-id'); // Get product ID from data attribute
    //     const isModel = li.data('is-model'); // Get is-model from data attribute (optional)
    //     const url = "{{ route('cart.remove') }}";

    //     // Validate productId
    //     if (!productId) {
    //         toastr.error('Product ID is missing.');
    //         return;
    //     }

    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: 'Do you want to remove this item from the cart?',
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonText: 'Yes, remove it!',
    //         cancelButtonText: 'Cancel'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 url: url,
    //                 type: 'POST',
    //                 data: {
    //                     _token: '{{ csrf_token() }}',
    //                     product_id: productId,
    //                     is_model: isModel // Include only if needed; remove if not in backend
    //                     // variant_id is omitted since it's not in the HTML or defined
    //                 },
    //                 success: function(res) {
    //                     li.remove(); // Remove the <li> element
    //                     toastr.success(res.message || 'Item removed from cart.');
    //                     updateCartTotal(); // Update cart total (assumed defined elsewhere)
    //                     Swal.fire(
    //                         'Removed!',
    //                         'The item has been removed from the cart.',
    //                         'success'
    //                     );
    //                     location.reload();
    //                 },
    //                 error: function(xhr) {
    //                     toastr.error('Error occurred while removing item.');
    //                 }
    //             });
    //         }
    //     });
    // });

    // $(document).on('click', '.remove-cart-item', function() {
    //     const li = $(this).closest('li'); // Changed from 'tr' to 'li'
    //     const productId = li.data('product-id'); // Get product ID from data attribute
    //     const isModel = li.data('is-model'); // Get is-model from data attribute (optional)
    //     const url = "{{ route('cart.remove') }}";

    //     // Validate productId
    //     if (!productId) {
    //         toastr.error('Product ID is missing.');
    //         return;
    //     }

    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: 'Do you want to remove this item from the cart?',
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonText: 'Yes, remove it!',
    //         cancelButtonText: 'Cancel'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 url: url,
    //                 type: 'POST',
    //                 data: {
    //                     _token: '{{ csrf_token() }}',
    //                     product_id: productId,
    //                     is_model: isModel // Include only if needed; remove if not in backend
    //                     // variant_id is omitted since it's not in the HTML or defined
    //                 },
    //                 success: function(res) {
    //                     li.remove(); // Remove the <li> element
    //                     toastr.success(res.message || 'Item removed from cart.');
    //                     updateCartTotal(); // Update cart total (assumed defined elsewhere)
    //                     Swal.fire(
    //                         'Removed!',
    //                         'The item has been removed from the cart.',
    //                         'success'
    //                     );
    //                     location.reload();
    //                 },
    //                 error: function(xhr) {
    //                     toastr.error('Error occurred while removing item.');
    //                 }
    //             });
    //         }
    //     });
    // });
</script>
<!-- Shooping card darwar Start -->
{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        var menuCart = document.querySelector(".menu-cart.style-2");
        var cartBox = menuCart.querySelector(".cart-box");
        var cartIcon = menuCart.querySelector(".cart-icon");
        cartBox.style.display = "none";
        cartIcon.addEventListener("click", function(e) {
            e.preventDefault();
            if (
                cartBox.style.display === "none" ||
                cartBox.style.display === ""
            ) {
                cartBox.style.display = "block";
            } else {
                cartBox.style.display = "none";
            }
        });
        // Optional: Hide cart when clicking outside
        document.addEventListener("click", function(e) {
            if (!menuCart.contains(e.target)) {
                cartBox.style.display = "none";
            }
        });
    });
    document.addEventListener("DOMContentLoaded", function() {
        var closeHeader = document.getElementById("cartCloseHeader");
        // Find the nearest parent with class 'cart-box'
        if (closeHeader) {
            closeHeader.addEventListener("click", function() {
                var parent = closeHeader;
                while (parent && !parent.classList.contains("cart-box")) {
                    parent = parent.parentElement;
                }
                if (parent) {
                    parent.style.display = "none";
                }
            });
        }
        // Also close on outside click
        var cartBox = document.querySelector(".menu-cart.style-2 .cart-box");
        document.addEventListener("mousedown", function(e) {
            if (
                cartBox &&
                cartBox.style.display === "block" &&
                !cartBox.contains(e.target)
            ) {
                cartBox.style.display = "none";
            }
        });
    });
</script> --}}

{{-- refactor [NA] --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var menuCart = document.querySelector(".menu-cart.style-2");
        if (!menuCart) return;

        var cartBox = menuCart.querySelector(".cart-box");
        var cartIcon = menuCart.querySelector(".cart-icon");
        var closeHeader = document.getElementById("cartCloseHeader");

        // Toggle sidebar
        cartIcon.addEventListener("click", function(e) {
            e.preventDefault();
            cartBox.classList.toggle("active");
        });

        // Close on outside click
        document.addEventListener("click", function(e) {
            if (!menuCart.contains(e.target) && cartBox.classList.contains("active")) {
                cartBox.classList.remove("active");
            }
        });

        // Close on header button click
        if (closeHeader) {
            closeHeader.addEventListener("click", function() {
                cartBox.classList.remove("active");
            });
        }
    });
</script>

@yield('scripts')
@stack('scripts')

<script src="{{ asset('front/assets/js/cart-sidebar.js') }}"></script>


