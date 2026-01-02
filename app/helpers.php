<?php

use App\Models\Footer;
use App\Models\WalletTransaction;
use App\Models\Wallet;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

if (!function_exists('usernameAvatar')) {
    function usernameAvatar($name)
    {
        $nameSplitted = explode(' ', $name);

        $firstLetter = substr($nameSplitted[0], 0, 1);
        if (count($nameSplitted) == 1) {
            $secondLetter = substr($nameSplitted[0], 1, 1);
        } else {
            $secondLetter = substr($nameSplitted[(count($nameSplitted) - 1)], 0, 1);
        }

        return utf8_encode(strtoupper($firstLetter) . strtoupper($secondLetter));
    }
}
if (!function_exists('moneyFormat')) {
    function moneyFormat($amount): string
    {
        $currency = config('app.currency');
        $formatted = number_format((float) $amount, 2, '.', ',');
        return $currency . ' ' . $formatted;
    }
}
if (!function_exists('greetings')) {
    function greetings()
    {
        $now = \Carbon\Carbon::now();
        $time = $now->format('g:i A');

        $greetings = "";
        if ($time < "12:00 PM") {
            $greetings = "Good Morning";
        } else

        if ($time >= "12:00 PM" && $time < "5:00 PM") {
            $greetings = "Good Afternoon";
        } else

        if ($time >= "5:00 PM" && $time < "7:00 PM") {
            $greetings = "Good Evening";
        } else

        if ($time >= "7:00 PM") {
            $greetings = "Good Night";
        }
        return $greetings;
    }
}
if (!function_exists('getCartCount')) {
    function getCartCount()
    {
        if (Auth::check()) {
            return App\Models\Cart::where('user_id', Auth::id())->count();
        } else {
            return session('cart') ? count(session('cart')) : 0;
        }
    }
}
if (!function_exists('topBarCarts')) {
    function topBarCarts()
    {
        if (Auth::check()) {
            return \App\Models\Cart::where('user_id', Auth::id())
                ->with(['product' => function ($query) {
                    $query->where('is_subscription', 0);
                }])
                ->whereHas('product', function ($query) {
                    $query->where('is_subscription', 0);
                })
                ->get();
        } else {
            $sessionCart = session('cart', []);
            $cartCollection = collect();

            foreach ($sessionCart as $item) {
                $product = \App\Models\Product::where('id', $item['product_id'])
                    ->where('is_subscription', 0)
                    ->first();
                if (!$product) continue;

                $cartObject = (object) [
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'product' => $product,
                    'attributes' => $item['attributes'],
                ];

                $cartCollection->push($cartObject);
            }

            return $cartCollection;
        }
    }
}

if (!function_exists('runTimeDateFormat')) {
    function runTimeDateFormat($date)
    {
        return \Carbon\Carbon::parse($date)->format('d M, Y h:i A');
    }
}
if (!function_exists('walletAmountClass')) {

    function walletAmountClass($wallet)
    {
        $class = '';

        if ($wallet->status === 'pending') {
            $class = 'amount-dark';
        } elseif ($wallet->status === 'rejected') {
            $class = 'amount-negative';
        } elseif ($wallet->status === 'approved') {
            $class = $wallet->type === 'credit' ? 'amount-positive' : 'amount-negative';
        }
        return $class;
    }
}
if (!function_exists('getMonthName')) {
    /**
     * Convert a numeric month (1-12 or "01"-"12") to its full month name.
     *
     * @param string|int|null $month Numeric month (e.g., 1, "01", 8, "08")
     * @return string Full month name (e.g., "January", "August") or fallback
     */
    function getMonthName($month, $fallback = '-')
    {
        $month = is_numeric($month) ? (int) $month : 0;
        if ($month < 1 || $month > 12) {
            return $fallback;
        }
        return date('F', mktime(0, 0, 0, $month, 1));
    }
}
if (!function_exists('product_price_range')) {
    function product_price_range($product)
    {
        $user = auth()->user();
        $isReseller = $user && $user->account_type === 'reseller';

        // Use base product price only
        $basePrice = $product->price;
        $discount = $product->discount ?? 0;
        $afterDiscount = $basePrice - ($basePrice * $discount) / 100;

        if ($isReseller) {
            $afterDiscount = round($afterDiscount * 0.99, 2);
        }

        $formattedPrice = config('app.currency') . ' ' . number_format($afterDiscount, 2);
        $formattedOriginalPrice = $discount > 0 ? config('app.currency') . ' ' . number_format($basePrice, 2) : null;

        return [
            'formatted_price' => $formattedPrice,
            'original_price' => $formattedOriginalPrice,
            'discount_percentage' => $discount
        ];
    }
}

