@component('mail::message')
<center><img src="https://dev.zeramom.brainiaccreation.com/public/front/assets/img/zera-mom-logo.png"></center>

Hi {{ $user->name }},

Thank you for subscribing to ZÉRA Mom Club 💝 Your order, {{ $checkout['merchant_ord_id'] }} is being prepared with care now and it is on its way to you

👉 Track your subscription here: {{ url('/track-subscription/'.$user->id) }}

Did you know? 🌟 As an active subscriber, you’ll also enjoy exclusive access to (be sure to log in first to unlock the full benefits!):

<a href="{{url('/products')}}">🛍️ Up to 80% OFF members-only shopping discounts at ZÉRA Shop</a>
<a href="{{url('/product/kiztopia')}}">🎡 Free / discounted entry to our partnering theme parks and playlands</a>
<a href="{{url('/product/jungle-gym-family-interactive-adventureland')}}">👩‍👧 Expert-led parenthood classes from our trusted partners</a>
🎁 Exciting giveaways with chances to win exclusive prizes 
📩 Exclusive invites to members-only workshops & events

✨ …and so much more! Stay tuned on Announcement (hyper link to announcement page) page for latest update! 

Love, 
ZÉRA Mom

@endcomponent
