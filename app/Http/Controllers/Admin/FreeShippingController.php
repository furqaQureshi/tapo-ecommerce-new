<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\AppSetting;

class FreeShippingController extends Controller
{
    public function list()
    {
        return view('admin.shipping.free-shipping');
    }

    public function create()
    {
        return view('admin.shipping.free-shipping-create');
    }

    public function edit()
    {
        $data['freeShipping'] = AppSetting::where('variable','free_shipping')->first();
        return view('admin.shipping.free-shipping-create', $data);
    }

    public function update(Request $request)
    {
        AppSetting::where('variable','free_shipping')->update(['value'=>$request->amount]);
        return redirect('account/settings/free-shipping');
    }

    public function freeShippingData(Request $request)
    {
        
        if ($request->ajax()) {

            $data = AppSetting::where('variable','free_shipping')->get();

            return Datatables::of($data)

                    ->addIndexColumn()

                    ->addColumn('actions', function($row){

                            $actions = '    <div class="d-flex gap-2">
                            <a href='.url('account/settings/free-shipping/'.$row->id.'/edit').'>
                            <button class="action_btn edit-item">
                            <i class="ri-edit-line"></i>
                            </button>
                            </a>
                            </div>';

                            return $actions;

                    })

                    ->rawColumns(['actions'])

                    ->make(true);

        }
    }
    
}
