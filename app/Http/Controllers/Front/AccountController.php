<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\OrderTrackingHistory;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Wallet;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ProductOrderPointLog;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\UserSubscriptionDetail;
use Yajra\DataTables\Facades\DataTables;

class AccountController extends Controller
{
public function index()
    {
        $subscriptionDetail = null;
        if (!Auth::check()) {
    return redirect()->route('login');
}
        // return auth()->user();
        // Incomplete order warning
        $incompleteOrder = Cart::where('user_id', auth()->user()->id)
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->where('products.is_subscription', 1)
            ->count() > 0 ? 1 : 0;

        $abandoned_cart_type = Cart::where('user_id', auth()->user()->id)
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->where('products.is_subscription', 0)
            ->count() > 0 ? 1 : 0;

        // return Cart::where('user_id', auth()->user()->id)->count();
        $productIds = Cart::where('user_id', auth()->user()->id)
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->where('products.is_subscription', 1)
            ->pluck('carts.product_id')
            ->toArray();
        $subscriptionStatus = null;
        $prompt = null;
        $canViewProducts = true; // Default: users can view products
        $formCompleted = true; // Default: assume form is filled

        // Fetch the latest subscription order
        $lastSubscription = Order::select('created_at', 'status', 'on_hold')
            ->where('type', 1) // Subscription order
            ->where('user_id', auth()->user()->id)
            ->latest()
            ->first();
        // return $lastSubscription;
        // Check for on-hold subscriptions
        $onHoldSubscription = Order::where('type', 1)
            ->where('on_hold', 1)
            ->where('user_id', auth()->user()->id)
            ->exists();

        if ($lastSubscription) {
            $createdAt = Carbon::parse($lastSubscription->created_at);
            $deadlineDate = $createdAt->copy()->addDays(30)->format('Y-m-d');

            if ($lastSubscription->status === 2) {
                $subscriptionStatus = 'cancelled';
                $prompt = __('lang.subscription_cancelled_prompt');
                $canViewProducts = true;
            } elseif ($onHoldSubscription) {
                $subscriptionStatus = 'on_hold';
                $prompt = __('lang.subscription_on_hold_prompt');
                $canViewProducts = true;
            } else {
                // Assume active if not cancelled or on hold
                $subscriptionStatus = 'active';
                $prompt = "We'll auto-pick for you if you don't choose by {$deadlineDate}.";
                // $prompt = __('lang.auto_pick_prompt');
                $canViewProducts = true;
            }

            $subscriptionDetail = UserSubscriptionDetail::where('user_id', auth()->user()->id)->first();
            $formCompleted = $subscriptionDetail ? $subscriptionDetail->isFormCompleted() : false;
            if (!$formCompleted) {
                $prompt = __('lang.form_fill_prompt');
                $canViewProducts = true;
            }
        }
        //  else {
        //     // No subscription found, treat as cancelled or new user
        //     $subscriptionStatus = 'none';
        //     $prompt = 'Oops! Your subscription has been cancelled, resubscribe now to pick your favorite goodies before they\'re gone!';
        //     $canViewProducts = true;
        // }

        // Fetch other data
        $orders = Order::where('user_id', auth()->user()->id)->orderBy('id','desc')->get();
        $wallets = Wallet::where('user_id', auth()->user()->id)->with('transaction')->paginate(10);
        $coupons = Coupon::orderBy('status', 'asc')
            ->orderBy('expiry_date', 'desc')
            ->get()
            ->map(function ($coupon) {
                $coupon->is_expired = $coupon->isExpired();
                $coupon->is_valid = $coupon->isValid();
                $coupon->usage_percentage = ($coupon->used_count / $coupon->usage_limit) * 100;
                $coupon->is_near_expiry = $coupon->expiry_date->diffInDays(Carbon::now()) <= 7 && !$coupon->is_expired;
                return $coupon;
            });

        // Calculate points
        $totalEarnedPoints = ProductOrderPointLog::where('user_id', auth()->user()->id)
            ->where('status', 'earned')
            ->sum('points_earned');
        $redeemedPoints = ProductOrderPointLog::where('user_id', auth()->user()->id)
            ->where('status', 'redeemed')
            ->sum('points_earned');
        $totalPoints = $totalEarnedPoints - $redeemedPoints;
        $thisMonthPoints = ProductOrderPointLog::where('user_id', auth()->user()->id)
            ->where('status', 'earned')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('points_earned');
        $cities = DB::table('cities')->get();
        // return $incompleteOrder;
        if ($incompleteOrder == 1) {

            $user = auth()->user();
            $subscription = SubscriptionPlan::where('id',$user->sub_id)->first();

            // $pFreq = $subscription->type == 2 ? 'Yearly' : 'Monthly';
            // $planText = '<h4>'.$subscription->title.' ('.$pFreq.')</h4><br>';
            // $planText .=  ' RM'.$subscription->price.' x '.($subscription->type == 2 ? '12' : '1');
            // $planText .=  $subscription->description;

            try {
                Mail::to($user->email)->send(
                    new \App\Mail\AbandonedCartMail($user, $planText)
                );
            } catch (\Exception $e) {
                //Log::error("Abandoned cart email failed: " . $e->getMessage());
            }
        }

        $myPlan = SubscriptionPlan::where('id',auth()->user()->sub_id)->first();

        // return view('front.account', compact(
        //     'orders',
        //     'incompleteOrder',
        //     'abandoned_cart_type',
        //     'subscriptionStatus',
        //     'myPlan',
        //     'subscriptionDetail',
        //     'prompt',
        //     'canViewProducts',
        //     'formCompleted',
        //     'wallets',
        //     'coupons',
        //     'totalPoints',
        //     'thisMonthPoints',
        //     'totalEarnedPoints',
        //     'redeemedPoints',
        //     'cities'
        // ));
        return view('front.panel.index');
    }
    public function getAvailableCoupons()
    {
        $coupons = Coupon::available()->get()->map(function ($coupon) {
            $coupon->is_expired = $coupon->isExpired();
            $coupon->is_valid = $coupon->isValid();
            $coupon->usage_percentage = ($coupon->used_count / $coupon->usage_limit) * 100;
            $coupon->is_near_expiry = $coupon->expiry_date->diffInDays(Carbon::now()) <= 7;
            return $coupon;
        });

        return response()->json([
            'success' => true,
            'data' => $coupons
        ]);
    }
    public function applyCoupon(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
            'order_amount' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid input data',
                'errors' => $validator->errors()
            ], 422);
        }

        $coupon = Coupon::where('code', strtoupper($request->code))->first();

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon code not found'
            ], 404);
        }

        if (!$coupon->isValid()) {
            $message = 'Coupon is not valid';
            if ($coupon->isExpired()) {
                $message = 'Coupon has expired';
            } elseif ($coupon->used_count >= $coupon->usage_limit) {
                $message = 'Coupon usage limit exceeded';
            } elseif ($coupon->status !== 'active') {
                $message = 'Coupon is not active';
            }

            return response()->json([
                'success' => false,
                'message' => $message
            ], 400);
        }

        $orderAmount = $request->order_amount;

        if ($coupon->min_amount && $orderAmount < $coupon->min_amount) {
            return response()->json([
                'success' => false,
                'message' => "Minimum order amount should be $" . $coupon->min_amount
            ], 400);
        }

        $discountAmount = $coupon->calculateDiscount($orderAmount);

        return response()->json([
            'success' => true,
            'message' => 'Coupon applied successfully',
            'data' => [
                'coupon_code' => $coupon->code,
                'discount_amount' => $discountAmount,
                'original_amount' => $orderAmount,
                'final_amount' => $orderAmount - $discountAmount,
                'coupon_type' => $coupon->type,
                'coupon_value' => $coupon->value
            ]
        ]);
    }

    // Redeem coupon (for checkout process)
    public function redeemCoupon(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
            'order_amount' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid input data',
                'errors' => $validator->errors()
            ], 422);
        }

        $coupon = Coupon::where('code', strtoupper($request->code))->first();

        if (!$coupon || !$coupon->isValid()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired coupon'
            ], 400);
        }

        $orderAmount = $request->order_amount;
        $discountAmount = $coupon->calculateDiscount($orderAmount);

        if ($discountAmount == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon cannot be applied to this order'
            ], 400);
        }

        // Use the coupon
        $coupon->useCoupon();

        return response()->json([
            'success' => true,
            'message' => 'Coupon redeemed successfully',
            'data' => [
                'coupon_code' => $coupon->code,
                'discount_amount' => $discountAmount,
                'original_amount' => $orderAmount,
                'final_amount' => $orderAmount - $discountAmount
            ]
        ]);
    }

    // Check coupon validity
    public function checkCoupon(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon code is required'
            ], 422);
        }

        $coupon = Coupon::where('code', strtoupper($request->code))->first();

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'code' => $coupon->code,
                'type' => $coupon->type,
                'value' => $coupon->value,
                'min_amount' => $coupon->min_amount,
                'max_discount' => $coupon->max_discount,
                'usage_limit' => $coupon->usage_limit,
                'used_count' => $coupon->used_count,
                'expiry_date' => $coupon->expiry_date->format('Y-m-d'),
                'status' => $coupon->status,
                'description' => $coupon->description,
                'is_valid' => $coupon->isValid(),
                'is_expired' => $coupon->isExpired()
            ]
        ]);
    }

    public function update(Request $request, $id)
    {



        $request->validate([
            'name'         => 'required|string|max:100',
            'last_name'    => 'required|string|max:100',
            'email'        => 'required|email|max:150|unique:users,email,' . $id,
            'phone'        => 'nullable|string|max:25',
            'country'      => 'nullable|string|max:100',
            'towncity'     => 'nullable|string|max:100',
            'address'      => 'nullable|string|max:350',
            'address2'     => 'nullable|string|max:100',
            'avatar'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $getState = DB::table('cities')->where('name', $request->towncity)->first();
        $user = User::find($id);
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->towncity = $request->towncity;
        $user->state = (!empty($getState) ? $getState->state : '');
        $user->address = $request->address;
        $user->address2 = $request->address2;

        if ($request->avatar) {
            $featuredImage = $request->file('avatar');
            $featuredImageName = $request->slug . '_' . time() . '.' . $featuredImage->getClientOriginalExtension();
            $featuredImagePath = public_path('user/avatar/');
            $featuredImage->move($featuredImagePath, $featuredImageName);

            if (file_exists(public_path($name =  $featuredImage->getClientOriginalName()))) {
                unlink(public_path($name));
            }

            $user->avatar = 'user/avatar/' . $featuredImageName;
        }
        $user->update();

        return redirect()->back()->with('success', 'Request has been completed.');
    }

    public function order_detail($unique_id)
    {
        $order = Order::where('id', $unique_id)->first();
        if ($order) {
            $order_shippings = \App\Models\OrderTrackingHistory::where(
                'order_id',
                $order->id,
            )
                ->orderBy('date', 'desc')
                ->get();
            $order_items = OrderItem::where('order_id', $order->id)->get();
            $status = $order->status;
            $statusClasses = [
                'pending'    => 'badge bg-warning-subtle text-warning fw-medium',
                'processing' => 'badge bg-info-subtle text-info fw-medium',
                'completed'  => 'badge bg-success-subtle text-success fw-medium',
                'failed'     => 'badge bg-danger-subtle text-danger fw-medium',
                'cancelled'  => 'badge bg-secondary-subtle text-secondary fw-medium',
            ];
            $badgeClass = $statusClasses[$order->status] ?? 'badge bg-primary-subtle text-primary';
            $subtotal = $order->total_amount; // Replace with actual subtotal calculation
            if ($order->shipping_id) {
                $shipping = Shipping::find($order->shipping_id);
                $shipping_cost = $shipping ? $shipping->price : 0;
            } else {
                $shipping_cost = 0;
            }

            $points_discount = $order->points_discount ?? 0;
            // Calculate grand total
            $grand_total = $subtotal + $shipping_cost - $points_discount - ($order->discount_applied ?? 0);
        }
        return view('front.order_details', compact('order', 'order_items', 'badgeClass', 'status', 'grand_total', 'order_shippings'));
    }
    // Add this method to your existing AccountController or UserController
    public function getRewardPointsData(Request $request)
    {
        $query = ProductOrderPointLog::with(['order', 'product'])
            ->where('user_id', auth()->id());

        return DataTables::of($query)
            ->addColumn('order_number', function ($row) {
                return $row->order ? $row->order->order_number : 'N/A';
            })
            ->addColumn('product_name', function ($row) {
                return $row->product ? 'The point is given for the product (' . $row->product->name . ')' : 'You have used points in this order';
            })
            ->addColumn('created_at_formatted', function ($row) {
                return $row->created_at->format('M d, Y - h:i A');
            })
            ->addColumn('order_link', function ($row) {
                if ($row->order) {
                    return route('user.order.details', $row->order->unique_id);
                }
                return null;
            })
            ->addColumn('points', function ($row) {
                $color = $row->status === 'earned' ? 'green' : 'red';
                $sign = $row->status === 'earned' ? '+' : '-';
                return '<span style="color: ' . $color . ';font-weight: 600;font-size: 14px;">' . $sign . $row->points_earned . '</span>';
            })
            ->addColumn('action', function ($row) {
                return '<button class="btn btn-sm btn-outline-primary">View Order</button>';
            })
            ->rawColumns(['points', 'action'])
            ->make(true);
    }
    public function getOrderList(Request $request)
    {
        $userId = Auth::id();

        $query = Order::where('user_id', $userId)->orderBy('id', 'DESC')->select('*');
        return DataTables::eloquent($query)
            ->addColumn('order_number', function ($order) {
                return '<div class="cart-item-thumb d-flex align-items-center gap-4">
                <a href="' . route('user.order.details', $order->id) . '"
                    style="color: #011e5e;"><span class="text-nowrap">#' . $order->order_number . '</span>
                    <i class="fas fa-external-link-alt ms-2"></i></a>
            </div>';
            })
            ->addColumn('type', function ($order) {
                if ($order->type == 1) {
                    return '<div class="d-flex flex-column gap-1 text-center"><h5><span class="badge bg-success-subtle text-success fw-medium">Subscription</span></h5></div>';
                } else {
                    return '<div class="d-flex flex-column gap-1 text-center"><h5><span class="badge bg-success-subtle text-success fw-medium">Normal</span></h5></div>';
                }
            })
            ->addColumn('payment_method', function ($order) {
                return '<span class="price-usd">
                            ' . ucfirst($order->payment_method) . '
                        </span>';
            })

            ->addColumn('total_amount', function ($order) {

                if ($order->type == 1) {
                    $shippingPrice = isset($order->shipping) ? $order->shipping->price : 0;
                    $grand_total = ($order->total_addon_price + $shippingPrice + $order->bundle_plan_price);
                    return '<span class="price-usd">
                                ' . number_format($grand_total, 2) . ' ' . config('app.currency') . '
                            </span>';
                } else {
                    return '<span class="price-usd">
                                ' . number_format($order->total_amount, 2) . ' ' . config('app.currency') . '
                            </span>';
                }
            })
            ->addColumn('status', function ($order) {
                return ' <span class="price-usd">
                            ' . ucfirst($order->status) . '
                        </span>';
            })
            ->addColumn('refund_status', function ($order) {
                return ' <span class="price-usd">
                            ' . ucfirst($order->refund_status) . '
                        </span>';
            })
            ->addColumn('action', function ($order) {
                $html = '<div style="display: flex; gap: 8px; justify-content: center;">';

                if ($order->refund_status !== 'Not Requested') {
                    $html .= '<span class="text-center">-</span>';
                } else {
                    $html .= '<a href="javascript:void(0);" class="action_btn edit-item open-refund-modal" title="Refund Amount"
                    data-bs-toggle="modal"
                    data-bs-target="#refundModal"
                    data-id="' . $order->id . '"
                    data-order-id="' . $order->order_number . '"
                    data-amount="' . $order->total_amount . '"
                    data-user-id="' . $order->user_id . '">
                    <i class="fa fa-undo" aria-hidden="true"></i>
                </a>';
                }

                $html .= '<a href="' . route('user.order.invoice', $order->id) . '" class="action_btn" title="Generate Invoice">
                    <i class="fas fa-file-invoice"></i>
                </a>';
                if ($order->status == 'failed' && $order->subscription_link) {
                    $html .= '<a href="' . $order->subscription_link . '" class="action_btn" title="Generate Invoice">
                    <i class="fa fa-credit-card"></i>
                </a>';
                }
                if ($order->tracking_url) {
                    $html .= '<a href="' . $order->tracking_url . '" class="action_btn" title="Track Order">
                    <i class=" ri-truck-line"></i>
                </a>';
                }
                $html .= '</div>';

                return $html;
            })

            ->rawColumns(['order_number', 'type',  'payment_method', 'total_amount', 'status', 'refund_status', 'action'])
            ->make(true);
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->unreadNotifications()->findOrFail($id);
        $notification->markAsRead();

        return response()->json(['success' => true]);
    }
}
