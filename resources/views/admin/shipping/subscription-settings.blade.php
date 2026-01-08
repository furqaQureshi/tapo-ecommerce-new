@extends('admin.master.layouts.app')

@section('page-title')
    Subscription Settings
@endsection

@section('page-content')
    <div class="page-content">
        <div class="container-fluid">
            @component('admin.master.layouts.partials.breadcrumb')
                @slot('li_1')
                    Dashboard
                @endslot
                @slot('title')
                    Subscription Settings
                @endslot
            @endcomponent

            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('admin.subscription.settings.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label"><b>Subscription Discount (%)</b></label>
                            <input type="number" step="0.01" class="form-control" name="discount" value="{{ optional($discount)->value ?? 5 }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>Subscription Free Shipping Minimum (RM)</b></label>
                            <input type="number" step="0.01" class="form-control" name="free_shipping" value="{{ optional($freeShipping)->value ?? 150 }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
