    @extends('admin.master.layouts.app')

    @section('page-title')

        Coupons

    @endsection

    @section('head')

        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />

        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

        <link href="{{ URL('admin/assets') }}/css/datatable.min.css" rel="stylesheet" type="text/css" />

        <style>

            .text-purple {

                color: #6f42c1;

            }



            .text-muted {

                color: #6c757d !important;

            }



            .font-monospace {

                font-family: "Courier New", Courier, monospace;

            }

            .select2-container--open {

                z-index: 1060 !important;

            }

            .select2-dropdown {

                z-index: 1061 !important;

            }

            li.select2-selection__choice {

                color: black !important;

            }

        </style>

    @endsection

    @section('page-content')

        @component('admin.master.layouts.partials.breadcrumb')

            @slot('li_1')

                Dashboard

            @endslot

            @slot('title')

                Coupons

            @endslot

        @endcomponent

        <div class="page-content">

            <div class="container-fluid">

                <!-- Filters -->

                {{-- <div class="card shadow-sm mb-4">

                    <div class="card-body">

                        <div class="row g-3">

                            <div class="col-md-8">

                                <div class="input-group">

                                    <span class="input-group-text"><i class="bi bi-search"></i></span>

                                    <input type="text" id="search-input" placeholder="Search coupons..."

                                        class="form-control">

                                </div>

                            </div>

                            <div class="col-md-4 d-flex align-items-center">

                                <span class="me-2"><i class="bi bi-filter"></i></span>

                                <select id="status-filter" class="form-select">

                                    <option value="all">All Status</option>

                                    <option value="active">Active</option>

                                    <option value="expired">Expired</option>

                                    <option value="inactive">Inactive</option>

                                </select>

                            </div>

                        </div>

                    </div>

                </div> --}}



                <!-- Coupons Table -->

                <div class="card">

                    <div class="card-body">

                        <table id="coupons-table"

                            class="table table-bordered dt-responsive nowrap table-striped align-middle">

                            <thead>

                                <tr>

                                    <th scope="col"

                                        class="px-3 py-3 text-start text-xs font-medium text-muted text-uppercase">

                                        Type</th>

                                    <th scope="col"

                                        class="px-3 py-3 text-start text-xs font-medium text-muted text-uppercase">

                                        Amount</th>

                                    <th scope="col"

                                        class="px-3 py-3 text-start text-xs font-medium text-muted text-uppercase">

                                        Actions</th>

                                </tr>

                            </thead>

                            <tbody></tbody>

                        </table>

                    </div>

                </div>



                <!-- Modal -->

                <div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">

                    <div class="modal-dialog modal-lg modal-dialog-scrollable">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h5 class="modal-title" id="modalTitle">Add New Coupon</h5>

                                <button type="button" class="btn-close" data-bs-dismiss="modal"

                                    aria-label="Close"></button>

                            </div>

                            <div class="modal-body">

                                <form id="coupon-form">

                                    @csrf

                                    <input type="hidden" id="coupon-id">

                                    <div class="row g-3">

                                        <div class="col-md-6">

                                            <label for="code" class="form-label">Coupon Code *</label>

                                            <input type="text" id="code" name="code" required

                                                class="form-control font-monospace" placeholder="e.g., SAVE20">

                                        </div>

                                        <div class="col-md-3">

                                            <label for="type" class="form-label">Discount Type *</label>

                                            <select id="type" name="type" class="form-select">

                                                <option value="percentage">Percentage (%)</option>

                                                <option value="fixed">Fixed Amount (RM)</option>

                                            </select>

                                        </div>

                                        <div class="col-md-3">

                                            <label for="value" class="form-label">Discount Value *</label>

                                            <input type="number" id="value" name="value" required min="0.01"

                                                step="0.01" class="form-control" placeholder="20">

                                        </div>

                                        <div class="col-md-6">

                                            <label for="min_amount" class="form-label">Minimum Order Amount *</label>

                                            <input type="number" id="min_amount" name="min_amount" required

                                                min="0" step="0.01" class="form-control" placeholder="100">

                                        </div>

                                        <div class="col-md-6">

                                            <label for="max_discount" class="form-label">Maximum Discount Amount</label>

                                            <input type="number" id="max_discount" name="max_discount" min="0"

                                                step="0.01" class="form-control" placeholder="50">

                                        </div>

                                        <div class="col-md-6">

                                            <label for="coupon_categories" class="form-label">Categories</label>

                                             <select class="select2-coupon-codes" multiple id="coupon_categories" name="coupon_categories[]">

                                                <option disabled value="">Select Categories</option>

                                             
                                            </select>

                                        </div>

                                         <div class="col-md-6">

                                            <label for="coupon_products" class="form-label">Products</label>

                                             <select class="select2-coupon-codes" multiple id="coupon_products" name="coupon_products[]">

                                                <option disabled value="">Select Products</option>                                                

                                

                                            </select>

                                        </div>

                                        <div class="col-md-6">

                                            <label for="coupon_product_variants" class="form-label">Product Variants</label>

                                             <select class="select2-coupon-codes" multiple id="coupon_product_variants" name="coupon_product_variants[]">

                                                <option disabled value="">Select Product Variants</option>                                                

                                            </select>

                                        </div>

                                        <div class="col-md-6">

                                            <label for="coupon_subscriptions" class="form-label">Subscriptions</label>

                                             <select class="select2-coupon-codes" multiple id="coupon_subscriptions" name="coupon_subscriptions[]">

                                                <option disabled value="">Select Subscriptions</option>  
                                                                                            

                                            </select>

                                        </div>

                                        <div class="col-md-3">

                                            <label for="usage_limit" class="form-label">Usage Limit *</label>

                                            <input type="number" id="usage_limit" name="usage_limit" required

                                                min="1" class="form-control" placeholder="100">

                                        </div>

                                        <div class="col-md-3">

                                            <label for="per_user_limit" class="form-label">Per User Limit</label>

                                            <input type="number" id="per_user_limit" name="per_user_limit"

                                                min="1" class="form-control" placeholder="100">

                                        </div>

                                        <div class="col-md-3">

                                            <label for="expiry_date" class="form-label">Expiry Date *</label>

                                            <input type="date" id="expiry_date" name="expiry_date" required

                                                class="form-control" min="{{ now()->toDateString() }}">

                                        </div>

                                        <div class="col-md-3">

                                            <div class="">



                                                <label for="status" class="form-label">Status</label>

                                                <select id="status" name="status" class="form-select form-control">

                                                    <option value="active">Active</option>

                                                    <option value="inactive">Inactive</option>

                                                </select>

                                            </div>

                                        </div>

                                        <div class="col-12">

                                            <label for="description" class="form-label">Description</label>

                                            <textarea id="description" name="description" class="form-control" rows="3"

                                                placeholder="Brief description of the coupon..."></textarea>

                                        </div>

                                    </div>

                                    <div class="mt-4 d-flex justify-content-end gap-3">

                                        <button type="button" class="btn btn-light"

                                            data-bs-dismiss="modal">Cancel</button>

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

        <!--datatable js-->

        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

        <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>



        <script src="{{ URL('admin/assets') }}/js/pages/datatables.init.js"></script>

        <script>

            $(document).ready(function() {



                $('.select2-coupon-codes').select2({

                    dropdownParent: $('#couponModal'),

                    width: '100%'

                });



                $('#coupon_products').on('change', function() {

                    var productIds = $(this).val();

                    

                    if (productIds.length > 0) {

                        $.ajax({

                            url: '{{ route('admin.code.variantsByProducts') }}',

                            type: 'GET',

                            data: {

                                product_ids: productIds

                            },

                            success: function(data) {

                                // Clear old options

                                let $variant = $('#coupon_product_variants');

                                $variant.empty();

                                $variant.append(

                                    '<option disabled>Select Product Variant</option>');



                                // Add new options

                                $.each(data, function(key, value) {

                                    $variant.append('<option value="' + value.id + '">' +

                                        value.name + '</option>');

                                });



                                // Refresh Select2 (important)

                                $variant.trigger('change.select2');

                            }

                        });

                    } else {

                        $('#coupon_product_variants').empty().append(

                                '<option disabled>Select Product Variant</option>')

                            .trigger('change.select2');

                    }

                });



                // Initialize DataTables with Bootstrap 5 integration

                const table = $('#coupons-table').DataTable({

                    processing: true,

                    serverSide: true,

                    responsive: true,

                    autoWidth: false,

                    ajax: {

                        url: '{{ route('admin.settings.free-shipping.index') }}',

                        type: 'GET',

                    },


                    columns: [{

                            data: 'name',
                            name: 'variable'

                        },

                        {

                            data: 'value',
                            name: 'value'

                        },
                        {

                            data: 'actions',

                            orderable: false,

                            searchable: false

                        }

                    ],

                    language: {

                        paginate: {

                            previous: "Previous",

                            next: "Next"

                        },

                        emptyTable: "No coupons found",

                        processing: "Loading...",

                        search: ""

                    }
                });





                // Form submission

                $('#coupon-form').on('submit', function(e) {

                    e.preventDefault();

                    const couponId = $('#coupon-id').val();

                    const url = couponId ? '{{ route('admin.coupon.update', ':id') }}'.replace(':id',

                            couponId) :

                        '{{ route('admin.coupon.store') }}';

                    const method = couponId ? 'PUT' : 'POST';



                    $.ajax({

                        url: url,

                        method: method,

                        data: $(this).serialize(),

                        headers: {

                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

                        success: function(response) {

                            if (response.success) {

                                toastr.success(response.message);

                                table.ajax.reload();

                                $('#couponModal').modal('hide');

                            }

                        },

                        error: function(xhr) {

                            const errors = xhr.responseJSON.errors;

                            let errorMessage = 'Please fix the following errors:\n';

                            $.each(errors, function(key, value) {

                                errorMessage += `- ${value[0]}\n`;

                            });

                            toastr.error(errorMessage);

                        }

                    });

                });





            });



            function openModal(coupon = null) {



                if (coupon) {

                    console.log(coupon.expiry_date);



                    $('#modalTitle').text('Edit Coupon');

                    $('#coupon-id').val(coupon.id);

                    $('#code').val(coupon.code);

                    $('#type').val(coupon.type);

                    $('#value').val(coupon.value);

                    $('#min_amount').val(coupon.min_amount);

                    $('#max_discount').val(coupon.max_discount || '');

                    $('#usage_limit').val(coupon.usage_limit);

                    $('#per_user_limit').val(coupon.per_user_limit);

                    if (coupon.expiry_date) {

                        const date = new Date(coupon.expiry_date);

                        const year = date.getFullYear();

                        const month = String(date.getMonth() + 1).padStart(2, '0');

                        const day = String(date.getDate()).padStart(2, '0');

                        const formattedDate = `${year}-${month}-${day}`;

                        $('#expiry_date').val(formattedDate);

                    } else {

                        $('#expiry_date').val('');

                    }

                    $('#status').val(coupon.status);

                    $('#description').val(coupon.description || '');



                    if (coupon.categories) {

                        const categoryIds = coupon.categories.map(c => c.id);

                        $('#coupon_categories').val(categoryIds).trigger('change');

                    }



                    if (coupon.products) {

                        const productIds = coupon.products.map(p => p.id);

                        $('#coupon_products').val(productIds).trigger('change');

                    }



                    setTimeout(() => {

                        if (coupon.variants) {

                            const variantIds = coupon.variants.map(v => v.id);

                            $('#coupon_product_variants').val(variantIds).trigger('change');

                        }

                    }, 1000);



                } else {

                    $('#modalTitle').text('Add New Coupon');

                    $('#coupon-form')[0].reset();

                    $('#coupon-id').val('');

                    $('#status').val('active');

                    $('#code').val('');

                    $('#type').val('');

                    $('#value').val('');

                    $('#min_amount').val('');

                    $('#max_discount').val('');

                    $('#usage_limit').val('');

                    $('#expiry_date').val('');

                    $('#description').val('');



                    $('#coupon_categories').val(null).trigger('change');

                    $('#coupon_products').val(null).trigger('change');

                    $('#coupon_product_variants').val(null).trigger('change');

                }

                $('#couponModal').modal('show');

            }



            function closeModal() {

                $('#couponModal').modal('hide');

            }



            function deleteCoupon(id) {

                // swal({

                //     title: 'Are you sure?',

                //     text: 'You won\'t be able to revert this!',

                //     icon: 'warning',

                //     showCancelButton: true,

                //     confirmButtonText: 'Yes, delete it!'

                // }).then((result) => {

                //     if (result.isConfirmed) {



                //     }

                // });



                swal({

                    title: "Are you sure you want to delete this record?",

                    text: "If you delete this, it will be gone forever.",

                    icon: "warning",

                    buttons: {

                        cancel: {

                            text: "Cancel",

                            visible: true,

                            className: "custom-cancel-btn",

                        },

                        confirm: {

                            text: "OK",

                            closeModal: true,

                            className: "custom-confirm-btn"

                        }

                    },

                    dangerMode: true,

                }).then((willDelete) => {

                    if (willDelete) {

                        $.ajax({

                            url: '{{ route('admin.coupon.destroy', ':id') }}'.replace(':id', id),

                            method: 'DELETE',

                            headers: {

                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                            },

                            success: function(response) {

                                if (response.success) {

                                    toastr.success(response.message);

                                    $('#coupons-table').DataTable().ajax.reload();

                                }

                            },

                            error: function(xhr) {

                                toastr.error(xhr.responseJSON.message);

                            }

                        });

                    }

                });

            }

        </script>

    @endsection

