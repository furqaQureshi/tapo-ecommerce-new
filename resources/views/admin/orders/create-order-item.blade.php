@extends('admin.master.layouts.app')
@section('page-title')


@section('page-content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <form class="row g-3" method="POST" action="{{ route('admin.order.createAddItems') }}" id="product-form">
                            @csrf
                                <input type="hidden" name="order_id" value="{{ $orderId }}">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <div class="p-0">
                                                <h4 class="card-title mb-0 flex-grow-1">Customer</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Product</label>
                                                    <select class="form-control" name="product_id">
                                                        <option value="">Select Product</option>
                                                            @foreach($data as $product)
                                                                <option value="{{ $product->id }}" >{{$product->name }}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                                <div class="col-lg-6 mt-3">
                                                    <div class="form-group">
                                                        <label>Quantity</label>
                                                        <input type="text" class="form-control" placeholder="Enter Quantity" name="quantity" value="" required>
                                                    </div>
                                                </div>
                                             <div class="col-lg-6 mt-3">
                                                {{-- <div class="form-group">
                                                    <label>type</label>
                                                    <select class="wide form-control" name="state" id="stateDropdown">
                                                        <option value="">Select Product</option>
                                                            @foreach($data as $product)
                                                                <option value="" >select Product</option>
                                                                <option value="{{ $product->name }}" >{{$product->name }}</option>
                                                            @endforeach
                                                    </select>
                                                </div> --}}

                                            <div class="col-lg-12">
                                                <div class="form-group mt-5">
                                                    <button class="btn btn-primary" type="submit" >Add Item</button>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </form>

                </div>
            </div>


        </div>
    @endsection


@endsection
