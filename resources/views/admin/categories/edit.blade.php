@extends('admin.master.layouts.app')
@section('page-title')
    Edit Category
@endsection
@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link href="{{ asset('admin/assets') }}/css/datatable.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
@endsection
@section('page-content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div class="p-0">
                                    <h4 class="card-title mb-0 flex-grow-1">Category Edit</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="row g-3" method="POST"
                                action="{{ route('admin.category.update', $category->id) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Name" value="{{ $category->name }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="slug" name="slug"
                                        placeholder="Slug" value="{{ $category->slug }}" required>
                                    @error('slug')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Parent Category --}}
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <label for="parent_id" class="form-label">Parent Category</label>
                                    <select class="form-control" id="parent_id" name="parent_id">
                                        <option value="">-- None (Main Category) --</option>
                                        @foreach ($parent_categories as $parent)
                                            <option value="{{ $parent->id }}"
                                                {{ $category->parent_id == $parent->id ? 'selected' : '' }}>
                                                {{ $parent->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-sm-12">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea type="text" class="form-control" rows="3" id="description" name="description"
                                        placeholder="Description">{{ $category->description }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-check form-check-right mb-2">
                                        <input class="form-check-input" type="checkbox" name="status" id="status1"
                                            {{ $category->status == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status1">
                                            Status
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label class="form-label">Featured Image</label>
                                    <input type="file" name="image" class="dropify"
                                        data-default-file="{{ asset($category->image) }}" id="image" data-height="180"
                                        accept=".jpg, .jpeg, .png, .webp">
                                </div>
                                <div class="col-12">
                                    <div class="text-right">
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
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>

    <script>
        $(document).ready(function() {

            let drEvent = $('#image').dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happened.'
                }
            });

            drEvent.on('change', function(e) {
                let file = e.target.files[0];

                if (file) {
                    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
                    const maxSize = 10 * 1024 * 1024;

                    if (!allowedTypes.includes(file.type)) {
                        toastr.error('Invalid file type. Only JPG, JPEG, PNG, and WEBP are allowed.');
                        $(this).val('');
                        $('.dropify-clear').click();
                        return;
                    }

                    if (file.size > maxSize) {
                        toastr.error('File size exceeds 10MB limit.');
                        $(this).val('');
                        $('.dropify-clear').click();
                        return;
                    }
                }
            });
            $('#name').on('input', function() {
                let name = $(this).val();
                let slug = name
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');

                $('#slug').val(slug);
            });
            $('#slug').on('input', function() {
                let cleanSlug = $(this).val().replace(/[^a-zA-Z0-9-]/g, '');
                $(this).val(cleanSlug);
            });

        });
    </script>
@endsection
