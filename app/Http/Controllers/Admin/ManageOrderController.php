<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\OrderItem;
use App\Models\OrderHistory;
use Illuminate\Http\Request;
use App\Models\ProductBundle;
use App\Models\RefundRequest;
use App\Models\Category;
use App\Models\ProductAffiliate;
use App\Models\Attribute;
use App\Models\State;
use App\Models\City;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ManageOrderController extends Controller
{
    public function list()
    {
        return view('admin.orders.list');
    }
    public function subscriptionOrderList()
    {
        return view('admin.orders.subscription-order-list');
    }
    public function get(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::query()
                ->leftJoin('users', 'orders.user_id', '=', 'users.id')
                ->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')
                ->select(
                    'orders.id',
                    'orders.unique_id',
                    'orders.order_number',
                    'orders.created_at',
                    'orders.status',
                    'orders.source_status',
                    'orders.total_amount',
                    'orders.grand_total',
                    'orders.payment_method',
                    'orders.refund_status',
                    'orders.user_id',
                    'orders.shipping_id',
                    'orders.points_discount',
                    'users.name as user_name',
                    'users.first_name as user_first_name',
                    'users.last_name as user_last_name',
                    'order_details.name as guest_name'
                )

                ->with(['user', 'order_detail', 'refundRequest'])->where('type', 0);

            return DataTables::of($orders)
                ->addIndexColumn()

                ->addColumn('order_id', function ($order) {
                    // $canView = auth()->user()->can(\App\Services\PermissionMap::getPermission('admin.order.details'));

                    // if ($canView) {
                    //     return '<a href="' . route('admin.order.details', $order->id) . '">' . $order->order_number . '</a>';
                    // }

                    // return $order->order_number;
                    return $order->id;

                })

                ->addColumn('customer', function ($order) {
                    $canViewUser = auth()->user()->can(\App\Services\PermissionMap::getPermission('admin.customer.view'));

                    if (($order->user_name || $order->user_last_name) && $canViewUser) {
                        // commented 21-11-2025
                        // return '<a href="' . route('admin.user.view', $order->user_id) . '">' . $order->user_first_name . ' ' . $order->user_last_name . '</a>';
                        // commented 21-11-2025
                        return $order->user_first_name . ' ' . $order->user_last_name;
                    } elseif ($order->user_name || $order->user_last_name) {
                        return $order->user_name . ' ' . $order->user_last_name;
                    } elseif ($order->guest_name) {
                        return $order->guest_name;
                    }

                    return 'N/A';
                })


                ->addColumn('order_date', function ($order) {
                    return runTimeDateFormat($order->created_at);
                })

                ->addColumn('source_status', function ($order) {
                    $statusClasses = [
                        'pending'    => 'badge bg-warning-subtle text-warning fw-medium',
                        'processing' => 'badge bg-info-subtle text-info fw-medium',
                        'completed'  => 'badge bg-success-subtle text-success fw-medium',
                        'Success'  => 'badge bg-success-subtle text-success fw-medium',
                        'success'  => 'badge bg-success-subtle text-success fw-medium',
                        'failed'     => 'badge bg-danger-subtle text-danger fw-medium',
                        'Failed'     => 'badge bg-danger-subtle text-danger fw-medium',
                        'cancelled'  => 'badge bg-secondary-subtle text-secondary fw-medium',
                    ];
                    $statusBadgeClass = $statusClasses[$order->source_status] ?? 'badge bg-secondary-subtle text-secondary';
                    $statusBadge = '<span class="' . $statusBadgeClass . '">' . ucfirst($order->source_status) . '</span>';

                    $refundBadge = '';
                    if ($order->refund_status === 'Rejected') {
                        $refundBadge = '<span class="badge bg-danger-subtle text-danger fw-medium">Refund Rejected</span>';
                    }

                    return '<div class="d-flex flex-column gap-1 text-center">'
                        . '<h5>' . $statusBadge . '</h5>'
                        . ($refundBadge ? '<h5>' . $refundBadge . '</h5>' : '')
                        . '</div>';
                })
                ->addColumn('status', function ($order) {
                    $statusClasses = [
                        'pending'    => 'badge bg-warning-subtle text-warning fw-medium',
                        'processing' => 'badge bg-info-subtle text-info fw-medium',
                        'completed'  => 'badge bg-success-subtle text-success fw-medium',
                        'Success'  => 'badge bg-success-subtle text-success fw-medium',
                        'success'  => 'badge bg-success-subtle text-success fw-medium',
                        'failed'     => 'badge bg-danger-subtle text-danger fw-medium',
                        'Failed'     => 'badge bg-danger-subtle text-danger fw-medium',
                        'cancelled'  => 'badge bg-secondary-subtle text-secondary fw-medium',
                    ];
                    $statusBadgeClass = $statusClasses[$order->status] ?? 'badge bg-secondary-subtle text-secondary';
                    $statusBadge = '<span class="' . $statusBadgeClass . '">' . ucfirst($order->status) . '</span>';

                    $refundBadge = '';
                    if ($order->refund_status === 'Rejected') {
                        $refundBadge = '<span class="badge bg-danger-subtle text-danger fw-medium">Refund Rejected</span>';
                    }

                    return '<div class="d-flex flex-column gap-1 text-center">'
                        . '<h5>' . $statusBadge . '</h5>'
                        . ($refundBadge ? '<h5>' . $refundBadge . '</h5>' : '')
                        . '</div>';
                })


                ->addColumn('payment_method', function ($order) {
                    return ucfirst($order->payment_method);
                })

                ->addColumn('total_amount', function ($order) {
                    return number_format($order->total_amount, 2);
                })
                ->editColumn('grand_total', function ($order) {
                    // return $order->shipping->price ?? 0;
                    $shippingPrice = isset($order->shipping) ? $order->shipping->price : 0;
                    $pointsDiscount = $order->points_discount ?? 0;
                    $shippingPrice = $shippingPrice - $pointsDiscount;
                    $grand_total = ($order->grand_total > 0) ? $order->grand_total  + $shippingPrice : ($order->total_amount + $shippingPrice);

                    return number_format($grand_total, 2);
                })

                ->addColumn('action', function ($order) {
                    $canView = auth()->user()->hasPermissionTo(\App\Services\PermissionMap::getPermission('admin.order.details'));

                    $html = '<div style="display: flex; gap: 8px;">';

                    if ($canView) {
                        $html .= '<a href="' . route('admin.order.details', $order->id) . '" class="action_btn edit-item">
                                        <i class="ri-eye-line"></i>
                                </a>
                                <a href="' . route('admin.order.edit', $order->id) . '" class="action_btn edit-item">
                                        <i class="ri-edit-line"></i>
                                </a>';
                    } else {
                        $html .= '<span class="text-center">-</span>';
                    }

                    if ($order->refund_status === 'Refund Requested') {
                        // $html .= '<a href="javascript:void(0);" class="action_btn view-refund-request edit-item" title="Manage Refund Request"
                        //     data-bs-toggle="modal"
                        //     data-bs-target="#refundRequestManageModal"
                        //     data-id="' . $order->id . '"
                        //     data-order-id="' . $order->order_number . '"
                        //     data-customer="' . ($order->user_name || $order->user_last_name ? trim($order->user_name . ' ' . $order->user_last_name) : $order->guest_name) . '"
                        //     data-amount="' . $order->total_amount . '"
                        //     data-status="' . ucfirst($order->status) . '"
                        //     data-refund-request-id="' . $order->refundRequest->id . '"
                        //     data-refund-status="' . ucfirst($order->refund_status) . '"
                        //     data-refund-method="' . $order->refundRequest->refund_method . '"
                        //     data-user-id="' . $order->user_id . '">
                        //     <i class="ri-refund-2-fill" aria-hidden="true"></i>
                        // </a>';
                    } else {
                        // $html .= '<a href="javascript:void(0);" class="action_btn edit-item open-refund-modal" title="Refund Amount"
                        //         data-bs-toggle="modal"
                        //         data-bs-target=".bs-example-modal-center"
                        //         data-id="' . $order->id . '"
                        //         data-order-id="' . $order->order_number . '"
                        //         data-customer="' . ($order->user_name || $order->user_last_name ? trim($order->user_name . ' ' . $order->user_last_name) : $order->guest_name) . '"
                        //         data-amount="' . $order->total_amount . '"
                        //         data-status="' . ucfirst($order->status) . '"
                        //         data-refund-status="' . ucfirst($order->refund_status) . '"
                        //         data-user-id="' . $order->user_id . '">
                        //         <i class="ri-refund-line"></i>
                        //     </a>';
                    }

                    $html .= '</div>';

                    return $html;
                })


                // FILTERS
                ->filterColumn('customer', function ($query, $keyword) {
                    $query->where(function ($q) use ($keyword) {
                        $q->where('users.name', 'like', "%{$keyword}%")
                            ->orWhere('users.last_name', 'like', "%{$keyword}%")
                            ->orWhere('order_details.name', 'like', "%{$keyword}%");
                    });
                })

                ->filterColumn('order_id', function ($query, $keyword) {
                    $query->where('orders.order_number', 'like', "%{$keyword}%");
                })

                ->filterColumn('order_date', function ($query, $keyword) {
                    $query->where(function ($q) use ($keyword) {
                        $q->whereDate('orders.created_at', $keyword)
                            ->orWhereRaw("DATE_FORMAT(orders.created_at, '%Y-%m-%d') LIKE ?", ["%{$keyword}%"])
                            ->orWhereRaw("DATE_FORMAT(orders.created_at, '%d-%m-%Y') LIKE ?", ["%{$keyword}%"])
                            ->orWhereRaw("DATE_FORMAT(orders.created_at, '%M') LIKE ?", ["%{$keyword}%"]);
                    });
                })

                ->filterColumn('total_amount', function ($query, $keyword) {
                    $query->where('orders.total_amount', 'like', "%{$keyword}%");
                })

                ->filterColumn('payment_method', function ($query, $keyword) {
                    $query->where('orders.payment_method', 'like', "%{$keyword}%");
                })

                ->filterColumn('status', function ($query, $keyword) {
                    $query->whereRaw("LOWER(orders.status) LIKE ?", ["%" . strtolower($keyword) . "%"]);
                })
                ->filterColumn('source_status', function ($query, $keyword) {
                    $query->whereRaw("LOWER(orders.source_status) LIKE ?", ["%" . strtolower($keyword) . "%"]);
                })
                // SORTING
                ->orderColumn('customer', function ($query, $order) {
                    $query->orderByRaw("COALESCE(users.name, order_details.name) {$order}");
                })

                ->orderColumn('order_id', function ($query, $order) {
                    $query->orderBy('orders.order_number', $order);
                })

                ->orderColumn('order_date', function ($query, $order) {
                    $query->orderBy('orders.created_at', $order);
                })

                ->orderColumn('status', function ($query, $order) {
                    $query->orderBy('orders.status', $order);
                })
                ->orderColumn('source_status', function ($query, $order) {
                    $query->orderBy('orders.source_status', $order);
                })
                ->rawColumns(['order_id', 'customer', 'order_date', 'total_amount', 'grand_total', 'payment_method', 'source_status', 'status', 'action'])

                ->make(true);
        }
    }
    public function getSubscriptionOrders(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::query()
                ->leftJoin('users', 'orders.user_id', '=', 'users.id')
                ->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')
                ->select(
                    'orders.id',
                    'orders.unique_id',
                    'orders.order_number',
                    'orders.created_at',
                    'orders.status',
                    'orders.source_status',
                    'orders.total_amount',
                    'orders.total_addon_price',
                    'orders.bundle_plan_price',
                    'orders.grand_total',
                    'orders.subscription_total',
                    'orders.payment_method',
                    'orders.refund_status',
                    'orders.user_id',
                    'orders.shipping_id',
                    'orders.tracking_url',
                    'users.name as user_name',
                    'users.last_name as user_last_name',
                    'order_details.name as guest_name'
                )

                ->with(['user', 'order_detail', 'refundRequest'])->where('type', 1)->orderBy('orders.id', 'desc');

            return DataTables::of($orders)
                ->addIndexColumn()

                ->addColumn('order_id', function ($order) {
                    $canView = auth()->user()->can(\App\Services\PermissionMap::getPermission('admin.order.details'));

                    if ($canView) {
                        return '<a href="' . route('admin.order.details', $order->unique_id) . '">' . $order->order_number . '</a>';
                    }

                    return $order->order_number;
                })

                ->addColumn('customer', function ($order) {
                    return $order->user_name . ' ' . $order->user_last_name;
                })

                ->addColumn('address', function ($order) {
                    return @$order->user->address ?? 'N/A';
                })

                ->addColumn('order_date', function ($order) {
                    return runTimeDateFormat($order->created_at);
                })

                ->addColumn('subs_date', function ($order) {
                    return runTimeDateFormat(@$order->user->subscription_detail->created_at);
                })


                ->addColumn('order_items', function ($order) {
                    if (empty($order?->items)) {
                        return '<div class="text-sm text-gray-500">No items</div>';
                    }

                    $items_html = '<div class="d-flex flex-column ms-2">';

                    foreach ($order->items as $i => $item) {
                        $items_html .= '<div class="text-sm text-gray-900">'
                            . 'Item ' . ($i + 1) . ': '
                            . '<a href="' . route('product.detail', optional($item->product)->slug) . '" class="text-blue-600 hover:underline" target="_blank">'
                            . e(optional($item->product)->name)
                            . '</a>'
                            . '</div>';
                    }

                    $items_html .= '</div>';

                    return $items_html;
                })

                ->addColumn('source_status', function ($order) {
                    $statusClasses = [
                        'pending'    => 'badge bg-warning-subtle text-warning fw-medium',
                        'processing' => 'badge bg-info-subtle text-info fw-medium',
                        'completed'  => 'badge bg-success-subtle text-success fw-medium',
                        'Success'  => 'badge bg-success-subtle text-success fw-medium',
                        'success'  => 'badge bg-success-subtle text-success fw-medium',
                        'failed'     => 'badge bg-danger-subtle text-danger fw-medium',
                        'Failed'     => 'badge bg-danger-subtle text-danger fw-medium',
                        'cancelled'  => 'badge bg-secondary-subtle text-secondary fw-medium',
                    ];
                    $statusBadgeClass = $statusClasses[$order->source_status] ?? 'badge bg-secondary-subtle text-secondary';
                    $statusBadge = '<span class="' . $statusBadgeClass . '">' . ucfirst($order->source_status) . '</span>';

                    $refundBadge = '';
                    if ($order->refund_status === 'Rejected') {
                        $refundBadge = '<span class="badge bg-danger-subtle text-danger fw-medium">Refund Rejected</span>';
                    }

                    return '<div class="d-flex flex-column gap-1 text-center">'
                        . '<h5>' . $statusBadge . '</h5>'
                        . ($refundBadge ? '<h5>' . $refundBadge . '</h5>' : '')
                        . '</div>';
                })
                ->addColumn('status', function ($order) {
                    $statusClasses = [
                        'pending'    => 'badge bg-warning-subtle text-warning fw-medium',
                        'processing' => 'badge bg-info-subtle text-info fw-medium',
                        'completed'  => 'badge bg-success-subtle text-success fw-medium',
                        'Success'  => 'badge bg-success-subtle text-success fw-medium',
                        'success'  => 'badge bg-success-subtle text-success fw-medium',
                        'failed'     => 'badge bg-danger-subtle text-danger fw-medium',
                        'Failed'     => 'badge bg-danger-subtle text-danger fw-medium',
                        'cancelled'  => 'badge bg-secondary-subtle text-secondary fw-medium',
                    ];
                    $statusBadgeClass = $statusClasses[$order->status] ?? 'badge bg-secondary-subtle text-secondary';
                    $statusBadge = '<span class="' . $statusBadgeClass . '">' . ucfirst($order->status) . '</span>';

                    $refundBadge = '';
                    if ($order->refund_status === 'Rejected') {
                        $refundBadge = '<span class="badge bg-danger-subtle text-danger fw-medium">Refund Rejected</span>';
                    }

                    return '<div class="d-flex flex-column gap-1 text-center">'
                        . '<h5>' . $statusBadge . '</h5>'
                        . ($refundBadge ? '<h5>' . $refundBadge . '</h5>' : '')
                        . '</div>';
                })


                ->addColumn('payment_method', function ($order) {
                    // return $order->tracking_no;
                    return ucfirst($order->payment_method);
                })

                // ->addColumn('total_amount', function ($order) {
                //     return number_format(($order->total_amount) , 2);
                // })
                ->editColumn('grand_total', function ($order) {
                    // return $order->shipping->price ?? 0;
                    // $shippingPrice = isset($order->shipping) ? $order->shipping->price : 0;
                    // $grand_total = ($order->grand_total > 0) ? $order->grand_total  + $shippingPrice : ($order->total_amount + $shippingPrice);

                    // return number_format($grand_total, 2);

                    $shippingPrice = isset($order->shipping) ? $order->shipping->price : 0;
                    $grand_total = ($order->total_addon_price + $shippingPrice + $order->bundle_plan_price);

                    return number_format($grand_total, 2);
                })

                ->addColumn('action', function ($order) {
                    $canView = auth()->user()->hasPermissionTo(\App\Services\PermissionMap::getPermission('admin.order.details'));

                    $html = '<div style="display: flex; gap: 8px;">';

                    // $html .= '<a href="' . route('admin.subscription.orders.reminder', $order->user_id) . '" class="action_btn reminder-noti">
                    //         <i class="ri-notification-line"></i>
                    // </a>';

                    if ($canView) {
                        $html .= '<a href="' . route('admin.order.details', $order->unique_id) . '" class="action_btn edit-item">
                                        <i class="ri-eye-line"></i>
                                </a>';
                    } else {
                        $html .= '<span class="text-center">-</span>';
                    }

                    if ($order->tracking_url) {
                        $html .= '<a href="' . $order->tracking_url . '" class="action_btn" title="Track Order">
                            <i class=" ri-truck-line"></i>
                        </a>';
                    }
                    if ($order->refund_status === 'Refund Requested') {
                        $html .= '<a href="javascript:void(0);" class="action_btn view-refund-request edit-item" title="Manage Refund Request"
                            data-bs-toggle="modal"
                            data-bs-target="#refundRequestManageModal"
                            data-id="' . $order->id . '"
                            data-order-id="' . $order->order_number . '"
                            data-customer="' . ($order->user_name || $order->user_last_name ? trim($order->user_name . ' ' . $order->user_last_name) : $order->guest_name) . '"
                            data-amount="' . $order->total_amount . '"
                            data-status="' . ucfirst($order->status) . '"
                            data-refund-request-id="' . $order->refundRequest->id . '"
                            data-refund-status="' . ucfirst($order->refund_status) . '"
                            data-refund-method="' . $order->refundRequest->refund_method . '"
                            data-user-id="' . $order->user_id . '">
                            <i class="ri-refund-2-fill" aria-hidden="true"></i>
                        </a>';
                    } else {
                        $html .= '<a href="javascript:void(0);" class="action_btn edit-item open-refund-modal" title="Refund Amount"
                                data-bs-toggle="modal"
                                data-bs-target=".bs-example-modal-center"
                                data-id="' . $order->id . '"
                                data-order-id="' . $order->order_number . '"
                                data-customer="' . ($order->user_name || $order->user_last_name ? trim($order->user_name . ' ' . $order->user_last_name) : $order->guest_name) . '"
                                data-amount="' . $order->total_amount . '"
                                data-status="' . ucfirst($order->status) . '"
                                data-refund-status="' . ucfirst($order->refund_status) . '"
                                data-user-id="' . $order->user_id . '">
                                <i class="ri-refund-line"></i>
                            </a>';
                    }

                    $html .= '</div>';

                    return $html;
                })


                // FILTERS
                ->filterColumn('customer', function ($query, $keyword) {
                    $query->where(function ($q) use ($keyword) {
                        $q->where('users.name', 'like', "%{$keyword}%")
                            ->orWhere('users.last_name', 'like', "%{$keyword}%")
                            ->orWhere('order_details.name', 'like', "%{$keyword}%");
                    });
                })

                ->filterColumn('order_id', function ($query, $keyword) {
                    $query->where('orders.order_number', 'like', "%{$keyword}%");
                })

                ->filterColumn('order_date', function ($query, $keyword) {
                    $query->where(function ($q) use ($keyword) {
                        $q->whereDate('orders.created_at', $keyword)
                            ->orWhereRaw("DATE_FORMAT(orders.created_at, '%Y-%m-%d') LIKE ?", ["%{$keyword}%"])
                            ->orWhereRaw("DATE_FORMAT(orders.created_at, '%d-%m-%Y') LIKE ?", ["%{$keyword}%"])
                            ->orWhereRaw("DATE_FORMAT(orders.created_at, '%M') LIKE ?", ["%{$keyword}%"]);
                    });
                })

                // ->filterColumn('total_amount', function ($query, $keyword) {
                //     $query->where('orders.total_amount', 'like', "%{$keyword}%");
                // })

                ->filterColumn('payment_method', function ($query, $keyword) {
                    $query->where('orders.payment_method', 'like', "%{$keyword}%");
                })

                ->filterColumn('status', function ($query, $keyword) {
                    $query->whereRaw("LOWER(orders.status) LIKE ?", ["%" . strtolower($keyword) . "%"]);
                })
                ->filterColumn('source_status', function ($query, $keyword) {
                    $query->whereRaw("LOWER(orders.source_status) LIKE ?", ["%" . strtolower($keyword) . "%"]);
                })
                // SORTING
                ->orderColumn('customer', function ($query, $order) {
                    $query->orderByRaw("COALESCE(users.name, order_details.name) {$order}");
                })

                ->orderColumn('order_id', function ($query, $order) {
                    $query->orderBy('orders.order_number', $order);
                })

                ->orderColumn('order_date', function ($query, $order) {
                    $query->orderBy('orders.created_at', $order);
                })

                ->orderColumn('status', function ($query, $order) {
                    $query->orderBy('orders.status', $order);
                })
                ->orderColumn('source_status', function ($query, $order) {
                    $query->orderBy('orders.source_status', $order);
                })
                ->rawColumns(['order_id', 'customer', 'address', 'order_date', 'subs_date', 'order_items', 'grand_total', 'payment_method', 'source_status', 'status', 'action'])

                ->make(true);
        }
    }

    public function add_extra_item(Request $request)
    {
        $data = $request->all();

        DB::beginTransaction();

        try {
            $product = Product::findOrFail($data['new_product_id']);
            $order = Order::where('user_id', $data['order_user_id'])
                ->where('id', $data['order_id'])
                ->firstOrFail();

            // Update order totals
            $order->total_amount += $product->price;
            $order->total_addon_price += $product->addon_price;
            $order->grand_total += $product->price;
            $order->save();

            // Create order item
            $orderItem = OrderItem::create([
                'order_id'        => $order->id,
                'product_id'      => $product->id,
                'quantity'        => 1,
                'price'           => $product->price,
                'addon_price'     => $product->addon_price ?? 0,
                'delivery_method' => 'manual',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Extra item added successfully.',
                'order'   => $order,
                'item'    => $orderItem
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to add extra item', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to add extra item.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
    public function detail($unique_id)
    {
        $order = Order::where('id', $unique_id)->first();
        $order_ids = OrderItem::where('order_id', $order->id)->pluck('product_id');
        $bundle = ProductBundle::where('month_of', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->first();

        if(!empty($bundle)){
            $bundle_product_ids = $bundle->product_ids;
            $remaining_ids = collect($bundle_product_ids)->diff($order_ids)->values()->toArray();
            $products = Product::whereIn('id', $remaining_ids)->get();
        } else {
            $products = [];
        }


        if ($order) {
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
        return view('admin.orders.detail', compact('order', 'order_items', 'products', 'badgeClass', 'status', 'grand_total'));
    }

    public function addOrderItem($id)
    {
        $orderId = $id;
        // $data = product::where('status', 'active')->get();        
        $data = product::get();
        return view('admin.orders.create-order-item',compact('id','data','orderId'));
    }

    public function addOrderItemPost(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|numeric',
        ]);
        
        $data = $request->all();

        $product = Product::select('price')->find($request->product_id);

        $itemData = [
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $product->price,
            'order_id'=>$request->order_id];

        OrderItem::updateOrCreate(
            ['order_id' => $request->order_id, 'product_id'=>$request->product_id],
            $itemData
        );

        $totalAmount = 0;
        $grandTotal = 0;

        $orderItems = OrderItem::with('product')->where('order_id',$request->order_id)->get();


        foreach($orderItems as $item)
        {
            $totalAmount += $item->product->price*$item->quantity;
        }

        $grandTotal = $totalAmount;

        Order::find($data['order_id'])->update([
            'total_amount'=>$totalAmount,
            'grand_total'=>$grandTotal
        ]);

        return redirect('account/order/edit/'.$request->order_id);
    }

    public function generateInvoice($unique_id)
    {
        // dd($unique_id);
        $order = Order::with(['user','order_detail','items','items.product'])->where('id', $unique_id)->first();
        // // dd($order);
        // $order_ids = OrderItem::where('order_id', $order->id)->pluck('product_id');
        // $bundle = ProductBundle::where('month_of', Carbon::now()->month)
        //     ->whereYear('created_at', Carbon::now()->year)
        //     ->first();

        // $bundle_product_ids = $bundle->product_ids;
        // $remaining_ids = collect($bundle_product_ids)->diff($order_ids)->values()->toArray();
        // $products = Product::whereIn('id', $remaining_ids)->get();

        if ($order) {
        //     $order_items = OrderItem::where('order_id', $order->id)->get();
            $status = $order->status;
        //     $statusClasses = [
        //         'pending'    => 'badge bg-warning-subtle text-warning fw-medium',
        //         'processing' => 'badge bg-info-subtle text-info fw-medium',
        //         'completed'  => 'badge bg-success-subtle text-success fw-medium',
        //         'failed'     => 'badge bg-danger-subtle text-danger fw-medium',
        //         'cancelled'  => 'badge bg-secondary-subtle text-secondary fw-medium',
        //     ];
            $badgeClass = $statusClasses[$order->status] ?? 'badge bg-primary-subtle text-primary';
            $subtotal = $order->total_amount;
        //     $shipping_cost = $order->shipping_id ? Shipping::find($order->shipping_id)->price : 0;
        //     $points_discount = $order->points_discount ?? 0;
            $grand_total = $order->grand_total;
        }

        // return view('admin.orders.invoice', compact('order', 'order_items', 'products', 'badgeClass', 'status', 'grand_total'));
        return view('admin.orders.invoice',compact('order','badgeClass','status','grand_total'));
    }

    public function downloadInvoice($unique_id)
    {
        $order = Order::with('user')->where('unique_id', $unique_id)->firstOrFail();

        $order_ids = OrderItem::where('order_id', $order->id)->pluck('product_id');
        $bundle = ProductBundle::where('month_of', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->first();

        $bundle_product_ids = $bundle ? $bundle->product_ids : [];
        $remaining_ids = collect($bundle_product_ids)->diff($order_ids)->values()->toArray();
        $products = Product::whereIn('id', $remaining_ids)->get();

        $order_items = OrderItem::where('order_id', $order->id)->get();
        $status = $order->status;

        $statusClasses = [
            'pending'    => 'badge bg-warning-subtle text-warning fw-medium',
            'processing' => 'badge bg-info-subtle text-info fw-medium',
            'completed'  => 'badge bg-success-subtle text-success fw-medium',
            'failed'     => 'badge bg-danger-subtle text-danger fw-medium',
            'cancelled'  => 'badge bg-secondary-subtle text-secondary fw-medium',
        ];
        $badgeClass = $statusClasses[$status] ?? 'badge bg-primary-subtle text-primary';

        $subtotal = $order->total_amount;
        $shipping_cost = $order->shipping_id ? Shipping::find($order->shipping_id)->price : 0;
        $points_discount = $order->points_discount ?? 0;
        $grand_total = $subtotal + $shipping_cost - $points_discount - ($order->discount_applied ?? 0);

        // Use PDF-safe Blade template
        $pdf = \PDF::loadView('admin.orders.invoice-pdf', compact(
            'order',
            'order_items',
            'products',
            'badgeClass',
            'status',
            'grand_total'
        ))->setOption('defaultFont', 'Helvetica');

        return $pdf->download('invoice-' . $order->unique_id . '.pdf');
    }

    public function status($id, Request $request)
    {
        $order = Order::find($id);
        if ($order->status === $request->status) {
            return redirect()->back();
        }
        if ($order) {
            $order->status = $request->status;
            $order->update();
            $statusMessages = [
                'pending'    => 'Order marked as Pending.',
                'processing' => 'Order is now Processing.',
                'completed'  => 'Order has been Completed.',
                'failed'     => 'Order has Failed.',
                'cancelled'  => 'Order has been Cancelled.',
            ];
            $historyText = $statusMessages[$order->status] ?? 'Order status updated.';
            OrderHistory::create([
                'order_id' => $order->id,
                'user_id' => $order->user_id,
                'status' => $order->status,
                'notes' => $historyText,
            ]);
        }
        return redirect()->back()->with('success', 'Request has been completed.');
    }

    public function approve(Request $request)
    {
        $request->validate([
            'refund_request_id' => 'required|exists:refund_requests,id',
        ]);

        $refund = RefundRequest::findOrFail($request->refund_request_id);
        $refund->status = 'approved';
        $refund->save();

        $order = Order::find($refund->order_id);
        $order->refund_status = 'Refunded via ' . $refund->refund_method;
        $order->save();

        return response()->json(['success' => 'Request has been completed.']);
    }

    public function reject(Request $request)
    {
        $request->validate([
            'refund_request_id' => 'required|exists:refund_requests,id',
        ]);

        $refund = RefundRequest::findOrFail($request->refund_request_id);
        $refund->status = 'rejected';
        $refund->save();

        $order = Order::find($refund->order_id);
        $order->refund_status = 'Rejected';
        $order->save();

        return response()->json(['success' => 'Request has been completed.']);
    }

    public function orderEdit($id)
    {
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->get();
        $order = Order::with(['items','items.product'])->find($id);
        $affiliate_titles = ProductAffiliate::where('product_id', $id)->pluck('title')->toArray();
        $affiliate_links = ProductAffiliate::where('product_id', $id)->pluck('link')->toArray();
        $attributes = Attribute::where('status', 1)->get();
        // return $product;

        $states = State::all();
        $state = State::find($order->state_id);
        $cities = City::distinct('name')->where('state',$state->name)->get();

        return view('admin.orders.edit', compact('categories', 'order', 'affiliate_titles', 'affiliate_links', 'attributes','states','cities'));
    }

    public function orderEditPost($id, Request $request)
    {
        $request->validate([
            'first_name'     => 'required|string',
            'last_name'      => 'required|string',
            'email'          => 'required|email',
            'phone_number'=>'required|numeric',
            'state'          => 'required',
            'city_id'           => 'required',
            'postal_code'=>'required',
            'address'=>'required'
        ]);

        $state = State::where('name',$request->state)->first();
        $stateId = $state->id;

        $data = $request->all();
        $data['state_id'] = $stateId;

        $order = Order::find($id);
        $order->update($data);
        OrderItem::where('order_id',$order->id)->delete();

        $totalPrice = 0;
        $count = 0;
        foreach($request->product_ids as $productId)
        {
             OrderItem::create([
                        'product_id' => $productId,
                        'attribute_id' => null,
                        'quantity' => $request->quantity[$count],
                        'price' => $request->product_prices[$count],
                        'order_id'=>$order->id
                    ]);

                    $totalPrice += $request->product_prices[$count]*$request->quantity[$count];

                    $count++;
        }

         $order->update(['total_amount'=>$totalPrice,'grand_total'=>$totalPrice]);

         return redirect()->back();


        // dd($request->all());
    }

    function deleteOrderItem(Request $request)
    {
        $orderId = $request->order_id;
        $orderItemId = $request->order_item_id;

        OrderItem::find($orderItemId)->delete();

        $orderItems = OrderItem::where('order_id',$orderId)->get();

        $totalAmount = 0;
        $grandTotal = 0;

        $orderItems = OrderItem::with('product')->where('order_id',$orderId)->get();

        foreach($orderItems as $item)
        {
            $totalAmount += $item->product->price*$item->quantity;
        }

        $grandTotal = $totalAmount;

        Order::find($orderId)->update([
            'total_amount'=>$totalAmount,
            'grand_total'=>$grandTotal
        ]);

        return redirect('account/order/edit/'.$orderId);
    }
}
