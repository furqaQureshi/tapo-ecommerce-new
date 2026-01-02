
        $(document).ready(function() {
            let isProcessing = false;

            /** =========================
             *  Variant Selection
             *  ========================= */
            $(document).on('click', '.pricing-card', function() {
                $('.pricing-card').removeClass('active');
                $(this).addClass('active');

                selectedPrice = parseFloat($(this).data('price'));
                productStock = parseInt($(this).data('var-qty')) || 0;

                let variantId = $(this).data('id');
                let productId = $(this).data('product-id');
                let qty = parseInt($('.qty').val()) || 1;

                if (qty > productStock) {
                    qty = productStock;
                    $('.qty').val(qty);
                    toastr.warning(window.lang.maximumStockLimitIs `${productStock}`);
                }

                $('#addToCartBtn')
                    .attr('data-price', selectedPrice)
                    .attr('data-stock', productStock)
                    .attr('data-variant-id', variantId)
                    .attr('data-product-id', productId);

                updatePriceDisplay(selectedPrice, qty);
            });

            /** =========================
             *  Quantity Handlers
             *  ========================= */
            // $('.qtyplus').off('click.quantity').on('click.quantity', function(e) {
            //     e.preventDefault();
            //     if (isProcessing) return;
            //     isProcessing = true;

            //     let $qtyInput = $(this).closest('.quantity').find('.qty');
            //     let qty = parseInt($qtyInput.val()) || 1;

            //     if (qty < productStock) {
            //         qty++;
            //         $qtyInput.val(qty);
            //         updatePriceDisplay(selectedPrice, qty);
            //     } else {
            //         toastr.warning(window.lang.maximumStockReached `(${productStock})`);
            //     }

            //     setTimeout(() => isProcessing = false, 200);
            // });

            // $('.qtyminus').off('click.quantity').on('click.quantity', function(e) {
            //     e.preventDefault();
            //     if (isProcessing) return;
            //     isProcessing = true;

            //     let $qtyInput = $(this).closest('.quantity').find('.qty');
            //     let qty = parseInt($qtyInput.val()) || 1;

            //     if (qty > 1) {
            //         qty--;
            //         $qtyInput.val(qty);
            //         updatePriceDisplay(selectedPrice, qty);
            //     }

            //     setTimeout(() => isProcessing = false, 200);
            // });

            // $('.qty').off('input.quantity').on('input.quantity', function() {
            //     let qty = parseInt($(this).val()) || 1;

            //     if (qty < 1) qty = 1;
            //     if (qty > productStock) {
            //         qty = productStock;
            //         toastr.warning(window.lang.maximumStockLimitIs `${productStock}`);
            //     }

            //     $(this).val(qty);
            //     updatePriceDisplay(selectedPrice, qty);
            // });

            // function updatePriceDisplay(price, quantity) {
            //     let total = (price * quantity).toFixed(2);
            //     $('#product_price').html(
            //         `{{ config('app.currency') }} ${total} 
            //         @if ($priceData['original_price']) 
            //             <del>{{ $priceData['original_price'] }}</del> 
            //         @endif`
            //     );
            // }

            /** =========================
             *  Add to Cart
             *  ========================= */
            $('.add-to-cart-btn').off('click').on('click', function() {
                var $button = $(this);
                var product_id = $button.data('product-id');
                var price = $button.data('price');
                var stock = parseInt($button.data('stock'));
                var quantity = parseInt($('.qty').val()) || 1;
                var variantID = null;
                var selectedAttribute = [];

                $('.attribute-badge.active').each(function() {
                    selectedAttribute.push({
                        id: $(this).data('id'),
                        name: $(this).data('name'),
                        value: $(this).data('value')
                    });
                });

                if (hasAttributes && selectedAttribute.length === 0) {
                    toastr.warning(window.lang.pleaseSelectAttributes);
                    return false;
                }

                if ($('.pricing-card').length > 0) {
                    var selected = $('.pricing-card.active');
                    if (selected.length === 0) {
                        toastr.error('{{ __("lang.Please_select_variant") }}');
                        return;
                    }
                    variantID = selected.data('id');
                    price = selected.data('price');
                    stock = selected.data('var-qty');
                }

                if (quantity > stock) {
                    toastr.error(window.lang.cannotAddMore);
                    return;
                }

                var data = {
                    _token: window.csrfToken,
                    product_id: product_id,
                    variant_id: variantID,
                    price: price,
                    quantity: quantity,
                    stock: stock,
                    attribute_id: selectedAttribute
                };

                $.post(window.addCartUrl, data, function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        updateCartSidebar(response.cartItems, response.totalPrice);
                        $('.menu-cart.style-2 .cart-box').show();
                        updateCartCount(response.cartCount);
                    } else {
                        toastr.error(response.message || 'Failed to add to cart.');
                    }
                }).fail(function(xhr) {
                    let msg = xhr.responseJSON?.message || 'Failed to add to cart.';
                    toastr.error(msg);
                });
            });

            /** =========================
             *  Remove from Cart
             *  ========================= */
            $(document).on('click', '.remove-cart-item', function() {
                var $item = $(this).closest('li');
                var data = {
                    _token: window.csrfToken,
                    product_id: $item.data('product-id'),
                    is_model: $item.data('is-model') === 1
                };

                Swal.fire({
                    title: window.lang.areYouSure,
                    text: window.lang.doYouWantRemove,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, remove it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post(window.cartRemove, data, function(response) {
                            if (response.success) {
                                toastr.success(response.message);
                                updateCartSidebar(response.cartItems, response.totalPrice);
                                updateCartCount(response.cartCount);
                            } else {
                                toastr.error('Failed to remove item.');
                            }
                        }).fail(() => toastr.error('Failed to remove item.'));
                    }
                });
            });

            /** =========================
             *  Cart Sidebar
             *  ========================= */
            function updateCartSidebar(cartItems, totalPrice) {
                var $cartList = $('.menu-cart.style-2 .cart-box ul');
                var $cartTotal = $('.totalPrice');
                $cartList.empty();

                if (cartItems.length > 0) {
                    var groupedItems = {};
                    $.each(cartItems, function(_, item) {
                        var productId = item.product_id || item.id;
                        if (!groupedItems[productId]) {
                            groupedItems[productId] = { ...item, quantity: 0 };
                        }
                        groupedItems[productId].quantity += parseInt(item.quantity, 10);
                    });

                    // $.each(groupedItems, function(_, item) {
                    //     var photo = item.image ?
                    //         (item.image.includes(',') ?
                    //             window.baseURL + '/' + item.image.split(',')[0].trim() :
                    //             window.baseURL + '/' + item.image) :
                    //         window.baseURL + '/front/assets/img/product/01.jpg';

                    //     $cartList.append(`
                    //         <li data-product-id="${item.id}" data-is-model="0">
                    //             <a href="javascript:void(0);" class="remove remove-cart-item">
                    //                 <i class="fa fa-remove"></i>
                    //             </a>
                    //             <img src="${photo}" alt="${item.name}" />
                    //             <div class="cart-product">
                    //                 <a href="{{ route('product.detail', '') }}/${item.slug}" target="_blank">${item.name}</a>
                    //                 <span>RM ${parseFloat(item.price).toFixed(2)}</span>
                    //                 <p class="quantity">${item.quantity} x</p>
                    //             </div>
                    //         </li>
                    //     `);
                    // });

                    $.each(groupedItems, function(_, item) {
                        var photo = item.image ?
                            (item.image.includes(',') ?
                                window.baseURL + '/' + item.image.split(',')[0].trim() :
                                window.baseURL + '/' + item.image) :
                            window.baseURL + '/front/assets/img/product/01.jpg';

                        // Build attributes HTML if available
                        var attributesHtml = '';
                        if (item.attributes && item.attributes.length > 0) {
                            attributesHtml = '<div class="mt-2">';
                            $.each(item.attributes, function(_, attr) {
                                attributesHtml += `<span class="mt-2" style="display:inline;"><small>${attr.name}: ${attr.value}</small></span> `;
                            });
                            attributesHtml += '</div>';
                        }

                        $cartList.append(`
                            <li data-product-id="${item.id}" data-is-model="0">
                                <a href="javascript:void(0);" class="remove remove-cart-item">
                                    <i class="fa fa-remove"></i>
                                </a>
                                <img src="${photo}" alt="${item.name}" />
                                <div class="cart-product">
                                    <a href="{{ route('product.detail', '') }}/${item.slug}" target="_blank">${item.name}</a>
                                    <br>
                                    ${attributesHtml}
                                    <span>RM ${parseFloat(item.price).toFixed(2)}</span>
                                    <p class="quantity">${item.quantity} x</p>
                                </div>
                            </li>
                        `);
                    });

                    $cartTotal.text(`RM ${parseFloat(totalPrice).toFixed(2)}`);
                    $('.menu-cart.style-2 .cart-box .cart-button').show();
                } else {
                    $cartList.append('<li>{{ __("lang.no_item_cart") }}</li>');
                    $cartTotal.text(`RM 0.00`);
                    $('.menu-cart.style-2 .cart-box .cart-button').hide();
                }
            }

            function updateCartCount(count) {
                var $cartIconCount = $('.menu-cart.style-2 .cart-icon .total-count');
                count > 0 ? $cartIconCount.text(count).show() : $cartIconCount.hide();
            }

            /** =========================
             *  Sidebar Toggle
             *  ========================= */
            var $menuCart = $(".menu-cart.style-2"),
                $cartBox = $menuCart.find(".cart-box"),
                $cartIcon = $menuCart.find(".cart-icon");

            $cartBox.hide();

            $cartIcon.on("click", function(e) {
                e.preventDefault();
                $cartBox.toggle();
            });

            $(document).on("click mousedown", function(e) {
                if (!$menuCart.is(e.target) && $menuCart.has(e.target).length === 0) {
                    $cartBox.hide();
                }
            });

            $("#cartCloseHeader").on("click", function() {
                $(this).closest(".cart-box").hide();
            });
        });