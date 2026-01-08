@extends('admin.master.layouts.app')
@section('page-title')
    Create Delivery Interval
@endsection
@section('page-content')
    @component('admin.master.layouts.partials.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Add Delivery Interval
        @endslot
    @endcomponent
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="row g-3" method="POST" action="{{ route('admin.delivery-interval.store') }}">
                                @csrf
                                <div class="col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Weeks</label>
                                    <input type="number" name="weeks" class="form-control" value="{{ old('weeks') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Default</label>
                                    <select name="is_default" class="form-select">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
