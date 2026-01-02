<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<!--<< Header Area >>-->
<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Brainiac Creation">
    <meta name="description" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(isset($product))
    <meta property="og:url"           content="{{route('product.detail',$product->slug)}}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="{{$product->name}}" />
    <meta property="og:description"   content="{{strip_tags($product->short_description)}}" />
    <meta property="og:image"         content="{{ asset($product->image_path) }}" />
    @endif
    <!-- Meta Pixel Code -->

    <script>

        ! function(f, b, e, v, n, t, s) {

            if (f.fbq) return;

            n = f.fbq = function() {

                n.callMethod ?

                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)

            };

            if (!f._fbq) f._fbq = n;

            n.push = n;

            n.loaded = !0;

            n.version = '2.0';

            n.queue = [];

            t = b.createElement(e);

            t.async = !0;

            t.src = v;

            s = b.getElementsByTagName(e)[0];

            s.parentNode.insertBefore(t, s)

        }(window, document, 'script',

            'https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', '520112337074947');

        fbq('track', 'PageView');

    </script>



    <noscript>

        <img height="1" width="1" style="display:none"

            src="https://www.facebook.com/tr?id=520112337074947&ev=PageView&noscript=1" />

    </noscript>

    <!-- End Meta Pixel Code -->



    <!-- TikTok Pixel Code Start -->

    <script>

        ! function(w, d, t) {

            w.TiktokAnalyticsObject = t;

            var ttq = w[t] = w[t] || [];

            ttq.methods = ["page", "track", "identify", "instances", "debug", "on", "off", "once", "ready", "alias",

                    "group", "enableCookie", "disableCookie", "holdConsent", "revokeConsent", "grantConsent"

                ],

                ttq.setAndDefer = function(t, e) {

                    t[e] = function() {

                        t.push([e].concat(Array.prototype.slice.call(arguments, 0)))

                    }

                };

            for (var i = 0; i < ttq.methods.length; i++) ttq.setAndDefer(ttq, ttq.methods[i]);

            ttq.instance = function(t) {

                    for (var e = ttq._i[t] || [], n = 0; n < ttq.methods.length; n++) ttq.setAndDefer(e, ttq.methods[n]);

                    return e

                },

                ttq.load = function(e, n) {

                    var r = "https://analytics.tiktok.com/i18n/pixel/events.js",

                        o = n && n.partner;

                    ttq._i = ttq._i || {}, ttq._i[e] = [], ttq._i[e]._u = r, ttq._t = ttq._t || {}, ttq._t[e] = +new Date,

                        ttq._o = ttq._o || {}, ttq._o[e] = n || {};

                    n = document.createElement("script");

                    n.type = "text/javascript", n.async = !0, n.src = r + "?sdkid=" + e + "&lib=" + t;

                    e = document.getElementsByTagName("script")[0];

                    e.parentNode.insertBefore(n, e)

                };



            ttq.load('D3AFLSRC77UB9GL67KB0');

            ttq.page();

        }(window, document, 'ttq');

    </script>

    <!-- TikTok Pixel Code End -->



    <!-- Google Tag Manager -->

    <script>

        (function(w, d, s, l, i) {

            w[l] = w[l] || [];

            w[l].push({

                'gtm.start': new Date().getTime(),

                event: 'gtm.js'

            });

            var f = d.getElementsByTagName(s)[0],

                j = d.createElement(s),

                dl = l != 'dataLayer' ? '&l=' + l : '';

            j.async = true;

            j.src =

                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;

            f.parentNode.insertBefore(j, f);

        })(window, document, 'script', 'dataLayer', 'GTM-TCS3KX4Z');

    </script>

    <!-- End Google Tag Manager -->



    <!-- ======== Page title ============ -->

    <title>@yield('title', config('app.name'))</title>

    <style>

        .whatsapp-chat {

            position: fixed;

            bottom: 90px;

            right: 30px;

            color: white;

            background: #25d366;

            border-radius: 50%;

            width: 50px;

            height: 50px;

            display: flex;

            align-items: center;

            justify-content: center;

            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);

            z-index: 9999;

        }



        /* Chat Popup */

        .chat-popup {

            display: none;

            position: fixed;

            bottom: 160px;

            right: 30px;

            width: 300px;

            background: #fff;

            border-radius: 10px;

            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);

            overflow: hidden;

            z-index: 10000;

            font-family: Arial, sans-serif;

        }



        .chat-header {

            background: #25d366;

            color: #fff;

            padding: 10px;

            display: flex;

            justify-content: space-between;

            align-items: center;

        }



        .chat-body {

            display: flex;

            flex-direction: column;

        }



        #chat-messages {

            height: 220px;

            overflow-y: auto;

            padding: 10px;

            font-size: 14px;

        }



        #chat-form {

            display: flex;

            border-top: 1px solid #eee;

        }



        #chat-input {

            flex: 1;

            border: none;

            padding: 10px;

            outline: none;

        }



        #chat-form button {

            background: #25d366;

            color: #fff;

            border: none;

            padding: 10px 15px;

            cursor: pointer;

        }

    </style>

    @yield('style')

</head>



<body>

    <!-- Google Tag Manager (noscript) -->

    <noscript>

        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TCS3KX4Z" height="0" width="0"

            style="display:none;visibility:hidden"></iframe>

    </noscript>

    <!-- End Google Tag Manager (noscript) -->



    <a href="https://wa.me/60172834522" target="_blank" class="whatsapp-chat" id="openChatBtn" aria-label="Chat with us on WhatsApp">

        <i class="fab fa-whatsapp"></i>

    </a>



    <div id="chat-popup" class="chat-popup">

        <div class="chat-header">

            <span>💬 Chat with Admin</span>

            <button id="closeChatBtn">&times;</button>

        </div>

        <div class="chat-body" id="chat-body">

            <div id="chat-messages"></div>

            <form id="chat-form">

                <input type="text" id="chat-input" placeholder="Type your message..." autocomplete="off">

                <button type="submit">Send</button>

            </form>

        </div>

    </div>



    <!-- Back To Top Start -->

    <!-- <button id="back-top" class="back-to-top">

        <i class="fa-regular fa-arrow-up"></i>

    </button> -->



    <!--<< Mouse Cursor Start >>-->

    <!-- <div class="mouse-cursor cursor-outer"></div>

    <div class="mouse-cursor cursor-inner"></div> -->



    <!-- Include Header Partial -->

    @include('front.layouts.partials.topbar')



    <!-- Main Content -->

    @yield('content')



    <!-- Include Footer Partial -->

    @include('front.layouts.partials.footer')

    @include('front.layouts.partials.script')



    @yield('scripts')



    <script>

        // document.getElementById('openChatBtn').addEventListener('click', () => {

        //     document.getElementById('chat-popup').style.display = 'block';

        // });

        // document.getElementById('closeChatBtn').addEventListener('click', () => {

        //     document.getElementById('chat-popup').style.display = 'none';

        // });

    </script>

</body>



</html>

