<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tapo</title>

    <!--====== Toastr CSS ======-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">
    <!--====== Google Fonts ======-->
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!--====== Flaticon css ======-->
    <link rel="stylesheet" href="{{ asset('assets/fonts/flaticon/flaticon_bistly.css') }}">
    <!--====== FontAwesome css ======-->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/css/all.min.css') }}">
    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/bootstrap.min.css') }}">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!--====== Slick-popup css ======-->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/slick.css') }}">
    <!--====== Magnific-popup css ======-->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/magnific-popup.css') }}">
    <!--====== Nice Select CSS ======-->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/nice-select.css') }}">
    <!--====== AOS Animation ======-->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/aos.css') }}">
    <!--====== Common Style css ======-->
    <link rel="stylesheet" href="{{ asset('assets/css/common-style.css') }}">
    <!--====== Page Styles ======-->
    <link rel="stylesheet" href="{{ asset('assets/css/pages/innerpages.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/home.css') }}">

</head>

<body>

@include('front.layouts.urwah_partials.header')


<div id="smooth-wrapper">
    <div id="smooth-content">
        @yield('content')
        @include('front.layouts.urwah_partials.footer')
    </div>
</div>

<!-- WhatsApp Floating Button -->
<a href="https://api.whatsapp.com/send/?phone=%2B601130117699&text=Hi+Hannah+%F0%9F%91%8B%F0%9F%8F%BC+I+saw+Tapo%E2%80%99s+food+packaging+and+wah%2C+really+nice+lah+%F0%9F%98%8D+Can+share+more+details+with+me%3F+%F0%9F%99%8F%F0%9F%8F%BC&type=phone_number&app_absent=0"
   class="whatsapp-float" target="_blank" title="Chat with us on WhatsApp">
    <svg class="whatsapp-icon" viewBox="0 0 24 24">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.108"/>
    </svg>
</a>

<!--====== JS Files ======-->

<!-- jQuery (only once) -->
<script src="{{ asset('assets/js/plugins/jquery-3.7.1.min.js') }}"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Bootstrap -->
<script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>

<!-- GSAP -->
<script src="{{ asset('assets/js/plugins/gsap/gsap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/gsap/SplitText.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/gsap/ScrollSmoother.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/gsap/ScrollTrigger.min.js') }}"></script>

<!-- Others -->
<script src="{{ asset('assets/js/plugins/jquery.waypoints.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/aos.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/common.js') }}"></script>
<script src="{{ asset('assets/js/home.js') }}"></script>
<script src="{{ asset('assets/js/innerpage.js') }}"></script>

<script>
       function minusQuantity(productId, typee, boxId)
        {
            let box = boxId;
            if(boxId == null)
            {
                box = "";
            }
            let quantity = $('#quantity'+productId+box).html();
            quantity = parseInt(quantity);
            quantity--;
            if(quantity>0)
            {
                $.ajax({
                    url: "{{ url('minus-quantity') }}",
                    type:"POST",
                    data:{
                            _token: "{{ csrf_token() }}",
                            product_id:productId,
                            box_id:box,
                            quantity:quantity,
                            type:typee
                            },
                    dataType:"JSON",
                    success:function(result){
                        $('#quantity'+productId+result.box_id).html(result.quantity);
                        $('.sb-new-total').html('RM '+result.total_price);
                        let freeShippingAmount = "{{ !empty($freeShippingPrice) ? $freeShippingPrice : '' }}";
                        updateProgressBar(freeShippingAmount, result.total_price);
                        console.log(result);
                    }
                });
            }
        }



        function plusQuantity(productId, typee, boxId)
        {
            let box = boxId;
            if(boxId == null)
            {
                box = "";
            }
            let quantity = $('#quantity'+productId+box).html();
            quantity = parseInt(quantity);
            quantity++;
            $.ajax({
               url: "{{ url('plus-quantity') }}",
               type:"POST",
               data:{
                _token: "{{ csrf_token() }}",
                product_id:productId,
                type:typee,
                box_id:box,
                quantity:quantity
            },
               dataType:"JSON",
               success:function(result){
                $('#quantity'+productId+result.box_id).html(result.quantity);
                $('.sb-new-total').html('RM '+result.total_price);
                let freeShippingAmount = "{{ !empty($freeShippingPrice) ? $freeShippingPrice : '' }}";
                updateProgressBar(freeShippingAmount, result.total_price);
                console.log(result);
               }
            });
        }

        function deleteItemFromCart(productId, typee, boxId)
        {
              $.ajax({
               url: "{{ url('delete-item-from-cart') }}",
               type:"POST",
               data:{
                _token: "{{ csrf_token() }}",
                product_id:productId,
                type: typee,
                box_id: boxId
            },
               dataType:"JSON",
               success:function(result){
                window.location.href = "{{ url('/') }}";
               }
            });
        }

        // To update sidebar progress bar
        function updateProgressBar(freeShippingAmount, totalAmount)
        {
            freeShippingAmount = parseFloat(freeShippingAmount);
            totalAmount = parseFloat(totalAmount);
            let percentage;

            if(freeShippingAmount-totalAmount > 0)
            {
                percentage = totalAmount*100/freeShippingAmount;
                percentage = parseInt(percentage);
                percentage += '%';
                $('.sb-progress-bar').css('width',percentage);
                $('#buy-amount').html('RM '+totalAmount.toFixed(2));
                let remainingAmount = freeShippingAmount-totalAmount;
                $('.sb-progress-text').html(`Only RM ${remainingAmount.toFixed(2)} away from <strong>FREE SHIPPING</strong>`);
                $('.sb-progress-bar-container').css('display','block');
            }
            else
            {
                $('.sb-progress-text').html('<strong>CONGRATULATION!</strong> You Availed <strong>FREE SHIPPING</strong>');
                $('.sb-progress-bar-container').css('display','none');
            }
        }
        // To update sidebar progress bar
</script>
@yield('script')

</body>
</html>
