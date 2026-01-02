@extends('admin.master.layouts.app')
@section('page-title')
    Blogs
@endsection
@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link href="{{ asset('admin/assets') }}/css/datatable.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('page-content')
    @component('admin.master.layouts.partials.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Languages
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
                                    <h4 class="card-title mb-0 flex-grow-1">Languages</h4>
                                </div>
                                <div class="p-0">
                                    <a href="{{ route('admin.blog.add') }}" class="btn btn-danger" data-name="blogAdd"><img
                                            src="{{ asset('admin/assets/images/svg/add.svg') }}" width="12"
                                            class="me-1"> Add Blog</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($languages as $langkey => $langvalue) 
                                <div class="row mb-2">                              
                                <div class="col-md-10 form-group">
                                    <textarea id="{{ $langkey }}" name="{{ $langkey }}" rows="3" class="form-control">{{ $langvalue }}</textarea></div>
                                <div class="col-md-2 form-group"><button type="button" class="btn btn-info update-lang" data-name="{{ $langkey }}">Update</button></div>
                                </div>
                                @endforeach
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="{{ asset('admin/assets') }}/js/pages/datatables.init.js"></script>
    <script>
        $('.update-lang').on('click', function() {
            var langKey = $(this).data('name');
            var langValue = $('#' + langKey).val();
            $.ajax({
                url: "{{ route('admin.lang.update') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    langKey: langKey,
                    langValue: langValue
                },
                success: function(response) {
                    if (response.success) {
                        alert('Language updated successfully');
                    } else {
                        
                        alert('Error updating language');
                    }
                }
            });
        });
    </script>

@endsection