if (!function_exists('normal_product_price_range')) {
    function normal_product_price_range($product)
    {
        // Use base product price only
        $basePrice = $product->price;
        $discount = $product->discount ?? 0;
        $afterDiscount = $basePrice - ($basePrice * $discount) / 100;

        $formattedPrice = config('app.currency') . ' ' . number_format($afterDiscount, 2);
        $formattedOriginalPrice = $discount > 0 ? config('app.currency') . ' ' . number_format($basePrice, 2) : null;

        return [
            'formatted_price' => $formattedPrice,
            'original_price' => $formattedOriginalPrice,
            'discount_percentage' => $discount
        ];
    }
}
if (!function_exists('calculatedPrice')) {
    function calculatedPrice($price)
    {
        if (!$price) return 'N/A';

        $user = auth()->user();
        $isReseller = $user && $user->account_type === 'reseller';


        if ($isReseller) {
            $price = round($price * 0.99, 2);
        }


        return number_format($price, 2);
    }
}


if (!function_exists('format_count')) {
    function format_count($number, $precision = 1)
    {
        if ($number >= 1000000) {
            return number_format($number / 1000000, $precision) . 'M';
        }

        if ($number >= 1000) {
            return number_format($number / 1000, $precision) . 'K';
        }

        return (string) $number;
    }
}
if (!function_exists('wallet_balance_format')) {
    function wallet_balance_format($number, $precision = 2)
    {
        if ($number >= 1000000) {
            return number_format($number / 1000000, $precision, '.', '') . 'M';
        }

        if ($number >= 1000) {
            return number_format($number / 1000, $precision, '.', '') . 'K';
        }

        return number_format($number, $precision, '.', '');
    }
}


if (!function_exists('getWeeklySpent')) {

    function getWeeklySpent($userId)
    {
        $walletIds = Wallet::where('user_id', $userId)->pluck('id');

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        return WalletTransaction::whereIn('wallet_id', $walletIds)
            ->where('type', 'debit')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->sum('amount');
    }
}
if (!function_exists('getGroupedFooterLinks')) {
    function getGroupedFooterLinks()
    {
        return Footer::where('section', '!=', 'Follow Us')->get()->groupBy('section');
    }
}
if (!function_exists('getFollowUsFooterLinks')) {
    function getFollowUsFooterLinks()
    {
        return Footer::where('section', 'Follow Us')->get()->groupBy('section');
    }
}

if (!function_exists('getBadgeClasses')) {
    function getBadgeClasses(string $status): string
    {
        $statusMap = [
            'pending' => 'bg-warning-subtle text-warning',
            'completed' => 'bg-success-subtle text-success',
            'success' => 'bg-success-subtle text-success',
            'Success' => 'bg-success-subtle text-success',
            'in progress' => 'bg-primary-subtle text-primary',
            'failed' => 'bg-danger-subtle text-danger',
            'Failed' => 'bg-danger-subtle text-danger',
            'cancelled' => 'bg-secondary-subtle text-secondary',
            'on hold' => 'bg-info-subtle text-info',
        ];

        // Convert status to lowercase to handle case variations
        $normalizedStatus = strtolower($status);

        // Return the corresponding classes or a default class if status not found
        return $statusMap[$normalizedStatus] ?? 'bg-light text-dark';
    }
}

if (!function_exists('getAttributes')) {
    function getAttributes($data, $id = null)
    {
        $html = '';
        $html .= '<option value="">Select an Attribute</option>';

        foreach ($data as $key => $value) {
            $selected = ($id !== null && $value->id == $id) ? ' selected' : '';
            $html .= '<option value="' . $value->id . '"' . $selected . '>' . $value->name . '</option>';
        }

        return $html;
    }
}

if (!function_exists('calculateOrderShipping')) {
    function calculateOrderShipping($region, $orderTotal)
    {
        if ($orderTotal >= 100) {
            return $region === 'sabah_sarawak' ? 20 : 0;
        }

        return $region === 'sabah_sarawak' ? 20 : 5;
    }
}

if (!function_exists('productPriceWithDiscount')) {
    function productPriceWithDiscount($productId)
    {
        $product = Product::select('price','discount')->where('id',$productId)->first();
        $discount = $product->price*$product->discount/100;
        $discountedPrice = number_format($product->price-$discount,2);
        return $discountedPrice;
    }
}

