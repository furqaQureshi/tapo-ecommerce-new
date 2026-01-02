<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrder = Order::where('status', 'completed')
            ->with('shipping') // Eager load the shipping relationship
            ->get()
            ->sum(function ($order) {
                $shippingCost = $order->shipping ? $order->shipping->shipping_cost : 0;
                return $order->grand_total - $shippingCost - $order->points_discount;
            });
        $userCount = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })->count();
        $productCount = Product::where('is_subscription', 0)
            ->where('status', 'active')
            ->count();
        $orderCount = Order::count();
        $bestSellingProducts = Product::select(
            'products.id',
            'products.name',
            'products.price',
            'products.slug',
            'products.created_at',
            DB::raw('COUNT(order_items.id) as order_count'),
            DB::raw('SUM(order_items.quantity * order_items.price) as total_amount'),
            DB::raw('(SELECT image_path FROM product_media WHERE product_media.product_id = products.id LIMIT 1) as image_path')
        )
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->groupBy('products.id', 'products.name', 'products.price', 'products.slug', 'products.created_at')
            ->orderByDesc('order_count')
            ->take(6)
            ->get();
        $recentOrders = Order::select(
            'orders.order_number',
            'orders.grand_total',
            'orders.status',
            'orders.id',
            'orders.unique_id',
            'orders.is_paid',
            'users.name as customer_name',
            'users.avatar',
            DB::raw('(SELECT products.name FROM products 
                         JOIN order_items ON products.id = order_items.product_id 
                         WHERE order_items.order_id = orders.id LIMIT 1) as product_name')
        )
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->orderByDesc('orders.created_at')
            ->take(4)
            ->get();

        return view('admin.master.dashboard', compact('totalOrder', 'userCount', 'productCount', 'orderCount', 'bestSellingProducts', 'recentOrders'));
    }
}
