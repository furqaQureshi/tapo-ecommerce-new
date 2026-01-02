@component('mail::message')
<img src="https://dev.zeramom.brainiaccreation.com/public/front/assets/img/zera-mom-logo.png">

Hi {{ $user->name }},

Looks like you have left something behind…Complete your checkout today and enjoy your new picks!

{{ $planText }}

@component('mail::button', ['url' => url('/login')])
Complete My Order
@endcomponent

Love, 
ZÉRA Mom
@endcomponent
