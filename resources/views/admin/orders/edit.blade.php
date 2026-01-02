@extends('admin.master.layouts.app')
@section('page-title')
    Edit Order
@endsection
@section('head')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond@^4.30.4/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        li.select2-selection__choice {
            color: black !important;
        }

        .filepond--root {
            max-height: 400px;
            border: 2px dashed #ddd;
            border-radius: 8px;
            padding: 10px;
        }

        .filepond--panel-root {
            background-color: #f8f9fa;
        }

        .filepond--item {
            width: 25%;
            /* 4 items per row */
            padding: 5px;
            box-sizing: border-box;
        }

        .filepond--item>.filepond--panel {
            border-radius: 8px;
        }

        .filepond--image-preview {
            border-radius: 8px;
            overflow: hidden;
        }

        .filepond--file-info {
            font-size: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .filepond--file-action-button {
            cursor: pointer;
        }

        .filepond--drop-label {
            font-size: 16px;
            color: #666;
        }

        /* Scrollable FilePond wrapper */
        .filepond-wrapper {
            max-height: 300px;
            /* Adjustable height */
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .filepond--list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 0;
            padding: 10px;
        }

        @media (max-width: 768px) {
            .filepond--item {
                width: 50%;
                /* 2 items per row on smaller screens */
            }
        }

        @media (max-width: 576px) {
            .filepond--item {
                width: 100%;
                /* 1 item per row on very small screens */
            }
        }

        /* Existing images styling */
        .existing-images .col-md-3 {
            position: relative;
            margin-bottom: 10px;
        }

        .existing-images img {
            max-height: 100px;
            width: 100%;
            object-fit: cover;
        }

        .existing-images .btn-danger {
            position: absolute;
            top: 0;
            right: 0;
            padding: 2px 6px;
            font-size: 12px;
        }
    </style>
@endsection
@section('page-content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <form class="row g-3" method="POST" action="{{ route('admin.order.update', $order->id) }}"
                        enctype="multipart/form-data" method="POST">
                            @csrf
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <div class="p-0">
                                                <h4 class="card-title mb-0 flex-grow-1">Customer</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                            <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control" placeholder="Enter first name" name="first_name" value="{{ $order->first_name }}" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control" placeholder="Enter last name" name="last_name" value="{{ $order->last_name }}" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Email Address</label>
                                                    <input type="email" class="form-control" placeholder="Enter email" name="email" value="{{ $order->email }}"  required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Phone Number</label>
                                                    <input type="phone" class="wide form-control" placeholder="Phone Number" name="phone_number" value="{{ $order->phone_number }}" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <select class="wide form-control" name="state" id="stateDropdown">
                                                        <option value="">Select state</option>
                                                            @foreach($states as $state)
                                                                <option value="{{ $state->name }}" {{ $order->state_id == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <select class="wide form-control" name="city_id" id="cityDropdown" required>
                                                        <option value="">Select City</option>
                                                        @foreach($cities as $city)
                                                            <option value="{{ $city->id }}" {{ $order->city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Zip/Postal Code</label>
                                                    <input type="text" class="form-control" placeholder="Enter zip code" name="postal_code" value="{{ $order->postal_code }}" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input rows="2" type="text" class="form-control" name="address" value="{{ $order->address }}" required>
                                                </div>
                                            </div>

                                <!-- <div class="col-12">
                                    <div class="text-end">
                                        <button class="btn btn-danger" type="submit">Update</button>
                                    </div>
                                </div> -->
                            </div>
                            <!-- </form> -->
                        </div>
                         <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div class="p-0">
                                    <h4 class="card-title mb-0 flex-grow-1">Order Items</h4>
                                </div>
                                {{-- <a href="{{ route('admin.order.items.add', $order->id) }}">

                                        <button type="button" class="btn btn-primary">
                                            Add Item
                                        </button>
                                    </a> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>Quantity</th>
                                    <th>Actions</th>
                                    <!-- <th>Total Price</th> -->
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                <tr>
                                    <td>
                                        <input type="hidden" name="product_ids[]" value="{{ $item->product->id }}">
                                        <input type="hidden" name="product_prices[]" value="{{ $item->product->price }}">
                                        <img src="{{ asset($item->product->media[0]->image_path) }}" width="50px"></td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->product->price }}</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity[]"
                                        value="{{ $item->quantity }}" style="max-width: 40%;"">
                                    </td>
                                    <td>
                                        <form action="{{ url('account/order/item-delete') }}" method="POST" id="item-delete-form">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <input type="hidden" name="order_item_id" value="{{ $item->id }}">
                                            <button type="button" onclick="deleteItem()" class="btn btn-danger">
                                                <i class="ri-delete-bin-line"></i>
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-lg-9"></div>
                                <div class="col-lg-3">
                                    <br>
                                    <p style="margin-bottom:0px;"><b>Sub Total:</b> {{ $order->total_amount }}</p>
                                    <p><b>Grand Total:</b> {{ $order->grand_total }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="text-end">
                                    <button class="btn btn-danger" type="submit">Update</button>
                                </div>
                            </div>
                        </div>
                        </div>
                    </form>


                </div>
            </div>


        </div>
        @include('admin.products.modal')
    @endsection
    @section('scripts')
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js">
        </script>
        <script src="https://unpkg.com/filepond@^4.30.4/dist/filepond.min.js"></script>
        <script src="{{ asset('admin/assets') }}/libs/sortablejs/Sortable.min.js"></script>
        <script src="{{ asset('admin/assets') }}/js/pages/nestable.init.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>

         $(function(){
               $('#stateDropdown').on('change', function () {
                let state = $(this).val();
                if(state) {
                    $.ajax({
                        // url: "/get-cities/" + state,
                        url: "{{ route('get.cities', '') }}/" + state,
                        type: "GET",
                        success: function (data) {
                            console.log("Cities Loaded:", data);

                            $('#cityDropdown').empty();
                            $('#cityDropdown').append('<option value="">Select City</option>');

                            $.each(data, function (key, city) {
                                $('#cityDropdown').append(
                                    '<option value="' + city.id + '">' + city.name + '</option>'
                                );
                            });
                        },
                        error: function(xhr) {
                            console.log("AJAX Error:", xhr.responseText);
                        }
                    });
                }
            });
         });

         function updateOrder()
         {
            // alert('good');
            $('#item-edit-form').submit();
         }
         function deleteItem()
         {
            $('#item-delete-form').submit();
         }
        </script>
    @endsection
