@extends('admin.master.layouts.app')

@section('page-title')
    Add Supplier
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
                                <h4 class="card-title mb-0 flex-grow-1">Add Supplier</h4>
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
                            <form class="row g-3" method="POST" action="{{ route('admin.apiservices.store') }}" id="apiServiceForm">
                                @csrf
                                @method('POST')
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') }}"
                                        placeholder="Supplier Name" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="slug" class="form-label">Slug <span
                                            class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        id="slug" name="slug" value="{{ old('slug') }}"
                                        placeholder="Slug" required>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="base_url" class="form-label">Base Url <span
                                            class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('base_url') is-invalid @enderror"
                                        id="base_url" name="base_url" value="{{ old('base_url') }}"
                                        placeholder="Base Url" required>
                                    @error('base_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="email" class="form-label">Auth Type <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('auth_type') is-invalid @enderror"
                                        id="auth_type" name="auth_type" value="{{ old('auth_type') }}" placeholder="Auth Type (apikey, bearer, basic, etc)"
                                        required>
                                    @error('auth_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="statusCheckToggle" class="form-label">Status</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" checked type="checkbox" name="is_active" {{ old('is_active') == 1 ? 'checked' : '' }} value="1" role="switch" id="statusCheckToggle">
                                        <label class="form-check-label" for="statusCheckToggle">Active</label>
                                    </div>
                                    @error('is_active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Credentials Repeater -->
                                <div class="col-md-12">
                                    <label class="form-label">Credentials</label>
                                    <div id="repeater">
                                    <div class="row mb-3 repeater-item">
                                        <div class="col-md-5">
                                            <input type="text" class="form-control key-input" placeholder="Key">
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control value-input" placeholder="Value">
                                        </div>
                                        <div class="col-md-2 d-grid">
                                            <button type="button" class="btn btn-danger btn-sm remove-btn">Remove</button>
                                        </div>
                                    </div>
                                </div>

                                    <div class="mb-3">
                                        <button type="button" id="addBtn" class="btn btn-sm btn-primary">Add Row <i class="fs-6 ri-add-box-fill"></i></button>
                                    </div>

                                    <input type="hidden" name="credentials" id="credentialsJson" />
                                </div>

                                <!-- Header Repeater -->
                                <div class="col-md-12">
                                    <label class="form-label">Headers</label>
                                    <div id="header-repeater">
                                    <div class="row mb-3 header-repeater-item">
                                        <div class="col-md-5">
                                            <input type="text" class="form-control header-key-input" placeholder="Key">
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control header-value-input" placeholder="Value">
                                        </div>
                                        <div class="col-md-2 d-grid">
                                            <button type="button" class="btn btn-danger btn-sm header-remove-btn">Remove</button>
                                        </div>
                                    </div>
                                </div>

                                    <div class="mb-3">
                                        <button type="button" id="addHeaderBtn" class="btn btn-sm btn-primary">Add Row <i class="fs-6 ri-add-box-fill"></i></button>
                                    </div>

                                    <input type="hidden" name="headers" id="headersJson" />
                                </div>

                                <div class="col-md-12">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea name="notes" id="notes" class="form-control">{{ old('notes') }}</textarea>
                                </div>
                               
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-danger">Submit</button>
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
    $(document).ready(function () {
      
      $('#addBtn').click(function () {
        const newRow = `
          <div class="row mb-3 repeater-item">
            <div class="col-md-5">
              <input type="text" class="form-control key-input" placeholder="Key">
            </div>
            <div class="col-md-5">
              <input type="text" class="form-control value-input" placeholder="Value">
            </div>
            <div class="col-md-2 d-grid">
              <button type="button" class="btn btn-sm btn-danger remove-btn">Remove</button>
            </div>
          </div>`;
        $('#repeater').append(newRow);
      });

      $('#repeater').on('click', '.remove-btn', function () {
        $(this).closest('.repeater-item').remove();
      });

      $('#addHeaderBtn').click(function () {
        const newRow = `
          <div class="row mb-3 header-repeater-item">
            <div class="col-md-5">
              <input type="text" class="form-control header-key-input" placeholder="Key">
            </div>
            <div class="col-md-5">
              <input type="text" class="form-control header-value-input" placeholder="Value">
            </div>
            <div class="col-md-2 d-grid">
              <button type="button" class="btn btn-sm btn-danger header-remove-btn">Remove</button>
            </div>
          </div>`;
        $('#header-repeater').append(newRow);
      });

      $('#header-repeater').on('click', '.header-remove-btn', function () {
        $(this).closest('.header-repeater-item').remove();
      });

      $('#apiServiceForm').submit(function (e) {
            e.preventDefault();

            const credentials = {};
            const headers = {};

            $('.repeater-item').each(function () {
                const key = $(this).find('.key-input').val().trim();
                const value = $(this).find('.value-input').val().trim();
                if (key) {
                credentials[key] = value;
                }
            });

            $('.header-repeater-item').each(function () {
                const key = $(this).find('.header-key-input').val().trim();
                const value = $(this).find('.header-value-input').val().trim();
                if (key) {
                headers[key] = value;
                }
            });

            $('#credentialsJson').val(JSON.stringify(credentials));
            $('#headersJson').val(JSON.stringify(headers));

    
            console.log('Credentials JSON:', $('#credentialsJson').val());
            console.log('Headers JSON:', $('#headersJson').val());

            this.submit();
        });


      
    });
  </script>
@endsection
