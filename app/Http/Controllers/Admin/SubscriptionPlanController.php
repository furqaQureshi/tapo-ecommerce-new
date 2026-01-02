<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\SubscriptionPlan;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;
use Razorpay\Api\Api;

class SubscriptionPlanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin|staff']);
    }

    public function list()
    {
        return view('admin.subscription-plans.list');
    }
    public function get(Request $request)
    {
        if ($request->ajax()) {
            $data = SubscriptionPlan::select('subscription_plans.*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->filterColumn('title', function ($query, $keyword) {
                    $query->where('title', 'like', "%$keyword%");
                })
                ->addColumn('type', function ($row) {
                    return $row->type == 1 ? 'Monthly' : ($row->type == 2 ? 'Yearly' : 'Unknown');
                })
                ->addColumn('price', function ($row) {
                    return e($row->price);
                })
                ->addColumn('discount', function ($row) {
                    return e($row->discount) . '%';
                })
                ->addColumn('description', function ($row) {
                    return e($row->description);
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<span class="badge bg-success">Active</span>';
                    } else {
                        return '<span class="badge bg-danger">Inactive</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.subscription-plan.edit', $row->id);
                    $deleteUrl = route('admin.subscription-plan.destroy', $row->id);
                    $csrf = csrf_field();
                    $method = method_field('DELETE');

                    $html = '';
                    $html .= '<div style="display: flex; gap: 8px;">
                                <a href="' . $editUrl . '" class="action_btn edit-item">
                                    <i class="ri-edit-line"></i>
                                </a>
                                <form method="POST" action="' . $deleteUrl . '" style="display:inline;">
                                    ' . $csrf . '
                                    ' . $method . '
                                    <button type="submit" class="action_btn delete-item show_confirm" data-name="Plan">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </div>';

                    return $html;
                })


                ->rawColumns(['title', 'price', 'discount', 'action', 'status', 'description', 'type'])
                ->make(true);
        }
    }
    public function add()
    {
        return view('admin.subscription-plans.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:1,2',
            'price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:1,0',
        ]);

        // Initialize Curlec (Razorpay) API
        $api = new Api(
            env('RAZORPAY_KEY'),
            env('RAZORPAY_SECRET')
        );

        try {
            // $plan = $api->plan->create([
            //     'period' => 'monthly',
            //     'interval' => 1,
            //     'item' => [
            //         'name' => $request->title,
            //         'description' => $request->description ?? 'Description for ' . $request->title,
            //         'amount' => (int)($request->price * 100),
            //         'currency' => 'MYR',
            //     ],
            //     'notes' => [
            //         'notes_key_1' => $request->title . ' title one',
            //         'notes_key_2' => $request->title . ' title two'
            //     ]
            // ]);

            // Create the subscription plan in the database
            $subscriptionPlan = SubscriptionPlan::create([
                'title' => $request->title,
                'type' => $request->type,
                'price' => $request->price,
                'discount' => $request->discount,
                'description' => $request->description,
                'status' => $request->status,
                'have_offer' => $request->have_offer,
                'offer_expiry' => $request->offer_expiry,
                'offer_month' => $request->offer_month,
                // 'curlec_plan_id' => $plan->id,
            ]);

            return redirect()->route('admin.subscription-plan.list')->with('success', 'Subscription plan created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create subscription plan: ' . $e->getMessage());
        }
    }


    public function edit($id)
    {
        $plan = SubscriptionPlan::find($id);
        return view('admin.subscription-plans.edit', compact('plan'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:1,2',
            'price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:1,0',
        ]);

        $subscriptionPlan = SubscriptionPlan::findOrFail($id);

        $subscriptionPlan->update([
            'title' => $request->title,
            'type' => $request->type,
            'price' => $request->price,
            'discount' => $request->discount,
            'description' => $request->description,
            'status' => $request->status,
             'have_offer' => $request->have_offer,
            'offer_expiry' => $request->offer_expiry,
            'offer_month' => $request->offer_month,
        ]);

        return redirect()->route('admin.subscription-plan.list')->with('success', 'Subscription plan updated successfully.');
    }


    public function destroy($id)
    {
        $subscriptionPlan = SubscriptionPlan::findOrFail($id);
        $subscriptionPlan->delete();

        return redirect()->route('admin.subscription-plan.list')->with('success', 'Subscription plan deleted successfully.');
    }
}
