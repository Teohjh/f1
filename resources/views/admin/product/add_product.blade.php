<!-- Add Product Page -->
@extends('layouts.master')

<!-- Page Title -->
@section('title','Add Product')

@section('admin_content')

<!-- Page content-->
<div class="container-fluid px-4">

    <!--Message shown when add product successful-->
    @if(session()->has('success'))
    <div class="card mt-4" id="message_show">
        <div class="card-body"> 
            <div class="alert alert-success">
                {{ session()->get('success') }}
                <button id="close" type="button" class="close float-right" data-dismiss="alert" aria-label="Close" style="float: right">
                    <span aria-hidden="true" class="float-right">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    <!--Message shown when add product fail-->
    @if(session()->has('fail'))
    <div class="card mt-4" id="message_show">
        <div class="card-body"> 
            <div class="alert alert-danger">
                {{ session()->get('fail') }}
                <button id="close" type="button" class="close float-right" data-dismiss="alert" aria-label="Close" style="float: right">
                    <span aria-hidden="true" class="float-right">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Enter New Product Detail -->
    <div class="card mt-4">
        <div class="card-header">
            <h4 class=""> <a href="javascript:history.back()" style="color:#000000"> <i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>   Add Product</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/product/add/store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                <label for="product_code"> Product Code </label>
                    <input type="text" class="form-control" placeholder="Enter Product Code"
                         name="product_code" value="{{old('product_code')}}">
                    <span class="text-danger">@error('product_code') {{$message}} @enderror </span>
                </div>

                <div class="mb-3">
                <label for="product_name"> Product Name </label>
                    <input type="text" class="form-control" placeholder="Enter Product Name"
                         name="product_name" value="{{old('product_name')}}">
                    <span class="text-danger">@error('product_name') {{$message}} @enderror </span>
                </div>

                <div class="mb-3">
                <label for="product_description"> Product Description </label>
                    <input type="text" class="form-control" placeholder="Enter Product Description"
                         name="product_description" value="{{old('product_description')}}">
                    <span class="text-danger">@error('product_description') {{$message}} @enderror </span>
                </div>

                <div class="mb-3">
                <label for="product_image"> Product Image </label>
                     <input type="file" class="form-control" placeholder="Upload Product Image"
                     name="product_image" value="">
                    <span class="text-danger">@error('product_image') {{$message}} @enderror </span>
                </div>

                <div class="mb-3">
                <label for="product_stock_quantity"> Stock Quantity </label>
                    <input type="text" class="form-control" placeholder="Enter Stock Quantity"
                         name="product_stock_quantity" value="{{old('product_stock_quantity')}}">
                    <span class="text-danger">@error('product_stock_quantity') {{$message}} @enderror </span>
                </div>

                <div class="mb-3">
                <label for="product_price"> Product Price (RM)</label>
                    <input type="text" class="form-control" placeholder="Enter Product Price"
                         name="product_price" value="{{old('product_price')}}">
                    <span class="text-danger">@error('product_price') {{$message}} @enderror </span>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-success float-end">Add</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    //close the message after add
    $(document).ready(function () {
        
        $("#message_show").hide().fadeIn(1000);

        //close the message when the button with id="close" is clicked
        $("#close").on("click", function (e) {
            e.preventDefault();
            $("#message_show").fadeOut(1000);
        });
    });
</script>
@endpush