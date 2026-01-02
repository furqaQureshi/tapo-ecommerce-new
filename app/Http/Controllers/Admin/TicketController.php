<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function list()
    {
        return view('admin.tickets.index');
    }

    public function get(Request $request)
    {
        if ($request->ajax()) {
            $data = Ticket::select(['id', 'image', 'name', 'status']);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    return '<img src="' . asset($row->image) . '" width="50" class="table-image" />';
                })
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('status', function ($row) {
                    $checked = $row->status ? 'checked' : '';
                    return '<input type="checkbox" class="status" data-id="' . $row->id . '" ' . $checked . '>';
                })
                ->addColumn('actions', function ($row) {
                    return '
                        <a href="' . route('admin.ticket.edit', $row->id) . '" class="action_btn edit-item"><i class="ri-edit-line"></i></a>
                        <button class="action_btn delete-btn" data-id="' . $row->id . '" ><i class="bx bx-trash"></i></button>
                    ';
                })
                ->rawColumns(['name', 'image', 'status', 'actions'])
                ->make(true);
        }
    }

    public function create()
    {
        return view('admin.tickets.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:10240',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->image) {
            $featuredImage = $request->file('image');
            $featuredImageName = $request->slug . '_' . time() . '.' . $featuredImage->getClientOriginalExtension();
            $featuredImagePath = public_path('tickets/image/');
            $featuredImage->move($featuredImagePath, $featuredImageName);

            if (file_exists(public_path($name =  $featuredImage->getClientOriginalName()))) {
                unlink(public_path($name));
            }

            $data['image'] = 'tickets/image/' . $featuredImageName;
        }

        Ticket::create($data);
        return redirect()->route('admin.tickets.list')->with('success', 'Ticket created successfully');
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('admin.tickets.edit', compact('ticket'));
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name'   => 'required|string|max:255',
            'image'  => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            $featuredImage = $request->file('image');
            $featuredImageName = $request->slug . '_' . time() . '.' . $featuredImage->getClientOriginalExtension();
            $featuredImagePath = public_path('tickets/image/');

            // Delete old image if exists
            if ($ticket->image && file_exists(public_path($ticket->image))) {
                unlink(public_path($ticket->image));
            }

            // Save new image
            $featuredImage->move($featuredImagePath, $featuredImageName);
            $data['image'] = 'tickets/image/' . $featuredImageName;
        } else {
            // Keep the old image if no new one is uploaded
            $data['image'] = $ticket->image;
        }

        $ticket->update($data);

        return redirect()->route('admin.tickets.list')->with('success', 'Ticket updated successfully');
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);

        if ($ticket->image && file_exists(public_path($ticket->image))) {
            unlink(public_path($ticket->image));
        
        }
        $ticket->delete();

        return response()->json(['success' => 'Ticket deleted successfully']);
    }

    public function updateStatus(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->status = $request->status;
        $ticket->save();
        return response()->json(['success' => 'Status updated successfully']);
    }
}
