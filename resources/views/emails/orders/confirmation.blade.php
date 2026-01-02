@component('mail::message')
Hi {{ $orderDetails['first_name'] }},

Thank you for shopping with **Tapu 🌸**
Your order **#{{ $order->order_number }}** has been received and is being prepared with care.

---

👉 [Track your subscription here]({{ url('/track-order/' . $order->order_number) }})

---

### 🛒 Order Summary
@foreach($orderItems as $i)
@foreach($i as $item)

@php
    $product = \App\Models\Product::find($item['product_id']);
@endphp

- **{{ $product->name ?? '' }}** × {{ $item['quantity'] }} —
  RM {{ number_format($item['price'], 2) }}

  @endforeach
@endforeach

**Total: RM {{ number_format($order->grand_total, 2) }}**

---

Psst... want to try premium products and enjoy exclusive benefits as a mother?
Apply code **Tapu** for **10% discount** on your next purchase!

@component('mail::button', ['url' => url('/subscriber-form')])
@endcomponent

Thanks,
**The tapu Team**
@endcomponent
