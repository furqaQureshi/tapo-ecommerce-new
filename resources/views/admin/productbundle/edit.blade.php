@extends('admin.master.layouts.app')
@section('page-title')
    Edit Product Bundle
@endsection
@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link href="{{ asset('admin/assets') }}/css/datatable.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-5-theme/1.3.0/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <style>
        .select2-container .select2-selection--multiple .select2-selection__choice {
            color: #b04c49 !important;
            font-weight: 600 !important;
        }

        .select2-results__option--selected {
            display: none;
        }
    </style>
@endsection
@section('page-content')
    @component('admin.master.layouts.partials.breadcrumb')
        @slot('li_1')
            Product Bundles
        @endslot
        @slot('title')
            Edit
        @endslot
    @endcomponent
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div class="p-0">
                                    <h4 class="card-title mb-0 flex-grow-1">Edit Product Bundle</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="row g-3" method="POST" action="{{ route('product-bundle.update', $bundle->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <label for="month_of" class="form-label">Month Of <span
                                            class="text-danger">*</span></label>
                                    <select id="monthSelect" name="month_of" class="form-control js-example-basic-single"
                                        required>
                                        <option value="">--Select a Month--</option>
                                        <option value="01"
                                            {{ old('month_of', $bundle->month_of) == '01' ? 'selected' : '' }}>January
                                        </option>
                                        <option value="02"
                                            {{ old('month_of', $bundle->month_of) == '02' ? 'selected' : '' }}>February
                                        </option>
                                        <option value="03"
                                            {{ old('month_of', $bundle->month_of) == '03' ? 'selected' : '' }}>March
                                        </option>
                                        <option value="04"
                                            {{ old('month_of', $bundle->month_of) == '04' ? 'selected' : '' }}>April
                                        </option>
                                        <option value="05"
                                            {{ old('month_of', $bundle->month_of) == '05' ? 'selected' : '' }}>May</option>
                                        <option value="06"
                                            {{ old('month_of', $bundle->month_of) == '06' ? 'selected' : '' }}>June</option>
                                        <option value="07"
                                            {{ old('month_of', $bundle->month_of) == '07' ? 'selected' : '' }}>July</option>
                                        <option value="08"
                                            {{ old('month_of', $bundle->month_of) == '08' ? 'selected' : '' }}>August
                                        </option>
                                        <option value="09"
                                            {{ old('month_of', $bundle->month_of) == '09' ? 'selected' : '' }}>September
                                        </option>
                                        <option value="10"
                                            {{ old('month_of', $bundle->month_of) == '10' ? 'selected' : '' }}>October
                                        </option>
                                        <option value="11"
                                            {{ old('month_of', $bundle->month_of) == '11' ? 'selected' : '' }}>November
                                        </option>
                                        <option value="12"
                                            {{ old('month_of', $bundle->month_of) == '12' ? 'selected' : '' }}>December
                                        </option>
                                    </select>
                                    @error('month_of')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <label for="product_ids" class="form-label">Products <span
                                            class="text-danger">*</span></label>
                                    <select id="productsSelect" name="product_ids[]" class="form-control select2" multiple
                                        required>
                                        <option value="" disabled>--Select Products--</option>
                                        @if (!empty($products))
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                    {{ in_array($product->id, old('product_ids', $bundle->product_ids ?? [])) ? 'selected' : '' }}>
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('product_ids')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="text-right">
                                        <a href="{{ route('product-bundle.index') }}" class="btn btn-light">Cancel</a>
                                        <button class="btn btn-danger" type="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div>
    </div>
@endsection
@section('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Bootstrap 5.3.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2 for month
            $('#monthSelect').select2({
                width: '100%',
                placeholder: '--Select a Month--',
                allowClear: true
            });

            // Initialize Select2 for products with hideSelected
            $('#productsSelect').select2({
                width: '100%',
                placeholder: '--Select Products--',
                allowClear: true,
                hideSelected: true // Hide selected options from dropdown
            }).on('select2:select', function(e) {
                // Force update to hide selected options
                $(this).trigger('change.select2');
            }).on('select2:unselect', function(e) {
                // Ensure unselected options reappear in dropdown
                $(this).trigger('change.select2');
            });

            // Set current month as default if no value is selected
            const currentMonth = String(new Date().getMonth() + 1).padStart(2, '0');
            if (!$('#monthSelect').val()) {
                $('#monthSelect').val(currentMonth).trigger('change');
            }

            // Form submission validation for minimum 4 products
            $('form').on('submit', function(e) {
                const selected = $('#productsSelect').val();
                if (!selected || selected.length < 4) {
                    e.preventDefault();
                    toastr.error('You must select at least 4 products.');
                }
            });

            // Add invalid feedback styling for Select2
            $('form').on('submit', function() {
                $('.select2').each(function() {
                    if ($(this).prop('required') && !$(this).val()) {
                        $(this).next('.select2-container').addClass('is-invalid');
                    } else {
                        $(this).next('.select2-container').removeClass('is-invalid');
                    }
                });
            });

            $('.form-control').on('change', function() {
                if ($(this).val()) {
                    $(this).next('.select2-container').removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection
