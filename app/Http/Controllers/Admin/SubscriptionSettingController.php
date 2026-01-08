<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppSetting;

class SubscriptionSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin|staff']);
    }

    public function edit()
    {
        $data['discount'] = AppSetting::where('variable', 'subscription_discount')->first();
        $data['freeShipping'] = AppSetting::where('variable', 'subscription_free_shipping')->first();

        return view('admin.shipping.subscription-settings', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'discount' => 'required|numeric|min:0|max:100',
            'free_shipping' => 'required|numeric|min:0',
        ]);

        AppSetting::updateOrInsert(
            ['variable' => 'subscription_discount'],
            ['value' => $request->discount, 'updated_at' => now()]
        );

        AppSetting::updateOrInsert(
            ['variable' => 'subscription_free_shipping'],
            ['value' => $request->free_shipping, 'updated_at' => now()]
        );

        return redirect()->route('admin.subscription.settings')->with('success', 'Subscription settings updated.');
    }
}
