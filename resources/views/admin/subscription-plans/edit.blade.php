@extends('admin.master.layouts.app')

@section('page-title')
    Edit Subscription Plan
@endsection

@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link href="{{ asset('admin/assets') }}/css/datatable.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('page-content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0 flex-grow-1">Edit Subscription Plan</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form class="row g-3" method="POST" action="{{ route('admin.subscription-plan.update', $plan->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col-md-12">
                                    <label for="title" class="form-label">Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title', $plan->title) }}"
                                        placeholder="Subscription Title" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="type" class="form-label">Type <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control form-select @error('type') is-invalid @enderror"
                                            id="type" name="type" required>
                                        <option value="" disabled>Select Type</option>
                                        @foreach ([1 => 'monthly', 2 => 'yearly'] as $value => $label)
                                            <option value="{{ $value }}"
                                                {{ old('type', $plan->type) == (string)$value ? 'selected' : '' }}>
                                                {{ ucfirst($label) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="price" class="form-label">Price <span
                                            class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                                        id="price" name="price" value="{{ old('price', $plan->price) }}"
                                        placeholder="Price" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="discount" class="form-label">Discount <span
                                            class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control @error('discount') is-invalid @enderror"
                                        id="discount" name="discount" value="{{ old('discount', $plan->discount) }}"
                                        placeholder="discount" required>
                                    @error('discount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="status" class="form-label">Status <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control form-select @error('status') is-invalid @enderror"
                                            id="status" name="status" required>
                                        <option value="" disabled>Select Status</option>
                                        @foreach ([1 => 'active', 0 => 'inactive'] as $value => $label)
                                            <option value="{{ $value }}"
                                                {{ old('status', $plan->status) == (string)$value ? 'selected' : '' }}>
                                                {{ ucfirst($label) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="have_offer" class="form-label">Have Offer <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control form-select @error('have_offer') is-invalid @enderror"
                                            id="have_offer" name="have_offer" required>
                                        <option value="" disabled>Select Any</option>
                                        @foreach (['Y' => 'Yes', 'N' => 'No'] as $value => $label)
                                            <option value="{{ $value }}"
                                                {{ old('status', $plan->have_offer) == (string)$value ? 'selected' : '' }}>
                                                {{ ucfirst($label) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('have_offer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="offer_expiry" class="form-label">Offer Expiry Date <span
                                            class="text-danger" id="offer_expiry_star">*</span></label>
                                   <input type="date" min="{{ date('Y-m-d') }}" class="form-control @error('offer_expiry') is-invalid @enderror"
                                        id="offer_expiry" name="offer_expiry" value="{{ old('offer_expiry', $plan->offer_expiry) }}"
                                        placeholder="Date">
                                    @error('offer_expiry')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                 <div class="col-md-3">
                                    <label for="offer_month" class="form-label">Offer For <small>(in months)</small> <span
                                            class="text-danger" id="offer_month_star">*</span></label>
                                   <input type="number" class="form-control @error('offer_month') is-invalid @enderror"
                                        id="offer_month" name="offer_month" value="{{ old('offer_month', $plan->offer_month) }}"
                                        placeholder="Month">
                                    @error('offer_month')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                        id="description" name="description" rows="5"
                                        placeholder="Subscription Description">{{ old('description', $plan->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-danger">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
$(document).ready(function(){

       $('#offer_month_star').hide();
       $('#offer_expiry_star').hide();
       $('#have_offer').on('change', function(){
            var current_value = $(this).val();
            if(current_value=='Y')
            {
                $('#offer_month').attr('required','required');
                $('#offer_expiry').attr('required','required');
                 $('#offer_month_star').show();
                $('#offer_expiry_star').show();
            }
            else
            {
                $('#offer_month').removeAttr('required');
                $('#offer_expiry').removeAttr('required');
                 $('#offer_month_star').hide();
                $('#offer_expiry_star').hide();
            }
       });

});
</script>
@endsection
