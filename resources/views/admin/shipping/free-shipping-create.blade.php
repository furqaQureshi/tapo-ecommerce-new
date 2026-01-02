@extends('admin.master.layouts.app')

@section('page-title')
     Free Shipping Edit
@endsection


@section('page-content')
<div class="page-content">
    <div class="container-fluid">
        
<h1 class="h3 mb-2 text-dark">Edit Shipping Price</h1>
<br>
<div class="row">
    <div class="col-md-4">
         <form action="{{ route('admin.settings.free-shipping.update') }}" method="POST">
            @csrf
                        <div class="mb-3">
                            <label for="amount" class="form-label"><b>Amount</b></label>
                            <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount" value="{{ $freeShipping->value }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
    </div>
    
</div>






    </div>
</div>
@endsection