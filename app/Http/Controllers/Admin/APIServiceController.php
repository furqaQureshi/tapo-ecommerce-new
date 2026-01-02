<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\APIService;
use Yajra\DataTables\Facades\DataTables;

class APIServiceController extends Controller
{
    public function list()
    {
        return view('admin.apiservices.list');
    }

    public function get(Request $request)
    {
        if ($request->ajax()) {
            $data = APIService::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('is_active', function ($data) {
                    return $data->is_active ? 'Active' : 'Not Active';
                })
                ->addColumn('action', function ($data) {
                    $action_btn = '<a href='.route("admin.apiservices.edit", $data->id).' class="action_btn edit-item me-1">
                                                    <i class="ri-edit-line"></i>
                                                </a>';

                    $action_btn .=  '<form method="POST" action='.route("admin.apiservices.destroy", $data->id).' style="display:inline;">
                                    '.csrf_field().'
                                    '.method_field('DELETE').'
                                    <button type="submit" class="action_btn delete-item show_confirm" data-name="Supplier">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>';
                    return $action_btn;
                })
                ->rawColumns(['is_active', 'action'])
                ->make(true);
        }
    }

    public function edit($id)
    {
        $api_service = APIService::find($id);
        return view('admin.apiservices.edit', compact('api_service'));
    }

    public function create()
    {
        return view('admin.apiservices.create');
    }

    public function view($id)
    {
        $api_service = APIService::find($id);
        return view('admin.apiservices.view', compact('api_service'));
    }

    public function store(Request $request)
    {
        $validation = $this->validate($request, [
            'name'=> 'required',
            'slug'=> 'required',
            'base_url'=> 'required',
            'auth_type'=> 'required'
        ]);

        if (APIService::where('slug',$request->slug)->exists()) {
            $request['slug'] = $request->slug .'-'.time();
        }

        $api_service = APIService::create($request->all());
        return redirect()->route('admin.apiservices.list')->with('success','Supplier Added successfully!');
    }

    public function update(Request $request, $id)
    {
        $validation = $this->validate($request, [
            'name'=> 'required',
            'slug'=> 'required',
            'base_url'=> 'required',
            'auth_type'=> 'required'
        ]);

        if (APIService::where('id','!=', $id)->where('slug',$request->slug)->exists()) {
            $request['slug'] = $request->slug .'-'.time();
        }

        $api_service = APIService::find($id);
        $api_service->update($request->all());

        return redirect()->route('admin.apiservices.list')->with('success','Supplier Updated successfully!');
    }

    public function destroy($id)
    {
        $api_service = APIService::find($id);
        $api_service->delete();
        return redirect()->back()->with('success','Supplier deleted successfully!');
    }
}
